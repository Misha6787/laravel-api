<template>
  <nav class="sticky top-0 bg-blue-400 z-20">
    <ul class="flex justify-end items-center container">
      <li class="menu__item"><NuxtLink to="/">Главная</NuxtLink></li>
      <li class="menu__item"><NuxtLink to="/about">О нас</NuxtLink></li>
      <li class="menu__item"><NuxtLink to="/posts/">Посты</NuxtLink></li>

      <li v-if="!userStore.currentUser" class="menu__item"><NuxtLink to="/user/login">Login</NuxtLink></li>
      <li v-if="!userStore.currentUser" class="menu__item"><NuxtLink to="/user/register">Register</NuxtLink></li>

      <li v-if="userStore.currentUser" class="dark:text-gray-50 text-xl text-gray-50 p-4 ml-4">
        <NuxtLink to="/user/accaunt">{{ userStore.currentUser.user.name }}</NuxtLink>
      </li>

      <li v-if="userStore.currentUser">
        <button class="menu__item rounded bg-emerald-400 p-2 hover:bg-red-600 transition-all" @click="logout">Выйти</button>
      </li>

      <span class="block p-4" @click="toggleColorTheme()">
        <svg xmlns="http://www.w3.org/2000/svg"
             class="hidden dark:block h-6 w-6 text-gray-50 hover:dark:text-yellow-400 hover:text-yellow-400"
             viewBox="0 0 20 20"
             fill="currentColor">
          <path d="M17.293 13.293A8 8 0 016.707 2.707a8.001 8.001 0 1010.586 10.586z" />
        </svg>
        <svg xmlns="http://www.w3.org/2000/svg"
             class="dark:hidden h-6 w-6 hover:dark:text-yellow-400 hover:text-yellow-400"
             viewBox="0 0 20 20" fill="currentColor ">
          <path fill-rule="evenodd"
                d="M10 2a1 1 0 011 1v1a1 1 0 11-2 0V3a1 1 0 011-1zm4 8a4 4 0 11-8 0 4 4 0 018 0zm-.464 4.95l.707.707a1 1 0 001.414-1.414l-.707-.707a1 1 0 00-1.414 1.414zm2.12-10.607a1 1 0 010 1.414l-.706.707a1 1 0 11-1.414-1.414l.707-.707a1 1 0 011.414 0zM17 11a1 1 0 100-2h-1a1 1 0 100 2h1zm-7 4a1 1 0 011 1v1a1 1 0 11-2 0v-1a1 1 0 011-1zM5.05 6.464A1 1 0 106.465 5.05l-.708-.707a1 1 0 00-1.414 1.414l.707.707zm1.414 8.486l-.707.707a1 1 0 01-1.414-1.414l.707-.707a1 1 0 011.414 1.414zM4 11a1 1 0 100-2H3a1 1 0 000 2h1z"
                clip-rule="evenodd" />
        </svg>
      </span>
    </ul>
  </nav>
</template>

<script setup>
  import axios from "axios";
  const config = useRuntimeConfig();
  const router = useRouter();

  const userStore = useUserStore();

  const logout = () => {
    axios.get(config.public.base + 'sanctum/csrf-cookie', {withCredentials: true})
      .then(res => {
        userStore.actionUserLogout()
          .then(mes => {
            useNuxtApp().$toast.success(
                mes, {
                  autoClose: 2000,
                }
            );
            router.push('/');
          })
          .catch(mes => {
            useNuxtApp().$toast.error(
                mes, {
                  autoClose: 2000,
                }
            );
          })
      })
  };

  const toggleColorTheme = () => {
    useColorMode().preference = useColorMode().preference === 'light' ? 'dark' : 'light';
  }
</script>

<style>

</style>
