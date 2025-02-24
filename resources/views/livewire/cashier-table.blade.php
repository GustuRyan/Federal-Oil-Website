<div class="space-y-5 w-full lg:w-[93%] text-lg">
    <div class="rounded-xl p-6 flex justify-between bg-light-red">
        @if ($type == 'service')
            <h1 class="text-3xl font-bold text-bold-blue flex items-center">
                Tabel Servis
            </h1>
            <button wire:click="toggleServiceForm"
                class="rounded-xl bg-primary-green p-3 flex items-center gap-2 text-white font-bold hover:opacity-85">
                <p>Tambah Baru</p>
                <p class="text-3xl leading-none">+</p>
            </button>
        @else
            <h1 class="text-3xl font-bold text-bold-blue flex items-center">
                Tabel Barang
            </h1>
            <button wire:click="toggleProductForm"
                class="rounded-xl bg-primary-green p-3 flex items-center gap-2 text-white font-bold hover:opacity-85">
                <p>Tambah Baru</p>
                <p class="text-3xl leading-none">+</p>
            </button>
        @endif
    </div>

    <!-- Tabel -->
    <div>
        <table class="w-full border rounded-xl">
            <thead>
                <tr align="center" class="text-[#515769] bg-slate-100">
                    @if ($type == 'service')
                        <th>No</th>
                        <th>Kode Service</th>
                        <th>Nama Service</th>
                        <th>Waktu</th>
                        <th>Harga</th>
                        <th>Action</th>
                    @else
                        <th>No</th>
                        <th>Kode Barang</th>
                        <th>Nama Barang</th>
                        <th>Jumlah</th>
                        <th>Harga</th>
                        <th>Action</th>
                    @endif
                </tr>
            </thead>
            <tbody>
                @foreach ($items as $index => $item)
                    <tr>
                        <td>{{ $index + 1 }}</td>
                        @if ($type == 'service')
                            <form action="{{ route('update.cart', ['id' => $item->id]) }}" method="POST">
                                @csrf
                                @method('PUT')
                                <td>{{ $item->service->service_code }}</td>
                                <td>{{ $item->service->service_name }}</td>
                                <td align="center">
                                    <input type="number" name="service_time" value="{{ $item->service_time ?? '-' }}"
                                        class="w-16 bg-slate-100 p-2 rounded-md"> Menit
                                </td>
                                <td>
                                    Rp. 
                                    <input type="number" name="price" value="{{ $item->price }}" class="bg-slate-100 p-2 rounded-md">
                                </td>
                                <td align="center">
                                    <div class="flex gap-2 justify-center">
                                        <button type="submit"
                                            class="w-fit h-12 py-1 px-2 bg-[#F7C443] rounded-lg text-white flex justify-between items-center gap-2 hover:opacity-85">
                                            <img src="/icons/icon_edit.svg" alt="" class="w-5 h-5">
                                            Simpan Edit
                                        </button>

                            </form>
                            <form id="deleteForm-{{ $item->id }}" action="{{ route('delete.cart', ['id' => $item->id]) }}" method="POST">
                                @csrf
                                @method('DELETE')
                                <button type="button" onclick="confirmDelete('{{ $item->id }}', '{{ $item->service->service_name }}')"
                                    class="w-fit h-12 py-1 px-2 rounded-lg bg-bold-red text-white flex justify-center items-center gap-2 hover:opacity-85">
                                    <img src="/icons/icon_delete.svg" alt="" class="w-5 h-5">
                                    Delete
                                </button>
                            </form>
                                    </div>
                                </td>
                        @else
                            <form action="{{ route('update.cart', ['id' => $item->id]) }}" method="POST">
                                @csrf
                                @method('PUT')
                                <td>{{ $item->product->product_code }}</td>
                                <td>{{ $item->product->product_name }}</td>
                                <td align="center">
                                    <input 
                                        type="number" 
                                        name="amount" 
                                        value="{{ $item->amount ?? '1' }}" 
                                        class="w-24 bg-slate-100 p-2 rounded-md"
                                        max="{{ $item->product->latest_stock ?? 1 }}" 
                                        min="1"
                                        required>
                                </td>
                                <td>Rp. 
                                    <input type="number" name="price" value="{{ $item->price }}" class="bg-slate-100 p-2 rounded-md">
                                </td>
                                <td align="center">
                                    <div class="flex gap-2 justify-center">
                                        <button type="submit"
                                            class="w-fit h-12 py-1 px-2 bg-[#F7C443] rounded-lg text-white flex justify-between items-center gap-2 hover:opacity-85">
                                            <img src="/icons/icon_edit.svg" alt="" class="w-5 h-5">
                                            Simpan Edit
                                        </button>
                            </form>
                            <form id="deleteFormProd-{{ $item->id }}" action="{{ route('delete.cart', ['id' => $item->id]) }}" method="POST">
                                @csrf
                                @method('DELETE')
                                <button type="button" onclick="confirmDeleteProd('{{ $item->id }}', '{{ $item->product->product_name }}')"
                                    class="w-fit h-12 py-1 px-2 rounded-lg bg-bold-red text-white flex justify-center items-center gap-2 hover:opacity-85">
                                    <img src="/icons/icon_delete.svg" alt="" class="w-5 h-5">
                                    Delete
                                </button>
                            </form>
                                    </div>
                                </td>
                        @endif
                    </tr>
                @endforeach
            </tbody>
        </table>
        <div class="w-full border-x-[3px] border-b-[3px] flex items-center justify-end p-4 font-bold text-xl">
            Sub Total: 
            <div class="ml-3 p-2 border-2 rounded-md font-normal">
                Rp. {{ number_format($sub_total, 0, ',', '.') }}
            </div>
        </div>
    </div>
    
