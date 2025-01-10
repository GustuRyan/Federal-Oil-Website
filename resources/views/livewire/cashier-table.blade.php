<div class="space-y-5 w-full text-lg">
    <div class="rounded-xl p-6 flex justify-between bg-light-red">

        @if ($type == 'service')
            <h1 class="text-3xl font-bold text-bold-blue flex items-center">
                Tabel Servis
            </h1>
        @else
            <h1 class="text-3xl font-bold text-bold-blue flex items-center">
                Tabel Barang
            </h1>
        @endif
        <button class="rounded-xl bg-primary-green p-3 flex items-center gap-2 text-white font-bold hover:opacity-85">
            <p>
                Tambah Baru
            </p>
            <p class="text-3xl leading-none">
                +
            </p>
        </button>
    </div>
    <div>
        <table class="w-full border rounded-xl">
            <thead>
                <tr align="center" class="text-[#515769]">
                    <th>No</th>
                    <th>Kode Barang</th>
                    <th>Nama Barang</th>
                    <th>Jumlah</th>
                    <th>Harga</th>
                    <th>Action</th>
                </tr>
            </thead>
            <tbody>
                <tr>
                    <td>1</td>
                    <td>BR123</td>
                    <td>Ban Dunlop</td>
                    <td>2 Unit</td>
                    <td>500.000</td>
                    <td align="center">
                        <div class="flex gap-2 justify-center">
                            <a href=""
                                class="w-fit h-12 py-1 px-2 bg-bold-blue rounded-lg text-white flex justify-between items-center gap-2 hover:opacity-85">
                                <img src="/icons/icon_detail.svg" alt="" class="w-5 h-5">
                                Detail
                            </a>
                            <a href=""
                                class="w-fit h-12 py-1 px-2 bg-[#F7C443] rounded-lg text-white flex justify-between items-center gap-2 hover:opacity-85">
                                <img src="/icons/icon_edit.svg" alt="" class="w-5 h-5">
                                Edit
                            </a>
                            <a href=""
                                class="w-fit h-12 py-1 px-2 bg-bold-red rounded-lg text-white flex justify-between items-center gap-2 hover:opacity-85">
                                <img src="/icons/icon_delete.svg" alt="" class="w-5 h-5">
                                Delete
                            </a>
                        </div>
                    </td>
                </tr>
                <tr>
                    <td>1</td>
                    <td>BR123</td>
                    <td>Ban Dunlop</td>
                    <td>2 Unit</td>
                    <td>500.000</td>
                    <td align="center">
                        <div class="flex gap-2 justify-center">
                            <a href=""
                                class="w-fit h-12 py-1 px-2 bg-bold-blue rounded-lg text-white flex justify-between items-center gap-2 hover:opacity-85">
                                <img src="/icons/icon_detail.svg" alt="" class="w-5 h-5">
                                Detail
                            </a>
                            <a href=""
                                class="w-fit h-12 py-1 px-2 bg-[#F7C443] rounded-lg text-white flex justify-between items-center gap-2 hover:opacity-85">
                                <img src="/icons/icon_edit.svg" alt="" class="w-5 h-5">
                                Edit
                            </a>
                            <a href=""
                                class="w-fit h-12 py-1 px-2 bg-bold-red rounded-lg text-white flex justify-between items-center gap-2 hover:opacity-85">
                                <img src="/icons/icon_delete.svg" alt="" class="w-5 h-5">
                                Delete
                            </a>
                        </div>
                    </td>
                </tr>
                <tr>
                    <td>1</td>
                    <td>BR123</td>
                    <td>Ban Dunlop</td>
                    <td>2 Unit</td>
                    <td>500.000</td>
                    <td align="center">
                        <div class="flex gap-2 justify-center">
                            <a href=""
                                class="w-fit h-12 py-1 px-2 bg-bold-blue rounded-lg text-white flex justify-between items-center gap-2 hover:opacity-85">
                                <img src="/icons/icon_detail.svg" alt="" class="w-5 h-5">
                                Detail
                            </a>
                            <a href=""
                                class="w-fit h-12 py-1 px-2 bg-[#F7C443] rounded-lg text-white flex justify-between items-center gap-2 hover:opacity-85">
                                <img src="/icons/icon_edit.svg" alt="" class="w-5 h-5">
                                Edit
                            </a>
                            <a href=""
                                class="w-fit h-12 py-1 px-2 bg-bold-red rounded-lg text-white flex justify-between items-center gap-2 hover:opacity-85">
                                <img src="/icons/icon_delete.svg" alt="" class="w-5 h-5">
                                Delete
                            </a>
                        </div>
                    </td>
                </tr>
                <tr>
                    <td>1</td>
                    <td>BR123</td>
                    <td>Ban Dunlop</td>
                    <td>2 Unit</td>
                    <td>500.000</td>
                    <td align="center">
                        <div class="flex gap-2 justify-center">
                            <a href=""
                                class="w-fit h-12 py-1 px-2 bg-bold-blue rounded-lg text-white flex justify-between items-center gap-2 hover:opacity-85">
                                <img src="/icons/icon_detail.svg" alt="" class="w-5 h-5">
                                Detail
                            </a>
                            <a href=""
                                class="w-fit h-12 py-1 px-2 bg-[#F7C443] rounded-lg text-white flex justify-between items-center gap-2 hover:opacity-85">
                                <img src="/icons/icon_edit.svg" alt="" class="w-5 h-5">
                                Edit
                            </a>
                            <a href=""
                                class="w-fit h-12 py-1 px-2 bg-bold-red rounded-lg text-white flex justify-between items-center gap-2 hover:opacity-85">
                                <img src="/icons/icon_delete.svg" alt="" class="w-5 h-5">
                                Delete
                            </a>
                        </div>
                    </td>
                </tr>
                <tr>
                    <td>1</td>
                    <td>BR123</td>
                    <td>Ban Dunlop</td>
                    <td>2 Unit</td>
                    <td>500.000</td>
                    <td align="center">
                        <div class="flex gap-2 justify-center">
                            <a href=""
                                class="w-fit h-12 py-1 px-2 bg-bold-blue rounded-lg text-white flex justify-between items-center gap-2 hover:opacity-85">
                                <img src="/icons/icon_detail.svg" alt="" class="w-5 h-5">
                                Detail
                            </a>
                            <a href=""
                                class="w-fit h-12 py-1 px-2 bg-[#F7C443] rounded-lg text-white flex justify-between items-center gap-2 hover:opacity-85">
                                <img src="/icons/icon_edit.svg" alt="" class="w-5 h-5">
                                Edit
                            </a>
                            <a href=""
                                class="w-fit h-12 py-1 px-2 bg-bold-red rounded-lg text-white flex justify-between items-center gap-2 hover:opacity-85">
                                <img src="/icons/icon_delete.svg" alt="" class="w-5 h-5">
                                Delete
                            </a>
                        </div>
                    </td>
                </tr>
            </tbody>
        </table>
        <div class="w-full p-6 flex justify-end gap-4 text-lg text-bold-blue font-semibold border-[3px] border-t-0">
            <div class="flex items-center gap-2">
                <p>Subtotal</p>
                <div class="border-2 rounded-lg p-3 w-40">
                    Rp. 250.000
                </div>
            </div>
        </div>
    </div>
</div>