@extends('layouts.app')

@section('title', 'Edit Stock Opname')

@section('content')
<div class="min-h-screen bg-gray-50 px-6 py-10">

    {{-- Container Tengah --}}
    <div class="mx-auto max-w-3xl">

        {{-- Judul Halaman --}}
        <div class="mb-6 text-center">
            <h1 class="text-3xl font-bold text-gray-800">
                Edit Stock Opname
            </h1>

            <p class="mt-2 text-sm text-gray-500">
                Perbarui data pemeriksaan stok barang.
            </p>
        </div>

        {{-- Form Edit --}}
        <div class="rounded-xl bg-white p-8 shadow-md">

            <form action="{{ route('stock-opnames.update', $opname->id) }}"
                  method="POST">

                @csrf
                @method('PUT')

                {{-- Pesan Error --}}
                @if ($errors->any())
                    <div class="mb-6 rounded-lg bg-red-100 p-4 text-sm text-red-700">
                        <ul class="list-disc space-y-1 pl-5">
                            @foreach ($errors->all() as $error)
                                <li>{{ $error }}</li>
                            @endforeach
                        </ul>
                    </div>
                @endif

                {{-- Produk --}}
                <div class="mb-6">
                    <label for="product_name"
                           class="mb-2 block text-sm font-semibold text-gray-700">
                        Produk
                    </label>

                    <input type="text"
                           id="product_name"
                           value="{{ $opname->product->name ?? '-' }}"
                           disabled
                           class="w-full rounded-lg border border-gray-300 bg-gray-100 px-4 py-3 text-gray-600 outline-none">

                    <p class="mt-2 text-xs text-gray-500">
                        Produk tidak dapat diubah saat mengedit stock opname.
                    </p>
                </div>

                {{-- Tanggal Stock Opname --}}
                <div class="mb-6">
                    <label for="opname_date"
                           class="mb-2 block text-sm font-semibold text-gray-700">
                        Tanggal Stock Opname
                    </label>

                    <input type="date"
                           name="opname_date"
                           id="opname_date"
                           value="{{ old('opname_date', $opname->opname_date?->format('Y-m-d')) }}"
                           required
                           class="w-full rounded-lg border border-gray-300 px-4 py-3 text-gray-700 outline-none focus:border-blue-500 focus:ring-2 focus:ring-blue-200">

                    @error('opname_date')
                        <p class="mt-2 text-sm text-red-600">
                            {{ $message }}
                        </p>
                    @enderror
                </div>

                {{-- Stok Sistem --}}
                <div class="mb-6">
                    <label for="system_stock"
                           class="mb-2 block text-sm font-semibold text-gray-700">
                        Stok Sistem
                    </label>

                    <input type="number"
                           id="system_stock"
                           value="{{ $opname->system_stock }}"
                           disabled
                           class="w-full rounded-lg border border-gray-300 bg-gray-100 px-4 py-3 text-gray-600 outline-none">

                    <p class="mt-2 text-xs text-gray-500">
                        Stok sistem saat stock opname dibuat.
                    </p>
                </div>

                {{-- Stok Aktual --}}
                <div class="mb-6">
                    <label for="actual_stock"
                           class="mb-2 block text-sm font-semibold text-gray-700">
                        Jumlah Stok Aktual
                    </label>

                    <input type="number"
                           name="actual_stock"
                           id="actual_stock"
                           min="0"
                           value="{{ old('actual_stock', $opname->actual_stock) }}"
                           required
                           class="w-full rounded-lg border border-gray-300 px-4 py-3 text-gray-700 outline-none focus:border-blue-500 focus:ring-2 focus:ring-blue-200">

                    <p class="mt-2 text-xs text-gray-500">
                        Masukkan jumlah stok fisik yang sebenarnya.
                    </p>

                    @error('actual_stock')
                        <p class="mt-2 text-sm text-red-600">
                            {{ $message }}
                        </p>
                    @enderror
                </div>

                {{-- Keterangan --}}
                <div class="mb-8">
                    <label for="notes"
                           class="mb-2 block text-sm font-semibold text-gray-700">
                        Keterangan
                    </label>

                    <textarea name="notes"
                              id="notes"
                              rows="5"
                              placeholder="Tambahkan keterangan jika diperlukan..."
                              class="w-full rounded-lg border border-gray-300 px-4 py-3 text-gray-700 outline-none focus:border-blue-500 focus:ring-2 focus:ring-blue-200">{{ old('notes', $opname->notes) }}</textarea>

                    @error('notes')
                        <p class="mt-2 text-sm text-red-600">
                            {{ $message }}
                        </p>
                    @enderror
                </div>

                {{-- Tombol --}}
                <div class="flex justify-center gap-4">

                    <button type="submit"
                            style="
                                background-color: #2563eb;
                                color: white;
                                padding: 12px 24px;
                                border: none;
                                border-radius: 8px;
                                font-size: 14px;
                                font-weight: 600;
                                cursor: pointer;
                            ">
                        Simpan Perubahan
                    </button>

                    <a href="{{ route('stock-opnames.index') }}"
                       style="
                            background-color: #6b7280;
                            color: white;
                            padding: 12px 24px;
                            border-radius: 8px;
                            font-size: 14px;
                            font-weight: 600;
                            text-decoration: none;
                            display: inline-block;
                       ">
                        Batal
                    </a>

                </div>

            </form>

        </div>
    </div>

</div>
@endsection