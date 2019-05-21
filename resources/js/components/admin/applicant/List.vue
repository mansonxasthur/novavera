<template xmlns:v-slot="http://www.w3.org/1999/XSL/Transform">
    <v-container fluid>
        <v-layout row wrap justify-center>
            <v-flex xs12>
                <v-card class="mt-5">
                    <v-card-title>
                        <span class="title">
                            <v-icon class="mx-1" color="deep-orange accent-2">fas fa-id-card</v-icon>
                            Applicants</span>
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
                                :items="applicants"
                                :search="search"
                                :pagination.sync="paginationSync"
                                class="elevation-0"
                        >
                            <template v-slot:items="props">
                                <td>{{ props.item.name }}</td>
                                <td>{{ props.item.email }}</td>
                                <td>{{ props.item.phone }}</td>
                                <td>{{ props.item.department.name }}</td>
                                <td>
                                    <v-icon :color="props.item.shortlist ? 'success' : 'grey'">fiber_manual_record
                                    </v-icon>
                                </td>
                                <td>
                                    <v-icon :color="props.item.rejected ? 'error' : 'grey'">fiber_manual_record</v-icon>
                                </td>
                                <td class="text-xs-center">

                                    <a class="mr-3" style="text-decoration: none;"
                                       :href="`/dashboard/applicants/${props.item.id}`">
                                        <v-icon color="blue">
                                            visibility
                                        </v-icon>
                                    </a>


                                    <v-icon
                                            color="error"
                                            @click="deleteItem(props.item, 'applicants')"
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
                @confirm="confirmDelete('applicants')"
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
        name: 'Applicants',
        mixins: [SnackbarComponent, Form],
        props: ['applicantCollection'],
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
                    text: 'Applied for',
                    align: 'left',
                    value: 'department.name',
                },
                {
                    text: 'Shortlist',
                    align: 'left',
                    value: 'shortlist'
                },
                {
                    text: 'Rejected',
                    align: 'left',
                    value: 'rejected'
                },
                {text: 'Actions', align: 'center', value: 'name', sortable: false}
            ],
            applicants: [],
            search: '',
            deleteRoute: '/dashboard/applicants/',
        }),
        created() {
            this.applicants = this.applicantCollection;
        }
    }
</script>

<style scoped>

</style>