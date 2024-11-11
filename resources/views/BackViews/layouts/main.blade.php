<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    @vite('resources/css/app.css')
    <title>Worshop Admin</title>
</head>
<body>
    <div class="flex">
        <div class="relative w-[298px] h-screen">
            <div class="fixed left-0 top-0 w-[298px] h-screen bg-gradient-to-b from-[#0D3771] to-[#FFFFFF] via-[#0D3771_20%] text-white p-4 space-y-6">
                <h1 class="w-full text-center text-3xl font-bold">
                    FEDERAL WEBSITE
                </h1>
                <div>
                    <h2 class="text-xl"> 
                        WEBSITE STOK DAN KASIR
                    </h2>
                    <p>
                        Menu Utama Aplikasi
                    </p>
                </div>
            </div>
        </div>
        <div>
            @yield('title-content')
            @yield('main-content')
        </div>
    </div>
</body>
</html>