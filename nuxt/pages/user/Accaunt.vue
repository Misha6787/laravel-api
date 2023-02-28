<template>
  <section v-if="userStore.currentUser">
    <h1>Welcome home: {{ userStore.currentUser.user.name }}</h1>
  </section>
</template>

<script setup>
import auth from "~/middleware/Auth";

const userStore = useUserStore();

definePageMeta({
  middleware: auth
})
</script>

<style scoped>

</style>