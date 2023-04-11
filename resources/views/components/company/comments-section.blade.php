<div class="antialiased mx-auto max-w-screen-md py-4 md:py-12">
    <h3 class="mb-4 px-2 text-lg font-semibold text-gray-900">
        {{ $slot->isEmpty() ? __('Comments') : $slot }}
    </h3>

    <div id="commentsList"

         x-cloak
         x-data="commentsList()"
    >
        <h1 x-show="isLoading">{{ __('Lading...') }}</h1>

        <div class="space-y-4 px-4"
             x-show="!isLoading"
        >
            <template x-for="review in reviews">
                <div class="flex flex-col sm:flex-row">
                    <div class="flex-shrink-0 flex justify-center items-center py-4 gap-1 sm:mr-3 sm:flex-col">
                        <img class="md:mt-2 rounded-full w-12 h-12 sm:w-16 sm:h-16"
                             x-bind:src="review.user.profile_photo_url"
                             x-bind:alt="review.user.name"
                        >

                        <div class="flex items-center justify-center">
                            <template x-for="i in 5">
                                <svg aria-hidden="true" class="w-6 h-6 sm:w-3 md:h-3" fill="currentColor"
                                     viewBox="0 0 20 20" xmlns="http://www.w3.org/2000/svg"
                                     :class="i <= review.rating ? 'text-yellow-400' : 'text-gray-300'"
                                >
                                    <title>First star</title>
                                    <path d="M9.049 2.927c.3-.921 1.603-.921 1.902 0l1.07 3.292a1 1 0 00.95.69h3.462c.969 0 1.371 1.24.588 1.81l-2.8 2.034a1 1 0 00-.364 1.118l1.07 3.292c.3.921-.755 1.688-1.54 1.118l-2.8-2.034a1 1 0 00-1.175 0l-2.8 2.034c-.784.57-1.838-.197-1.539-1.118l1.07-3.292a1 1 0 00-.364-1.118L2.98 8.72c-.783-.57-.38-1.81.588-1.81h3.461a1 1 0 00.951-.69l1.07-3.292z"></path>
                                </svg>
                            </template>
                        </div>
                    </div>
                    <div class="flex-1 border rounded-lg px-4 py-2 sm:px-6 sm:py-4 leading-relaxed">
                        <strong x-text="review.title"></strong>
                        <span class="text-xs text-gray-400" x-text="review.created_at"></span>
                        <p class="text-sm" x-text="review.text"></p>
                    </div>
                </div>
            </template>
        </div>

    </div>
    @push('js')
        <script>
            function commentsList() {
                return {
                    isLoading: true,
                    reviews: [],
                    fetchComments() {
                        this.isLoading = true;
                        const url = new URL("{{ route('companies.reviews.index', ['company' => $company->id]) }}");

                        fetch(url.toString())
                            .then(res => res.json())
                            .then(data => {
                                this.reviews = data.data
                                this.isLoading = false;
                            })
                    },
                    init() {
                        this.fetchComments()
                    },
                }
            }
        </script>
    @endpush
</div>

