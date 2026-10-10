

<?php $__env->startSection('title', 'Edit Stock Opname'); ?>

<?php $__env->startSection('content'); ?>
<div class="min-h-screen bg-gray-50 px-6 py-10">

    
    <div class="mx-auto max-w-3xl">

        
        <div class="mb-6 text-center">
            <h1 class="text-3xl font-bold text-gray-800">
                Edit Stock Opname
            </h1>

            <p class="mt-2 text-sm text-gray-500">
                Perbarui data pemeriksaan stok barang.
            </p>
        </div>

        
        <div class="rounded-xl bg-white p-8 shadow-md">

            <form action="<?php echo e(route('stock-opnames.update', $opname->id)); ?>"
                  method="POST">

                <?php echo csrf_field(); ?>
                <?php echo method_field('PUT'); ?>

                
                <?php if($errors->any()): ?>
                    <div class="mb-6 rounded-lg bg-red-100 p-4 text-sm text-red-700">
                        <ul class="list-disc space-y-1 pl-5">
                            <?php $__currentLoopData = $errors->all(); $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $error): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                <li><?php echo e($error); ?></li>
                            <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                        </ul>
                    </div>
                <?php endif; ?>

                
                <div class="mb-6">
                    <label for="product_name"
                           class="mb-2 block text-sm font-semibold text-gray-700">
                        Produk
                    </label>

                    <input type="text"
                           id="product_name"
                           value="<?php echo e($opname->product->name ?? '-'); ?>"
                           disabled
                           class="w-full rounded-lg border border-gray-300 bg-gray-100 px-4 py-3 text-gray-600 outline-none">

                    <p class="mt-2 text-xs text-gray-500">
                        Produk tidak dapat diubah saat mengedit stock opname.
                    </p>
                </div>

                
                <div class="mb-6">
                    <label for="opname_date"
                           class="mb-2 block text-sm font-semibold text-gray-700">
                        Tanggal Stock Opname
                    </label>

                    <input type="date"
                           name="opname_date"
                           id="opname_date"
                           value="<?php echo e(old('opname_date', $opname->opname_date?->format('Y-m-d'))); ?>"
                           required
                           class="w-full rounded-lg border border-gray-300 px-4 py-3 text-gray-700 outline-none focus:border-blue-500 focus:ring-2 focus:ring-blue-200">

                    <?php $__errorArgs = ['opname_date'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?>
                        <p class="mt-2 text-sm text-red-600">
                            <?php echo e($message); ?>

                        </p>
                    <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>
                </div>

                
                <div class="mb-6">
                    <label for="system_stock"
                           class="mb-2 block text-sm font-semibold text-gray-700">
                        Stok Sistem
                    </label>

                    <input type="number"
                           id="system_stock"
                           value="<?php echo e($opname->system_stock); ?>"
                           disabled
                           class="w-full rounded-lg border border-gray-300 bg-gray-100 px-4 py-3 text-gray-600 outline-none">

                    <p class="mt-2 text-xs text-gray-500">
                        Stok sistem saat stock opname dibuat.
                    </p>
                </div>

                
                <div class="mb-6">
                    <label for="actual_stock"
                           class="mb-2 block text-sm font-semibold text-gray-700">
                        Jumlah Stok Aktual
                    </label>

                    <input type="number"
                           name="actual_stock"
                           id="actual_stock"
                           min="0"
                           value="<?php echo e(old('actual_stock', $opname->actual_stock)); ?>"
                           required
                           class="w-full rounded-lg border border-gray-300 px-4 py-3 text-gray-700 outline-none focus:border-blue-500 focus:ring-2 focus:ring-blue-200">

                    <p class="mt-2 text-xs text-gray-500">
                        Masukkan jumlah stok fisik yang sebenarnya.
                    </p>

                    <?php $__errorArgs = ['actual_stock'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?>
                        <p class="mt-2 text-sm text-red-600">
                            <?php echo e($message); ?>

                        </p>
                    <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>
                </div>

                
                <div class="mb-8">
                    <label for="notes"
                           class="mb-2 block text-sm font-semibold text-gray-700">
                        Keterangan
                    </label>

                    <textarea name="notes"
                              id="notes"
                              rows="5"
                              placeholder="Tambahkan keterangan jika diperlukan..."
                              class="w-full rounded-lg border border-gray-300 px-4 py-3 text-gray-700 outline-none focus:border-blue-500 focus:ring-2 focus:ring-blue-200"><?php echo e(old('notes', $opname->notes)); ?></textarea>

                    <?php $__errorArgs = ['notes'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?>
                        <p class="mt-2 text-sm text-red-600">
                            <?php echo e($message); ?>

                        </p>
                    <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>
                </div>

                
                <div class="flex justify-center gap-4">

                    <button type="submit"
                            style="
                                background-color: #2563eb;
                                color: white;
                                padding: 12px 24px;
                                border: none;
                                border-radius: 8px;
                                font-size: 14px;
                                font-weight: 600;
                                cursor: pointer;
                            ">
                        Simpan Perubahan
                    </button>

                    <a href="<?php echo e(route('stock-opnames.index')); ?>"
                       style="
                            background-color: #6b7280;
                            color: white;
                            padding: 12px 24px;
                            border-radius: 8px;
                            font-size: 14px;
                            font-weight: 600;
                            text-decoration: none;
                            display: inline-block;
                       ">
                        Batal
                    </a>

                </div>

            </form>

        </div>
    </div>

</div>
<?php $__env->stopSection(); ?>
<?php echo $__env->make('layouts.app', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH C:\xampp\htdocs\stockify\resources\views/stock-opnames/edit.blade.php ENDPATH**/ ?>