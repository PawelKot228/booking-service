

<div class="hero"
     style="background-image: url('{{ asset("content/services/$category->value.jpg") }}');"
>
    <div class="hero-overlay bg-opacity-60"></div>
    <div class="hero-content text-center text-neutral-content rounded-l min-h-16 h-80">
        <div class="max-w-md">
            <h1 class="mb-5 text-3xl font-bold">{{ __($category->value) }}</h1>
            <div>
                <a class="btn btn-primary glass mb-2"
                   href="{{ route('services.search', ['categoryName' => $category->value]) }}"
                >
                    {{ __('Show services') }}
                </a>
            </div>

            <div>
                <a class="btn btn-primary glass"
                   href="{{ route('services.category', ['categoryName' => $category->value]) }}"
                >
                    {{ __('Select subcategory') }}
                </a>
            </div>

        </div>
    </div>
</div>
