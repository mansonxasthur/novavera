<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}" xmlns:v-slot="http://www.w3.org/1999/XSL/Transform">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
@stack('meta')

<!-- CSRF Token -->
    <meta name="csrf-token" content="{{ csrf_token() }}">

@stack('title')


<!-- Fonts -->
    <link rel="dns-prefetch" href="//fonts.gstatic.com">
    <link href="https://fonts.googleapis.com/css?family=Nunito" rel="stylesheet" type="text/css">

    <!-- Styles -->
    <link href="{{ asset('css/app.css') }}" rel="stylesheet">
    <style>
        a.sub-menu {
            text-decoration: none;
            color: inherit;
        }

        .citizenship-list {
            left: 0 !important;
            min-width: 100% !important;
        }

    </style>
    @stack('styles')
</head>
<body>
<v-app id="novavera" v-cloak>
    <v-navigation-drawer
            fixed
            disable-resize-watcher
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
    <v-toolbar app scroll-off-screen clipped-left color="white">
        <v-toolbar-side-icon @click.stop="drawer = !drawer" class="hidden-sm-and-up"></v-toolbar-side-icon>
        <a href="/" style="width: 170px">
            <img src="{{ asset('assets/logo.svg') }}" alt="">
        </a>
        <v-spacer></v-spacer>

        <v-toolbar-items class="hidden-sm-and-down">
            <v-btn class="text-capitalize font-weight-bold subheading" href="/" flat>Home</v-btn>
            <v-menu :nudge-width="100"
                    offset-y
                    transition="slide-x-transition"
            >
                <template v-slot:activator="{ on }">
                    <v-btn class="text-capitalize font-weight-bold subheading" flat v-on="on">
                        <span>Real State Brokerage</span>
                        <v-icon right>arrow_drop_down</v-icon>
                    </v-btn>
                </template>

                <v-list>
                    <a href="{{ route('projects.index', ['projectType' => 'residential']) }}" class="sub-menu">
                        <v-list-tile>
                            <v-list-tile-title>Residential Projects</v-list-tile-title>
                        </v-list-tile>
                    </a>
                    <a href="{{ route('projects.index', ['projectType' => 'commercial']) }}" class="sub-menu">
                        <v-list-tile>
                            <v-list-tile-title>Commercial Projects</v-list-tile-title>
                        </v-list-tile>
                    </a>
                    <a href="{{ route('developers.index') }}" class="sub-menu">
                        <v-list-tile>
                            <v-list-tile-title>Developers</v-list-tile-title>
                        </v-list-tile>
                    </a>

                </v-list>
            </v-menu>

            <v-menu
                    full-width
                    offset-y
                    transition="slide-x-transition"
                    content-class="citizenship-list"
            >
                <template v-slot:activator="{ on }">
                    <v-btn class="text-capitalize font-weight-bold subheading" flat v-on="on">
                        <span>Citizenship & Residency</span>
                        <v-icon right>arrow_drop_down</v-icon>
                    </v-btn>
                </template>

                <v-layout row wrap>
                    <v-flex d-flex xs12 md6>
                        <v-list>
                            <v-list-tile>
                                <v-list-tile-content>
                                    <h3 class="headline grey--text text--darken-1">Citizenship</h3>
                                </v-list-tile-content>
                            </v-list-tile>
                            @if (count($citizenshipList))
                                @foreach($citizenshipList as $citizenship)
                                    <a href="{{ $citizenship->path() }}" class="sub-menu">
                                        <v-list-tile>
                                            <v-list-tile-avatar tile>
                                                <img src="{{ $citizenship->dropdown_flag_url }}" width="100%" alt="{{ $citizenship->country_name}}" />
                                            </v-list-tile-avatar>
                                            <v-list-tile-title>{{ $citizenship->country_name }}</v-list-tile-title>
                                        </v-list-tile>
                                    </a>
                                @endforeach
                            @endif
                        </v-list>
                    </v-flex>
                    <v-flex d-flex xs12 md6>
                        <v-list>
                            <v-list-tile>
                                <v-list-tile-content>
                                    <h3 class="headline grey--text text--darken-1">Residency</h3>
                                </v-list-tile-content>
                            </v-list-tile>
                            @if (count($residencyList))
                                @foreach($residencyList as $residency)
                                    <a href="{{ $residency->path() }}" class="sub-menu">
                                        <v-list-tile>
                                            <v-list-tile-avatar tile>
                                                <img src="{{ $residency->dropdown_flag_url }}" width="100%" alt="{{ $residency->country_name}}" />
                                            </v-list-tile-avatar>
                                            <v-list-tile-title>{{ $residency->country_name }}</v-list-tile-title>
                                        </v-list-tile>
                                    </a>
                                @endforeach
                            @endif
                        </v-list>
                    </v-flex>
                </v-layout>
            </v-menu>
            @if($pageList->count())
                @foreach($pageList as $page)
                    <v-btn class="text-capitalize font-weight-bold subheading" flat
                           href="{{ $page->path() }}">{{ $page->title }}</v-btn>
                @endforeach
            @endif
            <v-btn class="text-capitalize font-weight-bold subheading" flat href="/#contact-us">Contact</v-btn>
            <v-btn class="text-capitalize font-weight-bold subheading" flat href="/careers">Careers</v-btn>
            <v-btn class="text-capitalize font-weight-bold subheading" flat>Become a Partner</v-btn>
            <v-btn class="red--text text--accent-2 font-weight-bold" flat @click="changeLocale">@{{ otherLocale }}
            </v-btn>
        </v-toolbar-items>
    </v-toolbar>
    <v-content>
        @yield('content')
    </v-content>

    <v-footer
            height="auto"
            class="nova-primary-bg"
    >
        <v-layout
                justify-center
                row
                wrap
        >
            <v-flex
                    primary
                    py-3
                    text-xs-center
                    white--text
                    xs12
            >
                Copyright © 2019 Novavera<sup>®</sup> - All Rights Reserved.
            </v-flex>
        </v-layout>
    </v-footer>

</v-app>
<!-- Scripts -->
<script src="{{ asset('js/app.js') }}"></script>
@stack('scripts')
</body>
</html>
