import { defineConfig } from 'vite';
import laravel from 'laravel-vite-plugin';
import purgecss from 'vite-plugin-purgecss'

export default defineConfig({
    plugins: [
        laravel({
            input: ['resources/css/app.css', 'resources/js/app.js', 'resources/js/home.js'],
            refresh: true,
        }),
        purgecss({
            content: [
                './resources/views/**/*.blade.php',
                './resources/views/**/*.blade.php',
                // './resources/css/*.css',
                './public/assets/js/**/*.js',
                './public/admin/js/pages/**/*.js',
            ],
            safelist: {
                standard: ['iti', 'iti__flag', 'iti--allow-dropdown', 'iti--separate-dial-code'],
                deep: [/^iti__flag/, /^iti--/], // Preserve all `iti__flag-xx` classes for country flags
            },
        }),
    ],
});
