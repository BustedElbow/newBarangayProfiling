<nav class="py-9 border border-r-[#1e1e1e] border-opacity-25 bg-[#FAFAFA] flex flex-col justify-between w-64 h-screen">
    <div class="flex flex-col w-full items-center gap-12">
        <div>
            <img class="w-[105px] h-[106px]" src="{{ asset('images/barangayEmblem.png') }}" alt="Barangay Emblem">
        </div>
        <div class="w-full">
            <ul class="flex flex-col gap-3">
                <li><a class="flex pl-5 gap-3 font-inter font-bold text-base py-3 {{ Request::is('*dashboard*') ? 'text-barangay-main border-barangay-main border-r-4 bg-slate-300' : 'text-[#1e1e1e]'}}" href="{{ route('admin.dashboard') }}"><img class="w-[24px] h-[24px]" src="{{ Request::is('*dashboard*') ? asset('images/icons/dashboard100-main.png') : asset('images/icons/dashboard100-black.png') }}" alt="">Dashboard</a></li>
                <li><a class="flex pl-5 gap-3 font-inter font-bold text-base py-3 {{ Request::is('*residents*') ? 'text-barangay-main border-barangay-main border-r-4 bg-slate-300' : 'text-[#1e1e1e]'}}" href="{{ route('admin.residents')}}"><img class="w-[24px] h-[24px]" src="{{ Request::is('*residents*') ? asset('images/icons/resident100-main.png') : asset('images/icons/resident100-black.png') }}" alt="">Residents</a></li>
            </ul>
        </div>
    </div>
    <div class="flex flex-col items-center gap-3">
        <img class="w-[50px] h-[50px] rounded-[100px] bg-slate-400" src="" alt="">
        <div class="flex flex-col gap-0">
            <span class="font-raleway font-bold text-sm">Tan, Miguel Andrei</span>
            <span class="font-inter font-normal text-sm text-[#1e1e1e] text-opacity-60">Barangay Captain</span>
        </div>
    </div>
</nav>