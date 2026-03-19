<section>
    <header>
        <h2 class="text-lg font-medium text-zas-primary leading-tight">
            {{ __('messages.Profile Information') }}
        </h2>

        <p class="mt-1 text-sm text-zas-dark">
            {{ __("messages.Update your account's profile information") }}
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
        <x-input-label for="user_select" :value={{ __('messages.Select user') }}/>
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
            <x-input-label for="name" :value="__('messages.Name')"/>
            <x-text-input id="name" name="name" type="text" class="mt-1 block w-full" :value="old('name', $user->name)" required autofocus autocomplete="name" />
            <x-input-error class="mt-2" :messages="$errors->get('name')" />
        </div>

        <div>
            <x-input-label for="nickname" :value="__('messages.Nickname')"/>
            <x-text-input id="nickname" name="nickname" type="text" class="mt-1 block w-full" :value="old('nickname', $user->nickname)" required autocomplete="nickname" />
            <x-input-error class="mt-2" :messages="$errors->get('nickname')" />
        </div>

        <div>
            <x-input-label for="email" :value="__('messages.Email')" />
            <x-text-input id="email" name="email" type="email" class="mt-1 block w-full" :value="old('email', $user->email)" required autocomplete="username" />
            <x-input-error class="mt-2" :messages="$errors->get('email')" />

            @if ($user instanceof \Illuminate\Contracts\Auth\MustVerifyEmail && ! $user->hasVerifiedEmail())
                <div>
                    <p class="text-sm mt-2 text-zas-primary">
                        {{ __('messages.Your email address is unverified') }}

                        <button form="send-verification" class="underline text-sm text-zas-dark hover:text-zas-light rounded-md focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-zas-primary">
                            {{ __('messages.Click here to re-send the verification email') }}
                        </button>
                    </p>

                    @if (session('status') === 'verification-link-sent')
                        <p class="mt-2 font-medium text-sm text-green-600 dark:text-green-400">
                            {{ __('messages.A new verification link has been sent to your email address') }}.
                        </p>
                    @endif
                </div>
            @endif
        </div>

        @if($authUser->type === 'admin')
            <div>
                <x-input-label for="type" :value="__('messages.User type')"/>
                <select id="type" name="type" class="mt-1 block w-full border-zas-primary rounded-md">
                    <option value="admin" {{ old('type', $user->type) == 'admin' ? 'selected' : '' }}>{{ __('messages.Administrator') }}</option>
                    <option value="junta" {{ old('type', $user->type) == 'junta' ? 'selected' : '' }}>{{ __('messages.Junta') }}</option>
                    <option value="partner" {{ old('type', $user->type) == 'partner' ? 'selected' : '' }}>{{ __('messages.Member') }}</option>
                    <option value="guest" {{ old('type', $user->type) == 'guest' ? 'selected' : '' }}>{{ __('messages.Guest') }}</option>
                </select>
            </div>
        @endif

        <div>
            <x-input-label for="num_partner" :value="__('messages.Num partner')" />
            <x-text-input id="num_partner" name="num_partner" type="number" class="mt-1 block w-full" :value="old('num_partner', $user->num_partner)" required autocomplete="name" />
            <x-input-error class="mt-2" :messages="$errors->get('num_partner')" />
        </div>

        <div>
            <x-input-label for="telephone" :value="__('messages.Telephone')" />
            <x-text-input id="telephone" name="telephone" type="text" class="mt-1 block w-full" :value="old('telephone', $user->telephone)" required autocomplete="name" />
            <x-input-error class="mt-2" :messages="$errors->get('telephone')" />
        </div>

        <div>
            <x-input-label for="age" :value="__('messages.Age')" />
            <x-text-input id="age" name="age" type="number" class="mt-1 block w-full" :value="old('age', $user->age)" required autocomplete="name" />
            <x-input-error class="mt-2" :messages="$errors->get('age')" />
        </div>
        <div>
            <x-input-label for="language" :value="__('messages.Language')"/>
            <select id="language" name="language"
                class="mt-1 block w-full border-zas-primary rounded-md">
                <option value="es" {{ old('language',$user->language)=='es' ? 'selected':'' }}>
                    {{ __('messages.Spanish') }}
                </option>
                <option value="en" {{ old('language',$user->language)=='en' ? 'selected':'' }}>
                    {{ __('messages.English') }}
                </option>
                <option value="ca" {{ old('language',$user->language)=='ca' ? 'selected':'' }}>
                    {{ __('messages.Catalan') }}
                </option>
            </select>
        </div>
        @if($authUser->type === 'admin')
            <div class="mt-4">
                <x-input-label :value="__('messages.Status')" />

                @if($user->withdrawal_date)
                    <p class="text-red-600 font-semibold">
                        {{ __('messages.User deactivated') }}
                        ({{ $user->withdrawal_date }})
                    </p>
                @else
                    <p class="text-green-600 font-semibold">
                        {{ __('messages.Active user') }}
                    </p>
                @endif
            </div>
        @endif

        <div class="flex items-center gap-4">
            <x-primary-button>{{ __('messages.Save') }}</x-primary-button>
        </div>
    </form>
    @if($authUser->type === 'admin' && $authUser->id !== $user->id)
        <div class="mt-4">
            @if($user->withdrawal_date)
                <form method="POST" action="{{ route('profile.zas.reactivate', $user->id) }}">
                    @csrf
                    @method('PATCH')

                    <button class="bg-green-600 text-white px-4 py-2 rounded hover:bg-green-700">
                        {{ __('messages.Reactivate user') }}
                    </button>
                </form>
            @else
                <form method="POST" action="{{ route('profile.zas.deactivate', $user->id) }}">
                    @csrf
                    @method('PATCH')

                    <button class="bg-red-600 text-white px-4 py-2 rounded hover:bg-red-700">
                        {{ __('messages.Deactivate user') }}
                    </button>
                </form>
            @endif

        </div>
    @endif
</section>
