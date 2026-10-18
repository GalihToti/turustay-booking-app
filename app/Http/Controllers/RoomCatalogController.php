<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\RoomType;
use App\Services\RoomAvailability;

class RoomCatalogController extends Controller
{
    public function index(Request $request) 
    {
        $checkIn = $request->input('check_in', '');
        $checkOut = $request->input('check_out', '');
        $guests = $request->input('guests', '');
        $searched = $request->filled('check_in') && $request->filled('check_out');
        $search = [
            'check_in' => $checkIn,
            'check_out' => $checkOut,
            'guests' => $guests,
        ];

        $roomTypes = RoomType::with('facilities')->get();

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
        $checkIn = $request->query('check_in', '');
        $checkOut = $request->query('check_out', '');
        $guests = $request->query('guests', 1);
        $availableCount = null; 

        if ($request->filled('check_in') && $request->filled('check_out')) {
            $availableCount = RoomAvailability::rooms($roomType->id, $checkIn, $checkOut)->count();
        }
        return view('rooms.show', compact('roomType', 'checkIn', 'checkOut', 'guests', 'availableCount'));
    }
}