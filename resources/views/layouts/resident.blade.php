<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    @vite(['resources/css/app.css', 'resources/js/app.js'])
</head>

<body class="font-inter">
  
    <div class="min-h-screen bg-gray-100 mt-10">
        @include('layouts.resident-navigation')

        <!-- Page Content -->
        <main>
            @yield('content')
        </main>
    </div>
</body>

</html>