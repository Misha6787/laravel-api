<template>
  <Navigation></Navigation>
  <div class="max-w-full">
    <div class="container">
      <Breadcrumbs></Breadcrumbs>
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
</script>
