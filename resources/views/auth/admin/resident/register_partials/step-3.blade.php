<div class="space-y-6">
    <!-- Occupation & Employer Row -->
    <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
        <!-- Occupation -->
        <div class="space-y-2">
            <label class="block text-sm font-medium text-gray-700" for="occupation">
                <span class="flex items-center gap-2">
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