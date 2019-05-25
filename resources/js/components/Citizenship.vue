<template>
    <v-container fluid fill-height>

        <v-layout column align-space-between justify-center>
            <v-flex>
                <div class="intro d-flex" :style="`background-image: url('${citizenship.header_url}')`">

                    <section :style="`height: ${height}px`">
                        <v-container fill-height fluid>
                            <v-layout fill-height column align-center justify-center>
                                <v-flex shrink class="text-xs-center intro-content">
                                    <div class="display-2 text-uppercase font-weight-bold">{{ citizenship.country_name }}</div>
                                </v-flex>
                            </v-layout>
                        </v-container>
                    </section>

                </div>
            </v-flex>
            <v-flex>
                <v-container>
                    <h2 class="display-1 my-3" v-text="citizenship.title"></h2>
                    <p class="body-1" v-html="citizenship.description"></p>
                </v-container>
            </v-flex>
            <v-flex class="text-xs-center primary py-5 my-4">
                <h2 class="headline text-uppercase white--text mb-4">{{ __sentences('wouldFreeConsultation') }}</h2>
                <v-btn href="#free-consultation">{{ __sentences('freeConsultation') }}</v-btn>
            </v-flex>
            <v-flex>
                <v-container pa-5>
                    <v-layout row wrap>
                        <v-flex xs12 md6>
                            <h2 class="display-1 my-3 text-uppercase">{{ __sentences('programBenefits') }}</h2>
                            <v-list>
                                <v-list-tile v-for="benefit in citizenship.benefits" :key="benefit.id">
                                    <v-list-tile-avatar>
                                        <v-icon color="primary">star</v-icon>
                                    </v-list-tile-avatar>
                                    <v-list-tile-title v-text="benefit.detail"></v-list-tile-title>
                                </v-list-tile>
                            </v-list>
                        </v-flex>
                        <v-flex xs12 md6>
                            <v-img src="/assets/img/world_alt.webp" width="100%" alt="Benefits equal happy family"></v-img>
                        </v-flex>
                    </v-layout>
                </v-container>
            </v-flex>
            <v-flex>
                <v-container pa-5>
                    <v-layout row wrap>
                        <v-flex xs12 md8>
                            <h2 class="display-1 my-3 text-uppercase">{{ __sentences('whatDoWeProvide') }}</h2>
                            <v-list>
                                <v-list-tile v-for="supply in citizenship.supplies" :key="supply.id">
                                    <v-list-tile-avatar>
                                        <v-icon color="success">check</v-icon>
                                    </v-list-tile-avatar>
                                    <v-list-tile-title v-text="supply.detail"></v-list-tile-title>
                                </v-list-tile>
                            </v-list>
                        </v-flex>
                        <v-flex xs12 md4 id="free-consultation">
                            <h2 class="display-1 my-3 text-uppercase">{{ __sentences('getFreeConsultation') }}</h2>
                            <v-form ref="form">
                                <v-text-field
                                    v-model="name"
                                    prepend-icon="person"
                                    :label="__words('name')"
                                    required
                                    :counter="30"
                                    :rules="nameRules"
                                    autocomplete="name"
                                    color="primary"
                                ></v-text-field>
                                <v-text-field
                                    v-model="email"
                                    prepend-icon="email"
                                    :label="__words('email')"
                                    required
                                    :rules="emailRules"
                                    autocomplete="email"
                                    color="primary"
                                ></v-text-field>
                                <v-text-field
                                    v-model="phone"
                                    prepend-icon="phone"
                                    :label="__words('phone')"
                                    required
                                    :counter="15"
                                    :rules="phoneRules"
                                    autocomplete="tel"
                                    color="primary"
                                ></v-text-field>
                                <v-btn color="primary" @click="send" :loading="loading">{{ __words('request') }}</v-btn>
                            </v-form>
                        </v-flex>
                    </v-layout>
                </v-container>
            </v-flex>
            <v-flex class="bg-color-dark">
                <citizenship-section :citizenship-collection="citizenshipCollection"></citizenship-section>
            </v-flex>
        </v-layout>

        <snackbar :active="snackbar.active" :color="snackbar.color" :message="snackbar.message"
                  @deactivate="deactivateSnackbar"></snackbar>
    </v-container>
</template>

<script>
    import SnackbarComponent from '../mixins/SnackbarComponent';

    export default {
        name: "Citizenship",
        props: {
            citizenship: {
                required: true,
                type: Object,
            },
            citizenshipCollection: {
                required: true,
                type: Array,
            }
        },
        mixins: [SnackbarComponent],
        data() {
            return {
                height: 500,
                loading: false,
                name: '',
                email: '',
                phone: '',
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
            }
        },
        mounted() {
            this.height = document.documentElement.clientHeight;
        },
        methods: {
            send() {
                if (this.$refs.form.validate()) {
                    let vm = this;
                    vm.loading = true;

                    axios.post(`/${this.$vuetify.lang.current}/countries`, {
                        name: vm.name,
                        email: vm.email,
                        phone: vm.phone,
                    })
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
    .container-fluid {
        padding-left: 0;
        padding-right: 0;
    }

    .intro{
        min-height: 100vh;
        width: 100%;
        background-attachment: fixed;
        background-size: cover;
    }

    .intro-content {
        width: 100%;
        padding: 32px 0;
        background: rgba(20, 21, 46, 0.7);
        text-shadow: 1px 1px #000;
        color: #fff;
    }
</style>