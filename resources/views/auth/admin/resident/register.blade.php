@extends('layouts.admin')

@section('content')
<!-- parent div for form and steps -->
<div class="flex flex-row p-10 gap-10 flex-grow">
    <!-- parent div for form-->

    <div class="flex flex-col border-r border-[#1e1e1e] pr-10 gap-8">
        <div class="border-b border-black pb-3">
            <h2 class="font-inter text-[#4169E1] text-[16px]">Step {{$currentStep}}</h2>
            <h1 class="font-bold font-raleway text-[20px]">
                @if($currentStep == 1)
                Personal and Contact Details
                @elseif($currentStep == 2)
                Household Information
                @elseif($currentStep == 3)
                Employement, Education, and Health Details
                @elseif($currentStep == 4)
                Review and Confirmation
                @endif
            </h1>
        </div>

        <form class="flex flex-col items-end h-full" action="{{ route('admin.resident.register') }}" method="POST">
            @csrf
            <div class="flex flex-col gap-9">
                @switch($currentStep)
                @case(1)
                @include('auth.admin.resident.register_partials.step-1')
                @break
                @case(2)
                @include('auth.admin.resident.register_partials.step-2')
                @break
                @case(3)
                @include('auth.admin.resident.register_partials.step-3')
                @break
                @break
                @case(4)
                @include('auth.admin.resident.register_partials.step-4')
                @break
                @endswitch
            </div>
            <div class="flex gap-3 mt-10">
                @if($currentStep > 1)
                <button formaction="{{ route('register') }}" name="previousForm" value="previous" class="bg-gray-300 text-black font-inter w-fit py-2 px-3">Previous</button>
                @endif
                <button name="{{ $currentStep < 4 ? 'next' : 'submit' }}" class="bg-[#4169E1] text-black font-inter w-fit py-2 px-3">{{ $currentStep < 4 ? 'Next' : 'Submit' }}</button>
            </div>
        </form>
    </div>

    <!-- steps div -->
    <div class="w-auto h-fit border bg-[#f5f5f5] border-[#1E1E1E] border-opacity-25 flex flex-row py-10 pl-7 pr-9 gap-3 relative overflow-hidden">
        <!-- Progress section on the left (vertical alignment) -->
        <div class="flex flex-col items-center gap-1">
            <div class="w-8 h-8 bg-blue-500 text-white rounded-full"></div>
            <div class="flex-grow w-[3px] bg-gray-300"></div>
            <div class="w-8 h-8 bg-gray-300 text-white rounded-full"></div>
            <div class="flex-grow w-[3px] bg-gray-300"></div>
            <div class="w-8 h-8 bg-gray-300 text-white rounded-full"></div>
            <div class="flex-grow w-[3px] bg-gray-300"></div>
            <div class="w-8 h-8 bg-gray-300 text-white rounded-full"></div>
        </div>

        <!-- Steps section on the right -->
        <div class="flex flex-col space-y-[40px]">
            <div>
                <p class="font-inter text-[12px]">Step 1</p>
                <h1 class="font-bold font-raleway text-[14px]">Personal and Contact Details</h1>
            </div>
            <div>
                <p class="font-inter text-[12px]">Step 2</p>
                <h1 class="font-bold font-raleway text-[14px]">Family Information</h1>
            </div>
            <div>
                <p class="font-inter text-[12px]">Step 3</p>
                <h1 class="font-bold font-raleway text-[14px] w-[80%]">Employment, Education, and Health Details</h1>
            </div>
            <div>
                <p class="font-inter text-[12px]">Step 4</p>
                <h1 class="font-bold font-raleway text-[14px]">Review and Confirmation</h1>
            </div>
        </div>
        <img class="absolute w-[500px] h-[60px] rotate-90 right-[-175px] bottom-[170px]" src="{{ asset( 'images/profile_banner.png')}}" alt="">
    </div>
</div>



@if ($errors->any())
<div class="text-red-500">
    <ul>
        @foreach ($errors->all() as $error)
        <li>{{ $error }}</li>
        @endforeach
    </ul>
</div>
@endif


