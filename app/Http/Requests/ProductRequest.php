<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class ProductRequest extends FormRequest
{
    /**
     * Menentukan apakah pengguna boleh mengirimkan request.
     */
    public function authorize(): bool
    {
        return auth()->check();
    }

    /**
     * Aturan validasi produk.
     */
    public function rules(): array
    {
        return [
            'category_id' => [
                'required',
                'exists:categories,id',
            ],

            'supplier_id' => [
                'required',
                'exists:suppliers,id',
            ],

            'code' => [
                'required',
                'string',
                'max:50',
                'unique:products,code,' . $this->route('product'),
            ],

            'name' => [
                'required',
                'string',
                'max:255',
            ],

            'description' => [
                'nullable',
                'string',
            ],

            'unit' => [
                'required',
                'string',
                'max:50',
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

            'image' => [
                'nullable',
                'image',
                'mimes:jpg,jpeg,png,webp',
                'max:2048',
            ],
        ];
    }

    /**
     * Pesan validasi.
     */
    public function messages(): array
    {
        return [
            'category_id.required' => 'Kategori wajib dipilih.',
            'category_id.exists' => 'Kategori tidak tersedia.',

            'supplier_id.required' => 'Supplier wajib dipilih.',
            'supplier_id.exists' => 'Supplier tidak tersedia.',

            'code.required' => 'Kode produk wajib diisi.',
            'code.unique' => 'Kode produk sudah digunakan.',

            'name.required' => 'Nama produk wajib diisi.',

            'unit.required' => 'Satuan wajib diisi.',

            'purchase_price.required' => 'Harga beli wajib diisi.',
            'purchase_price.numeric' => 'Harga beli harus berupa angka.',

            'selling_price.required' => 'Harga jual wajib diisi.',
            'selling_price.numeric' => 'Harga jual harus berupa angka.',

            'minimum_stock.required' => 'Stok minimum wajib diisi.',
            'minimum_stock.integer' => 'Stok minimum harus berupa angka.',

            'image.image' => 'File harus berupa gambar.',
            'image.mimes' => 'Format gambar harus JPG, JPEG, PNG, atau WEBP.',
            'image.max' => 'Ukuran gambar maksimal 2 MB.',
        ];
    }
}