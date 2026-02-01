import { defineConfig } from 'vite';
import tailwindcss from '@tailwindcss/vite';
import { ViteImageOptimizer } from 'vite-plugin-image-optimizer';

import path from 'path';

export default defineConfig({
    root: path.resolve(__dirname, 'assets/src'),

    // base: '/',

    plugins: [
        tailwindcss(),

        process.env.NODE_ENV === 'production' &&
        ViteImageOptimizer({
            jpg: {
                quality: 40,
            },
            jpeg: {
                quality: 40,
            },
            png: {
                quality: 40,
            },
            webp: {
                quality: 40,
            },
            avif: {
                quality: 60,
            },
        }),
    ],

    build: {
        outDir: path.resolve(__dirname, './assets/dist'),
        emptyOutDir: true,
        manifest: true,

        rollupOptions: {
            input: path.resolve(__dirname, 'assets/src/js/main.js'),
            output: {
                entryFileNames: 'main.[hash].js',

                assetFileNames: ({ name }) => {
                    const ext = name.split('.').pop();

                    if (/png|jpe?g|webp|avif|svg/.test(ext)) {
                        return 'img/[name].[ext]';
                    }

                    if (/\.(ttf|otf)$/.test(name ?? '')) {
                        return 'fonts/[name].[ext]';
                    }

                    if (/css/.test(ext)) {
                        return 'style.[hash].css';
                    }

                    return '[name].[hash].[ext]';
                },
                
            },
        },
    },

    server: {
        // host: true,
        host: '0.0.0.0',

        port: 5173,
        strictPort: true,

        hmr: {
            host: 'localhost',
            port: 5173,
            protocol: 'ws',
        },

        watch: {
            usePolling: true // required on Windows + Docker
        }
    }
});
