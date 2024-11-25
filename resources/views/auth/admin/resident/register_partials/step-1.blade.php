<div class="flex flex-row justify-between w-full">
    <!-- Image -->
    <div class="w-[279px] h-[279px] border border-black flex justify-center items-center">
        <div class="text-center flex flex-col items-center space-y-2 ">
            <img class="w-[37.5px] h-[37.5px]" src="{{ asset( 'images/icons/image100-black.png')}}" alt="">
            <label for="file-upload" class="font-inter bg-barangay-main text-white py-2 px-3">Add Image</label>
            <input id="file-upload" type="file" class="hidden">
        </div>
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