<?php $__env->startSection('title', 'Dashboard'); ?>
<?php $__env->startSection('page-title', 'Dashboard'); ?>

<?php $__env->startSection('content'); ?>

<?php if(auth()->user()->role === 'staff'): ?>

    

    <div class="mx-auto w-full max-w-7xl space-y-6 px-4 py-6 sm:px-6 lg:px-8">

        
        <div class="flex flex-col justify-between gap-4 sm:flex-row sm:items-center">

            <div>
                <p class="text-sm text-slate-500">
                    Dashboard / Staff Gudang
                </p>

                <h1 class="mt-1 text-2xl font-bold text-slate-900">
                    Dashboard Staff Gudang
                </h1>

                <p class="mt-1 text-sm text-slate-500">
                    Daftar tugas barang yang perlu diperiksa dan disiapkan.
                </p>
            </div>

        </div>


        

        <div class="grid grid-cols-1 gap-5 md:grid-cols-2">

            
            <div class="rounded-xl border border-slate-200 bg-white p-6 shadow-sm">

                <div class="flex items-start justify-between">

                    <div>

                        <p class="text-sm font-medium text-slate-500">
                            Barang Masuk
                        </p>

                        <h2 class="mt-4 text-3xl font-bold text-slate-900">
                            <?php echo e(($pendingStockIn ?? collect())->count()); ?>

                        </h2>

                        <p class="mt-2 text-sm text-slate-500">
                            Perlu diperiksa
                        </p>

                    </div>

                    <div class="flex h-14 w-14 items-center justify-center rounded-xl bg-green-100 text-green-600">

                        <svg
                            class="h-7 w-7"
                            fill="none"
                            stroke="currentColor"
                            viewBox="0 0 24 24"
                        >
                            <path
                                stroke-linecap="round"
                                stroke-linejoin="round"
                                stroke-width="2"
                                d="M12 4v16m8-8l-8 8-8-8"
                            />
                        </svg>

                    </div>

                </div>

            </div>


            
            <div class="rounded-xl border border-slate-200 bg-white p-6 shadow-sm">

                <div class="flex items-start justify-between">

                    <div>

                        <p class="text-sm font-medium text-slate-500">
                            Barang Keluar
                        </p>

                        <h2 class="mt-4 text-3xl font-bold text-slate-900">
                            <?php echo e(($pendingStockOut ?? collect())->count()); ?>

                        </h2>

                        <p class="mt-2 text-sm text-slate-500">
                            Perlu disiapkan
                        </p>

                    </div>

                    <div class="flex h-14 w-14 items-center justify-center rounded-xl bg-orange-100 text-orange-600">

                        <svg
                            class="h-7 w-7"
                            fill="none"
                            stroke="currentColor"
                            viewBox="0 0 24 24"
                        >
                            <path
                                stroke-linecap="round"
                                stroke-linejoin="round"
                                stroke-width="2"
                                d="M12 20V4m-8 8l8-8 8 8"
                            />
                        </svg>

                    </div>

                </div>

            </div>

        </div>


        

        <div class="overflow-hidden rounded-xl border border-slate-200 bg-white shadow-sm">

            <div class="flex flex-col justify-between gap-3 border-b border-slate-200 px-6 py-5 sm:flex-row sm:items-center">

                <div>

                    <h2 class="text-lg font-bold text-slate-900">
                        Barang Masuk yang Perlu Diperiksa
                    </h2>

                    <p class="mt-1 text-sm text-slate-500">
                        Daftar barang masuk yang masih menunggu konfirmasi.
                    </p>

                </div>

                <span
                    class="inline-flex w-fit rounded-full bg-yellow-100 px-4 py-2 text-sm font-semibold text-yellow-700"
                >
                    <?php echo e(($pendingStockIn ?? collect())->count()); ?> Menunggu
                </span>

            </div>


            <div class="overflow-x-auto">

                <table class="w-full text-left text-sm text-slate-600">

                    <thead class="bg-slate-50 text-xs uppercase text-slate-600">

                        <tr>

                            <th class="whitespace-nowrap px-6 py-4">
                                No
                            </th>

                            <th class="whitespace-nowrap px-6 py-4">
                                Tanggal
                            </th>

                            <th class="whitespace-nowrap px-6 py-4">
                                Produk
                            </th>

                            <th class="whitespace-nowrap px-6 py-4 text-center">
                                Jumlah
                            </th>

                            <th class="whitespace-nowrap px-6 py-4">
                                Keterangan
                            </th>

                            <th class="whitespace-nowrap px-6 py-4 text-center">
                                Aksi
                            </th>

                        </tr>

                    </thead>


                    <tbody>

                        <?php $__empty_1 = true; $__currentLoopData = ($pendingStockIn ?? collect()); $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $index => $transaction): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); $__empty_1 = false; ?>

                            <tr class="border-b border-slate-100 bg-white hover:bg-slate-50">

                                
                                <td class="px-6 py-5">
                                    <?php echo e($index + 1); ?>

                                </td>

                                
                                <td class="whitespace-nowrap px-6 py-5">
                                    <?php echo e($transaction->transaction_date?->format('d-m-Y') ?? '-'); ?>

                                </td>

                                
                                <td class="px-6 py-5">

                                    <div class="font-semibold text-slate-900">
                                        <?php echo e($transaction->product?->name ?? '-'); ?>

                                    </div>

                                    <?php if($transaction->product?->code): ?>

                                        <div class="mt-1 text-xs text-slate-500">
                                            <?php echo e($transaction->product->code); ?>

                                        </div>

                                    <?php endif; ?>

                                </td>

                                
                                <td class="px-6 py-5 text-center font-semibold text-slate-900">
                                    <?php echo e(number_format($transaction->quantity, 0, ',', '.')); ?>

                                </td>

                                
                                <td class="px-6 py-5">
                                    <?php echo e($transaction->description ?: '-'); ?>

                                </td>

                                
                                <td class="px-6 py-5 text-center">

                                    <form
                                        action="<?php echo e(route('stock-transactions.confirm', $transaction->id)); ?>"
                                        method="POST"
                                        onsubmit="return confirm('Apakah Anda yakin ingin mengonfirmasi barang masuk ini?');"
                                    >

                                        <?php echo csrf_field(); ?>

                                        <button
                                            type="submit"
                                            style="background-color:#16a34a !important;color:#ffffff !important;border:none !important;"
                                            class="inline-flex min-w-[110px] items-center justify-center rounded-lg px-4 py-2 text-sm font-semibold shadow-sm transition hover:opacity-90"
                                        >
                                            Konfirmasi
                                        </button>

                                    </form>

                                </td>

                            </tr>

                        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); if ($__empty_1): ?>

                            <tr>

                                <td
                                    colspan="6"
                                    class="px-6 py-12 text-center"
                                >

                                    <div class="mx-auto flex h-12 w-12 items-center justify-center rounded-full bg-green-100 text-green-600">

                                        <svg
                                            class="h-6 w-6"
                                            fill="none"
                                            stroke="currentColor"
                                            viewBox="0 0 24 24"
                                        >
                                            <path
                                                stroke-linecap="round"
                                                stroke-linejoin="round"
                                                stroke-width="2"
                                                d="M5 13l4 4L19 7"
                                            />
                                        </svg>

                                    </div>

                                    <p class="mt-3 text-sm font-semibold text-slate-700">
                                        Tidak ada barang masuk yang perlu diperiksa.
                                    </p>

                                    <p class="mt-1 text-sm text-slate-500">
                                        Semua barang masuk sudah dikonfirmasi.
                                    </p>

                                </td>

                            </tr>

                        <?php endif; ?>

                    </tbody>

                </table>

            </div>

        </div>


        

        <div class="overflow-hidden rounded-xl border border-slate-200 bg-white shadow-sm">

            <div class="flex flex-col justify-between gap-3 border-b border-slate-200 px-6 py-5 sm:flex-row sm:items-center">

                <div>

                    <h2 class="text-lg font-bold text-slate-900">
                        Barang Keluar yang Perlu Disiapkan
                    </h2>

                    <p class="mt-1 text-sm text-slate-500">
                        Daftar barang keluar yang masih menunggu konfirmasi.
                    </p>

                </div>

                <span
                    class="inline-flex w-fit rounded-full bg-yellow-100 px-4 py-2 text-sm font-semibold text-yellow-700"
                >
                    <?php echo e(($pendingStockOut ?? collect())->count()); ?> Menunggu
                </span>

            </div>


            <div class="overflow-x-auto">

                <table class="w-full text-left text-sm text-slate-600">

                    <thead class="bg-slate-50 text-xs uppercase text-slate-600">

                        <tr>

                            <th class="whitespace-nowrap px-6 py-4">
                                No
                            </th>

                            <th class="whitespace-nowrap px-6 py-4">
                                Tanggal
                            </th>

                            <th class="whitespace-nowrap px-6 py-4">
                                Produk
                            </th>

                            <th class="whitespace-nowrap px-6 py-4 text-center">
                                Jumlah
                            </th>

                            <th class="whitespace-nowrap px-6 py-4">
                                Keterangan
                            </th>

                            <th class="whitespace-nowrap px-6 py-4 text-center">
                                Aksi
                            </th>

                        </tr>

                    </thead>


                    <tbody>

                        <?php $__empty_1 = true; $__currentLoopData = ($pendingStockOut ?? collect()); $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $index => $transaction): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); $__empty_1 = false; ?>

                            <tr class="border-b border-slate-100 bg-white hover:bg-slate-50">

                                
                                <td class="px-6 py-5">
                                    <?php echo e($index + 1); ?>

                                </td>

                                
                                <td class="whitespace-nowrap px-6 py-5">
                                    <?php echo e($transaction->transaction_date?->format('d-m-Y') ?? '-'); ?>

                                </td>

                                
                                <td class="px-6 py-5">

                                    <div class="font-semibold text-slate-900">
                                        <?php echo e($transaction->product?->name ?? '-'); ?>

                                    </div>

                                    <?php if($transaction->product?->code): ?>

                                        <div class="mt-1 text-xs text-slate-500">
                                            <?php echo e($transaction->product->code); ?>

                                        </div>

                                    <?php endif; ?>

                                </td>

                                
                                <td class="px-6 py-5 text-center font-semibold text-slate-900">
                                    <?php echo e(number_format($transaction->quantity, 0, ',', '.')); ?>

                                </td>

                                
                                <td class="px-6 py-5">
                                    <?php echo e($transaction->description ?: '-'); ?>

                                </td>

                                
                                <td class="px-6 py-5 text-center">

                                    <form
                                        action="<?php echo e(route('stock-transactions.confirm', $transaction->id)); ?>"
                                        method="POST"
                                        onsubmit="return confirm('Apakah Anda yakin ingin mengonfirmasi barang keluar ini?');"
                                    >

                                        <?php echo csrf_field(); ?>

                                        <button
                                            type="submit"
                                            style="background-color:#16a34a !important;color:#ffffff !important;border:none !important;"
                                            class="inline-flex min-w-[110px] items-center justify-center rounded-lg px-4 py-2 text-sm font-semibold shadow-sm transition hover:opacity-90"
                                        >
                                            Konfirmasi
                                        </button>

                                    </form>

                                </td>

                            </tr>

                        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); if ($__empty_1): ?>

                            <tr>

                                <td
                                    colspan="6"
                                    class="px-6 py-12 text-center"
                                >

                                    <div class="mx-auto flex h-12 w-12 items-center justify-center rounded-full bg-green-100 text-green-600">

                                        <svg
                                            class="h-6 w-6"
                                            fill="none"
                                            stroke="currentColor"
                                            viewBox="0 0 24 24"
                                        >
                                            <path
                                                stroke-linecap="round"
                                                stroke-linejoin="round"
                                                stroke-width="2"
                                                d="M5 13l4 4L19 7"
                                            />
                                        </svg>

                                    </div>

                                    <p class="mt-3 text-sm font-semibold text-slate-700">
                                        Tidak ada barang keluar yang perlu disiapkan.
                                    </p>

                                    <p class="mt-1 text-sm text-slate-500">
                                        Semua barang keluar sudah dikonfirmasi.
                                    </p>

                                </td>

                            </tr>

                        <?php endif; ?>

                    </tbody>

                </table>

            </div>

        </div>

    </div>


