<template>
  <section v-if="userStore.currentUser">
      <h1>Welcome home: <i>{{ userStore.currentUser.user.name }}</i></h1>
      <div class="flex py-6">
        <div class="avatar-editeble ml-auto relative avatar-wrapper overflow-hidden w-46 h-46 rounded-full mr-8">
          <img :src="avatar" class="w-full h-full object-contain" alt="avatar">
          <label
              class="absolute transition-all flex items-center justify-center h-2/6 w-full bg-gray-800 bg-opacity-10 backdrop-blur-sm px-8 text-gray-300 text-center text-base"
              :class="editAcc ? 'avatar-input' : '' "
              for="avatar-input"
          >
            Изменить изображение
          </label>
          <input
              id="avatar-input"
              type="file"
              @change="upload_avatar"
              name="avatar"
              hidden
          />
        </div>

        <ul class="flex flex-col w-2/3 justify-center">
          <li class="acc__item">Логин:
            <span v-if="!editAcc" class="pl-2">{{ data.username }}</span>
            <input
                type="text"
                id="username"
                name="username"
                v-model="data.username"
                v-if="editAcc"
                class="border-solid border-b-2 pl-2"
                :class="{
              'border-red-500 focus:border-red-500': v$.username.$error && editAcc,
              'border-[#42d392] ': !v$.username.$invalid && editAcc,
            }"
                @change="v$.username.$touch"
                :disabled="!editAcc"
            >
            <v-icon
                v-if="editAcc"
                class="pb-2 pl-2"
                size="x-small"
                icon="mdi-pencil"
            ></v-icon>
          </li>
          <li class="acc__item">Почта
            <span v-if="!editAcc" class="pl-2">{{ data.email }}</span>
            <input
                type="email"
                id="email"
                name="email"
                v-model="data.email"
                v-if="editAcc"
                class="border-solid border-b-2 pl-2"
                :class="{
              'border-red-500 focus:border-red-500': v$.email.$error && editAcc,
              'border-[#42d392] ': !v$.email.$invalid && editAcc,
            }"
                @change="v$.email.$touch"
                :disabled="!editAcc"
            >
            <v-icon
                v-if="editAcc"
                class="pb-2 pl-2"
                size="x-small"
                icon="mdi-pencil"
            ></v-icon>
          </li>
          <li class="acc__item" :style="{opacity: editAcc ? 1 : 0}">Старый пароль:
            <input
                type="password"
                id="oldPassword"
                name="oldPassword"
                v-model="data.oldPassword"
                v-if="editAcc"
                class="border-solid border-b-2 pl-2"
                :class="{
              'border-red-500 focus:border-red-500': v$.oldPassword.$error && editAcc,
              'border-[#42d392] ': !v$.oldPassword.$invalid && editAcc,
            }"
                @change="v$.oldPassword.$touch"
                :disabled="!editAcc"
            >
            <v-icon
                v-if="editAcc"
                class="pb-2 pl-2"
                size="x-small"
                icon="mdi-pencil"
            ></v-icon>
          </li>
          <li class="acc__item" :style="{opacity: editAcc ? 1 : 0}">Новый пароль:
            <input
                type="password"
                id="newPassword"
                name="newPassword"
                v-model="data.newPassword"
                v-if="editAcc"
                class="border-solid border-b-2 pl-2"
                :class="{
              'border-red-500 focus:border-red-500': v$.newPassword.$error && editAcc,
              'border-[#42d392] ': !v$.newPassword.$invalid && editAcc,
            }"
                @change="v$.newPassword.$touch"
                :disabled="!editAcc"
            >
            <v-icon
                v-if="editAcc"
                class="pb-2 pl-2"
                size="x-small"
                icon="mdi-pencil"
            ></v-icon>
          </li>
        </ul>
      </div>

      <!-- Кнопка сохранения и изменения контента -->
      <div class="text-center">
        <v-btn
            prepend-icon="mdi-account-edit"
            class="mx-auto"
            color="info"
            v-if="!editAcc"
            @click="editAcc = true"
        >
          Изменить аккаунт
        </v-btn>
        <v-btn
            prepend-icon="mdi-account-check"
            class="mx-auto"
            color="success"
            v-if="editAcc"
            @click.prevent="submitForm"
        >
          Сохранить изменения
        </v-btn>
      </div>

    </section>
</template>

<!-- Отправлять по API изображение в Laravel, временно сохранять в storage, и отдавать url на фронт -->
<!-- Изображение будет грузиться и показываться пользователю, но сразу отправляться на базу не будет, только после нажатия на кнопку сохранения -->

<script setup>
  import auth from "~/middleware/Auth";
  import { required, email, sameAs, minLength, requiredIf, helpers } from '@vuelidate/validators';
  import { useVuelidate } from '@vuelidate/core';
  import axios from "axios";

  const config = useRuntimeConfig();
  const editAcc = ref(false);
  const userStore = useUserStore();
  const router = useRouter();

  // Аунтефикация пользователя через модуль auth
  definePageMeta({
    middleware: auth
  })

  // Обьявление аватарки
  let avatar = ref();

  // Изменяем переменную avatar до загрузки содержимого страницы
  onMounted(() => {
    avatar.value = config.public.baseStorage + userStore.currentUser.user.avatar;
  })

  // Обьект с данными для форм и валидаций
  const data = reactive({
    username: userStore.currentUser.user.name,
    email: userStore.currentUser.user.email,
    oldPassword: '',
    newPassword: '',
  });

  // Описание правил валилаций
  const rules = computed(() => {
    return {
      username: {
        minLength: helpers.withMessage('Минимум 6 символов', minLength(6))
      },
      email: {
        email: helpers.withMessage('Введите корректную почту', email),
      },
      oldPassword: {
        minLength: helpers.withMessage('Минимум 6 символов', minLength(6)),
        requiredIfRef: helpers.withMessage('Впишите новый пароль', requiredIf(data.newPassword !== ''))
      },
      newPassword: {
        minLength: helpers.withMessage('Минимум 6 символов', minLength(6)),
        requiredIfRef: helpers.withMessage('Впишите текущий пароль', requiredIf(data.oldPassword !== ''))
      },
    };
  });

  // Инициализация валидаций
  const v$ = useVuelidate(rules, data);

  // Отправка формы и ее валидация
  const submitForm = () => {
    v$.value.$validate();

    if (v$.value.$error) {
      useNuxtApp().$toast.error(
          'Неккоректные данные', {
            autoClose: 2000,
          }
      );
      return;
    }

    axios.get(config.public.base + 'sanctum/csrf-cookie', {withCredentials: true})
        .then(res => {
          userStore.actionUserEdit(data)
              .then(mes => {
                useNuxtApp().$toast.success(
                    'Профиль успешно изменен', {
                      autoClose: 2000,
                    }
                );
                editAcc.value = false;
              })
              .catch(mes => {
                console.log(mes);
                // useNuxtApp().$toast.error(
                //     'Ошибка, такого пользователя не существует', {
                //       autoClose: 2000,
                //     }
                // );
                // router.push('/user/register');
              })
        });
  };

  // Загрузка фото со стороны клиента и создание превьюшки
  const upload_avatar = (e) => {
    let file = e.target.files[0];
    let reader = new FileReader();

    if(file['size'] < 2111775) {
      reader.onloadend = (file) => {
        avatar.value = reader.result;
      }
      reader.readAsDataURL(file);
    }
  };
</script>

<style scoped>
  .avatar-input {
    bottom: -33.3%;
  }

  .avatar-editeble:hover .avatar-input {
    bottom: 0;
  }
</style>