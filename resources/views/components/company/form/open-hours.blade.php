@props(['company' => null])

<div>
    <h3 class="text-xl font-semibold">{{ __('Open Hours') }}</h3>
    @foreach(\App\Enums\Day::cases() as $day)
        @php
            $openHour = old("open_hours.$day->value.open") ?? $company?->open_hours[$day->value]['open'] ?? "";
            $closeHour = old("open_hours.$day->value.close") ?? $company?->open_hours[$day->value]['close'] ?? '';
        @endphp

        <h6 class="text-sm font-semibold">{{ __($day->value) }}</h6>
        <div class="flex flex-wrap">
            <div class="w-1/2">

                <div class="p-2">
                    <x-label for="open_hours_{{ $day->value }}_open" value="{{ __('Open') }}"/>
                    <x-input id="open_hours_{{ $day->value }}_open"
                             name="open_hours[{{ $day->value }}][open]"
                             type="time" class="mt-1 block w-full"
                             value='{{ $openHour }}'
                    />
                    <x-input-error for="open_hours.{{ $day->value }}.open" class="mt-2"/>
                </div>
            </div>
            <div class="w-1/2">
                <div class="p-2">
                    <x-label for="open_hours_{{ $day->value }}_close" value="{{ __('Close') }}"/>
                    <x-input id="open_hours_{{ $day->value }}_close"
                             name="open_hours[{{ $day->value }}][close]"
                             type="time" class="mt-1 block w-full"
                             value='{{ $closeHour }}'
                    />
                    <x-input-error for="open_hours.{{ $day->value }}.close" class="mt-2"/>
                </div>
            </div>
        </div>
    @endforeach
</div>
