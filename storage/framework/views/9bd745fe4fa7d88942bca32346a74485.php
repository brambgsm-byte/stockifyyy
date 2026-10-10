<?php
    use App\Models\Setting;

    $appSetting = Setting::find(1);

    $appName = $appSetting->app_name ?? 'Stockify';
?>

<!DOCTYPE html>
<html lang="<?php echo e(str_replace('_', '-', app()->getLocale())); ?>">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <title><?php echo e($appName); ?></title>

    <?php echo app('Illuminate\Foundation\Vite')(['resources/css/app.css', 'resources/js/app.js']); ?>

    <?php echo $__env->yieldPushContent('styles'); ?>
</head>

<body class="min-h-screen bg-slate-50 text-slate-800 antialiased">

    <div class="flex min-h-screen">

        
        <?php echo $__env->make('layouts.sidebar', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>


        
        <div class="flex min-w-0 flex-1 flex-col">

            
            <header
                class="flex shrink-0 items-center justify-between border-b border-slate-200 bg-white px-8"
                style="
                    height: 90px;
                    min-height: 90px;
                    max-height: 90px;
                    box-sizing: border-box;
                "
            >

                
                <div class="flex h-full flex-col justify-center">

                    <p class="text-sm leading-5 text-slate-500">
                        <?php echo e($appDescription ?? ($appSetting->app_description ?? 'Sistem Manajemen Stok Barang')); ?>

                    </p>

                    <h1 class="text-2xl font-bold leading-7 text-slate-900">
                        <?php echo $__env->yieldContent('header-title', 'Dashboard'); ?>
                    </h1>

                </div>


                
                <div class="flex items-center gap-4">

                    <form method="POST" action="<?php echo e(route('logout')); ?>">

                        <?php echo csrf_field(); ?>

                        <button
                            type="submit"
                            class="inline-flex h-12 items-center justify-center rounded-xl bg-red-500 px-7 text-sm font-semibold text-white transition hover:bg-red-600"
                        >
                            Keluar
                        </button>

                    </form>

                </div>

            </header>


            
            <?php if(session('success')): ?>

                <div class="mx-8 mt-6 rounded-xl border border-green-200 bg-green-50 px-5 py-4 text-sm text-green-700">
                    <?php echo e(session('success')); ?>

                </div>

            <?php endif; ?>


            
            
            <?php if($errors->any() && !request()->routeIs('products.import')): ?>

                <div class="mx-8 mt-6 rounded-xl border border-red-200 bg-red-50 px-5 py-4 text-sm text-red-700">

                    <ul class="list-inside list-disc">

                        <?php $__currentLoopData = $errors->all(); $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $error): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>

                            <li>
                                <?php echo e($error); ?>

                            </li>

                        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>

                    </ul>

                </div>

            <?php endif; ?>


            
            <main class="min-w-0 flex-1 px-8 py-8">

                <?php echo $__env->yieldContent('content'); ?>

            </main>


            
            <footer
                class="border-t border-slate-200 bg-white"
                style="
                    height: 72px !important;
                    min-height: 72px !important;
                    max-height: 72px !important;
                    padding: 0 !important;
                    margin: 0 !important;
                    display: flex !important;
                    align-items: center !important;
                    justify-content: center !important;
                    box-sizing: border-box !important;
                    flex-shrink: 0 !important;
                "
            >

                <span
                    class="text-center text-xs text-slate-500"
                    style="
                        display: block;
                        margin: 0 !important;
                        padding: 0 !important;
                        line-height: 1.5;
                    "
                >
                    &copy; <?php echo e(date('Y')); ?> <?php echo e($appName); ?>. Sistem Manajemen Stok.
                </span>

            </footer>

        </div>

    </div>


    <?php echo $__env->yieldPushContent('scripts'); ?>

</body>

</html><?php /**PATH C:\xampp\htdocs\stockify\resources\views/layouts/app.blade.php ENDPATH**/ ?>