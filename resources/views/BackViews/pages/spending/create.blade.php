@extends('backviews.layouts.main')
@section('title-content')
    <div class="flex items-center gap-4">
        <a href="{{ route('admin.spending.index') }}">
            <img src="/icons/icon_arrow_back.svg" class="w-8">
        </a>
        <div>
            BUAT PENGELUARAN
        </div>
    </div>
@endsection
@section('main-content')
    <form action="{{ route('create.spending') }}" method="POST">
        @csrf
        <div class="space-y-5">
            <div>
                <label for="spending_type" class="font-bold text-slate-700 mb-2.5">Tipe Pengeluaran *</label>
                <select id="spending_type" name="spending_type" class="w-full p-3 border border-black text-base rounded-md"
                    required>
                    <option value="">Pilih Tipe Pengeluaran</option>
                    <option value="biaya operasional">Biaya Operasional</option>
                    <option value="biaya suku cadang">Biaya Suku Cadang</option>
                    <option value="gaji">Gaji</option>
                </select>
            </div>

            <div>
                <label for="distributor" class="font-bold text-slate-700 mb-2.5">Distributor</label>
                <input type="text" id="distributor" name="distributor" placeholder="Masukkan nama distributor (opsional)"
                    class="w-full p-3 border border-black text-base rounded-md">
            </div>

            <div>
                <label for="total_cost" class="font-bold text-slate-700 mb-2.5">Total Biaya *</label>
                <input type="number" id="total_cost" name="total_cost" placeholder="Masukkan total biaya"
                    class="w-full p-3 border border-black text-base rounded-md" required>
            </div>

            <div>
                <label for="payment_methods" class="font-bold text-slate-700 mb-2.5">Metode Pembayaran *</label>
                <select id="payment_methods" name="payment_methods"
                    class="w-full p-3 border border-black text-base rounded-md" required>
                    <option value="">Pilih Metode Pembayaran</option>
                    <option value="tunai">Tunai</option>
                    <option value="kredit">Kredit</option>
                    <option value="transfer">Transfer</option>
                </select>
            </div>

            <div>
                <label for="description" class="font-bold text-slate-700 mb-2.5">Deskripsi</label>
                <textarea id="description" name="description" placeholder="Masukkan deskripsi (opsional)"
                    class="w-full p-3 border border-black text-base rounded-md"></textarea>
            </div>

            <div class="flex justify-end">
                <button type="submit"
                    class="mt-5 bg-blue-800 text-white text-xl font-bold py-4 px-6 rounded-lg hover:bg-blue-900 transition duration-300">
                    SIMPAN
                </button>
            </div>
        </div>
    </form>
@endsection
