<nav class="py-9 border border-r-[#1e1e1e] border-opacity-25 bg-[#FAFAFA] flex flex-col justify-between w-64 h-screen">
    <div class="flex flex-col w-full items-center gap-12">
        <div>
            <img class="w-[105px] h-[106px]" src="{{ asset('images/barangayEmblem.png') }}" alt="Barangay Emblem">
        </div>
        <div class="w-full">
            <ul class="flex flex-col gap-3">
                <li>
                    <a class="flex pl-5 gap-3 font-inter font-bold text-base py-3 {{ Request::is('admin') ? 'text-barangay-main border-barangay-main border-r-4 bg-slate-300' : 'text-[#1e1e1e]'}}" href="{{ route('admin.dashboard') }}"><img class="w-[24px] h-[24px]" src="{{ Request::is('admin') ? asset('images/icons/dashboard100-main.png') : asset('images/icons/dashboard100-black.png') }}" alt="">Dashboard</a>
                </li>
                <li>
                    <a class="flex pl-5 gap-3 font-inter font-bold text-base py-3 {{ Request::is('*residents*') ? 'text-barangay-main border-barangay-main border-r-4 bg-slate-300' : 'text-[#1e1e1e]'}}" href="{{ route('admin.residents')}}"><img class="w-[24px] h-[24px]" src="{{ Request::is('*residents*') ? asset('images/icons/resident100-main.png') : asset('images/icons/resident100-black.png') }}" alt="">Residents</a>
                </li>
                <li>
                    <a class="flex pl-5 gap-3 font-inter font-bold text-base py-3 {{ Request::is('*officials*') ? 'text-barangay-main border-barangay-main border-r-4 bg-slate-300' : 'text-[#1e1e1e]'}}" href="{{ route('admin.officials')}}"><img class="w-[24px] h-[24px]" src="{{ Request::is('*officials*') ? asset('images/icons/resident100-main.png') : asset('images/icons/resident100-black.png') }}" alt="">Officials</a>
                </li>
                <li>
                    <a class="flex pl-5 gap-3 font-inter font-bold text-base py-3 {{ Request::is('*services*') ? 'text-barangay-main border-barangay-main border-r-4 bg-slate-300' : 'text-[#1e1e1e]'}}" href="{{ route('admin.services')}}"><img class="w-[24px] h-[24px]" src="{{ Request::is('*services*') ? asset('images/icons/resident100-main.png') : asset('images/icons/resident100-black.png') }}" alt="">Services</a>
                </li>
                <li>
                    <a class="flex pl-5 gap-3 font-inter font-bold text-base py-3 {{ Request::is('*events*') ? 'text-barangay-main border-barangay-main border-r-4 bg-slate-300' : 'text-[#1e1e1e]'}}" href="{{ route('admin.events')}}"><img class="w-[24px] h-[24px]" src="{{ Request::is('*events*') ? asset('images/icons/resident100-main.png') : asset('images/icons/resident100-black.png') }}" alt="">Events</a>
                </li>
            </ul>
        </div>
    </div>
    <div class="relative flex flex-col items-center gap-3">
        <div class="flex flex-col gap-0 cursor-pointer" onclick="toggleDropdown()">
            <span class="font-raleway font-bold text-sm">{{ Auth::user()->name }}</span>
            <span class="font-inter font-normal text-sm text-[#1e1e1e] text-opacity-60">Barangay Captain</span>
        </div>
        <!-- Dropdown Menu -->
        <div id="dropdown-menu" class="hidden absolute top-full mt-2 bg-white shadow-md border rounded w-48">
            <ul class="flex flex-col text-left">
                <li>
                    <a href="{{ route('logout') }}" onclick="event.preventDefault(); document.getElementById('logout-form').submit();" class="block px-4 py-2 hover:bg-slate-100 text-sm font-medium">Logout</a>
                </li>
            </ul>
            <!-- Logout Form -->
            <form id="logout-form" action="{{ route('logout') }}" method="POST" class="hidden">
                @csrf
            </form>
        </div>
    </div>
</nav>

<script>
    function toggleDropdown() {
        const dropdown = document.getElementById('dropdown-menu')
        dropdown.classList.toggle('hidden')
    }
</script>