<template>
  <div class="flex min-h-full items-center justify-center py-12 px-4 sm:px-6 lg:px-8">
    <div class="w-full max-w-md space-y-8">
      <div>
        <!--        <img class="mx-auto h-12 w-auto" src="https://tailwindui.com/img/logos/mark.svg?color=indigo&shade=600" alt="Your Company" />-->
        <h2 class="mt-6 text-center text-3xl font-bold tracking-tight">Войти в аккаунт</h2>
        <!--        <p class="mt-2 text-center text-sm text-gray-600">-->
        <!--          Or-->
        <!--          {{ ' ' }}-->
        <!--          <a href="#" class="font-medium text-indigo-600 hover:text-indigo-500">start your 14-day free trial</a>-->
        <!--        </p>-->
      </div>
      <form id="loginForm" class="mt-8 space-y-6" @submit.prevent="submitHandler">
        <input type="hidden" name="remember" value="true" />
        <div class="-space-y-px rounded-md shadow-sm">
          <div>
            <label for="email-address" class="sr-only">Электронная почта</label>
            <input id="email-address"
                   name="email"
                   type="email"
                   autocomplete="email"
                   required
                   class="form__item rounded-t"
                   placeholder="Email"
                   v-model.trim="inputEmail" />
          </div>
          <div>
            <label for="password" class="sr-only">Пароль</label>
            <input id="password"
                   name="password"
                   type="password"
                   autocomplete="current-password"
                   required
                   class="form__item rounded-b"
                   placeholder="Пароль"
                   v-model.trim="inputPassword" />
          </div>
        </div>

        <div class="flex items-center justify-between">
          <div class="flex items-center">
            <input id="remember-me"
                   name="remember-me"
                   type="checkbox"
                   required
                   class="h-4 w-4 rounded border-gray-300 text-blue-400 focus:ring-blue-400" />
            <label for="remember-me" class="ml-2 block text-sm">Запомнить меня</label>
          </div>

          <div class="text-sm">
            <a href="#" class="font-medium text-blue-500 hover:text-blue-400">Забыли пароль?</a>
          </div>
        </div>

        <div>
          <button type="submit" @click.prevent="submitHandler"
                  class="group relative flex w-full justify-center rounded-md border border-transparent bg-blue-400 py-2 px-4 text-sm font-medium text-white hover:bg-blue-500 focus:outline-none focus:ring-1 focus:ring--blue-400">
            <span class="absolute inset-y-0 left-0 flex items-center pl-3">
              <svg class="h-5 w-5 text-blue-300 group-hover:text--blue-400" viewBox="0 0 20 20" fill="currentColor" aria-hidden="true">
              <path fill-rule="evenodd" d="M10 1a4.5 4.5 0 00-4.5 4.5V9H5a2 2 0 00-2 2v6a2 2 0 002 2h10a2 2 0 002-2v-6a2 2 0 00-2-2h-.5V5.5A4.5 4.5 0 0010 1zm3 8V5.5a3 3 0 10-6 0V9h6z" clip-rule="evenodd" />
            </svg>
            </span>
            Войти
          </button>
        </div>
      </form>
    </div>
  </div>

<!--  <button @click="test">Test</button>-->
</template>

<script setup>

import axios from "axios";
const config = useRuntimeConfig();

let inputEmail = ref();
let inputPassword = ref();

const router = useRouter()
const userStore = useUserStore();

// function test () {
//   axios.get('http://laravel-nuxt/api/v1/user').then(res => console.log(res));
// }

async function submitHandler () {
  let data = {
    email: inputEmail.value,
    password: inputPassword.value
  };

  // Тестовый аккаунт
  // email: 'test2@gail.ee',
  // password: '123456'

  axios.get(config.public.base + 'sanctum/csrf-cookie', {withCredentials: true})
      .then(res => {
        userStore.actionUserLogin(data)
            .then(mes => {
              useNuxtApp().$toast.success(
                  mes, {
                  autoClose: 2000,
                }
              );
              router.push('/');
            })
      });

  // axios.post(config.public.baseApi + 'login',
  //     data,
  //     {
  //       headers: {
  //         'Content-Type': 'application/json',
  //         'Accept': 'application/json',
  //       }
  //     }
  // )
  //     .then(responce => {
  //       console.log(responce)
  //       useNuxtApp().$toast.success(
  //           'Пользователь авторизирован', {
  //             autoClose: 2000,
  //           });
  //     })
  //     .catch(responce => {
  //       console.log(responce)
  //       useNuxtApp().$toast.error(
  //           'Неверено веденны данные', {
  //             autoClose: 2000,
  //           });
  //     });


  // try {
  //   await $sanctumAuth.login(
  //       {
  //         email: 'test2@gail.ee',
  //         password: '123456'
  //       },
  //       // optional callback function
  //       (data) => {
  //         console.log(data)
  //         // router.push('/')
  //       }
  //   )
  // } catch (e) {
  //   // your error handling
  //   errors.value = e.errors
  // }

  // console.log(document.cookie);

}

const submitHandler2 = async () => {
  let data = JSON.stringify({
    'email': inputEmail.value,
    'password': inputPassword.value
  });

  axios.post(config.API_BASE_URL + 'login',
      data,
      {
        headers: {
          'Content-Type': 'application/json',
          'Accept': 'application/json',
        }
      }
  )
      .then(responce => {
        useNuxtApp().$toast.success(
            'Пользователь авторизирован', {
              autoClose: 2000,
            });
      })
      .catch(responce => {
        useNuxtApp().$toast.error(
            'Неверено веденны данные', {
              autoClose: 2000,
            });
      });

}


// export default {
//   name: "login"
// }
</script>

<style scoped>

</style>