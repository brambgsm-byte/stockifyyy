@extends('layouts.app')

@section('header-title', 'Pengaturan')

@section('content')

<div class="space-y-6">

    {{-- HEADER HALAMAN --}}
    <div class="flex items-center justify-between">

        <div>
            <p class="text-sm text-slate-500">
                Pengaturan / Aplikasi
            </p>

            <h2 class="mt-1 text-2xl font-bold text-slate-900">
                Pengaturan Aplikasi
            </h2>

            <p class="mt-1 text-sm text-slate-500">
                Kelola informasi dan tampilan dasar aplikasi Stockify.
            </p>
        </div>

    </div>


    {{-- FORM PENGATURAN --}}
    <form
        method="POST"
        action="{{ route('settings.update') }}"
        enctype="multipart/form-data"
    >

        @csrf
        @method('PUT')

        <div class="grid grid-cols-1 gap-6 lg:grid-cols-3">

            {{-- INFORMASI APLIKASI --}}
            <div class="lg:col-span-2">

                <div class="rounded-2xl border border-slate-200 bg-white p-6 shadow-sm">

                    <div class="mb-6">

                        <h3 class="text-lg font-bold text-slate-900">
                            Informasi Aplikasi
                        </h3>

                        <p class="mt-1 text-sm text-slate-500">
                            Atur nama dan deskripsi aplikasi.
                        </p>

                    </div>


                    {{-- NAMA APLIKASI --}}
                    <div class="mb-5">

                        <label
                            for="app_name"
                            class="mb-2 block text-sm font-semibold text-slate-700"
                        >
                            Nama Aplikasi
                        </label>

                        <input
                            type="text"
                            id="app_name"
                            name="app_name"
                            value="{{ old('app_name', $setting->app_name) }}"
                            class="w-full rounded-xl border border-slate-200 bg-white px-4 py-3 text-sm text-slate-800 outline-none transition focus:border-blue-500 focus:ring-2 focus:ring-blue-100"
                            placeholder="Masukkan nama aplikasi"
                            required
                        >

                    </div>


                    {{-- DESKRIPSI --}}
                    <div>

                        <label
                            for="app_description"
                            class="mb-2 block text-sm font-semibold text-slate-700"
                        >
                            Deskripsi Aplikasi
                        </label>

                        <textarea
                            id="app_description"
                            name="app_description"
                            rows="5"
                            class="w-full resize-none rounded-xl border border-slate-200 bg-white px-4 py-3 text-sm text-slate-800 outline-none transition focus:border-blue-500 focus:ring-2 focus:ring-blue-100"
                            placeholder="Masukkan deskripsi aplikasi"
                        >{{ old('app_description', $setting->app_description) }}</textarea>

                        <p class="mt-2 text-xs text-slate-500">
                            Maksimal 1000 karakter.
                        </p>

                    </div>

                </div>

            </div>


            {{-- LOGO --}}
            <div>

                <div class="rounded-2xl border border-slate-200 bg-white p-6 shadow-sm">

                    <div class="mb-6">

                        <h3 class="text-lg font-bold text-slate-900">
                            Logo Aplikasi
                        </h3>

                        <p class="mt-1 text-sm text-slate-500">
                            Upload logo yang digunakan oleh aplikasi.
                        </p>

                    </div>


                    {{-- PREVIEW LOGO --}}
                    <div class="mb-5 flex justify-center">

                        @if ($setting->app_logo)

                            <div class="flex h-32 w-32 items-center justify-center overflow-hidden rounded-2xl border border-slate-200 bg-slate-50">

                                <img
                                    src="{{ asset('storage/' . $setting->app_logo) }}"
                                    alt="Logo {{ $setting->app_name }}"
                                    class="h-full w-full object-contain"
                                >

                            </div>

                        @else

                            <div class="flex h-32 w-32 items-center justify-center rounded-2xl bg-blue-600 text-5xl font-bold text-white shadow-sm">
                                S
                            </div>

                        @endif

                    </div>


                    {{-- UPLOAD LOGO --}}
                    <div>

                        <label
                            for="app_logo"
                            class="mb-2 block text-sm font-semibold text-slate-700"
                        >
                            Pilih Logo
                        </label>

                        <input
                            type="file"
                            id="app_logo"
                            name="app_logo"
                            accept=".jpg,.jpeg,.png,.webp"
                            class="block w-full cursor-pointer rounded-xl border border-slate-200 bg-white text-sm text-slate-600 file:mr-4 file:border-0 file:bg-blue-600 file:px-4 file:py-3 file:text-sm file:font-semibold file:text-white hover:file:bg-blue-700"
                        >

                        <p class="mt-2 text-xs leading-5 text-slate-500">
                            Format: JPG, JPEG, PNG, atau WEBP.
                            <br>
                            Ukuran maksimal: 2 MB.
                        </p>

                    </div>


                    {{-- HAPUS LOGO --}}
                    @if ($setting->app_logo)

                        <div class="mt-5 border-t border-slate-100 pt-5">

                            <button
                                type="submit"
                                form="remove-logo-form"
                                class="inline-flex w-full items-center justify-center rounded-xl border border-red-200 bg-red-50 px-4 py-3 text-sm font-semibold text-red-600 transition hover:bg-red-100"
                                onclick="return confirm('Apakah Anda yakin ingin menghapus logo aplikasi?')"
                            >
                                Hapus Logo
                            </button>

                        </div>

                    @endif

                </div>

            </div>

        </div>


        {{-- TOMBOL SIMPAN --}}
        <div class="mt-6 flex justify-end">

            <button
                type="submit"
                class="inline-flex items-center justify-center rounded-xl bg-blue-600 px-7 py-3 text-sm font-semibold text-white shadow-sm transition hover:bg-blue-700"
            >
                Simpan Pengaturan
            </button>

        </div>

    </form>


    {{-- FORM HAPUS LOGO --}}
    @if ($setting->app_logo)

        <form
            id="remove-logo-form"
            method="POST"
            action="{{ route('settings.logo.remove') }}"
            class="hidden"
        >

            @csrf
            @method('DELETE')

        </form>

    @endif

</div>

@endsection