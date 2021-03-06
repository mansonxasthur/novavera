/**
 * First we will load all of this project's JavaScript dependencies which
 * includes Vue and other libraries. It is a great starting point when
 * building robust, powerful web applications using Vue and Laravel.
 */

require('./bootstrap');

window.Vue = require('vue');
window.Vuetify = require('vuetify');
window.Vuex = require('vuex');
import translation from './util/translation';
// Translation provided by Vuetify (javascript)
import en from 'vuetify/es5/locale/en';
import ar from 'vuetify/es5/locale/ar';
/**
 * Next, we will create a fresh Vue application instance and attach it to
 * the page. Then, you may begin adding components to this application
 * or customize the JavaScript scaffolding to fit your unique needs.
 */
import {mapGetters} from "vuex";


Vue.use(Vuex);

Vue.mixin({
    methods: {
        __words(property, nested = '', needle = '') {
            return this.__getTranslation('words', property, nested, needle);
        },
        __sentences(property, nested = '', needle = '') {
            return this.__getTranslation('sentences', property, nested, needle);
        },
        __getTranslation(key, property, nested, needle) {
            let translationStr = translation(this.$vuetify.lang.current, key, property, nested);
            if (needle !== '') {
                translationStr = translationStr.replace(/:\w+:/, needle);
            }

            return translationStr;
        },
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
        __t(model, property) {
            if (this.$vuetify.lang.current === 'ar') {
                if (model.translation && model.translation[property]) {
                    return model.translation[property];
                }
            }

            return model[property];
        }
    }
});


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
        setLocale(state, lang) {
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


Vue.use(Vuetify, {
    lang: {
        locales: { ar, en},
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
Vue.component('citizenship-list', require('./components/CitizenshipList').default); // slider
Vue.component('citizenship-div-list', require('./components/CitizenshipDivList').default); // slider
Vue.component('page-list', require('./components/PageList').default); // slider
Vue.component('page-nav-btn', require('./components/PageNavBtn').default); // slider

Vue.component('developer-carousel', require('./components/DeveloperCarousel').default); //developer carousel
Vue.component('developers', require('./components/Developers').default); // developers page
Vue.component('developer', require('./components/Developer').default); // developer page

Vue.component('page', require('./components/Page').default); // custom page

Vue.component('project', require('./components/Project').default); // project page
Vue.component('project-section', require('./components/ProjectSection').default); // project section home page

Vue.component('citizenship', require('./components/Citizenship').default); // citizenship page
Vue.component('citizenship-section', require('./components/CitizenshipSection').default); // citizenship section home page

Vue.component('careers', require('./components/Careers').default); // careers page
Vue.component('property-request', require('./components/PropertyRequest').default); // property requests page
Vue.component('partners', require('./components/Partners').default); // partners page

const novavera = new Vue({
    el: '#novavera',
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
            let locale = lang === 'ar' ? 'en' : 'ar';

            let text = lang === 'ar' ? 'English' : 'العربية';
            return {
                key: locale,
                value: text
            };
        }
    },
    created() {
        let html = document.querySelector('html');
        let locale = html.getAttribute('lang');

        this.setLocale(locale);
    },
    methods: {
        setLocale(locale) {
            let currentLocale = this.$vuetify.lang.current = locale;
            if (this.locale !== currentLocale) {
                this.$store.commit('setLocale', currentLocale);
            }

        },
        changeLocale() {
            let location = window.location;
            let path = location.pathname.replace(this.locale, this.otherLocale.key);
            window.location = location.href.replace(location.pathname, path);
        }
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
