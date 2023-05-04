<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Dashboard') }} - {{ $company->name }}
        </h2>
    </x-slot>

    {{ Breadcrumbs::renderCompany($company) }}

    <x-page-body>

        <h2 class="font-semibold text-xl md:text-2xl text-gray-800 leading-tight">
            {{ __('Welcome to our dashboard!') }}
        </h2>

        <p class="mt-2 text-gray-500 text-sm md:text-xl leading-relaxed">
            {{ __('Stay on top of everything with easy access to our team, appointments, and product categories. Manage your business efficiently and effortlessly. Let\'s get started!') }}
        </p>


        <div class="grid grid-cols-1 md:grid-cols-2 gap-6 lg:gap-8 py-5 md:py-10">


            <x-company.widget-card href="{{ route('users.companies.employees.index', [$company]) }}">
                <x-slot name="icon">
                    <box-icon name='carousel' class="fill-red-500"></box-icon>
                </x-slot>

                <x-slot name="header">
                    {{ __('Meet your team') }}
                </x-slot>


                {{ __('Get a quick overview of our team. Click here to access a simple table displaying our employees and their roles. Discover who\'s who in our company with ease.') }}
            </x-company.widget-card>

            <x-company.widget-card href="{{ route('users.companies.appointments.index', [$company]) }}">
                <x-slot name="icon">
                    <box-icon name='calendar-event' class="fill-red-500"></box-icon>
                </x-slot>

                <x-slot name="header">
                    {{ __('Appointment list') }}
                </x-slot>

                {{ __('Stay organized with our appointment widget. Click to view a simple table of upcoming appointments and their details. Never miss a meeting again.') }}

            </x-company.widget-card>

            <x-company.widget-card href="{{ route('users.companies.categories.index', [$company]) }}">
                <x-slot name="icon">
                    <box-icon name='category' class="fill-red-500"></box-icon>
                </x-slot>

                <x-slot name="header">
                    {{ __('Categories') }}
                </x-slot>

                {{ __('Effortlessly browse through our products/services with our categories widget. Click to access a simple list of categories and quickly find what you\'re looking for. Simplify your search today.') }}

            </x-company.widget-card>

        </div>


    </x-page-body>

</x-app-layout>
