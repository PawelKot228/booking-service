<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ $company->name }}
        </h2>
    </x-slot>

    <x-page-body>
        <section class="bg-white dark:bg-gray-900">
            <div class="items-center py-8 px-4 mx-auto max-w-screen-xl md:grid md:grid-cols-2 md:py-16 md:px-6">
                <div class="font-light text-gray-500 sm:text-lg dark:text-gray-400">
                    <h2 class="mb-4 text-4xl tracking-tight font-extrabold text-gray-900 dark:text-white">
                        {{ $company->name }}
                    </h2>
                    <p class="mb-4">
                        {{ $company->description }}
                    </p>
                </div>
                <div class="grid grid-cols-2 gap-4 mt-8">
                        @foreach($company->covers->take(2) as $cover)
                            <img class="w-full rounded-lg min-h-[20rem] object-cover {{ $loop->even ? 'mt-4 lg:mt-10' : '' }}"
                                 src="{{ $cover->url }}"
                                 alt="cover image"
                            >
                        @endforeach

                </div>
            </div>
        </section>

        <x-company.categories-section :company="$company">
            {{ __('Services') }}
        </x-company.categories-section>

        <x-company.comments-section :company="$company">
            {{ __('Comments') }}
        </x-company.comments-section>
    </x-page-body>


    @push('modals')
        <x-appointment.create-modal :company="$company">
            {{ __('Make an appointment') }}
        </x-appointment.create-modal>
    @endpush

</x-app-layout>
