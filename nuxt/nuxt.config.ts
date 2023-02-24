// https://nuxt.com/docs/api/configuration/nuxt-config
// @ts-ignore
import * as process from "process";

export default defineNuxtConfig({
    webpack: undefined,
    theme: "",
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

    ssr: false,

    runtimeConfig: {
        public: {
            base: process.env.BASE_URL,
            baseApi: process.env.API_BASE_URL
        }
    },

    modules: [
        '@nuxtjs/tailwindcss',
        '@nuxtjs/color-mode',
        '@pinia/nuxt'
    ],

    imports: {
        dirs: ['./stores'],
    },

    pinia: {
        autoImports: ['defineStore', 'acceptHMRUpdate'],
    },

    tailwindcss: {
        cssPath: '~/assets/css/tailwind.css',
        configPath: 'tailwind.config.js',
        exposeConfig: false,
        injectPosition: 0,
        viewer: true
    }
})
