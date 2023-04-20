<nav x-data="{ open: false }" class="bg-white border-b border-gray-100">
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
        <div class="flex justify-between h-16">
            <div class="flex">
                <div class="shrink-0 flex items-center">
                    <a href="{{ route('home') }}">
                        <x-application-mark class="block h-9 w-auto"/>
                    </a>
                </div>

                <div class="hidden space-x-8 sm:-my-px sm:ml-10 sm:flex">
                    <x-nav-link href="{{ route('home') }}" :active="request()->routeIs('home')">
                        {{ __('Home') }}
                    </x-nav-link>
                    <x-nav-link href="{{ route('services.categories') }}"
                                :active="request()->routeIs('services.categories')"
                    >
                        {{ __('Services') }}
                    </x-nav-link>
                    <x-nav-link href="{{ route('services.search') }}"
                                :active="request()->routeIs('services.search')"
                    >
                        {{ __('Search') }}
                    </x-nav-link>
                </div>
            </div>


            @guest
                <div class="hidden sm:flex sm:items-center sm:ml-6">
                    <div class="ml-3 relative">
                        <x-nav-link href="{{ route('register') }}"
                                    :active="request()->routeIs('register')"
                        >
                            {{ __('Sign in') }}
                        </x-nav-link>
                        <x-nav-link href="{{ route('login') }}"
                                    :active="request()->routeIs('login')"
                        >
                            {{ __('Log in') }}
                        </x-nav-link>
                    </div>
                </div>
            @endguest


            @auth
                <div class="hidden sm:flex sm:items-center sm:ml-6">
                    <div class="ml-3 relative">
                        <x-dropdown align="right" width="48">
                            <x-slot name="trigger">
                                @if (Laravel\Jetstream\Jetstream::managesProfilePhotos())
                                    <button
                                        class="flex text-sm border-2 border-transparent rounded-full focus:outline-none focus:border-gray-300 transition">
                                        <img class="h-8 w-8 rounded-full object-cover"
                                             src="{{ Auth::user()->profile_photo_url }}"
                                             alt="{{ Auth::user()->name }}"/>
                                    </button>
                                @else
                                    <span class="inline-flex rounded-md">
                                    <button type="button"
                                            class="inline-flex items-center px-3 py-2 border border-transparent text-sm leading-4 font-medium rounded-md text-gray-500 bg-white hover:text-gray-700 focus:outline-none focus:bg-gray-50 active:bg-gray-50 transition ease-in-out duration-150">
                                        {{ Auth::user()->name }}

                                        <svg class="ml-2 -mr-0.5 h-4 w-4" xmlns="http://www.w3.org/2000/svg" fill="none"
                                             viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor">
                                            <path stroke-linecap="round" stroke-linejoin="round"
                                                  d="M19.5 8.25l-7.5 7.5-7.5-7.5"/>
                                        </svg>
                                    </button>
                                </span>
                                @endif
                            </x-slot>

                            <x-slot name="content">
                                <!-- Account Management -->
                                <div class="block px-4 py-2 text-xs text-gray-400">
                                    {{ __('Manage Account') }}
                                </div>

                                <x-dropdown-link href="{{ route('profile.show') }}">
                                    {{ __('Profile') }}
                                </x-dropdown-link>

                                <x-dropdown-link href="{{ route('users.appointments.index') }}">
                                    {{ __('Appointments') }}
                                </x-dropdown-link>

                                {{--                                @if (Laravel\Jetstream\Jetstream::hasApiFeatures())--}}
                                {{--                                    <x-dropdown-link href="{{ route('api-tokens.index') }}">--}}
                                {{--                                        {{ __('API Tokens') }}--}}
                                {{--                                    </x-dropdown-link>--}}
                                {{--                                @endif--}}

                                <div class="border-t border-gray-200"></div>

                                @if(auth()->user()->ownedCompanies->isNotEmpty())
                                    <div class="block px-4 py-2 text-xs text-gray-400">
                                        {{ __('Select Company') }}
                                    </div>

                                    @foreach(auth()->user()->ownedCompanies as $company)
                                        <x-dropdown-link href="{{ route('users.companies.show', ['company' => $company->id]) }}">
                                            {{ $company->name }}
                                        </x-dropdown-link>
                                    @endforeach

                                    <div class="border-t border-gray-200"></div>

                                @endif

                                <x-dropdown-link href="{{ route('users.companies.create') }}">
                                    {{ __('Create company') }}
                                </x-dropdown-link>

                                <div class="border-t border-gray-200"></div>

                                <!-- Authentication -->
                                <form method="POST" action="{{ route('logout') }}" x-data>
                                    @csrf

                                    <x-dropdown-link href="{{ route('logout') }}"
                                                     @click.prevent="$root.submit();">
                                        {{ __('Log Out') }}
                                    </x-dropdown-link>
                                </form>
                            </x-slot>
                        </x-dropdown>
                    </div>
                </div>

            @endauth
            <div class="-mr-2 flex items-center sm:hidden">
                <button @click="open = ! open"
                        class="inline-flex items-center justify-center p-2 rounded-md text-gray-400 hover:text-gray-500 hover:bg-gray-100 focus:outline-none focus:bg-gray-100 focus:text-gray-500 transition duration-150 ease-in-out">
                    <svg class="h-6 w-6" stroke="currentColor" fill="none" viewBox="0 0 24 24">
                        <path :class="{'hidden': open, 'inline-flex': ! open }" class="inline-flex"
                              stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                              d="M4 6h16M4 12h16M4 18h16"/>
                        <path :class="{'hidden': ! open, 'inline-flex': open }" class="hidden"
                              stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                              d="M6 18L18 6M6 6l12 12"/>
                    </svg>
                </button>
            </div>

        </div>
    </div>


    <!-- Responsive Navigation Menu -->
    <div :class="{'block': open, 'hidden': !open}" class="hidden sm:hidden">
        <div class="pt-2 pb-3 space-y-1">
            <x-responsive-nav-link href="{{ route('home') }}" :active="request()->routeIs('home')">
                {{ __('Home') }}
            </x-responsive-nav-link>
            <x-responsive-nav-link href="{{ route('services.categories') }}"
                                   :active="request()->routeIs('services.categories')">
                {{ __('Services') }}
            </x-responsive-nav-link>
            <x-responsive-nav-link href="{{ route('services.search') }}"
                                   :active="request()->routeIs('services.search')">
                {{ __('Search') }}
            </x-responsive-nav-link>
        </div>

        <!-- Responsive Settings Options -->
        <div class="pt-2 pb-1 border-t border-gray-200">
            @guest
                <div class="space-y-1">
                    <x-responsive-nav-link href="{{ route('login') }}">
                        {{ __('Log In') }}
                    </x-responsive-nav-link>
                </div>
            @endguest

            @auth
                <div class="flex items-center px-4">
                    @if (Laravel\Jetstream\Jetstream::managesProfilePhotos())
                        <div class="shrink-0 mr-3">
                            <img class="h-10 w-10 rounded-full object-cover" src="{{ Auth::user()->profile_photo_url }}"
                                 alt="{{ Auth::user()->name }}"/>
                        </div>
                    @endif

                    <div>
                        <div class="font-medium text-base text-gray-800">{{ Auth::user()->name }}</div>
                        <div class="font-medium text-sm text-gray-500">{{ Auth::user()->email }}</div>
                    </div>
                </div>

                <div class="mt-3 space-y-1">
                    <x-responsive-nav-link href="{{ route('profile.show') }}"
                                           :active="request()->routeIs('profile.show')">
                        {{ __('Profile') }}
                    </x-responsive-nav-link>

                    <x-responsive-nav-link href="{{ route('users.appointments.index') }}"
                                           :active="request()->routeIs('users.appointments.index')"
                    >
                        {{ __('Appointments') }}
                    </x-responsive-nav-link>

                    @if(auth()->user()->ownedCompanies)
                        @foreach(auth()->user()->ownedCompanies as $company)
                            <x-responsive-nav-link href="{{ route('users.companies.show', ['company' => $company->id]) }}">
                                {{ $company->name }}
                            </x-responsive-nav-link>
                        @endforeach
                    @else
                        <x-responsive-nav-link href="{{ route('users.companies.create') }}"
                                               :active="request()->routeIs('users.companies.create')"
                        >
                            {{ __('Create company') }}
                        </x-responsive-nav-link>
                    @endif

                    {{--                    @if (Laravel\Jetstream\Jetstream::hasApiFeatures())--}}
                    {{--                        <x-responsive-nav-link href="{{ route('api-tokens.index') }}"--}}
                    {{--                                               :active="request()->routeIs('api-tokens.index')"--}}
                    {{--                        >--}}
                    {{--                            {{ __('API Tokens') }}--}}
                    {{--                        </x-responsive-nav-link>--}}
                    {{--                    @endif--}}

                    <form method="POST" action="{{ route('logout') }}" x-data>
                        @csrf

                        <x-responsive-nav-link href="{{ route('logout') }}"
                                               @click.prevent="$root.submit();">
                            {{ __('Log Out') }}
                        </x-responsive-nav-link>
                    </form>
                </div>
            @endauth
        </div>
    </div>
</nav>
