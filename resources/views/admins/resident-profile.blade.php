@extends('layouts.admin')

@section('content')
<div class="flex p-10 space-x-10">
    <!-- Left Panel -->
    <div class="flex flex-col border-r border-gray-300 gap-5 pr-10">
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
                <span class="font-bold">{{ $resident->updated_at }}</span>
            </div>
            <div class="flex flex-col">
                <span class="text-gray-500">Date Created</span>
                <span class="font-bold">{{ $resident->created_at }}</span>
            </div>
        </div>
    </div>

    <!-- Right Panel -->
    <div class="flex flex-col w-full">
        <!-- Personal Information Accordion -->
        <div class="border border-gray-300 rounded shadow">
            <!-- Accordion Header -->
            <div class="p-4 bg-gray-100 border-b border-gray-300 cursor-pointer" id="personal-info-header">
                <h2 class="font-bold text-2xl">Personal Information</h2>
            </div>

            <!-- Accordion Content -->
            <div class="accordion-content p-6 space-y-6 hidden" id="personal-info-content">
                <!-- Form Fields -->
                <form id="update-resident-form" class="space-y-6" method="POST" action="{{ route('admin.resident.update', $resident->resident_id) }}">
                    @csrf
                    @method('PATCH')

                    <!-- Name Fields -->
                    <div class="grid grid-cols-3 gap-4">
                        @foreach (['first_name' => 'First Name', 'middle_name' => 'Middle Name', 'last_name' => 'Last Name'] as $field => $label)
                        <div class="flex flex-col">
                            <label for="{{ $field }}" class="text-gray-500">{{ $label }}</label>
                            <input class="form-input" type="text" name="{{ $field }}" value="{{ $resident->$field }}" readonly>
                        </div>
                        @endforeach
                    </div>

                    <!-- Additional Fields -->
                    <div class="grid grid-cols-3 gap-4">
                        @foreach ([
                        'birthdate' => 'Birthdate',
                        'age' => 'Age',
                        'sex' => 'Sex',
                        'civil_status' => 'Civil Status',
                        'contact_number' => 'Contact Number'
                        ] as $field => $label)
                        <div class="flex flex-col">
                            <label for="{{ $field }}" class="text-gray-500">{{ $label }}</label>
                            <input class="form-input" type="text" name="{{ $field }}" value="{{ $resident->$field ?? 'N/A' }}" readonly>
                        </div>
                        @endforeach
                    </div>

                    <!-- Address -->
                    <div class="flex flex-col">
                        <label for="address" class="text-gray-500">Address</label>
                        <input class="form-input" type="text" name="address" value="{{ $resident->address }}" readonly>
                    </div>

                    <!-- Occupation -->
                    <div class="grid grid-cols-3 gap-4">
                        @foreach ([
                        'occupation' => 'Occupation',
                        'employer' => 'Employer',
                        'educational_attainment' => 'Educational Attainment'
                        ] as $field => $label)
                        <div class="flex flex-col">
                            <label for="{{ $field }}" class="text-gray-500">{{ $label }}</label>
                            <input class="form-input" type="text" name="{{ $field }}" value="{{ $resident->$field ?? 'N/A' }}" readonly>
                        </div>
                        @endforeach
                    </div>

                    <!-- Edit/Save Button -->
                    <button id="edit-personal-details" class="text-blue-600 hover:text-blue-800 font-semibold border border-blue-600 px-4 py-2 mt-4">Edit</button>
                </form>
            </div>

            <div class="bg-white rounded-lg shadow-md mb-4">
                <div class="bg-white rounded-lg shadow-md mb-4">
                    <div class="p-4 cursor-pointer flex justify-between items-center" id="relationships-header">
                        <h3 class="text-lg font-semibold">Family Relationships</h3>
                        <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 9l-7 7-7-7" />
                        </svg>
                    </div>

                    <div id="relationships-content" class="px-4 pb-4 hidden">
                        @if($resident->relatedTo->count() > 0)
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
                                    @foreach($resident->relatedTo as $relation)
                                    <tr>
                                        <td class="px-6 py-4 whitespace-nowrap">
                                            {{ $relation->resident->first_name }}
                                            {{ $relation->resident->last_name }}
                                        </td>
                                        <td class="px-6 py-4 whitespace-nowrap">
                                            <form action="{{ route('admin.resident.editRelationship', ['relation' => $relation->blood_relation_id]) }}" method="POST">
                                                @csrf
                                                @method('PUT')
                                                <input type="text" name="relationship" value="{{ $relation->relationship }}" class="border rounded px-2 py-1">
                                                <button type="submit" class="text-blue-500">Save</button>
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

                <div class="bg-white rounded-lg shadow-md mb-4">
                    <div class="p-4 cursor-pointer flex justify-between items-center" id="household-header">
                        <h3 class="text-lg font-semibold">Household</h3>
                        <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 9l-7 7-7-7" />
                        </svg>
                    </div>

                    <div id="household-content" class="px-4 pb-4 hidden">
                        @if($resident->householdMember)
                        <p class="text-gray-500">Household Name: {{ $resident->householdMember->household->household_name }}</p>
                        <div class="overflow-x-auto">
                            <table class="min-w-full">
                                <thead>
                                    <tr class="bg-gray-50">
                                        <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase">Name</th>
                                        <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase">Role</th>
                                    </tr>
                                </thead>
                                <tbody class="bg-white divide-y divide-gray-200">
                                    @foreach($resident->householdMember->household->members as $member)
                                    <tr class="border-b {{ $member->resident_id == $resident->resident_id ? 'bg-yellow-100' : '' }}">
                                        <td class="px-6 py-4 whitespace-nowrap">
                                            {{ $member->resident->first_name }}
                                            {{ $member->resident->last_name }}
                                        </td>
                                        <td class="px-6 py-4 whitespace-nowrap">
                                            {{ $member->is_head ? 'Head' : 'Member' }}
                                            @if($member->is_head)
                                            <span class="text-sm text-gray-500">(Current Head)</span>
                                            @endif
                                        </td>
                                    </tr>
                                    @endforeach
                                </tbody>
                            </table>
                        </div>
                        @else
                        <p class="text-gray-500">No household assigned.</p>
                        @endif
                    </div>
                </div>
            </div>
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

        document.getElementById('edit-personal-details').addEventListener('click', function(e) {
            e.preventDefault();

            const button = e.target;
            const inputs = document.querySelectorAll('#update-resident-form input');

            if (button.textContent.trim() === 'Edit') {
                // Enable editing
                inputs.forEach(input => {
                    input.removeAttribute('readonly');
                    input.classList.add('border', 'border-barangay-main', 'pl-2');
                    input.classList.remove('border-none', 'pl-0');
                });
                button.textContent = 'Save';
            } else {
                // Submit form
                document.getElementById('update-resident-form').submit();
            }
        });
    </script>
    @endsection