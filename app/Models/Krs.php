<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Krs extends Model
{
    protected $table = 'krs';
    protected $primaryKey = 'id_krs';

    protected $fillable = ['npm', 'kode_matakuliah', 'status'];

    public function mahasiswa()
    {
        return $this->belongsTo(Mahasiswa::class, 'npm', 'npm');
    }

    public function matakuliah()
    {
        return $this->belongsTo(Matakuliah::class, 'kode_matakuliah', 'kode_matakuliah');
    }

    // Ambil jadwal melalui matakuliah
    public function jadwal()
    {
        return $this->hasOneThrough(
            Jadwal::class,
            Matakuliah::class,
            'kode_matakuliah',
            'kode_matakuliah',
            'kode_matakuliah',
            'kode_matakuliah'
        );
    }
}