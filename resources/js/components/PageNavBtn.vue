<template>

    <v-btn class="text-capitalize font-weight-bold subheading" flat
           :href="page.path">{{ __t(page, 'title') }}
    </v-btn>

</template>

<script>
    export default {
        name: "PageNavBtn",
        props: {
            page: {
                required: true,
                type: Object
            }
        }
    }
</script>

<style scoped>

</style>