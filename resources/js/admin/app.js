/**
 * First we will load all of this project's JavaScript dependencies which
 * includes Vue and other libraries. It is a great starting point when
 * building robust, powerful web applications using Vue and Laravel.
 */

require('../bootstrap');

window.Vue = require('vue');
window.Vuetify = require('vuetify');

Vue.use(Vuetify);

/**
 * The following block of code may be used to automatically register your
 * Vue components. It will recursively scan this directory for the Vue
 * components and automatically register them with their "basename".
 *
 * Eg. ./components/ExampleComponent.vue -> <example-component></example-component>
 */

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


/**
 * Next, we will create a fresh Vue application instance and attach it to
 * the page. Then, you may begin adding components to this application
 * or customize the JavaScript scaffolding to fit your unique needs.
 */

const app = new Vue({
    el: '#app',
    data() {
        return {
            dark: false,
            drawer: true,
        }
    },
    watch: {
        dark(val) {
            let theme = this.getCookie('theme');
            if ( theme !== '') {
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
    },
    methods: {
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
        setCookie(name, value)
        {
            document.cookie = `${name}=${value}`;
        },
        logout() {
            axios.post('/logout')
                .then(res => {
                    window.location = res.data;
                });
        }
    }
});
