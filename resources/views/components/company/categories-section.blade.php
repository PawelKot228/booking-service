<section class="p-4 md:px-8 md:py-12">
    <h2 class="text-xl md:text-2xl lg:text-3xl font-bold mb-2">{{ $slot }}</h2>

    <div class="-mx-4 flex flex-wrap">
        @foreach($company->categories as $category)
            <x-company.card-category :category="$category">
                {{ $category->name }}
            </x-company.card-category>
        @endforeach
    </div>
</section>