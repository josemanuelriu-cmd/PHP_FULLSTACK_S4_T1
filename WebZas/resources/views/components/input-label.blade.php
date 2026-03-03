@props(['value'])

<label {{ $attributes->merge(['class' => 'block font-medium text-sm text-zas-primary']) }}>
    {{ $value ?? $slot }}
</label>
