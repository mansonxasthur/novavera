<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}" xmlns:v-slot="http://www.w3.org/1999/XSL/Transform">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <!-- CSRF Token -->
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>{{ config('app.name', 'Laravel') }}</title>

    <!-- Scripts -->
    <script src="{{ asset('js/app.js') }}" defer></script>

    <!-- Fonts -->
    <link rel="dns-prefetch" href="//fonts.gstatic.com">
    <link href="https://fonts.googleapis.com/css?family=Nunito" rel="stylesheet" type="text/css">

    <!-- Styles -->
    <link href="{{ asset('css/app.css') }}" rel="stylesheet">
</head>
<body>
    <v-app id="app">
        <v-navigation-drawer
                fixed
                v-model="drawer"
                app
                class="hidden-sm-and-up"
        >
            <v-list dense>
                <v-list-tile @click="">
                    <v-list-tile-action>
                        <v-icon>dashboard</v-icon>
                    </v-list-tile-action>
                    <v-list-tile-content>
                        <v-list-tile-title>Dashboard</v-list-tile-title>
                    </v-list-tile-content>
                </v-list-tile>
                <v-list-tile @click="">
                    <v-list-tile-action>
                        <v-icon>settings</v-icon>
                    </v-list-tile-action>
                    <v-list-tile-content>
                        <v-list-tile-title>Settings</v-list-tile-title>
                    </v-list-tile-content>
                </v-list-tile>
            </v-list>
        </v-navigation-drawer>
        <v-toolbar app fixed clipped-left color="white">
            <v-toolbar-side-icon @click.stop="drawer = !drawer" class="hidden-sm-and-up"></v-toolbar-side-icon>
            <v-toolbar-title>{{ config('app.name') }}</v-toolbar-title>
            <v-spacer></v-spacer>

            <v-toolbar-items class="hidden-sm-and-down">
                <v-btn flat>Home</v-btn>
                <v-menu :nudge-width="100"
                        offset-y
                        transition="slide-x-transition"
                >
                    <template v-slot:activator="{ on }">
                        <v-btn flat v-on="on">
                            <span>Real State Brokerage</span>
                            <v-icon>arrow_drop_down</v-icon>
                        </v-btn>
                    </template>

                    <v-list>
                        <v-list-tile>
                            <v-list-tile-title>Residential Projects</v-list-tile-title>
                        </v-list-tile>
                    </v-list>
                </v-menu>

                <v-btn flat>Citizenship & Residency</v-btn>
                <v-btn flat>About</v-btn>
                <v-btn flat>Contact</v-btn>
                <v-btn flat>Become a Partner</v-btn>
            </v-toolbar-items>
        </v-toolbar>
        <v-content>
            @yield('content')
        </v-content>
    </v-app>
</body>
</html>
