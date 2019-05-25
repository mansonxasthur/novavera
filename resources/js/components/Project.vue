<template>
    <v-container fluid>
        <v-layout column>
            <v-flex>
                <v-layout row wrap>
                    <v-flex xs12 md8 pa-3>
                        <slider :slider-images="project.images ? project.images : []" src="image_url" height="auto"></slider>
                    </v-flex>
                    <v-flex xs12 md4 pa-3 grow>
                        <v-layout column align-space-between grey lighten-4>
                            <v-flex>
                                <v-layout row justify-center>
                                    <v-flex shrink>
                                        <v-avatar size="160" class="mt-5" tile>
                                            <img :src="project.logo_url !== '' ? project.logo_url : project.developer.logo_url" :alt="project.name">
                                        </v-avatar>
                                    </v-flex>
                                </v-layout>
                            </v-flex>
                            <v-flex text-xs-center py-3>
                                <h3 class="title mb-2">{{ __sentences('startingPrice' )}}</h3>
                                <h2 class="display-1">{{ project.price }} <small>{{ __sentences('egyptianPound') }}</small></h2>
                            </v-flex>
                            <v-flex py-5>
                                <v-layout row wrap>
                                    <v-flex xs12 md6>
                                        <v-layout column align-space-between>
                                            <v-flex class="nova-primary-bg pa-3 my-3" v-for="property in project.property_types" :key="property.id">
                                                <h4 class="title white--text">{{ property.name }}</h4>
                                            </v-flex>
                                        </v-layout>
                                    </v-flex>
                                    <v-flex xs12 md6>
                                        <v-layout column align-center justify-center text-xs-center>
                                            <v-flex py-2 v-if="project.down_payment">
                                                <h5 class="subheading">{{ __sentences('downPayment') }}</h5>
                                                <h3 class="display-1">{{ project.down_payment }}</h3>
                                            </v-flex>
                                            <v-flex py-2 v-if="project.installment_years">
                                                <h5 class="subheading">{{ __sentences('installmentYears') }}</h5>
                                                <h3 class="display-1">{{ project.installment_years}}</h3>
                                            </v-flex>
                                            <v-flex py-2 v-if="project.delivery_date">
                                                <h5 class="subheading">{{ __sentences('deliveryDate') }}</h5>
                                                <h3 class="display-1">{{ project.delivery_date }}</h3>
                                            </v-flex>
                                        </v-layout>
                                    </v-flex>
                                    <v-flex xs12 style="direction: ltr">
                                        <v-btn
                                                href="tel:+201020166669"
                                                large
                                                block
                                                color="primary"
                                        >
                                            <v-icon left>phone</v-icon>
                                            (+20) 101 969 9911</v-btn>
                                    </v-flex>
                                    <v-flex xs12>
                                        <v-btn
                                                large
                                                block
                                                color="primary"
                                                @click="ask"
                                        >
                                            <v-icon :left="$vuetify.lang.current === 'en'" :right="$vuetify.lang.current === 'ar'">message</v-icon>
                                            {{ __sentences('askNow') }}</v-btn>
                                    </v-flex>
                                </v-layout>
                            </v-flex>
                        </v-layout>
                    </v-flex>
                </v-layout>
            </v-flex>
            <v-flex pa-4>
                <h2 class="display-1 project-name pl-3">{{ project.name }}</h2>
                <v-layout row wrap>
                    <v-flex xs12 sm3>
                        <v-layout column>
                            <v-flex text-xs-center my-5 class="developer">
                                <h5 class="title mb-3">{{ __sentences('developedBy') }}</h5>
                                <v-avatar size="150" tile>
                                    <img :src="project.developer.logo_url" :alt="project.developer.name" :title="project.developer.name">
                                </v-avatar>
                            </v-flex>
                        </v-layout>
                    </v-flex>
                    <v-flex xs12 sm9 px-4>
                        <v-layout column align-space-between>
                            <v-flex my-5>
                                <div class="body-1" v-html="project.description"></div>
                            </v-flex>
                            <v-flex>
                                <div id="map"></div>
                            </v-flex>
                        </v-layout>
                    </v-flex>
                </v-layout>
            </v-flex>
        </v-layout>
        <v-dialog v-model="dialog" width="600px" max-width="100%" persistent>
            <v-card>
                <v-card-title>
                    <h4 class="headline">{{ __sentences('askNow') }}</h4>
                </v-card-title>
                <v-divider></v-divider>
                <v-card-text>
                    <v-form ref="form">
                        <v-layout row wrap>
                            <v-flex xs12>
                                <v-text-field
                                    type="text"
                                    :label="__words('name')"
                                    prepend-inner-icon="person"
                                    v-model="inquiry.name"
                                    autocomplete="name"
                                    color="primary"
                                    required
                                    :rules="nameRules"
                                    :counter="30"
                                ></v-text-field>
                            </v-flex>
                            <v-flex xs12>
                                <v-text-field
                                        type="email"
                                        :label="__words('email')"
                                        prepend-inner-icon="email"
                                        v-model="inquiry.email"
                                        autocomplete="email"
                                        color="primary"
                                        required
                                        :rules="emailRules"
                                ></v-text-field>
                            </v-flex>
                            <v-flex xs12>
                                <v-textarea
                                        :label="__words('message')"
                                        prepend-inner-icon="message"
                                        v-model="inquiry.message"
                                        color="primary"
                                        required
                                        :rules="messageRules"
                                        :counter="150"
                                ></v-textarea>
                            </v-flex>
                        </v-layout>
                    </v-form>
                </v-card-text>
                <v-card-actions>
                    <v-spacer></v-spacer>
                    <v-btn color="primary" @click="dialog = !dialog" class="mx-1">{{ __words('close') }}</v-btn>
                    <v-btn color="primary" @click="send" :loading="loading">{{ __words('send') }}</v-btn>
                </v-card-actions>
            </v-card>
        </v-dialog>

        <snackbar :active="snackbar.active" :color="snackbar.color" :message="snackbar.message"
                  @deactivate="deactivateSnackbar"></snackbar>
    </v-container>
