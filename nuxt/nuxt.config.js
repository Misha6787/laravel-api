// https://v3.nuxtjs.org/api/configuration/nuxt.config



export default {
    routeRules: undefined,

    publicRuntimeConfig: {
        API_BASE_URL: process.env.API_BASE_URL
    },

    // dev: process.env.NODE_ENV !== 'production',
    modules: ['@nuxtjs/tailwindcss', '@nuxtjs/color-mode', '@nuxtjs/router-extras'],

    build: {
        transpile: ["class-validator"]
    },
    vite: {
        optimizeDeps: {
            exclude: ['class-validator']
        }
    },

    app: {
        pageTransition: { name: 'page' },
        layoutTransition: { name: 'layout' },
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

    css: [
        '~/assets/css/custom.css',
        '~/assets/css/tailwind.css'
    ],
    tailwindcss: {
        cssPath: '~/assets/css/tailwind.css',
        configPath: 'tailwind.config.js',
        exposeConfig: false,
        injectPosition: 0,
        viewer: true
    },
    colorMode: {
        classSuffix: ''
    },

    // router: {
    //     extendRoutes(routes, resolve) {
    //         routes.push(
    //             {
    //                 name: 'home',
    //                 path: '/',
    //                 // component: () => import('~/pages/index'),
    //                 component: resolve(__dirname, '~/pages/index')
    //             },
    //             {
    //                 name: 'about',
    //                 path: '/about',
    //                 component: () => import('~/pages/about'),
    //                 meta: {
    //                     title: 'test',
    //                     breadCrumb: 'Главная'
    //                 }
    //             },
    //             {
    //                 name: 'posts',
    //                 path: '/posts',
    //                 component: () => import('~/pages/posts/posts'),
    //                 breadCrumb: 'Посты',
    //                 children: [
    //                     {
    //                         path: '/posts/[id]',
    //                         component: () => import('~/pages/[id]'),
    //                         props: true,
    //                         meta: {
    //                             breadCrumb: 'Главная'
    //                         }
    //                     }
    //                 ]
    //             })
    //     }
    // }
}
