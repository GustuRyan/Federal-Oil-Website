@extends('backviews.layouts.main')
@section('title-content')
    <div class="flex items-center gap-4">
        <a href="{{route('admin.income.index')}}">
            <img src="/icons/icon_arrow_back.svg" class="w-8">
        </a>
        <div>
            DETAIL PEMASUKAN
        </div>
    </div>    
@endsection
@section('main-content')
    <div class="space-y-16">
        <div class="space-y-4">
            <div class="w-full flex justify-between items-center text-2xl font-bold text-bold-blue p-3 rounded-md bg-blue-50">
                <h2>Total Keuntungan dari Produk</h2>
                <p>Rp. {{ number_format($totalCostProduct, 0, ',', '.') }}</p>
            </div>
            <div>
                <table class="w-full border rounded-xl">
                    <thead>
                        <tr align="center" class="text-[#515769] bg-slate-100">
                                <th>No</th>
                                <th>Kode Barang</th>
                                <th>Nama Barang</th>
                                <th>Jumlah</th>
                                <th>Harga</th>
                                <th>Action</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($products as $index => $item)
                            <tr>
                                <td>{{ $index + 1 }}</td>
                                    <form action="{{ route('update.cart', ['id' => $item->id]) }}" method="POST">
                                        @csrf
                                        @method('PUT')
                                        <td>{{ $item->product->product_code }}</td>
                                        <td>{{ $item->product->product_name }}</td>
                                        <td align="center">
                                            <input type="number" name="amount" value="{{ $item->amount ?? '-' }}"
                                                class="w-24 bg-slate-100 p-2 rounded-md">
                                        </td>
                                        <td>Rp. {{ number_format($item->product->selling_price, 0, ',', '.') }}</td>
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
                            </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
        </div>
        <div class="space-y-4">
                <div class="w-full flex justify-between items-center text-2xl font-bold text-bold-blue p-3 rounded-md bg-blue-50">
                    <h2>Total Keuntungan dari Servis</h2>
                    <p>Rp. {{ number_format($totalCostService, 0, ',', '.') }}</p>
                </div>
                <div>
                    <table class="w-full border rounded-xl">
                        <thead>
                            <tr align="center" class="text-[#515769] bg-slate-100">
                                    <th>No</th>
                                    <th>Kode Service</th>
                                    <th>Nama Service</th>
                                    <th>Waktu</th>
                                    <th>Harga</th>
                                    <th>Action</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($services as $index => $item)
                                <tr>
                                    <td>{{ $index + 1 }}</td>
                                        <form action="{{ route('update.cart', ['id' => $item->id]) }}" method="POST">
                                            @csrf
                                            @method('PUT')
                                            <td>{{ $item->service->service_code }}</td>
                                            <td>{{ $item->service->service_name }}</td>
                                            <td align="center">
                                                <input type="number" name="service_time" value="{{ $item->service_time ?? '-' }}"
                                                    class="w-16 bg-slate-100 p-2 rounded-md"> Menit
                                            </td>
                                            <td>Rp. {{ number_format($item->service->service_price, 0, ',', '.') }}</td>
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
                                </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
        </div>
    </div>
@endsection