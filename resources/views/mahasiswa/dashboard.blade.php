@extends('layouts.app')

@section('title', 'Dashboard Mahasiswa')

@section('content')
<div class="page-header">
    <div class="d-flex justify-content-between align-items-center">
        <div>
            <h1>👋 Selamat Datang, {{ Auth::user()->name }}!</h1>
            <p class="subtitle">Selamat datang di Sistem Informasi Akademik</p>
        </div>
        <div>
            <span class="badge bg-success" style="padding: 8px 20px; font-size: 14px; border-radius: 20px;">
                <i class="bi bi-check-circle"></i> Aktif
            </span>
        </div>
    </div>
</div>

@if(isset($error))
    <div class="alert alert-danger">
        <i class="bi bi-exclamation-circle"></i> {{ $error }}
    </div>
@else
    <!-- Statistik -->
    <div class="row">
        <div class="col-md-3 mb-3">
            <div class="card card-dashboard bg-primary text-white">
                <div class="card-body position-relative">
                    <h6 class="card-title">📚 Jumlah KRS</h6>
                    <h2 class="stat-number">{{ $krsCount ?? 0 }}</h2>
                    <small>Mata kuliah yang diambil</small>
                    <i class="bi bi-card-list icon"></i>
                </div>
            </div>
        </div>
        <div class="col-md-3 mb-3">
            <div class="card card-dashboard bg-success text-white">
                <div class="card-body position-relative">
                    <h6 class="card-title">📊 Total SKS</h6>
                    <h2 class="stat-number">{{ $totalSks ?? 0 }}</h2>
                    <small>Maksimal 24 SKS</small>
                    <i class="bi bi-book icon"></i>
                </div>
            </div>
        </div>
        <div class="col-md-3 mb-3">
            <div class="card card-dashboard bg-warning text-white">
                <div class="card-body position-relative">
                    <h6 class="card-title">📅 Jadwal Hari Ini</h6>
                    <h2 class="stat-number">{{ isset($jadwalHariIni) ? $jadwalHariIni->count() : 0 }}</h2>
                    <small>Mata kuliah hari ini</small>
                    <i class="bi bi-calendar-event icon"></i>
                </div>
            </div>
        </div>
        <div class="col-md-3 mb-3">
            <div class="card card-dashboard bg-info text-white">
                <div class="card-body position-relative">
                    <h6 class="card-title">👨‍🏫 Dosen Wali</h6>
                    <h6 class="stat-number" style="font-size: 1.2rem;">{{ $mahasiswa->dosen->nama ?? '-' }}</h6>
                    <small>NIDN: {{ $mahasiswa->dosen->nidn ?? '-' }}</small>
                    <i class="bi bi-person icon"></i>
                </div>
            </div>
        </div>
    </div>

    <!-- Menu Cepat -->
    <h5 class="mt-4 mb-3"><i class="bi bi-grid"></i> Menu Cepat</h5>
    <div class="row">
        <div class="col-md-3 mb-3">
            <a href="{{ route('krs.saya') }}" class="text-decoration-none">
                <div class="card menu-card">
                    <div class="card-body text-center">
                        <div class="icon-box">📚</div>
                        <h6 class="menu-title">KRS Saya</h6>
                        <p class="menu-desc">Lihat KRS yang diambil</p>
                    </div>
                </div>
            </a>
        </div>
        <div class="col-md-3 mb-3">
            <a href="{{ route('krs.create') }}" class="text-decoration-none">
                <div class="card menu-card">
                    <div class="card-body text-center">
                        <div class="icon-box">➕</div>
                        <h6 class="menu-title">Ambil KRS</h6>
                        <p class="menu-desc">Tambah mata kuliah baru</p>
                    </div>
                </div>
            </a>
        </div>
        <div class="col-md-3 mb-3">
            <a href="{{ route('jadwal.semua') }}" class="text-decoration-none">
                <div class="card menu-card">
                    <div class="card-body text-center">
                        <div class="icon-box">📅</div>
                        <h6 class="menu-title">Semua Jadwal</h6>
                        <p class="menu-desc">Lihat semua jadwal</p>
                    </div>
                </div>
            </a>
        </div>
        <div class="col-md-3 mb-3">
            <a href="{{ route('jadwal.saya') }}" class="text-decoration-none">
                <div class="card menu-card">
                    <div class="card-body text-center">
                        <div class="icon-box">📖</div>
                        <h6 class="menu-title">Jadwal Saya</h6>
                        <p class="menu-desc">Jadwal kuliah saya</p>
                    </div>
                </div>
            </a>
        </div>
    </div>

    <!-- Jadwal Hari Ini -->
    @if(isset($jadwalHariIni) && $jadwalHariIni->count() > 0)
    <div class="content-card mt-4">
        <div class="card-header bg-info text-white">
            <i class="bi bi-calendar-event"></i> Jadwal Hari Ini ({{ date('l, d F Y') }})
        </div>
        <div class="card-body">
            <div class="table-responsive">
                <table class="table table-hover">
                    <thead>
                        <tr>
                            <th>#</th>
                            <th>Kode MK</th>
                            <th>Mata Kuliah</th>
                            <th>Kelas</th>
                            <th>Dosen</th>
                            <th>Jam</th>
                            <th>Ruangan</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach($jadwalHariIni as $item)
                        <tr>
                            <td>{{ $loop->iteration }}</td>
                            <td><strong>{{ $item->kode_matakuliah }}</strong></td>
                            <td>{{ $item->matakuliah->nama_matakuliah ?? '-' }}</td>
                            <td><span class="badge bg-primary">{{ $item->kelas }}</span></td>
                            <td>{{ $item->dosen->nama ?? '-' }}</td>
                            <td>{{ $item->jam }}</td>
                            <td>{{ $item->ruangan ?? '-' }}</td>
                        </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
        </div>
    </div>
    @else
    <div class="alert alert-info mt-4">
        <i class="bi bi-info-circle"></i> Tidak ada jadwal kuliah hari ini. Selamat beristirahat! 🎉
    </div>
    @endif

    <!-- Data Mahasiswa -->
    <div class="content-card mt-4">
        <div class="card-header bg-secondary text-white">
            <i class="bi bi-person-circle"></i> Data Mahasiswa
        </div>
        <div class="card-body">
            <div class="row">
                <div class="col-md-3">
                    <strong>NPM</strong>
                    <p class="mb-0">{{ $mahasiswa->npm ?? '-' }}</p>
                </div>
                <div class="col-md-3">
                    <strong>Nama</strong>
                    <p class="mb-0">{{ $mahasiswa->nama ?? '-' }}</p>
                </div>
                <div class="col-md-3">
                    <strong>Dosen Wali</strong>
                    <p class="mb-0">{{ $mahasiswa->dosen->nama ?? '-' }}</p>
                </div>
                <div class="col-md-3">
                    <strong>Email</strong>
                    <p class="mb-0">{{ Auth::user()->email ?? '-' }}</p>
                </div>
            </div>
        </div>
    </div>
@endif
@endsection