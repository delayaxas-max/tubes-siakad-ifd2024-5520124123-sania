<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>@yield('title', 'SIAKAD')</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.min.css">
    <style>
        /* ===== SIDEBAR STYLES ===== */
        * {
            margin: 0;
            padding: 0;
            box-sizing: border-box;
        }

        body {
            font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;
            background: #f0f2f5;
        }

        /* Sidebar */
        .sidebar {
            position: fixed;
            top: 0;
            left: 0;
            width: 260px;
            height: 100vh;
            background: #1a1a2e;
            z-index: 1050;
            transition: all 0.3s ease;
            overflow-y: auto;
            box-shadow: 2px 0 15px rgba(0,0,0,0.1);
        }

        /* Sidebar Hidden */
        .sidebar.hidden {
            transform: translateX(-260px);
        }

        /* Sidebar Overlay (untuk mobile) */
        .sidebar-overlay {
            position: fixed;
            top: 0;
            left: 0;
            width: 100%;
            height: 100%;
            background: rgba(0,0,0,0.5);
            z-index: 1040;
            display: none;
        }

        .sidebar-overlay.active {
            display: block;
        }

        /* Main Content */
        .main-content {
            margin-left: 260px;
            padding: 20px;
            min-height: 100vh;
            transition: all 0.3s ease;
        }

        .main-content.expanded {
            margin-left: 0;
        }

        /* Sidebar Brand */
        .sidebar .brand {
            padding: 20px;
            text-align: center;
            border-bottom: 1px solid #2d2d44;
        }

        .sidebar .brand h5 {
            color: #fff;
            font-weight: 700;
            margin: 0;
        }

        .sidebar .brand small {
            color: #a8a8b3;
            font-size: 12px;
        }

        /* Sidebar User Info */
        .sidebar .user-info {
            padding: 15px 20px;
            border-bottom: 1px solid #2d2d44;
            text-align: center;
        }

        .sidebar .user-info .avatar {
            width: 60px;
            height: 60px;
            border-radius: 50%;
            background: #0f3460;
            display: flex;
            align-items: center;
            justify-content: center;
            margin: 0 auto 10px;
            font-size: 24px;
            color: #fff;
        }

        .sidebar .user-info .name {
            color: #fff;
            font-weight: 600;
            margin: 0;
            font-size: 14px;
        }

        .sidebar .user-info .role {
            font-size: 11px;
            padding: 3px 12px;
            border-radius: 20px;
            display: inline-block;
            margin-top: 5px;
        }

        .sidebar .user-info .role-admin {
            background: #dc3545;
            color: #fff;
        }

        .sidebar .user-info .role-mahasiswa {
            background: #28a745;
            color: #fff;
        }

        /* Sidebar Navigation */
        .sidebar .nav {
            padding: 10px 0;
        }

        .sidebar .nav-item {
            padding: 0 10px;
        }

        .sidebar .nav-link {
            color: #a8a8b3;
            padding: 10px 15px;
            border-radius: 8px;
            margin: 2px 0;
            transition: all 0.3s;
            display: flex;
            align-items: center;
            gap: 12px;
        }

        .sidebar .nav-link:hover {
            background: #16213e;
            color: #fff;
        }

        .sidebar .nav-link.active {
            background: #0f3460;
            color: #fff;
        }

        .sidebar .nav-link i {
            font-size: 1.1rem;
            width: 20px;
            text-align: center;
        }

        .sidebar .nav-link .nav-text {
            flex: 1;
        }

        .sidebar .nav-link .badge {
            background: rgba(255,255,255,0.15);
            color: #fff;
        }

        .sidebar .nav-link.logout-btn {
            color: #dc3545;
        }

        .sidebar .nav-link.logout-btn:hover {
            background: rgba(220, 53, 69, 0.15);
            color: #dc3545;
        }

        /* Toggle Button */
        .toggle-sidebar-btn {
            position: fixed;
            top: 15px;
            left: 15px;
            z-index: 1060;
            background: #1a1a2e;
            color: #fff;
            border: none;
            border-radius: 10px;
            padding: 10px 12px;
            font-size: 1.2rem;
            cursor: pointer;
            transition: all 0.3s;
            box-shadow: 0 2px 10px rgba(0,0,0,0.2);
        }

        .toggle-sidebar-btn:hover {
            background: #0f3460;
            transform: scale(1.05);
        }

        /* Content Header dengan Toggle Button */
        .content-header {
            display: flex;
            align-items: center;
            gap: 15px;
            margin-bottom: 20px;
            background: #fff;
            padding: 15px 20px;
            border-radius: 15px;
            box-shadow: 0 2px 10px rgba(0,0,0,0.05);
        }

        .content-header .toggle-btn {
            background: #1a1a2e;
            color: #fff;
            border: none;
            border-radius: 8px;
            padding: 8px 12px;
            font-size: 1.2rem;
            cursor: pointer;
            transition: all 0.3s;
        }

        .content-header .toggle-btn:hover {
            background: #0f3460;
        }

        .content-header .page-title {
            flex: 1;
        }

        .content-header .page-title h1 {
            font-size: 1.3rem;
            font-weight: 700;
            margin: 0;
            color: #1a1a2e;
        }

        .content-header .page-title small {
            color: #6c757d;
            font-size: 13px;
        }

        /* ===== CARD STYLES ===== */
        .card-dashboard {
            transition: transform 0.3s, box-shadow 0.3s;
            cursor: pointer;
            border: none;
            border-radius: 15px;
        }

        .card-dashboard:hover {
            transform: translateY(-5px);
            box-shadow: 0 10px 30px rgba(0,0,0,0.15);
        }

        .card-dashboard .card-body {
            padding: 25px;
        }

        .card-dashboard .icon {
            font-size: 2.5rem;
            opacity: 0.3;
            position: absolute;
            right: 20px;
            top: 20px;
        }

        .stat-number {
            font-size: 2.2rem;
            font-weight: 700;
        }

        .content-card {
            border: none;
            border-radius: 15px;
            box-shadow: 0 2px 10px rgba(0,0,0,0.05);
        }

        .content-card .card-header {
            background: #fff;
            border-bottom: 1px solid #e9ecef;
            padding: 15px 20px;
            border-radius: 15px 15px 0 0;
            font-weight: 600;
        }

        .content-card .card-body {
            padding: 20px;
        }

        .table thead th {
            background: #1a1a2e;
            color: #fff;
            border: none;
            padding: 12px 15px;
            font-weight: 600;
            font-size: 13px;
        }

        .table tbody td {
            padding: 12px 15px;
            vertical-align: middle;
        }

        .table tbody tr:hover {
            background: #f8f9fa;
        }

        .badge-status-aktif { background: #d4edda; color: #155724; }
        .badge-status-selesai { background: #cce5ff; color: #004085; }
        .badge-status-batal { background: #f8d7da; color: #721c24; }

        .btn-primary {
            background: #0f3460;
            border: none;
            border-radius: 10px;
            padding: 10px 20px;
            font-weight: 600;
            transition: all 0.3s;
        }

        .btn-primary:hover {
            background: #1a1a2e;
            transform: translateY(-2px);
            box-shadow: 0 5px 15px rgba(15, 52, 96, 0.3);
        }

        .btn-success {
            background: #28a745;
            border: none;
            border-radius: 10px;
            padding: 10px 20px;
            font-weight: 600;
            transition: all 0.3s;
        }

        .btn-success:hover {
            background: #1e7e34;
            transform: translateY(-2px);
            box-shadow: 0 5px 15px rgba(40, 167, 69, 0.3);
        }

        .form-control {
            border-radius: 10px;
            border: 2px solid #e9ecef;
            padding: 10px 15px;
        }

        .form-control:focus {
            border-color: #0f3460;
            box-shadow: 0 0 0 0.2rem rgba(15, 52, 96, 0.2);
        }

        .modal-content {
            border-radius: 15px;
            border: none;
        }

        .alert {
            border-radius: 12px;
            border: none;
        }

        /* ===== RESPONSIVE ===== */
        @media (max-width: 768px) {
            .sidebar {
                transform: translateX(-260px);
            }

            .sidebar.active {
                transform: translateX(0);
            }

            .sidebar-overlay.active {
                display: block;
            }

            .main-content {
                margin-left: 0;
            }

            .toggle-sidebar-btn {
                display: block;
                left: 10px;
                top: 10px;
                padding: 8px 10px;
                font-size: 1rem;
            }

            .content-header .toggle-btn {
                display: none;
            }
        }

        @media (min-width: 769px) {
            .toggle-sidebar-btn {
                display: none;
            }

            .sidebar.hidden {
                transform: translateX(-260px);
            }

            .main-content.expanded {
                margin-left: 0;
            }
        }

        /* Scrollbar Styling */
        .sidebar::-webkit-scrollbar {
            width: 5px;
        }

        .sidebar::-webkit-scrollbar-track {
            background: #1a1a2e;
        }

        .sidebar::-webkit-scrollbar-thumb {
            background: #2d2d44;
            border-radius: 10px;
        }

        .sidebar::-webkit-scrollbar-thumb:hover {
            background: #0f3460;
        }
    </style>
</head>
<body>
    <!-- Toggle Button (Desktop) -->
    <button class="toggle-sidebar-btn" id="toggleSidebarBtn" title="Toggle Sidebar">
        <i class="bi bi-list"></i>
    </button>

    <!-- Sidebar Overlay (Mobile) -->
    <div class="sidebar-overlay" id="sidebarOverlay"></div>

    <!-- Sidebar -->
    <nav class="sidebar" id="sidebar">
        <div class="brand">
            <h5>📚 SIAKAD</h5>
            <small>Sistem Informasi Akademik</small>
        </div>
        
        <div class="user-info">
            <div class="avatar">
                <i class="bi bi-person-fill"></i>
            </div>
            <p class="name">{{ Auth::user()->name }}</p>
            <span class="role role-{{ Auth::user()->role }}">
                {{ ucfirst(Auth::user()->role) }}
            </span>
        </div>

        <ul class="nav flex-column">
            <!-- Dashboard -->
            <li class="nav-item">
                <a class="nav-link {{ request()->routeIs('dashboard') ? 'active' : '' }}" 
                   href="{{ route('dashboard') }}">
                    <i class="bi bi-house-door"></i>
                    <span class="nav-text">Dashboard</span>
                </a>
            </li>

            @if(Auth::user()->role == 'admin')
                <!-- Menu Admin -->
                <li class="nav-item">
                    <a class="nav-link {{ request()->routeIs('dosen.*') ? 'active' : '' }}" 
                       href="{{ route('dosen.index') }}">
                        <i class="bi bi-person-badge"></i>
                        <span class="nav-text">Dosen</span>
                    </a>
                </li>
                <li class="nav-item">
                    <a class="nav-link {{ request()->routeIs('mahasiswa.*') ? 'active' : '' }}" 
                       href="{{ route('mahasiswa.index') }}">
                        <i class="bi bi-people"></i>
                        <span class="nav-text">Mahasiswa</span>
                    </a>
                </li>
                <li class="nav-item">
                    <a class="nav-link {{ request()->routeIs('matakuliah.*') ? 'active' : '' }}" 
                       href="{{ route('matakuliah.index') }}">
                        <i class="bi bi-book"></i>
                        <span class="nav-text">Mata Kuliah</span>
                    </a>
                </li>
                <li class="nav-item">
                    <a class="nav-link {{ request()->routeIs('jadwal.index') ? 'active' : '' }}" 
                       href="{{ route('jadwal.index') }}">
                        <i class="bi bi-calendar-event"></i>
                        <span class="nav-text">Jadwal</span>
                    </a>
                </li>
                <li class="nav-item">
                    <a class="nav-link {{ request()->routeIs('krs.index') ? 'active' : '' }}" 
                       href="{{ route('krs.index') }}">
                        <i class="bi bi-card-list"></i>
                        <span class="nav-text">KRS</span>
                    </a>
                </li>
            @else
                <!-- Menu Mahasiswa -->
                <li class="nav-item">
                    <a class="nav-link {{ request()->routeIs('krs.saya') ? 'active' : '' }}" 
                       href="{{ route('krs.saya') }}">
                        <i class="bi bi-card-list"></i>
                        <span class="nav-text">KRS Saya</span>
                    </a>
                </li>
                <li class="nav-item">
                    <a class="nav-link {{ request()->routeIs('krs.create') ? 'active' : '' }}" 
                       href="{{ route('krs.create') }}">
                        <i class="bi bi-plus-circle"></i>
                        <span class="nav-text">Ambil KRS</span>
                    </a>
                </li>
                <li class="nav-item">
                    <a class="nav-link {{ request()->routeIs('jadwal.semua') ? 'active' : '' }}" 
                       href="{{ route('jadwal.semua') }}">
                        <i class="bi bi-calendar3"></i>
                        <span class="nav-text">Semua Jadwal</span>
                    </a>
                </li>
                <li class="nav-item">
                    <a class="nav-link {{ request()->routeIs('jadwal.saya') ? 'active' : '' }}" 
                       href="{{ route('jadwal.saya') }}">
                        <i class="bi bi-calendar-check"></i>
                        <span class="nav-text">Jadwal Saya</span>
                    </a>
                </li>
            @endif

            <!-- Logout -->
            <li class="nav-item mt-3 border-top pt-2">
                <form action="{{ route('logout') }}" method="POST">
                    @csrf
                    <button type="submit" class="nav-link logout-btn" style="background:none; border:none; width:100%; text-align:left; cursor:pointer;">
                        <i class="bi bi-box-arrow-right"></i>
                        <span class="nav-text">Logout</span>
                    </button>
                </form>
            </li>
        </ul>
    </nav>

    <!-- Main Content -->
    <main class="main-content" id="mainContent">
        <!-- Content Header -->
        <div class="content-header">
            <button class="toggle-btn" id="toggleSidebarBtn2" title="Toggle Sidebar">
                <i class="bi bi-list"></i>
            </button>
            <div class="page-title">
                <h1>@yield('page-title', 'SIAKAD')</h1>
                <small>@yield('subtitle', 'Sistem Informasi Akademik')</small>
            </div>
            <div>
                @yield('header-actions')
            </div>
        </div>

        @yield('content')
    </main>

    <!-- Scripts -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
    <script>
        // ===== SIDEBAR TOGGLE =====
        document.addEventListener('DOMContentLoaded', function() {
            const sidebar = document.getElementById('sidebar');
            const mainContent = document.getElementById('mainContent');
            const overlay = document.getElementById('sidebarOverlay');
            const toggleBtns = document.querySelectorAll('#toggleSidebarBtn, #toggleSidebarBtn2');

            // Cek state dari localStorage
            const isHidden = localStorage.getItem('sidebarHidden') === 'true';

            // Terapkan state awal
            if (window.innerWidth > 768 && isHidden) {
                sidebar.classList.add('hidden');
                mainContent.classList.add('expanded');
            }

            // Fungsi toggle sidebar
            function toggleSidebar() {
                const isMobile = window.innerWidth <= 768;

                if (isMobile) {
                    // Mobile: toggle class active
                    sidebar.classList.toggle('active');
                    overlay.classList.toggle('active');
                } else {
                    // Desktop: toggle hidden
                    sidebar.classList.toggle('hidden');
                    mainContent.classList.toggle('expanded');
                    
                    // Simpan state
                    const isNowHidden = sidebar.classList.contains('hidden');
                    localStorage.setItem('sidebarHidden', isNowHidden);
                }
            }

            // Event listener untuk tombol toggle
            toggleBtns.forEach(btn => {
                btn.addEventListener('click', toggleSidebar);
            });

            // Overlay click untuk close sidebar di mobile
            overlay.addEventListener('click', function() {
                sidebar.classList.remove('active');
                overlay.classList.remove('active');
            });

            // Handle resize
            window.addEventListener('resize', function() {
                const isMobile = window.innerWidth <= 768;
                const isHidden = localStorage.getItem('sidebarHidden') === 'true';

                if (!isMobile) {
                    // Desktop
                    sidebar.classList.remove('active');
                    overlay.classList.remove('active');
                    
                    if (isHidden) {
                        sidebar.classList.add('hidden');
                        mainContent.classList.add('expanded');
                    } else {
                        sidebar.classList.remove('hidden');
                        mainContent.classList.remove('expanded');
                    }
                } else {
                    // Mobile
                    sidebar.classList.remove('hidden');
                    mainContent.classList.remove('expanded');
                    sidebar.classList.remove('active');
                    overlay.classList.remove('active');
                }
            });

            // Auto-hide alert after 5 seconds
            setTimeout(() => {
                document.querySelectorAll('.alert').forEach(el => {
                    el.style.transition = 'opacity 0.5s';
                    el.style.opacity = '0';
                    setTimeout(() => el.remove(), 500);
                });
            }, 5000);
        });

        // Keyboard shortcut: Alt + S untuk toggle sidebar
        document.addEventListener('keydown', function(e) {
            if (e.altKey && e.key === 's') {
                e.preventDefault();
                document.getElementById('toggleSidebarBtn')?.click();
            }
        });
    </script>
</body>
</html>