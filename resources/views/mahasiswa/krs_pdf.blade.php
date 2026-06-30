<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8">
    <title>KRS - {{ $mahasiswa->nama }}</title>
    <style>
        * {
            font-family: 'Arial', sans-serif;
            margin: 0;
            padding: 0;
        }
        body {
            padding: 40px;
            background: #fff;
        }
        .header {
            text-align: center;
            border-bottom: 3px solid #1a1a2e;
            padding-bottom: 15px;
            margin-bottom: 20px;
        }
        .header h1 {
            margin: 0;
            color: #1a1a2e;
            font-size: 28px;
            letter-spacing: 2px;
        }
        .header h1 span {
            color: #0f3460;
        }
        .header .subtitle {
            color: #6c757d;
            font-size: 14px;
            margin-top: 5px;
        }
        .header .date {
            color: #6c757d;
            font-size: 12px;
            margin-top: 3px;
        }
        .info-mahasiswa {
            background: #f8f9fa;
            padding: 15px 20px;
            border-radius: 8px;
            margin-bottom: 20px;
            border-left: 4px solid #0f3460;
        }
        .info-mahasiswa table {
            width: 100%;
            font-size: 13px;
        }
        .info-mahasiswa td {
            padding: 4px 10px;
        }
        .info-mahasiswa .label {
            font-weight: bold;
            width: 120px;
            color: #495057;
        }
        .info-mahasiswa .value {
            color: #1a1a2e;
        }
        table.krs-table {
            width: 100%;
            border-collapse: collapse;
            margin-top: 15px;
            font-size: 12px;
        }
        table.krs-table th {
            background: #1a1a2e;
            color: #ffffff;
            padding: 10px 12px;
            text-align: left;
        }
        table.krs-table td {
            padding: 10px 12px;
            border-bottom: 1px solid #e9ecef;
        }
        table.krs-table .text-center {
            text-align: center;
        }
        table.krs-table .badge {
            background: #28a745;
            color: #fff;
            padding: 2px 12px;
            border-radius: 20px;
            font-size: 10px;
            font-weight: bold;
        }
        table.krs-table .badge-selesai {
            background: #17a2b8;
        }
        table.krs-table .badge-batal {
            background: #dc3545;
        }
        table.krs-table tr:nth-child(even) {
            background: #f8f9fa;
        }
        .total-sks {
            margin-top: 20px;
            padding: 15px 20px;
            background: #e8f4fd;
            border-radius: 8px;
            text-align: right;
            border: 1px solid #b8d4e3;
        }
        .total-sks strong {
            font-size: 16px;
            color: #0f3460;
        }
        .total-sks .sks-number {
            font-size: 22px;
            color: #0f3460;
            font-weight: bold;
        }
        .footer {
            margin-top: 30px;
            text-align: center;
            border-top: 1px solid #dee2e6;
            padding-top: 15px;
            font-size: 11px;
            color: #6c757d;
        }
        .signature {
            margin-top: 40px;
            display: flex;
            justify-content: space-between;
        }
        .signature .sign-box {
            text-align: center;
            width: 30%;
        }
        .signature .sign-line {
            border-bottom: 1px solid #333;
            margin: 30px auto 5px;
            width: 80%;
        }
        .signature .sign-label {
            font-size: 12px;
            color: #495057;
        }
        .signature .sign-name {
            font-weight: bold;
            font-size: 13px;
            margin-top: 3px;
        }
        .watermark {
            position: fixed;
            top: 50%;
            left: 50%;
            transform: translate(-50%, -50%) rotate(-45deg);
            font-size: 100px;
            opacity: 0.03;
            color: #000;
            font-weight: bold;
            pointer-events: none;
            letter-spacing: 10px;
        }
        .page-break {
            page-break-before: always;
        }
        @page {
            margin: 20px;
        }
    </style>
