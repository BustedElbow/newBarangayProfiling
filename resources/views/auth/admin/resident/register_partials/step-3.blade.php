<div class="space-y-6">
    <!-- Occupation & Employer Row -->
    <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
        <!-- Occupation -->
        <div class="space-y-2">
            <label class="block text-sm font-medium text-gray-700" for="occupation">
                <span class="flex items-center gap-2">
                    <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M21 13.255A23.931 23.931 0 0112 15c-3.183 0-6.22-.62-9-1.745M16 6V4a2 2 0 00-2-2h-4a2 2 0 00-2 2v2m4 6h.01M5 20h14a2 2 0 002-2V8a2 2 0 00-2-2H5a2 2 0 00-2 2v10a2 2 0 002 2z" />
                    </svg>
                    Occupation
                </span>
            </label>
            <input
                type="text"
                name="occupation"
                id="occupation"
                value="{{ old('occupation', session('register_data.occupation')) }}"
                class="w-full px-4 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-barangay-main focus:border-barangay-main transition-colors">
        </div>

        <!-- Employer -->
        <div class="space-y-2">
            <label class="block text-sm font-medium text-gray-700" for="employer">
                <span class="flex items-center gap-2">
                    <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 21V5a2 2 0 00-2-2H7a2 2 0 00-2 2v16m14 0h2m-2 0h-5m-9 0H3m2 0h5M9 7h1m-1 4h1m4-4h1m-1 4h1m-5 10v-5a1 1 0 011-1h2a1 1 0 011 1v5m-4 0h4" />
                    </svg>
                    Employer
                </span>
            </label>
            <input
                type="text"
                name="employer"
                id="employer"
                value="{{ old('employer', session('register_data.employer')) }}"
                class="w-full px-4 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-barangay-main focus:border-barangay-main transition-colors">
        </div>
    </div>

    <!-- Educational Attainment -->
    <div class="space-y-2">
        <label class="block text-sm font-medium text-gray-700" for="educational_attainment">
            <span class="flex items-center gap-2">
                <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 14l9-5-9-5-9 5 9 5z" />
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 14l9-5-9-5-9 5 9 5zm0 0L3 9m0 0v11m0-11l9 5" />
                </svg>
                Educational Attainment
            </span>
        </label>
        <input
            type="text"
            name="educational_attainment"
            id="educational_attainment"
            value="{{ old('educational_attainment', session('register_data.educational_attainment')) }}"
            class="w-full px-4 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-barangay-main focus:border-barangay-main transition-colors">
    </div>

    <!-- Health Conditions -->
    <div class="space-y-2">
        <label class="block text-sm font-medium text-gray-700" for="health_conditions">
            <span class="flex items-center gap-2">
                <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4.318 6.318a4.5 4.5 0 000 6.364L12 20.364l7.682-7.682a4.5 4.5 0 00-6.364-6.364L12 7.636l-1.318-1.318a4.5 4.5 0 00-6.364 0z" />
                </svg>
                Health Conditions or Disabilities (If Applicable)
            </span>
        </label>
        <input
            type="text"
            name="health_conditions"
            id="health_conditions"
            class="w-full px-4 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-barangay-main focus:border-barangay-main transition-colors"
            placeholder="Optional">
    </div>
</div>