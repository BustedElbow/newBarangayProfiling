<div class="flex flex-col items-center gap-9">
    <div class="flex flex-col gap-5">
        <div id="familyMember" class="flex flex-col gap-3">

        </div>
        <button type="button" onclick="addNewFamilyMemberField()" class="font-inter bg-barangay-main py-2 px-3 text-white rounded-lg">Add Family Member</button>

        <input type="hidden" id="household_action" name="household_action" value="">
        <input type="hidden" id="existing_household_id" name="existing_household_id">

       
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