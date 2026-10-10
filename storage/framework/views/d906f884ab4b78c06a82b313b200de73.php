<?php
    use App\Models\Setting;

    $appSetting = Setting::find(1);

    $appName = $appSetting->app_name ?? 'Stockify';
    $appDescription = $appSetting->app_description ?? 'Sistem Manajemen Stok Barang';

    $ifyPosition = stripos($appName, 'ify');
?>

<!DOCTYPE html>
<html lang="id">

<head>

    <meta charset="UTF-8">

    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <title>Login - <?php echo e($appName); ?></title>

    <link rel="preconnect" href="https://fonts.googleapis.com">

    <link
        rel="preconnect"
        href="https://fonts.gstatic.com"
        crossorigin
    >

    <link
        href="https://fonts.googleapis.com/css2?family=Inter:wght@400;500;600;700;800&display=swap"
        rel="stylesheet"
    >

    <style>

        :root {
            --body-bg: #f4f7fc;
            --left-bg-start: #eef5ff;
            --left-bg-end: #dceaff;
            --right-bg: #ffffff;
            --heading-color: #172b4d;
            --text-color: #64748b;
            --muted-color: #94a3b8;
            --input-bg: #f8faff;
            --input-border: #dbe4f0;
            --input-text: #172b4d;
            --feature-bg: rgba(255, 255, 255, 0.85);
            --blue: #2563eb;
            --blue-hover: #1d4ed8;
            --shelf-color: #6d9bd8;
            --box-bg: #dfb78b;
            --box-border: #b9834d;
        }

        * {
            margin: 0;
            padding: 0;
            box-sizing: border-box;
        }

        html,
        body {
            min-height: 100%;
        }

        body {
            min-height: 100vh;
            overflow-x: hidden;
            background: var(--body-bg);
            color: var(--heading-color);
            font-family: 'Inter', sans-serif;
        }

        button,
        input {
            font-family: inherit;
        }

        .login-wrapper {
            display: flex;
            min-height: 100vh;
        }

        /* =========================
           BAGIAN KIRI
        ========================= */

        .left-section {
            position: relative;
            display: flex;
            flex-direction: column;
            justify-content: center;
            width: 55%;
            min-height: 100vh;
            padding: 60px 80px;
            overflow: hidden;
            background: linear-gradient(
                135deg,
                var(--left-bg-start),
                var(--left-bg-end)
            );
        }

        .left-section::before {
            content: "";
            position: absolute;
            top: -230px;
            right: -180px;
            width: 550px;
            height: 550px;
            border-radius: 50%;
            background: rgba(255, 255, 255, 0.48);
        }

        .left-section::after {
            content: "";
            position: absolute;
            bottom: -250px;
            left: -200px;
            width: 520px;
            height: 520px;
            border-radius: 50%;
            background: rgba(37, 99, 235, 0.08);
        }

        .brand {
            position: relative;
            z-index: 2;
            display: flex;
            align-items: center;
            gap: 15px;
            margin-bottom: 65px;
        }

        .brand-icon,
        .login-logo {
            display: flex;
            justify-content: center;
            align-items: center;
            background: var(--blue);
            color: #ffffff;
            font-weight: 800;
            box-shadow: 0 10px 25px rgba(37, 99, 235, 0.22);
        }

        .brand-icon {
            width: 58px;
            height: 58px;
            border-radius: 17px;
            font-size: 35px;
            overflow: hidden;
        }

        .brand-icon img {
            width: 100%;
            height: 100%;
            object-fit: contain;
            border-radius: inherit;
        }

        .brand-name {
            color: var(--heading-color);
            font-size: 31px;
            font-weight: 800;
            letter-spacing: -1px;
        }

        .brand-name span {
            color: var(--blue);
        }

        .brand-subtitle {
            margin-top: 5px;
            color: var(--text-color);
            font-size: 14px;
        }

        .left-content {
            position: relative;
            z-index: 2;
        }

        .left-content h1 {
            max-width: 650px;
            margin-bottom: 25px;
            color: var(--heading-color);
            font-size: 43px;
            font-weight: 800;
            line-height: 1.2;
            letter-spacing: -1.5px;
        }

        .left-content h1 span {
            color: var(--blue);
        }

        .left-content > p {
            max-width: 570px;
            margin-bottom: 38px;
            color: var(--text-color);
            font-size: 16px;
            line-height: 1.9;
        }

        .feature-list {
            display: flex;
            flex-direction: column;
            gap: 23px;
        }

        .feature-item {
            display: flex;
            align-items: center;
            gap: 17px;
        }

        .feature-icon {
            display: flex;
            justify-content: center;
            align-items: center;
            width: 58px;
            height: 58px;
            flex-shrink: 0;
            border-radius: 16px;
            background: var(--feature-bg);
            color: var(--blue);
            font-size: 25px;
            box-shadow: 0 5px 15px rgba(37, 99, 235, 0.08);
        }

        .feature-text h3 {
            margin-bottom: 6px;
            color: var(--heading-color);
            font-size: 15px;
            font-weight: 700;
        }

        .feature-text p {
            color: var(--text-color);
            font-size: 13px;
        }

        .left-footer {
            position: relative;
            z-index: 2;
            margin-top: 60px;
            color: var(--text-color);
            font-size: 12px;
        }

        /* ILUSTRASI GUDANG */

        .warehouse-illustration {
            position: absolute;
            z-index: 1;
            right: -25px;
            bottom: 0;
            width: 340px;
            opacity: 0.75;
        }

        .warehouse-shelf {
            position: relative;
            width: 290px;
            height: 220px;
            margin-left: auto;
            border-left: 15px solid var(--shelf-color);
            border-right: 15px solid var(--shelf-color);
            border-bottom: 15px solid var(--shelf-color);
        }

        .shelf-line {
            position: absolute;
            left: -15px;
            width: 290px;
            height: 15px;
            background: var(--shelf-color);
        }

        .shelf-line.one {
            top: 68px;
        }

        .shelf-line.two {
            top: 137px;
        }

        .box {
            position: absolute;
            width: 95px;
            height: 58px;
            border: 2px solid var(--box-border);
            border-radius: 6px;
            background: var(--box-bg);
        }

        .box.one {
            top: 10px;
            left: 40px;
        }

        .box.two {
            top: 82px;
            right: 35px;
        }

        .box.three {
            top: 150px;
            left: 45px;
        }

        /* =========================
           BAGIAN KANAN
        ========================= */

        .right-section {
            display: flex;
            justify-content: center;
            align-items: center;
            width: 45%;
            min-height: 100vh;
            padding: 45px;
            background: var(--right-bg);
        }

        .login-container {
            width: 100%;
            max-width: 505px;
        }

        /* HEADER LOGIN */

        .login-header {
            margin-bottom: 38px;
            text-align: center;
        }

        .login-logo {
            width: 76px;
            height: 76px;
            margin: 0 auto 25px;
            overflow: hidden;
            border-radius: 20px;
            font-size: 45px;
        }

        .login-logo img {
            width: 100%;
            height: 100%;
            object-fit: contain;
            border-radius: inherit;
        }

        .login-header h2 {
            margin-bottom: 12px;
            color: var(--heading-color);
            font-size: 34px;
            font-weight: 800;
            letter-spacing: -1.2px;
        }

        .login-header h2 span {
            color: var(--blue);
        }

        .login-header p {
            color: var(--muted-color);
            font-size: 14px;
        }

        /* PESAN ERROR */

        .error-message {
            margin-bottom: 22px;
            padding: 14px 16px;
            border: 1px solid #fecaca;
            border-radius: 10px;
            background: #fef2f2;
            color: #dc2626;
            font-size: 13px;
        }

        /* FORM */

        .form-group {
            margin-bottom: 24px;
        }

        .form-group label {
            display: block;
            margin-bottom: 10px;
            color: var(--heading-color);
            font-size: 13px;
            font-weight: 700;
        }

        .input-wrapper {
            position: relative;
        }

        .input-icon {
            position: absolute;
            top: 50%;
            left: 19px;
            z-index: 2;
            transform: translateY(-50%);
            color: var(--muted-color);
            font-size: 19px;
            pointer-events: none;
        }

        .form-control {
            width: 100%;
            height: 64px;
            padding: 0 57px;
            border: 1px solid var(--input-border);
            border-radius: 14px;
            outline: none;
            background: var(--input-bg);
            color: var(--input-text);
            font-size: 14px;
            transition:
                background 0.3s ease,
                color 0.3s ease,
                border-color 0.3s ease,
                box-shadow 0.3s ease;
        }

        .form-control:focus {
            border-color: var(--blue);
            background: var(--right-bg);
            box-shadow: 0 0 0 4px rgba(37, 99, 235, 0.12);
        }

        .form-control::placeholder {
            color: var(--muted-color);
        }

        .password-toggle {
            position: absolute;
            top: 50%;
            right: 19px;
            transform: translateY(-50%);
            border: none;
            background: transparent;
            color: var(--muted-color);
            font-size: 18px;
            cursor: pointer;
        }

        .password-toggle:hover {
            color: var(--blue);
        }

        /* REMEMBER DAN LUPA PASSWORD */

        .remember-row {
            display: flex;
            justify-content: space-between;
            align-items: center;
            gap: 15px;
            margin: 4px 0 28px;
        }

        .remember-label {
            display: flex;
            align-items: center;
            gap: 9px;
            color: var(--text-color);
            font-size: 13px;
            cursor: pointer;
        }

        .remember-label input {
            width: 18px;
            height: 18px;
            accent-color: var(--blue);
            cursor: pointer;
        }

        .forgot-link {
            color: var(--blue);
            font-size: 13px;
            font-weight: 600;
            text-decoration: none;
        }

        .forgot-link:hover {
            text-decoration: underline;
        }

        /* TOMBOL LOGIN */

        .login-button {
            display: flex;
            justify-content: center;
            align-items: center;
            gap: 15px;
            width: 100%;
            height: 64px;
            border: none;
            border-radius: 14px;
            background: linear-gradient(135deg, #2563eb, #1d4ed8);
            color: #ffffff;
            font-size: 15px;
            font-weight: 700;
            cursor: pointer;
            box-shadow: 0 10px 22px rgba(37, 99, 235, 0.22);
            transition:
                transform 0.3s ease,
                box-shadow 0.3s ease;
        }

        .login-button:hover {
            transform: translateY(-2px);
            box-shadow: 0 14px 28px rgba(37, 99, 235, 0.3);
        }

        .login-button span {
            font-size: 22px;
        }

        /* TEKS BAWAH */

        .bottom-text {
            margin-top: 34px;
            color: var(--muted-color);
            font-size: 13px;
            line-height: 1.8;
            text-align: center;
        }

        .bottom-text a {
            color: var(--blue);
            font-weight: 700;
            text-decoration: none;
        }

        .bottom-text a:hover {
            text-decoration: underline;
        }

        .copyright {
            margin-top: 45px;
            color: var(--muted-color);
            font-size: 11px;
            text-align: center;
            opacity: 0.7;
        }

        /* RESPONSIVE */

        @media (max-width: 1200px) {

            .left-section {
                padding: 50px;
            }

            .left-content h1 {
                font-size: 36px;
            }

            .warehouse-illustration {
                display: none;
            }

        }

        @media (max-width: 900px) {

            .left-section {
                display: none;
            }

            .right-section {
                width: 100%;
                min-height: 100vh;
                padding: 35px;
                background: var(--right-bg);
            }

        }

        @media (max-width: 480px) {

            .right-section {
                padding: 25px 20px;
            }

            .login-header h2 {
                font-size: 28px;
            }

            .remember-row {
                align-items: flex-start;
                flex-direction: column;
            }

            .forgot-link {
                margin-left: 27px;
            }

        }

    </style>

</head>

<body>

    <div class="login-wrapper">

        <!-- BAGIAN KIRI -->
        <section class="left-section">

            <div class="brand">

                <div class="brand-icon">

                    <?php if($appSetting && $appSetting->app_logo): ?>

                        <img
                            src="<?php echo e(asset('storage/' . $appSetting->app_logo)); ?>"
                            alt="<?php echo e($appName); ?>"
                        >

                    <?php else: ?>

                        S

                    <?php endif; ?>

                </div>

                <div>

                    <div class="brand-name">

                        <?php if($ifyPosition !== false): ?>

                            <?php echo e(substr($appName, 0, $ifyPosition)); ?><span><?php echo e(substr($appName, $ifyPosition)); ?></span>

                        <?php else: ?>

                            <?php echo e($appName); ?>


                        <?php endif; ?>

                    </div>

                    <div class="brand-subtitle">
                        <?php echo e($appDescription); ?>

                    </div>

                </div>

            </div>


            <div class="left-content">

                <h1>
                    Solusi Modern untuk
                    <span>Manajemen Stok</span>
                    yang Lebih Efisien
                </h1>

                <p>
                    <?php echo e($appName); ?> membantu Anda mengelola data barang,
                    transaksi, dan laporan stok dengan mudah,
                    akurat, dan terintegrasi.
                </p>


                <div class="feature-list">

                    <div class="feature-item">

                        <div class="feature-icon">
                            ▣
                        </div>

                        <div class="feature-text">

                            <h3>
                                Kelola Produk
                            </h3>

                            <p>
                                Atur data barang dengan mudah
                            </p>

                        </div>

                    </div>


                    <div class="feature-item">

                        <div class="feature-icon">
                            ⇄
                        </div>

                        <div class="feature-text">

                            <h3>
                                Pantau Transaksi
                            </h3>

                            <p>
                                Monitor barang masuk dan keluar
                            </p>

                        </div>

                    </div>


                    <div class="feature-item">

                        <div class="feature-icon">
                            ▥
                        </div>

                        <div class="feature-text">

                            <h3>
                                Laporan Lengkap
                            </h3>

                            <p>
                                Data akurat dan siap digunakan
                            </p>

                        </div>

                    </div>


                    <div class="feature-item">

                        <div class="feature-icon">
                            ♢
                        </div>

                        <div class="feature-text">

                            <h3>
                                Akses Aman
                            </h3>

                            <p>
                                Data terlindungi dengan baik
                            </p>

                        </div>

                    </div>

                </div>

            </div>


            <!-- ILUSTRASI GUDANG -->
            <div class="warehouse-illustration">

                <div class="warehouse-shelf">

                    <div class="shelf-line one"></div>

                    <div class="shelf-line two"></div>

                    <div class="box one"></div>

                    <div class="box two"></div>

                    <div class="box three"></div>

                </div>

            </div>


            <div class="left-footer">

                <?php echo e($appName); ?> — Manajemen Stok, Lebih Mudah, Lebih Baik.

            </div>

        </section>


        <!-- BAGIAN KANAN -->
        <section class="right-section">

            <div class="login-container">

                <div class="login-header">

                    <div class="login-logo">

                        <?php if($appSetting && $appSetting->app_logo): ?>

                            <img
                                src="<?php echo e(asset('storage/' . $appSetting->app_logo)); ?>"
                                alt="<?php echo e($appName); ?>"
                            >

                        <?php else: ?>

                            S

                        <?php endif; ?>

                    </div>

                    <h2>
                        Selamat <span>Datang Kembali</span>
                    </h2>

                    <p>
                        Masuk ke akun Anda untuk melanjutkan
                    </p>

                </div>


                <?php if($errors->any()): ?>

                    <div class="error-message">

                        <strong>
                            Terjadi kesalahan:
                        </strong>

                        <ul style="margin: 8px 0 0 18px;">

                            <?php $__currentLoopData = $errors->all(); $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $error): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>

                                <li>
                                    <?php echo e($error); ?>

                                </li>

                            <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>

                        </ul>

                    </div>

                <?php endif; ?>


                <form
                    method="POST"
                    action="<?php echo e(route('login')); ?>"
                >

                    <?php echo csrf_field(); ?>


                    <!-- EMAIL -->
                    <div class="form-group">

                        <label for="email">
                            Email
                        </label>

                        <div class="input-wrapper">

                            <span class="input-icon">
                                ✉
                            </span>

                            <input
                                id="email"
                                type="email"
                                name="email"
                                class="form-control"
                                value="<?php echo e(old('email')); ?>"
                                placeholder="Masukkan email Anda"
                                required
                                autofocus
                                autocomplete="username"
                            >

                        </div>

                    </div>


                    <!-- PASSWORD -->
                    <div class="form-group">

                        <label for="password">
                            Password
                        </label>

                        <div class="input-wrapper">

                            <span class="input-icon">
                                ♙
                            </span>

                            <input
                                id="password"
                                type="password"
                                name="password"
                                class="form-control"
                                placeholder="Masukkan password Anda"
                                required
                                autocomplete="current-password"
                            >

                            <button
                                type="button"
                                class="password-toggle"
                                id="passwordToggle"
                                onclick="togglePassword()"
                                aria-label="Tampilkan password"
                            >
                                ◉
                            </button>

                        </div>

                    </div>


                    <!-- REMEMBER ME DAN LUPA PASSWORD -->
                    <div class="remember-row">

                        <label class="remember-label">

                            <input
                                type="checkbox"
                                name="remember"
                                <?php echo e(old('remember') ? 'checked' : ''); ?>

                            >

                            Ingat saya

                        </label>


                        <?php if(Route::has('password.request')): ?>

                            <a
                                href="<?php echo e(route('password.request')); ?>"
                                class="forgot-link"
                            >
                                Lupa kata sandi?
                            </a>

                        <?php endif; ?>

                    </div>


                    <!-- TOMBOL MASUK -->
                    <button
                        type="submit"
                        class="login-button"
                    >

                        Masuk

                        <span>
                            →
                        </span>

                    </button>

                </form>


                <!-- KONTAK ADMINISTRATOR -->
                <div class="bottom-text">

                    Belum memiliki akun?

                    <br>

                    Silakan hubungi

                    <a href="mailto:admin@stockify.com">
                        administrator
                    </a>

                    untuk mendapatkan akses.

                </div>


                <div class="copyright">

                    © <?php echo e(date('Y')); ?> <?php echo e($appName); ?>. All rights reserved.

                </div>

            </div>

        </section>

    </div>


    <script>

        function togglePassword() {

            const passwordInput =
                document.getElementById('password');

            const passwordToggle =
                document.getElementById('passwordToggle');


            if (passwordInput.type === 'password') {

                passwordInput.type = 'text';

                passwordToggle.textContent = '◌';

                passwordToggle.setAttribute(
                    'aria-label',
                    'Sembunyikan password'
                );

            } else {

                passwordInput.type = 'password';

                passwordToggle.textContent = '◉';

                passwordToggle.setAttribute(
                    'aria-label',
                    'Tampilkan password'
                );

            }

        }

    </script>

</body>

</html><?php /**PATH C:\xampp\htdocs\stockify\resources\views/auth/login.blade.php ENDPATH**/ ?>