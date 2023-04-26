@props([
    'disabled' => false,
    'name' => null,
])

@php
    if ($attributes->has('old') && old($attributes->get('old'))) {
        $slot = old($attributes->get('old'));
    }
@endphp

<textarea {{ $disabled ? 'disabled' : '' }} {!! $attributes->merge(['class' => 'border-gray-300 focus:border-indigo-500 focus:ring-indigo-500 rounded-md shadow-sm']) !!}
>{{ $slot }}</textarea>
