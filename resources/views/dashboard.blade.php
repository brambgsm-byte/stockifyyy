@extends('layouts.app')

@section('title', 'Dashboard')
@section('page-title', 'Dashboard')

@section('content')

@if (auth()->user()->role === 'staff')

    {{-- =========================================================
        DASHBOARD STAFF
    ========================================================== --}}

    <div class="mx-auto w-full max-w-7xl space-y-6 px-4 py-6 sm:px-6 lg:px-8">

        {{-- HEADER DASHBOARD STAFF --}}
        <div class="flex flex-col justify-between gap-4 sm:flex-row sm:items-center">

            <div>
                <p class="text-sm text-slate-500">
                    Dashboard / Staff Gudang
                </p>

                <h1 class="mt-1 text-2xl font-bold text-slate-900">
                    Dashboard Staff Gudang
                </h1>

                <p class="mt-1 text-sm text-slate-500">
                    Daftar tugas barang yang perlu diperiksa dan disiapkan.
                </p>
            </div>

        </div>


        {{-- =====================================================
            RINGKASAN TUGAS STAFF
        ====================================================== --}}

        <div class="grid grid-cols-1 gap-5 md:grid-cols-2">

            {{-- BARANG MASUK --}}
            <div class="rounded-xl border border-slate-200 bg-white p-6 shadow-sm">

                <div class="flex items-start justify-between">

                    <div>

                        <p class="text-sm font-medium text-slate-500">
                            Barang Masuk
                        </p>

                        <h2 class="mt-4 text-3xl font-bold text-slate-900">
                            {{ ($pendingStockIn ?? collect())->count() }}
                        </h2>

                        <p class="mt-2 text-sm text-slate-500">
                            Perlu diperiksa
                        </p>

                    </div>

                    <div class="flex h-14 w-14 items-center justify-center rounded-xl bg-green-100 text-green-600">

                        <svg
                            class="h-7 w-7"
                            fill="none"
                            stroke="currentColor"
                            viewBox="0 0 24 24"
                        >
                            <path
                                stroke-linecap="round"
                                stroke-linejoin="round"
                                stroke-width="2"
                                d="M12 4v16m8-8l-8 8-8-8"
                            />
                        </svg>

                    </div>

                </div>

            </div>


            {{-- BARANG KELUAR --}}
            <div class="rounded-xl border border-slate-200 bg-white p-6 shadow-sm">

                <div class="flex items-start justify-between">

                    <div>

                        <p class="text-sm font-medium text-slate-500">
                            Barang Keluar
                        </p>

                        <h2 class="mt-4 text-3xl font-bold text-slate-900">
                            {{ ($pendingStockOut ?? collect())->count() }}
                        </h2>

                        <p class="mt-2 text-sm text-slate-500">
                            Perlu disiapkan
                        </p>

                    </div>

                    <div class="flex h-14 w-14 items-center justify-center rounded-xl bg-orange-100 text-orange-600">

                        <svg
                            class="h-7 w-7"
                            fill="none"
                            stroke="currentColor"
                            viewBox="0 0 24 24"
                        >
                            <path
                                stroke-linecap="round"
                                stroke-linejoin="round"
                                stroke-width="2"
                                d="M12 20V4m-8 8l8-8 8 8"
                            />
                        </svg>

                    </div>

                </div>

            </div>

        </div>


        {{-- =====================================================
            BARANG MASUK YANG PERLU DIPERIKSA
        ====================================================== --}}

        <div class="overflow-hidden rounded-xl border border-slate-200 bg-white shadow-sm">

            <div class="flex flex-col justify-between gap-3 border-b border-slate-200 px-6 py-5 sm:flex-row sm:items-center">

                <div>

                    <h2 class="text-lg font-bold text-slate-900">
                        Barang Masuk yang Perlu Diperiksa
                    </h2>

                    <p class="mt-1 text-sm text-slate-500">
                        Daftar barang masuk yang masih menunggu konfirmasi.
                    </p>

                </div>

                <span
                    class="inline-flex w-fit rounded-full bg-yellow-100 px-4 py-2 text-sm font-semibold text-yellow-700"
                >
                    {{ ($pendingStockIn ?? collect())->count() }} Menunggu
                </span>

            </div>


            <div class="overflow-x-auto">

                <table class="w-full text-left text-sm text-slate-600">

                    <thead class="bg-slate-50 text-xs uppercase text-slate-600">

                        <tr>

                            <th class="whitespace-nowrap px-6 py-4">
                                No
                            </th>

                            <th class="whitespace-nowrap px-6 py-4">
                                Tanggal
                            </th>

                            <th class="whitespace-nowrap px-6 py-4">
                                Produk
                            </th>

                            <th class="whitespace-nowrap px-6 py-4 text-center">
                                Jumlah
                            </th>

                            <th class="whitespace-nowrap px-6 py-4">
                                Keterangan
                            </th>

                            <th class="whitespace-nowrap px-6 py-4 text-center">
                                Aksi
                            </th>

                        </tr>

                    </thead>


                    <tbody>

                        @forelse (($pendingStockIn ?? collect()) as $index => $transaction)

                            <tr class="border-b border-slate-100 bg-white hover:bg-slate-50">

                                {{-- No --}}
                                <td class="px-6 py-5">
                                    {{ $index + 1 }}
                                </td>

                                {{-- Tanggal --}}
                                <td class="whitespace-nowrap px-6 py-5">
                                    {{ $transaction->transaction_date?->format('d-m-Y') ?? '-' }}
                                </td>

                                {{-- Produk --}}
                                <td class="px-6 py-5">

                                    <div class="font-semibold text-slate-900">
                                        {{ $transaction->product?->name ?? '-' }}
                                    </div>

                                    @if ($transaction->product?->code)

                                        <div class="mt-1 text-xs text-slate-500">
                                            {{ $transaction->product->code }}
                                        </div>

                                    @endif

                                </td>

                                {{-- Jumlah --}}
                                <td class="px-6 py-5 text-center font-semibold text-slate-900">
                                    {{ number_format($transaction->quantity, 0, ',', '.') }}
                                </td>

                                {{-- Keterangan --}}
                                <td class="px-6 py-5">
                                    {{ $transaction->description ?: '-' }}
                                </td>

                                {{-- Aksi --}}
                                <td class="px-6 py-5 text-center">

                                    <form
                                        action="{{ route('stock-transactions.confirm', $transaction->id) }}"
                                        method="POST"
                                        onsubmit="return confirm('Apakah Anda yakin ingin mengonfirmasi barang masuk ini?');"
                                    >

                                        @csrf

                                        <button
                                            type="submit"
                                            style="background-color:#16a34a !important;color:#ffffff !important;border:none !important;"
                                            class="inline-flex min-w-[110px] items-center justify-center rounded-lg px-4 py-2 text-sm font-semibold shadow-sm transition hover:opacity-90"
                                        >
                                            Konfirmasi
                                        </button>

                                    </form>

                                </td>

                            </tr>

                        @empty

                            <tr>

                                <td
                                    colspan="6"
                                    class="px-6 py-12 text-center"
                                >

                                    <div class="mx-auto flex h-12 w-12 items-center justify-center rounded-full bg-green-100 text-green-600">

                                        <svg
                                            class="h-6 w-6"
                                            fill="none"
                                            stroke="currentColor"
                                            viewBox="0 0 24 24"
                                        >
                                            <path
                                                stroke-linecap="round"
                                                stroke-linejoin="round"
                                                stroke-width="2"
                                                d="M5 13l4 4L19 7"
                                            />
                                        </svg>

                                    </div>

                                    <p class="mt-3 text-sm font-semibold text-slate-700">
                                        Tidak ada barang masuk yang perlu diperiksa.
                                    </p>

                                    <p class="mt-1 text-sm text-slate-500">
                                        Semua barang masuk sudah dikonfirmasi.
                                    </p>

                                </td>

                            </tr>

                        @endforelse

                    </tbody>

                </table>

            </div>

        </div>


        {{-- =====================================================
            BARANG KELUAR YANG PERLU DISIAPKAN
        ====================================================== --}}

        <div class="overflow-hidden rounded-xl border border-slate-200 bg-white shadow-sm">

            <div class="flex flex-col justify-between gap-3 border-b border-slate-200 px-6 py-5 sm:flex-row sm:items-center">

                <div>

                    <h2 class="text-lg font-bold text-slate-900">
                        Barang Keluar yang Perlu Disiapkan
                    </h2>

                    <p class="mt-1 text-sm text-slate-500">
                        Daftar barang keluar yang masih menunggu konfirmasi.
                    </p>

                </div>

                <span
                    class="inline-flex w-fit rounded-full bg-yellow-100 px-4 py-2 text-sm font-semibold text-yellow-700"
                >
                    {{ ($pendingStockOut ?? collect())->count() }} Menunggu
                </span>

            </div>


            <div class="overflow-x-auto">

                <table class="w-full text-left text-sm text-slate-600">

                    <thead class="bg-slate-50 text-xs uppercase text-slate-600">

                        <tr>

                            <th class="whitespace-nowrap px-6 py-4">
                                No
                            </th>

                            <th class="whitespace-nowrap px-6 py-4">
                                Tanggal
                            </th>

                            <th class="whitespace-nowrap px-6 py-4">
                                Produk
                            </th>

                            <th class="whitespace-nowrap px-6 py-4 text-center">
                                Jumlah
                            </th>

                            <th class="whitespace-nowrap px-6 py-4">
                                Keterangan
                            </th>

                            <th class="whitespace-nowrap px-6 py-4 text-center">
                                Aksi
                            </th>

                        </tr>

                    </thead>


                    <tbody>

                        @forelse (($pendingStockOut ?? collect()) as $index => $transaction)

                            <tr class="border-b border-slate-100 bg-white hover:bg-slate-50">

                                {{-- No --}}
                                <td class="px-6 py-5">
                                    {{ $index + 1 }}
                                </td>

                                {{-- Tanggal --}}
                                <td class="whitespace-nowrap px-6 py-5">
                                    {{ $transaction->transaction_date?->format('d-m-Y') ?? '-' }}
                                </td>

                                {{-- Produk --}}
                                <td class="px-6 py-5">

                                    <div class="font-semibold text-slate-900">
                                        {{ $transaction->product?->name ?? '-' }}
                                    </div>

                                    @if ($transaction->product?->code)

                                        <div class="mt-1 text-xs text-slate-500">
                                            {{ $transaction->product->code }}
                                        </div>

                                    @endif

                                </td>

                                {{-- Jumlah --}}
                                <td class="px-6 py-5 text-center font-semibold text-slate-900">
                                    {{ number_format($transaction->quantity, 0, ',', '.') }}
                                </td>

                                {{-- Keterangan --}}
                                <td class="px-6 py-5">
                                    {{ $transaction->description ?: '-' }}
                                </td>

                                {{-- Aksi --}}
                                <td class="px-6 py-5 text-center">

                                    <form
                                        action="{{ route('stock-transactions.confirm', $transaction->id) }}"
                                        method="POST"
                                        onsubmit="return confirm('Apakah Anda yakin ingin mengonfirmasi barang keluar ini?');"
                                    >

                                        @csrf

                                        <button
                                            type="submit"
                                            style="background-color:#16a34a !important;color:#ffffff !important;border:none !important;"
                                            class="inline-flex min-w-[110px] items-center justify-center rounded-lg px-4 py-2 text-sm font-semibold shadow-sm transition hover:opacity-90"
                                        >
                                            Konfirmasi
                                        </button>

                                    </form>

                                </td>

                            </tr>

                        @empty

                            <tr>

                                <td
                                    colspan="6"
                                    class="px-6 py-12 text-center"
                                >

                                    <div class="mx-auto flex h-12 w-12 items-center justify-center rounded-full bg-green-100 text-green-600">

                                        <svg
                                            class="h-6 w-6"
                                            fill="none"
                                            stroke="currentColor"
                                            viewBox="0 0 24 24"
                                        >
                                            <path
                                                stroke-linecap="round"
                                                stroke-linejoin="round"
                                                stroke-width="2"
                                                d="M5 13l4 4L19 7"
                                            />
                                        </svg>

                                    </div>

                                    <p class="mt-3 text-sm font-semibold text-slate-700">
                                        Tidak ada barang keluar yang perlu disiapkan.
                                    </p>

                                    <p class="mt-1 text-sm text-slate-500">
                                        Semua barang keluar sudah dikonfirmasi.
                                    </p>

                                </td>

                            </tr>

                        @endforelse

                    </tbody>

                </table>

            </div>

        </div>

    </div>


