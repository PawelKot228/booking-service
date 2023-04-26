@props([
    'actions' => [],
])

<div class="space-y-0.5">
    @foreach($actions as $action => $url)
        @if($action === 'edit')
            <a class="inline-block focus:outline-none text-white bg-yellow-400 hover:bg-yellow-500 focus:ring-4 focus:ring-yellow-300 font-medium rounded-lg text-sm px-3 py-1.5 dark:focus:ring-yellow-900"
               href="{{ $url }}"
            >
                {{ __('Edit') }}
            </a>
        @elseif($action === 'delete')
            <form class="delete-action inline-block" method="POST" action="{{ $url }}">
                @csrf
                @method('DELETE')

                <button class="inline-block focus:outline-none text-white bg-red-700 hover:bg-red-800 focus:ring-4 focus:ring-red-300 font-medium rounded-lg text-sm px-3 py-1.5 dark:bg-red-600 dark:hover:bg-red-700 dark:focus:ring-red-900"
                        type="submit"
                >
                    {{ __('Delete') }}
                </button>
            </form>
        @else
            <a class="inline-block focus:outline-none text-white bg-purple-700 hover:bg-purple-800 focus:ring-4 focus:ring-purple-300 font-medium rounded-lg text-sm px-3 py-1.5 dark:bg-purple-600 dark:hover:bg-purple-700 dark:focus:ring-purple-900"
               href="{{ $url }}"
            >
                {{ (string)str(__($action))->title() }}
            </a>
        @endif
    @endforeach

</div>
