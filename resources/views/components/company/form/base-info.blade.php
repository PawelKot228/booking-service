@props(['company' => null])

<div class="p-2">
    <x-label for="name" value="{{ __('Name') }}"/>
    <x-input id="name" name="name" type="text" class="mt-1 block w-full"
             value="{{ old('name') ?? $company?->name }}"
             autofocus
    />
    <x-input-error for="name" class="mt-2"/>
</div>
<div class="p-2">
    <x-label for="description" value="{{ __('Description') }}"/>
    <x-textarea id="description" name="description" type="text" class="mt-1 block w-full"

    >
        {{ old('description') ?? $company?->description }}
    </x-textarea>
    <x-input-error for="description" class="mt-2"/>
</div>
