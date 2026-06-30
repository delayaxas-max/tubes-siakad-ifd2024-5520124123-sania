<?php

namespace App\Http\Controllers;

use App\Models\Jadwal;
use App\Models\Dosen;
use App\Models\Matakuliah;
use App\Models\Krs; // TAMBAHKAN INI
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class JadwalController extends Controller
{
    // ADMIN - Lihat semua jadwal
    public function index(Request $request)
    {
        $query = Jadwal::with(['dosen', 'matakuliah']);

        if ($request->filled('search')) {
            $query->whereHas('matakuliah', function($q) use ($request) {
                $q->where('nama_matakuliah', 'LIKE', "%{$request->search}%")
                  ->orWhere('kode_matakuliah', 'LIKE', "%{$request->search}%");
            })->orWhereHas('dosen', function($q) use ($request) {
                $q->where('nama', 'LIKE', "%{$request->search}%");
            });
        }

        if ($request->filled('hari')) {
            $query->where('hari', $request->hari);
        }

        $jadwal = $query->orderBy('hari')->orderBy('jam')->paginate(10)->withQueryString();
        $dosen = Dosen::orderBy('nama')->get();
        $matakuliah = Matakuliah::orderBy('nama_matakuliah')->get();
        $hariList = ['Senin', 'Selasa', 'Rabu', 'Kamis', 'Jumat', 'Sabtu', 'Minggu'];

        return view('admin.jadwal', compact('jadwal', 'dosen', 'matakuliah', 'hariList'));
    }

    // ADMIN - Store jadwal
    public function store(Request $request)
    {
        $request->validate([
            'kode_matakuliah' => 'required|exists:matakuliah,kode_matakuliah',
            'nidn' => 'required|exists:dosen,nidn',
            'kelas' => 'required|max:1',
            'hari' => 'required|in:Senin,Selasa,Rabu,Kamis,Jumat,Sabtu,Minggu',
            'jam' => 'required',
            'ruangan' => 'required|max:20'
        ]);

        Jadwal::create($request->all());
        return back()->with('success', 'Jadwal berhasil ditambahkan.');
    }

    // ADMIN - Update jadwal
    public function update(Request $request, $id)
    {
        $request->validate([
            'kode_matakuliah' => 'required|exists:matakuliah,kode_matakuliah',
            'nidn' => 'required|exists:dosen,nidn',
            'kelas' => 'required|max:1',
            'hari' => 'required|in:Senin,Selasa,Rabu,Kamis,Jumat,Sabtu,Minggu',
            'jam' => 'required',
            'ruangan' => 'required|max:20'
        ]);

        Jadwal::findOrFail($id)->update($request->all());
        return back()->with('success', 'Jadwal berhasil diubah.');
    }

    // ADMIN - Delete jadwal
    public function destroy($id)
    {
        Jadwal::findOrFail($id)->delete();
        return back()->with('success', 'Jadwal berhasil dihapus.');
    }

    // ============================================================
    // MAHASISWA - Lihat semua jadwal
    // ============================================================
    public function indexMahasiswa(Request $request)
    {
        $query = Jadwal::with(['dosen', 'matakuliah']);

        if ($request->filled('search')) {
            $query->whereHas('matakuliah', function($q) use ($request) {
                $q->where('nama_matakuliah', 'LIKE', "%{$request->search}%")
                  ->orWhere('kode_matakuliah', 'LIKE', "%{$request->search}%");
            })->orWhereHas('dosen', function($q) use ($request) {
                $q->where('nama', 'LIKE', "%{$request->search}%");
            });
        }

        if ($request->filled('hari')) {
            $query->where('hari', $request->hari);
        }

        $jadwal = $query->orderBy('hari')->orderBy('jam')->get();
        $hariList = ['Senin', 'Selasa', 'Rabu', 'Kamis', 'Jumat', 'Sabtu', 'Minggu'];

        return view('mahasiswa.jadwal', compact('jadwal', 'hariList'));
    }

    // ============================================================
    // MAHASISWA - Lihat jadwal yang diambil
    // ============================================================
    public function jadwalSaya()
    {
        $mahasiswa = auth()->user()->mahasiswa;
        
        if (!$mahasiswa) {
            return redirect()->route('dashboard')->with('error', 'Data mahasiswa tidak ditemukan!');
        }

        // Ambil kode_matakuliah dari KRS mahasiswa
        $kodeMatakuliah = Krs::where('npm', $mahasiswa->npm)
            ->pluck('kode_matakuliah')
            ->toArray();

        // Jika tidak ada KRS, return empty
        if (empty($kodeMatakuliah)) {
            $jadwal = collect(); // empty collection
            return view('mahasiswa.jadwal_saya', compact('jadwal'));
        }

        $jadwal = Jadwal::with(['dosen', 'matakuliah'])
            ->whereIn('kode_matakuliah', $kodeMatakuliah)
            ->orderBy('hari')
            ->orderBy('jam')
            ->get();

        return view('mahasiswa.jadwal_saya', compact('jadwal'));
    }
}