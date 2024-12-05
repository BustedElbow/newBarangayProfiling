<div class="bg-white rounded-lg shadow-md mb-4">
    <!-- Accordion Header -->
    <div class="p-4 cursor-pointer flex justify-between items-center" id="personal-info-header">
        <h3 class="text-lg font-semibold">Personal Information</h3>
        <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 9l-7 7-7-7" />
        </svg>
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
</div>

<script>
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