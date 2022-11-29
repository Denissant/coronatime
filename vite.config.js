import { defineConfig } from 'vite';
import laravel from 'laravel-vite-plugin';

export default defineConfig({
    plugins: [
        laravel({
            input: ['resources/css/app.css', 'resources/js/burger-menu.js', 'resources/js/input-validation.js'],
            refresh: true,
        }),
    ],
});
