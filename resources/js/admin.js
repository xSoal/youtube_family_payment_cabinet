import Vue from 'vue';
import Admin from "./components/Admin/Admin";

import { router } from './components/Admin/eco/router';

import store from './components/Admin/eco/store';

// or import all icons if you don't care about bundle size
import 'vue-awesome/icons'

import Icon from 'vue-awesome/components/Icon'

import API from './components/Admin/eco/API'

import { DatePicker } from 'ant-design-vue';

Vue.use(DatePicker);

import 'ant-design-vue/dist/antd.css';

window.API = API;

Vue.component('v-icon', Icon);


const app = new Vue({
    el: '#admin',
    render: h => h(Admin),
    store,
    router,

});


