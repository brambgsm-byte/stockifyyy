@extends('layouts.app')

@section('title', 'Transaksi Stok - Stockify')

@section('page-title', 'Transaksi Stok')

@section('content')
    <div class="min-h-screen bg-gray-50">

        {{-- Header Halaman --}}
        <div class="border-b border-gray-200 bg-white px-8 py-6">
            <div class="flex items-center justify-between">
                <div>
                    <h1 class="text-2xl font-semibold text-gray-900">
                        Transaksi Stok
                    </h1>

                    <p class="mt-1 text-sm text-gray-500">
                        Kelola dan pantau transaksi barang masuk dan barang keluar.
                    </p>
                </div>

                {{-- Tambah Transaksi --}}
                <a
                    href="{{ route('stock-transactions.create') }}"
                    class="inline-flex items-center rounded-lg bg-blue-600 px-5 py-3 text-sm font-semibold text-white transition hover:bg-blue-700"
                >
                    + Tambah Transaksi
                </a>
            </div>
        </div>

        {{-- Konten --}}
        <div class="px-8 py-8">

            {{-- Pesan Error --}}
            @if ($errors->any())
                <div class="mb-6 rounded-lg border border-red-200 bg-red-50 px-5 py-4 text-sm text-red-700">
                    <div class="mb-2 font-semibold">
                        Terdapat kesalahan:
                    </div>

                    <ul class="list-disc space-y-1 pl-5">
                        @foreach ($errors->all() as $error)
                            <li>{{ $error }}</li>
                        @endforeach
                    </ul>
                </div>
            @endif

            {{-- Tabel Transaksi --}}
            <div class="overflow-hidden rounded-xl border border-gray-200 bg-white shadow-sm">

                {{-- Header Tabel --}}
                <div class="border-b border-gray-200 px-7 py-6">
                    <h2 class="text-xl font-semibold text-gray-900">
                        Riwayat Transaksi
                    </h2>

                    <p class="mt-1 text-sm text-gray-500">
                        Daftar seluruh transaksi stok yang tercatat dalam sistem.
                    </p>
                </div>

                {{-- Tabel --}}
                <div class="overflow-x-auto">
                    <table class="w-full text-left text-sm text-gray-600">

                        <thead class="bg-gray-100 text-xs uppercase text-gray-700">
                            <tr>
                                <th class="whitespace-nowrap px-6 py-4">
                                    No
                                </th>

                                <th class="whitespace-nowrap px-6 py-4">
                                    Tanggal
                                </th>

                                <th class="whitespace-nowrap px-6 py-4">
                                    Produk
                                </th>

                                <th class="whitespace-nowrap px-6 py-4">
                                    Jenis Transaksi
                                </th>

                                <th class="whitespace-nowrap px-6 py-4 text-center">
                                    Jumlah
                                </th>

                                <th class="whitespace-nowrap px-6 py-4">
                                    Keterangan
                                </th>

                                <th class="whitespace-nowrap px-6 py-4">
                                    User
                                </th>

                                <th class="whitespace-nowrap px-6 py-4 text-center">
                                    Status
                                </th>

                                <th class="whitespace-nowrap px-6 py-4 text-center">
                                    Aksi
                                </th>
                            </tr>
                        </thead>

                        <tbody>

                            @forelse ($transactions as $index => $transaction)

                                <tr class="border-b border-gray-200 bg-white transition hover:bg-gray-50">

                                    {{-- Nomor --}}
                                    <td class="px-6 py-5">
                                        {{ $index + 1 }}
                                    </td>

                                    {{-- Tanggal --}}
                                    <td class="whitespace-nowrap px-6 py-5">
                                        {{ $transaction->transaction_date?->format('d-m-Y') ?? '-' }}
                                    </td>

                                    {{-- Produk --}}
                                    <td class="px-6 py-5">
                                        <div class="font-medium text-gray-900">
                                            {{ $transaction->product?->name ?? '-' }}
                                        </div>

                                        @if ($transaction->product?->code)
                                            <div class="mt-1 text-xs text-gray-500">
                                                {{ $transaction->product->code }}
                                            </div>
                                        @endif
                                    </td>

                                    {{-- Jenis Transaksi --}}
                                    <td class="px-6 py-5">

                                        @if ($transaction->type === 'in')

                                            <span
                                                class="inline-flex whitespace-nowrap rounded-full bg-green-100 px-3 py-1 text-xs font-semibold text-green-700"
                                            >
                                                Barang Masuk
                                            </span>

                                        @else

                                            <span
                                                class="inline-flex whitespace-nowrap rounded-full bg-red-100 px-3 py-1 text-xs font-semibold text-red-700"
                                            >
                                                Barang Keluar
                                            </span>

                                        @endif

                                    </td>

                                    {{-- Jumlah --}}
                                    <td class="px-6 py-5 text-center font-semibold text-gray-900">
                                        {{ number_format($transaction->quantity, 0, ',', '.') }}
                                    </td>

                                    {{-- Keterangan --}}
                                    <td class="px-6 py-5">
                                        {{ $transaction->description ?: '-' }}
                                    </td>

                                    {{-- User --}}
                                    <td class="px-6 py-5">
                                        {{ $transaction->user?->name ?? '-' }}
                                    </td>

                                    {{-- Status --}}
                                    <td class="px-6 py-5 text-center">

                                        @if ($transaction->status === 'confirmed')

                                            <span
                                                class="inline-flex whitespace-nowrap rounded-full bg-green-100 px-3 py-1 text-xs font-semibold text-green-700"
                                            >
                                                Terkonfirmasi
                                            </span>

                                        @else

                                            <span
                                                class="inline-flex whitespace-nowrap rounded-full bg-yellow-100 px-3 py-1 text-xs font-semibold text-yellow-700"
                                            >
                                                Menunggu Konfirmasi
                                            </span>

                                        @endif

                                    </td>

                                    {{-- Aksi --}}
                                    <td class="px-6 py-5">

                                        <div class="flex min-w-max items-center justify-center gap-2">

                                            {{-- ========================================= --}}
                                            {{-- STAFF: KONFIRMASI TRANSAKSI --}}
                                            {{-- ========================================= --}}

                                            @if (
                                                auth()->user()->role === 'staff' &&
                                                $transaction->status === 'pending'
                                            )

                                                <form
                                                    action="{{ route('stock-transactions.confirm', $transaction->id) }}"
                                                    method="POST"
                                                    onsubmit="return confirm('Apakah Anda yakin ingin mengonfirmasi transaksi ini?');"
                                                >

                                                    @csrf

                                                    <button
                                                        type="submit"
                                                        style="background-color: #16a34a !important; color: #ffffff !important; border: none !important; opacity: 1 !important;"
                                                        class="inline-flex min-w-[120px] items-center justify-center rounded-lg px-4 py-2 text-sm font-semibold shadow-sm transition hover:opacity-90"
                                                    >
                                                        <span style="color: #ffffff !important;">
                                                            Konfirmasi
                                                        </span>
                                                    </button>

                                                </form>

                                            @endif


                                            {{-- ========================================= --}}
                                            {{-- ADMIN: HAPUS TRANSAKSI --}}
                                            {{-- ========================================= --}}

                                            @if (auth()->user()->role === 'admin')

                                                <form
                                                    action="{{ route('stock-transactions.destroy', $transaction->id) }}"
                                                    method="POST"
                                                    onsubmit="return confirm('Apakah Anda yakin ingin menghapus transaksi ini? Stok produk juga akan disesuaikan kembali.');"
                                                >

                                                    @csrf

                                                    @method('DELETE')

                                                    <button
                                                        type="submit"
                                                        style="background-color: #dc2626 !important; color: #ffffff !important; border: none !important; opacity: 1 !important;"
                                                        class="inline-flex min-w-[80px] items-center justify-center rounded-lg px-4 py-2 text-sm font-semibold shadow-sm transition hover:opacity-90"
                                                    >
                                                        <span style="color: #ffffff !important;">
                                                            Hapus
                                                        </span>
                                                    </button>

                                                </form>

                                            @endif


                                            {{-- ========================================= --}}
                                            {{-- TIDAK ADA AKSI --}}
                                            {{-- ========================================= --}}

                                            @if (
                                                auth()->user()->role === 'manager' ||
                                                (
                                                    auth()->user()->role === 'staff' &&
                                                    $transaction->status === 'confirmed'
                                                )
                                            )

                                                <span class="text-sm text-gray-400">
                                                    -
                                                </span>

                                            @endif

                                        </div>

                                    </td>

                                </tr>

                            @empty

                                <tr>

                                    <td
                                        colspan="9"
                                        class="px-6 py-16 text-center"
                                    >

                                        <p class="text-base font-medium text-gray-400">
                                            Belum ada transaksi stok.
                                        </p>

                                        <p class="mt-2 text-sm text-gray-400">
                                            Silakan tambahkan transaksi barang masuk atau barang keluar.
                                        </p>

                                    </td>

                                </tr>

                            @endforelse

                        </tbody>

                    </table>
                </div>

            </div>

        </div>

    </div>
@endsection