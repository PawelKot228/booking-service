<div class="antialiased mx-auto max-w-screen-md py-4 md:py-12">
    <h3 class="mb-4 px-2 text-lg font-semibold text-gray-900">
        {{ __('Comments') }}
    </h3>

    <div id="commentsList">
{{--        @if($isLoading)--}}
{{--            <h1>{{ __('Lading...') }}</h1>--}}
{{--        @endif--}}



        <div class="space-y-4 px-4">
            @foreach($reviews as $review)
                <div class="flex flex-col sm:flex-row">
                    <div class="flex-shrink-0 flex justify-center items-center py-4 gap-1 sm:mr-3 sm:flex-col">
                        <img class="md:mt-2 rounded-full w-12 h-12 sm:w-16 sm:h-16"
                             src="{{ $review->user->profile_photo_url }}"
                             alt="{{ $review->user->name }}"
                        >

                        <div class="flex items-center justify-center">
{{--                            <template x-for="i in 5">--}}
{{--                                <svg aria-hidden="true" class="w-6 h-6 sm:w-3 md:h-3" fill="currentColor"--}}
{{--                                     viewBox="0 0 20 20" xmlns="http://www.w3.org/2000/svg"--}}
{{--                                     :class="i <= review.rating ? 'text-yellow-400' : 'text-gray-300'"--}}
{{--                                >--}}
{{--                                    <title>First star</title>--}}
{{--                                    <path d="M9.049 2.927c.3-.921 1.603-.921 1.902 0l1.07 3.292a1 1 0 00.95.69h3.462c.969 0 1.371 1.24.588 1.81l-2.8 2.034a1 1 0 00-.364 1.118l1.07 3.292c.3.921-.755 1.688-1.54 1.118l-2.8-2.034a1 1 0 00-1.175 0l-2.8 2.034c-.784.57-1.838-.197-1.539-1.118l1.07-3.292a1 1 0 00-.364-1.118L2.98 8.72c-.783-.57-.38-1.81.588-1.81h3.461a1 1 0 00.951-.69l1.07-3.292z"></path>--}}
{{--                                </svg>--}}
{{--                            </template>--}}
                        </div>
                    </div>
                    <div class="flex-1 border rounded-lg px-4 py-2 sm:px-6 sm:py-4 leading-relaxed">
                        <strong>{{ $review->title }}</strong>
                        <span class="text-xs text-gray-400">
                            {{ $review->created_at->diffForHumans() }}
                        </span>
                        <p class="text-sm">
                            {{ $review->text }}
                        </p>
                    </div>
                </div>
            @endforeach

            {{ $reviews->links() }}
        </div>

    </div>
