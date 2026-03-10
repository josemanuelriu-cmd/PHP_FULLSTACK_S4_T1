@php
    $type = $type ?? null;
@endphp

<div>
    <label class="block font-medium text-gray-700">Nombre</label>
    <input type="text" name="type"
        value="{{ old('type', $type->type ?? '') }}"
        class="w-full mt-1 border-zas-primary border rounded-lg shadow-sm focus:ring-zas-primary focus:border-zas-primary pl-2">
    @error('type') <p class="text-red-500 text-sm">{{ $message }}</p> @enderror
</div>
<div>
    <label class="block font-medium text-gray-700">Descripción</label>
    <textarea name="description"
        class="w-full mt-1 border-zas-primary border rounded-lg shadow-sm focus:ring-zas-primary focus:border-zas-primary pl-2 resize-none">
        {{ old('type', $type->Description ?? '') }}
    </textarea>
    @error('description') <p class="text-red-500 text-sm">{{ $message }}</p> @enderror
</div>

