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
            class="hidden-md-and-up"
            :right="$vuetify.lang.current === 'ar'"
    >
        <img src="{{ asset('assets/logo.svg') }}" alt="Novavera Real Estate" width="100%" class="my-3">
        <v-list class="mt-2">

            <v-list-tile href="{{ route('home') }}">
                <v-list-tile-action>
                    <v-icon>home</v-icon>
                </v-list-tile-action>
                <v-list-tile-title>@{{ __words('home') }}</v-list-tile-title>
            </v-list-tile>

            <v-list-group
                    prepend-icon="business"
            >
                <template v-slot:activator>
                    <v-list-tile>
                        <v-list-tile-content>
                            <v-list-tile-title>@{{ __sentences('REB') }}</v-list-tile-title>
                        </v-list-tile-content>
                    </v-list-tile>
                </template>

                <v-list-tile href="{{ route('projects.index', ['projectType' => 'residential']) }}">
                    <v-list-tile-action>
                        <v-icon>apps</v-icon>
                    </v-list-tile-action>
                    <v-list-tile-title>@{{ __sentences('residentialProjects') }}</v-list-tile-title>
                </v-list-tile>
                <v-list-tile href="{{ route('projects.index', ['projectType' => 'commercial']) }}">
                    <v-list-tile-action>
                        <v-icon>apps</v-icon>
                    </v-list-tile-action>
                    <v-list-tile-title>@{{ __sentences('commercialProjects') }}</v-list-tile-title>
                </v-list-tile>
                <v-list-tile href="{{ route('developers.index') }}">
                    <v-list-tile-action>
                        <v-icon>business</v-icon>
                    </v-list-tile-action>
                    <v-list-tile-title>@{{ __words('developers') }}</v-list-tile-title>
                </v-list-tile>
                <v-list-tile href="{{ route('propertyRequests.index') }}">
                    <v-list-tile-action>
                        <v-icon>fas fa-user-clock</v-icon>
                    </v-list-tile-action>
                    <v-list-tile-title>@{{ __sentences('propertyRequests') }}</v-list-tile-title>
                </v-list-tile>
            </v-list-group>

            <v-list-group
                    prepend-icon="flag"
            >
                <template v-slot:activator>
                    <v-list-tile>
                        <v-list-tile-content>
                            <v-list-tile-title>@{{ __words('citizenship') }}</v-list-tile-title>
                        </v-list-tile-content>
                    </v-list-tile>
                </template>

                <citizenship-list :citizenships="{{ $citizenshipList }}"></citizenship-list>
            </v-list-group>

            <v-list-group
                    prepend-icon="flag"
            >
                <template v-slot:activator>
                    <v-list-tile>
                        <v-list-tile-content>
                            <v-list-tile-title>@{{ __words('residency') }}</v-list-tile-title>
                        </v-list-tile-content>
                    </v-list-tile>
                </template>

                <citizenship-list :citizenships="{{ $residencyList }}"></citizenship-list>
            </v-list-group>

            <page-list :pages="{{ $pageList }}"></page-list>

            <v-list-tile href="/#contact-us">
                <v-list-tile-action>
                    <v-icon>send</v-icon>
                </v-list-tile-action>
                <v-list-tile-title>@{{ __words('contact') }}</v-list-tile-title>
            </v-list-tile>

            <v-list-tile href="{{ route('careers.index') }}">
                <v-list-tile-action>
                    <v-icon>fas fa-id-card</v-icon>
                </v-list-tile-action>
                <v-list-tile-title>@{{ __words('careers') }}</v-list-tile-title>
            </v-list-tile>

            <v-list-tile href="{{ route('partners.index') }}">
                <v-list-tile-action>
                    <v-icon>fas fa-handshake</v-icon>
                </v-list-tile-action>
                <v-list-tile-title>@{{ __sentences('becomePartner') }}</v-list-tile-title>
            </v-list-tile>

            <v-list-tile @click="changeLocale">
                <v-list-tile-action>
                    <v-icon color="red accent-2">language</v-icon>
                </v-list-tile-action>
                <v-list-tile-title>
                    <span class="red--text text--accent-2 font-weight-bold">@{{ otherLocale }}</span>
                </v-list-tile-title>
            </v-list-tile>

        </v-list>
        <v-divider></v-divider>

        <h5 class="px-3 mt-2 grey--text font-weight-black text-xs-center">
            @{{ __sentences('copyright') }}
        </h5>


    </v-navigation-drawer>

    <v-toolbar app scroll-off-screen clipped-left color="white">
        <v-toolbar-side-icon @click.stop="drawer = !drawer" class="hidden-md-and-up"></v-toolbar-side-icon>
        <a href="/" style="width: 170px">
            <img src="{{ asset('assets/logo.svg') }}" alt="Novavera Real Estate">
        </a>
        <v-spacer></v-spacer>

        <v-toolbar-items class="hidden-sm-and-down">
            <v-btn class="text-capitalize font-weight-bold subheading" href="/" flat>@{{ __words('home') }}</v-btn>
            <v-menu
                    offset-y
                    transition="slide-x-transition"
            >
                <template v-slot:activator="{ on }">
                    <v-btn class="text-capitalize font-weight-bold subheading" flat v-on="on">
                        <span>@{{ __sentences('REB') }}</span>
                        <v-icon :right="$vuetify.lang.current === 'en'" :left="$vuetify.lang.current === 'ar'">arrow_drop_down</v-icon>
                    </v-btn>
                </template>

                <v-list>
                    <a href="{{ route('projects.index', ['projectType' => 'residential']) }}" class="sub-menu">
                        <v-list-tile>
                            <v-list-tile-title>@{{ __sentences('residentialProjects') }}</v-list-tile-title>
                        </v-list-tile>
                    </a>
                    <a href="{{ route('projects.index', ['projectType' => 'commercial']) }}" class="sub-menu">
                        <v-list-tile>
                            <v-list-tile-title>@{{ __sentences('commercialProjects') }}</v-list-tile-title>
                        </v-list-tile>
                    </a>
                    <a href="{{ route('developers.index') }}" class="sub-menu">
                        <v-list-tile>
                            <v-list-tile-title>@{{ __words('developers') }}</v-list-tile-title>
                        </v-list-tile>
                    </a>

                    <a href="{{ route('propertyRequests.index') }}" class="sub-menu">
                        <v-list-tile>
                            <v-list-tile-title>@{{ __sentences('propertyRequests') }}</v-list-tile-title>
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
                        <span>@{{ __sentences('CAR') }}</span>
                        <v-icon :right="$vuetify.lang.current === 'en'" :left="$vuetify.lang.current === 'ar'">arrow_drop_down</v-icon>
                    </v-btn>
                </template>

                <v-layout row wrap>
                    <v-flex d-flex xs12 md6>
                        <v-list>
                            <v-list-tile>
                                <v-list-tile-content>
                                    <h3 class="headline grey--text text--darken-1">@{{ __words('citizenship') }}</h3>
                                </v-list-tile-content>
                            </v-list-tile>

                            <citizenship-list :citizenships="{{ $citizenshipList }}"></citizenship-list>

                        </v-list>
                    </v-flex>
                    <v-flex d-flex xs12 md6>
                        <v-list>
                            <v-list-tile>
                                <v-list-tile-content>
                                    <h3 class="headline grey--text text--darken-1">@{{ __words('residency') }}</h3>
                                </v-list-tile-content>
                            </v-list-tile>

                            <citizenship-list :citizenships="{{ $residencyList }}"></citizenship-list>

                        </v-list>
                    </v-flex>
                </v-layout>
            </v-menu>
            @if(count($pageList))
                @foreach($pageList as $page)
                    <page-nav-btn :page="{{ $page }}"></page-nav-btn>
                @endforeach
            @endif
            <v-btn class="text-capitalize font-weight-bold subheading" flat href="/#contact-us">@{{ __words('contact')
                }}
            </v-btn>
            <v-btn class="text-capitalize font-weight-bold subheading" flat href="{{ route('careers.index') }}">
                @{{ __words('careers') }}
            </v-btn>
            <v-btn class="text-capitalize font-weight-bold subheading" flat href="{{ route('partners.index') }}">@{{ __sentences('becomePartner') }}
            </v-btn>
            <v-btn class="red--text text--accent-2 font-weight-bold" flat @click="changeLocale">@{{ otherLocale }}
            </v-btn>
        </v-toolbar-items>
    </v-toolbar>
    <v-content>
        @yield('content')
    </v-content>

    <v-footer
            height="auto"
            class="nova-primary-bg hidden-md-and-down"
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
                @{{ __sentences('copyright') }}
            </v-flex>
        </v-layout>
    </v-footer>

</v-app>
<!-- Scripts -->
<script src="{{ asset('js/app.js') }}"></script>
@stack('scripts')
</body>
</html>
