<template>
    <v-container fluid>
        <v-layout column>
            <v-flex>
                <v-layout row wrap>
                    <v-flex xs12 md8 pa-3>
                        <slider :slider-images="project.images ? project.images : []" src="image_url" height="auto"></slider>
                    </v-flex>
                    <v-flex xs12 md4 pa-3 grow>
                        <v-layout column align-space-between grey lighten-4>
                            <v-flex>
                                <v-layout row justify-center>
                                    <v-flex shrink>
                                        <v-avatar size="160" class="mt-5" tile>
                                            <img :src="project.logo_url !== '' ? project.logo_url : project.developer.logo_url" :alt="project.name">
                                        </v-avatar>
                                    </v-flex>
                                </v-layout>
                            </v-flex>
                            <v-flex text-xs-center py-3>
                                <h3 class="title mb-2">Starting Price</h3>
                                <h2 class="display-1">{{ project.price }} <small>EG</small></h2>
                            </v-flex>
                            <v-flex py-5>
                                <v-layout row wrap>
                                    <v-flex xs12 md6>
                                        <v-layout column align-space-between>
                                            <v-flex class="nova-primary-bg pa-3 my-3" v-for="property in project.property_types" :key="property.id">
                                                <h4 class="title white--text">{{ property.name }}</h4>
                                            </v-flex>
                                        </v-layout>
                                    </v-flex>
                                    <v-flex xs12 md6>
                                        <v-layout column align-center justify-center text-xs-center>
                                            <v-flex py-2 v-if="project.down_payment">
                                                <h5 class="subheading">Down Payment</h5>
                                                <h3 class="display-1">{{ project.down_payment }}</h3>
                                            </v-flex>
                                            <v-flex py-2 v-if="project.installment_years">
                                                <h5 class="subheading">Installment Years</h5>
                                                <h3 class="display-1">{{ project.installment_years}}</h3>
                                            </v-flex>
                                            <v-flex py-2 v-if="project.delivery_date">
                                                <h5 class="subheading">Delivery Date</h5>
                                                <h3 class="display-1">{{ project.delivery_date }}</h3>
                                            </v-flex>
                                        </v-layout>
                                    </v-flex>
                                    <v-flex xs12>
                                        <v-btn
                                                href="tel:+201020166669"
                                                large
                                                block
                                                color="primary"
                                        >
                                            <v-icon left>phone</v-icon>
                                            +201020166669</v-btn>
                                    </v-flex>
                                    <v-flex xs12>
                                        <v-btn
                                                large
                                                block
                                                color="primary"
                                                @click="ask"
                                        >
                                            <v-icon left>message</v-icon>
                                            Ask Now</v-btn>
                                    </v-flex>
                                </v-layout>
                            </v-flex>
                        </v-layout>
                    </v-flex>
                </v-layout>
            </v-flex>
            <v-flex pa-4>
                <h2 class="display-1 project-name pl-3">{{ project.name }}</h2>
                <v-layout row wrap>
                    <v-flex xs12 sm3>
                        <v-layout column>
                            <v-flex text-xs-center my-5 class="developer">
                                <h5 class="title mb-3">Developed by</h5>
                                <v-avatar size="150" tile>
                                    <img :src="project.developer.logo_url" :alt="project.developer.name">
                                </v-avatar>
                            </v-flex>
                        </v-layout>
                    </v-flex>
                    <v-flex xs12 sm9 px-4>
                        <v-layout column align-space-between>
                            <v-flex my-5>
                                <div class="body-1" v-html="project.description"></div>
                            </v-flex>
                            <v-flex>
                                <div id="map"></div>
                            </v-flex>
                        </v-layout>
                    </v-flex>
                </v-layout>
            </v-flex>
        </v-layout>
        <v-dialog v-model="dialog" max-width="40%">
            <v-card>
                <v-card-title>
                    <h4 class="headline">Ask Now</h4>
                </v-card-title>
                <v-divider></v-divider>
                <v-card-text>
                    <v-form>
                        <v-layout row wrap>
                            <v-flex xs12>
                                <v-text-field
                                    type="text"
                                    label="Name"
                                    prepend-icon="person"
                                    v-model="name"
                                    required
                                    autocomplete="name"
                                    color="primary"
                                >
                                </v-text-field>
                            </v-flex>
                            <v-flex xs12>
                                <v-text-field
                                        type="email"
                                        label="Email"
                                        prepend-icon="email"
                                        v-model="email"
                                        required
                                        autocomplete="email"
                                        color="primary"
                                >
                                </v-text-field>
                            </v-flex>
                            <v-flex xs12>
                                <v-textarea
                                        label="Message"
                                        prepend-icon="message"
                                        v-model="message"
                                        required
                                        color="primary"
                                >

                                </v-textarea>
                            </v-flex>
                        </v-layout>
                    </v-form>
                </v-card-text>
                <v-card-actions>
                    <v-spacer></v-spacer>
                    <v-btn color="primary" @click="dialog = !dialog">close</v-btn>
                    <v-btn color="primary" @click="send">Send</v-btn>
                </v-card-actions>
            </v-card>
        </v-dialog>
    </v-container>
</template>

<script>
    import gmapsInit from '../utilities/gmaps';

    export default {
        name: "Project",
        props: {
            project: {
                required: true,
                type: Object,
            }
        },
        data() {
            return {
                dialog: false,
                name: '',
                email: '',
                message: '',
            }
        },
        async mounted() {
            try {
                const google = await gmapsInit();
                const geocoder = new google.maps.Geocoder();
                const map = new google.maps.Map(document.getElementById('map'), {
                    center: {lat: Number(this.project.lat), lng: Number(this.project.lng)},
                    zoom: 16
                });

            } catch (error) {
                console.error(error);
            }
        },
        methods: {
            ask() {
                this.dialog = true;
            },
            send() {

            }
        },
    }
</script>

<style scoped>
    .project-name {
        border-left: 3px #cc0000 solid;
    }

    .developer {
        border-right: 3px #14152E solid;
    }

    #map {
        height: 500px;
    }
</style>