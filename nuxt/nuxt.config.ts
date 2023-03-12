// https://nuxt.com/docs/api/configuration/nuxt-config
// @ts-ignore
import * as process from "process";

export default defineNuxtConfig({
    // webpack: undefined,
    // Конфиги мета данных в head
    app: {
        head: {
            charset: 'utf-8',
            viewport: 'width=device-width, initial-scale=1',
            title: 'My Library',
            meta: [
                // <meta name="description" content="My amazing site">
                { name: 'description', content: 'My amazing site' }
            ]
        }
    },

    // Локальные переменные, или же конфиги
    runtimeConfig: {
        public: {
            base: process.env.BASE_URL,
            baseApi: process.env.API_BASE_URL,
            baseStorage: process.env.BASE_URL_STORAGE
        }
    },

    modules: [
        '@nuxtjs/tailwindcss',
        '@nuxtjs/color-mode',
        '@vueuse/nuxt',
        '@pinia/nuxt'
    ],

    imports: {
        dirs: ['./stores'],
    },

    // Конфиги pinia
    pinia: {
        // Передаваемые переменные, которые можно использовать в компонентах pinia
        autoImports: ['defineStore', 'acceptHMRUpdate'],
    },

    // Обьявление плагинов
    plugins: [
        '~/plugins/vue3-toastify',
    ],
    // Добавление стилей
    css: [
        'vuetify/lib/styles/main.sass',
        '@mdi/font/css/materialdesignicons.min.css',
    ],
    // Общая конфигурация сборки
    build: {
        transpile: ['vuetify'],
    },
    vite: {
        define: {
            'process.env.DEBUG': false,
        },
    },

    // Конфиги тем в @nuxtjs/color-mode
    colorMode: {
        // Удаляю приписку -mode
        classSuffix: ''
    },

    // конфиги tailwindcss
    tailwindcss: {
        cssPath: '~/assets/css/tailwind.css',
        configPath: 'tailwind.config.js',
        exposeConfig: false,
        injectPosition: 0,
        viewer: true
    }
})
