@props([
    'disabled' => false,
])

@php
    $classes = 'border-gray-300 text-gray-900 focus:ring-blue-500 focus:border-blue-500';

    if($attributes->get('name') && $errors->has($attributes->get('name'))) {
        $classes = 'bg-red-50 border border-red-500 text-red-900 placeholder-red-700 focus:ring-red-500 dark:bg-gray-700 focus:border-red-500 dark:text-red-500 dark:placeholder-red-500 dark:border-red-500';
    }
@endphp

<select {{ $disabled ? 'disabled' : '' }} {!! $attributes->merge(['class' => "$classes choices-js text-sm rounded-lg  block w-full p-2.5"]) !!}>
    {{ $slot }}
</select>
