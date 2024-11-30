@extends('layouts.admin')

@section('content')
<div class="p-10 flex gap-2">
    <div class="border border-black rounded p-2 flex flex-col gap-1">
        <div class="flex justify-between items-center">
            <span>List of Officials</span>
            <button class="bg-barangay-main text-white py-2 px-3 rounded">Add</button>
        </div>
        <div class="flex flex-col border border-black rounded p-1">
            <ul>
                <li>
                    <div>
                        <span>Official 1</span>
                        <span>Name: Tan, Miguel Andrei</span>
                        <span>Position: Barangay Captain</span>
                    </div>
                </li>
                <li>
                    <div>
                        <span>Official 2</span>
                        <span>Name: Tan, Miguel Andrei</span>
                        <span>Position: Barangay Captain</span>
                    </div>
                </li>
            </ul>
        </div>
    </div>
    <div class="flex flex-col border border-black rounded p-2">
        <span>Archives</span>
        <div class="">
            <ul></ul>
        </div>
    </div>
</div>
@endsection