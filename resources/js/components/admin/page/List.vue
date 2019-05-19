<template xmlns:v-slot="http://www.w3.org/1999/XSL/Transform">
    <v-container>
        <v-layout row wrap justify-center>
            <v-flex xs12 sm10 md8 lg6>
                <v-card class="mt-5">
                    <v-card-title>
                        <span class="title">
                            <v-icon class="mx-1" color="deep-orange accent-2">pages</v-icon>
                            Pages</span>
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
                                :items="pages"
                                :search="search"
                                :pagination.sync="paginationSync"
                                class="elevation-0"
                        >
                            <template v-slot:items="props">
                                <td>{{ props.item.title }}</td>
                                <td class="text-xs-right">{{ props.item.translation ? props.item.translation.title : '' }}</td>
                                <td>
                                    <v-switch v-model="!!props.item.published" color="success" @change="togglePublish(props.item)" :disabled="disabled"></v-switch>
                                </td>
                                <td class="text-xs-center">
                                    <a :href="'/dashboard/pages/' + props.item.slug + '/edit'">
                                        <v-btn flat small fab>
                                            <v-icon
                                                    small
                                            >
                                                edit
                                            </v-icon>
                                        </v-btn>
                                    </a>
                                    <v-btn flat small fab :disabled="disabled">
                                        <v-icon
                                                small
                                                @click="deleteItem(props.item, 'pages')"
                                        >
                                            delete
                                        </v-icon>
                                    </v-btn>
                                </td>
                            </template>
                        </v-data-table>
                    </v-card-text>
                    <v-card-actions>
                        <v-btn color="primary" outline class="mb-2" href="/dashboard/pages/create" :disabled="disabled">
                            New Page
                        </v-btn>
                    </v-card-actions>
                </v-card>
            </v-flex>
        </v-layout>
        <delete-dialog
                @confirm="confirmDelete('pages', '', 'slug')"
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
        name: "Pages",
        mixins: [SnackbarComponent, Form, auth],
        props: ['pageCollection'],
        data() {
            return {
                pages: [],
                dialog: false,
                paginationSync : {rowsPerPage: 10},
                headers: [
                    {
                        text: 'Title',
                        align: 'left',
                        sort: true,
                        value: 'title'
                    },
                    {
                        text: 'العنوان',
                        align: 'right',
                        sort: true,
                        value: 'translation.title'
                    },
                    {
                        text: 'publish',
                        align: 'left',
                        sortable: false,
                        value: 'published'
                    },
                    {text: 'Actions', align: 'center', value: 'name', sortable: false}
                ],
                search: '',
                deleteRoute: '/dashboard/pages/',
            }
        },
        created() {
            this.pages = this.pageCollection;
        },
        methods: {
            togglePublish(page) {
                let vm = this;
                let index = vm.pages.indexOf(page);
                let publish = !page.published;
                axios.post('/dashboard/pages/' + page.slug + '/publish', {publish})
                    .then(res => {
                        vm.activateSnackbar('success', res.data.message);
                        vm.pages[index].published = publish;
                    })
                    .catch(error => {
                        console.log(error.response.data.message);
                    });
            }
        }
    }
</script>

<style scoped>
    a {
        text-decoration: none;
    }
</style>