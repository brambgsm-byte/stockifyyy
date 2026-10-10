<?php

namespace App\Services;

use App\Models\Product;
use App\Repositories\CategoryRepository;
use Illuminate\Support\Facades\Validator;
use Illuminate\Validation\ValidationException;

class CategoryService
{
    protected CategoryRepository $categoryRepository;

    public function __construct(CategoryRepository $categoryRepository)
    {
        $this->categoryRepository = $categoryRepository;
    }

    public function getAllCategories()
    {
        return $this->categoryRepository->getAll();
    }

    public function getCategoryById(int $id)
    {
        return $this->categoryRepository->findById($id);
    }

    public function createCategory(array $data)
    {
        $validatedData = $this->validateData($data);

        return $this->categoryRepository->create($validatedData);
    }

    public function updateCategory(int $id, array $data)
    {
        $validatedData = $this->validateData($data, $id);

        return $this->categoryRepository->update($id, $validatedData);
    }

    public function deleteCategory(int $id): bool
    {
        // Cek apakah kategori masih digunakan oleh produk
        $productCount = Product::where('category_id', $id)->count();

        if ($productCount > 0) {
            throw ValidationException::withMessages([
                'category' => "Kategori tidak dapat dihapus karena masih digunakan oleh {$productCount} produk.",
            ]);
        }

        return $this->categoryRepository->delete($id);
    }

    protected function validateData(array $data, ?int $id = null): array
    {
        $uniqueRule = 'unique:categories,name';

        if ($id !== null) {
            $uniqueRule .= ',' . $id;
        }

        $validator = Validator::make(
            $data,
            [
                'name' => [
                    'required',
                    'string',
                    'max:255',
                    $uniqueRule,
                ],
                'description' => [
                    'nullable',
                    'string',
                ],
            ],
            [
                'name.required' => 'Nama kategori wajib diisi.',
                'name.unique' => 'Nama kategori sudah digunakan.',
                'name.max' => 'Nama kategori maksimal 255 karakter.',
                'description.string' => 'Deskripsi kategori harus berupa teks.',
            ]
        );

        if ($validator->fails()) {
            throw new ValidationException($validator);
        }

        return $validator->validated();
    }
}