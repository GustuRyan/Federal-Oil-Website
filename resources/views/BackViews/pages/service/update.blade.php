@extends('backviews.layouts.main')
@section('title-content')
    <div class="flex items-center gap-4">
        <a href="{{ route('admin.service.index') }}">
            <img src="/icons/icon_arrow_back.svg" class="w-8">
        </a>
        <div>
            PERBARUI STOK
        </div>
    </div>
@endsection
@section('main-content')
    <form action="{{ isset($service) ? route('update.service', $service->id) : route('store.service') }}" method="POST">
        @csrf
        @if (isset($service))
            @method('PUT')
        @endif

        <div class="flex flex-col">
            <label for="service_code" class="font-bold text-slate-700 mb-2.5">Kode Service *</label>
            <input type="text" id="service_code" name="service_code" placeholder="Masukkan kode service"
                class="p-3 border border-black text-base rounded-md mb-5"
                value="{{ old('service_code', $service->service_code ?? '') }}" required>

            <label for="service_name" class="font-bold text-slate-700 mb-2.5">Nama Service *</label>
            <input type="text" id="service_name" name="service_name" placeholder="Masukkan nama service"
                class="p-3 border border-black text-base rounded-md mb-5"
                value="{{ old('service_name', $service->service_name ?? '') }}" required>

            <label for="service_price" class="font-bold text-slate-700 mb-2.5">Harga Service *</label>
            <input type="number" id="service_price" name="service_price" placeholder="Masukkan harga service"
                class="p-3 border border-black text-base rounded-md mb-5"
                value="{{ old('service_price', $service->service_price ?? '') }}" required>

            <label for="description" class="font-bold text-slate-700 mb-2.5">Deskripsi</label>
            <textarea id="description" name="description" placeholder="Masukkan deskripsi service (opsional)"
                class="p-3 border border-black text-base rounded-md mb-5">{{ old('description', $service->description ?? '') }}</textarea>
        </div>

        <div class="flex justify-end">
            <button type="submit"
                class="mt-5 bg-blue-800 text-white text-xl font-bold py-4 px-6 rounded-lg hover:bg-blue-900 transition duration-300">
                {{ isset($service) ? 'UPDATE' : 'SIMPAN' }}
            </button>
        </div>
    </form>
@endsection
