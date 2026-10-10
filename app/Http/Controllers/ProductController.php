<?php

namespace App\Http\Controllers;

use App\Models\Category;
use App\Models\Supplier;
use App\Services\ProductService;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use Throwable;

class ProductController extends Controller
{
    protected ProductService $productService;

    public function __construct(ProductService $productService)
    {
        $this->productService = $productService;
    }

    /**
     * Menampilkan daftar produk.
     */
    public function index()
    {
        $products = $this->productService->getAllProducts();

        return view('products.index', compact('products'));
    }

    /**
     * Menampilkan detail produk.
     */
    public function show(int $id)
    {
        $product = $this->productService->getProductById($id);

        return view('products.show', compact('product'));
    }

    /**
     * Menampilkan halaman tambah produk.
     */
    public function create()
    {
        $categories = Category::orderBy('name', 'asc')->get();
        $suppliers = Supplier::orderBy('name', 'asc')->get();

        return view('products.create', compact(
            'categories',
            'suppliers'
        ));
    }

    /**
     * Menyimpan produk baru.
     */
    public function store(Request $request)
    {
        // Validasi file gambar.
        $request->validate([
            'image' => [
                'nullable',
                'image',
                'mimes:jpg,jpeg,png,webp',
                'max:2048',
            ],
        ], [
            'image.image' => 'File yang dipilih harus berupa gambar.',
            'image.mimes' => 'Format gambar harus JPG, JPEG, PNG, atau WEBP.',
            'image.max' => 'Ukuran gambar maksimal 2 MB.',
        ]);

        $data = $request->only([
            'category_id',
            'supplier_id',
            'code',
            'name',
            'description',
            'unit',
            'size',
            'color',
            'purchase_price',
            'selling_price',
            'minimum_stock',
        ]);

        $imagePath = null;

        try {
            // Menyimpan gambar jika tersedia.
            if ($request->hasFile('image')) {
                $imagePath = $request->file('image')->store(
                    'products',
                    'public'
                );

                $data['image'] = $imagePath;
            }

            $this->productService->createProduct($data);

            return redirect()
                ->route('products.index')
                ->with('success', 'Produk berhasil ditambahkan.');
        } catch (Throwable $e) {
            // Menghapus gambar jika proses penyimpanan produk gagal.
            if (
                $imagePath &&
                Storage::disk('public')->exists($imagePath)
            ) {
                Storage::disk('public')->delete($imagePath);
            }

            throw $e;
        }
    }

    /**
     * Menampilkan halaman edit produk.
     */
    public function edit(int $id)
    {
        $product = $this->productService->getProductById($id);

        $categories = Category::orderBy('name', 'asc')->get();
        $suppliers = Supplier::orderBy('name', 'asc')->get();

        return view('products.edit', compact(
            'product',
            'categories',
            'suppliers'
        ));
    }

    /**
     * Memperbarui data produk.
     */
    public function update(Request $request, int $id)
    {
        $product = $this->productService->getProductById($id);

        // Validasi file gambar baru.
        $request->validate([
            'image' => [
                'nullable',
                'image',
                'mimes:jpg,jpeg,png,webp',
                'max:2048',
            ],
        ], [
            'image.image' => 'File yang dipilih harus berupa gambar.',
            'image.mimes' => 'Format gambar harus JPG, JPEG, PNG, atau WEBP.',
            'image.max' => 'Ukuran gambar maksimal 2 MB.',
        ]);

        $data = $request->only([
            'category_id',
            'supplier_id',
            'code',
            'name',
            'description',
            'unit',
            'size',
            'color',
            'purchase_price',
            'selling_price',
            'minimum_stock',
        ]);

        $oldImagePath = $product->image;
        $newImagePath = null;

        try {
            // Menyimpan gambar baru jika dipilih.
            if ($request->hasFile('image')) {
                $newImagePath = $request->file('image')->store(
                    'products',
                    'public'
                );

                $data['image'] = $newImagePath;
            }

            // Memperbarui data produk terlebih dahulu.
            $this->productService->updateProduct($id, $data);

            // Menghapus gambar lama setelah update berhasil.
            if (
                $newImagePath &&
                $oldImagePath &&
                Storage::disk('public')->exists($oldImagePath)
            ) {
                Storage::disk('public')->delete($oldImagePath);
            }

            return redirect()
                ->route('products.index')
                ->with('success', 'Produk berhasil diperbarui.');
        } catch (Throwable $e) {
            // Menghapus gambar baru jika proses update gagal.
            if (
                $newImagePath &&
                Storage::disk('public')->exists($newImagePath)
            ) {
                Storage::disk('public')->delete($newImagePath);
            }

            throw $e;
        }
    }

    /**
     * Menghapus produk.
     */
    public function destroy(int $id)
    {
        $product = $this->productService->getProductById($id);

        $imagePath = $product->image;

        // Menghapus data produk terlebih dahulu.
        $this->productService->deleteProduct($id);

        // Menghapus gambar setelah produk berhasil dihapus.
        if (
            $imagePath &&
            Storage::disk('public')->exists($imagePath)
        ) {
            Storage::disk('public')->delete($imagePath);
        }

        return redirect()
            ->route('products.index')
            ->with('success', 'Produk berhasil dihapus.');
    }
}