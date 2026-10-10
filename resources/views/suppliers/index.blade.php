@extends('layouts.app')

@section('title', 'Supplier')
@section('page-title', 'Supplier')

@section('content')

<div class="space-y-8">

    {{-- Header Halaman --}}
    <div class="flex flex-col justify-between gap-4 sm:flex-row sm:items-center">

        <div>

            <p class="text-sm text-gray-500 dark:text-gray-400">
                Kelola data pemasok barang di Stockify.
            </p>

            <h1 class="mt-2 text-3xl font-bold text-gray-900 dark:text-white">
                Daftar Supplier
            </h1>

        </div>


        {{-- Tambah Supplier hanya untuk Admin --}}
        @if (auth()->user()->role === 'admin')

            <a
                href="{{ route('suppliers.create') }}"
                class="inline-flex items-center justify-center rounded-xl bg-blue-600 px-5 py-3 text-sm font-semibold text-white shadow-sm transition hover:bg-blue-700"
            >

                <svg
                    class="mr-2 h-5 w-5"
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

                Tambah Supplier

            </a>

        @endif

    </div>


    {{-- Pesan Berhasil --}}
    @if (session('success'))

        <div
            class="flex items-center gap-3 rounded-xl border border-green-200 bg-green-50 px-5 py-4 text-sm font-medium text-green-700"
        >

            <svg
                class="h-5 w-5 shrink-0"
                fill="none"
                stroke="currentColor"
                stroke-width="2"
                viewBox="0 0 24 24"
            >
                <path
                    stroke-linecap="round"
                    stroke-linejoin="round"
                    d="M5 13l4 4L19 7"
                />
            </svg>

            {{ session('success') }}

        </div>

    @endif


    {{-- Pesan Error --}}
    @if (session('error'))

        <div
            class="flex items-center gap-3 rounded-xl border border-red-200 bg-red-50 px-5 py-4 text-sm font-medium text-red-700"
        >

            <svg
                class="h-5 w-5 shrink-0"
                fill="none"
                stroke="currentColor"
                stroke-width="2"
                viewBox="0 0 24 24"
            >
                <path
                    stroke-linecap="round"
                    stroke-linejoin="round"
                    d="M6 18L18 6M6 6l12 12"
                />
            </svg>

            {{ session('error') }}

        </div>

    @endif


    {{-- Pesan Validasi --}}
    @if ($errors->any())

        <div
            class="rounded-xl border border-red-200 bg-red-50 px-5 py-4 text-sm text-red-700"
        >

            <p class="mb-2 font-semibold">
                Terdapat kesalahan:
            </p>

            <ul class="list-inside list-disc space-y-1">

                @foreach ($errors->all() as $error)

                    <li>
                        {{ $error }}
                    </li>

                @endforeach

            </ul>

        </div>

    @endif


    {{-- Card Data Supplier --}}
    <div
        class="overflow-hidden rounded-2xl border border-gray-200 bg-white shadow-sm dark:border-gray-700 dark:bg-slate-800"
    >

        {{-- Header Card --}}
        <div
            class="flex flex-col justify-between gap-3 border-b border-gray-200 px-6 py-5 sm:flex-row sm:items-center dark:border-gray-700"
        >

            <div>

                <h2 class="text-xl font-bold text-gray-900 dark:text-white">
                    Data Supplier
                </h2>

                <p class="mt-1 text-sm text-gray-500 dark:text-gray-400">
                    Daftar pemasok barang yang terdaftar dalam sistem.
                </p>

            </div>


            <div
                class="rounded-full bg-blue-50 px-4 py-2 text-sm font-semibold text-blue-600 dark:bg-blue-900/40 dark:text-blue-300"
            >
                {{ $suppliers->count() }} Supplier
            </div>

        </div>


        {{-- Tabel Supplier --}}
        <div class="overflow-x-auto">

            <table
                class="w-full min-w-[950px] text-left text-sm text-gray-600 dark:text-gray-300"
            >

                <thead
                    class="bg-gray-50 text-xs uppercase text-gray-600 dark:bg-slate-700 dark:text-gray-200"
                >

                    <tr>

                        <th class="px-6 py-4">
                            No
                        </th>

                        <th class="px-6 py-4">
                            Nama Supplier
                        </th>

                        <th class="px-6 py-4">
                            Nomor Telepon
                        </th>

                        <th class="px-6 py-4">
                            Alamat
                        </th>

                        <th class="px-6 py-4">
                            Deskripsi
                        </th>

                        <th class="px-6 py-4 text-center">
                            Aksi
                        </th>

                    </tr>

                </thead>


                <tbody class="divide-y divide-gray-100 dark:divide-gray-700">

                    @forelse ($suppliers as $index => $supplier)

                        <tr
                            class="transition hover:bg-gray-50 dark:hover:bg-slate-700/70"
                        >

                            {{-- Nomor --}}
                            <td
                                class="whitespace-nowrap px-6 py-5 text-gray-500 dark:text-gray-400"
                            >
                                {{ $index + 1 }}
                            </td>


                            {{-- Nama Supplier --}}
                            <td
                                class="whitespace-nowrap px-6 py-5 font-semibold text-gray-900 dark:text-white"
                            >
                                {{ $supplier->name }}
                            </td>


                            {{-- Nomor Telepon --}}
                            <td class="whitespace-nowrap px-6 py-5">
                                {{ $supplier->phone ?: '-' }}
                            </td>


                            {{-- Alamat --}}
                            <td class="px-6 py-5">
                                {{ $supplier->address ?: '-' }}
                            </td>


                            {{-- Deskripsi --}}
                            <td class="px-6 py-5">
                                {{ $supplier->description ?: '-' }}
                            </td>


                            {{-- Aksi --}}
                            <td class="px-6 py-5">

                                <div class="flex items-center justify-center gap-2">

                                    {{-- Edit dan Hapus hanya untuk Admin --}}
                                    @if (auth()->user()->role === 'admin')

                                        {{-- Edit --}}
                                        <a
                                            href="{{ route('suppliers.edit', $supplier->id) }}"
                                            class="inline-flex items-center gap-1 rounded-lg bg-yellow-100 px-4 py-2 text-xs font-semibold text-yellow-700 transition hover:bg-yellow-200"
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
                                                    d="M11 5H6a2 2 0 00-2 2v11a2 2 0 002 2h11a2 2 0 002-2v-5M18.5 2.5a2.121 2.121 0 013 3L12 15l-4 1 1-4 9.5-9.5z"
                                                />
                                            </svg>

                                            Edit

                                        </a>


                                        {{-- Hapus --}}
                                        <form
                                            action="{{ route('suppliers.destroy', $supplier->id) }}"
                                            method="POST"
                                            onsubmit="return confirm('Apakah Anda yakin ingin menghapus supplier ini?');"
                                        >

                                            @csrf

                                            @method('DELETE')

                                            <button
                                                type="submit"
                                                class="inline-flex items-center gap-1 rounded-lg bg-red-100 px-4 py-2 text-xs font-semibold text-red-700 transition hover:bg-red-200"
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
                                                        d="M3 6h18M8 6V4h8v2m-9 0l1 14h8l1-14M10 11v5M14 11v5"
                                                    />
                                                </svg>

                                                Hapus

                                            </button>

                                        </form>

                                    @else

                                        {{-- Manager hanya dapat melihat supplier --}}
                                        <span class="text-xs text-gray-400 dark:text-gray-500">
                                            -
                                        </span>

                                    @endif

                                </div>

                            </td>

                        </tr>

                    @empty

                        <tr>

                            <td
                                colspan="6"
                                class="px-6 py-16 text-center"
                            >

                                <div class="flex flex-col items-center">

                                    <svg
                                        class="h-14 w-14 text-gray-300 dark:text-gray-600"
                                        fill="none"
                                        stroke="currentColor"
                                        stroke-width="1.5"
                                        viewBox="0 0 24 24"
                                    >
                                        <path
                                            stroke-linecap="round"
                                            stroke-linejoin="round"
                                            d="M3 21h18M5 21V9l7-5 7 5v12M9 21v-6h6v6"
                                        />
                                    </svg>


                                    <p
                                        class="mt-4 text-base font-semibold text-gray-500 dark:text-gray-300"
                                    >
                                        Belum ada supplier
                                    </p>


                                    <p
                                        class="mt-1 text-sm text-gray-400 dark:text-gray-500"
                                    >
                                        Silakan tambahkan supplier baru.
                                    </p>


                                    {{-- Tombol Tambah hanya untuk Admin --}}
                                    @if (auth()->user()->role === 'admin')

                                        <a
                                            href="{{ route('suppliers.create') }}"
                                            class="mt-5 inline-flex items-center rounded-xl bg-blue-600 px-5 py-3 text-sm font-semibold text-white transition hover:bg-blue-700"
                                        >

                                            <svg
                                                class="mr-2 h-5 w-5"
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

                                            Tambah Supplier

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