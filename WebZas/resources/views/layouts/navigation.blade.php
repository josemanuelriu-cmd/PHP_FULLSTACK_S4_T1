<nav class="bg-zas-light border-b border-zas-primary/20 dark:bg-zas-primary dark:border-zas-primary/50">
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
        <div class="flex justify-between h-16">
            <div class="flex">
                <div class="shrink-0 flex items-center">
                    <span class="text-zas-light font-bold text-xl">
                        ZAS! Juegos de mesa y rol
                    </span>
                </div>

                <div class="hidden space-x-8 sm:-my-px sm:ml-10 sm:flex">
                    <x-nav-link :href="route('welcome')" :active="request()->routeIs('welcome')" class="text-zas-dark hover:text-zas-light">
                        {{ __('messages.Start') }}
                    </x-nav-link>
                    <x-nav-link :href="route('boardgames.index')" :active="request()->routeIs('boardgames.*')" class="text-zas-dark hover:text-zas-light">
                        {{ __('messages.Boardgames') }}
                    </x-nav-link>
                    @if(Auth::user()->type === 'admin')
                    <x-nav-link :href="route('profile.edit')" :active="request()->routeIs('profile.*')" class="text-zas-dark hover:text-zas-light">
                        {{ __('messages.Change password') }}
                    </x-nav-link>
                    @endif
                    <x-nav-link :href="route('profile.zas.edit')" :active="request()->routeIs('profile.zas.*')" class="text-zas-dark hover:text-zas-light">
                        {{ __('messages.Profile') }}
                    </x-nav-link>
                    @if(in_array(Auth::user()->type, ['admin', 'junta']))
                    <x-nav-link :href="route('types.index')" :active="request()->routeIs('types.*')" class="text-zas-dark hover:text-zas-light">
                        {{ __('messages.Types') }}
                    </x-nav-link>
                    @endif
                    <x-nav-link :href="route('zassessions.index')" :active="request()->routeIs('zassessions.*')" class="text-zas-dark hover:text-zas-light">
                        {{ __('messages.Sessions') }}
                    </x-nav-link>
                    
                </div>
            </div>

            <div class="hidden sm:flex sm:items-center sm:ml-6">
                <x-dropdown align="right" width="48">
                    <x-slot name="trigger">
                        <button class="flex items-center text-zas-light hover:text-zas-dark font-semibold">
                            {{ Auth::user()->nickname }}
                            <svg class="ml-2 h-4 w-4 fill-current" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20">
                                <path fill-rule="evenodd" d="M5.23 7.21a.75.75 0 011.06.02L10 11.293l3.71-4.06a.75.75 0 111.08 1.04l-4.25 4.65a.75.75 0 01-1.08 0l-4.25-4.65a.75.75 0 01.02-1.06z" clip-rule="evenodd"/>
                            </svg>
                        </button>
                    </x-slot>

                    <x-slot name="content">
                        <form method="POST" action="{{ route('logout') }}">
                            @csrf
                            <x-dropdown-link :href="route('logout')"
                                     onclick="event.preventDefault(); this.closest('form').submit();" class="text-zas-light hover:text-zas-dark bg-zas-primary">
                                {{ __('messages.Log Out') }}
                            </x-dropdown-link>
                        </form>
                    </x-slot>
                </x-dropdown>
            </div>
        </div>
    </div>
</nav>