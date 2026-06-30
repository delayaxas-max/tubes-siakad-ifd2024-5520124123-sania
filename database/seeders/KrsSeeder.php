<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Krs;

class KrsSeeder extends Seeder
{
    public function run(): void
    {
        Krs::insert([
            // Andi Saputra (231000001) - ambil 3 mata kuliah
            [
                'npm' => '231000001',
                'kode_matakuliah' => 'IF001',
                'status' => 'Aktif',
                'created_at' => now(),
                'updated_at' => now()
            ],
            [
                'npm' => '231000001',
                'kode_matakuliah' => 'IF002',
                'status' => 'Aktif',
                'created_at' => now(),
                'updated_at' => now()
            ],
            [
                'npm' => '231000001',
                'kode_matakuliah' => 'IF003',
                'status' => 'Aktif',
                'created_at' => now(),
                'updated_at' => now()
            ],

            // Bunga Maharani (231000002) - ambil 2 mata kuliah
            [
                'npm' => '231000002',
                'kode_matakuliah' => 'IF001',
                'status' => 'Aktif',
                'created_at' => now(),
                'updated_at' => now()
            ],
            [
                'npm' => '231000002',
                'kode_matakuliah' => 'IF004',
                'status' => 'Aktif',
                'created_at' => now(),
                'updated_at' => now()
            ],

            // Cahyo Pratama (231000003) - ambil 2 mata kuliah
            [
                'npm' => '231000003',
                'kode_matakuliah' => 'IF002',
                'status' => 'Aktif',
                'created_at' => now(),
                'updated_at' => now()
            ],
            [
                'npm' => '231000003',
                'kode_matakuliah' => 'IF005',
                'status' => 'Aktif',
                'created_at' => now(),
                'updated_at' => now()
            ],

            // Dinda Putri (231000004) - ambil 1 mata kuliah
            [
                'npm' => '231000004',
                'kode_matakuliah' => 'IF003',
                'status' => 'Aktif',
                'created_at' => now(),
                'updated_at' => now()
            ],

            // Eko Saputra (231000005) - ambil 2 mata kuliah
            [
                'npm' => '231000005',
                'kode_matakuliah' => 'IF001',
                'status' => 'Aktif',
                'created_at' => now(),
                'updated_at' => now()
            ],
            [
                'npm' => '231000005',
                'kode_matakuliah' => 'IF005',
                'status' => 'Aktif',
                'created_at' => now(),
                'updated_at' => now()
            ],
        ]);
    }
}