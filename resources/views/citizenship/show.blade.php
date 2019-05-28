@extends('layouts.app')


@push('meta')
    @component('partials.meta', ['name' => 'description'])
        {{ $citizenship->meta }}
    @endcomponent

    @component('partials.meta', ['name' => 'keywords'])
        {{ $citizenship->keywords }}
    @endcomponent
@endpush

@push('styles')
    <link href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css" rel="stylesheet"
          integrity="sha384-ggOyR0iXCbMQv3Xipma34MD+dH/1fQ784/j6cY/iJTQUOhcWr7x9JvoRxT2MZw1T" crossorigin="anonymous">
@endpush

@push('title')
    @component('partials.title')
        {{ $citizenship->title }}
    @endcomponent
@endpush


@section('content')
    <citizenship :citizenship="{{ $citizenship }}" :citizenship-collection="{{ $citizenships }}"></citizenship>
@endsection

@push('scripts')
    <script
            src="https://code.jquery.com/jquery-3.4.1.min.js"
            integrity="sha256-CSXorXvZcTkaix6Yvo6HppcZGetbYMGWSFlBw8HfCJo="
            crossorigin="anonymous"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/js/bootstrap.min.js"
            integrity="sha384-JjSmVgyd0p3pXB1rRibZUAYoIIy6OrQ6VrjIEaFf/nJGzIxFDsf4x0xIM+B07jRM"
            crossorigin="anonymous"></script>
@endpush