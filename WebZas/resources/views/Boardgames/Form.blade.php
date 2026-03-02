@php
    $boardgame = $boardgame ?? null;
@endphp

<div>
    <label class="block font-medium text-gray-700">Nombre</label>
    <input type="text" name="name"
        value="{{ old('name', $boardgame->name ?? '') }}"
        class="w-full mt-1 border-zas-primary border rounded-lg shadow-sm focus:ring-zas-primary focus:border-zas-primary pl-2">
    @error('name') <p class="text-red-500 text-sm">{{ $message }}</p> @enderror
</div>

<div class="grid md:grid-cols-2 gap-4">
    <div>
        <label class="block font-medium text-gray-700">Mín jugadores</label>
        <input type="number" name="min_players"
            value="{{ old('min_players', $boardgame->min_players ?? '') }}"
            class="w-full mt-1 border-zas-primary border rounded-lg shadow-sm pl-2">
    </div>

    <div>
        <label class="block font-medium text-gray-700">Máx jugadores</label>
        <input type="number" name="max_players"
            value="{{ old('max_players', $boardgame->max_players ?? '') }}"
            class="w-full mt-1 border-zas-primary border rounded-lg shadow-sm pl-2">
    </div>
</div>
<div class="grid md:grid-cols-3 gap-4">
    <div>
        <label class="block font-medium text-gray-700">Edad mínima</label>
        <input type="number" name="min_age"
            value="{{ old('min_age', $boardgame->min_age ?? '') }}"
            class="w-full mt-1 border-zas-primary border rounded-lg shadow-sm pl-2">
    </div>
    <div>
    </div>

    <div>
        <label class="block font-medium text-gray-700">Duración (minutos)</label>
        <input type="number" name="duration"
            value="{{ old('duration', $boardgame->duration ?? '') }}"
            class="w-full mt-1 border-zas-primary border rounded-lg shadow-sm pl-2">
    </div>
</div>
<div>
    <label class="block font-medium text-gray-700">Descripción</label>
    <textarea name="description"
        class="w-full mt-1 border-zas-primary border rounded-lg shadow-sm resize-none pl-2"
        rows="4">{{ old('description', $boardgame->description ?? '') }}</textarea>
</div>