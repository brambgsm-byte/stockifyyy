<?php

namespace App\Services;

use App\Repositories\SupplierRepository;
use Illuminate\Support\Facades\Validator;
use Illuminate\Validation\ValidationException;

class SupplierService
{
    protected SupplierRepository $supplierRepository;

    public function __construct(SupplierRepository $supplierRepository)
    {
        $this->supplierRepository = $supplierRepository;
    }

    /**
     * Mengambil seluruh data supplier.
     */
    public function getAllSuppliers()
    {
        return $this->supplierRepository->getAll();
    }

    /**
     * Mengambil data supplier berdasarkan ID.
     */
    public function getSupplierById(int $id)
    {
        return $this->supplierRepository->findById($id);
    }

    /**
     * Menambahkan supplier baru.
     */
    public function createSupplier(array $data)
    {
        $validatedData = $this->validateData($data);

        return $this->supplierRepository->create($validatedData);
    }

    /**
     * Memperbarui data supplier.
     */
    public function updateSupplier(int $id, array $data)
    {
        $validatedData = $this->validateData($data);

        return $this->supplierRepository->update($id, $validatedData);
    }

    /**
     * Menghapus supplier berdasarkan ID.
     */
    public function deleteSupplier(int $id): bool
    {
        return $this->supplierRepository->delete($id);
    }

    /**
     * Melakukan validasi data supplier.
     */
    protected function validateData(array $data): array
    {
        $validator = Validator::make(
            $data,
            [
                'name' => [
                    'required',
                    'string',
                    'max:255',
                ],
                'address' => [
                    'nullable',
                    'string',
                    'max:500',
                ],
                'phone' => [
                    'nullable',
                    'string',
                    'max:20',
                ],
                'email' => [
                    'nullable',
                    'email',
                    'max:255',
                ],
            ],
            [
                'name.required' => 'Nama supplier wajib diisi.',
                'name.string' => 'Nama supplier harus berupa teks.',
                'name.max' => 'Nama supplier maksimal 255 karakter.',
                'address.string' => 'Alamat supplier harus berupa teks.',
                'address.max' => 'Alamat supplier maksimal 500 karakter.',
                'phone.string' => 'Nomor telepon harus berupa teks.',
                'phone.max' => 'Nomor telepon maksimal 20 karakter.',
                'email.email' => 'Format email supplier tidak valid.',
                'email.max' => 'Email maksimal 255 karakter.',
            ]
        );

        if ($validator->fails()) {
            throw new ValidationException($validator);
        }

        return $validator->validated();
    }
}