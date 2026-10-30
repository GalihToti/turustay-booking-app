<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use App\Models\RoomType;
use App\Services\RoomAvailability;

class RoomCatalogController extends Controller
{
    public function index(Request $request)
    {
        $checkIn  = $request->input('check_in', '');
        $checkOut = $request->input('check_out', '');
        $guests   = $request->input('guests', '');
        $searched = false;
        $search   = [
            'check_in'  => $checkIn,
            'check_out' => $checkOut,
            'guests'    => $guests,
        ];

        $query = RoomType::with('facilities');

        // --- Validasi tanggal jika user mencoba mencari ---
        if ($request->filled('check_in') || $request->filled('check_out')) {
            $validator = Validator::make($request->all(), [
                'check_in'  => ['required', 'date', 'after_or_equal:today'],
                'check_out' => ['required', 'date', 'after:check_in'],
                'guests'    => ['nullable', 'integer', 'min:1'],
            ], [
                'check_in.required'       => 'Tanggal check-in wajib diisi.',
                'check_in.date'           => 'Format tanggal check-in tidak valid.',
                'check_in.after_or_equal' => 'Tanggal check-in tidak boleh sebelum hari ini.',
                'check_out.required'      => 'Tanggal check-out wajib diisi.',
                'check_out.date'          => 'Format tanggal check-out tidak valid.',
                'check_out.after'         => 'Tanggal check-out harus setelah tanggal check-in.',
                'guests.integer'          => 'Jumlah tamu harus berupa angka.',
                'guests.min'              => 'Jumlah tamu minimal 1 orang.',
            ]);

            if ($validator->fails()) {
                // Tampilkan halaman tanpa hasil pencarian, tapi dengan pesan error
                $roomTypes = $query->get();
                return view('welcome', compact('checkIn', 'checkOut', 'guests', 'searched', 'search', 'roomTypes'))
                    ->withErrors($validator);
            }

            $searched = true;
        }

        // --- Filter berdasarkan kapasitas tamu ---
        if ($guests) {
            $query->where('capacity', '>=', (int) $guests);
        }

        $roomTypes = $query->get();

        // --- Hitung ketersediaan per tipe kamar ---
        if ($searched) {
            $roomTypes->map(function ($type) use ($checkIn, $checkOut) {
                $type->available_count = RoomAvailability::rooms($type->id, $checkIn, $checkOut)->count();
                return $type;
            });
        }

        return view('welcome', compact(
            'checkIn',
            'checkOut',
            'guests',
            'searched',
            'search',
            'roomTypes'
        ));
    }

    public function show(Request $request, RoomType $roomType)
    {
        $roomType->load('facilities');
        $checkIn  = $request->query('check_in', '');
        $checkOut = $request->query('check_out', '');
        $guests   = $request->query('guests', 1);
        $availableCount = null;

        if ($request->filled('check_in') && $request->filled('check_out')) {
            $validator = Validator::make($request->all(), [
                'check_in'  => ['required', 'date', 'after_or_equal:today'],
                'check_out' => ['required', 'date', 'after:check_in'],
            ], [
                'check_in.after_or_equal' => 'Tanggal check-in tidak boleh sebelum hari ini.',
                'check_out.after'         => 'Tanggal check-out harus setelah tanggal check-in.',
            ]);

            if ($validator->fails()) {
                return view('rooms.show', compact('roomType', 'checkIn', 'checkOut', 'guests', 'availableCount'))
                    ->withErrors($validator);
            }

            $availableCount = RoomAvailability::rooms($roomType->id, $checkIn, $checkOut)->count();
        }

        return view('rooms.show', compact('roomType', 'checkIn', 'checkOut', 'guests', 'availableCount'));
    }
}
