<section>
    <div class="container mx-auto">
        <div class="grid grid-cols-12 gap-5">
            <!-- parent div -->
            <div class="w-[270px] bg-white border border-[#1E1E1E] border-opacity-[25%] h-[344px] mt-32 ">
                <!-- sidebar -->
                <div class="pt-6">
                    <h2 class="font-bold text-[#7D7D7D] font-raleway text-[18px] pl-6">GENERAL</h2>
                    <ul class="list-none pt-[16px]">
                        <li class="w-full relative hover:bg-blue-500/15 hover:text-blue-500 p-2 pl-6 rounded flex items-center group">
                            <!-- Mini Bar -->
                            <span class="absolute right-0 top-0 bottom-0 w-[4px] bg-transparent group-hover:bg-blue-500 rounded"></span>
                            <img src="{{ asset('../images/icons/user.png') }}" alt="default icon" class="w-[24px] h-[24px] mr-[8px] group-hover:hidden">
                            <img src="{{ asset('../images/icons/user-blue.png') }}" alt="blue icon" class="w-[24px] h-[24px] mr-[8px] hidden group-hover:inline">
                            <a href="" class="font-inter font-semibold w-full">Account</a>
                        </li>
                        <li class="w-full relative hover:bg-blue-500/15 hover:text-blue-500 p-2 pl-6 rounded flex items-center group">
                            <span class="absolute right-0 top-0 bottom-0 w-[4px] bg-transparent group-hover:bg-blue-500 rounded"></span>
                            <img src="{{ asset('../images/icons/exclamation.png') }}" alt="default icon" class="w-[24px] h-[24px] mr-[8px] group-hover:hidden">
                            <img src="{{ asset('../images/icons/exclamation-blue.png') }}" alt="blue icon" class="w-[24px] h-[24px] mr-[8px] hidden group-hover:inline">
                            <a href="" class="font-inter font-semibold w-full">Resident Information</a>
                        </li>
                    </ul>
                </div>

                <div class="pt-6">
                    <h2 class="font-bold text-[#7D7D7D] font-raleway text-[18px] pl-6">SERVICES</h2>
                    <ul class="list-none pt-[16px]">
                        <li class="w-full relative hover:bg-blue-500/15 hover:text-blue-500 p-2 pl-6 rounded flex items-center group">
                            <span class="absolute right-0 top-0 bottom-0 w-[4px] bg-transparent group-hover:bg-blue-500 rounded"></span>
                            <img src="{{ asset('../images/icons/scroll.png') }}" alt="default icon" class="w-[24px] h-[24px] mr-[8px] group-hover:hidden">
                            <img src="{{ asset('../images/icons/scroll-blue.png') }}" alt="blue icon" class="w-[24px] h-[24px] mr-[8px] hidden group-hover:inline">
                            <a href="" class="font-inter font-semibold w-full">Barangay Clearance</a>
                        </li>
                        <li class="w-full relative hover:bg-blue-500/15 hover:text-blue-500 p-2 pl-6 rounded flex items-center group">
                            <span class="absolute right-0 top-0 bottom-0 w-[4px] bg-transparent group-hover:bg-blue-500 rounded"></span>
                            <img src="{{ asset('../images/icons/medicine-black.png') }}" alt="default icon" class="w-[24px] h-[24px] mr-[8px] group-hover:hidden">
                            <img src="{{ asset('../images/icons/medicine-fill.png') }}" alt="blue icon" class="w-[24px] h-[24px] mr-[8px] hidden group-hover:inline">
                            <a href="" class="font-inter font-semibold w-full">Healthcare</a>
                        </li>
                    </ul>
                </div>
            </div>
        </div>
    </div>
</section>