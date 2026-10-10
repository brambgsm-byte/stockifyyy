<?php

namespace App\Http\Controllers;

use App\Models\Product;
use App\Models\StockOpname;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\View\View;

class StockOpnameController extends Controller
{
    /**
     * Menampilkan seluruh data Stock Opname.
     */
    public function index(): View
    {
        $opnames = StockOpname::with(['product', 'user'])
            ->latest('opname_date')
            ->latest()
            ->get();

        return view('stock-opnames.index', compact('opnames'));
    }

    /**
     * Form tambah Stock Opname.
     */
    public function create(): View
    {
        $products = Product::orderBy('name')->get();

        return view('stock-opnames.create', compact('products'));
    }

    /**
     * Menyimpan Stock Opname baru.
     */
    public function store(Request $request)
    {
        $validated = $request->validate([
            'product_id' => [
                'required',
                'exists:products,id',
            ],

            'opname_date' => [
                'required',
                'date',
            ],

            'actual_stock' => [
                'required',
                'integer',
                'min:0',
            ],

            'notes' => [
                'nullable',
                'string',
            ],
        ]);

        DB::transaction(function () use ($validated) {

            $product = Product::where(
                'id',
                $validated['product_id']
            )
                ->lockForUpdate()
                ->firstOrFail();

            /*
            |--------------------------------------------------------------------------
            | Stok sistem sebelum dilakukan Stock Opname
            |--------------------------------------------------------------------------
            */

            $systemStock = (int) $product->stock;

            /*
            |--------------------------------------------------------------------------
            | Stok fisik hasil Stock Opname
            |--------------------------------------------------------------------------
            */

            $actualStock = (int) $validated['actual_stock'];

            /*
            |--------------------------------------------------------------------------
            | Selisih Stock Opname
            |--------------------------------------------------------------------------
            */

            $difference = $actualStock - $systemStock;

            /*
            |--------------------------------------------------------------------------
            | Simpan histori Stock Opname
            |--------------------------------------------------------------------------
            */

            StockOpname::create([
                'product_id' => $product->id,
                'user_id' => Auth::id(),
                'opname_date' => $validated['opname_date'],
                'system_stock' => $systemStock,
                'actual_stock' => $actualStock,
                'difference' => $difference,
                'notes' => $validated['notes'] ?? null,
            ]);

            /*
            |--------------------------------------------------------------------------
            | Setelah Stock Opname, stok sistem mengikuti stok fisik.
            |--------------------------------------------------------------------------
            */

            $product->update([
                'stock' => $actualStock,
            ]);
        });

        return redirect()
            ->route('stock-opnames.index')
            ->with(
                'success',
                'Stock opname berhasil disimpan.'
            );
    }

    /**
     * Menampilkan detail Stock Opname.
     */
    public function show(string $id): View
    {
        $opname = StockOpname::with([
            'product.category',
            'user',
        ])->findOrFail($id);

        return view(
            'stock-opnames.show',
            compact('opname')
        );
    }

    /**
     * Form edit Stock Opname.
     *
     * Hanya Admin.
     */
    public function edit(string $id): View
    {
        abort_unless(
            Auth::check() &&
            Auth::user()->role === 'admin',
            403
        );

        $opname = StockOpname::with('product')
            ->findOrFail($id);

        $products = Product::orderBy('name')->get();

        return view(
            'stock-opnames.edit',
            compact('opname', 'products')
        );
    }

