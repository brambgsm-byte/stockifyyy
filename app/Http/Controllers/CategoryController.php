<?php

namespace App\Http\Controllers;

use App\Services\ActivityLogService;
use App\Services\CategoryService;
use Illuminate\Http\Request;

class CategoryController extends Controller
{
    protected CategoryService $categoryService;

    public function __construct(CategoryService $categoryService)
    {
        $this->categoryService = $categoryService;
    }

    /**
     * Menampilkan daftar kategori.
     */
    public function index()
    {
        $categories = $this->categoryService->getAllCategories();

        return view('categories.index', compact('categories'));
    }

    /**
     * Menampilkan halaman tambah kategori.
     */
    public function create()
    {
        return view('categories.create');
    }

    /**
     * Menyimpan kategori baru.
     */
    public function store(Request $request)
    {
        $data = $request->only([
            'name',
            'description',
        ]);

        $this->categoryService->createCategory($data);

        ActivityLogService::log(
            'Menambahkan kategori',
            'Menambahkan kategori baru: ' . ($data['name'] ?? '-'),
            'Kategori'
        );

        return redirect()
            ->route('categories.index')
            ->with('success', 'Kategori berhasil ditambahkan.');
    }

    /**
     * Menampilkan halaman edit kategori.
     */
    public function edit(int $id)
    {
        $category = $this->categoryService->getCategoryById($id);

        return view('categories.edit', compact('category'));
    }

    /**
     * Memperbarui kategori.
     */
    public function update(Request $request, int $id)
    {
        $data = $request->only([
            'name',
            'description',
        ]);

        $this->categoryService->updateCategory($id, $data);

        ActivityLogService::log(
            'Mengubah kategori',
            'Mengubah kategori dengan ID: ' . $id .
            ' menjadi: ' . ($data['name'] ?? '-'),
            'Kategori'
        );

        return redirect()
            ->route('categories.index')
            ->with('success', 'Kategori berhasil diperbarui.');
    }

    /**
     * Menghapus kategori.
     */
    public function destroy(int $id)
    {
        $this->categoryService->deleteCategory($id);

        ActivityLogService::log(
            'Menghapus kategori',
            'Menghapus kategori dengan ID: ' . $id,
            'Kategori'
        );

        return redirect()
            ->route('categories.index')
            ->with('success', 'Kategori berhasil dihapus.');
    }
}