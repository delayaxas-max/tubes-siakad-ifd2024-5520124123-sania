<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Mahasiswa;

class MahasiswaSeeder extends Seeder
{
    public function run(): void
    {
        Mahasiswa::insert([

            [
                'npm'=>'231000001',
                'nidn'=>'1000000001',
                'nama'=>'Andi Saputra',
                'created_at'=>now(),
                'updated_at'=>now()
            ],

            [
                'npm'=>'231000002',
                'nidn'=>'1000000002',
                'nama'=>'Bunga Maharani',
                'created_at'=>now(),
                'updated_at'=>now()
            ],

            [
                'npm'=>'231000003',
                'nidn'=>'1000000003',
                'nama'=>'Cahyo Pratama',
                'created_at'=>now(),
                'updated_at'=>now()
            ],

            [
                'npm'=>'231000004',
                'nidn'=>'1000000004',
                'nama'=>'Dinda Putri',
                'created_at'=>now(),
                'updated_at'=>now()
            ],

            [
                'npm'=>'231000005',
                'nidn'=>'1000000005',
                'nama'=>'Eko Saputra',
                'created_at'=>now(),
                'updated_at'=>now()
            ],

        ]);
    }
}