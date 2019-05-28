<template>
    <section>
        <a v-for="citizenship in citizenships" :key="citizenship.id" :href="citizenship.path" class="sub-menu">
            <v-list-tile>
                <v-list-tile-avatar tile>
                    <img :src="citizenship.dropdown_flag_url" width="100%"
                         :alt="citizenship.country_name"/>
                </v-list-tile-avatar>
                <v-list-tile-title>{{ __t(citizenship, 'country_name') }}</v-list-tile-title>
            </v-list-tile>
        </a>
    </section>
</template>

<script>
    export default {
        name: "CitizenshipList",
        props: {
            citizenships: {
                required: true,
                type: Array
            }
        }
    }
</script>

<style scoped>
    a.sub-menu {
        text-decoration: none;
        color: inherit;
    }
</style>