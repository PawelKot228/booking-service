@props(['value'])

<label {{ $attributes->merge(['class' => 'block font-medium text-sm lg:text-sm/[16px] text-gray-700']) }}>
    {{ $value ?? $slot }}
</label>
