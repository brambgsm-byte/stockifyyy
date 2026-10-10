<?php

namespace App\Http\Controllers;

use App\Models\Setting;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use Illuminate\View\View;

class SettingController extends Controller
{
    /**
     * Menampilkan halaman pengaturan aplikasi.
     */
    public function index(): View
    {
        $setting = Setting::firstOrCreate(
            ['id' => 1],
            [
                'app_name' => 'Stockify',
                'app_logo' => null,
                'app_description' => 'Sistem Manajemen Stok Barang',
            ]
        );

        return view('settings.index', compact('setting'));
    }

    /**
     * Menyimpan perubahan pengaturan aplikasi.
     */
    public function update(Request $request)
    {
        $setting = Setting::firstOrCreate(
            ['id' => 1],
            [
                'app_name' => 'Stockify',
                'app_logo' => null,
                'app_description' => 'Sistem Manajemen Stok Barang',
            ]
        );

        $validated = $request->validate([
            'app_name' => [
                'required',
                'string',
                'max:255',
            ],

            'app_description' => [
                'nullable',
                'string',
                'max:1000',
            ],

            'app_logo' => [
                'nullable',
                'image',
                'mimes:jpg,jpeg,png,webp',
                'max:2048',
            ],
        ], [
            'app_name.required' => 'Nama aplikasi wajib diisi.',
            'app_name.string' => 'Nama aplikasi harus berupa teks.',
            'app_name.max' => 'Nama aplikasi maksimal 255 karakter.',

            'app_description.string' => 'Deskripsi aplikasi harus berupa teks.',
            'app_description.max' => 'Deskripsi aplikasi maksimal 1000 karakter.',

            'app_logo.image' => 'File logo harus berupa gambar.',
            'app_logo.mimes' => 'Logo harus berformat JPG, JPEG, PNG, atau WEBP.',
            'app_logo.max' => 'Ukuran logo maksimal 2 MB.',
        ]);

        $data = [
            'app_name' => $validated['app_name'],
            'app_description' => $validated['app_description'] ?? null,
        ];

        /*
         * Upload logo baru jika dipilih.
         */
        if ($request->hasFile('app_logo')) {

            /*
             * Hapus logo lama jika masih ada.
             */
            if (
                $setting->app_logo &&
                Storage::disk('public')->exists($setting->app_logo)
            ) {
                Storage::disk('public')->delete($setting->app_logo);
            }

            /*
             * Simpan logo baru.
             */
            $data['app_logo'] = $request->file('app_logo')
                ->store('settings', 'public');
        }

        $setting->update($data);

        return redirect()
            ->route('settings.index')
            ->with('success', 'Pengaturan aplikasi berhasil diperbarui.');
    }

    /**
     * Menghapus logo aplikasi.
     */
    public function removeLogo()
    {
        $setting = Setting::find(1);

        if (!$setting) {
            return redirect()
                ->route('settings.index')
                ->with('error', 'Data pengaturan tidak ditemukan.');
        }

        if (
            $setting->app_logo &&
            Storage::disk('public')->exists($setting->app_logo)
        ) {
            Storage::disk('public')->delete($setting->app_logo);
        }

        $setting->update([
            'app_logo' => null,
        ]);

        return redirect()
            ->route('settings.index')
            ->with('success', 'Logo aplikasi berhasil dihapus.');
    }
}