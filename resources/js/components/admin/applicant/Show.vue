<template>
    <v-container>
        <v-layout row wrap justify-center>
            <v-flex xs12 sm10 md8>
                <v-card>
                    <v-card-title>
                        <h3 class="display-1 mx-auto my-4">{{ applicant.name }}</h3>
                    </v-card-title>
                    <v-card-text>
                        <v-layout row wrap>
                            <v-flex xs12 md6 text-xs-center>
                                <p class="title"><v-icon>email</v-icon> {{ applicant.email }}</p>
                            </v-flex>
                            <v-flex xs12 md6 text-xs-center>
                                <p class="title"><v-icon>phone</v-icon> {{ applicant.phone }}</p>
                            </v-flex>
                            <v-flex xs12 text-xs-center v-if="!!applicant.linkedin_link">
                                <p class="title"><v-icon>fab fa-linkedin</v-icon>
                                    <a :href="applicant.linkedin_link" target="_blank">{{ applicant.linkedin_link }}</a></p>
                            </v-flex>
                            <v-flex xs12 md6 text-xs-center py-4>
                                <v-list>
                                    <v-list-tile>
                                        <v-list-tile-title>
                                            Shortlist
                                        </v-list-tile-title>
                                        <v-list-tile-action>
                                            <v-switch v-model="applicant.shortlist" color="success"></v-switch>
                                        </v-list-tile-action>
                                    </v-list-tile>
                                </v-list>
                            </v-flex>
                            <v-flex xs12 md6 text-xs-center py-4>
                                <v-list>
                                    <v-list-tile>
                                        <v-list-tile-title>
                                            Reject
                                        </v-list-tile-title>
                                        <v-list-tile-action>
                                            <v-switch v-model="applicant.rejected" color="error"></v-switch>
                                        </v-list-tile-action>
                                    </v-list-tile>
                                </v-list>
                            </v-flex>
                            <v-flex xs12 mt-5>
                                <h3 class="display-1 font-weight-black text-xs-center my-4 grey--text">C.V.</h3>
                                <viewer-js :file="applicant.cv"></viewer-js>
                            </v-flex>
                        </v-layout>
                    </v-card-text>
                </v-card>
            </v-flex>
        </v-layout>
    </v-container>
</template>

<script>
    import ViewerJs from '../../ViewerJs';

    export default {
        name: "ApplicantShow",
        components: {ViewerJs},
        props: {
            applicantCollection: {
                required: true,
                type: Object,
            }
        },
        data() {
            return {
                applicant: null,
            }
        },
        created() {
            this.applicant = this.applicantCollection;
        },
        watch: {
            'applicant.shortlist': function(val) {
                axios.put('/dashboard/applicants/' + this.applicant.id + '/shortlist', {shortlist: val})
            },
            'applicant.rejected': function(val) {
                axios.put('/dashboard/applicants/' + this.applicant.id + '/reject', {rejected: val})
            }
        }
    }
</script>

<style scoped>

</style>