@extends('backviews.layouts.main')
@section('title-content')
    <div class="flex items-center gap-4">
        <a href="{{ route('admin.receivables.index') }}">
            <img src="/icons/icon_arrow_back.svg" class="w-8">
        </a>
        <div>
            BUAT PIUTANG
        </div>
    </div>
@endsection
@section('main-content')
    <form action="{{ route('create.receivable') }}" method="POST">
        @csrf
        <div class="flex flex-col">
            <label for="customer_id" class="font-bold text-slate-700 mb-2.5">Nama Pelanggan *</label>
            <select id="customer_id" name="customer_id" class="p-3 border border-black text-base rounded-md mb-5"
                required>
                <option value="">Pilih Pelanggan</option>
                @foreach ($customers as $customer)
                    <option value="{{ $customer->id }}">{{ $customer->name }}</option>
                @endforeach
            </select>

            <label for="total_cost" class="font-bold text-slate-700 mb-2.5">Total Biaya *</label>
            <input type="number" id="total_cost" name="total_cost" placeholder="Masukkan total biaya"
                class="p-3 border border-black text-base rounded-md mb-5" required>

            <label for="due_date" class="font-bold text-slate-700 mb-2.5">Tanggal Jatuh Tempo *</label>
            <input type="datetime-local" id="due_date" name="due_date"
                class="p-3 border border-black text-base rounded-md mb-5" required>

            <label for="payment_status" class="font-bold text-slate-700 mb-2.5">Status Pembayaran *</label>
            <select id="payment_status" name="payment_status" class="p-3 border border-black text-base rounded-md mb-5"
                required>
                <option value="lunas">Lunas</option>
                <option value="belum lunas">Belum Lunas</option>
            </select>

            <label for="description" class="font-bold text-slate-700 mb-2.5">Deskripsi</label>
            <textarea id="description" name="description" placeholder="Masukkan deskripsi (opsional)"
                class="p-3 border border-black text-base rounded-md mb-5"></textarea>
        </div>

        <div class="flex justify-end">
            <button type="submit"
                class="mt-5 bg-blue-800 text-white text-xl font-bold py-4 px-6 rounded-lg hover:bg-green-700 transition duration-300">
                SIMPAN
            </button>
        </div>
    </form>
@endsection
