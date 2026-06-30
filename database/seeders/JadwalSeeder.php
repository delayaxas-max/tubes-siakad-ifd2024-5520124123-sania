<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Jadwal;

class JadwalSeeder extends Seeder
{
    public function run(): void
    {
        Jadwal::insert([
            [
                'kode_matakuliah' => 'IF001',
                'nidn' => '1000000001',
                'kelas' => 'A',
                'hari' => 'Senin',
                'jam' => '08:00:00', // Waktu statis
                'ruangan' => 'R.301',
                'created_at' => now(),
                'updated_at' => now()
            ],
            [
                'kode_matakuliah' => 'IF001',
                'nidn' => '1000000001',
                'kelas' => 'B',
                'hari' => 'Rabu',
                'jam' => '10:00:00',
                'ruangan' => 'R.301',
                'created_at' => now(),
                'updated_at' => now()
            ],
            [
                'kode_matakuliah' => 'IF002',
                'nidn' => '1000000002',
                'kelas' => 'A',
                'hari' => 'Selasa',
                'jam' => '09:00:00',
                'ruangan' => 'R.302',
                'created_at' => now(),
                'updated_at' => now()
            ],
            [
                'kode_matakuliah' => 'IF002',
                'nidn' => '1000000002',
                'kelas' => 'B',
                'hari' => 'Kamis',
                'jam' => '13:00:00',
                'ruangan' => 'R.302',
                'created_at' => now(),
                'updated_at' => now()
            ],
            [
                'kode_matakuliah' => 'IF003',
                'nidn' => '1000000003',
                'kelas' => 'A',
                'hari' => 'Rabu',
                'jam' => '08:00:00',
                'ruangan' => 'R.303',
                'created_at' => now(),
                'updated_at' => now()
            ],
            [
                'kode_matakuliah' => 'IF003',
                'nidn' => '1000000003',
                'kelas' => 'B',
                'hari' => 'Jumat',
                'jam' => '10:00:00',
                'ruangan' => 'R.303',
                'created_at' => now(),
                'updated_at' => now()
            ],
            [
                'kode_matakuliah' => 'IF004',
                'nidn' => '1000000004',
                'kelas' => 'A',
                'hari' => 'Senin',
                'jam' => '13:00:00',
                'ruangan' => 'R.304',
                'created_at' => now(),
                'updated_at' => now()
            ],
            [
                'kode_matakuliah' => 'IF005',
                'nidn' => '1000000005',
                'kelas' => 'A',
                'hari' => 'Selasa',
                'jam' => '14:00:00',
                'ruangan' => 'R.305',
                'created_at' => now(),
                'updated_at' => now()
            ],
        ]);
    }
}