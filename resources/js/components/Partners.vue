<template>
    <v-container fluid fill-height>

        <v-layout column align-space-between justify-center>
            <v-flex>
                <div class="intro d-flex">

                    <v-container fill-height fluid>
                        <v-layout fill-height column align-center>
                            <v-flex shrink class="pb-3">
                                <h2 class="display-2 font-weight-black text-uppercase white--text">{{ __sentences('becomePartner') }}</h2>
                            </v-flex>
                            <v-flex shrink
                                    class="red darken-2"
                                    style="height: 4px; width: 55px">
                            </v-flex>
                        </v-layout>
                    </v-container>

                </div>
            </v-flex>

            <v-flex my-4>
                <v-container grid-list-lg>
                    <v-layout row wrap justify-center>
                        <v-flex xs12>
                            <v-container grid-list-lg>
                                <v-layout column align-center>
                                    <v-flex>
                                        <h3 class="display-1 text-uppercase font-weight-black primary--text my-4">{{ __words('partners') }}</h3>
                                    </v-flex>
                                    <v-flex>
                                        <v-layout row wrap justify-space-around>
                                            <v-flex xs12 md4>
                                                <p class="title" style="line-height: 1.5em!important;">
                                                    {{ __sentences('partnersTitle1') }}
                                                </p>
                                            </v-flex>
                                            <v-flex xs12 md4>
                                                <p class="title" style="line-height: 1.5em!important;">
                                                    {{ __sentences('partnersTitle2') }}
                                                </p>
                                            </v-flex>
                                        </v-layout>
                                    </v-flex>
                                </v-layout>
                            </v-container>
                        </v-flex>
                        <v-flex xs12>
                            <v-container grid-list-lg>
                                <v-layout column align-center>
                                    <v-flex>
                                        <h2 class="display-1 font-weight-black text-uppercase primary--text my-4">{{ __sentences('partnerBenefits') }}</h2>
                                    </v-flex>
                                    <v-flex id="benefits-list">
                                        <v-container grid-list-lg>
                                            <v-layout row wrap>
                                                <v-flex xs12 sm6 md4>
                                                    <v-layout column align-center>
                                                        <v-flex>
                                                            <v-icon large>fas fa-home</v-icon>
                                                        </v-flex>
                                                        <v-flex text-xs-center>
                                                            <p class="title" style="line-height: 1.5em!important;">
                                                                {{ __sentences('partnerBenefit1') }}
                                                            </p>
                                                        </v-flex>
                                                    </v-layout>
                                                </v-flex>
                                                <v-flex xs12 sm6 md4>
                                                    <v-layout column align-center>
                                                        <v-flex>
                                                            <v-icon large>fas fa-globe-europe</v-icon>
                                                        </v-flex>
                                                        <v-flex text-xs-center>
                                                            <p class="title" style="line-height: 1.5em!important;">
                                                                {{ __sentences('partnerBenefit2') }}
                                                            </p>
                                                        </v-flex>
                                                    </v-layout>
                                                </v-flex>
                                                <v-flex xs12 sm6 md4>
                                                    <v-layout column align-center>
                                                        <v-flex>
                                                            <v-icon large>fas fa-unlock-alt</v-icon>
                                                        </v-flex>
                                                        <v-flex text-xs-center>
                                                            <p class="title" style="line-height: 1.5em!important;">
                                                                {{ __sentences('partnerBenefit3') }}
                                                            </p>
                                                        </v-flex>
                                                    </v-layout>
                                                </v-flex>
                                                <v-flex xs12 sm6 md4>
                                                    <v-layout column align-center>
                                                        <v-flex>
                                                            <v-icon large>far fa-handshake</v-icon>
                                                        </v-flex>
                                                        <v-flex text-xs-center>
                                                            <p class="title" style="line-height: 1.5em!important;">
                                                                {{ __sentences('partnerBenefit4') }}
                                                            </p>
                                                        </v-flex>
                                                    </v-layout>
                                                </v-flex>
                                                <v-flex xs12 sm6 md4>
                                                    <v-layout column align-center>
                                                        <v-flex>
                                                            <v-icon large>fas fa-hand-holding-usd</v-icon>
                                                        </v-flex>
                                                        <v-flex text-xs-center>
                                                            <p class="title" style="line-height: 1.5em!important;">
                                                                {{ __sentences('partnerBenefit5') }}
                                                            </p>
                                                        </v-flex>
                                                    </v-layout>
                                                </v-flex>
                                                <v-flex xs12 sm6 md4>
                                                    <v-layout column align-center>
                                                        <v-flex>
                                                            <v-icon large>fas fa-medal</v-icon>
                                                        </v-flex>
                                                        <v-flex text-xs-center>
                                                            <p class="title" style="line-height: 1.5em!important;">
                                                                {{ __sentences('partnerBenefit6') }}
                                                            </p>
                                                        </v-flex>
                                                    </v-layout>
                                                </v-flex>
                                            </v-layout>
                                        </v-container>
                                    </v-flex>
                                </v-layout>
                            </v-container>
                        </v-flex>
                        <v-flex xs12>
                            <v-layout row wrap>
                                <v-flex xs12 md6>
                                    <v-container grid-list-lg>
                                        <v-layout column align-center>
                                            <v-flex>
                                                <h2 class="display-1 font-weight-black text-uppercase primary--text my-3">{{ __sentences('contactDetails') }}</h2>
                                            </v-flex>
                                            <v-flex>
                                                <v-layout row wrap justify-space-around>
                                                    <v-flex xs12 md4>
                                                        <v-layout column align-center>
                                                            <v-flex>
                                                                <v-icon large color="primary">phone</v-icon>
                                                            </v-flex>
                                                            <v-flex text-xs-center style="direction: ltr">
                                                                <p class="subheading">(+20) 101 969 9911</p>
                                                            </v-flex>
                                                        </v-layout>
                                                    </v-flex>
                                                    <v-flex xs12 md4>
                                                        <v-layout column align-center>
                                                            <v-flex>
                                                                <v-icon large color="primary">email</v-icon>
                                                            </v-flex>
                                                            <v-flex text-xs-center>
                                                                <p class="subheading">realestate@novavera.com</p>
                                                            </v-flex>
                                                        </v-layout>
                                                    </v-flex>
                                                    <v-flex xs12 md8>
                                                        <v-layout column align-center>
                                                            <v-flex>
                                                                <v-icon large color="primary">location_on</v-icon>
                                                            </v-flex>
                                                            <v-flex text-xs-center>
                                                                <p class="subheading">{{ __sentences('address') }}</p>
                                                            </v-flex>
                                                        </v-layout>
                                                    </v-flex>
                                                </v-layout>
                                            </v-flex>
                                        </v-layout>
                                    </v-container>
                                </v-flex>
                                <v-flex xs12 md6>
                                    <v-card flat hover>
                                        <v-card-title>
                                            <h2 class="display-1 font-weight-black text-uppercase primary--text my-4 mx-auto">{{ __sentences('becomePartner') }}</h2>
                                        </v-card-title>
                                        <v-card-text>
                                            <v-form ref="form">
                                                <v-layout row wrap>
                                                    <v-flex xs12>
                                                        <v-layout row wrap>
                                                            <v-flex xs12 md6 pa-1>
                                                                <v-text-field
                                                                        v-model="partner.name"
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
                                                                        v-model="partner.phone"
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
                                                                <v-text-field
                                                                        v-model="partner.companyName"
                                                                        outline
                                                                        :label="__sentences('companyName')"
                                                                        type="text"
                                                                        color="primary"
                                                                        autocomplete="organization"
                                                                        prepend-inner-icon="person"
                                                                        required
                                                                        :rules="companyRules"
                                                                        :counter="50"
                                                                ></v-text-field>
                                                            </v-flex>
                                                            <v-flex xs12 md6 pa-1>
                                                                <v-text-field
                                                                        v-model="partner.jobTitle"
                                                                        outline
                                                                        :label="__sentences('jobTitle')"
                                                                        type="text"
                                                                        color="primary"
                                                                        autocomplete="title"
                                                                        prepend-inner-icon="person"
                                                                        required
                                                                        :rules="jobRules"
                                                                        :counter="50"
                                                                ></v-text-field>
                                                            </v-flex>
                                                            <v-flex xs12 pa-1>
                                                                <v-text-field
                                                                        v-model="partner.email"
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
                                                            <v-flex xs12 pa-1>
                                                                <v-textarea
                                                                        v-model="partner.message"
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
                                                    </v-flex>
                                                </v-layout>
                                            </v-form>
                                        </v-card-text>
                                        <v-card-actions>
                                            <v-spacer></v-spacer>
                                            <v-btn
                                                    color="primary"
                                                    class="mx-2"
                                                    :loading="loading"
                                                    @click.stop="send()"
                                            >{{ __words('send') }}
                                            </v-btn>
                                        </v-card-actions>
                                    </v-card>
                                </v-flex>
                            </v-layout>
                        </v-flex>
                    </v-layout>
                </v-container>
            </v-flex>

        </v-layout>

        <snackbar :active="snackbar.active" :color="snackbar.color" :message="snackbar.message"
                  @deactivate="deactivateSnackbar"></snackbar>
    </v-container>
