/** @type {import('tailwindcss').Config} */
module.exports = {
    content: [
        "./resources/**/*.blade.php",
        "./resources/**/*.js"
    ],
    theme: {
        fontFamily: {
            sans: 'Inter'
        },
        extend: {
            colors: {
                'brand-black': '#010414',
                'brand-lightgreen': '#0FBA68',
                'brand-green': '#249E2C',
                'brand-darkgreen': '#078E4A',
                'brand-gray': '#808189',
                'brand-light': '#E6E6E7',
                'brand-blue': '#2029F3',
                'brand-lightblue': '#DBE8FB',
                'brand-red': '#CC1E1E'
            },
            spacing: {
                '5.5': '1.125rem'
            },
            outlineWidth: {
                3: '3px',
            }
        },
    },
    plugins: [
        require('@tailwindcss/forms'),
    ],
}
