<x-app-layout>
    <div class="container mx-auto">
        <div class="grid grid-cols-12 gap-5">
            <!-- Parent div (sidebar) -->
            <div class="col-start-1 col-span-3">
                @include('profile.partials.sidebar')
            </div>

            <!-- Main content -->
            <div class="col-start-4 col-span-9 flex flex-col mt-32 gap-2">
                <!-- Profile Information -->
                <div class="w-full h-[500px] border border-barangay-common border-opacity-25 overflow-hidden relative bg-[#F5F5F5]">
                    @include('profile.partials.update-profile-information-form')
                </div>

                <!-- Update Password -->
                <div class="w-full h-[500px] border border-barangay-common border-opacity-25 flex">
                    @include('profile.partials.update-password-form')
                </div>

                <!-- Delete Account -->
                <div class="w-full h-[200px] border border-barangay-common border-opacity-25 flex">
                    <div class="flex flex-col space-y-4">
                        @include('profile.partials.delete-user-form')
                    </div>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>