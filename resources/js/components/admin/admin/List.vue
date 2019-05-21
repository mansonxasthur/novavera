<template xmlns:v-slot="http://www.w3.org/1999/XSL/Transform">
    <v-container fluid>
        <v-layout row wrap justify-center>
            <v-flex xs12 sm10 md8>
                <v-card class="mt-5">
                    <v-card-title>
                        <span class="title">
                            <v-icon class="mx-1" color="deep-orange accent-2">people</v-icon>
                            Admins</span>
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
                                :items="admins"
                                :search="search"
                                :pagination.sync="paginationSync"
                                class="elevation-0"
                        >
                            <template v-slot:items="props">
                                <td>{{ props.item.name }}</td>
                                <td>{{ props.item.email }}</td>
                                <td>{{ props.item.role.name }}</td>
                                <td class="text-xs-center">
                                    <v-btn flat fab small>
                                        <v-icon
                                                small
                                                @click="editItem(props.item, 'admins')"
                                        >
                                            edit
                                        </v-icon>
                                    </v-btn>
                                    <v-btn flat fab small>
                                        <v-icon
                                                small
                                                @click="deleteItem(props.item, 'admins')"
                                        >
                                            delete
                                        </v-icon>
                                    </v-btn>
                                </td>
                            </template>
                        </v-data-table>
                    </v-card-text>
                    <v-card-actions>
                        <v-dialog v-model="dialog" max-width="500px" width="100%" persistent>
                            <template v-slot:activator="{ on }">
                                <v-btn color="primary" outline class="mb-2" v-on="on">
                                    New Admin
                                </v-btn>
                            </template>
                            <v-card>
                                <v-card-title>
                                    <span class="headline">{{ formTitle }}</span>
                                </v-card-title>

                                <v-card-text>
                                    <v-form ref="adminForm">
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
                                                </v-flex>
                                                <v-flex xs12>
                                                    <v-text-field
                                                            v-model="editedItem.email"
                                                            label="Email"
                                                            required
                                                    ></v-text-field>
                                                </v-flex>
                                                <v-flex xs12>
                                                    <v-select
                                                        v-model="editedItem.role_id"
                                                        :items="roles"
                                                        item-text="name"
                                                        item-value="id"
                                                        label="Role"
                                                    >
                                                    </v-select>
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
                @confirm="confirmDelete('admins')"
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
        name: "Admins",
        mixins: [SnackbarComponent, Form],
        props: {
            roles: {
                required: true,
                type: Array,
            },
            adminCollection: {
                required: true,
                type: Array,
            }
        },
        data: () => ({
            dialog: false,
            loading: false,
            paginationSync : {rowsPerPage: 10},
            headers: [
                {
                    text: 'Name',
                    align: 'left',
                    sort: true,
                    value: 'name'
                },
                {
                    text: 'Email',
                    align: 'left',
                    value: 'email',
                    sortable: false,
                },
                {
                    text: 'Role',
                    align: 'left',
                    value: 'role.name',
                    sortable: false,
                },
                {text: 'Actions', align: 'center', value: 'name', sortable: false}
            ],
            admins: [],
            editedIndex: -1,
            editedItem: {
                name: null,
                email: null,
                role_id: null
            },
            defaultItem: {
                name: null,
                email: null,
                role_id: null
            },
            search: '',
            nameRules: [
                v => !!v || 'Name is required',
                v => (v && v.length <= 30) || 'Name must be less than 30 characters'
            ],
            descriptionRules: [
                v => (v && v.length <= 150) || 'Name must be less than 150 characters'
            ],
            postRoute: '/dashboard/admins',
            updateRoute: '/dashboard/admins/',
            deleteRoute: '/dashboard/admins/',
        }),
        computed: {
            formTitle() {
                return this.editedIndex === -1 ? 'New Admin' : 'Edit Admin';
            }
        },
        watch: {
            dialog(val) {
                val || this.close();
            },
        },
        created() {
            this.admins = this.adminCollection;
        },
        methods: {
            save() {
                let vm = this;
                let admin = new FormData();
                let item = this.editedItem;

                vm.loading = true;
                Object.keys(item).forEach(key => {
                    if (key === 'role') return;

                    if (!!item[key]) {

                        admin.set(key, item[key]);
                    }
                });

                if (this.editedIndex > -1) {
                    this.update(item, item.id, 'adminForm', 'admins')

                } else {
                    this.post(admin, 'adminForm', 'admins');
                }
            },
            closeDialog() {
                this.close();
            }
        }
    }
</script>

<style scoped>

</style>