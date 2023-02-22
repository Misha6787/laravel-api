<template>
  <Navigation></Navigation>
  <div class="max-w-full">
    <div class="container">
      <Breadcrumbs></Breadcrumbs>
      <h1 class="dark:text-gray-50 text-3xl font-bold text-gray-900">{{ route.meta.title }}</h1>
<!--      <pre>-->
<!--        {{ route }}-->
<!--      </pre>-->
      <slot />
    </div>
  </div>
</template>

<script lang="ts" setup>
  import Breadcrumbs from "~/components/Breadcrumbs";
  import Navigation from "~/components/Navigation";

  useHead({
    bodyAttrs: {
      class: 'dark:text-gray-50 dark:bg-gray-900 bg-gray-50 max-w-full'
    },
  })

  const route = useRoute(); // рут с информацией со страницами
  const router = useRouter(); // Методы для работы с рутами

  // const getColor =  async () => await useAppConfig();
  // const appConfig = await getColor();
</script>

<style>
  .page-enter-active,
  .page-leave-active {
    transition: all 0.4s;
  }
  .page-enter-from,
  .page-leave-to {
    opacity: 0;
    filter: blur(1rem);
  }
</style>
