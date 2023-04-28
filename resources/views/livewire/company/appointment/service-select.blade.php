<x-select id="service_id" name="service_id" required
    wire:change="change" wire:model="serviceId"
>
    <option value="" class="hidden">

    </option>
    @foreach($categories as $category)
        <optgroup label="{{ $category->name }}">
            @foreach($category->services as $service)
                <option value="{{ $service->id }}">
                    {{ $service->name }} [{{ $service->price.$service->currency }}] {{ $service->duration }} {{ __('minutes') }}
                </option>
            @endforeach
        </optgroup>
    @endforeach
</x-select>
