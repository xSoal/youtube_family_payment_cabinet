import Vue from 'vue'
import Vuex from 'vuex'
import API from './API';

Vue.use(Vuex);

export default new Vuex.Store ({

    state: {
        globalLoading: false,
        users: [],
        currentUserPeriods: [],
        allPayment: [],
        startPeriodsData: null,
        youtubePeriods: [],
        youtubeDefaultAmount: 150
    },

    actions: {

        async rebasePeriods(ctx){
            await API.get('/recalculate_all_user_periods');

        },

        async getAllUsers(ctx){
             // console.log('qwenlmasdcnmasdm')
            const res = await API.get('/users');

            ctx.state.users = res.data;

        },
        async createUser(ctx, {name, email, password, password_confirm}){
            const res = await API.post('/users/add', {
                name,
                email,
                password,
                password_confirm
            });
            await ctx.dispatch('getAllUsers');
            return res;
        },
        async editUser(ctx, { id, name, email, password, password_confirm }){
            const res =  await API.post(`/users/edit/${id}`, {
                 email,
                 name,
                 password,
                 password_confirm
             });

            // if(!res.error) await ctx.dispatch('getAllUsers');
            return res;
        },

        async deleteUser(ctx, {id}){
             const res =  await API.get(`/users/delete/${id}`);
             if(!res.error && !res.errors){
                ctx.commit('removeUser', id)
             }
         },


        async getStartPeriodData(ctx){
             const res = await API.get('/get_start_periods_data');
             ctx.state.startPeriodsData = res.data;
        },


        async createUserPeriods(ctx, {userId, startFrom, startTo, userInPaymentCount }){

             const res = await API.post(`/create_periods/${userId}`, {
                 start_from: startFrom,
                 start_to: startTo,
                 user_in_payment_count: userInPaymentCount
             });
        },

        async getUserPeriods(ctx, userId){
             const res = await API.get(`/get_user_periods/${userId}`);

             if(!res.error) ctx.state.currentUserPeriods = res.data;

        },


        async deleteUserPeriod(ctx, {
            periodId,
            userId
        }){
             const res = await API.delete(`/get_user_periods/${periodId}`);

             ctx.dispatch('getUserPeriods', userId);
        },


        async getAllPayments(ctx){
             const res = await API.get('/get_all_payments');

             ctx.state.allPayment = res.data;
        },

        async addUserPayment(ctx, {userId, amount, date}){
            const res = await API.post(`/create_user_payment/${userId}`, {
                amount,
                date
            });

           ctx.dispatch('getAllPayments', userId);
        },

        async editUserPayment(ctx, {paymentId, amount, date}){
          const res = await API.post(`/update_user_payment/${paymentId}`)
        },

        async deleteUserPayment(ctx, paymentId){
            const res = await API.delete(`/delete_user_payment/${paymentId}`);

            if(res.error) return;

            const paymentIndex = ctx.state.allPayment.findIndex(el => el.id === paymentId);
            ctx.state.allPayment.splice(paymentIndex, 1);
        },


        async getYoutubePeriods(ctx) {
            const res = await API.get(`/get_youtube_periods`);
            ctx.state.youtubePeriods = res.data;
        },

        async addYoutubePeriod(ctx, {yearMonthDate, amount}) {
            const res = await API.post(`/add_youtube_period`, {
                yearMonthDate,
                amount
            });
            
            ctx.dispatch('getYoutubePeriods');
            return true;
        },

        async deleteYoutubePeriod(ctx, periodId){
            const res = await API.delete(`/delete_youtube_period/${periodId}`);
            ctx.dispatch('getYoutubePeriods');
        }


    },
    getters: {},
    mutations: {
        removeUser(state, id){
            const i = state.users.findIndex( i => i.id === id);
            state.users.splice(i, 1);
        }
    }
});


