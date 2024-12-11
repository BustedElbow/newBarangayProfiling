<div class="flex flex-wrap justify-between w-full gap-4">
    <!-- Image Upload Section -->
    <div class="w-full md:w-[279px] h-[279px] border border-gray-300 rounded flex justify-center items-center">
        <div class="text-center flex flex-col items-center space-y-3">
            <!-- Image Preview -->
            <img id="image-preview" class="w-[120px] h-[120px] rounded-full border border-gray-300 object-cover" src="{{ asset('images/icons/default-profile.png') }}" alt="Uploaded Image">
            <!-- Add Image Button -->
            <label for="file-upload" class="font-inter bg-barangay-main text-white py-2 px-4 rounded cursor-pointer hover:bg-barangay-main/90">
                Add Image
            </label>
            <input id="file-upload" type="file" name="image" accept="image/*" class="hidden" onchange="previewImage(event)">
        </div>
    </div>

    <!-- Input Fields -->
    <div class="flex-1 flex flex-wrap gap-4">
        <!-- First Name -->
        <div class="flex flex-col gap-1 w-full md:w-[48%]">
            <label for="first_name" class="capitalize font-inter font-semibold">First Name</label>
            <input id="first_name" name="first_name" type="text"
                class="bg-gray-100 border border-gray-300 p-2 rounded-md w-full focus:ring focus:ring-barangay-main @error('first_name') border-red-500 @enderror"
                value="{{ old('first_name', session('register_data.first_name')) }}">
            <input id="age" class="hidden" type="text" name="age" value="{{ old('age', session('register_data.age')) }}">
            @error('first_name')
            <span class="text-red-500 text-sm">{{ $message }}</span>
            @enderror
        </div>

        <!-- Middle Name -->
        <div class="flex flex-col gap-1 w-full md:w-[48%]">
            <label for="middle_name" class="capitalize font-inter font-semibold">Middle Name</label>
            <input id="middle_name" name="middle_name" type="text"
                class="bg-gray-100 border border-gray-300 p-2 rounded-md w-full focus:ring focus:ring-barangay-main @error('middle_name') border-red-500 @enderror"
                value="{{ old('middle_name', session('register_data.middle_name')) }}">
            @error('middle_name')
            <span class="text-red-500 text-sm">{{ $message }}</span>
            @enderror
        </div>

        <!-- Last Name -->
        <div class="flex flex-col gap-1 w-full">
            <label for="last_name" class="capitalize font-inter font-semibold">Last Name</label>
            <input id="last_name" name="last_name" type="text"
                class="bg-gray-100 border border-gray-300 p-2 rounded-md w-full focus:ring focus:ring-barangay-main @error('last_name') border-red-500 @enderror"
                value="{{ old('last_name', session('register_data.last_name')) }}">
            @error('last_name')
            <span class="text-red-500 text-sm">{{ $message }}</span>
            @enderror
        </div>
    </div>
</div>

<div class="flex flex-wrap gap-4 mt-6">
    <!-- Birthdate -->
    <div class="flex flex-col gap-1 w-full md:w-[48%]">
        <label for="birthdate" class="font-semibold font-inter">Birthdate</label>
        <input id="birthdate" name="birthdate" type="date"
            class="bg-gray-100 border border-gray-300 p-2 rounded-md w-full focus:ring focus:ring-barangay-main @error('birthdate') border-red-500 @enderror"
            value="{{ old('birthdate', session('register_data.birthdate')) }}">
        @error('birthdate')
        <span class="text-red-500 text-sm">{{ $message }}</span>
        @enderror
    </div>

    <!-- Civil Status -->
    <div class="flex flex-col gap-1 w-full md:w-[48%]">
        <label for="civil_status" class="font-semibold font-inter">Civil Status</label>
        <select id="civil_status" name="civil_status"
            class="bg-gray-100 border border-gray-300 p-2 rounded-md w-full focus:ring focus:ring-barangay-main @error('civil_status') border-red-500 @enderror">
            <option value="" disabled selected>Select Civil Status</option>
            <option value="single" {{ old('civil_status', session('register_data.civil_status')) == 'single' ? 'selected' : '' }}>Single</option>
            <option value="married" {{ old('civil_status', session('register_data.civil_status')) == 'married' ? 'selected' : '' }}>Married</option>
            <option value="widowed" {{ old('civil_status', session('register_data.civil_status')) == 'widowed' ? 'selected' : '' }}>Widowed</option>
        </select>
        @error('civil_status')
        <span class="text-red-500 text-sm">{{ $message }}</span>
        @enderror
    </div>
