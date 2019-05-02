@extends('admin.layouts.app')
@push('styles')
    @include('layouts.summernote-styles')
@endpush
@section('content')
    <create-page></create-page>
@endsection

@push('scripts')
    @include('layouts.summernote-scripts')
@endpush


