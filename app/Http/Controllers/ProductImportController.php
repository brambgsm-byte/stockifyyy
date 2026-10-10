<?php

namespace App\Http\Controllers;

use App\Exports\ProductTemplateExport;
use App\Imports\ProductsImport;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;
use Maatwebsite\Excel\Facades\Excel;
use Throwable;

class ProductImportController extends Controller
{
    /**
     * Menampilkan halaman impor produk.
     */
    public function create()
    {
        return view('products.import');
    }

    /**
     * Mengunduh template Excel produk.
     */
    public function downloadTemplate()
    {
        return Excel::download(
            new ProductTemplateExport(),
            'template-impor-produk.xlsx'
        );
    }

    /**
     * Memproses file Excel yang diunggah.
     */
    public function store(Request $request)
    {
        /*
        |--------------------------------------------------------------------------
        | Validasi file
        |--------------------------------------------------------------------------
        */
        $request->validate(
            [
                'file' => [
                    'required',
                    'file',
                    'mimes:xlsx,xls,csv',
                    'max:5120',
                ],
            ],
            [
                'file.required' =>
                    'Silakan pilih file Excel terlebih dahulu.',

                'file.file' =>
                    'File yang diunggah tidak valid.',

                'file.mimes' =>
                    'File harus berformat XLSX, XLS, atau CSV.',

                'file.max' =>
                    'Ukuran file maksimal 5 MB.',
            ]
        );

        try {

            /*
            |--------------------------------------------------------------------------
            | Jalankan proses import
            |--------------------------------------------------------------------------
            */
            Excel::import(
                new ProductsImport(),
                $request->file('file')
            );

            /*
            |--------------------------------------------------------------------------
            | Jika berhasil
            |--------------------------------------------------------------------------
            */
            return redirect()
                ->route('products.index')
                ->with(
                    'success',
                    'Data produk berhasil diimpor dari Excel.'
                );

        } catch (Throwable $e) {

            /*
            |--------------------------------------------------------------------------
            | Simpan detail error ke log
            |--------------------------------------------------------------------------
            */
            Log::error(
                'Gagal mengimpor produk.',
                [
                    'message' => $e->getMessage(),
                    'file' => $e->getFile(),
                    'line' => $e->getLine(),
                ]
            );

            /*
            |--------------------------------------------------------------------------
            | Tampilkan error asli kepada user
            |--------------------------------------------------------------------------
            */
            return back()
                ->withInput()
                ->withErrors([
                    'file' => $e->getMessage(),
                ]);
        }
    }
}