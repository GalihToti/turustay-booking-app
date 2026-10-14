<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Room;
use App\Models\RoomType;
use Illuminate\Http\Request;
use Illuminate\Validation\Rule;

class RoomController extends Controller
{
    private function rules(?Room $room = null): array
    {
        return [
            'room_type_id' => ['required', 'exists:room_types,id'],
            'room_number'  => ['required', 'string', 'max:255', Rule::unique('rooms', 'room_number')->ignore($room)],
            'floor'        => ['required', 'integer', 'min:1'],
            'status'       => ['required', Rule::in(['available', 'maintenance'])],
        ];
    }

    public function index()
    {
        $rooms = Room::with('roomType')->orderBy('room_number')->paginate(10);
        return view('admin.rooms.index', compact('rooms'));
    }

    public function create()
    {
        $roomTypes = RoomType::orderBy('name')->get();
        return view('admin.rooms.create', compact('roomTypes'));
    }

    public function store(Request $request)
    {
        Room::create($request->validate($this->rules()));
        return redirect()->route('admin.rooms.index')->with('success', 'Kamar berhasil ditambahkan.');
    }

    public function edit(Room $room)
    {
        $roomTypes = RoomType::orderBy('name')->get();
        return view('admin.rooms.edit', compact('room', 'roomTypes'));
    }

    public function update(Request $request, Room $room)
    {
        $room->update($request->validate($this->rules($room)));
        return redirect()->route('admin.rooms.index')->with('success', 'Kamar berhasil diperbarui.');
    }

    public function destroy(Room $room)
    {
        if ($room->bookings()->exists()) {
            return back()->with('error', 'Kamar tidak bisa dihapus karena sudah memiliki booking.');
        }

        $room->delete();
        return redirect()->route('admin.rooms.index')->with('success', 'Kamar berhasil dihapus.');
    }
}