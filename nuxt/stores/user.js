import { defineStore } from 'pinia';
import axios from "axios";
const config = useRuntimeConfig();

const useUserStore = defineStore('user', {
    state(){
        return {
            currentUser: localStorage.getItem('user') != null ? JSON.parse(localStorage.getItem('user')) : {user: null},
            users: [],
            employee: [],
            toCompanyId: null
        }
    },
    getters:{
        getCurrentUser(state){
            return state.currentUser;
        },
        getUsers: (state) => state.users,
        getEmployee: (state) => state.employee,
        getToCompanyId: (state) => state.toCompanyId,
    },
    actions:{
        async actionUserLogout(){
            return await new Promise((resolve, reject) => {
                axios
                    .post(config.public.baseApi + '/logout', {}, {
                        headers: {
                            //'Content-Type': 'application/x-www-form-urlencoded',
                            'Accept': 'application/json',
                            'Authorization': `${this.getCurrentUser.token_type} ${this.getCurrentUser.token}`
                        }
                    })
                    .then(() => {
                        resolve('notify.success.logout');
                        this.currentUser = {user: null};
                        localStorage.removeItem('user')
                    })
                    .catch(error => {
                        reject('notify.error.logout');
                        console.log(error);
                        localStorage.removeItem('user');
                        this.currentUser = {user: null};
                    });
            });
        },
        async actionUserLogin(data){
            return await new Promise((resolve, reject) => {
                axios
                    .post(config.public.baseApi + 'login', data)
                    .then((response) => {
                        let date_end = new Date();
                        let item = response.data;
                        item.date_end = date_end.setSeconds(date_end.getSeconds() + Number(item.expires_in));
                        localStorage.setItem('user', JSON.stringify(item));
                        //removed mutation and update store directly using this
                        this.currentUser = item
                        resolve('notify.success.login');
                    })
                    .catch((error) => {
                        localStorage.removeItem('user');
                        this.error = error;
                        this.currentUser = {user: null};
                        reject('notify.error.login');
                    });
            });
        },
        async actionGetUsers(){
            return await new Promise(() => {
                axios
                    .get(config.public.baseApi + '/user/list', {
                        headers: {
                            //'Content-Type': 'application/x-www-form-urlencoded',
                            'Accept': 'application/json',
                            'Authorization': `${this.getCurrentUser.token_type} ${this.getCurrentUser.token}`
                        }
                    })
                    .then((response) => {
                        this.users = response.data.data
                    })
                    .catch((error) => {
                        console.log(error)
                    });
            });
        },
        async actionTest(){
            axios.get(config.public.baseApi + '/super',
                {
                    headers: {
                        //'Content-Type': 'application/x-www-form-urlencoded',
                        'Accept': 'application/json',
                        'Authorization': `${this.getCurrentUser.token_type} ${this.getCurrentUser.token}`
                    }
                })
                .then(res => {
                    console.log('Success middleWare laravel ' + res);
                })
                .catch(err => {
                    console.log('Bad middleWare laravel ' + err)
                })
        }
    },

})
 export {useUserStore};
