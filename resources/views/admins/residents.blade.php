@extends('layouts.admin')

@section('content')
<div class="p-7 flex h-full">
    <div class=" bg-slate-50 h-full w-full">
        <a href="{{ route('admin.resident.register.show') }}">Register Resident</a>
    </div>
    <div class="bg-gray-100 h-full w-full border border-black border-opacity-25 rounded">
        <div class="border-b border-black p-2 w-full">
            <span class="font-bold">Result</span>
        </div>
            <!-- List of Residents -->
            @foreach ($residents as $resident)
            <a class="hover:bg-barangay-main hover:text-white" href="{{ route('admin.resident.profile', [$resident->resident_id]) }}">
                <div class="flex items-center justify-between">
                    <div class="flex items-center gap-2">
                        <img class="w-[50px] h-[50px] border rounded-full" src="" alt="">
                        <span class="font-raleway font-bold">{{ $resident->last_name }}, {{ $resident->first_name }} {{ $resident->middle_name }}</span>
                    </div>
                </div>
            </a>
            @endforeach
    </div>
</div>
@endsection