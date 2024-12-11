@extends('layouts.admin')

@section('content')
<div class="p-6 lg:p-8">
    <!-- Header -->
    <div class="mb-8">
        <div class="flex items-center justify-between">
            <div>
                <h2 class="text-2xl font-bold text-gray-900">{{ $household->household_name }}</h2>
                <p class="mt-1 text-sm text-gray-500">Household Details</p>
            </div>
            <a href="{{ route('admin.households') }}"
                class="bg-gray-100 text-gray-600 px-4 py-2 rounded-lg hover:bg-gray-200">
                Back to List
            </a>
        </div>
    </div>

    <!-- Household Head Section -->
    <div class="bg-white rounded-lg shadow p-6 mb-6">
        <h3 class="text-lg font-semibold mb-4">Household Head</h3>
        @php
        $head = $household->members->where('is_head', true)->first();
        @endphp
        @if($head)
        <div class="flex items-center">
            <div class="h-12 w-12 rounded-full bg-barangay-main flex items-center justify-center text-white">
                {{ substr($head->resident->first_name, 0, 1) }}
            </div>
            <div class="ml-4">
                <div class="font-medium text-gray-900">
                    {{ $head->resident->first_name }} {{ $head->resident->last_name }}
                </div>
                <div class="text-sm text-gray-500">Head of Household</div>
            </div>
        </div>
        @else
        <p class="text-gray-500">No Head Assigned</p>
        @endif
    </div>

    <!-- Members List -->
    <div class="bg-white rounded-lg shadow">
        <div class="p-6">
            <h3 class="text-lg font-semibold mb-4">Household Members</h3>
            <div class="space-y-4">
                @foreach($household->members->where('is_head', false) as $member)
                <div class="flex items-center justify-between p-4 bg-gray-50 rounded-lg">
                    <div class="flex items-center">
                        <div class="h-10 w-10 rounded-full bg-gray-200 flex items-center justify-center text-gray-600">
                            {{ substr($member->resident->first_name, 0, 1) }}
                        </div>
                        <div class="ml-3">
                            <div class="font-medium text-gray-900">
                                {{ $member->resident->first_name }} {{ $member->resident->last_name }}
                            </div>
                            <div class="text-sm text-gray-500">Member</div>
                        </div>
                    </div>
                </div>
                @endforeach
                @if($household->members->where('is_head', false)->isEmpty())
                <p class="text-gray-500 text-center py-4">No other members</p>
                @endif
            </div>
        </div>
    </div>
</div>
@endsection