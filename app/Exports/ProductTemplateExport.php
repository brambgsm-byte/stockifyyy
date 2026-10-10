<?php

namespace App\Exports;

use Maatwebsite\Excel\Concerns\FromArray;
use Maatwebsite\Excel\Concerns\WithHeadings;

class ProductTemplateExport implements FromArray, WithHeadings
{
    /**
     * Data contoh pada template Excel.
     */
    public function array(): array
    {
        return [
            [
                3,
                3,
                'PRD001',
                'Contoh Produk',
                'Deskripsi produk',
                'pcs',
                'M',
                'Hitam',
                100000,
                150000,
                5,
            ],
        ];
    }

    /**
     * Nama kolom pada template Excel.
     */
    public function headings(): array
    {
        return [
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
        ];
    }
}