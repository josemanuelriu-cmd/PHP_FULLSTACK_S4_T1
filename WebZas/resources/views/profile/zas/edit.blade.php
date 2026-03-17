<x-app-layout>
    <x-slot name="header">
        <div class="flex justify-between items-center">
            <h2 class="font-semibold text-xl text-zas-primary leading-tight">
                🧑🏻‍🦱 {{ __('messages.Profile Zas') }}
            </h2>
        </div>
    </x-slot>
    <div class="py-12">
        <div class="max-w-3xl mx-auto sm:px-6 lg:px-8 space-y-6">
            <div class="p-4 sm:p-8 bg-white shadow sm:rounded-lg border border-zas-light">
                <div class="max-w-xl">                   
                    @include('profile.zas.partials.update-zas-form')
                </div>
            </div>
        </div>
    </div>
</x-app-layout>
