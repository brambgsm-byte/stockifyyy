<?php

namespace App\Exports;

use App\Models\Category;
use App\Models\Supplier;
use Illuminate\Support\Collection;
use Maatwebsite\Excel\Concerns\FromCollection;
use Maatwebsite\Excel\Concerns\WithHeadings;
use Maatwebsite\Excel\Concerns\WithTitle;

class ReferenceDataSheet implements FromCollection, WithHeadings, WithTitle
{
    public function collection(): Collection
    {
        $data = collect();

        foreach (Category::orderBy('id')->get() as $category) {
            $data->push([
                'Kategori',
                $category->id,
                $category->name,
            ]);
        }

        foreach (Supplier::orderBy('id')->get() as $supplier) {
            $data->push([
                'Supplier',
                $supplier->id,
                $supplier->name,
            ]);
        }

        return $data;
    }

    public function headings(): array
    {
        return [
            'jenis',
            'id',
            'nama',
        ];
    }

    public function title(): string
    {
        return 'Referensi Kategori Supplier';
    }
}