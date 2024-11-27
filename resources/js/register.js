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

const birthdateInput = document.getElementById("birthdate");
const ageInput = document.getElementById("age");

birthdateInput.addEventListener("input", function () {
    const birthdate = birthdateInput.value;

    if (birthdate) {
        const age = calculateAge(birthdate);
        ageInput.value = age;
    }
});

function addNewFamilyMemberField() {
    const newMemberDiv = document.createElement("div");
    newMemberDiv.classList.add("flex", "gap-5", "family-member");

    const nameContainer = document.createElement("div");
    nameContainer.classList.add("flex", "flex-col", "gap-2");

    const nameLabel = document.createElement("label");
    nameLabel.classList.add("font-inter", "font-semibold");
    nameLabel.textContent = "Name";

    const nameInput = document.createElement("input");
    nameInput.name = `family_members[${familyMemberCounter}][name]`;
    nameInput.classList.add(
        "bg-[#f5f5f5]",
        "border-black",
        "border-b",
        "p-2",
        "font-inter",
        "focus:outline-none",
        "focus:bg-[#f5f5f5]",
        "w-[323px]"
    );

    const residentIdInput = document.createElement("input");
    residentIdInput.type = "hidden";
    residentIdInput.name = `family_members[${familyMemberCounter}][resident_id]`;

    nameContainer.appendChild(nameLabel);
    nameContainer.appendChild(nameInput);
    nameContainer.appendChild(residentIdInput);

    const relationshipContainer = document.createElement("div");
    relationshipContainer.classList.add("flex", "flex-col", "gap-2");

    const relationshipLabel = document.createElement("label");
    relationshipLabel.classList.add("font-inter", "font-semibold");
    relationshipLabel.textContent = "Relationship";

    const relationshipInput = document.createElement("input");
    relationshipInput.name = `family_members[${familyMemberCounter}][relationship]`;
    relationshipInput.classList.add(
        "bg-[#f5f5f5]",
        "border-black",
        "border-b",
        "p-2",
        "font-inter",
        "focus:outline-none",
        "focus:bg-[#f5f5f5]",
        "w-[323px]"
    );

    relationshipContainer.appendChild(relationshipLabel);
    relationshipContainer.appendChild(relationshipInput);

    const removeButton = document.createElement("button");
    removeButton.type = "button";
    removeButton.textContent = "X";
    removeButton.classList.add("font-inter");
    removeButton.onclick = () => {
        newMemberDiv.remove();
    };

    const connectToResidentButton = document.createElement("button");
    connectToResidentButton.type = "button";
    connectToResidentButton.textContent = "key";
    connectToResidentButton.classList.add(
        "font-inter",
        "p-1",
        "bg-barangay-main",
        "text-white"
    );
    connectToResidentButton.onclick = () => {
        const index = Array.from(familyMember.children).indexOf(newMemberDiv);
        openConnectResidentModal(index);
    };

    newMemberDiv.appendChild(connectToResidentButton);
    newMemberDiv.appendChild(nameContainer);
    newMemberDiv.appendChild(relationshipContainer);
    newMemberDiv.appendChild(removeButton);

    document.getElementById("familyMember").appendChild(newMemberDiv);

    familyMemberCounter++;
}

function loadResidents(search = "") {
    const residentList = document.getElementById("residentList");
    residentList.innerHTML = "<p>Loading...</p>";

    fetch(`/fetchresidents?search=${search}`)
        .then((response) => response.json())
        .then((data) => {
            residentList.innerHTML = "";
            if (data.length > 0) {
                data.forEach((resident) => {
                    const residentDiv = document.createElement("div");
                    residentDiv.classList.add(
                        "flex",
                        "justify-between",
                        "items-center"
                    );

                    const residentInfo = document.createElement("span");
                    residentInfo.textContent = `${resident.first_name} ${resident.last_name}`;

                    const connectButton = document.createElement("button");
                    connectButton.type = "button";
                    connectButton.textContent = "Connect";
                    connectButton.classList.add(
                        "bg-barangay-main",
                        "text-white",
                        "p-2"
                    );
                    connectButton.onclick = () => {
                        connectResidentToFamilyMember(resident);
                    };

                    residentDiv.appendChild(residentInfo);
                    residentDiv.appendChild(connectButton);

                    residentList.appendChild(residentDiv);
                });
            } else {
                residentList.innerHTML = "<p>No residents found.</p>";
            }
        })
        .catch((error) => {
            console.error("Error fetching residents:", error);
            residentList.innerHTML = "<p>Error loading residents.</p>";
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
    const searchInput = document.getElementById("residentSearchInput").value;
    loadResidents(searchInput);
}

function openExistingHouseholdsModal() {
    document
        .getElementById("existingHouseholdModal")
        .classList.remove("hidden");
}

function closeExistingHouseholdsModal() {
    document.getElementById("existingHouseholdModal").classList.add("hidden");
}

function showUIforNewHousehold() {
    document.getElementById("createNewHousehold").classList.remove("hidden");
}

function hideUIforNewHousehold() {
    document.getElementById("createNewHousehold").classList.add("hidden");
}

function closeConnectResidentModal() {
    document.getElementById("connectResident").classList.add("hidden");
    currentFamilyMemberIndex = null;
}

function openConnectResidentModal(index) {
    console.log("Opening modal for index: ", index);
    currentFamilyMemberIndex = index;
    document.getElementById("connectResident").classList.remove("hidden");
}
