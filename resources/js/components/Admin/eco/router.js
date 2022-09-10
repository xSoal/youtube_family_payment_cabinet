import Vue from 'vue';
import VueRouter from 'vue-router';
import Users from "../Users/Users";
import Payment from "../Payment/Payment";

Vue.use(VueRouter);

const leftMenuRoutes = [
    {
        path: '/admin/users',
        component: Users,
        name: 'users',
        meta: {
            keepAlive: true
        }
    },
    {
        path: '/admin/payment',
        component: Payment,
        name: 'payment'
    }
];

const routes = [
    ...leftMenuRoutes
];


const router = new VueRouter({
    routes,
    mode: 'history'
});


export  {
    leftMenuRoutes,
    router
};
