@php
    $boardgame = $boardgame ?? null;
@endphp

<div>
    <label class="block font-medium text-gray-700">
        {{ __('messages.Name') }}
    </label>
    <input type="text" name="name"
        value="{{ old('name', $boardgame->name ?? '') }}"
        class="w-full mt-1 border-zas-primary border rounded-lg shadow-sm focus:ring-zas-primary focus:border-zas-primary pl-2">
    @error('name') <p class="text-red-500 text-sm">{{ $message }}</p> @enderror
</div>
<div>
    <label class="block font-medium text-gray-700">
        {{ __('messages.Slug') }}
    </label>
    <input type="text" name="slug"
        value="{{ old('slug', $boardgame->slug ?? '') }}"
        class="w-full mt-1 border-zas-primary border rounded-lg shadow-sm focus:ring-zas-primary focus:border-zas-primary pl-2">
    @error('slug') <p class="text-red-500 text-sm">{{ $message }}</p> @enderror
</div>

<div class="grid md:grid-cols-2 gap-4">
    <div>
        <label class="block font-medium text-gray-700">
            {{ __('messages.Min players') }}
        </label>
        <input type="number" name="min_players"
            value="{{ old('min_players', $boardgame->min_players ?? '') }}"
            class="w-full mt-1 border-zas-primary border rounded-lg focus:ring-zas-primary focus:border-zas-primary shadow-sm pl-2">
    </div>

    <div>
        <label class="block font-medium text-gray-700">
            {{ __('messages.Max players') }}
        </label>
        <input type="number" name="max_players"
            value="{{ old('max_players', $boardgame->max_players ?? '') }}"
            class="w-full mt-1 border-zas-primary border rounded-lg focus:ring-zas-primary focus:border-zas-primary shadow-sm pl-2">
    </div>
</div>
<div class="grid md:grid-cols-2 gap-4">
    <div>
        <label class="block font-medium text-gray-700">
            {{ __('messages.Min age') }}
        </label>
        <input type="number" name="min_age"
            value="{{ old('min_age', $boardgame->min_age ?? '') }}"
            class="w-full mt-1 border-zas-primary border rounded-lg focus:ring-zas-primary focus:border-zas-primary shadow-sm pl-2">
    </div>

    <div>
        <label class="block font-medium text-gray-700">
            {{ __('messages.Duration (minutes)') }}
        </label>
        <input type="number" name="duration"
            value="{{ old('duration', $boardgame->duration ?? '') }}"
            class="w-full mt-1 border-zas-primary border rounded-lg focus:ring-zas-primary focus:border-zas-primary shadow-sm pl-2">
    </div>
</div>
<!-- Dual listbox para tipos -->
<div>
    <label class="block font-medium text-gray-700 mb-2">
        {{ __('messages.Types') }}
    </label>
    <div id="dual-listbox" class="grid grid-cols-2 gap-4">
        <!-- Tipos disponibles -->
        <div class="bg-white shadow rounded p-2">
            <h3 class="font-bold mb-2">
                {{ __('messages.Available') }}
            </h3>
            <ul id="available_types" class="space-y-1">
                @foreach($types as $type)
                    @if(!$boardgame || !$boardgame->types->contains($type->id))
                        <li class="flex justify-between items-center p-1 border rounded">
                            <span>{{ $type->type }}</span>
                            <button type="button" class="text-white px-2 rounded" onclick="moveToSelected({{ $type->id }}, '{{ $type->type }}', this)">
                                ➡️
                            </button>
                        </li>
                    @endif
                @endforeach
            </ul>
        </div>

        <!-- Tipos seleccionados -->
        <div class="bg-white shadow rounded p-2">
            <h3 class="font-bold mb-2">
                {{ __('messages.Selected') }}
            </h3>
            <ul id="selected_types" class="space-y-1">
                @if($boardgame)
                    @foreach($boardgame->types as $type)
                        <li class="flex justify-between items-center p-1 border rounded">
                            <button type="button" class="text-white px-2 rounded " onclick="moveToAvailable({{ $type->id }}, '{{ $type->type }}', this)">
                                ⬅️
                            </button>
                            <span>{{ $type->type }}</span>
                            <input type="hidden" name="types[]" value="{{ $type->id }}">
                        </li>
                    @endforeach
                @endif
            </ul>
        </div>
    </div>
</div>
<div>
    <label class="block font-medium text-gray-700">
        {{ __('messages.Description') }}
    </label>
    <textarea name="description"
        class="w-full mt-1 border-zas-primary border rounded-lg focus:ring-zas-primary focus:border-zas-primary shadow-sm resize-none pl-2"
        rows="4">{{ old('description', $boardgame->description ?? '') }}</textarea>
</div>

<script>
function moveToSelected(id, text, button) {
    // eliminar del listado disponible
    const li = button.parentElement;
    li.remove();

    // crear nuevo elemento en selected
    const ul = document.getElementById('selected_types');
    const newLi = document.createElement('li');
    newLi.className = 'flex justify-between items-center p-1 border rounded';

    newLi.innerHTML = `
        <button type="button" class="text-white px-2 rounded " onclick="moveToAvailable(${id}, '${text}', this)">⬅️</button>
        <span>${text}</span>
        <input type="hidden" name="types[]" value="${id}">
    `;

    ul.appendChild(newLi);
}

function moveToAvailable(id, text, button) {
    // eliminar del listado seleccionado
    const li = button.parentElement;
    li.remove();

    // crear nuevo elemento en available
    const ul = document.getElementById('available_types');
    const newLi = document.createElement('li');
    newLi.className = 'flex justify-between items-center p-1 border rounded';

    newLi.innerHTML = `
        <span>${text}</span>
        <button type="button" class="text-white px-2 " onclick="moveToSelected(${id}, '${text}', this)">➡️</button>
    `;

    ul.appendChild(newLi);
}
</script>