<template xmlns:v-slot="http://www.w3.org/1999/XSL/Transform">
    <v-container fluid>
        <v-layout class="py-5 mt-3 mb-5">
            <v-card>
                <v-card-title>
                    <v-flex class="text-xs-center mb-5">
                        <div class="display-1">
                            New Project
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
                                                    v-model="project.name"
                                                    :counter="30"
                                                    :rules="nameRules"
                                                    label="Name"
                                                    required
                                            ></v-text-field>
                                        </v-flex>
                                        <v-flex xs12 md6 class="my-3">
                                            <v-text-field
                                                    v-model="project.translation.name"
                                                    :counter="30"
                                                    :rules="nameRules"
                                                    label="الأسم"
                                                    required
                                            ></v-text-field>
                                        </v-flex>
                                        <v-flex xs12 sm6 md3 class="my-3">
                                            <v-text-field
                                                    v-model="project.price"
                                                    label="Price"
                                            ></v-text-field>
                                        </v-flex>
                                        <v-flex xs12 sm6 md3 class="my-3">
                                            <v-text-field
                                                    v-model="project.down_payment"
                                                    label="Down Payment"
                                            ></v-text-field>
                                        </v-flex>
                                        <v-flex xs12 sm6 md3 class="my-3">
                                            <v-text-field
                                                    v-model="project.installment_years"
                                                    label="Installment Years"
                                            ></v-text-field>
                                        </v-flex>
                                        <v-flex xs12 sm6 md3 class="my-3">
                                            <v-text-field
                                                    v-model="project.delivery_date"
                                                    label="Delivery Date"
                                            ></v-text-field>
                                        </v-flex>
                                        <v-flex xs12 md6 class="my-3">
                                            <v-select
                                                    v-model="selectedDeveloper"
                                                    :items="developers"
                                                    item-text="name"
                                                    item-value="id"
                                                    label="Developer"
                                                    required
                                            ></v-select>
                                        </v-flex>
                                        <v-flex xs12 md6 class="my-3">
                                            <v-select
                                                    v-model="selectedProjectType"
                                                    :items="projectTypes"
                                                    item-text="text"
                                                    item-value="value"
                                                    label="Project Type"
                                                    required
                                            ></v-select>
                                        </v-flex>
                                        <v-flex xs12 md6 class="my-3">
                                            <v-select
                                                    v-model="selectedLocation"
                                                    :items="locations"
                                                    item-text="name"
                                                    item-value="id"
                                                    label="Location"
                                                    prepend-icon="map"
                                                    required
                                            ></v-select>
                                        </v-flex>
                                        <v-flex xs12 md6 class="my-3">
                                            <v-layout row wrap>
                                                <v-flex xs12 md6>
                                                    <v-text-field
                                                            v-model="project.lat"
                                                            label="Latitude"
                                                            required
                                                    ></v-text-field>
                                                </v-flex>
                                                <v-flex xs12 md6>
                                                    <v-text-field
                                                            v-model="project.lng"
                                                            label="Longitude"
                                                            required
                                                    ></v-text-field>
                                                </v-flex>
                                            </v-layout>
                                        </v-flex>
                                        <v-flex xs12 md6 class="my-3">
                                            <v-select
                                                    v-model="selectedPropertyTypes"
                                                    :items="propertyTypes"
                                                    item-text="name"
                                                    item-value="id"
                                                    label="Property Types"
                                                    multiple
                                                    required
                                            >
                                                <template v-slot:prepend-item>
                                                    <v-list-tile
                                                            ripple
                                                            @click="toggle"
                                                    >
                                                        <v-list-tile-action>
                                                            <v-icon :color="selectedPropertyTypes.length > 0 ? 'indigo darken-4' : ''">
                                                                {{ icon }}
                                                            </v-icon>
                                                        </v-list-tile-action>
                                                        <v-list-tile-content>
                                                            <v-list-tile-title>Select All</v-list-tile-title>
                                                        </v-list-tile-content>
                                                    </v-list-tile>
                                                    <v-divider class="mt-2"></v-divider>
                                                </template>
                                            </v-select>
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
                                                            v-model="project.meta"
                                                            label="Meta Description"
                                                            :counter="150"
                                                            :rules="metaRules"
                                                    ></v-textarea>
                                                </v-flex>
                                                <v-flex xs12 md6>
                                                    <v-textarea
                                                            v-model="project.keywords"
                                                            label="Keywords"
                                                    ></v-textarea>
                                                </v-flex>
                                            </v-layout>
                                        </v-flex>
                                    </v-layout>
                                </v-flex>
                                <v-flex xs12 md6 class="mt-3">
                                    <input type="file" multiple id="imageUploader" style="visibility: hidden"
                                           accept="image/png, image/jpeg, image/webp, image/jpg, image/svg+xml"
                                           @change="uploadImages">
                                    <v-btn
                                            color="deep-orange accent-3"
                                            outline
                                            @click="triggerUpload"
                                    >
                                        Upload Images
                                        <v-icon right>cloud_upload</v-icon>
                                    </v-btn>
                                    <v-btn color="nova-gradient" dark v-if="previewImages.length"
                                           @click="viewImages = true">
                                        Show Images
                                    </v-btn>
                                    <v-dialog v-model="viewImages" max-width="80%">
                                        <v-card>
                                            <v-card-text>
                                                <v-layout row wrap>
                                                    <v-flex xs4 v-for="(src, index) in previewImages" :key="index"
                                                            class="pa-2 text-xs-center">
                                                        <v-img :src="src" max-height="200px">
                                                            <v-btn fab dark small color="primary"
                                                                   style="position: absolute;top: 0;right: 0;"
                                                                   @click="removeImage(index)">
                                                                <v-icon dark>remove</v-icon>
                                                            </v-btn>
                                                        </v-img>

                                                    </v-flex>
                                                </v-layout>
                                            </v-card-text>
                                            <v-card-actions>
                                                <v-spacer></v-spacer>
                                                <v-btn color="primary" @click="viewImages = !viewImages">
                                                    close
                                                </v-btn>
                                            </v-card-actions>
                                        </v-card>
                                    </v-dialog>
                                </v-flex>
                                <v-flex xs12 md6 class="mt-3">
                                    <v-layout row wrap>
                                        <v-flex xs12 md6>
                                            <input type="file" id="logoUploader" style="visibility: hidden"
                                                   accept="image/png, image/jpeg, image/webp, image/jpg, image/svg+xml"
                                                   @change="uploadLogo">
                                            <v-btn
                                                    color="deep-orange accent-3"
                                                    outline
                                                    @click="triggerLogoUpload"
                                            >
                                                Upload Logo
                                                <v-icon right>cloud_upload</v-icon>
                                            </v-btn>
                                        </v-flex>
                                        <v-flex xs12 md6>
                                            <v-img :src="previewLogo" width="auto" v-if="previewLogo !== ''">
                                                <v-btn fab dark small color="primary"
                                                       style="position: absolute;top: 0;right: 0;"
                                                       @click="removeLogo">
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
                        Create Project
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
        name: "CreateProject",
        props: ['developerCollection', 'propertyCollection', 'locationCollection'],
        mixins: [SnackbarComponent],
        data() {
            return {
                loading: false,
                developers: [],
                propertyTypes: [],
                locations: [],
                projectTypes: [
                    {
                        value: 'residential',
                        text: 'Residential'
                    },
                    {
                        value: 'commercial',
                        text: 'Commercial'
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
                metaRules: [
                    v => !!v || 'Meta Description is required',
                    v => (v && v.length <= 150) || 'Name must be less than 150 characters'
                ],
                project: {
                    name: null,
                    description: null,
                    lat: null,
                    lng: null,
                    meta:null,
                    keywords: null,
                    price: null,
                    logo: null,
                    down_payment: null,
                    installment_years: null,
                    delivery_date: null,
                    translation: {
                        name: null,
                        description: null,
                    }
                },
                selectedDeveloper: null,
                selectedPropertyTypes: [],
                selectedProjectType: null,
                selectedLocation: null,
                previewImages: [],
                uploadedImages: [],
                viewImages: false,
                previewLogo: '',
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
                            vm.project.description = contents;
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
                            vm.project.translation.description = contents;
                        }
                    }
                });
            });
            this.developers = this.developerCollection;
            this.propertyTypes = this.propertyCollection;
            this.locations = this.locationCollection;
        },
        methods: {
            toggle() {
                this.$nextTick(() => {
                    if (this.allPropertyTypes) {
                        this.selectedPropertyTypes = []
                    } else {
                        this.selectedPropertyTypes = this.propertyTypes.slice()
                    }
                })
            },
            triggerUpload() {
                document.querySelector('#imageUploader').click();
            },
            triggerLogoUpload() {
                document.querySelector('#logoUploader').click();
            },
            uploadImages(e) {
                let vm = this;
                let images = e.target.files; //sames as here

                vm.uploadedImages = Array.from(images);

                Array.from(images).forEach(image => {
                    setTimeout(function () {
                        let reader = new FileReader();
                        reader.onloadend = function () {
                            vm.previewImages.push(reader.result);
                        };

                        if (image) {
                            reader.readAsDataURL(image); //reads the data as a URL
                        }

                    }, 300)
                });

                e.target.value = '';
            },
            uploadLogo(e) {
                let vm = this;
                let logo = e.target.files[0]; //sames as here


                vm.project.logo = logo;

                let reader = new FileReader();
                reader.onloadend = function () {
                    vm.previewLogo = reader.result;
                };

                if (logo) {
                    reader.readAsDataURL(logo); //reads the data as a URL
                } else {
                    vm.previewLogo = '';
                }

                e.target.value = '';
            },
            removeImage(index) {
                this.previewImages.splice(index, 1);
                this.uploadedImages.splice(index, 1);
            },
            removeLogo() {
                this.previewLogo = '';
                this.project.logo = null;
            },
            post() {
                if (this.$refs.form.validate()) {
                    let vm = this;
                    let item = vm.project;
                    vm.loading = true;
                    let project = new FormData();

                    Object.keys(item).forEach(key => {

                        if (!!item[key]) {
                            if (key === 'logo') {
                                project.append(key, item[key]);
                                return;
                            }

                            if (key === 'translation') {
                                Object.keys(item[key]).forEach(translationKey => {
                                    if (!!item[key][translationKey])
                                        project.set(`translation[${translationKey}]`, item[key][translationKey]);
                                });
                                return;
                            }
                            project.set(key, item[key]);
                        }
                    });

                    project.set('developer', vm.selectedDeveloper);
                    project.set('propertyTypes', JSON.stringify(vm.selectedPropertyTypes));
                    project.set('projectType', vm.selectedProjectType);
                    project.set('location', vm.selectedLocation);

                    if (vm.uploadedImages.length) {
                        vm.uploadedImages.forEach(image => {
                            project.append('images[]', image);
                        });
                    }


                    axios.post('/dashboard/projects', project)
                        .then(res => {
                            vm.reset(res);
                        })
                        .catch(error => {
                            vm.loading = false;
                            vm.activateSnackbar('error', error.response.data.message);
                        })
                }
            },
            reset(res){
                this.$refs.form.reset();
                this.$refs.form.resetValidation();
                this.activateSnackbar('success', res.data.message);
                $('#englishEditor').summernote('code', '');
                $('#arabicEditor').summernote('code', '');
                this.previewLogo = '';
                this.project.logo = null;
                this.uploadedImages = [];
                this.previewImages = [];
                this.loading = false;
            }
        },
        computed: {
            allPropertyTypes() {
                return this.selectedPropertyTypes.length === this.propertyTypes.length
            },
            somePropertyTypes() {
                return this.selectedPropertyTypes.length > 0 && !this.allPropertyTypes
            },
            icon() {
                if (this.allPropertyTypes) return 'indeterminate_check_box';
                if (this.somePropertyTypes) return 'indeterminate_check_box';
                return 'check_box_outline_blank'
            }
        },
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