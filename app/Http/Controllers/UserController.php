<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Validation\Rule;
use Illuminate\View\View;

class UserController extends Controller
{
    /**
     * Menampilkan daftar pengguna.
     */
    public function index(): View
    {
        $users = User::latest()->get();

        return view('users.index', compact('users'));
    }

    /**
     * Menampilkan halaman tambah pengguna.
     */
    public function create(): View
    {
        return view('users.create');
    }

    /**
     * Menyimpan pengguna baru.
     */
    public function store(Request $request)
    {
        $validated = $request->validate([
            'name' => [
                'required',
                'string',
                'max:255',
            ],
            'email' => [
                'required',
                'email',
                'max:255',
                'unique:users,email',
            ],
            'role' => [
                'required',
                Rule::in(['admin', 'manager', 'staff']),
            ],
            'password' => [
                'required',
                'string',
                'min:8',
                'confirmed',
            ],
        ]);

        User::create([
            'name' => $validated['name'],
            'email' => $validated['email'],
            'role' => $validated['role'],
            'password' => Hash::make($validated['password']),
        ]);

        return redirect()
            ->route('users.index')
            ->with('success', 'Pengguna berhasil ditambahkan.');
    }

    /**
     * Menampilkan halaman edit pengguna.
     */
    public function edit(User $user): View
    {
        return view('users.edit', compact('user'));
    }

    /**
     * Memperbarui data pengguna.
     */
    public function update(Request $request, User $user)
    {
        $validated = $request->validate([
            'name' => [
                'required',
                'string',
                'max:255',
            ],
            'email' => [
                'required',
                'email',
                'max:255',
                Rule::unique('users', 'email')->ignore($user->id),
            ],
            'role' => [
                'required',
                Rule::in(['admin', 'manager', 'staff']),
            ],
            'password' => [
                'nullable',
                'string',
                'min:8',
                'confirmed',
            ],
        ]);

        $user->name = $validated['name'];
        $user->email = $validated['email'];
        $user->role = $validated['role'];

        if (!empty($validated['password'])) {
            $user->password = Hash::make($validated['password']);
        }

        $user->save();

        return redirect()
            ->route('users.index')
            ->with('success', 'Data pengguna berhasil diperbarui.');
    }

    /**
     * Menghapus pengguna.
     */
    public function destroy(User $user)
    {
        if (auth()->id() === $user->id) {
            return redirect()
                ->route('users.index')
                ->with('error', 'Anda tidak dapat menghapus akun sendiri.');
        }

        $user->delete();

        return redirect()
            ->route('users.index')
            ->with('success', 'Pengguna berhasil dihapus.');
    }
}