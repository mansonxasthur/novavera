<template>
    <v-container>
        <v-layout>
            <v-flex>
                <h2 class="display-1 novadev-title px-3">NOVAVERA DEVELOPERS</h2>
                <v-container grid-list-md>
                    <v-layout row wrap py-5>
                        <v-flex xs6 sm4 md3 lg2
                                text-xs-center
                                v-for="developer in developers" :key="developer.id">
                            <a :href="path(developer)" class="developer-path">
                                <v-card flat hover>
                                    <v-card-text>
                                        <img :src="developer.logo_url" :alt="developer.name" class="developer-img">
                                        <h5 class="title mt-3" v-text="developer.name"></h5>
                                    </v-card-text>
                                </v-card>
                            </a>
                        </v-flex>
                    </v-layout>
                </v-container>
            </v-flex>
        </v-layout>
    </v-container>
</template>

<script>
    export default {
        name: "Developers",
        props: {
            developers: {
                required: true,
                type: Array,
            }
        },
        methods: {
            path(developer) {
                return '/developers/' + developer.slug;
            }
        }
    }
</script>

<style scoped>
    .novadev-title {
        border-left: 3px #cc0000 solid;
    }

    a.developer-path {text-decoration: none}
    .developer-img {max-height: 100px; max-width: 100%}
</style>