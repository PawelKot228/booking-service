<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Services') }}
        </h2>
    </x-slot>

    <x-page-body>
        <div class="flex flex-wrap justify-center">
            @foreach(\App\Enums\ServiceCategory::cases() as $category)
                <div class="w-1 md:w-1/2 xl:w-1/3 px-5 py-2">
                    <x-service.category-card :category="$category"/>
                </div>
            @endforeach
        </div>
    </x-page-body>
</x-app-layout>
