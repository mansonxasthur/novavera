/**
 * First we will load all of this project's JavaScript dependencies which
 * includes Vue and other libraries. It is a great starting point when
 * building robust, powerful web applications using Vue and Laravel.
 */

require('../bootstrap');

window.Vue = require('vue');
window.Vuetify = require('vuetify');
window.Vuex = require('vuex');

Vue.use(Vuetify);
Vue.use(Vuex);

/**
 * The following block of code may be used to automatically register your
 * Vue components. It will recursively scan this directory for the Vue
 * components and automatically register them with their "basename".
 *
 * Eg. ./components/ExampleComponent.vue -> <example-component></example-component>
 */


// Admins
//Vue.component('edit-admin', require('../components/admin/admin/Edit').default);
Vue.component('admins', require('../components/admin/admin/List').default);

// Locations
Vue.component('locations', require('../components/admin/location/List').default);
// Property Types
Vue.component('property-types', require('../components/admin/propertyType/List').default);
// Developers
Vue.component('developers', require('../components/admin/developer/List').default);
// Departments
Vue.component('departments', require('../components/admin/department/List').default);
// Projects
Vue.component('create-project', require('../components/admin/project/Create').default);
Vue.component('edit-project', require('../components/admin/project/Edit').default);
Vue.component('projects', require('../components/admin/project/List').default);

// Projects
Vue.component('create-citizenship', require('../components/admin/citizenship/Create').default);
Vue.component('edit-citizenship', require('../components/admin/citizenship/Edit').default);
Vue.component('citizenship-list', require('../components/admin/citizenship/List').default);
// Tags
Vue.component('tags', require('../components/admin/tag/List').default);
// Posts
Vue.component('create-post', require('../components/admin/post/Create').default);
Vue.component('edit-post', require('../components/admin/post/Edit').default);
Vue.component('posts', require('../components/admin/post/List').default);
// Pages
Vue.component('create-page', require('../components/admin/page/Create').default);
Vue.component('edit-page', require('../components/admin/page/Edit').default);
Vue.component('pages', require('../components/admin/page/List').default);
// Sliders
Vue.component('edit-slider', require('../components/admin/slider/Edit').default);
Vue.component('sliders', require('../components/admin/slider/List').default);


const store = new Vuex.Store({
    state: {
        user: null
    },
    mutations: {
        user(state, user) {
            state.user = user;
        }
    },
    getters: {
        getUser(state) {
            return state.user;
        }
    },
    actions: {
        setUser(context, user) {
            context.commit('user', user);
        }
    }
});

/**
 * Next, we will create a fresh Vue application instance and attach it to
 * the page. Then, you may begin adding components to this application
 * or customize the JavaScript scaffolding to fit your unique needs.
 */
import User from '../util/authorization';
import {mapGetters, mapActions} from 'vuex';

const app = new Vue({
    el: '#app',
    store,
    data() {
        return {
            dark: false,
            drawer: true
        }
    },
    watch: {
        dark(val) {
            let theme = this.getCookie('theme');
            if (theme !== '') {
                theme = theme === 'true';
                if (this.dark !== theme) this.setCookie('theme', val);
            } else {
                this.setCookie('theme', val);
            }
        }
    },
    mounted() {
        let theme = this.getCookie('theme');

        if (theme !== '') {
            theme = theme === 'true';
            if (this.dark !== theme) this.dark = theme;
        }
        let vm = this;

        axios.get('/dashboard/user')
            .then(res => {
                vm.setUser(new User(res.data));
            })
            .catch(err => {
                vm.setUser = new User();
            })
    },
    methods: {
        ...mapActions(['setUser']),
        getCookie(cname) {
            let name = cname + "=";
            let decodedCookie = decodeURIComponent(document.cookie);
            let ca = decodedCookie.split(';');
            for (let i = 0; i < ca.length; i++) {
                let c = ca[i];
                while (c.charAt(0) === ' ') {
                    c = c.substring(1);
                }
                if (c.indexOf(name) === 0) {
                    return c.substring(name.length, c.length);
                }
            }
            return "";
        },
        setCookie(name, value) {
            document.cookie = `${name}=${value}`;
        },
        logout() {
            axios.post('/logout')
                .then(res => {
                    window.location = res.data;
                });
        }
    },
    computed: {
        ...mapGetters({user: 'getUser'})
    }
});
