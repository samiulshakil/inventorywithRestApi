/**
 * First we will load all of this project's JavaScript dependencies which
 * includes Vue and other libraries. It is a great starting point when
 * building robust, powerful web applications using Vue and Laravel.
 */

require('./bootstrap');


import Vue from 'vue'
import VueRouter from 'vue-router'
Vue.use(VueRouter)

//router import...
import {routes} from './routes';

//import user js
import User from './helpers/User';
window.User = User

import Notification from './helpers/Notification';
window.Notification = Notification

// sweet alert
import Swal from 'sweetalert2'

window.Swal = Swal;

const Toast = Swal.mixin({
  toast: true,
  position: 'top-end',
  showConfirmButton: false,
  timer: 3000
});

window.Toast = Toast

//sweet alert end

const router = new VueRouter({
  routes,
  mode: 'history'
})

const app = new Vue({
  router
}).$mount('#app')
