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
        {{ $clearance->status === 'for_claim' ? 'bg-blue-100 text-blue-800' : '' }}
        {{ $clearance->status === 'claimed' ? 'bg-gray-100 text-gray-800' : '' }}
        {{ $clearance->status === 'rejected' ? 'bg-red-100 text-red-800' : '' }}">
                                {{ ucfirst(str_replace('_', ' ', $clearance->status)) }}
                            </span>
                        </td>
                        <td class="px-6 py-4 whitespace-nowrap text-sm font-medium">
                            @if($clearance->status === 'pending')
                            <button onclick="approveClearance('{{ $clearance->clearance_id }}')"
                                class="text-white bg-green-500 hover:bg-green-600 px-3 py-1 rounded-md mr-2">
                                Approve
                            </button>
                            <button onclick="rejectClearance('{{ $clearance->clearance_id }}')"
                                class="text-white bg-red-500 hover:bg-red-600 px-3 py-1 rounded-md">
                                Reject
                            </button>
                            @elseif($clearance->status === 'approved')
                            <button onclick="markForClaim('{{ $clearance->clearance_id }}')"
                                class="text-white bg-blue-500 hover:bg-blue-600 px-3 py-1 rounded-md">
                                Mark for Claim
                            </button>
                            @elseif($clearance->status === 'for_claim')
                            <button onclick="markAsClaimed('{{ $clearance->clearance_id }}')"
                                class="text-white bg-gray-500 hover:bg-gray-600 px-3 py-1 rounded-md">
                                Mark as Claimed
                            </button>
                            @endif

                            @if($clearance->status === 'rejected')
                            <div class="text-sm text-red-600 mt-1">
                                Reason: {{ $clearance->rejection_reason }}
                            </div>
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

<script>
    function approveClearance(id) {
        if (!confirm('Are you sure you want to approve this clearance?')) return;

        fetch(`/admin/clearances/${id}/approve`, {
                method: 'PATCH',
                headers: {
                    'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').content,
                    'Accept': 'application/json',
                    'Content-Type': 'application/json'
                }
            })
            .then(response => response.json())
            .then(data => {
                if (data.success) {
                    window.location.reload();
                } else {
                    alert(data.message || 'Failed to approve clearance');
                }
            })
            .catch(error => {
                console.error('Error:', error);
                alert('An error occurred while processing the request');
            });
    }

    function rejectClearance(id) {
        const reason = prompt('Please enter reason for rejection:');
        if (!reason) return;

        fetch(`/admin/clearances/${id}/reject`, {
                method: 'PATCH',
                headers: {
                    'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').content,
                    'Accept': 'application/json',
                    'Content-Type': 'application/json'
                },
                body: JSON.stringify({
                    reason: reason
                })
            })
            .then(response => response.json())
            .then(data => {
                if (data.success) {
                    window.location.reload();
                } else {
                    alert(data.message || 'Failed to reject clearance');
                }
            })
            .catch(error => {
                console.error('Error:', error);
                alert('An error occurred while processing the request');
            });
    }

    function markForClaim(id) {
        if (!confirm('Mark this clearance as ready for claim?')) return;

        fetch(`/admin/clearances/${id}/for-claim`, {
                method: 'PATCH',
                headers: {
                    'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').content,
                    'Accept': 'application/json',
                    'Content-Type': 'application/json'
                }
            })
            .then(response => response.json())
            .then(data => {
                if (data.success) {
                    window.location.reload();
                } else {
                    alert('Failed to mark clearance for claim');
                }
            })
            .catch(error => {
                console.error('Error:', error);
                alert('An error occurred while processing the request');
            });
    }

    function markAsClaimed(id) {
        if (!confirm('Mark this clearance as claimed?')) return;

        fetch(`/admin/clearances/${id}/claim`, {
                method: 'PATCH',
                headers: {
                    'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').content,
                    'Accept': 'application/json',
                    'Content-Type': 'application/json'
                }
            })
            .then(response => response.json())
            .then(data => {
                if (data.success) {
                    window.location.reload();
                } else {
                    alert('Failed to mark clearance as claimed');
                }
            })
            .catch(error => {
                console.error('Error:', error);
                alert('An error occurred while processing the request');
            });
    }
</script>
@endsection