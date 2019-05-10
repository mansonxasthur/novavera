<template xmlns:v-slot="http://www.w3.org/1999/XSL/Transform">
    <v-container>
        <v-layout row wrap justify-center>
            <v-flex xs12 sm10 md8 lg6>
                <v-card class="mt-5">
                    <v-card-title>
                        <span class="title">
                            <v-icon class="mx-1" color="deep-orange accent-2">local_offer</v-icon>
                            Tags</span>
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
                                :items="tags"
                                :search="search"
                                class="elevation-0"
                        >
                            <template v-slot:items="props">
                                <td>{{ props.item.name }}</td>
                                <td>{{ props.item.translation !== null ?
                                    props.item.translation.name : '' }}</td>
                                <td class="text-xs-center">
                                    <v-btn flat fab small>
                                        <v-icon
                                                small
                                                @click="editItem(props.item, 'tags')"
                                        >
                                            edit
                                        </v-icon>
                                    </v-btn>
                                    <v-btn flat fab small>
                                        <v-icon
                                                small
                                                @click="deleteItem(props.item, 'tags')"
                                        >
                                            delete
                                        </v-icon>
                                    </v-btn>
                                </td>
                            </template>
                        </v-data-table>
                    </v-card-text>
                    <v-card-actions>
                        <v-dialog v-model="dialog" max-width="500px">
                            <template v-slot:activator="{ on }">
                                <v-btn color="primary" outline class="mb-2" v-on="on">
                                    New Tag
                                </v-btn>
                            </template>
                            <v-card>
                                <v-card-title>
                                    <span class="headline">{{ formTitle }}</span>
                                </v-card-title>

                                <v-card-text>
                                    <v-form ref="tagForm">
                                        <v-container grid-list-md>
                                            <v-layout wrap>
                                                <v-flex xs12>
                                                    <v-text-field
                                                            v-model="editedItem.name"
                                                            :counter="30"
                                                            :rules="nameRules"
                                                            label="Name"
                                                            required
                                                    ></v-text-field>
                                                    <v-text-field
                                                            v-model="editedItem.translation.name"
                                                            :counter="30"
                                                            :rules="nameRules"
                                                            label="الأسم"
                                                            required
                                                    ></v-text-field>
                                                </v-flex>
                                            </v-layout>
                                        </v-container>
                                    </v-form>
                                </v-card-text>

                                <v-card-actions>
                                    <v-spacer></v-spacer>
                                    <v-btn color="blue darken-1" flat @click="close">Cancel</v-btn>
                                    <v-btn color="blue darken-1" :loading="loading" flat @click="save">Save</v-btn>
                                </v-card-actions>
                            </v-card>
                        </v-dialog>
                    </v-card-actions>
                </v-card>
            </v-flex>
        </v-layout>
        <delete-dialog
                @confirm="confirmDelete('tags')"
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
        name: 'Tags',
        mixins: [SnackbarComponent, Form],
        props: ['tagCollection'],
        data: () => ({
            dialog: false,
            headers: [
                {
                    text: 'Name',
                    align: 'left',
                    value: 'name'
                },
                {
                    text: 'الأسم',
                    align: 'right',
                    value: 'translation.name'
                },
                {text: 'Actions', align: 'center', value: 'name', sortable: false}
            ],
            tags: [],
            editedIndex: -1,
            editedItem: {
                name: null,
                translation: {
                    name: null
                }
            },
            defaultItem: {
                name: null,
                translation: {
                    name: null
                }
            },
            search: '',
            nameRules: [
                v => !!v || 'Name is required',
                v => (v && v.length <= 30) || 'Name must be less than 30 characters'
            ],
            postRoute: '/dashboard/tags',
            updateRoute: '/dashboard/tags/',
            deleteRoute: '/dashboard/tags/',
        }),
        computed: {
            formTitle() {
                return this.editedIndex === -1 ? 'New Tag' : 'Edit Tag';
            }
        },
        watch: {
            dialog(val) {
                val || this.close();
            },
        },
        created() {
            this.tags = this.tagCollection;
        },
        methods: {
            save() {
                if (this.editedIndex > -1) {
                    this.update(
                        this.editedItem, this.editedItem.id
                        , 'tagForm', 'tags');
                } else {
                    this.post(
                        this.editedItem, 'tagForm', 'tags');
                }
            }
        }
    }
</script>

<style scoped>

</style>