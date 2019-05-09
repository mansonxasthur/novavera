@extends('layouts.app')

@push('styles')
{!! $page->style !!}
@endpush
@section('content')
    <page :page="{{ $page }}"></page>
@endsection