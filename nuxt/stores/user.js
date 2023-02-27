import { defineStore } from 'pinia';
import axios from "axios";
import * as process from "process";

const useUserStore = defineStore('user', {

    state(){
        return {
            currentUser: useCookie('user') != null ? useCookie('user') : null,
            users: [],
        }
    },
    getters:{
        getCurrentUser(state){
            return state.currentUser;
        },
    },
    actions:{
        async actionUserLogin(data){
            return await new Promise((resolve, reject) => {
                axios
                    .post(useRuntimeConfig().public.baseApi + 'login', data)
                        .then((response) => {
                            let date_end = new Date();
                            let item = response.data;
                            item.date_end = date_end.setSeconds(date_end.getSeconds() + Number(item.expires_in));

                            const userCookie = useCookie('user');
                            userCookie.value = JSON.stringify(item);

                            this.currentUser = item
                            resolve('notify.success.login');
                        })
                        .catch((error) => {
                            const userCookie = useCookie('user');
                            userCookie.value = null;

                            // this.error = error;
                            this.currentUser = null;
                            reject('notify.error.login');
                        });
            });
        },
        async actionUserRegister(data){
            return await new Promise((resolve, reject) => {
                axios
                    .post(useRuntimeConfig().public.baseApi + 'register', data)
                    .then((response) => {
                        // let date_end = new Date();
                        let item = response.data;
                        // item.date_end = date_end.setSeconds(date_end.getSeconds() + Number(item.expires_in));

                        const userCookie = useCookie('user');
                        userCookie.value = JSON.stringify(item);

                        this.currentUser = item
                        resolve('notify.success.register');
                    })
                    .catch((error) => {
                        const userCookie = useCookie('user');
                        userCookie.value = null;

                        // this.error = error;
                        this.currentUser = null;
                        reject('notify.error.register');
                    });
            });
        },
        async actionUserLogout(){
            return await new Promise((resolve, reject) => {
                axios
                    .post(useRuntimeConfig().public.baseApi + 'logout', {}, {
                        headers: {
                            'Accept': 'application/json',
                            'Authorization': `${this.getCurrentUser.token_type} ${this.getCurrentUser.token}`
                        }
                    })
                    .then((res) => {
                        const userCookie = useCookie('user');
                        userCookie.value = null;

                        this.currentUser = null;

                        resolve('notify.success.logout');
                    })
                    .catch(error => {
                        reject('notify.error.logout');
                    });
            });
        },
        // async actionGetUsers(){
        //     return await new Promise(() => {
        //         axios
        //             .get(process.env.API_BASE_URL + '/user/list', {
        //                 headers: {
        //                     //'Content-Type': 'application/x-www-form-urlencoded',
        //                     'Accept': 'application/json',
        //                     'Authorization': `${this.getCurrentUser.token_type} ${this.getCurrentUser.token}`
        //                 }
        //             })
        //             .then((response) => {
        //                 this.users = response.data.data
        //             })
        //             .catch((error) => {
        //                 console.log(error)
        //             });
        //     });
        // },
    },

})
export {useUserStore};
