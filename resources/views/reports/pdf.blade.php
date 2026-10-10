<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">

    <title>Laporan Stok</title>

    <style>
        @page {
            margin: 25px;
        }

        body {
            font-family: DejaVu Sans, sans-serif;
            font-size: 10px;
            color: #222;
        }

        h1 {
            text-align: center;
            margin-bottom: 5px;
            font-size: 18px;
        }

        .subtitle {
            text-align: center;
            margin-bottom: 20px;
            color: #555;
        }

        .summary {
            width: 100%;
            margin-bottom: 20px;
        }

        .summary td {
            width: 25%;
            padding: 8px;
            border: 1px solid #ddd;
            text-align: center;
        }

        .summary strong {
            display: block;
            font-size: 15px;
            margin-top: 5px;
        }

        table {
            width: 100%;
            border-collapse: collapse;
        }

        th {
            background-color: #1f2937;
            color: white;
            padding: 7px;
            border: 1px solid #999;
            text-align: center;
        }

        td {
            padding: 6px;
            border: 1px solid #bbb;
        }

        .text-center {
            text-align: center;
        }

        .text-right {
            text-align: right;
        }

        .badge-in {
            color: #15803d;
            font-weight: bold;
        }

        .badge-out {
            color: #dc2626;
            font-weight: bold;
        }

        .footer {
            margin-top: 20px;
            text-align: right;
            font-size: 9px;
            color: #666;
        }
    </style>
</head>

<body>

    <h1>LAPORAN STOK BARANG</h1>

    <div class="subtitle">
        Stockify - Sistem Manajemen Persediaan
    </div>

    <table class="summary">
        <tr>
            <td>
                Total Produk
                <strong>{{ $totalProducts }}</strong>
            </td>

            <td>
                Total Stok
                <strong>{{ number_format($totalStock, 0, ',', '.') }}</strong>
            </td>

            <td>
                Total Barang Masuk
                <strong>{{ number_format($totalStockIn, 0, ',', '.') }}</strong>
            </td>

            <td>
                Total Barang Keluar
                <strong>{{ number_format($totalStockOut, 0, ',', '.') }}</strong>
            </td>
        </tr>
    </table>

    <h3>Riwayat Transaksi Stok</h3>

    <table>
        <thead>
            <tr>
                <th width="5%">No.</th>
                <th width="15%">Tanggal</th>
                <th width="15%">Kode Produk</th>
                <th width="20%">Nama Produk</th>
                <th width="10%">Jenis</th>
                <th width="10%">Jumlah</th>
                <th width="15%">Pengguna</th>
                <th width="10%">Keterangan</th>
            </tr>
        </thead>

        <tbody>
            @forelse ($transactions as $transaction)
                <tr>
                    <td class="text-center">
                        {{ $loop->iteration }}
                    </td>

                    <td class="text-center">
                        {{ \Carbon\Carbon::parse($transaction->transaction_date)->format('d-m-Y') }}
                    </td>

                    <td>
                        {{ $transaction->product->code ?? '-' }}
                    </td>

                    <td>
                        {{ $transaction->product->name ?? '-' }}
                    </td>

                    <td class="text-center">
                        @if ($transaction->type === 'in')
                            <span class="badge-in">Masuk</span>
                        @else
                            <span class="badge-out">Keluar</span>
                        @endif
                    </td>

                    <td class="text-right">
                        {{ number_format($transaction->quantity, 0, ',', '.') }}
                    </td>

                    <td>
                        {{ $transaction->user->name ?? '-' }}
                    </td>

                    <td>
                        {{ $transaction->description ?? '-' }}
                    </td>
                </tr>
            @empty
                <tr>
                    <td colspan="8" class="text-center">
                        Tidak ada transaksi stok.
                    </td>
                </tr>
            @endforelse
        </tbody>
    </table>

    <div class="footer">
        Dicetak pada:
        {{ now()->format('d-m-Y H:i:s') }}
    </div>

</body>
</html>