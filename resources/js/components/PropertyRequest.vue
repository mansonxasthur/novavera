<template>
    <v-container fluid fill-height>

        <v-layout column align-space-between justify-center>
            <v-flex>
                <div class="intro d-flex">

                    <v-container fill-height fluid>
                        <v-layout fill-height column align-center>
                            <v-flex shrink class="pb-3">
                                <h2 class="display-2 font-weight-black text-uppercase white--text">{{ __sentences('propertyRequests') }}</h2>
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
                <v-container>
                    <v-layout row justify-center>
                        <v-flex xs12 sm10 md8 pa-4>
                            <v-card hover>
                                <v-card-title>
                                    <h3 class="title primary--text mx-auto font-weight-black">{{ __sentences('applyRequest') }}</h3>
                                </v-card-title>
                                <v-card-text>
                                    <v-form ref="form">
                                        <v-layout row wrap>
                                            <v-flex xs12>
                                                <v-layout row wrap>
                                                    <v-flex xs12 pa-1>
                                                        <v-text-field
                                                                v-model="request.name"
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
                                                    <v-flex xs12 pa-1>
                                                        <v-text-field
                                                                v-model="request.email"
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
                                                        <v-text-field
                                                                v-model="request.phone"
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
                                                    <v-flex xs12 pa-1>
                                                        <v-select
                                                                v-model="location"
                                                                outline
                                                                :items="locations"
                                                                item-value="id"
                                                                item-text="name"
                                                                :label="__sentences('selectLocation')"
                                                                color="primary"
                                                                prepend-inner-icon="location_on"
                                                                required
                                                                :rules="locationRules"
                                                        ></v-select>
                                                    </v-flex>
                                                    <v-flex xs12 pa-1>
                                                        <v-select
                                                                v-model="request.project"
                                                                outline
                                                                :items="projects"
                                                                item-value="id"
                                                                item-text="name"
                                                                :label="__sentences('selectProject')"
                                                                color="primary"
                                                                prepend-inner-icon="business"
                                                                required
                                                                :rules="projectRules"
                                                                :disabled="!projects.length"
                                                        ></v-select>
                                                    </v-flex>
                                                    <v-flex xs12 pa-1>
                                                        <v-select
                                                                v-model="request.property"
                                                                outline
                                                                :items="propertyTypes"
                                                                item-value="id"
                                                                item-text="name"
                                                                :label="__sentences('selectedPropertyType')"
                                                                color="primary"
                                                                prepend-inner-icon="account_balance"
                                                                required
                                                                :rules="propertyRules"
                                                                :disabled="!propertyTypes.length"
                                                        ></v-select>
                                                    </v-flex>
                                                    <v-flex xs12 pa-1>
                                                        <v-textarea
                                                                v-model="request.message"
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
                                    > {{ __words('send') }}
                                    </v-btn>
                                </v-card-actions>
                            </v-card>
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
        props: {
            locations: {
                required: true,
                type: Array,
            }
        },
        data() {
            return {
                height: 500,
                loading: false,
                request: {
                    name: null,
                    email: null,
                    phone: null,
                    project: null,
                    property: null,
                    message: null
                },
                location: null,
                projects: [],
                propertyTypes: [],
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
                locationRules: [
                    v => !!v || 'Location is required',
                ],
                projectRules: [
                    v => !!v || 'Project is required',
                ],
                propertyRules: [
                    v => !!v || 'Property Type is required',
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
                    let item = vm.request;
                    let request = new FormData();

                    Object.keys(item).forEach(key => {

                        if (!!item[key]) {
                            request.set(key, item[key]);
                        }
                    });

                    axios.post(`/${this.$vuetify.lang.current}/property-requests`, request)
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
                this.projects = [];
                this.propertyTypes = [];
            },
            resetValidation() {
                this.$refs.form.resetValidation()
            }
        },
        watch: {
            location(val) {
                if (val !== null && typeof val !== 'undefined') {
                    let location = this.locations.filter(location => location.id === val);
                    this.projects = location[0].projects;
                }
            },
            projects(val) {
              this.request.project = null;
            },
            'request.project': function(val) {
                if (val !== null && typeof val !== 'undefined') {
                    let project = this.projects.filter(project => project.id === val);
                    this.propertyTypes = project[0].property_types;
                } else {
                    this.propertyTypes = [];
                }
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
        background-image: url('/assets/img/property.webp')
    }

    .intro-content {
        width: 100%;
        padding: 32px 0;
        background: rgba(20, 21, 46, 0.7);
        text-shadow: 1px 1px #000;
        color: #fff;
    }
</style>