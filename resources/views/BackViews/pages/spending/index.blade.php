@extends('backviews.layouts.main')
@section('title-content')
    PENGELUARAN
@endsection
@php
$headers = [
    'Tipe Pengeluaran',
    'Distributor',
    'Total Pengeluaran',
    'Metode Pembayaran',
    'Deskripsi',
    'Action',
];
@endphp
@section('js')
    <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/apexcharts"></script>
    {!! $chartData->script() !!}
    {!! $chartSpend->script() !!}
@endsection
@section('main-content')
<div class="w-full space-y-9">
    @if (session('success'))
        <div id="success-message" class="w-full flex items-center justify-center mb-4">
            <div class="w-full p-2 rounded-xl shadow-md bg-green-200">
                <div class="bg-green-200 text-xl font-bold text-green-700 p-4 rounded">
                    {{ session('success') }}
                </div>
            </div>
        </div>
    @endif
    <div class="w-full space-y-9">
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
                {!! $chartSpend->container() !!}
            </div>
        </div>
        <form action="{{ route('admin.spending.index') }}" class="w-full flex flex-col md:flex-row justify-between gap-3 md:gap-0">
            <h1 class="text-3xl font-bold text-bold-blue">
                Daftar Pengeluaran
            </h1>
            <div class="flex items-center">
                <input type="text" class="w-full md:w-[28vw] p-2 rounded-l-lg bg-[#ECEDF3] border" name="search" placeholder={{ $searchTerm ? $searchTerm : 'Cari disini...' }}>
                <button type="submit"
                    class="w-12 p-2 border border-bold-blue bg-bold-blue rounded-r-lg flex justify-center items-center hover:opacity-85">
                    <img src="/icons/icon_search.svg" alt="" class="w-5 h-6">
                </button>
            </div>
            <div class="flex gap-3 font-bold">
                <a href="{{ route('admin.spending.create') }}"
                class="w-28 h-9 py-1 px-2 font-bold bg-bold-blue rounded-lg text-white flex justify-between items-center hover:opacity-85">
                Tambah
                <img src="/icons/icon_plus.svg" alt="" class="w-4 h-4">
            </a>
            </div>
        </form>
        <div class="w-full overflow-x-scroll scrollbar-hide">
            <table class="w-full border rounded-xl">
                <thead>
                    <tr align="center" class="text-[#515769] bg-slate-100">
                        <th>No</th>
                        @foreach ($headers as $header)
                            <th>{{ $header }}</th>
                        @endforeach
                    </tr>
                </thead>
                <tbody>
                    @foreach ($spendings as $index => $spending)
                        <tr>
                            <td align="center">{{ $index + 1 }}</td>
                            <td class="capitalize">{{ $spending->spending_type }}</td>
                            <td>{{ $spending->distributor ? $spending->distributor : 'Tidak ada data Distributor.' }}</td>
                            <td>Rp. {{ number_format($spending->total_cost, 0, ',', '.') }}</td>
                            <td>{{ $spending->payment_methods }}</td>
                            <td>{{ $spending->description ? $spending->description : 'Deskripsi untuk pengeluaran ini belum dimasukkan pada saat ini.' }}
                            </td>
                            <td align="center">
                                <div class="flex gap-2 justify-center">
                                    <a href="{{ route('admin.spending.update', ['id' => $spending->id]) }}"
                                        class="w-fit h-12 py-1 px-2 bg-[#F7C443] rounded-lg text-white flex justify-between items-center gap-2 hover:opacity-85">
                                        <img src="/icons/icon_edit.svg" alt="" class="w-5 h-5">
                                        Edit
                                    </a>
                                    <form id="deleteForm-{{ $spending->id }}"
                                        action="{{ route('delete.spending', ['id' => $spending->id]) }}" method="POST">
                                        @csrf
                                        @method('DELETE')
                                        <button type="button"
                                            onclick="confirmDelete('{{ $spending->id }}')"
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
                {{ $spendings->links('pagination::bootstrap-5') }}
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
<script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
<script>
    function confirmDelete(itemId) {
        Swal.fire({
            title: 'Anda yakin menghapus pengeluaran ini?',
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