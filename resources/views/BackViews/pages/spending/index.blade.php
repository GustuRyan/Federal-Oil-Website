@extends('backviews.layouts.main')
@section('title-content')
    PENGELUARAN
@endsection
@section('main-content')
    <div class="w-full space-y-9">
        <div class="w-full grid grid-cols-4 gap-4 p-1">
            <livewire:admin.cashflow-card />
            <livewire:admin.cashflow-card />
            <livewire:admin.cashflow-card />
            <livewire:admin.cashflow-card />
        </div>
        <div class="w-full flex justify-between">
            <h1 class="text-3xl font-bold text-bold-blue">
                Daftar Pengeluaran
            </h1>
            <form class="flex items-center">
                <input type="text" class="w-[28vw] h-8 p-4 rounded-l-lg bg-[#ECEDF3] border" placeholder="Cari disini...">
                <button
                    class="w-12 h-8 p-4 border border-bold-blue bg-bold-blue rounded-r-lg flex justify-center items-center hover:opacity-85">
                    <img src="/icons/icon_search.svg" alt="" class="w-5 h-5">
                </button>
            </form>
            <div class="flex gap-3 font-bold">
                <select name="" id=""
                    class="w-28 h-9 p-1 bg-primary-green rounded-lg text-white flex justify-center items-center hover:opacity-85">
                    <option value="" class="text-white">
                        Ascending
                    </option>
                </select>
                <select name="" id=""
                    class="w-28 h-9 p-1 bg-primary-green rounded-lg text-white flex justify-center items-center hover:opacity-85">
                    <option value="" class="text-white">
                        Bulan
                    </option>
                </select>
            </div>
        </div>
        <livewire:admin.table />
    </div>
@endsection
