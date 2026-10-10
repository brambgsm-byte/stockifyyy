@extends('layouts.app')

@section('title', 'Produk')

@section('page-title', 'Produk')

@section('content')

<div class="space-y-8">

    {{-- Header Halaman --}}
    <div class="flex flex-col justify-between gap-4 sm:flex-row sm:items-center">

        <div>

            <p class="text-sm text-gray-500 dark:text-gray-400">
                Kelola data produk barang Stockify.
            </p>

            <h1 class="mt-2 text-3xl font-bold text-gray-900 dark:text-white">
                Daftar Produk
            </h1>

        </div>

        {{-- Tombol Aksi --}}
        @if (in_array(auth()->user()->role, ['admin', 'manager']))

            <div class="flex flex-wrap items-center gap-3">

                {{-- Tombol Impor Excel --}}
                @if (auth()->user()->role === 'admin')
                    <a
                        href="{{ route('products.import') }}"
                        style="background-color: #16a34a; color: #ffffff;"
                        class="inline-flex items-center justify-center gap-2 rounded-xl
                               border border-green-700 px-5 py-3 text-sm font-semibold
                               shadow-sm transition hover:opacity-90"
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
                                d="M12 3v12m0 0l-4-4m4 4l4-4M5 15v4a2 2 0 002 2h10a2 2 0 002-2v-4"
                            />
                        </svg>

                        <span style="color: #ffffff;">
                            Impor Excel
                        </span>

                    </a>
                @endif

                {{-- Tombol Tambah Produk --}}
                <a
                    href="{{ route('products.create') }}"
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
                            d="M12 5v14M5 12h14"
                        />
                    </svg>

                    Tambah Produk

                </a>

            </div>

        @endif

    </div>


    {{-- Card Daftar Produk --}}
    <div
        class="overflow-hidden rounded-2xl border border-gray-200 bg-white
               shadow-sm dark:border-gray-700 dark:bg-gray-800"
    >

        {{-- Header Card --}}
        <div
            class="flex flex-col justify-between gap-4 border-b border-gray-200
                   px-6 py-5 sm:flex-row sm:items-center
                   dark:border-gray-700"
        >

            <div>

                <h2 class="text-xl font-bold text-gray-900 dark:text-white">
                    Data Produk
                </h2>

                <p class="mt-1 text-sm text-gray-500 dark:text-gray-400">
                    Daftar produk yang tersedia di dalam sistem.
                </p>

            </div>

            <div
                class="inline-flex w-fit items-center rounded-full bg-blue-50
                       px-4 py-2 text-sm font-semibold text-blue-600
                       dark:bg-blue-900/30 dark:text-blue-300"
            >
                {{ $products->count() }} Produk
            </div>

        </div>


        {{-- Tabel Produk --}}
        <div class="overflow-x-auto">

            <table
                class="w-full min-w-[1450px] text-left text-sm
                       text-gray-600 dark:text-gray-300"
            >

                <thead
                    class="bg-gray-50 text-xs uppercase text-gray-600
                           dark:bg-gray-700 dark:text-gray-300"
                >

                    <tr>

                        <th class="px-6 py-4">
                            No
                        </th>

                        <th class="px-6 py-4">
                            Gambar
                        </th>

                        <th class="px-6 py-4">
                            Kode
                        </th>

                        <th class="px-6 py-4">
                            Nama Produk
                        </th>

                        <th class="px-6 py-4">
                            Kategori
                        </th>

                        <th class="px-6 py-4">
                            Supplier
                        </th>

                        <th class="px-6 py-4 text-center">
                            Stok
                        </th>

                        <th class="px-6 py-4">
                            Satuan
                        </th>

                        <th class="px-6 py-4">
                            Ukuran
                        </th>

                        <th class="px-6 py-4">
                            Warna
                        </th>

                        <th class="px-6 py-4">
                            Harga Jual
                        </th>

                        <th class="px-6 py-4 text-center">
                            Aksi
                        </th>

                    </tr>

                </thead>


                <tbody class="divide-y divide-gray-100 dark:divide-gray-700">

                    @forelse ($products as $index => $product)

                        <tr
                            class="transition hover:bg-gray-50 dark:hover:bg-gray-700/50"
                        >

                            {{-- Nomor --}}
                            <td
                                class="whitespace-nowrap px-6 py-5 text-gray-500
                                       dark:text-gray-400"
                            >
                                {{ $index + 1 }}
                            </td>


                            {{-- Gambar Produk --}}
                            <td class="px-6 py-5">

                                @if ($product->image)

                                    <img
                                        src="{{ asset('storage/' . $product->image) }}"
                                        alt="{{ $product->name }}"
                                        class="h-16 w-16 rounded-xl border border-gray-200
                                               object-cover shadow-sm dark:border-gray-600"
                                        loading="lazy"
                                    >

                                @else

                                    <div
                                        class="flex h-16 w-16 items-center justify-center
                                               rounded-xl border border-dashed border-gray-300
                                               bg-gray-100 text-center text-xs text-gray-400
                                               dark:border-gray-600 dark:bg-gray-700
                                               dark:text-gray-400"
                                    >
                                        Tidak ada gambar
                                    </div>

                                @endif

                            </td>


                            {{-- Kode Produk --}}
                            <td
                                class="whitespace-nowrap px-6 py-5 font-semibold
                                       text-gray-900 dark:text-white"
                            >
                                {{ $product->code }}
                            </td>


                            {{-- Nama Produk --}}
                            <td class="px-6 py-5">

                                <div
                                    class="font-semibold text-gray-900 dark:text-white"
                                >
                                    {{ $product->name }}
                                </div>

                                @if ($product->description)

                                    <div
                                        class="mt-1 max-w-xs truncate text-xs
                                               text-gray-500 dark:text-gray-400"
                                    >
                                        {{ $product->description }}
                                    </div>

                                @endif

                            </td>


                            {{-- Kategori --}}
                            <td class="whitespace-nowrap px-6 py-5">
                                {{ $product->category?->name ?? '-' }}
                            </td>


                            {{-- Supplier --}}
                            <td class="whitespace-nowrap px-6 py-5">
                                {{ $product->supplier?->name ?? '-' }}
                            </td>


                            {{-- Stok --}}
                            <td class="whitespace-nowrap px-6 py-5 text-center">

                                @if ($product->stock <= $product->minimum_stock)

                                    <span
                                        class="inline-flex items-center rounded-full
                                               bg-red-100 px-3 py-1 text-xs
                                               font-semibold text-red-700
                                               dark:bg-red-900/30 dark:text-red-300"
                                    >
                                        {{ $product->stock }}
                                    </span>

                                @else

                                    <span
                                        class="inline-flex items-center rounded-full
                                               bg-green-100 px-3 py-1 text-xs
                                               font-semibold text-green-700
                                               dark:bg-green-900/30 dark:text-green-300"
                                    >
                                        {{ $product->stock }}
                                    </span>

                                @endif

                            </td>


                            {{-- Satuan --}}
                            <td class="whitespace-nowrap px-6 py-5">
                                {{ $product->unit }}
                            </td>


                            {{-- Ukuran --}}
                            <td class="whitespace-nowrap px-6 py-5">
                                {{ $product->size ?? '-' }}
                            </td>


                            {{-- Warna --}}
                            <td class="whitespace-nowrap px-6 py-5">
                                {{ $product->color ?? '-' }}
                            </td>


                            {{-- Harga Jual --}}
                            <td
                                class="whitespace-nowrap px-6 py-5 font-semibold
                                       text-gray-900 dark:text-white"
                            >
                                Rp {{ number_format($product->selling_price, 0, ',', '.') }}
                            </td>


                            {{-- Aksi --}}
                            <td class="px-6 py-5">

                                <div class="flex items-center justify-center gap-2">

                                    {{-- Tombol Detail --}}
                                    <a
                                        href="{{ route('products.show', $product->id) }}"
                                        class="inline-flex items-center justify-center rounded-lg
                                               bg-blue-100 px-3 py-2 text-xs font-semibold
                                               text-blue-700 transition hover:bg-blue-200
                                               dark:bg-blue-900/30 dark:text-blue-300"
                                    >

                                        <svg
                                            class="mr-1 h-4 w-4"
                                            fill="none"
                                            stroke="currentColor"
                                            stroke-width="2"
                                            viewBox="0 0 24 24"
                                        >
                                            <path
                                                stroke-linecap="round"
                                                stroke-linejoin="round"
                                                d="M15 12a3 3 0 11-6 0 3 3 0 016 0z"
                                            />

                                            <path
                                                stroke-linecap="round"
                                                stroke-linejoin="round"
                                                d="M2.458 12C3.732 7.943 7.523 5 12 5c4.477 0 8.268 2.943 9.542 7-1.274 4.057-5.065 7-9.542 7-4.477 0-8.268-2.943-9.542-7z"
                                            />
                                        </svg>

                                        Detail

                                    </a>


                                    {{-- Edit dan Hapus hanya untuk Admin --}}
                                    @if (auth()->user()->role === 'admin')

                                        {{-- Tombol Edit --}}
                                        <a
                                            href="{{ route('products.edit', $product->id) }}"
                                            class="inline-flex items-center justify-center rounded-lg
                                                   bg-yellow-100 px-3 py-2 text-xs font-semibold
                                                   text-yellow-700 transition hover:bg-yellow-200
                                                   dark:bg-yellow-900/30 dark:text-yellow-300"
                                        >

                                            <svg
                                                class="mr-1 h-4 w-4"
                                                fill="none"
                                                stroke="currentColor"
                                                stroke-width="2"
                                                viewBox="0 0 24 24"
                                            >
                                                <path
                                                    stroke-linecap="round"
                                                    stroke-linejoin="round"
                                                    d="M11 5H6a2 2 0 00-2 2v11a2 2 0 002 2h11a2 2 0 002-2v-5M18.5 2.5a2.121 2.121 0 013 3L12 15l-4 1 1-4 9.5-9.5z"
                                                />
                                            </svg>

                                            Edit

                                        </a>


                                        {{-- Tombol Hapus --}}
                                        <form
                                            action="{{ route('products.destroy', $product->id) }}"
                                            method="POST"
                                            onsubmit="return confirm('Apakah Anda yakin ingin menghapus produk ini?');"
                                        >

                                            @csrf

                                            @method('DELETE')

                                            <button
                                                type="submit"
                                                class="inline-flex items-center justify-center rounded-lg
                                                       bg-red-100 px-3 py-2 text-xs font-semibold
                                                       text-red-700 transition hover:bg-red-200
                                                       dark:bg-red-900/30 dark:text-red-300"
                                            >

                                                <svg
                                                    class="mr-1 h-4 w-4"
                                                    fill="none"
                                                    stroke="currentColor"
                                                    stroke-width="2"
                                                    viewBox="0 0 24 24"
                                                >
                                                    <path
                                                        stroke-linecap="round"
                                                        stroke-linejoin="round"
                                                        d="M3 6h18M8 6V4a2 2 0 012-2h4a2 2 0 012 2v2m3 0v14a2 2 0 01-2 2H7a2 2 0 01-2-2V6m3 5v6m4-6v6"
                                                    />
                                                </svg>

                                                Hapus

                                            </button>

                                        </form>

                                    @endif

                                </div>

                            </td>

                        </tr>

                    @empty

                        {{-- Data Kosong --}}
                        <tr>

                            <td colspan="12" class="px-6 py-16 text-center">

                                <div class="flex flex-col items-center">

                                    <div
                                        class="flex h-16 w-16 items-center justify-center
                                               rounded-full bg-gray-100 dark:bg-gray-700"
                                    >

                                        <svg
                                            class="h-8 w-8 text-gray-400"
                                            fill="none"
                                            stroke="currentColor"
                                            stroke-width="1.5"
                                            viewBox="0 0 24 24"
                                        >

                                            <path
                                                stroke-linecap="round"
                                                stroke-linejoin="round"
                                                d="M20 13V6a2 2 0 00-2-2H6a2 2 0 00-2 2v7m16 0v5a2 2 0 01-2 2H6a2 2 0 01-2-2v-5m16 0H4m4-5h8"
                                            />

                                        </svg>

                                    </div>

                                    <p
                                        class="mt-4 text-base font-semibold text-gray-500
                                               dark:text-gray-300"
                                    >
                                        Belum ada produk
                                    </p>

                                    <p class="mt-1 text-sm text-gray-400">
                                        Silakan tambahkan produk baru.
                                    </p>


                                    {{-- Tambah Produk untuk Admin + Manager --}}
                                    @if (in_array(auth()->user()->role, ['admin', 'manager']))

                                        <a
                                            href="{{ route('products.create') }}"
                                            class="mt-5 inline-flex items-center gap-2 rounded-xl
                                                   bg-blue-600 px-4 py-2.5 text-sm font-semibold
                                                   text-white transition hover:bg-blue-700"
                                        >

                                            <svg
                                                class="h-4 w-4"
                                                fill="none"
                                                stroke="currentColor"
                                                stroke-width="2"
                                                viewBox="0 0 24 24"
                                            >

                                                <path
                                                    stroke-linecap="round"
                                                    stroke-linejoin="round"
                                                    d="M12 5v14M5 12h14"
                                                />

                                            </svg>

                                            Tambah Produk

                                        </a>

                                    @endif

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