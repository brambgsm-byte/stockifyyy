<?php

namespace App\Imports;

use App\Models\Product;
use Illuminate\Support\Collection;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Validator;
use Illuminate\Validation\ValidationException;
use Maatwebsite\Excel\Concerns\ToCollection;
use Maatwebsite\Excel\Concerns\WithHeadingRow;

class ProductsImport implements ToCollection, WithHeadingRow
{
    /**
     * Memproses seluruh data dari file Excel.
     */
    public function collection(Collection $rows)
    {
        DB::transaction(function () use ($rows) {

            /*
            |--------------------------------------------------------------------------
            | Simpan daftar kode yang sudah ditemukan dalam file Excel
            |--------------------------------------------------------------------------
            */
            $codesInFile = [];

            foreach ($rows as $index => $row) {

                /*
                |--------------------------------------------------------------------------
                | Nomor baris Excel
                | Header = baris 1
                | Data pertama = baris 2
                |--------------------------------------------------------------------------
                */
                $excelRow = $index + 2;

                /*
                |--------------------------------------------------------------------------
                | Ubah Row menjadi array
                |--------------------------------------------------------------------------
                */
                $rowData = $row->toArray();

                /*
                |--------------------------------------------------------------------------
                | Normalisasi nama header dan nilai
                |--------------------------------------------------------------------------
                |
                | Tujuannya agar header seperti:
                | category_id
                | Category_ID
                | category_id
                | category id
                |
                | tetap dapat dibaca dengan benar.
                |--------------------------------------------------------------------------
                */
                $normalizedRow = [];

                foreach ($rowData as $key => $value) {

                    /*
                    | Hilangkan karakter tersembunyi / BOM
                    */
                    $key = preg_replace('/[\x00-\x1F\x80-\xFF]/', '', (string) $key);

                    /*
                    | Ubah ke lowercase
                    */
                    $key = strtolower(trim($key));

                    /*
                    | Ubah spasi dan tanda strip menjadi underscore
                    */
                    $key = preg_replace('/[\s\-]+/', '_', $key);

                    /*
                    | Hilangkan underscore berulang
                    */
                    $key = preg_replace('/_+/', '_', $key);

                    /*
                    | Normalisasi value
                    */
                    if (is_string($value)) {
                        $value = trim($value);
                    }

                    $normalizedRow[$key] = $value;
                }

                /*
                |--------------------------------------------------------------------------
                | Mapping nama kolom Excel
                |--------------------------------------------------------------------------
                */
                $rowData = [
                    'category_id' => $this->getValue(
                        $normalizedRow,
                        ['category_id', 'categoryid', 'kategori_id', 'kategori']
                    ),

                    'supplier_id' => $this->getValue(
                        $normalizedRow,
                        ['supplier_id', 'supplierid', 'pemasok_id', 'pemasok']
                    ),

                    'code' => $this->getValue(
                        $normalizedRow,
                        ['code', 'kode', 'kode_produk', 'product_code']
                    ),

                    'name' => $this->getValue(
                        $normalizedRow,
                        ['name', 'nama', 'nama_produk', 'product_name']
                    ),

                    'description' => $this->getValue(
                        $normalizedRow,
                        ['description', 'deskripsi', 'keterangan']
                    ),

                    'unit' => $this->getValue(
                        $normalizedRow,
                        ['unit', 'satuan']
                    ),

                    'size' => $this->getValue(
                        $normalizedRow,
                        ['size', 'ukuran']
                    ),

                    'color' => $this->getValue(
                        $normalizedRow,
                        ['color', 'warna']
                    ),

                    'purchase_price' => $this->getValue(
                        $normalizedRow,
                        [
                            'purchase_price',
                            'purchaseprice',
                            'harga_beli',
                            'harga_beli_produk'
                        ]
                    ),

                    'selling_price' => $this->getValue(
                        $normalizedRow,
                        [
                            'selling_price',
                            'sellingprice',
                            'harga_jual',
                            'harga_jual_produk'
                        ]
                    ),

                    'minimum_stock' => $this->getValue(
                        $normalizedRow,
                        [
                            'minimum_stock',
                            'minimumstock',
                            'stok_minimum',
                            'minimum_stok'
                        ]
                    ),
                ];

                /*
                |--------------------------------------------------------------------------
                | Cek apakah baris benar-benar kosong
                |--------------------------------------------------------------------------
                */
                $isEmptyRow = collect($rowData)
                    ->filter(function ($value) {
                        return $value !== null && $value !== '';
                    })
                    ->isEmpty();

                if ($isEmptyRow) {
                    continue;
                }

                /*
                |--------------------------------------------------------------------------
                | Ambil kode produk
                |--------------------------------------------------------------------------
                */
                $code = trim((string) ($rowData['code'] ?? ''));

                /*
                |--------------------------------------------------------------------------
                | Validasi data
                |--------------------------------------------------------------------------
                */
                $validator = Validator::make(
                    $rowData,
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
                    ],
                    [
                        'category_id.required' =>
                            'Kategori wajib diisi.',

                        'category_id.integer' =>
                            'ID kategori harus berupa angka.',

                        'category_id.exists' =>
                            'ID kategori tidak ditemukan di database.',

                        'supplier_id.required' =>
                            'Supplier wajib diisi.',

                        'supplier_id.integer' =>
                            'ID supplier harus berupa angka.',

                        'supplier_id.exists' =>
                            'ID supplier tidak ditemukan di database.',

                        'code.required' =>
                            'Kode produk wajib diisi.',

                        'code.max' =>
                            'Kode produk maksimal 255 karakter.',

                        'name.required' =>
                            'Nama produk wajib diisi.',

                        'name.max' =>
                            'Nama produk maksimal 255 karakter.',

                        'unit.required' =>
                            'Satuan produk wajib diisi.',

                        'purchase_price.required' =>
                            'Harga beli wajib diisi.',

                        'purchase_price.numeric' =>
                            'Harga beli harus berupa angka.',

                        'purchase_price.min' =>
                            'Harga beli tidak boleh negatif.',

                        'selling_price.required' =>
                            'Harga jual wajib diisi.',

                        'selling_price.numeric' =>
                            'Harga jual harus berupa angka.',

                        'selling_price.min' =>
                            'Harga jual tidak boleh negatif.',

                        'minimum_stock.required' =>
                            'Stok minimum wajib diisi.',

                        'minimum_stock.integer' =>
                            'Stok minimum harus berupa angka bulat.',

                        'minimum_stock.min' =>
                            'Stok minimum tidak boleh negatif.',
                    ]
                );

                /*
                |--------------------------------------------------------------------------
                | Jika validasi gagal
                |--------------------------------------------------------------------------
                */
                if ($validator->fails()) {

                    throw ValidationException::withMessages([
                        'file' =>
                            'Kesalahan pada baris Excel ke-' .
                            $excelRow .
                            ': ' .
                            implode(
                                ' ',
                                $validator->errors()->all()
                            ),
                    ]);
                }

                /*
                |--------------------------------------------------------------------------
                | Normalisasi kode
                |--------------------------------------------------------------------------
                */
                $normalizedCode = strtolower($code);

                /*
                |--------------------------------------------------------------------------
                | Cek kode duplicate di dalam file Excel
                |--------------------------------------------------------------------------
                */
                if (in_array($normalizedCode, $codesInFile, true)) {

                    throw ValidationException::withMessages([
                        'file' =>
                            'Kesalahan pada baris Excel ke-' .
                            $excelRow .
                            ': Kode produk "' .
                            $code .
                            '" muncul lebih dari satu kali di file Excel.',
                    ]);
                }

                $codesInFile[] = $normalizedCode;

                /*
                |--------------------------------------------------------------------------
                | Cek kode sudah ada di database
                |--------------------------------------------------------------------------
                */
                $existingProduct = Product::where(
                    'code',
                    $code
                )->first();

                if ($existingProduct) {

                    throw ValidationException::withMessages([
                        'file' =>
                            'Kesalahan pada baris Excel ke-' .
                            $excelRow .
                            ': Kode produk "' .
                            $code .
                            '" sudah digunakan oleh produk "' .
                            $existingProduct->name .
                            '". Gunakan kode produk yang berbeda.',
                    ]);
                }

                /*
                |--------------------------------------------------------------------------
                | Bersihkan nilai angka
                |--------------------------------------------------------------------------
                */
                $purchasePrice = $this->normalizeNumber(
                    $rowData['purchase_price']
                );

                $sellingPrice = $this->normalizeNumber(
                    $rowData['selling_price']
                );

                /*
                |--------------------------------------------------------------------------
                | Simpan produk
                |--------------------------------------------------------------------------
                */
                Product::create([
                    'category_id' => (int) $rowData['category_id'],

                    'supplier_id' => (int) $rowData['supplier_id'],

                    'code' => $code,

                    'name' => trim(
                        (string) $rowData['name']
                    ),

                    'description' =>
                        !empty($rowData['description'])
                            ? trim((string) $rowData['description'])
                            : null,

                    'unit' => trim(
                        (string) $rowData['unit']
                    ),

                    'size' =>
                        !empty($rowData['size'])
                            ? trim((string) $rowData['size'])
                            : null,

                    'color' =>
                        !empty($rowData['color'])
                            ? trim((string) $rowData['color'])
                            : null,

                    'purchase_price' => $purchasePrice,

                    'selling_price' => $sellingPrice,

                    'minimum_stock' => (int) $rowData['minimum_stock'],

                    /*
                    |--------------------------------------------------------------------------
                    | Produk hasil import dimulai dengan stok 0
                    |--------------------------------------------------------------------------
                    */
                    'stock' => 0,

                    'image' => null,
                ]);
            }
        });
    }

    /**
     * Mengambil value dari beberapa kemungkinan nama kolom.
     */
    private function getValue(array $row, array $possibleKeys)
    {
        foreach ($possibleKeys as $key) {
            if (array_key_exists($key, $row)) {
                return $row[$key];
            }
        }

        return null;
    }

    /**
     * Membersihkan format angka dari Excel.
     */
    private function normalizeNumber($value): float
    {
        if ($value === null || $value === '') {
            return 0;
        }

        if (is_numeric($value)) {
            return (float) $value;
        }

        $value = trim((string) $value);

        /*
        |--------------------------------------------------------------------------
        | Format Indonesia:
        | 10.000,50
        |--------------------------------------------------------------------------
        */
        if (
            str_contains($value, '.') &&
            str_contains($value, ',')
        ) {
            $value = str_replace('.', '', $value);
            $value = str_replace(',', '.', $value);

            return (float) $value;
        }

        /*
        |--------------------------------------------------------------------------
        | Hanya koma:
        | 10000,50
        |--------------------------------------------------------------------------
        */
        if (str_contains($value, ',')) {
            $value = str_replace(',', '.', $value);

            return (float) $value;
        }

        /*
        |--------------------------------------------------------------------------
        | Hanya titik:
        | 10000.50
        |--------------------------------------------------------------------------
        */
        return (float) $value;
    }
}