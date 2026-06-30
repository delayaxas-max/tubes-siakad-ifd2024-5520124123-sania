<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\User;
use App\Models\Mahasiswa;
use Illuminate\Support\Facades\Hash;

class UserSeeder extends Seeder
{
    public function run(): void
    {
        // Admin
        User::create([
            'name' => 'Administrator',
            'email' => 'admin@siakad.com',
            'password' => Hash::make('admin123'),
            'role' => 'admin',
            'npm' => null,
        ]);

        // Ambil data mahasiswa dari tabel mahasiswa
        $mahasiswa = Mahasiswa::all();

        // Buat user untuk setiap mahasiswa
        $mahasiswaData = [
            ['name' => 'Andi Saputra', 'email' => 'andi@student.com', 'npm' => '231000001'],
            ['name' => 'Bunga Maharani', 'email' => 'bunga@student.com', 'npm' => '231000002'],
            ['name' => 'Cahyo Pratama', 'email' => 'cahyo@student.com', 'npm' => '231000003'],
            ['name' => 'Dinda Putri', 'email' => 'dinda@student.com', 'npm' => '231000004'],
            ['name' => 'Eko Saputra', 'email' => 'eko@student.com', 'npm' => '231000005'],
        ];

        foreach ($mahasiswaData as $data) {
            User::create([
                'name' => $data['name'],
                'email' => $data['email'],
                'password' => Hash::make('password'),
                'role' => 'mahasiswa',
                'npm' => $data['npm'],
            ]);
        }
    }
}