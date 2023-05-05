<button {{ $attributes->merge(['type' => 'submit', 'class' => 'inline-block focus:outline-none text-white bg-yellow-400 hover:bg-yellow-500 focus:ring-4 focus:ring-yellow-300 font-medium rounded-lg text-sm px-5 py-2.5 dark:focus:ring-yellow-900']) }}>
    {{ $slot }}
</a>
