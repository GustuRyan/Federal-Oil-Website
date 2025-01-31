@extends('backviews.layouts.main')
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
        'Deskkripsi',
        'Action',
    ];
@endphp
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
        <div class="w-full grid grid-cols-4 gap-4 p-1">
            <livewire:admin.cashflow-card />
            <livewire:admin.cashflow-card />
            <livewire:admin.cashflow-card />
            <livewire:admin.cashflow-card />
        </div>
        <form action="{{ route('admin.income.index') }}" class="w-full flex justify-between">
            <h1 class="text-3xl font-bold text-bold-blue">
                Daftar Pemasukan
            </h1>
            <div class="flex items-center">
                <input type="text" class="w-[28vw] p-2 rounded-l-lg bg-[#ECEDF3] border" name="search"
                    placeholder={{ $searchTerm ? $searchTerm : 'Cari disini...' }}>
                <button type="submit"
                    class="w-12 p-2 border border-bold-blue bg-bold-blue rounded-r-lg flex justify-center items-center hover:opacity-85">
                    <img src="/icons/icon_search.svg" alt="" class="w-5 h-6">
                </button>
            </div>
            <div class="flex gap-3 font-bold">
                <select name="payment_methods" id=""
                    class="w-28 h-9 p-1 bg-primary-green rounded-lg text-white flex justify-center items-center hover:opacity-85"
                    onchange="this.form.submit()">
                    <option value="tunai" class="text-white">
                        Tunai
                    </option>
                    <option value="transfer" class="text-white">
                        Transfer
                    </option>
                    <option value="kredit" class="text-white">
                        Kredit
                    </option>
                </select>

                <select name="payment_status" id=""
                    class="w-28 h-9 p-1 bg-primary-green rounded-lg text-white flex justify-center items-center hover:opacity-85"
                    onchange="this.form.submit()">
                    <option value="lunas" class="text-white">
                        Lunas
                    </option>
                    <option value="belum lunas" class="text-white">
                        Belum Lunas
                    </option>
                </select>
                
                <select name="sort" id=""
                    class="w-28 h-9 p-1 bg-primary-green rounded-lg text-white flex justify-center items-center hover:opacity-85"
                    onchange="this.form.submit()">
                    <option value="ascending" class="text-white">
                        Ascending
                    </option>
                    <option value="descending" class="text-white">
                        Descending
                    </option>
                </select>
            </div>
        </form>
        <div>
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
                    @foreach ($transactions as $index => $transaction)
                        <tr>
                            <td>{{ $index + 1 }}</td>
                            <td>{{ $transaction->invoice }}</td>
                            <td>{{ $transaction->customer->name }}</td>
                            <td>Rp. {{ number_format($transaction->total_cost, 0, ',', '.') }}</td>
                            <td>{{ $transaction->payment_methods }}</td>
                            <td>{{ $transaction->payment_status }}</td>
                            <td>{{ $transaction->description ? $transaction->description : 'Deskripsi untuk transaksi ini belum dimasukkan pada saat ini.' }}
                            </td>
                            <td align="center">
                                <div class="flex gap-2 justify-center">
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
<script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
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
