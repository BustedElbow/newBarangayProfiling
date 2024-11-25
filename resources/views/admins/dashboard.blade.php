@extends('layouts.admin')

@section('content')
<div class="flex p-10 gap-4">
    <div class="flex flex-col gap-4">
        <div class="px-3 py-2 border border-[#1e1e1e] border-opacity-25 w-[300px] h-[300px] bg-[#f5f5f5]">
            <span class="font-raleway font-bold">Pending Clearances</span>
        </div>
        <div class="px-3 py-2 border border-[#1e1e1e] border-opacity-25 w-[300px] h-fit bg-[#f5f5f5]">
            <div class="flex flex-col">
                <div class="flex gap-1">
                    <img class="w-[24px] h-[24px]" src="{{ asset('images/icons/resident100-black.png')}}" alt="">
                    <span class="font-raleway font-bold">Total Residents</span>
                </div>
                <span class="font-inter font-bold text-3xl text-barangay-main">199</span>
            </div>
        </div>
    </div>
    <div class="flex flex-col gap-4">
        <div class="flex gap-4">
            <div class="px-3 py-2 border border-[#1e1e1e] border-opacity-25 w-[370px] h-[370px] bg-[#f5f5f5]">
                <span class="font-raleway font-bold">Age Demographics</span>
            </div>
            <div class="px-3 py-2 border border-[#1e1e1e] border-opacity-25 w-[370px] h-[370px] bg-[#f5f5f5]">
                <span class="font-raleway font-bold">Gender Distribution</span>
            </div>
        </div>
        <div class="flex gap-4">
            <div class="px-3 py-2 border border-[#1e1e1e] border-opacity-25 w-[370px] h-[370px] bg-[#f5f5f5]">
                <span class="font-raleway font-bold">Civil Status</span>
            </div>
            <div class="px-3 py-2 border border-[#1e1e1e] border-opacity-25 w-[370px] h-[370px] bg-[#f5f5f5]">
                <span class="font-raleway font-bold">Employment Percentage</span>
            </div>
        </div>
    </div>
</div>
@endsection