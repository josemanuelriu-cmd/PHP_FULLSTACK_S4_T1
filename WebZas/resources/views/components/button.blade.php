<button {{ $attributes->merge([
    'class' => 'inline-flex items-center px-4 py-2 bg-zas-primary border border-transparent rounded-md font-semibold text-white hover:bg-zas-primaryHover focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-zas-primary'
]) }}>
    {{ $slot }}
</button>