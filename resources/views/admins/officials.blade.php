@extends('layouts.admin')

@section('content')
<div class="p-6 max-w-7xl mx-auto">
    <div class="grid grid-cols-1 lg:grid-cols-3 gap-6">
        <!-- Officials List Section -->
        <div class="lg:col-span-2">
            <div class="bg-white rounded-lg shadow-sm border border-gray-200">
                <div class="p-6">
                    <div class="flex justify-between items-center">
                        <h2 class="text-2xl font-bold text-gray-900">Officials</h2>
                        <button
                            onclick="toggleModal()"
                            class="inline-flex items-center px-4 py-2 bg-barangay-main text-white rounded-lg hover:bg-opacity-90 transition-colors duration-200">
                            <svg class="w-5 h-5 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4v16m8-8H4" />
                            </svg>
                            Add Official
                        </button>
                    </div>

                    <!-- New Official Form -->
                    <div id="newOfficialRow" class="hidden mt-6 p-4 bg-gray-50 rounded-lg border border-gray-200">
                        <div class="space-y-4">
                            <div class="flex items-center justify-between">
                                <h3 class="text-lg font-medium text-gray-900">New Official Details</h3>
                                <button onclick="cancelNewOfficial()" class="text-gray-400 hover:text-gray-500">
                                    <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12" />
                                    </svg>
                                </button>
                            </div>
                            <div>
                                <label class="block text-sm font-medium text-gray-700">Selected Resident</label>
                                <p id="selectedResidentName" class="mt-1 text-sm text-gray-900 font-semibold"></p>
                            </div>
                            <div class="grid grid-cols-1 gap-4">
                                <div>
                                    <label class="block text-sm font-medium text-gray-700">Position</label>
                                    <input type="text" id="position"
                                        class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-barangay-main focus:ring-barangay-main">
                                </div>
                                <div class="grid grid-cols-2 gap-4">
                                    <div>
                                        <label class="block text-sm font-medium text-gray-700">Term Start</label>
                                        <input type="date" id="term_start"
                                            class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-barangay-main focus:ring-barangay-main">
                                    </div>
                                    <div>
                                        <label class="block text-sm font-medium text-gray-700">Term End</label>
                                        <input type="date" id="term_end"
                                            class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-barangay-main focus:ring-barangay-main">
                                    </div>
                                </div>
                            </div>
                            <div class="flex justify-end space-x-3">
                                <button onclick="saveOfficial()"
                                    class="inline-flex items-center px-4 py-2 bg-green-600 text-white rounded-md hover:bg-green-700 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-green-500">
                                    Save Official
                                </button>
                            </div>
                        </div>
                    </div>

                    <!-- Officials List -->
                    <div class="mt-6 divide-y divide-gray-200">
                        @forelse($officials as $official)
                        <div class="py-4">
                            <div class="flex items-center justify-between">
                                <div>
                                    <h4 class="text-lg font-medium text-gray-900">
                                        {{ $official->resident->last_name }}, {{ $official->resident->first_name }}
                                    </h4>
                                    <p class="text-sm text-gray-500">{{ $official->position }}</p>
                                </div>
                                <div class="flex items-center space-x-2">
                                    <span class="px-2 py-1 text-xs font-medium rounded-full 
                                        {{ $official->is_active ? 'bg-green-100 text-green-800' : 'bg-gray-100 text-gray-800' }}">
                                        {{ $official->is_active ? 'Active' : 'Inactive' }}
                                    </span>
                                </div>
                            </div>
                        </div>
                        @empty
                        <div class="py-4 text-center text-gray-500">No officials found.</div>
                        @endforelse
                    </div>
                </div>
            </div>
        </div>

        <!-- Archives Section -->
        <div class="bg-white rounded-lg shadow-sm border border-gray-200">
            <div class="p-6">
                <h2 class="text-2xl font-bold text-gray-900 mb-6">Archives</h2>
                <div class="text-gray-500 text-center">No archived officials yet.</div>
            </div>
        </div>
    </div>
