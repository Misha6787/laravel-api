# Документация

### Особенности
- Такая же как во vue 3 за исключением middleware, composables, utils и server (попозже распищу про них поподробнее)
- Есть файл [nuxt.config.js](nuxt.config.js) в нем находится конфигурация nuxt'a и по сути всего проекта, потому что в нем подключаются все стили, модули, и делается конфигурация сайта
- В nuxt пути прописываются в отдельном файле конфигураций [router.options.ts](router.options.ts) во vue 3 это делалось в отдельной папке в js файле, на ряду с папками page, components и тд. Синтаксис по сути не изменился, только есть различия из того что файл теперь в формате ts



# Nuxt 3 Minimal Starter

Look at the [nuxt 3 documentation](https://v3.nuxtjs.org) to learn more.

## Setup

Make sure to install the dependencies:

```bash
# yarn
yarn install

# npm
npm install

# pnpm
pnpm install --shamefully-hoist
```

## Development Server

Start the development server on http://localhost:3000

```bash
npm run dev
```

## Production

Build the application for production:

```bash
npm run build
```

Locally preview production build:

```bash
npm run preview
```

Checkout the [deployment documentation](https://v3.nuxtjs.org/guide/deploy/presets) for more information.
