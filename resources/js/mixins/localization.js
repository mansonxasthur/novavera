import translation from '../util/translation'

export default {
    methods: {
        __words(property, nested = '') {
            return this.__getTranslation('words', property, nested);
        },
        __sentences(property, nested = '') {
            return this.__getTranslation('sentences', property, nested);
        },
        __getTranslation(key, property, nested) {
            return translation(this.$vuetify.lang.current, key, property, nested);
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
}