<template>
  <nav aria-label="breadcrumb">
<!--    {{route.fullPath.split('/')}}-->
<!--    {{route.fullPath}}-->
<!--    <button @click="count++">+1</button>-->

<!--    {{metaNames2}}-->
<!--    {{metaNames.fullPath}}-->
<!--    {{router}}-->
<!--    <pre>{{router}}</pre>-->

    <ol class="flex p-3 border-default">
<!--      <li class="breadcrumbs__item"><NuxtLink to="/">Главная</NuxtLink></li>-->
      <li
          v-for="(item, index) in route.fullPath.split('/')"
          v-if="route.fullPath !== '/'"
          :key="`item${index}`"
          class="breadcrumbs__item"
          itemprop="itemListElement"
          itemscope
          itemtype="https://schema.org/ListItem"
      >
        <NuxtLink
            v-if="index < route.fullPath.length - 1"
            :to="'/' + item"
            :itemid="item"
            itemtype="https://schema.org/Thing"
            itemscope
            itemprop="item"
        >
          <span itemprop="name">{{ item ? item : 'Главная' }}</span>
        </NuxtLink>

        <span v-else itemprop="name">{{ item ? item : 'Главная' }}</span>

        <meta itemprop="position" :content="(index + 1).toString()" />
      </li>

      <li
          v-else
          class="breadcrumbs__item"
          itemprop="itemListElement"
          itemscope
          itemtype="https://schema.org/ListItem"
      >
        <NuxtLink
            to="/"
            itemid="/"
            itemtype="https://schema.org/Thing"
            itemscope
            itemprop="item"
        >
          <span itemprop="name">Главная</span>
        </NuxtLink>
      </li>

<!--      <li class="breadcrumbs__item"><NuxtLink to="/">Главная</NuxtLink></li>-->
<!--      <li class="breadcrumbs__item"><NuxtLink v-if="route.path !== '/' " :to='route.fullPath'>{{ route.meta.title }}</NuxtLink></li>-->
    </ol>
  </nav>
</template>

<script setup lang="ts">
  import { ref, reactive } from 'vue'

  const route = useRoute();
  const router = useRouter();

  // useAsyncData((context) => {
  //   console.log(context)
  //   return { name: 'World' }
  // })

  let metaNames = route;
  let metaNames2 = route.fullPath.split('/');

  // let pathUrl = reactive(),
  //     pathTitles = reactive();

  // const getData = (route) => {
  //   pathUrl = ref(route.fullPath);
  //   pathTitles = ref(['Главная']);
  //
  //   route.matched.forEach(item => pathTitles.value.push(item.name));
  // }



  // router.getRoutes().forEach((item) => {
    //metaNames.push({item.name: item.meta.title})
  // })
  // this.$forceUpdate();
  // const routeFullpath  = route.fullPath.split('/')
  // const routeFullpath = route.matched
  // console.log('routeFullpath', routeFullpath)

  // import { computed } from "vue";
  // const props = defineProps<{
  //   pathUrl: string;
  //   pathTitles: string[];
  // }>();

  // watch(() => route.query)



  // console.log(route.matched.forEach(item => item))
  // const props = {
  //   pathUrl,
  //   pathTitles
  // }

  // const urls = pathUrl.split("/");
  // urls[0] = "/";
  // const urlsFormatted = urls.map((url: string, i: number) => {
  //   if (i === 0) {
  //     return `${url}`;
  //   } else if (i === 1) {
  //     return `${urls[i - 1]}${url}`;
  //   } else if (i === 2) {
  //     return `${urls[i - 2]}${urls[i - 1]}/${url}`;
  //   } else {
  //     return `${urls[i - 3]}${urls[i - 2]}/${urls[i - 1]}/${url}`;
  //   }
  // });
  // const breadcrumbs = urlsFormatted.map(function (url: string, i: number) {
  //   return reactive({ url: url, title: titles[i] });
  // });
  // router.options.history.listen((item) => {
  //   console.log(item)
  // })
</script>

<style scoped>

</style>