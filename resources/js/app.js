/**
 * First we will load all of this project's JavaScript dependencies which
 * includes Vue and other libraries. It is a great starting point when
 * building robust, powerful web applications using Vue and Laravel.
 */

require('./bootstrap');

window.Vue = require('vue');
window.Vuetify = require('vuetify');
window.Vuex = require('vuex');


Vue.use(Vuex);


/**
 * Next, we will create a fresh Vue application instance and attach it to
 * the page. Then, you may begin adding components to this application
 * or customize the JavaScript scaffolding to fit your unique needs.
 */




const store = new Vuex.Store({
    state: {
        locale: 'en',
        pageTitle: ''
    },
    getters: {
        getLocale(state) {
            return state.locale;
        },
        getPageTitle(state) {
            return state.pageTitle
        }
    },
    mutations: {
        changeLocale(state, lang) {
            state.locale = lang;
        },
        changePageTitle(state, title) {
            state.pageTitle = title;
        }
    },
    actions: {
        setTitle(context, title) {
            context.commit('changePageTitle', title);
        }
    }
});



// Translation provided by Vuetify (javascript)
import en from 'vuetify/es5/locale/en'
import ar from 'vuetify/es5/locale/ar'

Vue.use(Vuetify, {
    lang: {
        locales: {en, ar},
        current: 'en'
    },
    rtl: store.getters.getLocale === 'ar'
});

/**
 * The following block of code may be used to automatically register your
 * Vue components. It will recursively scan this directory for the Vue
 * components and automatically register them with their "basename".
 *
 * Eg. ./components/ExampleComponent.vue -> <example-component></example-component>
 */

Vue.component('slider', require('./components/Slider').default); // slider
Vue.component('contact-form-section', require('./components/ContactFormSection').default); // slider

Vue.component('developer-carousel', require('./components/DeveloperCarousel').default); //developer carousel
Vue.component('developers', require('./components/Developers').default); // developers page
Vue.component('developer', require('./components/Developer').default); // developer page

Vue.component('page', require('./components/Page').default); // custom page

Vue.component('project', require('./components/Project').default); // project page
Vue.component('project-section', require('./components/ProjectSection').default); // project section home page

Vue.component('citizenship', require('./components/Citizenship').default); // citizenship page
Vue.component('citizenship-section', require('./components/CitizenshipSection').default); // citizenship section home page

Vue.component('careers', require('./components/Careers').default); // careers page

/**
 * Next, we will create a fresh Vue application instance and attach it to
 * the page. Then, you may begin adding components to this application
 * or customize the JavaScript scaffolding to fit your unique needs.
 */
import {mapGetters} from "vuex";
import localization from './mixins/localization';

const novavera = new Vue({
    el: '#novavera',
    mixins: [localization],
    store,
    data() {
        return {
            drawer: false,
        }
    },
    computed: {
        ...mapGetters({
            locale: 'getLocale',
            title: 'getPageTitle'
        }),
        otherLocale() {
            let lang = this.$vuetify.lang.current;
            return lang === 'ar' ? 'English' : 'العربية';
        }
    },
    created() {
        if (this.getCookie('locale') !== '') {
            this.$store.commit('changeLocale', this.getCookie('locale'));
        }

        this.$vuetify.lang.current = this.locale;
    },
    methods: {
        changeLocale() {
            let currentLocale = this.$vuetify.lang.current = this.$vuetify.lang.current === 'ar' ? 'en' : 'ar';
            this.$store.commit('changeLocale', currentLocale);
            this.setCookie('locale', currentLocale);
        },
    },
    watch: {
        locale(val) {
            let isArabic = val === 'ar';
            let content = document.querySelector('.v-content');
            let html = document.querySelector('html');
            if (isArabic) {
                content.setAttribute('style', 'text-align:right;');
                html.setAttribute('lang', 'ar');
            } else {
                content.setAttribute('style', 'text-align:inherit;');
                html.setAttribute('lang', 'en');
            }

            this.$vuetify.rtl = isArabic;
            this.drawer = false;
        }
    }
});
