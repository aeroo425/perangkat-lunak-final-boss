import { defineConfig } from 'vite';
import laravel from 'laravel-vite-plugin';
import path from 'path' // Tambahkan ini

export default defineConfig({
    plugins: [
        laravel({
            input: [
                'resources/css/app.css',
                'resources/js/app.js',
            ],
            refresh: true,
        }),
    ],
    // Tambahkan bagian resolve untuk alias Bootstrap
    resolve: {
        alias: {
            '~bootstrap': path.resolve(__dirname, 'node_modules/bootstrap'),
        }
    },
});
