@extends('backviews.layouts.main')
@section('js')
    <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/apexcharts"></script>
    {!! $chartData->script() !!}
    {!! $chartRevenue->script() !!}
@endsection

@section('title-content')
    PEMASUKAN
@endsection
@php
    $headers = [
        'Invoice',
        'Pelanggan',
        'Total Pemasukan',
        'Metode Pembayaran',
        'Status Pembayaran',
        'Deskripsi',
        'Action',
    ];
@endphp
@section('main-content')
    @if (session('success'))
        <div id="success-message" class="w-full flex items-center justify-center mb-4">
            <div class="w-full p-2 rounded-xl shadow-md bg-green-200">
                <div class="bg-green-200 text-xl font-bold text-green-700 p-4 rounded">
                    {{ session('success') }}
                </div>
            </div>
        </div>
    @endif
    <div class="w-full max-w-[760px] xl:max-w-full space-y-9">
        <div class="w-full overflow-x-scroll scrollbar-hide">
            <div class="min-w-[900px] grid grid-cols-4 gap-4 p-1 ">
                @foreach ($cardResources as $item)
                    <livewire:admin.cashflow-card :title="$item['title']" :value="$item['value']" :time="$item['time']" />
                @endforeach
            </div>
        </div>
        <div class="w-full flex flex-col lg:flex-row gap-4">
            <div class="w-full p-4 space-y-12 font-semibold rounded-lg shadow-md border bg-white">
                {!! $chartData->container() !!}
            </div>
            <div class="w-full p-4 space-y-12 font-semibold rounded-lg shadow-md border bg-white">
                {!! $chartRevenue->container() !!}
            </div>
        </div>
        <form action="{{ route('admin.income.index') }}" class="w-full flex flex-col md:flex-row lg:items-center justify-between gap-3">
            <h1 class="w-36 lg:w-fit text-3xl font-bold text-bold-blue flex items-center leading-none">
                Daftar Pemasukan
            </h1>
            <div class="flex items-center">
                <input type="text" class="w-full md:w-[28vw] p-2 rounded-l-lg bg-[#ECEDF3] border" name="search"
                    placeholder={{ $searchTerm ? $searchTerm : 'Cari disini...' }}>
                <button type="submit"
                    class="w-12 p-2 border border-bold-blue bg-bold-blue rounded-r-lg flex justify-center items-center hover:opacity-85">
                    <img src="/icons/icon_search.svg" alt="" class="w-5 h-6">
                </button>
            </div>
            <div class="flex flex-col xl:flex-row gap-3 font-bold">
                <select name="method" id=""
                    class="w-36 h-9 p-1 bg-primary-green rounded-lg text-white flex justify-center items-center hover:opacity-85"
                    onchange="this.form.submit()">
                    <option value="all" class="text-white" {{ request('method') == 'all' ? 'selected' : '' }}>
                        Semua Metode
                    </option>
                    <option value="tunai" class="text-white" {{ request('method') == 'tunai' ? 'selected' : '' }}>
                        Tunai
                    </option>
                    <option value="transfer" class="text-white" {{ request('method') == 'transfer' ? 'selected' : '' }}>
                        Transfer
                    </option>
                    <option value="kredit" class="text-white" {{ request('method') == 'kredit' ? 'selected' : '' }}>
                        Kredit
                    </option>
                </select>

                <select name="status" id=""
                    class="w-36 h-9 p-1 bg-primary-green rounded-lg text-white flex justify-center items-center hover:opacity-85"
                    onchange="this.form.submit()">
                    <option value="all" class="text-white" {{ request('status') == 'all' ? 'selected' : '' }}>
                        Semua Status
                    </option>
                    <option value="lunas" class="text-white" {{ request('status') == 'lunas' ? 'selected' : '' }}>
                        Lunas
                    </option>
                    <option value="belum lunas" class="text-white"
                        {{ request('status') == 'belum lunas' ? 'selected' : '' }}>
                        Belum Lunas
                    </option>
                </select>

                <select name="sort" id=""
                    class="w-28 h-9 p-1 bg-primary-green rounded-lg text-white flex justify-center items-center hover:opacity-85"
                    onchange="this.form.submit()">
                    <option value="default" {{ request('sort') == 'default' ? 'selected' : '' }}>
                        Default
                    </option>
                    <option value="asc" class="text-white" {{ request('sort') == 'asc' ? 'selected' : '' }}>
                        Ascending
                    </option>
                    <option value="desc" class="text-white" {{ request('sort') == 'desc' ? 'selected' : '' }}>
                        Descending
                    </option>
                </select>
            </div>
        </form>
        <div class="overflow-x-scroll scrollbar-hide">
            <table class="min-w-[1000px] xl:min-w-full border rounded-xl">
                <thead>
                    <tr align="center" class="text-[#515769] bg-slate-100">
                        <th>No</th>
                        @foreach ($headers as $header)
                            <th class="max-w-24 lg:max-w-32">{{ $header }}</th>
                        @endforeach
                    </tr>
                </thead>
                <tbody>
                    @foreach ($transactions as $index => $transaction)
                        <tr>
                            <td>{{ $index + 1 }}</td>
                            <td class="max-w-24 lg:max-w-32">{{ $transaction->invoice }}</td>
                            <td class="max-w-24 lg:max-w-32">{{ $transaction->customer->name }}</td>
                            <td class="max-w-24 lg:max-w-32">Rp. {{ number_format($transaction->total_cost, 0, ',', '.') }}</td>
                            <td class="max-w-24 lg:max-w-32">{{ $transaction->payment_methods }}</td>
                            <td class="max-w-24 lg:max-w-32">{{ $transaction->payment_status }}</td>
                            <td class="max-w-24 lg:max-w-32">{{ $transaction->description ? $transaction->description : 'Deskripsi untuk transaksi ini belum dimasukkan pada saat ini.' }}
                            </td>
                            <td align="center">
                                <div class="grid xl:flex gap-2 justify-center justify-items-center">
                                    <a href="{{ route('invoice.pdf', ['id' => $transaction->id]) }}"
                                        class="w-full h-12 py-1 px-2 bg-primary-green rounded-lg text-white flex justify-between items-center gap-2 hover:opacity-85">
                                        <img src="/icons/icon_detail.svg" alt="" class="w-5 h-5">
                                        Print Invoice
                                    </a>
                                    <a href="{{ route('admin.income.detail', ['id' => $transaction->id]) }}"
                                        class="w-fit h-12 py-1 px-2 bg-bold-blue rounded-lg text-white flex justify-between items-center gap-2 hover:opacity-85">
                                        <img src="/icons/icon_detail.svg" alt="" class="w-5 h-5">
                                        Detail
                                    </a>
                                    <a href="{{ route('admin.income.update', ['id' => $transaction->id]) }}"
                                        class="w-fit h-12 py-1 px-2 bg-[#F7C443] rounded-lg text-white flex justify-between items-center gap-2 hover:opacity-85">
                                        <img src="/icons/icon_edit.svg" alt="" class="w-5 h-5">
                                        Edit
                                    </a>
                                    <form id="deleteForm-{{ $transaction->id }}"
                                        action="{{ route('delete.transaction', ['id' => $transaction->id]) }}"
                                        method="POST">
                                        @csrf
                                        @method('DELETE')
                                        <button type="button" onclick="confirmDelete('{{ $transaction->id }}')"
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
            <div class="mt-4 px-2">
                {{ $transactions->links('pagination::bootstrap-5') }}
            </div>
        </div>
    </div>
@endsection
<script>
    setTimeout(function() {
        var errorMessage = document.getElementById('error-message');
        if (errorMessage) {
            errorMessage.style.top = '-200px';
        }

        var successMessage = document.getElementById('success-message');
        if (successMessage) {
            successMessage.style.display = 'none';
        }
    }, 3000);
</script>
<script>
    function confirmDelete(itemId) {
        Swal.fire({
            title: 'Anda yakin menghapus transaksi ini?',
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