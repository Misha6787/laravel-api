<template>
  Переход на админ страницу...
</template>

<script setup>
  window.location.href = useRuntimeConfig().public.base + 'admin';
  // const router = useRouter();
  // router.resolve(useRuntimeConfig().public.base + 'admin')
</script>

<style scoped>

</style>