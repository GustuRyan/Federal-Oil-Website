@php
    $percentage = $product->first_stocks > 0 
        ? ($product->latest_stock / $product->first_stocks) * 100 
        : 0;
@endphp
<div class="shadow-md bg-white w-fit rounded-lg">
    <img src="/example_image.png" alt="" class="w-full content-center rounded-t-lg">
    <div class="p-4 space-y-3 w-full">
        <div class="space-y-2 w-full">
            <div class="w-full flex justify-between">
                <h2 class="text-xl font-bold w-40">
                    {{ $product->product_name }}
                </h2>
                <p class="@if ($percentage > 50)
                        text-primary-green
                    @elseif ($percentage > 30)
                        text-yellow-600
                    @else
                        text-red-500
                    @endif text-lg font-bold">x{{ $product->latest_stock }}</p>
            </div>
            <div class="w-full flex justify-between">
                <p>{{ $product->product_category }}</p>
                <p>Rp. {{ number_format($product->selling_price, 0, ',', '.') }}</p>
            </div>
        </div>
        <p class="line-clamp-2">
            {{ $product->description ? $product->description : 'Deskripsi untuk produk ini belum dimasukkan pada saat ini.' }}
        </p>
        <div class="flex justify-center gap-3">
            <a href="{{ route('admin.stocks.detail', ['id' => $product->id]) }}"
                class="w-12 h-12 rounded-full bg-bold-blue flex justify-center items-center hover:opacity-85">
                <img src="/icons/icon_detail.svg" alt="" class="w-6 h-6">
            </a>
            <a href="{{ route('admin.stocks.update', ['id' => $product->id]) }}"
                class="w-12 h-12 rounded-full bg-[#F7C443] flex justify-center items-center hover:opacity-85">
                <img src="/icons/icon_edit.svg" alt="" class="w-6 h-6">
            </a>
            <form id="deleteForm-{{ $product->id }}" action="{{ route('delete.product', $product->id) }}" method="POST">
                @csrf
                @method('DELETE')
                <button type="button" onclick="confirmDelete('{{ $product->id }}', '{{ $product->product_name }}')" class="w-12 h-12 rounded-full bg-bold-red flex justify-center items-center hover:opacity-85">
                    <img src="/icons/icon_delete.svg" alt="" class="w-5 h-5">
                </button>
            </form>
        </div>
    </div>
</div>

<script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
<script>
    function confirmDelete(itemId, customerName) {
        Swal.fire({
            title: 'Anda yakin menghapus ' + customerName + '?',
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
</script>