<?php

use Illuminate\Support\Facades\Route;

use App\Http\Controllers\ActivityLogController;
use App\Http\Controllers\CategoryController;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\ProductController;
use App\Http\Controllers\ProductImportController;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\ReportController;
use App\Http\Controllers\SettingController;
use App\Http\Controllers\StockManagementController;
use App\Http\Controllers\StockOpnameController;
use App\Http\Controllers\StockTransactionController;
use App\Http\Controllers\SupplierController;
use App\Http\Controllers\UserController;


/*
|--------------------------------------------------------------------------
| DASHBOARD
|--------------------------------------------------------------------------
*/

Route::get('/dashboard', function () {

    $user = auth()->user();

    return match ($user->role) {
        'admin' => redirect()->route('admin.dashboard'),
        'manager' => redirect()->route('manager.dashboard'),
        'staff' => redirect()->route('staff.dashboard'),
        default => abort(403, 'Role pengguna tidak valid.'),
    };

})->middleware('auth')->name('dashboard');


Route::get('/admin/dashboard', [DashboardController::class, 'index'])
    ->middleware(['auth', 'role:admin'])
    ->name('admin.dashboard');

Route::get('/manager/dashboard', [DashboardController::class, 'index'])
    ->middleware(['auth', 'role:manager'])
    ->name('manager.dashboard');

Route::get('/staff/dashboard', [DashboardController::class, 'index'])
    ->middleware(['auth', 'role:staff'])
    ->name('staff.dashboard');


/*
|--------------------------------------------------------------------------
| PROFILE
|--------------------------------------------------------------------------
*/

Route::middleware('auth')->group(function () {

    Route::get('/profile', [ProfileController::class, 'edit'])
        ->name('profile.edit');

    Route::patch('/profile', [ProfileController::class, 'update'])
        ->name('profile.update');

    Route::delete('/profile', [ProfileController::class, 'destroy'])
        ->name('profile.destroy');

});


/*
|--------------------------------------------------------------------------
| CATEGORIES
|--------------------------------------------------------------------------
| Admin: Full CRUD
|--------------------------------------------------------------------------
*/

Route::middleware(['auth', 'role:admin'])->group(function () {

    Route::resource('categories', CategoryController::class)
        ->except(['show']);

});


/*
|--------------------------------------------------------------------------
| SUPPLIERS
|--------------------------------------------------------------------------
| Admin   : Full CRUD
| Manager : View only
| Staff   : No access
|--------------------------------------------------------------------------
*/

Route::middleware(['auth', 'role:admin,manager'])->group(function () {

    Route::get('/suppliers', [SupplierController::class, 'index'])
        ->name('suppliers.index');

});


Route::middleware(['auth', 'role:admin'])->group(function () {

    Route::get('/suppliers/create', [SupplierController::class, 'create'])
        ->name('suppliers.create');

    Route::post('/suppliers', [SupplierController::class, 'store'])
        ->name('suppliers.store');

    Route::get('/suppliers/{supplier}/edit', [SupplierController::class, 'edit'])
        ->name('suppliers.edit');

    Route::put('/suppliers/{supplier}', [SupplierController::class, 'update'])
        ->name('suppliers.update');

    Route::delete('/suppliers/{supplier}', [SupplierController::class, 'destroy'])
        ->name('suppliers.destroy');

});


/*
|--------------------------------------------------------------------------
| USERS
|--------------------------------------------------------------------------
| Admin only
|--------------------------------------------------------------------------
*/

Route::middleware(['auth', 'role:admin'])->group(function () {

    Route::resource('users', UserController::class)
        ->except(['show']);

});


/*
|--------------------------------------------------------------------------
| ACTIVITY LOGS
|--------------------------------------------------------------------------
| Admin only
|--------------------------------------------------------------------------
*/

Route::middleware(['auth', 'role:admin'])->group(function () {

    Route::get('/activity-logs', [ActivityLogController::class, 'index'])
        ->name('activity-logs.index');

});


/*
|--------------------------------------------------------------------------
| PRODUCTS
|--------------------------------------------------------------------------
| Admin   : Full CRUD
| Manager : Lihat + Tambah
| Staff   : No access
|--------------------------------------------------------------------------
*/


/*
|--------------------------------------------------------------------------
| PRODUCT IMPORT
|--------------------------------------------------------------------------
| Admin only
|--------------------------------------------------------------------------
*/

Route::middleware(['auth', 'role:admin'])->group(function () {

    Route::get('/products/import', [ProductImportController::class, 'create'])
        ->name('products.import');

    Route::post('/products/import', [ProductImportController::class, 'store'])
        ->name('products.import.store');

    Route::get('/products/import/template', [ProductImportController::class, 'downloadTemplate'])
        ->name('products.import.template');

});


/*
|--------------------------------------------------------------------------
| PRODUCT CREATE
|--------------------------------------------------------------------------
| Admin + Manager
|--------------------------------------------------------------------------
|
| Sesuai tugas:
| - Admin dapat menambah produk
| - Manager Gudang dapat menambahkan produk baru
|
*/

Route::middleware(['auth', 'role:admin,manager'])->group(function () {

    Route::get('/products/create', [ProductController::class, 'create'])
        ->name('products.create');

    Route::post('/products', [ProductController::class, 'store'])
        ->name('products.store');

});


