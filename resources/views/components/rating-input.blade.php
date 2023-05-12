@props([
    'inputId' => 'rating-input'
])

<div
    x-cloak
    x-data="starRatingInput('{{ $inputId }}')"
>
    <template x-for="starRating in 5" :key="starRating">
        <button class="rounded-sm text-gray-400 fill-current focus:outline-none focus:shadow-outline p-1 w-12 m-0 cursor-pointer"
                type="button"
                aria-hidden="true"

                @click="selectRating(starRating)"
                @mouseover="hoverRating = starRating"
                @mouseleave="hoverRating = rating"
                :class="{
                    'text-gray-600': hoverRating >= starRating,
                    'text-yellow-400': rating >= starRating && hoverRating >= starRating
                }"
        >
            <svg class="w-15 transition duration-150" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20" fill="currentColor">
                <path d="M9.049 2.927c.3-.921 1.603-.921 1.902 0l1.07 3.292a1 1 0 00.95.69h3.462c.969 0 1.371 1.24.588 1.81l-2.8 2.034a1 1 0 00-.364 1.118l1.07 3.292c.3.921-.755 1.688-1.54 1.118l-2.8-2.034a1 1 0 00-1.175 0l-2.8 2.034c-.784.57-1.838-.197-1.539-1.118l1.07-3.292a1 1 0 00-.364-1.118L2.98 8.72c-.783-.57-.38-1.81.588-1.81h3.461a1 1 0 00.951-.69l1.07-3.292z" />
            </svg>
        </button>
    </template>

    {{ $slot }}

</div>

@pushonce('js')
    <script>
        function starRatingInput(inputId) {
            return {
                rating: rating,
                hoverRating: 0,
                ratingsCount: 5,
                inputId: inputId,
                ratingInput: null,
                selectRating(rating) {
                    this.rating = rating
                    this.hoverRating = rating
                    this.ratingInput.value = this.rating;
                },
                init() {
                    this.ratingInput = document.getElementById(inputId);
                    this.selectRating(parseInt(this.ratingInput.value))


                }

            }
        }
    </script>
@endpushonce
