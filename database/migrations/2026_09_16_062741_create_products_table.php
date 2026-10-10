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
        Schema::create('products', function (Blueprint $table) {

            // ID produk
            $table->id();

            // Relasi dengan kategori
            $table->foreignId('category_id')
                ->constrained('categories')
                ->cascadeOnUpdate()
                ->restrictOnDelete();

            // Relasi dengan supplier
            $table->foreignId('supplier_id')
                ->constrained('suppliers')
                ->cascadeOnUpdate()
                ->restrictOnDelete();

            // Kode produk / SKU
            $table->string('code')->unique();

            // Nama produk
            $table->string('name');

            // Deskripsi produk
            $table->text('description')->nullable();

            // Satuan produk
            // Contoh: pcs, unit, box, kg
            $table->string('unit');

            // Harga beli
            $table->decimal('purchase_price', 15, 2)->default(0);

            // Harga jual
            $table->decimal('selling_price', 15, 2)->default(0);

            // Batas minimum stok
            $table->unsignedInteger('minimum_stock')->default(0);

            // Gambar produk
            $table->string('image')->nullable();

            // created_at dan updated_at
            $table->timestamps();
        });
    }

    /**
     * Membatalkan migration.
     */
    public function down(): void
    {
        Schema::dropIfExists('products');
    }
};