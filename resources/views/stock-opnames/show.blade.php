@extends('layouts.app')

@section('title', 'Detail Stock Opname')
@section('page-title', 'Detail Stock Opname')

@section('content')

<div class="mx-auto max-w-5xl">

    {{-- Header --}}
    <div class="mb-6 flex flex-col gap-4 sm:flex-row sm:items-center sm:justify-between">
        <div>
            <h2 class="text-2xl font-bold text-slate-900">
                Detail Stock Opname
            </h2>
            <p class="mt-1 text-sm text-slate-500">
                Informasi lengkap hasil pemeriksaan stok barang.
            </p>
        </div>

        <div class="flex items-center gap-3">
            <a
                href="{{ route('stock-opnames.index') }}"
                class="inline-flex items-center gap-2 rounded-xl border border-slate-200 bg-white px-5 py-3 text-sm font-semibold text-slate-700 transition hover:bg-slate-50"
            >
                ← Kembali
            </a>    
        </div>
    </div>

    {{-- Informasi utama --}}
    <div class="mb-6 grid grid-cols-1 gap-5 md:grid-cols-3">

        {{-- Stok Sistem --}}
        <div class="rounded-2xl border border-slate-200 bg-white p-6 shadow-sm">
            <div class="mb-4 flex items-center justify-between">
                <div>
                    <p class="text-sm font-medium text-slate-500">
                        Stok Sistem
                    </p>

                    <p class="mt-2 text-3xl font-bold text-slate-900">
                        {{ number_format($opname->system_stock, 0, ',', '.') }}
                    </p>
                </div>

                <div class="flex h-12 w-12 items-center justify-center rounded-xl bg-slate-100 text-xl">
                    📦
                </div>
            </div>

            <p class="text-xs text-slate-500">
                Stok yang tercatat di sistem saat opname dilakukan.
            </p>
        </div>

        {{-- Stok Aktual --}}
        <div class="rounded-2xl border border-slate-200 bg-white p-6 shadow-sm">
            <div class="mb-4 flex items-center justify-between">
                <div>
                    <p class="text-sm font-medium text-slate-500">
                        Stok Aktual
                    </p>

                    <p class="mt-2 text-3xl font-bold text-blue-600">
                        {{ number_format($opname->actual_stock, 0, ',', '.') }}
                    </p>
                </div>

                <div class="flex h-12 w-12 items-center justify-center rounded-xl bg-blue-50 text-xl">
                    🔎
                </div>
            </div>

            <p class="text-xs text-slate-500">
                Jumlah stok berdasarkan hasil pengecekan fisik.
            </p>
        </div>

        {{-- Selisih --}}
        <div class="rounded-2xl border border-slate-200 bg-white p-6 shadow-sm">
            <div class="mb-4 flex items-center justify-between">
                <div>
                    <p class="text-sm font-medium text-slate-500">
                        Selisih
                    </p>

                    <p class="mt-2 text-3xl font-bold
                        @if ($opname->difference > 0)
                            text-green-600
                        @elseif ($opname->difference < 0)
                            text-red-600
                        @else
                            text-slate-900
                        @endif
                    ">
                        @if ($opname->difference > 0)
                            +
                        @endif

                        {{ number_format($opname->difference, 0, ',', '.') }}
                    </p>
                </div>

                <div class="flex h-12 w-12 items-center justify-center rounded-xl
                    @if ($opname->difference > 0)
                        bg-green-50
                    @elseif ($opname->difference < 0)
                        bg-red-50
                    @else
                        bg-slate-100
                    @endif
                    text-xl"
                >
                    @if ($opname->difference > 0)
                        ↑
                    @elseif ($opname->difference < 0)
                        ↓
                    @else
                        =
                    @endif
                </div>
            </div>

            <p class="text-xs text-slate-500">
                Selisih antara stok aktual dan stok sistem.
            </p>
        </div>

    </div>

    {{-- Detail --}}
    <div class="overflow-hidden rounded-2xl border border-slate-200 bg-white shadow-sm">

        <div class="border-b border-slate-200 px-6 py-5">
            <h3 class="text-lg font-bold text-slate-900">
                Informasi Stock Opname
            </h3>

            <p class="mt-1 text-sm text-slate-500">
                Detail data pemeriksaan stok.
            </p>
        </div>

        <div class="grid grid-cols-1 gap-x-8 gap-y-6 p-6 md:grid-cols-2">

            {{-- Produk --}}
            <div>
                <p class="mb-1 text-sm font-medium text-slate-500">
                    Produk
                </p>

                <p class="text-base font-semibold text-slate-900">
                    {{ $opname->product->name ?? '-' }}
                </p>
            </div>

            {{-- SKU --}}
            <div>
                <p class="mb-1 text-sm font-medium text-slate-500">
                    SKU
                </p>

                <p class="text-base font-semibold text-slate-900">
                    {{ $opname->product->sku ?? '-' }}
                </p>
            </div>

            {{-- Tanggal --}}
            <div>
                <p class="mb-1 text-sm font-medium text-slate-500">
                    Tanggal Opname
                </p>

                <p class="text-base font-semibold text-slate-900">
                    {{ $opname->opname_date?->format('d F Y') ?? '-' }}
                </p>
            </div>

            {{-- Petugas --}}
            <div>
                <p class="mb-1 text-sm font-medium text-slate-500">
                    Dilakukan Oleh
                </p>

                <p class="text-base font-semibold text-slate-900">
                    {{ $opname->user->name ?? '-' }}
                </p>
            </div>

            {{-- Kategori --}}
            <div>
                <p class="mb-1 text-sm font-medium text-slate-500">
                    Kategori
                </p>

                <p class="text-base font-semibold text-slate-900">
                    {{ $opname->product->category->name ?? '-' }}
                </p>
            </div>

            {{-- Status --}}
            <div>
                <p class="mb-1 text-sm font-medium text-slate-500">
                    Status
                </p>

                @if ($opname->difference > 0)
                    <span class="inline-flex rounded-full bg-green-100 px-3 py-1 text-xs font-semibold text-green-700">
                        Stok Bertambah
                    </span>
                @elseif ($opname->difference < 0)
                    <span class="inline-flex rounded-full bg-red-100 px-3 py-1 text-xs font-semibold text-red-700">
                        Stok Berkurang
                    </span>
                @else
                    <span class="inline-flex rounded-full bg-slate-100 px-3 py-1 text-xs font-semibold text-slate-700">
                        Stok Sesuai
                    </span>
                @endif
            </div>

        </div>

        {{-- Catatan --}}
        <div class="border-t border-slate-200 px-6 py-5">

            <p class="mb-2 text-sm font-medium text-slate-500">
                Catatan
            </p>

            <div class="rounded-xl bg-slate-50 p-4 text-sm leading-6 text-slate-700">
                {{ $opname->notes ?: 'Tidak ada catatan.' }}
            </div>

        </div>

    </div>

    {{-- Ringkasan --}}
    <div class="mt-6 rounded-2xl border border-blue-100 bg-blue-50 p-6">

        <h3 class="text-base font-bold text-blue-900">
            Ringkasan
        </h3>

        <p class="mt-2 text-sm leading-6 text-blue-800">

            Pada tanggal
            <strong>
                {{ $opname->opname_date?->format('d F Y') ?? '-' }}
            </strong>,

            produk
            <strong>
                {{ $opname->product->name ?? '-' }}
            </strong>

            memiliki stok sistem sebanyak
            <strong>
                {{ number_format($opname->system_stock, 0, ',', '.') }}
            </strong>

            dan stok aktual sebanyak
            <strong>
                {{ number_format($opname->actual_stock, 0, ',', '.') }}
            </strong>.

            Terdapat selisih sebesar
            <strong>
                {{ number_format(abs($opname->difference), 0, ',', '.') }}
            </strong>
            unit.
        </p>

    </div>

</div>

@endsection