<!-- Form Servis -->
@if ($isServiceFormVisible)
    <div class="fixed inset-0 z-50">
        <!-- Overlay untuk mendeteksi klik -->
        <div wire:click="toggleServiceForm" class="fixed inset-0 bg-gray-800 opacity-45 z-40"></div>
        <!-- Pop-up -->
        <div class="fixed inset-0 z-50 flex items-center justify-center">
            <div class="bg-white p-8 rounded-lg shadow-md space-y-4">
                <div class="flex w-full items-center justify-between pb-2">
                    <h2 class="font-bold text-2xl">
                        Daftar Servis
                    </h2>
                    <button wire:click="toggleServiceForm">
                        <img src="/icons/icon_close.svg" alt="" class="w-5 h-5">
                    </button>
                </div>
                <livewire:cashier-service-form />
            </div>
        </div>
    </div>
@endif

<!-- Form Produk -->
@if ($isProductFormVisible)
    <div class="fixed inset-0 z-50">
        <!-- Overlay untuk mendeteksi klik -->
        <div wire:click="toggleProductForm" class="fixed inset-0 bg-gray-800 opacity-45 z-40"></div>
        <!-- Pop-up -->
        <div class="fixed inset-0 z-50 flex items-center justify-center">
            <div class="bg-white p-8 rounded-lg shadow-md space-y-4">
                <div class="flex w-full items-center justify-between pb-2">
                    <h2 class="font-bold text-2xl">
                        Daftar Produk
                    </h2>
                    <button wire:click="toggleProductForm">
                        <img src="/icons/icon_close.svg" alt="" class="w-5 h-5">
                    </button>
                </div>
                <livewire:cashier-product-form />
            </div>
        </div>
    </div>
@endif

</div>
<script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
<script>
    function confirmDelete(itemId, serviceName) {
        Swal.fire({
            title: 'Anda yakin menghapus ' + serviceName + '?',
            text: "Data yang dihapus tidak dapat dikembalikan!",
            icon: 'warning',
            showCancelButton: true,
            confirmButtonColor: '#d33',
            cancelButtonColor: '#3085d6',
            confirmButtonText: 'Ya, hapus!',
            cancelButtonText: 'Batal'
        }).then((result) => {
            if (result.isConfirmed) {
                document.getElementById(`deleteForm-${itemId}`).submit();
            }
        });
    }

    function confirmDeleteProd(itemId, productName) {
        Swal.fire({
            title: 'Anda yakin menghapus ' + productName + '?',
            text: "Data yang dihapus tidak dapat dikembalikan!",
            icon: 'warning',
            showCancelButton: true,
            confirmButtonColor: '#d33',
            cancelButtonColor: '#3085d6',
            confirmButtonText: 'Ya, hapus!',
            cancelButtonText: 'Batal'
        }).then((result) => {
            if (result.isConfirmed) {
                document.getElementById(`deleteFormProd-${itemId}`).submit();
            }
        });
    }
</script>