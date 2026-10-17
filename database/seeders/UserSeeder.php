<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Seeder;

class UserSeeder extends Seeder
{
    public function run(): void {
        User::updateOrCreate(
            ['email' => 'admin@gmail.com'],
            [
                'name' => 'Admin TuruStay',
                'phone' => '081234567890',
                'password' => 'password',
                'role' => 'admin',
            ]
        );

        User::updateOrCreate(
            ['email' => 'tamu@gmail.com'],
            [
                'name' => 'Tamu Demo',
                'phone' => '089876543210',
                'password' => 'password',
                'role' => 'user',
            ]
        );
    }
}
