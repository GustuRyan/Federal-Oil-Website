@extends('backviews.layouts.main')
@php
    $bgColors = ['bg-[#FFE2E6]', 'bg-[#E9F1FE]', 'bg-[#FFEDEF]', 'bg-[#F6FAFF]'];
@endphp
@section('title-content')
    DASHBOARD
@endsection
@section('js')
    <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/apexcharts"></script>
    {!! $chartData->script() !!}
    {!! $chartRevenue->script() !!}
    {!! $spendData->script() !!}
    {!! $chartSpend->script() !!}
@endsection
@section('main-content')
    <div class="w-full">
        <h1 class="text-3xl font-bold text-bold-blue">
            Top Report
        </h1>
        <div class="w-full lg:w-[77vw] overflow-x-scroll scrollbar-hide space-y-8">
            <div class="w-screen py-8 pr-4 flex gap-6">
                @foreach ($cardResources as $item)
                    <livewire:admin.dashboard-card :bgColor="$item['color']" :title="$item['title']" :value="$item['value']" :time="$item['time']"/>
                @endforeach
            </div>
        </div>
        <div class="w-full flex flex-col md:flex-row justify-between gap-4 md:gap-0 lg:gap-4 mb-4 md:mb-8">
            <div class="md:w-[49%] lg:w-full p-4 space-y-12 font-semibold rounded-lg shadow-md border bg-white">
                {!! $chartData->container() !!}
            </div>
            <div class="md:w-[49%] lg:w-full p-4 space-y-12 font-semibold rounded-lg shadow-md border bg-white">
                {!! $chartRevenue->container() !!}
            </div>
        </div>
        <div class="w-full flex flex-col md:flex-row justify-between gap-4 md:gap-0 lg:gap-4">
            <div class="md:w-[49%] lg:w-full p-4 space-y-12 font-semibold rounded-lg shadow-md border bg-white">
                {!! $spendData->container() !!}
            </div>
            <div class="md:w-[49%] lg:w-full p-4 space-y-12 font-semibold rounded-lg shadow-md border bg-white">
                {!! $chartSpend->container() !!}
            </div>
        </div>
    </div>
@endsection
