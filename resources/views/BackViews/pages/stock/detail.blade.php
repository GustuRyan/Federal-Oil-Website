@extends('backviews.layouts.main')
@section('title-content')
    <div class="flex items-center gap-4">
        <a href="{{ route('admin.stocks.index') }}">
            <img src="/icons/icon_arrow_back.svg" class="w-8">
        </a>
        <div>
            DETAIL STOK
        </div>
    </div>
@endsection
@section('main-content')
    <div class="flex items-center justify-between">
        <h1 class="text-4xl font-bold leading-none">
            {{ $product->product_name }}
        </h1>
        <p class="text-xl ">
            Kode Produk: {{ $product->product_code }}
        </p>
    </div>
    <div class="flex items-center justify-between mt-8">
        <p class="text-xl font-bold">
            Kategori Produk: {{ $product->product_category }}
        </p>
        <p class="text-xl font-bold">
            Brand Produk: {{ $product->brand }}
        </p>
        <p class="text-xl font-bold">
            Model Produk: {{ $product->model }}
        </p>
    </div>
    <div class="flex items-center gap-16 mt-8 bg-slate-100 rounded-lg p-4">
        <p class="text-xl font-bold">
            Stok Awal Produk: {{ $product->first_stocks }}
        </p>
        <p class="text-xl font-bold">
            Stok Terakhir Produk: {{ $product->latest_stock }}
        </p>
        <p class="text-xl font-bold">
            Tempat Rak: {{ $product->shelf_location }}
        </p>
    </div>
    <div class="flex items-center gap-16 mt-8 bg-slate-100 rounded-lg p-4">
        <p class="text-xl">
            Harga Pembelian: Rp. {{ number_format($product->buying_price, 0, ',', '.') }}
        </p>
        <p class="text-xl">
            Harga Jual: Rp. {{ number_format($product->selling_price, 0, ',', '.') }}
        </p>
        <p class="text-xl">
            Tipe Unit Satuan: {{ $product->unit_type }}
        </p>
    </div>
    <div class="flex items-center justify-between mt-8">
        <p class="text-xl font-bold">
            Tanggal Masuk: {{ $product->in_date }}
        </p>
        <p class="text-xl font-bold">
            Tanggal Kadaluarsa: {{ $product->expired_date }}
        </p>
    </div>
    <div class="mt-8 bg-slate-100 rounded-lg p-4 text-xl">
        Deskripsi Produk
        <br><br>
        @if ($product->description)
            {{ $product->description }}
        @else
            <div class="w-full text-center pb-8">
                Tidak Ada Deskripsi Saat Ini
            </div>
        @endif
    </div>
@endsection
