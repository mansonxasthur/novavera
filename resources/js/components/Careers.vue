<template>
    <v-container fluid fill-height>

        <v-layout column align-space-between justify-center>
            <v-flex>
                <div class="intro d-flex">

                    <v-container fill-height fluid>
                        <v-layout fill-height column align-center>
                            <v-flex shrink class="pb-3">
                                <h2 class="display-2 font-weight-black text-uppercase white--text">{{ __words('careers') }}</h2>
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
                                    <h3 class="title primary--text mx-auto font-weight-black">{{ __sentences('applyCv') }}</h3>
                                </v-card-title>
                                <v-card-text>
                                    <v-form ref="form">
                                        <v-layout row wrap>
                                            <v-flex xs12>
                                                <v-layout row wrap>
                                                    <v-flex xs12 pa-1>
                                                        <v-text-field
                                                                v-model="applicant.name"
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
                                                                v-model="applicant.email"
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
                                                                v-model="applicant.phone"
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
                                                        <v-text-field
                                                                v-model="applicant.linkedIn"
                                                                outline
                                                                :label="__sentences('linkedinLink')"
                                                                type="link"
                                                                color="primary"
                                                                prepend-inner-icon="fab fa-linkedin"
                                                        ></v-text-field>
                                                    </v-flex>
                                                    <v-flex xs12 pa-1>
                                                        <v-select
                                                                v-model="applicant.department"
                                                                outline
                                                                :items="departments"
                                                                item-value="id"
                                                                item-text="name"
                                                                :label="__sentences('selectDepartment')"
                                                                color="primary"
                                                                prepend-inner-icon="assignment_ind"
                                                                required
                                                                :rules="departmentRules"
                                                        ></v-select>
                                                    </v-flex>
                                                    <v-flex xs12>
                                                        <span class="right caption red--text">{{ __sentences('pdfOnly') }}</span>
                                                        <input type="file" id="cvUploader" style="display: none"
                                                               accept="application/pdf,application/msword,application/vnd.openxmlformats-officedocument.wordprocessingml.document"
                                                               @change="uploadCv">
                                                        <v-btn
                                                                block
                                                                @click="triggerCvUpload"
                                                                outline
                                                                :color="applicant.cv ? 'green accent-2' : ''"
                                                        >
                                                            <v-icon :right="$vuetify.lang.current === 'ar'" :left="$vuetify.lang.current === 'en'">cloud_upload</v-icon>
                                                            {{ __sentences('uploadCv') }}
                                                        </v-btn>
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
                                    >{{ __words('send') }}</v-btn>
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
        name: "Careers",
        mixins: [SnackbarComponent],
        props: {
            departments: {
                required: true,
                type: Array,
            },
        },
        data() {
            return {
                height: 500,
                loading: false,
                applicant: {
                    name: null,
                    email: null,
                    phone: null,
                    linkedIn: null,
                    department: null,
                    cv: null
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
                departmentRules: [
                    v => !!v || this.__sentences('departmentRules', 'required'),
                ],
            }
        },
        mounted() {
            this.height = document.documentElement.clientHeight;
        },
        methods: {
            triggerCvUpload() {
                document.querySelector('#cvUploader').click();
            },
            uploadCv(e) {
                this.applicant.cv = e.target.files[0];
            },
            send () {
                if (this.$refs.form.validate()) {
                    let vm = this;
                    vm.loading = true;
                    let item = vm.applicant;
                    let applicant = new FormData();

                    Object.keys(item).forEach(key => {

                        if (!!item[key]) {
                            if (key === 'cv') {
                                applicant.append(key, item[key]);
                                return;
                            }

                            applicant.set(key, item[key]);
                        }
                    });

                    axios.post(`/${this.$vuetify.lang.current}/careers`, applicant)
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
                document.querySelector('#cvUploader').value = '';
                this.applicant.cv = null;
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
        background-image: url('/assets/img/career.jpg')
    }

    .intro-content {
        width: 100%;
        padding: 32px 0;
        background: rgba(20, 21, 46, 0.7);
        text-shadow: 1px 1px #000;
        color: #fff;
    }
</style>