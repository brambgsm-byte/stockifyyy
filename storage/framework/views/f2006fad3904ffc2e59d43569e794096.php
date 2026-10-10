

<?php $__env->startSection('title', 'Tambah Stock Opname'); ?>

<?php $__env->startSection('content'); ?>
<div class="p-6">

    <div class="mb-6">
        <h1 class="text-2xl font-bold text-gray-800">
            Tambah Stock Opname
        </h1>

        <p class="text-sm text-gray-500 mt-1">
            Catat hasil pemeriksaan stok barang.
        </p>
    </div>

    <div class="bg-white rounded-lg shadow p-6 max-w-3xl">

        <form action="<?php echo e(route('stock-opnames.store')); ?>" method="POST">
            <?php echo csrf_field(); ?>

            <div class="mb-5">
                <label for="product_id"
                       class="block mb-2 text-sm font-medium text-gray-700">
                    Produk
                </label>

                <select name="product_id"
                        id="product_id"
                        required
                        class="w-full rounded-lg border-gray-300 focus:border-blue-500 focus:ring-blue-500">

                    <option value="">-- Pilih Produk --</option>

                    <?php $__currentLoopData = $products; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $product): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                        <option value="<?php echo e($product->id); ?>"
                            <?php echo e(old('product_id') == $product->id ? 'selected' : ''); ?>>
                            <?php echo e($product->name); ?> - Stok Saat Ini: <?php echo e($product->stock); ?>

                        </option>
                    <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                </select>

                <?php $__errorArgs = ['product_id'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?>
                    <p class="mt-1 text-sm text-red-600">
                        <?php echo e($message); ?>

                    </p>
                <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>
            </div>

            <div class="mb-5">
                <label for="opname_date"
                       class="block mb-2 text-sm font-medium text-gray-700">
                    Tanggal Stock Opname
                </label>

                <input type="date"
                       name="opname_date"
                       id="opname_date"
                       value="<?php echo e(old('opname_date', date('Y-m-d'))); ?>"
                       required
                       class="w-full rounded-lg border-gray-300 focus:border-blue-500 focus:ring-blue-500">

                <?php $__errorArgs = ['opname_date'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?>
                    <p class="mt-1 text-sm text-red-600">
                        <?php echo e($message); ?>

                    </p>
                <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>
            </div>

            <div class="mb-5">
                <label for="actual_stock"
                       class="block mb-2 text-sm font-medium text-gray-700">
                    Jumlah Stok Aktual
                </label>

                <input type="number"
                       name="actual_stock"
                       id="actual_stock"
                       min="0"
                       value="<?php echo e(old('actual_stock')); ?>"
                       required
                       placeholder="Masukkan jumlah stok aktual"
                       class="w-full rounded-lg border-gray-300 focus:border-blue-500 focus:ring-blue-500">

                <p class="mt-1 text-xs text-gray-500">
                    Masukkan jumlah barang yang benar-benar tersedia secara fisik.
                </p>

                <?php $__errorArgs = ['actual_stock'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?>
                    <p class="mt-1 text-sm text-red-600">
                        <?php echo e($message); ?>

                    </p>
                <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>
            </div>

            <div class="mb-6">
                <label for="notes"
                       class="block mb-2 text-sm font-medium text-gray-700">
                    Keterangan
                </label>

                <textarea name="notes"
                          id="notes"
                          rows="4"
                          placeholder="Tambahkan keterangan jika diperlukan..."
                          class="w-full rounded-lg border-gray-300 focus:border-blue-500 focus:ring-blue-500"><?php echo e(old('notes')); ?></textarea>

                <?php $__errorArgs = ['notes'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?>
                    <p class="mt-1 text-sm text-red-600">
                        <?php echo e($message); ?>

                    </p>
                <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>
            </div>

            <div class="flex items-center gap-3">
                <button type="submit"
                        class="rounded-lg bg-blue-600 px-5 py-2.5 text-sm font-medium text-white hover:bg-blue-700">
                    Simpan
                </button>

                <a href="<?php echo e(route('stock-opnames.index')); ?>"
                   class="rounded-lg bg-gray-500 px-5 py-2.5 text-sm font-medium text-white hover:bg-gray-600">
                    Batal
                </a>
            </div>

        </form>

    </div>
</div>
<?php $__env->stopSection(); ?>
<?php echo $__env->make('layouts.app', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH C:\xampp\htdocs\stockify\resources\views/stock-opnames/create.blade.php ENDPATH**/ ?>