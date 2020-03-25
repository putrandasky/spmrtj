/**
 * First we will load all of this project's JavaScript dependencies which
 * includes Vue and other libraries. It is a great starting point when
 * building robust, powerful web applications using Vue and Laravel.
 */

import BootstrapVue from 'bootstrap-vue'
import App from './components/App';
import router from './router'
import Loading from 'vue-loading-overlay';
import {
  store
} from './store';
import 'vue-loading-overlay/dist/vue-loading.css';
import './filter/filter';
import './scss/custom.scss';
import Lottie from 'vue-lottie'
import VueBootstrapTypeahead from '@/survey/components/packages/VueBootstrapTypeahead.vue'
import RangeSlider from 'vue-range-slider'
// import Lottie from 'vue-lottie'
import '@pencilpix/vue2-clock-picker/dist/vue2-clock-picker.min.css';
// import VueProgressBar from 'vue-progressbar'
const VueClockPickerPlugin = require('@pencilpix/vue2-clock-picker/dist/vue2-clock-picker.plugin.js')
require('./bootstrap');

window.Vue = require('vue');
Vue.use(BootstrapVue)
Vue.component('lottie', Lottie);
Vue.use(VueClockPickerPlugin)
Vue.component('loading', Loading);
// Vue.component('lottie', Lottie);
Vue.component('RangeSlider', RangeSlider)
Vue.component('vue-bootstrap-typeahead', VueBootstrapTypeahead)
// Vue.use(VueProgressBar, {
//   color: '#3A45AD',
//   failedColor: 'red',
//   thickness: '5px'
// })
/**
 * The following block of code may be used to automatically register your
 * Vue components. It will recursively scan this directory for the Vue
 * components and automatically register them with their "basename".
 *
 * Eg. ./components/ExampleComponent.vue -> <example-component></example-component>
 */

// const files = require.context('./', true, /\.vue$/i)
// files.keys().map(key => Vue.component(key.split('/').pop().split('.')[0], files(key).default))

// Vue.component('example-component', require('./components/ExampleComponent.vue').default);

/**
 * Next, we will create a fresh Vue application instance and attach it to
 * the page. Then, you may begin adding components to this application
 * or customize the JavaScript scaffolding to fit your unique needs.
 */

const app = new Vue({
    el: '#apps',
    store,
    router,
    render: h => h(App),
  });
