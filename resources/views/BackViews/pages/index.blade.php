@extends('backviews.layouts.main')
@php
    $bgColors = ['bg-[#FFE2E6]', 'bg-[#E9F1FE]', 'bg-[#FFEDEF]', 'bg-[#F6FAFF]'];
@endphp
@section('title-content')
    DASHBOARD
@endsection
@section('main-content')
    <div class="w-full">
        <h1 class="text-3xl font-bold text-bold-blue">
            Top Report
        </h1>
        <div class="w-[77vw] overflow-x-scroll scrollbar-hide">
            <div class="w-screen py-8 pr-4 flex gap-6">
                @foreach ($bgColors as $item)
                    <livewire:admin.dashboard-card :bgColor="$item" />
                @endforeach
            </div>
        </div>        
    </div>
@endsection