<?php

namespace App\Http\Controllers;

use App\Exports\StockReportExport;
use App\Models\ActivityLog;
use App\Models\Category;
use App\Models\Product;
use App\Models\StockTransaction;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\View\View;
use Maatwebsite\Excel\Facades\Excel;
use Barryvdh\DomPDF\Facade\Pdf;

class ReportController extends Controller
{
    /**
     * Menampilkan laporan stok dan transaksi.
     */
    public function index(Request $request): View
    {
        $startDate = $request->input('start_date');
        $endDate = $request->input('end_date');
        $type = $request->input('type');
        $categoryId = $request->input('category_id');

        $transactions = StockTransaction::with([
            'product.category',
            'user',
        ])
            ->when($startDate, function ($query) use ($startDate) {
                $query->whereDate('transaction_date', '>=', $startDate);
            })
            ->when($endDate, function ($query) use ($endDate) {
                $query->whereDate('transaction_date', '<=', $endDate);
            })
            ->when($type, function ($query) use ($type) {
                $query->where('type', $type);
            })
            ->when($categoryId, function ($query) use ($categoryId) {
                $query->whereHas('product', function ($productQuery) use ($categoryId) {
                    $productQuery->where('category_id', $categoryId);
                });
            })
            ->latest('transaction_date')
            ->latest('id')
            ->get();

        $products = Product::with('category')
            ->when($categoryId, function ($query) use ($categoryId) {
                $query->where('category_id', $categoryId);
            })
            ->orderBy('name')
            ->get();

        $totalStockIn = $transactions
            ->where('type', 'in')
            ->sum('quantity');

        $totalStockOut = $transactions
            ->where('type', 'out')
            ->sum('quantity');

        $totalProducts = $products->count();

        $totalStock = $products->sum('stock');

        $categories = Category::orderBy('name')->get();

        return view('reports.index', compact(
            'transactions',
            'products',
            'categories',
            'totalProducts',
            'totalStock',
            'totalStockIn',
            'totalStockOut',
            'startDate',
            'endDate',
            'type',
            'categoryId'
        ));
    }

    /**
     * Mengekspor laporan transaksi ke Excel.
     */
    public function exportExcel(Request $request)
    {
        $validated = $request->validate([
            'start_date' => ['nullable', 'date'],
            'end_date' => [
                'nullable',
                'date',
                'after_or_equal:start_date',
            ],
            'type' => ['nullable', 'in:in,out'],
        ]);

        $fileName = 'laporan-stok-' . now()->format('Y-m-d-His') . '.xlsx';

        return Excel::download(
            new StockReportExport(
                $validated['start_date'] ?? null,
                $validated['end_date'] ?? null,
                $validated['type'] ?? null
            ),
            $fileName
        );
    }

    /**
     * Mengekspor laporan transaksi ke PDF.
     */
    public function exportPdf(Request $request)
    {
        $validated = $request->validate([
            'start_date' => ['nullable', 'date'],
            'end_date' => [
                'nullable',
                'date',
                'after_or_equal:start_date',
            ],
            'type' => ['nullable', 'in:in,out'],
            'category_id' => ['nullable', 'exists:categories,id'],
        ]);

        $startDate = $validated['start_date'] ?? null;
        $endDate = $validated['end_date'] ?? null;
        $type = $validated['type'] ?? null;
        $categoryId = $validated['category_id'] ?? null;

        $transactions = StockTransaction::with([
            'product.category',
            'user',
        ])
            ->when($startDate, function ($query) use ($startDate) {
                $query->whereDate('transaction_date', '>=', $startDate);
            })
            ->when($endDate, function ($query) use ($endDate) {
                $query->whereDate('transaction_date', '<=', $endDate);
            })
            ->when($type, function ($query) use ($type) {
                $query->where('type', $type);
            })
            ->when($categoryId, function ($query) use ($categoryId) {
                $query->whereHas('product', function ($productQuery) use ($categoryId) {
                    $productQuery->where('category_id', $categoryId);
                });
            })
            ->latest('transaction_date')
            ->latest('id')
            ->get();

        $products = Product::with('category')
            ->when($categoryId, function ($query) use ($categoryId) {
                $query->where('category_id', $categoryId);
            })
            ->orderBy('name')
            ->get();

        $totalStockIn = $transactions
            ->where('type', 'in')
            ->sum('quantity');

        $totalStockOut = $transactions
            ->where('type', 'out')
            ->sum('quantity');

        $totalProducts = $products->count();

        $totalStock = $products->sum('stock');

        $pdf = Pdf::loadView('reports.pdf', compact(
            'transactions',
            'products',
            'totalProducts',
            'totalStock',
            'totalStockIn',
            'totalStockOut',
            'startDate',
            'endDate',
            'type',
            'categoryId'
        ))->setPaper('a4', 'landscape');

        $fileName = 'laporan-stok-' . now()->format('Y-m-d-His') . '.pdf';

        return $pdf->download($fileName);
    }

    /**
     * Menampilkan laporan aktivitas pengguna.
     */
    public function activityReport(Request $request): View
    {
        $startDate = $request->input('start_date');
        $endDate = $request->input('end_date');
        $userId = $request->input('user_id');

        $activities = ActivityLog::with('user')
            ->when($startDate, function ($query) use ($startDate) {
                $query->whereDate('created_at', '>=', $startDate);
            })
            ->when($endDate, function ($query) use ($endDate) {
                $query->whereDate('created_at', '<=', $endDate);
            })
            ->when($userId, function ($query) use ($userId) {
                $query->where('user_id', $userId);
            })
            ->latest()
            ->paginate(15)
            ->withQueryString();

        $users = User::orderBy('name')->get();

        return view('reports.activity', compact(
            'activities',
            'users',
            'startDate',
            'endDate',
            'userId'
        ));
    }
}