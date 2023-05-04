<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ $company->name }}
        </h2>
    </x-slot>

    {{ Breadcrumbs::renderCompany($appointment, $company) }}

    <x-page-body>
        <x-leading-text-header class="text-2xl">
            {{ __('Appointment') }} #{{$appointment->id}}
        </x-leading-text-header>


        <div class="flex my-4">
            <div class="md:w-1/3">
                <h4 class="text-xl font-semibold">
                    {{ __('Employee') }}
                </h4>

                <div class="flex">
                    <div class="w-1/2">
                        {{ __('Name') }}
                    </div>
                    <div class="w-1/2">
                        {{ $appointment->customer->name }}
                    </div>
                </div>
                <hr class="w-[60%] h-px mr-auto my-0.5 bg-gray-400 border-0 rounded dark:bg-gray-700">


            </div>
            <div class="md:w-1/2">
                <h4 class="text-xl font-semibold">
                    {{ __('Customer') }}
                </h4>
            </div>
        </div>


        @dump($appointment)
    </x-page-body>
</x-app-layout>
