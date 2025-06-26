import { defineConfig } from 'vite';
import laravel from 'laravel-vite-plugin';
import tailwindcss from '@tailwindcss/vite';

export default defineConfig({
    plugins: [
        laravel({
            input: ['resources/css/app.css', 
                    'resources/js/app.js',
                    'resources/images/a-login.png',
                    'resources/images/Alogin.jpeg',
                    'resources/images/homepage.png',
                    'resources/images/icon.png',
                    'resources/images/logo.png',
            ],
            refresh: true,
        }),
        tailwindcss(),
    ],
    server:{
        allowedHosts: true,
        host: '127.0.0.1',
        watch:{
            usePolling: true
        },
        cors: true,
    },
    resolve: {
        alias: {
            '$': 'jQuery'
        },
    },
    build: {
        outDir: 'public/build', 
        emptyOutDir: true, 
        rollupOptions: {
            output: {               
                entryFileNames: `assets/[name]-[hash].js`,
                chunkFileNames: `assets/[name]-[hash].js`,
                assetFileNames: `assets/[name]-[hash].[ext]`
            }
        }
    }
});
