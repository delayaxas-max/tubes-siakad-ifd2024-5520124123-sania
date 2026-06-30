<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Jadwal extends Model
{
    protected $table = 'jadwal';
    protected $primaryKey = 'id_jadwal';

    protected $fillable = [
        'kode_matakuliah',
        'nidn',
        'kelas',
        'hari',
        'jam',
        'ruangan'
    ];

    public function dosen()
    {
        return $this->belongsTo(Dosen::class, 'nidn', 'nidn');
    }

    public function matakuliah()
    {
        return $this->belongsTo(Matakuliah::class, 'kode_matakuliah', 'kode_matakuliah');
    }

    public function krs()
    {
        return $this->hasMany(Krs::class, 'kode_matakuliah', 'kode_matakuliah');
    }

    public function scopeSearch($query, $search)
    {
        return $query->whereHas('matakuliah', function($q) use ($search) {
            $q->where('nama_matakuliah', 'LIKE', "%{$search}%")
              ->orWhere('kode_matakuliah', 'LIKE', "%{$search}%");
        })->orWhereHas('dosen', function($q) use ($search) {
            $q->where('nama', 'LIKE', "%{$search}%");
        });
    }

    public function scopeFilterByHari($query, $hari)
    {
        if ($hari) {
            return $query->where('hari', $hari);
        }
        return $query;
    }
}