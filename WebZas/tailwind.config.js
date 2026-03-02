/** @type {import('tailwindcss').Config} */
module.exports = {
    content: [
        "./resources/**/*.blade.php",
        "./resources/**/*.js",
        "./resources/**/*.vue",
    ],
    theme: {
        extend: {
            colors: {
                zas: {
                    primary: '#6B0F1A',
                    primaryHover: '#8E1B2E',
                    dark: '#111111',
                    darkSoft: '#1f1f1f',
                }
            }
        },
    },
    plugins: [],
}