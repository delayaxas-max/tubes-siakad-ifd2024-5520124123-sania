<?php

namespace App\Http\Controllers;

use App\Models\Mahasiswa;
use App\Models\Dosen;
use Illuminate\Http\Request;

class MahasiswaController extends Controller
{
    public function index(Request $request)
    {
        $query = Mahasiswa::with('dosen');

        if ($request->filled('search')) {
            $query->search($request->search);
        }

        $mahasiswa = $query->orderBy('nama')->paginate(10)->withQueryString();
        $dosen = Dosen::orderBy('nama')->get();
        return view('admin.mahasiswa', compact('mahasiswa', 'dosen'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'npm' => 'required|size:10|unique:mahasiswa,npm',
            'nama' => 'required|max:50',
            'nidn' => 'required|exists:dosen,nidn'
        ], [
            'npm.required' => 'NPM wajib diisi.',
            'npm.size' => 'NPM harus 10 digit.',
            'npm.unique' => 'NPM sudah terdaftar.',
            'nama.required' => 'Nama wajib diisi.',
            'nama.max' => 'Nama maksimal 50 karakter.',
            'nidn.required' => 'Dosen wali wajib dipilih.',
            'nidn.exists' => 'Dosen wali tidak valid.'
        ]);

        Mahasiswa::create($request->all());
        return back()->with('success', 'Mahasiswa berhasil ditambahkan.');
    }

    public function update(Request $request, $npm)
    {
        $request->validate([
            'nama' => 'required|max:50',
            'nidn' => 'required|exists:dosen,nidn'
        ], [
            'nama.required' => 'Nama wajib diisi.',
            'nama.max' => 'Nama maksimal 50 karakter.',
            'nidn.required' => 'Dosen wali wajib dipilih.',
            'nidn.exists' => 'Dosen wali tidak valid.'
        ]);

        Mahasiswa::where('npm', $npm)->update([
            'nama' => $request->nama,
            'nidn' => $request->nidn
        ]);

        return back()->with('success', 'Mahasiswa berhasil diubah.');
    }

    public function destroy($npm)
    {
        Mahasiswa::where('npm', $npm)->delete();
        return back()->with('success', 'Mahasiswa berhasil dihapus.');
    }
}