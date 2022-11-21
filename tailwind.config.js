/** @type {import('tailwindcss').Config} */
module.exports = {
    content: [
        "./resources/**/*.blade.php",
        "./resources/**/*.js"
    ],
    theme: {},
    plugins: [
        require('@tailwindcss/forms'),
    ],
}
