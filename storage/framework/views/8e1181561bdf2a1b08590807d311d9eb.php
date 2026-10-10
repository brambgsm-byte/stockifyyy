

<?php $__env->startSection('title', 'Produk'); ?>

<?php $__env->startSection('page-title', 'Produk'); ?>

<?php $__env->startSection('content'); ?>

<div class="space-y-8">

    
    <div class="flex flex-col justify-between gap-4 sm:flex-row sm:items-center">

        <div>

            <p class="text-sm text-gray-500 dark:text-gray-400">
                Kelola data produk barang Stockify.
            </p>

            <h1 class="mt-2 text-3xl font-bold text-gray-900 dark:text-white">
                Daftar Produk
            </h1>

        </div>

        
        <?php if(in_array(auth()->user()->role, ['admin', 'manager'])): ?>

            <div class="flex flex-wrap items-center gap-3">

                
                <?php if(auth()->user()->role === 'admin'): ?>
                    <a
                        href="<?php echo e(route('products.import')); ?>"
                        style="background-color: #16a34a; color: #ffffff;"
                        class="inline-flex items-center justify-center gap-2 rounded-xl
                               border border-green-700 px-5 py-3 text-sm font-semibold
                               shadow-sm transition hover:opacity-90"
                    >

                        <svg
                            class="h-5 w-5"
                            fill="none"
                            stroke="currentColor"
                            stroke-width="2"
                            viewBox="0 0 24 24"
                        >
                            <path
                                stroke-linecap="round"
                                stroke-linejoin="round"
                                d="M12 3v12m0 0l-4-4m4 4l4-4M5 15v4a2 2 0 002 2h10a2 2 0 002-2v-4"
                            />
                        </svg>

                        <span style="color: #ffffff;">
                            Impor Excel
                        </span>

                    </a>
                <?php endif; ?>

                
                <a
                    href="<?php echo e(route('products.create')); ?>"
                    class="inline-flex items-center justify-center gap-2 rounded-xl
                           bg-blue-600 px-5 py-3 text-sm font-semibold text-white
                           shadow-sm transition hover:bg-blue-700"
                >

                    <svg
                        class="h-5 w-5"
                        fill="none"
                        stroke="currentColor"
                        stroke-width="2"
                        viewBox="0 0 24 24"
                    >
                        <path
                            stroke-linecap="round"
                            stroke-linejoin="round"
                            d="M12 5v14M5 12h14"
                        />
                    </svg>

                    Tambah Produk

                </a>

            </div>

        <?php endif; ?>

    </div>


    
    <div
        class="overflow-hidden rounded-2xl border border-gray-200 bg-white
               shadow-sm dark:border-gray-700 dark:bg-gray-800"
    >

        
        <div
            class="flex flex-col justify-between gap-4 border-b border-gray-200
                   px-6 py-5 sm:flex-row sm:items-center
                   dark:border-gray-700"
        >

            <div>

                <h2 class="text-xl font-bold text-gray-900 dark:text-white">
                    Data Produk
                </h2>

                <p class="mt-1 text-sm text-gray-500 dark:text-gray-400">
                    Daftar produk yang tersedia di dalam sistem.
                </p>

            </div>

            <div
                class="inline-flex w-fit items-center rounded-full bg-blue-50
                       px-4 py-2 text-sm font-semibold text-blue-600
                       dark:bg-blue-900/30 dark:text-blue-300"
            >
                <?php echo e($products->count()); ?> Produk
            </div>

        </div>


        
        <div class="overflow-x-auto">

            <table
                class="w-full min-w-[1450px] text-left text-sm
                       text-gray-600 dark:text-gray-300"
            >

                <thead
                    class="bg-gray-50 text-xs uppercase text-gray-600
                           dark:bg-gray-700 dark:text-gray-300"
                >

                    <tr>

                        <th class="px-6 py-4">
                            No
                        </th>

                        <th class="px-6 py-4">
                            Gambar
                        </th>

                        <th class="px-6 py-4">
                            Kode
                        </th>

                        <th class="px-6 py-4">
                            Nama Produk
                        </th>

                        <th class="px-6 py-4">
                            Kategori
                        </th>

                        <th class="px-6 py-4">
                            Supplier
                        </th>

                        <th class="px-6 py-4 text-center">
                            Stok
                        </th>

                        <th class="px-6 py-4">
                            Satuan
                        </th>

                        <th class="px-6 py-4">
                            Ukuran
                        </th>

                        <th class="px-6 py-4">
                            Warna
                        </th>

                        <th class="px-6 py-4">
                            Harga Jual
                        </th>

                        <th class="px-6 py-4 text-center">
                            Aksi
                        </th>

                    </tr>

                </thead>


                <tbody class="divide-y divide-gray-100 dark:divide-gray-700">

                    <?php $__empty_1 = true; $__currentLoopData = $products; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $index => $product): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); $__empty_1 = false; ?>

                        <tr
                            class="transition hover:bg-gray-50 dark:hover:bg-gray-700/50"
                        >

                            
                            <td
                                class="whitespace-nowrap px-6 py-5 text-gray-500
                                       dark:text-gray-400"
                            >
                                <?php echo e($index + 1); ?>

                            </td>


                            
                            <td class="px-6 py-5">

                                <?php if($product->image): ?>

                                    <img
                                        src="<?php echo e(asset('storage/' . $product->image)); ?>"
                                        alt="<?php echo e($product->name); ?>"
                                        class="h-16 w-16 rounded-xl border border-gray-200
                                               object-cover shadow-sm dark:border-gray-600"
                                        loading="lazy"
                                    >

                                <?php else: ?>

                                    <div
                                        class="flex h-16 w-16 items-center justify-center
                                               rounded-xl border border-dashed border-gray-300
                                               bg-gray-100 text-center text-xs text-gray-400
                                               dark:border-gray-600 dark:bg-gray-700
                                               dark:text-gray-400"
                                    >
                                        Tidak ada gambar
                                    </div>

                                <?php endif; ?>

                            </td>


                            
                            <td
                                class="whitespace-nowrap px-6 py-5 font-semibold
                                       text-gray-900 dark:text-white"
                            >
                                <?php echo e($product->code); ?>

                            </td>


                            
                            <td class="px-6 py-5">

                                <div
                                    class="font-semibold text-gray-900 dark:text-white"
                                >
                                    <?php echo e($product->name); ?>

                                </div>

                                <?php if($product->description): ?>

                                    <div
                                        class="mt-1 max-w-xs truncate text-xs
                                               text-gray-500 dark:text-gray-400"
                                    >
                                        <?php echo e($product->description); ?>

                                    </div>

                                <?php endif; ?>

                            </td>


                            
                            <td class="whitespace-nowrap px-6 py-5">
                                <?php echo e($product->category?->name ?? '-'); ?>

                            </td>


                            
                            <td class="whitespace-nowrap px-6 py-5">
                                <?php echo e($product->supplier?->name ?? '-'); ?>

                            </td>


                            
                            <td class="whitespace-nowrap px-6 py-5 text-center">

                                <?php if($product->stock <= $product->minimum_stock): ?>

                                    <span
                                        class="inline-flex items-center rounded-full
                                               bg-red-100 px-3 py-1 text-xs
                                               font-semibold text-red-700
                                               dark:bg-red-900/30 dark:text-red-300"
                                    >
                                        <?php echo e($product->stock); ?>

                                    </span>

                                <?php else: ?>

                                    <span
                                        class="inline-flex items-center rounded-full
                                               bg-green-100 px-3 py-1 text-xs
                                               font-semibold text-green-700
                                               dark:bg-green-900/30 dark:text-green-300"
                                    >
                                        <?php echo e($product->stock); ?>

                                    </span>

                                <?php endif; ?>

                            </td>


                            
                            <td class="whitespace-nowrap px-6 py-5">
                                <?php echo e($product->unit); ?>

                            </td>


                            
                            <td class="whitespace-nowrap px-6 py-5">
                                <?php echo e($product->size ?? '-'); ?>

                            </td>


                            
                            <td class="whitespace-nowrap px-6 py-5">
                                <?php echo e($product->color ?? '-'); ?>

                            </td>


                            
                            <td
                                class="whitespace-nowrap px-6 py-5 font-semibold
                                       text-gray-900 dark:text-white"
                            >
                                Rp <?php echo e(number_format($product->selling_price, 0, ',', '.')); ?>

                            </td>


                            
                            <td class="px-6 py-5">

                                <div class="flex items-center justify-center gap-2">

                                    
                                    <a
                                        href="<?php echo e(route('products.show', $product->id)); ?>"
                                        class="inline-flex items-center justify-center rounded-lg
                                               bg-blue-100 px-3 py-2 text-xs font-semibold
                                               text-blue-700 transition hover:bg-blue-200
                                               dark:bg-blue-900/30 dark:text-blue-300"
                                    >

                                        <svg
                                            class="mr-1 h-4 w-4"
                                            fill="none"
                                            stroke="currentColor"
                                            stroke-width="2"
                                            viewBox="0 0 24 24"
                                        >
                                            <path
                                                stroke-linecap="round"
                                                stroke-linejoin="round"
                                                d="M15 12a3 3 0 11-6 0 3 3 0 016 0z"
                                            />

                                            <path
                                                stroke-linecap="round"
                                                stroke-linejoin="round"
                                                d="M2.458 12C3.732 7.943 7.523 5 12 5c4.477 0 8.268 2.943 9.542 7-1.274 4.057-5.065 7-9.542 7-4.477 0-8.268-2.943-9.542-7z"
                                            />
                                        </svg>

                                        Detail

                                    </a>


                                    
                                    <?php if(auth()->user()->role === 'admin'): ?>

                                        
                                        <a
                                            href="<?php echo e(route('products.edit', $product->id)); ?>"
                                            class="inline-flex items-center justify-center rounded-lg
                                                   bg-yellow-100 px-3 py-2 text-xs font-semibold
                                                   text-yellow-700 transition hover:bg-yellow-200
                                                   dark:bg-yellow-900/30 dark:text-yellow-300"
                                        >

                                            <svg
                                                class="mr-1 h-4 w-4"
                                                fill="none"
                                                stroke="currentColor"
                                                stroke-width="2"
                                                viewBox="0 0 24 24"
                                            >
                                                <path
                                                    stroke-linecap="round"
                                                    stroke-linejoin="round"
                                                    d="M11 5H6a2 2 0 00-2 2v11a2 2 0 002 2h11a2 2 0 002-2v-5M18.5 2.5a2.121 2.121 0 013 3L12 15l-4 1 1-4 9.5-9.5z"
                                                />
                                            </svg>

                                            Edit

                                        </a>


                                        
                                        <form
                                            action="<?php echo e(route('products.destroy', $product->id)); ?>"
                                            method="POST"
                                            onsubmit="return confirm('Apakah Anda yakin ingin menghapus produk ini?');"
                                        >

                                            <?php echo csrf_field(); ?>

                                            <?php echo method_field('DELETE'); ?>

                                            <button
                                                type="submit"
                                                class="inline-flex items-center justify-center rounded-lg
                                                       bg-red-100 px-3 py-2 text-xs font-semibold
                                                       text-red-700 transition hover:bg-red-200
                                                       dark:bg-red-900/30 dark:text-red-300"
                                            >

                                                <svg
                                                    class="mr-1 h-4 w-4"
                                                    fill="none"
                                                    stroke="currentColor"
                                                    stroke-width="2"
                                                    viewBox="0 0 24 24"
                                                >
                                                    <path
                                                        stroke-linecap="round"
                                                        stroke-linejoin="round"
                                                        d="M3 6h18M8 6V4a2 2 0 012-2h4a2 2 0 012 2v2m3 0v14a2 2 0 01-2 2H7a2 2 0 01-2-2V6m3 5v6m4-6v6"
                                                    />
                                                </svg>

                                                Hapus

                                            </button>

                                        </form>

                                    <?php endif; ?>

                                </div>

                            </td>

                        </tr>

                    <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); if ($__empty_1): ?>

                        
                        <tr>

                            <td colspan="12" class="px-6 py-16 text-center">

                                <div class="flex flex-col items-center">

                                    <div
                                        class="flex h-16 w-16 items-center justify-center
                                               rounded-full bg-gray-100 dark:bg-gray-700"
                                    >

                                        <svg
                                            class="h-8 w-8 text-gray-400"
                                            fill="none"
                                            stroke="currentColor"
                                            stroke-width="1.5"
                                            viewBox="0 0 24 24"
                                        >

                                            <path
                                                stroke-linecap="round"
                                                stroke-linejoin="round"
                                                d="M20 13V6a2 2 0 00-2-2H6a2 2 0 00-2 2v7m16 0v5a2 2 0 01-2 2H6a2 2 0 01-2-2v-5m16 0H4m4-5h8"
                                            />

                                        </svg>

                                    </div>

                                    <p
                                        class="mt-4 text-base font-semibold text-gray-500
                                               dark:text-gray-300"
                                    >
                                        Belum ada produk
                                    </p>

                                    <p class="mt-1 text-sm text-gray-400">
                                        Silakan tambahkan produk baru.
                                    </p>


                                    
                                    <?php if(in_array(auth()->user()->role, ['admin', 'manager'])): ?>

                                        <a
                                            href="<?php echo e(route('products.create')); ?>"
                                            class="mt-5 inline-flex items-center gap-2 rounded-xl
                                                   bg-blue-600 px-4 py-2.5 text-sm font-semibold
                                                   text-white transition hover:bg-blue-700"
                                        >

                                            <svg
                                                class="h-4 w-4"
                                                fill="none"
                                                stroke="currentColor"
                                                stroke-width="2"
                                                viewBox="0 0 24 24"
                                            >

                                                <path
                                                    stroke-linecap="round"
                                                    stroke-linejoin="round"
                                                    d="M12 5v14M5 12h14"
                                                />

                                            </svg>

                                            Tambah Produk

                                        </a>

                                    <?php endif; ?>

                                </div>

                            </td>

                        </tr>

                    <?php endif; ?>

                </tbody>

            </table>

        </div>

    </div>

</div>

<?php $__env->stopSection(); ?>
<?php echo $__env->make('layouts.app', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH C:\xampp\htdocs\stockify\resources\views/products/index.blade.php ENDPATH**/ ?>