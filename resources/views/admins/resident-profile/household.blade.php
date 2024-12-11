<div class="bg-white rounded-lg shadow-md mb-4">
    <div class="p-4 cursor-pointer flex justify-between items-center" id="household-header">
        <h3 class="text-lg font-semibold">Household</h3>
        <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 9l-7 7-7-7" />
        </svg>
    </div>

    <div id="household-content" class="px-4 pb-4 hidden">
        @php
        dump([
        'resident_id' => $residentData->resident_id,
        'household_member' => $residentData->householdMember,
        'household' => $residentData->householdMember?->household,
        'members' => $residentData->householdMember?->household?->members
        ]);
        @endphp
        @if($residentData->householdMember)
        <p class="text-gray-500">Household Name: {{ $residentData->householdMember->household->household_name }}</p>
        <div class="overflow-x-auto">
            <table class="min-w-full">
                <thead>
                    <tr class="bg-gray-50">
                        <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase">Name</th>
                        <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase">Role</th>
                    </tr>
                </thead>
                <tbody class="bg-white divide-y divide-gray-200">
                    @foreach($residentData->householdMember->household->members as $member)
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
        @if(!$residentData->householdMember->is_head)
        <button type="button" onclick="leaveHousehold()" class="bg-red-500 text-white font-inter w-fit py-2 px-3 mt-4">Leave Household</button>
        @endif
        @else
        <p class="text-gray-500">No household assigned.</p>
        <button type="button" onclick="openExistingHouseholdsModal()" class="bg-[#4169E1] text-white font-inter w-fit py-2 px-4 mt-4 rounded-md">Join Existing Household</button>
        @endif
    </div>
</div>

<!-- Modal For Existing Household -->
<div id="existingHouseholdModal" class="fixed inset-0 bg-gray-800 bg-opacity-50 flex items-center justify-center hidden z-50">
    <div class="bg-white w-1/2 h-1/2 p-4 rounded">
        <h2 class="text-lg font-bold mb-4">Join an Existing Household</h2>
        <div>
            <input
                id="householdSearchInput"
                class="bg-gray-100 border border-gray-300 p-2 rounded w-full focus:outline-none"
                type="text"
                placeholder="Search Household"
                onkeyup="searchHousehold()">
        </div>
        <div class="border border-black rounded p-2 overflow-y-auto h-1/2 mt-4" id="householdList">
            <!-- List of Households -->
        </div>
        <div class="mt-4 flex justify-end space-x-4">
            <button onclick="closeExistingHouseholdsModal()" type="button" class="font-inter text-white bg-gray-500 py-2 px-4 rounded">Cancel</button>
        </div>
    </div>
</div>

<script>
    // Function to open the modal and fetch household data
    function openExistingHouseholdsModal() {
        // Show the modal
        document.getElementById('existingHouseholdModal').classList.remove('hidden');

        // Fetch households from the server
        fetch('/fetchhouseholds')
            .then(response => response.json())
            .then(data => {
                const householdList = document.getElementById('householdList');
                householdList.innerHTML = ''; // Clear any previous household data

                // Populate the list with fetched households
                data.forEach(household => {
                    const householdItem = document.createElement('div');
                    householdItem.classList.add('p-2', 'border', 'rounded', 'cursor-pointer', 'hover:bg-gray-100');
                    householdItem.innerHTML = `
                        <span>${household.household_name}</span>
                        <button 
                            class="bg-blue-500 text-white py-1 px-2 rounded ml-4"
                            onclick="assignToHousehold(${household.household_id})">
                            Join
                        </button>
                    `;
                    householdList.appendChild(householdItem);
                });
            })
            .catch(error => {
                console.error('Error fetching households:', error);
                alert('Failed to fetch households.');
            });
    }

    // Function to close the modal
    function closeExistingHouseholdsModal() {
        document.getElementById('existingHouseholdModal').classList.add('hidden');
    }

    // Function to assign the resident to a selected household
    function assignToHousehold(householdId) {
        const residentId = "{{ $resident->resident_id }}";

        fetch(`/admin/residents/${residentId}/update-household`, {
                method: 'PATCH',
                headers: {
                    'Content-Type': 'application/json',
                    'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').content,
                    'Accept': 'application/json'
                },
                body: JSON.stringify({
                    household_id: householdId
                })
            })
            .then(response => response.json())
            .then(data => {
                if (data.success) {
                    alert('Household updated successfully!');
                    window.location.reload();
                } else {
                    throw new Error('Failed to update household.');
                }
            })
            .catch(error => {
                console.error('Error:', error);
                alert('Failed to assign household.');
            });
    }

    function leaveHousehold() {
        if (!confirm('Are you sure you want to leave this household?')) {
            return;
        }

        const residentId = "{{ $resident->resident_id }}";

        fetch(`/admin/residents/${residentId}/leave-household`, {
                method: 'DELETE',
                headers: {
                    'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').content,
                    'Accept': 'application/json'
                },
                credentials: 'same-origin'
            })
            .then(async response => {
                const data = await response.json();
                if (!response.ok) throw new Error(data.message || 'Failed to leave household');
                if (data.success) {
                    alert(data.message);
                    window.location.reload();
                } else {
                    throw new Error(data.message);
                }
            })
            .catch(error => {
                console.error('Error:', error);
                alert(error.message);
            });
    }
</script>