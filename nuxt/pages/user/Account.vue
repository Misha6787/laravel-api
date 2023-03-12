<template>
  <section v-if="userStore.currentUser">
    <h1>Welcome home: <i>{{ userStore.currentUser.user.name }}</i></h1>
    <div class="flex py-6">
      <div class="avatar-editeble ml-auto relative avatar-wrapper overflow-hidden w-56 h-56 rounded-full mr-8">
        <img :src="avatar" class="w-full h-full" alt="avatar">
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

      <ul class="flex flex-col w-50 justify-center">
        <li class="acc__item">Имя:
          <span :contenteditable="editAcc">{{ userStore.currentUser.user.name }}</span>
          <v-icon
                v-if="editAcc"
                class="pb-2 pl-2"
                size="x-small"
                icon="mdi-pencil"
            ></v-icon>
        </li>
        <li class="acc__item">Почта
          <span :contenteditable="editAcc">{{ userStore.currentUser.user.email }}</span>
          <v-icon
                v-if="editAcc"
                class="pb-2 pl-2"
                size="x-small"
                icon="mdi-pencil"
            ></v-icon>
        </li>
        <li class="acc__item" v-if="editAcc">Изменить пароль:
          <input type="text">
        </li>
        <li class="acc__item" v-if="editAcc">Подтвердить пароль:
          <input type="text">
        </li>
      </ul>
    </div>

    <!-- buttons edit and save acc -->
    <button
        v-if="!editAcc"
        class="acc__btn"
        @click="editAcc = true"
    >
      Изменить аккаунт
    </button>
    <button
        v-if="editAcc"
        class="acc__btn"
        @click="editAcc = false"
    >
      Сохранить изменения
    </button>
  </section>
</template>

<!-- Отправлять по API изображение в Laravel, временно сохранять в storage, и отдавать url на фронт -->
<!-- Изображение будет грузиться и показываться пользователю, но сразу отправляться на базу не будет, только после нажатия на кнопку сохранения -->

<script setup>
  import auth from "~/middleware/Auth";

  const config = useRuntimeConfig();
  const editAcc = ref(false);
  const userStore = useUserStore();

  definePageMeta({
    middleware: auth
  })

  let avatar = ref();

  onMounted(() => {
    avatar.value = config.public.baseStorage + userStore.currentUser.user.avatar;
  })

  const upload_avatar = (e) => {
    console.log('tertr')
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