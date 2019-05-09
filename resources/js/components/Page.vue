<template>
    <v-container fluid>
        <v-layout column>
            <v-flex>
                <v-parallax
                        dark
                        :src="page.header_url"
                        :height="height"
                >
                    <v-layout
                            column
                            align-center
                            justify-center
                    >
                        <h1 class="display-1 font-weight-black elevation-1 mb-3 animated flipInX page-title" v-text="page.title"></h1>
                        <div class="red darken-2"
                             style="height: 3px; width: 50px"   ></div>
                    </v-layout>
                </v-parallax>
            </v-flex>
            <v-flex text-xs-center>
                <v-container>
                    <v-layout row justify-center>
                        <v-flex xs12 sm10 v-html="page.body"></v-flex>
                    </v-layout>
                </v-container>
            </v-flex>
        </v-layout>
    </v-container>
</template>

<script>
    export default {
        name: "Page",
        props: {
            page: {
                required: true,
                type: Object
            }
        },
        data() {
            return {
                height: 500,
            }
        },
        mounted() {
            this.height = document.documentElement.clientHeight * 0.65;
        }
    }
</script>

<style lang="scss" scoped>

    .fluid {
        padding: 0;
    }

    .v-parallax__content {
        background: rgba(0,0,0, 1)!important;
        padding: 0!important;
    }

    .page-title {
        text-shadow: 2px 2px 2px #000;
    }
</style>