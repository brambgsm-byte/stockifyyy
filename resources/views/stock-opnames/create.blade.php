@extends('layouts.app')

@section('title', 'Tambah Stock Opname')

@section('content')
<div class="p-6">

    <div class="mb-6">
        <h1 class="text-2xl font-bold text-gray-800">
            Tambah Stock Opname
        </h1>

        <p class="text-sm text-gray-500 mt-1">
            Catat hasil pemeriksaan stok barang.
        </p>
    </div>

    <div class="bg-white rounded-lg shadow p-6 max-w-3xl">

        <form action="{{ route('stock-opnames.store') }}" method="POST">
            @csrf

            <div class="mb-5">
                <label for="product_id"
                       class="block mb-2 text-sm font-medium text-gray-700">
                    Produk
                </label>

                <select name="product_id"
                        id="product_id"
                        required
                        class="w-full rounded-lg border-gray-300 focus:border-blue-500 focus:ring-blue-500">

                    <option value="">-- Pilih Produk --</option>

                    @foreach ($products as $product)
                        <option value="{{ $product->id }}"
                            {{ old('product_id') == $product->id ? 'selected' : '' }}>
                            {{ $product->name }} - Stok Saat Ini: {{ $product->stock }}
                        </option>
                    @endforeach
                </select>

                @error('product_id')
                    <p class="mt-1 text-sm text-red-600">
                        {{ $message }}
                    </p>
                @enderror
            </div>

            <div class="mb-5">
                <label for="opname_date"
                       class="block mb-2 text-sm font-medium text-gray-700">
                    Tanggal Stock Opname
                </label>

                <input type="date"
                       name="opname_date"
                       id="opname_date"
                       value="{{ old('opname_date', date('Y-m-d')) }}"
                       required
                       class="w-full rounded-lg border-gray-300 focus:border-blue-500 focus:ring-blue-500">

                @error('opname_date')
                    <p class="mt-1 text-sm text-red-600">
                        {{ $message }}
                    </p>
                @enderror
            </div>

            <div class="mb-5">
                <label for="actual_stock"
                       class="block mb-2 text-sm font-medium text-gray-700">
                    Jumlah Stok Aktual
                </label>

                <input type="number"
                       name="actual_stock"
                       id="actual_stock"
                       min="0"
                       value="{{ old('actual_stock') }}"
                       required
                       placeholder="Masukkan jumlah stok aktual"
                       class="w-full rounded-lg border-gray-300 focus:border-blue-500 focus:ring-blue-500">

                <p class="mt-1 text-xs text-gray-500">
                    Masukkan jumlah barang yang benar-benar tersedia secara fisik.
                </p>

                @error('actual_stock')
                    <p class="mt-1 text-sm text-red-600">
                        {{ $message }}
                    </p>
                @enderror
            </div>

            <div class="mb-6">
                <label for="notes"
                       class="block mb-2 text-sm font-medium text-gray-700">
                    Keterangan
                </label>

                <textarea name="notes"
                          id="notes"
                          rows="4"
                          placeholder="Tambahkan keterangan jika diperlukan..."
                          class="w-full rounded-lg border-gray-300 focus:border-blue-500 focus:ring-blue-500">{{ old('notes') }}</textarea>

                @error('notes')
                    <p class="mt-1 text-sm text-red-600">
                        {{ $message }}
                    </p>
                @enderror
            </div>

            <div class="flex items-center gap-3">
                <button type="submit"
                        class="rounded-lg bg-blue-600 px-5 py-2.5 text-sm font-medium text-white hover:bg-blue-700">
                    Simpan
                </button>

                <a href="{{ route('stock-opnames.index') }}"
                   class="rounded-lg bg-gray-500 px-5 py-2.5 text-sm font-medium text-white hover:bg-gray-600">
                    Batal
                </a>
            </div>

        </form>

    </div>
</div>
@endsection