window._ = require('lodash');
import Vue from "vue";

import VueSweetalert2 from 'vue-sweetalert2';
import 'sweetalert2/dist/sweetalert2.min.css';
Vue.use(VueSweetalert2);
try {
    window.Popper = require('popper.js').default;
    window.$ = window.jQuery = require('jquery');
} catch (e) {}

window.axios = require('axios');

Vue.prototype.$axios = window.axios;

window.axios.defaults.headers.common['X-Requested-With'] = 'XMLHttpRequest';
