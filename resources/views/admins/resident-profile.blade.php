@extends('layouts.admin')

@section('content')
<div class="flex pt-10 gap-6 w-[60%]">
    <!-- Left Panel -->
    <div class="flex flex-col gap-5 bg-[#fafafa] h-fit p-5 border border-[#1e1e1e] border-opacity-25 rounded-lg ">
        <!-- Profile Picture -->
        <img class="w-[210px] h-[210px] bg-gray-100 border border-gray-300 rounded" src="" alt="Profile picture">

        <!-- Info/Logs Tabs -->
        <div class="flex rounded border border-barangay-main overflow-hidden">
            <a class="text-center w-1/2 text-white font-semibold capitalize bg-barangay-main py-2" href="">Info</a>
            <a class="text-center w-1/2 text-blue-600 hover:text-blue-800 font-semibold capitalize py-2" href="">Logs</a>
        </div>

        <!-- Metadata -->
        <div class="space-y-3">
            <div class="flex flex-col">
                <span class="text-gray-500">Last Modified</span>
                <span class="font-bold">{{ $residentData->updated_at }}</span>
            </div>
            <div class="flex flex-col">
                <span class="text-gray-500">Date Created</span>
                <span class="font-bold">{{ $residentData->created_at }}</span>
            </div>
        </div>
    </div>

    <!-- Right Panel -->
    <div class="flex flex-col w-full">
        @include('admins.resident-profile.personal-information')
        @include('admins.resident-profile.relationships')
        @include('admins.resident-profile.household')
    </div>
</div>

<script>
    document.getElementById('household-header').addEventListener('click', function() {
        const content = document.getElementById('household-content');
        content.classList.toggle('hidden');
    });

    document.getElementById('relationships-header').addEventListener('click', function() {
        const content = document.getElementById('relationships-content');
        content.classList.toggle('hidden');
    });

    document.getElementById('personal-info-header').addEventListener('click', function() {
        const content = document.getElementById('personal-info-content');
        const isHidden = content.classList.contains('hidden');

        // Toggle the accordion
        if (isHidden) {
            content.classList.remove('hidden');
        } else {
            content.classList.add('hidden');
        }
    });
</script>
@endsection