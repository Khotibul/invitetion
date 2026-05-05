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
            '~bootstrap':         path.resolve(__dirname, 'node_modules/bootstrap'),
            '~boxicons':          path.resolve(__dirname, 'node_modules/boxicons'),
            '~html2canvas':       path.resolve(__dirname, 'node_modules/html2canvas'),
            '~owl-carousel':      path.resolve(__dirname, 'node_modules/owl-carousel'),
            '~perfect-scrollbar': path.resolve(__dirname, 'node_modules/perfect-scrollbar'),
            '~sweetalert2':       path.resolve(__dirname, 'node_modules/sweetalert2'),
            '~js-circle-progress':path.resolve(__dirname, 'node_modules/js-circle-progress'),
        },
    },

    optimizeDeps: {
        exclude: ['html2canvas'],
    },

    build: {
        // Minify dengan esbuild (lebih cepat dari terser)
        minify: 'esbuild',
        // Chunk size warning threshold
        chunkSizeWarningLimit: 1000,
        rollupOptions: {
            output: {
                // Manual chunk splitting untuk vendor libraries
                manualChunks(id) {
                    if (id.includes('node_modules/sweetalert2')) return 'vendor-swal';
                    if (id.includes('node_modules/jquery'))       return 'vendor-jquery';
                    if (id.includes('node_modules/bootstrap'))    return 'vendor-bootstrap';
                },
                // Asset file naming dengan hash untuk cache busting
                assetFileNames: 'assets/[name]-[hash][extname]',
                chunkFileNames: 'assets/[name]-[hash].js',
                entryFileNames: 'assets/[name]-[hash].js',
            },
        },
        // CSS code splitting
        cssCodeSplit: true,
        // Source maps hanya di dev
        sourcemap: false,
    },

    // Suppress Dart Sass deprecation warnings dari Bootstrap 5.x
    css: {
        preprocessorOptions: {
            scss: {
                api: 'legacy',
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
