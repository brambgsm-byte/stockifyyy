<?php

namespace App\Services;

use App\Models\Product;
use App\Repositories\StockTransactionRepository;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Validator;
use Illuminate\Validation\ValidationException;

class StockTransactionService
{
    protected StockTransactionRepository $stockTransactionRepository;

    public function __construct(
        StockTransactionRepository $stockTransactionRepository
    ) {
        $this->stockTransactionRepository = $stockTransactionRepository;
    }

    /**
     * Mengambil semua transaksi stok.
     */
    public function getAllTransactions()
    {
        return $this->stockTransactionRepository->getAll();
    }

    /**
     * Membuat transaksi stok.
     */
    public function createTransaction(array $data)
    {
        $validatedData = $this->validateData($data);

        return DB::transaction(function () use ($validatedData) {

            $product = Product::findOrFail(
                $validatedData['product_id']
            );

            /*
             * Transaksi keluar:
             * stok dikurangi saat transaksi dibuat.
             */
            if ($validatedData['type'] === 'out') {

                if ($product->stock < $validatedData['quantity']) {
                    throw ValidationException::withMessages([
                        'quantity' => 'Stok produk tidak mencukupi.',
                    ]);
                }

                $product->decrement(
                    'stock',
                    $validatedData['quantity']
                );
            }

            /*
             * Transaksi masuk:
             * stok ditambahkan saat transaksi dibuat.
             */
            if ($validatedData['type'] === 'in') {

                $product->increment(
                    'stock',
                    $validatedData['quantity']
                );
            }

            /*
             * Simpan user yang membuat transaksi.
             */
            $validatedData['user_id'] = auth()->id();

            /*
             * Setiap transaksi baru berstatus pending.
             */
            $validatedData['status'] = 'pending';

            return $this->stockTransactionRepository->create(
                $validatedData
            );
        });
    }

    /**
     * Mengonfirmasi transaksi stok.
     *
     * Konfirmasi hanya mengubah status transaksi
     * dari pending menjadi confirmed.
     *
     * Stok tidak diubah lagi karena stok
     * sudah diperbarui ketika transaksi dibuat.
     */
    public function confirmTransaction(int $id)
    {
        return DB::transaction(function () use ($id) {

            $transaction =
                $this->stockTransactionRepository->findById($id);

            /*
             * Cegah transaksi dikonfirmasi dua kali.
             */
            if ($transaction->status === 'confirmed') {
                throw ValidationException::withMessages([
                    'transaction' =>
                        'Transaksi ini sudah dikonfirmasi.',
                ]);
            }

            /*
             * Ubah status transaksi menjadi confirmed.
             */
            $transaction->status = 'confirmed';
            $transaction->save();

            return $transaction;
        });
    }

    /**
     * Menghapus transaksi stok.
     */
    public function deleteTransaction(int $id): bool
    {
        return DB::transaction(function () use ($id) {

            $transaction =
                $this->stockTransactionRepository->findById($id);

            $product = Product::findOrFail(
                $transaction->product_id
            );

            /*
             * Jika transaksi masuk dihapus,
             * stok harus dikurangi kembali.
             */
            if ($transaction->type === 'in') {

                if ($product->stock < $transaction->quantity) {
                    throw ValidationException::withMessages([
                        'transaction' =>
                            'Transaksi tidak dapat dihapus karena stok produk tidak mencukupi untuk penyesuaian.',
                    ]);
                }

                $product->decrement(
                    'stock',
                    $transaction->quantity
                );
            }

            /*
             * Jika transaksi keluar dihapus,
             * stok harus dikembalikan.
             */
            if ($transaction->type === 'out') {

                $product->increment(
                    'stock',
                    $transaction->quantity
                );
            }

            return $this->stockTransactionRepository->delete($id);
        });
    }

    /**
     * Validasi data transaksi.
     */
    protected function validateData(array $data): array
    {
        $validator = Validator::make(
            $data,
            [
                'product_id' => [
                    'required',
                    'integer',
                    'exists:products,id',
                ],

                'type' => [
                    'required',
                    'in:in,out',
                ],

                'quantity' => [
                    'required',
                    'integer',
                    'min:1',
                ],

                'transaction_date' => [
                    'required',
                    'date',
                ],

                'description' => [
                    'nullable',
                    'string',
                ],
            ],
            [
                'product_id.required' =>
                    'Produk wajib dipilih.',

                'product_id.exists' =>
                    'Produk yang dipilih tidak tersedia.',

                'type.required' =>
                    'Jenis transaksi wajib dipilih.',

                'type.in' =>
                    'Jenis transaksi tidak valid.',

                'quantity.required' =>
                    'Jumlah barang wajib diisi.',

                'quantity.integer' =>
                    'Jumlah barang harus berupa bilangan bulat.',

                'quantity.min' =>
                    'Jumlah barang minimal 1.',

                'transaction_date.required' =>
                    'Tanggal transaksi wajib diisi.',

                'transaction_date.date' =>
                    'Format tanggal transaksi tidak valid.',

                'description.string' =>
                    'Keterangan harus berupa teks.',
            ]
        );

        if ($validator->fails()) {
            throw new ValidationException($validator);
        }

        return $validator->validated();
    }
}