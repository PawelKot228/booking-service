@unless ($breadcrumbs->isEmpty())
    <nav
        class="max-w-7xl mx-auto sm:px-6 lg:px-8"
        aria-label="{{ __('Breadcrumb') }}"
    >
        <div
            class="flex px-5 py-3 my-2 text-gray-700 border border-gray-200 rounded-lg bg-white dark:bg-white dark:border-gray-700">

            <ol class="inline-flex items-center space-x-1">
                @foreach ($breadcrumbs as $breadcrumb)
                    <li class="inline-flex items-center justify-center">
                        @if(!$loop->first)
                            <svg aria-hidden="true" class="w-6 h-6 text-gray-400 mx-0.5" fill="currentColor" viewBox="0 0 20 20" xmlns="http://www.w3.org/2000/svg"><path fill-rule="evenodd" d="M7.293 14.707a1 1 0 010-1.414L10.586 10 7.293 6.707a1 1 0 011.414-1.414l4 4a1 1 0 010 1.414l-4 4a1 1 0 01-1.414 0z" clip-rule="evenodd"></path></svg>
                        @endif

                        @if($loop->last)
                            <span class="inline-flex leading-none items-center text-sm font-medium text-gray-700">
                                @if($loop->first)
                                    <svg aria-hidden="true" class="w-4 h-4 mr-1" fill="currentColor" viewBox="0 0 20 20" xmlns="http://www.w3.org/2000/svg"><path d="M10.707 2.293a1 1 0 00-1.414 0l-7 7a1 1 0 001.414 1.414L4 10.414V17a1 1 0 001 1h2a1 1 0 001-1v-2a1 1 0 011-1h2a1 1 0 011 1v2a1 1 0 001 1h2a1 1 0 001-1v-6.586l.293.293a1 1 0 001.414-1.414l-7-7z"></path></svg>
                                @endif

                                {{ $breadcrumb->title }}
                            </span>
                        @else
                            <a href="{{ $breadcrumb->url }}"
                               class="inline-flex leading-none items-center text-sm font-medium text-gray-700 hover:text-blue-600 dark:text-gray-400 dark:hover:text-white"
                            >
                                @if($loop->first)
                                    <svg aria-hidden="true" class="w-4 h-4 mr-1" fill="currentColor" viewBox="0 0 20 20" xmlns="http://www.w3.org/2000/svg"><path d="M10.707 2.293a1 1 0 00-1.414 0l-7 7a1 1 0 001.414 1.414L4 10.414V17a1 1 0 001 1h2a1 1 0 001-1v-2a1 1 0 011-1h2a1 1 0 011 1v2a1 1 0 001 1h2a1 1 0 001-1v-6.586l.293.293a1 1 0 001.414-1.414l-7-7z"></path></svg>
                                @endif

                                {{ $breadcrumb->title }}
                            </a>
                        @endif

                    </li>
                @endforeach
            </ol>
        </div>

    </nav>
@endunless



