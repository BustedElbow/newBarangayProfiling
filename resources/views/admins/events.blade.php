@extends('layouts.admin')

@section('content')
<div class="p-10 space-y-10">

    <!-- Create New Event -->
    <div class="bg-white p-6 rounded shadow-md">
        <h2 class="text-xl font-bold mb-4">Create New Event</h2>
        <form method="POST" action="#" class="space-y-4">
            <div class="flex gap-5">
                <div class="flex flex-col flex-1">
                    <label for="event_name" class="font-semibold">Event Name</label>
                    <input id="event_name" type="text" class="w-full p-2 border border-gray-300 rounded" placeholder="Enter event name">
                </div>
                <div class="flex flex-col flex-1">
                    <label for="event_date" class="font-semibold">Event Date</label>
                    <input id="event_date" type="date" class="w-full p-2 border border-gray-300 rounded">
                </div>
            </div>
            <div class="flex flex-col">
                <label for="event_description" class="font-semibold">Event Description</label>
                <textarea id="event_description" class="w-full p-2 border border-gray-300 rounded" placeholder="Describe the event"></textarea>
            </div>
            <div class="flex gap-5 mt-4">
                <button type="submit" class="px-6 py-2 bg-barangay-main text-white rounded">Create Event</button>
            </div>
        </form>
    </div>

    <!-- Active Events List -->
    <div class="bg-white p-6 rounded shadow-md">
        <h2 class="text-xl font-bold mb-4">Active Events</h2>
        <table class="w-full border-collapse">
            <thead>
                <tr class="bg-gray-100">
                    <th class="py-2 px-4 border-b">Event Name</th>
                    <th class="py-2 px-4 border-b">Date</th>
                    <th class="py-2 px-4 border-b">Actions</th>
                </tr>
            </thead>
            <tbody>
                <!-- Repeat for each event -->
                <tr>
                    <td class="py-2 px-4 border-b">Community Clean-Up</td>
                    <td class="py-2 px-4 border-b">Dec 5, 2024</td>
                    <td class="py-2 px-4 border-b">
                        <a href="#" class="text-blue-600 hover:text-blue-800 edit-event">Edit</a>
                        <a href="#" class="ml-4 text-blue-600 hover:text-blue-800">View Attendees</a>
                    </td>
                </tr>
                <!-- End of repeat -->
            </tbody>
        </table>
    </div> 
</div>

<!-- Edit Event Modal (optional) -->
<div id="edit-event-modal" class="hidden fixed top-0 inset-0 bg-black bg-opacity-50 flex items-center justify-center z-50">
    <div class="bg-white p-6 rounded shadow-md w-1/2">
        <h2 class="text-xl font-bold mb-4">Edit Event</h2>
        <form method="POST" action="#" class="space-y-4">
            <div class="flex gap-5">
                <div class="flex flex-col flex-1">
                    <label for="edit_event_name" class="font-semibold">Event Name</label>
                    <input id="edit_event_name" type="text" class="w-full p-2 border border-gray-300 rounded" value="Community Clean-Up">
                </div>
                <div class="flex flex-col flex-1">
                    <label for="edit_event_date" class="font-semibold">Event Date</label>
                    <input id="edit_event_date" type="date" class="w-full p-2 border border-gray-300 rounded" value="2024-12-05">
                </div>
            </div>
            <div class="flex flex-col">
                <label for="edit_event_description" class="font-semibold">Event Description</label>
                <textarea id="edit_event_description" class="w-full p-2 border border-gray-300 rounded">Description of the event.</textarea>
            </div>
            <div class="flex gap-5 mt-4">
                <button type="submit" class="px-6 py-2 bg-barangay-main text-white rounded">Save Changes</button>
                <button type="button" id="cancel-edit" class="px-6 py-2 bg-gray-500 text-white rounded">Cancel</button>
            </div>
        </form>
    </div>
</div>

<script>
    // Open Edit Event Modal
    document.querySelectorAll('.edit-event').forEach(button => {
        button.addEventListener('click', function(event) {
            event.preventDefault(); // Prevent link from navigating
            document.getElementById('edit-event-modal').classList.remove('hidden'); // Show modal
        });
    });

    // Close Edit Event Modal
    document.getElementById('cancel-edit').addEventListener('click', function() {
        document.getElementById('edit-event-modal').classList.add('hidden'); // Hide modal
    });

    // Close modal when clicked outside
    document.getElementById('edit-event-modal').addEventListener('click', function(e) {
        if (e.target === this) {
            this.classList.add('hidden'); // Hide modal if outside clicked
        }
    });
</script>
@endsection