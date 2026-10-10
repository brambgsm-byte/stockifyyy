@php
    use App\Models\Setting;

    $appSetting = Setting::find(1);

    $appName = $appSetting->app_name ?? 'Stockify';
    $appDescription = $appSetting->app_description ?? 'Sistem Manajemen Stok Barang';

    $ifyPosition = stripos($appName, 'ify');
@endphp

<!DOCTYPE html>
<html lang="id">

<head>

    <meta charset="UTF-8">

    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <title>Lupa Kata Sandi - {{ $appName }}</title>

    <link rel="preconnect" href="https://fonts.googleapis.com">

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

        .page-wrapper {
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
        .forgot-logo {
            display: flex;
            justify-content: center;
            align-items: center;
            background: var(--blue);
            color: #ffffff;
            font-weight: 800;
            box-shadow: 0 10px 25px rgba(37, 99, 235, 0.22);
        }

        .brand-icon {
            width: 64px;
            height: 64px;
            overflow: hidden;
            border-radius: 18px;
            font-size: 38px;
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
            max-width: 620px;
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
            max-width: 590px;
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
            width: 64px;
            height: 64px;
            flex-shrink: 0;
            border-radius: 17px;
            background: var(--feature-bg);
            color: var(--blue);
            font-size: 28px;
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

        /* ILUSTRASI RAK GUDANG */

        .warehouse {
            position: absolute;
            right: -20px;
            bottom: 0;
            z-index: 1;
            width: 340px;
            opacity: 0.75;
        }

        .warehouse-shelf {
            position: relative;
            width: 290px;
            height: 220px;
            margin-left: auto;
            border-right: 15px solid var(--shelf-color);
            border-bottom: 15px solid var(--shelf-color);
            border-left: 15px solid var(--shelf-color);
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

        .forgot-container {
            width: 100%;
            max-width: 505px;
        }

        /* HEADER */

        .forgot-header {
            margin-bottom: 40px;
            text-align: center;
        }

        .forgot-logo {
            width: 86px;
            height: 86px;
            margin: 0 auto 30px;
            overflow: hidden;
            border-radius: 22px;
            font-size: 50px;
        }

        .forgot-logo img {
            width: 100%;
            height: 100%;
            object-fit: contain;
            border-radius: inherit;
        }

        .forgot-header h2 {
            margin-bottom: 15px;
            color: var(--heading-color);
            font-size: 34px;
            font-weight: 800;
            letter-spacing: -1.2px;
        }

        .forgot-header h2 span {
            color: var(--blue);
        }

        .forgot-header p {
            color: var(--muted-color);
            font-size: 14px;
            line-height: 1.9;
        }

        /* PESAN */

        .status-message {
            margin-bottom: 22px;
            padding: 14px 16px;
            border: 1px solid #bbf7d0;
            border-radius: 10px;
            background: #f0fdf4;
            color: #15803d;
            font-size: 13px;
            line-height: 1.6;
        }

        .error-message {
            margin-bottom: 22px;
            padding: 14px 16px;
            border: 1px solid #fecaca;
            border-radius: 10px;
            background: #fef2f2;
            color: #dc2626;
            font-size: 13px;
            line-height: 1.6;
        }

        /* FORM */

        .form-group {
            margin-bottom: 26px;
        }

        .form-group label {
            display: block;
            margin-bottom: 11px;
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
            left: 20px;
            transform: translateY(-50%);
            color: var(--muted-color);
            font-size: 20px;
            pointer-events: none;
        }

        .form-control {
            width: 100%;
            height: 68px;
            padding: 0 22px 0 60px;
            border: 1px solid var(--input-border);
            border-radius: 15px;
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

        /* TOMBOL KIRIM */

        .submit-button {
            display: flex;
            justify-content: center;
            align-items: center;
            gap: 17px;
            width: 100%;
            height: 68px;
            border: none;
            border-radius: 15px;
            background: linear-gradient(
                135deg,
                #2563eb,
                #1d4ed8
            );
            color: #ffffff;
            font-size: 15px;
            font-weight: 700;
            cursor: pointer;
            box-shadow: 0 10px 25px rgba(37, 99, 235, 0.24);
            transition:
                transform 0.3s ease,
                box-shadow 0.3s ease;
        }

        .submit-button:hover {
            transform: translateY(-2px);
            box-shadow: 0 14px 30px rgba(37, 99, 235, 0.32);
        }

        .submit-button span {
            font-size: 23px;
        }

        /* KEMBALI KE LOGIN */

        .back-login {
            display: block;
            margin-top: 30px;
            color: var(--blue);
            font-size: 13px;
            font-weight: 600;
            text-align: center;
            text-decoration: none;
        }

        .back-login:hover {
            text-decoration: underline;
        }

        .copyright {
            margin-top: 55px;
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

            .warehouse {
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

            .forgot-header h2 {
                font-size: 28px;
            }

        }

    </style>

</head>

<body>

    <div class="page-wrapper">

        <!-- BAGIAN KIRI -->
        <section class="left-section">

            <div class="brand">

                <div class="brand-icon">

                    @if ($appSetting && $appSetting->app_logo)

                        <img
                            src="{{ asset('storage/' . $appSetting->app_logo) }}"
                            alt="{{ $appName }}"
                        >

                    @else

                        S

                    @endif

                </div>


                <div>

                    <div class="brand-name">

                        @if ($ifyPosition !== false)

                            {{ substr($appName, 0, $ifyPosition) }}<span>{{ substr($appName, $ifyPosition) }}</span>

                        @else

                            {{ $appName }}

                        @endif

                    </div>


                    <div class="brand-subtitle">
                        {{ $appDescription }}
                    </div>

                </div>

            </div>


            <div class="left-content">

                <h1>
                    Kelola Stok dengan
                    <span>Lebih Mudah</span>
                    dan Terorganisir
                </h1>

                <p>
                    Lupa kata sandi bukan masalah. Pulihkan akses
                    akun {{ $appName }} Anda dengan cepat dan aman.
                </p>


                <div class="feature-list">

                    <div class="feature-item">

                        <div class="feature-icon">
                            ✓
                        </div>

                        <div class="feature-text">

                            <h3>
                                Proses Pemulihan Mudah
                            </h3>

                            <p>
                                Atur ulang kata sandi dengan praktis
                            </p>

                        </div>

                    </div>


                    <div class="feature-item">

                        <div class="feature-icon">
                            ✉
                        </div>

                        <div class="feature-text">

                            <h3>
                                Link Melalui Email
                            </h3>

                            <p>
                                Link pemulihan dikirim ke email Anda
                            </p>

                        </div>

                    </div>


                    <div class="feature-item">

                        <div class="feature-icon">
                            ♢
                        </div>

                        <div class="feature-text">

                            <h3>
                                Keamanan Terjamin
                            </h3>

                            <p>
                                Data akun Anda tetap terlindungi
                            </p>

                        </div>

                    </div>

                </div>

            </div>


            <!-- ILUSTRASI GUDANG -->
            <div class="warehouse">

                <div class="warehouse-shelf">

                    <div class="shelf-line one"></div>

                    <div class="shelf-line two"></div>

                    <div class="box one"></div>

                    <div class="box two"></div>

                    <div class="box three"></div>

                </div>

            </div>


            <div class="left-footer">
                {{ $appName }} — Manajemen Stok, Lebih Mudah, Lebih Baik.
            </div>

        </section>


        <!-- BAGIAN KANAN -->
        <section class="right-section">

            <div class="forgot-container">

                <!-- HEADER -->
                <div class="forgot-header">

                    <div class="forgot-logo">

                        @if ($appSetting && $appSetting->app_logo)

                            <img
                                src="{{ asset('storage/' . $appSetting->app_logo) }}"
                                alt="{{ $appName }}"
                            >

                        @else

                            S

                        @endif

                    </div>


                    <h2>
                        Lupa <span>Kata Sandi?</span>
                    </h2>


                    <p>
                        Jangan khawatir. Masukkan email Anda
                        <br>
                        dan kami akan mengirimkan link pemulihan.
                    </p>

                </div>


                <!-- PESAN STATUS -->
                @if (session('status'))

                    <div class="status-message">
                        {{ session('status') }}
                    </div>

                @endif


                <!-- PESAN ERROR -->
                @if ($errors->any())

                    <div class="error-message">

                        <strong>
                            Terjadi kesalahan:
                        </strong>

                        <ul style="margin: 8px 0 0 18px;">

                            @foreach ($errors->all() as $error)

                                <li>
                                    {{ $error }}
                                </li>

                            @endforeach

                        </ul>

                    </div>

                @endif


                <!-- FORM RESET PASSWORD -->
                <form
                    method="POST"
                    action="{{ route('password.email') }}"
                >

                    @csrf


                    <div class="form-group">

                        <label for="email">
                            Alamat Email
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
                                value="{{ old('email') }}"
                                placeholder="Masukkan email Anda"
                                required
                                autofocus
                                autocomplete="email"
                            >

                        </div>

                    </div>


                    <button
                        type="submit"
                        class="submit-button"
                    >

                        Kirim Link Pemulihan

                        <span>
                            →
                        </span>

                    </button>

                </form>


                <!-- KEMBALI KE LOGIN -->
                <a
                    href="{{ route('login') }}"
                    class="back-login"
                >
                    ← Kembali ke halaman login
                </a>


                <div class="copyright">
                    © {{ date('Y') }} {{ $appName }}. All rights reserved.
                </div>

            </div>

        </section>

    </div>

</body>

</html>