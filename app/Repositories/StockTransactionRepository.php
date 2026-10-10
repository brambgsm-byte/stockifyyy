<?php

namespace App\Repositories;

use App\Models\StockTransaction;

class StockTransactionRepository
{
    /**
     * Mengambil semua transaksi stok.
     */
    public function getAll()
    {
        return StockTransaction::with(['product', 'user'])
            ->orderBy('transaction_date', 'desc')
            ->orderBy('id', 'desc')
            ->get();
    }

    /**
     * Mencari transaksi berdasarkan ID.
     */
    public function findById(int $id)
    {
        return StockTransaction::with(['product', 'user'])
            ->findOrFail($id);
    }

    /**
     * Membuat transaksi baru.
     */
    public function create(array $data)
    {
        return StockTransaction::create($data);
    }

    /**
     * Menghapus transaksi.
     */
    public function delete(int $id): bool
    {
        $transaction = StockTransaction::findOrFail($id);

        return (bool) $transaction->delete();
    }

    /**
     * Mengambil transaksi berdasarkan produk.
     */
    public function getByProductId(int $productId)
    {
        return StockTransaction::where('product_id', $productId)
            ->with(['product', 'user'])
            ->orderBy('transaction_date', 'desc')
            ->orderBy('id', 'desc')
            ->get();
    }
}