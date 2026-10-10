<?php

namespace App\Repositories;

use App\Models\Product;

class ProductRepository
{
    /**
     * Mengambil semua produk.
     */
    public function getAll()
    {
        return Product::with(['category', 'supplier'])
            ->orderBy('name', 'asc')
            ->get();
    }

    /**
     * Mengambil produk berdasarkan ID.
     */
    public function findById(int $id)
    {
        return Product::with(['category', 'supplier'])
            ->findOrFail($id);
    }

    /**
     * Membuat produk baru.
     */
    public function create(array $data)
    {
        return Product::create($data);
    }

    /**
     * Memperbarui produk.
     */
    public function update(int $id, array $data)
    {
        $product = Product::findOrFail($id);

        $product->update($data);

        return $product->fresh([
            'category',
            'supplier',
        ]);
    }

    /**
     * Menghapus produk.
     */
    public function delete(int $id): bool
    {
        $product = Product::findOrFail($id);

        return (bool) $product->delete();
    }

    /**
     * Mencari produk berdasarkan kode.
     */
    public function findByCode(string $code)
    {
        return Product::where('code', $code)->first();
    }

    /**
     * Mengambil produk dengan stok rendah.
     */
    public function getLowStockProducts()
    {
        return Product::whereColumn(
                'stock',
                '<=',
                'minimum_stock'
            )
            ->with(['category', 'supplier'])
            ->orderBy('stock', 'asc')
            ->get();
    }
}