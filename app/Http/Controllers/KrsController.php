<?php

namespace App\Http\Controllers;

use App\Models\Krs;
use App\Models\Mahasiswa;
use App\Models\Matakuliah;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Barryvdh\DomPDF\Facade\Pdf;

class KrsController extends Controller
{
    // ADMIN - CRUD KRS
    public function index(Request $request)
    {
        $query = Krs::with(['mahasiswa', 'matakuliah']);

        if ($request->filled('search')) {
            $query->whereHas('mahasiswa', function($q) use ($request) {
                $q->where('nama', 'LIKE', "%{$request->search}%")
                  ->orWhere('npm', 'LIKE', "%{$request->search}%");
            })->orWhereHas('matakuliah', function($q) use ($request) {
                $q->where('nama_matakuliah', 'LIKE', "%{$request->search}%");
            });
        }

        $krs = $query->latest()->paginate(10)->withQueryString();
        $mahasiswa = Mahasiswa::orderBy('nama')->get();
        $matakuliah = Matakuliah::orderBy('nama_matakuliah')->get();

        return view('admin.krs', compact('krs', 'mahasiswa', 'matakuliah'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'npm' => 'required|exists:mahasiswa,npm',
            'kode_matakuliah' => 'required|exists:matakuliah,kode_matakuliah'
        ], [
            'npm.required' => 'Mahasiswa wajib dipilih.',
            'npm.exists' => 'Mahasiswa tidak valid.',
            'kode_matakuliah.required' => 'Mata kuliah wajib dipilih.',
            'kode_matakuliah.exists' => 'Mata kuliah tidak valid.'
        ]);

        // Cek duplikat
        $exists = Krs::where('npm', $request->npm)
            ->where('kode_matakuliah', $request->kode_matakuliah)
            ->exists();

        if ($exists) {
            return back()->with('error', 'Mahasiswa sudah mengambil mata kuliah ini!');
        }

        Krs::create([
            'npm' => $request->npm,
            'kode_matakuliah' => $request->kode_matakuliah,
            'status' => 'Aktif'
        ]);

        return back()->with('success', 'KRS berhasil ditambahkan.');
    }

    public function update(Request $request, $id)
    {
        $request->validate([
            'npm' => 'required|exists:mahasiswa,npm',
            'kode_matakuliah' => 'required|exists:matakuliah,kode_matakuliah',
            'status' => 'required|in:Aktif,Selesai,Batal'
        ]);

        Krs::findOrFail($id)->update($request->all());
        return back()->with('success', 'KRS berhasil diubah.');
    }

    public function destroy($id)
    {
        Krs::findOrFail($id)->delete();
        return back()->with('success', 'KRS berhasil dihapus.');
    }

    // MAHASISWA - FITUR KRS
    public function indexMahasiswa()
    {
        $mahasiswa = Auth::user()->mahasiswa;
        $krs = Krs::with(['matakuliah'])->where('npm', $mahasiswa->npm)->get();
        $totalSks = $krs->sum(fn($item) => $item->matakuliah->sks ?? 0);

        return view('mahasiswa.krs', compact('krs', 'totalSks'));
    }

    public function create()
    {
        $mahasiswa = Auth::user()->mahasiswa;

        $matakuliah = Matakuliah::whereDoesntHave('krs', function($q) use ($mahasiswa) {
            $q->where('npm', $mahasiswa->npm);
        })->orderBy('kode_matakuliah')->get();

        return view('mahasiswa.tambah_krs', compact('matakuliah'));
    }

    public function storeMahasiswa(Request $request)
    {
        $request->validate([
            'kode_matakuliah' => 'required|exists:matakuliah,kode_matakuliah'
        ], [
            'kode_matakuliah.required' => 'Mata kuliah wajib dipilih.',
            'kode_matakuliah.exists' => 'Mata kuliah tidak valid.'
        ]);

        $mahasiswa = Auth::user()->mahasiswa;

        // Cek duplikat
        $exists = Krs::where('npm', $mahasiswa->npm)
            ->where('kode_matakuliah', $request->kode_matakuliah)
            ->exists();

        if ($exists) {
            return back()->with('error', 'Anda sudah mengambil mata kuliah ini!');
        }

        // Cek total SKS (maks 24)
        $currentSks = Krs::where('npm', $mahasiswa->npm)
            ->with('matakuliah')
            ->get()
            ->sum(fn($item) => $item->matakuliah->sks ?? 0);

        $matakuliah = Matakuliah::find($request->kode_matakuliah);
        $sksBaru = $matakuliah->sks ?? 0;

        if (($currentSks + $sksBaru) > 24) {
            return back()->with('error', 'Total SKS melebihi batas maksimal 24 SKS!');
        }

        Krs::create([
            'npm' => $mahasiswa->npm,
            'kode_matakuliah' => $request->kode_matakuliah,
            'status' => 'Aktif'
        ]);

        return redirect()->route('krs.saya')->with('success', 'KRS berhasil ditambahkan!');
    }

    public function destroyMahasiswa($id)
    {
        $mahasiswa = Auth::user()->mahasiswa;

        $krs = Krs::where('id_krs', $id)
            ->where('npm', $mahasiswa->npm)
            ->first();

        if (!$krs) {
            return back()->with('error', 'Data KRS tidak ditemukan!');
        }

        $krs->delete();
        return back()->with('success', 'Mata kuliah berhasil di-drop!');
    }

    // BONUS: Export KRS ke PDF (menggunakan DomPDF)
    public function exportPdf()
    {
        $mahasiswa = Auth::user()->mahasiswa;
        $krs = Krs::with(['matakuliah'])->where('npm', $mahasiswa->npm)->get();
        $totalSks = $krs->sum(fn($item) => $item->matakuliah->sks ?? 0);

        $pdf = \Barryvdh\DomPDF\Facade\Pdf::loadView('mahasiswa.krs_pdf', compact('krs', 'totalSks', 'mahasiswa'));
        return $pdf->download('KRS_'.$mahasiswa->npm.'.pdf');
    }
}