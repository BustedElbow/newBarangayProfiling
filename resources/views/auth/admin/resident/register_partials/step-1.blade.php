<div class="flex flex-row justify-between w-full">
    <!-- Image -->
    <div class="max-w-md mx-auto bg-white p-6 border rounded">
        <h2 class="text-2xl font-semibold mb-4">Upload Your Image</h2>

        <!-- Image Input Form -->
        <form id="image-form">
            <label for="image-upload" class="block mb-2 text-gray-700">Choose an Image:</label>
            <input type="file" id="image-upload" name="image" accept="image/*" class="block mb-4 p-2 border rounded" />

            <!-- Image Preview -->
            <div id="image-preview" class="hidden">
                <h3 class="text-lg font-semibold">Image Preview:</h3>
                <img id="preview" src="" alt="Image preview" class="mt-2 border rounded w-full" />
            </div>

            <button type="submit" class="bg-blue-500 text-white py-2 px-4 rounded">Submit</button>
        </form>
    </div>

    <div class="flex flex-col gap-2 justify-between">
        <div class="flex flex-col gap-1">
            <label for="FirstName" class="capitalize font-inter font-semibold ">first name</label>
            <input name="first_name" type="text" class="bg-[#F5F5F5] border-black border-b p-2 font-inter w-[367px] focus:outline-none focus:bg-[#F5F5F5]" value="{{ old('first_name', session('register_data.first_name')) }}">
        </div>
        <div class="flex flex-col gap-1">
            <label for="MiddleName" class="capitalize font-inter font-semibold">middle name</label>
            <input name="middle_name" type="text" class="bg-[#F5F5F5] border-black border-b p-2 font-inter w-[367px] focus:outline-none focus:bg-[#F5F5F5]" value="{{ old('middle_name', session('register_data.middle_name')) }}">
        </div>
        <div class="flex flex-col gap-1">
            <label for="LastName" class="capitalize font-inter font-semibold">last name</label>
            <input name="last_name" type="text" class="bg-[#F5F5F5] border-black border-b p-2 font-inter w-[367px] focus:outline-none focus:bg-[#F5F5F5]" value="{{ old('last_name', session('register_data.last_name')) }}">
        </div>
    </div>
</div>

<div class="flex flex-col gap-9">
    <div class="flex gap-5">
        <div class="flex flex-col gap-1">
            <label for="BirthDate" class="font-semibold font-inter">Birthdate</label>
            <input id="birthdate" name="birthdate" type="date" class="bg-[#F5F5F5] border-black border-b p-2 font-inter w-[323px] focus:outline-none focus:bg-[#F5F5F5]" value="{{ old('birthdate', session('register_data.birthdate')) }}">
            <input id="age" class="hidden" type="text" name="age" value="{{ old('age', session('register_data.age')) }}">
        </div>
        <div class="flex flex-col gap-1">
            <label for="CivilStatus" class="font-semibold font-inter">Civil Status</label>
            <input name="civil_status" type="text" class="bg-[#F5F5F5] border-black border-b p-2 font-inter w-[323px] focus:outline-none focus:bg-[#F5F5F5]" value="{{ old('civil_status', session('register_data.civil_status')) }}">
        </div>

    </div>

    <div class="flex gap-5">
        <div class="flex flex-col gap-1">
            <label for="Sex" class="font-semibold font-inter">Sex</label>
            <input name="sex" type="text" class="bg-[#F5F5F5] border-black border-b p-2 font-inter w-[323px] focus:outline-none focus:bg-[#F5F5F5]" value="{{ old('sex', session('register_data.sex')) }}">
        </div>
        <div class="flex flex-col gap-1">
            <label for="PhoneNumber" class="font-semibold font-inter">Phone Number</label>
            <input name="contact_number" type="text" class="bg-[#F5F5F5] border-black border-b p-2 font-inter w-[323px] focus:outline-none focus:bg-[#F5F5F5]" value="{{ old('contact_number', session('register_data.contact_number')) }}">
        </div>
    </div>
    <div class="flex flex-col gap-1 w-full">
        <label class="font-semibold font-inter" for="">Address</label>
        <input name="address" class="bg-[#F5F5F5] border-black border-b p-2 font-inter focus:outline-none focus:bg-[#F5F5F5] w-full" type="text" value="{{ old('address', session('register_data.address')) }}">
    </div>
    <div class="flex flex-col gap-1 w-full">
        <label class="font-semibold font-inter" for="nationality">Nationality</label>
        <input class="bg-[#F5F5F5] border-black border-b p-2 font-inter focus:outline-none focus:bg-[#F5F5F5] w-full" type="text" name="nationality" value="{{ old('nationality', session('register_data.nationality')) }}">
    </div>
</div>
<script>
    // JavaScript to handle image preview
    const fileInput = document.getElementById('image-upload');
    const imagePreview = document.getElementById('image-preview');
    const previewImage = document.getElementById('preview');

    fileInput.addEventListener('change', function(event) {
        const file = event.target.files[0];
        if (file) {
            // Create a URL for the selected image
            const reader = new FileReader();
            reader.onload = function(e) {
                // Set the preview image source to the selected file
                previewImage.src = e.target.result;
                imagePreview.classList.remove('hidden'); // Show the preview section
            };
            reader.readAsDataURL(file);
        } else {
            imagePreview.classList.add('hidden'); // Hide the preview section if no file is selected
        }
    });
</script>