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
    <!-- Latest compiled and minified CSS -->
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css"
          integrity="sha384-BVYiiSIFeK1dGmJRAkycuHAHRg32OmUcww7on3RYdg4Va+PmSTsz/K68vbdEjh4u" crossorigin="anonymous">
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
    <!-- Latest compiled and minified JavaScript -->
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js"
            integrity="sha384-Tc5IQib027qvyjSMfHjOMaLkfuWVxZxUPnCJA7l2mCWNIpG9mGCD8wGNIcPD7Txa"
            crossorigin="anonymous"></script>
@endpush