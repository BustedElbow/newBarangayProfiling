@extends('layouts.admin')

@section('content')
<div class="p-10 flex justify-center space-x-10 h-fit">
    <div class="flex-1 bg-[#fafafa] p-6 rounded-lg border border-[#1e1e1e] border-opacity-25">
        <div class="flex justify-between items-center mb-6">
            <div>
                <h2 class="text-2xl font-semibold text-barangay-main">Barangay Clearance</h2>
                <p class="text-gray-600">Process barangay clearance requests</p>
            </div>
        </div>

        <!-- Clearances Table -->
        <div class="overflow-x-auto">
            <table class="min-w-full divide-y divide-gray-200">
                <thead class="bg-gray-50">
                    <tr>
                        <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase">Requester</th>
                        <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase">Purpose</th>
                        <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase">Date Requested</th>
                        <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase">Status</th>
                        <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase">Actions</th>
                    </tr>
                </thead>
                <tbody class="bg-white divide-y divide-gray-200">
                    @forelse($clearances as $clearance)
                    <tr>
                        <td class="px-6 py-4 whitespace-nowrap">
                            <div class="flex items-center">
                                <div>
                                    <div class="text-sm font-medium text-gray-900">
                                        {{ $clearance->resident->last_name }},
                                        {{ $clearance->resident->first_name }}
                                    </div>
                                    <div class="text-sm text-gray-500">
                                        ID: {{ $clearance->resident->identification_number }}
                                    </div>
                                </div>
                            </div>
                        </td>
                        <td class="px-6 py-4">
                            <div class="text-sm text-gray-900">{{ $clearance->purpose }}</div>
                        </td>
                        <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-500">
                            {{ $clearance->request_date->format('M d, Y') }}
                        </td>
                        <td class="px-6 py-4 whitespace-nowrap">
                            <span class="px-2 inline-flex text-xs leading-5 font-semibold rounded-full 
                                {{ $clearance->status === 'pending' ? 'bg-yellow-100 text-yellow-800' : '' }}
                                {{ $clearance->status === 'approved' ? 'bg-green-100 text-green-800' : '' }}
                                {{ $clearance->status === 'rejected' ? 'bg-red-100 text-red-800' : '' }}">
                                {{ ucfirst($clearance->status) }}
                            </span>
                        </td>
                        <td class="px-6 py-4 whitespace-nowrap text-sm font-medium">
                            @if($clearance->status === 'pending')
                            <button class="text-white bg-green-500 hover:bg-green-600 px-3 py-1 rounded-md mr-2">
                                Approve
                            </button>
                            <button class="text-white bg-red-500 hover:bg-red-600 px-3 py-1 rounded-md">
                                Reject
                            </button>
                            @endif
                        </td>
                    </tr>
                    @empty
                    <tr>
                        <td colspan="5" class="px-6 py-4 text-center text-gray-500">
                            No clearance requests found
                        </td>
                    </tr>
                    @endforelse
                </tbody>
            </table>
        </div>
    </div>
</div>
@endsection