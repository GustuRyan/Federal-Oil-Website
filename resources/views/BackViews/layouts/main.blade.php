<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    @vite('resources/css/app.css')
    <title>Worshop Admin</title>
</head>
@php
    $menus = [
        [
            'title' => 'Dashboard',
            'icon' => '',
            'route' => 'admin.dashboard',
        ],
        [
            'title' => 'Stok',
            'icon' => '',
            'route' => 'admin.stocks',
        ],
        [
            'title' => 'Pemasukan',
            'icon' => '',
            'route' => 'admin.income',
        ],
        [
            'title' => 'Pengeluaran',
            'icon' => '',
            'route' => 'admin.spending',
        ],
        [
            'title' => 'Piutang',
            'icon' => '',
            'route' => 'admin.receivables',
        ],
        [
            'title' => 'Kasir',
            'icon' => '',
            'route' => 'cashier',
        ],
    ];
@endphp

<body>
    <div class="flex bg-bold-blue">
        <div class="relative w-[24%] h-screen">
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
                        @if (request()->routeIs($item['route']))
                            <li class="bg-bold-blue rounded-lg hover:opacity-85 border-2">
                                <a href="{{route($item['route'])}}" class=" font-bold flex items-center gap-3 p-3">
                                    <div class="rounded-full w-4 h-4 bg-white"></div>
                                @else
                            <li class="text-bold-blue bg-white rounded-lg hover:bg-blue-100">
                                <a href="{{route($item['route'])}}" class=" font-bold flex items-center gap-3 p-3">
                                    <div class="rounded-full w-4 h-4 bg-bold-blue"></div>
                        @endif
                        <p>{{ $item['title'] }}</p>
                        </a>
                        </li>
                    @endforeach
                </ul>
            </div>
        </div>
        <div class="w-full">
            <div class="w-full h-[8vh]">

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
</body>

</html>
