<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}" xmlns:v-slot="http://www.w3.org/1999/XSL/Transform">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <!-- CSRF Token -->
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>{{ config('app.name', 'Novavera Real State') }}</title>

    <!-- Scripts -->
    <script src="{{ asset('admin/js/app.js') }}" defer></script>

    <!-- Fonts -->
    <link rel="dns-prefetch" href="//fonts.gstatic.com">
    <link href="https://fonts.googleapis.com/css?family=Nunito" rel="stylesheet" type="text/css">

    <!-- Styles -->
    <link href="{{ asset('admin/css/app.css') }}" rel="stylesheet">
    @stack('styles')
</head>
<body>
<v-app id="app" :dark="dark" v-cloak>
    <v-navigation-drawer
            disable-resize-watcher
            disable-route-watcher
            clipped
            fixed
            v-model="drawer"
            app
    >
        <v-list class="mt-2">
            <v-list-tile>
                <v-list-tile-action>
                    <v-icon>home</v-icon>
                </v-list-tile-action>
                <v-list-tile-title>Home</v-list-tile-title>
            </v-list-tile>

            <div v-if="user && !user.isSeo() && !user.isViewer()">
                <v-list-tile href="{{ route('admin.departments.index') }}">
                    <v-list-tile-action>
                        <v-icon>assignment_ind</v-icon>
                    </v-list-tile-action>
                    <v-list-tile-title>Departments</v-list-tile-title>
                </v-list-tile>

                <v-list-tile href="{{ route('admin.locations.index') }}">
                    <v-list-tile-action>
                        <v-icon>location_on</v-icon>
                    </v-list-tile-action>
                    <v-list-tile-title>Locations</v-list-tile-title>
                </v-list-tile>

                <v-list-tile href="{{ route('admin.propertyTypes.index') }}">
                    <v-list-tile-action>
                        <v-icon>account_balance</v-icon>
                    </v-list-tile-action>
                    <v-list-tile-title>Property Types</v-list-tile-title>
                </v-list-tile>

                <v-list-tile href="{{ route('admin.developers.index') }}">
                    <v-list-tile-action>
                        <v-icon>business</v-icon>
                    </v-list-tile-action>
                    <v-list-tile-title>Developers</v-list-tile-title>
                </v-list-tile>

                <v-list-tile href="{{ route('admin.tags.index') }}">
                    <v-list-tile-action>
                        <v-icon>local_offer</v-icon>
                    </v-list-tile-action>
                    <v-list-tile-title>Tags</v-list-tile-title>
                </v-list-tile>

                <v-list-tile href="{{ route('admin.sliders.index') }}">
                    <v-list-tile-action>
                        <v-icon>photo_library</v-icon>
                    </v-list-tile-action>
                    <v-list-tile-title>Sliders</v-list-tile-title>
                </v-list-tile>
            </div>

            <v-list-group
                    prepend-icon="apps"
            >
                <template v-slot:activator>
                    <v-list-tile>
                        <v-list-tile-content>
                            <v-list-tile-title>Projects</v-list-tile-title>
                        </v-list-tile-content>
                    </v-list-tile>
                </template>

                <v-list-tile href="{{ route('admin.projects.create') }}" v-if="user && !user.isSeo() && !user.isViewer()">
                    <v-list-tile-action>
                        <v-icon>add</v-icon>
                    </v-list-tile-action>
                    <v-list-tile-title>New Project</v-list-tile-title>
                </v-list-tile>
                <v-list-tile href="{{ route('admin.projects.index') }}">
                    <v-list-tile-action>
                        <v-icon>list</v-icon>
                    </v-list-tile-action>
                    <v-list-tile-title>All Projects</v-list-tile-title>
                </v-list-tile>
            </v-list-group>

            <v-list-group
                    prepend-icon="flag"
            >
                <template v-slot:activator>
                    <v-list-tile>
                        <v-list-tile-content>
                            <v-list-tile-title>Citizenship</v-list-tile-title>
                        </v-list-tile-content>
                    </v-list-tile>
                </template>

                <v-list-tile href="{{ route('admin.citizenship.create') }}" v-if="user && !user.isSeo() && !user.isViewer()">
                    <v-list-tile-action>
                        <v-icon>add</v-icon>
                    </v-list-tile-action>
                    <v-list-tile-title>New Citizenship</v-list-tile-title>
                </v-list-tile>
                <v-list-tile href="{{ route('admin.citizenship.index') }}">
                    <v-list-tile-action>
                        <v-icon>list</v-icon>
                    </v-list-tile-action>
                    <v-list-tile-title>All Countries</v-list-tile-title>
                </v-list-tile>
            </v-list-group>

            <v-list-group
                    prepend-icon="create"
            >
                <template v-slot:activator>
                    <v-list-tile>
                        <v-list-tile-content>
                            <v-list-tile-title>Posts</v-list-tile-title>
                        </v-list-tile-content>
                    </v-list-tile>
                </template>

                <v-list-tile href="{{ route('admin.posts.create') }}" v-if="user && !user.isSeo() && !user.isViewer()">
                    <v-list-tile-action>
                        <v-icon>add</v-icon>
                    </v-list-tile-action>
                    <v-list-tile-title>New Post</v-list-tile-title>
                </v-list-tile>
                <v-list-tile href="{{ route('admin.posts.index') }}">
                    <v-list-tile-action>
                        <v-icon>list</v-icon>
                    </v-list-tile-action>
                    <v-list-tile-title>All Posts</v-list-tile-title>
                </v-list-tile>
            </v-list-group>

            <v-list-group
                    prepend-icon="pages"
            >
                <template v-slot:activator>
                    <v-list-tile>
                        <v-list-tile-content>
                            <v-list-tile-title>Pages</v-list-tile-title>
                        </v-list-tile-content>
                    </v-list-tile>
                </template>

                <v-list-tile href="{{ route('admin.pages.create') }}" v-if="user && !user.isSeo() && !user.isViewer()">
                    <v-list-tile-action>
                        <v-icon>add</v-icon>
                    </v-list-tile-action>
                    <v-list-tile-title>New Page</v-list-tile-title>
                </v-list-tile>
                <v-list-tile href="{{ route('admin.pages.index') }}">
                    <v-list-tile-action>
                        <v-icon>list</v-icon>
                    </v-list-tile-action>
                    <v-list-tile-title>All Pages</v-list-tile-title>
                </v-list-tile>
            </v-list-group>

            <v-divider></v-divider>

            <v-list-tile href="{{ route('admin.admins.index') }}" v-if="user && user.isSuper()">
                <v-list-tile-action>
                    <v-icon>people</v-icon>
                </v-list-tile-action>
                <v-list-tile-title>Admins</v-list-tile-title>
            </v-list-tile>

        </v-list>
        <v-divider class="hidden-md-and-up"></v-divider>
        <v-list subheader class="hidden-md-and-up">
            <v-list-tile>
                <v-list-tile-content>
                    <v-switch v-model="dark"></v-switch>
                </v-list-tile-content>
                <v-list-tile-action>
                    <v-icon>brightness_2</v-icon>
                </v-list-tile-action>
            </v-list-tile>
            <v-list-tile @click="logout">
                <v-list-tile-content>
                    <v-list-tile-title>Logout</v-list-tile-title>
                </v-list-tile-content>
                <v-list-tile-action>
                    <v-icon>input</v-icon>
                </v-list-tile-action>
            </v-list-tile>
        </v-list>
    </v-navigation-drawer>
    <v-toolbar app fixed clipped-left color="primary" dark>
        <v-toolbar-side-icon @click.stop="drawer = !drawer"></v-toolbar-side-icon>
        <v-toolbar-title>Dashboard</v-toolbar-title>
        <v-spacer></v-spacer>
        <v-toolbar-items class="hidden-sm-and-down">
            <v-menu
                    offset-y
                    transition="slide-x-transition"
            >
                <template v-slot:activator="{ on }">
                    <v-btn flat v-on="on">
                        <span>{{ auth()->check() ? auth()->user()->name : '' }}</span>
                        <v-icon>arrow_drop_down</v-icon>
                    </v-btn>
                </template>

                <v-list>
                    <v-list-tile>
                        <v-list-tile-content>
                            <v-switch v-model="dark" class="mt-4"></v-switch>
                        </v-list-tile-content>
                        <v-list-tile-action>
                            <v-icon>brightness_2</v-icon>
                        </v-list-tile-action>
                    </v-list-tile>
                    <v-list-tile @click="logout">
                        <v-list-tile-content>
                            <v-list-tile-title>Logout</v-list-tile-title>
                        </v-list-tile-content>
                        <v-list-tile-action>
                            <v-icon>input</v-icon>
                        </v-list-tile-action>
                    </v-list-tile>
                </v-list>
            </v-menu>
        </v-toolbar-items>
    </v-toolbar>
    <v-content>
        @yield('content')
    </v-content>
</v-app>

@stack('scripts')
</body>
</html>
