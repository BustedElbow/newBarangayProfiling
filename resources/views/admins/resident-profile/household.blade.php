<div class="bg-white rounded-lg shadow-md mb-4">
    <div class="p-4 cursor-pointer flex justify-between items-center" id="household-header">
        <h3 class="text-lg font-semibold">Household</h3>
        <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 9l-7 7-7-7" />
        </svg>
    </div>

    <div id="household-content" class="px-4 pb-4 hidden">
        @if($resident->householdMember)
        <p class="text-gray-500">Household Name: {{ $resident->householdMember->household->household_name }}</p>
        <div class="overflow-x-auto">
            <table class="min-w-full">
                <thead>
                    <tr class="bg-gray-50">
                        <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase">Name</th>
                        <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase">Role</th>
                    </tr>
                </thead>
                <tbody class="bg-white divide-y divide-gray-200">
                    @foreach($resident->householdMember->household->members as $member)
                    <tr class="border-b {{ $member->resident_id == $resident->resident_id ? 'bg-yellow-100' : '' }}">
                        <td class="px-6 py-4 whitespace-nowrap">
                            {{ $member->resident->first_name }}
                            {{ $member->resident->last_name }}
                        </td>
                        <td class="px-6 py-4 whitespace-nowrap">
                            {{ $member->is_head ? 'Head' : 'Member' }}
                            @if($member->is_head)
                            <span class="text-sm text-gray-500">(Current Head)</span>
                            @endif
                        </td>
                    </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
        @else
        <p class="text-gray-500">No household assigned.</p>
        @endif
    </div>
</div>