<?php

namespace App\Http\Controllers;

use App\Services\ActivityLogService;
use App\Services\SupplierService;
use Illuminate\Http\Request;

class SupplierController extends Controller
{
    protected SupplierService $supplierService;

    public function __construct(SupplierService $supplierService)
    {
        $this->supplierService = $supplierService;
    }

    /**
     * Menampilkan semua supplier.
     */
    public function index()
    {
        $suppliers = $this->supplierService->getAllSuppliers();

        return view('suppliers.index', compact('suppliers'));
    }

    /**
     * Menampilkan halaman tambah supplier.
     */
    public function create()
    {
        return view('suppliers.create');
    }

    /**
     * Menyimpan supplier baru.
     */
    public function store(Request $request)
    {
        $validated = $request->validate([
            'name' => [
                'required',
                'string',
                'max:255',
            ],
            'address' => [
                'required',
                'string',
                'max:500',
            ],
            'phone' => [
                'required',
                'string',
                'max:20',
            ],
            'email' => [
                'nullable',
                'email',
                'max:255',
            ],
        ], [
            'name.required' => 'Nama supplier wajib diisi.',
            'name.max' => 'Nama supplier maksimal 255 karakter.',
            'address.required' => 'Alamat supplier wajib diisi.',
            'phone.required' => 'Nomor telepon wajib diisi.',
            'phone.max' => 'Nomor telepon maksimal 20 karakter.',
            'email.email' => 'Format email tidak valid.',
        ]);

        $this->supplierService->createSupplier($validated);

        ActivityLogService::log(
            'Menambahkan supplier',
            'Menambahkan supplier baru: ' . $validated['name'],
            'Supplier'
        );

        return redirect()
            ->route('suppliers.index')
            ->with('success', 'Supplier berhasil ditambahkan.');
    }

    /**
     * Menampilkan halaman edit supplier.
     */
    public function edit(int $id)
    {
        $supplier = $this->supplierService->getSupplierById($id);

        return view('suppliers.edit', compact('supplier'));
    }

    /**
     * Memperbarui data supplier.
     */
    public function update(Request $request, int $id)
    {
        $validated = $request->validate([
            'name' => [
                'required',
                'string',
                'max:255',
            ],
            'address' => [
                'required',
                'string',
                'max:500',
            ],
            'phone' => [
                'required',
                'string',
                'max:20',
            ],
            'email' => [
                'nullable',
                'email',
                'max:255',
            ],
        ], [
            'name.required' => 'Nama supplier wajib diisi.',
            'name.max' => 'Nama supplier maksimal 255 karakter.',
            'address.required' => 'Alamat supplier wajib diisi.',
            'phone.required' => 'Nomor telepon wajib diisi.',
            'phone.max' => 'Nomor telepon maksimal 20 karakter.',
            'email.email' => 'Format email tidak valid.',
        ]);

        $this->supplierService->updateSupplier($id, $validated);

        ActivityLogService::log(
            'Mengubah supplier',
            'Mengubah supplier dengan ID: ' . $id .
            ' menjadi: ' . $validated['name'],
            'Supplier'
        );

        return redirect()
            ->route('suppliers.index')
            ->with('success', 'Supplier berhasil diperbarui.');
    }

    /**
     * Menghapus supplier.
     */
    public function destroy(int $id)
    {
        $supplier = $this->supplierService->getSupplierById($id);

        $supplierName = $supplier->name ?? 'Tidak diketahui';

        $this->supplierService->deleteSupplier($id);

        ActivityLogService::log(
            'Menghapus supplier',
            'Menghapus supplier: ' . $supplierName .
            ' dengan ID: ' . $id,
            'Supplier'
        );

        return redirect()
            ->route('suppliers.index')
            ->with('success', 'Supplier berhasil dihapus.');
    }
}