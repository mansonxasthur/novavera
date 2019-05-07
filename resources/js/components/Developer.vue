<template>
    <v-container>
        <v-layout column>
            <v-flex>
                <h2 class="display-1 developer-name pl-3">{{ developer.name }}</h2>
                <v-layout row wrap>
                    <v-flex xs12 sm3>
                        <v-layout column>
                            <v-flex text-xs-center my-5 class="developer">
                                <v-card flat hover>
                                    <v-card-text>
                                        <img :src="developer.logo_url" :alt="developer.name" height="170px">
                                    </v-card-text>
                                </v-card>
                            </v-flex>
                        </v-layout>
                    </v-flex>
                    <v-flex xs12 sm9 px-4>
                        <div class="body-1 my-5" v-html="developer.description"></div>
                    </v-flex>
                </v-layout>
            </v-flex>
            <v-flex my-5>
                <h2 class="display-1 developer-name pl-3">Projects</h2>
            </v-flex>
        </v-layout>
    </v-container>
</template>

<script>
    export default {
        name: "Developer",
        props: {
            developer: {
                required: true,
                type: Object,
            },
            locations: {
                required: true,
                type: Array,
            }
        }
    }
</script>

<style scoped>
    .developer-name {
        border-left: 3px #cc0000 solid;
    }

    .developer {
        border-right: 3px #14152E solid;
    }
</style>