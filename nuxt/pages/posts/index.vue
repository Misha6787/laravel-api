<template>
<!--  <NuxtPage></NuxtPage>-->
  <h1>Каталог постов</h1>
  <section class="flex justify-between flex-wrap">
    <article class="basis-1/3 p-3 hover:dark:text-gray-900 cursor-pointer rounded hover:bg-blue-100 transition" v-for="post in posts" @click.prevent="router.push(`/posts/${post.id}`)">
      <h3 class="mb-2 text-xl font-bold">{{ post.title }}</h3>
      <p>{{ post.body }}</p>
    </article>
  </section>


</template>

<script setup lang="ts">

definePageMeta({
  title: 'Посты'
});


// https://jsonplaceholder.typicode.com/posts/1

// const postData = await useFetch('https://jsonplaceholder.typicode.com/posts')

const posts = await fetch('https://jsonplaceholder.typicode.com/posts?_limit=12')
    .then((response) => response.json())
    // .then((json) => console.log(json));

// console.log('posts', posts)
const route = useRoute()
const router = useRouter()

</script>

<style scoped>

</style>