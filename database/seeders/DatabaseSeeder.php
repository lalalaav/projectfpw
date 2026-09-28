<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        User::create([
            'name' => 'Admin Toko',
            'email' => 'admin@toomuch.test',
            'password' => Hash::make('password'),
            'role' => 'admin',
        ]);

        User::create([
            'name' => 'Kasir Rina',
            'email' => 'kasir@toomuch.test',
            'password' => Hash::make('password'),
            'role' => 'kasir',
        ]);

        $this->call(CategorySeeder::class);
    }
}