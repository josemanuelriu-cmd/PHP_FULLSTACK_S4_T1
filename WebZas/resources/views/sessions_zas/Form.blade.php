@php
    $session_zas = $session_zas ?? null;
@endphp

<div>
    <label class="block font-medium text-gray-700">Fecha</label>
    <input type="date" name="date"
        value="{{ old('date', $session_zas->date ?? '') }}"
        class="w-full mt-1 border-zas-primary border rounded-lg shadow-sm focus:ring-zas-primary focus:border-zas-primary pl-2">
    @error('date') <p class="text-red-500 text-sm">{{ $message }}</p> @enderror
</div>

<div class="grid md:grid-cols-2 gap-4">
    <div>
        <label class="block font-medium text-gray-700">Hora inicial</label>
        <input type="time" name="start_time"
            value="{{ old('start_time', $session_zas->start_time ?? '') }}"
            class="w-full mt-1 border-zas-primary border rounded-lg shadow-sm pl-2">
    </div>

    <div>
        <label class="block font-medium text-gray-700">Hora final</label>
        <input type="time" name="end_time"
            value="{{ old('end_time', $session_zas->end_time ?? '') }}"
            class="w-full mt-1 border-zas-primary border rounded-lg shadow-sm pl-2">
    </div>
    <div>
        <label class="block font-medium text-gray-700">Usuarios máximos</label>
        <input type="number" name="max_users"
            value="{{ old('max_users', $session_zas->max_users ?? '') }}"
            class="w-full mt-1 border-zas-primary border rounded-lg shadow-sm pl-2">
    </div>
</div>
<div>
    <label class="block font-medium text-gray-700">Dirección</label>
    <input type="text" name="direction"
        value="{{ old('direction', $session_zas->direction ?? '') }}"
        class="w-full mt-1 border-zas-primary border rounded-lg shadow-sm pl-2">
</div>

<div class="grid md:grid-cols-2 gap-4">
    <iframe src="https://maps.google.com/maps?q={{ old('latitude', $session_zas->latitude ?? '') }},{{ old('longitude', $session_zas->longitude ?? '') }}&z=ZOOM&output=embed"></iframe>
</div>
