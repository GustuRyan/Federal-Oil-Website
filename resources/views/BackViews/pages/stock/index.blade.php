@extends('backviews.layouts.main')
@section('title-content')
    STOK
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
        <form action="{{ route('admin.stocks.index') }}" class="w-full flex flex-col md:flex-row justify-between gap-3 md:gap-0">
            <h1 class="text-3xl font-bold text-bold-blue">
                Daftar Barang
            </h1>
            <div class="w-full flex items-center">
                <input type="text" class="w-full p-2 rounded-l-lg bg-[#ECEDF3] border" name="search"
                    placeholder="{{ $searchTerm ?? 'Cari disini...' }}">
                <button type="submit"
                    class="w-12 p-2 border border-bold-blue bg-bold-blue rounded-r-lg flex justify-center items-center hover:opacity-85">
                    <img src="/icons/icon_search.svg" alt="" class="w-5 h-6">
                </button>
            </div>
            <div class="flex flex-row md:flex-col items-center lg:flex-row gap-3 font-bold">
                <select name="category" id=""
                    class="w-28 h-9 p-1 bg-primary-green rounded-lg text-white flex justify-center items-center hover:opacity-85"
                    onchange="this.form.submit()">
                    <option value="all" class="text-white capitalize"
                        {{ request('category') == 'all' ? 'selected' : '' }}>
                        Semua
                    </option>
                    @foreach ($categories as $category)
                        <option value="{{ $category }}" class="text-white capitalize"
                            {{ request('category') == $category ? 'selected' : '' }}>
                            {{ $category }}
                        </option>
                    @endforeach
                </select>
                <a href="{{ route('admin.stocks.create') }}"
                    class="w-28 h-9 py-1 px-2 bg-bold-blue rounded-lg text-white flex justify-between items-center hover:opacity-85">
                    Tambah
                    <img src="/icons/icon_plus.svg" alt="" class="w-4 h-4">
                </a>
            </div>
        </form>
        <div class="w-full md:w-[77vw] grid place-items-center md:grid-cols-2 lg:grid-cols-3 xl:grid-cols-4 2xl:grid-cols-5 gap-8 p-2">
            @foreach ($products as $product)
                <livewire:admin.product-card :product="$product" />
            @endforeach
        </div>
        <div class="mt-4 px-2">
            {{ $products->links('pagination::bootstrap-5') }}
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
