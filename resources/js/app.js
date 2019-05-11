/**
 * First we will load all of this project's JavaScript dependencies which
 * includes Vue and other libraries. It is a great starting point when
 * building robust, powerful web applications using Vue and Laravel.
 */

require('./bootstrap');

window.Vue = require('vue');
window.Vuetify = require('vuetify');

Vue.use(Vuetify);

import InfiniteSlideBar from 'vue-infinite-slide-bar';

Vue.component('infinite-slide-bar', InfiniteSlideBar);




/**
 * The following block of code may be used to automatically register your
 * Vue components. It will recursively scan this directory for the Vue
 * components and automatically register them with their "basename".
 *
 * Eg. ./components/ExampleComponent.vue -> <example-component></example-component>
 */

Vue.component('slider', require('./components/Slider').default);
Vue.component('developer-carousel', require('./components/DeveloperCarousel').default);
Vue.component('project', require('./components/Project').default);
Vue.component('developers', require('./components/Developers').default);
Vue.component('developer', require('./components/Developer').default);
Vue.component('page', require('./components/Page').default);
Vue.component('project-section', require('./components/ProjectSection').default);

/**
 * Next, we will create a fresh Vue application instance and attach it to
 * the page. Then, you may begin adding components to this application
 * or customize the JavaScript scaffolding to fit your unique needs.
 */

const app = new Vue({
    el: '#app',
    data() {
        return {
            drawer: false,
        }
    }
});