@else

    {{-- =========================================================
        DASHBOARD ADMIN & MANAGER
        DASHBOARD LAMA
    ========================================================== --}}

    <div class="mx-auto w-full max-w-7xl space-y-6 px-4 py-6 sm:px-6 lg:px-8">

        {{-- HEADER DASHBOARD --}}
        <div class="flex flex-col justify-between gap-4 sm:flex-row sm:items-center">

            <div>

                <p class="text-sm text-slate-500">
                    Dashboard / Ringkasan
                </p>

                <h1 class="mt-1 text-2xl font-bold text-slate-900">
                    Dashboard
                </h1>

                <p class="mt-1 text-sm text-slate-500">
                    Selamat datang di sistem manajemen stok Stockify.
                </p>

            </div>

            @if (Route::has('stock-management.index'))

                <a
                    href="{{ route('stock-management.index') }}"
                    class="inline-flex items-center justify-center gap-2 rounded-lg bg-blue-600 px-4 py-3 text-sm font-semibold text-white shadow-sm transition hover:bg-blue-700"
                >

                    <svg
                        class="h-5 w-5"
                        fill="none"
                        stroke="currentColor"
                        viewBox="0 0 24 24"
                    >
                        <path
                            stroke-linecap="round"
                            stroke-linejoin="round"
                            stroke-width="2"
                            d="M12 4v16m8-8H4"
                        />
                    </svg>

                    Manajemen Stok

                </a>

            @endif

        </div>


        {{-- PERINGATAN STOK MENIPIS --}}
        @if (($lowStockProducts ?? collect())->count() > 0)

            <div class="rounded-xl border border-red-200 bg-red-50 p-5">

                <div class="flex items-start gap-4">

                    <div class="flex h-11 w-11 shrink-0 items-center justify-center rounded-full bg-red-100 text-red-600">

                        <svg
                            class="h-6 w-6"
                            fill="none"
                            stroke="currentColor"
                            viewBox="0 0 24 24"
                        >
                            <path
                                stroke-linecap="round"
                                stroke-linejoin="round"
                                stroke-width="2"
                                d="M12 9v3m0 4h.01M10.3 3.8L2.7 17a2 2 0 001.7 3h15.2a2 2 0 001.7-3L13.7 3.8a2 2 0 00-3.4 0z"
                            />
                        </svg>

                    </div>

                    <div class="flex-1">

                        <h3 class="text-base font-bold text-red-700">
                            Perhatian! Stok Menipis
                        </h3>

                        <p class="mt-1 text-sm text-red-600">
                            Terdapat
                            <strong>{{ $lowStockProducts->count() }}</strong>
                            produk yang stoknya berada di bawah batas minimum.
                        </p>

                        @if (Route::has('stock-management.index'))

                            <a
                                href="{{ route('stock-management.index') }}"
                                class="mt-3 inline-flex rounded-lg bg-red-600 px-4 py-2 text-sm font-semibold text-white transition hover:bg-red-700"
                            >
                                Periksa Stok
                            </a>

                        @endif

                    </div>

                </div>

            </div>

        @endif


        {{-- KARTU STATISTIK UTAMA --}}
        <div class="grid grid-cols-1 gap-5 md:grid-cols-2">

            {{-- TOTAL PRODUK --}}
            <div class="rounded-xl border border-slate-200 bg-white p-6 shadow-sm">

                <div class="flex items-start justify-between">

                    <div>

                        <p class="text-sm font-medium text-slate-500">
                            Total Produk
                        </p>

                        <h2 class="mt-4 text-3xl font-bold text-slate-900">
                            {{ number_format($totalProducts ?? 0, 0, ',', '.') }}
                        </h2>

                        <p class="mt-2 text-sm text-slate-500">
                            Produk yang terdaftar dalam sistem
                        </p>

                    </div>

                    <div class="flex h-14 w-14 items-center justify-center rounded-xl bg-blue-100 text-blue-600">

                        <svg
                            class="h-7 w-7"
                            fill="none"
                            stroke="currentColor"
                            viewBox="0 0 24 24"
                        >
                            <path
                                stroke-linecap="round"
                                stroke-linejoin="round"
                                stroke-width="2"
                                d="M20 7l-8-4-8 4m16 0v10l-8 4m8-14l-8 4m0 0L4 7m8 4v10"
                            />
                        </svg>

                    </div>

                </div>

            </div>


            {{-- TOTAL STOK --}}
            <div class="rounded-xl border border-slate-200 bg-white p-6 shadow-sm">

                <div class="flex items-start justify-between">

                    <div>

                        <p class="text-sm font-medium text-slate-500">
                            Total Stok
                        </p>

                        <h2 class="mt-4 text-3xl font-bold text-slate-900">
                            {{ number_format($totalStock ?? 0, 0, ',', '.') }}
                        </h2>

                        <p class="mt-2 text-sm text-slate-500">
                            Jumlah seluruh stok produk
                        </p>

                    </div>

                    <div class="flex h-14 w-14 items-center justify-center rounded-xl bg-purple-100 text-purple-600">

                        <svg
                            class="h-7 w-7"
                            fill="none"
                            stroke="currentColor"
                            viewBox="0 0 24 24"
                        >
                            <path
                                stroke-linecap="round"
                                stroke-linejoin="round"
                                stroke-width="2"
                                d="M4 7h16M6 7v13h12V7M9 7V4h6v3M8 11h8M8 15h8"
                            />
                        </svg>

                    </div>

                </div>

            </div>


            {{-- BARANG MASUK --}}
            <div class="rounded-xl border border-slate-200 bg-white p-6 shadow-sm">

                <div class="flex items-start justify-between">

                    <div>

                        <p class="text-sm font-medium text-slate-500">
                            Barang Masuk
                        </p>

                        <h2 class="mt-4 text-3xl font-bold text-slate-900">
                            {{ number_format($totalStockIn ?? 0, 0, ',', '.') }}
                        </h2>

                        <p class="mt-2 text-sm text-slate-500">
                            Total kuantitas barang masuk
                        </p>

                    </div>

                    <div class="flex h-14 w-14 items-center justify-center rounded-xl bg-green-100 text-green-600">

                        <svg
                            class="h-7 w-7"
                            fill="none"
                            stroke="currentColor"
                            viewBox="0 0 24 24"
                        >
                            <path
                                stroke-linecap="round"
                                stroke-linejoin="round"
                                stroke-width="2"
                                d="M12 4v16m8-8l-8 8-8-8"
                            />
                        </svg>

                    </div>

                </div>

            </div>


            {{-- BARANG KELUAR --}}
            <div class="rounded-xl border border-slate-200 bg-white p-6 shadow-sm">

                <div class="flex items-start justify-between">

                    <div>

                        <p class="text-sm font-medium text-slate-500">
                            Barang Keluar
                        </p>

                        <h2 class="mt-4 text-3xl font-bold text-slate-900">
                            {{ number_format($totalStockOut ?? 0, 0, ',', '.') }}
                        </h2>

                        <p class="mt-2 text-sm text-slate-500">
                            Total kuantitas barang keluar
                        </p>

                    </div>

                    <div class="flex h-14 w-14 items-center justify-center rounded-xl bg-orange-100 text-orange-600">

                        <svg
                            class="h-7 w-7"
                            fill="none"
                            stroke="currentColor"
                            viewBox="0 0 24 24"
                        >
                            <path
                                stroke-linecap="round"
                                stroke-linejoin="round"
                                stroke-width="2"
                                d="M12 20V4m-8 8l8-8 8 8"
                            />
                        </svg>

                    </div>

                </div>

            </div>

        </div>


        {{-- BARANG MASUK & KELUAR HARI INI --}}
        <div class="grid grid-cols-1 gap-5 md:grid-cols-2">

            {{-- BARANG MASUK HARI INI --}}
            <div class="rounded-xl border border-slate-200 bg-white p-6 shadow-sm">

                <div class="flex items-start justify-between">

                    <div>

                        <p class="text-sm font-medium text-slate-500">
                            Barang Masuk Hari Ini
                        </p>

                        <h2 class="mt-4 text-3xl font-bold text-slate-900">
                            {{ number_format($todayStockIn ?? 0, 0, ',', '.') }}
                        </h2>

                        <p class="mt-2 text-sm text-slate-500">
                            Total kuantitas barang masuk hari ini
                        </p>

                    </div>

                    <div class="flex h-14 w-14 items-center justify-center rounded-xl bg-green-100 text-green-600">

                        <svg
                            class="h-7 w-7"
                            fill="none"
                            stroke="currentColor"
                            viewBox="0 0 24 24"
                        >
                            <path
                                stroke-linecap="round"
                                stroke-linejoin="round"
                                stroke-width="2"
                                d="M12 4v16m8-8l-8 8-8-8"
                            />
                        </svg>

                    </div>

                </div>

            </div>


            {{-- BARANG KELUAR HARI INI --}}
            <div class="rounded-xl border border-slate-200 bg-white p-6 shadow-sm">

                <div class="flex items-start justify-between">

                    <div>

                        <p class="text-sm font-medium text-slate-500">
                            Barang Keluar Hari Ini
                        </p>

                        <h2 class="mt-4 text-3xl font-bold text-slate-900">
                            {{ number_format($todayStockOut ?? 0, 0, ',', '.') }}
                        </h2>

                        <p class="mt-2 text-sm text-slate-500">
                            Total kuantitas barang keluar hari ini
                        </p>

                    </div>

                    <div class="flex h-14 w-14 items-center justify-center rounded-xl bg-orange-100 text-orange-600">

                        <svg
                            class="h-7 w-7"
                            fill="none"
                            stroke="currentColor"
                            viewBox="0 0 24 24"
                        >
                            <path
                                stroke-linecap="round"
                                stroke-linejoin="round"
                                stroke-width="2"
                                d="M12 20V4m-8 8l8-8 8 8"
                            />
                        </svg>

                    </div>

                </div>

            </div>

        </div>


        {{-- STATISTIK TAMBAHAN --}}
        <div class="grid grid-cols-1 gap-5 md:grid-cols-3">

            {{-- TOTAL KATEGORI --}}
            <div class="rounded-xl border border-slate-200 bg-white p-5 shadow-sm">

                <div class="flex items-center justify-between">

                    <div>

                        <p class="text-sm text-slate-500">
                            Total Kategori
                        </p>

                        <h2 class="mt-3 text-2xl font-bold text-slate-900">
                            {{ number_format($totalCategories ?? 0, 0, ',', '.') }}
                        </h2>

                        <p class="mt-1 text-xs text-slate-500">
                            Kategori produk
                        </p>

                    </div>

                    <span class="text-2xl">
                        📁
                    </span>

                </div>

            </div>


            {{-- TOTAL SUPPLIER --}}
            <div class="rounded-xl border border-slate-200 bg-white p-5 shadow-sm">

                <div class="flex items-center justify-between">

                    <div>

                        <p class="text-sm text-slate-500">
                            Total Supplier
                        </p>

                        <h2 class="mt-3 text-2xl font-bold text-slate-900">
                            {{ number_format($totalSuppliers ?? 0, 0, ',', '.') }}
                        </h2>

                        <p class="mt-1 text-xs text-slate-500">
                            Supplier terdaftar
                        </p>

                    </div>

                    <span class="text-2xl">
                        🏢
                    </span>

                </div>

            </div>


            {{-- STOK MENIPIS --}}
            <div class="rounded-xl border border-slate-200 bg-white p-5 shadow-sm">

                <div class="flex items-center justify-between">

                    <div>

                        <p class="text-sm text-slate-500">
                            Produk Stok Menipis
                        </p>

                        <h2 class="mt-3 text-2xl font-bold text-red-600">
                            {{ ($lowStockProducts ?? collect())->count() }}
                        </h2>

                        <p class="mt-1 text-xs text-slate-500">
                            Perlu segera diperiksa
                        </p>

                    </div>

                    <span class="text-2xl">
                        ⚠️
                    </span>

                </div>

            </div>

        </div>


        {{-- GRAFIK TRANSAKSI --}}
        <div class="rounded-xl border border-slate-200 bg-white p-6 shadow-sm">

            <div class="mb-6">

                <h2 class="text-lg font-bold text-slate-900">
                    Grafik Transaksi Stok
                </h2>

                <p class="mt-1 text-sm text-slate-500">
                    Perbandingan barang masuk dan barang keluar selama enam bulan terakhir.
                </p>

            </div>

            <div class="relative h-80 w-full">
                <canvas id="stockTransactionChart"></canvas>
            </div>

        </div>


        {{-- AKTIVITAS DAN TRANSAKSI TERBARU --}}
        <div class="grid grid-cols-1 gap-6 xl:grid-cols-2">

            {{-- AKTIVITAS TERBARU --}}
            <div class="rounded-xl border border-slate-200 bg-white p-6 shadow-sm">

                <div class="border-b border-slate-200 pb-4">

                    <h2 class="text-lg font-bold text-slate-900">
                        Aktivitas Terbaru
                    </h2>

                    <p class="mt-1 text-sm text-slate-500">
                        Riwayat aktivitas pengguna terbaru.
                    </p>

                </div>

                <div class="divide-y divide-slate-100">

                    @forelse (($recentActivities ?? collect()) as $activity)

                        <div class="flex items-start gap-3 py-4">

                            <div class="flex h-10 w-10 shrink-0 items-center justify-center rounded-full bg-blue-50 text-blue-600">

                                <svg
                                    class="h-5 w-5"
                                    fill="none"
                                    stroke="currentColor"
                                    viewBox="0 0 24 24"
                                >
                                    <path
                                        stroke-linecap="round"
                                        stroke-linejoin="round"
                                        stroke-width="2"
                                        d="M12 8v4l3 2m6-2a9 9 0 11-18 0 9 9 0 0118 0z"
                                    />
                                </svg>

                            </div>

                            <div class="min-w-0 flex-1">

                                <p class="text-sm font-medium text-slate-800">
                                    {{ $activity->activity ?? 'Aktivitas sistem' }}
                                </p>

                                <p class="mt-1 text-xs text-slate-500">
                                    {{ $activity->user->name ?? 'Sistem' }}
                                    ·
                                    {{ $activity->created_at?->format('d/m/Y H:i') }}
                                </p>

                            </div>

                        </div>

                    @empty

                        <p class="py-8 text-center text-sm text-slate-500">
                            Belum ada aktivitas terbaru.
                        </p>

                    @endforelse

                </div>

            </div>


            {{-- TRANSAKSI TERBARU --}}
            <div class="rounded-xl border border-slate-200 bg-white p-6 shadow-sm">

                <div class="border-b border-slate-200 pb-4">

                    <h2 class="text-lg font-bold text-slate-900">
                        Transaksi Terbaru
                    </h2>

                    <p class="mt-1 text-sm text-slate-500">
                        Lima transaksi stok terakhir.
                    </p>

                </div>

                <div class="divide-y divide-slate-100">

                    @forelse (($recentTransactions ?? collect()) as $transaction)

                        <div class="flex items-center justify-between gap-3 py-4">

                            <div class="min-w-0">

                                <p class="truncate text-sm font-semibold text-slate-800">
                                    {{ $transaction->product->name ?? 'Produk tidak tersedia' }}
                                </p>

                                <p class="mt-1 text-xs text-slate-500">
                                    {{ $transaction->transaction_date
                                        ? \Carbon\Carbon::parse($transaction->transaction_date)->format('d/m/Y')
                                        : '-' }}
                                </p>

                            </div>

                            <div class="text-right">

                                <span
                                    class="inline-flex rounded-full px-3 py-1 text-xs font-semibold
                                    {{ $transaction->type === 'in'
                                        ? 'bg-green-100 text-green-700'
                                        : 'bg-red-100 text-red-700' }}"
                                >

                                    {{ $transaction->type === 'in' ? '+' : '-' }}
                                    {{ number_format($transaction->quantity ?? 0, 0, ',', '.') }}

                                </span>

                                <p class="mt-1 text-xs text-slate-500">
                                    {{ $transaction->type === 'in' ? 'Barang Masuk' : 'Barang Keluar' }}
                                </p>

                            </div>

                        </div>

                    @empty

                        <p class="py-8 text-center text-sm text-slate-500">
                            Belum ada transaksi terbaru.
                        </p>

                    @endforelse

                </div>

            </div>

        </div>

    </div>


