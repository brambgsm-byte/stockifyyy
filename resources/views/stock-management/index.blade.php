@extends('layouts.app')

@section('title', 'Manajemen Stok')

@section('content')

<div class="space-y-8">

    {{-- HEADER HALAMAN --}}
    <div class="flex items-end justify-between border-b border-gray-200 pb-6">

        {{-- Teks di sebelah kiri --}}
        <div>

            {{-- Breadcrumb --}}
            <div class="mb-5 flex items-center gap-3 text-sm text-gray-500">

                <a href="{{ route('dashboard') }}"
                   class="transition hover:text-blue-600">
                    Dashboard
                </a>

                <span>/</span>

                <span class="text-gray-700">
                    Manajemen Stok
                </span>

            </div>


            <h1 class="text-3xl font-bold tracking-tight text-gray-900">
                Manajemen Stok
            </h1>

            <p class="mt-3 text-sm text-gray-500">
                Pantau dan kelola persediaan barang secara mudah.
            </p>

        </div>


        {{-- Tombol di pojok kanan --}}
        <div>

            <a href="{{ route('stock-transactions.create') }}"
               class="inline-flex items-center gap-3 rounded-lg bg-blue-600 px-5 py-3 text-sm font-semibold text-white shadow-sm transition hover:bg-blue-700 focus:outline-none focus:ring-4 focus:ring-blue-200">

                <svg xmlns="http://www.w3.org/2000/svg"
                     class="h-5 w-5"
                     fill="none"
                     viewBox="0 0 24 24"
                     stroke="currentColor"
                     stroke-width="2">

                    <path stroke-linecap="round"
                          stroke-linejoin="round"
                          d="M12 4v16m8-8H4" />

                </svg>

                Tambah Transaksi

            </a>

        </div>

    </div>


    {{-- KARTU STATISTIK --}}
    <div class="grid grid-cols-1 gap-5 md:grid-cols-3">

        {{-- Total Produk --}}
        <div class="rounded-xl border border-gray-200 bg-white p-6 shadow-sm">

            <div class="flex items-start justify-between">

                <div>

                    <p class="text-sm font-medium text-gray-500">
                        Total Produk
                    </p>

                    <h2 class="mt-4 text-3xl font-bold text-gray-900">
                        {{ $products->count() }}
                    </h2>

                    <p class="mt-3 text-sm text-gray-500">
                        Produk terdaftar
                    </p>

                </div>

                <div class="rounded-lg bg-blue-100 p-3 text-blue-600">

                    <svg xmlns="http://www.w3.org/2000/svg"
                         class="h-6 w-6"
                         fill="none"
                         viewBox="0 0 24 24"
                         stroke="currentColor"
                         stroke-width="2">

                        <path stroke-linecap="round"
                              stroke-linejoin="round"
                              d="M20 7l-8-4-8 4m16 0v10l-8 4-8-4V7m16 0l-8 4m-8-4l8 4m0 0v10" />

                    </svg>

                </div>

            </div>

        </div>


        {{-- Total Stok --}}
        <div class="rounded-xl border border-gray-200 bg-white p-6 shadow-sm">

            <div class="flex items-start justify-between">

                <div>

                    <p class="text-sm font-medium text-gray-500">
                        Total Stok Barang
                    </p>

                    <h2 class="mt-4 text-3xl font-bold text-gray-900">
                        {{ $products->sum('stock') }}
                    </h2>

                    <p class="mt-3 text-sm text-gray-500">
                        Jumlah seluruh persediaan
                    </p>

                </div>

                <div class="rounded-lg bg-green-100 p-3 text-green-600">

                    <svg xmlns="http://www.w3.org/2000/svg"
                         class="h-6 w-6"
                         fill="none"
                         viewBox="0 0 24 24"
                         stroke="currentColor"
                         stroke-width="2">

                        <path stroke-linecap="round"
                              stroke-linejoin="round"
                              d="M5 12l5 5L20 7" />

                    </svg>

                </div>

            </div>

        </div>


        {{-- Stok Menipis --}}
        <div class="rounded-xl border border-gray-200 bg-white p-6 shadow-sm">

            <div class="flex items-start justify-between">

                <div>

                    <p class="text-sm font-medium text-gray-500">
                        Stok Menipis
                    </p>

                    <h2 class="mt-4 text-3xl font-bold text-red-600">
                        {{ $products->filter(function ($product) {
                            return $product->stock <= $product->minimum_stock;
                        })->count() }}
                    </h2>

                    <p class="mt-3 text-sm text-gray-500">
                        Perlu segera diperiksa
                    </p>

                </div>

                <div class="rounded-lg bg-red-100 p-3 text-red-600">

                    <svg xmlns="http://www.w3.org/2000/svg"
                         class="h-6 w-6"
                         fill="none"
                         viewBox="0 0 24 24"
                         stroke="currentColor"
                         stroke-width="2">

                        <path stroke-linecap="round"
                              stroke-linejoin="round"
                              d="M12 9v2m0 4h.01M5.07 19h13.86c1.54 0 2.5-1.67 1.73-3L13.73 4c-.77-1.33-2.69-1.33-3.46 0L3.34 16c-.77 1.33.19 3 1.73 3z" />

                    </svg>

                </div>

            </div>

        </div>

    </div>


    {{-- DAFTAR STOK BARANG --}}
    <div class="overflow-hidden rounded-xl border border-gray-200 bg-white shadow-sm">

        {{-- Header Tabel --}}
        <div class="flex items-center justify-between border-b border-gray-200 px-6 py-6">

            <div>

                <h2 class="text-xl font-bold text-gray-900">
                    Daftar Stok Barang
                </h2>

                <p class="mt-2 text-sm text-gray-500">
                    Informasi persediaan setiap produk.
                </p>

            </div>

            <span class="rounded-full bg-blue-50 px-4 py-2 text-sm font-medium text-blue-600">
                {{ $products->count() }} Produk
            </span>

        </div>


        {{-- Tabel --}}
        <div class="overflow-x-auto">

            <table class="w-full text-left text-sm text-gray-600">

                <thead class="bg-gray-50 text-xs uppercase text-gray-600">

                    <tr>

                        <th class="whitespace-nowrap px-6 py-5">
                            No
                        </th>

                        <th class="whitespace-nowrap px-6 py-5">
                            Produk
                        </th>

                        <th class="whitespace-nowrap px-6 py-5">
                            Kategori
                        </th>

                        <th class="whitespace-nowrap px-6 py-5">
                            Supplier
                        </th>

                        <th class="whitespace-nowrap px-6 py-5 text-center">
                            Stok
                        </th>

                        <th class="whitespace-nowrap px-6 py-5 text-center">
                            Satuan
                        </th>

                        <th class="whitespace-nowrap px-6 py-5 text-center">
                            Status
                        </th>

                    </tr>

                </thead>


                <tbody class="divide-y divide-gray-100">

                    @forelse ($products as $product)

                        <tr class="transition hover:bg-gray-50">

                            <td class="whitespace-nowrap px-6 py-6 font-medium text-gray-900">
                                {{ $loop->iteration }}
                            </td>

                            <td class="px-6 py-6">

                                <p class="font-semibold text-gray-900">
                                    {{ $product->name }}
                                </p>

                                <p class="mt-1 text-xs text-gray-500">
                                    {{ $product->code }}
                                </p>

                            </td>

                            <td class="whitespace-nowrap px-6 py-6">
                                {{ $product->category->name ?? '-' }}
                            </td>

                            <td class="whitespace-nowrap px-6 py-6">
                                {{ $product->supplier->name ?? '-' }}
                            </td>

                            <td class="whitespace-nowrap px-6 py-6 text-center">

                                <span class="font-semibold text-gray-900">
                                    {{ $product->stock }}
                                </span>

                            </td>

                            <td class="whitespace-nowrap px-6 py-6 text-center">
                                {{ $product->unit }}
                            </td>

                            <td class="whitespace-nowrap px-6 py-6 text-center">

                                @if ($product->stock <= $product->minimum_stock)

                                    <span class="inline-flex rounded-full bg-red-100 px-3 py-1 text-xs font-semibold text-red-700">
                                        Stok Menipis
                                    </span>

                                @else

                                    <span class="inline-flex rounded-full bg-green-100 px-3 py-1 text-xs font-semibold text-green-700">
                                        Stok Aman
                                    </span>

                                @endif

                            </td>

                        </tr>

                    @empty

                        <tr>

                            <td colspan="7" class="px-6 py-12 text-center">

                                <p class="font-medium text-gray-500">
                                    Belum ada data produk.
                                </p>

                                <p class="mt-2 text-sm text-gray-400">
                                    Silakan tambahkan produk terlebih dahulu.
                                </p>

                            </td>

                        </tr>

                    @endforelse

                </tbody>

            </table>

        </div>

    </div>

</div>

@endsection