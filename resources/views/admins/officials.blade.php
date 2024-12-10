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
        <!-- Officials List -->
        <div class="flex flex-col border border-black rounded p-2">
            <ul class="divide-y divide-gray-300">
                <!-- Example official -->
                <li class="py-2">
                    <div class="flex flex-col">
                        <span class="font-bold">Official 1</span>
                        <span>Name: <span class="font-semibold">Tan, Miguel Andrei</span></span>
                        <span>Position: Barangay Captain</span>
                    </div>
                </li>
                <!-- Example official -->
                <li class="py-2">
                    <div class="flex flex-col">
                        <span class="font-bold">Official 2</span>
                        <span>Name: <span class="font-semibold">Doe, Jane</span></span>
                        <span>Position: Barangay Secretary</span>
                    </div>
                </li>
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
    <div class="bg-white rounded shadow-lg w-1/3 p-5 relative">
        <h2 class="text-lg font-bold mb-3">Add New Official</h2>
        <form id="addOfficialForm" class="flex flex-col gap-3">
            <!-- Resident Selection -->
            <div>
                <label for="resident" class="block font-medium">Resident</label>
                <select id="resident" name="resident" class="w-full border-gray-300 rounded focus:ring focus:ring-barangay-main">
                    <option value="">Select a Resident</option>
                    <!-- Populate options dynamically -->
                    <option value="1">Tan, Miguel Andrei</option>
                    <option value="2">Doe, Jane</option>
                </select>
            </div>
            <!-- Position Input -->
            <div>
                <label for="position" class="block font-medium">Position</label>
                <input
                    type="text"
                    id="position"
                    name="position"
                    class="w-full border-gray-300 rounded focus:ring focus:ring-barangay-main"
                    placeholder="Enter Position">
            </div>
            <!-- Term Start -->
            <div>
                <label for="term_start" class="block font-medium">Term Start</label>
                <input
                    type="date"
                    id="term_start"
                    name="term_start"
                    class="w-full border-gray-300 rounded focus:ring focus:ring-barangay-main">
            </div>
            <!-- Term End -->
            <div>
                <label for="term_end" class="block font-medium">Term End</label>
                <input
                    type="date"
                    id="term_end"
                    name="term_end"
                    class="w-full border-gray-300 rounded focus:ring focus:ring-barangay-main">
            </div>
            <!-- Modal Buttons -->
            <div class="flex justify-end gap-2">
                <button
                    type="button"
                    onclick="toggleModal()"
                    class="py-2 px-4 rounded bg-gray-300 hover:bg-gray-400">
                    Cancel
                </button>
                <button
                    type="submit"
                    class="py-2 px-4 rounded bg-barangay-main text-white hover:bg-opacity-90">
                    Save
                </button>
            </div>
        </form>
    </div>
</div>

<script>
    function toggleModal() {
        const modal = document.getElementById('addOfficialModal');
        modal.classList.toggle('hidden');
    }
</script>
@endsection