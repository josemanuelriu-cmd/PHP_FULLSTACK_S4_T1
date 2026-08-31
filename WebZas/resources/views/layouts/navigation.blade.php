<nav class="bg-zas-primary border-b border-zas-primary/20 dark:bg-zas-primary" x-data="{ mobileOpen: false }">
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
        <div class="flex justify-between h-16">

            {{-- Logo + desktop links --}}
            <div class="flex items-center min-w-0">
                <div class="shrink-0 flex items-center">
                    <a href="{{ route('welcome') }}" class="flex items-center gap-2 no-underline">
                        <img src="{{ asset('images/logo.png') }}" alt="ZAS" class="h-9 w-auto shrink-0 brightness-0 invert">
                        <div class="flex flex-col leading-none">
                            <span class="text-zas-light font-bold text-base sm:text-lg tracking-wide">ZAS!</span>
                            <span class="text-zas-light text-xs font-medium tracking-wide">Juegos de mesa y rol</span>
                        </div>
                    </a>
                </div>

                <div class="hidden sm:-my-px sm:ml-8 sm:flex sm:space-x-1">
                    @if(auth()->check())
                        <x-nav-link :href="route('boardgames.index')" :active="request()->routeIs('boardgames.*')" class="text-zas-gray hover:text-zas-light">
                            {{ __('messages.Boardgames') }}
                        </x-nav-link>
                        <x-nav-link :href="route('zassessions.index')" :active="request()->routeIs('zassessions.*')" class="text-zas-gray hover:text-zas-light">
                            {{ __('messages.Sessions') }}
                        </x-nav-link>
                        @if(in_array(Auth::user()->type, ['admin', 'junta']))
                            <x-nav-link :href="route('types.index')" :active="request()->routeIs('types.*')" class="text-zas-gray hover:text-zas-light">
                                {{ __('messages.Types') }}
                            </x-nav-link>
                        @endif
                    @else
                        <x-nav-link :href="route('login')" :active="request()->routeIs('login')" class="text-zas-gray hover:text-zas-light">
                            {{ __('messages.Login') }}
                        </x-nav-link>
                    @endif
                </div>
            </div>

            {{-- Right side --}}
            <div class="flex items-center gap-2">
                {{-- Desktop: user dropdown --}}
                @if(auth()->check())
                    <div class="hidden sm:flex sm:items-center sm:ml-4">
                        <x-dropdown align="right" width="48">
                            <x-slot name="trigger">
                                <button class="flex items-center gap-1.5 text-zas-light hover:opacity-80 font-semibold text-sm px-3 py-1.5 rounded-full border border-zas-light/30 hover:border-zas-light/60 transition">
                                    <span class="max-w-[120px] truncate">{{ Auth::user()->nickname }}</span>
                                    <svg class="h-3.5 w-3.5 fill-current shrink-0" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20">
                                        <path fill-rule="evenodd" d="M5.23 7.21a.75.75 0 011.06.02L10 11.293l3.71-4.06a.75.75 0 111.08 1.04l-4.25 4.65a.75.75 0 01-1.08 0l-4.25-4.65a.75.75 0 01.02-1.06z" clip-rule="evenodd"/>
                                    </svg>
                                </button>
                            </x-slot>
                            <x-slot name="content">
                                <x-dropdown-link :href="route('profile.zas.edit')">
                                    {{ __('messages.Profile') }}
                                </x-dropdown-link>
                                <x-dropdown-link :href="route('profile.edit')">
                                    {{ __('messages.Change password') }}
                                </x-dropdown-link>
                                <div class="border-t border-gray-200 dark:border-gray-600 my-1"></div>
                                <form method="POST" action="{{ route('logout') }}">
                                    @csrf
                                    <x-dropdown-link :href="route('logout')"
                                            onclick="event.preventDefault(); this.closest('form').submit();">
                                        {{ __('messages.Log Out') }}
                                    </x-dropdown-link>
                                </form>
                            </x-slot>
                        </x-dropdown>
                    </div>
                @endif

                {{-- Mobile: hamburger button --}}
                <button @click="mobileOpen = !mobileOpen"
                        class="sm:hidden inline-flex items-center justify-center p-2 rounded-md text-zas-light hover:bg-zas-primaryHover focus:outline-none transition"
                        aria-label="Menu">
                    <svg x-show="!mobileOpen" class="h-6 w-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 6h16M4 12h16M4 18h16"/>
                    </svg>
                    <svg x-show="mobileOpen" class="h-6 w-6" fill="none" stroke="currentColor" viewBox="0 0 24 24" style="display:none;">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12"/>
                    </svg>
                </button>
            </div>
        </div>
    </div>

    {{-- Mobile menu --}}
    <div x-show="mobileOpen"
         x-transition:enter="transition ease-out duration-150"
         x-transition:enter-start="opacity-0 -translate-y-1"
         x-transition:enter-end="opacity-100 translate-y-0"
         x-transition:leave="transition ease-in duration-100"
         x-transition:leave-start="opacity-100 translate-y-0"
         x-transition:leave-end="opacity-0 -translate-y-1"
         class="sm:hidden border-t border-zas-light/20"
         style="display:none;">

        <div class="py-2 space-y-0.5">
            @if(auth()->check())
                <x-responsive-nav-link :href="route('boardgames.index')" :active="request()->routeIs('boardgames.*')">
                    {{ __('messages.Boardgames') }}
                </x-responsive-nav-link>
                <x-responsive-nav-link :href="route('zassessions.index')" :active="request()->routeIs('zassessions.*')">
                    {{ __('messages.Sessions') }}
                </x-responsive-nav-link>
                @if(in_array(Auth::user()->type, ['admin', 'junta']))
                    <x-responsive-nav-link :href="route('types.index')" :active="request()->routeIs('types.*')">
                        {{ __('messages.Types') }}
                    </x-responsive-nav-link>
                @endif
            @endif
        </div>

        @if(auth()->check())
            <div class="border-t border-zas-light/20 pt-3 pb-2">
                <div class="px-4 mb-2">
                    <p class="text-sm font-semibold text-zas-light">{{ Auth::user()->nickname }}</p>
                    <p class="text-xs text-zas-light/60">{{ Auth::user()->email }}</p>
                </div>
                <div class="space-y-0.5">
                    <x-responsive-nav-link :href="route('profile.zas.edit')" :active="request()->routeIs('profile.zas.*')">
                        {{ __('messages.Profile') }}
                    </x-responsive-nav-link>
                    <x-responsive-nav-link :href="route('profile.edit')" :active="request()->routeIs('profile.edit')">
                        {{ __('messages.Change password') }}
                    </x-responsive-nav-link>
                    <form method="POST" action="{{ route('logout') }}">
                        @csrf
                        <x-responsive-nav-link :href="route('logout')"
                                onclick="event.preventDefault(); this.closest('form').submit();">
                            {{ __('messages.Log Out') }}
                        </x-responsive-nav-link>
                    </form>
                </div>
            </div>
        @else
            <div class="border-t border-zas-light/20 py-2">
                <x-responsive-nav-link :href="route('login')" :active="request()->routeIs('login')">
                    {{ __('messages.Login') }}
                </x-responsive-nav-link>
            </div>
        @endif
    </div>
</nav>
