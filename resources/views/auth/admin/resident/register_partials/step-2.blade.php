<div class="flex flex-col items-center gap-9">
    <div class="flex flex-col gap-5">
        <div id="familyMember" class="flex flex-col gap-3">

        </div>
        <button type="button" onclick="addNewFamilyMemberField()" class="font-inter bg-barangay-main py-2 px-3 text-white">Add New Family Member</button>

        <input type="hidden" id="household_action" name="household_action" value="">
        <input type="hidden" id="existing_household_id" name="existing_household_id">

        <!-- UI for creating a new household -->
        <div id="createNewHousehold" class="flex flex-col hidden">
            <input type="text" name="new_household_name" value="{{ session('register_data.last_name') }} Household">
            <div class="flex gap-2">
                <span>Current Head: You</span>
                <span>{{ session('register_data.last_name') }}, {{ session('register_data.first_name') }} {{ session('register_data.middle_name') }}</span>
            </div>
            <button onclick="hideUIforNewHousehold()" type="button" class="font-inter text-white py-2 px-3 bg-barangay-main">Cancel</button>
        </div>

        <div class="flex gap-5">
            <button type="button" onclick="openExistingHouseholdsModal()" class="bg-[#4169E1] text-white font-inter w-fit py-2 px-3">Add Existing Household</button>
            <button type="button" onclick="showUIforNewHousehold()" class="bg-[#4169E1] text-white font-inter w-fit py-2 px-3">Create New Household</button>
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

<!-- Modal for Connecting Existing Resident -->
<div id="connectResident" class="z-50 fixed inset-0 bg-gray-800 bg-opacity-50 flex items-center justify-center hidden">
    <!-- Modal Content -->
    <div class="bg-white w-1/2 h-1/2 p-6 rounded-lg shadow-lg">
        <h2 class="text-lg font-bold mb-4">Residents</h2>
        <div class="flex items-center gap-3 mb-4">
            <input
                id="residentSearchInput"
                class="bg-gray-100 border border-gray-300 p-2 rounded w-full focus:outline-none focus:ring-2 focus:ring-barangay-main"
                type="text"
                placeholder="Search Residents">
            <button
                onclick="searchResident()"
                class="bg-barangay-main text-white px-4 py-2 rounded hover:bg-barangay-dark transition"
                type="button">
                Search
            </button>
        </div>
        <!-- List of Residents -->
        <div id="residentList" class="border border-gray-300 rounded p-4 overflow-y-auto h-1/2">
            <!-- Dynamic content will be loaded here -->
        </div>
        <div class="flex justify-end mt-4">
            <button
                onclick="closeConnectResidentModal()"
                class="bg-barangay-main text-white px-4 py-2 rounded hover:bg-barangay-dark transition"
                type="button">
                Cancel
            </button>
        </div>
    </div>
</div>

