@extends('layouts.app')

@section('title', 'Riwayat Aktivitas')

@section('page-title', 'Riwayat Aktivitas')

@section('content')

<div class="space-y-6">

    <div>
        <h2 class="text-2xl font-bold text-gray-800 dark:text-white">
            Riwayat Aktivitas
        </h2>

        <p class="text-sm text-gray-500 dark:text-gray-400 mt-1">
            Daftar aktivitas pengguna dalam sistem Stockify.
        </p>
    </div>

    <div class="bg-white dark:bg-gray-800 rounded-xl shadow-sm border border-gray-200 dark:border-gray-700 overflow-hidden">

        <div class="overflow-x-auto">
            <table class="w-full text-sm text-left text-gray-600 dark:text-gray-300">

                <thead class="text-xs uppercase bg-gray-100 dark:bg-gray-700 text-gray-700 dark:text-gray-200">
                    <tr>
                        <th class="px-6 py-4">No</th>
                        <th class="px-6 py-4">Pengguna</th>
                        <th class="px-6 py-4">Aktivitas</th>
                        <th class="px-6 py-4">Deskripsi</th>
                        <th class="px-6 py-4">Modul</th>
                        <th class="px-6 py-4">IP Address</th>
                        <th class="px-6 py-4">Waktu</th>
                    </tr>
                </thead>

                <tbody>
                    @forelse ($activities as $activity)
                        <tr class="border-b border-gray-200 dark:border-gray-700 hover:bg-gray-50 dark:hover:bg-gray-700">

                            <td class="px-6 py-4">
                                {{ $activities->firstItem() + $loop->index }}
                            </td>

                            <td class="px-6 py-4 font-medium text-gray-900 dark:text-white">
                                {{ $activity->user->name ?? 'Sistem' }}
                            </td>

                            <td class="px-6 py-4">
                                <span class="inline-flex px-3 py-1 rounded-full text-xs font-semibold bg-blue-100 text-blue-800 dark:bg-blue-900 dark:text-blue-200">
                                    {{ $activity->activity }}
                                </span>
                            </td>

                            <td class="px-6 py-4">
                                {{ $activity->description ?? '-' }}
                            </td>

                            <td class="px-6 py-4">
                                {{ $activity->module ?? '-' }}
                            </td>

                            <td class="px-6 py-4">
                                {{ $activity->ip_address ?? '-' }}
                            </td>

                            <td class="px-6 py-4 whitespace-nowrap">
                                {{ $activity->created_at->format('d/m/Y H:i') }}
                            </td>

                        </tr>
                    @empty
                        <tr>
                            <td colspan="7" class="px-6 py-10 text-center text-gray-500 dark:text-gray-400">
                                Belum ada aktivitas yang tercatat.
                            </td>
                        </tr>
                    @endforelse
                </tbody>

            </table>
        </div>

        @if ($activities->hasPages())
            <div class="p-5 border-t border-gray-200 dark:border-gray-700">
                {{ $activities->links() }}
            </div>
        @endif

    </div>

</div>

@endsection