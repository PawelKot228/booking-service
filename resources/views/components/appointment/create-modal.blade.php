<div class="fixed top-0 left-0 right-0 z-50 hidden w-full p-4 overflow-x-hidden overflow-y-auto md:inset-0 h-[calc(100%-1rem)] max-h-full"
     id="appointmentModal" tabindex="-1" aria-hidden="true"
     x-cloak
     x-data="appointmentModal()"
>
    <div class="relative w-full max-w-2xl max-h-full">
        <div class="relative bg-white rounded-lg shadow dark:bg-gray-700">
            <div class="flex items-start justify-between p-4 border-b rounded-t dark:border-gray-600">
                <h3 class="text-xl font-semibold text-gray-900 dark:text-white">
                    {{ $slot }}
                </h3>
                <button class="text-gray-400 bg-transparent hover:bg-gray-200 hover:text-gray-900 rounded-lg text-sm p-1.5 ml-auto inline-flex items-center dark:hover:bg-gray-600 dark:hover:text-white"
                        data-modal-hide="appointmentModal"
                        type="button"
                >
                    <svg aria-hidden="true" class="w-5 h-5" fill="currentColor" viewBox="0 0 20 20"
                         xmlns="http://www.w3.org/2000/svg"
                    >
                        <path d="M4.293 4.293a1 1 0 011.414 0L10 8.586l4.293-4.293a1 1 0 111.414 1.414L11.414 10l4.293 4.293a1 1 0 01-1.414 1.414L10 11.414l-4.293 4.293a1 1 0 01-1.414-1.414L8.586 10 4.293 5.707a1 1 0 010-1.414z"
                              fill-rule="evenodd"
                              clip-rule="evenodd"
                        />
                    </svg>
                    <span class="sr-only">{{ __('Close modal') }}</span>
                </button>
            </div>

            <div class="p-6">
                <div class="mb-2 md:mb-4">
                    <h5 class="font-bold text-xl">{{ __('Select time') }}</h5>
                    <div class="flex overflow-x-scroll gap-1.5 p-2">
                        <template x-for="appointment in availableAppointments">
                            <button type="button"
                                    class="text-white bg-blue-700 hover:bg-blue-800 focus:outline-none focus:ring-4 focus:ring-blue-300 font-medium rounded-full text-sm px-3 py-1 text-center dark:bg-blue-600 dark:hover:bg-blue-700 dark:focus:ring-blue-800"
                                    x-text="appointment.time"
                                    :class="appointment.time === selectedTime ? 'bg-blue-950 hover:bg-blue-950' : ''"
                                    x-bind:disabled="appointment.time === selectedTime"
                                    @click="selectedTime = appointment.time"
                            ></button>
                        </template>
                    </div>
                </div>

                <div>
                    <h5 class="font-bold text-xl md:text-2xl">{{ __('Summary') }}</h5>
                    <p class="text-2xs">
                        <span class="font-bold">{{ __('Price') }}</span> <span x-text="price"></span> <span x-text="currency"></span>
                    </p>
                    <p class="text-2xs">
                        <span class="font-bold">{{ __('Time') }}</span> <span x-text="selectedTime"></span>
                    </p>
                </div>

            </div>

            <div class="flex items-center p-6 space-x-2 border-t border-gray-200 rounded-b dark:border-gray-600">
                <button class="text-white bg-blue-700 hover:bg-blue-800 focus:ring-4 focus:outline-none focus:ring-blue-300 font-medium rounded-lg text-sm px-5 py-2.5 text-center dark:bg-blue-600 dark:hover:bg-blue-700 dark:focus:ring-blue-800"
{{--                        data-modal-hide="appointmentModal" type="button"--}}
                        @click="scheduleAppointment()"
                >
                    {{ __('Schedule appointment') }}
                </button>
                <button class="text-gray-500 bg-white hover:bg-gray-100 focus:ring-4 focus:outline-none focus:ring-blue-300 rounded-lg border border-gray-200 text-sm font-medium px-5 py-2.5 hover:text-gray-900 focus:z-10 dark:bg-gray-700 dark:text-gray-300 dark:border-gray-500 dark:hover:text-white dark:hover:bg-gray-600 dark:focus:ring-gray-600"
                        data-modal-hide="appointmentModal" type="button"
                        @click="cancelAppointment()"
                >
                    {{ __('Cancel') }}
                </button>
            </div>
        </div>
    </div>

    @push('js')
        <script>
            function appointmentModal() {
                return {
                    isLoading: true,
                    isLoadingAppointments: true,
                    url: null,
                    company: null,
                    service: null,
                    price: null,
                    currency: null,
                    selectedTime: null,
                    availableAppointments: [],

                    fetchAppointments() {
                        const url = new URL(this.url)

                        fetch(url.toString())
                            .then(res => res.json())
                            .then(data => {
                                this.service = data.data;
                                this.price = this.service.price
                                this.currency = this.service.currency
                                this.availableAppointments = this.service.availableAppointments;
                                this.isLoading = false
                                this.isLoadingAppointments = false
                            })
                    },
                    scheduleAppointment() {

                    },
                    cancelAppointment() {
                        this.url = null
                        this.service = null
                        this.price = null
                        this.selectedTime = null
                        this.availableAppointments = []
                        this.isLoading = true;
                    },
                    init() {
                        window.addEventListener('company-appointment-modal', (event) => {
                            const button = event.target;

                            this.url = button.dataset.url;
                            this.fetchAppointments();
                        })
                    }
                }
            }
        </script>
    @endpush
</div>