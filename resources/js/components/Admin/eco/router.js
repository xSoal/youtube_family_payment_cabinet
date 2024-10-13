import Vue from 'vue';
import VueRouter from 'vue-router';
import Users from "../Users/Users";
import Payment from "../Payment/Payment";
import YoutubePeriods from "../YoutubePeriods/YoutubePeriods";

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
    },
    {
        path: '/admin/youtube_periods',
        component: YoutubePeriods,
        name: 'youtube_periods'
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
