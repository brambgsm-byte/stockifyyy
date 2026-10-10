<?php

namespace App\Exports;

use App\Models\Category;
use App\Models\Supplier;
use Maatwebsite\Excel\Concerns\FromArray;
use Maatwebsite\Excel\Concerns\WithHeadings;
use Maatwebsite\Excel\Concerns\WithTitle;

class ProductTemplateSheet implements FromArray, WithHeadings, WithTitle
{
    public function array(): array
    {
        $categoryId = Category::orderBy('id')->value('id') ?? 0;
        $supplierId = Supplier::orderBy('id')->value('id') ?? 0;

        return [
            [
                $categoryId,
                $supplierId,
                'PRD001',
                'Contoh Produk',
                'Deskripsi produk',
                'pcs',
                100000,
                150000,
                5,
            ],
        ];
    }

    public function headings(): array
    {
        return [
            'category_id',
            'supplier_id',
            'code',
            'name',
            'description',
            'unit',
            'purchase_price',
            'selling_price',
            'minimum_stock',
        ];
    }

    public function title(): string
    {
        return 'Template Produk';
    }
}