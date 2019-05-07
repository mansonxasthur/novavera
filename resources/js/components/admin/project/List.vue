<template xmlns:v-slot="http://www.w3.org/1999/XSL/Transform">
    <v-container fluid>
        <v-layout row wrap justify-center>
            <v-flex xs12 sm10>
                <v-card class="mt-5">
                    <v-card-title>
                        <span class="title">
                            <v-icon class="mx-1" color="deep-orange accent-2">apps</v-icon>
                            Projects</span>
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
                                :items="projects"
                                :search="search"
                                :pagination.sync="paginationSync"
                                class="elevation-0"
                        >
                            <template v-slot:items="props">
                                <td>{{ props.item.name }}</td>
                                <td>
                                    <v-img width="auto" class="my-2" :src="props.item.logo ? props.item.logo_url : props.item.developer.logo_url "></v-img>
                                </td>
                                <td>{{ props.item.developer.name }}</td>
                                <td>{{ props.item.location.name }}</td>
                                <td>{{ props.item.project_type | capitalize }}</td>
                                <td class="text-xs-center">
                                    <a :href="'/dashboard/project/' + props.item.slug + '/edit'">
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
                                                @click="deleteItem(props.item, 'projects')"
                                        >
                                            delete
                                        </v-icon>
                                    </v-btn>
                                </td>
                            </template>
                        </v-data-table>
                    </v-card-text>
                    <v-card-actions>
                        <v-btn color="primary" outline class="mb-2" href="/dashboard/projects/create">
                            New Project
                        </v-btn>
                    </v-card-actions>
                </v-card>
            </v-flex>
        </v-layout>
        <delete-dialog
                @confirm="confirmDelete('projects', 'slug')"
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
        name: "Projects",
        mixins: [SnackbarComponent, Form],
        props: ['projectCollection'],
        data() {
            return {
                projects: [],
                paginationSync : {rowsPerPage: 10},
                dialog: false,
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
                        text: 'Developer',
                        align: 'left',
                        sort: true,
                        value: 'developer.name'
                    },
                    {
                        text: 'Location',
                        align: 'left',
                        sort: true,
                        value: 'location.name'
                    },
                    {
                        text: 'Project Type',
                        align: 'left',
                        sort: true,
                        value: 'project_type'
                    },
                    {text: 'Actions', align: 'center', value: 'name', sortable: false}
                ],
                search: '',
                deleteRoute: '/dashboard/project/',
            }
        },
        created() {
            this.projects = this.projectCollection;
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