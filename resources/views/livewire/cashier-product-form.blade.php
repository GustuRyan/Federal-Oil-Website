<div class="grid grid-cols-3 gap-4">
    @foreach ($products as $product)
        @php
            $percentage = $product->first_stocks > 0 ? ($product->latest_stock / $product->first_stocks) * 100 : 0;
        @endphp
        @if ($product->latest_stock != 0)
            <form action="{{ route('create.cart') }}" method="POST"
                class="min-w-56 min-h-48 shadow-md bg-white rounded-lg hover:bg-slate-50 border border-slate-100 cursor-pointer transition-colors p-4 flex flex-col justify-between">
                @csrf
                <div class="space-y-2">
                    <div class="flex justify-between items-center">
                        <h2 class="text-xl font-bold truncate">
                            {{ $product->product_name }}
                        </h2>
                        <p
                            class="
                    @if ($percentage > 50) text-primary-green
                    @elseif ($percentage > 30)
                        text-yellow-600
                    @else
                        text-red-500 @endif 
                    text-lg font-bold">
                            x{{ $product->latest_stock }}</p>
                    </div>
                    <div class="flex justify-between items-center pb-6">
                        <p>{{ $product->product_category }}</p>
                        <p>Rp. {{ number_format($product->selling_price, 0, ',', '.') }}</p>
                    </div>
                    <input type="hidden" name="product_id" value="{{ $product->id }}">
                    <input type="hidden" name="amount" value="1">
                    <input type="hidden" name="price" value="{{ $product->selling_price }}">
                </div>
                <button type="submit" data-id="{{ $product->id }}" id="addToCart{{ $product->id }}"
                    class="w-full p-2 bg-primary-green rounded-md text-white font-bold">
                    SIMPAN
                </button>
            </form>
        @endif
    @endforeach
</div>
