@props(['company'])

<div class="flex gap-4 p-6 bg-white border border-gray-200 rounded-lg shadow dark:bg-gray-800 dark:border-gray-700">
    <div class="flex items-center text-center">

        <div>
            <div class="relative inline-flex items-center justify-center w-24 h-24 overflow-hidden bg-gray-100 rounded-full dark:bg-gray-600">
                <img class="w-full rounded-lg"
                     src="{{ $company?->cover?->url ?? asset('content/no_image.jpg') }}"
                     alt="cover image"
                >
            </div>

            <div class="flex items-center justify-center mt-2">
                <svg aria-hidden="true" class="w-5 h-5 text-yellow-400" fill="currentColor" viewBox="0 0 20 20" xmlns="http://www.w3.org/2000/svg">
                    <title>{{ __('Rating star') }}</title>
                    <path d="M9.049 2.927c.3-.921 1.603-.921 1.902 0l1.07 3.292a1 1 0 00.95.69h3.462c.969 0 1.371 1.24.588 1.81l-2.8 2.034a1 1 0 00-.364 1.118l1.07 3.292c.3.921-.755 1.688-1.54 1.118l-2.8-2.034a1 1 0 00-1.175 0l-2.8 2.034c-.784.57-1.838-.197-1.539-1.118l1.07-3.292a1 1 0 00-.364-1.118L2.98 8.72c-.783-.57-.38-1.81.588-1.81h3.461a1 1 0 00.951-.69l1.07-3.292z"></path>
                </svg>
                <p class="text-sm font-bold text-gray-900 dark:text-white">
                    {{ number_format($company->reviews_avg_rating ?? 0, 2) }}
                </p>
            </div>

            <a class="text-sm font-medium text-gray-900 underline hover:no-underline dark:text-white"
                href="{{ route('companies.reviews.index', [$company]) }}"
            >
                <span>
                    {{ $company->reviews_count }}
                </span>
                {{ __('reviews') }}
            </a>

            @if($company->distance)
                <div class="flex align-middle">
                    <box-icon name='car'></box-icon>
                    <span class="font-bold text-lg"> {{ $company->distance }}KM </span>
                </div>
            @endif

        </div>
    </div>

    <div>
        <a href="{{ route('companies.show', [$company]) }}">
            <h5 class="text-2xl font-bold tracking-tight text-gray-900 dark:text-white">
                {{ $company->name }}
            </h5>
        </a>
        <p>
            @foreach($company->categories->pluck('category')->unique() as $category)
                <span class="bg-pink-100 text-pink-800 text-xs font-medium mr-2 px-2.5 py-0.5 rounded dark:bg-pink-900 dark:text-pink-300">
                {{ __($category) }}
                </span>
            @endforeach
        </p>
        <p class="mb-2">
            @foreach($company->categories->pluck('subcategory')->unique() as $subcategory)
                <span class="bg-purple-100 text-purple-800 text-xs font-medium mr-2 px-2.5 py-0.5 rounded dark:bg-purple-900 dark:text-purple-300">
                {{ __($subcategory) }}
                </span>
            @endforeach
        </p>

        <p class="mb-3 font-normal text-gray-700 dark:text-gray-400">
            {{ $company->description }}
        </p>

        <a class="inline-flex items-center px-3 py-2 text-sm font-medium text-center text-white bg-blue-700 rounded-lg hover:bg-blue-800 focus:ring-4 focus:outline-none focus:ring-blue-300 dark:bg-blue-600 dark:hover:bg-blue-700 dark:focus:ring-blue-800"
           href="{{ route('companies.show', [$company]) }}"
        >
            {{ __('Read more') }}
            <svg aria-hidden="true" class="w-4 h-4 ml-2 -mr-1" fill="currentColor" viewBox="0 0 20 20"
                 xmlns="http://www.w3.org/2000/svg">
                <path fill-rule="evenodd"
                      d="M10.293 3.293a1 1 0 011.414 0l6 6a1 1 0 010 1.414l-6 6a1 1 0 01-1.414-1.414L14.586 11H3a1 1 0 110-2h11.586l-4.293-4.293a1 1 0 010-1.414z"
                      clip-rule="evenodd"></path>
            </svg>
        </a>
    </div>

</div>
