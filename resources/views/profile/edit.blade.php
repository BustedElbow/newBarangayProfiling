<x-app-layout>
    <div class="flex justify-center items-start gap-6">

        <!-- Main content -->
        <div class="flex flex-col mt-32 gap-2">

            <!-- Resident Profile -->
            <div class="w-full border border-barangay-common border-opacity-25 bg-[#fafafa] rounded-lg overflow-hidden">
                <div class="p-6 space-y-6">
                    <!-- Header -->
                    <div class="flex items-start gap-6">
                        <!-- Profile Image -->
                        <div class="w-24 h-24 rounded-full border-2 border-barangay-main overflow-hidden bg-gray-100">
                            <img
                                src="{{ auth()->user()->resident->image ?? asset('images/default-profile.png') }}"
                                alt="Profile Picture"
                                class="w-full h-full object-cover">
                        </div>

                        <!-- Basic Info -->
                        <div class="flex-1">
                            <h2 class="text-2xl font-bold text-gray-800">
                                {{ auth()->user()->resident->first_name }}
                                {{ auth()->user()->resident->middle_name }}
                                {{ auth()->user()->resident->last_name }}
                            </h2>
                            <p class="text-gray-500">ID: {{ auth()->user()->resident->identification_number }}</p>
                        </div>
                    </div>

                </div>
            </div>

            <!-- Profile Information -->
            <div class=" w-full h-fit border border-barangay-common border-opacity-25 overflow-hidden relative bg-[#fafafa] rounded-lg">
                @include('profile.partials.update-profile-information-form')
            </div>

            <!-- Update Password -->
            <div class="w-full h-auto border border-barangay-common border-opacity-25 flex rounded-lg bg-[#fafafa]">
                @include('profile.partials.update-password-form')
            </div>

            <!-- Request Barangay Clearance -->
            <div class="w-full h-auto border border-barangay-common border-opacity-25 flex rounded-lg bg-[#fafafa]">
                <div class="w-full p-6">
                    <h2 class="font-raleway text-barangay-main font-bold text-lg">Request Barangay Clearance</h2>
                    <p class="text-gray-600 mb-4">Submit a request for barangay clearance</p>

                    <form method="POST" action="{{ route('clearance.request') }}" class="space-y-4">
                        @csrf

                        <div>
                            <label for="purpose" class="block text-sm font-medium text-gray-700">Purpose</label>
                            <textarea
                                id="purpose"
                                name="purpose"
                                rows="3"
                                class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-barangay-main focus:ring focus:ring-barangay-main focus:ring-opacity-50"
                                placeholder="State your purpose for requesting clearance"
                                required></textarea>
                        </div>

                        <div class="flex justify-end">
                            <button type="submit" class="bg-barangay-main text-white px-4 py-2 rounded-md hover:bg-opacity-90 transition-colors">
                                Submit Request
                            </button>
                        </div>
                    </form>

                    @if(session('success'))
                    <div class="mt-4 p-4 bg-green-100 text-green-700 rounded-md">
                        {{ session('success') }}
                    </div>
                    @endif
                </div>
            </div>

            <div class="w-full h-auto border border-barangay-common border-opacity-25 flex flex-col rounded-lg bg-[#fafafa]">
                <h3 class="text-lg font-bold font-raleway mb-4 p-4 text-barangay-main">Clearance History</h3>

                <div class="overflow-x-auto">
                    <table class="min-w-full divide-y divide-gray-200">
                        <thead class="bg-gray-50">
                            <tr>
                                <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Request Date</th>
                                <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Purpose</th>
                                <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Status</th>
                                <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Processed Date</th>
                            </tr>
                        </thead>
                        <tbody class="bg-white divide-y divide-gray-200">
                            @forelse(auth()->user()->resident->clearances()->latest('request_date')->get() as $clearance)
                            <tr>
                                <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-500">
                                    {{ $clearance->request_date->format('M d, Y') }}
                                </td>
                                <td class="px-6 py-4 text-sm text-gray-900">
                                    {{ $clearance->purpose }}
                                </td>
                                <td class="px-6 py-4 whitespace-nowrap">
                                    <span class="px-2 inline-flex text-xs leading-5 font-semibold rounded-full 
                            {{ $clearance->status === 'pending' ? 'bg-yellow-100 text-yellow-800' : '' }}
                            {{ $clearance->status === 'approved' ? 'bg-green-100 text-green-800' : '' }}
                            {{ $clearance->status === 'rejected' ? 'bg-red-100 text-red-800' : '' }}">
                                        {{ ucfirst($clearance->status) }}
                                    </span>
                                </td>
                                <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-500">
                                    {{ $clearance->processed_date ? $clearance->processed_date->format('M d, Y') : 'Pending' }}
                                </td>
                            </tr>
                            @empty
                            <tr>
                                <td colspan="4" class="px-6 py-4 text-center text-gray-500">
                                    No clearance requests found.
                                </td>
                            </tr>
                            @endforelse
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>

</x-app-layout>