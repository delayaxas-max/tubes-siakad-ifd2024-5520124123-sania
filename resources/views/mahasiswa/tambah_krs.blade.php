@extends('layouts.app')

@section('title', 'Ambil KRS')

@section('content')
<div class="page-header">
    <div class="d-flex justify-content-between align-items-center">
        <div>
            <h1>📝 Ambil KRS</h1>
            <p class="subtitle">Pilih mata kuliah yang ingin Anda ambil</p>
        </div>
        <a href="{{ route('krs.saya') }}" class="btn btn-secondary">
            <i class="bi bi-arrow-left"></i> Kembali
        </a>
    </div>
</div>

@if(session('error'))
    <div class="alert alert-danger alert-dismissible fade show" role="alert">
        <i class="bi bi-exclamation-circle"></i> {{ session('error') }}
        <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
    </div>
@endif

@if(session('success'))
    <div class="alert alert-success alert-dismissible fade show" role="alert">
        <i class="bi bi-check-circle"></i> {{ session('success') }}
        <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
    </div>
@endif

<!-- Info -->
<div class="content-card mb-3">
    <div class="card-body">
        <div class="row">
            <div class="col-md-4">
                <strong>NPM:</strong> {{ Auth::user()->mahasiswa->npm ?? '-' }}
            </div>
            <div class="col-md-4">
                <strong>Nama:</strong> {{ Auth::user()->mahasiswa->nama ?? '-' }}
            </div>
            <div class="col-md-4">
                <strong>SKS Saat Ini:</strong> 
                <span class="badge bg-primary">{{ $totalSks ?? 0 }} SKS</span>
                <small class="text-muted">(Maksimal 24 SKS)</small>
            </div>
        </div>
    </div>
</div>

<div class="content-card">
    <div class="card-body">
        <form action="{{ route('krs.store.mahasiswa') }}" method="POST">
            @csrf
            <div class="mb-4">
                <label class="form-label fw-bold">Pilih Mata Kuliah <span class="text-danger">*</span></label>
                <select name="kode_matakuliah" class="form-control" required>
                    <option value="">-- Pilih Mata Kuliah --</option>
                    @foreach($matakuliah as $item)
                        <option value="{{ $item->kode_matakuliah }}">
                            {{ $item->kode_matakuliah }} - 
                            {{ $item->nama_matakuliah }} 
                            ({{ $item->sks }} SKS)
                            @if($item->jadwal->isNotEmpty())
                                | Kelas: {{ $item->jadwal->first()->kelas ?? '-' }}
                            @endif
                        </option>
                    @endforeach
                </select>
                @error('kode_matakuliah')
                    <small class="text-danger">{{ $message }}</small>
                @enderror
            </div>

            <!-- Informasi -->
            <div class="alert alert-info">
                <h6><i class="bi bi-info-circle"></i> Informasi:</h6>
                <ul class="mb-0">
                    <li>Maksimal mengambil <strong>24 SKS</strong> per semester</li>
                    <li>Pastikan tidak ada bentrok jadwal</li>
                    <li>Mata kuliah yang sudah diambil tidak dapat dipilih lagi</li>
                </ul>
            </div>

            <button type="submit" class="btn btn-primary">
                <i class="bi bi-save"></i> Simpan
            </button>
            <a href="{{ route('krs.saya') }}" class="btn btn-secondary">
                <i class="bi bi-x-circle"></i> Batal
            </a>
        </form>
    </div>
</div>

<!-- Daftar Mata Kuliah yang Tersedia -->
<div class="content-card mt-3">
    <div class="card-header">
        <i class="bi bi-list"></i> Mata Kuliah Tersedia ({{ $matakuliah->count() }})
    </div>
    <div class="card-body">
        <div class="table-responsive">
            <table class="table table-sm table-hover">
                <thead>
                    <tr>
                        <th>Kode</th>
                        <th>Nama Mata Kuliah</th>
                        <th>SKS</th>
                        <th>Kelas</th>
                        <th>Dosen</th>
                    </tr>
                </thead>
                <tbody>
                    @forelse($matakuliah as $item)
                    <tr>
                        <td><strong>{{ $item->kode_matakuliah }}</strong></td>
                        <td>{{ $item->nama_matakuliah }}</td>
                        <td><span class="badge bg-primary">{{ $item->sks }}</span></td>
                        <td>
                            @if($item->jadwal->isNotEmpty())
                                <span class="badge bg-info">{{ $item->jadwal->first()->kelas ?? '-' }}</span>
                            @else
                                <span class="text-muted">Belum ada jadwal</span>
                            @endif
                        </td>
                        <td>{{ $item->jadwal->first()->dosen->nama ?? '-' }}</td>
                    </tr>
                    @empty
                    <tr>
                        <td colspan="5" class="text-center text-muted">
                            <i class="bi bi-check-circle"></i> Semua mata kuliah sudah diambil!
                        </td>
                    </tr>
                    @endforelse
                </tbody>
            </table>
        </div>
    </div>
</div>
@endsection