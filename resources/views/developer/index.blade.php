@extends('layouts.app')

@push('meta')
    @component('partials.meta', ['name' => 'description'])
        Novavera Real Estate deals with the most prestigious developers in Egypt and Middle East
    @endcomponent

    @component('partials.meta', ['name' => 'keywords'])
        Novavera, Real Estate, Palm Hills, Emaar, Tatwir Misr
    @endcomponent
@endpush


@push('title')
    @component('partials.title')
        Developers
    @endcomponent
@endpush

@section('content')
    <developers :developers="{{ $developers }}"></developers>
@endsection