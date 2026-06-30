@extends('layouts.app')

@section('title', 'Dashboard Admin')

@section('content')
<div class="d-flex justify-content-between flex-wrap flex-md-nowrap align-items-center pt-3 pb-2 mb-3 border-bottom">
    <h1 class="h2">📊 Dashboard Admin</h1>
</div>

<div class="row">
    <div class="col-xl-3 col-md-6 mb-3">
        <div class="card card-dashboard bg-primary text-white">
            <div class="card-body">
                <div class="d-flex justify-content-between align-items-center">
                    <div>
                        <h6 class="card-title">Dosen</h6>
                        <h2 class="stat-number">{{ $totalDosen }}</h2>
                    </div>
                    <i class="bi bi-person-badge" style="font-size: 3rem; opacity: 0.5;"></i>
                </div>
            </div>
        </div>
    </div>
    <div class="col-xl-3 col-md-6 mb-3">
        <div class="card card-dashboard bg-success text-white">
            <div class="card-body">
                <div class="d-flex justify-content-between align-items-center">
                    <div>
                        <h6 class="card-title">Mahasiswa</h6>
                        <h2 class="stat-number">{{ $totalMahasiswa }}</h2>
                    </div>
                    <i class="bi bi-people" style="font-size: 3rem; opacity: 0.5;"></i>
                </div>
            </div>
        </div>
    </div>
    <div class="col-xl-3 col-md-6 mb-3">
        <div class="card card-dashboard bg-warning text-white">
            <div class="card-body">
                <div class="d-flex justify-content-between align-items-center">
                    <div>
                        <h6 class="card-title">Mata Kuliah</h6>
                        <h2 class="stat-number">{{ $totalMatakuliah }}</h2>
                    </div>
                    <i class="bi bi-book" style="font-size: 3rem; opacity: 0.5;"></i>
                </div>
            </div>
        </div>
    </div>
    <div class="col-xl-3 col-md-6 mb-3">
        <div class="card card-dashboard bg-info text-white">
            <div class="card-body">
                <div class="d-flex justify-content-between align-items-center">
                    <div>
                        <h6 class="card-title">Jadwal</h6>
                        <h2 class="stat-number">{{ $totalJadwal }}</h2>
                    </div>
                    <i class="bi bi-calendar-event" style="font-size: 3rem; opacity: 0.5;"></i>
                </div>
            </div>
        </div>
    </div>
</div>

<div class="row mt-4">
    <div class="col-md-6">
        <div class="card">
            <div class="card-header bg-primary text-white">
                <h5><i class="bi bi-person-plus"></i> Dosen Terbaru</h5>
            </div>
            <div class="card-body">
                <ul class="list-group">
                    @forelse($dosenBaru as $item)
                        <li class="list-group-item d-flex justify-content-between">
                            <span>{{ $item->nama }}</span>
                            <span class="badge bg-secondary">{{ $item->nidn }}</span>
                        </li>
                    @empty
                        <li class="list-group-item text-muted">Belum ada data</li>
                    @endforelse
                </ul>
            </div>
        </div>
    </div>
    <div class="col-md-6">
        <div class="card">
            <div class="card-header bg-success text-white">
                <h5><i class="bi bi-person-plus"></i> Mahasiswa Terbaru</h5>
            </div>
            <div class="card-body">
                <ul class="list-group">
                    @forelse($mahasiswaBaru as $item)
                        <li class="list-group-item d-flex justify-content-between">
                            <span>{{ $item->nama }}</span>
                            <span class="badge bg-secondary">{{ $item->npm }}</span>
                        </li>
                    @empty
                        <li class="list-group-item text-muted">Belum ada data</li>
                    @endforelse
                </ul>
            </div>
        </div>
    </div>
</div>

<div class="card mt-4">
    <div class="card-header bg-info text-white">
        <h5><i class="bi bi-clock-history"></i> KRS Terbaru</h5>
    </div>
    <div class="card-body">
        <div class="table-responsive">
            <table class="table table-sm">
                <thead>
                    <tr>
                        <th>#</th>
                        <th>Mahasiswa</th>
                        <th>Mata Kuliah</th>
                        <th>Status</th>
                        <th>Tanggal</th>
                    </tr>
                </thead>
                <tbody>
                    @forelse($krsTerbaru as $item)
                        <tr>
                            <td>{{ $loop->iteration }}</td>
                            <td>{{ $item->mahasiswa->nama ?? '-' }}</td>
                            <td>{{ $item->matakuliah->nama_matakuliah ?? '-' }}</td>
                            <td><span class="badge bg-{{ $item->status == 'Aktif' ? 'success' : ($item->status == 'Selesai' ? 'info' : 'danger') }}">{{ $item->status }}</span></td>
                            <td>{{ $item->created_at->format('d/m/Y H:i') }}</td>
                        </tr>
                    @empty
                        <tr><td colspan="5" class="text-muted">Belum ada data</td></tr>
                    @endforelse
                </tbody>
            </table>
        </div>
    </div>
</div>
@endsection