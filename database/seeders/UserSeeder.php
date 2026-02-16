<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\User; // Pastikan Model User diimport
use Illuminate\Support\Facades\Hash; // Import Hash untuk password

class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        // 1. Akun Admin
        User::create([
            'name' => 'Administrator Utama',
            'email' => 'admin@gmail.com',
            'password' => Hash::make('password'), // Password: password
            'role' => 'admin', // Pastikan kolom ini ada di tabel users
        ]);

        // 2. Akun Petugas
        User::create([
            'name' => 'Petugas Lapangan',
            'email' => 'petugas@gmail.com',
            'password' => Hash::make('password'),
            'role' => 'petugas',
        ]);

        // 3. Akun Masyarakat (Opsional, buat ngetes login masyarakat)
        User::create([
            'name' => 'Warga Sipil',
            'email' => 'warga@gmail.com',
            'password' => Hash::make('password'),
            'role' => 'masyarakat',
        ]);
    }
}
