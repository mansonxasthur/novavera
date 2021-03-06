@extends('layouts.app')


@push('meta')
    @component('partials.meta', ['name' => 'description'])
        {{ $citizenship->meta }}
    @endcomponent

    @component('partials.meta', ['name' => 'keywords'])
        {{ $citizenship->keywords }}
    @endcomponent
@endpush

@push('bootstrap')
    <!-- Latest compiled and minified CSS -->
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css"
          integrity="sha384-BVYiiSIFeK1dGmJRAkycuHAHRg32OmUcww7on3RYdg4Va+PmSTsz/K68vbdEjh4u" crossorigin="anonymous">
@endpush

@push('title')
    @component('partials.title')
        {{ $citizenship->title }}
    @endcomponent
@endpush

@push('styles')
    <style>
        .v-menu__content.theme--light.v-menu__content--fixed.menuable__content__active.citizenship-list {
            padding-left: 12px;
            padding-right: 12px;
        }

        a.text-capitalize.font-weight-bold.subheading.v-btn.v-btn--flat.theme--light {
            text-decoration: none;
        }
    </style>
@endpush

@section('content')
    <citizenship :citizenship="{{ $citizenship }}" :citizenship-collection="{{ $citizenships }}"></citizenship>
@endsection
