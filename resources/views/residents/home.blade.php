@extends('layouts.resident')

@section('content')
<div class="container mx-auto">
    <div class="grid grid-cols-12 gap-5 bg-eagle-alt">
        <div class="col-span-5 flex flex-col h-auto gap-6 justify-center mt-16">
            <div class="flex flex-col gap-2">
                <h3 class="text-2xl font-weight-light uppercase font-inter text-[#4169e1] font-semibold">welcome to the</h3>
                <p class="capitalize font-bold text-5xl font-raleway">official barangay kalinaw website</p>
                @if(Auth::check())
                <span>Im gay</span>
                @else
                <span>Didnt work</span>
                @endif
            </div>
        </div>
    </div>



    <div class="container mx-auto mt-24 min-h-screen relative">
        <!-- Carousel Wrapper -->
        <div id="card-container" class="overflow-x-auto relative ">
            <div class="flex space-x-6 rtl:space-x-reverse snap-x snap-mandatory">
                <!-- News Card 1 -->
                <a href="link-news" class="card flex-shrink-0 bg-white border p-4 rounded-lg w-auto h-auto snap-center">
                    <img src="{{ asset('../images/brngy_logo.png') }}" alt="asd" class="w-[379px] h-[308px]">
                </a>
                <a href="link-news" class="card flex-shrink-0 bg-white border p-4 rounded-lg w-auto h-auto snap-center">
                    <img src="{{ asset('../images/brngy_logo.png') }}" alt="asd" class="w-[379px] h-[308px]">
                </a>
                <a href="link-news" class="card flex-shrink-0 bg-white border p-4 rounded-lg w-auto h-auto snap-center">
                    <img src="{{ asset('../images/brngy_logo.png') }}" alt="asd" class="w-[379px] h-[308px]">
                </a>
                <a href="link-news" class="card flex-shrink-0 bg-white border p-4 rounded-lg w-auto h-auto snap-center">
                    <img src="{{ asset('../images/brngy_logo.png') }}" alt="asd" class="w-[379px] h-[308px]">
                </a>
                <a href="link-news" class="card flex-shrink-0 bg-white border p-4 rounded-lg w-auto h-auto snap-center">
                    <img src="{{ asset('../images/brngy_logo.png') }}" alt="asd" class="w-[379px] h-[308px]">
                </a>
                <a href="link-news" class="card flex-shrink-0 bg-white border p-4 rounded-lg w-auto h-auto snap-center">
                    <img src="{{ asset('../images/brngy_logo.png') }}" alt="asd" class="w-[379px] h-[308px]">
                </a>
                <a href="link-news" class="card flex-shrink-0 bg-white border p-4 rounded-lg w-auto h-auto snap-center">
                    <img src="{{ asset('../images/brngy_logo.png') }}" alt="asd" class="w-[379px] h-[308px]">
                </a>
                <a href="link-news" class="card flex-shrink-0 bg-white border p-4 rounded-lg w-auto h-auto snap-center">
                    <img src="{{ asset('../images/brngy_logo.png') }}" alt="asd" class="w-[379px] h-[308px]">
                </a>
            </div>
        </div>

        <div>
            <!-- Custom Slider Control -->
            <input id="custom-slider" type="range" min="0" max="100" value="0" class="w-full mt-2" disabled>
        </div>

        <div>
            <h1 class="font-raleway font-bold text-2xl mt-8">Lorem Ipsum Feature</h1>
            <div class="flex items-center mt-2 space-x-4">
                <p>Lorem ipsum dolooluptatem nasamu molestias id.</p>
                <div class="pl-64">
                    <button id="slider-prev" class="px-4 py-2 bg-blue-500 text-white rounded-l">&lt;</button>
                    <button id="slider-next" class="px-4 py-2 bg-blue-500 text-white rounded-r">&gt;</button>
                </div>
            </div>
        </div>
    </div>
</div>

<!-- Breakpoint -->
<div class="bg-[#F5F5F5] w-full h-full flex items-center justify-center relative overflow-hidden border border-b-[1px] border-t-[1px] border-[#1e1e1e] border-opacity-25">
    <div class="container mx-auto">
        <div class="grid grid-cols-12 gap-5 bg-eagle-alt">
            <div><img src="{{ asset('../images/eagle_mugnanimao.png') }}" alt="asd" class="w-[300px] h-[300px] absolute top-[200px] left-[-140px] opacity-15 z-0"></div>
            <div class="flex justify-between items-center gap-[80px] col-start-1 col-span-12 pt-[40px] pb-[40px]">
                <img src="{{ asset('../images/brngy_pic.jpg') }}" alt="asd" class="w-[50%] h-[363px] z-50">
                <div class="w-[50%] h-auto flex flex-col gap-[15px]">
                    <h1 class="uppercase font-inter font-semibold text-[#4169E1] text-[18px] w-full">Service</h1>
                    <h1 class="capitalize font-raleway font-bold text-[36px] w-53">barangay clearance & healthcare </h1>
                    <p class=" font-inter text-[16px]">Lorem ipsum dolor sit amet consectetur adipisicing elit. Delectus commodi nobis magni laboriosam dolore. Maiores, obcaecati qui nisi voluptatem iusto rerum, aliquam illum quae sit quaerat quos iure ipsam nostrum. </p>
                    <div class="mt-12">
                        <a class="bg-[#4169e1] text-[#fefefe] self-center py-2 px-4 font-inter font-normal text-base pt-15 flex w-[120px]">Learn More</a>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
</div>
@endsection