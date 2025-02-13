@extends('backviews.layouts.main')
@section('title-content')
    <div class="flex items-center gap-4">
        <a href="{{ route('admin.stocks.index') }}">
            <img src="/icons/icon_arrow_back.svg" class="w-8">
        </a>
        <div>
            PERBARUI STOK
        </div>
    </div>
@endsection
@section('main-content')
    <form action="{{ route('update.product', $product->id) }}" method="POST">
        @csrf
        @method('PUT') <!-- Tambahkan method PUT untuk update -->
        <div class="flex flex-col">
            <label for="product_code" class="font-bold text-slate-700 mb-2.5">Kode Produk *</label>
            <input type="number" id="product_code" name="product_code" placeholder="Masukkan kode produk"
                value="{{ old('product_code', $product->product_code) }}"
                class="p-3 border border-black text-base rounded-md mb-5" required>

            <label for="product_name" class="font-bold text-slate-700 mb-2.5">Nama Produk *</label>
            <input type="text" id="product_name" name="product_name" placeholder="Masukkan nama produk"
                value="{{ old('product_name', $product->product_name) }}"
                class="p-3 border border-black text-base rounded-md mb-5" required>

            <label for="product_category" class="font-bold text-slate-700 mb-2.5">Kategori Produk *</label>
            <input type="text" id="product_category" name="product_category" placeholder="Masukkan kategori produk"
                value="{{ old('product_category', $product->product_category) }}"
                class="p-3 border border-black text-base rounded-md mb-5" required>

            <label for="brand" class="font-bold text-slate-700 mb-2.5">Merek</label>
            <input type="text" id="brand" name="brand" placeholder="Masukkan merek (opsional)"
                value="{{ old('brand', $product->brand) }}" class="p-3 border border-black text-base rounded-md mb-5">

            <label for="model" class="font-bold text-slate-700 mb-2.5">Model *</label>
            <input type="text" id="model" name="model" placeholder="Masukkan model produk"
                value="{{ old('model', $product->model) }}" class="p-3 border border-black text-base rounded-md mb-5"
                required>

            <div class="flex gap-8">
                <div class="w-full">
                    <label for="first_stocks" class="font-bold text-slate-700 mb-2.5">Stok Awal *</label>
                    <input type="number" id="first_stocks" name="first_stocks" placeholder="Masukkan stok awal"
                        value="{{ old('first_stocks', $product->first_stocks) }}"
                        class="w-full p-3 border border-black text-base rounded-md mb-5" required oninput="validateStock()">
                </div>

                <div class="w-full">
                    <label for="latest_stock" class="font-bold text-slate-700 mb-2.5">Stok Terbaru *</label>
                    <input type="number" id="latest_stock" name="latest_stock" placeholder="Masukkan stok terbaru"
                        value="{{ old('latest_stock', $product->latest_stock) }}"
                        class="w-full p-3 border border-black text-base rounded-md mb-5" required oninput="validateStock()">
                </div>
            </div>

            <div class="flex gap-8">
                <div class="w-full">
                    <label for="buying_price" class="font-bold text-slate-700 mb-2.5">Harga Beli *</label>
                    <input type="number" step="0.01" id="buying_price" name="buying_price"
                        placeholder="Masukkan harga beli" value="{{ old('buying_price', $product->buying_price) }}"
                        class="w-full p-3 border border-black text-base rounded-md mb-5" required>
                </div>

                <div class="w-full">
                    <label for="selling_price" class="font-bold text-slate-700 mb-2.5">Harga Jual *</label>
                    <input type="number" step="0.01" id="selling_price" name="selling_price"
                        placeholder="Masukkan harga jual" value="{{ old('selling_price', $product->selling_price) }}"
                        class="w-full p-3 border border-black text-base rounded-md mb-5" required>
                </div>
            </div>

            <label for="unit_type" class="font-bold text-slate-700 mb-2.5">Jenis Satuan *</label>
            <input type="text" id="unit_type" name="unit_type" placeholder="Masukkan jenis satuan"
                value="{{ old('unit_type', $product->unit_type) }}"
                class="p-3 border border-black text-base rounded-md mb-5" required>

            <div class="flex gap-8">
                <div class="w-full">
                    <label for="in_date" class="font-bold text-slate-700 mb-2.5">Tanggal Masuk *</label>
                    <input type="date" id="in_date" name="in_date"
                        value="{{ old('in_date', date('Y-m-d', strtotime($product->in_date))) }}"
                        class="w-full p-3 border border-black text-base rounded-md mb-5" required>
                </div>

                <div class="w-full">
                    <label for="expired_date" class="font-bold text-slate-700 mb-2.5">Tanggal Kadaluarsa</label>
                    <input type="date" id="expired_date" name="expired_date"
                        value="{{ old('expired_date', $product->expired_date ?? '') }}"
                        class="w-full p-3 border border-black text-base rounded-md mb-5">
                </div>
            </div>

            <label for="description" class="font-bold text-slate-700 mb-2.5">Deskripsi</label>
            <textarea id="description" name="description" placeholder="Masukkan deskripsi produk (opsional)"
                class="p-3 border border-black text-base rounded-md mb-5">{{ old('description', $product->description) }}</textarea>

            <label for="shelf_location" class="font-bold text-slate-700 mb-2.5">Lokasi Rak</label>
            <input type="text" id="shelf_location" name="shelf_location" placeholder="Masukkan lokasi rak (opsional)"
                value="{{ old('shelf_location', $product->shelf_location) }}"
                class="p-3 border border-black text-base rounded-md mb-5">
        </div>
        <div class="flex justify-end">
            <button type="submit"
                class="mt-5 bg-blue-800 text-white text-xl font-bold py-4 px-6 rounded-lg hover:bg-blue-900 transition duration-300">SIMPAN</button>
        </div>
    </form>
@endsection
<script>
    function validateStock() {
        const firstStocks = document.getElementById('first_stocks').value;
        const latestStock = document.getElementById('latest_stock');

        const maxStock = parseInt(firstStocks, 10) || 0;
        const latestValue = parseInt(latestStock.value, 10) || 0;

        latestStock.max = maxStock;

        if (latestValue > maxStock) {
            latestStock.value = maxStock;
        }
    }
</script>
