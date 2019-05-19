<template xmlns:v-slot="http://www.w3.org/1999/XSL/Transform">
    <v-container fluid>
        <v-layout class="py-5 mt-3 mb-5">
            <v-card>
                <v-card-title>
                    <v-flex class="text-xs-center mb-5">
                        <div class="display-1">
                            New Citizenship
                        </div>
                    </v-flex>
                </v-card-title>
                <v-card-text>
                    <v-form ref="form">
                        <v-container grid-list-md>
                            <v-layout row wrap height="300px">
                                <v-flex xs12>
                                    <v-layout row wrap>

                                        <v-flex xs12 md6 class="my-3">
                                            <v-text-field
                                                    v-model="citizenship.country_name"
                                                    :counter="30"
                                                    :rules="nameRules"
                                                    label="Country Name"
                                                    required
                                            ></v-text-field>
                                        </v-flex>
                                        <v-flex xs12 md6 class="my-3">
                                            <v-text-field
                                                    v-model="citizenship.translation.country_name"
                                                    :counter="30"
                                                    :rules="nameRules"
                                                    label="أسم الدولة"
                                                    required
                                            ></v-text-field>
                                        </v-flex>

                                        <v-flex xs12 md6 class="my-3">
                                            <v-text-field
                                                    v-model="citizenship.title"
                                                    :counter="50"
                                                    :rules="titleRules"
                                                    label="Title"
                                                    required
                                            ></v-text-field>
                                        </v-flex>
                                        <v-flex xs12 md6 class="my-3">
                                            <v-text-field
                                                    v-model="citizenship.translation.title"
                                                    :counter="50"
                                                    :rules="titleRules"
                                                    label="العنوان"
                                                    required
                                            ></v-text-field>
                                        </v-flex>

                                        <v-flex xs12 md6 class="my-3">
                                            <v-textarea
                                                    v-model="citizenship.snippet"
                                                    :counter="150"
                                                    :rules="snippetRules"
                                                    label="Snippet"
                                                    required
                                            ></v-textarea>
                                        </v-flex>
                                        <v-flex xs12 md6 class="my-3">
                                            <v-textarea
                                                    v-model="citizenship.translation.snippet"
                                                    :counter="150"
                                                    :rules="snippetRules"
                                                    label="قصاصة"
                                                    required
                                            ></v-textarea>
                                        </v-flex>

                                        <v-flex xs12 class="my-3">
                                            <v-select
                                                    v-model="citizenship.type"
                                                    :items="citizenshipTypes"
                                                    item-text="text"
                                                    item-value="value"
                                                    label="Citizenship Type"
                                                    required
                                            ></v-select>
                                        </v-flex>

                                        <!-- Benefits -->

                                        <v-flex xs12 class="my-3">
                                            <v-form ref="benefitForm">
                                                <v-layout row wrap justify-space-between>
                                                    <v-flex xs12 md5>
                                                        <v-text-field
                                                                v-model="benefit.en"
                                                                :counter="80"
                                                                :rules="benefitRules"
                                                                label="Benefit"
                                                                required
                                                        ></v-text-field>
                                                    </v-flex>
                                                    <v-flex xs12 md5>
                                                        <v-text-field
                                                                v-model="benefit.ar"
                                                                :counter="80"
                                                                :rules="benefitRules"
                                                                label="ميزة"
                                                                required
                                                        ></v-text-field>
                                                    </v-flex>
                                                    <v-flex>
                                                        <v-btn dark small color="blue darken-4" @click="addBenefit"
                                                               class="left mt-3">
                                                            <v-icon left small>add</v-icon> Add Benefit
                                                        </v-btn>
                                                    </v-flex>
                                                </v-layout>
                                            </v-form>
                                        </v-flex>

                                        <v-flex xs12 v-if="benefits.length">

                                                <v-layout row wrap>
                                                    <v-flex xs12 v-for="(benefit, i) in benefits" :key="i" mb-2>
                                                        <v-card dark>
                                                        <v-layout row wrap justify-space-between>
                                                            <v-flex xs12 md5 pa-4>
                                                                <div class="title">
                                                                    <v-icon small dark class="pa-1">star</v-icon>
                                                                    {{ benefit.en }}
                                                                </div>
                                                            </v-flex>
                                                            <v-flex xs12 md5 style="direction: rtl" pa-4>
                                                                <div class="title">
                                                                    <v-icon small dark class="pa-1">star</v-icon>
                                                                    {{ benefit.ar }}
                                                                </div>
                                                            </v-flex>
                                                            <v-flex>
                                                                <v-btn fab dark small color="red darken-4"
                                                                       @click="removeBenefit(benefit)" class="right">
                                                                    <v-icon small>remove</v-icon>
                                                                </v-btn>
                                                            </v-flex>
                                                        </v-layout>
                                                        </v-card>
                                                    </v-flex>
                                                </v-layout>

                                        </v-flex>

                                        <!-- Supplies -->
                                        <v-flex xs12 class="my-3">
                                            <v-form ref="supplyForm">
                                                <v-layout row wrap justify-space-between>
                                                    <v-flex xs12 md5>
                                                        <v-text-field
                                                                v-model="supply.en"
                                                                :counter="80"
                                                                :rules="supplyRules"
                                                                label="Provide"
                                                                required
                                                        ></v-text-field>
                                                    </v-flex>
                                                    <v-flex xs12 md5>
                                                        <v-text-field
                                                                v-model="supply.ar"
                                                                :counter="80"
                                                                :rules="supplyRules"
                                                                label="يوفر"
                                                                required
                                                        ></v-text-field>
                                                    </v-flex>
                                                    <v-flex>
                                                        <v-btn dark small color="blue darken-4" @click="addSupply"
                                                               class="left mt-3">
                                                            <v-icon left small>add</v-icon> Add Supply
                                                        </v-btn>
                                                    </v-flex>
                                                </v-layout>
                                            </v-form>
                                        </v-flex>

                                        <v-flex xs12 v-if="supplies.length">

                                            <v-layout row wrap>
                                                <v-flex xs12 v-for="(supply, i) in supplies" :key="i" mb-2>
                                                    <v-card dark>
                                                        <v-layout row wrap justify-space-between>
                                                            <v-flex xs12 md5 pa-4>
                                                                <div class="title">
                                                                    <v-icon small dark class="pa-1">star</v-icon>
                                                                    {{ supply.en }}
                                                                </div>
                                                            </v-flex>
                                                            <v-flex xs12 md5 style="direction: rtl" pa-4>
                                                                <div class="title">
                                                                    <v-icon small dark class="pa-1">star</v-icon>
                                                                    {{ supply.ar }}
                                                                </div>
                                                            </v-flex>
                                                            <v-flex>
                                                                <v-btn fab dark small color="red darken-4"
                                                                       @click="removeSupply(supply)" class="right">
                                                                    <v-icon small>remove</v-icon>
                                                                </v-btn>
                                                            </v-flex>
                                                        </v-layout>
                                                    </v-card>
                                                </v-flex>
                                            </v-layout>

                                        </v-flex>

                                    </v-layout>
                                </v-flex>
                                <v-flex xs12 class="mt-5">
                                    <v-layout row wrap>
                                        <v-flex xs12 md6>
                                            <v-layout row wrap>
                                                <v-flex xs12 class="text-xs-center">
                                                    <div class="display-1 grey--text">Description</div>
                                                </v-flex>
                                                <v-flex xs12>
                                                    <div id="englishEditor"></div>
                                                </v-flex>
                                            </v-layout>
                                        </v-flex>
                                        <v-flex xs12 md6>
                                            <v-layout row wrap>
                                                <v-flex xs12 class="text-xs-center">
                                                    <div class="display-1 grey--text">الوصف</div>
                                                </v-flex>
                                                <v-flex xs12>
                                                    <div id="arabicEditor"></div>
                                                </v-flex>
                                            </v-layout>
                                        </v-flex>
                                        <v-flex xs12>
                                            <v-layout row wrap>
                                                <v-flex xs12 md6>
                                                    <v-textarea
                                                            v-model="citizenship.meta"
                                                            label="Meta Description"
                                                    ></v-textarea>
                                                </v-flex>
                                                <v-flex xs12 md6>
                                                    <v-textarea
                                                            v-model="citizenship.keywords"
                                                            label="Keywords"
                                                    ></v-textarea>
                                                </v-flex>
                                            </v-layout>
                                        </v-flex>
                                    </v-layout>
                                </v-flex>
                                <v-flex xs12 md6 class="mt-3">
                                    <v-layout row wrap>
                                        <v-flex xs12 md6>
                                            <input type="file" id="headerUploader" style="visibility: hidden"
                                                   accept="image/png, image/jpeg, image/webp, image/jpg, image/svg+xml"
                                                   @change="uploadHeader">
                                            <v-btn
                                                    color="deep-orange accent-3"
                                                    outline
                                                    @click="triggerHeaderUpload"
                                            >
                                                Upload Header
                                                <v-icon right>cloud_upload</v-icon>
                                            </v-btn>
                                        </v-flex>
                                        <v-flex xs12 md6>
                                            <v-img :src="previewHeader" width="auto" v-if="previewHeader !== ''">
                                                <v-btn fab dark small color="primary"
                                                       style="position: absolute;top: 0;right: 0;"
                                                       @click="removeHeader">
                                                    <v-icon dark>remove</v-icon>
                                                </v-btn>
                                            </v-img>
                                        </v-flex>
                                    </v-layout>
                                </v-flex>
                                <v-flex xs12 md6 class="mt-3">
                                    <v-layout row wrap>
                                        <v-flex xs12 md6>
                                            <input type="file" id="flagUploader" style="visibility: hidden"
                                                   accept="image/png, image/jpeg, image/webp, image/jpg, image/svg+xml"
                                                   @change="uploadFlag">
                                            <v-btn
                                                    color="deep-orange accent-3"
                                                    outline
                                                    @click="triggerFlagUpload"
                                            >
                                                Upload Flag
                                                <v-icon right>cloud_upload</v-icon>
                                            </v-btn>
                                        </v-flex>
                                        <v-flex xs12 md6>
                                            <v-img :src="previewFlag" width="auto" v-if="previewFlag !== ''">
                                                <v-btn fab dark small color="primary"
                                                       style="position: absolute;top: 0;right: 0;"
                                                       @click="removeFlag">
                                                    <v-icon dark>remove</v-icon>
                                                </v-btn>
                                            </v-img>
                                        </v-flex>
                                    </v-layout>
                                </v-flex>
                            </v-layout>
                        </v-container>
                    </v-form>
                </v-card-text>
                <v-card-actions class="py-4 mt-5">
                    <v-spacer></v-spacer>
                    <v-btn outline color="primary" @click="post" :loading="loading">
                        Create Citizenship
                    </v-btn>
                </v-card-actions>
            </v-card>
        </v-layout>
        <snackbar :active="snackbar.active" :color="snackbar.color" :message="snackbar.message"
                  @deactivate="deactivateSnackbar"></snackbar>
    </v-container>