<?php else: ?>

    

    <div class="mx-auto w-full max-w-7xl space-y-6 px-4 py-6 sm:px-6 lg:px-8">

        
        <div class="flex flex-col justify-between gap-4 sm:flex-row sm:items-center">

            <div>

                <p class="text-sm text-slate-500">
                    Dashboard / Ringkasan
                </p>

                <h1 class="mt-1 text-2xl font-bold text-slate-900">
                    Dashboard
                </h1>

                <p class="mt-1 text-sm text-slate-500">
                    Selamat datang di sistem manajemen stok Stockify.
                </p>

            </div>

            <?php if(Route::has('stock-management.index')): ?>

                <a
                    href="<?php echo e(route('stock-management.index')); ?>"
                    class="inline-flex items-center justify-center gap-2 rounded-lg bg-blue-600 px-4 py-3 text-sm font-semibold text-white shadow-sm transition hover:bg-blue-700"
                >

                    <svg
                        class="h-5 w-5"
                        fill="none"
                        stroke="currentColor"
                        viewBox="0 0 24 24"
                    >
                        <path
                            stroke-linecap="round"
                            stroke-linejoin="round"
                            stroke-width="2"
                            d="M12 4v16m8-8H4"
                        />
                    </svg>

                    Manajemen Stok

                </a>

            <?php endif; ?>

        </div>


        
        <?php if(($lowStockProducts ?? collect())->count() > 0): ?>

            <div class="rounded-xl border border-red-200 bg-red-50 p-5">

                <div class="flex items-start gap-4">

                    <div class="flex h-11 w-11 shrink-0 items-center justify-center rounded-full bg-red-100 text-red-600">

                        <svg
                            class="h-6 w-6"
                            fill="none"
                            stroke="currentColor"
                            viewBox="0 0 24 24"
                        >
                            <path
                                stroke-linecap="round"
                                stroke-linejoin="round"
                                stroke-width="2"
                                d="M12 9v3m0 4h.01M10.3 3.8L2.7 17a2 2 0 001.7 3h15.2a2 2 0 001.7-3L13.7 3.8a2 2 0 00-3.4 0z"
                            />
                        </svg>

                    </div>

                    <div class="flex-1">

                        <h3 class="text-base font-bold text-red-700">
                            Perhatian! Stok Menipis
                        </h3>

                        <p class="mt-1 text-sm text-red-600">
                            Terdapat
                            <strong><?php echo e($lowStockProducts->count()); ?></strong>
                            produk yang stoknya berada di bawah batas minimum.
                        </p>

                        <?php if(Route::has('stock-management.index')): ?>

                            <a
                                href="<?php echo e(route('stock-management.index')); ?>"
                                class="mt-3 inline-flex rounded-lg bg-red-600 px-4 py-2 text-sm font-semibold text-white transition hover:bg-red-700"
                            >
                                Periksa Stok
                            </a>

                        <?php endif; ?>

                    </div>

                </div>

            </div>

        <?php endif; ?>


        
        <div class="grid grid-cols-1 gap-5 md:grid-cols-2">

            
            <div class="rounded-xl border border-slate-200 bg-white p-6 shadow-sm">

                <div class="flex items-start justify-between">

                    <div>

                        <p class="text-sm font-medium text-slate-500">
                            Total Produk
                        </p>

                        <h2 class="mt-4 text-3xl font-bold text-slate-900">
                            <?php echo e(number_format($totalProducts ?? 0, 0, ',', '.')); ?>

                        </h2>

                        <p class="mt-2 text-sm text-slate-500">
                            Produk yang terdaftar dalam sistem
                        </p>

                    </div>

                    <div class="flex h-14 w-14 items-center justify-center rounded-xl bg-blue-100 text-blue-600">

                        <svg
                            class="h-7 w-7"
                            fill="none"
                            stroke="currentColor"
                            viewBox="0 0 24 24"
                        >
                            <path
                                stroke-linecap="round"
                                stroke-linejoin="round"
                                stroke-width="2"
                                d="M20 7l-8-4-8 4m16 0v10l-8 4m8-14l-8 4m0 0L4 7m8 4v10"
                            />
                        </svg>

                    </div>

                </div>

            </div>


            
            <div class="rounded-xl border border-slate-200 bg-white p-6 shadow-sm">

                <div class="flex items-start justify-between">

                    <div>

                        <p class="text-sm font-medium text-slate-500">
                            Total Stok
                        </p>

                        <h2 class="mt-4 text-3xl font-bold text-slate-900">
                            <?php echo e(number_format($totalStock ?? 0, 0, ',', '.')); ?>

                        </h2>

                        <p class="mt-2 text-sm text-slate-500">
                            Jumlah seluruh stok produk
                        </p>

                    </div>

                    <div class="flex h-14 w-14 items-center justify-center rounded-xl bg-purple-100 text-purple-600">

                        <svg
                            class="h-7 w-7"
                            fill="none"
                            stroke="currentColor"
                            viewBox="0 0 24 24"
                        >
                            <path
                                stroke-linecap="round"
                                stroke-linejoin="round"
                                stroke-width="2"
                                d="M4 7h16M6 7v13h12V7M9 7V4h6v3M8 11h8M8 15h8"
                            />
                        </svg>

                    </div>

                </div>

            </div>


            
            <div class="rounded-xl border border-slate-200 bg-white p-6 shadow-sm">

                <div class="flex items-start justify-between">

                    <div>

                        <p class="text-sm font-medium text-slate-500">
                            Barang Masuk
                        </p>

                        <h2 class="mt-4 text-3xl font-bold text-slate-900">
                            <?php echo e(number_format($totalStockIn ?? 0, 0, ',', '.')); ?>

                        </h2>

                        <p class="mt-2 text-sm text-slate-500">
                            Total kuantitas barang masuk
                        </p>

                    </div>

                    <div class="flex h-14 w-14 items-center justify-center rounded-xl bg-green-100 text-green-600">

                        <svg
                            class="h-7 w-7"
                            fill="none"
                            stroke="currentColor"
                            viewBox="0 0 24 24"
                        >
                            <path
                                stroke-linecap="round"
                                stroke-linejoin="round"
                                stroke-width="2"
                                d="M12 4v16m8-8l-8 8-8-8"
                            />
                        </svg>

                    </div>

                </div>

            </div>


            
            <div class="rounded-xl border border-slate-200 bg-white p-6 shadow-sm">

                <div class="flex items-start justify-between">

                    <div>

                        <p class="text-sm font-medium text-slate-500">
                            Barang Keluar
                        </p>

                        <h2 class="mt-4 text-3xl font-bold text-slate-900">
                            <?php echo e(number_format($totalStockOut ?? 0, 0, ',', '.')); ?>

                        </h2>

                        <p class="mt-2 text-sm text-slate-500">
                            Total kuantitas barang keluar
                        </p>

                    </div>

                    <div class="flex h-14 w-14 items-center justify-center rounded-xl bg-orange-100 text-orange-600">

                        <svg
                            class="h-7 w-7"
                            fill="none"
                            stroke="currentColor"
                            viewBox="0 0 24 24"
                        >
                            <path
                                stroke-linecap="round"
                                stroke-linejoin="round"
                                stroke-width="2"
                                d="M12 20V4m-8 8l8-8 8 8"
                            />
                        </svg>

                    </div>

                </div>

            </div>

        </div>


        
        <div class="grid grid-cols-1 gap-5 md:grid-cols-2">

            
            <div class="rounded-xl border border-slate-200 bg-white p-6 shadow-sm">

                <div class="flex items-start justify-between">

                    <div>

                        <p class="text-sm font-medium text-slate-500">
                            Barang Masuk Hari Ini
                        </p>

                        <h2 class="mt-4 text-3xl font-bold text-slate-900">
                            <?php echo e(number_format($todayStockIn ?? 0, 0, ',', '.')); ?>

                        </h2>

                        <p class="mt-2 text-sm text-slate-500">
                            Total kuantitas barang masuk hari ini
                        </p>

                    </div>

                    <div class="flex h-14 w-14 items-center justify-center rounded-xl bg-green-100 text-green-600">

                        <svg
                            class="h-7 w-7"
                            fill="none"
                            stroke="currentColor"
                            viewBox="0 0 24 24"
                        >
                            <path
                                stroke-linecap="round"
                                stroke-linejoin="round"
                                stroke-width="2"
                                d="M12 4v16m8-8l-8 8-8-8"
                            />
                        </svg>

                    </div>

                </div>

            </div>


            
            <div class="rounded-xl border border-slate-200 bg-white p-6 shadow-sm">

                <div class="flex items-start justify-between">

                    <div>

                        <p class="text-sm font-medium text-slate-500">
                            Barang Keluar Hari Ini
                        </p>

                        <h2 class="mt-4 text-3xl font-bold text-slate-900">
                            <?php echo e(number_format($todayStockOut ?? 0, 0, ',', '.')); ?>

                        </h2>

                        <p class="mt-2 text-sm text-slate-500">
                            Total kuantitas barang keluar hari ini
                        </p>

                    </div>

                    <div class="flex h-14 w-14 items-center justify-center rounded-xl bg-orange-100 text-orange-600">

                        <svg
                            class="h-7 w-7"
                            fill="none"
                            stroke="currentColor"
                            viewBox="0 0 24 24"
                        >
                            <path
                                stroke-linecap="round"
                                stroke-linejoin="round"
                                stroke-width="2"
                                d="M12 20V4m-8 8l8-8 8 8"
                            />
                        </svg>

                    </div>

                </div>

            </div>

        </div>


        
        <div class="grid grid-cols-1 gap-5 md:grid-cols-3">

            
            <div class="rounded-xl border border-slate-200 bg-white p-5 shadow-sm">

                <div class="flex items-center justify-between">

                    <div>

                        <p class="text-sm text-slate-500">
                            Total Kategori
                        </p>

                        <h2 class="mt-3 text-2xl font-bold text-slate-900">
                            <?php echo e(number_format($totalCategories ?? 0, 0, ',', '.')); ?>

                        </h2>

                        <p class="mt-1 text-xs text-slate-500">
                            Kategori produk
                        </p>

                    </div>

                    <span class="text-2xl">
                        📁
                    </span>

                </div>

            </div>


            
            <div class="rounded-xl border border-slate-200 bg-white p-5 shadow-sm">

                <div class="flex items-center justify-between">

                    <div>

                        <p class="text-sm text-slate-500">
                            Total Supplier
                        </p>

                        <h2 class="mt-3 text-2xl font-bold text-slate-900">
                            <?php echo e(number_format($totalSuppliers ?? 0, 0, ',', '.')); ?>

                        </h2>

                        <p class="mt-1 text-xs text-slate-500">
                            Supplier terdaftar
                        </p>

                    </div>

                    <span class="text-2xl">
                        🏢
                    </span>

                </div>

            </div>


            
            <div class="rounded-xl border border-slate-200 bg-white p-5 shadow-sm">

                <div class="flex items-center justify-between">

                    <div>

                        <p class="text-sm text-slate-500">
                            Produk Stok Menipis
                        </p>

                        <h2 class="mt-3 text-2xl font-bold text-red-600">
                            <?php echo e(($lowStockProducts ?? collect())->count()); ?>

                        </h2>

                        <p class="mt-1 text-xs text-slate-500">
                            Perlu segera diperiksa
                        </p>

                    </div>

                    <span class="text-2xl">
                        ⚠️
                    </span>

                </div>

            </div>

        </div>


        
        <div class="rounded-xl border border-slate-200 bg-white p-6 shadow-sm">

            <div class="mb-6">

                <h2 class="text-lg font-bold text-slate-900">
                    Grafik Transaksi Stok
                </h2>

                <p class="mt-1 text-sm text-slate-500">
                    Perbandingan barang masuk dan barang keluar selama enam bulan terakhir.
                </p>

            </div>

            <div class="relative h-80 w-full">
                <canvas id="stockTransactionChart"></canvas>
            </div>

        </div>


        
        <div class="grid grid-cols-1 gap-6 xl:grid-cols-2">

            
            <div class="rounded-xl border border-slate-200 bg-white p-6 shadow-sm">

                <div class="border-b border-slate-200 pb-4">

                    <h2 class="text-lg font-bold text-slate-900">
                        Aktivitas Terbaru
                    </h2>

                    <p class="mt-1 text-sm text-slate-500">
                        Riwayat aktivitas pengguna terbaru.
                    </p>

                </div>

                <div class="divide-y divide-slate-100">

                    <?php $__empty_1 = true; $__currentLoopData = ($recentActivities ?? collect()); $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $activity): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); $__empty_1 = false; ?>

                        <div class="flex items-start gap-3 py-4">

                            <div class="flex h-10 w-10 shrink-0 items-center justify-center rounded-full bg-blue-50 text-blue-600">

                                <svg
                                    class="h-5 w-5"
                                    fill="none"
                                    stroke="currentColor"
                                    viewBox="0 0 24 24"
                                >
                                    <path
                                        stroke-linecap="round"
                                        stroke-linejoin="round"
                                        stroke-width="2"
                                        d="M12 8v4l3 2m6-2a9 9 0 11-18 0 9 9 0 0118 0z"
                                    />
                                </svg>

                            </div>

                            <div class="min-w-0 flex-1">

                                <p class="text-sm font-medium text-slate-800">
                                    <?php echo e($activity->activity ?? 'Aktivitas sistem'); ?>

                                </p>

                                <p class="mt-1 text-xs text-slate-500">
                                    <?php echo e($activity->user->name ?? 'Sistem'); ?>

                                    ·
                                    <?php echo e($activity->created_at?->format('d/m/Y H:i')); ?>

                                </p>

                            </div>

                        </div>

                    <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); if ($__empty_1): ?>

                        <p class="py-8 text-center text-sm text-slate-500">
                            Belum ada aktivitas terbaru.
                        </p>

                    <?php endif; ?>

                </div>

            </div>


            
            <div class="rounded-xl border border-slate-200 bg-white p-6 shadow-sm">

                <div class="border-b border-slate-200 pb-4">

                    <h2 class="text-lg font-bold text-slate-900">
                        Transaksi Terbaru
                    </h2>

                    <p class="mt-1 text-sm text-slate-500">
                        Lima transaksi stok terakhir.
                    </p>

                </div>

                <div class="divide-y divide-slate-100">

                    <?php $__empty_1 = true; $__currentLoopData = ($recentTransactions ?? collect()); $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $transaction): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); $__empty_1 = false; ?>

                        <div class="flex items-center justify-between gap-3 py-4">

                            <div class="min-w-0">

                                <p class="truncate text-sm font-semibold text-slate-800">
                                    <?php echo e($transaction->product->name ?? 'Produk tidak tersedia'); ?>

                                </p>

                                <p class="mt-1 text-xs text-slate-500">
                                    <?php echo e($transaction->transaction_date
                                        ? \Carbon\Carbon::parse($transaction->transaction_date)->format('d/m/Y')
                                        : '-'); ?>

                                </p>

                            </div>

                            <div class="text-right">

                                <span
                                    class="inline-flex rounded-full px-3 py-1 text-xs font-semibold
                                    <?php echo e($transaction->type === 'in'
                                        ? 'bg-green-100 text-green-700'
                                        : 'bg-red-100 text-red-700'); ?>"
                                >

                                    <?php echo e($transaction->type === 'in' ? '+' : '-'); ?>

                                    <?php echo e(number_format($transaction->quantity ?? 0, 0, ',', '.')); ?>


                                </span>

                                <p class="mt-1 text-xs text-slate-500">
                                    <?php echo e($transaction->type === 'in' ? 'Barang Masuk' : 'Barang Keluar'); ?>

                                </p>

                            </div>

                        </div>

                    <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); if ($__empty_1): ?>

                        <p class="py-8 text-center text-sm text-slate-500">
                            Belum ada transaksi terbaru.
                        </p>

                    <?php endif; ?>

                </div>

            </div>

        </div>

    </div>


