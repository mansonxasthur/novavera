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
                                                        <v-textarea
                                                                v-model="benefit.en"
                                                                :counter="115"
                                                                :rules="benefitRules"
                                                                label="Benefit"
                                                                required
                                                        ></v-textarea>
                                                    </v-flex>
                                                    <v-flex xs12 md5>
                                                        <v-textarea
                                                                v-model="benefit.ar"
                                                                :counter="115"
                                                                :rules="benefitRules"
                                                                label="ميزة"
                                                                required
                                                        ></v-textarea>
                                                    </v-flex>
                                                    <v-flex>
                                                        <v-btn dark small color="blue darken-4" @click="addBenefit"
                                                               class="left mt-3">
                                                            <v-icon left small>add</v-icon>
                                                            Add Benefit
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
                                                        <v-textarea
                                                                v-model="supply.en"
                                                                :counter="115"
                                                                :rules="supplyRules"
                                                                label="Provide"
                                                                required
                                                        ></v-textarea>
                                                    </v-flex>
                                                    <v-flex xs12 md5>
                                                        <v-textarea
                                                                v-model="supply.ar"
                                                                :counter="115"
                                                                :rules="supplyRules"
                                                                label="يوفر"
                                                                required
                                                        ></v-textarea>
                                                    </v-flex>
                                                    <v-flex>
                                                        <v-btn dark small color="blue darken-4" @click="addSupply"
                                                               class="left mt-3">
                                                            <v-icon left small>add</v-icon>
                                                            Add Supply
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
                                <v-flex xs12 class="mt-5" id="custom-sections">
                                    <v-layout column align-space-between>
                                        <v-flex py-4>
                                            <v-btn @click="newSection" color="primary"><v-icon left>add</v-icon>Create Section</v-btn>
                                        </v-flex>
                                        <v-flex v-for="section in customSections" :key="section.section_id" my-3>
                                            <v-layout row wrap>
                                                <v-flex>
                                                    <v-card>
                                                        <v-card-title class="primary--text font-weight-black" v-text="section.section_id"></v-card-title>
                                                        <v-card-text>
                                                            <v-layout row wrap>
                                                                <v-flex xs12 md6>
                                                                    <v-layout row wrap>
                                                                        <v-flex xs12 class="text-xs-center">
                                                                            <div class="display-1 grey--text">Content</div>
                                                                        </v-flex>
                                                                        <v-flex xs12>
                                                                            <div :id="`${section.section_id}-editor`"></div>
                                                                        </v-flex>
                                                                    </v-layout>
                                                                </v-flex>
                                                                <v-flex xs12 md6>
                                                                    <v-layout row wrap>
                                                                        <v-flex xs12 class="text-xs-center">
                                                                            <div class="display-1 grey--text">المحتوى</div>
                                                                        </v-flex>
                                                                        <v-flex xs12>
                                                                            <div :id="`${section.section_id}-editor-arabic`"></div>
                                                                        </v-flex>
                                                                    </v-layout>
                                                                </v-flex>
                                                            </v-layout>
                                                        </v-card-text>
                                                        <v-card-actions>
                                                            <v-select
                                                                    label="After"
                                                                    :items="mainSections"
                                                                    v-model="section.after"
                                                            ></v-select>
                                                            <small class="grey--text"><sup class="red--text">*</sup>select DIV to come after</small>
                                                            <v-spacer></v-spacer>
                                                            <v-btn color="primary" @click="removeSection">Cancel</v-btn>
                                                        </v-card-actions>
                                                    </v-card>
                                                </v-flex>
                                            </v-layout>
                                        </v-flex>
                                    </v-layout>
                                </v-flex>
                                <v-flex d-flex xs12 md4 class="mt-3">
                                    <v-layout column align-space-between justify-center>
                                        <v-flex>
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
                                        <v-flex>
                                            <v-img :src="previewHeader" width="100%" v-if="previewHeader !== ''">
                                                <v-btn fab dark small color="primary"
                                                       style="position: absolute;top: 0;right: 0;"
                                                       @click="removeHeader">
                                                    <v-icon dark>remove</v-icon>
                                                </v-btn>
                                            </v-img>
                                        </v-flex>
                                    </v-layout>
                                </v-flex>
                                <v-flex d-flex xs12 md4 class="mt-3">
                                    <v-layout column align-space-between justify-center>
                                        <v-flex>
                                            <input type="file" id="dropdownFlagUploader" style="visibility: hidden"
                                                   accept="image/png, image/jpeg, image/webp, image/jpg, image/svg+xml"
                                                   @change="uploadDropdownFlag">
                                            <v-btn
                                                    color="deep-orange accent-3"
                                                    outline
                                                    @click="triggerDropdownFlagUpload"
                                            >
                                                Upload Dropdown Flag
                                                <v-icon right>cloud_upload</v-icon>
                                            </v-btn>
                                        </v-flex>
                                        <v-flex>
                                            <v-img :src="previewDropdownFlag" width="100%"
                                                   v-if="previewDropdownFlag !== ''">
                                                <v-btn fab dark small color="primary"
                                                       style="position: absolute;top: 0;right: 0;"
                                                       @click="removeDropdownFlag">
                                                    <v-icon dark>remove</v-icon>
                                                </v-btn>
                                            </v-img>
                                        </v-flex>
                                    </v-layout>
                                </v-flex>
                                <v-flex d-flex xs12 md4 class="mt-3">
                                    <v-layout column align-space-between justify-center>
                                        <v-flex>
                                            <input type="file" id="bodyFlagUploader" style="visibility: hidden"
                                                   accept="image/png, image/jpeg, image/webp, image/jpg, image/svg+xml"
                                                   @change="uploadBodyFlag">
                                            <v-btn
                                                    color="deep-orange accent-3"
                                                    outline
                                                    @click="triggerBodyFlagUpload"
                                            >
                                                Upload Body Flag
                                                <v-icon right>cloud_upload</v-icon>
                                            </v-btn>
                                        </v-flex>
                                        <v-flex>
                                            <v-img :src="previewBodyFlag" width="100%" v-if="previewBodyFlag !== ''">
                                                <v-btn fab dark small color="primary"
                                                       style="position: absolute;top: 0;right: 0;"
                                                       @click="removeBodyFlag">
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
                    v => (v && v.length <= 115) || 'Name must be less than 115 characters'
                ],
                supplyRules: [
                    v => !!v || 'Supply is required',
                    v => (v && v.length <= 115) || 'Name must be less than 115 characters'
                ],
                citizenship: {
                    country_name: null,
                    title: null,
                    description: null,
                    snippet: null,
                    meta: null,
                    keywords: null,
                    type: null,
                    dropdown_flag: null,
                    body_flag: null,
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
                previewDropdownFlag: '',
                previewBodyFlag: '',
                previewHeader: '',
                customSections: [],
                mainSections: [
                    'intro',
                    'description',
                    'propose-consultation',
                    'benefits',
                    'provides',
                    'citizenship',
                ],
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
            triggerDropdownFlagUpload() {
                document.querySelector('#dropdownFlagUploader').click();
            },
            uploadDropdownFlag(e) {
                let vm = this;
                let dropdown_flag = e.target.files[0]; //sames as here


                vm.citizenship.dropdown_flag = dropdown_flag;

                let reader = new FileReader();
                reader.onloadend = function () {
                    vm.previewDropdownFlag = reader.result;
                };

                if (dropdown_flag) {
                    reader.readAsDataURL(dropdown_flag); //reads the data as a URL
                } else {
                    vm.previewDropdownFlag = '';
                }

                e.target.value = '';
            },
            removeDropdownFlag() {
                this.previewDropdownFlag = '';
                this.citizenship.dropdown_flag = null;
            },
            triggerBodyFlagUpload() {
                document.querySelector('#bodyFlagUploader').click();
            },
            uploadBodyFlag(e) {
                let vm = this;
                let body_flag = e.target.files[0]; //sames as here


                vm.citizenship.body_flag = body_flag;

                let reader = new FileReader();
                reader.onloadend = function () {
                    vm.previewBodyFlag = reader.result;
                };

                if (body_flag) {
                    reader.readAsDataURL(body_flag); //reads the data as a URL
                } else {
                    vm.previewBodyFlag = '';
                }

                e.target.value = '';
            },
            removeBodyFlag() {
                this.previewBodyFlag = '';
                this.citizenship.body_flag = null;
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
                            if (key === 'dropdown_flag' || key === 'body_flag' || key === 'header') {
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
                    vm.customSections.length ? citizenship.append('customSections', JSON.stringify(vm.customSections)) : null;

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
                this.previewDropdownFlag = '';
                this.previewBodyFlag = '';
                this.previewHeader = '';
                this.citizenship.dropdown_flag = null;
                this.citizenship.body_flag = null;
                this.citizenship.header = null;
                this.loading = false;

                this.benefits = [];
                this.supplies = [];
                this.customSections = [];
            },
            newSection() {
                let vm = this;
                let id = 'custom-section-' + new Date().getTime();
                let section = {
                    section_id: id,
                    content: '',
                    after: '',
                    translation: {
                        content: '',
                    }
                };
                vm.customSections.push(section);
                let index = vm.customSections.indexOf(section);
                setTimeout(function () {
                    $(`#${id}-editor`).summernote({
                        height: 300,
                        codemirror: {
                            mode: 'text/html',
                            htmlMode: true,
                            lineNumbers: true,
                            theme: 'monokai'
                        },
                        callbacks: {
                            onChange: function (contents) {
                                vm.customSections[index].content = contents;
                            }
                        }
                    });
                    $(`#${id}-editor-arabic`).summernote({
                        height: 300,
                        codemirror: {
                            mode: 'text/html',
                            htmlMode: true,
                            lineNumbers: true,
                            theme: 'monokai'
                        },
                        callbacks: {
                            onChange: function (contents) {
                                vm.customSections[index].translation.content = contents;
                            }
                        }
                    });
                }, 200);
            },
            removeSection(section) {
                let i = this.customSections.indexOf(section);
                this.customSections.splice(i, 1);
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