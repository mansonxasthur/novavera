@extends('layouts.app')

@push('meta')
    @component('partials.meta', ['name' => 'description'])
        We provide real estate and investment services
        with high standards of expertise
    @endcomponent
@endpush

@push('title')
    <title>Novavera Real Estate | Building the Future Today</title>
@endpush

@push('styles')
    <link rel="stylesheet" href="{{ asset('css/flaticon/flaticon.css') }}"
          xmlns:v-slot="http://www.w3.org/1999/XSL/Transform">
    <style>
        [class^="flaticon-"]:before, [class*=" flaticon-"]:before, [class^="flaticon-"]:after, [class*=" flaticon-"]:after {
            font-family: Flaticon, serif;
            font-size: 50px;
            font-style: normal;
            margin-left: 0;
        }

        #citizenship-features i:before, i:after {
            font-size: 70px;
        }

        /* why us */

        .service_box {
            margin: 20px 0;
            padding: 40px 20px;
            text-align: center;
            border-radius: 5px;
            background: #ffff;
            transition: all 0.30s ease 0s;
            min-height: 380px;
        }

        .service_box:hover {
            background: #fff;
        }

        .service_box .service_icon {
            width: 70px;
            height: 70px;
            margin: 0 auto;
            font-size: 35px;
            background: #fff;
            line-height: 70px;
            border-radius: 50px;
            transform: translateY(0);
            transition: all 0.30s ease 0s;
        }

        .service_box:hover .service_icon {
            transform: translateY(-100%);
        }

        .service_box .service_icon i {
            color: #14152E;
        }

        .service_box h3 {
            position: relative;
            top: 40px;
            margin: 0;
            color: #14152E;
            font-size: 23px;
            text-transform: uppercase;
            transform: translateY(0%);
            transition: all 600ms cubic-bezier(0.68, -0.55, 0.265, 1.55) 0s;
        }

        .service_box:hover h3 {
            top: -40px;
            color: #14152E
        }

        .service_box p {
            color: #14152E !important;
            margin: 0;
            opacity: 0;
            transition: all 0.30s linear 0s;
        }

        @media (max-width: 600px) {
            .service_box p {
                opacity: 1;
            }

            .service_box h3 {
                top: -40px;
                color: #14152E
            }

            .service_box .service_icon {
                transform: translateY(-100%);
            }
        }

        .service_box:hover p {
            opacity: 1;
            color: #14152E;
            transition: 2s;
        }
    </style>
@endpush

