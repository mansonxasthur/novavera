<template xmlns:v-slot="http://www.w3.org/1999/XSL/Transform">
    <v-container fluid>
        <v-layout row wrap justify-center>
            <v-flex xs12>
                <v-card class="mt-5">
                    <v-card-title>
                        <span class="title">
                            <v-icon class="mx-1" color="deep-orange accent-2">fas fa-user-clock</v-icon>
                            Property Requests</span>
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
                                :items="requests"
                                :search="search"
                                :pagination.sync="paginationSync"
                                class="elevation-0"
                        >
                            <template v-slot:items="props">
                                <td>{{ props.item.name }}</td>
                                <td>{{ props.item.email }}</td>
                                <td>{{ props.item.phone }}</td>
                                <td>{{ props.item.project.name }}</td>
                                <td>{{ props.item.property_type.name }}</td>
                                <td>

                                    <v-icon color="blue" @click="showMessage(props.item)">
                                        visibility
                                    </v-icon>

                                </td>
                                <td class="text-xs-center">
                                    <v-icon
                                            color="error"
                                            @click="deleteItem(props.item, 'requests')"
                                    >
                                        delete
                                    </v-icon>

                                </td>
                            </template>
                        </v-data-table>
                    </v-card-text>
                </v-card>
            </v-flex>
        </v-layout>
        <delete-dialog
                @confirm="confirmDelete('requests')"
                @closeDialog="closeDeleteDialog"
                :loading="loading"
                :delete-dialog="deleteDialog"
        ></delete-dialog>
        <snackbar :active="snackbar.active" :color="snackbar.color" :message="snackbar.message"
                  @deactivate="deactivateSnackbar"></snackbar>

        <v-dialog
                v-model="dialog"
                max-width="500px"
                width="100%"
        >
            <v-card>
                <v-card-title class="headline">{{ message.author }}</v-card-title>

                <v-card-text>
                    {{ message.body }}
                </v-card-text>

                <v-card-actions>
                    <v-spacer></v-spacer>

                    <v-btn
                            flat="flat"
                            @click="hideMessage"
                    >
                        Close
                    </v-btn>
                </v-card-actions>
            </v-card>
        </v-dialog>
    </v-container>

</template>

<script>
    import SnackbarComponent from '../../../mixins/SnackbarComponent';
    import Form from '../../../mixins/Form';

    export default {
        name: 'PropertyRequest',
        mixins: [SnackbarComponent, Form],
        props: ['propertyRequestCollection'],
        data: () => ({
            dialog: false,
            paginationSync: {rowsPerPage: 10},
            headers: [
                {
                    text: 'Name',
                    align: 'left',
                    value: 'name'
                },
                {
                    text: 'Email',
                    align: 'left',
                    value: 'email',
                    sortable: false,
                },
                {
                    text: 'Phone',
                    align: 'left',
                    value: 'phone',
                    sortable: false,
                },
                {
                    text: 'Project',
                    align: 'left',
                    value: 'project.name',
                },
                {
                    text: 'Property Type',
                    align: 'left',
                    value: 'propertyType.name'
                },
                {
                    text: 'Message',
                    align: 'left',
                    value: 'message'
                },
                {text: 'Actions', align: 'center', value: 'name', sortable: false}
            ],
            requests: [],
            search: '',
            message: {
                author: null,
                body: null,
            },
            deleteRoute: '/dashboard/property-requests/',
        }),
        created() {
            this.requests = this.propertyRequestCollection;
        },
        methods: {
            showMessage(request) {
                this.dialog = true;
                this.message.author = request.name;
                this.message.body = request.message;
            },
            hideMessage() {
                this.dialog = false;
                this.message.author = null;
                this.message.body = null;
            }
        }
    }
</script>

<style scoped>

</style>