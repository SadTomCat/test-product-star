/** @type {import('tailwindcss').Config} */
module.exports = {
    purge: [
        './resources/views/**/*.blade.php',
        './resources/js/**/*.vue',
    ],
    content: [],
    theme: {
        container: {
            padding: '2rem',
        },
        extend: {},
    },
    plugins: [],
}
