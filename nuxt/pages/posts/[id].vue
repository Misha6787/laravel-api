<template>
  <h1>{{ $t('hello', { name: 'vue-i18n' }) }}</h1>
<!--  <h1 class="dark:text-gray-50 text-3xl font-bold text-gray-900">{{ post.title }}</h1>-->
  <div class="bg-blue-200 dark:bg-transparent dark:border-solid dark:border-blue-400 dark:border w-full rounded p-3 my-4">
    <h2 class="mb-2 text-2xl font-bold">{{ post.title }}</h2>
    <p class="">{{ post.body }}</p>
  </div>
</template>

<script setup lang="ts">
  const route = useRoute();

  const post = await fetch(`https://jsonplaceholder.typicode.com/posts/${route.params.id}`)
      .then((response) => response.json())

  const props = defineProps({
    foo: String
  });

  console.log(props);

  definePageMeta({
    // title: 'Пост'
    key: route => route.fullPath,
    title: 'Пост'
  });

</script>

<style scoped>

</style>