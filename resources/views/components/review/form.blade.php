@props([
    'review' => null,
    'url' => null,
])

<form id="review-form" method="POST"
      action="{{ $url }}"
>
    @csrf
    @if(isset($method))
        {{ $method }}
    @endif

    <div class="p-2">
        <x-label for="title" value="{{ __('Title') }}"/>
        <x-input id="title" name="title" type="text" class="mt-1 block w-full"
                 value="{{ old('title') ?? $review?->title }}"
                 autofocus
        />
        <x-input-error for="title" class="mt-2"/>
    </div>
    <div class="p-2">
        <x-label for="text" value="{{ __('Description') }}"/>
        <x-textarea id="text" name="text" type="text" class="mt-1 block w-full"

        >
            {{ old('text') ?? $review?->text }}
        </x-textarea>
        <x-input-error for="text" class="mt-2"/>
    </div>

    <div class="p-2">
        <x-label for="rating" value="{{ __('Rating') }}"/>
        <x-rating-input :rating="$review?->rating ?? 0" input-id="rating">
            <x-input id="rating" type="number" class="hidden" name="rating"
                     value="{{ old('rating') ?? $review?->rating }}"
            />
        </x-rating-input>
        <x-input-error for="rating" class="mt-2"/>
    </div>
</form>
