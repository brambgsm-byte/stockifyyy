<?php
    use App\Models\Setting;

    $appSetting = Setting::find(1);

    $appName = $appSetting->app_name ?? 'Stockify';
    $appDescription = $appSetting->app_description ?? 'Sistem Manajemen Stok Barang';
?>

<aside class="sticky top-0 z-30 flex h-screen w-64 shrink-0 flex-col border-r border-slate-200 bg-white">

    
    <div
        class="flex shrink-0 items-center gap-3 border-b border-slate-200 px-6"
        style="
            height: 90px !important;
            min-height: 90px !important;
            max-height: 90px !important;
            box-sizing: border-box !important;
        "
    >

        
        <?php if($appSetting && $appSetting->app_logo): ?>

            <div
                class="flex h-10 w-10 shrink-0 items-center justify-center overflow-hidden rounded-xl bg-white"
            >
                <img
                    src="<?php echo e(asset('storage/' . $appSetting->app_logo)); ?>"
                    alt="<?php echo e($appName); ?>"
                    class="h-full w-full object-contain"
                >
            </div>

        <?php else: ?>

            <div
                class="flex h-10 w-10 shrink-0 items-center justify-center rounded-xl bg-blue-600 text-xl font-bold text-white"
            >
                S
            </div>

        <?php endif; ?>


        
        <div class="min-w-0">

            <h2 class="truncate text-lg font-bold leading-tight text-slate-900">

                <?php
                    $stockifyPosition = stripos($appName, 'ify');
                ?>

                <?php if($stockifyPosition !== false): ?>

                    <?php echo e(substr($appName, 0, $stockifyPosition)); ?><span style="color: #2563eb;"><?php echo e(substr($appName, $stockifyPosition)); ?></span>

                <?php else: ?>

                    <?php echo e($appName); ?>


                <?php endif; ?>

            </h2>

            <p class="truncate whitespace-nowrap text-xs text-slate-500">
                <?php echo e($appDescription); ?>

            </p>

        </div>

    </div>


    
    <nav class="flex-1 overflow-y-auto px-4 py-5">

        <div class="space-y-1">

            
            <a
                href="<?php echo e(route(auth()->user()->role . '.dashboard')); ?>"
                class="flex items-center gap-3 rounded-xl px-4 py-3 text-sm font-medium transition
                <?php echo e(request()->routeIs('*.dashboard')
                    ? 'bg-blue-50 text-blue-600'
                    : 'text-slate-600 hover:bg-slate-50 hover:text-slate-900'); ?>"
            >

                <span class="text-lg">
                    ▣
                </span>

                <span>
                    Dashboard
                </span>

            </a>


            
            <?php if(auth()->user()->role === 'admin'): ?>

                <a
                    href="<?php echo e(route('categories.index')); ?>"
                    class="flex items-center gap-3 rounded-xl px-4 py-3 text-sm font-medium transition
                    <?php echo e(request()->routeIs('categories.*')
                        ? 'bg-blue-50 text-blue-600'
                        : 'text-slate-600 hover:bg-slate-50 hover:text-slate-900'); ?>"
                >

                    <span class="text-lg">
                        ▦
                    </span>

                    <span>
                        Kategori
                    </span>

                </a>

            <?php endif; ?>


            
            <?php if(in_array(auth()->user()->role, ['admin', 'manager'])): ?>

                <a
                    href="<?php echo e(route('products.index')); ?>"
                    class="flex items-center gap-3 rounded-xl px-4 py-3 text-sm font-medium transition
                    <?php echo e(request()->routeIs('products.*')
                        ? 'bg-blue-50 text-blue-600'
                        : 'text-slate-600 hover:bg-slate-50 hover:text-slate-900'); ?>"
                >

                    <span class="text-lg">
                        ▱
                    </span>

                    <span>
                        Produk
                    </span>

                </a>

            <?php endif; ?>


            
            <?php if(in_array(auth()->user()->role, ['admin', 'manager'])): ?>

                <a
                    href="<?php echo e(route('suppliers.index')); ?>"
                    class="flex items-center gap-3 rounded-xl px-4 py-3 text-sm font-medium transition
                    <?php echo e(request()->routeIs('suppliers.*')
                        ? 'bg-blue-50 text-blue-600'
                        : 'text-slate-600 hover:bg-slate-50 hover:text-slate-900'); ?>"
                >

                    <span class="text-lg">
                        ▤
                    </span>

                    <span>
                        Supplier
                    </span>

                </a>

            <?php endif; ?>


            
            <?php if(in_array(auth()->user()->role, ['admin', 'manager', 'staff'])): ?>

                <a
                    href="<?php echo e(route('stock-management.index')); ?>"
                    class="flex items-center gap-3 rounded-xl px-4 py-3 text-sm font-medium transition
                    <?php echo e(request()->routeIs('stock-management.*')
                        ? 'bg-blue-50 text-blue-600'
                        : 'text-slate-600 hover:bg-slate-50 hover:text-slate-900'); ?>"
                >

                    <span class="text-lg">
                        ▥
                    </span>

                    <span>
                        Manajemen Stok
                    </span>

                </a>

            <?php endif; ?>


            
            <?php if(in_array(auth()->user()->role, ['admin', 'manager', 'staff'])): ?>

                <a
                    href="<?php echo e(route('stock-transactions.index')); ?>"
                    class="flex items-center gap-3 rounded-xl px-4 py-3 text-sm font-medium transition
                    <?php echo e(request()->routeIs('stock-transactions.*')
                        ? 'bg-blue-50 text-blue-600'
                        : 'text-slate-600 hover:bg-slate-50 hover:text-slate-900'); ?>"
                >

                    <span class="text-lg">
                        ⇄
                    </span>

                    <span>
                        Transaksi Stok
                    </span>

                </a>

            <?php endif; ?>


            
            <?php if(in_array(auth()->user()->role, ['admin', 'manager', 'staff'])): ?>

                <a
                    href="<?php echo e(route('stock-opnames.index')); ?>"
                    class="flex items-center gap-3 rounded-xl px-4 py-3 text-sm font-medium transition
                    <?php echo e(request()->routeIs('stock-opnames.*')
                        ? 'bg-blue-50 text-blue-600'
                        : 'text-slate-600 hover:bg-slate-50 hover:text-slate-900'); ?>"
                >

                    <span class="text-lg">
                        ✓
                    </span>

                    <span>
                        Stock Opname
                    </span>

                </a>

            <?php endif; ?>


            
            <?php if(in_array(auth()->user()->role, ['admin', 'manager'])): ?>

                <a
                    href="<?php echo e(route('reports.index')); ?>"
                    class="flex items-center gap-3 rounded-xl px-4 py-3 text-sm font-medium transition
                    <?php echo e(request()->routeIs('reports.*')
                        ? 'bg-blue-50 text-blue-600'
                        : 'text-slate-600 hover:bg-slate-50 hover:text-slate-900'); ?>"
                >

                    <span class="text-lg">
                        ▤
                    </span>

                    <span>
                        Laporan
                    </span>

                </a>

            <?php endif; ?>


            
            <?php if(auth()->user()->role === 'admin'): ?>

                <a
                    href="<?php echo e(route('users.index')); ?>"
                    class="flex items-center gap-3 rounded-xl px-4 py-3 text-sm font-medium transition
                    <?php echo e(request()->routeIs('users.*')
                        ? 'bg-blue-50 text-blue-600'
                        : 'text-slate-600 hover:bg-slate-50 hover:text-slate-900'); ?>"
                >

                    <span class="text-lg">
                        ♙
                    </span>

                    <span>
                        Pengguna
                    </span>

                </a>

            <?php endif; ?>


            
            <?php if(auth()->user()->role === 'admin'): ?>

                <a
                    href="<?php echo e(route('activity-logs.index')); ?>"
                    class="flex items-center gap-3 rounded-xl px-4 py-3 text-sm font-medium transition
                    <?php echo e(request()->routeIs('activity-logs.*')
                        ? 'bg-blue-50 text-blue-600'
                        : 'text-slate-600 hover:bg-slate-50 hover:text-slate-900'); ?>"
                >

                    <span class="text-lg">
                        ◷
                    </span>

                    <span>
                        Aktivitas
                    </span>

                </a>

            <?php endif; ?>


            
            <?php if(auth()->user()->role === 'admin'): ?>

                <a
                    href="<?php echo e(route('settings.index')); ?>"
                    class="flex items-center gap-3 rounded-xl px-4 py-3 text-sm font-medium transition
                    <?php echo e(request()->routeIs('settings.*')
                        ? 'bg-blue-50 text-blue-600'
                        : 'text-slate-600 hover:bg-slate-50 hover:text-slate-900'); ?>"
                >

                    <span class="text-lg">
                        ⚙
                    </span>

                    <span>
                        Pengaturan
                    </span>

                </a>

            <?php endif; ?>

        </div>

    </nav>


    
    <div
        class="shrink-0 border-t border-slate-200 px-5"
        style="
            height: 72px !important;
            min-height: 72px !important;
            max-height: 72px !important;
            padding-top: 0 !important;
            padding-bottom: 0 !important;
            display: flex !important;
            align-items: center !important;
            box-sizing: border-box !important;
        "
    >

        <div
            class="flex w-full items-center gap-3"
            style="
                height: 100%;
                align-items: center;
            "
        >

            
            <div
                class="flex h-10 w-10 shrink-0 items-center justify-center rounded-full bg-slate-100 text-sm font-semibold text-slate-600"
            >
                <?php echo e(strtoupper(substr(auth()->user()->name ?? 'A', 0, 1))); ?>

            </div>


            
            <div class="min-w-0">

                <p class="truncate text-sm font-semibold leading-5 text-slate-900">
                    <?php echo e(auth()->user()->name ?? 'Pengguna'); ?>

                </p>

                <p class="text-xs leading-4 text-slate-500">
                    <?php echo e(ucfirst(auth()->user()->role ?? 'User')); ?>

                </p>

            </div>

        </div>

    </div>

</aside><?php /**PATH C:\xampp\htdocs\stockify\resources\views/layouts/sidebar.blade.php ENDPATH**/ ?>