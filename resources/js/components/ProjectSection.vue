<template>
    <v-layout column align-space-between>
        <v-flex class="py-4">
            <v-layout column align-center>
                <v-flex class="pb-3"><h2 class="display-1">{{ title }}</h2></v-flex>
                <v-flex
                        class="red darken-2"
                        style="height: 3px; width: 50px">
                </v-flex>
            </v-layout>
        </v-flex>
        <v-flex v-if="projects.length">
            <v-layout column align-center>
                <v-flex shrink>
                    <v-toolbar dense flat color="white">
                        <v-toolbar-items>
                            <v-btn class="text-capitalize font-weight-bold" flat @click="all()">{{ __words('all') }}</v-btn>
                            <v-btn class="text-capitalize font-weight-bold" flat v-for="location in locations" :key="location.id"
                                   @click="projectsOf(location)">{{ __t(location, 'name')}}
                            </v-btn>
                        </v-toolbar-items>
                    </v-toolbar>
                </v-flex>
            </v-layout>
        </v-flex>
        <v-flex v-else>
            <v-layout column align-center justify-center>
                <v-flex>
                    <div class="display-1 grey--text text--darken-1">{{ __sentences('thereIsNo')}} <span class="text-lowercase">{{ title }}</span> {{ __words('yet') }}</div>
                </v-flex>
            </v-layout>
        </v-flex>
        <v-flex mt-4>
            <v-layout row wrap>
                <v-flex xs12 sm6 md4 lg3 v-for="(p, i) in length" :key="i" class="animated zoomIn faster">
                    <a :href="projectPath(projects[i])" style="text-decoration: none; color: inherit;">
                        <v-img :src="projectImage(projects[i])" :alt="__t(projects[i], 'name')" max-height="200">
                            <v-layout fill-height column align-center justify-center class="img-mask">
                                <v-flex shrink>
                                    <h4 class="headline white--text">{{ __t(projects[i], 'name')}}</h4>
                                </v-flex>
                            </v-layout>
                        </v-img>
                    </a>
                </v-flex>
            </v-layout>
        </v-flex>
    </v-layout>
</template>

<script>
    export default {
        name: "ProjectSection",
        props: {
            locations: {
                required: true,
                type: Array,
            },
            title: {
                required: true,
                type: String,
            },
            count: {
                type: Number,
                default: -1
            }
        },
        data() {
            return {
                projects: [],
                allProjects: [],
            }
        },
        mounted() {
            this.locations.map(location => {
                Array.prototype.push.apply(this.allProjects, location.projects);
            });
            this.all();
        },
        methods: {
            all() {
                this.projects = this.allProjects;
            },
            projectsOf(location) {
                this.projects = location.projects;
            },
            projectImage(project) {
                try {
                    if (project.images.length) {
                        let images = project.images;

                        if (images.length) {
                            return images[0].image_url;
                        }
                    }
                    return '';
                } catch (error) {
                    console.log(error);
                }
            },
            projectPath(project) {
                return `/projects/${project.project_type}/${project.slug}`;
            }
        },
        computed: {
            length() {
                if (this.count !== -1) {
                    return this.count <= this.projects.length ? this.count : this.projects.length ;
                }

                return this.projects.length;
            }
        }
    }
</script>

<style scoped>
    .img-mask {
        background: rgba(20, 21, 46, 0.6);
    }
</style>