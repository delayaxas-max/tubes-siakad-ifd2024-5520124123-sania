<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\Auth;
use App\Models\Dosen;
use App\Models\Mahasiswa;
use App\Models\Matakuliah;
use App\Models\Jadwal;
use App\Models\Krs;

class DashboardController extends Controller
{
    public function index()
    {
        if (Auth::user()->role == 'admin') {
            return view('admin.dashboard', [
                'totalDosen' => Dosen::count(),
                'totalMahasiswa' => Mahasiswa::count(),
                'totalMatakuliah' => Matakuliah::count(),
                'totalJadwal' => Jadwal::count(),
                'totalKrs' => Krs::count(),
                'dosenBaru' => Dosen::latest()->take(5)->get(),
                'mahasiswaBaru' => Mahasiswa::latest()->take(5)->get(),
                'krsTerbaru' => Krs::with(['mahasiswa', 'matakuliah'])->latest()->take(5)->get(),
            ]);
        }

        // Mahasiswa
        $mahasiswa = Auth::user()->mahasiswa;

        if (!$mahasiswa) {
            return view('mahasiswa.dashboard', ['error' => 'Data mahasiswa tidak ditemukan!']);
        }

        $krsCount = Krs::where('npm', $mahasiswa->npm)->count();
        $totalSks = Krs::where('npm', $mahasiswa->npm)
            ->with('matakuliah')
            ->get()
            ->sum(fn($item) => $item->matakuliah->sks ?? 0);

        $kodeMatakuliah = Krs::where('npm', $mahasiswa->npm)->pluck('kode_matakuliah')->toArray();
        
        $hariIni = date('l');
        $jadwalHariIni = Jadwal::with(['dosen', 'matakuliah'])
            ->where('hari', $hariIni)
            ->whereIn('kode_matakuliah', $kodeMatakuliah)
            ->orderBy('jam')
            ->get();

        return view('mahasiswa.dashboard', compact(
            'mahasiswa',
            'krsCount',
            'totalSks',
            'jadwalHariIni'
        ));
    }
}