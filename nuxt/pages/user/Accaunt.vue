<template>
  <section v-if="userStore.currentUser">
    <h1>Welcome home: {{ userStore.currentUser.user.name }}</h1>
    <img :src="config.public.baseStorage + userStore.currentUser.user.avatar"
         class="  "
         alt="avatar">
  </section>
</template>

<script setup>
import auth from "~/middleware/Auth";
const config = useRuntimeConfig()

const userStore = useUserStore();

definePageMeta({
  middleware: auth
})
</script>

<style scoped>

</style>