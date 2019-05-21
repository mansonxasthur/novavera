@extends('admin.layouts.app')

@section('content')
    <v-container fill-height>
        <v-layout row wrap justify-center>
            <v-flex xs12 md8>
                <h3 class="display-1 my-4 text-xs-center">Welcome {{ auth()->user()->name }}</h3>
            </v-flex>
            @can('view', \App\Applicant::class)
                <v-flex xs12>
                    <v-layout row wrap justify-space-around>
                        <v-flex xs12 md4>
                            <a href="/dashboard/property-requests" style="text-decoration: none;">
                                <v-card hover>
                                    <v-card-title>
                                        <h3 class="title mx-auto">Property Requests Today</h3>
                                    </v-card-title>
                                    <v-card-text pa-5 text-xs-center>
                                        <h3 class="display-2 red--text text--accent-2 text-xs-center">{{ $propertyRequests }}</h3>
                                    </v-card-text>
                                </v-card>
                            </a>
                        </v-flex>
                        <v-flex xs12 md4>
                            <a href="/dashboard/applicants" style="text-decoration: none;">
                                <v-card hover>
                                    <v-card-title>
                                        <h3 class="title mx-auto">Job Applicants Today</h3>
                                    </v-card-title>
                                    <v-card-text pa-5 text-xs-center>
                                        <h3 class="display-2 red--text text--accent-2 text-xs-center">{{ $applicants }}</h3>
                                    </v-card-text>
                                </v-card>
                            </a>
                        </v-flex>
                    </v-layout>
                </v-flex>
            @endcan
        </v-layout>
    </v-container>
@endsection