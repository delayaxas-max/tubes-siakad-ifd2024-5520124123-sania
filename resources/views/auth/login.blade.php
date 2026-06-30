<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login - SIAKAD</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.min.css">
    <style>
        body {
            background: linear-gradient(135deg, #1a1a2e 0%, #16213e 50%, #0f3460 100%);
            min-height: 100vh;
            display: flex;
            align-items: center;
            justify-content: center;
            font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;
        }
        .login-card {
            background: rgba(255, 255, 255, 0.95);
            border-radius: 20px;
            padding: 40px;
            width: 100%;
            max-width: 420px;
            box-shadow: 0 20px 60px rgba(0, 0, 0, 0.5);
            animation: fadeInUp 0.6s ease;
        }
        @keyframes fadeInUp {
            from {
                opacity: 0;
                transform: translateY(30px);
            }
            to {
                opacity: 1;
                transform: translateY(0);
            }
        }
        .login-card .logo {
            text-align: center;
            margin-bottom: 30px;
        }
        .login-card .logo h2 {
            font-weight: 700;
            color: #1a1a2e;
        }
        .login-card .logo h2 span {
            color: #0f3460;
        }
        .login-card .logo p {
            color: #6c757d;
            font-size: 14px;
        }
        .login-card .form-control {
            border-radius: 10px;
            padding: 12px 15px;
            border: 2px solid #e9ecef;
            transition: all 0.3s;
        }
        .login-card .form-control:focus {
            border-color: #0f3460;
            box-shadow: 0 0 0 0.2rem rgba(15, 52, 96, 0.25);
        }
        .login-card .btn-login {
            background: linear-gradient(135deg, #0f3460, #1a1a2e);
            border: none;
            border-radius: 10px;
            padding: 12px;
            font-weight: 600;
            width: 100%;
            color: #fff;
            transition: all 0.3s;
        }
        .login-card .btn-login:hover {
            transform: translateY(-2px);
            box-shadow: 0 5px 20px rgba(15, 52, 96, 0.4);
        }
        .login-card .form-icon {
            position: relative;
        }
        .login-card .form-icon i {
            position: absolute;
            left: 15px;
            top: 50%;
            transform: translateY(-50%);
            color: #6c757d;
        }
        .login-card .form-icon input {
            padding-left: 45px;
        }
        .login-card .alert {
            border-radius: 10px;
        }
        .login-card .footer-text {
            text-align: center;
            margin-top: 20px;
            color: #6c757d;
            font-size: 13px;
        }
        .login-card .footer-text a {
            color: #0f3460;
            text-decoration: none;
            font-weight: 600;
        }
        .login-card .footer-text a:hover {
            text-decoration: underline;
        }
        .login-card .info-box {
            background: #f8f9fa;
            border-radius: 10px;
            padding: 15px;
            margin-top: 20px;
            border-left: 4px solid #0f3460;
            font-size: 13px;
            color: #6c757d;
        }
        .login-card .info-box i {
            color: #0f3460;
            margin-right: 8px;
        }
    </style>
</head>
<body>
    <div class="login-card">
        <div class="logo">
            <h2>📚 <span>SIAKAD</span></h2>
            <p>Sistem Informasi Akademik</p>
        </div>

        @if(session('error'))
            <div class="alert alert-danger alert-dismissible fade show" role="alert">
                <i class="bi bi-exclamation-circle"></i> {{ session('error') }}
                <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
            </div>
        @endif

        @if($errors->any())
            <div class="alert alert-danger alert-dismissible fade show" role="alert">
                <i class="bi bi-exclamation-circle"></i> {{ $errors->first() }}
                <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
            </div>
        @endif

        <form method="POST" action="{{ route('login') }}">
            @csrf
            <div class="mb-3">
                <label class="form-label fw-semibold">Email</label>
                <div class="form-icon">
                    <i class="bi bi-envelope"></i>
                    <input type="email" name="email" class="form-control" placeholder="Masukkan email" value="{{ old('email') }}" required autofocus>
                </div>
            </div>
            <div class="mb-3">
                <label class="form-label fw-semibold">Password</label>
                <div class="form-icon">
                    <i class="bi bi-lock"></i>
                    <input type="password" name="password" class="form-control" placeholder="Masukkan password" required>
                </div>
            </div>
            <div class="mb-3 form-check">
                <input type="checkbox" name="remember" class="form-check-input" id="remember">
                <label class="form-check-label" for="remember">Ingat saya</label>
            </div>
            <button type="submit" class="btn-login">
                <i class="bi bi-box-arrow-in-right"></i> Login
            </button>
        </form>

        <!-- Info Box (Tanpa email & password) -->
        <div class="info-box">
            <i class="bi bi-info-circle"></i>
            <strong>Informasi:</strong> Untuk mendapatkan akun, silakan hubungi administrator. 
            Atau lihat file <strong>README.md</strong> untuk informasi login.
        </div>

        <div class="footer-text">
            &copy; {{ date('Y') }} SIAKAD - Tugas Besar Web II
        </div>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>