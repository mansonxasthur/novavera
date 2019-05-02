@extends('admin.layouts.app')
@push('styles')
    @include('layouts.summernote-styles')
@endpush
@section('content')
    <edit-post
        :tag-collection="{{ $tags }}"
        :post-collection="{{ $post }}"
    ></edit-post>
@endsection

@push('scripts')
    @include('layouts.summernote-scripts')
@endpush