/*
|--------------------------------------------------------------------------
| PRODUCT ADMIN
|--------------------------------------------------------------------------
| Admin only
| - Edit
| - Update
| - Delete
|--------------------------------------------------------------------------
*/

Route::middleware(['auth', 'role:admin'])->group(function () {

    Route::get('/products/{product}/edit', [ProductController::class, 'edit'])
        ->name('products.edit');

    Route::match(['put', 'patch'], '/products/{product}', [ProductController::class, 'update'])
        ->name('products.update');

    Route::delete('/products/{product}', [ProductController::class, 'destroy'])
        ->name('products.destroy');

});


/*
|--------------------------------------------------------------------------
| PRODUCT VIEW
|--------------------------------------------------------------------------
| Admin + Manager
|--------------------------------------------------------------------------
*/

Route::middleware(['auth', 'role:admin,manager'])->group(function () {

    Route::get('/products', [ProductController::class, 'index'])
        ->name('products.index');

    Route::get('/products/{product}', [ProductController::class, 'show'])
        ->name('products.show');

});


/*
|--------------------------------------------------------------------------
| STOCK MANAGEMENT
|--------------------------------------------------------------------------
| Admin + Manager + Staff
|--------------------------------------------------------------------------
*/

Route::middleware(['auth', 'role:admin,manager,staff'])->group(function () {

    Route::get('/stock-management', [StockManagementController::class, 'index'])
        ->name('stock-management.index');

});


/*
|--------------------------------------------------------------------------
| STOCK TRANSACTIONS
|--------------------------------------------------------------------------
| Admin   : Lihat, tambah, hapus
| Manager : Lihat, tambah
| Staff   : Lihat, tambah, konfirmasi
|--------------------------------------------------------------------------
*/


/*
|--------------------------------------------------------------------------
| ADMIN + MANAGER + STAFF
|--------------------------------------------------------------------------
| Melihat dan membuat transaksi stok.
|--------------------------------------------------------------------------
*/

Route::middleware(['auth', 'role:admin,manager,staff'])->group(function () {

    Route::get(
        '/stock-transactions',
        [StockTransactionController::class, 'index']
    )->name('stock-transactions.index');

    Route::get(
        '/stock-transactions/create',
        [StockTransactionController::class, 'create']
    )->name('stock-transactions.create');

    Route::post(
        '/stock-transactions',
        [StockTransactionController::class, 'store']
    )->name('stock-transactions.store');

});


/*
|--------------------------------------------------------------------------
| STAFF
|--------------------------------------------------------------------------
| Staff dapat mengonfirmasi transaksi.
|--------------------------------------------------------------------------
*/

Route::middleware(['auth', 'role:staff'])->group(function () {

    Route::post(
        '/stock-transactions/{id}/confirm',
        [StockTransactionController::class, 'confirm']
    )->name('stock-transactions.confirm');

});


/*
|--------------------------------------------------------------------------
| ADMIN
|--------------------------------------------------------------------------
| Hanya Admin yang dapat menghapus transaksi.
|--------------------------------------------------------------------------
*/

Route::middleware(['auth', 'role:admin'])->group(function () {

    Route::delete(
        '/stock-transactions/{id}',
        [StockTransactionController::class, 'destroy']
    )->name('stock-transactions.destroy');

});


/*
|--------------------------------------------------------------------------
| STOCK OPNAME
|--------------------------------------------------------------------------
| Semua user yang sudah login dapat melihat,
| menambah, edit, detail, dan delete.
|
| Pembatasan hak akses tambahan tetap ditangani
| di StockOpnameController.
|--------------------------------------------------------------------------
*/

Route::middleware(['auth'])->group(function () {

    Route::resource('stock-opnames', StockOpnameController::class);

});


/*
|--------------------------------------------------------------------------
| REPORTS
|--------------------------------------------------------------------------
| Admin + Manager
|--------------------------------------------------------------------------
*/

Route::middleware(['auth', 'role:admin,manager'])->group(function () {

    Route::get('/reports', [ReportController::class, 'index'])
        ->name('reports.index');

    Route::get('/reports/activity', [ReportController::class, 'activityReport'])
        ->name('reports.activity');

    Route::get('/reports/export-excel', [ReportController::class, 'exportExcel'])
        ->name('reports.export.excel');

    Route::get('/reports/export-pdf', [ReportController::class, 'exportPdf'])
        ->name('reports.export.pdf');

});


/*
|--------------------------------------------------------------------------
| SETTINGS
|--------------------------------------------------------------------------
| Admin only
|--------------------------------------------------------------------------
*/

Route::middleware(['auth', 'role:admin'])->group(function () {

    Route::get('/settings', [SettingController::class, 'index'])
        ->name('settings.index');

    Route::put('/settings', [SettingController::class, 'update'])
        ->name('settings.update');

    Route::delete('/settings/logo', [SettingController::class, 'removeLogo'])
        ->name('settings.logo.remove');

});


/*
|--------------------------------------------------------------------------
| AUTHENTICATION
|--------------------------------------------------------------------------
*/

require __DIR__ . '/auth.php';