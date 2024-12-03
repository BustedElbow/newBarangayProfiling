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

                <!-- Relationship Section -->
                <div class="mt-8">
                    <h3 class="text-lg font-bold mb-4">Relationship</h3>
                    <div class="flex flex-col gap-4">
                        <div class="flex flex-col">
                            <span class="text-sm text-gray-500">Brother</span>
                            <span class="text-base font-bold">John Doe</span>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<script>
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