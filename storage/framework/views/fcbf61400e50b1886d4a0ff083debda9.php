

<?php $__env->startSection('title', 'Riwayat Aktivitas'); ?>

<?php $__env->startSection('page-title', 'Riwayat Aktivitas'); ?>

<?php $__env->startSection('content'); ?>

<div class="space-y-6">

    <div>
        <h2 class="text-2xl font-bold text-gray-800 dark:text-white">
            Riwayat Aktivitas
        </h2>

        <p class="text-sm text-gray-500 dark:text-gray-400 mt-1">
            Daftar aktivitas pengguna dalam sistem Stockify.
        </p>
    </div>

    <div class="bg-white dark:bg-gray-800 rounded-xl shadow-sm border border-gray-200 dark:border-gray-700 overflow-hidden">

        <div class="overflow-x-auto">
            <table class="w-full text-sm text-left text-gray-600 dark:text-gray-300">

                <thead class="text-xs uppercase bg-gray-100 dark:bg-gray-700 text-gray-700 dark:text-gray-200">
                    <tr>
                        <th class="px-6 py-4">No</th>
                        <th class="px-6 py-4">Pengguna</th>
                        <th class="px-6 py-4">Aktivitas</th>
                        <th class="px-6 py-4">Deskripsi</th>
                        <th class="px-6 py-4">Modul</th>
                        <th class="px-6 py-4">IP Address</th>
                        <th class="px-6 py-4">Waktu</th>
                    </tr>
                </thead>

                <tbody>
                    <?php $__empty_1 = true; $__currentLoopData = $activities; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $activity): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); $__empty_1 = false; ?>
                        <tr class="border-b border-gray-200 dark:border-gray-700 hover:bg-gray-50 dark:hover:bg-gray-700">

                            <td class="px-6 py-4">
                                <?php echo e($activities->firstItem() + $loop->index); ?>

                            </td>

                            <td class="px-6 py-4 font-medium text-gray-900 dark:text-white">
                                <?php echo e($activity->user->name ?? 'Sistem'); ?>

                            </td>

                            <td class="px-6 py-4">
                                <span class="inline-flex px-3 py-1 rounded-full text-xs font-semibold bg-blue-100 text-blue-800 dark:bg-blue-900 dark:text-blue-200">
                                    <?php echo e($activity->activity); ?>

                                </span>
                            </td>

                            <td class="px-6 py-4">
                                <?php echo e($activity->description ?? '-'); ?>

                            </td>

                            <td class="px-6 py-4">
                                <?php echo e($activity->module ?? '-'); ?>

                            </td>

                            <td class="px-6 py-4">
                                <?php echo e($activity->ip_address ?? '-'); ?>

                            </td>

                            <td class="px-6 py-4 whitespace-nowrap">
                                <?php echo e($activity->created_at->format('d/m/Y H:i')); ?>

                            </td>

                        </tr>
                    <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); if ($__empty_1): ?>
                        <tr>
                            <td colspan="7" class="px-6 py-10 text-center text-gray-500 dark:text-gray-400">
                                Belum ada aktivitas yang tercatat.
                            </td>
                        </tr>
                    <?php endif; ?>
                </tbody>

            </table>
        </div>

        <?php if($activities->hasPages()): ?>
            <div class="p-5 border-t border-gray-200 dark:border-gray-700">
                <?php echo e($activities->links()); ?>

            </div>
        <?php endif; ?>

    </div>

</div>

<?php $__env->stopSection(); ?>
<?php echo $__env->make('layouts.app', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH C:\xampp\htdocs\stockify\resources\views/activity-logs/index.blade.php ENDPATH**/ ?>