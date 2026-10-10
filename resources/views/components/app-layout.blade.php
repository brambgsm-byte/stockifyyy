<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">

<head>
    <meta charset="utf-8">

    <meta name="viewport" content="width=device-width, initial-scale=1">

    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>
        @yield('title', 'Stockify') - Stockify
    </title>

    {{-- Font --}}
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>

    <link
        href="https://fonts.googleapis.com/css2?family=Inter:wght@400;500;600;700;800&display=swap"
        rel="stylesheet"
    >

    {{-- Vite --}}
    @vite(['resources/css/app.css', 'resources/js/app.js'])

    <style>
        * {
            box-sizing: border-box;
        }

        body {
            font-family: 'Inter', sans-serif;
        }
    </style>

    @stack('styles')
</head>

<body class="min-h-screen bg-slate-50 text-gray-900">

    {{-- SIDEBAR --}}
    <aside class="fixed left-0 top-0 z-40 flex h-screen w-72 flex-col border-r border-gray-200 bg-white">

        {{-- LOGO --}}
        <div class="flex h-24 items-center gap-3 border-b border-gray-200 px-7">

            <div class="flex h-11 w-11 items-center justify-center rounded-xl bg-blue-600 text-2xl font-bold text-white">
                S
            </div>

            <div>
                <h1 class="text-xl font-bold text-gray-900">
                    Stockify
                </h1>

                <p class="text-xs text-gray-500">
                    Sistem Manajemen Stok
                </p>
            </div>

        </div>

        {{-- MENU --}}
        <nav class="flex-1 space-y-2 overflow-y-auto px-4 py-6">

            {{-- Dashboard --}}
            <a
                href="{{ url('/dashboard') }}"
                class="{{ request()->is('dashboard') || request()->is('admin/dashboard') || request()->is('manager/dashboard') || request()->is('staff/dashboard') ? 'bg-blue-50 font-semibold text-blue-600' : 'text-gray-600 hover:bg-gray-100 hover:text-blue-600' }} flex items-center gap-4 rounded-xl px-4 py-3 text-sm transition"
            >
                <svg class="h-5 w-5" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round"
                        d="M3 12l9-9 9 9M5 10v10h14V10M9 20v-6h6v6"/>
                </svg>

                Dashboard
            </a>

            {{-- Produk --}}
            <a
                href="{{ url('/products') }}"
                class="{{ request()->is('products*') ? 'bg-blue-50 font-semibold text-blue-600' : 'text-gray-600 hover:bg-gray-100 hover:text-blue-600' }} flex items-center gap-4 rounded-xl px-4 py-3 text-sm transition"
            >
                <svg class="h-5 w-5" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round"
                        d="M20 7l-8-4-8 4m16 0v10l-8 4-8-4V7m16 0l-8 4-8-4m8 4v10"/>
                </svg>

                Produk
            </a>

            {{-- Kategori --}}
            <a
                href="{{ url('/categories') }}"
                class="{{ request()->is('categories*') ? 'bg-blue-50 font-semibold text-blue-600' : 'text-gray-600 hover:bg-gray-100 hover:text-blue-600' }} flex items-center gap-4 rounded-xl px-4 py-3 text-sm transition"
            >
                <svg class="h-5 w-5" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round"
                        d="M4 6h16M4 12h16M4 18h16"/>
                </svg>

                Kategori
            </a>

            {{-- Supplier --}}
            <a
                href="{{ url('/suppliers') }}"
                class="{{ request()->is('suppliers*') ? 'bg-blue-50 font-semibold text-blue-600' : 'text-gray-600 hover:bg-gray-100 hover:text-blue-600' }} flex items-center gap-4 rounded-xl px-4 py-3 text-sm transition"
            >
                <svg class="h-5 w-5" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round"
                        d="M3 21h18M5 21V9l7-5 7 5v12M9 21v-6h6v6"/>
                </svg>

                Supplier
            </a>

            {{-- Manajemen Stok --}}
            <a
                href="{{ url('/stock-management') }}"
                class="{{ request()->is('stock-management*') ? 'bg-blue-50 font-semibold text-blue-600' : 'text-gray-600 hover:bg-gray-100 hover:text-blue-600' }} flex items-center gap-4 rounded-xl px-4 py-3 text-sm transition"
            >
                <svg class="h-5 w-5" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round"
                        d="M4 6h16M4 12h16M4 18h16"/>
                </svg>

                Manajemen Stok
            </a>

            {{-- Transaksi --}}
            <a
                href="{{ url('/stock-transactions') }}"
                class="{{ request()->is('stock-transactions*') ? 'bg-blue-50 font-semibold text-blue-600' : 'text-gray-600 hover:bg-gray-100 hover:text-blue-600' }} flex items-center gap-4 rounded-xl px-4 py-3 text-sm transition"
            >
                <svg class="h-5 w-5" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24">
                    <rect width="16" height="18" x="4" y="3" rx="2"/>
                    <path stroke-linecap="round" stroke-linejoin="round"
                        d="M8 7h8M8 11h8M8 15h5"/>
                </svg>

                Transaksi
            </a>

            {{-- Laporan --}}
            <a
                href="{{ url('/reports') }}"
                class="{{ request()->is('reports*') ? 'bg-blue-50 font-semibold text-blue-600' : 'text-gray-600 hover:bg-gray-100 hover:text-blue-600' }} flex items-center gap-4 rounded-xl px-4 py-3 text-sm transition"
            >
                <svg class="h-5 w-5" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round"
                        d="M4 19V5M4 19h16M8 16v-5M12 16V8M16 16v-3"/>
                </svg>

                Laporan
            </a>

        </nav>

        {{-- INFORMASI USER --}}
        <div class="border-t border-gray-200 p-5">

            <div class="flex items-center gap-3">

                <div class="flex h-11 w-11 items-center justify-center rounded-full bg-gray-100 text-lg font-medium text-gray-600">
                    {{ strtoupper(substr(auth()->user()->name ?? 'A', 0, 1)) }}
                </div>

                <div class="min-w-0">

                    <p class="truncate text-sm font-semibold text-gray-900">
                        {{ auth()->user()->name ?? 'Admin Stockify' }}
                    </p>

                    <p class="text-xs capitalize text-gray-500">
                        {{ auth()->user()->role ?? 'Admin' }}
                    </p>

                </div>

            </div>

        </div>

    </aside>

    {{-- KONTEN UTAMA --}}
    <div class="ml-72 min-h-screen">

        {{-- HEADER --}}
        <header class="flex min-h-[88px] items-center justify-between border-b border-gray-200 bg-white px-8 py-5">

            <div>
                <p class="text-sm text-gray-500">
                    Sistem Manajemen Stok Barang
                </p>

                <h2 class="text-xl font-semibold text-gray-900">
                    @yield('page-title', 'Dashboard')
                </h2>
            </div>

            {{-- LOGOUT --}}
            @auth
                <form method="POST" action="{{ route('logout') }}">
                    @csrf

                    <button
                        type="submit"
                        class="rounded-xl bg-red-500 px-6 py-3 text-sm font-semibold text-white transition hover:bg-red-600 focus:outline-none focus:ring-4 focus:ring-red-200"
                    >
                        Keluar
                    </button>
                </form>
            @endauth

        </header>

        {{-- KONTEN HALAMAN --}}
        <main class="px-8 py-8">

            {{-- PESAN SUKSES --}}
            @if (session('success'))
                <div class="mb-6 rounded-xl border border-green-200 bg-green-50 px-5 py-4 text-sm font-medium text-green-700">
                    {{ session('success') }}
                </div>
            @endif

            {{-- PESAN ERROR --}}
            @if (session('error'))
                <div class="mb-6 rounded-xl border border-red-200 bg-red-50 px-5 py-4 text-sm font-medium text-red-700">
                    {{ session('error') }}
                </div>
            @endif

            {{-- ISI DARI @extends('layouts.app') --}}
            @yield('content')

        </main>

        {{-- FOOTER --}}
        <footer class="border-t border-gray-200 bg-white px-8 py-6">

            <p class="text-sm text-gray-500">
                © {{ date('Y') }} Stockify. All rights reserved.
            </p>

        </footer>

    </div>

    @stack('scripts')

</body>

</html>