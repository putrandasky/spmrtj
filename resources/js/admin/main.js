// The Vue build version to load with the `import` command
// (runtime-only or standalone) has been set in webpack.base.conf with an alias.
import Vue from 'vue';
import BootstrapVue from 'bootstrap-vue';
var VueTouch = require('vue-touch');
import Toasted from 'vue-toasted';

import store from './store';
import router from './Routes';
import App from './App';
import layoutMixin from './mixins/layout';
import Widget from './components/Widget/Widget';

window.axios = require('axios');
Vue.use(BootstrapVue);
Vue.use(VueTouch);
Vue.component('Widget', Widget);

Vue.mixin(layoutMixin);
Vue.use(Toasted, {duration: 10000});

Vue.config.productionTip = false;

/* eslint-disable no-new */
new Vue({
  el: '#apps',
  store,
  router,
  render: h => h(App),
});
