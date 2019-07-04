<template>
    <v-layout row wrap>
        <v-flex xs4 v-for="citizenship in citizenships" :key="citizenship.id">
            <a :href="citizenship.path"  class="sub-menu">
                <v-layout column align-center justify-space-between>
                    <v-flex style="min-width: 100px;">
                        <v-avatar size="80" tile>
                            <img :src="citizenship.body_flag_url" :alt="citizenship.country_name">
                        </v-avatar>
                    </v-flex>
                    <v-flex>{{ citizenship.country_name }}</v-flex>
                </v-layout>
            </a>
        </v-flex>
    </v-layout>
</template>

<script>
    export default {
        name: "CitizenshipDivList",
        props: {
            citizenships: {
                required: true,
                type: Array
            }
        }
    }
</script>

<style scoped>

</style>