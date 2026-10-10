@extends('layouts.app')

@section('title', 'Tambah Kategori')

@section('content')

<div class="mx-auto max-w-3xl space-y-6">

    {{-- Header --}}
    <div>
        <p class="mb-2 text-sm text-gray-500">
            Kategori / Tambah
        </p>

        <h1 class="text-3xl font-bold text-gray-900">
            Tambah Kategori
        </h1>

        <p class="mt-2 text-sm text-gray-500">
            Tambahkan kategori baru untuk mengelompokkan barang.
        </p>
    </div>

    {{-- Form --}}
    <div class="overflow-hidden rounded-xl border border-gray-200 bg-white shadow-sm">

        <form action="{{ route('categories.store') }}" method="POST">

            @csrf

            <div class="space-y-6 p-6">

                {{-- Nama Kategori --}}
                <div>
                    <label
                        for="name"
                        class="mb-2 block text-sm font-medium text-gray-900"
                    >
                        Nama Kategori
                        <span class="text-red-500">*</span>
                    </label>

                    <input
                        type="text"
                        id="name"
                        name="name"
                        value="{{ old('name') }}"
                        placeholder="Contoh: Elektronik"
                        class="block w-full rounded-lg border border-gray-300 bg-gray-50 p-3 text-sm text-gray-900 focus:border-blue-500 focus:ring-blue-500"
                    >

                    @error('name')
                        <p class="mt-2 text-sm text-red-600">
                            {{ $message }}
                        </p>
                    @enderror
                </div>

                {{-- Deskripsi --}}
                <div>
                    <label
                        for="description"
                        class="mb-2 block text-sm font-medium text-gray-900"
                    >
                        Deskripsi
                    </label>

                    <textarea
                        id="description"
                        name="description"
                        rows="5"
                        placeholder="Masukkan deskripsi kategori..."
                        class="block w-full rounded-lg border border-gray-300 bg-gray-50 p-3 text-sm text-gray-900 focus:border-blue-500 focus:ring-blue-500"
                    >{{ old('description') }}</textarea>

                    @error('description')
                        <p class="mt-2 text-sm text-red-600">
                            {{ $message }}
                        </p>
                    @enderror
                </div>

            </div>

            {{-- Tombol --}}
            <div class="flex items-center justify-end gap-3 border-t border-gray-200 bg-gray-50 px-6 py-4">

                <a
                    href="{{ route('categories.index') }}"
                    class="rounded-lg border border-gray-300 bg-white px-5 py-2.5 text-sm font-medium text-gray-700 hover:bg-gray-100"
                >
                    Batal
                </a>

                <button
                    type="submit"
                    class="rounded-lg bg-blue-600 px-5 py-2.5 text-sm font-medium text-white hover:bg-blue-700 focus:ring-4 focus:ring-blue-300"
                >
                    Simpan Kategori
                </button>

            </div>

        </form>

    </div>

</div>

@endsection