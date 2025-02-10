<div class="space-y-2">
    @foreach ($services as $service)
        <form action="{{ route('create.cart') }}" method="POST"
            class="serviceToCart shadow-md bg-white w-full rounded-lg hover:bg-slate-50 border border-slate-100 p-4">
            @csrf
            <div class="w-full items-center flex justify-between gap-6">
                <div class="flex flex-col">
                    <h2 class="text-xl font-bold">
                        {{ $service->service_name }}
                    </h2>
                    <p>Rp. {{ number_format($service->service_price, 0, ',', '.') }}</p>
                </div>
                <div class="flex flex-col">
                    <input type="hidden" name="service_id" value="{{ $service->id }}">
                    <label for="service_time" class="font-bold">Waktu Servis</label>
                    <input type="number" name="service_time" class="rounded-md p-1" placeholder="waktu service (menit)" required>
                </div>
                <button type="submit" data-id="{{ $service->id }}"
                    class="p-2 bg-primary-green rounded-md text-white font-bold">
                    SIMPAN
                </button>
            </div>
        </form>
    @endforeach
</div>