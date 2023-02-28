export default defineNuxtRouteMiddleware((to, from) => {

    const userStore = useUserStore();
    if (!userStore.currentUser) {
        return navigateTo('/user/login')
    }
})