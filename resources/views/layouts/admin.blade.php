<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    @vite(['resources/css/app.css', 'resources/js/app.js'])
</head>

<body class="flex h-screen">

    @include('layouts.admin-navigation')

    <main class="flex flex-col">
        <div class="bg-[#f5f5f5] p-4 relative overflow-hidden border-[#1e1e1e] border-opacity-25 border-b">
            <h2 class="text-base font-inter uppercase text-barangay-main font-semibold">
                @if (Request::is('*residents*'))
                Residents
                @elseif (Request::is('*dashboard*'))
                Dashboard
                @endif
            </h2>
            <h1 class="text-3xl font-raleway text-[#1e1e1e] font-bold">
                @if (Request::is('*dashboard*'))
                Welcome back, User
                @elseif (Request::is('*residents*'))
                Barangay Residents
                @elseif (Request::is('*residents/register*'))
                Register New Resident
                @endif
            </h1>
            <img class="w-[250px] h-[250px] absolute top-[-70px] right-[-45px] opacity-25" src="{{ asset('images/eagle_mugnanimao.png') }}" alt="">
        </div>

        @yield('content')
    </main>

</body>

</html>