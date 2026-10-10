@extends('layouts.app')

@section('title', 'Tambah Produk')
@section('page-title', 'Tambah Produk')

@section('content')

<div class="mx-auto max-w-6xl">

    {{-- Header Halaman --}}
    <div class="mb-8 flex flex-col justify-between gap-4 sm:flex-row sm:items-center">

        <div>
            <p class="text-sm text-gray-500 dark:text-gray-400">
                Sistem Manajemen Stok Barang
            </p>

            <h1 class="mt-2 text-3xl font-bold text-gray-900 dark:text-white">
                Tambah Produk
            </h1>

            <p class="mt-2 text-sm text-gray-500 dark:text-gray-400">
                Tambahkan data produk baru ke dalam sistem Stockify.
            </p>
        </div>

        <a
            href="{{ route('products.index') }}"
            class="inline-flex items-center justify-center rounded-xl border
                   border-gray-300 bg-white px-5 py-3 text-sm font-semibold
                   text-gray-700 transition hover:bg-gray-100
                   dark:border-gray-600 dark:bg-gray-800 dark:text-gray-200
                   dark:hover:bg-gray-700"
        >
            ← Kembali
        </a>

    </div>


    {{-- Pesan Error --}}
    @if ($errors->any())

        <div class="mb-6 rounded-xl border border-red-200 bg-red-50 p-5
                    dark:border-red-800 dark:bg-red-900/20">

            <div class="flex items-start gap-3">

                <svg
                    class="h-5 w-5 shrink-0 text-red-600 dark:text-red-400"
                    fill="none"
                    stroke="currentColor"
                    stroke-width="2"
                    viewBox="0 0 24 24"
                >
                    <path
                        stroke-linecap="round"
                        stroke-linejoin="round"
                        d="M12 9v4m0 4h.01M10.29 3.86l-7.82 14a2 2 0 002 3h15.58a2 2 0 002-3l-7.82-14a2 2 0 00-3.48 0z"
                    />
                </svg>

                <div>

                    <h3 class="mb-2 font-semibold text-red-700 dark:text-red-300">
                        Terdapat kesalahan pada formulir:
                    </h3>

                    <ul class="list-inside list-disc space-y-1 text-sm text-red-600 dark:text-red-300">

                        @foreach ($errors->all() as $error)
                            <li>{{ $error }}</li>
                        @endforeach

                    </ul>

                </div>

            </div>

        </div>

    @endif


    {{-- Form Tambah Produk --}}
    <div class="rounded-2xl border border-gray-200 bg-white p-8 shadow-sm
                dark:border-gray-700 dark:bg-gray-800">

        <div class="mb-8">

            <h2 class="text-xl font-bold text-gray-900 dark:text-white">
                Informasi Produk
            </h2>

            <p class="mt-1 text-sm text-gray-500 dark:text-gray-400">
                Isi informasi dasar produk yang akan ditambahkan.
            </p>

        </div>


        <form
            action="{{ route('products.store') }}"
            method="POST"
            enctype="multipart/form-data"
        >

            @csrf

            <div class="grid grid-cols-1 gap-6 md:grid-cols-2">

                {{-- Kode Produk --}}
                <div>

                    <label
                        for="code"
                        class="mb-2 block text-sm font-semibold text-gray-700
                               dark:text-gray-200"
                    >
                        Kode Produk
                    </label>

                    <input
                        type="text"
                        id="code"
                        name="code"
                        value="{{ old('code') }}"
                        placeholder="Contoh: BRG-001"
                        class="w-full rounded-xl border border-gray-300 bg-white
                               px-4 py-3 text-sm text-gray-900 outline-none
                               transition focus:border-blue-500 focus:ring-2
                               focus:ring-blue-100 dark:border-gray-600
                               dark:bg-gray-700 dark:text-white"
                        required
                    >

                </div>


                {{-- Nama Produk --}}
                <div>

                    <label
                        for="name"
                        class="mb-2 block text-sm font-semibold text-gray-700
                               dark:text-gray-200"
                    >
                        Nama Produk
                    </label>

                    <input
                        type="text"
                        id="name"
                        name="name"
                        value="{{ old('name') }}"
                        placeholder="Masukkan nama produk"
                        class="w-full rounded-xl border border-gray-300 bg-white
                               px-4 py-3 text-sm text-gray-900 outline-none
                               transition focus:border-blue-500 focus:ring-2
                               focus:ring-blue-100 dark:border-gray-600
                               dark:bg-gray-700 dark:text-white"
                        required
                    >

                </div>


                {{-- Kategori --}}
                <div>

                    <label
                        for="category_id"
                        class="mb-2 block text-sm font-semibold text-gray-700
                               dark:text-gray-200"
                    >
                        Kategori
                    </label>

                    <select
                        id="category_id"
                        name="category_id"
                        class="w-full rounded-xl border border-gray-300 bg-white
                               px-4 py-3 text-sm text-gray-900 outline-none
                               transition focus:border-blue-500 focus:ring-2
                               focus:ring-blue-100 dark:border-gray-600
                               dark:bg-gray-700 dark:text-white"
                        required
                    >

                        <option value="">Pilih kategori</option>

                        @foreach ($categories as $category)

                            <option
                                value="{{ $category->id }}"
                                {{ old('category_id') == $category->id ? 'selected' : '' }}
                            >
                                {{ $category->name }}
                            </option>

                        @endforeach

                    </select>

                </div>


                {{-- Supplier --}}
                <div>

                    <label
                        for="supplier_id"
                        class="mb-2 block text-sm font-semibold text-gray-700
                               dark:text-gray-200"
                    >
                        Supplier
                    </label>

                    <select
                        id="supplier_id"
                        name="supplier_id"
                        class="w-full rounded-xl border border-gray-300 bg-white
                               px-4 py-3 text-sm text-gray-900 outline-none
                               transition focus:border-blue-500 focus:ring-2
                               focus:ring-blue-100 dark:border-gray-600
                               dark:bg-gray-700 dark:text-white"
                        required
                    >

                        <option value="">Pilih supplier</option>

                        @foreach ($suppliers as $supplier)

                            <option
                                value="{{ $supplier->id }}"
                                {{ old('supplier_id') == $supplier->id ? 'selected' : '' }}
                            >
                                {{ $supplier->name }}
                            </option>

                        @endforeach

                    </select>

                </div>


                {{-- Satuan --}}
                <div>

                    <label
                        for="unit"
                        class="mb-2 block text-sm font-semibold text-gray-700
                               dark:text-gray-200"
                    >
                        Satuan
                    </label>

                    <input
                        type="text"
                        id="unit"
                        name="unit"
                        value="{{ old('unit') }}"
                        placeholder="Contoh: pcs, unit, box"
                        class="w-full rounded-xl border border-gray-300 bg-white
                               px-4 py-3 text-sm text-gray-900 outline-none
                               transition focus:border-blue-500 focus:ring-2
                               focus:ring-blue-100 dark:border-gray-600
                               dark:bg-gray-700 dark:text-white"
                        required
                    >

                </div>


                {{-- Ukuran --}}
                <div>

                    <label
                        for="size"
                        class="mb-2 block text-sm font-semibold text-gray-700
                               dark:text-gray-200"
                    >
                        Ukuran
                    </label>

                    <input
                        type="text"
                        id="size"
                        name="size"
                        value="{{ old('size') }}"
                        placeholder="Contoh: S, M, L, XL atau 40"
                        class="w-full rounded-xl border border-gray-300 bg-white
                               px-4 py-3 text-sm text-gray-900 outline-none
                               transition focus:border-blue-500 focus:ring-2
                               focus:ring-blue-100 dark:border-gray-600
                               dark:bg-gray-700 dark:text-white"
                    >

                </div>


                {{-- Warna --}}
                <div>

                    <label
                        for="color"
                        class="mb-2 block text-sm font-semibold text-gray-700
                               dark:text-gray-200"
                    >
                        Warna
                    </label>

                    <input
                        type="text"
                        id="color"
                        name="color"
                        value="{{ old('color') }}"
                        placeholder="Contoh: Hitam, Putih, Merah"
                        class="w-full rounded-xl border border-gray-300 bg-white
                               px-4 py-3 text-sm text-gray-900 outline-none
                               transition focus:border-blue-500 focus:ring-2
                               focus:ring-blue-100 dark:border-gray-600
                               dark:bg-gray-700 dark:text-white"
                    >

                </div>


                {{-- Stok Minimum --}}
                <div>

                    <label
                        for="minimum_stock"
                        class="mb-2 block text-sm font-semibold text-gray-700
                               dark:text-gray-200"
                    >
                        Stok Minimum
                    </label>

                    <input
                        type="number"
                        id="minimum_stock"
                        name="minimum_stock"
                        value="{{ old('minimum_stock', 0) }}"
                        min="0"
                        placeholder="Masukkan stok minimum"
                        class="w-full rounded-xl border border-gray-300 bg-white
                               px-4 py-3 text-sm text-gray-900 outline-none
                               transition focus:border-blue-500 focus:ring-2
                               focus:ring-blue-100 dark:border-gray-600
                               dark:bg-gray-700 dark:text-white"
                        required
                    >

                </div>


                {{-- Harga Beli --}}
                <div>

                    <label
                        for="purchase_price"
                        class="mb-2 block text-sm font-semibold text-gray-700
                               dark:text-gray-200"
                    >
                        Harga Beli
                    </label>

                    <div class="flex">

                        <span
                            class="inline-flex items-center rounded-l-xl border
                                   border-r-0 border-gray-300 bg-gray-100 px-4
                                   text-sm text-gray-600 dark:border-gray-600
                                   dark:bg-gray-600 dark:text-gray-200"
                        >
                            Rp
                        </span>

                        <input
                            type="number"
                            id="purchase_price"
                            name="purchase_price"
                            value="{{ old('purchase_price') }}"
                            min="0"
                            placeholder="0"
                            class="w-full rounded-r-xl border border-gray-300
                                   bg-white px-4 py-3 text-sm text-gray-900
                                   outline-none transition focus:border-blue-500
                                   focus:ring-2 focus:ring-blue-100
                                   dark:border-gray-600 dark:bg-gray-700
                                   dark:text-white"
                            required
                        >

                    </div>

                </div>


                {{-- Harga Jual --}}
                <div>

                    <label
                        for="selling_price"
                        class="mb-2 block text-sm font-semibold text-gray-700
                               dark:text-gray-200"
                    >
                        Harga Jual
                    </label>

                    <div class="flex">

                        <span
                            class="inline-flex items-center rounded-l-xl border
                                   border-r-0 border-gray-300 bg-gray-100 px-4
                                   text-sm text-gray-600 dark:border-gray-600
                                   dark:bg-gray-600 dark:text-gray-200"
                        >
                            Rp
                        </span>

                        <input
                            type="number"
                            id="selling_price"
                            name="selling_price"
                            value="{{ old('selling_price') }}"
                            min="0"
                            placeholder="0"
                            class="w-full rounded-r-xl border border-gray-300
                                   bg-white px-4 py-3 text-sm text-gray-900
                                   outline-none transition focus:border-blue-500
                                   focus:ring-2 focus:ring-blue-100
                                   dark:border-gray-600 dark:bg-gray-700
                                   dark:text-white"
                            required
                        >

                    </div>

                </div>


                {{-- Deskripsi --}}
                <div class="md:col-span-2">

                    <label
                        for="description"
                        class="mb-2 block text-sm font-semibold text-gray-700
                               dark:text-gray-200"
                    >
                        Deskripsi Produk
                    </label>

                    <textarea
                        id="description"
                        name="description"
                        rows="4"
                        placeholder="Masukkan deskripsi produk"
                        class="w-full rounded-xl border border-gray-300 bg-white
                               px-4 py-3 text-sm text-gray-900 outline-none
                               transition focus:border-blue-500 focus:ring-2
                               focus:ring-blue-100 dark:border-gray-600
                               dark:bg-gray-700 dark:text-white"
                    >{{ old('description') }}</textarea>

                </div>


                {{-- Gambar Produk --}}
                <div class="md:col-span-2">

                    <label
                        for="image"
                        class="mb-2 block text-sm font-semibold text-gray-700
                               dark:text-gray-200"
                    >
                        Gambar Produk
                    </label>

                    <div class="grid grid-cols-1 gap-6 md:grid-cols-2">

                        {{-- Input Upload --}}
                        <div>

                            <input
                                type="file"
                                id="image"
                                name="image"
                                accept=".jpg,.jpeg,.png,.webp"
                                class="block w-full rounded-xl border border-gray-300
                                       bg-white text-sm text-gray-700
                                       file:mr-4 file:border-0 file:bg-blue-50
                                       file:px-4 file:py-3 file:font-semibold
                                       file:text-blue-700 hover:file:bg-blue-100
                                       dark:border-gray-600 dark:bg-gray-700
                                       dark:text-gray-200"
                            >

                            <p class="mt-2 text-xs text-gray-500 dark:text-gray-400">
                                Format: JPG, JPEG, PNG, atau WEBP. Maksimal 2 MB.
                            </p>

                        </div>


                        {{-- Pratinjau Gambar --}}
                        <div id="preview-container" class="hidden">

                            <p class="mb-3 text-sm font-medium text-gray-600 dark:text-gray-300">
                                Pratinjau Gambar
                            </p>

                            <img
                                id="image-preview"
                                src="#"
                                alt="Pratinjau gambar produk"
                                class="h-48 w-48 rounded-2xl border border-gray-200
                                       object-cover shadow-sm dark:border-gray-600"
                            >

                        </div>

                    </div>

                </div>


            </div>


            {{-- Tombol --}}
            <div
                class="mt-8 flex justify-end gap-3 border-t border-gray-200 pt-6
                       dark:border-gray-700"
            >

                <a
                    href="{{ route('products.index') }}"
                    class="rounded-xl border border-gray-300 bg-white px-6 py-3
                           text-sm font-semibold text-gray-700 transition
                           hover:bg-gray-100 dark:border-gray-600
                           dark:bg-gray-700 dark:text-gray-200
                           dark:hover:bg-gray-600"
                >
                    Batal
                </a>

                <button
                    type="submit"
                    class="rounded-xl bg-blue-600 px-6 py-3 text-sm font-semibold
                           text-white transition hover:bg-blue-700
                           focus:outline-none focus:ring-4 focus:ring-blue-200"
                >
                    Simpan Produk
                </button>

            </div>

        </form>

    </div>

