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
{{--                        data-modal-hide="appointmentModal"--}}
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

                    <div role="status" class="flex justify-center items-center p-2"
                         x-show="isLoading"
                    >
                        <svg aria-hidden="true"
                             class="w-8 h-8 mr-2 text-gray-200 animate-spin dark:text-gray-600 fill-blue-600"
                             viewBox="0 0 100 101" fill="none" xmlns="http://www.w3.org/2000/svg">
                            <path d="M100 50.5908C100 78.2051 77.6142 100.591 50 100.591C22.3858 100.591 0 78.2051 0 50.5908C0 22.9766 22.3858 0.59082 50 0.59082C77.6142 0.59082 100 22.9766 100 50.5908ZM9.08144 50.5908C9.08144 73.1895 27.4013 91.5094 50 91.5094C72.5987 91.5094 90.9186 73.1895 90.9186 50.5908C90.9186 27.9921 72.5987 9.67226 50 9.67226C27.4013 9.67226 9.08144 27.9921 9.08144 50.5908Z"
                                  fill="currentColor"/>
                            <path d="M93.9676 39.0409C96.393 38.4038 97.8624 35.9116 97.0079 33.5539C95.2932 28.8227 92.871 24.3692 89.8167 20.348C85.8452 15.1192 80.8826 10.7238 75.2124 7.41289C69.5422 4.10194 63.2754 1.94025 56.7698 1.05124C51.7666 0.367541 46.6976 0.446843 41.7345 1.27873C39.2613 1.69328 37.813 4.19778 38.4501 6.62326C39.0873 9.04874 41.5694 10.4717 44.0505 10.1071C47.8511 9.54855 51.7191 9.52689 55.5402 10.0491C60.8642 10.7766 65.9928 12.5457 70.6331 15.2552C75.2735 17.9648 79.3347 21.5619 82.5849 25.841C84.9175 28.9121 86.7997 32.2913 88.1811 35.8758C89.083 38.2158 91.5421 39.6781 93.9676 39.0409Z"
                                  fill="currentFill"/>
                        </svg>
                        <span class="sr-only">{{ __('Loading...') }}</span>
                    </div>

                    <div class="flex overflow-x-scroll gap-1.5 p-2"
                         x-show="!isLoading"
                    >
                        <template x-for="openDay in openDays">
                            <button type="button"
                                    class="outline-0 bg-transparent"
                                    x-bind:disabled="selectedDay === openDay || isLoadingAppointments"
                                    @click="changeDay(openDay)"
                            >
                                <div class="bg-fuchsia-100 hover:bg-fuchsia-200 px-2 py-1.5 text-center rounded-md border-2 shadow-md"
                                     :class="selectedDay === openDay ? 'bg-fuchsia-300 hover:bg-fuchsia-300' : ''"
                                >
                                    <p class="text-2xl font-bold"
                                       x-text="parseDate(openDay).day"
                                    >
                                    </p>
                                    <p class="text-sm/[14px]"
                                       x-text="parseDate(openDay).month"
                                    >
                                    </p>
                                </div>
                            </button>
                        </template>
                    </div>
                </div>

                <div class="mb-2 md:mb-4">
                    <h5 class="font-bold text-xl">{{ __('Select time') }}</h5>

                    <div role="status" class="flex justify-center items-center p-2"
                         x-show="isLoadingAppointments"
                    >
                        <svg aria-hidden="true"
                             class="w-8 h-8 mr-2 text-gray-200 animate-spin dark:text-gray-600 fill-blue-600"
                             viewBox="0 0 100 101" fill="none" xmlns="http://www.w3.org/2000/svg">
                            <path d="M100 50.5908C100 78.2051 77.6142 100.591 50 100.591C22.3858 100.591 0 78.2051 0 50.5908C0 22.9766 22.3858 0.59082 50 0.59082C77.6142 0.59082 100 22.9766 100 50.5908ZM9.08144 50.5908C9.08144 73.1895 27.4013 91.5094 50 91.5094C72.5987 91.5094 90.9186 73.1895 90.9186 50.5908C90.9186 27.9921 72.5987 9.67226 50 9.67226C27.4013 9.67226 9.08144 27.9921 9.08144 50.5908Z"
                                  fill="currentColor"/>
                            <path d="M93.9676 39.0409C96.393 38.4038 97.8624 35.9116 97.0079 33.5539C95.2932 28.8227 92.871 24.3692 89.8167 20.348C85.8452 15.1192 80.8826 10.7238 75.2124 7.41289C69.5422 4.10194 63.2754 1.94025 56.7698 1.05124C51.7666 0.367541 46.6976 0.446843 41.7345 1.27873C39.2613 1.69328 37.813 4.19778 38.4501 6.62326C39.0873 9.04874 41.5694 10.4717 44.0505 10.1071C47.8511 9.54855 51.7191 9.52689 55.5402 10.0491C60.8642 10.7766 65.9928 12.5457 70.6331 15.2552C75.2735 17.9648 79.3347 21.5619 82.5849 25.841C84.9175 28.9121 86.7997 32.2913 88.1811 35.8758C89.083 38.2158 91.5421 39.6781 93.9676 39.0409Z"
                                  fill="currentFill"/>
                        </svg>
                        <span class="sr-only">{{ __('Loading...') }}</span>
                    </div>

                    <div class="flex overflow-x-scroll gap-1.5 p-2"
                         x-show="!isLoadingAppointments"
                    >
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
                        <span class="font-bold">{{ __('Price') }}</span>
                    </p>
                    <p>
                        <span x-show="!isLoadingAppointments">
                            <span x-text="price"></span> <span x-text="currency"></span>
                        </span>

                        <span role="status" class="flex justify-center items-center p-2"
                              x-show="isLoadingAppointments"
                        >
                            <svg aria-hidden="true"
                                 class="w-8 h-8 mr-2 text-gray-200 animate-spin dark:text-gray-600 fill-blue-600"
                                 viewBox="0 0 100 101" fill="none" xmlns="http://www.w3.org/2000/svg"><path
                                        d="M100 50.5908C100 78.2051 77.6142 100.591 50 100.591C22.3858 100.591 0 78.2051 0 50.5908C0 22.9766 22.3858 0.59082 50 0.59082C77.6142 0.59082 100 22.9766 100 50.5908ZM9.08144 50.5908C9.08144 73.1895 27.4013 91.5094 50 91.5094C72.5987 91.5094 90.9186 73.1895 90.9186 50.5908C90.9186 27.9921 72.5987 9.67226 50 9.67226C27.4013 9.67226 9.08144 27.9921 9.08144 50.5908Z"
                                        fill="currentColor"/><path
                                        d="M93.9676 39.0409C96.393 38.4038 97.8624 35.9116 97.0079 33.5539C95.2932 28.8227 92.871 24.3692 89.8167 20.348C85.8452 15.1192 80.8826 10.7238 75.2124 7.41289C69.5422 4.10194 63.2754 1.94025 56.7698 1.05124C51.7666 0.367541 46.6976 0.446843 41.7345 1.27873C39.2613 1.69328 37.813 4.19778 38.4501 6.62326C39.0873 9.04874 41.5694 10.4717 44.0505 10.1071C47.8511 9.54855 51.7191 9.52689 55.5402 10.0491C60.8642 10.7766 65.9928 12.5457 70.6331 15.2552C75.2735 17.9648 79.3347 21.5619 82.5849 25.841C84.9175 28.9121 86.7997 32.2913 88.1811 35.8758C89.083 38.2158 91.5421 39.6781 93.9676 39.0409Z"
                                        fill="currentFill"/></svg>
                            <span class="sr-only">{{ __('Loading...') }}</span>
                        </span>
                    </p>

                    <p class="text-2xs">
                        <span class="font-bold">{{ __('Time') }}</span>
                    </p>
                    <p class="text-2xs">
                        <span x-show="!selectedTime" class="opacity-0">6:00</span>
                        <span x-text="selectedTime"></span>
                    </p>
                </div>

            </div>

            <div class="flex items-center p-6 space-x-2 border-t border-gray-200 rounded-b dark:border-gray-600">
                <button class="text-white bg-blue-700 hover:bg-blue-800 focus:ring-4 focus:outline-none focus:ring-blue-300 font-medium rounded-lg text-sm px-5 py-2.5 text-center disabled:bg-blue-400 dark:bg-blue-600 dark:hover:bg-blue-700 dark:focus:ring-blue-800"
                        {{--                        data-modal-hide="appointmentModal" type="button"--}}
                        x-bind:disabled="!scheduleUrl || !price || !selectedDay || !selectedTime || isCreatingAppointment"
                        @click="scheduleAppointment()"
                >
                    <span x-show="isCreatingAppointment">
                            <svg aria-hidden="true" role="status" class="inline w-4 h-4 mr-3 text-white animate-spin"
                                 viewBox="0 0 100 101" fill="none" xmlns="http://www.w3.org/2000/svg">
                                <path d="M100 50.5908C100 78.2051 77.6142 100.591 50 100.591C22.3858 100.591 0 78.2051 0 50.5908C0 22.9766 22.3858 0.59082 50 0.59082C77.6142 0.59082 100 22.9766 100 50.5908ZM9.08144 50.5908C9.08144 73.1895 27.4013 91.5094 50 91.5094C72.5987 91.5094 90.9186 73.1895 90.9186 50.5908C90.9186 27.9921 72.5987 9.67226 50 9.67226C27.4013 9.67226 9.08144 27.9921 9.08144 50.5908Z"
                                      fill="#E5E7EB"/>
                                <path d="M93.9676 39.0409C96.393 38.4038 97.8624 35.9116 97.0079 33.5539C95.2932 28.8227 92.871 24.3692 89.8167 20.348C85.8452 15.1192 80.8826 10.7238 75.2124 7.41289C69.5422 4.10194 63.2754 1.94025 56.7698 1.05124C51.7666 0.367541 46.6976 0.446843 41.7345 1.27873C39.2613 1.69328 37.813 4.19778 38.4501 6.62326C39.0873 9.04874 41.5694 10.4717 44.0505 10.1071C47.8511 9.54855 51.7191 9.52689 55.5402 10.0491C60.8642 10.7766 65.9928 12.5457 70.6331 15.2552C75.2735 17.9648 79.3347 21.5619 82.5849 25.841C84.9175 28.9121 86.7997 32.2913 88.1811 35.8758C89.083 38.2158 91.5421 39.6781 93.9676 39.0409Z"
                                      fill="currentColor"/>
                            </svg>
                    </span>

                    {{ __('Schedule appointment') }}
                </button>
                <button class="text-gray-500 bg-white hover:bg-gray-100 focus:ring-4 focus:outline-none focus:ring-blue-300 rounded-lg border border-gray-200 text-sm font-medium px-5 py-2.5 hover:text-gray-900 focus:z-10 dark:bg-gray-700 dark:text-gray-300 dark:border-gray-500 dark:hover:text-white dark:hover:bg-gray-600 dark:focus:ring-gray-600"
{{--                        data-modal-hide="appointmentModal" type="button"--}}

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
                    isCreatingAppointment: false,
                    modal: new Modal(document.getElementById('appointmentModal')),

                    url: null,
                    scheduleUrl: null,
                    company: null,
                    service: null,
                    price: null,
                    currency: null,
                    selectedTime: null,
                    selectedDay: null,

                    availableAppointments: [],
                    openDays: [],
                    translatedMonths: [
                        "{{ __('January') }}",
                        "{{ __('February') }}",
                        "{{ __('March') }}",
                        "{{ __('April') }}",
                        "{{ __('May') }}",
                        "{{ __('June') }}",
                        "{{ __('July') }}",
                        "{{ __('August') }}",
                        "{{ __('September') }}",
                        "{{ __('October') }}",
                        "{{ __('November') }}",
                        "{{ __('December') }}",
                    ],

                    fetchAppointments() {
                        this.isLoadingAppointments = true

                        const url = new URL(this.url)

                        if (this.selectedDay) {
                            url.searchParams.set('date', this.selectedDay)
                        }

                        fetch(url.toString())
                            .then(res => res.json())
                            .then(data => {
                                this.service = data.data;
                                this.availableAppointments = this.service.availableAppointments;
                                this.openDays = this.service.openDays;
                                this.scheduleUrl = this.service.appointmentUrl;

                                this.price = this.service.price
                                this.currency = this.service.currency
                                this.selectedDay ??= this.openDays[0] ?? null;

                                this.isLoading = false
                                this.isLoadingAppointments = false
                            })
                    },
                    changeDay(day) {
                        this.selectedDay = day
                        this.selectedTime = null

                        this.fetchAppointments()
                    },
                    parseDate(date) {
                        const parsedDate = new Date(Date.parse(date));

                        return {
                            month: this.translatedMonths[parsedDate.getMonth()],
                            day: parsedDate.getDate()
                        }
                    },
                    scheduleAppointment() {
                        this.isCreatingAppointment = true;
                        let date = dayjs(`${this.selectedDay} ${this.selectedTime}`);

                        const body = {
                            service_id: this.service.id,
                            from: date.format('YYYY-MM-DD HH:mm:ss'),
                        }

                        fetch(this.scheduleUrl, {
                            method: 'POST',
                            headers: {
                                'Accept': 'application/json',
                                'Content-Type': 'application/json',
                                'X-CSRF-TOKEN': document.head.querySelector('meta[name=csrf-token]').content,
                            },
                            body: JSON.stringify(body)
                        })
                            .then(res => res.json())
                            .then((data) => {
                                console.log(data)

                                this.modal.hide();

                                this.$dispatch('notice', {type: 'error', text: '{{ __('Appointment has been successfully created!') }}'})
                            })
                            .catch((e) => {
                                console.log(e)
                            })
                            .finally((data) => {
                                this.isCreatingAppointment = false
                            })
                    },
                    cancelAppointment() {
                        this.modal.hide()

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

                            this.modal.show()
                            this.url = button.dataset.url;
                            this.fetchAppointments();
                        })
                    }
                }
            }
        </script>
    @endpush
</div>