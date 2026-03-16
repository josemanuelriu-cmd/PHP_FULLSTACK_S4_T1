<section>
    <header>
        <h2 class="text-lg font-medium text-zas-primary leading-tight">
            {{ __('Profile Information') }}
        </h2>

        <p class="mt-1 text-sm text-zas-dark">
            {{ __("Update your account's profile information") }}
        </p>
    </header>

    <form id="send-verification" method="post" action="{{ route('verification.send') }}">
        @csrf
    </form>
@php
    $authUser = auth()->user();
@endphp

@if($authUser->type === 'admin' && isset($users))
    <div class="mb-6">
        <x-input-label for="user_select" value="Selecciona usuario"/>
        <select
            onchange="window.location.href='{{ url('/profile/zas') }}/'+this.value"
            class="mt-1 block w-full border-zas-primary rounded-md">
            @foreach($users as $u)
                <option value="{{ $u->id }}"
                    {{ $u->id == $user->id ? 'selected' : '' }}>
                    {{ $u->name }} ({{ $u->nickname }})
                </option>
            @endforeach
        </select>
    </div>
@endif

    <form method="POST" action="{{ route('profile.zas.update', $user->id) }}" class="mt-6 space-y-6">
        @csrf
        @method('PATCH')

        <div>
            <x-input-label for="name" :value="__('Name')" />
            <x-text-input id="name" name="name" type="text" class="mt-1 block w-full" :value="old('name', $user->name)" required autofocus autocomplete="name" />
            <x-input-error class="mt-2" :messages="$errors->get('name')" />
        </div>

        <div>
            <x-input-label for="nickname" :value="__('Nickname')" />
            <x-text-input id="nickname" name="nickname" type="text" class="mt-1 block w-full" :value="old('nickname', $user->nickname)" required autocomplete="nickname" />
            <x-input-error class="mt-2" :messages="$errors->get('nickname')" />
        </div>

        <div>
            <x-input-label for="email" :value="__('Email')" />
            <x-text-input id="email" name="email" type="email" class="mt-1 block w-full" :value="old('email', $user->email)" required autocomplete="username" />
            <x-input-error class="mt-2" :messages="$errors->get('email')" />

            @if ($user instanceof \Illuminate\Contracts\Auth\MustVerifyEmail && ! $user->hasVerifiedEmail())
                <div>
                    <p class="text-sm mt-2 text-zas-primary">
                        {{ __('Your email address is unverified.') }}

                        <button form="send-verification" class="underline text-sm text-zas-dark hover:text-zas-light rounded-md focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-zas-primary">
                            {{ __('Click here to re-send the verification email.') }}
                        </button>
                    </p>

                    @if (session('status') === 'verification-link-sent')
                        <p class="mt-2 font-medium text-sm text-green-600 dark:text-green-400">
                            {{ __('A new verification link has been sent to your email address.') }}
                        </p>
                    @endif
                </div>
            @endif
        </div>

        @if($authUser->type === 'admin')
            <div>
                <x-input-label for="type" value="Tipo de usuario"/>
                <select id="type" name="type" class="mt-1 block w-full border-zas-primary rounded-md">
                    <option value="admin" {{ old('type', $user->type) == 'admin' ? 'selected' : '' }}>Administrador</option>
                    <option value="junta" {{ old('type', $user->type) == 'junta' ? 'selected' : '' }}>Junta</option>
                    <option value="partner" {{ old('type', $user->type) == 'partner' ? 'selected' : '' }}>Socio</option>
                    <option value="guest" {{ old('type', $user->type) == 'guest' ? 'selected' : '' }}>Invitado</option>
                </select>
            </div>
        @endif

        <div>
            <x-input-label for="num_partner" :value="__('Num partner')" />
            <x-text-input id="num_partner" name="num_partner" type="number" class="mt-1 block w-full" :value="old('num_partner', $user->num_partner)" required autocomplete="name" />
            <x-input-error class="mt-2" :messages="$errors->get('num_partner')" />
        </div>

        <div>
            <x-input-label for="telephone" :value="__('Telephone')" />
            <x-text-input id="telephone" name="telephone" type="text" class="mt-1 block w-full" :value="old('telephone', $user->telephone)" required autocomplete="name" />
            <x-input-error class="mt-2" :messages="$errors->get('telephone')" />
        </div>

        <div>
            <x-input-label for="age" :value="__('Age')" />
            <x-text-input id="age" name="age" type="number" class="mt-1 block w-full" :value="old('age', $user->age)" required autocomplete="name" />
            <x-input-error class="mt-2" :messages="$errors->get('age')" />
        </div>


        <div class="flex items-center gap-4">
            <x-primary-button>{{ __('Save') }}</x-primary-button>

            @if (session('status') === 'profilezas-updated')
                <p
                    x-data="{ show: true }"
                    x-show="show"
                    x-transition
                    x-init="setTimeout(() => show = false, 2000)"
                    class="text-sm text-zas-primary"
                >{{ __('Saved.') }}</p>
            @endif

            @if(session('status'))
                <div class="alert alert-success">
                    {{ session('status') }}
                </div>
            @endif
        </div>
    </form>
</section>
