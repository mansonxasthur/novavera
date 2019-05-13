@extends('layouts.app')

@push('title')
    @component('partials.title')
        | Developers
    @endcomponent
@endpush

@section('content')
    <developers :developers="{{ $developers }}"></developers>
@endsection