<?php

namespace App\Repositories;

use App\Models\Supplier;
use Illuminate\Database\Eloquent\Collection;

class SupplierRepository
{
    /**
     * Mengambil semua data supplier.
     */
    public function getAll(): Collection
    {
        return Supplier::orderBy('name', 'asc')->get();
    }

    /**
     * Mengambil supplier berdasarkan ID.
     *
     * @throws \Illuminate\Database\Eloquent\ModelNotFoundException
     */
    public function findById(int $id): Supplier
    {
        return Supplier::findOrFail($id);
    }

    /**
     * Menambahkan supplier baru.
     */
    public function create(array $data): Supplier
    {
        return Supplier::create($data);
    }

    /**
     * Memperbarui data supplier.
     */
    public function update(int $id, array $data): Supplier
    {
        $supplier = Supplier::findOrFail($id);

        $supplier->update($data);

        return $supplier->fresh();
    }

    /**
     * Menghapus supplier berdasarkan ID.
     */
    public function delete(int $id): bool
    {
        $supplier = Supplier::findOrFail($id);

        return (bool) $supplier->delete();
    }
}