@extends('layouts.app')

@section('title', 'Manajemen Pengguna')

@section('content')
<div class="space-y-6">

    {{-- Header --}}
    <div class="flex items-center justify-between">
        <div>
            <h1 class="text-2xl font-bold text-slate-800">
                Manajemen Pengguna
            </h1>

            <p class="mt-1 text-sm text-slate-500">
                Kelola data pengguna aplikasi Stockify.
            </p>
        </div>

        <a href="{{ route('users.create') }}"
           style="background-color: #2563eb; color: white; padding: 12px 18px; border-radius: 8px; font-weight: 600; text-decoration: none;">
            + Tambah Pengguna
        </a>
    </div>

    {{-- Notifikasi Berhasil --}}
    @if (session('success'))
        <div class="rounded-lg border border-green-200 bg-green-50 px-5 py-4 text-green-700">
            {{ session('success') }}
        </div>
    @endif

    {{-- Notifikasi Error --}}
    @if (session('error'))
        <div class="rounded-lg border border-red-200 bg-red-50 px-5 py-4 text-red-700">
            {{ session('error') }}
        </div>
    @endif

    {{-- Tabel Pengguna --}}
    <div class="overflow-hidden rounded-xl bg-white shadow">
        <div class="overflow-x-auto">
            <table class="w-full text-left text-sm text-slate-600">
                <thead class="bg-slate-100 text-xs uppercase text-slate-700">
                    <tr>
                        <th class="px-6 py-4">No</th>
                        <th class="px-6 py-4">Nama</th>
                        <th class="px-6 py-4">Email</th>
                        <th class="px-6 py-4">Role</th>
                        <th class="px-6 py-4 text-center">Aksi</th>
                    </tr>
                </thead>

                <tbody>
                    @forelse ($users as $user)
                        <tr class="border-b hover:bg-slate-50">

                            <td class="px-6 py-4">
                                {{ $loop->iteration }}
                            </td>

                            <td class="px-6 py-4 font-semibold text-slate-800">
                                {{ $user->name }}
                            </td>

                            <td class="px-6 py-4">
                                {{ $user->email }}
                            </td>

                            <td class="px-6 py-4">
                                @if ($user->role === 'admin')
                                    <span style="background-color: #fee2e2; color: #b91c1c; padding: 6px 14px; border-radius: 999px; font-size: 12px; font-weight: 600;">
                                        Admin
                                    </span>
                                @elseif ($user->role === 'manager')
                                    <span style="background-color: #dbeafe; color: #1d4ed8; padding: 6px 14px; border-radius: 999px; font-size: 12px; font-weight: 600;">
                                        Manager
                                    </span>
                                @else
                                    <span style="background-color: #dcfce7; color: #15803d; padding: 6px 14px; border-radius: 999px; font-size: 12px; font-weight: 600;">
                                        Staff
                                    </span>
                                @endif
                            </td>

                            {{-- Tombol Aksi --}}
                            <td class="px-6 py-4">
                                <div style="display: flex; align-items: center; justify-content: center; gap: 8px;">

                                    {{-- Tombol Edit --}}
                                    <a href="{{ route('users.edit', $user->id) }}"
                                       style="display: inline-block; background-color: #f59e0b; color: white; padding: 9px 14px; border-radius: 7px; font-size: 12px; font-weight: 600; text-decoration: none;">
                                        Edit
                                    </a>

                                    {{-- Tombol Hapus --}}
                                    <form action="{{ route('users.destroy', $user->id) }}"
                                          method="POST"
                                          onsubmit="return confirm('Apakah Anda yakin ingin menghapus pengguna ini?')"
                                          style="display: inline-block; margin: 0;">
                                        @csrf
                                        @method('DELETE')

                                        <button type="submit"
                                                style="background-color: #dc2626; color: white; padding: 9px 14px; border: none; border-radius: 7px; font-size: 12px; font-weight: 600; cursor: pointer;">
                                            Hapus
                                        </button>
                                    </form>

                                </div>
                            </td>

                        </tr>
                    @empty
                        <tr>
                            <td colspan="5" class="px-6 py-8 text-center text-slate-500">
                                Belum ada data pengguna.
                            </td>
                        </tr>
                    @endforelse
                </tbody>
            </table>
        </div>
    </div>

</div>
@endsection