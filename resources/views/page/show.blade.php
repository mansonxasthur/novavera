@extends('layouts.app')

@if($page->style)
    @push('styles')
        {!! $page->style !!}
    @endpush
@endif
@section('content')
    <page :page="{{ $page }}"></page>
@endsection