<?php

namespace App\Services;

use App\Repositories\ProductRepository;
use Illuminate\Support\Facades\Validator;
use Illuminate\Validation\ValidationException;

class ProductService
{
    protected ProductRepository $productRepository;

    public function __construct(ProductRepository $productRepository)
    {
        $this->productRepository = $productRepository;
    }

    /**
     * Mengambil semua produk.
     */
    public function getAllProducts()
    {
        return $this->productRepository->getAll();
    }

    /**
     * Mengambil produk berdasarkan ID.
     */
    public function getProductById(int $id)
    {
        return $this->productRepository->findById($id);
    }

    /**
     * Membuat produk baru.
     */
    public function createProduct(array $data)
    {
        // Stok awal produk selalu dimulai dari 0.
        $data['stock'] = 0;

        $validatedData = $this->validateData($data);

        return $this->productRepository->create($validatedData);
    }

    /**
     * Memperbarui produk.
     */
    public function updateProduct(int $id, array $data)
    {
        // Stok tidak boleh diubah melalui formulir produk.
        unset($data['stock']);

        $validatedData = $this->validateData($data, $id);

        return $this->productRepository->update($id, $validatedData);
    }

    /**
     * Menghapus produk.
     */
    public function deleteProduct(int $id): bool
    {
        return $this->productRepository->delete($id);
    }

    /**
     * Mengambil produk dengan stok rendah.
     */
    public function getLowStockProducts()
    {
        return $this->productRepository->getLowStockProducts();
    }

    /**
     * Validasi data produk.
     */
    protected function validateData(array $data, ?int $id = null): array
    {
        $codeUniqueRule = 'unique:products,code';

        if ($id !== null) {
            $codeUniqueRule .= ',' . $id;
        }

        $validator = Validator::make(
            $data,
            [
                'category_id' => [
                    'required',
                    'integer',
                    'exists:categories,id',
                ],

                'supplier_id' => [
                    'required',
                    'integer',
                    'exists:suppliers,id',
                ],

                'code' => [
                    'required',
                    'string',
                    'max:255',
                    $codeUniqueRule,
                ],

                'name' => [
                    'required',
                    'string',
                    'max:255',
                ],

                'description' => [
                    'nullable',
                    'string',
                    'max:1000',
                ],

                'unit' => [
                    'required',
                    'string',
                    'max:255',
                ],

                'size' => [
                    'nullable',
                    'string',
                    'max:255',
                ],

                'color' => [
                    'nullable',
                    'string',
                    'max:255',
                ],

                'purchase_price' => [
                    'required',
                    'numeric',
                    'min:0',
                ],

                'selling_price' => [
                    'required',
                    'numeric',
                    'min:0',
                ],

                'minimum_stock' => [
                    'required',
                    'integer',
                    'min:0',
                ],

                // Data image sudah berupa path file.
                'image' => [
                    'nullable',
                    'string',
                    'max:255',
                ],

                // Stok awal diatur otomatis menjadi 0.
                'stock' => [
                    'sometimes',
                    'integer',
                    'min:0',
                ],
            ],
            [
                'category_id.required' => 'Kategori produk wajib dipilih.',
                'category_id.integer' => 'Kategori produk tidak valid.',
                'category_id.exists' => 'Kategori yang dipilih tidak tersedia.',

                'supplier_id.required' => 'Supplier produk wajib dipilih.',
                'supplier_id.integer' => 'Supplier produk tidak valid.',
                'supplier_id.exists' => 'Supplier yang dipilih tidak tersedia.',

                'code.required' => 'Kode produk wajib diisi.',
                'code.string' => 'Kode produk harus berupa teks.',
                'code.max' => 'Kode produk maksimal 255 karakter.',
                'code.unique' => 'Kode produk sudah digunakan.',

                'name.required' => 'Nama produk wajib diisi.',
                'name.string' => 'Nama produk harus berupa teks.',
                'name.max' => 'Nama produk maksimal 255 karakter.',

                'description.string' => 'Deskripsi produk harus berupa teks.',
                'description.max' => 'Deskripsi produk maksimal 1000 karakter.',

                'unit.required' => 'Satuan produk wajib diisi.',
                'unit.string' => 'Satuan produk harus berupa teks.',
                'unit.max' => 'Satuan produk maksimal 255 karakter.',

                'size.string' => 'Ukuran produk harus berupa teks.',
                'size.max' => 'Ukuran produk maksimal 255 karakter.',

                'color.string' => 'Warna produk harus berupa teks.',
                'color.max' => 'Warna produk maksimal 255 karakter.',

                'purchase_price.required' => 'Harga beli wajib diisi.',
                'purchase_price.numeric' => 'Harga beli harus berupa angka.',
                'purchase_price.min' => 'Harga beli tidak boleh kurang dari 0.',

                'selling_price.required' => 'Harga jual wajib diisi.',
                'selling_price.numeric' => 'Harga jual harus berupa angka.',
                'selling_price.min' => 'Harga jual tidak boleh kurang dari 0.',

                'minimum_stock.required' => 'Minimum stok wajib diisi.',
                'minimum_stock.integer' => 'Minimum stok harus berupa bilangan bulat.',
                'minimum_stock.min' => 'Minimum stok tidak boleh kurang dari 0.',

                'image.string' => 'Data gambar produk tidak valid.',
                'image.max' => 'Path gambar maksimal 255 karakter.',

                'stock.integer' => 'Stok harus berupa bilangan bulat.',
                'stock.min' => 'Stok tidak boleh kurang dari 0.',
            ]
        );

        if ($validator->fails()) {
            throw new ValidationException($validator);
        }

        return $validator->validated();
    }
}