<template>
    <v-carousel
            :height="height"
            hide-delimiters
    >
        <v-carousel-item
                v-for="(image,i) in images"
                :key="i"
                :src="getSrc(image)"
                transition="fade-transition"
                reverse-transition="fade-transition"
        >
            <section class="slide-info" v-if="image.title">
                <h1 class="display-1 mb-5 animated flipInX delay-1s" v-html="image.title"></h1>
                <h3 class="title mb-5 animated lightSpeedIn delay-1s" v-if="image.subtitle" v-html="image.subtitle"></h3>
                <v-btn
                        class="nova-btn-primary animated fadeInUp delay-2s"
                        dark
                        v-if="image.btn_label&& image.btn_link"
                        v-text="image.btn_label"
                        :href="image.btn_link"
                ></v-btn>
            </section>
        </v-carousel-item>
    </v-carousel>
</template>

<script>
    export default {
        name: "Slider",
        props: {
            sliderImages: {
                required: true,
                type: Array
            },
            src: {
                required: true,
                type: String
            },
            height: {
                type: String,
                default: '100vh'
            }
        },
        data() {
            return {
                images: [],
            }
        },
        created() {
            this.images = this.sliderImages;
        },
        methods: {
            getSrc(image) {
                return image[this.src];
            }
        }
    }
</script>

<style lang="scss">
    .fluid {
        padding: 0;
    }

    h1, h2, h3 {
        text-transform: uppercase;
    }

    .slide-info {
        position: relative;
        -webkit-margin-start: 10%;
        -moz-margin-start: 10%;
        -webkit-border-radius: 1px;
        -moz-border-radius: 1px;
        border-radius: 1px;
        max-width: 30%;
        top: 20%;
        color: #fff;
        background: rgba(0, 0, 0, 0.1);
        padding: 20px;

        .v-btn {
            -webkit-margin-start: 0;
            -moz-margin-start: 0;
            color: #E8DAAD;
        }
    }
</style>