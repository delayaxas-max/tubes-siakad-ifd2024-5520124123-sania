<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    public function run(): void
    {
        $this->call([
            DosenSeeder::class,
            MatakuliahSeeder::class,
            MahasiswaSeeder::class,
            JadwalSeeder::class,
            UserSeeder::class,
            KrsSeeder::class, // Tambahkan ini
        ]);
    }
}