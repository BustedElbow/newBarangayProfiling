@extends('layouts.resident')

@section('content')
<div class="container mx-auto p-0 md:p-6 lg:p-8 xl:pl-4">
    <div class="grid grid-cols-12 gap-5 bg-eagle-alt p-4 md:p-6 lg:p-8 xl:pl-4">
        <div class="col-span-12 md:col-span-5 flex flex-col h-auto gap-6 justify-center mt-16">
            <div class="flex flex-col gap-2">
                <h3 class="text-2xl font-weight-light uppercase font-inter text-[#4169e1] font-semibold">welcome to the</h3>
                <p class="capitalize font-bold text-3xl sm:text-4xl md:text-5xl font-raleway">official barangay kalinaw website</p>
                @if(Auth::check())
                <span>Im gay</span>
                @else
                <span>Didnt work</span>
                @endif
            </div>
        </div>
    </div>

    <div class="container mx-auto px-4 py-8">
        <!-- Section Header -->
        <div class="mb-8">
            <h3 class="text-5xl font-inter text-[#4169e1] font-semibold uppercase relative inline-block">
                News Section
                <span class="absolute bottom-0 left-0 w-full h-1 bg-[#4169e1]/20"></span>
            </h3>
        </div>

        <!-- News Section -->
        <div class="container mx-auto px-4 py-12">
            <!-- Category Tabs -->
            <div class="flex gap-4 mb-8 overflow-x-auto hide-scrollbar">
                <button class="px-4 py-2 text-sm font-medium bg-[#4169e1] text-white rounded-full">All</button>
            </div>

            <!-- News Grid -->
            <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-3 gap-6">
                @for ($i = 1; $i <= 6; $i++)
                    <div class="bg-white rounded-xl shadow-md overflow-hidden hover:shadow-lg transition-shadow duration-300">
                    <!-- Image -->
                    <div class="relative aspect-[16/9]">
                        <img src="{{ asset('../images/brngy_logo.png') }}"
                            alt="News Image {{ $i }}"
                            class="w-full h-full object-cover">
                        <div class="absolute inset-0 bg-gradient-to-t from-black/60 to-transparent"></div>

                    </div>

                    <!-- Content -->
                    <div class="p-4">
                        <div class="text-xs text-gray-500 mb-2">March 15, 2024</div>
                        <h4 class="font-raleway font-bold text-lg mb-2 line-clamp-2">News Title {{ $i }}</h4>
                        <p class="text-gray-600 text-sm line-clamp-2 mb-4">Lorem ipsum dolor sit amet, consectetur adipiscing elit.</p>
                        <a href="link-news" class="text-[#4169e1] text-sm font-medium hover:underline">Read More →</a>
                    </div>
            </div>
            @endfor
        </div>

        <!-- View More Button -->
        <div class="text-center mt-8">
            <button class="px-6 py-2 border border-[#4169e1] text-[#4169e1] rounded-full hover:bg-[#4169e1] hover:text-white transition-colors duration-300">
                View More News
            </button>
        </div>
    </div>
</div>


</div>

<!-- Breakpoint -->
<div class="bg-[#F5F5F5] w-full min-h-screen flex items-center justify-center relative overflow-hidden border border-y border-[#1e1e1e] border-opacity-25 p-4 md:p-6 lg:p-8">
    <div class="container mx-auto">
        <div class="grid grid-cols-12 gap-5 bg-eagle-alt relative">
            <div class="">
                <img src="{{ asset('../images/eagle_mugnanimao.png') }}" alt="asd" class="w-1/4 md:w-[300px] h-auto absolute top-[200px] left-[-160px] opacity-15 z-10 ">
            </div>
            <div class="flex flex-col md:flex-row justify-between items-center gap-8 md:gap-[80px] col-start-1 col-span-12 py-8 md:py-[40px] z-20">
                <img src="{{ asset('../images/brngy_pic.jpg') }}" alt="asd" class="w-full md:w-[50%] h-auto md:h-[363px] object-cover ">
                <div class="w-full md:w-[50%] h-auto flex flex-col gap-[15px] text-center md:text-left">
                    <h1 class="uppercase font-inter font-semibold text-[#4169E1] text-[18px]">Service</h1>
                    <h1 class="capitalize font-raleway font-bold text-[28px] md:text-[36px]">barangay clearance & healthcare</h1>
                    <p class="font-inter text-[16px]">Lorem ipsum dolor sit amet consectetur adipisicing elit. Delectus commodi nobis magni laboriosam dolore. Maiores, obcaecati qui nisi voluptatem iusto rerum, aliquam illum quae sit quaerat quos iure ipsam nostrum.</p>
                    <div class="mt-8 md:mt-12 flex justify-center md:justify-start">
                        <a class="bg-[#4169e1] text-[#fefefe] py-2 px-4 font-inter font-normal text-base w-[120px] text-center">Learn More</a>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<!-- Barangay Officials Section -->
<div class="container mx-auto py-20 px-4 md:px-6 lg:px-8">
    <div class="text-center mb-12">
        <h2 class="text-2xl font-inter text-[#4169e1] font-semibold uppercase mb-2">Our Team</h2>
        <h3 class="font-raleway font-bold text-3xl md:text-4xl capitalize">Barangay Officials</h3>
    </div>

    <div class="grid grid-cols-1 sm:grid-cols-2 md:grid-cols-3 lg:grid-cols-4 gap-6">
        <!-- Barangay Captain -->
        <div class="bg-white rounded-lg shadow-md overflow-hidden">
            <div class="relative">
                <img src="{{ asset('../images/miguel.png') }}" alt="Barangay Captain" class="w-full h-64 object-cover">
                <div class="absolute bottom-0 left-0 right-0 bg-gradient-to-t from-black/70 to-transparent p-4">
                    <h4 class="text-white font-semibold text-xl">Miguel Andrei D. Tan</h4>
                    <p class="text-white/90 text-sm">Barangay Captain</p>
                </div>
            </div>
        </div>

        <!-- Kagawad 1 -->
        <div class="bg-white rounded-lg shadow-md overflow-hidden">
            <div class="relative">
                <img src="{{ asset('../images/rheniel.png') }}" alt="Kagawad" class="w-full h-64 object-cover">
                <div class="absolute bottom-0 left-0 right-0 bg-gradient-to-t from-black/70 to-transparent p-4">
                    <h4 class="text-white font-semibold text-xl">Rheniel F. Penional</h4>
                    <p class="text-white/90 text-sm">Kagawad - Education</p>
                </div>
            </div>
        </div>
    </div>
</div>

<footer class="bg-[#4169E1] text-white py-12">
    <div class="container mx-auto px-4">
        <!-- Main Footer Content -->
        <div class="flex flex-col space-y-8">
            <!-- Branding Section -->
            <div class="text-center">
                <h3 class="font-raleway font-bold text-2xl mb-2">Barangay Kalinaw</h3>
                <p class="text-white/80">Serving Our Community</p>
            </div>

            <!-- Contact Information -->
            <div class="text-center">
                <h4 class="font-inter font-semibold mb-4">Contact Us</h4>
                <div class="space-y-2 text-white/80">
                    <p>University Of Mindanao, Matina Campus, Davao City</p>
                    <p>Phone: (0917)-138-5648</p>
                </div>
            </div>





            <!-- Divider -->
            <div class="border-t border-white/20 my-4"></div>

            <!-- Copyright -->
            <div class="text-center text-sm text-white/80">
                <p>&copy; 2024 Barangay Kalinaw. All rights reserved.</p>
                <p class="mt-2">All services and information on this website are subject to change.</p>
            </div>
        </div>
    </div>
</footer>

@endsection