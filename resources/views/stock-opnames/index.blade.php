@extends('layouts.app')

@section('title', 'Stock Opname')
@section('page-title', 'Stock Opname')

@section('content')

<div class="mx-auto max-w-[1400px]">

    {{-- Header --}}
    <div class="mb-7 flex items-center justify-between">
        <div>
            <h2 class="text-2xl font-bold text-slate-900">
                Stock Opname
            </h2>

            <p class="mt-1 text-sm text-slate-500">
                Kelola dan pantau hasil pemeriksaan stok barang.
            </p>
        </div>

        <a
            href="{{ route('stock-opnames.create') }}"
            class="inline-flex items-center rounded-xl bg-blue-600 px-5 py-3 text-sm font-semibold text-white transition hover:bg-blue-700"
        >
            + Tambah Stock Opname
        </a>
    </div>

    {{-- Table --}}
    <div class="overflow-hidden rounded-xl border border-slate-200 bg-white shadow-sm">

        <div class="overflow-x-auto">
            <table class="w-full text-left">

                {{-- Table Header --}}
                <thead class="bg-slate-100">
                    <tr>
                        <th class="px-5 py-4 text-xs font-bold uppercase text-slate-700">
                            No
                        </th>

                        <th class="px-5 py-4 text-xs font-bold uppercase text-slate-700">
                            Produk
                        </th>

                        <th class="px-5 py-4 text-xs font-bold uppercase text-slate-700">
                            Tanggal
                        </th>

                        <th class="px-5 py-4 text-xs font-bold uppercase text-slate-700">
                            Stok Sistem
                        </th>

                        <th class="px-5 py-4 text-xs font-bold uppercase text-slate-700">
                            Stok Aktual
                        </th>

                        <th class="px-5 py-4 text-xs font-bold uppercase text-slate-700">
                            Selisih
                        </th>

                        <th class="px-5 py-4 text-xs font-bold uppercase text-slate-700">
                            Petugas
                        </th>

                        <th class="px-5 py-4 text-xs font-bold uppercase text-slate-700">
                            Keterangan
                        </th>

                        <th class="px-5 py-4 text-center text-xs font-bold uppercase text-slate-700">
                            Aksi
                        </th>
                    </tr>
                </thead>

                {{-- Table Body --}}
                <tbody class="divide-y divide-slate-100">

                    @forelse ($opnames as $index => $opname)

                        <tr class="transition hover:bg-slate-50">

                            {{-- No --}}
                            <td class="px-5 py-4 text-sm text-slate-700">
                                {{ $index + 1 }}
                            </td>

                            {{-- Produk --}}
                            <td class="px-5 py-4">
                                <div class="font-semibold text-slate-900">
                                    {{ $opname->product->name ?? '-' }}
                                </div>

                                @if ($opname->product?->sku)
                                    <div class="mt-1 text-xs text-slate-500">
                                        SKU: {{ $opname->product->sku }}
                                    </div>
                                @endif
                            </td>

                            {{-- Tanggal --}}
                            <td class="px-5 py-4 text-sm text-slate-600">
                                {{ $opname->opname_date?->format('d-m-Y') ?? '-' }}
                            </td>

                            {{-- Stok Sistem --}}
                            <td class="px-5 py-4 text-sm text-slate-600">
                                {{ number_format($opname->system_stock, 0, ',', '.') }}
                            </td>

                            {{-- Stok Aktual --}}
                            <td class="px-5 py-4 text-sm font-semibold text-slate-900">
                                {{ number_format($opname->actual_stock, 0, ',', '.') }}
                            </td>

                            {{-- Selisih --}}
                            <td class="px-5 py-4">

                                @if ($opname->difference > 0)

                                    <span class="font-semibold text-green-600">
                                        +{{ number_format($opname->difference, 0, ',', '.') }}
                                    </span>

                                @elseif ($opname->difference < 0)

                                    <span class="font-semibold text-red-600">
                                        {{ number_format($opname->difference, 0, ',', '.') }}
                                    </span>

                                @else

                                    <span class="font-semibold text-slate-600">
                                        0
                                    </span>

                                @endif

                            </td>

                            {{-- Petugas --}}
                            <td class="px-5 py-4 text-sm text-slate-600">
                                {{ $opname->user->name ?? '-' }}
                            </td>

                            {{-- Keterangan --}}
                            <td class="max-w-[180px] px-5 py-4 text-sm text-slate-600">
                                <div class="truncate">
                                    {{ $opname->notes ?: '-' }}
                                </div>
                            </td>

                            {{-- Aksi --}}
                            <td class="px-5 py-4">

                                <div class="flex items-center justify-center gap-2">

                                    {{-- Detail --}}
                                    <a
                                        href="{{ route('stock-opnames.show', $opname->id) }}"
                                        style="background-color: #2563eb; color: #ffffff;"
                                        class="inline-flex items-center justify-center rounded-lg px-4 py-2 text-xs font-semibold transition hover:opacity-90"
                                    >
                                        Detail
                                    </a>


                                    {{-- Edit dan Hapus hanya untuk Admin --}}
                                    @if (auth()->user()->role === 'admin')

                                        {{-- Edit --}}
                                        <a
                                            href="{{ route('stock-opnames.edit', $opname->id) }}"
                                            style="background-color: #f59e0b; color: #ffffff;"
                                            class="inline-flex items-center justify-center rounded-lg px-4 py-2 text-xs font-semibold transition hover:opacity-90"
                                        >
                                            ✎ Edit
                                        </a>


                                        {{-- Hapus --}}
                                        <form
                                            action="{{ route('stock-opnames.destroy', $opname->id) }}"
                                            method="POST"
                                            onsubmit="return confirm('Apakah Anda yakin ingin menghapus data stock opname ini?')"
                                        >
                                            @csrf

                                            @method('DELETE')

                                            <button
                                                type="submit"
                                                style="background-color: #ef4444; color: #ffffff;"
                                                class="inline-flex items-center justify-center rounded-lg px-4 py-2 text-xs font-semibold transition hover:opacity-90"
                                            >
                                                🗑 Hapus
                                            </button>
                                        </form>

                                    @endif

                                </div>

                            </td>

                        </tr>

                    @empty

                        <tr>
                            <td
                                colspan="9"
                                class="px-5 py-12 text-center"
                            >
                                <div class="text-sm font-medium text-slate-500">
                                    Belum ada data stock opname.
                                </div>

                                <a
                                    href="{{ route('stock-opnames.create') }}"
                                    class="mt-3 inline-block text-sm font-semibold text-blue-600 hover:text-blue-700"
                                >
                                    + Tambah Stock Opname
                                </a>
                            </td>
                        </tr>

                    @endforelse

                </tbody>

            </table>
        </div>

    </div>

</div>

@endsection