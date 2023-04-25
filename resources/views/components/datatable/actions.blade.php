@props([
    'actions' => [],
])

<div class="space-y-0.5">
    @if($actions['edit'] ?? null)
        <a class="inline-block focus:outline-none text-white bg-yellow-400 hover:bg-yellow-500 focus:ring-4 focus:ring-yellow-300 font-medium rounded-lg text-sm px-3 py-1.5 dark:focus:ring-yellow-900"
           href="{{ $actions['edit'] }}"
        >
            {{ __('Edit') }}
        </a>
    @endif

    @if($actions['delete'] ?? null)
        <form class="delete-action" method="POST" action="{{ $actions['delete'] }}">
            @csrf
            @method('DELETE')

            <button class="inline-block focus:outline-none text-white bg-red-700 hover:bg-red-800 focus:ring-4 focus:ring-red-300 font-medium rounded-lg text-sm px-3 py-1.5 dark:bg-red-600 dark:hover:bg-red-700 dark:focus:ring-red-900"
                    type="submit"
            >
                {{ __('Delete') }}
            </button>
        </form>

    @endif

</div>
