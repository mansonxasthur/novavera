<template>
    <section>

            <v-list-tile v-for="page in pages" :key="page.id" :href="page.path">
                <v-list-tile-action>
                    <v-icon>pages</v-icon>
                </v-list-tile-action>
                <v-list-tile-title>{{ __t(page, 'title') }}</v-list-tile-title>
            </v-list-tile>

    </section>
</template>

<script>
    export default {
        name: "PageList",
        props: {
            pages: {
                required: true,
                type: Array
            }
        }
    }
</script>

<style scoped>

</style>