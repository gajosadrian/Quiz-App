
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

Vue.component('b-block', require('./components/bootstrap/b-block.vue'));
Vue.component('b-alert', require('./components/bootstrap/b-alert.vue'));
Vue.component('quiz-app', require('./components/quiz/app.vue'));

const app = new Vue({
    el: '#app'
});
