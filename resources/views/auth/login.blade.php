<x-guest-layout>
    <!-- Session Status -->
    <x-auth-session-status class="mb-4" :status="session('status')" />
    <div class="flex border border-black border-opacity-25 rounded">
        <div class="border-r border-black border-opacity-25">
            <div class="flex flex-col gap-4 w-full bg-[#f5f5f5] p-5 overflow-hidden relative">
                <h2 class="uppercase font-bold text-barangay-main font-inter">Information</h2>
                <h1 class="font-bold text-4xl font-raleway z-10">Don't have an account?</h1>
                <img class="w-[350px] h-[350px] absolute opacity-25 top-[-60px] right-[-80px]" src="{{ asset('images/eagle_mugnanimao.png')}}" alt="">
            </div>
            <div class="p-5 font-inter">
                <p>Test Texts</p>
            </div>
        </div>
        <div class="flex flex-col items-center p-12">

            <img class="w-[125px] h-[125px] mb-5" src="{{ asset('images/barangayEmblem.png') }}" alt="Barangay Kalinaw Emblem">
        
            <span class="font-raleway font-bold text-2xl">Barangay Kalinaw</span>
            <span class="font-inter text-[#7d7d7d] mb-5 ">Resident</span>

            <form method="POST" action="{{ route('login') }}">
                @csrf

                <!-- Email Address -->
                <div>
                    <x-input-label for="email" :value="__('Email')" />
                    <x-text-input id="email" class="block mt-1 w-full" type="email" name="email" :value="old('email')" required autofocus autocomplete="username" />
                    <x-input-error :messages="$errors->get('email')" class="mt-2" />
                </div>

                <!-- Password -->
                <div class="mt-4">
                    <x-input-label for="password" :value="__('Password')" />

                    <x-text-input id="password" class="block mt-1 w-full"
                        type="password"
                        name="password"
                        required autocomplete="current-password" />

                    <x-input-error :messages="$errors->get('password')" class="mt-2" />
                </div>

                <!-- Remember Me -->
                <div class="block mt-4">
                    <label for="remember_me" class="inline-flex items-center">
                        <input id="remember_me" type="checkbox" class="rounded border-gray-300 text-indigo-600 shadow-sm focus:ring-indigo-500" name="remember">
                        <span class="ms-2 text-sm text-gray-600">{{ __('Remember me') }}</span>
                    </label>
                </div>

                <div class="flex items-center justify-end mt-4">
                    @if (Route::has('password.request'))
                    <a class="underline text-sm text-gray-600 hover:text-gray-900 rounded-md focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-indigo-500" href="{{ route('password.request') }}">
                        {{ __('Forgot your password?') }}
                    </a>
                    @endif

                    <x-primary-button class="ms-3">
                        {{ __('Log in') }}
                    </x-primary-button>
                </div>
            </form>
        </div>
    </div>
</x-guest-layout>