</head>
<body>
    <div class="watermark">SIAKAD</div>

    <!-- Header -->
    <div class="header">
        <h1>📚 <span>KARTU RENCANA STUDI</span></h1>
        <p class="subtitle">Sistem Informasi Akademik</p>
        <p class="date">Semester Ganjil {{ date('Y') }}/{{ date('Y')+1 }}</p>
        <p class="date" style="font-size: 11px;">Dicetak: {{ date('d F Y H:i:s') }}</p>
    </div>

    <!-- Info Mahasiswa -->
    <div class="info-mahasiswa">
        <table>
            <tr>
                <td class="label">NPM</td>
                <td class="value">: <strong>{{ $mahasiswa->npm }}</strong></td>
                <td class="label">Program Studi</td>
                <td class="value">: Teknik Informatika</td>
            </tr>
            <tr>
                <td class="label">Nama</td>
                <td class="value">: <strong>{{ $mahasiswa->nama }}</strong></td>
                <td class="label">Fakultas</td>
                <td class="value">: FIKOM</td>
            </tr>
            <tr>
                <td class="label">Dosen Wali</td>
                <td class="value">: {{ $mahasiswa->dosen->nama ?? '-' }}</td>
                <td class="label">Tahun Akademik</td>
                <td class="value">: {{ date('Y') }}/{{ date('Y')+1 }}</td>
            </tr>
        </table>
    </div>

    <!-- Tabel KRS -->
    <table class="krs-table">
        <thead>
            <tr>
                <th style="width:40px;">No</th>
                <th style="width:100px;">Kode MK</th>
                <th>Mata Kuliah</th>
                <th style="width:50px;text-align:center;">SKS</th>
                <th style="width:80px;text-align:center;">Status</th>
            </tr>
        </thead>
        <tbody>
            @forelse($krs as $item)
            <tr>
                <td>{{ $loop->iteration }}</td>
                <td><strong>{{ $item->matakuliah->kode_matakuliah ?? '-' }}</strong></td>
                <td>{{ $item->matakuliah->nama_matakuliah ?? '-' }}</td>
                <td class="text-center">{{ $item->matakuliah->sks ?? 0 }}</td>
                <td class="text-center">
                    <span class="badge {{ $item->status == 'Selesai' ? 'badge-selesai' : ($item->status == 'Batal' ? 'badge-batal' : '') }}">
                        {{ $item->status }}
                    </span>
                </td>
            </tr>
            @empty
            <tr>
                <td colspan="5" style="text-align:center;padding:30px;color:#6c757d;">
                    <em>Belum ada KRS</em>
                </td>
            </tr>
            @endforelse
        </tbody>
    </table>

    <!-- Total SKS -->
    <div class="total-sks">
        <strong>Total SKS : <span class="sks-number">{{ $totalSks }}</span></strong>
        <br>
        <small style="color:#6c757d;">* Maksimal 24 SKS per semester</small>
    </div>

    <!-- Tanda Tangan -->
    <div class="signature">
        <div class="sign-box">
            <div class="sign-line"></div>
            <p class="sign-label">Mahasiswa</p>
            <p class="sign-name">{{ $mahasiswa->nama }}</p>
            <p style="font-size:10px;color:#6c757d;">NPM: {{ $mahasiswa->npm }}</p>
        </div>
        <div class="sign-box">
            <div class="sign-line"></div>
            <p class="sign-label">Dosen Wali</p>
            <p class="sign-name">{{ $mahasiswa->dosen->nama ?? '-' }}</p>
            <p style="font-size:10px;color:#6c757d;">NIDN: {{ $mahasiswa->dosen->nidn ?? '-' }}</p>
        </div>
        <div class="sign-box">
            <div class="sign-line"></div>
            <p class="sign-label">Ketua Program Studi</p>
            <p class="sign-name">Dr. Ahmad Fauzi, M.Kom</p>
            <p style="font-size:10px;color:#6c757d;">NIDN: 1000000001</p>
        </div>
    </div>

    <!-- Footer -->
    <div class="footer">
        <p>© {{ date('Y') }} SIAKAD - Sistem Informasi Akademik</p>
        <p style="font-size:10px;">Dokumen ini adalah bukti resmi Kartu Rencana Studi</p>
    </div>
</body>
</html>