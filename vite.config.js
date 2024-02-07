import { defineConfig } from 'vite';
import laravel from 'laravel-vite-plugin';

export default defineConfig({
    plugins: [
        laravel({
            input: ['resources/js/app.js','resources/css/index.css','resources/css/cart.css','resources/css/signin.css'],
            refresh: true,
        }),
    ],
});
