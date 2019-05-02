<template xmlns:v-slot="http://www.w3.org/1999/XSL/Transform">
    <v-container fluid>
        <v-layout class="py-5 mt-3 mb-5">
            <v-card>
                <v-card-title>
                    <v-flex class="text-xs-center mb-5">
                        <div class="display-1">
                            Edit Post
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
                                                    v-model="post.title"
                                                    :counter="30"
                                                    :rules="nameRules"
                                                    label="Title"
                                                    required
                                            ></v-text-field>
                                        </v-flex>
                                        <v-flex xs12 md6 class="my-3">
                                            <v-text-field
                                                    v-model="post.translation.title"
                                                    :counter="30"
                                                    :rules="nameRules"
                                                    label="العنوان"
                                                    required
                                            ></v-text-field>
                                        </v-flex>
                                        <v-flex xs12 md6 class="my-3">
                                            <v-select
                                                    v-model="selectedTags"
                                                    :items="tags"
                                                    item-text="name"
                                                    item-value="id"
                                                    label="Tags"
                                                    multiple
                                                    required
                                            >
                                                <template v-slot:prepend-item>
                                                    <v-list-tile
                                                            ripple
                                                            @click="toggle"
                                                    >
                                                        <v-list-tile-action>
                                                            <v-icon :color="selectedTags.length > 0 ? 'indigo darken-4' : ''">
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
                                                            v-model="post.meta"
                                                            label="Meta Description"
                                                    ></v-textarea>
                                                </v-flex>
                                                <v-flex xs12 md6>
                                                    <v-textarea
                                                            v-model="post.keywords"
                                                            label="Keywords"
                                                    ></v-textarea>
                                                </v-flex>
                                                <v-flex xs12>
                                                    <v-textarea
                                                            v-model="post.style"
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
                                                   @change="uploadFeaturedImage">
                                            <v-btn
                                                    color="deep-orange accent-3"
                                                    outline
                                                    @click="triggerImageUpload"
                                            >
                                                Change Featured Image
                                                <v-icon right>cloud_upload</v-icon>
                                            </v-btn>
                                        </v-flex>
                                        <v-flex xs12 md6>
                                            <v-img :src="post.featured_image_url" width="auto"
                                                   v-if="post.featured_image !== ''"></v-img>
                                            <v-img :src="previewFeaturedImage" width="auto" v-if="previewFeaturedImage !== ''">
                                                <v-btn fab dark small color="primary"
                                                       style="position: absolute;top: 0;right: 0;"
                                                       @click="removeFeaturedImage">
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
                        Update Post
                    </v-btn>
                    <v-btn outline color="primary" href="/dashboard/posts">
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
        name: "EditPost",
        mixins: [SnackbarComponent],
        props: ['tagCollection', 'postCollection'],
        data() {
            return {
                loading: false,
                post: {},
                tags: [],
                title: '',
                arabicTitle: '',
                body: '',
                arabicBody: '',
                nameRules: [
                    v => !!v || 'Name is required',
                    v => (v && v.length <= 30) || 'Name must be less than 30 characters'
                ],
                meta: '',
                keywords: '',
                style: '',
                previewFeaturedImage: '',
                uploadedFeaturedImage: {},
                selectedTags: [],
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
                            vm.post.body = contents;
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
                            vm.post.translation.body = contents;
                        }
                    }
                });
                $('#englishEditor').summernote('code', vm.postCollection.body);
                $('#arabicEditor').summernote('code', vm.postCollection.translation.body);
            });

            this.init();
        },
        methods: {
            init() {
                this.tags = this.tagCollection;
                this.post = this.postCollection;
                this.selectedTags = this.post.tags.map(tag => tag.id);
            },
            toggle() {
                this.$nextTick(() => {
                    if (this.allTags) {
                        this.selectedTags = []
                    } else {
                        this.selectedTags = this.tags.slice()
                    }
                })
            },
            triggerImageUpload() {
                document.querySelector('#imageUploader').click();
            },
            uploadFeaturedImage(e) {
                let vm = this;
                let image = e.target.files[0]; //sames as here


                vm.uploadedFeaturedImage = image;

                let reader = new FileReader();
                reader.onloadend = function () {
                    vm.previewFeaturedImage = reader.result;
                };

                if (image) {
                    vm.post.featured_image = '';
                    reader.readAsDataURL(image); //reads the data as a URL
                }

                e.target.value = '';
            },
            removeFeaturedImage() {
                this.previewFeaturedImage = '';
                this.uploadedFeaturedImage = {};
            },
            submit() {
                if (this.$refs.form.validate()) {
                    let vm = this;
                    vm.loading = true;
                    let post = new FormData();
                    post.set('title', this.post.title);
                    post.set('arabicTitle', this.post.translation.title);
                    post.set('tags', JSON.stringify(this.selectedTags));
                    post.set('body', this.post.body);
                    post.set('arabicBody', this.post.translation.body);
                    post.set('meta', this.post.meta);
                    post.set('keywords', this.post.keywords);
                    post.set('style', this.post.style);
                    post.append('featuredImage', this.uploadedFeaturedImage);
                    axios.post('/dashboard/posts/' + this.post.slug, post)
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
                this.$refs.form.resetValidation();
                this.activateSnackbar('success', res.data.message);
                this.loading = false;
            }
        },
        computed: {
            allTags() {
                return this.selectedTags.length === this.tags.length
            },
            someTags() {
                return this.selectedTags.length > 0 && !this.allTags
            },
            icon() {
                if (this.allTags) return 'indeterminate_check_box';
                if (this.someTags) return 'indeterminate_check_box';
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