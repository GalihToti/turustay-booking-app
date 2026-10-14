<?php

use App\Http\Controllers\Admin\BookingController;
use App\Http\Controllers\Admin\FacilityController;
use App\Http\Controllers\Admin\RoomController;
use App\Http\Controllers\Admin\RoomTypeController;
use Illuminate\Support\Facades\Route;

Route::middleware(['auth', 'admin'])
    ->prefix('admin')
    ->name('admin.')
    ->group(function () {
        Route::get('/', function () {
            return 'Dashboard admin TuruStay';
        })->name('dashboard');

        Route::resource('room-types', RoomTypeController::class);
        Route::resource('rooms', RoomController::class)->except('show');
        Route::resource('facilities', FacilityController::class)->except('show');
        Route::resource('bookings', BookingController::class)->only(['index', 'show', 'update', 'destroy']);

        // Langkah 5 nanti:
        // Route::resource('room-types', Admin\RoomTypeController::class);
        // Route::resource('rooms', Admin\RoomController::class);
        // Route::resource('facilities', Admin\FacilityController::class);
        // Route::resource('bookings', Admin\BookingController::class)->only(['index', 'show', 'update', 'destroy']);
    });

