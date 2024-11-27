@extends('layouts.admin')

@section('content')
<div class="flex p-10 ">
    <div class="flex flex-col border-r border-black gap-5 pr-14 mr-14">
        <img class="w-[210px] h-[210px] bg-[#f5f5f5] border border-black" src="" alt="Profile picture">

        <div class="flex">
            <a class="text-white font-semibold capitalize border bg-barangay-main border-barangay-main px-3 py-2 " href="">Info</a>
            <a class=" text-blue-600 hover:text-blue-800 font-semibold capitalize border border-blue-600 px-3 py-2 " href="">Logs</a>
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
        <div class="flex flex-col w-[600px] border border-[#1e1e1e] border-opacity-25">
            <div class=" p-3 bg-[#f5f5f5] border-b border-[#1e1e1e] border-opacity-25">
                <h2 class="font-raleway font-bold text-2xl">Personal Information</h2>
            </div>
            <div class="flex flex-col p-4 gap-5">
                <!-- Main Content -->
                <div class="flex flex-col p-2 gap-5">
                    <div class="flex justify-between">
                        <div class="flex gap-5">
                            <div class="flex flex-col">
                                <span class="font-inter text-sm">First Name</span>
                                <span class="font-inter text-base font-bold">{{ $resident->first_name }}</span>
                            </div>
                            <div class="flex flex-col">
                                <span class="font-inter text-sm">Middle Name</span>
                                <span class="font-inter text-base font-bold">{{ $resident->middle_name }}</span>
                            </div>
                            <div class="flex flex-col">
                                <span class="font-inter text-sm">Last Name</span>
                                <span class="font-inter text-base font-bold">{{ $resident->last_name }}</span>
                            </div>
                        </div>
                        <button class="text-blue-600 hover:text-blue-800 font-semibold capitalize border border-blue-600 px-3 py-2 ">Edit</button>
                    </div>
                    <div class="flex gap-5">
                        <div class="flex flex-col">
                            <span class="font-inter text-sm">Birthdate</span>
                            <span class="font-inter text-base font-bold">{{ $resident->birthdate}}</span>
                        </div>
                        <div class="flex flex-col">
                            <span class="font-inter text-sm">Age</span>
                            <span class="font-inter text-base font-bold">{{ $resident->age }}</span>
                        </div>
                        <div class="flex flex-col">
                            <span class="font-inter text-sm">Sex</span>
                            <span class="font-inter text-base font-bold">{{ $resident->sex }}</span>
                        </div>
                        <div class="flex flex-col">
                            <span class="font-inter text-sm">Civil Status</span>
                            <span class="font-inter text-base font-bold">{{ $resident->civil_status }}</span>
                        </div>
                        <div class="flex flex-col">
                            <span class="font-inter text-sm">Contact Number</span>
                            <span class="font-inter text-base font-bold">{{ $resident->contact_number }}</span>
                        </div>
                    </div>
                    <div class="flex gap-5">
                        <div class="flex flex-col">
                            <span class="font-inter text-sm">Addresss</span>
                            <span class="font-inter text-base font-bold">{{ $resident->address }}</span>
                        </div>
                    </div>
                    <div class="flex gap-5">
                        <div class="flex flex-col">
                            <span class="font-inter text-sm">Occupation</span>
                            <span class="font-inter text-base font-bold">{{ $resident->occupation }}</span>
                        </div>
                        <div class="flex flex-col">
                            <span class="font-inter text-sm">Employer</span>
                            <span class="font-inter text-base font-bold">{{ $resident->employer }}</span>
                        </div>
                        <div class="flex flex-col">
                            <span class="font-inter text-sm">Educational Attainment</span>
                            <span class="font-inter text-base font-bold">{{ $resident->educational_attainment }}</span>
                        </div>
                    </div>
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
@endsection
<!-- <div class="flex p-10 flex-grow">
    <div class="flex flex-col border-r border-black gap-5 pr-14 mr-14">
        <img class="w-[210px] h-[210px] bg-[#f5f5f5] border border-black" src="" alt="Profile picture">

        <div class="flex">
            <a class="text-white font-semibold capitalize border bg-barangay-main border-barangay-main px-3 py-2 " href="">Info</a>
            <a class=" text-blue-600 hover:text-blue-800 font-semibold capitalize border border-blue-600 px-3 py-2 " href="">Logs</a>
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
        <div class="flex flex-col w-[600px] border border-[#1e1e1e] border-opacity-25">
            <div class=" p-3 bg-[#f5f5f5] border-b border-[#1e1e1e] border-opacity-25">
                <h2 class="font-raleway font-bold text-2xl">Personal Information</h2>
            </div>
            <div class="flex flex-col p-4 gap-5"> -->
                <!-- Main Content
                <div class="flex flex-col p-2 gap-5">
                    <div class="flex justify-between">
                        <div class="flex gap-5">
                            <div class="flex flex-col">
                                <span class="font-inter text-sm">First Name</span>
                                <span class="font-inter text-base font-bold">{{ $resident->first_name }}</span>
                            </div>
                            <div class="flex flex-col">
                                <span class="font-inter text-sm">Middle Name</span>
                                <span class="font-inter text-base font-bold">{{ $resident->middle_name }}</span>
                            </div>
                            <div class="flex flex-col">
                                <span class="font-inter text-sm">Last Name</span>
                                <span class="font-inter text-base font-bold">{{ $resident->last_name }}</span>
                            </div>
                        </div>
                        <button class="text-blue-600 hover:text-blue-800 font-semibold capitalize border border-blue-600 px-3 py-2 ">Edit</button>
                    </div>
                    <div class="flex gap-5">
                        <div class="flex flex-col">
                            <span class="font-inter text-sm">Birthdate</span>
                            <span class="font-inter text-base font-bold">{{ $resident->birthdate}}</span>
                        </div>
                        <div class="flex flex-col">
                            <span class="font-inter text-sm">Age</span>
                            <span class="font-inter text-base font-bold">{{ $resident->age }}</span>
                        </div>
                        <div class="flex flex-col">
                            <span class="font-inter text-sm">Sex</span>
                            <span class="font-inter text-base font-bold">{{ $resident->sex }}</span>
                        </div>
                        <div class="flex flex-col">
                            <span class="font-inter text-sm">Civil Status</span>
                            <span class="font-inter text-base font-bold">{{ $resident->civil_status }}</span>
                        </div>
                        <div class="flex flex-col">
                            <span class="font-inter text-sm">Contact Number</span>
                            <span class="font-inter text-base font-bold">{{ $resident->contact_number }}</span>
                        </div>
                    </div>
                    <div class="flex gap-5">
                        <div class="flex flex-col">
                            <span class="font-inter text-sm">Addresss</span>
                            <span class="font-inter text-base font-bold">{{ $resident->address }}</span>
                        </div>
                    </div>
                    <div class="flex gap-5">
                        <div class="flex flex-col">
                            <span class="font-inter text-sm">Occupation</span>
                            <span class="font-inter text-base font-bold">{{ $resident->occupation }}</span>
                        </div>
                        <div class="flex flex-col">
                            <span class="font-inter text-sm">Employer</span>
                            <span class="font-inter text-base font-bold">{{ $resident->employer }}</span>
                        </div>
                        <div class="flex flex-col">
                            <span class="font-inter text-sm">Educational Attainment</span>
                            <span class="font-inter text-base font-bold">{{ $resident->educational_attainment }}</span>
                        </div>
                    </div>
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
</div> -->