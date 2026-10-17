<?php

namespace Database\Seeders;

use App\Models\Facility;
use App\Models\Room;
use App\Models\RoomType;
use Illuminate\Database\Seeder;

class RoomSeeder extends Seeder
{
    public function run(): void
    {
        $facilities = collect([
            ['name' => 'WiFi', 'icon' => 'bi-wifi'],
            ['name' => 'AC', 'icon' => 'bi-snow'],
            ['name' => 'Sarapan', 'icon' => 'bi-cup-hot'],
            ['name' => 'TV', 'icon' => 'bi-tv'],
            ['name' => 'Kolam Renang', 'icon' => 'bi-water'],
        ])->mapWithKeys(function ($data) {
            $facility = Facility::firstOrCreate(['name' => $data['name']], $data);

            return [$facility->name => $facility->id];
        });

        $types = [
            [
                'name' => 'Standard',
                'description' => 'Kamar nyaman untuk 2 tamu dengan kebutuhan dasar menginap.',
                'price_per_night' => 250000,
                'capacity' => 2,
                'facilities' => ['WiFi', 'AC'],
                'rooms' => ['101', '102', '103'],
                'floor' => 1,
            ],
            [
                'name' => 'Deluxe',
                'description' => 'Kamar lebih luas dengan sarapan dan TV, cocok untuk keluarga kecil.',
                'price_per_night' => 450000,
                'capacity' => 3,
                'facilities' => ['WiFi', 'AC', 'Sarapan', 'TV'],
                'rooms' => ['201', '202', '203'],
                'floor' => 2,
            ],
            [
                'name' => 'Suite',
                'description' => 'Kamar terbaik dengan semua fasilitas dan akses kolam renang.',
                'price_per_night' => 850000,
                'capacity' => 4,
                'facilities' => ['WiFi', 'AC', 'Sarapan', 'TV', 'Kolam Renang'],
                'rooms' => ['301', '302'],
                'floor' => 3,
            ],
        ];

        foreach ($types as $data) {
            $type = RoomType::firstOrCreate(
                ['name' => $data['name']],
                [
                    'description' => $data['description'],
                    'price_per_night' => $data['price_per_night'],
                    'capacity' => $data['capacity'],
                ]
            );

            $type->facilities()->syncWithoutDetaching(
                collect($data['facilities'])->map(fn ($name) => $facilities[$name])->all()
            );

            foreach ($data['rooms'] as $number) {
                Room::firstOrCreate(
                    ['room_number' => $number],
                    ['room_type_id' => $type->id, 'floor' => $data['floor'], 'status' => 'available']
                );
            }
        }
    }
}