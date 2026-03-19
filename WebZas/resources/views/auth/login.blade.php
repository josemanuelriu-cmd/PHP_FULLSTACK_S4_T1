<x-guest-layout>
    <x-auth-card>
        <x-slot name="logo">

            <h1 class="text-zas-primary font-bold text-3xl">ZAS Club</h1>
        </x-slot>

        <!-- Session Status -->
        <x-auth-session-status class="mb-4" :status="session('status')" />

        <!-- Validation Errors -->
        <x-auth-validation-errors class="mb-4" :errors="$errors" />
        
        <form method="POST" action="{{ route('login') }}">
            @csrf
            
                
                <!-- Email -->
                <div>
                    <x-label for="email" :value="__('messages.Email')" class="text-zas-dark"/>
                    <x-input id="email" class="block mt-1 w-full" type="email" name="email" 
                    value="" 
                    required autofocus />
                </div>

                <!-- Password -->
                <div class="mt-4">
                    <x-label for="password" :value="__('messages.Password')" class="text-zas-dark"/>
                    <x-input id="password" class="block mt-1 w-full" type="password" name="password" 
                    value="" 
                    required autocomplete="current-password" />
                </div>

                <!-- Remember Me -->
                <div class="block mt-4">
                    <label for="remember_me" class="inline-flex items-center">
                        <input id="remember_me" type="checkbox" name="remember" class="rounded border-zas-primary text-zas-primary shadow-sm focus:ring-zas-primary">
                        <span class="ml-2 text-sm font-medium text-zas-dark">{{ __('messages.Remember me') }}</span>
                    </label>
                </div>

                <div class="flex items-center justify-end mt-4">
                    @if (Route::has('password.request'))
                        <a class="underline text-sm text-zas-primary hover:text-zas-primaryHover" href="{{ route('password.request') }}">
                            {{ __('messages.Forgot your password?') }}
                        </a>
                    @endif

                    <x-button class="ml-3 bg-zas-primary hover:bg-zas-primaryHover">
                        {{ __('messages.Login') }}
                    </x-button>
                    <a href="{{ route('register') }}" class="ml-4 underline text-sm text-zas-primary hover:text-zas-primaryHover">
                        {{ __('messages.Create new user') }}
                    </a>
                </div>
            
        </form>
    </x-auth-card>
</x-guest-layout>