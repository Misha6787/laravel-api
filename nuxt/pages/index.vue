<template>
  <p>Text</p>
</template>

<script setup lang="ts">
  import getTitle from "~/composables/getTitle";

  useHead({
    title: 'Main Page',
    meta: [
      { name: 'description', content: 'Main page' }
    ]
  })

  // definePageMeta({
  //   title: 'Главная',
  // });





</script>