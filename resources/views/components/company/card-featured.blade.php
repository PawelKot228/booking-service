<div class="flex items-center justify-center text-center py-4 md:py-6">
    <div>
        <div class="relative inline-flex items-center justify-center w-24 h-24 overflow-hidden bg-gray-100 rounded-full dark:bg-gray-600">
            <img class="w-full rounded-lg"
                 src="{{ $company?->cover?->url ?? asset('content/no_image.jpg') }}"
                 alt="cover image"
            >
        </div>

        <a href="{{ route('companies.show', [$company]) }}">
            <h5 class="text-2xl font-bold tracking-tight text-gray-900 dark:text-white">
                {{ $company->name }}
            </h5>
        </a>

        <div class="flex items-center justify-center mt-2">
            <svg aria-hidden="true" class="w-5 h-5 text-yellow-400" fill="currentColor" viewBox="0 0 20 20" xmlns="http://www.w3.org/2000/svg">
                <title>{{ __('Rating star') }}</title>
                <path d="M9.049 2.927c.3-.921 1.603-.921 1.902 0l1.07 3.292a1 1 0 00.95.69h3.462c.969 0 1.371 1.24.588 1.81l-2.8 2.034a1 1 0 00-.364 1.118l1.07 3.292c.3.921-.755 1.688-1.54 1.118l-2.8-2.034a1 1 0 00-1.175 0l-2.8 2.034c-.784.57-1.838-.197-1.539-1.118l1.07-3.292a1 1 0 00-.364-1.118L2.98 8.72c-.783-.57-.38-1.81.588-1.81h3.461a1 1 0 00.951-.69l1.07-3.292z"></path>
            </svg>
            <p class="text-sm font-bold text-gray-900 dark:text-white">
                {{ rtrim(round($company->reviews_avg_rating ?? 0, 2), '0.') }}
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
    </div>
</div>
