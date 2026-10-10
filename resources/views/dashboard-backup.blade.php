@extends('layouts.app')

@section('title', 'Dashboard')

@section('page-title', 'Dashboard')

@section('content')

{{-- Aktivitas Terbaru --}}
<div class="rounded-xl border border-gray-200 bg-white shadow-sm">

    {{-- Header Aktivitas --}}
    <div class="border-b border-gray-200 px-6 py-5">

        <div class="flex flex-col gap-3 sm:flex-row sm:items-center sm:justify-between">

            <div>
                <h2 class="text-lg font-semibold text-gray-900">
                    Aktivitas Terbaru
                </h2>

                <p class="mt-1 text-sm text-gray-500">
                    Riwayat aktivitas pengguna terbaru dalam sistem.
                </p>
            </div>

            @auth
                @if (auth()->user()->role === 'admin')
                    <a
                        href="{{ route('activity-logs.index') }}"
                        class="inline-flex items-center justify-center rounded-lg bg-blue-600 px-4 py-2 text-sm font-semibold text-white transition hover:bg-blue-700"
                    >
                        Lihat Semua Aktivitas
                    </a>
                @endif
            @endauth

        </div>

    </div>

    {{-- Daftar Aktivitas --}}
    <div class="divide-y divide-gray-100">

        @forelse (($recentActivities ?? collect()) as $activity)

            <div class="flex items-start gap-4 px-6 py-4 transition hover:bg-gray-50">

                {{-- Ikon Aktivitas --}}
                <div class="flex h-10 w-10 shrink-0 items-center justify-center rounded-full bg-blue-100 text-blue-600">

                    <svg
                        xmlns="http://www.w3.org/2000/svg"
                        class="h-5 w-5"
                        fill="none"
                        viewBox="0 0 24 24"
                        stroke="currentColor"
                        stroke-width="2"
                    >
                        <path
                            stroke-linecap="round"
                            stroke-linejoin="round"
                            d="M12 8v4l3 2m6-2a9 9 0 11-18 0 9 9 0 0118 0z"
                        />
                    </svg>

                </div>

                {{-- Detail Aktivitas --}}
                <div class="min-w-0 flex-1">

                    <div class="flex flex-col gap-1 sm:flex-row sm:items-center sm:justify-between">

                        <p class="font-semibold text-gray-900">
                            {{ $activity->activity ?? 'Aktivitas Sistem' }}
                        </p>

                        <span class="text-xs text-gray-400">
                            @if ($activity->created_at)
                                {{ $activity->created_at->format('d-m-Y H:i') }}
                            @else
                                -
                            @endif
                        </span>

                    </div>

                    <p class="mt-1 text-sm text-gray-600">
                        {{ $activity->description ?? 'Tidak ada deskripsi aktivitas.' }}
                    </p>

                    {{-- Modul dan Pengguna --}}
                    <div class="mt-2 flex flex-wrap items-center gap-2 text-xs text-gray-500">

                        <span class="rounded-full bg-gray-100 px-2 py-1">
                            {{ $activity->module ?? 'Sistem' }}
                        </span>

                        <span>
                            Oleh:
                            {{ optional($activity->user)->name ?? 'Sistem' }}
                        </span>

                    </div>

                </div>

            </div>

        @empty

            <div class="px-6 py-8 text-center text-gray-500">

                <p class="font-medium">
                    Belum ada aktivitas terbaru.
                </p>

                <p class="mt-1 text-xs text-gray-400">
                    Aktivitas pengguna akan muncul di bagian ini.
                </p>

            </div>

        @endforelse

    </div>

</div>

@endsection