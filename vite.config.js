import { defineConfig } from 'vite';
import laravel from 'laravel-vite-plugin';
import path from 'path';

export default defineConfig({
    plugins: [
        laravel({
            input: [
                'resources/css/sneat.css',
                'resources/js/sneat.js',
                'resources/css/member-style.css',
                'resources/sass/member-style-s.scss',
                'resources/js/member-script.js',
                'resources/sass/landing-style-s.scss',
                'resources/js/landing-script.js',
                'resources/css/template/default.css',
                'resources/js/template/default.js',
            ],
            refresh: true,
        }),
    ],
    resolve: {
        alias: {
            '~bootstrap': path.resolve(__dirname, 'node_modules/bootstrap'),
            '~boxicons': path.resolve(__dirname, 'node_modules/boxicons'),
            '~html2canvas': path.resolve(__dirname, 'node_modules/html2canvas'),
            '~owl-carousel': path.resolve(__dirname, 'node_modules/owl-carousel'),
            '~perfect-scrollbar': path.resolve(__dirname, 'node_modules/perfect-scrollbar'),
            '~sweetalert2': path.resolve(__dirname, 'node_modules/sweetalert2'),
            '~js-circle-progress': path.resolve(__dirname, 'node_modules/js-circle-progress'),
        }
    },
    optimizeDeps: {
        exclude: ['html2canvas']
    },
    // Suppress Dart Sass deprecation warnings dari Bootstrap 5.x
    css: {
        preprocessorOptions: {
            scss: {
                // Gunakan legacy API agar kompatibel dengan Bootstrap 5 @import
                api: 'legacy',
                // Suppress semua deprecation warnings
                silenceDeprecations: [
                    'import',
                    'global-builtin',
                    'color-functions',
                    'if-function',
                    'abs-percent',
                ],
                quietDeps: true,
            },
        },
    },
});
