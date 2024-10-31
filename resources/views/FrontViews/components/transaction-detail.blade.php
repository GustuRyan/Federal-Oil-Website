<div class="w-[36%]">
    <form class="bg-light-blue rounded-xl shadow-lg w-full text-lg">
        <div class="space-y-4 p-6">

            <div class="w-full pb-3 border-b-[3px] border-[#C3C1C7] text-bold-blue text-2xl font-bold">
                Detail Transaksi
            </div>
            <div class="space-y-2">
                <h2 class="text-xl font-semibold text-bold-blue">
                    Km Kendaraan
                </h2>
                <div class="w-full rounded-xl shadow-md flex justify-between gap-3 p-3 bg-white">
                    <div class="flex gap-2">
                        <p>
                            Sekarang:
                        </p>
                        <input type="number" class="w-24 appearance-none border-none outline-none">
                    </div>
                    <div class="h-[100] w-[2px] rounded-full bg-[#EDEDED]"></div>
                    <div class="flex gap-2">
                        <p>
                            Berikut:
                        </p>
                        <input type="number" class="w-24 appearance-none border-none outline-none">
                    </div>
                </div>
            </div>
            <div class="space-y-2">
                <h2 class="text-xl font-semibold text-bold-blue">
                    Status
                </h2>
                <div class="w-full rounded-xl shadow-md flex justify-between p-3 bg-white">
                    <select name="" id="" class="w-full">
                        <option value="">
                            Diproses
                        </option>
                        <option value="">
                            Pending
                        </option>
                        <option value="">
                            Selesai
                        </option>
                    </select>
                </div>
            </div>
            <div class="space-y-2">
                <h2 class="text-xl font-semibold text-bold-blue">
                    Keterangan (Keluhan)
                </h2>
                <div class="w-full rounded-xl shadow-md flex justify-between bg-white">
                    <textarea name="" id="" class="w-full h-28 p-3 rounded-xl" placeholder="masukan keterangan service disini..."></textarea>
                </div>
            </div>
            <div class="w-full h-[3px] bg-[#C3C1C7]"></div>
            <div class="space-y-3">
                <div class="w-full flex justify-between items-center">
                    <h2 class="text-xl font-semibold text-bold-blue">
                        Jasa Mekanik
                    </h2>
                    <button class="rounded-xl bg-primary-green text-white font-semibold p-2 hover:opacity-85">
                        Tambah +
                    </button>
                </div>
                <div class="w-full rounded-xl shadow-md justify-between bg-white space-y-3 p-3">
                    <div class="flex justify-between py-4">
                        <p>1. Wawan</p>
                        <div class="h-[100] w-[2px] rounded-full bg-[#EDEDED]"></div>
                        <div class="flex justify-between w-[32%]">
                            <p>Biaya:</p>
                            <p>15.000</p>
                        </div>
                    </div>
                    <div class="w-full h-[2px] bg-[#E6E6E6]"></div>
                    <div class="w-full flex justify-between">
                        <h2 class="font-bold text-bold-blue"> 
                            Total biaya jasa
                        </h2>
                        <p>
                            15.000
                        </p>
                    </div>
                </div>
            </div>
            <div class="w-full h-[3px] bg-[#C3C1C7]"></div>
            <div class="space-y-3">
                <h2 class="text-xl font-semibold text-bold-blue">
                    Total Biaya Transaksi
                </h2>
                <div class="w-full rounded-xl shadow-md justify-between bg-white space-y-3 p-3">
                    <div class="flex justify-between">
                        <p>Sub Total</p>
                        <p>15.000</p>
                    </div>
                    <div class="flex justify-between">
                        <p>Potongan Fakur</p>
                        <p>15.000</p>
                    </div>
                    <div class="flex justify-between">
                        <p>Pajak</p>
                        <p>15.000</p>
                    </div>
                    <div class="w-full h-[2px] bg-[#E6E6E6]"></div>
                    <div class="space-y-1">
                        <div class="w-full flex justify-between">
                            <h2 class="font-bold text-bold-blue">Total Keseluruhan</h2>
                            <p>15.000</p>
                        </div>
                        <div class="w-full flex justify-between">
                            <h2 class="font-semibold text-bold-blue">Jumlah Bayar</h2>
                            <p>15.000</p>
                        </div>
                        <div class="w-full flex justify-between">
                            <h2 class="font-semibold text-bold-blue">Kembalian</h2>
                            <p>15.000</p>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="bg-white p-6 rounded-b-lg flex justify-end">
            <button class="rounded-xl bg-primary-green text-white font-semibold p-3 hover:opacity-85">
                Checkout
            </button>
        </div>
    </form>
</div>