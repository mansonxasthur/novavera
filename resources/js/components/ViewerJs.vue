<template>
    <iframe :src="`/ViewerJS/#../storage/${file}`" width='100%' height='1024' allowfullscreen webkitallowfullscreen></iframe>
</template>

<script>
    export default {
        name: "ViewerJs",
        props: {
            file: {
                required: true,
                type: String
            }
        }
    }
</script>

<style scoped>

</style>