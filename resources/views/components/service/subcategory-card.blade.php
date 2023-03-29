

<div class="hero"
     style="background-image: url('https://media.istockphoto.com/id/1340519810/photo/angler-silhouette.jpg?b=1&s=170667a&w=0&k=20&c=tHI5igVbhfifVX6WGv9bdcV-C-cPgxrYNBykX54qb14=');"
>
    <div class="hero-overlay bg-opacity-60"></div>
    <div class="hero-content text-center text-neutral-content rounded-l">
        <div class="max-w-md">
            <h1 class="mb-5 text-3xl font-bold">{{ __($subcategory->value) }}</h1>
            <div>
                <a class="btn btn-primary glass mb-2"
                   href="{{ route('services.search', ['subcategoryName' => $subcategory->value]) }}"
                >
                    {{ __('Show services') }}
                </a>
            </div>

        </div>
    </div>
</div>