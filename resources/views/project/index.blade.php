@extends('layouts.app')

@push('meta')
    @component('partials.meta', ['name' => 'description'])
        A list of our luxurious {{ $title }}
    @endcomponent

    @component('partials.meta', ['name' => 'keywords'])
        @foreach($locations as $location)
            {{ $location->name }}, @foreach($location->projects as $project){{ $project->name }},@endforeach
        @endforeach
    @endcomponent
@endpush

@push('title')
    @component('partials.title')
        {{ $title }}
    @endcomponent
@endpush

@section('content')
    <v-container fluid>
        <project-section :locations="{{ $locations }}" title="{{ $title }}"></project-section>
    </v-container>
@endsection