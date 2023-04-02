<div class="bg-center bg-no-repeat bg-gray-500 bg-blend-multiply bg-fit"
         style="background-image: url('{{ asset("content/services/$category->value.jpg") }}');"
>
    <div class="px-4 mx-auto max-w-screen-xl text-center py-12">
        <h1 class="mb-4 text-2xl font-extrabold tracking-tight leading-none text-white md:text-3xl">
            {{ __($category->value) }}
        </h1>

        <div class="flex flex-col space-y-4 sm:flex-row sm:justify-center sm:space-y-0 sm:space-x-4">
            <x-button-link :href="route('services.search', ['categoryName' => $category->value])">
                {{ __('Show services') }}
            </x-button-link>
        </div>
    </div>
</div>