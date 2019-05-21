@extends('layouts.app')

@push('meta')
    @component('partials.meta', ['name' => 'description'])
        {{ $page->meta }}
    @endcomponent

    @component('partials.meta', ['name' => 'keywords'])
        {{ $page->keywords }}
    @endcomponent
@endpush

@push('title')
    @component('partials.title')
        {{ $page->title }}
    @endcomponent
@endpush

@if($page->style)
    @push('styles')
        {!! $page->style !!}
    @endpush
@endif
@section('content')
    <page :page="{{ $page }}"></page>
@endsection