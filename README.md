<p align="center">
    <img src="https://raw.githubusercontent.com/laravel/art/master/logo-lockup/5%20SVG/2%20CMYK/1%20Full%20Color/laravel-logolockup-cmyk-red.svg" width="400" alt="Laravel Logo">
</p>

<p align="center">
    <a href="https://github.com/laravel/framework/actions">
        <img src="https://github.com/laravel/framework/workflows/tests/badge.svg" alt="Build Status">
    </a>
    <a href="https://packagist.org/packages/laravel/framework">
        <img src="https://img.shields.io/packagist/dt/laravel/framework" alt="Total Downloads">
    </a>
    <a href="https://packagist.org/packages/laravel/framework">
        <img src="https://img.shields.io/packagist/v/laravel/framework" alt="Latest Stable Version">
    </a>
    <a href="https://packagist.org/packages/laravel/framework">
        <img src="https://img.shields.io/packagist/l/laravel/framework" alt="License">
    </a>
</p>

---

# 📚 SIAKAD - Sistem Informasi Akademik Sederhana

## Tentang Aplikasi

**SIAKAD (Sistem Informasi Akademik)** adalah aplikasi web berbasis Laravel yang digunakan untuk mengelola data akademik di lingkungan perguruan tinggi. Aplikasi ini dirancang untuk memudahkan administrasi akademik dengan dua peran pengguna: **Admin** dan **Mahasiswa**.

### Tujuan Aplikasi:
- Mengelola data dosen, mahasiswa, mata kuliah, dan jadwal perkuliahan
- Memudahkan mahasiswa dalam mengisi Kartu Rencana Studi (KRS)
- Menyediakan informasi jadwal perkuliahan secara real-time
- Mempermudah admin dalam mengelola data akademik

### Fitur Unggulan:
- [**Autentikasi & Authorization**](https://laravel.com/docs/authentication) - Login & Register dengan 2 role (Admin & Mahasiswa)
- [**CRUD Data**](https://laravel.com/docs/eloquent) - Kelola Dosen, Mahasiswa, Mata Kuliah, Jadwal, dan KRS
- [**Eloquent ORM**](https://laravel.com/docs/eloquent) - Database relationship yang powerful
- [**Middleware Role**](https://laravel.com/docs/middleware) - Pembatasan akses berdasarkan role
- [**Export PDF**](https://github.com/barryvdh/laravel-dompdf) - Export KRS ke PDF
- [**Pencarian & Filter**](https://laravel.com/docs/requests) - Fitur pencarian dan filter data
- [**Dashboard Statistik**](https://laravel.com/docs/blade) - Visualisasi data secara real-time

---

## 🔑 Informasi Login

### 👑 Admin
| Role | Email | Password | Hak Akses |
|------|-------|----------|-----------|
| **Admin** | admin@siakad.com | **admin123** | ✅ Kelola semua data |

### 👨‍🎓 Mahasiswa
| Nama | NPM | Email | Password | Hak Akses |
|------|-----|-------|----------|-----------|
| Andi Saputra | 231000001 | andi@student.com | **password** | ✅ Ambil KRS & Lihat Jadwal |

> **Catatan:** Untuk testing lebih lanjut, gunakan akun mahasiswa lain yang terdaftar di sistem dengan password **`password`**.

---

## 📱 Fitur Aplikasi

### 1. Autentikasi
- **Login**: Pengguna login menggunakan email dan password
- **Logout**: Pengguna dapat keluar dari sistem

### 2. Admin
- **Dashboard**: Statistik data (Dosen, Mahasiswa, Mata Kuliah, Jadwal, KRS)
- **CRUD Dosen**: Tambah, edit, hapus, lihat data dosen
- **CRUD Mahasiswa**: Tambah, edit, hapus, lihat data mahasiswa
- **CRUD Mata Kuliah**: Tambah, edit, hapus, lihat data mata kuliah
- **CRUD Jadwal**: Tambah, edit, hapus, lihat data jadwal
- **CRUD KRS**: Tambah, edit, hapus, lihat data KRS

### 3. Mahasiswa
- **Dashboard**: Jumlah KRS, Total SKS, Jadwal Hari Ini, Data diri
- **KRS**: Lihat, ambil (maks 24 SKS), dan drop mata kuliah
- **Jadwal**: Lihat semua jadwal dan jadwal yang diambil
- **Export PDF**: Mengunduh KRS dalam format PDF

### 4. Fitur Tambahan (Bonus)
- Export KRS ke PDF
- Pencarian 
- Dashboard statistic

---

## 🛠 Teknologi yang Digunakan

| Teknologi | Keterangan |
|-----------|------------|
| **Laravel 12** | Framework PHP |
| **Bootstrap 5** | Frontend Framework |
| **Bootstrap Icons** | Icon Library |
| **MySQL / SQLite** | Database |
| **Laravel DomPDF** | Export PDF |
| **Laravel Breeze** | Authentication |

---

## 🌐 Link Hosting

Aplikasi dapat diakses secara online di:

👉 **[https://sania-delayaxa.gt.tc/login](https://sania-delayaxa.gt.tc/login)**

---

## 👨‍💻 Pengembang

| Nama | [Sania Delayaxa] |
|------|-------------|
| **NPM** | [5520124123] |
| **Kelas** | [IF D 24] |

**Mata Kuliah:** Web II 

---
