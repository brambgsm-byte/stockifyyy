@extends('layouts.app')

@section('title', 'Edit Pengguna')

@section('content')
<div class="space-y-6">

    <div>
        <h1 class="text-2xl font-bold text-slate-800">
            Edit Pengguna
        </h1>

        <p class="mt-1 text-sm text-slate-500">
            Perbarui informasi pengguna aplikasi Stockify.
        </p>
    </div>

    <div class="rounded-xl bg-white p-6 shadow">
        <form action="{{ route('users.update', $user->id) }}" method="POST" class="space-y-5">
            @csrf
            @method('PUT')

            {{-- Nama --}}
            <div>
                <label for="name" class="mb-2 block text-sm font-medium text-slate-700">
                    Nama Pengguna
                </label>

                <input
                    type="text"
                    id="name"
                    name="name"
                    value="{{ old('name', $user->name) }}"
                    class="w-full rounded-lg border border-slate-300 px-4 py-2.5 text-sm"
                    required
                >

                @error('name')
                    <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                @enderror
            </div>

            {{-- Email --}}
            <div>
                <label for="email" class="mb-2 block text-sm font-medium text-slate-700">
                    Email
                </label>

                <input
                    type="email"
                    id="email"
                    name="email"
                    value="{{ old('email', $user->email) }}"
                    class="w-full rounded-lg border border-slate-300 px-4 py-2.5 text-sm"
                    required
                >

                @error('email')
                    <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                @enderror
            </div>

            {{-- Role --}}
            <div>
                <label for="role" class="mb-2 block text-sm font-medium text-slate-700">
                    Role Pengguna
                </label>

                <select
                    id="role"
                    name="role"
                    class="w-full rounded-lg border border-slate-300 px-4 py-2.5 text-sm"
                    required
                >
                    <option value="admin" {{ old('role', $user->role) == 'admin' ? 'selected' : '' }}>
                        Admin
                    </option>

                    <option value="manager" {{ old('role', $user->role) == 'manager' ? 'selected' : '' }}>
                        Manager
                    </option>

                    <option value="staff" {{ old('role', $user->role) == 'staff' ? 'selected' : '' }}>
                        Staff
                    </option>
                </select>

                @error('role')
                    <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                @enderror
            </div>

            {{-- Password --}}
            <div>
                <label for="password" class="mb-2 block text-sm font-medium text-slate-700">
                    Password Baru
                    <span class="font-normal text-slate-400">(Opsional)</span>
                </label>

                <input
                    type="password"
                    id="password"
                    name="password"
                    placeholder="Kosongkan jika tidak ingin mengubah password"
                    class="w-full rounded-lg border border-slate-300 px-4 py-2.5 text-sm"
                >

                @error('password')
                    <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                @enderror
            </div>

            {{-- Konfirmasi Password --}}
            <div>
                <label for="password_confirmation" class="mb-2 block text-sm font-medium text-slate-700">
                    Konfirmasi Password Baru
                </label>

                <input
                    type="password"
                    id="password_confirmation"
                    name="password_confirmation"
                    placeholder="Ulangi password baru"
                    class="w-full rounded-lg border border-slate-300 px-4 py-2.5 text-sm"
                >
            </div>

            {{-- Tombol --}}
            <div class="flex justify-end gap-3 pt-4">
                <a
                    href="{{ route('users.index') }}"
                    class="rounded-lg bg-slate-200 px-5 py-2.5 text-sm font-semibold text-slate-700 hover:bg-slate-300"
                >
                    Batal
                </a>

                <button
                    type="submit"
                    class="rounded-lg bg-blue-600 px-5 py-2.5 text-sm font-semibold text-white hover:bg-blue-700"
                >
                    Simpan Perubahan
                </button>
            </div>

        </form>
    </div>

</div>
@endsection