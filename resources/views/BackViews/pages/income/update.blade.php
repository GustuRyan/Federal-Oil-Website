@extends('backviews.layouts.main')
@section('title-content')
    <div class="flex items-center gap-4">
        <a href="{{ route('admin.income.index') }}">
            <img src="/icons/icon_arrow_back.svg" class="w-8">
        </a>
        <div>
            PERBARUI PEMASUKAN
        </div>
    </div>
@endsection
@section('main-content')
    <form action="{{ route('update.transaction', $transaction->id) }}" method="POST">
        @csrf
        @method('PUT')
        <div class="flex flex-col">
            <label for="invoice" class="font-bold text-slate-700 mb-2.5">Invoice *</label>
            <input type="text" id="invoice" name="invoice" placeholder="Masukkan kode invoice"
                class="p-3 border border-black text-base rounded-md mb-3"
                value="{{ old('invoice', $transaction->invoice ?? '') }}" required>

            <label for="customer_id" class="font-bold text-slate-700 mb-2.5">Customer ID *</label>
            <select id="customer_id" name="customer_id" class="p-3 border border-black text-base rounded-md mb-3" required>
                @foreach ($customers as $customer)
                    <option value="{{ $customer->id }}"
                        {{ old('customer_id', $transaction->customer_id ?? '') == $customer->id ? 'selected' : '' }}>
                        {{ $customer->name }}
                    </option>
                @endforeach
            </select>

            <label for="total_cost" class="font-bold text-slate-700 mb-2.5">Total Biaya *</label>
            <input type="number" id="total_cost" name="total_cost" placeholder="Masukkan total biaya"
                class="p-3 border border-black text-base rounded-md mb-3"
                value="{{ old('total_cost', $transaction->total_cost ?? '') }}" required>

            <label for="payment_methods" class="font-bold text-slate-700 mb-2.5">Metode Pembayaran *</label>
            <select id="payment_methods" name="payment_methods" class="p-3 border border-black text-base rounded-md mb-3"
                required>
                <option value="tunai"
                    {{ old('payment_methods', $transaction->payment_methods) === 'tunai' ? 'selected' : '' }}>Tunai</option>
                <option value="kredit"
                    {{ old('payment_methods', $transaction->payment_methods) === 'kredit' ? 'selected' : '' }}>Kredit
                </option>
                <option value="transfer"
                    {{ old('payment_methods', $transaction->payment_methods) === 'transfer' ? 'selected' : '' }}>Transfer
                </option>
            </select>

            <label for="payment_status" class="font-bold text-slate-700 mb-2.5">Status Pembayaran *</label>
            <select id="payment_status" name="payment_status" class="p-3 border border-black text-base rounded-md mb-3"
                required>
                <option value="paid"
                    {{ old('payment_status', $transaction->payment_status) === 'paid' ? 'selected' : '' }}>Lunas</option>
                <option value="pending"
                    {{ old('payment_status', $transaction->payment_status) === 'pending' ? 'selected' : '' }}>Belum Lunas
                </option>
            </select>

            <label for="description" class="font-bold text-slate-700 mb-2.5">Deskripsi</label>
            <textarea id="description" name="description" placeholder="Masukkan deskripsi transaksi (opsional)"
                class="p-3 border border-black text-base rounded-md mb-3">{{ old('description', $transaction->description ?? '') }}</textarea>
        </div>

        <div class="flex justify-end">
            <button type="submit"
                class="mt-5 bg-blue-800 text-white text-xl font-bold py-4 px-6 rounded-lg hover:bg-blue-900 transition duration-300">
                UPDATE
            </button>
        </div>
    </form>
@endsection
