<nav class="py-9 border border-r-[#1e1e1e] border-opacity-25 bg-[#FAFAFA] flex flex-col justify-between h-screen w-64 fixed">
    <div class="flex flex-col w-full items-center gap-12">
        <div class="w-full">
            <ul class="flex flex-col">
                <li class="p-2">
                    <a class="flex pl-5 gap-3 font-inter text-base py-3 {{ Request::is('*dashboard*') ? 'text-barangay-main border-barangay-main rounded-lg bg-slate-300' : 'text-[#1e1e1e]'}}" href="{{ route('admin.dashboard') }}"><img class="w-[24px] h-[24px]" src="{{ Request::is('*dashboard*') ? asset('images/icons/dashboard128-main.png') : asset('images/icons/dashboard128-black.png') }}" alt="">Dashboard</a>
                </li>
                <li class="p-2">
                    <!-- Main Menu Item -->
                    <div class="flex justify-between items-center pl-5 gap-3 font-inter text-base py-3 cursor-pointer text-[#1e1e1e]"
                        onclick="toggleSubmenu('residentsSubmenu')">
                        <div class="flex gap-3">
                            <img class="w-[24px] h-[24px]"
                                src="{{ asset('images/icons/resident128-black.png')}}"
                                alt="">
                            <span>Residents</span>
                        </div>
                        <!-- Arrow Icon -->
                        <svg class="w-4 h-4 transform transition-transform duration-200" id="residentsArrow" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 9l-7 7-7-7" />
                        </svg>
                    </div>

                    <!-- Submenu -->
                    <div id="residentsSubmenu" class="hidden mt-2 space-y-2 flex flex-col">
                        <a href="{{ route('admin.residents') }}"
                            class="pl-14 py-2 hover:text-barangay-main {{ Request::is('admin/residents') ? 'text-barangay-main bg-slate-300 rounded-lg' : 'text-[#1e1e1e]' }}">
                            List All
                        </a>
                        <a href="{{ route('admin.resident.register.show') }}"
                            class="pl-14 py-2 hover:text-barangay-main {{ Request::is('admin/register') ? 'text-barangay-main bg-slate-300 rounded-lg' : 'text-[#1e1e1e]' }}">
                            Register New
                        </a>
                    </div>
                </li>
                <li class="p-2">
                    <a class="flex pl-5 gap-3 font-inter text-base py-3 {{ Request::is('*households*') ? 'text-barangay-main border-barangay-main rounded-lg bg-slate-300' : 'text-[#1e1e1e]'}}" href="{{ route('admin.households') }}">
                        <img class="w-[24px] h-[24px]" src="{{ Request::is('*households*') ? asset('images/icons/household128-main.png') : asset('images/icons/household128-black.png') }}" alt="">
                        Households
                    </a>
                </li>
                <li class="p-2">
                    <a class="flex pl-5 gap-3 font-inter text-base py-3 {{ Request::is('*officials*') ? 'text-barangay-main border-barangay-main rounded-lg bg-slate-300' : 'text-[#1e1e1e]'}}" href="{{ route('admin.officials')}}"><img class="w-[24px] h-[24px]" src="{{ Request::is('*officials*') ? asset('images/icons/official128-main.png') : asset('images/icons/official128-black.png') }}" alt="">Officials</a>
                </li>
                <li class="p-2">
                    <a class="flex pl-5 gap-3 font-inter text-base py-3 {{ Request::is('*services*') ? 'text-barangay-main border-barangay-main rounded-lg bg-slate-300' : 'text-[#1e1e1e]'}}" href="{{ route('admin.services')}}"><img class="w-[24px] h-[24px]" src="{{ Request::is('*services*') ? asset('images/icons/clerance128-main.png') : asset('images/icons/clerance128-black.png') }}" alt="">Services</a>
                </li>
            </ul>
        </div>
    </div>
</nav>

<script>
    // Add this at the start to check submenu state on page load
    document.addEventListener('DOMContentLoaded', function() {
        const submenuId = 'residentsSubmenu';
        const submenu = document.getElementById(submenuId);
        const arrow = document.getElementById('residentsArrow');

        // Check if submenu was open
        const isOpen = localStorage.getItem('submenuState') === 'open';

        if (isOpen) {
            submenu.classList.remove('hidden');
            arrow.classList.add('rotate-180');
        }

        // Auto-open if on a residents page
        if (window.location.pathname.includes('residents') ||
            window.location.pathname.includes('register-resident')) {
            submenu.classList.remove('hidden');
            arrow.classList.add('rotate-180');
            localStorage.setItem('submenuState', 'open');
        }
    });

    // Update toggle function to persist state
    function toggleSubmenu(submenuId) {
        const submenu = document.getElementById(submenuId);
        const arrow = document.getElementById('residentsArrow');

        submenu.classList.toggle('hidden');
        arrow.classList.toggle('rotate-180');

        // Save state
        const isOpen = !submenu.classList.contains('hidden');
        localStorage.setItem('submenuState', isOpen ? 'open' : 'closed');
    }
</script>