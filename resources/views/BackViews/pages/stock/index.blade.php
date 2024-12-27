@extends('backviews.layouts.main')
@section('title-content')
    STOK
@endsection
@section('main-content')
    <div class="w-full space-y-4">
        <div class="w-full flex justify-between">
            <h1 class="text-3xl font-bold text-bold-blue">
                Daftar Barang
            </h1>
            <form class="flex items-center">
                <input type="text" class="w-[28vw] h-8 p-4 rounded-l-lg bg-[#ECEDF3] border" placeholder="Cari disini...">
                <button class="w-12 h-8 p-4 border border-bold-blue bg-bold-blue rounded-r-lg flex justify-center items-center hover:opacity-85">
                    <img src="/icons/icon_search.svg" alt="" class="w-5 h-5">
                </button>
            </form>
            <div class="flex gap-3 font-bold">
                <select name="" id="" class="w-28 h-9 p-1 bg-primary-green rounded-lg text-white flex justify-center items-center hover:opacity-85">
                    <option value="" class="text-white">
                        Kategori
                    </option>
                </select>
                <a href="{{route('admin.stocks.create')}}" class="w-28 h-9 py-1 px-2 bg-bold-blue rounded-lg text-white flex justify-between items-center hover:opacity-85">
                    Tambah
                    <img src="/icons/icon_plus.svg" alt="" class="w-4 h-4">
                </a>
            </div>
        </div>
        <div class="w-[77vw] grid grid-cols-3 xl:grid-cols-4 2xl:grid-cols-5 gap-8 p-2">
            <livewire:admin.product-card/>
            <livewire:admin.product-card/>
            <livewire:admin.product-card/>
            <livewire:admin.product-card/>
            <livewire:admin.product-card/>
            <livewire:admin.product-card/>
            <livewire:admin.product-card/>
            <livewire:admin.product-card/>
        </div>
    </div>
@endsection