</template>

<script>
    import SnackbarComponent from '../mixins/SnackbarComponent';

    export default {
        name: "PropertyRequest",
        mixins: [SnackbarComponent],
        data() {
            return {
                height: 500,
                loading: false,
                partner: {
                    name: null,
                    email: null,
                    phone: null,
                    companyName: null,
                    jobTitle: null,
                    message: null
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
                companyRules: [
                    v => !!v || this.__sentences('companyRules', 'required'),
                    v => (v && v.length <= 50) || this.__sentences('companyRules', 'length', '50')
                ],
                jobRules: [
                    v => !!v || this.__sentences('jobRules', 'required'),
                    v => (v && v.length <= 50) || this.__sentences('jobRules', 'length', '50')
                ],
                messageRules: [
                    v => !!v || this.__sentences('messageRules', 'required'),
                    v => (v && v.length <= 150) || this.__sentences('messageRules', 'lengthMax', '150'),
                    v => (v && v.length >= 10) || this.__sentences('messageRules', 'lengthMin', '10')
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

                    axios.post(`/${this.$vuetify.lang.current}/partners`, vm.partner)
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
            reset() {
                this.$refs.form.reset();
                this.loading = false;
            },
            resetValidation() {
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

    .intro {
        min-height: 70vh;
        width: 100%;
        background-attachment: fixed;
        background-size: cover;
        background-image: url('/assets/img/partners.webp')
    }

    .intro-content {
        width: 100%;
        padding: 32px 0;
        background: rgba(20, 21, 46, 0.7);
        text-shadow: 1px 1px #000;
        color: #fff;
    }

    #benefits-list .v-icon {
        font-size: 50px!important;
        color: #14152E;
    }
</style>