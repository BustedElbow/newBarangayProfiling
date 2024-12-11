@extends('layouts.admin')

@section('content')
<div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 py-8">
    <!-- Header -->
    <div class="mb-8 flex items-center justify-between">
        <div>
            <h2 class="text-2xl font-bold text-gray-900">{{ $household->household_name }}</h2>
            <p class="mt-1 text-sm text-gray-500">Household Details and Members</p>
        </div>
        <a href="{{ route('admin.households') }}"
            class="inline-flex items-center px-4 py-2 rounded-lg bg-white border border-gray-300 text-sm font-medium text-gray-700 hover:bg-gray-50 transition-colors duration-200">
            <svg class="w-5 h-5 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10 19l-7-7m0 0l7-7m-7 7h18" />
            </svg>
            Back to List
        </a>
    </div>

    <!-- Household Head Section -->
    <div class="bg-white rounded-xl shadow-sm border border-gray-200 p-6 mb-6">
        <h3 class="text-lg font-semibold text-gray-900 mb-4">Household Head</h3>
        @php
        $head = $household->members->where('is_head', true)->first();
        @endphp
        @if($head)
        <a href="{{ route('admin.resident.profile', ['residentId' => $head->resident->resident_id]) }}"
            class="group block">
            <div class="flex items-center p-4 rounded-lg hover:bg-gray-50 transition-colors duration-200">
                <div class="h-12 w-12 rounded-full bg-barangay-main flex items-center justify-center text-white font-medium">
                    {{ substr($head->resident->first_name, 0, 1) }}
                </div>
                <div class="ml-4 flex-grow">
                    <div class="font-medium text-gray-900 group-hover:text-barangay-main transition-colors duration-200">
                        {{ $head->resident->first_name }} {{ $head->resident->last_name }}
                    </div>
                    <div class="text-sm text-gray-500">Head of Household</div>
                </div>
                <svg class="w-5 h-5 text-gray-400 group-hover:text-barangay-main transition-colors duration-200"
                    fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5l7 7-7 7" />
                </svg>
            </div>
        </a>
        @else
        <p class="text-gray-500">No Head Assigned</p>
        @endif
    </div>

    <!-- Members List -->
    <div class="bg-white rounded-xl shadow-sm border border-gray-200">
        <div class="p-6">
            <h3 class="text-lg font-semibold text-gray-900 mb-4">Household Members</h3>
            <div class="space-y-3">
                @foreach($household->members->where('is_head', false) as $member)
                <a href="{{ route('admin.resident.profile', ['residentId' => $member->resident->resident_id]) }}"
                    class="block">
                    <div class="flex items-center justify-between p-4 bg-gray-50 rounded-lg hover:bg-gray-100 transition-all duration-200 group">
                        <div class="flex items-center flex-grow">
                            <div class="h-10 w-10 rounded-full bg-gray-200 flex items-center justify-center text-gray-600">
                                {{ substr($member->resident->first_name, 0, 1) }}
                            </div>
                            <div class="ml-3">
                                <div class="font-medium text-gray-900 group-hover:text-barangay-main transition-colors duration-200">
                                    {{ $member->resident->first_name }} {{ $member->resident->last_name }}
                                </div>
                                <div class="text-sm text-gray-500">Member</div>
                            </div>
                        </div>
                        <svg class="w-5 h-5 text-gray-400 group-hover:text-barangay-main transition-colors duration-200"
                            fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5l7 7-7 7" />
                        </svg>
                    </div>
                </a>
                @endforeach
                @if($household->members->where('is_head', false)->isEmpty())
                <div class="text-center py-8">
                    <svg class="mx-auto h-12 w-12 text-gray-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                            d="M12 4.354a4 4 0 110 5.292M15 21H3v-1a6 6 0 0112 0v1zm0 0h6v-1a6 6 0 00-9-5.197M13 7a4 4 0 11-8 0 4 4 0 018 0z" />
                    </svg>
                    <p class="mt-2 text-sm text-gray-500">No other members in this household</p>
                </div>
                @endif
            </div>
        </div>
    </div>
</div>
@endsection