<script>
    let familyMemberCounter = 0;
    let currentFamilyMemberIndex = null;

    function calculateAge(birthdate) {
        const birthDate = new Date(birthdate);
        const today = new Date();
        let age = today.getFullYear() - birthDate.getFullYear();
        const m = today.getMonth() - birthDate.getMonth();

        // Adjust age if the birthday hasn't occurred yet this year
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


    function addNewFamilyMemberField() {
        const newMemberDiv = document.createElement('div')
        newMemberDiv.classList.add('flex', 'gap-5', 'family-member')

        const nameContainer = document.createElement('div')
        nameContainer.classList.add('flex', 'flex-col', 'gap-2')

        const nameLabel = document.createElement('label')
        nameLabel.classList.add('font-inter', 'font-semibold')
        nameLabel.textContent = 'Name'

        const nameInput = document.createElement('input')
        nameInput.name = `family_members[${familyMemberCounter}][name]`
        nameInput.classList.add('bg-[#f5f5f5]', 'border-black', 'border-b', 'p-2', 'font-inter', 'focus:outline-none', 'focus:bg-[#f5f5f5]', 'w-[323px]')

        const residentIdInput = document.createElement('input')
        residentIdInput.type = 'hidden'
        residentIdInput.name = `family_members[${familyMemberCounter}][resident_id]`

        nameContainer.appendChild(nameLabel)
        nameContainer.appendChild(nameInput)
        nameContainer.appendChild(residentIdInput)

        const relationshipContainer = document.createElement('div')
        relationshipContainer.classList.add('flex', 'flex-col', 'gap-2')

        const relationshipLabel = document.createElement('label')
        relationshipLabel.classList.add('font-inter', 'font-semibold')
        relationshipLabel.textContent = 'Relationship'

        const relationshipInput = document.createElement('input')
        relationshipInput.name = `family_members[${familyMemberCounter}][relationship]`
        relationshipInput.classList.add('bg-[#f5f5f5]', 'border-black', 'border-b', 'p-2', 'font-inter', 'focus:outline-none', 'focus:bg-[#f5f5f5]', 'w-[323px]')

        relationshipContainer.appendChild(relationshipLabel)
        relationshipContainer.appendChild(relationshipInput)

        const removeButton = document.createElement('button')
        removeButton.type = 'button'
        removeButton.textContent = 'X'
        removeButton.classList.add('font-inter')
        removeButton.onclick = () => {
            newMemberDiv.remove()
        }

        const connectToResidentButton = document.createElement('button')
        connectToResidentButton.type = 'button'
        connectToResidentButton.textContent = 'key'
        connectToResidentButton.classList.add('font-inter', 'p-1', 'bg-barangay-main', 'text-white')
        connectToResidentButton.onclick = () => {
            const index = Array.from(familyMember.children).indexOf(newMemberDiv);
            openConnectResidentModal(index);
        }

        newMemberDiv.appendChild(connectToResidentButton)
        newMemberDiv.appendChild(nameContainer)
        newMemberDiv.appendChild(relationshipContainer)
        newMemberDiv.appendChild(removeButton)

        document.getElementById('familyMember').appendChild(newMemberDiv)

        familyMemberCounter++
    }

    function loadResidents(search = '') {
        const residentList = document.getElementById('residentList');
        residentList.innerHTML = '<p>Loading...</p>';

        fetch(`/residents?search=${search}`)
            .then(response => response.json())
            .then(data => {
                residentList.innerHTML = '';
                if (data.length > 0) {
                    data.forEach(resident => {
                        const residentDiv = document.createElement('div');
                        residentDiv.classList.add('flex', 'justify-between', 'items-center');

                        const residentInfo = document.createElement('span');
                        residentInfo.textContent = `${resident.first_name} ${resident.last_name}`;

                        const connectButton = document.createElement('button');
                        connectButton.type = 'button'
                        connectButton.textContent = 'Connect';
                        connectButton.classList.add('bg-barangay-main', 'text-white', 'p-2');
                        connectButton.onclick = () => {
                            connectResidentToFamilyMember(resident);
                        };

                        residentDiv.appendChild(residentInfo);
                        residentDiv.appendChild(connectButton);

                        residentList.appendChild(residentDiv);
                    });
                } else {
                    residentList.innerHTML = '<p>No residents found.</p>';
                }
            })
            .catch(error => {
                console.error('Error fetching residents:', error);
                residentList.innerHTML = '<p>Error loading residents.</p>';
            });
    }

    function connectResidentToFamilyMember(resident) {
        if (currentFamilyMemberIndex !== null) {
            // Update the family member's resident ID and name
            const residentIdInput = document.querySelector(
                `input[name="family_members[${currentFamilyMemberIndex}][resident_id]"]`
            );
            const nameInput = document.querySelector(
                `input[name="family_members[${currentFamilyMemberIndex}][name]"]`
            );

            if (residentIdInput && nameInput) {
                residentIdInput.value = resident.resident_id; // Set the resident's ID
                nameInput.value = `${resident.first_name} ${resident.last_name}`; // Set the full name
            }

            // Close the modal after selecting the resident
            closeConnectResidentModal();
        }
    }

    function searchResident() {
        const searchInput = document.getElementById('residentSearchInput').value
        loadResidents(searchInput)
    }

    function openExistingHouseholdsModal() {
        document.getElementById('existingHouseholdModal').classList.remove('hidden')
    }

    function closeExistingHouseholdsModal() {
        document.getElementById('existingHouseholdModal').classList.add('hidden')
    }

    function showUIforNewHousehold() {
        document.getElementById('createNewHousehold').classList.remove('hidden')
    }

    function hideUIforNewHousehold() {
        document.getElementById('createNewHousehold').classList.add('hidden')
    }

    function closeConnectResidentModal() {
        document.getElementById('connectResident').classList.add('hidden')
        currentFamilyMemberIndex = null
    }

    function openConnectResidentModal(index) {
        console.log('Opening modal for index: ', index)
        currentFamilyMemberIndex = index
        document.getElementById('connectResident').classList.remove('hidden')
    }
</script>
@endsection