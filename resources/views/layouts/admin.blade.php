<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <title>Document</title>
    <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
    @vite(['resources/css/app.css', 'resources/js/app.js'])
</head>

<body class="flex flex-col h-full font-inter">
    <div class="bg-[#fafafa] border-[#1e1e1e] border-opacity-25 border-b flex justify-between py-2 px-7 fixed top-0 w-full z-50">
        <div class="flex gap-3 justify-center items-center">
            <img class="w-[55px] h-[55px]" src="{{ asset('images/barangayEmblem.png') }}" alt="Barangay Emblem">
            <h2 class="uppercase text-lg font-bold font-raleway text-barangay-main">Barangay Kalinaw</h2>
        </div>
        <div class="flex flex-col items-center justify-center gap-3 relative">
            <div class="flex flex-col gap-0 cursor-pointer" onclick="toggleDropdown()">
                <span class="font-raleway font-bold text-sm">{{ Auth::user()->name }}</span>
                <span class="font-inter font-normal text-sm text-[#1e1e1e] text-opacity-60">Barangay Captain</span>
            </div>
            <!-- Dropdown Menu -->
            <div id="dropdown-menu" class="hidden absolute top-full mt-2 bg-white shadow-md border rounded w-auto">
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
    </div>

    <main class="flex w-full mt-16 min-h-screen">
        @include('layouts.admin-navigation')
        <div class="ml-64 w-full min-h-screen flex justify-center bg-slate-100">
            @yield('content')
        </div>
    </main>

    <script>
        function toggleDropdown() {
            const dropdown = document.getElementById('dropdown-menu')
            dropdown.classList.toggle('hidden')
        }
    </script>
</body>

</html>