@endif

@endsection


{{-- SCRIPT GRAFIK --}}
@push('scripts')

<script src="https://cdn.jsdelivr.net/npm/chart.js"></script>

<script>
    document.addEventListener('DOMContentLoaded', function () {

        const chartElement = document.getElementById('stockTransactionChart');

        if (!chartElement) {
            return;
        }

        new Chart(chartElement, {

            type: 'line',

            data: {

                labels: @json($monthlyLabels ?? []),

                datasets: [

                    {
                        label: 'Barang Masuk',
                        data: @json($monthlyStockIn ?? []),
                        borderColor: '#3B82F6',
                        backgroundColor: 'rgba(59, 130, 246, 0.12)',
                        borderWidth: 2,
                        tension: 0.4,
                        fill: true,
                        pointRadius: 4,
                        pointHoverRadius: 6
                    },

                    {
                        label: 'Barang Keluar',
                        data: @json($monthlyStockOut ?? []),
                        borderColor: '#EF4444',
                        backgroundColor: 'rgba(239, 68, 68, 0.12)',
                        borderWidth: 2,
                        tension: 0.4,
                        fill: true,
                        pointRadius: 4,
                        pointHoverRadius: 6
                    }

                ]

            },

            options: {

                responsive: true,

                maintainAspectRatio: false,

                interaction: {
                    intersect: false,
                    mode: 'index'
                },

                plugins: {

                    legend: {
                        position: 'top'
                    }

                },

                scales: {

                    y: {

                        beginAtZero: true,

                        ticks: {
                            precision: 0
                        }

                    }

                }

            }

        });

    });
</script>

@endpush