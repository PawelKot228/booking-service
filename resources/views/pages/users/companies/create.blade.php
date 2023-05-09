<x-app-layout>
    {{--    @dump($errors)--}}
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Create company') }}
        </h2>
    </x-slot>

    <x-page-body>
        <form action="{{ route('users.companies.store') }}" method="POST">
            @csrf
            <x-leading-text-header>
                {{ __('Create company') }}

                <x-slot:buttons>
                    <x-button>
                        {{ __('Create') }}
                    </x-button>
                </x-slot:buttons>
            </x-leading-text-header>


            <div class="flex flex-wrap">
                <div class="w-full md:w-1/2 lg:w-1/3 xl:w-1/2  space-y-4">
                    <x-company.form.base-info/>

                    <x-company.form.open-hours/>
                </div>
                <div class="w-full md:w-1/2 lg:w-2/3 xl:w-1/2">
                    <x-company.form.location/>
                </div>
            </div>

        </form>
    </x-page-body>

</x-app-layout>
