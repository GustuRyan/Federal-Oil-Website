@extends('backviews.layouts.main')
@section('title-content')
    PELANGGAN
@endsection
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
    <div class="w-full space-y-4">
        <form action="{{ route('admin.customer.index') }}" class="w-full flex flex-col md:flex-row md:item-center justify-between gap-3 md:gap-0">
            <h1 class="text-3xl font-bold text-bold-blue">
                Daftar Pelanggan
            </h1>
            <div class="flex items-center">
                <input type="text" class="w-full md:w-[28vw] p-2 rounded-l-lg bg-[#ECEDF3] border" name="search" placeholder={{ $searchTerm ? $searchTerm : 'Cari disini...' }}>
                <button type="submit"
                    class="w-12 p-2 border border-bold-blue bg-bold-blue rounded-r-lg flex justify-center items-center hover:opacity-85">
                    <img src="/icons/icon_search.svg" alt="" class="w-5 h-6">
                </button>
            </div>
            <a href="{{ route('admin.customer.create') }}"
                class="w-28 h-9 py-1 px-2 font-bold bg-bold-blue rounded-lg text-white flex justify-between items-center hover:opacity-85">
                Tambah
                <img src="/icons/icon_plus.svg" alt="" class="w-4 h-4">
            </a>
        </form>
        <div class="overflow-x-scroll scrollbar-hide">
            <table class="w-full border rounded-xl">
                <thead>
                    <tr align="center" class="text-[#515769] bg-slate-100">
                        <th>No</th>
                        <th>Nama</th>
                        <th>Alamat</th>
                        <th>Nomor Telepon</th>
                        <th>Email</th>
                        <th>Tipe Motor</th>
                        <th>Deskripsi</th>
                        <th>Action</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($customers as $index => $customer)
                        <tr>
                            <td align="center">{{ $index + 1 }}</td>
                            <td>{{ $customer->name }}</td>
                            <td>{{ $customer->address }}</td>
                            <td>{{ $customer->phone_number }}</td>
                            <td>{{ $customer->email }}</td>
                            <td>{{ $customer->motorcycle_type }}</td>
                            <td class="max-w-72">
                                {{ $customer->description ? $customer->description : 'Deskripsi untuk pelanggan ini belum dimasukkan pada saat ini.' }}
                            </td>
                            <td align="center">
                                <div class="flex gap-2 justify-center">
                                    <a href="{{ route('admin.customer.update', ['id' => $customer->id]) }}"
                                        class="w-fit h-12 py-1 px-2 bg-[#F7C443] rounded-lg text-white flex justify-between items-center gap-2 hover:opacity-85">
                                        <img src="/icons/icon_edit.svg" alt="" class="w-5 h-5">
                                        Edit
                                    </a>
                                    <form id="deleteForm-{{ $customer->id }}"
                                        action="{{ route('delete.customer', ['id' => $customer->id]) }}" method="POST">
                                        @csrf
                                        @method('DELETE')
                                        <button type="button"
                                            onclick="confirmDelete('{{ $customer->id }}', '{{ $customer->name }}')"
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
                {{ $customers->links('pagination::bootstrap-5') }}
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