</div>

<!-- Modal -->
<div id="addOfficialModal" class="fixed inset-0 z-50 hidden">
    <div class="fixed inset-0 bg-gray-500 bg-opacity-75 transition-opacity"></div>
    <div class="fixed inset-0 z-10 overflow-y-auto">
        <div class="flex min-h-full items-end justify-center p-4 text-center sm:items-center sm:p-0">
            <div class="relative transform overflow-hidden rounded-lg bg-white text-left shadow-xl transition-all sm:my-8 sm:w-full sm:max-w-2xl">
                <div class="bg-white px-4 pb-4 pt-5 sm:p-6 sm:pb-4">
                    <div class="sm:flex sm:items-start">
                        <div class="mt-3 text-center sm:ml-4 sm:mt-0 sm:text-left w-full">
                            <h3 class="text-xl font-semibold leading-6 text-gray-900">Select Resident</h3>
                            <div class="mt-4">
                                <div class="overflow-y-auto max-h-96">
                                    <table class="min-w-full divide-y divide-gray-200">
                                        <thead class="bg-gray-50">
                                            <tr>
                                                <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Name</th>
                                                <th class="px-6 py-3 text-right text-xs font-medium text-gray-500 uppercase tracking-wider">Action</th>
                                            </tr>
                                        </thead>
                                        <tbody id="residentsTableBody" class="bg-white divide-y divide-gray-200"></tbody>
                                    </table>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="bg-gray-50 px-4 py-3 sm:flex sm:flex-row-reverse sm:px-6">
                    <button type="button" onclick="toggleModal()" class="mt-3 inline-flex w-full justify-center rounded-md bg-white px-3 py-2 text-sm font-semibold text-gray-900 shadow-sm ring-1 ring-inset ring-gray-300 hover:bg-gray-50 sm:mt-0 sm:w-auto">Cancel</button>
                </div>
            </div>
        </div>
    </div>
</div>

<script>
    let selectedResidentId = null;
    let isLoading = false;

    function toggleModal() {
        const modal = document.getElementById('addOfficialModal');
        if (modal.classList.contains('hidden')) {
            fetchResidents();
        }
        modal.classList.toggle('hidden');
    }

    async function fetchResidents() {
        if (isLoading) return;

        try {
            isLoading = true;
            const tbody = document.getElementById('residentsTableBody');
            tbody.innerHTML = '<tr><td colspan="2" class="px-6 py-4 text-center">Loading...</td></tr>';

            const response = await fetch('/fetchresidents');
            if (!response.ok) throw new Error('Failed to fetch residents');

            const residents = await response.json();
            displayResidents(residents);
        } catch (error) {
            console.error('Error:', error);
            document.getElementById('residentsTableBody').innerHTML =
                '<tr><td colspan="2" class="px-6 py-4 text-center text-red-600">Failed to load residents</td></tr>';
        } finally {
            isLoading = false;
        }
    }

    function displayResidents(residents) {
        const tbody = document.getElementById('residentsTableBody');
        tbody.innerHTML = residents.length ? residents.map(resident => `
        <tr class="hover:bg-gray-50">
            <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-900">
                ${resident.last_name}, ${resident.first_name}
            </td>
            <td class="px-6 py-4 whitespace-nowrap text-right text-sm font-medium">
                <button onclick="selectResident(${resident.resident_id}, '${resident.last_name}, ${resident.first_name}')"
                    class="inline-flex items-center px-3 py-1.5 border border-transparent text-xs font-medium rounded-full shadow-sm text-white bg-barangay-main hover:bg-opacity-90 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-barangay-main">
                    Select
                </button>
            </td>
        </tr>
    `).join('') : '<tr><td colspan="2" class="px-6 py-4 text-center">No residents found</td></tr>';
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