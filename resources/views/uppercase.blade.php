<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Validasi Huruf Kapital - Form Pendaftaran</title>
    <!-- Google Fonts -->
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Plus+Jakarta+Sans:wght@300;400;500;600;700;800&display=swap" rel="stylesheet">
    <!-- FontAwesome Icons -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">

    <style>
        * {
            margin: 0;
            padding: 0;
            box-sizing: border-box;
            font-family: 'Plus Jakarta Sans', -apple-system, BlinkMacSystemFont, sans-serif;
        }

        body {
            min-height: 100vh;
            display: flex;
            justify-content: center;
            align-items: center;
            background: #0f172a;
            position: relative;
            overflow-x: hidden;
            padding: 24px;
        }

        /* Ambient Glowing Background Orbs */
        .bg-glow-1 {
            position: absolute;
            top: 15%;
            left: 20%;
            width: 350px;
            height: 350px;
            background: radial-gradient(circle, rgba(99, 102, 241, 0.45) 0%, rgba(0, 0, 0, 0) 70%);
            filter: blur(50px);
            z-index: 0;
            animation: floatGlow 12s infinite alternate ease-in-out;
        }

        .bg-glow-2 {
            position: absolute;
            bottom: 15%;
            right: 20%;
            width: 380px;
            height: 380px;
            background: radial-gradient(circle, rgba(236, 72, 153, 0.35) 0%, rgba(0, 0, 0, 0) 70%);
            filter: blur(60px);
            z-index: 0;
            animation: floatGlow 15s infinite alternate-reverse ease-in-out;
        }

        @keyframes floatGlow {
            0% { transform: translate(0, 0) scale(1); }
            50% { transform: translate(30px, -40px) scale(1.1); }
            100% { transform: translate(-20px, 30px) scale(0.95); }
        }

        /* Glassmorphism Form Card */
        .glass-card {
            position: relative;
            z-index: 10;
            width: 100%;
            max-width: 460px;
            background: rgba(30, 41, 59, 0.7);
            backdrop-filter: blur(20px);
            -webkit-backdrop-filter: blur(20px);
            border: 1px solid rgba(255, 255, 255, 0.12);
            border-radius: 24px;
            padding: 40px 36px;
            box-shadow: 0 25px 50px -12px rgba(0, 0, 0, 0.5),
                        0 0 0 1px rgba(255, 255, 255, 0.05);
            animation: fadeIn 0.6s cubic-bezier(0.16, 1, 0.3, 1);
        }

        @keyframes fadeIn {
            from { opacity: 0; transform: translateY(20px); }
            to { opacity: 1; transform: translateY(0); }
        }

        /* Header Section */
        .form-header {
            text-align: center;
            margin-bottom: 30px;
        }

        .icon-badge {
            display: inline-flex;
            align-items: center;
            justify-content: center;
            width: 58px;
            height: 58px;
            background: linear-gradient(135deg, rgba(99, 102, 241, 0.2), rgba(168, 85, 247, 0.2));
            border: 1px solid rgba(168, 85, 247, 0.3);
            border-radius: 18px;
            color: #818cf8;
            font-size: 24px;
            margin-bottom: 16px;
            box-shadow: 0 8px 16px rgba(0, 0, 0, 0.2);
        }

        .form-header h2 {
            font-size: 24px;
            font-weight: 700;
            color: #ffffff;
            letter-spacing: -0.02em;
            margin-bottom: 6px;
        }

        .form-header p {
            font-size: 14px;
            color: #94a3b8;
            font-weight: 400;
        }

        /* Error Alert Box */
        .alert-error {
            background: rgba(239, 68, 68, 0.12);
            border: 1px solid rgba(239, 68, 68, 0.3);
            border-radius: 14px;
            padding: 14px 16px;
            margin-bottom: 24px;
            animation: shake 0.4s cubic-bezier(0.36, 0.07, 0.19, 0.97) both;
        }

        @keyframes shake {
            10%, 90% { transform: translate3d(-1px, 0, 0); }
            20%, 80% { transform: translate3d(2px, 0, 0); }
            30%, 50%, 70% { transform: translate3d(-4px, 0, 0); }
            40%, 60% { transform: translate3d(4px, 0, 0); }
        }

        .alert-title {
            display: flex;
            align-items: center;
            gap: 8px;
            color: #fca5a5;
            font-size: 14px;
            font-weight: 600;
            margin-bottom: 6px;
        }

        .alert-error ul {
            list-style: none;
            padding-left: 24px;
        }

        .alert-error li {
            position: relative;
            font-size: 13px;
            color: #f87171;
            margin-bottom: 4px;
            line-height: 1.4;
        }

        .alert-error li::before {
            content: "•";
            position: absolute;
            left: -12px;
            color: #fca5a5;
        }

        .alert-error li:last-child {
            margin-bottom: 0;
        }

        /* Success Alert Box */
        .alert-success {
            display: flex;
            align-items: center;
            gap: 10px;
            padding: 14px 16px;
            margin-bottom: 24px;
            color: #86efac;
            background: rgba(34, 197, 94, 0.12);
            border: 1px solid rgba(34, 197, 94, 0.3);
            border-radius: 14px;
            font-size: 14px;
            font-weight: 600;
            animation: fadeIn 0.4s ease-out;
        }

        .alert-success i {
            color: #4ade80;
            font-size: 16px;
        }

        /* Form Group & Input Styling */
        .form-group {
            margin-bottom: 20px;
        }

        .form-label {
            display: block;
            font-size: 13px;
            font-weight: 600;
            color: #cbd5e1;
            margin-bottom: 8px;
            letter-spacing: 0.01em;
        }

        .input-wrapper {
            position: relative;
            display: flex;
            align-items: center;
        }

        .input-icon {
            position: absolute;
            left: 16px;
            color: #64748b;
            font-size: 16px;
            transition: color 0.2s ease;
            pointer-events: none;
        }

        .form-input {
            width: 100%;
            height: 48px;
            padding: 0 16px 0 46px;
            background: rgba(15, 23, 42, 0.6);
            border: 1px solid rgba(255, 255, 255, 0.1);
            border-radius: 12px;
            font-size: 14px;
            color: #f8fafc;
            outline: none;
            transition: all 0.25s ease;
        }

        .form-input::placeholder {
            color: #475569;
        }

        .form-input:focus {
            border-color: #818cf8;
            background: rgba(15, 23, 42, 0.85);
            box-shadow: 0 0 0 4px rgba(99, 102, 241, 0.15);
        }

        .form-input:focus + .input-icon,
        .input-wrapper:focus-within .input-icon {
            color: #818cf8;
        }

        /* Toggle Password Button */
        .toggle-password {
            position: absolute;
            right: 14px;
            background: none;
            border: none;
            color: #64748b;
            font-size: 15px;
            cursor: pointer;
            padding: 6px;
            border-radius: 6px;
            transition: color 0.2s ease;
        }

        .toggle-password:hover {
            color: #cbd5e1;
        }

        /* Submit Button Gradient & Shimmer */
        .btn-submit {
            position: relative;
            width: 100%;
            height: 50px;
            margin-top: 10px;
            background: linear-gradient(135deg, #6366f1 0%, #a855f7 100%);
            border: none;
            border-radius: 12px;
            color: #ffffff;
            font-size: 15px;
            font-weight: 600;
            cursor: pointer;
            overflow: hidden;
            box-shadow: 0 10px 20px -5px rgba(99, 102, 241, 0.4);
            transition: all 0.3s cubic-bezier(0.16, 1, 0.3, 1);
            display: flex;
            align-items: center;
            justify-content: center;
            gap: 10px;
        }

        .btn-submit:hover {
            transform: translateY(-2px);
            box-shadow: 0 14px 26px -5px rgba(99, 102, 241, 0.5);
            background: linear-gradient(135deg, #4f46e5 0%, #9333ea 100%);
        }

        .btn-submit:active {
            transform: translateY(1px);
            box-shadow: 0 6px 14px -4px rgba(99, 102, 241, 0.4);
        }

        /* Shimmer Effect */
        .btn-submit::after {
            content: '';
            position: absolute;
            top: -50%;
            left: -50%;
            width: 200%;
            height: 200%;
            background: linear-gradient(
                60deg,
                transparent 30%,
                rgba(255, 255, 255, 0.25) 50%,
                transparent 70%
            );
            transform: rotate(30deg);
            animation: shimmer 4s infinite linear;
        }

        @keyframes shimmer {
            0% { transform: translateX(-100%) rotate(30deg); }
            100% { transform: translateX(100%) rotate(30deg); }
        }

        /* Footer text */
        .form-footer {
            text-align: center;
            margin-top: 24px;
            font-size: 12px;
            color: #64748b;
        }

        .form-footer a {
            color: #818cf8;
            text-decoration: none;
            font-weight: 500;
        }

        .form-footer a:hover {
            text-decoration: underline;
        }
    </style>
</head>
<body>

    <!-- Background Ambient Light -->
    <div class="bg-glow-1"></div>
    <div class="bg-glow-2"></div>

    <!-- Glassmorphism Card Container -->
    <div class="glass-card">

        <!-- Header -->
        <div class="form-header">
            <div class="icon-badge">
                <i class="fa-solid fa-font"></i>
            </div>
            <h2>Validasi Huruf Kapital</h2>
            <p>Silakan isi data formulir di bawah ini dengan benar</p>
        </div>

        @if (session('success'))
            <div class="alert-success" role="status">
                <i class="fa-solid fa-circle-check"></i>
                <span>{{ session('success') }}</span>
            </div>
        @endif

        <!-- Laravel Validation Errors Block -->
        @if ($errors->any())
            <div class="alert-error">
                <div class="alert-title">
                    <i class="fa-solid fa-circle-exclamation"></i>
                    <span>Terjadi kesalahan input:</span>
                </div>
                <ul>
                    @foreach ($errors->all() as $error)
                        <li>{{ $error }}</li>
                    @endforeach
                </ul>
            </div>
        @endif

        <!-- Form Action & Method -->
        <form action="/uppercase" method="POST">
            @csrf

            <!-- Field 1: Nama Lengkap -->
            <div class="form-group">
                <label for="name" class="form-label">Nama Lengkap</label>
                <div class="input-wrapper">
                    <input
                        type="text"
                        id="name"
                        name="name"
                        class="form-input"
                        placeholder="Nama kapital, 3-50 karakter..."
                        value="{{ old('name') }}"
                        minlength="3"
                        maxlength="50"
                        required
                        autocomplete="off"
                    >
                    <i class="fa-regular fa-user input-icon"></i>
                </div>
            </div>

            <!-- Field 2: Email -->
            <div class="form-group">
                <label for="email" class="form-label">Email</label>
                <div class="input-wrapper">
                    <input
                        type="email"
                        id="email"
                        name="email"
                        class="form-input"
                        placeholder="Masukkan alamat email..."
                        value="{{ old('email') }}"
                        required
                        autocomplete="email"
                    >
                    <i class="fa-regular fa-envelope input-icon"></i>
                </div>
            </div>

            <!-- Field 3: Password -->
            <div class="form-group">
                <label for="password" class="form-label">Password</label>
                <div class="input-wrapper">
                    <input
                        type="password"
                        id="password"
                        name="password"
                        class="form-input"
                        placeholder="Minimal 6 karakter"
                        minlength="6"
                        required
                        autocomplete="new-password"
                    >
                    <i class="fa-solid fa-lock input-icon"></i>
                    <button type="button" class="toggle-password" id="togglePasswordBtn" title="Tampilkan Password">
                        <i class="fa-regular fa-eye" id="toggleIcon"></i>
                    </button>
                </div>
            </div>

            <!-- Submit Button -->
            <button type="submit" class="btn-submit">
                <span>Kirim Data</span>
                <i class="fa-solid fa-arrow-right"></i>
            </button>

            <!-- Footer Notes -->
            <div class="form-footer">
                Sistem Validasi Otomatis &bull; Laravel Custom Rule
            </div>
        </form>

    </div>

    <!-- Interactivity Script -->
    <script>
        document.addEventListener('DOMContentLoaded', () => {
            const togglePasswordBtn = document.getElementById('togglePasswordBtn');
            const passwordInput = document.getElementById('password');
            const toggleIcon = document.getElementById('toggleIcon');

            if (togglePasswordBtn && passwordInput && toggleIcon) {
                togglePasswordBtn.addEventListener('click', () => {
                    const isPassword = passwordInput.getAttribute('type') === 'password';

                    // Toggle field type
                    passwordInput.setAttribute('type', isPassword ? 'text' : 'password');

                    // Toggle icon class
                    toggleIcon.className = isPassword ? 'fa-regular fa-eye-slash' : 'fa-regular fa-eye';
                });
            }
        });
    </script>
</body>
</html>
