<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <title>Document</title>
    @vite(['resources/css/app.css', 'resources/js/app.js'])
</head>

<body class="flex h-screen font-inter"> 

    @include('layouts.admin-navigation')

    <main class="flex flex-col w-full">
        <div class="bg-[#f5f5f5] border-[#1e1e1e] border-opacity-25 border-b flex">
            <div class="flex flex-col p-4 w-full">
                <h2 class="text-base font-inter uppercase text-barangay-main font-semibold">
                    @if (Request::is('admin'))
                    Dashboard
                    @elseif(Request::is('*admin/residents*'))
                    Residents
                    @else
                    Placeholder
                    @endif
                </h2>
                <h1 class="text-3xl font-raleway text-[#1e1e1e] font-bold">
                    @if (Request::is('admin'))
                    Welcome back, User
                    @elseif (Request::is('admin/residents'))
                    Barangay Residents
                    @elseif (Request::is('admin/residents/register'))
                    Register New Resident
                    @else
                    Placeholder
                    @endif
                </h1>
            </div>
            <div class="overflow-hidden relative w-full">
                <img class="w-[250px] h-[250px] absolute top-[-70px] right-[-45px] opacity-25" src="{{ asset('images/eagle_mugnanimao.png') }}" alt="">
            </div>
        </div>

        @yield('content')
    </main>
</body>

</html>