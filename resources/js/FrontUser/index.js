import Vue from 'vue';
import Front from "./Components/Front/Front";

import { router } from './eco/router';

import store from './eco/store';

import Index from './Components/Index';

// or import all icons if you don't care about bundle size
import 'vue-awesome/icons'

import Icon from 'vue-awesome/components/Icon'

import API from './eco/API'

import { DatePicker } from 'ant-design-vue';

Vue.use(DatePicker);

import 'ant-design-vue/dist/antd.css';

window.API = API;

Vue.component('v-icon', Icon);


const app = new Vue({
    el: '#appa',
    render: h => h(Index),
    // store,
    router,
});

