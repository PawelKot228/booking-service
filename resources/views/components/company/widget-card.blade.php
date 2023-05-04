@props(['url' => '#'])

<a {!! $attributes->merge(['class' => 'scale-100 p-6 bg-white from-gray-700/50 via-transparent rounded-lg shadow-2xl shadow-gray-500/20 flex motion-safe:hover:scale-[1.01] transition-all duration-250 focus:outline focus:outline-2 focus:outline-red-500 border border-red-100']) !!}>
    <div>
        @if (isset($icon))
            <div class="h-16 w-16 bg-red-50 flex items-center justify-center rounded-full">
                {{ $icon }}
            </div>

            <h2 class="mt-6 text-xl font-semibold text-gray-900">

            </h2>
        @endif


        @if (isset($header))
            <h2 class="mt-6 text-xl font-semibold text-gray-900">
                    {{ $header }}
            </h2>
        @endif

        <p class="mt-4 text-gray-500 text-sm leading-relaxed">
            {{ $slot }}
        </p>
    </div>

    <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5"
         class="self-center shrink-0 stroke-red-500 w-6 h-6 mx-6">
        <path stroke-linecap="round" stroke-linejoin="round"
              d="M4.5 12h15m0 0l-6.75-6.75M19.5 12l-6.75 6.75"/>
    </svg>
</a>
