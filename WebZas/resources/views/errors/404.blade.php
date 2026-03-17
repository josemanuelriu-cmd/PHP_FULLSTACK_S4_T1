<x-app-layout>
    

<div class="max-w-2xl mx-auto px-4 py-8">

    <div class="bg-white border border-zas-primary
                    rounded-2xl p-10 mt-4 shadow-2xl">
        <h1 class="text-3xl font-bold text-zas-primary mb-4">Error 404</h1>

        <h2 class="text-xl text-zas-primary mb-4">{{ __('messages.Page not found') }}</h2>

        <p class="text-zas-primary mb-4">{{ __('messages.The page you are looking for does not exist or has been moved') }}</p>

        <a href="{{ url('/') }}" class="bg-zas-primary px-4 py-2 rounded-lg text-white hover:bg-zas-primaryHover transition">{{ __('return to the beginning') }}</a>
    </div>
</div>
</x-app-layout>