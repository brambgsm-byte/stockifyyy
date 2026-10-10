

<?php $__env->startSection('title', 'Transaksi Stok - Stockify'); ?>

<?php $__env->startSection('page-title', 'Transaksi Stok'); ?>

<?php $__env->startSection('content'); ?>
    <div class="min-h-screen bg-gray-50">

        
        <div class="border-b border-gray-200 bg-white px-8 py-6">
            <div class="flex items-center justify-between">
                <div>
                    <h1 class="text-2xl font-semibold text-gray-900">
                        Transaksi Stok
                    </h1>

                    <p class="mt-1 text-sm text-gray-500">
                        Kelola dan pantau transaksi barang masuk dan barang keluar.
                    </p>
                </div>

                
                <a
                    href="<?php echo e(route('stock-transactions.create')); ?>"
                    class="inline-flex items-center rounded-lg bg-blue-600 px-5 py-3 text-sm font-semibold text-white transition hover:bg-blue-700"
                >
                    + Tambah Transaksi
                </a>
            </div>
        </div>

        
        <div class="px-8 py-8">

            
            <?php if($errors->any()): ?>
                <div class="mb-6 rounded-lg border border-red-200 bg-red-50 px-5 py-4 text-sm text-red-700">
                    <div class="mb-2 font-semibold">
                        Terdapat kesalahan:
                    </div>

                    <ul class="list-disc space-y-1 pl-5">
                        <?php $__currentLoopData = $errors->all(); $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $error): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                            <li><?php echo e($error); ?></li>
                        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                    </ul>
                </div>
            <?php endif; ?>

            
            <div class="overflow-hidden rounded-xl border border-gray-200 bg-white shadow-sm">

                
                <div class="border-b border-gray-200 px-7 py-6">
                    <h2 class="text-xl font-semibold text-gray-900">
                        Riwayat Transaksi
                    </h2>

                    <p class="mt-1 text-sm text-gray-500">
                        Daftar seluruh transaksi stok yang tercatat dalam sistem.
                    </p>
                </div>

                
                <div class="overflow-x-auto">
                    <table class="w-full text-left text-sm text-gray-600">

                        <thead class="bg-gray-100 text-xs uppercase text-gray-700">
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

                                <th class="whitespace-nowrap px-6 py-4">
                                    Jenis Transaksi
                                </th>

                                <th class="whitespace-nowrap px-6 py-4 text-center">
                                    Jumlah
                                </th>

                                <th class="whitespace-nowrap px-6 py-4">
                                    Keterangan
                                </th>

                                <th class="whitespace-nowrap px-6 py-4">
                                    User
                                </th>

                                <th class="whitespace-nowrap px-6 py-4 text-center">
                                    Status
                                </th>

                                <th class="whitespace-nowrap px-6 py-4 text-center">
                                    Aksi
                                </th>
                            </tr>
                        </thead>

                        <tbody>

                            <?php $__empty_1 = true; $__currentLoopData = $transactions; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $index => $transaction): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); $__empty_1 = false; ?>

                                <tr class="border-b border-gray-200 bg-white transition hover:bg-gray-50">

                                    
                                    <td class="px-6 py-5">
                                        <?php echo e($index + 1); ?>

                                    </td>

                                    
                                    <td class="whitespace-nowrap px-6 py-5">
                                        <?php echo e($transaction->transaction_date?->format('d-m-Y') ?? '-'); ?>

                                    </td>

                                    
                                    <td class="px-6 py-5">
                                        <div class="font-medium text-gray-900">
                                            <?php echo e($transaction->product?->name ?? '-'); ?>

                                        </div>

                                        <?php if($transaction->product?->code): ?>
                                            <div class="mt-1 text-xs text-gray-500">
                                                <?php echo e($transaction->product->code); ?>

                                            </div>
                                        <?php endif; ?>
                                    </td>

                                    
                                    <td class="px-6 py-5">

                                        <?php if($transaction->type === 'in'): ?>

                                            <span
                                                class="inline-flex whitespace-nowrap rounded-full bg-green-100 px-3 py-1 text-xs font-semibold text-green-700"
                                            >
                                                Barang Masuk
                                            </span>

                                        <?php else: ?>

                                            <span
                                                class="inline-flex whitespace-nowrap rounded-full bg-red-100 px-3 py-1 text-xs font-semibold text-red-700"
                                            >
                                                Barang Keluar
                                            </span>

                                        <?php endif; ?>

                                    </td>

                                    
                                    <td class="px-6 py-5 text-center font-semibold text-gray-900">
                                        <?php echo e(number_format($transaction->quantity, 0, ',', '.')); ?>

                                    </td>

                                    
                                    <td class="px-6 py-5">
                                        <?php echo e($transaction->description ?: '-'); ?>

                                    </td>

                                    
                                    <td class="px-6 py-5">
                                        <?php echo e($transaction->user?->name ?? '-'); ?>

                                    </td>

                                    
                                    <td class="px-6 py-5 text-center">

                                        <?php if($transaction->status === 'confirmed'): ?>

                                            <span
                                                class="inline-flex whitespace-nowrap rounded-full bg-green-100 px-3 py-1 text-xs font-semibold text-green-700"
                                            >
                                                Terkonfirmasi
                                            </span>

                                        <?php else: ?>

                                            <span
                                                class="inline-flex whitespace-nowrap rounded-full bg-yellow-100 px-3 py-1 text-xs font-semibold text-yellow-700"
                                            >
                                                Menunggu Konfirmasi
                                            </span>

                                        <?php endif; ?>

                                    </td>

                                    
                                    <td class="px-6 py-5">

                                        <div class="flex min-w-max items-center justify-center gap-2">

                                            
                                            
                                            

                                            <?php if(
                                                auth()->user()->role === 'staff' &&
                                                $transaction->status === 'pending'
                                            ): ?>

                                                <form
                                                    action="<?php echo e(route('stock-transactions.confirm', $transaction->id)); ?>"
                                                    method="POST"
                                                    onsubmit="return confirm('Apakah Anda yakin ingin mengonfirmasi transaksi ini?');"
                                                >

                                                    <?php echo csrf_field(); ?>

                                                    <button
                                                        type="submit"
                                                        style="background-color: #16a34a !important; color: #ffffff !important; border: none !important; opacity: 1 !important;"
                                                        class="inline-flex min-w-[120px] items-center justify-center rounded-lg px-4 py-2 text-sm font-semibold shadow-sm transition hover:opacity-90"
                                                    >
                                                        <span style="color: #ffffff !important;">
                                                            Konfirmasi
                                                        </span>
                                                    </button>

                                                </form>

                                            <?php endif; ?>


                                            
                                            
                                            

                                            <?php if(auth()->user()->role === 'admin'): ?>

                                                <form
                                                    action="<?php echo e(route('stock-transactions.destroy', $transaction->id)); ?>"
                                                    method="POST"
                                                    onsubmit="return confirm('Apakah Anda yakin ingin menghapus transaksi ini? Stok produk juga akan disesuaikan kembali.');"
                                                >

                                                    <?php echo csrf_field(); ?>

                                                    <?php echo method_field('DELETE'); ?>

                                                    <button
                                                        type="submit"
                                                        style="background-color: #dc2626 !important; color: #ffffff !important; border: none !important; opacity: 1 !important;"
                                                        class="inline-flex min-w-[80px] items-center justify-center rounded-lg px-4 py-2 text-sm font-semibold shadow-sm transition hover:opacity-90"
                                                    >
                                                        <span style="color: #ffffff !important;">
                                                            Hapus
                                                        </span>
                                                    </button>

                                                </form>

                                            <?php endif; ?>


                                            
                                            
                                            

                                            <?php if(
                                                auth()->user()->role === 'manager' ||
                                                (
                                                    auth()->user()->role === 'staff' &&
                                                    $transaction->status === 'confirmed'
                                                )
                                            ): ?>

                                                <span class="text-sm text-gray-400">
                                                    -
                                                </span>

                                            <?php endif; ?>

                                        </div>

                                    </td>

                                </tr>

                            <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); if ($__empty_1): ?>

                                <tr>

                                    <td
                                        colspan="9"
                                        class="px-6 py-16 text-center"
                                    >

                                        <p class="text-base font-medium text-gray-400">
                                            Belum ada transaksi stok.
                                        </p>

                                        <p class="mt-2 text-sm text-gray-400">
                                            Silakan tambahkan transaksi barang masuk atau barang keluar.
                                        </p>

                                    </td>

                                </tr>

                            <?php endif; ?>

                        </tbody>

                    </table>
                </div>

            </div>

        </div>

    </div>
<?php $__env->stopSection(); ?>
<?php echo $__env->make('layouts.app', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH C:\xampp\htdocs\stockify\resources\views/stock-transactions/index.blade.php ENDPATH**/ ?>