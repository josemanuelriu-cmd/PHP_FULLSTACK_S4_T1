@php
    $zassession = $zassession ?? null;
@endphp


<div>
    <label class="block font-medium text-zas-primary">Fecha</label>
        <input type="date" name="date"
            value="{{ old('date', optional($zassession?->date)->format('Y-m-d') ?? '') }}"
            class="w-full mt-1 border-zas-primary border rounded-lg shadow-sm focus:ring-zas-primary focus:border-zas-primary pl-2">
        @error('date') <p class="text-red-500 text-sm">{{ $message }}</p> @enderror
</div>

<div class="grid md:grid-cols-2 gap-4">
    <div>
        <label class="block font-medium text-zas-primary">Lugar</label>
        <input type="text" name="name" default="Can verdaguer"
            value="{{ old('name', $zassession->name ?? 'Can verdaguer2') }}"
            class="w-full mt-1 border-zas-primary border rounded-lg shadow-sm pl-2">
    </div>

    <div>
        <label class="block font-medium text-zas-primary">Nombre del evento</label>
        <input type="text" name="event_name" default="Sesión Zas"
            value="{{ old('event_name', $zassession->event_name ?? 'Sesión Zas2') }}"
            class="w-full mt-1 border-zas-primary border rounded-lg shadow-sm pl-2">
    </div>
</div>
<div class="grid md:grid-cols-3 gap-4">
    <div>
        <label class="block font-medium text-zas-primary">Hora inicial</label>
        <input type="time" name="start_time"
            value="{{ old('start_time',  optional($zassession?->start_time)->format('H:i') ?? '16:30') }}"
            class="w-full mt-1 border-zas-primary border rounded-lg shadow-sm pl-2">
    </div>

    <div>
        <label class="block font-medium text-zas-primary">Hora final</label>
        <input type="time" name="end_time"
            value="{{ old('end_time',  optional($zassession?->end_time)->format('H:i') ?? '20:30') }}"
            class="w-full mt-1 border-zas-primary border rounded-lg shadow-sm pl-2">
    </div>
    <div>
        <label class="block font-medium text-zas-primary">Usuarios máximos</label>
        <input type="number" name="max_users"
            value="{{ old('max_users', $zassession->max_users ?? '14') }}"
            class="w-full mt-1 border-zas-primary border rounded-lg shadow-sm pl-2">
    </div>
</div>
<div>
    <label class="block font-medium text-zas-primary">Dirección</label>
    <input type="text" name="direction"
        value="{{ old('direction', $zassession->direction ?? 'Carrer de Piferrer 2, 111, 08016 Barcelona') }}"
        class="w-full mt-1 border-zas-primary border rounded-lg shadow-sm pl-2">
</div>

<div class="grid md:grid-cols-2 gap-4">
    <div>
        <label class="block font-medium text-zas-primary">Latitud</label>
        <input type="text" name="latitude"
            value="{{ old('latitude', $zassession->latitude ?? '41.43408800') }}"
            class="w-full mt-1 border-zas-primary border rounded-lg shadow-sm pl-2">
    </div>

    <div>
        <label class="block font-medium text-zas-primary">Longitud</label>
        <input type="text" name="longitude"
            value="{{ old('longitude', $zassession->longitude ?? '2.17922400') }}"
            class="w-full mt-1 border-zas-primary border rounded-lg shadow-sm pl-2">
    </div>
</div>