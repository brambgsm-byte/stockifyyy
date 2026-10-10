

<?php $__env->startSection('title', 'Stock Opname'); ?>
<?php $__env->startSection('page-title', 'Stock Opname'); ?>

<?php $__env->startSection('content'); ?>

<div class="mx-auto max-w-[1400px]">

    
    <div class="mb-7 flex items-center justify-between">
        <div>
            <h2 class="text-2xl font-bold text-slate-900">
                Stock Opname
            </h2>

            <p class="mt-1 text-sm text-slate-500">
                Kelola dan pantau hasil pemeriksaan stok barang.
            </p>
        </div>

        <a
            href="<?php echo e(route('stock-opnames.create')); ?>"
            class="inline-flex items-center rounded-xl bg-blue-600 px-5 py-3 text-sm font-semibold text-white transition hover:bg-blue-700"
        >
            + Tambah Stock Opname
        </a>
    </div>

    
    <div class="overflow-hidden rounded-xl border border-slate-200 bg-white shadow-sm">

        <div class="overflow-x-auto">
            <table class="w-full text-left">

                
                <thead class="bg-slate-100">
                    <tr>
                        <th class="px-5 py-4 text-xs font-bold uppercase text-slate-700">
                            No
                        </th>

                        <th class="px-5 py-4 text-xs font-bold uppercase text-slate-700">
                            Produk
                        </th>

                        <th class="px-5 py-4 text-xs font-bold uppercase text-slate-700">
                            Tanggal
                        </th>

                        <th class="px-5 py-4 text-xs font-bold uppercase text-slate-700">
                            Stok Sistem
                        </th>

                        <th class="px-5 py-4 text-xs font-bold uppercase text-slate-700">
                            Stok Aktual
                        </th>

                        <th class="px-5 py-4 text-xs font-bold uppercase text-slate-700">
                            Selisih
                        </th>

                        <th class="px-5 py-4 text-xs font-bold uppercase text-slate-700">
                            Petugas
                        </th>

                        <th class="px-5 py-4 text-xs font-bold uppercase text-slate-700">
                            Keterangan
                        </th>

                        <th class="px-5 py-4 text-center text-xs font-bold uppercase text-slate-700">
                            Aksi
                        </th>
                    </tr>
                </thead>

                
                <tbody class="divide-y divide-slate-100">

                    <?php $__empty_1 = true; $__currentLoopData = $opnames; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $index => $opname): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); $__empty_1 = false; ?>

                        <tr class="transition hover:bg-slate-50">

                            
                            <td class="px-5 py-4 text-sm text-slate-700">
                                <?php echo e($index + 1); ?>

                            </td>

                            
                            <td class="px-5 py-4">
                                <div class="font-semibold text-slate-900">
                                    <?php echo e($opname->product->name ?? '-'); ?>

                                </div>

                                <?php if($opname->product?->sku): ?>
                                    <div class="mt-1 text-xs text-slate-500">
                                        SKU: <?php echo e($opname->product->sku); ?>

                                    </div>
                                <?php endif; ?>
                            </td>

                            
                            <td class="px-5 py-4 text-sm text-slate-600">
                                <?php echo e($opname->opname_date?->format('d-m-Y') ?? '-'); ?>

                            </td>

                            
                            <td class="px-5 py-4 text-sm text-slate-600">
                                <?php echo e(number_format($opname->system_stock, 0, ',', '.')); ?>

                            </td>

                            
                            <td class="px-5 py-4 text-sm font-semibold text-slate-900">
                                <?php echo e(number_format($opname->actual_stock, 0, ',', '.')); ?>

                            </td>

                            
                            <td class="px-5 py-4">

                                <?php if($opname->difference > 0): ?>

                                    <span class="font-semibold text-green-600">
                                        +<?php echo e(number_format($opname->difference, 0, ',', '.')); ?>

                                    </span>

                                <?php elseif($opname->difference < 0): ?>

                                    <span class="font-semibold text-red-600">
                                        <?php echo e(number_format($opname->difference, 0, ',', '.')); ?>

                                    </span>

                                <?php else: ?>

                                    <span class="font-semibold text-slate-600">
                                        0
                                    </span>

                                <?php endif; ?>

                            </td>

                            
                            <td class="px-5 py-4 text-sm text-slate-600">
                                <?php echo e($opname->user->name ?? '-'); ?>

                            </td>

                            
                            <td class="max-w-[180px] px-5 py-4 text-sm text-slate-600">
                                <div class="truncate">
                                    <?php echo e($opname->notes ?: '-'); ?>

                                </div>
                            </td>

                            
                            <td class="px-5 py-4">

                                <div class="flex items-center justify-center gap-2">

                                    
                                    <a
                                        href="<?php echo e(route('stock-opnames.show', $opname->id)); ?>"
                                        style="background-color: #2563eb; color: #ffffff;"
                                        class="inline-flex items-center justify-center rounded-lg px-4 py-2 text-xs font-semibold transition hover:opacity-90"
                                    >
                                        Detail
                                    </a>


                                    
                                    <?php if(auth()->user()->role === 'admin'): ?>

                                        
                                        <a
                                            href="<?php echo e(route('stock-opnames.edit', $opname->id)); ?>"
                                            style="background-color: #f59e0b; color: #ffffff;"
                                            class="inline-flex items-center justify-center rounded-lg px-4 py-2 text-xs font-semibold transition hover:opacity-90"
                                        >
                                            ✎ Edit
                                        </a>


                                        
                                        <form
                                            action="<?php echo e(route('stock-opnames.destroy', $opname->id)); ?>"
                                            method="POST"
                                            onsubmit="return confirm('Apakah Anda yakin ingin menghapus data stock opname ini?')"
                                        >
                                            <?php echo csrf_field(); ?>

                                            <?php echo method_field('DELETE'); ?>

                                            <button
                                                type="submit"
                                                style="background-color: #ef4444; color: #ffffff;"
                                                class="inline-flex items-center justify-center rounded-lg px-4 py-2 text-xs font-semibold transition hover:opacity-90"
                                            >
                                                🗑 Hapus
                                            </button>
                                        </form>

                                    <?php endif; ?>

                                </div>

                            </td>

                        </tr>

                    <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); if ($__empty_1): ?>

                        <tr>
                            <td
                                colspan="9"
                                class="px-5 py-12 text-center"
                            >
                                <div class="text-sm font-medium text-slate-500">
                                    Belum ada data stock opname.
                                </div>

                                <a
                                    href="<?php echo e(route('stock-opnames.create')); ?>"
                                    class="mt-3 inline-block text-sm font-semibold text-blue-600 hover:text-blue-700"
                                >
                                    + Tambah Stock Opname
                                </a>
                            </td>
                        </tr>

                    <?php endif; ?>

                </tbody>

            </table>
        </div>

    </div>

</div>

<?php $__env->stopSection(); ?>
<?php echo $__env->make('layouts.app', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH C:\xampp\htdocs\stockify\resources\views/stock-opnames/index.blade.php ENDPATH**/ ?>