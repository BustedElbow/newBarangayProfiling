@extends('layouts.admin')

@section('content')
<div class="p-10">
    <h2 class="text-2xl font-bold mb-6">Households List</h2>

    <div class="overflow-x-auto">
        <table class="min-w-full bg-white">
            <thead>
                <tr class="bg-gray-100">
                    <th class="px-6 py-3 text-left">Household Name</th>
                    <th class="px-6 py-3 text-left">Household Head</th>
                    <th class="px-6 py-3 text-left">Total Members</th>
                </tr>
            </thead>
            <tbody>
                @foreach($households as $household)
                <tr class="border-b">
                    <td class="px-6 py-4">{{ $household->household_name }}</td>
                    <td class="px-6 py-4">
                        @php
                        $head = $household->members->where('is_head', true)->first();
                        @endphp
                        {{ $head ? $head->resident->first_name . ' ' . $head->resident->last_name : 'No Head Assigned' }}
                    </td>
                    <td class="px-6 py-4">{{ $household->members->count() }}</td>
                </tr>
                @endforeach
            </tbody>
        </table>
    </div>
</div>
@endsection