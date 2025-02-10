<div class="w-full p-4 space-y-12 font-semibold rounded-lg shadow-md border bg-white">
    <div class="w-full flex justify-between items-center">
        <h1 class="text-xl max-w-52">
            {{ $title }}
        </h1>
        <img src="/icons/icon_wallet.svg" alt="" class="hidden xl:block w-8 h-8">
    </div>
    <div class="space-y-2">
        <h2 class="text-2xl">
            {{ number_format($value, 0, ',', '.') }}
        </h2>
        <p class="text-xl">
            {{ $time }}
        </p>
    </div>
</div>
