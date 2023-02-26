import { defineStore } from 'pinia';
import axios from "axios";
import * as process from "process";

// import { useLocalStorage } from '@vueuse/core';

// const config = useRuntimeConfig();

const useUserStore = defineStore('user', {

    state(){
        return {
            // currentUser: localStorage.getItem('user') != null ? JSON.parse(localStorage.getItem('user')) : {user: null},
            currentUser: useCookie('user') != null ? useCookie('user') : {user: null},
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
                        userCookie.value = {user: null};

                        this.error = error;
                        this.currentUser = {user: null};
                        reject('notify.error.login');
                    });
            });
        },
        // async actionUserLogout(){
        //     return await new Promise((resolve, reject) => {
        //         axios
        //             .post(process.env.API_BASE_URL + '/logout', {}, {
        //                 headers: {
        //                     //'Content-Type': 'application/x-www-form-urlencoded',
        //                     'Accept': 'application/json',
        //                     'Authorization': `${this.getCurrentUser.token_type} ${this.getCurrentUser.token}`
        //                 }
        //             })
        //             .then(() => {
        //                 resolve('notify.success.logout');
        //                 this.currentUser = {user: null};
        //                 localStorage.removeItem('user')
        //             })
        //             .catch(error => {
        //                 reject('notify.error.logout');
        //                 console.log(error);
        //                 localStorage.removeItem('user');
        //                 this.currentUser = {user: null};
        //             });
        //     });
        // },
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
        // async actionTest(){
        //     axios
        //         .get(process.env.API_BASE_URL + '/super',
        //         {
        //             headers: {
        //                 //'Content-Type': 'application/x-www-form-urlencoded',
        //                 'Accept': 'application/json',
        //                 'Authorization': `${this.getCurrentUser.token_type} ${this.getCurrentUser.token}`
        //             }
        //         })
        //         .then(res => {
        //             console.log('Success middleWare laravel ' + res);
        //         })
        //         .catch(err => {
        //             console.log('Bad middleWare laravel ' + err)
        //         })
        // }
    },

})
export {useUserStore};
