<?php

namespace App\Exports;

use App\Models\StockTransaction;
use Illuminate\Database\Eloquent\Builder;
use Maatwebsite\Excel\Concerns\FromQuery;
use Maatwebsite\Excel\Concerns\WithHeadings;
use Maatwebsite\Excel\Concerns\WithMapping;

class StockReportExport implements FromQuery, WithHeadings, WithMapping
{
    protected ?string $startDate;
    protected ?string $endDate;
    protected ?string $type;

    public function __construct(
        ?string $startDate = null,
        ?string $endDate = null,
        ?string $type = null
    ) {
        $this->startDate = $startDate;
        $this->endDate = $endDate;
        $this->type = $type;
    }

    public function query(): Builder
    {
        return StockTransaction::query()
            ->with(['product', 'user'])
            ->when($this->startDate, function (Builder $query) {
                $query->whereDate('transaction_date', '>=', $this->startDate);
            })
            ->when($this->endDate, function (Builder $query) {
                $query->whereDate('transaction_date', '<=', $this->endDate);
            })
            ->when($this->type, function (Builder $query) {
                $query->where('type', $this->type);
            })
            ->latest('transaction_date')
            ->latest('id');
    }

    public function headings(): array
    {
        return [
            'No',
            'Tanggal',
            'Produk',
            'SKU',
            'Jenis Transaksi',
            'Jumlah',
            'Pengguna',
            'Keterangan',
        ];
    }

    public function map($transaction): array
    {
        static $number = 0;

        $number++;

        return [
            $number,
            optional($transaction->transaction_date)->format('d-m-Y')
                ?? $transaction->transaction_date,
            $transaction->product->name ?? '-',
            $transaction->product->sku ?? '-',
            strtoupper($transaction->type),
            $transaction->quantity,
            $transaction->user->name ?? '-',
            $transaction->description ?? '-',
        ];
    }
}