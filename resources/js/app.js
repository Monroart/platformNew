/**
 * First we will load all of this project's JavaScript dependencies which
 * includes Vue and other libraries. It is a great starting point when
 * building robust, powerful web applications using Vue and Laravel.
 */


import {mapState} from "vuex";

require('./bootstrap');

window.Vue = require('vue').default;

/**
 * The following block of code may be used to automatically register your
 * Vue components. It will recursively scan this directory for the Vue
 * components and automatically register them with their "basename".
 *
 * Eg. ./components/ExampleComponent.vue -> <example-component></example-component>
 */

// const files = require.context('./', true, /\.vue$/i)
// files.keys().map(key => Vue.component(key.split('/').pop().split('.')[0], files(key).default))


Vue.component('sidebar', require('./components/sidebar/Sidebar.vue').default)
Vue.component('header-main', require('./components/header/HeaderMain.vue').default)
Vue.component('loader', require('./components/loader/MyLoader.vue').default)

/**
 * Next, we will create a fresh Vue application instance and attach it to
 * the page. Then, you may begin adding components to this application
 * or customize the JavaScript scaffolding to fit your unique needs.
 */

import router from "./router";
import axios from "axios";
import store from "./store";
import Vuetify from './plugins/vuetify'
import moment from 'moment'
import Vuelidate from 'vuelidate'
import VueMoment from 'vue-moment'
import 'vue2-datepicker/locale/ru';
import VueToast from 'vue-toast-notification';
import 'vue-toast-notification/dist/theme-bootstrap.css';


Vue.use(Vuelidate)
Vue.use(VueMoment)
Vue.use(VueToast);

const app = new Vue({
    el: '#app',
    vuetify: Vuetify,
    router,
    axios,
    store,
    moment: moment,
    computed: {
        ...mapState('loading', ['isLoading'])
    }
});

