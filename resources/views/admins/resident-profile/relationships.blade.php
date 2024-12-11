<div class="bg-white rounded-lg shadow-md mb-4">
    <div class="p-4 cursor-pointer flex justify-between items-center" id="relationships-header">
        <h3 class="text-lg font-semibold">Family Relationships</h3>
        <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 9l-7 7-7-7" />
        </svg>
    </div>

    <div id="relationships-content" class="px-4 pb-4 hidden">
        <form id="relationshipForm" action="{{ route('admin.resident.storeRelationship', $residentData->resident_id) }}" method="POST">
            @csrf
            <button type="button" onclick="addNewRelationshipField()" class="mb-4 inline-flex items-center px-4 py-2 border border-transparent text-sm font-medium rounded-md shadow-sm text-white bg-indigo-600 hover:bg-indigo-700">
                Add New Relationship
            </button>

            <div id="familyMember" class="space-y-4 mb-4">
                <!-- Dynamic fields added here -->
            </div>

            <button id="saveAllRelationshipsBtn" type="submit" class="mb-4 inline-flex items-center px-4 py-2 border border-transparent text-sm font-medium rounded-md shadow-sm text-white bg-green-600 hover:bg-green-700 hidden">
                Save All Relationships
            </button>
        </form>

        @if($residentData->relatedTo->count() > 0)
        <div class="overflow-x-auto">
            <table class="min-w-full">
                <thead>
                    <tr class="bg-gray-50">
                        <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase">Name</th>
                        <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase">Relationship</th>
                        <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase">Actions</th>
                    </tr>
                </thead>
                <tbody class="bg-white divide-y divide-gray-200">
                    @foreach($residentData->relatedTo as $relation)
                    <tr>
                        <td class="px-6 py-4 whitespace-nowrap">
                            @if($relation->resident)
                            {{ $relation->resident->first_name }}
                            {{ $relation->resident->last_name }}
                            @else
                            {{ $relation->name }}
                            @endif
                        </td>
                        <td class="px-6 py-4 whitespace-nowrap">
                            <form action="{{ route('admin.resident.editRelationship', ['relation' => $relation->blood_relation_id]) }}" method="POST" class="flex items-center gap-2">
                                @csrf
                                @method('PUT')
                                <input type="text"
                                    name="relationship"
                                    value="{{ $relation->relationship }}"
                                    class="border-none border rounded px-2 py-1 relationship-field"
                                    disabled>
                                <button type="button"
                                    onclick="enableEditing(this)"
                                    class="text-blue-500 edit-button">
                                    Edit
                                </button>
                                <button type="submit"
                                    class="text-green-500 save-button hidden">
                                    Save
                                </button>
                                <button type="button"
                                    onclick="cancelEditing(this, '{{ $relation->relationship }}')"
                                    class="text-red-500 cancel-button hidden">
                                    Cancel
                                </button>
                            </form>
                        </td>
                        <td class="px-6 py-4 whitespace-nowrap">
                            <form action="{{ route('admin.resident.deleteRelationship', ['relation' => $relation->blood_relation_id]) }}" method="POST">
                                @csrf
                                @method('DELETE')
                                <button type="submit" class="text-red-500">Delete</button>
                            </form>
                        </td>
                    </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
        @else
        <p class="text-gray-500">No family relationships recorded.</p>
        @endif
    </div>
</div>

