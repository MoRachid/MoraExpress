/**
 * First we will load all of this project's JavaScript dependencies which
 * includes Vue and other libraries. It is a great starting point when
 * building robust, powerful web applications using Vue and Laravel.
 */

require('./bootstrap');
require('vue-multiselect/dist/vue-multiselect.min.css');
import Vue from 'vue';
import VModal from 'vue-js-modal';
import Turbolinks from 'turbolinks';

window.Vue = require('vue');

Vue.use(VModal);
Turbolinks.start();

/**
 * There are the global component
 */
Vue.component('card-component', require('./components/Card.vue').default);
Vue.component('menu-container', require('./modules/menu/MenuContainer.vue').default);
Vue.component('resto-group', require('./modules/restos/RestoGroup.vue').default);
Vue.component('order-group', require('./modules/orders/OrderGroup.vue').default);


/**
 * Next, we will create a fresh Vue application instance and attach it to
 * the page. Then, you may begin adding components to this application
 * or customize the JavaScript scaffolding to fit your unique needs.
 */

 document.addEventListener('turbolinks:load', () => {
    var element = document.getElementById('app');
    if (element != null) {
      const app = new Vue({
        el: element
      });
    }
});  
