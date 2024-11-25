<div class="flex flex-col items-center gap-9">
    <div class="flex flex-col gap-5">
        <div id="familyMember" class="flex flex-col gap-3">

        </div>
        <button type="button" onclick="addNewFamilyMemberField()" class="font-inter bg-barangay-main py-2 px-3 text-white">Add New Family Member</button>

        <!-- UI for creating a new household -->
        <div id="createNewHousehold" class="flex flex-col hidden">
            <input type="text" value="{{ session('register_data.last_name') }} Household">
            <div class="flex gap-2">
                <span>Current Head: You</span>
                <span>{{ session('register_data.last_name') }}, {{ session('register_data.first_name') }} {{ session('register_data.middle_name') }}</span>
            </div>
            <button onclick="hideUIforNewHousehold()" type="button" class="font-inter text-white py-2 px-3 bg-barangay-main">Cancel</button>
        </div>

        <div class="flex gap-5">
            <button type="button" onclick="openExistingHouseholdsModal()" class="bg-[#4169E1] text-white font-inter w-fit py-2 px-3">Add Existing Household</button>
            <button type="button" onclick="showUIforNewHousehold()" class="bg-[#4169E1] text-white font-inter w-fit py-2 px-3">Create New Household</button>
        </div>
    </div>
</div>

<!-- Modal For Existing Household -->
<div id="existingHouseholdModal" class="fixed inset-0 bg-gray-800 bg-opacity-50 flex items-center justify-center hidden">
    <!-- Content -->
    <div class="bg-white w-1/2 h-1/2 p-4">
        <h2>Households</h2>

        <button onclick="closeExistingHouseholdsModal()" type="button" class="font-inter text-white bg-barangay-main py-2 px-3">Cancel</button>
    </div>
</div>

<!-- Modal for Connecting Existing Resident -->
<div id="connectResident" class="z-50 fixed inset-0 bg-gray-800 bg-opacity-50 flex items-center justify-center hidden">
    <!-- Content -->
    <div class="bg-white w-1/2 h-1/2 p-4">
        <h2>Residents</h2>
        <input id="residentSearchInput" class="bg-[#F5F5F5] border-black border-b p-2 font-inter w-[323px] focus:outline-none focus:bg-[#F5F5F5]" type="text" placeholder="Search Residents">
        <button onclick="searchResident()" class="bg-barangay-main text-white p-2 font-inter" type="button">Search</button>
        <!-- List of Residents -->
        <div id="residentList" class="border border-black w-full h-1/2">

        </div>
        <button onclick="closeConnectResidentModal()" class="bg-barangay-main text-white p-2 font-inter" type="button">Cancel</button>
    </div>
</div>