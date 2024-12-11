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
            <!-- Existing table row content -->
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