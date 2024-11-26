@props(['value'])

<label {{ $attributes->merge(['class' => 'block font-medium text-sm text-gray-700 font-inter']) }}>
    {{ $value ?? $slot }}
</label>
