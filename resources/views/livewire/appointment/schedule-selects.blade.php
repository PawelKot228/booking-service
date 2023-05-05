<div>
    <div class="p-2">
        <x-label for="service_id" value="{{ __('Service') }}"/>
        <x-select id="service_id" name="service_id" required wire:model="serviceId">
            <option value="" class="hidden"></option>
            @foreach($categories as $category)
                <optgroup label="{{ $category->name }}">
                    @foreach($category->services as $service)
                        <option value="{{ $service->id }}"
                                wire:key="{{ $service->id }}"
                        >
                            {{ $service->name }} [{{ $service->price.$service->currency }}]
                            {{ $service->duration }} {{ __('minutes') }}
                        </option>
                    @endforeach
                </optgroup>
            @endforeach
        </x-select>
        <x-input-error for="service_id" class="mt-2"/>
    </div>
    <div class="p-2">
        <x-label for="day" value="{{ __('Day') }}"/>
        <x-select id="day" name="day" required wire:model="day">
            <option value="" class="hidden"></option>
            @foreach($days as $day)
                <option value="{{ $day }}">
                    {{ $day }}
                </option>
            @endforeach
        </x-select>
        <x-input-error for="day" class="mt-2"/>
    </div>
    <div class="p-2">
        <x-label for="hour" value="{{ __('Hour') }}"/>
        <x-select id="hour" name="hour" required wire:model="hour">
            <option value="" class="hidden"></option>
            @foreach($hours as $hour)
                <option value="{{ $hour['time'] }}" {{ $hour['available'] ? '' : 'disabled' }}>
                    {{ $hour['time'] }}
                </option>
            @endforeach
        </x-select>
        <x-input-error for="hour" class="mt-2"/>
    </div>

</div>
