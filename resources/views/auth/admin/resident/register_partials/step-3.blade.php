<div class="flex flex-col items-center gap-9">
    <div class="flex gap-5">
        <div class="flex flex-col gap-1">
            <label class="font-semibold font-inter" for="">Occupation</label>
            <input class="bg-[#F5F5F5] border-black border-b p-2 font-inter w-[323px] focus:outline-none focus:bg-[#F5F5F5]" type="text" name="occupation" value="{{ old('occupation', session('register_data.occupation')) }}">
        </div>
        <div class="flex flex-col gap-1">
            <label class="font-semibold font-inter" for="">Employer</label>
            <input class="bg-[#F5F5F5] border-black border-b p-2 font-inter w-[323px] focus:outline-none focus:bg-[#F5F5F5]" type="text" name="employer" value="{{ old('employer', session('register_data.employer')) }}">
        </div>
    </div>
    <div class="flex flex-col gap-1 w-full">
        <label class="font-semibold font-inter" for="">Educational Attainment</label>
        <input class="bg-[#F5F5F5] border-black border-b p-2 font-inter focus:outline-none focus:bg-[#F5F5F5] w-full" type="text" name="educational_attainment" value="{{ old('educational_attainment', session('register_data.educational_attainment')) }}">
    </div>
    <div class="flex flex-col gap-1 w-full">
        <label class="font-semibold font-inter" for="">Health Conditions or Disabilities (If Applicable)</label>
        <input class="bg-[#F5F5F5] border-black border-b p-2 font-inter focus:outline-none focus:bg-[#F5F5F5] w-full" type="text">
    </div>
</div>