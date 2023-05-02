<x-select id="employee_id" name="employee_id" required>
    <option value="" class="hidden"></option>
    @foreach($employees as $employee)
        <option value="{{ $employee->id }}">
            {{ $employee->name }}
        </option>
    @endforeach
</x-select>
