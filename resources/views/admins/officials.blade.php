@extends('layouts.admin')

@section('content')
<div class="p-10 flex gap-2">
    <!-- Officials List Section -->
    <div class="border border-black rounded p-2 flex flex-col gap-1 w-2/3">
        <div class="flex justify-between items-center mb-2">
            <span class="text-lg font-bold">List of Officials</span>
            <!-- Add Official Button -->
            <button
                onclick="toggleModal()"
                class="bg-barangay-main text-white py-2 px-3 rounded hover:bg-opacity-90">
                Add Official
            </button>
        </div>
        <!-- Officials List with New Official Row -->
        <div class="flex flex-col border border-black rounded p-2">
            <!-- New Official Row -->
            <div id="newOfficialRow" class="hidden py-2 border-b">
                <div class="flex flex-col">
                    <span class="font-bold">New Official</span>
                    <span>Name: <span id="selectedResidentName" class="font-semibold"></span></span>
                    <div class="space-y-2 mt-2">
                        <input type="text" id="position" placeholder="Enter Position"
                            class="w-full p-2 border rounded">
                        <input type="date" id="term_start" placeholder="Term Start"
                            class="w-full p-2 border rounded">
                        <input type="date" id="term_end" placeholder="Term End"
                            class="w-full p-2 border rounded">
                        <div class="flex gap-2">
                            <button onclick="saveOfficial()"
                                class="bg-green-500 text-white px-3 py-1 rounded">
                                Save
                            </button>
                            <button onclick="cancelNewOfficial()"
                                class="bg-red-500 text-white px-3 py-1 rounded">
                                Cancel
                            </button>
                        </div>
                    </div>
                </div>
            </div>
            <!-- Existing Officials List -->
            <ul class="divide-y divide-gray-300">
                @forelse($officials as $official)
                <li class="py-2">
                    <div class="flex flex-col">
                        <span class="font-bold">Official {{ $loop->iteration }}</span>
                        <span>Name: <span class="font-semibold">
                                {{ $official->resident->last_name }}, {{ $official->resident->first_name }}
                            </span></span>
                        <span>Position: {{ $official->position }}</span>
                    </div>
                </li>
                @empty
                <li>No officials found.</li>
                @endforelse
            </ul>
        </div>
    </div>

    <!-- Archives Section -->
    <div class="flex flex-col border border-black rounded p-2 w-1/3">
        <span class="text-lg font-bold mb-2">Archives</span>
        <div>
            <ul>
                <li>No archived officials yet.</li>
            </ul>
        </div>
    </div>
</div>

<!-- Modal for Adding Officials -->
<div id="addOfficialModal" class="fixed inset-0 bg-gray-800 bg-opacity-50 flex items-center justify-center hidden">
    <div class="bg-white rounded shadow-lg w-2/3 p-5 relative">
        <h2 class="text-lg font-bold mb-3">Select Resident</h2>
        <div class="overflow-y-auto max-h-96">
            <table class="min-w-full">
                <thead class="bg-gray-50">
                    <tr>
                        <th class="px-6 py-3 text-left">Name</th>
                        <th class="px-6 py-3 text-left">Action</th>
                    </tr>
                </thead>
                <tbody id="residentsTableBody">
                    <!-- Residents populated here -->
                </tbody>
            </table>
        </div>
        <button
            type="button"
            onclick="toggleModal()"
            class="mt-4 py-2 px-4 rounded bg-gray-300 hover:bg-gray-400">
            Cancel
        </button>
    </div>
</div>

<script>
    let selectedResidentId = null;

    function toggleModal() {
        const modal = document.getElementById('addOfficialModal');
        if (modal.classList.contains('hidden')) {
            fetchResidents();
        }
        modal.classList.toggle('hidden');
    }

    async function fetchResidents() {
        try {
            const response = await fetch('/fetchresidents');
            const residents = await response.json();
            displayResidents(residents);
        } catch (error) {
            console.error('Error fetching residents:', error);
        }
    }

    function displayResidents(residents) {
        const tbody = document.getElementById('residentsTableBody');
        tbody.innerHTML = '';

        residents.forEach(resident => {
            const row = document.createElement('tr');
            row.innerHTML = `
            <td class="px-6 py-4">${resident.last_name}, ${resident.first_name}</td>
            <td class="px-6 py-4">
                <button onclick="selectResident(${resident.resident_id}, '${resident.last_name}, ${resident.first_name}')"
                    class="bg-blue-500 text-white px-3 py-1 rounded hover:bg-blue-600">
                    Select
                </button>
            </td>
        `;
            tbody.appendChild(row);
        });
    }

    function selectResident(residentId, residentName) {
        selectedResidentId = residentId;
        document.getElementById('selectedResidentName').textContent = residentName;
        document.getElementById('newOfficialRow').classList.remove('hidden');
        toggleModal();
    }

    function cancelNewOfficial() {
        document.getElementById('newOfficialRow').classList.add('hidden');
        selectedResidentId = null;
    }

    async function saveOfficial() {
        const position = document.getElementById('position').value;
        const term_start = document.getElementById('term_start').value;
        const term_end = document.getElementById('term_end').value;

        if (!position || !term_start || !term_end) {
            alert('Please fill in all fields');
            return;
        }

        try {
            const response = await fetch('/admin/officials', {
                method: 'POST',
                headers: {
                    'Content-Type': 'application/json',
                    'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').content,
                    'Accept': 'application/json'
                },
                body: JSON.stringify({
                    resident_id: selectedResidentId,
                    position: position,
                    term_start: term_start,
                    term_end: term_end
                })
            });

            const data = await response.json();

            if (data.success) {
                // Clear form
                document.getElementById('position').value = '';
                document.getElementById('term_start').value = '';
                document.getElementById('term_end').value = '';
                document.getElementById('newOfficialRow').classList.add('hidden');

                // Reload page to show new official
                window.location.reload();
            } else {
                throw new Error(data.message);
            }
        } catch (error) {
            console.error('Error:', error);
            alert(error.message || 'Failed to add official');
        }
    }
</script>
@endsection