<div class="flex flex-col items-center gap-9">
    <!-- Step 1 Form Data -->
    <div class="flex flex-row justify-between w-full">
        <div class="w-[279px] h-[279px] border border-black flex justify-center items-center">
            <div class="text-center flex flex-col items-center space-y-2">
                <img class="w-[37.5px] h-[37.5px]" src="{{ asset( 'images/icons/image100-black.png')}}" alt="">
                <span></span> <!-- Display Name -->
            </div>
        </div>
        <div class="flex flex-col gap-2 justify-between">
            <div class="flex flex-col gap-1">
                <label for="FirstName" class="capitalize font-inter font-semibold ">First Name</label>
                <input value="{{ session('register_data.first_name') }}" readonly class="bg-[#F5F5F5] border-black border-b p-2 font-inter w-[367px] focus:outline-none">
            </div>
            <div class="flex flex-col gap-1">
                <label for="MiddleName" class="capitalize font-inter font-semibold">Middle Name</label>
                <input value="{{ session('register_data.middle_name') }}" readonly class="bg-[#F5F5F5] border-black border-b p-2 font-inter w-[367px] focus:outline-none">
            </div>
            <div class="flex flex-col gap-1">
                <label for="LastName" class="capitalize font-inter font-semibold">Last Name</label>
                <input value="{{ session('register_data.last_name') }}" readonly class="bg-[#F5F5F5] border-black border-b p-2 font-inter w-[367px] focus:outline-none">
            </div>
        </div>
    </div>

    <!-- Step 2 Form Data -->
    <div class="flex gap-5">
        <div class="flex flex-col gap-1">
            <label for="BirthDate" class="font-semibold font-inter">Birthdate</label>
            <input value="{{ session('register_data.birthdate') }}" readonly class="bg-[#F5F5F5] border-black border-b p-2 font-inter w-[323px] focus:outline-none">
        </div>
        <div class="flex flex-col gap-1">
            <label for="CivilStatus" class="font-semibold font-inter">Civil Status</label>
            <input value="{{ session('register_data.civil_status') }}" readonly class="bg-[#F5F5F5] border-black border-b p-2 font-inter w-[323px] focus:outline-none">
        </div>
    </div>

    <!-- Step 3 Form Data -->
    <div class="flex gap-5">
        <div class="flex flex-col gap-1">
            <label for="Sex" class="font-semibold font-inter">Sex</label>
            <input value="{{ session('register_data.sex') }}" readonly class="bg-[#F5F5F5] border-black border-b p-2 font-inter w-[323px] focus:outline-none">
        </div>
        <div class="flex flex-col gap-1">
            <label for="contact_number" class="font-semibold font-inter">Phone Number</label>
            <input value="{{ session('register_data.contact_number') }}" readonly class="bg-[#F5F5F5] border-black border-b p-2 font-inter w-[323px] focus:outline-none">
        </div>
    </div>

    <!-- Step 4 Form Data (Optional Extra Fields) -->
    <div class="flex flex-col gap-1 w-full">
        <label class="font-semibold font-inter" for="">Address</label>
        <input value="{{ session('register_data.address') }}" readonly class="bg-[#F5F5F5] border-black border-b p-2 font-inter focus:outline-none w-full">
    </div>
    <div class="flex flex-col gap-1 w-full">
        <label class="font-semibold font-inter" for="">Nationality</label>
        <input value="{{ session('register_data.nationality') }}" readonly class="bg-[#F5F5F5] border-black border-b p-2 font-inter focus:outline-none w-full">
    </div>
    <div class="flex gap-5">
        <div class="flex flex-col gap-1">
            <label for="Occupation" class="font-semibold font-inter">Occupation</label>
            <input value="{{ session('register_data.occupation') }}" readonly class="bg-[#F5F5F5] border-black border-b p-2 font-inter w-[323px] focus:outline-none">
        </div>
        <div class="flex flex-col gap-1">
            <label for="Employer" class="font-semibold font-inter">Employer</label>
            <input value="{{ session('register_data.employer') }}" readonly class="bg-[#F5F5F5] border-black border-b p-2 font-inter w-[323px] focus:outline-none">
        </div>
    </div>
    <div class="flex flex-col gap-1 w-full">
        <label class="font-semibold font-inter" for="">Educational Attainment</label>
        <input value="{{ session('register_data.educational_attainment') }}" readonly class="bg-[#F5F5F5] border-black border-b p-2 font-inter focus:outline-none w-full">
    </div>
    <div class="flex flex-col gap-1 w-full">
        <label class="font-semibold font-inter" for="">Health Conditions or Disabilities (If Applicable)</label>
        <input value="None" readonly class="bg-[#F5F5F5] border-black border-b p-2 font-inter focus:outline-none w-full">
    </div>

    <span class="font-inter font-bold text-xl">Relationships</span>
    @if (session('register_data.family_members'))
    <h3>Family Members in Session:</h3>
    <ul>
        @foreach (session('register_data.family_members') as $member)
        <li>Name: {{ $member['name'] }}, Relationship: {{ $member['relationship'] }}, Connected ID: {{ $member['resident_id'] }}</li>
        @endforeach
    </ul>
    @endif
    <!-- <div class="flex gap-5">
        <div class="flex flex-col gap-1">
            <label for="Occupation" class="font-semibold font-inter">Person Name</label>
            <input value="John Doe" readonly class="bg-[#F5F5F5] border-black border-b p-2 font-inter w-[323px] focus:outline-none">
        </div>
        <div class="flex flex-col gap-1">
            <label for="Employer" class="font-semibold font-inter">Relationship</label>
            <input value="Brother" readonly class="bg-[#F5F5F5] border-black border-b p-2 font-inter w-[323px] focus:outline-none">
        </div>
    </div> -->
</div>