<?php endif; ?>

<?php $__env->stopSection(); ?>



<?php $__env->startPush('scripts'); ?>

<script src="https://cdn.jsdelivr.net/npm/chart.js"></script>

<script>
    document.addEventListener('DOMContentLoaded', function () {

        const chartElement = document.getElementById('stockTransactionChart');

        if (!chartElement) {
            return;
        }

        new Chart(chartElement, {

            type: 'line',

            data: {

                labels: <?php echo json_encode($monthlyLabels ?? [], 15, 512) ?>,

                datasets: [

                    {
                        label: 'Barang Masuk',
                        data: <?php echo json_encode($monthlyStockIn ?? [], 15, 512) ?>,
                        borderColor: '#3B82F6',
                        backgroundColor: 'rgba(59, 130, 246, 0.12)',
                        borderWidth: 2,
                        tension: 0.4,
                        fill: true,
                        pointRadius: 4,
                        pointHoverRadius: 6
                    },

                    {
                        label: 'Barang Keluar',
                        data: <?php echo json_encode($monthlyStockOut ?? [], 15, 512) ?>,
                        borderColor: '#EF4444',
                        backgroundColor: 'rgba(239, 68, 68, 0.12)',
                        borderWidth: 2,
                        tension: 0.4,
                        fill: true,
                        pointRadius: 4,
                        pointHoverRadius: 6
                    }

                ]

            },

            options: {

                responsive: true,

                maintainAspectRatio: false,

                interaction: {
                    intersect: false,
                    mode: 'index'
                },

                plugins: {

                    legend: {
                        position: 'top'
                    }

                },

                scales: {

                    y: {

                        beginAtZero: true,

                        ticks: {
                            precision: 0
                        }

                    }

                }

            }

        });

    });
</script>

<?php $__env->stopPush(); ?>
<?php echo $__env->make('layouts.app', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH C:\xampp\htdocs\stockify\resources\views/dashboard.blade.php ENDPATH**/ ?>