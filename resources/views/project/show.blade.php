@extends('layouts.app')

@push('meta')
    @component('partials.meta', ['name' => 'description'])
        {{ $project->meta }}
    @endcomponent

    @component('partials.meta', ['name' => 'keywords'])
        {{ $project->keywords }}
    @endcomponent
@endpush

@push('title')
    @component('partials.title')
        {{ $project->name }}
    @endcomponent
@endpush

@section('content')
    <project :project="{{ $project }}"></project>
@endsection