</div>

<div class="flex flex-wrap gap-4 mt-4">
    <!-- Sex -->
    <div class="flex flex-col gap-1 w-full md:w-[48%]">
        <label for="sex" class="font-semibold font-inter">Sex</label>
        <select id="sex" name="sex"
            class="bg-gray-100 border border-gray-300 p-2 rounded-md w-full focus:ring focus:ring-barangay-main @error('sex') border-red-500 @enderror">
            <option value="" disabled selected>Select Sex</option>
            <option value="male" {{ old('sex', session('register_data.sex')) == 'male' ? 'selected' : '' }}>Male</option>
            <option value="female" {{ old('sex', session('register_data.sex')) == 'female' ? 'selected' : '' }}>Female</option>
        </select>
        @error('sex')
        <span class="text-red-500 text-sm">{{ $message }}</span>
        @enderror
    </div>

    <!-- Phone Number -->
    <div class="flex flex-col gap-1 w-full md:w-[48%]">
        <label for="contact_number" class="font-semibold font-inter">Phone Number</label>
        <input id="contact_number" name="contact_number" type="text"
            class="bg-gray-100 border border-gray-300 p-2 rounded-md w-full focus:ring focus:ring-barangay-main @error('contact_number') border-red-500 @enderror"
            value="{{ old('contact_number', session('register_data.contact_number')) }}">
        @error('contact_number')
        <span class="text-red-500 text-sm">{{ $message }}</span>
        @enderror
    </div>
</div>

<div class="flex flex-wrap gap-4 mt-4">
    <!-- Address -->
    <div class="flex flex-col gap-1 w-full">
        <label for="address" class="font-semibold font-inter">Address</label>
        <input id="address" name="address" type="text"
            class="bg-gray-100 border border-gray-300 p-2 rounded-md w-full focus:ring focus:ring-barangay-main @error('address') border-red-500 @enderror"
            value="{{ old('address', session('register_data.address')) }}">
        @error('address')
        <span class="text-red-500 text-sm">{{ $message }}</span>
        @enderror
    </div>

    <!-- Nationality -->
    <div class="flex flex-col gap-1 w-full">
        <label for="nationality" class="font-semibold font-inter">Nationality</label>
        <input id="nationality" name="nationality" type="text"
            class="bg-gray-100 border border-gray-300 p-2 rounded-md w-full focus:ring focus:ring-barangay-main @error('nationality') border-red-500 @enderror"
            value="{{ old('nationality', session('register_data.nationality')) }}">
        @error('nationality')
        <span class="text-red-500 text-sm">{{ $message }}</span>
        @enderror
    </div>
</div>


<!-- Image Preview JavaScript -->
<script>
    function previewImage(event) {
        const file = event.target.files[0];
        const preview = document.getElementById('image-preview');

        if (file && file.type.startsWith('image/')) {
            const reader = new FileReader();

            reader.onload = function(e) {
                preview.src = e.target.result;
            }

            reader.readAsDataURL(file);
        } else {
            preview.src = "{{ asset('images/icons/default-profile.png') }}";
        }
    }

    function calculateAge(birthdate) {
        const birthDate = new Date(birthdate);
        const today = new Date();
        let age = today.getFullYear() - birthDate.getFullYear();
        const m = today.getMonth() - birthDate.getMonth();

        if (m < 0 || (m === 0 && today.getDate() < birthDate.getDate())) {
            age--;
        }

        return age;
    }

    const birthdateInput = document.getElementById('birthdate');
    const ageInput = document.getElementById('age');

    birthdateInput.addEventListener('input', function() {
        const birthdate = birthdateInput.value;

        if (birthdate) {
            const age = calculateAge(birthdate);
            ageInput.value = age;
        }
    });
</script>