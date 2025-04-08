import { defineConfig } from 'vite';
import laravel from 'laravel-vite-plugin';
import purgecss from 'vite-plugin-purgecss'

export default defineConfig({
    plugins: [
        laravel({
            input: [
                'resources/css/app.css', 
                'resources/css/swiper-bundle.min.css', 
                'resources/css/bootstrap.min.css', 
                'resources/css/themify-icons.css', 
                'resources/css/owl.carousel.min.css', 
                'resources/css/owl.theme.default.min.css', 
                'resources/css/intlTelInput.css', 
                'resources/css/iziToast.min.css', 
                'resources/css/image-previewer.css', 
            ],
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
            defaultExtractor: (content) => content.match(/[\w-/.:]+(?<!:)/g) || [],
            safelist: {
                standard: ['iti', 'iti__flag', 'iti--allow-dropdown', 'iti--separate-dial-code'],
                deep: [/^iti__flag/, /^iti--/], // Preserve all `iti__flag-xx` classes for country flags
            },
        }),
    ],
});
