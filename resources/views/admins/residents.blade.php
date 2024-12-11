@extends('layouts.admin')

@section('content')
<div class="flex h-screen justify-center pt-12 w-fit"> <!-- Full viewport height with no scroll -->
    <!-- Right Panel -->
    <div class="bg-white h-[800px] w-full border border-gray-300 rounded shadow flex flex-col">
        <!-- Header -->
        <div class="border-b border-gray-300 p-4 w-[850px]">
            <h2 class="text-lg font-semibold text-gray-700">Residents List</h2>
        </div>

        <!-- Resident List -->
        <div class="p-4 space-y-4 flex-1 overflow-y-auto">
            @forelse ($residents as $resident)
            <a
                class="block p-4 bg-gray-100 hover:bg-barangay-main hover:text-white rounded transition duration-200"
                href="{{ route('admin.resident.profile', ['residentId' => $resident->resident_id]) }}">
                <div class="flex items-center gap-4">
                    <!-- Resident Image -->
                    <img
                        class="w-12 h-12 border rounded-full object-cover"
                        src="{{ $resident->image ?? 'https://via.placeholder.com/150' }}"
                        alt="Resident Image">
                    <!-- Resident Name -->
                    <span class="font-medium text-gray-800">
                        {{ $resident->last_name }}, {{ $resident->first_name }} {{ $resident->middle_name }}
                    </span>
                </div>
            </a>
            @empty
            <!-- No Residents Found -->
            <div class="text-center text-gray-500 py-4">
                No residents found.
            </div>
            @endforelse
        </div>

        <!-- Pagination -->
        <div class="border-t border-gray-300 p-4">
            {{ $residents->links() }}
        </div>
    </div>
</div>
@endsection