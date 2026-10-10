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
        Schema::create('stock_transactions', function (Blueprint $table) {

            $table->id();

            // Produk yang mengalami transaksi
            $table->foreignId('product_id')
                ->constrained('products')
                ->cascadeOnDelete();

            // Jenis transaksi: masuk atau keluar
            $table->enum('type', [
                'in',
                'out',
            ]);

            // Jumlah barang yang masuk / keluar
            $table->unsignedInteger('quantity');

            // Tanggal transaksi
            $table->date('transaction_date');

            // Keterangan tambahan
            $table->text('description')->nullable();

            // User yang melakukan transaksi
            $table->foreignId('user_id')
                ->nullable()
                ->constrained('users')
                ->nullOnDelete();

            $table->timestamps();
        });
    }

    /**
     * Membatalkan migration.
     */
    public function down(): void
    {
        Schema::dropIfExists('stock_transactions');
    }
};