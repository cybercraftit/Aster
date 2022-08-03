// import path from 'path'
import { defineConfig } from 'vite';
import laravel from 'laravel-vite-plugin';
import vue from '@vitejs/plugin-vue';
import Unocss from '@unocss/vite'

export default defineConfig({
    plugins: [
        Unocss({ /* options */ }),
        laravel({
            input: [
                /*'resources/sass/app.scss',
                'resources/js/app.js',*/
                'Aster/Admin/Resources/assets/sass/admin.scss',
                'Aster/Admin/Resources/assets/js/admin.js'
            ],
            refresh: true,
        }),
        vue({
            template: {
                transformAssetUrls: {
                    base: null,
                    includeAbsolute: false,
                },
            },
        }),
    ],
    resolve: {
        alias: {
            vue: 'vue/dist/vue.esm-bundler.js',
            //'~': path.resolve(__dirname, './src'), // used for resolving while building
        },
    },
});
