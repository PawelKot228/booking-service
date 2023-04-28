<div
    id="notificationsBox"
    x-cloak
    x-data="notificationsHandler()"
    class="fixed inset-0 flex flex-col-reverse items-end justify-start h-screen w-screen pointer-events-none"
    @notification.window="add($event.detail)"
>
    <template x-for="notification of notifications" :key="notification.id">
        <div
            x-show="visible.includes(notification)"
            x-transition:enter="transition ease-in duration-200"
            x-transition:enter-start="transform opacity-0 translate-y-2"
            x-transition:enter-end="transform opacity-100"
            x-transition:leave="transition ease-out duration-500"
            x-transition:leave-start="transform translate-x-0 opacity-100"
            x-transition:leave-end="transform translate-x-full opacity-0"
            @click="remove(notification.id)"
            class="flex items-center w-full max-w-xs p-4 mb-4 text-gray-500 bg-white rounded-lg shadow dark:text-gray-400 dark:bg-gray-800"
            role="alert"
            style="pointer-events: all"


        >


            <div
                class="inline-flex items-center justify-center flex-shrink-0 w-8 h-8 rounded-lg "
                :class="{
				'text-green-500 bg-green-100 dark:bg-green-800 dark:text-green-200': notification.type === 'success',
				'text-blue-500 bg-blue-100 dark:bg-blue-800 dark:text-blue-200': notification.type === 'info',
				'text-orange-500 bg-orange-100 dark:bg-orange-700 dark:text-orange-200': notification.type === 'warning',
				'text-red-500 bg-red-100 dark:bg-red-800 dark:text-red-200': notification.type === 'error'
			 }"
            >
                <template x-if="notification.type === 'success'">
                    <svg aria-hidden="true" class="w-5 h-5" fill="currentColor" viewBox="0 0 20 20" xmlns="http://www.w3.org/2000/svg"><path fill-rule="evenodd" d="M16.707 5.293a1 1 0 010 1.414l-8 8a1 1 0 01-1.414 0l-4-4a1 1 0 011.414-1.414L8 12.586l7.293-7.293a1 1 0 011.414 0z" clip-rule="evenodd"></path></svg>
                    <span class="sr-only">{{ __('Check icon') }}</span>
                </template>

                <template x-if="notification.type === 'info'">
                    <svg aria-hidden="true" class="w-5 h-5" fill="currentColor" viewBox="0 0 20 20" xmlns="http://www.w3.org/2000/svg"><path fill-rule="evenodd" d="M4 2a1 1 0 011 1v2.101a7.002 7.002 0 0111.601 2.566 1 1 0 11-1.885.666A5.002 5.002 0 005.999 7H9a1 1 0 010 2H4a1 1 0 01-1-1V3a1 1 0 011-1zm.008 9.057a1 1 0 011.276.61A5.002 5.002 0 0014.001 13H11a1 1 0 110-2h5a1 1 0 011 1v5a1 1 0 11-2 0v-2.101a7.002 7.002 0 01-11.601-2.566 1 1 0 01.61-1.276z" clip-rule="evenodd"></path></svg>
                    <span class="sr-only">{{ __('Info icon') }}</span>
                </template>

                <template x-if="notification.type === 'warning'">
                    <svg aria-hidden="true" class="w-5 h-5" fill="currentColor" viewBox="0 0 20 20" xmlns="http://www.w3.org/2000/svg"><path fill-rule="evenodd" d="M8.257 3.099c.765-1.36 2.722-1.36 3.486 0l5.58 9.92c.75 1.334-.213 2.98-1.742 2.98H4.42c-1.53 0-2.493-1.646-1.743-2.98l5.58-9.92zM11 13a1 1 0 11-2 0 1 1 0 012 0zm-1-8a1 1 0 00-1 1v3a1 1 0 002 0V6a1 1 0 00-1-1z" clip-rule="evenodd"></path></svg>
                    <span class="sr-only">{{ __('Warning icon') }}</span>
                </template>

                <template x-if="notification.type === 'error'">
                    <svg aria-hidden="true" class="w-5 h-5" fill="currentColor" viewBox="0 0 20 20" xmlns="http://www.w3.org/2000/svg"><path fill-rule="evenodd" d="M4.293 4.293a1 1 0 011.414 0L10 8.586l4.293-4.293a1 1 0 111.414 1.414L11.414 10l4.293 4.293a1 1 0 01-1.414 1.414L10 11.414l-4.293 4.293a1 1 0 01-1.414-1.414L8.586 10 4.293 5.707a1 1 0 010-1.414z" clip-rule="evenodd"></path></svg>
                    <span class="sr-only">{{ __('Error icon') }}</span>
                </template>
            </div>


            <div class="ml-3 text-sm font-normal"
                 x-text="notification.text"
            ></div>

            <button type="button"
                    class="ml-auto -mx-1.5 -my-1.5 bg-white text-gray-400 hover:text-gray-900 rounded-lg focus:ring-2 focus:ring-gray-300 p-1.5 hover:bg-gray-100 inline-flex h-8 w-8 dark:text-gray-500 dark:hover:text-white dark:bg-gray-800 dark:hover:bg-gray-700"
                    aria-label="Close"
            >
                <span class="sr-only">{{ __('Close') }}</span>
                <svg aria-hidden="true" class="w-5 h-5" fill="currentColor" viewBox="0 0 20 20"
                     xmlns="http://www.w3.org/2000/svg">
                    <path fill-rule="evenodd"
                          d="M4.293 4.293a1 1 0 011.414 0L10 8.586l4.293-4.293a1 1 0 111.414 1.414L11.414 10l4.293 4.293a1 1 0 01-1.414 1.414L10 11.414l-4.293 4.293a1 1 0 01-1.414-1.414L8.586 10 4.293 5.707a1 1 0 010-1.414z"
                          clip-rule="evenodd"></path>
                </svg>
            </button>
        </div>
    </template>


    <script>


        function notificationsHandler() {
            return {
                notifications: [],
                visible: [],
                add(notification) {
                    notification.id = (Math.random() + 1).toString(36)
                    this.notifications.push(notification)
                    this.fire(notification.id)
                },
                fire(id) {
                    this.visible.push(this.notifications.find(notification => notification.id === id))
                    const timeShown = 2500 * this.visible.length

                    setTimeout(() => {
                        this.remove(id)
                    }, timeShown)
                },
                remove(id) {
                    const notification = this.visible.find(notification => notification.id === id)
                    const index = this.visible.indexOf(notification)
                    this.visible.splice(index, 1)
                },
                init() {
                    let sessionNotifications = {!! json_encode(session('notifications', [])) !!};

                    for (const [type, messages] of Object.entries(sessionNotifications)) {
                        for (const message of messages) {
                            this.add({type: type, text: message});
                        }
                    }
                },
            }
        }

    </script>

</div>
