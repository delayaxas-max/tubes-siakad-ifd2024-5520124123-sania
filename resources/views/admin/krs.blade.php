@extends('layouts.app')

@section('title', 'Data KRS')

@section('content')
<div class="d-flex justify-content-between flex-wrap flex-md-nowrap align-items-center pt-3 pb-2 mb-3 border-bottom">
    <h1 class="h2">📋 Data KRS</h1>
    <button class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#tambahModal">
        <i class="bi bi-plus-circle"></i> Tambah KRS
    </button>
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

<!-- Search -->
<div class="card mb-3">
    <div class="card-body">
        <form action="" method="GET" class="row g-3">
            <div class="col-md-10">
                <input type="text" name="search" class="form-control" placeholder="Cari NPM, Nama Mahasiswa, atau Mata Kuliah..." value="{{ request('search') }}">
            </div>
            <div class="col-md-2">
                <button type="submit" class="btn btn-primary w-100">
                    <i class="bi bi-search"></i> Cari
                </button>
            </div>
        </form>
    </div>
</div>

<div class="card">
    <div class="card-body">
        <div class="table-responsive">
            <table class="table table-bordered table-hover">
                <thead class="table-dark">
                    <tr>
                        <th>#</th>
                        <th>NPM</th>
                        <th>Mahasiswa</th>
                        <th>Mata Kuliah</th>
                        <th>SKS</th>
                        <th>Status</th>
                        <th>Tanggal</th>
                        <th>Aksi</th>
                    </tr>
                </thead>
                <tbody>
                    @forelse($krs as $item)
                    <tr>
                        <td>{{ $loop->iteration }}</td>
                        <td><strong>{{ $item->npm }}</strong></td>
                        <td>{{ $item->mahasiswa->nama ?? '-' }}</td>
                        <td>{{ $item->matakuliah->nama_matakuliah ?? '-' }}</td>
                        <td><span class="badge bg-primary">{{ $item->matakuliah->sks ?? 0 }}</span></td>
                        <td>
                            <span class="badge bg-{{ $item->status == 'Aktif' ? 'success' : ($item->status == 'Selesai' ? 'info' : 'danger') }}">
                                {{ $item->status }}
                            </span>
                        </td>
                        <td>{{ $item->created_at->format('d/m/Y') }}</td>
                        <td class="table-actions">
                            <button class="btn btn-warning btn-sm" data-bs-toggle="modal" data-bs-target="#editModal{{ $item->id_krs }}">
                                <i class="bi bi-pencil"></i>
                            </button>
                            <form action="{{ route('krs.destroy', $item->id_krs) }}" method="POST" class="d-inline"
                                  onsubmit="return confirm('Yakin ingin menghapus KRS ini?')">
                                @csrf
                                @method('DELETE')
                                <button type="submit" class="btn btn-danger btn-sm">
                                    <i class="bi bi-trash"></i>
                                </button>
                            </form>
                        </td>
                    </tr>

                    <!-- Modal Edit -->
                    <div class="modal fade" id="editModal{{ $item->id_krs }}" tabindex="-1">
                        <div class="modal-dialog">
                            <div class="modal-content">
                                <div class="modal-header">
                                    <h5 class="modal-title">Edit KRS</h5>
                                    <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
                                </div>
                                <form action="{{ route('krs.update', $item->id_krs) }}" method="POST">
                                    @csrf
                                    @method('PUT')
                                    <div class="modal-body">
                                        <div class="mb-3">
                                            <label class="form-label">Mahasiswa <span class="text-danger">*</span></label>
                                            <select name="npm" class="form-control" required>
                                                <option value="">-- Pilih --</option>
                                                @foreach($mahasiswa as $m)
                                                    <option value="{{ $m->npm }}" {{ $item->npm == $m->npm ? 'selected' : '' }}>
                                                        {{ $m->npm }} - {{ $m->nama }}
                                                    </option>
                                                @endforeach
                                            </select>
                                        </div>
                                        <div class="mb-3">
                                            <label class="form-label">Mata Kuliah <span class="text-danger">*</span></label>
                                            <select name="kode_matakuliah" class="form-control" required>
                                                <option value="">-- Pilih --</option>
                                                @foreach($matakuliah as $mk)
                                                    <option value="{{ $mk->kode_matakuliah }}" {{ $item->kode_matakuliah == $mk->kode_matakuliah ? 'selected' : '' }}>
                                                        {{ $mk->kode_matakuliah }} - {{ $mk->nama_matakuliah }}
                                                    </option>
                                                @endforeach
                                            </select>
                                        </div>
                                        <div class="mb-3">
                                            <label class="form-label">Status <span class="text-danger">*</span></label>
                                            <select name="status" class="form-control" required>
                                                <option value="Aktif" {{ $item->status == 'Aktif' ? 'selected' : '' }}>Aktif</option>
                                                <option value="Selesai" {{ $item->status == 'Selesai' ? 'selected' : '' }}>Selesai</option>
                                                <option value="Batal" {{ $item->status == 'Batal' ? 'selected' : '' }}>Batal</option>
                                            </select>
                                        </div>
                                    </div>
                                    <div class="modal-footer">
                                        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Batal</button>
                                        <button type="submit" class="btn btn-warning">Update</button>
                                    </div>
                                </form>
                            </div>
                        </div>
                    </div>
                    @empty
                    <tr>
                        <td colspan="8" class="text-center text-muted">Belum ada data KRS</td>
                    </tr>
                    @endforelse
                </tbody>
            </table>
        </div>
        {{ $krs->links() }}
    </div>
</div>

<!-- Modal Tambah -->
<div class="modal fade" id="tambahModal" tabindex="-1">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title">Tambah KRS</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
            </div>
            <form action="{{ route('krs.store') }}" method="POST">
                @csrf
                <div class="modal-body">
                    <div class="mb-3">
                        <label class="form-label">Mahasiswa <span class="text-danger">*</span></label>
                        <select name="npm" class="form-control" required>
                            <option value="">-- Pilih --</option>
                            @foreach($mahasiswa as $m)
                                <option value="{{ $m->npm }}">{{ $m->npm }} - {{ $m->nama }}</option>
                            @endforeach
                        </select>
                    </div>
                    <div class="mb-3">
                        <label class="form-label">Mata Kuliah <span class="text-danger">*</span></label>
                        <select name="kode_matakuliah" class="form-control" required>
                            <option value="">-- Pilih --</option>
                            @foreach($matakuliah as $mk)
                                <option value="{{ $mk->kode_matakuliah }}">{{ $mk->kode_matakuliah }} - {{ $mk->nama_matakuliah }}</option>
                            @endforeach
                        </select>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Batal</button>
                    <button type="submit" class="btn btn-primary">Simpan</button>
                </div>
            </form>
        </div>
    </div>
</div>
@endsection