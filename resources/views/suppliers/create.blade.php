@extends('layouts.app')

@section('title', 'Tambah Supplier')
@section('page-title', 'Tambah Supplier')

@section('content')

<div class="mx-auto max-w-4xl space-y-8">

    {{-- Header Halaman --}}
    <div>
        <p class="mb-2 text-sm text-gray-500 dark:text-gray-400">
            Supplier / Tambah Supplier
        </p>

        <h1 class="text-3xl font-bold text-gray-900 dark:text-white">
            Tambah Supplier
        </h1>

        <p class="mt-2 text-sm text-gray-500 dark:text-gray-400">
            Tambahkan data supplier baru ke dalam sistem Stockify.
        </p>
    </div>

    {{-- Pesan Error Umum --}}
    @if ($errors->any())
        <div class="rounded-xl border border-red-200 bg-red-50 px-5 py-4 text-sm text-red-700 dark:border-red-800 dark:bg-red-900/30 dark:text-red-300">
            <div class="flex items-start gap-3">
                <svg
                    class="mt-0.5 h-5 w-5 shrink-0"
                    fill="none"
                    stroke="currentColor"
                    stroke-width="2"
                    viewBox="0 0 24 24"
                >
                    <path
                        stroke-linecap="round"
                        stroke-linejoin="round"
                        d="M12 9v4m0 4h.01M10.29 3.86l-8.18 14a2 2 0 001.73 3h16.32a2 2 0 001.73-3l-8.18-14a2 2 0 00-3.42 0z"
                    />
                </svg>

                <div>
                    <p class="font-semibold">
                        Terdapat kesalahan pada pengisian formulir.
                    </p>

                    <ul class="mt-2 list-inside list-disc space-y-1">
                        @foreach ($errors->all() as $error)
                            <li>{{ $error }}</li>
                        @endforeach
                    </ul>
                </div>
            </div>
        </div>
    @endif

    {{-- Card Form --}}
    <div class="overflow-hidden rounded-2xl border border-gray-200 bg-white shadow-sm dark:border-gray-700 dark:bg-slate-800">

        {{-- Header Card --}}
        <div class="border-b border-gray-200 px-6 py-5 dark:border-gray-700">
            <div class="flex items-center gap-3">
                <div class="flex h-11 w-11 items-center justify-center rounded-xl bg-blue-100 text-blue-600 dark:bg-blue-900/40 dark:text-blue-300">
                    <svg
                        class="h-6 w-6"
                        fill="none"
                        stroke="currentColor"
                        stroke-width="1.8"
                        viewBox="0 0 24 24"
                    >
                        <path
                            stroke-linecap="round"
                            stroke-linejoin="round"
                            d="M3 21h18M5 21V9l7-5 7 5v12M9 21v-6h6v6"
                        />
                    </svg>
                </div>

                <div>
                    <h2 class="text-xl font-bold text-gray-900 dark:text-white">
                        Informasi Supplier
                    </h2>

                    <p class="mt-1 text-sm text-gray-500 dark:text-gray-400">
                        Isi informasi supplier dengan lengkap dan benar.
                    </p>
                </div>
            </div>
        </div>

        {{-- Form --}}
        <form action="{{ route('suppliers.store') }}" method="POST">
            @csrf

            <div class="space-y-6 p-6">

                {{-- Nama Supplier --}}
                <div>
                    <label
                        for="name"
                        class="mb-2 block text-sm font-semibold text-gray-700 dark:text-gray-200"
                    >
                        Nama Supplier
                        <span class="text-red-500">*</span>
                    </label>

                    <input
                        type="text"
                        id="name"
                        name="name"
                        value="{{ old('name') }}"
                        placeholder="Masukkan nama supplier"
                        required
                        class="block w-full rounded-xl border border-gray-300 bg-gray-50 px-4 py-3 text-sm text-gray-900 outline-none transition placeholder:text-gray-400 focus:border-blue-500 focus:ring-2 focus:ring-blue-200 dark:border-gray-600 dark:bg-slate-700 dark:text-white dark:placeholder:text-gray-400 dark:focus:border-blue-400 dark:focus:ring-blue-900"
                    >

                    @error('name')
                        <p class="mt-2 text-sm text-red-600 dark:text-red-400">
                            {{ $message }}
                        </p>
                    @enderror
                </div>

                {{-- Alamat --}}
                <div>
                    <label
                        for="address"
                        class="mb-2 block text-sm font-semibold text-gray-700 dark:text-gray-200"
                    >
                        Alamat Supplier
                    </label>

                    <textarea
                        id="address"
                        name="address"
                        rows="4"
                        placeholder="Masukkan alamat lengkap supplier"
                        class="block w-full resize-y rounded-xl border border-gray-300 bg-gray-50 px-4 py-3 text-sm text-gray-900 outline-none transition placeholder:text-gray-400 focus:border-blue-500 focus:ring-2 focus:ring-blue-200 dark:border-gray-600 dark:bg-slate-700 dark:text-white dark:placeholder:text-gray-400 dark:focus:border-blue-400 dark:focus:ring-blue-900"
                    >{{ old('address') }}</textarea>

                    @error('address')
                        <p class="mt-2 text-sm text-red-600 dark:text-red-400">
                            {{ $message }}
                        </p>
                    @enderror
                </div>

                {{-- Grid Nomor Telepon dan Email --}}
                <div class="grid grid-cols-1 gap-6 md:grid-cols-2">

                    {{-- Nomor Telepon --}}
                    <div>
                        <label
                            for="phone"
                            class="mb-2 block text-sm font-semibold text-gray-700 dark:text-gray-200"
                        >
                            Nomor Telepon
                        </label>

                        <div class="relative">
                            <div class="pointer-events-none absolute inset-y-0 left-0 flex items-center pl-4 text-gray-400">
                                <svg
                                    class="h-5 w-5"
                                    fill="none"
                                    stroke="currentColor"
                                    stroke-width="1.8"
                                    viewBox="0 0 24 24"
                                >
                                    <path
                                        stroke-linecap="round"
                                        stroke-linejoin="round"
                                        d="M3 5a2 2 0 012-2h3.28a1 1 0 01.95.68l1.5 4.49a1 1 0 01-.5 1.21l-2.12 1.06a11.05 11.05 0 005.75 5.75l1.06-2.12a1 1 0 011.21-.5l4.49 1.5a1 1 0 01.68.95V20a2 2 0 01-2 2h-1C10.61 22 2 13.39 2 3V5z"
                                    />
                                </svg>
                            </div>

                            <input
                                type="text"
                                id="phone"
                                name="phone"
                                value="{{ old('phone') }}"
                                placeholder="081234567890"
                                class="block w-full rounded-xl border border-gray-300 bg-gray-50 py-3 pl-12 pr-4 text-sm text-gray-900 outline-none transition placeholder:text-gray-400 focus:border-blue-500 focus:ring-2 focus:ring-blue-200 dark:border-gray-600 dark:bg-slate-700 dark:text-white dark:placeholder:text-gray-400 dark:focus:border-blue-400 dark:focus:ring-blue-900"
                            >
                        </div>

                        @error('phone')
                            <p class="mt-2 text-sm text-red-600 dark:text-red-400">
                                {{ $message }}
                            </p>
                        @enderror
                    </div>

                    {{-- Email --}}
                    <div>
                        <label
                            for="email"
                            class="mb-2 block text-sm font-semibold text-gray-700 dark:text-gray-200"
                        >
                            Email Supplier
                        </label>

                        <div class="relative">
                            <div class="pointer-events-none absolute inset-y-0 left-0 flex items-center pl-4 text-gray-400">
                                <svg
                                    class="h-5 w-5"
                                    fill="none"
                                    stroke="currentColor"
                                    stroke-width="1.8"
                                    viewBox="0 0 24 24"
                                >
                                    <path
                                        stroke-linecap="round"
                                        stroke-linejoin="round"
                                        d="M3 7l9 6 9-6M5 5h14a2 2 0 012 2v10a2 2 0 01-2 2H5a2 2 0 01-2-2V7a2 2 0 012-2z"
                                    />
                                </svg>
                            </div>

                            <input
                                type="email"
                                id="email"
                                name="email"
                                value="{{ old('email') }}"
                                placeholder="supplier@email.com"
                                class="block w-full rounded-xl border border-gray-300 bg-gray-50 py-3 pl-12 pr-4 text-sm text-gray-900 outline-none transition placeholder:text-gray-400 focus:border-blue-500 focus:ring-2 focus:ring-blue-200 dark:border-gray-600 dark:bg-slate-700 dark:text-white dark:placeholder:text-gray-400 dark:focus:border-blue-400 dark:focus:ring-blue-900"
                            >
                        </div>

                        @error('email')
                            <p class="mt-2 text-sm text-red-600 dark:text-red-400">
                                {{ $message }}
                            </p>
                        @enderror
                    </div>

                </div>

            </div>

            {{-- Footer Form --}}
            <div class="flex flex-col-reverse gap-3 border-t border-gray-200 bg-gray-50 px-6 py-5 sm:flex-row sm:items-center sm:justify-end dark:border-gray-700 dark:bg-slate-900/40">

                {{-- Tombol Batal --}}
                <a
                    href="{{ route('suppliers.index') }}"
                    class="inline-flex items-center justify-center rounded-xl border border-gray-300 bg-white px-5 py-3 text-sm font-semibold text-gray-700 transition hover:bg-gray-100 dark:border-gray-600 dark:bg-slate-700 dark:text-gray-200 dark:hover:bg-slate-600"
                >
                    <svg
                        class="mr-2 h-5 w-5"
                        fill="none"
                        stroke="currentColor"
                        stroke-width="1.8"
                        viewBox="0 0 24 24"
                    >
                        <path
                            stroke-linecap="round"
                            stroke-linejoin="round"
                            d="M6 18L18 6M6 6l12 12"
                        />
                    </svg>

                    Batal
                </a>

                {{-- Tombol Simpan --}}
                <button
                    type="submit"
                    class="inline-flex items-center justify-center rounded-xl bg-blue-600 px-5 py-3 text-sm font-semibold text-white shadow-sm transition hover:bg-blue-700 focus:outline-none focus:ring-4 focus:ring-blue-300 dark:focus:ring-blue-800"
                >
                    <svg
                        class="mr-2 h-5 w-5"
                        fill="none"
                        stroke="currentColor"
                        stroke-width="1.8"
                        viewBox="0 0 24 24"
                    >
                        <path
                            stroke-linecap="round"
                            stroke-linejoin="round"
                            d="M5 12l4 4L19 6"
                        />
                    </svg>

                    Simpan Supplier
                </button>

            </div>

        </form>

    </div>

</div>

@endsection