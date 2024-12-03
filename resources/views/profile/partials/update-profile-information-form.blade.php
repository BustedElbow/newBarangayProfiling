<section>
    <!-- parent div -->
    <div>
        <!-- banner -->
        <div class="overflow-hidden h-[53px] w-auto">
            <img src="{{ asset('../images/profile_banner.png') }}" alt="asd" class="w-full h-[53px] object-cover opacity-100">
        </div>

        <header class="mb-4 mt-4 pl-9">
            <h2 class="text-lg font-medium text-gray-900">
                {{ __('Profile Information') }}
            </h2>

            <p class="mt-1 text-sm text-gray-600">
                {{ __("Update your account's profile information and email address.") }}
            </p>
        </header>

        <!-- main content -->
        <div class="flex">
            <div class="absolute w-full h-full right-[10px] top-7">
                <img src="{{ asset('../images/eagle_mugnanimao.png') }}" alt="Eagle Emblem"
                    class="w-[300px] h-[300px] absolute opacity-15 right-[-80px] bottom-[-10px] z-0">
            </div>
            <div class="mr-8 ml-9 relative">
                <div class="max-w-md mx-auto bg-white p-6 border rounded">
                    <h2 class="text-2xl font-semibold mb-4">Image dapat naa diri</h2>
                    <!-- Image Input Form -->
                    <form id="image-form">
                        <label for="image-upload" class="block mb-2 text-gray-700">Choose an Image:</label>
                        <input type="file" id="image-upload" name="image" accept="image/*" class="block mb-4 p-2 border rounded" />

                        <!-- Image Preview -->
                        <div id="image-preview" class="hidden">
                            <h3 class="text-lg font-semibold">Image Preview:</h3>
                            <div class="w-32 h-32 rounded-full overflow-hidden mx-auto mt-4">
                                <img id="preview" src="" alt="Image preview" class="object-cover w-full h-full" />
                            </div>
                        </div>
                        <button type="submit" class="bg-blue-500 text-white py-2 px-4 rounded">Submit</button>
                    </form>
                </div>
            </div>



            <div class="">
                <form id="send-verification" method="post" action="{{ route('verification.send') }}">
                    @csrf
                </form>

                <form method="post" action="{{ route('profile.update') }}" class="">
                    @csrf
                    @method('patch')

                    <div class="mb-6">
                        <x-input-label for="name" :value="__('Name')" />
                        <x-text-input id="name" name="name" type="text" class="mt-1 block w-full" :value="old('name', $user->name)" required autofocus autocomplete="name" />
                        <x-input-error class="mt-2" :messages="$errors->get('name')" />
                    </div>

                    <div class="mb-6">
                        <x-input-label for="role" :value="__('Role')" />
                        <x-text-input id="role" name="role" type="text" class="mt-1 block w-full" :value="old('role', $user->role)" required autofocus autocomplete="role" />
                        <x-input-error class="mt-2" :messages="$errors->get('role')" />
                    </div>

                    <div class="mb-6">
                        <x-input-label for="email" :value="__('Email')" />
                        <x-text-input id="email" name="email" type="email" class="mt-1 block w-full" :value="old('email', $user->email)" required autocomplete="username" />
                        <x-input-error class="mt-2" :messages="$errors->get('email')" />

                        @if ($user instanceof \Illuminate\Contracts\Auth\MustVerifyEmail && ! $user->hasVerifiedEmail())
                        <div>
                            <p class="text-sm mt-2 text-gray-800">
                                {{ __('Your email address is unverified.') }}

                                <button form="send-verification" class="underline text-sm text-gray-600 hover:text-gray-900 rounded-md focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-indigo-500">
                                    {{ __('Click here to re-send the verification email.') }}
                                </button>
                            </p>

                            @if (session('status') === 'verification-link-sent')
                            <p class="mt-2 font-medium text-sm text-green-600">
                                {{ __('A new verification link has been sent to your email address.') }}
                            </p>
                            @endif
                        </div>
                        @endif
                    </div>

                    <div class="flex items-center gap-4">
                        <x-primary-button>{{ __('Save') }}</x-primary-button>

                        @if (session('status') === 'profile-updated')
                        <p
                            x-data="{ show: true }"
                            x-show="show"
                            x-transition
                            x-init="setTimeout(() => show = false, 2000)"
                            class="text-sm text-gray-600">{{ __('Saved.') }}</p>
                        @endif
                    </div>
                </form>
            </div>
        </div>
    </div>

</section>