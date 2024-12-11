<div id="createNewHousehold" class="hidden w-full bg-white rounded-lg shadow-md p-6">
    <div class="space-y-6">
        <!-- Header -->
        <div class="border-b pb-4">
            <h3 class="text-xl font-semibold text-gray-900">Create New Household</h3>
            <p class="text-sm text-gray-500 mt-1">Set up your household as the head</p>
        </div>

        <!-- Form Content -->
        <div class="space-y-4">
            <!-- Household Name Input -->
            <div>
                <label for="new_household_name" class="flex items-center gap-2 text-sm font-medium text-gray-700">
                    <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 12l2-2m0 0l7-7 7 7M5 10v10a1 1 0 001 1h3m10-11l2 2m-2-2v10a1 1 0 01-1 1h-3m-6 0a1 1 0 001-1v-4a1 1 0 011-1h2a1 1 0 011 1v4a1 1 0 001 1m-6 0h6" />
                    </svg>
                    Household Name
                </label>
                <input type="text"
                    name="new_household_name"
                    class="mt-1 w-full px-4 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-barangay-main focus:border-barangay-main transition-colors"
                    value="{{ session('register_data.last_name') }} Household">
            </div>

            <!-- Head Preview -->
            <div class="bg-gray-50 rounded-lg p-4">
                <h4 class="text-sm font-medium text-gray-700 mb-3 flex items-center gap-2">
                    <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M16 7a4 4 0 11-8 0 4 4 0 018 0zM12 14a7 7 0 00-7 7h14a7 7 0 00-7-7z" />
                    </svg>
                    Household Head
                </h4>
                <div class="flex items-center gap-3">
                    <div class="w-10 h-10 bg-barangay-main rounded-full flex items-center justify-center">
                        <span class="text-white font-medium">
                            {{ substr(session('register_data.first_name'), 0, 1) }}
                        </span>
                    </div>
                    <div>
                        <p class="font-medium text-gray-900">
                            {{ session('register_data.last_name') }}, {{ session('register_data.first_name') }} {{ session('register_data.middle_name') }}
                        </p>
                        <p class="text-sm text-gray-500">Head of Household</p>
                    </div>
                </div>
            </div>
        </div>

        <!-- Action Buttons -->
        <div class="flex justify-end gap-3 pt-4 border-t">
            <button type="button"
                onclick="hideUIforNewHousehold()"
                class="px-4 py-2 text-gray-700 bg-gray-100 rounded-lg hover:bg-gray-200 transition-colors">
                Cancel
            </button>
            <button type="button"
                class="px-4 py-2 bg-barangay-main text-white rounded-lg hover:bg-opacity-90 transition-colors">
                Create Household
            </button>
        </div>
    </div>
</div>

<div class="flex gap-5">
    <button type="button" onclick="openExistingHouseholdsModal()" class="bg-[#4169E1] text-white font-inter w-fit py-2 px-3">Add Existing Household</button>
    <button type="button" onclick="showUIforNewHousehold()" class="bg-[#4169E1] text-white font-inter w-fit py-2 px-3">Create New Household</button>
</div>

<div id="selectedHouseholdPreview" class="hidden w-full bg-white rounded-lg shadow-md p-6">
    <div class="space-y-4">
        <div class="flex justify-between items-center">
            <h3 class="text-lg font-semibold text-gray-900">Selected Household</h3>
            <button type="button" onclick="removeSelectedHousehold()"
                class="text-gray-400 hover:text-red-500 p-1 rounded-full hover:bg-red-50">
                <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12" />
                </svg>
            </button>
        </div>
        <div class="bg-gray-50 rounded-lg p-4">
            <div id="selectedHouseholdInfo" class="space-y-2">
                <!-- Household info will be populated here -->
            </div>
        </div>
    </div>
</div>


