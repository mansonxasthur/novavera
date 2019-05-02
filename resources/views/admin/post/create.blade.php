@extends('admin.layouts.app')
@push('styles')
    @include('layouts.summernote-styles')
@endpush
@section('content')
    <create-post
        :tag-collection="{{ $tags }}"
    ></create-post>
@endsection

@push('scripts')
    @include('layouts.summernote-scripts')
@endpush


