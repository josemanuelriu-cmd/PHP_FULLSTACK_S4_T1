<x-app-layout>
    <x-slot name="header">
        <div class="flex justify-between items-center">
            <h2 class="font-semibold text-2xl text-zas-primary leading-tight">
                🧮 {{ __('messages.Game types') }}
            </h2>
        </div>
    </x-slot>

    <div class="max-w-3xl mx-auto px-4 py-8">

        <h2 class="text-3xl font-bold text-gray-800 mb-6">✏ {{ __('messages.Edit type') }}</h2>

        <a href="{{ route('types.show', $type) }}"
        class="text-zas-primary hover:underline mb-6 inline-block">
            ← {{ __('messages.Return') }}
        </a>

        <form action="{{ route('types.update', $type) }}" method="post"
            class="bg-white shadow-lg rounded-xl p-6 space-y-4 border border-zas-primary/30">
            @csrf
            @method('PUT')

            @include('types.Form', ['type' => $type])

            <div  class="grid md:grid-cols-3 gap-4">
                <button type="submit"
                    class="bg-zas-primary text-white px-6 py-2 rounded-lg hover:bg-zas-primaryHover transition">
                    {{ __('messages.Update type') }}
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