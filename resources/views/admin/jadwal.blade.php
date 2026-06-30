@extends('layouts.app')

@section('title', 'Data Jadwal')

@section('content')
<div class="d-flex justify-content-between flex-wrap flex-md-nowrap align-items-center pt-3 pb-2 mb-3 border-bottom">
    <h1 class="h2">📅 Data Jadwal</h1>
    <button class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#tambahModal">
        <i class="bi bi-plus-circle"></i> Tambah Jadwal
    </button>
</div>

@if(session('success'))
    <div class="alert alert-success alert-dismissible fade show" role="alert">
        <i class="bi bi-check-circle"></i> {{ session('success') }}
        <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
    </div>
@endif

<!-- Search & Filter -->
<div class="card mb-3">
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

<div class="card">
    <div class="card-body">
        <div class="table-responsive">
            <table class="table table-bordered table-hover">
                <thead class="table-dark">
                    <tr>
                        <th>#</th>
                        <th>Kode MK</th>
                        <th>Mata Kuliah</th>
                        <th>Dosen</th>
                        <th>Kelas</th>
                        <th>Hari</th>
                        <th>Jam</th>
                        <th>Ruangan</th>
                        <th>Aksi</th>
                    </tr>
                </thead>
                <tbody>
                    @forelse($jadwal as $item)
                    <tr>
                        <td>{{ $loop->iteration }}</td>
                        <td><strong>{{ $item->kode_matakuliah }}</strong></td>
                        <td>{{ $item->matakuliah->nama_matakuliah ?? '-' }}</td>
                        <td>{{ $item->dosen->nama ?? '-' }}</td>
                        <td><span class="badge bg-primary">{{ $item->kelas }}</span></td>
                        <td>{{ $item->hari }}</td>
                        <td>{{ $item->jam }}</td>
                        <td>{{ $item->ruangan ?? '-' }}</td>
                        <td class="table-actions">
                            <button class="btn btn-warning btn-sm" data-bs-toggle="modal" data-bs-target="#editModal{{ $item->id_jadwal }}">
                                <i class="bi bi-pencil"></i>
                            </button>
                            <form action="{{ route('jadwal.destroy', $item->id_jadwal) }}" method="POST" class="d-inline"
                                  onsubmit="return confirm('Yakin ingin menghapus jadwal ini?')">
                                @csrf
                                @method('DELETE')
                                <button type="submit" class="btn btn-danger btn-sm">
                                    <i class="bi bi-trash"></i>
                                </button>
                            </form>
                        </td>
                    </tr>

                    <!-- Modal Edit -->
                    <div class="modal fade" id="editModal{{ $item->id_jadwal }}" tabindex="-1">
                        <div class="modal-dialog">
                            <div class="modal-content">
                                <div class="modal-header">
                                    <h5 class="modal-title">Edit Jadwal</h5>
                                    <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
                                </div>
                                <form action="{{ route('jadwal.update', $item->id_jadwal) }}" method="POST">
                                    @csrf
                                    @method('PUT')
                                    <div class="modal-body">
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
                                            <label class="form-label">Dosen <span class="text-danger">*</span></label>
                                            <select name="nidn" class="form-control" required>
                                                <option value="">-- Pilih --</option>
                                                @foreach($dosen as $d)
                                                    <option value="{{ $d->nidn }}" {{ $item->nidn == $d->nidn ? 'selected' : '' }}>
                                                        {{ $d->nama }}
                                                    </option>
                                                @endforeach
                                            </select>
                                        </div>
                                        <div class="mb-3">
                                            <label class="form-label">Kelas <span class="text-danger">*</span></label>
                                            <input type="text" name="kelas" class="form-control" value="{{ old('kelas', $item->kelas) }}" maxlength="1" required>
                                        </div>
                                        <div class="mb-3">
                                            <label class="form-label">Hari <span class="text-danger">*</span></label>
                                            <select name="hari" class="form-control" required>
                                                @foreach($hariList as $h)
                                                    <option value="{{ $h }}" {{ $item->hari == $h ? 'selected' : '' }}>{{ $h }}</option>
                                                @endforeach
                                            </select>
                                        </div>
                                        <div class="mb-3">
                                            <label class="form-label">Jam <span class="text-danger">*</span></label>
                                            <input type="time" name="jam" class="form-control" value="{{ old('jam', $item->jam) }}" required>
                                        </div>
                                        <div class="mb-3">
                                            <label class="form-label">Ruangan <span class="text-danger">*</span></label>
                                            <input type="text" name="ruangan" class="form-control" value="{{ old('ruangan', $item->ruangan) }}" required>
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
                        <td colspan="9" class="text-center text-muted">Belum ada data jadwal</td>
                    </tr>
                    @endforelse
                </tbody>
            </table>
        </div>
        {{ $jadwal->links() }}
    </div>
</div>

<!-- Modal Tambah -->
<div class="modal fade" id="tambahModal" tabindex="-1">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title">Tambah Jadwal</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
            </div>
            <form action="{{ route('jadwal.store') }}" method="POST">
                @csrf
                <div class="modal-body">
                    <div class="mb-3">
                        <label class="form-label">Mata Kuliah <span class="text-danger">*</span></label>
                        <select name="kode_matakuliah" class="form-control" required>
                            <option value="">-- Pilih --</option>
                            @foreach($matakuliah as $mk)
                                <option value="{{ $mk->kode_matakuliah }}">{{ $mk->kode_matakuliah }} - {{ $mk->nama_matakuliah }}</option>
                            @endforeach
                        </select>
                    </div>
                    <div class="mb-3">
                        <label class="form-label">Dosen <span class="text-danger">*</span></label>
                        <select name="nidn" class="form-control" required>
                            <option value="">-- Pilih --</option>
                            @foreach($dosen as $d)
                                <option value="{{ $d->nidn }}">{{ $d->nama }}</option>
                            @endforeach
                        </select>
                    </div>
                    <div class="mb-3">
                        <label class="form-label">Kelas <span class="text-danger">*</span></label>
                        <input type="text" name="kelas" class="form-control" placeholder="A/B/C" maxlength="1" required>
                    </div>
                    <div class="mb-3">
                        <label class="form-label">Hari <span class="text-danger">*</span></label>
                        <select name="hari" class="form-control" required>
                            <option value="">-- Pilih --</option>
                            @foreach($hariList as $h)
                                <option value="{{ $h }}">{{ $h }}</option>
                            @endforeach
                        </select>
                    </div>
                    <div class="mb-3">
                        <label class="form-label">Jam <span class="text-danger">*</span></label>
                        <input type="time" name="jam" class="form-control" required>
                    </div>
                    <div class="mb-3">
                        <label class="form-label">Ruangan <span class="text-danger">*</span></label>
                        <input type="text" name="ruangan" class="form-control" placeholder="Contoh: R.301" required>
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