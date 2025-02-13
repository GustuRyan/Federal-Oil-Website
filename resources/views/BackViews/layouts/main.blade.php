<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">

    <!-- Bootstrap 5 CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">

    <!-- Optional JavaScript and Popper.js -->
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.11.8/dist/umd/popper.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/alpinejs@3.x.x/dist/cdn.min.js" defer></script>

    @vite('resources/css/app.css')
    @stack('scripts')

    <title>Worshop Admin</title>
</head>
@php
    $menus = [
        [
            'title' => 'Dashboard',
            'icon' => '',
            'route' => 'admin.dashboard',
            'root' => 'admin.dashboard',
        ],
        [
            'title' => 'Stok',
            'icon' => '',
            'route' => 'admin.stocks.index',
            'root' => 'admin.stocks.*',
        ],
        [
            'title' => 'Servis',
            'icon' => '',
            'route' => 'admin.service.index',
            'root' => 'admin.service.*',
        ],
        [
            'title' => 'Pemasukan',
            'icon' => '',
            'route' => 'admin.income.index',
            'root' => 'admin.income.*',
        ],
        [
            'title' => 'Pengeluaran',
            'icon' => '',
            'route' => 'admin.spending.index',
            'root' => 'admin.spending.*',
        ],
        [
            'title' => 'Piutang',
            'icon' => '',
            'route' => 'admin.receivables.index',
            'root' => 'admin.receivables.*',
        ],
        [
            'title' => 'Pelanggan',
            'icon' => '',
            'route' => 'admin.customer.index',
            'root' => 'admin.customer.*',
        ],
        [
            'title' => 'Kasir',
            'icon' => '',
            'route' => 'cashier',
            'root' => 'cashier',
        ],
    ];
@endphp

<body>
    <div x-data="{ open: false }" class="flex bg-bold-blue">
        <div class="relative w-[24%] h-screen hidden lg:block">
            <div
                class="absolute left-0 top-0 w-full h-screen bg-gradient-to-b from-[#0D3771] to-[rgba(256,256,256,0.7)] via-[#0D3771_24%] text-white p-4 space-y-6">
                <h1 class="w-full text-center text-2xl font-bold">
                    FEDERAL WEBSITE
                </h1>
                <div>
                    <h2 class="text-xl">
                        WEBSITE STOK DAN KASIR
                    </h2>
                    <p>
                        Menu Utama Panel Admin
                    </p>
                </div>
                <ul class="space-y-3">
                    @foreach ($menus as $item)
                        @if (request()->routeIs($item['root']))
                            <li class="bg-bold-blue rounded-lg hover:opacity-85 border-2">
                                <a href="{{ route($item['route']) }}" class=" font-bold flex items-center gap-3 p-3">
                                    <div class="rounded-full w-4 h-4 bg-white hidden xl:block"></div>
                                @else
                            <li class="text-bold-blue bg-white rounded-lg hover:bg-blue-100">
                                <a href="{{ route($item['route']) }}" class=" font-bold flex items-center gap-3 p-3">
                                    <div class="rounded-full w-4 h-4 bg-bold-blue hidden xl:block"></div>
                        @endif
                                    <p>{{ $item['title'] }}</p>
                                </a>
                            </li>
                    @endforeach
                </ul>
            </div>
        </div>
        <div class="w-full">
            <div x-show="open" class="fixed w-56 h-screen bg-[#0D3771] text-white p-4 space-y-6 shadow-lg z-50">
                <div class="flex">
                    <h1 class="w-full text-center text-2xl font-bold">
                        FEDERAL WEBSITE
                    </h1>
                    <img @click="open = !open" src="/icons/icon_close.svg" class="w-4 h-4 img-white">
                </div>
                <div>
                    <h2 class="text-xl">
                        WEBSITE STOK DAN KASIR
                    </h2>
                    <p>
                        Menu Utama Panel Admin
                    </p>
                </div>
                <ul class="space-y-3">
                    @foreach ($menus as $item)
                        @if (request()->routeIs($item['root']))
                            <li class="bg-bold-blue rounded-lg hover:opacity-85 border-2">
                                <a href="{{ route($item['route']) }}" class=" font-bold flex items-center gap-3 p-3">
                                    <div class="rounded-full w-4 h-4 bg-white hidden xl:block"></div>
                                @else
                            <li class="text-bold-blue bg-white rounded-lg hover:bg-blue-100">
                                <a href="{{ route($item['route']) }}" class=" font-bold flex items-center gap-3 p-3">
                                    <div class="rounded-full w-4 h-4 bg-bold-blue hidden xl:block"></div>
                        @endif
                                    <p>{{ $item['title'] }}</p>
                                </a>
                            </li>
                    @endforeach
                </ul>
            </div>
            <div class="w-full h-[8vh] flex items-center p-6">
                <img @click="open = !open" src="/icons/icon_menu.svg" class="w-6 lg:hidden">
            </div>
            <div class="bg-white w-full h-[92vh] rounded-tl-[36px] px-8 pt-8">
                <div class="w-full h-[8vh] border-b-4 pb-4">
                    <h1 class="text-[40px] font-bold text-bold-blue leading-none">
                        @yield('title-content')
                    </h1>
                </div>
                <div class="mt-4 w-full h-[76vh] overflow-y-scroll scrollbar-hide">
                    @yield('main-content')
                </div>
            </div>
        </div>
    </div>
    @yield('js')
</body>

</html>
