<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Booking;
use App\Models\Room;
use App\Models\RoomType;
use Illuminate\Http\Request;

class DashboardController extends Controller
{
    public function index() {
        $stats = [
            'room_types'=>RoomType::count(),
            'rooms'=>Room::count(),
            'bookings'=>Booking::count(),
            'pending'=>Booking::where('status', 'pending')->count(),
        ];

        $latestBookings = Booking::with(['user', 'room.roomType'])
            ->latest()
            ->take(5)
            ->get();
        return view('admin.dashboard', compact('stats', 'latestBookings'));
    }
}
