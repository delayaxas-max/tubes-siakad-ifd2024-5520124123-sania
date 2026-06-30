<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Mahasiswa extends Model
{
    protected $table = 'mahasiswa';
    protected $primaryKey = 'npm';
    public $incrementing = false;
    protected $keyType = 'string';

    protected $fillable = ['npm', 'nama', 'nidn'];

    public function dosen()
    {
        return $this->belongsTo(Dosen::class, 'nidn', 'nidn');
    }

    public function krs()
    {
        return $this->hasMany(Krs::class, 'npm', 'npm');
    }

    public function user()
    {
        return $this->hasOne(User::class, 'npm', 'npm');
    }

    public function scopeSearch($query, $search)
    {
        return $query->where('npm', 'LIKE', "%{$search}%")
                     ->orWhere('nama', 'LIKE', "%{$search}%");
    }
}