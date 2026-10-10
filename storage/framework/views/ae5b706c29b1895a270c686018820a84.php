

<?php $__env->startSection('title', 'Kategori'); ?>
<?php $__env->startSection('page-title', 'Kategori'); ?>

<?php $__env->startSection('content'); ?>

<div class="space-y-8">

    
    <div class="flex flex-col justify-between gap-4 sm:flex-row sm:items-center">

        <div>
            <p class="text-sm text-gray-500">
                Kelola kategori barang yang tersedia di Stockify.
            </p>

            <h1 class="mt-2 text-3xl font-bold text-gray-900">
                Daftar Kategori
            </h1>
        </div>

        
        <a
            href="<?php echo e(route('categories.create')); ?>"
            class="inline-flex items-center justify-center gap-2 rounded-xl bg-blue-600 px-5 py-3 text-sm font-semibold text-white shadow-sm transition hover:bg-blue-700"
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

            Tambah Kategori
        </a>

    </div>

    
    <?php if(session('error')): ?>
        <div class="flex items-center gap-3 rounded-xl border border-red-200 bg-red-50 px-5 py-4 text-sm font-medium text-red-700">
            <svg
                class="h-5 w-5 shrink-0"
                fill="none"
                stroke="currentColor"
                stroke-width="2"
                viewBox="0 0 24 24"
            >
                <path
                    stroke-linecap="round"
                    stroke-linejoin="round"
                    d="M12 9v4m0 4h.01M10.29 3.86l-7.82 14a2 2 0 001.74 3h15.58a2 2 0 001.74-3l-7.82-14a2 2 0 00-3.42 0z"
                />
            </svg>

            <?php echo e(session('error')); ?>

        </div>
    <?php endif; ?>


    
    <div class="overflow-hidden rounded-2xl border border-gray-200 bg-white shadow-sm">

        
        <div class="flex flex-col justify-between gap-4 border-b border-gray-200 px-6 py-5 sm:flex-row sm:items-center">

            <div>
                <h2 class="text-xl font-bold text-gray-900">
                    Data Kategori
                </h2>

                <p class="mt-1 text-sm text-gray-500">
                    Daftar kategori barang yang terdaftar di dalam sistem.
                </p>
            </div>

            
            <div class="inline-flex w-fit items-center rounded-full bg-blue-50 px-4 py-2 text-sm font-semibold text-blue-600">
                <?php echo e($categories->count()); ?> Kategori
            </div>

        </div>


        
        <div class="overflow-x-auto">

            <table class="w-full min-w-[700px] text-left text-sm text-gray-600">

                <thead class="bg-gray-50 text-xs uppercase text-gray-600">

                    <tr>
                        <th class="px-6 py-4">
                            No
                        </th>

                        <th class="px-6 py-4">
                            Nama Kategori
                        </th>

                        <th class="px-6 py-4">
                            Deskripsi
                        </th>

                        <th class="px-6 py-4 text-center">
                            Aksi
                        </th>
                    </tr>

                </thead>


                <tbody class="divide-y divide-gray-100">

                    <?php $__empty_1 = true; $__currentLoopData = $categories; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $index => $category): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); $__empty_1 = false; ?>

                        <tr class="transition hover:bg-gray-50">

                            
                            <td class="whitespace-nowrap px-6 py-5 text-gray-500">
                                <?php echo e($index + 1); ?>

                            </td>


                            
                            <td class="whitespace-nowrap px-6 py-5">

                                <div class="flex items-center gap-3">

                                    <div class="flex h-10 w-10 items-center justify-center rounded-xl bg-blue-50 text-blue-600">
                                        <svg
                                            class="h-5 w-5"
                                            fill="none"
                                            stroke="currentColor"
                                            stroke-width="1.8"
                                            viewBox="0 0 24 24"
                                        >
                                            <path
                                                stroke-linecap="round"
                                                stroke-linejoin="round"
                                                d="M4 6h16M4 12h16M4 18h16"
                                            />
                                        </svg>
                                    </div>

                                    <span class="font-semibold text-gray-900">
                                        <?php echo e($category->name); ?>

                                    </span>

                                </div>

                            </td>


                            
                            <td class="px-6 py-5">

                                <?php if($category->description): ?>

                                    <p class="max-w-md leading-relaxed text-gray-600">
                                        <?php echo e($category->description); ?>

                                    </p>

                                <?php else: ?>

                                    <span class="text-gray-400">
                                        Belum ada deskripsi
                                    </span>

                                <?php endif; ?>

                            </td>


                            
                            <td class="px-6 py-5">

                                <div class="flex items-center justify-center gap-2">

                                    
                                    <a
                                        href="<?php echo e(route('categories.edit', $category->id)); ?>"
                                        class="inline-flex items-center justify-center gap-1 rounded-lg bg-yellow-100 px-3 py-2 text-xs font-semibold text-yellow-700 transition hover:bg-yellow-200"
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
                                                d="M11 5H6a2 2 0 00-2 2v11a2 2 0 002 2h11a2 2 0 002-2v-5M18.5 2.5a2.121 2.121 0 013 3L12 15l-4 1 1-4 9.5-9.5z"
                                            />
                                        </svg>

                                        Edit
                                    </a>


                                    
                                    <form
                                        action="<?php echo e(route('categories.destroy', $category->id)); ?>"
                                        method="POST"
                                        onsubmit="return confirm('Apakah Anda yakin ingin menghapus kategori ini?');"
                                    >

                                        <?php echo csrf_field(); ?>
                                        <?php echo method_field('DELETE'); ?>

                                        <button
                                            type="submit"
                                            class="inline-flex items-center justify-center gap-1 rounded-lg bg-red-100 px-3 py-2 text-xs font-semibold text-red-700 transition hover:bg-red-200"
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
                                                    d="M3 6h18M8 6V4a2 2 0 012-2h4a2 2 0 012 2v2m3 0v14a2 2 0 01-2 2H7a2 2 0 01-2-2V6m3 5v6m4-6v6"
                                                />
                                            </svg>

                                            Hapus
                                        </button>

                                    </form>

                                </div>

                            </td>

                        </tr>

                    <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); if ($__empty_1): ?>

                        
                        <tr>

                            <td colspan="4" class="px-6 py-16 text-center">

                                <div class="flex flex-col items-center">

                                    <div class="flex h-16 w-16 items-center justify-center rounded-full bg-gray-100">

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
                                                d="M4 6h16M4 12h16M4 18h16"
                                            />
                                        </svg>

                                    </div>

                                    <p class="mt-4 text-base font-semibold text-gray-500">
                                        Belum ada kategori
                                    </p>

                                    <p class="mt-1 text-sm text-gray-400">
                                        Silakan tambahkan kategori baru.
                                    </p>

                                    <a
                                        href="<?php echo e(route('categories.create')); ?>"
                                        class="mt-5 inline-flex items-center gap-2 rounded-xl bg-blue-600 px-4 py-2.5 text-sm font-semibold text-white transition hover:bg-blue-700"
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

                                        Tambah Kategori
                                    </a>

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
<?php echo $__env->make('layouts.app', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH C:\xampp\htdocs\stockify\resources\views/categories/index.blade.php ENDPATH**/ ?>