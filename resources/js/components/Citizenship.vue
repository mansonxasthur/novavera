<template>
    <v-container fluid fill-height>
        <div class="intro" :style="`background-image: url('${citizenship.header_url}')`">

                <section :style="`height: ${height}px`">
                    <v-container fill-height fluid>
                        <v-layout fill-height column align-center justify-center>
                            <v-flex shrink class="text-xs-center intro-content">
                                <div class="display-1">{{ citizenship.country_name }}</div>
                            </v-flex>
                        </v-layout>
                    </v-container>
                </section>

        </div>
    </v-container>
</template>

<script>
    export default {
        name: "Citizenship",
        props: {
            citizenship: {
                required: true,
                type: Object,
            },
            citizenshipCollection: {
                required: true,
                type: Array,
            }
        },
        data() {
            return {
                height: 500,
            }
        },
        mounted() {
            this.height = document.documentElement.clientHeight;
        }
    }
    /* @todo Citizenship page */
</script>

<style scoped>
    .container-fluid {
        padding-left: 0;
        padding-right: 0;
    }

    .intro{
        min-height: 100vh;
        width: 100%;
        background-attachment: fixed;
        background-size: cover;
    }

    .intro-content {
        width: 100%;
        padding: 20px 0;
        background: rgba(0,0,0, 0.4);
        color: #fff;
    }
</style>