<template>
  <section v-if="userStore.currentUser">
    <h1>Welcome home: <i>{{ userStore.currentUser.user.name }}</i></h1>
    <div class="flex justify-around py-6">
      <img :src="config.public.baseStorage + userStore.currentUser.user.avatar"
           style="max-width: 256px"
           alt="avatar">


      <input type="file" @change='upload_avatar' name="avatar">

      <img :src="avatar.value" class="avatar" v-bind:style="styleObject" alt="avatar2"/>

      <ul class="flex flex-col">
        <li class="acc__item">Имя:
          <span>{{ userStore.currentUser.user.name }}</span>
        </li>
        <li class="acc__item">Почта
          <span>{{ userStore.currentUser.user.email }}</span>
        </li>
        <li class="acc__item">Изменить пароль:
          <input type="text">
        </li>
        <li class="acc__item">Подтвердить пароль:
          <input type="text">
        </li>
      </ul>
    </div>
    avatar - {{avatar.value}}
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

  let avatar = ref('');

  let styleObject = {
    width: '160px',
    height: '160px'
  }

  onBeforeMount(() => {
    avatar.value = config.public.baseStorage + userStore.currentUser.user.avatar;
  })

  console.log(avatar.value)

  const upload_avatar = (e) =>{
    let file = e.target.files[0];
    let reader = new FileReader();

    if(file['size'] < 2111775) {
      reader.onloadend = (file) => {
        avatar.value = reader.result;
      }
      reader.readAsDataURL(file);
    }
  };
  // const get_avatar = () => {
  //
  // }
  // get_avatar()

  // console.log(avatar.value.length)
  //avatar.value = avatar.value
  // if (avatar.value.length > 100) {
  //   avatar = avatar.value
  // }
</script>

<style scoped>

</style>