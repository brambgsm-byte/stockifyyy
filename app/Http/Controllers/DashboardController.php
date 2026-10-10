<?php

namespace App\Http\Controllers;

use App\Models\ActivityLog;
use App\Models\Category;
use App\Models\Product;
use App\Models\StockTransaction;
use App\Models\Supplier;
use Carbon\Carbon;
use Illuminate\View\View;

class DashboardController extends Controller
{
    /**
     * Menampilkan dashboard.
     */
    public function index(): View
    {
        /*
        |--------------------------------------------------------------------------
        | DASHBOARD STAFF
        |--------------------------------------------------------------------------
        | Staff hanya membutuhkan daftar tugas:
        | - Barang masuk yang perlu diperiksa
        | - Barang keluar yang perlu disiapkan
        |--------------------------------------------------------------------------
        */

        if (auth()->user()->role === 'staff') {

            /*
             * Barang masuk yang masih menunggu konfirmasi Staff.
             */
            $pendingStockIn = StockTransaction::with([
                'product',
                'user'
            ])
                ->where('type', 'in')
                ->where('status', 'pending')
                ->orderBy('transaction_date', 'desc')
                ->orderBy('id', 'desc')
                ->get();

            /*
             * Barang keluar yang masih menunggu konfirmasi Staff.
             */
            $pendingStockOut = StockTransaction::with([
                'product',
                'user'
            ])
                ->where('type', 'out')
                ->where('status', 'pending')
                ->orderBy('transaction_date', 'desc')
                ->orderBy('id', 'desc')
                ->get();

            return view('dashboard', compact(
                'pendingStockIn',
                'pendingStockOut'
            ));
        }


        /*
        |--------------------------------------------------------------------------
        | DASHBOARD ADMIN & MANAGER
        |--------------------------------------------------------------------------
        | Bagian ini menggunakan dashboard utama.
        |--------------------------------------------------------------------------
        */

        // Statistik utama
        $totalProducts = Product::count();

        $totalCategories = Category::count();

        $totalSuppliers = Supplier::count();

        $totalStock = Product::sum('stock');

        $totalStockIn = StockTransaction::where('type', 'in')
            ->sum('quantity');

        $totalStockOut = StockTransaction::where('type', 'out')
            ->sum('quantity');


        /*
        |--------------------------------------------------------------------------
        | BARANG MASUK & KELUAR HARI INI
        |--------------------------------------------------------------------------
        | Digunakan untuk kebutuhan Dashboard Manager Gudang.
        |--------------------------------------------------------------------------
        */

        $todayStockIn = StockTransaction::where('type', 'in')
            ->whereDate('transaction_date', Carbon::today())
            ->sum('quantity');

        $todayStockOut = StockTransaction::where('type', 'out')
            ->whereDate('transaction_date', Carbon::today())
            ->sum('quantity');


        // Produk dengan stok rendah
        $lowStockProducts = Product::whereColumn(
            'stock',
            '<=',
            'minimum_stock'
        )
            ->orderBy('stock', 'asc')
            ->get();


        // Lima transaksi terbaru
        $recentTransactions = StockTransaction::with([
            'product',
            'user'
        ])
            ->orderBy('transaction_date', 'desc')
            ->orderBy('id', 'desc')
            ->take(5)
            ->get();


        // Lima aktivitas terbaru
        $recentActivities = ActivityLog::with('user')
            ->latest()
            ->take(5)
            ->get();


        // Data transaksi enam bulan terakhir
        $monthlyStockIn = [];
        $monthlyStockOut = [];
        $monthlyLabels = [];

        for ($i = 5; $i >= 0; $i--) {

            $date = Carbon::now()->subMonths($i);

            $month = $date->month;
            $year = $date->year;

            $monthlyLabels[] = $date->translatedFormat('M Y');

            $monthlyStockIn[] = StockTransaction::where('type', 'in')
                ->whereMonth('transaction_date', $month)
                ->whereYear('transaction_date', $year)
                ->sum('quantity');

            $monthlyStockOut[] = StockTransaction::where('type', 'out')
                ->whereMonth('transaction_date', $month)
                ->whereYear('transaction_date', $year)
                ->sum('quantity');
        }


        return view('dashboard', compact(
            'totalProducts',
            'totalCategories',
            'totalSuppliers',
            'totalStock',
            'totalStockIn',
            'totalStockOut',
            'todayStockIn',
            'todayStockOut',
            'lowStockProducts',
            'recentTransactions',
            'recentActivities',
            'monthlyLabels',
            'monthlyStockIn',
            'monthlyStockOut'
        ));
    }
}