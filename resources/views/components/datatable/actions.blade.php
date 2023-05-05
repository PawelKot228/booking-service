@props([
    'actions' => [],
])

<div class="flex gap-0.5 flex-wrap items-center min-w-[100px]">
    @foreach($actions as $action => $details)
        @php
            $url = $details;
            $icon = $details['icon'] ?? null;
            $type = $details['type'] ?? null;
            $title = $details['title'] ?? null;
            $tooltip = $details['tooltip'] ?? null;

            if (is_array($details)) {
                $url = $details['url'];
            }
        @endphp

        @if($action === 'edit')
            <a class="inline-flex justify-center items-center focus:outline-none text-white bg-yellow-400 hover:bg-yellow-500 focus:ring-4 focus:ring-yellow-300 font-medium rounded-lg text-sm px-3 py-1.5 dark:focus:ring-yellow-900"
               data-tooltip-target="tooltip-edit"
               href="{{ $url }}"
            >
                <box-icon name='edit' class="fill-white" />
            </a>
        @elseif($action === 'show')
            <a class="inline-flex justify-center items-center focus:outline-none text-white bg-blue-400 hover:bg-blue-500 focus:ring-4 focus:ring-blue-300 font-medium rounded-lg text-sm px-3 py-1.5 dark:focus:ring-blue-900"
               data-tooltip-target="tooltip-show"
               href="{{ $url }}"
            >
                <box-icon name='show' class="fill-white" />
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
                    <box-icon name='trash' class="fill-white" />
                </button>
            </form>
        @else
            <a class="inline-flex focus:outline-none text-white bg-purple-700 hover:bg-purple-800 focus:ring-4 focus:ring-purple-300 font-medium rounded-lg text-sm px-3 py-1.5 dark:bg-purple-600 dark:hover:bg-purple-700 dark:focus:ring-purple-900"
               data-tooltip-target="tooltip-{{ $tooltip }}"
               href="{{ $url }}"

            >
                @if($icon)
                    <box-icon name='{{ $icon }}' class="fill-white" />
                @endif

                @if($title)
                    {{ $title }}
                @endif
            </a>
        @endif
    @endforeach

</div>
