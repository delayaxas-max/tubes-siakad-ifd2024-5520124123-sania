@extends('layouts.app')

@section('title', 'Jadwal Saya')

@section('content')
<div class="page-header">
    <div class="d-flex justify-content-between align-items-center">
        <div>
            <h1>📅 Jadwal Kuliah Saya</h1>
            <p class="subtitle">Jadwal mata kuliah yang Anda ambil</p>
        </div>
        <div>
            <a href="{{ route('jadwal.semua') }}" class="btn btn-secondary">
                <i class="bi bi-calendar3"></i> Semua Jadwal
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

<div class="content-card">
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
                        <th>Ruangan</th>
                    </tr>
                </thead>
                <tbody>
                    @forelse($jadwal as $item)
                    <tr>
                        <td>{{ $loop->iteration }}</td>
                        <td><strong>{{ $item->kode_matakuliah }}</strong></td>
                        <td>{{ $item->matakuliah->nama_matakuliah ?? '-' }}</td>
                        <td class="text-center"><span class="badge bg-primary">{{ $item->matakuliah->sks ?? 0 }}</span></td>
                        <td><span class="badge bg-info">{{ $item->kelas }}</span></td>
                        <td>{{ $item->dosen->nama ?? '-' }}</td>
                        <td>
                            <span class="badge bg-{{ $item->hari == 'Senin' ? 'danger' : ($item->hari == 'Selasa' ? 'warning' : ($item->hari == 'Rabu' ? 'success' : ($item->hari == 'Kamis' ? 'info' : 'secondary'))) }}">
                                {{ $item->hari }}
                            </span>
                        </td>
                        <td>{{ $item->jam }}</td>
                        <td>{{ $item->ruangan ?? '-' }}</td>
                    </tr>
                    @empty
                    <tr>
                        <td colspan="9" class="text-center py-4">
                            <i class="bi bi-inbox" style="font-size: 2rem; display: block; color: #6c757d;"></i>
                            <p class="text-muted mt-2">Anda belum mengambil mata kuliah apapun</p>
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

<!-- Ringkasan -->
@if($jadwal->count() > 0)
<div class="content-card mt-3">
    <div class="card-header">
        <i class="bi bi-info-circle"></i> Ringkasan
    </div>
    <div class="card-body">
        <div class="row">
            <div class="col-md-3">
                <strong>Total Mata Kuliah</strong>
                <p class="mb-0">{{ $jadwal->count() }}</p>
            </div>
            <div class="col-md-3">
                <strong>Total SKS</strong>
                <p class="mb-0">{{ $jadwal->sum(fn($item) => $item->matakuliah->sks ?? 0) }} SKS</p>
            </div>
            <div class="col-md-3">
                <strong>Hari Kuliah</strong>
                <p class="mb-0">{{ $jadwal->pluck('hari')->unique()->count() }} Hari</p>
            </div>
            <div class="col-md-3">
                <strong>Dosen Pengajar</strong>
                <p class="mb-0">{{ $jadwal->pluck('dosen.nama')->unique()->count() }} Dosen</p>
            </div>
        </div>
    </div>
</div>
@endif
@endsection