<?php

namespace Database\Seeders;

use App\Models\Setting;
use Illuminate\Database\Seeder;

class SettingSeeder extends Seeder
{
    /**
     * Menjalankan seeder.
     */
    public function run(): void
    {
        Setting::updateOrCreate(
            ['id' => 1],
            [
                'app_name' => 'Stockify',
                'app_logo' => null,
                'app_description' => 'Sistem Manajemen Stok Barang',
            ]
        );
    }
}