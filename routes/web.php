<?php

use Illuminate\Support\Facades\Route;

Route::middleware(['auth', 'admin'])
    ->prefix('admin')
    ->name('admin.')
    ->group(function () {
        Route::get('/', function () {
            return 'Dashboard admin TuruStay';
        })->name('dashboard');

        // Langkah 5 nanti:
        // Route::resource('room-types', Admin\RoomTypeController::class);
        // Route::resource('rooms', Admin\RoomController::class);
        // Route::resource('facilities', Admin\FacilityController::class);
        // Route::resource('bookings', Admin\BookingController::class)->only(['index', 'show', 'update', 'destroy']);
    });