<!-- Modal -->
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

    function enableEditing(editButton) {
        const form = editButton.closest('form');
        const inputField = form.querySelector('.relationship-field');
        const saveButton = form.querySelector('.save-button');
        const cancelButton = form.querySelector('.cancel-button');

        inputField.disabled = false;

        editButton.classList.add('hidden');
        saveButton.classList.remove('hidden');
        cancelButton.classList.remove('hidden');

        inputField.focus();
    }

    function cancelEditing(cancelButton, originalValue) {
        const form = cancelButton.closest('form');
        const inputField = form.querySelector('.relationship-field');
        const editButton = form.querySelector('.edit-button');
        const saveButton = form.querySelector('.save-button');

        inputField.value = originalValue;

        inputField.disabled = true;

        cancelButton.classList.add('hidden');
        saveButton.classList.add('hidden');
        editButton.classList.remove('hidden');
    }

    function addNewRelationshipField() {
        const familyMemberDiv = document.getElementById('familyMember');
        const newMemberDiv = document.createElement('div');
        newMemberDiv.classList.add('flex', 'items-center', 'gap-4', 'mb-4');

        newMemberDiv.innerHTML = `
    <input type="hidden" name="relationships[${familyMemberCounter}][resident_id]" class="resident-id">
    <div class="flex flex-col gap-2 w-full">
        <input type="text" 
            name="relationships[${familyMemberCounter}][name]" 
            class="bg-[#f5f5f5] border-gray-300 rounded-md p-2 w-full" 
            placeholder="Resident name">
        <input type="text" 
            name="relationships[${familyMemberCounter}][relationship]" 
            class="bg-[#f5f5f5] border-gray-300 rounded-md p-2 w-full" 
            placeholder="Relationship" 
            required>
    </div>
    <button type="button" 
        onclick="openConnectResidentModal(${familyMemberCounter})" 
        class="bg-barangay-main text-white p-2 rounded-md">
        Connect
    </button>
    <button type="button" 
        onclick="removeRelationshipField(this)" 
        class="bg-red-500 text-white p-2 rounded-md">
        Remove
    </button>
    `;

        familyMemberDiv.appendChild(newMemberDiv);
        familyMemberCounter++;

        // Show the save button
        toggleSaveButton();
    }

    function toggleSaveButton() {
        const saveButton = document.getElementById('saveAllRelationshipsBtn');
        const familyMemberDiv = document.getElementById('familyMember');

        if (familyMemberDiv.children.length > 0) {
            saveButton.classList.remove('hidden');
        } else {
            saveButton.classList.add('hidden');
        }
    }

    function removeRelationshipField(button) {
        button.closest('div').remove();
        familyMemberCounter--;

        // Hide the save button if no fields are present
        toggleSaveButton();
    }

    function loadResidents(search = '') {
        const residentList = document.getElementById('residentList');
        residentList.innerHTML = '<p>Loading...</p>';

        fetch(`/fetchresidents?search=${search}`)
            .then(response => response.json())
            .then(data => {
                residentList.innerHTML = '';
                data.forEach(resident => {
                    const div = document.createElement('div');
                    div.className = 'flex justify-between items-center p-2 border-b';
                    div.innerHTML = `
                        <span>${resident.first_name} ${resident.last_name}</span>
                        <button onclick="selectResident('${resident.resident_id}', '${resident.first_name} ${resident.last_name}')" 
                                class="bg-barangay-main text-white px-4 py-2 rounded">
                            Connect
                        </button>
                    `;
                    residentList.appendChild(div);
                });
            });
    }

    function selectResident(residentId, residentName) {
        const currentField = document.querySelector(`[name="relationships[${currentFamilyMemberIndex}][resident_id]"]`);
        const nameField = document.querySelector(`[name="relationships[${currentFamilyMemberIndex}][name]"]`);

        if (currentField && nameField) {
            currentField.value = residentId;
            nameField.value = residentName;
        }

        closeConnectResidentModal();
    }

    function openConnectResidentModal(index) {
        currentFamilyMemberIndex = index;
        document.getElementById('connectResident').classList.remove('hidden');
        loadResidents();
    }

    function closeConnectResidentModal() {
        document.getElementById('connectResident').classList.add('hidden');
        currentFamilyMemberIndex = null;
    }

    function searchResident() {
        const query = document.getElementById('residentSearchInput').value;
        loadResidents(query);
    }

    document.getElementById('residentSearchInput').addEventListener('input', function(e) {
        searchResident();
    });
</script>