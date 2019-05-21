@extends('layouts.app')


@push('meta')
    @component('partials.meta', ['name' => 'description'])
        Become one of our many partners
    @endcomponent

    @component('partials.meta', ['name' => 'keywords'])

    @endcomponent
@endpush

@push('title')
    @component('partials.title')
        Partners
    @endcomponent
@endpush

@section('content')
    <partners></partners>
@endsection