</template>

<script>
    import SnackbarComponent from '../../../mixins/SnackbarComponent';

    export default {
        name: "CreateCitizenship",
        mixins: [SnackbarComponent],
        data() {
            return {
                loading: false,
                citizenshipTypes: [
                    {
                        value: 'citizenship',
                        text: 'Citizenship'
                    },
                    {
                        value: 'residency',
                        text: 'Residency'
                    },
                    {
                        value: 'both',
                        text: 'Both'
                    },
                ],
                nameRules: [
                    v => !!v || 'Name is required',
                    v => (v && v.length <= 30) || 'Name must be less than 30 characters'
                ],
                titleRules: [
                    v => !!v || 'Title is required',
                    v => (v && v.length <= 50) || 'Name must be less than 50 characters'
                ],
                snippetRules: [
                    v => !!v || 'Snippet is required',
                    v => (v && v.length <= 150) || 'Name must be less than 150 characters'
                ],
                benefitRules: [
                    v => !!v || 'Benefit is required',
                    v => (v && v.length <= 80) || 'Name must be less than 80 characters'
                ],
                supplyRules: [
                    v => !!v || 'Supply is required',
                    v => (v && v.length <= 80) || 'Name must be less than 80 characters'
                ],
                citizenship: {
                    country_name: null,
                    title: null,
                    description: null,
                    snippet: null,
                    meta: null,
                    keywords: null,
                    type: null,
                    flag: null,
                    header: null,
                    translation: {
                        country_name: null,
                        title: null,
                        description: null,
                        snippet: null,
                    }
                },
                benefits: [],
                benefit: {
                    en: null,
                    ar: null,
                },
                supplies: [],
                supply: {
                    en: null,
                    ar: null,
                },
                previewFlag: '',
                previewHeader: '',
            }
        },
        created() {
            let vm = this;
            $(document).ready(function () {
                $('#englishEditor').summernote({
                    height: 300,
                    codemirror: {
                        mode: 'text/html',
                        htmlMode: true,
                        lineNumbers: true,
                        theme: 'monokai'
                    },
                    callbacks: {
                        onChange: function (contents) {
                            vm.citizenship.description = contents;
                        }
                    }
                });
                $('#arabicEditor').summernote({
                    height: 300,
                    codemirror: {
                        mode: 'text/html',
                        htmlMode: true,
                        lineNumbers: true,
                        theme: 'monokai'
                    },
                    callbacks: {
                        onChange: function (contents) {
                            vm.citizenship.translation.description = contents;
                        }
                    }
                });
            });
        },
        methods: {
            triggerFlagUpload() {
                document.querySelector('#flagUploader').click();
            },
            uploadFlag(e) {
                let vm = this;
                let flag = e.target.files[0]; //sames as here


                vm.citizenship.flag = flag;

                let reader = new FileReader();
                reader.onloadend = function () {
                    vm.previewFlag = reader.result;
                };

                if (flag) {
                    reader.readAsDataURL(flag); //reads the data as a URL
                } else {
                    vm.previewFlag = '';
                }

                e.target.value = '';
            },
            removeFlag() {
                this.previewFlag = '';
                this.citizenship.flag = null;
            },
            triggerHeaderUpload() {
                document.querySelector('#headerUploader').click();
            },
            uploadHeader(e) {
                let vm = this;
                let header = e.target.files[0]; //sames as here


                vm.citizenship.header = header;

                let reader = new FileReader();
                reader.onloadend = function () {
                    vm.previewHeader = reader.result;
                };

                if (header) {
                    reader.readAsDataURL(header); //reads the data as a URL
                } else {
                    vm.previewHeader = '';
                }

                e.target.value = '';
            },
            removeHeader() {
                this.previewHeader = '';
                this.citizenship.header = null
            },
            // Benefits methods
            addBenefit() {
                let form = this.$refs.benefitForm;
                if (form.validate()) {
                    let benefit = {};
                    benefit.en = this.benefit.en;
                    benefit.ar = this.benefit.ar;
                    try {
                        if (this.benefits.push(benefit)) {
                            form.reset();
                            form.resetValidation();
                        }

                    } catch (e) {
                        console.log(e);
                    }
                }
            },
            removeBenefit(benefit) {
                let i = this.benefits.indexOf(benefit);
                this.benefits.splice(i, 1);
            },
            // Supplies methods
            addSupply() {
                let form = this.$refs.supplyForm;
                if (form.validate()) {
                    let supply = {};
                    supply.en = this.supply.en;
                    supply.ar = this.supply.ar;
                    try {
                        if (this.supplies.push(supply)) {
                            form.reset();
                            form.resetValidation();
                        }

                    } catch (e) {
                        console.log(e);
                    }
                }
            },
            removeSupply(supply) {
                let i = this.supplies.indexOf(supply);
                this.supplies.splice(i, 1);
            },
            // Creating a citizenship
            post() {
                if (this.$refs.form.validate()) {
                    let vm = this;
                    let item = vm.citizenship;
                    vm.loading = true;
                    let citizenship = new FormData();

                    Object.keys(item).forEach(key => {

                        if (!!item[key]) {
                            if (key === 'flag' || key === 'header') {
                                citizenship.append(key, item[key]);
                                return;
                            }

                            if (key === 'translation') {
                                Object.keys(item[key]).forEach(translationKey => {
                                    if (!!item[key][translationKey])
                                        citizenship.set(`translation[${translationKey}]`, item[key][translationKey]);
                                });
                                return;
                            }
                            citizenship.set(key, item[key]);
                        }
                    });

                    vm.benefits.length ? citizenship.append('benefits', JSON.stringify(vm.benefits)) : null;
                    vm.supplies.length ? citizenship.append('supplies', JSON.stringify(vm.supplies)) : null;

                    axios.post('/dashboard/citizenship', citizenship)
                        .then(res => {
                            vm.reset(res);
                        })
                        .catch(error => {
                            vm.loading = false;
                            vm.activateSnackbar('error', error.response.data.message);
                        })
                }
            },
            reset(res) {
                this.$refs.form.reset();
                this.$refs.form.resetValidation();
                this.activateSnackbar('success', res.data.message);
                $('#englishEditor').summernote('code', '');
                $('#arabicEditor').summernote('code', '');
                this.previewFlag = '';
                this.previewHeader = '';
                this.citizenship.flag = null;
                this.citizenship.header = null;
                this.loading = false;

                this.benefits = [];
                this.supplies = [];
            }

        }
    }
</script>

<style scoped>
    .v-list__tile {
        text-decoration: none !important;
    }

    .note-toolbar {
        z-index: 1;
    }

    .container {
        width: auto;
    }
</style>