</template>

<script>
    import gmapsInit from '../util/gmaps';
    import SnackbarComponent from '../mixins/SnackbarComponent';
    export default {
        name: "Project",
        mixins: [SnackbarComponent],
        props: {
            project: {
                required: true,
                type: Object,
            }
        },
        data() {
            return {
                dialog: false,
                loading: false,
                inquiry: {
                    name: '',
                    email: '',
                    message: '',
                    project: '',
                    location: '',
                },
                nameRules: [
                    v => !!v || this.__sentences('nameRules', 'required'),
                    v => (v && v.length <= 30) || this.__sentences('nameRules', 'length', '30')
                ],
                emailRules: [
                    v => !!v || this.__sentences('emailRules', 'required'),
                    v => /.+@.+/.test(v) || this.__sentences('emailRules', 'valid'),
                ],
                messageRules: [
                    v => !!v || this.__sentences('messageRules', 'required'),
                    v => (v && v.length <= 150) || this.__sentences('messageRules', 'lengthMax', '150'),
                    v => (v && v.length >= 10) || this.__sentences('messageRules', 'lengthMin', '10')
                ],
            }
        },
        async mounted() {
            try {
                const google = await gmapsInit();
                const geocoder = new google.maps.Geocoder();
                const map = new google.maps.Map(document.getElementById('map'), {
                    center: {lat: Number(this.project.lat), lng: Number(this.project.lng)},
                    zoom: 16
                });

            } catch (error) {
                //console.error(error);
            }

            this.inquiry.project = this.project.name;
            this.inquiry.location = this.project.location.name;
        },
        methods: {
            ask() {
                this.dialog = true;
            },
            send () {
                if (this.$refs.form.validate()) {
                    let vm = this;
                    vm.loading = true;
                    axios.post(`/${this.$vuetify.lang.current}/contact/project`, vm.inquiry)
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
                this.dialog = false;
                this.loading = false;
            },
            resetValidation () {
                this.$refs.form.resetValidation()
            }
        },
    }
</script>

<style scoped>
    .project-name {
        border-left: 3px #cc0000 solid;
    }

    .developer {
        border-right: 3px #14152E solid;
    }

    #map {
        height: 500px;
    }
</style>