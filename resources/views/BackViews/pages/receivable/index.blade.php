@extends('backviews.layouts.main')
@section('title-content')
    PIUTANG
@endsection
@php
    $headers = ['Pelanggan', 'Total Utang', 'Status Pembayaran', 'Jatuh Tempo', 'Deskkripsi', 'Action'];
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
    <form action="{{ route('admin.receivables.index') }}" class="w-full space-y-6">
        <div class="w-full flex flex-col md:flex-row md:items-center justify-between gap-3 md:gap-0">
            <h1 class="text-3xl font-bold text-bold-blue">
                Daftar Piutang
            </h1>
            <div class="flex items-center">
                <input type="text" class="w-full md:w-[28vw] p-2 rounded-l-lg bg-[#ECEDF3] border" name="search" placeholder={{ $searchTerm ? $searchTerm : 'Cari disini...' }}>
                <button type="submit"
                    class="w-12 p-2 border border-bold-blue bg-bold-blue rounded-r-lg flex justify-center items-center hover:opacity-85">
                    <img src="/icons/icon_search.svg" alt="" class="w-5 h-6">
                </button>
            </div>
            <div class="flex gap-3 font-bold">
                <select name="status" id=""
                    class="w-36 h-9 p-1 bg-primary-green rounded-lg text-white flex justify-center items-center hover:opacity-85"
                    onchange="this.form.submit()">
                    <option value="all" class="text-white" {{ request('status') == 'all' ? 'selected' : '' }}>
                        Semua Status
                    </option>
                    <option value="lunas" class="text-white" {{ request('status') == 'lunas' ? 'selected' : '' }}>
                        Lunas
                    </option>
                    <option value="belum lunas" class="text-white" {{ request('status') == 'belum lunas' ? 'selected' : '' }}>
                        Belum Lunas
                    </option>
                </select>
                <a href="{{ route('admin.receivables.create') }}"
                    class="w-28 h-9 py-1 px-2 font-bold bg-bold-blue rounded-lg text-white flex justify-between items-center hover:opacity-85">
                    Tambah
                    <img src="/icons/icon_plus.svg" alt="" class="w-4 h-4">
                </a>
            </div>
        </div>
        <div class="overflow-x-scroll scrollbar-hide">
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
                    @foreach ($receivables as $index => $receivable)
                        <tr>
                            <td>{{ $index + 1 }}</td>
                            <td>{{ $receivable->customer->name }}</td>
                            <td>Rp. {{ number_format($receivable->total_cost, 0, ',', '.') }}</td>
                            <td>{{ $receivable->payment_status }}</td>
                            <td>
                                @if ($receivable->payment_status == 'lunas')
                                    <div
                                        class="bg-primary-green flex justify-center font-bold text-white p-2 rounded-full">
                                        {{ $receivable->due_date }}
                                    </div>
                                @else
                                    <div
                                        class="{{ now() > \Carbon\Carbon::parse($receivable->due_date) ? 'bg-bold-red' : 'bg-[#F7C443]' }} flex justify-center font-bold text-white p-2 rounded-full">
                                        {{ $receivable->due_date }}
                                    </div>
                                @endif
                            </td>
                            <td>{{ $receivable->description ? $receivable->description : 'Deskripsi untuk transaksi ini belum dimasukkan pada saat ini.' }}
                            </td>
                            <td align="center">
                                <div class="flex gap-2 justify-center">
                                    <a href="{{ route('admin.receivables.update', ['id' => $receivable->id]) }}"
                                        class="w-fit h-12 py-1 px-2 bg-[#F7C443] rounded-lg text-white flex justify-between items-center gap-2 hover:opacity-85">
                                        <img src="/icons/icon_edit.svg" alt="" class="w-5 h-5">
                                        Edit
                                    </a>
                                    <form id="deleteForm-{{ $receivable->id }}"
                                        action="{{ route('delete.receivable', ['id' => $receivable->id]) }}"
                                        method="POST">
                                        @csrf
                                        @method('DELETE')
                                        <button type="button" onclick="confirmDelete('{{ $receivable->id }}')"
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
                {{ $receivables->links('pagination::bootstrap-5') }}
            </div>
        </div>
    </form>
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
            title: 'Anda yakin menghapus piutang ini?',
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
