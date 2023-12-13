import { defineConfig } from 'vite';
import laravel from 'laravel-vite-plugin';

export default defineConfig({
    plugins: [
        laravel({
            input: [
                'public/assets/css/app.css',
                'public/assets/css/vendor.css',
                'public/assets/js/app.js',
                'public/assets/js/vendor.js',
            ],
            refresh: true,
        }),
    ],
});
