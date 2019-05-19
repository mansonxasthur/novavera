<template xmlns:v-slot="http://www.w3.org/1999/XSL/Transform">
    <v-container fluid>
        <v-layout row wrap justify-center>
            <v-flex xs12 sm10>
                <v-card class="mt-5">
                    <v-card-title>
                        <span class="title">
                            <v-icon class="mx-1" color="deep-orange accent-2">flag</v-icon>
                            Citizenship</span>
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
                                :items="citizenships"
                                :search="search"
                                :pagination.sync="paginationSync"
                                class="elevation-0"
                        >
                            <template v-slot:items="props">
                                <td>
                                    <v-img width="auto" class="my-2" :src="props.item.flag_url"></v-img>
                                </td>
                                <td>{{ props.item.country_name }}</td>
                                <td class="text-capitalize">{{ props.item.type }}</td>
                                <td class="text-xs-center">
                                    <a :href="'/dashboard/citizenship/' + props.item.slug + '/edit'">
                                        <v-btn flat small fab>
                                            <v-icon
                                                    small
                                            >
                                                edit
                                            </v-icon>
                                        </v-btn>
                                    </a>
                                    <v-btn flat small fab>
                                        <v-icon
                                                small
                                                @click="deleteItem(props.item, 'citizenships')"
                                                :disabled="disabled"
                                        >
                                            delete
                                        </v-icon>
                                    </v-btn>
                                </td>
                            </template>
                        </v-data-table>
                    </v-card-text>
                    <v-card-actions>
                        <v-btn color="primary" outline class="mb-2" href="/dashboard/citizenship/create" :disabled="disabled">
                            New Citizenship
                        </v-btn>
                    </v-card-actions>
                </v-card>
            </v-flex>
        </v-layout>
        <delete-dialog
                @confirm="confirmDelete('citizenships','', 'slug')"
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
    import auth from "../../../mixins/auth";


    export default {
        name: "Citizenships",
        mixins: [SnackbarComponent, Form, auth],
        props: ['citizenshipCollection'],
        data() {
            return {
                citizenships: [],
                paginationSync : {rowsPerPage: 10},
                dialog: false,
                headers: [
                    {
                        text: '#',
                        align: 'left',
                        value: 'flag_url',
                        sortable: false,
                    },
                    {
                        text: 'Country Name',
                        align: 'left',
                        sort: true,
                        value: 'country_name'
                    },
                    {
                        text: 'Type',
                        align: 'left',
                        sort: true,
                        value: 'type'
                    },
                    {text: 'Actions', align: 'center', value: 'country_name', sortable: false}
                ],
                search: '',
                deleteRoute: '/dashboard/citizenship/',
            }
        },
        created() {
            this.citizenships = this.citizenshipCollection;
        },
        filters: {
            capitalize(value) {
                if (!value) return '';
                value = value.toString();
                return value.charAt(0).toUpperCase() + value.slice(1);
            }
        }
    }
</script>

<style scoped>
    a {
        text-decoration: none;
    }
</style>