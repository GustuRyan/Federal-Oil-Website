<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    @vite('resources/css/app.css')
    <title>Workshop Website</title>
</head>
<body>
    <div class="relative w-full">
        <div class="fixed bottom-0 right-0 font-bold z-30 p-4">
            <a href="{{ route('admin.dashboard') }}" class="py-2 px-4 bg-bold-blue rounded-full text-lg text-white text-center opacity-50 hover:opacity-100">
                Panel 
                Admin
            </a>
        </div>
        <div class="relative">
            <img src="/workshop-hero.png" alt="Hero Image" class="w-full h-screen object-cover">
            <div class="absolute left-0 top-0 w-full h-screen bg-gradient-to-r from-[rgba(238,46,69,0.75)] to-[rgba(238,46,69,0.25)] flex items-center justify-end">
                
                {{-- Queue Card --}}
                
                <div class="w-fit h-fit bg-light-red mr-24 rounded-lg shadow-lg p-8 grid grid-cols-2 gap-x-12 gap-y-16">
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

        {{-- Customer's Data --}}

        <form class="w-full bg-light-red p-12 space-y-8 text-xl font-semibold">
            <div class="grid grid-cols-3  gap-x-12">
                <div class="space-x-2 flex items-center justify-between">
                    <label for="">Nomor Invoice</label>
                    <input type="text" class="p-3 rounded-md border-2">
                </div>
                <div class="space-x-2 flex items-center justify-between">
                    <label for="">Nomor Polisi</label>
                    <input type="text" class="p-3 rounded-md border-2">
                </div>
                <div class="space-x-2 flex items-center justify-between">
                    <label for="">Tanggal</label>
                    <input type="text" class="p-3 rounded-md border-2">
                </div>
            </div>
            <div class="grid grid-cols-3  gap-x-12">
                <div class="space-x-2 flex items-center justify-between">
                    <label for="">Pemilik</label>
                    <input type="text" class="p-3 rounded-md border-2">
                </div>
                <div class="space-x-2 flex items-center justify-between">
                    <label for="">Merk/Tipe</label>
                    <input type="text" class="p-3 rounded-md border-2">
                </div>
                <div class="space-x-2 flex items-center justify-between">
                    <label for="">Nomor Rangka</label>
                    <input type="text" class="p-3 rounded-md border-2">
                </div>
            </div>
            <div class="grid grid-cols-3  gap-x-12">
                <div class="space-x-2 flex items-center justify-between">
                    <label for="">Jenis</label>
                    <input type="text" class="p-3 w- rounded-md border-2">
                </div>
                <div class="space-x-2 flex items-center justify-between">
                    <label for="">Warna</label>
                    <input type="text" class="p-3 rounded-md border-2">
                </div>
                <div class="space-x-2 flex items-center justify-between">
                    <label for="">Nomor Mesin</label>
                    <input type="text" class="p-3 rounded-md border-2">
                </div>
            </div>
        </form>

        {{-- End of Customer's Data --}}

        {{-- Vehicle's Data --}}

        <div class="p-12 flex justify-between gap-12">
            
            <div class="space-y-12 w-full">
                <livewire:cashier-table/>
                
                <livewire:cashier-table/>
            </div>

            @include('frontviews.components.transaction-detail')

        </div>

        {{-- End of Vehicle's Data --}}
        
    </div>
</body>
</html>