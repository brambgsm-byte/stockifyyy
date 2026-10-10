@extends('layouts.app')

@section('title', 'Detail Produk')
@section('page-title', 'Detail Produk')

@section('content')

<div class="space-y-8">

    {{-- Header Halaman --}}
    <div class="flex flex-col justify-between gap-4 sm:flex-row sm:items-center">

        <div>

            <p class="text-sm text-gray-500 dark:text-gray-400">
                Informasi lengkap produk Stockify.
            </p>

            <h1 class="mt-2 text-3xl font-bold text-gray-900 dark:text-white">
                Detail Produk
            </h1>

        </div>


        {{-- Tombol Aksi --}}
        <div class="flex items-center gap-3">

            <a
                href="{{ route('products.index') }}"
                class="inline-flex items-center justify-center gap-2 rounded-xl
                       bg-gray-100 px-5 py-3 text-sm font-semibold text-gray-700
                       shadow-sm transition hover:bg-gray-200
                       dark:bg-gray-700 dark:text-gray-200 dark:hover:bg-gray-600"
            >

                <svg
                    class="h-5 w-5"
                    fill="none"
                    stroke="currentColor"
                    stroke-width="2"
                    viewBox="0 0 24 24"
                >
                    <path
                        stroke-linecap="round"
                        stroke-linejoin="round"
                        d="M10 19l-7-7m0 0l7-7m-7 7h18"
                    />
                </svg>

                Kembali

            </a>


            {{-- Tombol Edit hanya untuk Admin --}}
            @if (auth()->user()->role === 'admin')

                <a
                    href="{{ route('products.edit', $product->id) }}"
                    class="inline-flex items-center justify-center gap-2 rounded-xl
                           bg-blue-600 px-5 py-3 text-sm font-semibold text-white
                           shadow-sm transition hover:bg-blue-700"
                >

                    <svg
                        class="h-5 w-5"
                        fill="none"
                        stroke="currentColor"
                        stroke-width="2"
                        viewBox="0 0 24 24"
                    >
                        <path
                            stroke-linecap="round"
                            stroke-linejoin="round"
                            d="M11 5H6a2 2 0 00-2 2v11a2 2 0 002 2h11a2 2 0 002-2v-5"
                        />

                        <path
                            stroke-linecap="round"
                            stroke-linejoin="round"
                            d="M18.5 2.5a2.121 2.121 0 013 3L12 15l-4 1 1-4 9.5-9.5z"
                        />
                    </svg>

                    Edit Produk

                </a>

            @endif

        </div>

    </div>


    {{-- Informasi Utama Produk --}}
    <div class="grid grid-cols-1 gap-6 lg:grid-cols-3">


        {{-- Gambar Produk --}}
        <div
            class="rounded-2xl border border-gray-200 bg-white p-6 shadow-sm
                   dark:border-gray-700 dark:bg-gray-800"
        >

            <div class="flex min-h-[360px] items-center justify-center">

                @if ($product->image)

                    <img
                        src="{{ asset('storage/' . $product->image) }}"
                        alt="{{ $product->name }}"
                        class="max-h-[340px] w-full rounded-2xl object-contain"
                    >

                @else

                    <div
                        class="flex h-72 w-full items-center justify-center
                               rounded-2xl border-2 border-dashed border-gray-300
                               bg-gray-50 text-sm text-gray-400
                               dark:border-gray-600 dark:bg-gray-700/50
                               dark:text-gray-400"
                    >
                        Tidak ada gambar produk
                    </div>

                @endif

            </div>

        </div>


        {{-- Identitas Produk --}}
        <div
            class="rounded-2xl border border-gray-200 bg-white p-6 shadow-sm
                   lg:col-span-2
                   dark:border-gray-700 dark:bg-gray-800"
        >

            <div class="mb-6 border-b border-gray-200 pb-5 dark:border-gray-700">

                <p class="text-sm font-medium text-blue-600 dark:text-blue-400">
                    {{ $product->code }}
                </p>

                <h2 class="mt-2 text-2xl font-bold text-gray-900 dark:text-white">
                    {{ $product->name }}
                </h2>

                @if ($product->description)

                    <p class="mt-2 text-sm leading-6 text-gray-500 dark:text-gray-400">
                        {{ $product->description }}
                    </p>

                @endif

            </div>


            {{-- Informasi Produk --}}
            <div class="grid grid-cols-1 gap-5 sm:grid-cols-2">


                {{-- Kategori --}}
                <div>

                    <p class="text-xs font-semibold uppercase tracking-wide text-gray-500">
                        Kategori
                    </p>

                    <p class="mt-1 text-sm font-medium text-gray-900 dark:text-white">
                        {{ $product->category?->name ?? '-' }}
                    </p>

                </div>


                {{-- Supplier --}}
                <div>

                    <p class="text-xs font-semibold uppercase tracking-wide text-gray-500">
                        Supplier
                    </p>

                    <p class="mt-1 text-sm font-medium text-gray-900 dark:text-white">
                        {{ $product->supplier?->name ?? '-' }}
                    </p>

                </div>


                {{-- Satuan --}}
                <div>

                    <p class="text-xs font-semibold uppercase tracking-wide text-gray-500">
                        Satuan
                    </p>

                    <p class="mt-1 text-sm font-medium text-gray-900 dark:text-white">
                        {{ $product->unit ?: '-' }}
                    </p>

                </div>


                {{-- Ukuran --}}
                <div>

                    <p class="text-xs font-semibold uppercase tracking-wide text-gray-500">
                        Ukuran
                    </p>

                    <p class="mt-1 text-sm font-medium text-gray-900 dark:text-white">
                        {{ $product->size ?: '-' }}
                    </p>

                </div>


                {{-- Warna --}}
                <div>

                    <p class="text-xs font-semibold uppercase tracking-wide text-gray-500">
                        Warna
                    </p>

                    <p class="mt-1 text-sm font-medium text-gray-900 dark:text-white">
                        {{ $product->color ?: '-' }}
                    </p>

                </div>


                {{-- Harga Beli --}}
                <div>

                    <p class="text-xs font-semibold uppercase tracking-wide text-gray-500">
                        Harga Beli
                    </p>

                    <p class="mt-1 text-sm font-medium text-gray-900 dark:text-white">
                        Rp {{ number_format($product->purchase_price, 0, ',', '.') }}
                    </p>

                </div>


                {{-- Harga Jual --}}
                <div>

                    <p class="text-xs font-semibold uppercase tracking-wide text-gray-500">
                        Harga Jual
                    </p>

                    <p class="mt-1 text-sm font-medium text-gray-900 dark:text-white">
                        Rp {{ number_format($product->selling_price, 0, ',', '.') }}
                    </p>

                </div>


                {{-- Minimum Stok --}}
                <div>

                    <p class="text-xs font-semibold uppercase tracking-wide text-gray-500">
                        Minimum Stok
                    </p>

                    <p class="mt-1 text-sm font-medium text-gray-900 dark:text-white">
                        {{ number_format($product->minimum_stock, 0, ',', '.') }}
                        {{ $product->unit }}
                    </p>

                </div>

            </div>

        </div>

    </div>


    {{-- Informasi Stok --}}
    <div
        class="rounded-2xl border border-gray-200 bg-white p-6 shadow-sm
               dark:border-gray-700 dark:bg-gray-800"
    >

        <div class="mb-5">

            <h2 class="text-xl font-bold text-gray-900 dark:text-white">
                Informasi Stok
            </h2>

            <p class="mt-1 text-sm text-gray-500 dark:text-gray-400">
                Kondisi stok produk saat ini.
            </p>

        </div>


        <div class="grid grid-cols-1 gap-5 md:grid-cols-3">


            {{-- Stok Saat Ini --}}
            <div
                class="rounded-2xl border border-blue-100 bg-blue-50 p-5
                       dark:border-blue-900/40 dark:bg-blue-900/20"
            >

                <p class="text-sm font-medium text-blue-600 dark:text-blue-400">
                    Stok Saat Ini
                </p>

                <p class="mt-2 text-3xl font-bold text-gray-900 dark:text-white">
                    {{ number_format($product->stock, 0, ',', '.') }}
                </p>

                <p class="mt-1 text-xs text-gray-500 dark:text-gray-400">
                    {{ $product->unit }}
                </p>

            </div>


            {{-- Minimum Stok --}}
            <div
                class="rounded-2xl border border-gray-100 bg-gray-50 p-5
                       dark:border-gray-700 dark:bg-gray-700/50"
            >

                <p class="text-sm font-medium text-gray-600 dark:text-gray-300">
                    Batas Minimum
                </p>

                <p class="mt-2 text-3xl font-bold text-gray-900 dark:text-white">
                    {{ number_format($product->minimum_stock, 0, ',', '.') }}
                </p>

                <p class="mt-1 text-xs text-gray-500 dark:text-gray-400">
                    {{ $product->unit }}
                </p>

            </div>


            {{-- Status Stok --}}
            <div
                class="rounded-2xl border p-5
                @if ($product->stock <= $product->minimum_stock)
                    border-red-100 bg-red-50 dark:border-red-900/40 dark:bg-red-900/20
                @else
                    border-green-100 bg-green-50 dark:border-green-900/40 dark:bg-green-900/20
                @endif"
            >

                <p
                    class="text-sm font-medium
                    @if ($product->stock <= $product->minimum_stock)
                        text-red-600 dark:text-red-400
                    @else
                        text-green-600 dark:text-green-400
                    @endif"
                >
                    Status Stok
                </p>


                @if ($product->stock <= $product->minimum_stock)

                    <p class="mt-2 text-xl font-bold text-red-700 dark:text-red-400">
                        Stok Menipis
                    </p>

                    <p class="mt-1 text-xs text-red-600 dark:text-red-400">
                        Segera lakukan pengadaan barang.
                    </p>

                @else

                    <p class="mt-2 text-xl font-bold text-green-700 dark:text-green-400">
                        Stok Aman
                    </p>

                    <p class="mt-1 text-xs text-green-600 dark:text-green-400">
                        Jumlah stok masih di atas batas minimum.
                    </p>

                @endif

            </div>

        </div>

    </div>


    {{-- Informasi Tambahan --}}
    <div
        class="rounded-2xl border border-gray-200 bg-white p-6 shadow-sm
               dark:border-gray-700 dark:bg-gray-800"
    >

        <h2 class="text-xl font-bold text-gray-900 dark:text-white">
            Informasi Tambahan
        </h2>

        <div class="mt-5 grid grid-cols-1 gap-5 md:grid-cols-2">


            {{-- ID Produk --}}
            <div>

                <p class="text-xs font-semibold uppercase tracking-wide text-gray-500">
                    ID Produk
                </p>

                <p class="mt-1 text-sm text-gray-900 dark:text-white">
                    {{ $product->id }}
                </p>

            </div>


            {{-- Dibuat --}}
            <div>

                <p class="text-xs font-semibold uppercase tracking-wide text-gray-500">
                    Ditambahkan
                </p>

                <p class="mt-1 text-sm text-gray-900 dark:text-white">
                    {{ $product->created_at?->format('d F Y H:i') ?? '-' }}
                </p>

            </div>


            {{-- Terakhir Diperbarui --}}
            <div>

                <p class="text-xs font-semibold uppercase tracking-wide text-gray-500">
                    Terakhir Diperbarui
                </p>

                <p class="mt-1 text-sm text-gray-900 dark:text-white">
                    {{ $product->updated_at?->format('d F Y H:i') ?? '-' }}
                </p>

            </div>

        </div>

    </div>


</div>

@endsection 