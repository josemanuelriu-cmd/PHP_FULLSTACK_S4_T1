@php $logeado = auth()->check(); @endphp

<nav class="bg-zas-primary border-b border-zas-primary/20" x-data="{ mobileOpen: false }">
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
                    @if($logeado)
                        <x-nav-link :href="route('boardgames.index')" :active="request()->routeIs('boardgames.*')" class="text-zas-gray hover:text-zas-light">
                            {{ __('messages.Boardgames') }}
                        </x-nav-link>
                        <x-nav-link :href="route('zassessions.index')" :active="request()->routeIs('zassessions.*')" class="text-zas-gray hover:text-zas-light">
                            {{ __('messages.Sessions') }}
                        </x-nav-link>
                    @else
                        <x-nav-link :href="route('login')" :active="request()->routeIs('login')" class="text-zas-gray hover:text-zas-light">
                            {{ __('messages.Login') }}
                        </x-nav-link>
                        <x-nav-link :href="route('register')" :active="request()->routeIs('register')" class="text-zas-gray hover:text-zas-light">
                            {{ __('messages.Register') }}
                        </x-nav-link>
                    @endif
                </div>
            </div>

            {{-- Right side --}}
            <div class="flex items-center">
                {{-- Mobile: hamburger --}}
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
            @if($logeado)
                <x-responsive-nav-link :href="route('boardgames.index')" :active="request()->routeIs('boardgames.*')">
                    {{ __('messages.Boardgames') }}
                </x-responsive-nav-link>
                <x-responsive-nav-link :href="route('zassessions.index')" :active="request()->routeIs('zassessions.*')">
                    {{ __('messages.Sessions') }}
                </x-responsive-nav-link>
                <div class="border-t border-zas-light/20 my-1"></div>
                <form method="POST" action="{{ route('logout') }}">
                    @csrf
                    <x-responsive-nav-link :href="route('logout')"
                            onclick="event.preventDefault(); this.closest('form').submit();">
                        {{ __('messages.Log Out') }}
                    </x-responsive-nav-link>
                </form>
            @else
                <x-responsive-nav-link :href="route('login')" :active="request()->routeIs('login')">
                    {{ __('messages.Login') }}
                </x-responsive-nav-link>
                <x-responsive-nav-link :href="route('register')" :active="request()->routeIs('register')">
                    {{ __('messages.Register') }}
                </x-responsive-nav-link>
            @endif
        </div>
    </div>
</nav>
