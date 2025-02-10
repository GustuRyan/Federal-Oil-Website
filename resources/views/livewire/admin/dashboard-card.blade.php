<div class="w-[480px] h-fit p-6 rounded-3xl shadow-md space-y-28 {{$bgColor}}">
    <div class="w-full space-y-1">
        <div class="w-full flex justify-between">
            <p class="text-2xl font-bold text-bold-blue">
                {{ $title }}
            </p>
            <div class="w-10 h-10 rounded-full bg-bold-blue"></div>
        </div>
        <p class="text-3xl font-bold text-bold-blue">
            {{ number_format($value, 0, ',', '.') }}
        </p>
    </div>
    <div class="w-full flex justify-between">
        <div class="flex gap-2">
            <div class="w-7 h-7 rounded-full bg-bold-blue"></div>
            <p class="text-xl font-bold text-bold-blue">
                {{ $time }}
            </p>
        </div>
        <p class="text-xl font-bold text-bold-blue">
            {{ $year }}
        </p>
    </div>
</div>
