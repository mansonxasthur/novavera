<template>
    <v-snackbar
            v-model="snackbar"
            right
            top
            :color="color"
    >
        {{ message }}
        <v-btn
                dark
                flat
                :multi-line="multiline"
                @click="snackbar = false"
        >
            {{ __words('close') }}
        </v-btn>
    </v-snackbar>
</template>

<script>
    export default {
        name: "Snackbar",
        props: ['message', 'color', 'active'],
        data() {
            return {
                //
            }
        },
        computed:{
            snackbar: {
                get: function () {
                    return this.active;
                },
                set: function(value) {
                    this.$emit('deactivate',value)
                }
            },
            multiline() {
                let breakpoint = this.$vuetify.breakpoint;
                return breakpoint.sm === true || breakpoint.xs === true;
            }
        }
    }
</script>

<style scoped>

</style>