</div>


{{-- Script Pratinjau dan Validasi Gambar --}}
<script>
    document.addEventListener('DOMContentLoaded', function () {

        const imageInput = document.getElementById('image');
        const previewContainer = document.getElementById('preview-container');
        const imagePreview = document.getElementById('image-preview');

        imageInput.addEventListener('change', function (event) {

            const file = event.target.files[0];

            if (!file) {
                previewContainer.classList.add('hidden');
                imagePreview.src = '#';
                return;
            }

            const allowedTypes = [
                'image/jpeg',
                'image/png',
                'image/webp'
            ];

            if (!allowedTypes.includes(file.type)) {
                alert('Format gambar harus JPG, JPEG, PNG, atau WEBP.');
                imageInput.value = '';
                previewContainer.classList.add('hidden');
                imagePreview.src = '#';
                return;
            }

            if (file.size > 2 * 1024 * 1024) {
                alert('Ukuran gambar maksimal 2 MB.');
                imageInput.value = '';
                previewContainer.classList.add('hidden');
                imagePreview.src = '#';
                return;
            }

            const reader = new FileReader();

            reader.onload = function (event) {
                imagePreview.src = event.target.result;
                previewContainer.classList.remove('hidden');
            };

            reader.readAsDataURL(file);

        });

    });
</script>

@endsection