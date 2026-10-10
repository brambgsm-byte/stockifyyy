<?php

namespace App\Http\Controllers;

use App\Models\Product;
use Illuminate\View\View;

class StockManagementController extends Controller
{
    /**
     * Menampilkan halaman manajemen stok.
     */
    public function index(): View
    {
        $products = Product::with(['category', 'supplier'])
            ->orderBy('name', 'asc')
            ->get();

        return view('stock-management.index', compact('products'));
    }
}