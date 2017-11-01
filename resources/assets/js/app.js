
/**
 * First we will load all of this project's JavaScript dependencies which
 * includes Vue and other libraries. It is a great starting point when
 * building robust, powerful web applications using Vue and Laravel.
 */

require('./bootstrap');

window.Vue = require('vue');

/**
 * Next, we will create a fresh Vue application instance and attach it to
 * the page. Then, you may begin adding components to this application
 * or customize the JavaScript scaffolding to fit your unique needs.
 */


Vue.component('example-component', require('./components/ExampleComponent.vue'));
Vue.component('image-editor', require('./components/imageEditor.vue'));
Vue.component('orders', require('./components/orders.vue'));
Vue.component('order-amount', require('./components/order-amount.vue'));
Vue.component('order-select', require('./components/order-select.vue'));
Vue.component('template-image-text', require('./components/template-image-text.vue'));
Vue.component('vue-scrollbar', require('./components/vue2-scrollbar/src/js/components/vue-scrollbar.vue'));
Vue.component('btn', require('./components/general/btn.vue'));
Vue.component('font-select', require('./components/general/font-select.vue'));
Vue.component('image-grid', require('./components/general/image-grid.vue'));
Vue.component('button-group', require('./components/general/button-group.vue'));
Vue.component('vueSlider', require('vue-slider-component'));


const app = new Vue({
    el: '#app'
});
