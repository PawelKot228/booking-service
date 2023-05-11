<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Create company') }}
        </h2>
    </x-slot>

    {{ Breadcrumbs::renderCompany($company) }}

    <x-page-body>
        <form action="{{ route('users.companies.update', [$company]) }}" method="POST">
            @csrf
            @method('PUT')

            <x-leading-text-header>
                {{ __('Create company') }}

                <x-slot:buttons>
                    <x-button>
                        {{ __('Save') }}
                    </x-button>
                </x-slot:buttons>
            </x-leading-text-header>


            <div class="flex flex-wrap">
                <div class="w-full md:w-1/2 lg:w-1/3 xl:w-1/2  space-y-4">
                    <x-company.form.base-info :company="$company"/>

                    <x-company.form.open-hours :company="$company"/>
                </div>
                <div class="w-full md:w-1/2 lg:w-2/3 xl:w-1/2">
                    <x-company.form.location :company="$company"/>
                    <div>
                        <x-label class="text-2xl">
                            {{ __('Gallery') }}
                        </x-label>
                        <livewire:file-uploader
                            source-id="{{ $company->id }}"
                            source-type="{{ $company->getTable() }}"
                        />
                    </div>

                </div>
            </div>

        </form>
    </x-page-body>

</x-app-layout>
