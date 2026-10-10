

<?php $__env->startSection('title', 'Tambah Transaksi - Stockify'); ?>

<?php $__env->startSection('page-title', 'Tambah Transaksi Stok'); ?>

<?php $__env->startSection('content'); ?>
    <div class="min-h-screen bg-gray-50">

        
        <div class="border-b border-gray-200 bg-white px-8 py-6">
            <div class="flex items-center justify-between">
                <div>
                    <h1 class="text-2xl font-semibold text-gray-900">
                        Tambah Transaksi Stok
                    </h1>

                    <p class="mt-1 text-sm text-gray-500">
                        Catat transaksi barang masuk atau barang keluar.
                    </p>
                </div>

                <a href="<?php echo e(route('stock-transactions.index')); ?>"
                   class="rounded-lg bg-gray-200 px-5 py-3 text-sm font-medium text-gray-700 transition hover:bg-gray-300">
                    Kembali
                </a>
            </div>
        </div>

        
        <div class="px-8 py-8">

            
            <?php if($errors->any()): ?>
                <div class="mx-auto mb-6 max-w-4xl rounded-lg border border-red-200 bg-red-50 p-4">
                    <div class="mb-2 font-semibold text-red-700">
                        Terdapat kesalahan:
                    </div>

                    <ul class="list-disc space-y-1 pl-5 text-sm text-red-600">
                        <?php $__currentLoopData = $errors->all(); $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $error): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                            <li><?php echo e($error); ?></li>
                        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                    </ul>
                </div>
            <?php endif; ?>

            
            <div class="mx-auto max-w-4xl rounded-xl bg-white p-8 shadow-sm">

                <div class="mb-8">
                    <h2 class="text-xl font-semibold text-gray-900">
                        Form Transaksi
                    </h2>

                    <p class="mt-1 text-sm text-gray-500">
                        Isi data transaksi dengan lengkap dan benar.
                    </p>
                </div>

                <form action="<?php echo e(route('stock-transactions.store')); ?>"
                      method="POST">
                    <?php echo csrf_field(); ?>

                    
                    <div class="mb-6">
                        <label for="product_id"
                               class="mb-2 block text-sm font-medium text-gray-900">
                            Produk <span class="text-red-500">*</span>
                        </label>

                        <select id="product_id"
                                name="product_id"
                                required
                                class="block w-full rounded-lg border border-gray-300 bg-gray-50 p-3 text-sm text-gray-900 focus:border-blue-500 focus:ring-blue-500">

                            <option value="">
                                -- Pilih Produk --
                            </option>

                            <?php $__currentLoopData = $products; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $product): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                <option value="<?php echo e($product->id); ?>"
                                    <?php echo e(old('product_id') == $product->id ? 'selected' : ''); ?>>
                                    <?php echo e($product->name); ?>

                                    (<?php echo e($product->code); ?>)
                                    - Stok: <?php echo e($product->stock); ?>

                                </option>
                            <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                        </select>
                    </div>

                    
                    <div class="mb-6">
                        <label for="type"
                               class="mb-2 block text-sm font-medium text-gray-900">
                            Jenis Transaksi <span class="text-red-500">*</span>
                        </label>

                        <select id="type"
                                name="type"
                                required
                                class="block w-full rounded-lg border border-gray-300 bg-gray-50 p-3 text-sm text-gray-900 focus:border-blue-500 focus:ring-blue-500">

                            <option value="">
                                -- Pilih Jenis Transaksi --
                            </option>

                            <option value="in"
                                <?php echo e(old('type') === 'in' ? 'selected' : ''); ?>>
                                Barang Masuk
                            </option>

                            <option value="out"
                                <?php echo e(old('type') === 'out' ? 'selected' : ''); ?>>
                                Barang Keluar
                            </option>
                        </select>
                    </div>

                    
                    <div class="mb-6">
                        <label for="quantity"
                               class="mb-2 block text-sm font-medium text-gray-900">
                            Jumlah Barang <span class="text-red-500">*</span>
                        </label>

                        <input type="number"
                               id="quantity"
                               name="quantity"
                               value="<?php echo e(old('quantity')); ?>"
                               min="1"
                               required
                               placeholder="Contoh: 10"
                               class="block w-full rounded-lg border border-gray-300 bg-gray-50 p-3 text-sm text-gray-900 focus:border-blue-500 focus:ring-blue-500">
                    </div>

                    
                    <div class="mb-6">
                        <label for="transaction_date"
                               class="mb-2 block text-sm font-medium text-gray-900">
                            Tanggal Transaksi <span class="text-red-500">*</span>
                        </label>

                        <input type="date"
                               id="transaction_date"
                               name="transaction_date"
                               value="<?php echo e(old('transaction_date', date('Y-m-d'))); ?>"
                               required
                               class="block w-full rounded-lg border border-gray-300 bg-gray-50 p-3 text-sm text-gray-900 focus:border-blue-500 focus:ring-blue-500">
                    </div>

                    
                    <div class="mb-8">
                        <label for="description"
                               class="mb-2 block text-sm font-medium text-gray-900">
                            Keterangan
                        </label>

                        <textarea id="description"
                                  name="description"
                                  rows="4"
                                  placeholder="Contoh: Pembelian barang dari supplier..."
                                  class="block w-full rounded-lg border border-gray-300 bg-gray-50 p-3 text-sm text-gray-900 focus:border-blue-500 focus:ring-blue-500"><?php echo e(old('description')); ?></textarea>
                    </div>

                    
                    <div class="flex items-center justify-end gap-3 border-t border-gray-200 pt-6">

                        <a href="<?php echo e(route('stock-transactions.index')); ?>"
                           class="rounded-lg bg-gray-200 px-6 py-3 text-sm font-medium text-gray-700 transition hover:bg-gray-300">
                            Batal
                        </a>

                        <button type="submit"
                                class="rounded-lg bg-blue-600 px-6 py-3 text-sm font-semibold text-white transition hover:bg-blue-700">
                            Simpan Transaksi
                        </button>

                    </div>
                </form>
            </div>
        </div>
    </div>
<?php $__env->stopSection(); ?>
<?php echo $__env->make('layouts.app', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH C:\xampp\htdocs\stockify\resources\views/stock-transactions/create.blade.php ENDPATH**/ ?>