<!-- Modal For Existing Household -->
<div id="existingHouseholdModal" class="fixed inset-0 bg-gray-800 bg-opacity-50 flex items-center justify-center hidden z-50">
    <div class="bg-white w-1/2 h-1/2 p-4">
        <h2>Households</h2>
        <div>
            <input
                id="householdSearchInput"
                class="bg-gray-100 border border-gray-300 p-2 rounded w-full focus:outline-none"
                type="text"
                placeholder="Search Household"
                onkeyup="searchHousehold()">
            <button type="button" onclick="searchHousehold()">Search</button>
        </div>
        <div class="border border-black rounded p-2 overflow-y-auto h-1/2" id="householdList">
            <!-- List of Households -->
        </div>
        <button onclick="closeExistingHouseholdsModal()" type="button" class="font-inter text-white bg-barangay-main py-2 px-3">Cancel</button>
    </div>
</div>

<script>
    let selectedHousehold = null;

    function loadHouseholds(search = '') {
        const householdList = document.getElementById('householdList');
        householdList.innerHTML = '<p>Loading...</p>';

        fetch(`/fetchhouseholds?search=${search}`)
            .then(response => response.json())
            .then(data => {
                householdList.innerHTML = '';
                if (data.length > 0) {
                    data.forEach(household => {
                        const householdDiv = document.createElement('div');
                        householdDiv.classList.add('flex', 'justify-between', 'items-center', 'p-2', 'border-b');

                        const householdInfo = document.createElement('span');
                        const head = household.members[0]?.resident;
                        const headName = head ? `${head.first_name} ${head.last_name}` : 'No Head Assigned';
                        householdInfo.textContent = `${household.household_name} (Head: ${headName})`;

                        const joinButton = document.createElement('button');
                        joinButton.type = 'button';
                        joinButton.textContent = 'Join';
                        joinButton.classList.add('bg-barangay-main', 'text-white', 'px-4', 'py-2', 'rounded');
                        joinButton.onclick = () => {
                            joinHousehold(household.household_id, household);
                        };

                        householdDiv.appendChild(householdInfo);
                        householdDiv.appendChild(joinButton);

                        householdList.appendChild(householdDiv);
                    });
                } else {
                    householdList.innerHTML = '<p>No households found.</p>';
                }
            })
            .catch(error => {
                console.error('Error fetching households:', error);
                householdList.innerHTML = '<p>Error loading households.</p>';
            });
    }

    function searchHousehold() {
        const searchInput = document.getElementById('householdSearchInput').value;
        loadHouseholds(searchInput);
    }

    function joinHousehold(householdId, household) {
        selectedHousehold = household;

        // Update hidden inputs
        document.getElementById('household_action').value = 'existing';
        document.getElementById('existing_household_id').value = householdId;

        // Update preview
        const previewDiv = document.getElementById('selectedHouseholdPreview');
        const infoDiv = document.getElementById('selectedHouseholdInfo');

        const head = household.members[0]?.resident;
        const headName = head ? `${head.first_name} ${head.last_name}` : 'No Head Assigned';

        infoDiv.innerHTML = `
        <h4 class="font-medium text-gray-900">${household.household_name}</h4>
        <p class="text-sm text-gray-500">Head: ${headName}</p>
        <div class="mt-2 pt-2 border-t border-gray-200">
            <p class="text-sm text-gray-600">Members: ${household.members.length}</p>
        </div>
    `;

        previewDiv.classList.remove('hidden');
        closeExistingHouseholdsModal();
    }

    function removeSelectedHousehold() {
        selectedHousehold = null;
        document.getElementById('household_action').value = '';
        document.getElementById('existing_household_id').value = '';
        document.getElementById('selectedHouseholdPreview').classList.add('hidden');
    }

    function openExistingHouseholdsModal() {
        document.getElementById('existingHouseholdModal').classList.remove('hidden')
    }

    function closeExistingHouseholdsModal() {
        document.getElementById('existingHouseholdModal').classList.add('hidden')
    }

    function showUIforNewHousehold() {
        document.getElementById('household_action').value = 'new'
        document.getElementById('existing_household_id').value = null
        document.getElementById('createNewHousehold').classList.remove('hidden')
    }

    function hideUIforNewHousehold() {
        document.getElementById('household_action').value = ""
        document.getElementById('createNewHousehold').classList.add('hidden')
    }
</script>