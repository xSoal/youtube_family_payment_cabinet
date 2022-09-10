//
// function API () {
//     const url = `http://127.0.0.1:8000/api/`;
//     alert('url')
// }

import axios from "axios";
import store  from './store';
// import { showSuccess, showError } from "../../../helpers";



class API_CLASS {
    constructor() {
        this.time = new Date().getTime() + '___' + Math.random();
        this.api_url = `/api`;
        this.access_token = null;

        this.access_token = document.querySelector('#user_token')?.value;

        //
        // this.error = (message = 'Ошибка') => {
        //     return this._notification['success']({
        //         message: message
        //     });
        // };
        //
        // this.showLoader = () => {
        //   store.globalLoading = true;
        // };
        //
        // this.hideLoader = () => {
        //     store.globalLoading = false;
        // };


    }

    // isAuth() {
    //
    //     const JWT = JSON.parse(window.localStorage.getItem('JWT'));
    //
    //     if (JWT === null || JWT.toTime < new Date().getTime()) {
    //         return false;
    //     } else {
    //         return true;
    //     }
    // }

    // async tryAuth(name, password) {
    //     try {
    //         const res = await axios.post(`${this.api_url}/auth/login`, {
    //             name, password
    //         });
    //         const data = res.data;
    //
    //         let storageData = {
    //             user: data.user,
    //             toTime: new Date().getTime() + data.expires_in * 1000,
    //             access_token: data.access_token
    //         };
    //
    //         this.access_token = data.access_token;
    //         window.localStorage.setItem('JWT', JSON.stringify(storageData));
    //
    //
    //         return {
    //             ...data.user,
    //         };
    //
    //     } catch (err) {
    //         return err;
    //     }
    //
    // }

    getToken(){
        return this.access_token;
    }

    async request( url = '', type = 'get', data = {}, config = {} ){
        const token = this.getToken();
        store.state.globalLoading = true;

        try{
            const req = await axios[type](`${this.api_url}${url}`, {
                headers: {
                    Authorization: "Bearer " + token,
                    ...config
                },
                ...data
            }, {
                headers: {
                    Authorization: "Bearer " + token,
                    ...config
                }
            });

            if(type !== 'get'){
                // showSuccess();
            }

            return {
                ...req,
                error: false
            };

        } catch(err){
            // showError(err?.response?.data?.message || '');
            return {
                ...err,
                errors: err.response?.data?.errors,
                error: true
            };
        } finally {
            setTimeout(()=>{
                store.state.globalLoading = false;
            },255)

        }


    }


    async get(url) {

        return await this.request(url, 'get');

        // const token = this.getToken();
        // store.state.globalLoading = true;
        //
        // try {
        //     const req = await axios.get(`${this.api_url}${url}`, {
        //         headers: {
        //             Authorization: "Bearer " + token
        //         }
        //     });
        //
        //     return {
        //         ...req,
        //         error: false
        //     };
        // } catch (err) {
        //     return {
        //         ...err,
        //         error: true
        //     };
        // } finally {
        //     setTimeout(()=>{
        //         store.state.globalLoading = false;
        //
        //     },455)
        // }
    }

    async put(url, data) {

        return await this.request(url, 'put', data);

        // const token = this.getToken();
        //
        // try {
        //     const req = await axios.put(`${this.api_url}${url}`, data, {
        //         headers: {
        //             Authorization: "Bearer " + token
        //         }
        //     });
        //     this.success();
        //     return {
        //         ...req,
        //         error: false
        //     };
        // } catch (err) {
        //     console.log(err)
        //     this.error(err);
        //     return {
        //         ...err,
        //         error: true
        //     };
        // }

    }

    async post(url, data, config) {

        return await this.request(url, 'post', data, config);

        //
        // const token = this.getToken();
        //
        // try {
        //     const req = await axios.post(`${this.api_url}${url}`, data, {
        //         headers: {
        //             Authorization: "Bearer " + token,
        //             ...config
        //         }
        //     });
        //     this.success();
        //     return {
        //         ...req,
        //         error: false
        //     };
        // } catch (err) {
        //     console.log(err);
        //     this.error(err);
        //     return {
        //         ...err,
        //         error: true
        //     };
        // }
    }

    async delete(url) {

        return await this.request(url, 'delete');

        //
        //
        // const token = this.getToken();
        //
        // try {
        //     const req = await axios.delete(`${this.api_url}${url}`, {
        //         headers: {
        //             Authorization: "Bearer " + token
        //         }
        //     });
        //     this.success();
        //     return {
        //         ...req,
        //         error: false
        //     };
        // } catch (err) {
        //     console.log(err);
        //     this.error(err);
        //     return {
        //         ...err,
        //         error: true
        //     };
        // }


    }

}


const API = new API_CLASS();

export default API;
