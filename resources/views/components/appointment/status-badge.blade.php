@props(['status' => null])

@if(\App\Enums\AppointmentStatus::CANCELLED->value === $status)
    <span class="bg-red-100 text-red-800 border-red-300 border-2 rounded-md text-xs font-medium mr-2 px-2.5 py-0.5 dark:bg-red-900 dark:border-green-500 dark:text-red-300">
        {{ __('Cancelled') }}
    </span>
@elseif(\App\Enums\AppointmentStatus::REJECTED->value === $status)
    <span class="bg-red-100 text-red-800 border-red-300 border-2 rounded-md text-xs font-medium mr-2 px-2.5 py-0.5 dark:bg-red-900 dark:border-green-500 dark:text-red-300">
        {{ __('Rejected') }}
    </span>
@elseif(\App\Enums\AppointmentStatus::PENDING->value === $status)
    <span class="bg-blue-100 text-blue-800 border-blue-300 border-2 rounded-md text-xs font-medium mr-2 px-2.5 py-0.5 dark:bg-blue-900 dark:border-blue-500 dark:text-blue-300">
        {{ __('Pending') }}
    </span>
@elseif(\App\Enums\AppointmentStatus::ACCEPTED->value === $status)
    <span class="bg-green-100 text-green-800 border-green-300 border-2 rounded-md text-xs font-medium mr-2 px-2.5 py-0.5 dark:bg-green-900 dark:border-green-500 dark:text-green-300">
        {{ __('Accepted') }}
    </span>
@elseif(\App\Enums\AppointmentStatus::FINISHED->value === $status)
    <span class="bg-teal-100 text-green-800 border-green-300 border-2 rounded-md text-xs font-medium mr-2 px-2.5 py-0.5 dark:bg-green-900 dark:border-green-500 dark:text-green-300">
        {{ __('Finished') }}
    </span>
@else
    <span class="bg-pink-100 text-pink-800 border-pink-300 border-2 rounded-md text-xs font-medium mr-2 px-2.5 py-0.5 dark:bg-pink-900 dark:border-pink-500 dark:text-pink-300">
        {{ __('Unknown') }}
    </span>
@endif
