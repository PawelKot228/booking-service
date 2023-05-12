<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Create company') }}
        </h2>
    </x-slot>

    <x-page-body>
        <x-leading-text-header>
            {{ __('Write a review') }}

            <x-slot:buttons>
                <form class="inline-block" method="POST" action="{{ route('users.appointments.reviews.destroy', [$appointment->id, $review->id]) }}">
                    @csrf
                    @method('DELETE')

                    <x-danger-button>
                        {{ __('Delete') }}
                    </x-danger-button>
                </form>

                <x-button onclick="document.getElementById('review-form').submit()">
                    {{ __('Save') }}
                </x-button>
            </x-slot:buttons>
        </x-leading-text-header>


        <x-review.form :review="$review"
                       url="{{ route('users.appointments.reviews.update', [$appointment->id, $review->id]) }}"
        >
            <x-slot:method>
                @method('PUT')
            </x-slot:method>
        </x-review.form>
    </x-page-body>

</x-app-layout>
