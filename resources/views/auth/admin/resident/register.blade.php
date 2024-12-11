@extends('layouts.admin')

@section('content')
<!-- parent div for form and steps -->
<div class="flex flex-row p-10 gap-10 ">
    <!-- parent div for form-->

    <div class="flex flex-col">
        @if ($errors->any())
        <div class="bg-red-100 border border-red-400 text-red-700 px-4 py-3 rounded relative" role="alert">
            <ul>
                @foreach ($errors->all() as $error)
                <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div>
        @endif

        <form enctype="multipart/form-data" class="flex flex-col gap-5 items-end h-full border border-[#1e1e1e] border-opacity-25 rounded-lg  bg-slate-200 p-2" action="{{ route('admin.resident.store') }}" method="POST">
            @csrf
            <div class="border border-[#1e1e1e] border-opacity-25 rounded-lg bg-[#fafafa] p-5 w-full">
                @include('auth.admin.resident.register_partials.step-1')
            </div>
            <div class="border border-[#1e1e1e] border-opacity-25 rounded-lg bg-[#fafafa] p-5 w-full">
                @include('auth.admin.resident.register_partials.step-2a')
            </div>
            <div class="border border-[#1e1e1e] border-opacity-25 rounded-lg bg-[#fafafa] p-5 w-full">
                @include('auth.admin.resident.register_partials.step-2b')
            </div>
            <div class="border border-[#1e1e1e] border-opacity-25 rounded-lg bg-[#fafafa] p-5 w-full">
                @include('auth.admin.resident.register_partials.step-3')
            </div>
            <div class="flex justify-center items-center w-full">
                <button class="px-3 py-2 bg-barangay-main rounded-lg text-white w-[25%]">Submit</button>
            </div>
        </form>
    </div>
</div>

@endsection