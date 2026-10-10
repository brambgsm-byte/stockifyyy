

<?php $__env->startSection('title', 'Supplier'); ?>
<?php $__env->startSection('page-title', 'Supplier'); ?>

<?php $__env->startSection('content'); ?>

<div class="space-y-8">

    
    <div class="flex flex-col justify-between gap-4 sm:flex-row sm:items-center">

        <div>

            <p class="text-sm text-gray-500 dark:text-gray-400">
                Kelola data pemasok barang di Stockify.
            </p>

            <h1 class="mt-2 text-3xl font-bold text-gray-900 dark:text-white">
                Daftar Supplier
            </h1>

        </div>


        
        <?php if(auth()->user()->role === 'admin'): ?>

            <a
                href="<?php echo e(route('suppliers.create')); ?>"
                class="inline-flex items-center justify-center rounded-xl bg-blue-600 px-5 py-3 text-sm font-semibold text-white shadow-sm transition hover:bg-blue-700"
            >

                <svg
                    class="mr-2 h-5 w-5"
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

                Tambah Supplier

            </a>

        <?php endif; ?>

    </div>


    
    <?php if(session('success')): ?>

        <div
            class="flex items-center gap-3 rounded-xl border border-green-200 bg-green-50 px-5 py-4 text-sm font-medium text-green-700"
        >

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
                    d="M5 13l4 4L19 7"
                />
            </svg>

            <?php echo e(session('success')); ?>


        </div>

    <?php endif; ?>


    
    <?php if(session('error')): ?>

        <div
            class="flex items-center gap-3 rounded-xl border border-red-200 bg-red-50 px-5 py-4 text-sm font-medium text-red-700"
        >

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
                    d="M6 18L18 6M6 6l12 12"
                />
            </svg>

            <?php echo e(session('error')); ?>


        </div>

    <?php endif; ?>


    
    <?php if($errors->any()): ?>

        <div
            class="rounded-xl border border-red-200 bg-red-50 px-5 py-4 text-sm text-red-700"
        >

            <p class="mb-2 font-semibold">
                Terdapat kesalahan:
            </p>

            <ul class="list-inside list-disc space-y-1">

                <?php $__currentLoopData = $errors->all(); $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $error): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>

                    <li>
                        <?php echo e($error); ?>

                    </li>

                <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>

            </ul>

        </div>

    <?php endif; ?>


    
    <div
        class="overflow-hidden rounded-2xl border border-gray-200 bg-white shadow-sm dark:border-gray-700 dark:bg-slate-800"
    >

        
        <div
            class="flex flex-col justify-between gap-3 border-b border-gray-200 px-6 py-5 sm:flex-row sm:items-center dark:border-gray-700"
        >

            <div>

                <h2 class="text-xl font-bold text-gray-900 dark:text-white">
                    Data Supplier
                </h2>

                <p class="mt-1 text-sm text-gray-500 dark:text-gray-400">
                    Daftar pemasok barang yang terdaftar dalam sistem.
                </p>

            </div>


            <div
                class="rounded-full bg-blue-50 px-4 py-2 text-sm font-semibold text-blue-600 dark:bg-blue-900/40 dark:text-blue-300"
            >
                <?php echo e($suppliers->count()); ?> Supplier
            </div>

        </div>


        
        <div class="overflow-x-auto">

            <table
                class="w-full min-w-[950px] text-left text-sm text-gray-600 dark:text-gray-300"
            >

                <thead
                    class="bg-gray-50 text-xs uppercase text-gray-600 dark:bg-slate-700 dark:text-gray-200"
                >

                    <tr>

                        <th class="px-6 py-4">
                            No
                        </th>

                        <th class="px-6 py-4">
                            Nama Supplier
                        </th>

                        <th class="px-6 py-4">
                            Nomor Telepon
                        </th>

                        <th class="px-6 py-4">
                            Alamat
                        </th>

                        <th class="px-6 py-4">
                            Deskripsi
                        </th>

                        <th class="px-6 py-4 text-center">
                            Aksi
                        </th>

                    </tr>

                </thead>


                <tbody class="divide-y divide-gray-100 dark:divide-gray-700">

                    <?php $__empty_1 = true; $__currentLoopData = $suppliers; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $index => $supplier): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); $__empty_1 = false; ?>

                        <tr
                            class="transition hover:bg-gray-50 dark:hover:bg-slate-700/70"
                        >

                            
                            <td
                                class="whitespace-nowrap px-6 py-5 text-gray-500 dark:text-gray-400"
                            >
                                <?php echo e($index + 1); ?>

                            </td>


                            
                            <td
                                class="whitespace-nowrap px-6 py-5 font-semibold text-gray-900 dark:text-white"
                            >
                                <?php echo e($supplier->name); ?>

                            </td>


                            
                            <td class="whitespace-nowrap px-6 py-5">
                                <?php echo e($supplier->phone ?: '-'); ?>

                            </td>


                            
                            <td class="px-6 py-5">
                                <?php echo e($supplier->address ?: '-'); ?>

                            </td>


                            
                            <td class="px-6 py-5">
                                <?php echo e($supplier->description ?: '-'); ?>

                            </td>


                            
                            <td class="px-6 py-5">

                                <div class="flex items-center justify-center gap-2">

                                    
                                    <?php if(auth()->user()->role === 'admin'): ?>

                                        
                                        <a
                                            href="<?php echo e(route('suppliers.edit', $supplier->id)); ?>"
                                            class="inline-flex items-center gap-1 rounded-lg bg-yellow-100 px-4 py-2 text-xs font-semibold text-yellow-700 transition hover:bg-yellow-200"
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
                                            action="<?php echo e(route('suppliers.destroy', $supplier->id)); ?>"
                                            method="POST"
                                            onsubmit="return confirm('Apakah Anda yakin ingin menghapus supplier ini?');"
                                        >

                                            <?php echo csrf_field(); ?>

                                            <?php echo method_field('DELETE'); ?>

                                            <button
                                                type="submit"
                                                class="inline-flex items-center gap-1 rounded-lg bg-red-100 px-4 py-2 text-xs font-semibold text-red-700 transition hover:bg-red-200"
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
                                                        d="M3 6h18M8 6V4h8v2m-9 0l1 14h8l1-14M10 11v5M14 11v5"
                                                    />
                                                </svg>

                                                Hapus

                                            </button>

                                        </form>

                                    <?php else: ?>

                                        
                                        <span class="text-xs text-gray-400 dark:text-gray-500">
                                            -
                                        </span>

                                    <?php endif; ?>

                                </div>

                            </td>

                        </tr>

                    <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); if ($__empty_1): ?>

                        <tr>

                            <td
                                colspan="6"
                                class="px-6 py-16 text-center"
                            >

                                <div class="flex flex-col items-center">

                                    <svg
                                        class="h-14 w-14 text-gray-300 dark:text-gray-600"
                                        fill="none"
                                        stroke="currentColor"
                                        stroke-width="1.5"
                                        viewBox="0 0 24 24"
                                    >
                                        <path
                                            stroke-linecap="round"
                                            stroke-linejoin="round"
                                            d="M3 21h18M5 21V9l7-5 7 5v12M9 21v-6h6v6"
                                        />
                                    </svg>


                                    <p
                                        class="mt-4 text-base font-semibold text-gray-500 dark:text-gray-300"
                                    >
                                        Belum ada supplier
                                    </p>


                                    <p
                                        class="mt-1 text-sm text-gray-400 dark:text-gray-500"
                                    >
                                        Silakan tambahkan supplier baru.
                                    </p>


                                    
                                    <?php if(auth()->user()->role === 'admin'): ?>

                                        <a
                                            href="<?php echo e(route('suppliers.create')); ?>"
                                            class="mt-5 inline-flex items-center rounded-xl bg-blue-600 px-5 py-3 text-sm font-semibold text-white transition hover:bg-blue-700"
                                        >

                                            <svg
                                                class="mr-2 h-5 w-5"
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

                                            Tambah Supplier

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
<?php echo $__env->make('layouts.app', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH C:\xampp\htdocs\stockify\resources\views/suppliers/index.blade.php ENDPATH**/ ?>