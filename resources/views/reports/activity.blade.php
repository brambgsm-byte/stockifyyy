@extends('layouts.app')

@section('title', 'Laporan Aktivitas Pengguna')
@section('page-title', 'Laporan Aktivitas Pengguna')

@section('content')
<div class="space-y-6">

    {{-- Header Halaman --}}
    <div class="flex flex-col gap-4 md:flex-row md:items-center md:justify-between">
        <div>
            <h2 class="text-2xl font-bold text-gray-800 dark:text-white">
                Laporan Aktivitas Pengguna
            </h2>
            <p class="mt-1 text-sm text-gray-500 dark:text-gray-400">
                Pantau seluruh aktivitas pengguna dalam sistem Stockify.
            </p>
        </div>

        <a href="{{ route('reports.index') }}"
           class="inline-flex items-center justify-center rounded-lg bg-gray-600 px-4 py-2.5 text-sm font-medium text-white transition hover:bg-gray-700">
            <svg class="mr-2 h-5 w-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                      d="M10 19l-7-7m0 0l7-7m-7 7h18"/>
            </svg>
            Kembali ke Laporan
        </a>
    </div>

    {{-- Filter Aktivitas --}}
    <div class="rounded-xl bg-white p-6 shadow-sm dark:bg-gray-800">
        <form method="GET" action="{{ route('reports.activity') }}">
            <div class="grid grid-cols-1 gap-4 md:grid-cols-4">

                {{-- Tanggal Mulai --}}
                <div>
                    <label for="start_date"
                           class="mb-2 block text-sm font-medium text-gray-700 dark:text-gray-300">
                        Tanggal Mulai
                    </label>

                    <input type="date"
                           id="start_date"
                           name="start_date"
                           value="{{ $startDate ?? request('start_date') }}"
                           class="block w-full rounded-lg border border-gray-300 bg-gray-50 p-2.5 text-sm text-gray-900 focus:border-blue-500 focus:ring-blue-500 dark:border-gray-600 dark:bg-gray-700 dark:text-white">
                </div>

                {{-- Tanggal Akhir --}}
                <div>
                    <label for="end_date"
                           class="mb-2 block text-sm font-medium text-gray-700 dark:text-gray-300">
                        Tanggal Akhir
                    </label>

                    <input type="date"
                           id="end_date"
                           name="end_date"
                           value="{{ $endDate ?? request('end_date') }}"
                           class="block w-full rounded-lg border border-gray-300 bg-gray-50 p-2.5 text-sm text-gray-900 focus:border-blue-500 focus:ring-blue-500 dark:border-gray-600 dark:bg-gray-700 dark:text-white">
                </div>

                {{-- Pengguna --}}
                <div>
                    <label for="user_id"
                           class="mb-2 block text-sm font-medium text-gray-700 dark:text-gray-300">
                        Pengguna
                    </label>

                    <select id="user_id"
                            name="user_id"
                            class="block w-full rounded-lg border border-gray-300 bg-gray-50 p-2.5 text-sm text-gray-900 focus:border-blue-500 focus:ring-blue-500 dark:border-gray-600 dark:bg-gray-700 dark:text-white">

                        <option value="">Semua Pengguna</option>

                        @foreach ($users as $user)
                            <option value="{{ $user->id }}"
                                {{ (string) ($userId ?? request('user_id')) === (string) $user->id ? 'selected' : '' }}>
                                {{ $user->name }}
                            </option>
                        @endforeach
                    </select>
                </div>

                {{-- Tombol --}}
                <div class="flex items-end gap-2">
                    <button type="submit"
                            class="inline-flex w-full items-center justify-center rounded-lg bg-blue-600 px-4 py-2.5 text-sm font-medium text-white transition hover:bg-blue-700">
                        <svg class="mr-2 h-5 w-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                  d="M21 21l-6-6m2-5a7 7 0 11-14 0 7 7 0 0114 0z"/>
                        </svg>
                        Filter
                    </button>

                    <a href="{{ route('reports.activity') }}"
                       class="inline-flex items-center justify-center rounded-lg bg-gray-200 px-4 py-2.5 text-sm font-medium text-gray-700 transition hover:bg-gray-300 dark:bg-gray-700 dark:text-gray-200 dark:hover:bg-gray-600">
                        Reset
                    </a>
                </div>

            </div>
        </form>
    </div>

    {{-- Tabel Aktivitas --}}
    <div class="overflow-hidden rounded-xl bg-white shadow-sm dark:bg-gray-800">
        <div class="border-b border-gray-200 px-6 py-4 dark:border-gray-700">
            <h3 class="text-lg font-semibold text-gray-800 dark:text-white">
                Riwayat Aktivitas
            </h3>

            <p class="mt-1 text-sm text-gray-500 dark:text-gray-400">
                Daftar aktivitas yang dilakukan oleh pengguna.
            </p>
        </div>

        <div class="overflow-x-auto">
            <table class="w-full text-left text-sm text-gray-500 dark:text-gray-400">
                <thead class="bg-gray-50 text-xs uppercase text-gray-700 dark:bg-gray-700 dark:text-gray-300">
                    <tr>
                        <th scope="col" class="px-6 py-4">No.</th>
                        <th scope="col" class="px-6 py-4">Pengguna</th>
                        <th scope="col" class="px-6 py-4">Aktivitas</th>
                        <th scope="col" class="px-6 py-4">Deskripsi</th>
                        <th scope="col" class="px-6 py-4">Modul</th>
                        <th scope="col" class="px-6 py-4">IP Address</th>
                        <th scope="col" class="px-6 py-4">Waktu</th>
                    </tr>
                </thead>

                <tbody>
                    @forelse ($activities as $activity)
                        <tr class="border-b bg-white hover:bg-gray-50 dark:border-gray-700 dark:bg-gray-800 dark:hover:bg-gray-700">

                            <td class="whitespace-nowrap px-6 py-4 font-medium text-gray-900 dark:text-white">
                                {{ $activities->firstItem() + $loop->index }}
                            </td>

                            <td class="whitespace-nowrap px-6 py-4">
                                <div class="font-medium text-gray-900 dark:text-white">
                                    {{ $activity->user->name ?? 'Pengguna dihapus' }}
                                </div>

                                @if ($activity->user)
                                    <div class="text-xs text-gray-500 dark:text-gray-400">
                                        {{ ucfirst($activity->user->role ?? '-') }}
                                    </div>
                                @endif
                            </td>

                            <td class="whitespace-nowrap px-6 py-4">
                                <span class="rounded-full bg-blue-100 px-3 py-1 text-xs font-medium text-blue-800 dark:bg-blue-900 dark:text-blue-300">
                                    {{ $activity->activity }}
                                </span>
                            </td>

                            <td class="min-w-[250px] px-6 py-4 text-gray-700 dark:text-gray-300">
                                {{ $activity->description ?? '-' }}
                            </td>

                            <td class="whitespace-nowrap px-6 py-4">
                                {{ $activity->module ?? '-' }}
                            </td>

                            <td class="whitespace-nowrap px-6 py-4">
                                {{ $activity->ip_address ?? '-' }}
                            </td>

                            <td class="whitespace-nowrap px-6 py-4">
                                {{ $activity->created_at?->format('d/m/Y H:i:s') ?? '-' }}
                            </td>

                        </tr>
                    @empty
                        <tr>
                            <td colspan="7"
                                class="px-6 py-8 text-center text-gray-500 dark:text-gray-400">
                                Belum ada aktivitas pengguna.
                            </td>
                        </tr>
                    @endforelse
                </tbody>
            </table>
        </div>

        {{-- Pagination --}}
        @if ($activities->hasPages())
            <div class="border-t border-gray-200 px-6 py-4 dark:border-gray-700">
                {{ $activities->links() }}
            </div>
        @endif
    </div>

</div>
@endsection