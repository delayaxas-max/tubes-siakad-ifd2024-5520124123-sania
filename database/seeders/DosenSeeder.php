<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Dosen;

class DosenSeeder extends Seeder
{
    public function run(): void
    {
        Dosen::insert([
            ['nidn'=>'1000000001','nama'=>'Dr. Ahmad Fauzi','created_at'=>now(),'updated_at'=>now()],
            ['nidn'=>'1000000002','nama'=>'Dr. Siti Rahma','created_at'=>now(),'updated_at'=>now()],
            ['nidn'=>'1000000003','nama'=>'Dr. Budi Santoso','created_at'=>now(),'updated_at'=>now()],
            ['nidn'=>'1000000004','nama'=>'Dr. Dewi Lestari','created_at'=>now(),'updated_at'=>now()],
            ['nidn'=>'1000000005','nama'=>'Dr. Rudi Hartono','created_at'=>now(),'updated_at'=>now()],
        ]);
    }
}