@section('content')
    <v-container fluid>
        <section id="intro">
            <slider :slider-images="{{ $slider->images ?? '[]' }}" src="path_url"></slider>
        </section>
        <v-layout row wrap>
            <v-flex xs12 class="overview mb-4">
                <v-layout row wrap>
                    <v-flex xs12 md6 class="grey lighten-5">
                        <v-layout column align-space-between>
                            <v-flex>
                                <v-layout justify-center>
                                    <v-flex shrink class="mt-0 nova-btn-primary py-3 px-4">
                                        <h3 style="color: white">@{{ __words('egypt') }}</h3>
                                    </v-flex>
                                </v-layout>
                            </v-flex>
                            <v-flex shrink class="pt-4">
                                <v-layout column align-center>
                                    <v-flex shrink class="pb-3"><h2>@{{ __sentences('REC') }}</h2></v-flex>
                                    <v-flex shrink
                                            class="red darken-2"
                                            style="height: 3px; width: 50px">
                                    </v-flex>
                                </v-layout>
                            </v-flex>

                            <v-flex shrink class="text-xs-center font-weight-light pa-4">
                                <div style="max-width:450px; width: 100%" class="mx-auto">
                                    <p class="title">
                                        @{{ __sentences('recTitle') }}
                                    </p>
                                </div>
                            </v-flex>
                            <v-flex grow>
                                <v-layout row wrap class="text-xs-center">
                                    <v-flex xs12 sm6 md4 class="pa-5">
                                        <div class="flaticon-consultation mx-auto"></div>
                                        <h3 class="">@{{ __words('consultancy') }}</h3>
                                    </v-flex>
                                    <v-flex xs12 sm6 md4 class="pa-5">
                                        <div class="flaticon-sale mx-auto"></div>
                                        <h3 class="">@{{ __sentences('sellAndBuy') }}</h3>
                                    </v-flex>
                                    <v-flex xs12 sm6 md4 class="pa-5">
                                        <div class="flaticon-coin mx-auto"></div>
                                        <h3 class="">@{{ __words('investment') }}</h3>
                                    </v-flex>
                                    <v-flex xs12 sm6 md4 class="pa-5">
                                        <div class="flaticon-home mx-auto"></div>
                                        <h3 class="">@{{ __words('residential') }}</h3>
                                    </v-flex>
                                    <v-flex xs12 sm6 md4 class="pa-5">
                                        <div class="flaticon-shop mx-auto"></div>
                                        <h3 class="">@{{ __words('commercial') }}</h3>
                                    </v-flex>
                                    <v-flex xs12 sm6 md4 class="pa-5">
                                        <div class="flaticon-apartments mx-auto"></div>
                                        <h3 class="">@{{ __words('administrative') }}</h3>
                                    </v-flex>
                                </v-layout>
                            </v-flex>
                            <v-flex shrink class="text-xs-center my-3">
                                <v-btn class="nova-btn-primary" dark href="#residential-projects" role="link">
                                    @{{ __sentences('discoverMore') }}
                                </v-btn>
                            </v-flex>
                        </v-layout>
                    </v-flex>
                    <v-flex xs12 md6 class="bg-color-dark" dark>
                        <v-layout column align-space-between>
                            <v-flex>
                                <v-layout justify-center>
                                    <v-flex shrink class="mt-0 grey lighten-5 py-3 px-4">
                                        <h3 class="black--text lighten-2 text-xs-center">@{{ __words('worldwide') }}</h3>
                                    </v-flex>
                                </v-layout>
                            </v-flex>
                            <v-flex shrink class="pt-4">
                                <v-layout column align-center>
                                    <v-flex shrink class="pb-3 text-xs-center"><h2>@{{ __sentences('CAR') }}</h2></v-flex>
                                    <v-flex shrink
                                            class="red darken-2"
                                            style="height: 3px; width: 50px">
                                    </v-flex>
                                </v-layout>
                            </v-flex>

                            <v-flex shrink class="text-xs-center font-weight-light pa-4">
                                <div style="max-width:450px; width: 100%" class="mx-auto">
                                    <p class="title">
                                        @{{ __sentences('carTitle') }}
                                    </p>
                                </div>
                            </v-flex>
                            <v-flex grow>
                                <v-layout row wrap class="text-xs-center">
                                    <v-flex xs12 md6 class="text-xs-center">
                                        @if (count($citizenshipList))
                                            <h3 class="headline font-weight-bold text-uppercase white--text">@{{ __words('citizenship') }}</h3>
                                            <v-container grid-list>
                                                <citizenship-div-list :citizenships="{{ $citizenshipList }}"></citizenship-div-list>
                                            </v-container>
                                        @endif
                                    </v-flex>
                                    <v-flex xs12 md6 class="text-xs-center">
                                        @if (count($residencyList))
                                            <h3 class="headline font-weight-bold text-uppercase white--text">@{{ __words('residency') }}</h3>
                                            <v-container grid-list>
                                                <citizenship-div-list :citizenships="{{ $residencyList }}"></citizenship-div-list>
                                            </v-container>
                                        @endif
                                    </v-flex>
                                </v-layout>
                            </v-flex>
                            <v-flex shrink class="text-xs-center my-3">
                                <v-btn color="grey lighten-5" href="#citizenship-residency" role="link">
                                    @{{ __sentences('discoverMore') }}
                                </v-btn>
                            </v-flex>
                        </v-layout>
                    </v-flex>
                </v-layout>
            </v-flex>

            <v-flex xs12 my-5 id="residential-projects">
                <project-section
                        :locations="{{ $residentialProjectLocations }}"
                        :title=" __sentences('residentialProjects')"
                        :count="{{ 4 }}"
                ></project-section>
                @if(count($residentialProjectLocations))
                    <v-layout column align-center>
                        <v-flex py-4>
                            <v-btn color="primary" href="/projects/residential">@{{ __sentences('viewAll') }}</v-btn>
                        </v-flex>
                    </v-layout>
                @endif
            </v-flex>

            <v-flex xs12 my-5>
                <project-section
                        :locations="{{ $commercialProjectLocations }}"
                        :title="__sentences('commercialProjects')"
                        :count="{{ 4 }}"
                ></project-section>
                @if(count($commercialProjectLocations))
                    <v-layout column align-center>
                        <v-flex py-4>
                            <v-btn color="primary" href="/projects/commercial">@{{ __sentences('viewAll') }}</v-btn>
                        </v-flex>
                    </v-layout>
                @endif
            </v-flex>

            <v-flex xs12 my-5 style="direction: ltr">
                <developer-carousel :developers="{{ $developers }}"></developer-carousel>
            </v-flex>

            <v-flex xs12 my-5 pb-5 class="bg-color-dark" dark id="citizenship-residency">
                <v-layout column align-space-between>
                    <v-flex grow>
                        <citizenship-section
                                :citizenship-collection="{{ $citizenshipCollection }}"></citizenship-section>
                    </v-flex>

                    <v-flex shrink class="pt-4">
                        <v-layout column align-center>
                            <v-flex shrink class="py-3"><h2 class="display-1">@{{ __sentences('whyShouldYou') }}</h2></v-flex>
                            <v-flex shrink
                                    class="red darken-2"
                                    style="height: 3px; width: 50px">
                            </v-flex>
                        </v-layout>
                    </v-flex>

                    <v-flex shrink class="text-xs-center pa-4">
                        <div class="mx-auto" style="max-width: 600px; width: 100%">
                            <p class="subheading">
                                @{{ __sentences('whyShouldYouSubheading') }}
                            </p>
                        </div>
                    </v-flex>
                    <v-flex>
                        <v-container id="citizenship-features" px-4 py-2>
                            <v-layout row wrap>
                                <v-flex xs12 sm4 pa-3>
                                    <v-layout row>
                                        <v-flex xs4>
                                            <i class="flaticon-airplane"></i>
                                        </v-flex>
                                        <v-flex xs12 pa-3>
                                            <h3 class="title font-weight-bold mb-3">@{{ __sentences('easeOfTravel') }}</h3>
                                            <p class="subheading">@{{ __sentences('easeOfTravelSubheading') }}</p>
                                        </v-flex>
                                    </v-layout>
                                </v-flex>
                                <v-flex xs12 sm4 pa-3>
                                    <v-layout row>
                                        <v-flex xs4>
                                            <i class="flaticon-price-tag"></i>
                                        </v-flex>
                                        <v-flex xs12 pa-3>
                                            <h3 class="title font-weight-bold mb-3">@{{ __sentences('assetProtection') }}</h3>
                                            <p class="subheading">@{{ __sentences('assetProtectionSubheading') }}</p>
                                        </v-flex>
                                    </v-layout>
                                </v-flex>
                                <v-flex xs12 sm4 pa-3>
                                    <v-layout row>
                                        <v-flex xs4>
                                            <i class="flaticon-cap"></i>
                                        </v-flex>
                                        <v-flex xs12 pa-3>
                                            <h3 class="title font-weight-bold mb-3">@{{ __words('education') }}</h3>
                                            <p class="subheading">@{{ __sentences('educationSubheading') }}</p>
                                        </v-flex>
                                    </v-layout>
                                </v-flex>
                                <v-flex xs12 sm4 pa-3>
                                    <v-layout row>
                                        <v-flex xs4>
                                            <i class="flaticon-swimming-pool"></i>
                                        </v-flex>
                                        <v-flex xs12 pa-3>
                                            <h3 class="title font-weight-bold mb-3">@{{ __sentences('overseasRetirement') }}</h3>
                                            <p class="subheading">@{{ __sentences('overseasRetirementSubheading') }}</p>
                                        </v-flex>
                                    </v-layout>
                                </v-flex>
                                <v-flex xs12 sm4 pa-3>
                                    <v-layout row>
                                        <v-flex xs4>
                                            <i class="flaticon-worldwide"></i>
                                        </v-flex>
                                        <v-flex xs12 pa-3>
                                            <h3 class="title font-weight-bold mb-3">@{{ __words('freedom') }}</h3>
                                            <p class="subheading">@{{ __sentences('freedomSubheading') }}</p>
                                        </v-flex>
                                    </v-layout>
                                </v-flex>
                                <v-flex xs12 sm4 pa-3>
                                    <v-layout row>
                                        <v-flex xs4>
                                            <i class="flaticon-family"></i>
                                        </v-flex>
                                        <v-flex xs12 pa-3>
                                            <h3 class="title font-weight-bold mb-3">@{{ __words('security') }}</h3>
                                            <p class="subheading">@{{ __sentences('securitySubheading') }}</p>
                                        </v-flex>
                                    </v-layout>
                                </v-flex>
                            </v-layout>
                        </v-container>
                    </v-flex>
                    {{--<v-flex text-xs-center>
                        <v-btn href="" role="link">Learn More</v-btn>
                    </v-flex>--}}
                </v-layout>
            </v-flex>

            <v-flex xs12 my-5>
                <section id="free-consultation">
                    <v-layout column align-center>
                        <v-flex shrink class="py-3 text-xs-center" dark>
                            <h1 class="display-1">@{{ __sentences('freeConsultation') }}</h1>
                        </v-flex>
                        <v-flex shrink>
                            <v-btn color="primary" href="#contact-us" role="link">@{{ __sentences('contactUs') }}</v-btn>
                        </v-flex>
                    </v-layout>
                </section>
            </v-flex>

            <v-flex xs12 my-5 class="bg-color-dark">
                <section id="why-us" class="py-5">
                    <v-layout column align-center>
                        <v-flex shrink class="py-3" dark>
                            <h1 class="display-1">@{{ __sentences('whyChooseUs') }}</h1>
                        </v-flex>
                        <v-flex shrink
                                class="red darken-2 mb-4"
                                style="height: 3px; width: 50px">
                        </v-flex>
                        <v-flex>
                            <v-container>
                                <v-layout row wrap>
                                    <v-flex xs12 md4 pa-4>
                                        <div class="service_box">
                                            <div class="service_icon">
                                                <i class="fa fa-search"></i>
                                            </div>
                                            <h3>@{{ __words('transparency') }}</h3>
                                            <p class="subheading">@{{ __sentences('transparencySubheading') }}</p>
                                        </div>
                                    </v-flex>
                                    <v-flex xs12 md4 pa-4>
                                        <div class="service_box">
                                            <div class="service_icon">
                                                <i class="fa fa-briefcase"></i>
                                            </div>
                                            <h3>@{{ __words('experience') }}</h3>
                                            <p class="subheading">@{{ __sentences('experienceSubheading') }}</p>
                                        </div>
                                    </v-flex>
                                    <v-flex xs12 md4 pa-4>
                                        <div class="service_box">
                                            <div class="service_icon">
                                                <i class="fa fa-handshake"></i>
                                            </div>
                                            <h3>@{{ __words('credibility') }}</h3>
                                            <p class="subheading">@{{ __sentences('credibilitySubheading') }}</p>
                                        </div>
                                    </v-flex>
                                </v-layout>
                            </v-container>
                        </v-flex>
                    </v-layout>
                </section>
            </v-flex>

            <v-flex xs12 my-5>
                <section id="our-offices">
                    <v-layout column align-center>
                        <v-flex shrink class="py-3 text-xs-center">
                            <h1 class="display-1">@{{ __sentences('worldwideOffices') }}</h1>
                        </v-flex>
                        <v-flex shrink
                                class="red darken-2 mb-4"
                                style="height: 3px; width: 50px">
                        </v-flex>
                    </v-layout>
                    <v-layout row wrap>
                        <v-flex xs12 sm6 md3 mb-3>
                            <v-layout column>
                                <v-flex>
                                    <v-img src="{{ asset('assets/img/office/vienna.webp') }}"
                                           alt="Vienna Office" width="100%" height="190px"></v-img>
                                </v-flex>
                                <v-flex pl-3 pt-4>
                                    <h3 class="headline">@{{ __words('vienna') }}</h3>
                                    <h4 class="title mt-3">
                                        Opernring 1/R/201,<br>
                                        A- 1010 Wien
                                    </h4>
                                </v-flex>
                            </v-layout>
                        </v-flex>
                        <v-flex xs12 sm6 md3 mb-3>
                            <v-layout column>
                                <v-flex>
                                    <v-img src="{{ asset('assets/img/office/linz.webp') }}" alt="Linz Office"
                                           width="100%" height="190px"></v-img>
                                </v-flex>
                                <v-flex pl-3 pt-4>
                                    <h3 class="headline">@{{ __words('linz') }}</h3>
                                    <h4 class="title mt-3">
                                        Rudolfstrasse 6/1.OG,<br>
                                        A- 4040 Linz
                                    </h4>
                                </v-flex>
                            </v-layout>
                        </v-flex>
                        <v-flex xs12 sm6 md3 mb-3>
                            <v-layout column>
                                <v-flex>
                                    <v-img src="{{ asset('assets/img/office/hungary.webp') }}"
                                           alt="Hungary Office" width="100%" height="190px"></v-img>
                                </v-flex>
                                <v-flex pl-3 pt-4>
                                    <h3 class="headline">@{{ __words('hungary') }}</h3>
                                    <h4 class="title mt-3">
                                        Mosonmagyaróvár Fo út 49. 1/7,<br>
                                        9200 Ungarn
                                    </h4>
                                </v-flex>
                            </v-layout>
                        </v-flex>
                        <v-flex xs12 sm6 md3 mb-3>
                            <v-layout column>
                                <v-flex>
                                    <v-img src="{{ asset('assets/img/office/capital.webp') }}"
                                           alt="Cairo Office" width="100%" height="190px"></v-img>
                                </v-flex>
                                <v-flex pl-3 pt-4>
                                    <h3 class="headline">@{{ __words('cairo') }}</h3>
                                    <h4 class="title mt-3">
                                        Sheikh Zayed, Capital Business Park,<br>
                                        B 6, Off 314
                                    </h4>
                                </v-flex>
                            </v-layout>
                        </v-flex>
                    </v-layout>
                </section>
            </v-flex>

            <v-flex xs12 my-5>
                <contact-form-section></contact-form-section>
            </v-flex>

            <v-flex xs12 mt-5>
                <v-layout row wrap>
                    <v-flex xs12 md6 grey lighten-2>
                        <v-layout column align-start class="pa-5">
                            <v-flex mb-5>
                                <h1 class="display-1" style="width: auto">
                                    Careers
                                    <v-progress-linear
                                            color="primary"
                                            height="5"
                                            value="30"
                                    ></v-progress-linear>
                                </h1>

                            </v-flex>
                            <v-flex py-3>
                                <p class="subheading">
                                    Want to work at Novavera Real Estate
                                </p>
                                <v-btn href="{{ route('careers.index') }}" class="nova-btn-primary ml-0" dark role="link">
                                    Job Openings
                                    <v-icon>keyboard_arrow_right</v-icon>
                                </v-btn>
                            </v-flex>
                        </v-layout>
                    </v-flex>
                    <v-flex xs12 md6 grey lighten-4>
                        <v-layout column align-start class="pa-5">
                            <v-flex mb-5>
                                <h1 class="display-1" style="width: auto">
                                    BECOME A PARTNER
                                    <v-progress-linear
                                            color="primary"
                                            height="5"
                                            value="30"
                                    ></v-progress-linear>
                                </h1>

                            </v-flex>
                            <v-flex py-3>
                                <p class="subheading">
                                    Ready to partner with us?
                                </p>
                                <v-btn href="{{ route('partners.index') }}" class="nova-btn-primary ml-0" dark role="link">
                                    Join Us
                                    <v-icon>keyboard_arrow_right</v-icon>
                                </v-btn>
                            </v-flex>
                        </v-layout>
                    </v-flex>
                </v-layout>
            </v-flex>

        </v-layout>
    </v-container>
@endsection