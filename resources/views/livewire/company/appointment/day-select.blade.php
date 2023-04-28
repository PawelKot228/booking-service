<x-select id="day" name="day" required
          wire:change="selectedDay" wire:model="day"
>
    <option value="" class="hidden"></option>
        @foreach($days as $day)
            <option value="{{ $day }}">
                {{ $day }}
            </option>
        @endforeach
</x-select>
