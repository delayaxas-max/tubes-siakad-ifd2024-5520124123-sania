@extends('layouts.app')

@section('title', 'KRS Saya')

@section('content')
<div class="page-header">
    <div class="d-flex justify-content-between align-items-center">
        <div>
            <h1>📚 Kartu Rencana Studi (KRS)</h1>
            <p class="subtitle">Daftar mata kuliah yang Anda ambil</p>
        </div>
        <div>
            <a href="{{ route('krs.create') }}" class="btn btn-primary">
                <i class="bi bi-plus-circle"></i> Ambil KRS
            </a>
            <a href="{{ route('krs.export.pdf') }}" class="btn btn-success" target="_blank">
                <i class="bi bi-file-pdf"></i> Export PDF
            </a>
        </div>
    </div>
</div>

@if(session('success'))
    <div class="alert alert-success alert-dismissible fade show" role="alert">
        <i class="bi bi-check-circle"></i> {{ session('success') }}
        <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
    </div>
@endif

@if(session('error'))
    <div class="alert alert-danger alert-dismissible fade show" role="alert">
        <i class="bi bi-exclamation-circle"></i> {{ session('error') }}
        <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
    </div>
@endif

<!-- Info Mahasiswa -->
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
                <strong>Total SKS:</strong> 
                <span class="badge bg-{{ $totalSks > 18 ? 'warning' : 'success' }}" style="font-size: 14px; padding: 8px 16px;">
                    {{ $totalSks }} SKS
                </span>
                <small class="text-muted">(Maksimal 24 SKS)</small>
            </div>
        </div>
    </div>
</div>

<!-- Progress Bar SKS -->
<div class="content-card mb-3">
    <div class="card-body">
        <div class="d-flex justify-content-between">
            <span>SKS Diambil: <strong>{{ $totalSks }}</strong></span>
            <span>SKS Tersisa: <strong>{{ 24 - $totalSks }}</strong></span>
            <span>Maksimal: <strong>24 SKS</strong></span>
        </div>
        <div class="progress mt-2" style="height: 10px; border-radius: 10px;">
            <div class="progress-bar bg-{{ $totalSks > 18 ? 'warning' : ($totalSks > 12 ? 'info' : 'success') }}" 
                 role="progressbar" 
                 style="width: {{ ($totalSks / 24) * 100 }}%" 
                 aria-valuenow="{{ $totalSks }}" 
                 aria-valuemin="0" 
                 aria-valuemax="24">
            </div>
        </div>
    </div>
</div>

<!-- Tabel KRS -->
<div class="content-card">
    <div class="card-header">
        <i class="bi bi-list"></i> Daftar Mata Kuliah
    </div>
    <div class="card-body">
        <div class="table-responsive">
            <table class="table table-hover">
                <thead>
                    <tr>
                        <th>#</th>
                        <th>Kode MK</th>
                        <th>Mata Kuliah</th>
                        <th>SKS</th>
                        <th>Kelas</th>
                        <th>Dosen</th>
                        <th>Hari</th>
                        <th>Jam</th>
                        <th>Status</th>
                        <th>Aksi</th>
                    </tr>
                </thead>
                <tbody>
                    @forelse($krs as $item)
                    <tr>
                        <td>{{ $loop->iteration }}</td>
                        <td><strong>{{ $item->matakuliah->kode_matakuliah ?? '-' }}</strong></td>
                        <td>{{ $item->matakuliah->nama_matakuliah ?? '-' }}</td>
                        <td class="text-center"><span class="badge bg-primary">{{ $item->matakuliah->sks ?? 0 }}</span></td>
                        <td>
                            @php
                                $jadwal = $item->jadwal()->first();
                            @endphp
                            <span class="badge bg-info">{{ $jadwal->kelas ?? '-' }}</span>
                        </td>
                        <td>{{ $jadwal->dosen->nama ?? '-' }}</td>
                        <td>{{ $jadwal->hari ?? '-' }}</td>
                        <td>{{ $jadwal->jam ?? '-' }}</td>
                        <td>
                            <span class="badge badge-status badge-status-{{ strtolower($item->status) }}">
                                {{ $item->status }}
                            </span>
                        </td>
                        <td class="table-actions">
                            @if($item->status == 'Aktif')
                            <form action="{{ route('krs.destroy.mahasiswa', $item->id_krs) }}" method="POST" class="d-inline"
                                  onsubmit="return confirm('Yakin ingin drop mata kuliah {{ $item->matakuliah->nama_matakuliah ?? '' }}?')">
                                @csrf
                                @method('DELETE')
                                <button type="submit" class="btn btn-danger btn-sm">
                                    <i class="bi bi-x-circle"></i> Drop
                                </button>
                            </form>
                            @else
                            <span class="text-muted">-</span>
                            @endif
                        </td>
                    </tr>
                    @empty
                    <tr>
                        <td colspan="10" class="text-center py-4">
                            <i class="bi bi-inbox" style="font-size: 2rem; display: block; color: #6c757d;"></i>
                            <p class="text-muted mt-2">Belum ada KRS. Silakan ambil mata kuliah!</p>
                            <a href="{{ route('krs.create') }}" class="btn btn-primary">
                                <i class="bi bi-plus-circle"></i> Ambil KRS Sekarang
                            </a>
                        </td>
                    </tr>
                    @endforelse
                </tbody>
            </table>
        </div>
    </div>
</div>
@endsection