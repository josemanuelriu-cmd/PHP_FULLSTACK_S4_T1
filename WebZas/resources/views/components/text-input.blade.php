@props(['disabled' => false])

<input @disabled($disabled) {{ $attributes->merge(['class' => 'border-zas-primary focus:border-zas-primary focus:ring-zas-primary focus:border-zas-primaryhover rounded-md shadow-sm']) }}>
