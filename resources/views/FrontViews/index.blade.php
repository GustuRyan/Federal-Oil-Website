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
                
                {{-- Queue Card --}}
                
                <div class="w-fit h-fit bg-light-red mr-24 rounded-lg shadow-lg p-8 grid grid-cols-2 gap-x-8 gap-y-16">
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
                        <div class="text-5xl space-y-3">
                            <p>08</p>
                            <p>09</p>
                            <p>10</p>
                            <p>11</p>
                        </div>
                    </div>
                    <div class="font-bold text-bold-blue w-fit space-y-12">
                        <div class="flex gap-2">
                            <h1 class="text-2xl ">
                                Antrean <br>
                                Selanjutnya
                            </h1>
                            <input type="number" class="px-2 rounded-md w-28 h-16 text-[64px] leading-none appearance-none border-none outline-none bg-transparent hover:bg-light-blue" value="08">
                        </div>
                        <button id="nextQueue" class="bg-primary-green rounded-lg text-white text-xl font-semibold p-3 hover:opacity-80"> 
                            Pilih Antrean
                        </button>
                    </div>
                    <div class="text-2xl font-bold text-bold-blue w-fit space-y-5">
                        <h1>
                            Edit Daftar Antrean
                        </h1>
                        <div class="flex flex-col gap-2">
                            <button id="addQueue" class="w-52 bg-bold-blue rounded-lg text-white text-xl font-semibold p-3 hover:opacity-80">
                                Tambah Antrean +
                            </button>
                            <button id="deleteQueue" class="w-52 bg-bold-red rounded-lg text-white text-xl font-semibold p-3 hover:opacity-80">
                                Hapus Antrean -
                            </button>
                        </div>
                    </div>
                </div>
                
                {{-- End of Queue Card --}}

            </div>
        </div>
        <div class="w-full bg-light-red p-12 space-y-8 text-xl font-semibold">
            <div class="flex justify-between">
                <div class="space-x-2">
                    <label for="">Nomor Invoice</label>
                    <input type="text" class="p-3 rounded-md border-2">
                </div>
                <div class="space-x-2">
                    <label for="">Nomor Polisi</label>
                    <input type="text" class="p-3 rounded-md border-2">
                </div>
                <div class="space-x-2">
                    <label for="">Tanggal</label>
                    <input type="text" class="p-3 rounded-md border-2">
                </div>
            </div>
        </div>
    </div>
</body>
</html>