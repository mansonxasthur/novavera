@extends('layouts.app')

@push('meta')
    @component('partials.meta', [
        'name' => 'description',
        'content' => 'We provide real estate and investment services
with high standards of expertise',
    ])
    @endcomponent
@endpush

@push('title')
    @component('partials.title')

    @endcomponent
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
                                        <h3 style="color: white">Egypt</h3>
                                    </v-flex>
                                </v-layout>
                            </v-flex>
                            <v-flex shrink class="pt-4">
                                <v-layout column align-center>
                                    <v-flex shrink class="pb-3"><h2>REAL ESTATE CONSULTANCY</h2></v-flex>
                                    <v-flex shrink
                                            class="red darken-2"
                                            style="height: 3px; width: 50px">
                                    </v-flex>
                                </v-layout>
                            </v-flex>

                            <v-flex shrink class="text-xs-center font-weight-light pa-4">
                                <p class="title">
                                    We provide real estate and investment services<br>
                                    with high standards of expertise
                                </p>
                            </v-flex>
                            <v-flex grow>
                                <v-layout row wrap class="text-xs-center">
                                    <v-flex xs12 sm6 md4 class="pa-5">
                                        <div class="flaticon-consultation mx-auto"></div>
                                        <h3 class="">Consultancy</h3>
                                    </v-flex>
                                    <v-flex xs12 sm6 md4 class="pa-5">
                                        <div class="flaticon-sale mx-auto"></div>
                                        <h3 class="">Sell & Buy Properties</h3>
                                    </v-flex>
                                    <v-flex xs12 sm6 md4 class="pa-5">
                                        <div class="flaticon-coin mx-auto"></div>
                                        <h3 class="">Investment</h3>
                                    </v-flex>
                                    <v-flex xs12 sm6 md4 class="pa-5">
                                        <div class="flaticon-home mx-auto"></div>
                                        <h3 class="">Residential</h3>
                                    </v-flex>
                                    <v-flex xs12 sm6 md4 class="pa-5">
                                        <div class="flaticon-shop mx-auto"></div>
                                        <h3 class="">Commercial</h3>
                                    </v-flex>
                                    <v-flex xs12 sm6 md4 class="pa-5">
                                        <div class="flaticon-apartments mx-auto"></div>
                                        <h3 class="">Administrative</h3>
                                    </v-flex>
                                </v-layout>
                            </v-flex>
                            <v-flex shrink class="text-xs-center my-3">
                                <v-btn class="nova-btn-primary" dark href="#residential-projects" role="link">
                                    Discover More
                                </v-btn>
                            </v-flex>
                        </v-layout>
                    </v-flex>
                    <v-flex xs12 md6 class="bg-color-dark" dark>
                        <v-layout column align-space-between>
                            <v-flex>
                                <v-layout justify-center>
                                    <v-flex shrink class="mt-0 grey lighten-5 py-3 px-4">
                                        <h3 class="black--text lighten-2 text-xs-center">Worldwide</h3>
                                    </v-flex>
                                </v-layout>
                            </v-flex>
                            <v-flex shrink class="pt-4">
                                <v-layout column align-center>
                                    <v-flex shrink class="pb-3 text-xs-center"><h2>CITIZENSHIP & RESIDENCY</h2></v-flex>
                                    <v-flex shrink
                                            class="red darken-2"
                                            style="height: 3px; width: 50px">
                                    </v-flex>
                                </v-layout>
                            </v-flex>

                            <v-flex shrink class="text-xs-center font-weight-light pa-4">
                                <p class="title">
                                    We offer second Citizenship & Residency opportunities <br>
                                    through investment abroad
                                </p>
                            </v-flex>
                            <v-flex grow>
                                <v-layout row wrap class="text-xs-center">
                                    <v-flex xs12 md6 class="text-xs-center">

                                        @if (count($citizenshipList))
                                            <h3 class="headline font-weight-bold text-uppercase white--text">Citizenship</h3>
                                            <v-container grid-list>
                                                <v-layout row wrap>
                                                    @foreach($citizenshipList as $citizenship)
                                                            <v-flex xs4>
                                                                <a href="{{ $citizenship->path() }}" class="sub-menu">
                                                                <v-layout column align-center justify-space-between>
                                                                    <v-flex style="min-width: 100px;">
                                                                        <v-avatar size="80" tile>
                                                                            <img src="{{ $citizenship->flag_url }}" alt="{{ $citizenship->country_name }}">
                                                                        </v-avatar>
                                                                    </v-flex>
                                                                    <v-flex>{{ $citizenship->country_name }}</v-flex>
                                                                </v-layout>
                                                                </a>
                                                            </v-flex>

                                                    @endforeach
                                                </v-layout>
                                            </v-container>

                                        @endif
                                    </v-flex>
                                    <v-flex xs12 md6 class="text-xs-center">

                                        @if (count($residencyList))
                                            <h3 class="headline font-weight-bold text-uppercase white--text">Residency</h3>
                                            <v-container grid-list>
                                                <v-layout row wrap>
                                                    @foreach($residencyList as $residency)
                                                        <v-flex xs4>
                                                            <a href="{{ $residency->path() }}" class="sub-menu">
                                                                <v-layout column align-center justify-space-between>
                                                                    <v-flex style="min-width: 100px;">
                                                                        <v-avatar size="80" tile>
                                                                            <img src="{{ $residency->flag_url }}" alt="{{ $residency->country_name }}">
                                                                        </v-avatar>
                                                                    </v-flex>
                                                                    <v-flex>{{ $residency->country_name }}</v-flex>
                                                                </v-layout>
                                                            </a>
                                                        </v-flex>

                                                    @endforeach
                                                </v-layout>
                                            </v-container>

                                        @endif
                                    </v-flex>
                                </v-layout>
                            </v-flex>
                            <v-flex shrink class="text-xs-center my-3">
                                <v-btn color="grey lighten-5" href="#citizenship-residency" role="link">
                                    Discover More
                                </v-btn>
                            </v-flex>
                        </v-layout>
                    </v-flex>
                </v-layout>
            </v-flex>

            <v-flex xs12 my-5 id="residential-projects">
                <project-section
                        :locations="{{ $residentialProjectLocations }}"
                        title="Residential Projects"
                        :count="{{ 4 }}"
                ></project-section>
                @if(count($residentialProjectLocations))
                    <v-layout column align-center>
                        <v-flex py-4>
                            <v-btn color="primary" href="/projects/residential">View All</v-btn>
                        </v-flex>
                    </v-layout>
                @endif
            </v-flex>

            <v-flex xs12 my-5>
                <project-section
                        :locations="{{ $commercialProjectLocations }}"
                        title="Commercial Projects"
                        :count="{{ 4 }}"
                ></project-section>
                @if(count($commercialProjectLocations))
                    <v-layout column align-center>
                        <v-flex py-4>
                            <v-btn color="primary" href="/projects/commercial">View All</v-btn>
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
                            <v-flex shrink class="py-3"><h2 class="display-1">WHY SHOULD YOU INVEST IN A SECOND
                                    CITIZENSHIP ?</h2></v-flex>
                            <v-flex shrink
                                    class="red darken-2"
                                    style="height: 3px; width: 50px">
                            </v-flex>
                        </v-layout>
                    </v-flex>

                    <v-flex shrink class="text-xs-center font-weight-light pa-4">
                        <p class="subheading">
                            Whether you are a corporate executive, public figure, investor, or private citizen,the
                            benefits of investing
                            <br>
                            in our programs will impact all aspects of life in the short and long term.
                        </p>
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
                                            <h3 class="title">Ease of Travel</h3>
                                            <p class="subheading">
                                                Convenient visa-free travelling
                                            </p>
                                        </v-flex>
                                    </v-layout>
                                </v-flex>
                                <v-flex xs12 sm4 pa-3>
                                    <v-layout row>
                                        <v-flex xs4>
                                            <i class="flaticon-price-tag"></i>
                                        </v-flex>
                                        <v-flex xs12 pa-3>
                                            <h3 class="title">Asset Protection</h3>
                                            <p class="subheading">Diversify and secure your wealth</p>
                                        </v-flex>
                                    </v-layout>
                                </v-flex>
                                <v-flex xs12 sm4 pa-3>
                                    <v-layout row>
                                        <v-flex xs4>
                                            <i class="flaticon-cap"></i>
                                        </v-flex>
                                        <v-flex xs12 pa-3>
                                            <h3 class="title">Education</h3>
                                            <p class="subheading">Broader education opportunities for your family</p>
                                        </v-flex>
                                    </v-layout>
                                </v-flex>
                                <v-flex xs12 sm4 pa-3>
                                    <v-layout row>
                                        <v-flex xs4>
                                            <i class="flaticon-swimming-pool"></i>
                                        </v-flex>
                                        <v-flex xs12 pa-3>
                                            <h3 class="title">Overseas Retirement</h3>
                                            <p class="subheading">Retire in a safe destination away from distress</p>
                                        </v-flex>
                                    </v-layout>
                                </v-flex>
                                <v-flex xs12 sm4 pa-3>
                                    <v-layout row>
                                        <v-flex xs4>
                                            <i class="flaticon-worldwide"></i>
                                        </v-flex>
                                        <v-flex xs12 pa-3>
                                            <h3 class="title">Freedom</h3>
                                            <p class="subheading">Freedom to live, work or study internationally</p>
                                        </v-flex>
                                    </v-layout>
                                </v-flex>
                                <v-flex xs12 sm4 pa-3>
                                    <v-layout row>
                                        <v-flex xs4>
                                            <i class="flaticon-family"></i>
                                        </v-flex>
                                        <v-flex xs12 pa-3>
                                            <h3 class="title">Security</h3>
                                            <p class="subheading">Protect what you value the most</p>
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
                            <h1 class="display-1">Free Consultation?</h1>
                        </v-flex>
                        <v-flex shrink>
                            <v-btn color="primary" href="#contact-us" role="link">Contact Us</v-btn>
                        </v-flex>
                    </v-layout>
                </section>
            </v-flex>

            <v-flex xs12 my-5 class="bg-color-dark">
                <section id="why-us" class="py-5">
                    <v-layout column align-center>
                        <v-flex shrink class="py-3" dark>
                            <h1 class="display-1">Why Choose Us?</h1>
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
                                            <h3>Transparency</h3>
                                            <p class="subheading">Integrity, honesty, transparency and authenticity are
                                                very important to us and we work closely with our clients
                                                to ensure that they have every level of support.</p>
                                        </div>
                                    </v-flex>
                                    <v-flex xs12 md4 pa-4>
                                        <div class="service_box">
                                            <div class="service_icon">
                                                <i class="fa fa-briefcase"></i>
                                            </div>
                                            <h3>Experience</h3>
                                            <p class="subheading">Novavera® is based on over 27 years of extensive
                                                experience in different international
                                                businesses, a long career of success,
                                                rebranded in an innovative, creative and up-to-date mind set.</p>
                                        </div>
                                    </v-flex>
                                    <v-flex xs12 md4 pa-4>
                                        <div class="service_box">
                                            <div class="service_icon">
                                                <i class="fa fa-handshake"></i>
                                            </div>
                                            <h3>Credibility</h3>
                                            <p class="subheading">Through our work with clients over the last 27 years,
                                                we have learned how to use a common language with everyone.</p>
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
                            <h1 class="display-1">Worldwide Offices</h1>
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
                                    <h3 class="headline">Vienna</h3>
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
                                    <h3 class="headline">Linz</h3>
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
                                    <h3 class="headline">Hungary</h3>
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
                                    <h3 class="headline">Cairo</h3>
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
                <section id="contact-us">
                    <v-layout column align-center>
                        <v-flex shrink class="py-3">
                            <h1 class="display-1">Contact Us</h1>
                        </v-flex>
                        <v-flex shrink
                                class="red darken-2 mb-4"
                                style="height: 3px; width: 50px">
                        </v-flex>
                    </v-layout>
                    <v-flex>
                        <v-container fluid>
                            <v-layout row wrap>
                                <v-flex xs12 lg8 pa-2>
                                    <v-card flat>
                                        <v-form>
                                            <v-card-text>
                                                <v-layout row wrap>
                                                    <v-flex xs12>
                                                        <v-layout row wrap>
                                                            <v-flex xs12 md6 pa-1>
                                                                <v-text-field
                                                                        outline
                                                                        label="Enter Name"
                                                                        type="text"
                                                                        color="blue darken-4"
                                                                        autocomplete="name"
                                                                        prepend-inner-icon="person"
                                                                ></v-text-field>
                                                            </v-flex>
                                                            <v-flex xs12 md6 pa-1>
                                                                <v-text-field
                                                                        outline
                                                                        label="Enter Email"
                                                                        type="email"
                                                                        color="blue darken-4"
                                                                        color="primary"
                                                                        autocomplete="email"
                                                                        prepend-inner-icon="email"
                                                                ></v-text-field>
                                                            </v-flex>
                                                            <v-flex xs12 md6 pa-1>
                                                                <v-text-field
                                                                        outline
                                                                        label="Enter Phone"
                                                                        type="tel"
                                                                        color="blue darken-4"
                                                                        color="primary"
                                                                        autocomplete="tel"
                                                                        prepend-inner-icon="phone"
                                                                ></v-text-field>
                                                            </v-flex>
                                                            <v-flex xs12 md6 pa-1>
                                                                <v-select
                                                                        outline
                                                                        :items="{{ json_encode([
                                                            'Real Estate Egypt',
                                                            'Citizenship & Residency'
                                                            ]) }}"
                                                                        label="Select Category"
                                                                        color="blue darken-4"
                                                                        prepend-inner-icon="category"
                                                                ></v-select>
                                                            </v-flex>
                                                        </v-layout>
                                                    </v-flex>
                                                    <v-flex xs12 pa-1>
                                                        <v-textarea
                                                                outline
                                                                height="100%"
                                                                label="Message"
                                                                color="blue darken-4"
                                                                prepend-inner-icon="message"
                                                        ></v-textarea>
                                                    </v-flex>
                                                </v-layout>
                                            </v-card-text>
                                            <v-card-actions>
                                                <v-spacer></v-spacer>
                                                <v-btn type="submit" color="primary" class="mx-2">Send message</v-btn>
                                            </v-card-actions>
                                        </v-form>
                                    </v-card>
                                </v-flex>
                                <v-flex xs12 lg4 pa-2>
                                    <v-card flat>
                                        <v-card-text>
                                            <v-flex pa-2>
                                                <h2 class="headline mb-3">
                                                    <v-icon large>location_on</v-icon>
                                                    Our office
                                                </h2>

                                                <v-layout column>
                                                    <v-flex class="subheading py-2">
                                                        <address>
                                                            <v-tooltip left>
                                                                <template v-slot:activator="{ on }">

                                                                    <a href="https://goo.gl/maps/4y74kX6UDg5We5Ud7"
                                                                       target="_blank" role="link" v-on="on"
                                                                       style="text-decoration: none; color:inherit">
                                                                        Cairo, Capital Business Park, Sheikh Zayed
                                                                        Building 6 , Office 314
                                                                    </a>
                                                                </template>
                                                                <span>Address</span>
                                                            </v-tooltip>
                                                        </address>
                                                    </v-flex>
                                                    <v-flex class="subheading py-2">
                                                        <v-tooltip left>
                                                            <template v-slot:activator="{ on }">
                                                                <a href="tel:+201019699911" role="tel" v-on="on"
                                                                   style="text-decoration: none; color:inherit">
                                                                    (+20) 1019699911
                                                                </a>
                                                            </template>
                                                            <span>Phone</span>
                                                        </v-tooltip>

                                                    </v-flex>
                                                    <v-flex class="subheading py-2">
                                                        <v-tooltip left>
                                                            <template v-slot:activator="{ on }">
                                                                <a href="mailto:realestate@novavera.com" role="email"
                                                                   v-on="on"
                                                                   style="text-decoration: none; color:inherit">
                                                                    realestate@novavera.com
                                                                </a>
                                                            </template>
                                                            <span>Email</span>
                                                        </v-tooltip>
                                                    </v-flex>
                                                </v-layout>
                                            </v-flex>
                                        </v-card-text>
                                    </v-card>
                                </v-flex>
                            </v-layout>
                        </v-container>
                    </v-flex>
                </section>
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
                                <v-btn href="#" class="nova-btn-primary ml-0" dark role="link">
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
                                <v-btn href="#" class="nova-btn-primary ml-0" dark role="link">
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