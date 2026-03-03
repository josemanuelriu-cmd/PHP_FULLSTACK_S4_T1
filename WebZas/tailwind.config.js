import defaultTheme from 'tailwindcss/defaultTheme';
import forms from '@tailwindcss/forms';

/** @type {import('tailwindcss').Config} */
export default {
    content: [
        './vendor/laravel/framework/src/Illuminate/Pagination/resources/views/*.blade.php',
        './storage/framework/views/*.php',
        './resources/views/**/*.blade.php',
    ],

    theme: {
        extend: {
            fontFamily: {
                sans: ['Figtree', ...defaultTheme.fontFamily.sans],
            },
            colors: {
                // Colores ZAS
                /*
                'zas-primary': '#6C63FF',       // Azul violeta
                'zas-primaryHover': '#5a52d4',  // Azul violeta más oscuro al hover
                */
                'zas-primary': '#800020',       // Azul violeta
                'zas-primaryHover': '#66001a',  // Azul violeta más oscuro al hover
                'zas-borgona': '#6C63FF',       // Borgoña
                'zas-borgonaHover': '#5a52d4',  // Borgoña más oscuro al hover
                'zas-light': '#F5F5F5',         // Gris claro para fondos
                'zas-dark': '#1F1F1F',          // Gris oscuro para fondos / texto
                'zas-gray': '#9CA3AF',          // Gris neutro para texto secundario
            },
            borderRadius: {
                'xl': '1rem',
                '2xl': '1.5rem',
            },
            boxShadow: {
                'lg': '0 10px 15px -3px rgba(0,0,0,0.1), 0 4px 6px -4px rgba(0,0,0,0.1)',
                'xl': '0 20px 25px -5px rgba(0,0,0,0.1), 0 10px 10px -5px rgba(0,0,0,0.04)',
            },
            bordercolor: {
                'zas-primary': '#800020',       // Azul violeta
                'zas-primaryHover': '#66001a',  // Azul violeta más oscuro al hover
                //'zas-borgona': '#6C63FF',       // Borgoña
                //'zas-borgonaHover': '#5a52d4',  // Borgoña más oscuro al hover
            },
        },
    },

    plugins: [forms],
};
