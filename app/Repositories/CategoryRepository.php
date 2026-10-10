<?php

namespace App\Repositories;

use App\Models\Category;

class CategoryRepository
{
    /**
     * Mengambil semua kategori.
     */
    public function getAll()
    {
        return Category::orderBy('name', 'asc')->get();
    }

    /**
     * Mencari kategori berdasarkan ID.
     */
    public function findById(int $id)
    {
        return Category::findOrFail($id);
    }

    /**
     * Membuat kategori baru.
     */
    public function create(array $data)
    {
        return Category::create($data);
    }

    /**
     * Memperbarui kategori.
     */
    public function update(int $id, array $data)
    {
        $category = Category::findOrFail($id);

        $category->update($data);

        return $category->fresh();
    }

    /**
     * Menghapus kategori.
     */
    public function delete(int $id): bool
    {
        $category = Category::findOrFail($id);

        return (bool) $category->delete();
    }
}