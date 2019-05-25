<template xmlns:v-slot="http://www.w3.org/1999/XSL/Transform">
    <section id="contact-us">
        <v-layout column align-center>
            <v-flex shrink class="py-3">
                <h1 class="display-1">{{ __sentences('contactUs') }}</h1>
            </v-flex>
            <v-flex shrink
                    class="red darken-2 mb-4"
                    style="height: 3px; width: 50px">
            </v-flex>
        </v-layout>
        <v-flex>
            <v-container fluid>
                <v-layout row wrap>
                    <v-flex xs12 lg8 pa-2>
                        <v-card flat>
                            <v-form ref="form" lazy-validation>
                                <v-card-text>
                                    <v-layout row wrap>
                                        <v-flex xs12>
                                            <v-layout row wrap>
                                                <v-flex xs12 md6 pa-1>
                                                    <v-text-field
                                                            v-model="contact.name"
                                                            outline
                                                            :label="__words('name')"
                                                            type="text"
                                                            color="primary"
                                                            autocomplete="name"
                                                            prepend-inner-icon="person"
                                                            required
                                                            :rules="nameRules"
                                                            :counter="30"
                                                    ></v-text-field>
                                                </v-flex>
                                                <v-flex xs12 md6 pa-1>
                                                    <v-text-field
                                                            v-model="contact.email"
                                                            outline
                                                            :label="__words('email')"
                                                            type="email"
                                                            color="primary"
                                                            autocomplete="email"
                                                            prepend-inner-icon="email"
                                                            required
                                                            :rules="emailRules"
                                                    ></v-text-field>
                                                </v-flex>
                                                <v-flex xs12 md6 pa-1>
                                                    <v-text-field
                                                            v-model="contact.phone"
                                                            outline
                                                            :label="__words('phone')"
                                                            type="tel"
                                                            color="primary"
                                                            autocomplete="tel"
                                                            prepend-inner-icon="phone"
                                                            required
                                                            :rules="phoneRules"
                                                            :counter="15"
                                                    ></v-text-field>
                                                </v-flex>
                                                <v-flex xs12 md6 pa-1>
                                                    <v-select
                                                            v-model="contact.inquiry_type"
                                                            outline
                                                            :items="inquiries"
                                                            :label="__sentences('selectCategory')"
                                                            color="primary"
                                                            prepend-inner-icon="category"
                                                            required
                                                            :rules="inquiryRules"
                                                    ></v-select>
                                                </v-flex>
                                            </v-layout>
                                        </v-flex>
                                        <v-flex xs12 pa-1>
                                            <v-textarea
                                                    v-model="contact.message"
                                                    outline
                                                    height="100%"
                                                    :label="__words('message')"
                                                    color="primary"
                                                    prepend-inner-icon="message"
                                                    required
                                                    :rules="messageRules"
                                                    :counter="140"
                                            ></v-textarea>
                                        </v-flex>
                                    </v-layout>
                                </v-card-text>
                                <v-card-actions>
                                    <v-spacer></v-spacer>
                                    <v-btn color="primary" class="mx-2" :loading="loading" @click.stop="send()">{{ __words('send') }}</v-btn>
                                </v-card-actions>
                            </v-form>
                        </v-card>
                    </v-flex>
                    <v-flex xs12 lg4 pa-2>
                        <v-card flat>
                            <v-card-text>
                                <v-flex pa-2>
                                    <h2 class="headline mb-3">
                                        <v-icon large>location_on</v-icon>
                                        {{ __sentences('ourOffice') }}
                                    </h2>

                                    <v-layout column>
                                        <v-flex class="subheading py-2">
                                            <address>
                                                <v-tooltip left>
                                                    <template v-slot:activator="{ on }">

                                                        <a href="https://goo.gl/maps/4y74kX6UDg5We5Ud7"
                                                           target="_blank" role="link" v-on="on"
                                                           style="text-decoration: none; color:inherit">
                                                            {{ __sentences('address') }}
                                                        </a>
                                                    </template>
                                                    <span>{{ __words('address') }}</span>
                                                </v-tooltip>
                                            </address>
                                        </v-flex>
                                        <v-flex class="subheading py-2" style="direction: ltr">
                                            <v-tooltip left>
                                                <template v-slot:activator="{ on }">
                                                    <a href="tel:+201019699911" role="tel" v-on="on"
                                                       style="text-decoration: none; color:inherit;">
                                                        (+20) 101 969 9911
                                                    </a>
                                                </template>
                                                <span>{{ __words('phone') }}</span>
                                            </v-tooltip>

                                        </v-flex>
                                        <v-flex class="subheading py-2">
                                            <v-tooltip left>
                                                <template v-slot:activator="{ on }">
                                                    <a href="mailto:realestate@novavera.com" role="email"
                                                       v-on="on"
                                                       style="text-decoration: none; color:inherit">
                                                        realestate@novavera.com
                                                    </a>
                                                </template>
                                                <span>{{ __words('email') }}</span>
                                            </v-tooltip>
                                        </v-flex>
                                    </v-layout>
                                </v-flex>
                            </v-card-text>
                        </v-card>
                    </v-flex>
                </v-layout>
            </v-container>
        </v-flex>
        <snackbar :active="snackbar.active" :color="snackbar.color" :message="snackbar.message"
                  @deactivate="deactivateSnackbar"></snackbar>
    </section>
</template>

<script>
    import SnackbarComponent from '../mixins/SnackbarComponent';
    export default {
        name: "ContactFormSection",
        mixins: [SnackbarComponent],
        data() {
            return {
                loading: false,
                inquiries: [
                    this.__sentences('REE'),
                    this.__sentences('CAR')
                ],
                contact: {
                    name: '',
                    email: '',
                    phone: '',
                    inquiry_type: '',
                    message: '',
                },
                nameRules: [
                    v => !!v || this.__sentences('nameRules', 'required'),
                    v => (v && v.length <= 30) || this.__sentences('nameRules', 'length', '30')
                ],
                emailRules: [
                    v => !!v || this.__sentences('emailRules', 'required'),
                    v => /.+@.+/.test(v) || this.__sentences('emailRules', 'valid'),
                ],
                phoneRules: [
                    v => !!v || this.__sentences('phoneRules', 'required'),
                    v => /\d+/.test(v) || this.__sentences('phoneRules', 'valid'),
                    v => (v && v.length <= 15) || this.__sentences('phoneRules', 'length', '15')
                ],
                inquiryRules: [
                    v => !!v || this.__sentences('inquiryRules', 'required'),
                ],
                messageRules: [
                    v => !!v || this.__sentences('messageRules', 'required'),
                    v => (v && v.length <= 150) || this.__sentences('messageRules', 'lengthMax', '150'),
                    v => (v && v.length >= 10) || this.__sentences('messageRules', 'lengthMin', '10')
                ],
            }
        },
        methods: {
            send () {
                if (this.$refs.form.validate()) {
                    let vm = this;
                    vm.loading = true;
                    axios.post(`/${this.$vuetify.lang.current}/contact/home`, vm.contact)
                        .then(res => {
                            vm.reset();
                            vm.resetValidation();
                            vm.activateSnackbar('success', res.data.message);
                        })
                        .catch(err => {
                            vm.loading = false;
                            if ('response' in err) {
                                vm.activateSnackbar('error', err.response.data.message);
                            }
                        })
                }
            },
            reset () {
                this.$refs.form.reset();
                this.loading = false;
            },
            resetValidation () {
                this.$refs.form.resetValidation()
            }
        }
    }
</script>

<style scoped>

</style>