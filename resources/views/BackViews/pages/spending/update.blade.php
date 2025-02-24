@extends('backviews.layouts.main')
@section('title-content')
    <div class="flex items-center gap-4">
        <a href="{{ route('admin.spending.index') }}">
            <img src="/icons/icon_arrow_back.svg" class="w-8">
        </a>
        <div>
            PERBARUI PENGELUARAN
        </div>
    </div>
@endsection
@section('main-content')
    <form action="{{ route('update.spending', $spending->id) }}" method="POST">
        @csrf
        @method('PUT')
        <div class="space-y-5">
            <div>
                <label for="spending_type" class="font-bold text-slate-700 mb-2.5">Tipe Pengeluaran *</label>
                <select id="spending_type" name="spending_type" class="w-full p-3 border border-black text-base rounded-md"
                    required>
                    <option value="">Pilih Tipe Pengeluaran</option>
                    <option value="biaya operasional"
                        {{ old('spending_type', $spending->spending_type) === 'biaya operasional' ? 'selected' : '' }}>Biaya
                        Operasional</option>
                    <option value="biaya suku cadang"
                        {{ old('spending_type', $spending->spending_type) === 'biaya suku cadang' ? 'selected' : '' }}>Biaya
                        Suku Cadang</option>
                    <option value="gaji"
                        {{ old('spending_type', $spending->spending_type) === 'gaji' ? 'selected' : '' }}>Gaji</option>
                </select>
            </div>

            <div>
                <label for="distributor" class="font-bold text-slate-700 mb-2.5">Distributor</label>
                <input type="text" id="distributor" name="distributor" placeholder="Masukkan nama distributor (opsional)"
                    value="{{ old('distributor', $spending->distributor) }}"
                    class="w-full p-3 border border-black text-base rounded-md">
            </div>

            <div>
                <label for="total_cost" class="font-bold text-slate-700 mb-2.5">Total Biaya *</label>
                <input type="number" id="total_cost" name="total_cost" placeholder="Masukkan total biaya"
                    value="{{ old('total_cost', $spending->total_cost) }}"
                    class="w-full p-3 border border-black text-base rounded-md" required>
            </div>

            <div>
                <label for="payment_methods" class="font-bold text-slate-700 mb-2.5">Metode Pembayaran *</label>
                <select id="payment_methods" name="payment_methods"
                    class="w-full p-3 border border-black text-base rounded-md" required>
                    <option value="">Pilih Metode Pembayaran</option>
                    <option value="tunai"
                        {{ old('payment_methods', $spending->payment_methods) === 'tunai' ? 'selected' : '' }}>Tunai
                    </option>
                    <option value="kredit"
                        {{ old('payment_methods', $spending->payment_methods) === 'kredit' ? 'selected' : '' }}>Kredit
                    </option>
                    <option value="transfer"
                        {{ old('payment_methods', $spending->payment_methods) === 'transfer' ? 'selected' : '' }}>Transfer
                    </option>
                </select>
            </div>

            <div>
                <label for="description" class="font-bold text-slate-700 mb-2.5">Deskripsi</label>
                <textarea id="description" name="description" placeholder="Masukkan deskripsi (opsional)"
                    class="w-full p-3 border border-black text-base rounded-md">{{ old('description', $spending->description) }}</textarea>
            </div>

            <div class="flex justify-end">
                <button type="submit"
                    class="mt-5 bg-blue-800 text-white text-xl font-bold py-4 px-6 rounded-lg hover:bg-blue-900 transition duration-300">
                    UPDATE
                </button>
            </div>
        </div>
    </form>
@endsection
