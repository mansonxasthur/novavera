@extends('layouts.app')


@push('meta')
    @component('partials.meta', ['name' => 'description'])
        Become one of our many partners
    @endcomponent

    @component('partials.meta', ['name' => 'keywords'])
        @foreach($locations as $location)
            {{ $location->name }}, @foreach($location->projects as $project){{ $project->name }},@endforeach villa, townhouse, apartment, deluxe
        @endforeach
    @endcomponent
@endpush

@push('title')
    @component('partials.title')
        Property Request
    @endcomponent
@endpush

@section('content')
    <property-request :locations="{{ $locations }}"></property-request>
@endsection