<script>
    let familyMemberCounter = 0;
    let currentFamilyMemberIndex = null;

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
                            joinHousehold(household.household_id);
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

    function joinHousehold(householdId) {
        // Assign the selected household ID to a hidden input for form submission
        document.getElementById('household_action').value = 'existing';
        document.getElementById('existing_household_id').value = householdId;

        // Close the modal
        closeExistingHouseholdsModal();
    }


    function addNewFamilyMemberField() {
        const newMemberDiv = document.createElement('div')
        newMemberDiv.classList.add('flex', 'gap-5', 'family-member')

        const nameContainer = document.createElement('div')
        nameContainer.classList.add('flex', 'flex-col', 'gap-2')

        const nameLabel = document.createElement('label')
        nameLabel.classList.add('font-inter', 'font-semibold')
        nameLabel.textContent = 'Name'

        const nameInput = document.createElement('input')
        nameInput.name = `family_members[${familyMemberCounter}][name]`
        nameInput.classList.add('bg-[#f5f5f5]', 'border-black', 'border-b', 'p-2', 'font-inter', 'focus:outline-none', 'focus:bg-[#f5f5f5]', 'w-[323px]')

        const residentIdInput = document.createElement('input')
        residentIdInput.type = 'hidden'
        residentIdInput.name = `family_members[${familyMemberCounter}][resident_id]`

        nameContainer.appendChild(nameLabel)
        nameContainer.appendChild(nameInput)
        nameContainer.appendChild(residentIdInput)

        const relationshipContainer = document.createElement('div')
        relationshipContainer.classList.add('flex', 'flex-col', 'gap-2')

        const relationshipLabel = document.createElement('label')
        relationshipLabel.classList.add('font-inter', 'font-semibold')
        relationshipLabel.textContent = 'Relationship'

        const relationshipInput = document.createElement('input')
        relationshipInput.name = `family_members[${familyMemberCounter}][relationship]`
        relationshipInput.classList.add('bg-[#f5f5f5]', 'border-black', 'border-b', 'p-2', 'font-inter', 'focus:outline-none', 'focus:bg-[#f5f5f5]', 'w-[323px]')

        relationshipContainer.appendChild(relationshipLabel)
        relationshipContainer.appendChild(relationshipInput)

        const removeButton = document.createElement('button')
        removeButton.type = 'button'
        removeButton.textContent = 'X'
        removeButton.classList.add('font-inter')
        removeButton.onclick = () => {
            newMemberDiv.remove()
        }

        const connectToResidentButton = document.createElement('button')
        connectToResidentButton.type = 'button'
        connectToResidentButton.textContent = 'key'
        connectToResidentButton.classList.add('font-inter', 'p-1', 'bg-barangay-main', 'text-white')
        connectToResidentButton.onclick = () => {
            const index = Array.from(familyMember.children).indexOf(newMemberDiv);
            openConnectResidentModal(index);
        }

        newMemberDiv.appendChild(connectToResidentButton)
        newMemberDiv.appendChild(nameContainer)
        newMemberDiv.appendChild(relationshipContainer)
        newMemberDiv.appendChild(removeButton)

        document.getElementById('familyMember').appendChild(newMemberDiv)

        familyMemberCounter++
    }

    function loadResidents(search = '') {
        const residentList = document.getElementById('residentList');
        residentList.innerHTML = '<p>Loading...</p>';

        fetch(`/fetchresidents?search=${search}`)
            .then(response => response.json())
            .then(data => {
                residentList.innerHTML = '';
                if (data.length > 0) {
                    data.forEach(resident => {
                        const residentDiv = document.createElement('div');
                        residentDiv.classList.add('flex', 'justify-between', 'items-center');

                        const residentInfo = document.createElement('span');
                        residentInfo.textContent = `${resident.first_name} ${resident.last_name}`;

                        const connectButton = document.createElement('button');
                        connectButton.type = 'button'
                        connectButton.textContent = 'Connect';
                        connectButton.classList.add('bg-barangay-main', 'text-white', 'p-2');
                        connectButton.onclick = () => {
                            connectResidentToFamilyMember(resident);
                        };

                        residentDiv.appendChild(residentInfo);
                        residentDiv.appendChild(connectButton);

                        residentList.appendChild(residentDiv);
                    });
                } else {
                    residentList.innerHTML = '<p>No residents found.</p>';
                }
            })
            .catch(error => {
                console.error('Error fetching residents:', error);
                residentList.innerHTML = '<p>Error loading residents.</p>';
            });
    }

    function connectResidentToFamilyMember(resident) {
        if (currentFamilyMemberIndex !== null) {
            const residentIdInput = document.querySelector(
                `input[name="family_members[${currentFamilyMemberIndex}][resident_id]"]`
            );
            const nameInput = document.querySelector(
                `input[name="family_members[${currentFamilyMemberIndex}][name]"]`
            );

            if (residentIdInput && nameInput) {
                residentIdInput.value = resident.resident_id;
                nameInput.value = `${resident.first_name} ${resident.last_name}`;
            }

            closeConnectResidentModal();
        }
    }

    function searchResident() {
        const searchInput = document.getElementById('residentSearchInput').value
        loadResidents(searchInput)
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

    function closeConnectResidentModal() {
        document.getElementById('connectResident').classList.add('hidden')
        currentFamilyMemberIndex = null
    }

    function openConnectResidentModal(index) {
        console.log('Opening modal for index: ', index)
        currentFamilyMemberIndex = index
        document.getElementById('connectResident').classList.remove('hidden')
    }
</script>