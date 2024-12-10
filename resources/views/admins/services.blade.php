@extends('layouts.admin')

@section('content')
<div class="p-10 flex space-x-10">
    <!-- Barangay Clearance Panel -->
    <div class="flex-1 bg-white p-6 rounded-lg shadow-md">
        <h2 class="text-2xl font-semibold mb-4 text-barangay-main">Barangay Clearance</h2>
        <p class="text-gray-600 mb-4">Process your barangay clearance requests or approve pending applications.</p>

        <!-- Go to Barangay Clearance Page Button -->
        <div class="mb-4">
            <a href="#" class="w-full bg-barangay-main text-white px-4 py-2 rounded hover:bg-barangay-main-light text-center block">Go to Barangay Clearance Page</a>
        </div>

        <!-- Pending Clearances List -->
        <div class="space-y-4">
            <h3 class="text-xl font-medium text-barangay-main mb-2">Pending Clearances</h3>

            <!-- Example of Pending Clearances -->
            <div class="flex justify-between items-center border-b border-gray-300 pb-3 mb-3">
                <span class="text-lg">John Doe</span>
                <a href="#" class="bg-yellow-500 text-white px-4 py-2 rounded hover:bg-yellow-600">Approve</a>
            </div>

            <div class="flex justify-between items-center border-b border-gray-300 pb-3 mb-3">
                <span class="text-lg">Jane Smith</span>
                <a href="#" class="bg-yellow-500 text-white px-4 py-2 rounded hover:bg-yellow-600">Approve</a>
            </div>

            <!-- If no pending clearances -->
            <div class="text-gray-500">No pending clearances at the moment.</div>
        </div>
    </div>

    <!-- Health Assistance Panel -->
    <div class="flex-1 bg-white p-6 rounded-lg shadow-md">
        <h2 class="text-2xl font-semibold mb-4 text-barangay-main">Health Assistance</h2>
        <p class="text-gray-600 mb-4">Manage health assistance programs or approve pending applications.</p>

        <!-- Go to Health Assistance Page Button -->
        <div class="mb-4">
            <a href="#" class="w-full bg-barangay-main text-white px-4 py-2 rounded hover:bg-barangay-main-light text-center block">Go to Health Assistance Page</a>
        </div>

        <!-- Pending Health Assistance List -->
        <div class="space-y-4">
            <h3 class="text-xl font-medium text-barangay-main mb-2">Pending Health Assistance Applications</h3>

            <!-- Example of Pending Health Assistance -->
            <div class="flex justify-between items-center border-b border-gray-300 pb-3 mb-3">
                <span class="text-lg">Alice Brown</span>
                <a href="#" class="bg-yellow-500 text-white px-4 py-2 rounded hover:bg-yellow-600">Approve</a>
            </div>

            <div class="flex justify-between items-center border-b border-gray-300 pb-3 mb-3">
                <span class="text-lg">Bob White</span>
                <a href="#" class="bg-yellow-500 text-white px-4 py-2 rounded hover:bg-yellow-600">Approve</a>
            </div>

            <!-- If no pending health applications -->
            <div class="text-gray-500">No pending health applications at the moment.</div>
        </div>
    </div>
</div>
@endsection