

<?php $__env->startSection('title', 'Edit Produk'); ?>
<?php $__env->startSection('page-title', 'Edit Produk'); ?>

<?php $__env->startSection('content'); ?>

<div class="mx-auto max-w-6xl">

    
    <div class="mb-8 flex flex-col justify-between gap-4 sm:flex-row sm:items-center">

        <div>

            <p class="text-sm text-gray-500 dark:text-gray-400">
                Sistem Manajemen Stok Barang
            </p>

            <h1 class="mt-2 text-3xl font-bold text-gray-900 dark:text-white">
                Edit Produk
            </h1>

            <p class="mt-2 text-sm text-gray-500 dark:text-gray-400">
                Perbarui informasi produk yang tersedia di Stockify.
            </p>

        </div>

        <a
            href="<?php echo e(route('products.index')); ?>"
            class="inline-flex items-center justify-center rounded-xl border
                   border-gray-300 bg-white px-5 py-3 text-sm font-semibold
                   text-gray-700 transition hover:bg-gray-100
                   dark:border-gray-600 dark:bg-gray-800 dark:text-gray-200
                   dark:hover:bg-gray-700"
        >
            ← Kembali
        </a>

    </div>


    
    <?php if($errors->any()): ?>

        <div class="mb-6 rounded-xl border border-red-200 bg-red-50 p-5
                    dark:border-red-800 dark:bg-red-900/20">

            <div class="flex items-start gap-3">

                <svg
                    class="h-5 w-5 shrink-0 text-red-600 dark:text-red-400"
                    fill="none"
                    stroke="currentColor"
                    stroke-width="2"
                    viewBox="0 0 24 24"
                >
                    <path
                        stroke-linecap="round"
                        stroke-linejoin="round"
                        d="M12 9v4m0 4h.01M10.29 3.86l-7.82 14a2 2 0 002 3h15.58a2 2 0 002-3l-7.82-14a2 2 0 00-3.48 0z"
                    />
                </svg>

                <div>

                    <h3 class="mb-2 font-semibold text-red-700 dark:text-red-300">
                        Terdapat kesalahan pada formulir:
                    </h3>

                    <ul class="list-inside list-disc space-y-1 text-sm text-red-600 dark:text-red-300">

                        <?php $__currentLoopData = $errors->all(); $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $error): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                            <li><?php echo e($error); ?></li>
                        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>

                    </ul>

                </div>

            </div>

        </div>

    <?php endif; ?>


    
    <div class="rounded-2xl border border-gray-200 bg-white p-8 shadow-sm
                dark:border-gray-700 dark:bg-gray-800">

        <div class="mb-8">

            <h2 class="text-xl font-bold text-gray-900 dark:text-white">
                Informasi Produk
            </h2>

            <p class="mt-1 text-sm text-gray-500 dark:text-gray-400">
                Ubah informasi produk sesuai kebutuhan.
            </p>

        </div>


        <form
            action="<?php echo e(route('products.update', $product->id)); ?>"
            method="POST"
            enctype="multipart/form-data"
        >

            <?php echo csrf_field(); ?>
            <?php echo method_field('PUT'); ?>


            <div class="grid grid-cols-1 gap-6 md:grid-cols-2">

                
                <div>

                    <label
                        for="code"
                        class="mb-2 block text-sm font-semibold text-gray-700
                               dark:text-gray-200"
                    >
                        Kode Produk
                    </label>

                    <input
                        type="text"
                        id="code"
                        name="code"
                        value="<?php echo e(old('code', $product->code)); ?>"
                        placeholder="Contoh: BRG-001"
                        class="w-full rounded-xl border border-gray-300 bg-white
                               px-4 py-3 text-sm text-gray-900 outline-none
                               transition focus:border-blue-500 focus:ring-2
                               focus:ring-blue-100 dark:border-gray-600
                               dark:bg-gray-700 dark:text-white"
                        required
                    >

                </div>


                
                <div>

                    <label
                        for="name"
                        class="mb-2 block text-sm font-semibold text-gray-700
                               dark:text-gray-200"
                    >
                        Nama Produk
                    </label>

                    <input
                        type="text"
                        id="name"
                        name="name"
                        value="<?php echo e(old('name', $product->name)); ?>"
                        placeholder="Masukkan nama produk"
                        class="w-full rounded-xl border border-gray-300 bg-white
                               px-4 py-3 text-sm text-gray-900 outline-none
                               transition focus:border-blue-500 focus:ring-2
                               focus:ring-blue-100 dark:border-gray-600
                               dark:bg-gray-700 dark:text-white"
                        required
                    >

                </div>


                
                <div>

                    <label
                        for="category_id"
                        class="mb-2 block text-sm font-semibold text-gray-700
                               dark:text-gray-200"
                    >
                        Kategori
                    </label>

                    <select
                        id="category_id"
                        name="category_id"
                        class="w-full rounded-xl border border-gray-300 bg-white
                               px-4 py-3 text-sm text-gray-900 outline-none
                               transition focus:border-blue-500 focus:ring-2
                               focus:ring-blue-100 dark:border-gray-600
                               dark:bg-gray-700 dark:text-white"
                        required
                    >

                        <option value="">
                            Pilih kategori
                        </option>

                        <?php $__currentLoopData = $categories; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $category): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>

                            <option
                                value="<?php echo e($category->id); ?>"
                                <?php echo e(old('category_id', $product->category_id) == $category->id ? 'selected' : ''); ?>

                            >
                                <?php echo e($category->name); ?>

                            </option>

                        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>

                    </select>

                </div>


                
                <div>

                    <label
                        for="supplier_id"
                        class="mb-2 block text-sm font-semibold text-gray-700
                               dark:text-gray-200"
                    >
                        Supplier
                    </label>

                    <select
                        id="supplier_id"
                        name="supplier_id"
                        class="w-full rounded-xl border border-gray-300 bg-white
                               px-4 py-3 text-sm text-gray-900 outline-none
                               transition focus:border-blue-500 focus:ring-2
                               focus:ring-blue-100 dark:border-gray-600
                               dark:bg-gray-700 dark:text-white"
                        required
                    >

                        <option value="">
                            Pilih supplier
                        </option>

                        <?php $__currentLoopData = $suppliers; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $supplier): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>

                            <option
                                value="<?php echo e($supplier->id); ?>"
                                <?php echo e(old('supplier_id', $product->supplier_id) == $supplier->id ? 'selected' : ''); ?>

                            >
                                <?php echo e($supplier->name); ?>

                            </option>

                        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>

                    </select>

                </div>


                
                <div>

                    <label
                        for="unit"
                        class="mb-2 block text-sm font-semibold text-gray-700
                               dark:text-gray-200"
                    >
                        Satuan
                    </label>

                    <input
                        type="text"
                        id="unit"
                        name="unit"
                        value="<?php echo e(old('unit', $product->unit)); ?>"
                        placeholder="Contoh: pcs, unit, box"
                        class="w-full rounded-xl border border-gray-300 bg-white
                               px-4 py-3 text-sm text-gray-900 outline-none
                               transition focus:border-blue-500 focus:ring-2
                               focus:ring-blue-100 dark:border-gray-600
                               dark:bg-gray-700 dark:text-white"
                        required
                    >

                </div>


                
                <div>

                    <label
                        for="size"
                        class="mb-2 block text-sm font-semibold text-gray-700
                               dark:text-gray-200"
                    >
                        Ukuran
                    </label>

                    <input
                        type="text"
                        id="size"
                        name="size"
                        value="<?php echo e(old('size', $product->size)); ?>"
                        placeholder="Contoh: S, M, L, XL atau 40"
                        class="w-full rounded-xl border border-gray-300 bg-white
                               px-4 py-3 text-sm text-gray-900 outline-none
                               transition focus:border-blue-500 focus:ring-2
                               focus:ring-blue-100 dark:border-gray-600
                               dark:bg-gray-700 dark:text-white"
                    >

                </div>


                
                <div>

                    <label
                        for="color"
                        class="mb-2 block text-sm font-semibold text-gray-700
                               dark:text-gray-200"
                    >
                        Warna
                    </label>

                    <input
                        type="text"
                        id="color"
                        name="color"
                        value="<?php echo e(old('color', $product->color)); ?>"
                        placeholder="Contoh: Hitam, Putih, Merah"
                        class="w-full rounded-xl border border-gray-300 bg-white
                               px-4 py-3 text-sm text-gray-900 outline-none
                               transition focus:border-blue-500 focus:ring-2
                               focus:ring-blue-100 dark:border-gray-600
                               dark:bg-gray-700 dark:text-white"
                    >

                </div>


                
                <div>

                    <label
                        for="minimum_stock"
                        class="mb-2 block text-sm font-semibold text-gray-700
                               dark:text-gray-200"
                    >
                        Stok Minimum
                    </label>

                    <input
                        type="number"
                        id="minimum_stock"
                        name="minimum_stock"
                        value="<?php echo e(old('minimum_stock', $product->minimum_stock)); ?>"
                        min="0"
                        class="w-full rounded-xl border border-gray-300 bg-white
                               px-4 py-3 text-sm text-gray-900 outline-none
                               transition focus:border-blue-500 focus:ring-2
                               focus:ring-blue-100 dark:border-gray-600
                               dark:bg-gray-700 dark:text-white"
                        required
                    >

                </div>


                
                <div>

                    <label
                        for="purchase_price"
                        class="mb-2 block text-sm font-semibold text-gray-700
                               dark:text-gray-200"
                    >
                        Harga Beli
                    </label>

                    <div class="flex">

                        <span
                            class="inline-flex items-center rounded-l-xl border
                                   border-r-0 border-gray-300 bg-gray-100 px-4
                                   text-sm text-gray-600 dark:border-gray-600
                                   dark:bg-gray-600 dark:text-gray-200"
                        >
                            Rp
                        </span>

                        <input
                            type="number"
                            id="purchase_price"
                            name="purchase_price"
                            value="<?php echo e(old('purchase_price', $product->purchase_price)); ?>"
                            min="0"
                            class="w-full rounded-r-xl border border-gray-300
                                   bg-white px-4 py-3 text-sm text-gray-900
                                   outline-none transition focus:border-blue-500
                                   focus:ring-2 focus:ring-blue-100
                                   dark:border-gray-600 dark:bg-gray-700
                                   dark:text-white"
                            required
                        >

                    </div>

                </div>


                
                <div>

                    <label
                        for="selling_price"
                        class="mb-2 block text-sm font-semibold text-gray-700
                               dark:text-gray-200"
                    >
                        Harga Jual
                    </label>

                    <div class="flex">

                        <span
                            class="inline-flex items-center rounded-l-xl border
                                   border-r-0 border-gray-300 bg-gray-100 px-4
                                   text-sm text-gray-600 dark:border-gray-600
                                   dark:bg-gray-600 dark:text-gray-200"
                        >
                            Rp
                        </span>

                        <input
                            type="number"
                            id="selling_price"
                            name="selling_price"
                            value="<?php echo e(old('selling_price', $product->selling_price)); ?>"
                            min="0"
                            class="w-full rounded-r-xl border border-gray-300
                                   bg-white px-4 py-3 text-sm text-gray-900
                                   outline-none transition focus:border-blue-500
                                   focus:ring-2 focus:ring-blue-100
                                   dark:border-gray-600 dark:bg-gray-700
                                   dark:text-white"
                            required
                        >

                    </div>

                </div>


                
                <div class="md:col-span-2">

                    <label
                        for="image"
                        class="mb-2 block text-sm font-semibold text-gray-700
                               dark:text-gray-200"
                    >
                        Gambar Produk
                    </label>

                    <div class="grid grid-cols-1 gap-6 md:grid-cols-2">

                        
                        <div>

                            <p class="mb-3 text-sm font-medium text-gray-600 dark:text-gray-300">
                                Gambar saat ini
                            </p>

                            <?php if($product->image): ?>

                                <img
                                    id="current-image"
                                    src="<?php echo e(asset('storage/' . $product->image)); ?>"
                                    alt="<?php echo e($product->name); ?>"
                                    class="h-48 w-48 rounded-2xl border border-gray-200
                                           object-cover shadow-sm dark:border-gray-600"
                                >

                            <?php else: ?>

                                <div
                                    id="current-image"
                                    class="flex h-48 w-48 items-center justify-center
                                           rounded-2xl border border-dashed
                                           border-gray-300 bg-gray-100 text-center
                                           text-sm text-gray-400 dark:border-gray-600
                                           dark:bg-gray-700"
                                >
                                    Tidak ada gambar
                                </div>

                            <?php endif; ?>

                        </div>


                        
                        <div>

                            <p class="mb-3 text-sm font-medium text-gray-600 dark:text-gray-300">
                                Pilih gambar baru
                            </p>

                            <input
                                type="file"
                                id="image"
                                name="image"
                                accept=".jpg,.jpeg,.png,.webp"
                                class="block w-full rounded-xl border border-gray-300
                                       bg-white text-sm text-gray-700
                                       file:mr-4 file:border-0 file:bg-blue-50
                                       file:px-4 file:py-3 file:font-semibold
                                       file:text-blue-700 hover:file:bg-blue-100
                                       dark:border-gray-600 dark:bg-gray-700
                                       dark:text-gray-200"
                            >

                            <p class="mt-2 text-xs text-gray-500 dark:text-gray-400">
                                Format: JPG, JPEG, PNG, atau WEBP. Maksimal 2 MB.
                            </p>


                            
                            <div id="preview-container" class="mt-4 hidden">

                                <p class="mb-2 text-sm font-medium text-gray-600 dark:text-gray-300">
                                    Pratinjau gambar baru
                                </p>

                                <img
                                    id="image-preview"
                                    src="#"
                                    alt="Pratinjau gambar baru"
                                    class="h-48 w-48 rounded-2xl border border-gray-200
                                           object-cover shadow-sm dark:border-gray-600"
                                >

                            </div>

                        </div>

                    </div>

                </div>


                
                <div class="md:col-span-2">

                    <label
                        for="description"
                        class="mb-2 block text-sm font-semibold text-gray-700
                               dark:text-gray-200"
                    >
                        Deskripsi Produk
                    </label>

                    <textarea
                        id="description"
                        name="description"
                        rows="5"
                        placeholder="Masukkan deskripsi produk"
                        class="w-full rounded-xl border border-gray-300 bg-white
                               px-4 py-3 text-sm text-gray-900 outline-none
                               transition focus:border-blue-500 focus:ring-2
                               focus:ring-blue-100 dark:border-gray-600
                               dark:bg-gray-700 dark:text-white"
                    ><?php echo e(old('description', $product->description)); ?></textarea>

                </div>

            </div>


            
            <div
                class="mt-8 flex justify-end gap-3 border-t border-gray-200 pt-6
                       dark:border-gray-700"
            >

                <a
                    href="<?php echo e(route('products.index')); ?>"
                    class="rounded-xl border border-gray-300 bg-white px-6 py-3
                           text-sm font-semibold text-gray-700 transition
                           hover:bg-gray-100 dark:border-gray-600
                           dark:bg-gray-700 dark:text-gray-200
                           dark:hover:bg-gray-600"
                >
                    Batal
                </a>

                <button
                    type="submit"
                    class="rounded-xl bg-blue-600 px-6 py-3 text-sm font-semibold
                           text-white transition hover:bg-blue-700
                           focus:outline-none focus:ring-4 focus:ring-blue-200"
                >
                    Simpan Perubahan
                </button>

            </div>

        </form>

    </div>

