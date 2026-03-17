<x-app-layout>
    <x-slot name="header">
        <div class="flex justify-between items-center">
            <h2 class="font-semibold text-2xl text-zas-primary leading-tight">
                🧮 {{ __('messages.Game types') }}
            </h2>
        </div>
    </x-slot>

    <div class="max-w-3xl mx-auto px-4 py-8">

        <h2 class="text-3xl font-bold text-gray-800 mb-6">➕ {{ __('messages.Add new type') }}</h2>

        <a href="{{ route('types.index') }}"
        class="text-zas-primary hover:underline mb-6 inline-block">
            ← {{ __('messages.Return to list') }}
        </a>

        @if ($errors->any())
            <div class="bg-red-100 text-red-700 p-4 rounded mb-4">
                <ul>
                    @foreach ($errors->all() as $error)
                        <li>{{ $error }}</li>
                    @endforeach
                </ul>
            </div>
        @endif

        <form action="{{ route('types.store') }}" method="post"
            class="bg-white shadow-lg rounded-xl p-6 space-y-4 border border-zas-primary/30">
            @csrf

            @include('types.Form')
            
            <div  class="grid md:grid-cols-3 gap-4">
                <button type="submit"
                    class="bg-zas-primary text-white px-6 py-2 rounded-lg hover:bg-zas-primaryHover transition">
                    {{ __('messages.Save type') }}
                </button>
                <button type="reset"
                    class="bg-gray-300 text-gray-700 px-6 py-2 rounded-lg hover:bg-gray-400 transition">
                    {{ __('messages.Clean form') }}
                </button>
                <a href="{{ route('types.index') }}"
                    class="bg-zas-dark text-white px-6 py-2 rounded-lg hover:bg-zas-darkSoft transition text-center">
                    {{ __('messages.Cancel') }}
            </a>
            </div>
        </form>

    </div>
</x-app-layout>
