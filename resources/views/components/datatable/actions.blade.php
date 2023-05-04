@props([
    'actions' => [],
])

<div class="flex gap-0.5 flex-wrap items-center fill-white min-w-[180px]">
    @foreach($actions as $action => $details)
        @php
            $url = $details;
            $icon = $details['icon'] ?? null;
            $type = $details['type'] ?? null;
            $title = $details['title'] ?? null;

            if (is_array($details)) {
                $url = $details['url'];
            }
        @endphp

        @if($action === 'edit')
            <a class="inline-flex justify-center items-center focus:outline-none text-white bg-yellow-400 hover:bg-yellow-500 focus:ring-4 focus:ring-yellow-300 font-medium rounded-lg text-sm px-3 py-1.5 dark:focus:ring-yellow-900"
               data-tooltip-target="tooltip-edit"
               href="{{ $url }}"
            >
                <box-icon
                    name='edit'>
                </box-icon>
            </a>
        @elseif($action === 'delete')
            <form class="delete-action inline-block" method="POST" action="{{ $url }}">
                @csrf
                @method('DELETE')

                <button
                    class="inline-flex justify-center items-center focus:outline-none text-white bg-red-700 hover:bg-red-800 focus:ring-4 focus:ring-red-300 font-medium rounded-lg text-sm px-3 py-1.5 dark:bg-red-600 dark:hover:bg-red-700 dark:focus:ring-red-900"
                    data-tooltip-target="tooltip-delete"
                    type="submit"
                >
                    <box-icon name='trash'></box-icon>
                </button>
            </form>
        @else
            <a class="inline-flex focus:outline-none text-white bg-purple-700 hover:bg-purple-800 focus:ring-4 focus:ring-purple-300 font-medium rounded-lg text-sm px-3 py-1.5 dark:bg-purple-600 dark:hover:bg-purple-700 dark:focus:ring-purple-900"
               data-tooltip-target="tooltip-services"
               href="{{ $url }}"

            >
                @if($icon)
                    <box-icon name='{{ $icon }}'></box-icon>
                @endif

                @if($title)
                    {{ $title }}
                @endif
            </a>
        @endif
    @endforeach

</div>
