@extends('layouts.app')

@section('title', 'Laporan')

@section('content')

<div class="space-y-8">

    {{-- Header --}}
    <div class="flex flex-col gap-4 sm:flex-row sm:items-center sm:justify-between">

        <div>
            <p class="mb-2 text-sm text-gray-500">
                Laporan / Ringkasan
            </p>

            <h1 class="text-3xl font-bold text-gray-900">
                Laporan
            </h1>

            <p class="mt-2 text-sm text-gray-500">
                Lihat laporan stok dan riwayat transaksi Stockify.
            </p>
        </div>

        {{-- Tombol Export --}}
        <div class="flex flex-wrap items-center gap-3">

            {{-- Tombol Export Excel --}}
            <a href="{{ route('reports.export.excel', request()->query()) }}"
               style="background-color: #16a34a !important; color: white !important;"
               class="inline-flex items-center gap-2 rounded-xl px-5 py-3 text-sm font-semibold shadow-sm transition hover:opacity-90">

                <svg xmlns="http://www.w3.org/2000/svg"
                     class="h-5 w-5"
                     fill="none"
                     viewBox="0 0 24 24"
                     stroke="currentColor"
                     stroke-width="2"
                     style="color: white !important;">

                    <path stroke-linecap="round"
                          stroke-linejoin="round"
                          d="M12 10v6m0 0l-3-3m3 3l3-3m2 8H7a2 2 0 01-2-2V5a2 2 0 012-2h7l5 5v11a2 2 0 01-2 2z" />

                </svg>

                <span style="color: white !important;">
                    Export Excel
                </span>

            </a>

            {{-- Tombol Export PDF --}}
            <a href="{{ route('reports.export.pdf', request()->query()) }}"
               style="background-color: #dc2626 !important; color: white !important;"
               class="inline-flex items-center gap-2 rounded-xl px-5 py-3 text-sm font-semibold shadow-sm transition hover:opacity-90">

                <svg xmlns="http://www.w3.org/2000/svg"
                     class="h-5 w-5"
                     fill="none"
                     viewBox="0 0 24 24"
                     stroke="currentColor"
                     stroke-width="2"
                     style="color: white !important;">

                    <path stroke-linecap="round"
                          stroke-linejoin="round"
                          d="M7 3h8l5 5v13H7a2 2 0 01-2-2V5a2 2 0 012-2z" />

                    <path stroke-linecap="round"
                          stroke-linejoin="round"
                          d="M15 3v6h6M8 13h8M8 17h6" />

                </svg>

                <span style="color: white !important;">
                    Export PDF
                </span>

            </a>

        </div>

    </div>


    {{-- Filter Laporan --}}
    <div class="rounded-xl border border-gray-200 bg-white p-6 shadow-sm">

        <div class="mb-5">

            <h2 class="text-lg font-semibold text-gray-900">
                Filter Laporan Transaksi
            </h2>

            <p class="mt-1 text-sm text-gray-500">
                Gunakan filter untuk menampilkan laporan sesuai kebutuhan.
            </p>

        </div>

        <form action="{{ route('reports.index') }}" method="GET">

            <div class="grid grid-cols-1 gap-5 md:grid-cols-5">

                {{-- Tanggal Mulai --}}
                <div>
                    <label for="start_date"
                           class="mb-2 block text-sm font-medium text-gray-700">
                        Tanggal Mulai
                    </label>

                    <input type="date"
                           id="start_date"
                           name="start_date"
                           value="{{ $startDate }}"
                           class="w-full rounded-lg border border-gray-300 bg-white px-3 py-2.5 text-sm text-gray-700 outline-none transition focus:border-blue-500 focus:ring-2 focus:ring-blue-200">
                </div>


                {{-- Tanggal Akhir --}}
                <div>
                    <label for="end_date"
                           class="mb-2 block text-sm font-medium text-gray-700">
                        Tanggal Akhir
                    </label>

                    <input type="date"
                           id="end_date"
                           name="end_date"
                           value="{{ $endDate }}"
                           class="w-full rounded-lg border border-gray-300 bg-white px-3 py-2.5 text-sm text-gray-700 outline-none transition focus:border-blue-500 focus:ring-2 focus:ring-blue-200">
                </div>


                {{-- Jenis Transaksi --}}
                <div>
                    <label for="type"
                           class="mb-2 block text-sm font-medium text-gray-700">
                        Jenis Transaksi
                    </label>

                    <select id="type"
                            name="type"
                            class="w-full rounded-lg border border-gray-300 bg-white px-3 py-2.5 text-sm text-gray-700 outline-none transition focus:border-blue-500 focus:ring-2 focus:ring-blue-200">

                        <option value="">
                            Semua Transaksi
                        </option>

                        <option value="in"
                            {{ $type === 'in' ? 'selected' : '' }}>
                            Barang Masuk
                        </option>

                        <option value="out"
                            {{ $type === 'out' ? 'selected' : '' }}>
                            Barang Keluar
                        </option>

                    </select>
                </div>


                {{-- Kategori --}}
                <div>
                    <label for="category_id"
                           class="mb-2 block text-sm font-medium text-gray-700">
                        Kategori
                    </label>

                    <select id="category_id"
                            name="category_id"
                            class="w-full rounded-lg border border-gray-300 bg-white px-3 py-2.5 text-sm text-gray-700 outline-none transition focus:border-blue-500 focus:ring-2 focus:ring-blue-200">

                        <option value="">
                            Semua Kategori
                        </option>

                        @foreach ($categories as $category)
                            <option value="{{ $category->id }}"
                                {{ (string) ($categoryId ?? '') === (string) $category->id ? 'selected' : '' }}>
                                {{ $category->name }}
                            </option>
                        @endforeach

                    </select>
                </div>


                {{-- Tombol Filter --}}
                <div class="flex items-end gap-2">

                    <button type="submit"
                            class="inline-flex flex-1 items-center justify-center gap-2 rounded-lg bg-blue-600 px-4 py-2.5 text-sm font-semibold text-white transition hover:bg-blue-700">

                        <svg xmlns="http://www.w3.org/2000/svg"
                             class="h-4 w-4"
                             fill="none"
                             viewBox="0 0 24 24"
                             stroke="currentColor"
                             stroke-width="2">

                            <path stroke-linecap="round"
                                  stroke-linejoin="round"
                                  d="m21 21-4.35-4.35m2.1-5.4a7.5 7.5 0 1 1-15 0 7.5 7.5 0 0 1 15 0Z" />

                        </svg>

                        Terapkan

                    </button>

                    <a href="{{ route('reports.index') }}"
                       class="inline-flex items-center justify-center rounded-lg bg-gray-200 px-4 py-2.5 text-sm font-semibold text-gray-700 transition hover:bg-gray-300">

                        Reset

                    </a>

                </div>

            </div>

        </form>

    </div>


    {{-- Ringkasan Laporan --}}
    <div class="grid grid-cols-1 gap-5 sm:grid-cols-2 lg:grid-cols-4">

        {{-- Total Produk --}}
        <div class="rounded-xl border border-gray-200 bg-white p-6 shadow-sm">

            <div class="flex items-center justify-between">
                <p class="text-sm font-medium text-gray-500">
                    Total Produk
                </p>

                <div class="rounded-lg bg-blue-100 p-3 text-blue-600">
                    📦
                </div>
            </div>

            <h2 class="mt-4 text-3xl font-bold text-gray-900">
                {{ $totalProducts ?? 0 }}
            </h2>

            <p class="mt-2 text-sm text-gray-500">
                Produk terdaftar
            </p>

        </div>


        {{-- Total Stok --}}
        <div class="rounded-xl border border-gray-200 bg-white p-6 shadow-sm">

            <div class="flex items-center justify-between">
                <p class="text-sm font-medium text-gray-500">
                    Total Stok
                </p>

                <div class="rounded-lg bg-purple-100 p-3 text-purple-600">
                    🗃️
                </div>
            </div>

            <h2 class="mt-4 text-3xl font-bold text-gray-900">
                {{ $totalStock ?? 0 }}
            </h2>

            <p class="mt-2 text-sm text-gray-500">
                Jumlah seluruh stok
            </p>

        </div>


        {{-- Barang Masuk --}}
        <div class="rounded-xl border border-gray-200 bg-white p-6 shadow-sm">

            <div class="flex items-center justify-between">
                <p class="text-sm font-medium text-gray-500">
                    Barang Masuk
                </p>

                <div class="rounded-lg bg-green-100 p-3 text-green-600">
                    ↗
                </div>
            </div>

            <h2 class="mt-4 text-3xl font-bold text-green-600">
                {{ $totalStockIn ?? 0 }}
            </h2>

            <p class="mt-2 text-sm text-gray-500">
                Total barang masuk
            </p>

        </div>


        {{-- Barang Keluar --}}
        <div class="rounded-xl border border-gray-200 bg-white p-6 shadow-sm">

            <div class="flex items-center justify-between">
                <p class="text-sm font-medium text-gray-500">
                    Barang Keluar
                </p>

                <div class="rounded-lg bg-red-100 p-3 text-red-600">
                    ↘
                </div>
            </div>

            <h2 class="mt-4 text-3xl font-bold text-red-600">
                {{ $totalStockOut ?? 0 }}
            </h2>

            <p class="mt-2 text-sm text-gray-500">
                Total barang keluar
            </p>

        </div>

    </div>


    {{-- Laporan Stok Barang --}}
    <div class="overflow-hidden rounded-xl border border-gray-200 bg-white shadow-sm">

        <div class="flex flex-col gap-3 border-b border-gray-200 px-6 py-5 sm:flex-row sm:items-center sm:justify-between">

            <div>
                <h2 class="text-lg font-semibold text-gray-900">
                    Laporan Stok Barang
                </h2>

                <p class="mt-1 text-sm text-gray-500">
                    Daftar stok barang berdasarkan kategori.
                </p>
            </div>

            <span class="rounded-full bg-blue-100 px-3 py-1 text-xs font-semibold text-blue-700">
                {{ $products->count() }} Produk
            </span>

        </div>

        <div class="overflow-x-auto">

            <table class="w-full text-left text-sm text-gray-600">

                <thead class="bg-gray-50 text-xs uppercase text-gray-700">

                    <tr>
                        <th class="whitespace-nowrap px-6 py-4">No</th>
                        <th class="whitespace-nowrap px-6 py-4">Nama Produk</th>
                        <th class="whitespace-nowrap px-6 py-4">Kategori</th>
                        <th class="whitespace-nowrap px-6 py-4">Stok</th>
                        <th class="whitespace-nowrap px-6 py-4">Status</th>
                    </tr>

                </thead>

                <tbody>

                    @forelse ($products as $product)

                        <tr class="border-b border-gray-100 transition hover:bg-gray-50">

                            <td class="px-6 py-4">
                                {{ $loop->iteration }}
                            </td>

                            <td class="px-6 py-4 font-medium text-gray-900">
                                {{ $product->name }}
                            </td>

                            <td class="px-6 py-4">
                                {{ $product->category->name ?? 'Tanpa Kategori' }}
                            </td>

                            <td class="px-6 py-4 font-semibold text-gray-900">
                                {{ $product->stock }}
                            </td>

                            <td class="px-6 py-4">

                                @if ($product->stock <= $product->minimum_stock)

                                    <span class="inline-flex rounded-full bg-red-100 px-3 py-1 text-xs font-semibold text-red-700">
                                        Stok Menipis
                                    </span>

                                @else

                                    <span class="inline-flex rounded-full bg-green-100 px-3 py-1 text-xs font-semibold text-green-700">
                                        Aman
                                    </span>

                                @endif

                            </td>

                        </tr>

                    @empty

                        <tr>

                            <td colspan="5"
                                class="px-6 py-10 text-center text-gray-500">

                                <div class="flex flex-col items-center justify-center">

                                    <span class="mb-2 text-3xl">
                                        📦
                                    </span>

                                    <p class="font-medium">
                                        Belum ada data produk.
                                    </p>

                                    <p class="mt-1 text-xs text-gray-400">
                                        Data produk akan ditampilkan di sini.
                                    </p>

                                </div>

                            </td>

                        </tr>

                    @endforelse

                </tbody>

            </table>

        </div>

    </div>


    {{-- Riwayat Transaksi --}}
    <div class="overflow-hidden rounded-xl border border-gray-200 bg-white shadow-sm">

        <div class="flex flex-col gap-3 border-b border-gray-200 px-6 py-5 sm:flex-row sm:items-center sm:justify-between">

            <div>
                <h2 class="text-lg font-semibold text-gray-900">
                    Riwayat Transaksi
                </h2>

                <p class="mt-1 text-sm text-gray-500">
                    Riwayat transaksi barang masuk dan barang keluar.
                </p>
            </div>

            <span class="rounded-full bg-gray-100 px-3 py-1 text-xs font-semibold text-gray-700">
                {{ $transactions->count() }} Transaksi
            </span>

        </div>

        <div class="overflow-x-auto">

            <table class="w-full text-left text-sm text-gray-600">

                <thead class="bg-gray-50 text-xs uppercase text-gray-700">

                    <tr>
                        <th class="whitespace-nowrap px-6 py-4">No</th>
                        <th class="whitespace-nowrap px-6 py-4">Produk</th>
                        <th class="whitespace-nowrap px-6 py-4">Jenis</th>
                        <th class="whitespace-nowrap px-6 py-4">Jumlah</th>
                        <th class="whitespace-nowrap px-6 py-4">Tanggal</th>
                        <th class="whitespace-nowrap px-6 py-4">Pengguna</th>
                    </tr>

                </thead>

                <tbody>

                    @forelse ($transactions as $transaction)

                        <tr class="border-b border-gray-100 transition hover:bg-gray-50">

                            <td class="px-6 py-4">
                                {{ $loop->iteration }}
                            </td>

                            <td class="px-6 py-4 font-medium text-gray-900">
                                {{ $transaction->product->name ?? 'Produk dihapus' }}
                            </td>

                            <td class="px-6 py-4">

                                @if ($transaction->type === 'in')

                                    <span class="inline-flex rounded-full bg-green-100 px-3 py-1 text-xs font-semibold text-green-700">
                                        Barang Masuk
                                    </span>

                                @else

                                    <span class="inline-flex rounded-full bg-red-100 px-3 py-1 text-xs font-semibold text-red-700">
                                        Barang Keluar
                                    </span>

                                @endif

                            </td>

                            <td class="px-6 py-4 font-semibold text-gray-900">
                                {{ $transaction->quantity }}
                            </td>

                            <td class="whitespace-nowrap px-6 py-4">

                                @if ($transaction->transaction_date)

                                    {{ \Carbon\Carbon::parse($transaction->transaction_date)->format('d-m-Y') }}

                                @else

                                    -

                                @endif

                            </td>

                            <td class="px-6 py-4">
                                {{ $transaction->user->name ?? 'Tidak diketahui' }}
                            </td>

                        </tr>

                    @empty

                        <tr>

                            <td colspan="6"
                                class="px-6 py-10 text-center text-gray-500">

                                <div class="flex flex-col items-center justify-center">

                                    <span class="mb-2 text-3xl">
                                        📝
                                    </span>

                                    <p class="font-medium">
                                        Belum ada riwayat transaksi.
                                    </p>

                                    <p class="mt-1 text-xs text-gray-400">
                                        Transaksi terbaru akan ditampilkan di sini.
                                    </p>

                                </div>

                            </td>

                        </tr>

                    @endforelse

                </tbody>

            </table>

        </div>

    </div>

</div>

@endsection