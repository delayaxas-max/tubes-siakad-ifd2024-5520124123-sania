@extends('layouts.app')

@section('title', 'Semua Jadwal')

@section('content')
<div class="page-header">
    <div class="d-flex justify-content-between align-items-center">
        <div>
            <h1>📅 Semua Jadwal Perkuliahan</h1>
            <p class="subtitle">Daftar semua jadwal perkuliahan yang tersedia</p>
        </div>
        <div>
            <a href="{{ route('jadwal.saya') }}" class="btn btn-success">
                <i class="bi bi-calendar-check"></i> Jadwal Saya
            </a>
        </div>
    </div>
</div>

<!-- Filter -->
<div class="content-card mb-3">
    <div class="card-body">
        <form action="" method="GET" class="row g-3">
            <div class="col-md-5">
                <input type="text" name="search" class="form-control" placeholder="Cari Mata Kuliah atau Dosen..." value="{{ request('search') }}">
            </div>
            <div class="col-md-3">
                <select name="hari" class="form-control">
                    <option value="">-- Semua Hari --</option>
                    @foreach($hariList as $h)
                        <option value="{{ $h }}" {{ request('hari') == $h ? 'selected' : '' }}>{{ $h }}</option>
                    @endforeach
                </select>
            </div>
            <div class="col-md-4">
                <button type="submit" class="btn btn-primary w-100">
                    <i class="bi bi-search"></i> Cari & Filter
                </button>
            </div>
        </form>
    </div>
</div>

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
                            <p class="text-muted mt-2">Belum ada jadwal yang tersedia</p>
                        </td>
                    </tr>
                    @endforelse
                </tbody>
            </table>
        </div>
    </div>
</div>
@endsection