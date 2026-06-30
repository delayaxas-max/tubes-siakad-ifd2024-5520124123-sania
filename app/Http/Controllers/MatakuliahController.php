<?php

namespace App\Http\Controllers;

use App\Models\Matakuliah;
use Illuminate\Http\Request;

class MatakuliahController extends Controller
{
    public function index(Request $request)
    {
        $query = Matakuliah::withCount('krs');

        if ($request->filled('search')) {
            $query->search($request->search);
        }

        $matakuliah = $query->orderBy('kode_matakuliah')->paginate(10)->withQueryString();
        return view('admin.matakuliah', compact('matakuliah'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'kode_matakuliah' => 'required|max:8|unique:matakuliah,kode_matakuliah',
            'nama_matakuliah' => 'required|max:50',
            'sks' => 'required|integer|min:1|max:6',
        ], [
            'kode_matakuliah.required' => 'Kode mata kuliah wajib diisi.',
            'kode_matakuliah.max' => 'Kode maksimal 8 karakter.',
            'kode_matakuliah.unique' => 'Kode sudah terdaftar.',
            'nama_matakuliah.required' => 'Nama mata kuliah wajib diisi.',
            'nama_matakuliah.max' => 'Nama maksimal 50 karakter.',
            'sks.required' => 'SKS wajib diisi.',
            'sks.integer' => 'SKS harus berupa angka.',
            'sks.min' => 'SKS minimal 1.',
            'sks.max' => 'SKS maksimal 6.'
        ]);

        Matakuliah::create($request->all());
        return back()->with('success', 'Mata kuliah berhasil ditambahkan.');
    }

    public function update(Request $request, string $kode_matakuliah)
    {
        $request->validate([
            'nama_matakuliah' => 'required|max:50',
            'sks' => 'required|integer|min:1|max:6',
        ], [
            'nama_matakuliah.required' => 'Nama mata kuliah wajib diisi.',
            'nama_matakuliah.max' => 'Nama maksimal 50 karakter.',
            'sks.required' => 'SKS wajib diisi.',
            'sks.integer' => 'SKS harus berupa angka.',
            'sks.min' => 'SKS minimal 1.',
            'sks.max' => 'SKS maksimal 6.'
        ]);

        Matakuliah::where('kode_matakuliah', $kode_matakuliah)->update([
            'nama_matakuliah' => $request->nama_matakuliah,
            'sks' => $request->sks
        ]);

        return back()->with('success', 'Mata kuliah berhasil diubah.');
    }

    public function destroy(string $kode_matakuliah)
    {
        Matakuliah::where('kode_matakuliah', $kode_matakuliah)->delete();
        return back()->with('success', 'Mata kuliah berhasil dihapus.');
    }
}