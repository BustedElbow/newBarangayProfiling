@extends('layouts.admin')

@section('content')
<!-- parent div for form and steps -->
<div class="flex flex-row p-10 gap-10 ">
    <!-- parent div for form-->

    <div class="flex flex-col border-r border-[#1e1e1e] pr-10 gap-8 rounded">
        <div class="border-b border-black pb-3">
            <h2 class="font-inter text-[#4169E1] text-[16px]">Step {{$currentStep}}</h2>
            <h1 class="font-bold font-raleway text-[20px]">
                @if($currentStep == 1)
                Personal and Contact Details
                @elseif($currentStep == 2)
                Household Information
                @elseif($currentStep == 3)
                Employement, Education, and Health Details
                @elseif($currentStep == 4)
                Review and Confirmation
                @endif
            </h1>
        </div>

        <form class="flex flex-col items-end h-full" action="{{ route('admin.resident.register') }}" method="POST">
            @csrf
            <div class="flex flex-col gap-9">
                @switch($currentStep)
                @case(1)
                @include('auth.admin.resident.register_partials.step-1')
                @break
                @case(2)
                @include('auth.admin.resident.register_partials.step-2')
                @break
                @case(3)
                @include('auth.admin.resident.register_partials.step-3')
                @break
                @break
                @case(4)
                @include('auth.admin.resident.register_partials.step-4')
                @break
                @endswitch
            </div>
            <div class="flex gap-3 mt-10">
                @if($currentStep > 1)
                <button formaction="{{ route('register') }}" name="previousForm" value="previous" class="bg-gray-300 text-black font-inter w-fit py-2 px-3">Previous</button>
                @endif
                <button name="{{ $currentStep < 4 ? 'next' : 'submit' }}" class="bg-[#4169E1] text-black font-inter w-fit py-2 px-3">{{ $currentStep < 4 ? 'Next' : 'Submit' }}</button>
            </div>
        </form>
    </div>

    <!-- steps div -->
    <div class="w-auto h-fit border bg-[#f5f5f5] border-[#1E1E1E] border-opacity-25 flex flex-row py-10 pl-7 pr-9 gap-3 relative overflow-hidden rounded">
        <!-- Progress section on the left (vertical alignment) -->
        <div class="flex flex-col items-center gap-1">
            <div class="w-8 h-8 bg-blue-500 text-white rounded-full"></div>
            <div class="flex-grow w-[3px] bg-gray-300"></div>
            <div class="w-8 h-8 bg-gray-300 text-white rounded-full"></div>
            <div class="flex-grow w-[3px] bg-gray-300"></div>
            <div class="w-8 h-8 bg-gray-300 text-white rounded-full"></div>
            <div class="flex-grow w-[3px] bg-gray-300"></div>
            <div class="w-8 h-8 bg-gray-300 text-white rounded-full"></div>
        </div>

        <!-- Steps section on the right -->
        <div class="flex flex-col space-y-[40px]">
            <div>
                <p class="font-inter text-[12px]">Step 1</p>
                <h1 class="font-bold font-raleway text-[14px]">Personal and Contact Details</h1>
            </div>
            <div>
                <p class="font-inter text-[12px]">Step 2</p>
                <h1 class="font-bold font-raleway text-[14px]">Family Information</h1>
            </div>
            <div>
                <p class="font-inter text-[12px]">Step 3</p>
                <h1 class="font-bold font-raleway text-[14px] w-[80%]">Employment, Education, and Health Details</h1>
            </div>
            <div>
                <p class="font-inter text-[12px]">Step 4</p>
                <h1 class="font-bold font-raleway text-[14px]">Review and Confirmation</h1>
            </div>
        </div>
        <img class="absolute w-[500px] h-[60px] rotate-90 right-[-175px] bottom-[170px]" src="{{ asset( 'images/profile_banner.png')}}" alt="">
    </div>
</div>



@if ($errors->any())
<div class="text-red-500">
    <ul>
        @foreach ($errors->all() as $error)
        <li>{{ $error }}</li>
        @endforeach
    </ul>
</div>
@endif

@endsection