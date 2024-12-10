@extends('layouts.admin')

@section('content')
<div class="p-10 space-y-10">

    <!-- Dashboard Header -->
    <div class="text-center">
        <h1 class="text-3xl font-semibold text-barangay-main">Barangay Dashboard</h1>
        <p class="text-gray-600 mt-2">Welcome to the Barangay Dashboard. Manage all key services here.</p>
    </div>

    <!-- Overview Section (General Statistics) -->
    <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-3 gap-10">
        <!-- Total Residents -->
        <div class="bg-white p-6 rounded-lg shadow-md">
            <h3 class="text-xl font-semibold text-barangay-main">Total Residents</h3>
            <p class="text-gray-600">Total number of residents registered in the barangay.</p>
            <div class="text-3xl font-bold mt-4">1,250</div> <!-- Example value -->
        </div>

        <!-- Pending Requests -->
        <div class="bg-white p-6 rounded-lg shadow-md">
            <h3 class="text-xl font-semibold text-barangay-main">Pending Requests</h3>
            <p class="text-gray-600">Requests waiting for approval, including clearances and assistance.</p>
            <div class="text-3xl font-bold mt-4">15</div> <!-- Example value -->
        </div>

        <!-- Events Overview -->
        <div class="bg-white p-6 rounded-lg shadow-md">
            <h3 class="text-xl font-semibold text-barangay-main">Upcoming Events</h3>
            <p class="text-gray-600">See the next scheduled events for the barangay.</p>
            <div class="text-3xl font-bold mt-4">3</div> <!-- Example value -->
        </div>
    </div>

    <!-- Recent Activities / Logs Section -->
    <div class="bg-white p-6 rounded-lg shadow-md">
        <h3 class="text-xl font-semibold text-barangay-main mb-4">Recent Activities</h3>
        <div class="space-y-4">
            <div class="flex justify-between items-center">
                <span class="text-lg">John Doe submitted a Barangay Clearance request.</span>
                <span class="text-sm text-gray-500">5 minutes ago</span>
            </div>
            <div class="flex justify-between items-center">
                <span class="text-lg">Jane Smith attended Health Assistance Program.</span>
                <span class="text-sm text-gray-500">2 hours ago</span>
            </div>
            <div class="flex justify-between items-center">
                <span class="text-lg">Bob White registered for upcoming Barangay Event.</span>
                <span class="text-sm text-gray-500">1 day ago</span>
            </div>
            <!-- Add more activities as needed -->
        </div>
    </div>

    <!-- Quick Actions Section -->
    <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-3 gap-10">
        <!-- Add Barangay Event -->
        <div class="bg-barangay-main text-white p-6 rounded-lg shadow-md hover:bg-barangay-main-light transition">
            <h3 class="text-xl font-semibold">Add Barangay Event</h3>
            <p>Create and manage barangay events from here.</p>
            <a href="#" class="bg-white text-barangay-main px-4 py-2 rounded mt-4 block text-center hover:bg-gray-200">Add Event</a>
        </div>

        <!-- Approve Requests -->
        <div class="bg-barangay-main text-white p-6 rounded-lg shadow-md hover:bg-barangay-main-light transition">
            <h3 class="text-xl font-semibold">Approve Requests</h3>
            <p>Review and approve pending clearance or health assistance requests.</p>
            <a href="#" class="bg-white text-barangay-main px-4 py-2 rounded mt-4 block text-center hover:bg-gray-200">View Pending</a>
        </div>

        <!-- View Residents -->
        <div class="bg-barangay-main text-white p-6 rounded-lg shadow-md hover:bg-barangay-main-light transition">
            <h3 class="text-xl font-semibold">View Residents</h3>
            <p>Quick access to the list of all registered residents.</p>
            <a href="#" class="bg-white text-barangay-main px-4 py-2 rounded mt-4 block text-center hover:bg-gray-200">View Residents</a>
        </div>
    </div>

</div>
@endsection