    /**
     * Memperbarui Stock Opname.
     *
     * Hanya Admin.
     */
    public function update(
        Request $request,
        string $id
    ) {
        abort_unless(
            Auth::check() &&
            Auth::user()->role === 'admin',
            403
        );

        $validated = $request->validate([
            'opname_date' => [
                'required',
                'date',
            ],

            'actual_stock' => [
                'required',
                'integer',
                'min:0',
            ],

            'notes' => [
                'nullable',
                'string',
            ],
        ]);

        DB::transaction(function () use (
            $validated,
            $id
        ) {

            /*
            |--------------------------------------------------------------------------
            | Ambil Stock Opname yang akan diedit
            |--------------------------------------------------------------------------
            */

            $opname = StockOpname::where(
                'id',
                $id
            )
                ->lockForUpdate()
                ->firstOrFail();

            /*
            |--------------------------------------------------------------------------
            | Ambil produk terkait
            |--------------------------------------------------------------------------
            */

            $product = Product::where(
                'id',
                $opname->product_id
            )
                ->lockForUpdate()
                ->firstOrFail();

            /*
            |--------------------------------------------------------------------------
            | Nilai lama
            |--------------------------------------------------------------------------
            */

            $oldDifference = (int) $opname->difference;

            /*
            |--------------------------------------------------------------------------
            | Nilai baru
            |--------------------------------------------------------------------------
            */

            $newActualStock = (int) $validated['actual_stock'];

            /*
            |--------------------------------------------------------------------------
            | System Stock untuk histori tetap menggunakan nilai awal opname.
            |--------------------------------------------------------------------------
            */

            $systemStock = (int) $opname->system_stock;

            /*
            |--------------------------------------------------------------------------
            | Hitung selisih baru.
            |--------------------------------------------------------------------------
            */

            $newDifference =
                $newActualStock - $systemStock;

            /*
            |--------------------------------------------------------------------------
            | Batalkan koreksi Stock Opname lama.
            |
            | Contoh:
            |
            | Selisih lama = +1.234
            |
            | Stok sekarang dikurangi 1.234 untuk membatalkan
            | koreksi lama.
            |--------------------------------------------------------------------------
            */

            $currentStock = (int) $product->stock;

            $stockAfterRemovingOldAdjustment =
                $currentStock - $oldDifference;

            /*
            |--------------------------------------------------------------------------
            | Pastikan stok tidak menjadi negatif.
            |--------------------------------------------------------------------------
            */

            if ($stockAfterRemovingOldAdjustment < 0) {
                abort(
                    422,
                    'Stock opname tidak dapat diperbarui karena pembatalan koreksi lama membuat stok menjadi negatif.'
                );
            }

            /*
            |--------------------------------------------------------------------------
            | Terapkan koreksi Stock Opname yang baru.
            |--------------------------------------------------------------------------
            */

            $newProductStock =
                $stockAfterRemovingOldAdjustment +
                $newDifference;

            if ($newProductStock < 0) {
                abort(
                    422,
                    'Stock opname tidak dapat diperbarui karena koreksi baru membuat stok menjadi negatif.'
                );
            }

            /*
            |--------------------------------------------------------------------------
            | Update stok produk.
            |--------------------------------------------------------------------------
            */

            $product->update([
                'stock' => $newProductStock,
            ]);

            /*
            |--------------------------------------------------------------------------
            | Update data Stock Opname.
            |--------------------------------------------------------------------------
            */

            $opname->update([
                'opname_date' => $validated['opname_date'],
                'system_stock' => $systemStock,
                'actual_stock' => $newActualStock,
                'difference' => $newDifference,
                'notes' => $validated['notes'] ?? null,
            ]);
        });

        return redirect()
            ->route('stock-opnames.index')
            ->with(
                'success',
                'Stock opname berhasil diperbarui.'
            );
    }

    /**
     * Menghapus Stock Opname.
     *
     * Hanya Admin.
     */
    public function destroy(string $id)
    {
        abort_unless(
            Auth::check() &&
            Auth::user()->role === 'admin',
            403
        );

        DB::transaction(function () use ($id) {

            /*
            |--------------------------------------------------------------------------
            | Ambil Stock Opname
            |--------------------------------------------------------------------------
            */

            $opname = StockOpname::where(
                'id',
                $id
            )
                ->lockForUpdate()
                ->firstOrFail();

            /*
            |--------------------------------------------------------------------------
            | Ambil produk terkait
            |--------------------------------------------------------------------------
            */

            $product = Product::where(
                'id',
                $opname->product_id
            )
                ->lockForUpdate()
                ->firstOrFail();

            /*
            |--------------------------------------------------------------------------
            | Ambil koreksi Stock Opname
            |--------------------------------------------------------------------------
            */

            $difference = (int) $opname->difference;

            $currentStock = (int) $product->stock;

            /*
            |--------------------------------------------------------------------------
            | Batalkan koreksi Stock Opname.
            |--------------------------------------------------------------------------
            */

            $newProductStock =
                $currentStock - $difference;

            /*
            |--------------------------------------------------------------------------
            | Pastikan stok tidak negatif.
            |--------------------------------------------------------------------------
            */

            if ($newProductStock < 0) {
                abort(
                    422,
                    'Stock opname tidak dapat dihapus karena pembatalan koreksi membuat stok menjadi negatif.'
                );
            }

            /*
            |--------------------------------------------------------------------------
            | Update stok produk.
            |--------------------------------------------------------------------------
            */

            $product->update([
                'stock' => $newProductStock,
            ]);

            /*
            |--------------------------------------------------------------------------
            | Hapus histori Stock Opname.
            |--------------------------------------------------------------------------
            */

            $opname->delete();
        });

        return redirect()
            ->route('stock-opnames.index')
            ->with(
                'success',
                'Data stock opname berhasil dihapus.'
            );
    }
}