@extends('layouts.resident')

@section('content')
< class="container mx-auto p-0 md:p-6 lg:p-8">
    <section class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 py-12 sm:py-16">
        <div class=" mb-28">
            <h3 class="text-2xl font-weight-light uppercase font-inter text-[#4169e1] font-semibold">
                welcome to the
            </h3>
            <p class="capitalize font-bold text-3xl sm:text-4xl md:text-5xl font-raleway">
                official barangay kalinaw website
            </p>
        </div>

        <!-- News Grid -->
        <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-3 gap-6">
            @for ($i = 1; $i <= 3; $i++)
                <article class="group relative bg-white rounded-xl overflow-hidden shadow-sm 
                      transition-all duration-300 hover:shadow-md hover:-translate-y-1">
                <!-- Image Container -->
                <div class="aspect-video relative">
                    <img
                        src="{{ asset('../images/brngy_logo.png') }}"
                        alt="News thumbnail"
                        class="w-full h-full object-cover"
                        loading="lazy">
                    <div class="absolute inset-0 bg-gradient-to-t from-black/60 via-black/20 to-transparent"></div>
                </div>

                <!-- Content -->
                <div class="p-5">
                    <time datetime="2024-03-15" class="text-xs text-gray-500">
                        March 15, 2024
                    </time>

                    <h3 class="mt-2 text-lg font-bold text-gray-900 line-clamp-2">
                        News Title {{ $i }}
                    </h3>

                    <p class="mt-2 text-sm text-gray-600 line-clamp-2">
                        Lorem ipsum dolor sit amet, consectetur adipiscing elit. Sed do eiusmod tempor incididunt ut labore.
                    </p>

                    <a href="#"
                        class="mt-4 inline-flex items-center text-sm font-medium text-[#4169e1] group-hover:underline">
                        Read More
                        <svg class="ml-1 w-4 h-4 transition-transform group-hover:translate-x-1"
                            fill="none" viewBox="0 0 24 24" stroke="currentColor">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5l7 7-7 7" />
                        </svg>
                    </a>
                </div>
                </article>
                @endfor
        </div>
    </section>
    </div>


    </div>

    <!-- Breakpoint -->
    <section class="bg-[#F5F5F5] border-y border-[#1e1e1e]/25 py-12 sm:py-16 lg:py-20 overflow-hidden relative">
        <!-- Background Image -->
        <img
            src="{{ asset('../images/eagle_mugnanimao.png') }}"
            alt="Background Eagle"
            class="absolute w-72 h-auto -left-40 top-48 opacity-15 pointer-events-none"
            aria-hidden="true">

        <!-- Main Content -->
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
            <div class="flex flex-col md:flex-row items-center gap-8 md:gap-20">
                <!-- Image Section -->
                <div class="w-full md:w-1/2">
                    <div class="aspect-[4/3] relative rounded-lg overflow-hidden shadow-lg">
                        <img
                            src="{{ asset('../images/brngy_pic.jpg') }}"
                            alt="Barangay Service Image"
                            class="absolute inset-0 w-full h-full object-cover transition duration-700 hover:scale-105">
                    </div>
                </div>

                <!-- Content Section -->
                <div class="w-full md:w-1/2 flex flex-col gap-4 text-center md:text-left">
                    <span class="uppercase font-inter font-semibold text-[#4169E1] tracking-wider">
                        Service
                    </span>

                    <h2 class="font-raleway font-bold text-2xl sm:text-3xl lg:text-4xl capitalize">
                        barangay clearance & healthcare
                    </h2>

                    <p class="font-inter text-gray-600 leading-relaxed">
                        Lorem ipsum dolor sit amet consectetur adipisicing elit. Delectus commodi nobis magni laboriosam dolore. Maiores, obcaecati qui nisi voluptatem iusto rerum.
                    </p>

                    <div class="mt-8">
                        <a href="#"
                            class="inline-flex items-center px-6 py-3 bg-[#4169e1] text-white font-inter rounded-md 
                              transition duration-300 hover:bg-[#4169e1]/90 hover:shadow-lg">
                            Learn More
                            <svg class="ml-2 w-4 h-4" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5l7 7-7 7" />
                            </svg>
                        </a>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <!-- Barangay Officials Section -->
    <section class="py-20 bg-gray-50">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
            <!-- Header -->
            <div class="text-center space-y-2 mb-16">
                <span class="inline-block text-lg font-medium text-[#4169e1] tracking-wider uppercase">
                    Our Team
                </span>
                <h2 class="text-3xl sm:text-4xl lg:text-5xl font-bold capitalize">
                    Barangay Officials
                </h2>
            </div>

            <!-- Officials Grid -->
            <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-3 xl:grid-cols-4 gap-8">
                @foreach($officials as $official)
                <article class="group relative bg-white rounded-xl overflow-hidden shadow-sm hover:shadow-lg transition-all duration-300">
                    <div class="aspect-[3/4] relative overflow-hidden">
                        <img
                            src="{{ asset($official->image_path) }}"
                            alt="Photo of {{ $official->resident->last_name }}, {{ $official->resident->first_name }}"
                            class="w-full h-full object-cover object-center transform group-hover:scale-105 transition-transform duration-500"
                            loading="lazy">

                        <div class="absolute inset-0 bg-gradient-to-t from-black/80 via-black/40 to-transparent opacity-90"></div>

                        <div class="absolute bottom-0 left-0 right-0 p-6">
                            <div class="transform translate-y-4 group-hover:translate-y-0 transition-transform duration-300">
                                <h3 class="text-xl font-bold text-white mb-1">
                                    {{ $official->resident->last_name }}, {{ $official->resident->first_name }}
                                </h3>
                                <p class="text-white/90 text-sm mb-3">
                                    {{ $official->position }}
                                </p>

                                <div class="flex items-center gap-2 text-white/75 text-xs opacity-0 group-hover:opacity-100 transition-opacity duration-300">
                                    <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 7V3m8 4V3m-9 8h10M5 21h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v12a2 2 0 002 2z" />
                                    </svg>
                                    <span>Term: {{ $official->term_start }} - {{ $official->term_end }}</span>
                                </div>

                                @if($official->is_active)
                                <span class="absolute top-6 right-6 px-2 py-1 bg-green-500 text-white text-xs font-medium rounded-full">
                                    Active
                                </span>
                                @endif
                            </div>
                        </div>
                    </div>
                </article>
                @endforeach
            </div>
        </div>
    </section>

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