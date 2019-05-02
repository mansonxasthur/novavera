<template xmlns:v-slot="http://www.w3.org/1999/XSL/Transform">
    <v-container>
        <v-layout row wrap justify-center>
            <v-flex xs12 sm10 md8 lg6>
                <v-card class="mt-5">
                    <v-card-title>
                        <span class="title">
                            <v-icon class="mx-1" color="deep-orange accent-2">photo_library</v-icon>
                            Sliders</span>
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
                                :items="sliders"
                                :search="search"
                                :pagination.sync="paginationSync"
                                class="elevation-0"
                        >
                            <template v-slot:items="props">
                                <td>{{ props.item.name }}</td>
                                <td>
                                    <v-switch v-model="!!props.item.main" color="success" @change="toggleMain(props.item)"></v-switch>
                                </td>
                                <td class="text-xs-center">
                                    <a :href="'/dashboard/sliders/' + props.item.id + '/edit'">
                                        <v-btn flat fab small>
                                            <v-icon
                                                    small
                                            >
                                                edit
                                            </v-icon>
                                        </v-btn>
                                    </a>
                                    <v-btn flat fab small>
                                        <v-icon
                                                small
                                                @click="deleteItem(props.item, 'sliders')"
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
                                    New Slider
                                </v-btn>
                            </template>
                            <v-card>
                                <v-card-title>
                                    <span class="headline">New Slider</span>
                                </v-card-title>

                                <v-card-text>
                                    <v-form ref="sliderForm">
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
                @confirm="confirmDelete('sliders')"
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
        name: 'Sliders',
        mixins: [SnackbarComponent, Form],
        props: ['sliderCollection'],
        data: () => ({
            dialog: false,
            paginationSync : {rowsPerPage: 10},
            headers: [
                {
                    text: 'Name',
                    align: 'left',
                    sort: true,
                    value: 'name'
                },
                {
                    text: 'Main',
                    align: 'left',
                    sortable: false,
                    value: 'main'
                },
                {text: 'Actions', align: 'center', value: 'name', sortable: false}
            ],
            sliders: [],
            editedItem: {
                name: '',
            },
            defaultItem: {
                name: '',
            },
            search: '',
            nameRules: [
                v => !!v || 'Name is required',
                v => (v && v.length <= 30) || 'Name must be less than 30 characters'
            ],
            postRoute: '/dashboard/sliders',
            deleteRoute: '/dashboard/sliders/',
        }),
        watch: {
            dialog(val) {
                val || this.close();
            },
        },
        created() {
            this.sliders = this.sliderCollection;
        },
        methods: {
            save() {
                this.post({
                    name: this.editedItem.name,
                }, 'sliderForm', 'sliders');
            },
            toggleMain(slider) {
                let vm = this;
                let index = vm.sliders.indexOf(slider);
                let main = !slider.main;
                axios.post('/dashboard/sliders/' + slider.id + '/main', {main})
                    .then(res => {
                        vm.activateSnackbar('success', res.data.message);
                        vm.sliders[index].main = main;
                        if (main) {
                            vm.sliders.forEach(item => {
                                if (item.id !== slider.id) {
                                    item.main = !main;
                                }
                            } )
                        }
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