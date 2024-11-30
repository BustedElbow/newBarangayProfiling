@extends('layouts.admin')

@section('content')
<div class="p-10 flex">
    <div class="border border-black rounded">
        <span>List of Officials</span>
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
    <div class="flex flex-col">
        <button class="bg-barangay-main text-white p-2 rounded">Manage</button>
    </div>
</div>
@endsection