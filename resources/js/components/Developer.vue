<template>
    <v-container fluid>
        <v-layout column>
            <v-flex pa-5>
                <v-layout row wrap>
                    <v-flex xs12>
                        <h2 class="display-1 developer-name pl-3">{{ developer.name }}</h2>
                    </v-flex>
                    <v-flex xs12 sm3 class="developer">
                        <v-layout column align-center justify-center>
                            <v-flex text-xs-center my-5>
                                <v-card flat hover>
                                    <v-card-text>
                                        <img :src="developer.logo_url" :alt="developer.name" class="developer-image">
                                    </v-card-text>
                                </v-card>
                            </v-flex>
                        </v-layout>
                    </v-flex>
                    <v-flex xs12 sm9 px-4>
                        <div class="body-1 my-5" v-html="developer.description"></div>
                    </v-flex>
                </v-layout>
            </v-flex>
            <v-flex mt-5>
                <v-layout column>
                    <v-flex pa-5>
                        <h2 class="display-1 developer-name pl-3">Projects</h2>
                    </v-flex>
                    <v-flex v-if="projects.length">
                        <v-layout column align-center>
                            <v-flex shrink>
                                <v-toolbar dense flat color="white">
                                    <v-toolbar-items>
                                        <v-btn class="text-capitalize font-weight-bold" flat @click="all()">All</v-btn>
                                        <v-btn class="text-capitalize font-weight-bold" flat v-for="location in locations" :key="location.id"
                                               @click="projectsOf(location)">{{ location.name }}
                                        </v-btn>
                                    </v-toolbar-items>
                                </v-toolbar>
                            </v-flex>
                        </v-layout>
                    </v-flex>
                    <v-flex v-else>
                        <v-layout column align-center justify-center>
                            <v-flex>
                                <div class="display-1 grey--text text--darken-1">This developer doesn't have projects yet</div>
                            </v-flex>
                        </v-layout>
                    </v-flex>
                    <v-flex mt-4>
                        <v-layout row wrap>
                            <v-flex xs12 sm6 md4 lg3 v-for="project in projects" :key="project.id" class="animated zoomIn faster" d-flex>
                                <a :href="projectPath(project)" style="text-decoration: none; color: inherit;">
                                    <v-img :src="projectImage(project)" :alt="project.name" height="100%" width="100%">
                                        <v-layout fill-height column align-center justify-center class="project-image">
                                            <v-flex shrink>
                                                <h4 class="headline white--text">{{ project.name }}</h4>
                                            </v-flex>
                                        </v-layout>
                                    </v-img>
                                </a>
                            </v-flex>
                        </v-layout>
                    </v-flex>
                </v-layout>
            </v-flex>
        </v-layout>
    </v-container>
</template>

<script>
    export default {
        name: "Developer",
        props: {
            developer: {
                required: true,
                type: Object,
            },
            locations: {
                required: true,
                type: Array,
            },
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
        }
    }
</script>

<style scoped>
    .fluid {
        padding: 0;
    }

    .developer-name {
        border-left: 3px #cc0000 solid;
    }

    .developer {
        border-right: 3px #14152E solid;
    }

    .developer-image {
        max-height: 170px;
    }

    .project-image {
        background: rgba(20, 21, 46, 0.6);
    }
</style>