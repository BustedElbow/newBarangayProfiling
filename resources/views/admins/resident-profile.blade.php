@extends('layouts.admin')

@section('content')
<div class="flex p-10 ">
    <div class="flex flex-col border-r border-black gap-5 pr-14 mr-14">
        <img class="w-[210px] h-[210px] bg-[#f5f5f5] border border-black rounded" src="" alt="Profile picture">

        <div class="flex rounded border p-1 border-barangay-main">
            <a class="text-center w-full text-white font-semibold capitalize border rounded  bg-barangay-main px-3 py-2 " href="">Info</a>
            <a class="text-center w-full text-blue-600 hover:text-blue-800 font-semibold capitalize px-3 py-2 " href="">Logs</a>
        </div>

        <div class=" flex flex-col">
            <span class="font-inter text-[#7d7d7d]">Last Modified</span>
            <span class="font-inter font-bold">{{ $resident->updated_at }}</span>
        </div>
        <div class="flex flex-col">
            <span class="font-inter text-[#7d7d7d]">Date Created</span>
            <span class="font-inter font-bold">{{ $resident->created_at }}</span>
        </div>

    </div>
    <div class="flex flex-col w-fit">
        <div class="flex flex-col w-[700px] border border-[#1e1e1e] border-opacity-25 rounded">
            <div class=" p-3 bg-[#f5f5f5] border-b border-[#1e1e1e] border-opacity-25">
                <h2 class="font-raleway font-bold text-2xl">Personal Information</h2>
            </div>
            <div class="flex flex-col p-4 gap-5 w-auto">
                <!-- Main Content -->
                <div id="personal-details">
                    <form id="update-resident-form" class="flex flex-col p-2 gap-5" method="POST" action="{{ route('admin.resident.update', $resident->resident_id) }}">
                        @csrf
                        @method('PATCH')
                        <div class="flex justify-between gap-2">
                            <div class=" flex flex-col flex-1">
                                <label class="text-[#7d7d7d]" for="first_name">First Name</label>
                                <input class="pl-0 py-1 w-full border-none focus:ring-0 font-bold" type="text" name="first_name" value="{{ $resident->first_name }}" readonly>
                            </div>
                            <div class="flex flex-col flex-1 ">
                                <label for="middle_name">Middle Name</label>
                                <input class="pl-0 py-1 w-full border-none focus:ring-0 font-bold" type="text" name="middle_name" value="{{ $resident->middle_name }}" readonly>
                            </div>
                            <div class="flex flex-col flex-1 ">
                                <label for="last_name">Last Name</label>
                                <input class="pl-0 py-1 w-full border-none focus:ring-0 font-bold" type="text" name="last_name" value="{{ $resident->last_name }}" readonly>
                            </div>

                        </div>
                        <div class="flex gap-5">
                            <div class="flex flex-col flex-1">
                                <label for="birthdate">Birthdate</label>
                                <input class="pl-0 py-1 w-full border-none focus:ring-0 font-bold" type="text" name="birthdate" value="{{ \Carbon\Carbon::parse($resident->birthdate)->format('M d, Y') }}" readonly>
                            </div>
                            <div class="flex flex-col flex-1">
                                <label for="age">Age</label>
                                <input class="pl-0 py-1 w-full border-none focus:ring-0 font-bold" type="number" name="age" value="{{ $resident->age }}" readonly>
                            </div>
                            <div class="flex flex-col flex-1">
                                <label for="sex">Sex</label>
                                <input class="pl-0 py-1 w-full border-none focus:ring-0 font-bold" type="text" name="sex" value="{{ $resident->sex }}" readonly>
                            </div>
                            <div class="flex flex-col flex-1">
                                <label for="civil_status">Civil Status</label>
                                <input class="pl-0 py-1 w-full border-none focus:ring-0 font-bold" type="text" name="civil_status" value="{{ $resident->civil_status }}" readonly>
                            </div>
                            <div class="flex flex-col flex-1">
                                <label for="contact_number">Contact Number</label>
                                <input class="pl-0 py-1 w-full border-none focus:ring-0 font-bold" type="text" name="contact_number" value="{{ $resident->contact_number }}" readonly>
                            </div>
                        </div>
                        <div class="flex gap-5">
                            <div class="flex flex-col flex-1">
                                <label for="address">Address</label>
                                <input class="pl-0 py-1 w-full border-none focus:ring-0 font-bold" type="text" name="address" value="{{ $resident->address }}" readonly>
                            </div>
                        </div>
                        <div class="flex gap-5">
                            <div class="flex flex-col flex-1">
                                <label for="occupation">Occupation</label>
                                <input class="pl-0 py-1 w-full border-none focus:ring-0 font-bold" type="text" name="occupation" value="{{ $resident->occupation }}" readonly>
                            </div>
                            <div class="flex flex-col flex-1">
                                <label for="employer">Employer</label>
                                <input class="pl-0 py-1 w-full border-none focus:ring-0 font-bold" type="text" name="employer" value="{{ $resident->employer }}" readonly>
                            </div>
                            <div class="flex flex-col flex-1">
                                <label for="educational_attainment">Educational Attainment</label>
                                <input class="pl-0 py-1 w-full border-none focus:ring-0 font-bold" type="text" name="educational_attainment" value="{{ $resident->educational_attainment }}" readonly>
                            </div>
                        </div>
                        <button id="edit-personal-details" class="text-blue-600 hover:text-blue-800 font-semibold capitalize border border-blue-600 px-3 py-2 ">Edit</button>
                    </form>
                </div>
                <div class="w-full py-3 border-b border-black">
                    <h3 class="font-raleway font-bold text-lg">Relationship</h3>
                </div>
                <div class="flex gap-4 p-2">
                    <div class="flex flex-col">
                        <span class="font-inter text-sm">Brother</span>
                        <span class="font-inter text-base font-bold">John Doe</span>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<script>
    document.getElementById('edit-personal-details').addEventListener('click', function(e) {
        e.preventDefault()

        const button = e.target
        const inputs = document.querySelectorAll('#personal-details input')

        if (button.textContent.trim() === 'Edit') {
            // Enable editing
            inputs.forEach(input => {
                input.removeAttribute('readonly');
                input.classList.remove('pl-0', 'border-none', 'focus:ring-0');
                input.classList.add('pl-2', 'border', 'border-barangay-main');
            });
            button.textContent = 'Save';
        } else {
            // Save data
            const form = document.getElementById('update-resident-form');
            form.submit(); // Submit the form
        }
    })
</script>
@endsection