@extends('layouts.app')


@push('meta')
    @component('partials.meta', ['name' => 'description'])
        {{ $citizenship->meta }}
    @endcomponent

    @component('partials.meta', ['name' => 'keywords'])
        {{ $citizenship->keywords }}
    @endcomponent
@endpush

@push('title')
    @component('partials.title')
        {{ $citizenship->title }}
    @endcomponent
@endpush


@section('content')
    <citizenship :citizenship="{{ $citizenship }}" :citizenship-collection="{{ $citizenships }}"></citizenship>
@endsection