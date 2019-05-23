<template>
    <v-layout column align-space-between dark>
        <v-flex>
            <v-layout justify-center>
                <v-flex shrink class="mt-0 white py-3 px-4">
                    <h3 class="black--text lighten-2 text-xs-center">{{ __words('worldwide') }}</h3>
                </v-flex>
            </v-layout>
        </v-flex>
        <v-flex shrink class="pt-4">
            <v-layout column align-center>
                <v-flex shrink class="py-3"><h2 class="display-1 text-xs-center">{{ __sentences('CAR') }}</h2></v-flex>
                <v-flex shrink
                        class="red darken-2"
                        style="height: 3px; width: 50px">
                </v-flex>
            </v-layout>
        </v-flex>

        <v-flex shrink class="text-xs-center font-weight-light pa-4">
            <div style="width: 100%; max-width: 800px" class="mx-auto">{{ __sentences('carSubheading') }}</div>
        </v-flex>
        <v-flex>
            <v-container grid-list-lg>
                <v-layout row wrap>
                    <v-flex xs12 sm6 md4 lg3 v-for="(citizenship, i) in citizenshipCollection" :key="citizenship.id" v-if="i < length" class="citizenship" d-flex>
                        <a :href="`/countries/${citizenship.type}/${citizenship.slug}`" role="link">
                            <div class="above">
                                <v-img
                                        :src="citizenship.header_url"
                                        :alt="__t(citizenship, 'country_name')"
                                        width="100%"
                                        height="100%"
                                >
                                    <div class="country_name text-xs-center pa-2 primary--text" v-text="__t(citizenship, 'country_name')"></div>
                                    <div class="beneath text-xs-center">
                                        <div class="country_name text-xs-center pa-2 primary--text">{{ __sentences('learnMore') }}</div>
                                        <v-container>
                                            <v-layout fill-height column align-center justify-center>
                                                <v-flex style="margin-top: 20%">
                                                    <p class="subheading font-weight-bold white--text">{{ __t(citizenship, 'snippet') }}</p>
                                                </v-flex>
                                            </v-layout>
                                        </v-container>
                                    </div>
                                </v-img>
                            </div>
                        </a>
                    </v-flex>
                </v-layout>
            </v-container>
        </v-flex>
        <v-flex shrink class="text-xs-center my-3" v-if="citizenshipCollection.length > length">
            <v-btn color="grey lighten-5" @click="discoverMore">
                {{ __sentences('moreCountries') }}
            </v-btn>
        </v-flex>
    </v-layout>
</template>

<script>
    export default {
        name: "CitizenshipSection",
        props: {
            citizenshipCollection: {
                required: true,
                type: Array,
            }
        },
        data() {
            return {
                length: 12,
            }
        },
        methods: {
            discoverMore() {
                this.length = this.citizenshipCollection.length;
                let vm = this;
                setTimeout(function () {
                    vm.init();
                }, 100);
            },
            init() {
                let citizenshipElements = document.querySelectorAll('.citizenship');
                citizenshipElements.forEach(element => {
                    element.addEventListener('mouseenter', function (e) {
                        let beneath = element.querySelector('.beneath');
                        beneath.setAttribute('style', 'opacity: 1');
                    });

                    element.addEventListener('mouseleave', function (e) {
                        let beneath = element.querySelector('.beneath');
                        beneath.setAttribute('style', 'opacity: 0');
                    })
                })
            }
        },
        mounted() {
            this.init();
        }
    }
</script>

<style scoped>
    .citizenship {
        -webkit-border-radius: 15px;
        -moz-border-radius: 15px;
        border-radius: 15px;
        cursor: pointer;
    }

    .citizenship a {
        text-decoration: none;
    }

    .above, .beneath {
        -webkit-border-radius: 15px;
        -moz-border-radius: 15px;
        border-radius: 15px;
        width: 100%;
        height: 100%;
    }
    
    .citizenship .v-image{
        -webkit-border-radius: inherit;
        -moz-border-radius: inherit;
        border-radius: inherit;
    }

    .beneath {
        opacity: 0;
        position: relative;
        background-color: rgba(20, 21, 46, 0.8);
        -webkit-transition: opacity 500ms;
        -moz-transition: opacity 500ms;
        -ms-transition: opacity 500ms;
        -o-transition: opacity 500ms;
        transition: opacity 500ms;
    }

    .country_name {
        position: absolute;
        left: 0;
        top: 10%;
        border-top-right-radius: 10px;
        background-color: #fbe4d5;
    }

    .application.application--is-rtl .country_name {
        position: absolute;
        left: auto;
        right: 0;
        top: 10%;
        border-top-right-radius: 0;
        border-top-left-radius: 10px;
        background-color: #fbe4d5;
    }
</style>