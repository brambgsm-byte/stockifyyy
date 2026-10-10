@php
    use App\Models\Setting;

    $appSetting = Setting::find(1);

    $appName = $appSetting->app_name ?? 'Stockify';
@endphp

<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <title>{{ $appName }}</title>

    @vite(['resources/css/app.css', 'resources/js/app.js'])

    @stack('styles')
</head>

<body class="min-h-screen bg-slate-50 text-slate-800 antialiased">

    <div class="flex min-h-screen">

        {{-- SIDEBAR --}}
        @include('layouts.sidebar')


        {{-- AREA UTAMA --}}
        <div class="flex min-w-0 flex-1 flex-col">

            {{-- HEADER --}}
            <header
                class="flex shrink-0 items-center justify-between border-b border-slate-200 bg-white px-8"
                style="
                    height: 90px;
                    min-height: 90px;
                    max-height: 90px;
                    box-sizing: border-box;
                "
            >

                {{-- JUDUL HALAMAN --}}
                <div class="flex h-full flex-col justify-center">

                    <p class="text-sm leading-5 text-slate-500">
                        {{ $appDescription ?? ($appSetting->app_description ?? 'Sistem Manajemen Stok Barang') }}
                    </p>

                    <h1 class="text-2xl font-bold leading-7 text-slate-900">
                        @yield('header-title', 'Dashboard')
                    </h1>

                </div>


                {{-- TOMBOL KELUAR --}}
                <div class="flex items-center gap-4">

                    <form method="POST" action="{{ route('logout') }}">

                        @csrf

                        <button
                            type="submit"
                            class="inline-flex h-12 items-center justify-center rounded-xl bg-red-500 px-7 text-sm font-semibold text-white transition hover:bg-red-600"
                        >
                            Keluar
                        </button>

                    </form>

                </div>

            </header>


            {{-- PESAN BERHASIL --}}
            @if (session('success'))

                <div class="mx-8 mt-6 rounded-xl border border-green-200 bg-green-50 px-5 py-4 text-sm text-green-700">
                    {{ session('success') }}
                </div>

            @endif


            {{-- VALIDATION ERROR --}}
            {{-- Dikecualikan dari halaman Import Produk agar tidak tampil dua kali --}}
            @if ($errors->any() && !request()->routeIs('products.import'))

                <div class="mx-8 mt-6 rounded-xl border border-red-200 bg-red-50 px-5 py-4 text-sm text-red-700">

                    <ul class="list-inside list-disc">

                        @foreach ($errors->all() as $error)

                            <li>
                                {{ $error }}
                            </li>

                        @endforeach

                    </ul>

                </div>

            @endif


            {{-- KONTEN UTAMA --}}
            <main class="min-w-0 flex-1 px-8 py-8">

                @yield('content')

            </main>


            {{-- FOOTER --}}
            <footer
                class="border-t border-slate-200 bg-white"
                style="
                    height: 72px !important;
                    min-height: 72px !important;
                    max-height: 72px !important;
                    padding: 0 !important;
                    margin: 0 !important;
                    display: flex !important;
                    align-items: center !important;
                    justify-content: center !important;
                    box-sizing: border-box !important;
                    flex-shrink: 0 !important;
                "
            >

                <span
                    class="text-center text-xs text-slate-500"
                    style="
                        display: block;
                        margin: 0 !important;
                        padding: 0 !important;
                        line-height: 1.5;
                    "
                >
                    &copy; {{ date('Y') }} {{ $appName }}. Sistem Manajemen Stok.
                </span>

            </footer>

        </div>

    </div>


    @stack('scripts')

</body>

</html>