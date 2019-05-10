<template xmlns:v-slot="http://www.w3.org/1999/XSL/Transform">
    <v-container fluid>
        <v-layout class="py-5 mt-3 mb-5">
            <v-card>
                <v-card-title>
                    <v-flex class="text-xs-center mb-5">
                        <div class="display-1">
                            Edit Page
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
                                                    v-model="page.title"
                                                    :counter="30"
                                                    :rules="nameRules"
                                                    label="Title"
                                                    required
                                            ></v-text-field>
                                        </v-flex>
                                        <v-flex xs12 md6 class="my-3">
                                            <v-text-field
                                                    v-model="page.translation.title"
                                                    :counter="30"
                                                    :rules="nameRules"
                                                    label="العنوان"
                                                    required
                                            ></v-text-field>
                                        </v-flex>
                                    </v-layout>
                                </v-flex>
                                <v-flex xs12 class="mt-5">
                                    <v-layout row wrap>
                                        <v-flex xs12 md6>
                                            <v-layout row wrap>
                                                <v-flex xs12 class="text-xs-center">
                                                    <div class="display-1 grey--text">Content</div>
                                                </v-flex>
                                                <v-flex xs12>
                                                    <div id="englishEditor"></div>
                                                </v-flex>
                                            </v-layout>
                                        </v-flex>
                                        <v-flex xs12 md6>
                                            <v-layout row wrap>
                                                <v-flex xs12 class="text-xs-center">
                                                    <div class="display-1 grey--text">المحتوى</div>
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
                                                            v-model="page.meta"
                                                            label="Meta Description"
                                                    ></v-textarea>
                                                </v-flex>
                                                <v-flex xs12 md6>
                                                    <v-textarea
                                                            v-model="page.keywords"
                                                            label="Keywords"
                                                    ></v-textarea>
                                                </v-flex>
                                                <v-flex xs12>
                                                    <v-textarea
                                                            v-model="page.style"
                                                            label="Custom Style"
                                                    ></v-textarea>
                                                </v-flex>
                                            </v-layout>
                                        </v-flex>
                                    </v-layout>
                                </v-flex>
                                <v-flex xs12 md6 class="mt-3">
                                    <v-layout row wrap>
                                        <v-flex xs12 md6>
                                            <input type="file" id="imageUploader" style="visibility: hidden"
                                                   accept="image/png, image/jpeg, image/webp, image/jpg, image/svg+xml"
                                                   @change="uploadHeader">
                                            <v-btn
                                                    color="deep-orange accent-3"
                                                    outline
                                                    @click="triggerImageUpload"
                                            >
                                                Change Header
                                                <v-icon right>cloud_upload</v-icon>
                                            </v-btn>
                                        </v-flex>
                                        <v-flex xs12 md6>
                                            <v-img :src="page.header_url" width="auto"
                                                   v-if="page.header_url !== ''"></v-img>
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
                            </v-layout>
                        </v-container>
                    </v-form>
                </v-card-text>
                <v-card-actions class="py-4 mt-5">
                    <v-spacer></v-spacer>
                    <v-btn outline color="primary" @click="submit" :loading="loading">
                        Update Page
                    </v-btn>
                    <v-btn outline color="primary" href="/dashboard/pages">
                        Cancel
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
        name: "EditPage",
        mixins: [SnackbarComponent],
        props: ['pageCollection'],
        data() {
            return {
                loading: false,
                page: {},
                nameRules: [
                    v => !!v || 'Name is required',
                    v => (v && v.length <= 30) || 'Name must be less than 30 characters'
                ],
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
                            vm.page.body = contents;
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
                            vm.page.translation.body = contents;
                        }
                    }
                });
                $('#englishEditor').summernote('code', vm.pageCollection.body);
                $('#arabicEditor').summernote('code', vm.pageCollection.translation.body);
            });

            this.init();
        },
        methods: {
            init() {
                this.page = this.pageCollection;
            },
            triggerImageUpload() {
                document.querySelector('#imageUploader').click();
            },
            uploadHeader(e) {
                let vm = this;
                let image = e.target.files[0]; //sames as here


                vm.page.header = image;

                let reader = new FileReader();
                reader.onloadend = function () {
                    vm.previewHeader = reader.result;
                };

                if (image) {
                    vm.page.header_url = '';
                    reader.readAsDataURL(image); //reads the data as a URL
                }

                e.target.value = '';
            },
            removeHeader() {
                this.previewHeader = '';
                this.uploadedHeader = {};
            },
            submit() {
                if (this.$refs.form.validate()) {
                    let vm = this;
                    vm.loading = true;
                    let item = vm.page;
                    let page = new FormData();

                    Object.keys(item).forEach(key => {
                        if (key === 'header_url') return;

                        if (!!item[key]) {
                            if (key === 'header') {
                                page.append(key, item[key]);
                                return;
                            }

                            if (key === 'translation') {
                                Object.keys(item[key]).forEach(translationKey => {
                                    if (!!item[key][translationKey])
                                        page.set(`translation[${translationKey}]`, item[key][translationKey]);
                                });
                                return;
                            }
                            page.set(key, item[key]);
                        }
                    });

                    axios.post('/dashboard/pages/' + this.page.slug, page)
                        .then(res => {
                            if (('slug' in res.data) && res.data.slug !== vm.page.slug ) {
                                window.location = '/dashboard/pages/' + res.data.slug + '/edit';
                            }
                            vm.reset(res);
                        })
                        .catch(error => {
                            vm.loading = false;
                            vm.activateSnackbar('error', error.response.data.message);
                        })
                }
            },
            reset(res){
                this.$refs.form.resetValidation();
                this.activateSnackbar('success', res.data.message);
                this.loading = false;
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