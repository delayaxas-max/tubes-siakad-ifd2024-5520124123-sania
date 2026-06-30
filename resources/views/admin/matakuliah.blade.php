@extends('layouts.app')

@section('title', 'Data Mata Kuliah')

@section('content')
<div class="d-flex justify-content-between flex-wrap flex-md-nowrap align-items-center pt-3 pb-2 mb-3 border-bottom">
    <h1 class="h2">📖 Data Mata Kuliah</h1>
    <button class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#tambahModal">
        <i class="bi bi-plus-circle"></i> Tambah Mata Kuliah
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
            <div class="col-md-8">
                <input type="text" name="search" class="form-control" placeholder="Cari Kode atau Nama Mata Kuliah..." value="{{ request('search') }}">
            </div>
            <div class="col-md-4">
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
                        <th>Kode</th>
                        <th>Nama Mata Kuliah</th>
                        <th>SKS</th>
                        <th>Jumlah KRS</th>
                        <th>Aksi</th>
                    </tr>
                </thead>
                <tbody>
                    @forelse($matakuliah as $item)
                    <tr>
                        <td>{{ $loop->iteration }}</td>
                        <td><strong>{{ $item->kode_matakuliah }}</strong></td>
                        <td>{{ $item->nama_matakuliah }}</td>
                        <td><span class="badge bg-primary">{{ $item->sks }} SKS</span></td>
                        <td><span class="badge bg-info">{{ $item->krs_count ?? $item->krs->count() ?? 0 }}</span></td>
                        <td class="table-actions">
                            <button class="btn btn-warning btn-sm" data-bs-toggle="modal" data-bs-target="#editModal{{ $item->kode_matakuliah }}">
                                <i class="bi bi-pencil"></i>
                            </button>
                            <form action="{{ route('matakuliah.destroy', $item->kode_matakuliah) }}" method="POST" class="d-inline"
                                  onsubmit="return confirm('Yakin ingin menghapus mata kuliah ini?')">
                                @csrf
                                @method('DELETE')
                                <button type="submit" class="btn btn-danger btn-sm">
                                    <i class="bi bi-trash"></i>
                                </button>
                            </form>
                        </td>
                    </tr>

                    <!-- Modal Edit -->
                    <div class="modal fade" id="editModal{{ $item->kode_matakuliah }}" tabindex="-1">
                        <div class="modal-dialog">
                            <div class="modal-content">
                                <div class="modal-header">
                                    <h5 class="modal-title">Edit Mata Kuliah</h5>
                                    <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
                                </div>
                                <form action="{{ route('matakuliah.update', $item->kode_matakuliah) }}" method="POST">
                                    @csrf
                                    @method('PUT')
                                    <div class="modal-body">
                                        <div class="mb-3">
                                            <label class="form-label">Kode</label>
                                            <input type="text" class="form-control" value="{{ $item->kode_matakuliah }}" disabled>
                                        </div>
                                        <div class="mb-3">
                                            <label class="form-label">Nama Mata Kuliah <span class="text-danger">*</span></label>
                                            <input type="text" name="nama_matakuliah" class="form-control" value="{{ old('nama_matakuliah', $item->nama_matakuliah) }}" required>
                                            @error('nama_matakuliah') <small class="text-danger">{{ $message }}</small> @enderror
                                        </div>
                                        <div class="mb-3">
                                            <label class="form-label">SKS <span class="text-danger">*</span></label>
                                            <input type="number" name="sks" class="form-control" value="{{ old('sks', $item->sks) }}" min="1" max="6" required>
                                            @error('sks') <small class="text-danger">{{ $message }}</small> @enderror
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
                        <td colspan="6" class="text-center text-muted">Belum ada data mata kuliah</td>
                    </tr>
                    @endforelse
                </tbody>
            </table>
        </div>
        {{ $matakuliah->links() }}
    </div>
</div>

<!-- Modal Tambah -->
<div class="modal fade" id="tambahModal" tabindex="-1">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title">Tambah Mata Kuliah</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
            </div>
            <form action="{{ route('matakuliah.store') }}" method="POST">
                @csrf
                <div class="modal-body">
                    <div class="mb-3">
                        <label class="form-label">Kode <span class="text-danger">*</span></label>
                        <input type="text" name="kode_matakuliah" class="form-control" placeholder="Contoh: IF53413" required>
                        @error('kode_matakuliah') <small class="text-danger">{{ $message }}</small> @enderror
                    </div>
                    <div class="mb-3">
                        <label class="form-label">Nama Mata Kuliah <span class="text-danger">*</span></label>
                        <input type="text" name="nama_matakuliah" class="form-control" placeholder="Masukkan nama mata kuliah" required>
                        @error('nama_matakuliah') <small class="text-danger">{{ $message }}</small> @enderror
                    </div>
                    <div class="mb-3">
                        <label class="form-label">SKS <span class="text-danger">*</span></label>
                        <input type="number" name="sks" class="form-control" placeholder="1-6" min="1" max="6" required>
                        @error('sks') <small class="text-danger">{{ $message }}</small> @enderror
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