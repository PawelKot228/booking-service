@props(['disabled' => false])

@php
    $classes = 'border-gray-300 focus:border-indigo-500 focus:ring-indigo-500';

    if($attributes->get('name') && $errors->get($attributes->get('name'))) {
        $classes = 'bg-red-50 border border-red-500 text-red-900 placeholder-red-700 focus:ring-red-500 dark:bg-gray-700 focus:border-red-500 dark:text-red-500 dark:placeholder-red-500 dark:border-red-500';
    }
@endphp

<input {{ $disabled ? 'disabled' : '' }} {!! $attributes->merge(['class' => "$classes rounded-md shadow-sm"]) !!}>
