@php
    use App\Models\Setting;

    $appSetting = Setting::find(1);

    $appName = $appSetting->app_name ?? 'Stockify';
    $appDescription = $appSetting->app_description ?? 'Sistem Manajemen Stok Barang';
@endphp

<aside class="sticky top-0 z-30 flex h-screen w-64 shrink-0 flex-col border-r border-slate-200 bg-white">

    {{-- LOGO / BRAND --}}
    <div
        class="flex shrink-0 items-center gap-3 border-b border-slate-200 px-6"
        style="
            height: 90px !important;
            min-height: 90px !important;
            max-height: 90px !important;
            box-sizing: border-box !important;
        "
    >

        {{-- LOGO APLIKASI --}}
        @if ($appSetting && $appSetting->app_logo)

            <div
                class="flex h-10 w-10 shrink-0 items-center justify-center overflow-hidden rounded-xl bg-white"
            >
                <img
                    src="{{ asset('storage/' . $appSetting->app_logo) }}"
                    alt="{{ $appName }}"
                    class="h-full w-full object-contain"
                >
            </div>

        @else

            <div
                class="flex h-10 w-10 shrink-0 items-center justify-center rounded-xl bg-blue-600 text-xl font-bold text-white"
            >
                S
            </div>

        @endif


        {{-- NAMA APLIKASI --}}
        <div class="min-w-0">

            <h2 class="truncate text-lg font-bold leading-tight text-slate-900">

                @php
                    $stockifyPosition = stripos($appName, 'ify');
                @endphp

                @if ($stockifyPosition !== false)

                    {{ substr($appName, 0, $stockifyPosition) }}<span style="color: #2563eb;">{{ substr($appName, $stockifyPosition) }}</span>

                @else

                    {{ $appName }}

                @endif

            </h2>

            <p class="truncate whitespace-nowrap text-xs text-slate-500">
                {{ $appDescription }}
            </p>

        </div>

    </div>


    {{-- MENU SIDEBAR --}}
    <nav class="flex-1 overflow-y-auto px-4 py-5">

        <div class="space-y-1">

            {{-- DASHBOARD --}}
            <a
                href="{{ route(auth()->user()->role . '.dashboard') }}"
                class="flex items-center gap-3 rounded-xl px-4 py-3 text-sm font-medium transition
                {{ request()->routeIs('*.dashboard')
                    ? 'bg-blue-50 text-blue-600'
                    : 'text-slate-600 hover:bg-slate-50 hover:text-slate-900' }}"
            >

                <span class="text-lg">
                    ▣
                </span>

                <span>
                    Dashboard
                </span>

            </a>


            {{-- KATEGORI --}}
            @if(auth()->user()->role === 'admin')

                <a
                    href="{{ route('categories.index') }}"
                    class="flex items-center gap-3 rounded-xl px-4 py-3 text-sm font-medium transition
                    {{ request()->routeIs('categories.*')
                        ? 'bg-blue-50 text-blue-600'
                        : 'text-slate-600 hover:bg-slate-50 hover:text-slate-900' }}"
                >

                    <span class="text-lg">
                        ▦
                    </span>

                    <span>
                        Kategori
                    </span>

                </a>

            @endif


            {{-- PRODUK --}}
            @if(in_array(auth()->user()->role, ['admin', 'manager']))

                <a
                    href="{{ route('products.index') }}"
                    class="flex items-center gap-3 rounded-xl px-4 py-3 text-sm font-medium transition
                    {{ request()->routeIs('products.*')
                        ? 'bg-blue-50 text-blue-600'
                        : 'text-slate-600 hover:bg-slate-50 hover:text-slate-900' }}"
                >

                    <span class="text-lg">
                        ▱
                    </span>

                    <span>
                        Produk
                    </span>

                </a>

            @endif


            {{-- SUPPLIER --}}
            @if(in_array(auth()->user()->role, ['admin', 'manager']))

                <a
                    href="{{ route('suppliers.index') }}"
                    class="flex items-center gap-3 rounded-xl px-4 py-3 text-sm font-medium transition
                    {{ request()->routeIs('suppliers.*')
                        ? 'bg-blue-50 text-blue-600'
                        : 'text-slate-600 hover:bg-slate-50 hover:text-slate-900' }}"
                >

                    <span class="text-lg">
                        ▤
                    </span>

                    <span>
                        Supplier
                    </span>

                </a>

            @endif


            {{-- MANAJEMEN STOK --}}
            @if(in_array(auth()->user()->role, ['admin', 'manager', 'staff']))

                <a
                    href="{{ route('stock-management.index') }}"
                    class="flex items-center gap-3 rounded-xl px-4 py-3 text-sm font-medium transition
                    {{ request()->routeIs('stock-management.*')
                        ? 'bg-blue-50 text-blue-600'
                        : 'text-slate-600 hover:bg-slate-50 hover:text-slate-900' }}"
                >

                    <span class="text-lg">
                        ▥
                    </span>

                    <span>
                        Manajemen Stok
                    </span>

                </a>

            @endif


            {{-- TRANSAKSI STOK --}}
            @if(in_array(auth()->user()->role, ['admin', 'manager', 'staff']))

                <a
                    href="{{ route('stock-transactions.index') }}"
                    class="flex items-center gap-3 rounded-xl px-4 py-3 text-sm font-medium transition
                    {{ request()->routeIs('stock-transactions.*')
                        ? 'bg-blue-50 text-blue-600'
                        : 'text-slate-600 hover:bg-slate-50 hover:text-slate-900' }}"
                >

                    <span class="text-lg">
                        ⇄
                    </span>

                    <span>
                        Transaksi Stok
                    </span>

                </a>

            @endif


            {{-- STOCK OPNAME --}}
            @if(in_array(auth()->user()->role, ['admin', 'manager', 'staff']))

                <a
                    href="{{ route('stock-opnames.index') }}"
                    class="flex items-center gap-3 rounded-xl px-4 py-3 text-sm font-medium transition
                    {{ request()->routeIs('stock-opnames.*')
                        ? 'bg-blue-50 text-blue-600'
                        : 'text-slate-600 hover:bg-slate-50 hover:text-slate-900' }}"
                >

                    <span class="text-lg">
                        ✓
                    </span>

                    <span>
                        Stock Opname
                    </span>

                </a>

            @endif


            {{-- LAPORAN --}}
            @if(in_array(auth()->user()->role, ['admin', 'manager']))

                <a
                    href="{{ route('reports.index') }}"
                    class="flex items-center gap-3 rounded-xl px-4 py-3 text-sm font-medium transition
                    {{ request()->routeIs('reports.*')
                        ? 'bg-blue-50 text-blue-600'
                        : 'text-slate-600 hover:bg-slate-50 hover:text-slate-900' }}"
                >

                    <span class="text-lg">
                        ▤
                    </span>

                    <span>
                        Laporan
                    </span>

                </a>

            @endif


            {{-- PENGGUNA --}}
            @if(auth()->user()->role === 'admin')

                <a
                    href="{{ route('users.index') }}"
                    class="flex items-center gap-3 rounded-xl px-4 py-3 text-sm font-medium transition
                    {{ request()->routeIs('users.*')
                        ? 'bg-blue-50 text-blue-600'
                        : 'text-slate-600 hover:bg-slate-50 hover:text-slate-900' }}"
                >

                    <span class="text-lg">
                        ♙
                    </span>

                    <span>
                        Pengguna
                    </span>

                </a>

            @endif


            {{-- AKTIVITAS --}}
            @if(auth()->user()->role === 'admin')

                <a
                    href="{{ route('activity-logs.index') }}"
                    class="flex items-center gap-3 rounded-xl px-4 py-3 text-sm font-medium transition
                    {{ request()->routeIs('activity-logs.*')
                        ? 'bg-blue-50 text-blue-600'
                        : 'text-slate-600 hover:bg-slate-50 hover:text-slate-900' }}"
                >

                    <span class="text-lg">
                        ◷
                    </span>

                    <span>
                        Aktivitas
                    </span>

                </a>

            @endif


            {{-- PENGATURAN --}}
            @if(auth()->user()->role === 'admin')

                <a
                    href="{{ route('settings.index') }}"
                    class="flex items-center gap-3 rounded-xl px-4 py-3 text-sm font-medium transition
                    {{ request()->routeIs('settings.*')
                        ? 'bg-blue-50 text-blue-600'
                        : 'text-slate-600 hover:bg-slate-50 hover:text-slate-900' }}"
                >

                    <span class="text-lg">
                        ⚙
                    </span>

                    <span>
                        Pengaturan
                    </span>

                </a>

            @endif

        </div>

    </nav>


    {{-- USER PROFILE --}}
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

            {{-- AVATAR --}}
            <div
                class="flex h-10 w-10 shrink-0 items-center justify-center rounded-full bg-slate-100 text-sm font-semibold text-slate-600"
            >
                {{ strtoupper(substr(auth()->user()->name ?? 'A', 0, 1)) }}
            </div>


            {{-- INFORMASI USER --}}
            <div class="min-w-0">

                <p class="truncate text-sm font-semibold leading-5 text-slate-900">
                    {{ auth()->user()->name ?? 'Pengguna' }}
                </p>

                <p class="text-xs leading-4 text-slate-500">
                    {{ ucfirst(auth()->user()->role ?? 'User') }}
                </p>

            </div>

        </div>

    </div>

</aside>