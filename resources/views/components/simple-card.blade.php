<div class="block rounded-lg bg-white border border-gray-300 shadow-[0_2px_15px_-3px_rgba(0,0,0,0.07),0_10px_20px_-2px_rgba(0,0,0,0.04)] dark:bg-neutral-700">
    @if(isset($header))
        <div class="flex justify-between border-b-2 border-gray-300 px-6 py-3 dark:border-neutral-600 dark:text-neutral-50">
            <div>
                {{ $header }}
            </div>
            @if(isset($buttons))
                <div>
                    {{ $buttons }}
                </div>
            @endif
        </div>
    @endif
    <div class="p-6">
        {{ $slot }}
    </div>
</div>
