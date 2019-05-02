@extends('admin.layouts.app')
@push('styles')
    @include('layouts.summernote-styles')
@endpush
@section('content')
    <create-tag
        :tag-collection="{{ $tags }}"
    ></create-tag>
@endsection

@push('scripts')
    @include('layouts.summernote-scripts')
@endpush


