<x-select id="employee_id" name="employee_id" required
    wire:model="appointmentEmployeeId"
          disabled="{{ $disabled }}"
>
    <option value="" class="hidden"></option>
    @foreach($employees as $employee)
        <option value="{{ $employee->id }}"
            wire:key="{{ $employee->id }}"
        >
            {{ $employee->name }}
        </option>
    @endforeach
</x-select>
