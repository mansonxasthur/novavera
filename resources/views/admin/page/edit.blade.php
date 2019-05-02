@extends('admin.layouts.app')
@push('styles')
    @include('layouts.summernote-styles')
@endpush
@section('content')
    <edit-page
        :page-collection="{{ $page }}"
    ></edit-page>
@endsection

@push('scripts')
    @include('layouts.summernote-scripts')
@endpush


