<?php

namespace App\Http\Controllers;

use App\Models\Dosen;
use Illuminate\Http\Request;

class DosenController extends Controller
{
    public function index(Request $request)
    {
        $query = Dosen::with('mahasiswa');

        // Pencarian
        if ($request->filled('search')) {
            $query->search($request->search);
        }

        $dosen = $query->orderBy('nama')->paginate(10)->withQueryString();
        return view('admin.dosen', compact('dosen'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'nidn' => 'required|size:10|unique:dosen,nidn',
            'nama' => 'required|max:50'
        ], [
            'nidn.required' => 'NIDN wajib diisi.',
            'nidn.size' => 'NIDN harus 10 digit.',
            'nidn.unique' => 'NIDN sudah terdaftar.',
            'nama.required' => 'Nama wajib diisi.',
            'nama.max' => 'Nama maksimal 50 karakter.'
        ]);

        Dosen::create($request->all());
        return back()->with('success', 'Data dosen berhasil ditambahkan.');
    }

    public function update(Request $request, string $nidn)
    {
        $request->validate([
            'nama' => 'required|max:50'
        ], [
            'nama.required' => 'Nama wajib diisi.',
            'nama.max' => 'Nama maksimal 50 karakter.'
        ]);

        Dosen::where('nidn', $nidn)->update(['nama' => $request->nama]);
        return back()->with('success', 'Data dosen berhasil diubah.');
    }

    public function destroy(string $nidn)
    {
        Dosen::where('nidn', $nidn)->delete();
        return back()->with('success', 'Data dosen berhasil dihapus.');
    }
}