</div>



<script>
    document.addEventListener('DOMContentLoaded', function () {

        const imageInput = document.getElementById('image');
        const previewContainer = document.getElementById('preview-container');
        const imagePreview = document.getElementById('image-preview');

        imageInput.addEventListener('change', function (event) {

            const file = event.target.files[0];

            if (!file) {
                previewContainer.classList.add('hidden');
                imagePreview.src = '#';
                return;
            }

            const allowedTypes = [
                'image/jpeg',
                'image/png',
                'image/webp'
            ];

            if (!allowedTypes.includes(file.type)) {
                alert('Format gambar harus JPG, JPEG, PNG, atau WEBP.');
                imageInput.value = '';
                previewContainer.classList.add('hidden');
                imagePreview.src = '#';
                return;
            }

            if (file.size > 2 * 1024 * 1024) {
                alert('Ukuran gambar maksimal 2 MB.');
                imageInput.value = '';
                previewContainer.classList.add('hidden');
                imagePreview.src = '#';
                return;
            }

            const reader = new FileReader();

            reader.onload = function (e) {
                imagePreview.src = e.target.result;
                previewContainer.classList.remove('hidden');
            };

            reader.readAsDataURL(file);

        });

    });
</script>

<?php $__env->stopSection(); ?>
<?php echo $__env->make('layouts.app', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH C:\xampp\htdocs\stockify\resources\views/products/edit.blade.php ENDPATH**/ ?>