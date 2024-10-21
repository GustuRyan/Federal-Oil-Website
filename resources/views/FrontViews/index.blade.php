<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    @vite('resources/css/app.css')
    <title>Worshop Website</title>
</head>
<body>
    <div class="w-full">
        <div class="relative">
            <img src="/workshop-hero.png" alt="Hero Image" class="w-full h-screen object-cover">
            <div class="absolute left-0 top-0 w-full h-screen bg-gradient-to-r from-[rgba(238,46,69,0.75)] to-[rgba(238,46,69,0.25)] flex items-center justify-end">
                <div class="w-[42%] h-fit bg-light-red mr-24 rounded-md shadow-lg p-8 grid grid-cols-2 gap-8">
                    <div class="font-bold text-bold-blue">
                        <h1 class="text-2xl">
                            Antrean Sekarang
                        </h1>
                        <p class="text-[192px] leading-none">
                            07
                        </p>
                    </div>
                    <div class="text-2xl font-bold text-bold-blue w-fit space-y-4">
                        <h1>
                            Daftar Antrean
                        </h1>
                        <p class="text-5xl">
                            08 <br> 
                            09 <br>
                            10 <br>
                            11 <br>
                        </p>
                    </div>
                    <div class="font-bold text-bold-blue w-fit">
                        <div class="flex gap-4">
                            <h1 class="text-2xl ">
                                Antrean <br>
                                Selanjutnya
                            </h1>
                            <input type="number" class="w-24 text-[64px] leading-none appearance-none border-none outline-none bg-transparent" value="08">
                        </div>
                    </div>
                    <div class="text-2xl font-bold text-bold-blue w-fit">
                        Test 1
                    </div>
                </div>
            </div>
        </div>
    </div>
</body>
</html>