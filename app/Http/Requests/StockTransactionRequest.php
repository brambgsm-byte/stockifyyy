<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class StockTransactionRequest extends FormRequest
{
    public function authorize(): bool
    {
        return auth()->check();
    }

    public function rules(): array
    {
        return [
            'product_id' => ['required', 'integer', 'exists:products,id'],
            'type' => ['required', 'in:in,out'],
            'quantity' => ['required', 'integer', 'min:1'],
            'transaction_date' => ['required', 'date'],
            'description' => ['nullable', 'string'],
        ];
    }

    public function messages(): array
    {
        return [
            'product_id.required' => 'Produk wajib dipilih.',
            'product_id.exists' => 'Produk yang dipilih tidak tersedia.',

            'type.required' => 'Jenis transaksi wajib dipilih.',
            'type.in' => 'Jenis transaksi tidak valid.',

            'quantity.required' => 'Jumlah barang wajib diisi.',
            'quantity.integer' => 'Jumlah barang harus berupa bilangan bulat.',
            'quantity.min' => 'Jumlah barang minimal 1.',

            'transaction_date.required' => 'Tanggal transaksi wajib diisi.',
            'transaction_date.date' => 'Format tanggal transaksi tidak valid.',

            'description.string' => 'Keterangan harus berupa teks.',
        ];
    }
}