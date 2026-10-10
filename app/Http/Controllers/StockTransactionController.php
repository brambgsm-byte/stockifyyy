<?php

namespace App\Http\Controllers;

use App\Http\Requests\StockTransactionRequest;
use App\Models\Product;
use App\Services\StockTransactionService;
use Illuminate\Http\RedirectResponse;
use Illuminate\Support\Facades\Auth;
use Illuminate\View\View;

class StockTransactionController extends Controller
{
    protected StockTransactionService $stockTransactionService;

    public function __construct(
        StockTransactionService $stockTransactionService
    ) {
        $this->stockTransactionService = $stockTransactionService;
    }

    public function index(): View
    {
        $transactions = $this->stockTransactionService->getAllTransactions();

        return view('stock-transactions.index', compact('transactions'));
    }

    public function create(): View
    {
        $products = Product::orderBy('name', 'asc')->get();

        return view('stock-transactions.create', compact('products'));
    }

    public function store(StockTransactionRequest $request): RedirectResponse
    {
        $this->stockTransactionService->createTransaction(
            $request->validated()
        );

        return redirect()
            ->route('stock-transactions.index')
            ->with('success', 'Transaksi stok berhasil disimpan.');
    }

    /**
     * Konfirmasi transaksi stok oleh Staff.
     */
    public function confirm(int $id): RedirectResponse
    {
        abort_unless(
            Auth::check() &&
            in_array(Auth::user()->role, ['admin', 'manager', 'staff']),
            403
        );

        $this->stockTransactionService->confirmTransaction($id);

        return redirect()
            ->back()
            ->with('success', 'Transaksi stok berhasil dikonfirmasi.');
    }

    public function destroy(int $id): RedirectResponse
    {
        /*
        |--------------------------------------------------------------------------
        | Hapus transaksi hanya boleh dilakukan oleh Admin
        |--------------------------------------------------------------------------
        */

        abort_unless(
            Auth::check() && Auth::user()->role === 'admin',
            403
        );

        $this->stockTransactionService->deleteTransaction($id);

        return redirect()
            ->route('stock-transactions.index')
            ->with('success', 'Transaksi stok berhasil dihapus.');
    }
}