<x-select id="hour" name="hour" required wire:model="hour">
    <option value="" class="hidden"></option>
    @foreach($hours as $hour)
        <option value="{{ $hour['time'] }}" {{ $hour['available'] ? '' : 'disabled' }}>
            {{ $hour['time'] }}
        </option>
    @endforeach
</x-select>
