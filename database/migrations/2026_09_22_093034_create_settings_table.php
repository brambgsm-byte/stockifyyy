<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Menjalankan migration.
     */
    public function up(): void
    {
        Schema::create('settings', function (Blueprint $table) {

            $table->id();

            // Nama aplikasi
            $table->string('app_name')
                ->default('Stockify');

            // Logo aplikasi
            $table->string('app_logo')
                ->nullable();

            // Deskripsi singkat aplikasi
            $table->text('app_description')
                ->nullable();

            $table->timestamps();
        });
    }

    /**
     * Membatalkan migration.
     */
    public function down(): void
    {
        Schema::dropIfExists('settings');
    }
};