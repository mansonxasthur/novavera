<template xmlns:v-slot="http://www.w3.org/1999/XSL/Transform">
    <v-container fluid>
        <v-layout row wrap justify-center>
            <v-flex xs12 sm10>
                <v-card class="mt-5">
                    <v-card-title>
                        <span class="title">
                            <v-icon class="mx-1" color="deep-orange accent-2">business</v-icon>
                            Developers</span>
                        <v-spacer></v-spacer>
                        <v-text-field
                                v-model="search"
                                append-icon="search"
                                label="Search"
                                single-line
                                hide-details
                        ></v-text-field>

                    </v-card-title>
                    <v-card-text>
                        <v-data-table
                                :headers="headers"
                                :items="developers"
                                :search="search"
                                :pagination.sync="paginationSync"
                                class="elevation-0"
                        >
                            <template v-slot:items="props">
                                <td>{{ props.item.name }}</td>
                                <td class="pa-0">
                                    <img :src="props.item.logo_url" :alt="props.item.name" style="max-width: 100%;">
                                </td>
                                <td>{{ props.item.description }}</td>
                                <td class="text-xs-right">{{ props.item.translation !== null ?
                                    props.item.translation.description : '' }}
                                </td>
                                <td class="text-xs-center">
                                    <v-btn flat fab small>
                                        <v-icon
                                                small
                                                @click="editItem(props.item, 'developers')"
                                        >
                                            edit
                                        </v-icon>
                                    </v-btn>
                                    <v-btn flat fab small>
                                        <v-icon
                                                small
                                                @click="deleteItem(props.item, 'developers')"
                                        >
                                            delete
                                        </v-icon>
                                    </v-btn>
                                </td>
                            </template>
                        </v-data-table>
                    </v-card-text>
                    <v-card-actions>
                        <v-dialog v-model="dialog" max-width="600px">
                            <template v-slot:activator="{ on }">
                                <v-btn color="primary" outline class="mb-2" v-on="on">
                                    New Developer
                                </v-btn>
                            </template>
                            <v-card>
                                <v-card-title>
                                    <span class="headline">{{ formTitle }}</span>
                                </v-card-title>

                                <v-card-text>
                                    <v-form ref="developerForm">
                                        <v-container grid-list-md>
                                            <v-layout wrap>
                                                <v-flex x12 v-if="logo" class="my-2">
                                                    <v-layout justify-center>
                                                        <v-avatar size="150">
                                                            <img :src="logo" alt="logo">
                                                        </v-avatar>
                                                    </v-layout>
                                                </v-flex>
                                                <v-flex xs12>
                                                    <v-text-field
                                                            v-model="editedItem.name"
                                                            :counter="30"
                                                            :rules="nameRules"
                                                            label="Name"
                                                            required
                                                    ></v-text-field>
                                                </v-flex>
                                                <v-flex xs12 md6>
                                                    <v-textarea
                                                            v-model="editedItem.description"
                                                            :counter="300"
                                                            label="Description"
                                                    ></v-textarea>
                                                </v-flex>
                                                <v-flex xs12 md6>
                                                    <v-textarea
                                                            v-model="editedItem.translation.description"
                                                            :counter="300"
                                                            label="الوصف"
                                                    ></v-textarea>
                                                </v-flex>
                                                <v-flex xs12>
                                                    <input type="file" id="logoUploader" style="visibility: hidden"
                                                           @change="uploadLogo">
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
                    </v-card-actions>
                </v-card>
            </v-flex>
        </v-layout>
        <delete-dialog
                @confirm="confirmDelete('developers', '','slug')"
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

    export default {
        name: 'Developers',
        mixins: [SnackbarComponent, Form],
        props: ['developerCollection'],
        data: () => ({
            dialog: false,
            loading: false,
            paginationSync: {rowsPerPage: 10},
            headers: [
                {
                    text: 'Name',
                    align: 'left',
                    sort: true,
                    value: 'name'
                },
                {
                    text: 'Logo',
                    align: 'left',
                    value: 'logo',
                    sortable: false,
                },
                {
                    text: 'Description',
                    align: 'left',
                    value: 'description',
                    sortable: false,
                },
                {
                    text: 'الوصف',
                    align: 'right',
                    value: 'translation.description',
                    sortable: false,
                },
                {text: 'Actions', align: 'center', value: 'name', sortable: false}
            ],
            developers: [],
            editedIndex: -1,
            editedItem: {
                name: null,
                description: null,
                logo: null,
                translation: {
                    description: null
                }
            },
            defaultItem: {
                name: null,
                description: null,
                logo: null,
                translation: {
                    description: null
                }
            },
            search: '',
            nameRules: [
                v => !!v || 'Name is required',
                v => (v && v.length <= 30) || 'Name must be less than 30 characters'
            ],
            descriptionRules: [
                v => (v && v.length <= 300) || 'Description must be less than 300 characters'
            ],
            postRoute: '/dashboard/developers',
            updateRoute: '/dashboard/developers/',
            deleteRoute: '/dashboard/developers/',
            logo: ''
        }),
        computed: {
            formTitle() {
                return this.editedIndex === -1 ? 'New Developer' : 'Edit Developer';
            },
            uploadTitle() {
                return this.editedIndex === -1 ? 'Upload Logo' : 'Change Logo';
            }
        },
        watch: {
            dialog(val) {
                val || this.close();
            },
            editedItem(val) {
                if (this.editedItem.translation === null) {
                    this.editedItem.translation = {};
                    this.editedItem.translation.description = '';
                }
                this.logo = this.editedItem.logo_url;
            }
        },
        created() {
            this.developers = this.developerCollection;
        },
        methods: {
            save() {
                let vm = this;
                let developer = new FormData();
                let item = this.editedItem;

                vm.loading = true;
                Object.keys(item).forEach(key => {
                    if (key === 'logo_url') return;

                    if (!!item[key]) {
                        if (key === 'logo') {
                            developer.append(key, item[key]);
                            return;
                        }

                        if (key === 'translation') {
                            Object.keys(item[key]).forEach(translationKey => {
                                if (!!item[key][translationKey])
                                    developer.set(`translation[${translationKey}]`, item[key][translationKey]);
                            });
                            return;
                        }
                        developer.set(key, item[key]);
                    }
                });

                if (this.editedIndex > -1) {
                    if (this.validate('developerForm')) {
                        let vm = this;
                        vm.loading = true;
                        axios.post(vm.updateRoute + item.slug, developer)
                            .then(res => {
                                console.log(item);
                                Object.assign(vm.developers[vm.editedIndex], res.data.data);
                                vm.reset('developerForm');
                                vm.activateSnackbar('success', res.data.message);
                            })
                            .catch(error => {
                                console.log(error);
                                vm.loading = false;
                                vm.activateSnackbar('error', error.response.data.message);
                            })
                    }

                } else {
                    this.post(developer, 'developerForm', 'developers') ? this.logo = '' : null;
                }
            },
            triggerUpload() {
                let logoUploader = document.querySelector('#logoUploader');
                logoUploader.click();
            },
            uploadLogo(e) {
                let vm = this;
                let file = e.target.files[0]; //sames as here
                let reader = new FileReader();

                vm.editedItem.logo = file;
                reader.onloadend = function () {
                    vm.logo = reader.result;
                };

                if (file) {
                    reader.readAsDataURL(file); //reads the data as a URL
                    e.target.value = '';
                } else {
                    vm.logo = '';
                }
            },
            closeDialog() {
                this.close();
            }
        },
    }
</script>

<style scoped>

</style>