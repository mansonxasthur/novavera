<template xmlns:v-slot="http://www.w3.org/1999/XSL/Transform">
    <v-container fluid>
        <v-layout row wrap justify-center>
            <v-flex xs12 sm10>
                <v-card class="mt-5">
                    <v-card-title>
                        <v-text-field
                            v-model="slider.name"
                            prepend-icon="photo_library"
                        ></v-text-field>
                        <v-spacer></v-spacer>
                        <v-btn small color="primary" dark @click="saveChanges">
                            <v-icon small class="mx-1">save</v-icon>
                            Save Changes
                        </v-btn>
                        <v-btn small color="primary" dark @click="addSlide">
                            <v-icon class="mx-1">add</v-icon>
                            New slide
                        </v-btn>
                        <v-dialog v-model="dialog" max-width="80%">
                            <v-card>
                                <v-card-title>
                                    <span class="headline">{{ formTitle }}</span>
                                </v-card-title>

                                <v-card-text>
                                    <v-form ref="imageForm">
                                        <v-container grid-list-md>
                                            <v-layout wrap>
                                                <v-flex xs12 v-if="image" class="my-2">
                                                    <v-layout justify-center>
                                                        <v-img :src="image" max-width="25%"></v-img>
                                                    </v-layout>
                                                </v-flex>
                                                <v-flex xs12 md6>
                                                    <v-text-field
                                                            v-model="editedItem.title"
                                                            :counter="30"
                                                            label="Title"
                                                    ></v-text-field>
                                                </v-flex>
                                                <v-flex xs12 md6>
                                                    <v-text-field
                                                            v-model="editedItem.translation.title"
                                                            :counter="30"
                                                            label="العنوان"
                                                    ></v-text-field>
                                                </v-flex>
                                                <v-flex xs12 md6>
                                                    <v-text-field
                                                            v-model="editedItem.subtitle"
                                                            :counter="30"
                                                            label="Subtitle"
                                                    ></v-text-field>
                                                </v-flex>
                                                <v-flex xs12 md6>
                                                    <v-text-field
                                                            v-model="editedItem.translation.subtitle"
                                                            :counter="30"
                                                            label="العنوان الفرعي"
                                                    ></v-text-field>
                                                </v-flex>
                                                <v-flex xs12 md6>
                                                    <v-text-field
                                                            v-model="editedItem.btn_label"
                                                            :counter="30"
                                                            label="Label"
                                                    ></v-text-field>
                                                </v-flex>
                                                <v-flex xs12 md6>
                                                    <v-text-field
                                                            v-model="editedItem.translation.btn_label"
                                                            :counter="30"
                                                            label="الملصق"
                                                    ></v-text-field>
                                                </v-flex>
                                                <v-flex xs12>
                                                    <v-text-field
                                                            v-model="editedItem.btn_link"
                                                            :counter="30"
                                                            label="Label Link"
                                                    ></v-text-field>
                                                </v-flex>

                                                <v-flex xs12>
                                                    <input type="file" id="imageUploader" style="visibility: hidden"
                                                           @change="previewImage">
                                                    <v-spacer></v-spacer>
                                                    <v-btn
                                                            color="deep-orange accent-3"
                                                            outline
                                                            @click="triggerUpload"
                                                    >
                                                        {{ uploadTitle }}
                                                        <v-icon right>cloud_upload</v-icon>
                                                    </v-btn>
                                                </v-flex>
                                            </v-layout>
                                        </v-container>
                                    </v-form>
                                </v-card-text>

                                <v-card-actions>
                                    <v-spacer></v-spacer>
                                    <v-btn color="blue darken-1" flat @click="closeDialog">Cancel</v-btn>
                                    <v-btn color="blue darken-1" :loading="loading" flat @click="save">Save</v-btn>
                                </v-card-actions>
                            </v-card>
                        </v-dialog>
                    </v-card-title>
                    <v-card-text>
                        <v-data-table
                                :headers="headers"
                                :items="slider.images"
                                :pagination.sync="paginationSync"
                                ref="sortableTable"
                                class="elevation-0"
                        >
                            <template v-slot:items="props">
                                <tr
                                        class="sortableRow"
                                        :key="itemKey(props.item)"
                                >
                                    <td class="px-1" style="width: 0.1%">
                                        <v-btn style="cursor: move" icon class="sortHandle">
                                            <v-icon>drag_handle</v-icon>
                                        </v-btn>
                                    </td>
                                    <td class="px-0">
                                        <v-img class="slide-img" :src="props.item.path_url" @click="imageZoomIn(props.item.path_url)"></v-img>
                                        <v-dialog v-model="imageDialog" max-width="70%">
                                            <v-img :src="imageDialogSrc" width="auto">

                                                <v-icon color="deep-orange accent-2"
                                                        style="position: absolute;top: 8px;right: 8px;"
                                                        large
                                                        @click="imageZoomOut"
                                                >
                                                    close
                                                </v-icon>

                                            </v-img>
                                        </v-dialog>
                                    </td>
                                    <td>{{ props.item.title | nullable}}</td>
                                    <td class="text-xs-right">{{ props.item.translation ? props.item.translation.title : '' | nullable}}</td>
                                    <td>{{ props.item.subtitle | nullable}}</td>
                                    <td class="text-xs-right">{{ props.item.translation ? props.item.translation.subtitle : '' | nullable}}</td>
                                    <td>{{ props.item.btn_label | nullable}}</td>
                                    <td class="text-xs-right">{{ props.item.translation ? props.item.translation.btn_label : '' | nullable}}</td>
                                    <td>{{ props.item.btn_link | nullable}}</td>
                                    <td>{{ props.item.order }}</td>

                                    <td>
                                        <v-btn flat fab small @click="editItem(props.item, 'slider', 'images')">
                                            <v-icon
                                                    small
                                            >
                                                edit
                                            </v-icon>
                                        </v-btn>
                                        <v-btn flat fab small @click="deleteItem(props.item, 'slider', 'images')">
                                            <v-icon
                                                    small
                                            >
                                                delete
                                            </v-icon>
                                        </v-btn>
                                    </td>
                                </tr>
                            </template>
                        </v-data-table>
                    </v-card-text>
                </v-card>
            </v-flex>
        </v-layout>
        <delete-dialog
                @confirm="confirmDelete('slider', 'images')"
                @closeDialog="closeDeleteDialog"
                :loading="loading"
                :delete-dialog="deleteDialog"
        ></delete-dialog>
        <snackbar :active="snackbar.active" :color="snackbar.color" :message="snackbar.message"
                  @deactivate="deactivateSnackbar"></snackbar>
    </v-container>
