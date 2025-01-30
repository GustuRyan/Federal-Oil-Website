@extends('backviews.layouts.main')
@section('title-content')
    <div class="flex items-center gap-4">
        <a href="{{ route('admin.customer.index') }}">
            <img src="/icons/icon_arrow_back.svg" class="w-8">
        </a>
        <div>
            PELANGGAN
        </div>
    </div>
@endsection
@section('main-content')
    <form action="{{ route('create.customer') }}" method="POST">
        @csrf
        <div class="flex flex-col">
            <label for="name" class="font-bold text-slate-700 mb-2.5">Nama *</label>
            <input type="text" id="name" name="name" placeholder="Masukkan nama customer"
                class="p-3 border border-black text-base rounded-md mb-5" required>

            <label for="address" class="font-bold text-slate-700 mb-2.5">Alamat *</label>
            <textarea id="address" name="address" placeholder="Masukkan alamat customer"
                class="p-3 border border-black text-base rounded-md mb-5" required></textarea>

            <label for="phone_number" class="font-bold text-slate-700 mb-2.5">Nomor Telepon *</label>
            <input type="text" id="phone_number" name="phone_number" placeholder="Masukkan nomor telepon"
                class="p-3 border border-black text-base rounded-md mb-5" required>

            <label for="email" class="font-bold text-slate-700 mb-2.5">Email *</label>
            <input type="email" id="email" name="email" placeholder="Masukkan email customer"
                class="p-3 border border-black text-base rounded-md mb-5" required>

            <label for="motorcycle_type" class="font-bold text-slate-700 mb-2.5">Tipe Motor *</label>
            <input type="text" id="motorcycle_type" name="motorcycle_type" placeholder="Masukkan tipe motor"
                class="p-3 border border-black text-base rounded-md mb-5" required>

            <label for="description" class="font-bold text-slate-700 mb-2.5">Deskripsi</label>
            <textarea id="description" name="description" placeholder="Masukkan deskripsi (opsional)"
                class="p-3 border border-black text-base rounded-md mb-5"></textarea>
        </div>
        <div class="flex justify-end">
            <button type="submit"
                class="mt-5 bg-blue-800 text-white text-xl font-bold py-4 px-6 rounded-lg hover:bg-blue-900 transition duration-300">SIMPAN</button>
        </div>
    </form>
@endsection
