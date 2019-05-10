<template xmlns:v-slot="http://www.w3.org/1999/XSL/Transform">
    <v-container>
        <v-layout row wrap justify-center>
            <v-flex xs12 sm10 md8 lg6>
                <v-card class="mt-5">
                    <v-card-title>
                        <span class="title">
                            <v-icon class="mx-1" color="deep-orange accent-2">location_on</v-icon>
                            Locations</span>
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
                                :items="locations"
                                :search="search"
                                :pagination.sync="paginationSync"
                                class="elevation-0"
                        >
                            <template v-slot:items="props">
                                <td>{{ props.item.name }}</td>
                                <td class="text-xs-right">{{ props.item.translation !== null ? props.item.translation.name : '' }}</td>
                                <td class="text-xs-center">
                                    <v-btn flat fab small>
                                        <v-icon
                                                small
                                                @click="editItem(props.item, 'locations')"
                                        >
                                            edit
                                        </v-icon>
                                    </v-btn>
                                    <v-btn flat fab small>
                                        <v-icon
                                                small
                                                @click="deleteItem(props.item, 'locations')"
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
                                    New Location
                                </v-btn>
                            </template>
                            <v-card>
                                <v-card-title>
                                    <span class="headline">{{ formTitle }}</span>
                                </v-card-title>

                                <v-card-text>
                                    <v-form ref="locationForm">
                                        <v-container grid-list-md>
                                            <v-layout wrap>
                                                <v-flex xs12 md6>
                                                    <v-text-field
                                                            v-model="editedItem.name"
                                                            :counter="30"
                                                            :rules="nameRules"
                                                            label="English Name"
                                                            required
                                                    ></v-text-field>
                                                </v-flex>
                                                <v-flex xs12 md6>
                                                    <v-text-field
                                                            v-model="editedItem.translation.name"
                                                            :counter="20"
                                                            :rules="nameRules"
                                                            label="الأسم العربي"
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
                @confirm="confirmDelete('locations')"
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
        name: 'Locations',
        mixins: [SnackbarComponent, Form],
        props: ['locationCollection'],
        data: () => ({
            dialog: false,
            paginationSync : {rowsPerPage: 10},
            headers: [
                {
                    text: 'English Name',
                    align: 'left',
                    sort: true,
                    value: 'name'
                },
                {
                    text: 'الأسم العربي',
                    align: 'right',
                    sort: true,
                    value: 'translation.name'
                },
                {text: 'Actions', align: 'center', value: 'name', sortable: false}
            ],
            locations: [],
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
            postRoute: '/dashboard/locations',
            updateRoute: '/dashboard/locations/',
            deleteRoute: '/dashboard/locations/',
        }),
        computed: {
            formTitle() {
                return this.editedIndex === -1 ? 'New Location' : 'Edit Location';
            }
        },
        watch: {
            dialog(val) {
                val || this.close();
            },
            editedItem(val) {
                if (this.editedItem.translation === null) {
                    this.editedItem.translation = {name: null};
                }
            }
        },
        created() {
            this.locations = this.locationCollection;
        },
        methods: {
            save() {
                if (this.editedIndex > -1) {
                    this.update(
                        this.editedItem, this.editedItem.id
                        , 'locationForm', 'locations');
                } else {
                    this.post(this.editedItem, 'locationForm', 'locations');
                }
            }
        }
    }
</script>

<style scoped>

</style>