</template>

<script>
    import SnackbarComponent from '../../../mixins/SnackbarComponent';
    import Form from '../../../mixins/Form';
    import Sortable from '../../../utilities/sortable.min';

    export default {
        name: 'EditSlider',
        mixins: [SnackbarComponent, Form],
        props: ['sliderCollection'],
        data: () => ({
            itemKeys: new WeakMap(),
            currentItemKey: 0,
            dialog: false,
            imageDialog: false,
            imageDialogSrc: '',
            paginationSync : {rowsPerPage: 10},
            headers: [
                {sortable: false},
                {
                    text: 'Slide',
                    align: 'left',
                    sortable: false,
                    value: 'path'
                },
                {
                    text: 'Title',
                    align: 'left',
                    sortable: false,
                    value: 'title'
                },
                {
                    text: 'العنوان',
                    align: 'right',
                    sortable: false,
                    value: 'translation.title'
                },
                {
                    text: 'Subtitle',
                    align: 'left',
                    sortable: false,
                    value: 'subtitle'
                },
                {
                    text: 'عنوان فرعي',
                    align: 'right',
                    sortable: false,
                    value: 'translation.subtitle'
                },
                {
                    text: 'Label',
                    align: 'left',
                    sortable: false,
                    value: 'btn_label'
                },
                {
                    text: 'الملصق',
                    align: 'right',
                    sortable: false,
                    value: 'translation.btn_label'
                },
                {
                    text: 'Label Link',
                    align: 'left',
                    sortable: false,
                    value: 'btn_link'
                },
                {
                    text: 'Order',
                    align: 'left',
                    sortable: false,
                    value: 'order'
                },
                {text: 'Actions', align: 'center', value: 'name', sortable: false}
            ],
            slider: {},
            editedIndex: -1,
            editedItem: {
                title: '',
                subtitle: '',
                btn_label: '',
                btn_link: '',
                order: '',
                translation: {
                    title: '',
                    subtitle: '',
                    btn_label: '',
                }
            },
            defaultItem: {
                title: '',
                subtitle: '',
                btn_label: '',
                btn_link: '',
                order: '',
                translation: {
                    title: '',
                    subtitle: '',
                    btn_label: '',
                }
            },
            search: '',
            nameRules: [
                v => !!v || 'Name is required',
                v => (v && v.length <= 30) || 'Name must be less than 30 characters'
            ],
            image: '',
        }),
        filters: {
          nullable(val) {
              return val === 'null' ? '' : val;
          }
        },
        mounted() {
            /* eslint-disable no-new */
            new Sortable(
                this.$refs.sortableTable.$el.getElementsByTagName('tbody')[0],
                {
                    draggable: '.sortableRow',
                    handle: '.sortHandle',
                    onEnd: this.dragReorder
                }
            )
        },
        computed: {
            updateRoute() {
                return '/dashboard/sliders/' + this.slider.id;
            },
            postRoute() {
                return '/dashboard/sliders/' + this.slider.id + '/images';
            },
            updateImageRoute() {
                return '/dashboard/sliders/' + this.slider.id + '/images/';
            },
            deleteRoute() {
                return '/dashboard/sliders/' + this.slider.id + '/images/';
            },
            formTitle() {
                return this.editedIndex === -1 ? 'New Slide' : 'Edit Slide';
            },
            uploadTitle() {
                return this.editedIndex === -1 ? 'Upload Image' : 'Change Image';
            }
        },
        watch: {
            dialog(val) {
                val || this.close();
            },
            editedItem(val) {
                if (this.editedItem.translation === null) {
                    this.editedItem.translation = {};
                    this.editedItem.translation.title = '';
                    this.editedItem.translation.subtitle = '';
                    this.editedItem.translation.btn_label = '';
                }
                this.image = this.editedItem.path_url;
            }
        },
        created() {
            this.slider = this.sliderCollection;
        },
        methods: {
            dragReorder({oldIndex, newIndex}) {
                const movedItem = this.slider.images.splice(oldIndex, 1)[0];
                this.slider.images.splice(newIndex, 0, movedItem);
            },
            itemKey(item) {
                if (!this.itemKeys.has(item)) this.itemKeys.set(item, ++this.currentItemKey);
                return this.itemKeys.get(item);
            },
            save() {
                let vm = this;
                vm.loading = true;
                let slide = new FormData();
                slide.set('title', vm.editedItem.title);
                slide.set('arabicTitle', vm.editedItem.translation.title);
                slide.set('subtitle', vm.editedItem.subtitle);
                slide.set('arabicSubtitle', vm.editedItem.translation.subtitle);
                slide.set('label', vm.editedItem.btn_label);
                slide.set('arabicLabel', vm.editedItem.translation.btn_label);
                slide.set('labelLink', vm.editedItem.btn_link);
                slide.set('order', vm.editedItem.order);
                slide.append('image', vm.editedItem.image);
                if (vm.editedIndex > -1) {
                    let form = 'imageForm';
                    let collection = 'slider';
                    let subcollection = 'images';
                    if (this.validate(form)) {
                        let vm = this;
                        vm.loading = true;
                        let formSubmit = axios.post(vm.updateImageRoute + vm.editedItem.id, slide)
                            .then(res => {
                                if (collection !== '') {
                                    if (subcollection !== '') {
                                        Object.assign(vm[collection][subcollection][vm.editedIndex], res.data.data);
                                    } else {
                                        console.log('assigning2');
                                        Object.assign(vm[collection][vm.editedIndex], res.data.data);
                                    }
                                }
                                vm.reset(form);
                                vm.activateSnackbar('success', res.data.message);
                                vm.image = '';
                            })
                            .catch(error => {
                                vm.loading = false;
                                vm.activateSnackbar('error', error.response.data.message);
                                return false;
                            });

                    }
                } else {
                    vm.post(slide, 'imageForm', 'slider', 'images') ? vm.image = '' : null;
                }

            },
            triggerUpload() {
                let imageUploader = document.querySelector('#imageUploader');
                imageUploader.click();
            },
            previewImage(e) {
                let vm = this;
                let file = e.target.files[0]; //sames as here
                let reader = new FileReader();

                vm.editedItem.image = file;
                reader.onloadend = function () {
                    vm.image = reader.result;
                };

                if (file) {
                    reader.readAsDataURL(file); //reads the data as a URL
                    e.target.value = '';
                } else {
                    vm.image = '';
                }
            },
            addSlide() {
                this.dialog = true;
            },
            closeDialog() {
                this.close();
            },
            imageZoomIn(src) {
                this.imageDialogSrc = src;
                this.imageDialog = true;
            },
            imageZoomOut() {
                this.imageDialog = false;
                this.imageDialogSrc = '';
            },
            reorderImages() {
                let i = 1;
                this.slider.images.forEach(image => {
                    image.order = i;
                    i++;
                });
            },
            saveChanges() {
                let vm = this;
                vm.reorderImages();
                axios.put(vm.updateRoute, {
                    name: vm.slider.name,
                    images: vm.slider.images
                })
                    .then(res => {

                        vm.activateSnackbar('success', res.data.message);
                    })
                    .catch(error => {
                        vm.activateSnackbar('error', error.response.data.message);
                    });
            }
        },
    }
</script>

<style scoped>
    a {
        text-decoration: none;
    }

    .container {
        width: auto;
    }

    .slide-img {
        cursor: zoom-in;
    }
</style>