@extends('layouts.app')

@section('title', 'Impor Produk')

@section('page-title', 'Impor Produk')

@section('content')

<div class="mx-auto max-w-4xl space-y-6">

    {{-- Header Halaman --}}
    <div class="flex flex-col gap-4 sm:flex-row sm:items-center sm:justify-between">

        <div>
            <h1 class="text-2xl font-bold text-gray-800 dark:text-white">
                Impor Produk dari Excel
            </h1>

            <p class="mt-1 text-sm text-gray-500 dark:text-gray-400">
                Tambahkan banyak produk sekaligus melalui file Excel.
            </p>
        </div>

        <div class="flex flex-col gap-2 sm:flex-row">

            {{-- Tombol Download Template --}}
            <a href="{{ route('products.import.template') }}"
               style="background-color: #16a34a; color: #ffffff;"
               class="inline-flex items-center justify-center gap-2 rounded-xl
                      px-4 py-2.5 text-sm font-semibold transition
                      hover:opacity-90 focus:outline-none">

                <i class="fas fa-file-excel"></i>
                Download Template
            </a>

            {{-- Tombol Kembali --}}
            <a href="{{ route('products.index') }}"
               style="background-color: #f3f4f6; color: #374151;"
               class="inline-flex items-center justify-center gap-2 rounded-xl
                      px-4 py-2.5 text-sm font-semibold transition
                      hover:opacity-80 focus:outline-none
                      dark:bg-gray-700 dark:text-gray-200">

                <i class="fas fa-arrow-left"></i>
                Kembali
            </a>

        </div>
    </div>


    {{-- Pesan Error --}}
    @if ($errors->any())

        <div class="rounded-xl border border-red-200 bg-red-50 p-4
                    dark:border-red-800 dark:bg-red-900/20">

            <div class="flex items-start gap-3">

                <i class="fas fa-exclamation-circle mt-0.5 text-xl text-red-500"></i>

                <div>
                    <h3 class="font-semibold text-red-700 dark:text-red-400">
                        Impor Gagal
                    </h3>

                    <ul class="mt-2 list-inside list-disc text-sm text-red-600
                               dark:text-red-300">

                        @foreach ($errors->all() as $error)
                            <li>{{ $error }}</li>
                        @endforeach

                    </ul>
                </div>

            </div>
        </div>

    @endif


    {{-- Informasi Format Excel --}}
    <div class="rounded-2xl border border-blue-200 bg-blue-50 p-5
                dark:border-blue-800 dark:bg-blue-900/20">

        <div class="flex items-start gap-3">

            <div class="flex h-11 w-11 shrink-0 items-center justify-center
                        rounded-xl bg-blue-600 text-white">

                <i class="fas fa-info-circle text-lg"></i>

            </div>

            <div>
                <h3 class="font-semibold text-blue-800 dark:text-blue-300">
                    Perhatikan Format File
                </h3>

                <p class="mt-1 text-sm leading-relaxed text-blue-700 dark:text-blue-200">
                    Pastikan file Excel memiliki nama kolom yang sesuai dengan
                    format yang telah ditentukan.
                </p>
            </div>

        </div>


        {{-- Tabel Format Excel --}}
        <div class="mt-4 overflow-x-auto rounded-xl border border-blue-200
                    dark:border-blue-700">

            <table class="min-w-full text-sm">

                <thead class="bg-blue-100 dark:bg-blue-900/40">

                    <tr>
                        <th class="px-4 py-3 text-left font-semibold text-blue-800
                                   dark:text-blue-200">
                            Nama Kolom
                        </th>

                        <th class="px-4 py-3 text-left font-semibold text-blue-800
                                   dark:text-blue-200">
                            Keterangan
                        </th>
                    </tr>

                </thead>

                <tbody class="divide-y divide-blue-200 dark:divide-blue-700">

                    <tr>
                        <td class="px-4 py-3 font-mono text-blue-700 dark:text-blue-300">
                            category_id
                        </td>

                        <td class="px-4 py-3 text-blue-700 dark:text-blue-200">
                            ID kategori yang tersedia di database
                        </td>
                    </tr>

                    <tr>
                        <td class="px-4 py-3 font-mono text-blue-700 dark:text-blue-300">
                            supplier_id
                        </td>

                        <td class="px-4 py-3 text-blue-700 dark:text-blue-200">
                            ID supplier yang tersedia di database
                        </td>
                    </tr>

                    <tr>
                        <td class="px-4 py-3 font-mono text-blue-700 dark:text-blue-300">
                            code
                        </td>

                        <td class="px-4 py-3 text-blue-700 dark:text-blue-200">
                            Kode unik produk
                        </td>
                    </tr>

                    <tr>
                        <td class="px-4 py-3 font-mono text-blue-700 dark:text-blue-300">
                            name
                        </td>

                        <td class="px-4 py-3 text-blue-700 dark:text-blue-200">
                            Nama produk
                        </td>
                    </tr>

                    <tr>
                        <td class="px-4 py-3 font-mono text-blue-700 dark:text-blue-300">
                            description
                        </td>

                        <td class="px-4 py-3 text-blue-700 dark:text-blue-200">
                            Deskripsi produk, boleh dikosongkan
                        </td>
                    </tr>

                    <tr>
                        <td class="px-4 py-3 font-mono text-blue-700 dark:text-blue-300">
                            unit
                        </td>

                        <td class="px-4 py-3 text-blue-700 dark:text-blue-200">
                            Satuan produk, misalnya pcs atau unit
                        </td>
                    </tr>

                    {{-- Size --}}
                    <tr>
                        <td class="px-4 py-3 font-mono text-blue-700 dark:text-blue-300">
                            size
                        </td>

                        <td class="px-4 py-3 text-blue-700 dark:text-blue-200">
                            Ukuran produk, misalnya S, M, L, XL, 40, atau 42
                        </td>
                    </tr>

                    {{-- Color --}}
                    <tr>
                        <td class="px-4 py-3 font-mono text-blue-700 dark:text-blue-300">
                            color
                        </td>

                        <td class="px-4 py-3 text-blue-700 dark:text-blue-200">
                            Warna produk, misalnya Hitam, Putih, Merah, atau Biru
                        </td>
                    </tr>

                    {{-- Purchase Price --}}
                    <tr>
                        <td class="px-4 py-3 font-mono text-blue-700 dark:text-blue-300">
                            purchase_price
                        </td>

                        <td class="px-4 py-3 text-blue-700 dark:text-blue-200">
                            Harga beli produk
                        </td>
                    </tr>

                    <tr>
                        <td class="px-4 py-3 font-mono text-blue-700 dark:text-blue-300">
                            selling_price
                        </td>

                        <td class="px-4 py-3 text-blue-700 dark:text-blue-200">
                            Harga jual produk
                        </td>
                    </tr>

                    <tr>
                        <td class="px-4 py-3 font-mono text-blue-700 dark:text-blue-300">
                            minimum_stock
                        </td>

                        <td class="px-4 py-3 text-blue-700 dark:text-blue-200">
                            Batas minimum stok
                        </td>
                    </tr>

                </tbody>

            </table>

        </div>


        {{-- Informasi Stok Awal --}}
        <p class="mt-4 text-sm text-blue-700 dark:text-blue-200">

            <i class="fas fa-lightbulb mr-1"></i>

            Stok awal setiap produk akan otomatis diatur menjadi
            <strong>0</strong>.

        </p>

    </div>


    {{-- Form Upload --}}
    <div class="rounded-2xl border border-gray-200 bg-white p-6 shadow-sm
                dark:border-gray-700 dark:bg-gray-800">

        <div class="mb-6">

            <h2 class="text-lg font-bold text-gray-800 dark:text-white">
                Unggah File Excel
            </h2>

            <p class="mt-1 text-sm text-gray-500 dark:text-gray-400">
                Pilih file Excel dengan format .xlsx, .xls, atau .csv.
            </p>

        </div>


        <form action="{{ route('products.import.store') }}"
              method="POST"
              enctype="multipart/form-data"
              class="space-y-5">

            @csrf

            {{-- Input File --}}
            <div>

                <label for="file"
                       class="mb-2 block text-sm font-semibold text-gray-700
                              dark:text-gray-200">

                    File Excel

                </label>

                <input
                    type="file"
                    name="file"
                    id="file"
                    accept=".xlsx,.xls,.csv"
                    required
                    class="block w-full cursor-pointer rounded-xl border border-gray-300
                           bg-gray-50 text-sm text-gray-700
                           file:mr-4 file:border-0 file:bg-blue-600
                           file:px-5 file:py-3 file:text-sm file:font-semibold
                           file:text-white hover:file:bg-blue-700
                           focus:outline-none focus:ring-2 focus:ring-blue-500
                           dark:border-gray-600 dark:bg-gray-700
                           dark:text-gray-200"
                >

                <p class="mt-2 text-xs text-gray-500 dark:text-gray-400">
                    Ukuran file maksimal 5 MB.
                </p>

                @error('file')

                    <p class="mt-2 text-sm text-red-600 dark:text-red-400">
                        {{ $message }}
                    </p>

                @enderror

            </div>


            {{-- Tombol Form --}}
            <div class="flex flex-col-reverse gap-3 sm:flex-row sm:justify-end">

                {{-- Tombol Batal --}}
                <a href="{{ route('products.index') }}"
                   style="border: 1px solid #d1d5db; color: #374151;"
                   class="inline-flex items-center justify-center gap-2 rounded-xl
                          px-5 py-3 text-sm font-semibold transition
                          hover:bg-gray-100 focus:outline-none
                          dark:border-gray-600 dark:text-gray-200
                          dark:hover:bg-gray-700">

                    <i class="fas fa-times"></i>
                    Batal

                </a>


                {{-- Tombol Impor --}}
                <button
                    type="submit"
                    style="background-color: #2563eb; color: #ffffff;"
                    class="inline-flex items-center justify-center gap-2 rounded-xl
                           px-5 py-3 text-sm font-semibold transition
                           hover:opacity-90 focus:outline-none
                           focus:ring-2 focus:ring-blue-500">

                    <i class="fas fa-file-import"></i>
                    Impor Produk

                </button>

            </div>

        </form>

    </div>


    {{-- Catatan Penting --}}
    <div class="rounded-xl border border-yellow-200 bg-yellow-50 p-4
                dark:border-yellow-800 dark:bg-yellow-900/20">

        <div class="flex items-start gap-3">

            <i class="fas fa-exclamation-triangle mt-0.5 text-lg text-yellow-600"></i>

            <div class="text-sm text-yellow-800 dark:text-yellow-200">

                <p class="font-semibold">
                    Catatan Penting
                </p>

                <ul class="mt-2 list-disc space-y-1 pl-5">

                    <li>
                        Gunakan nama kolom Excel sesuai format yang ditentukan.
                    </li>

                    <li>
                        Pastikan ID kategori dan supplier sudah tersedia.
                    </li>

                    <li>
                        Kode produk tidak boleh sama dengan produk yang sudah ada.
                    </li>

                    <li>
                        Jika salah satu baris bermasalah, seluruh proses impor
                        akan dibatalkan.
                    </li>

                </ul>

            </div>

        </div>

    </div>

</div>

@endsection