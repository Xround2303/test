import {defineConfig} from 'vite';
import laravel from 'laravel-vite-plugin';
import vue from '@vitejs/plugin-vue'

export default defineConfig(({ mode }) => {
    return {
        plugins: [
            vue(),
            laravel([
                'resources/js/index.js'
            ]),
        ],
        server: {
            host: '0.0.0.0',
            hmr: {
                host: "localhost"
            },
            port: 3000,
            open: false,
        }
    }
});
