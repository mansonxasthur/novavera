<template>
    <section id="developers">
        <v-layout column align-center>
            <v-flex shrink class="py-3">
                <h1 class="display-1">Developers</h1>
            </v-flex>
            <v-flex shrink
                    class="red darken-2 mb-4"
                    style="height: 3px; width: 50px">
            </v-flex>
        </v-layout>
        <infinite-slide-bar duration="14s" class="mt-3" :direction="direction" style="direction: ltr">
            <v-layout row wrap>
                <v-flex v-for="developer in developers" :key="developer.id">
                    <img :src="developer.logo_url" :alt="developer.name" height="100px">
                </v-flex>
            </v-layout>
        </infinite-slide-bar>
    </section>
</template>

<script>
    import InfiniteSlideBar from 'vue-infinite-slide-bar';

    export default {
        name: "DeveloperCarousel",
        components: {InfiniteSlideBar},
        props: {
            developers: {
                required: true,
                type: Array
            }
        },
        computed: {
            direction() {
                return this.$vuetify.lang.current === 'ar' ? 'reverse' : 'normal';
            }
        }
    }
</script>

<style scoped>

</style>