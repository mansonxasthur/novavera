@extends('admin.layouts.app')
@push('styles')
    @include('layouts.summernote-styles')
@endpush
@section('content')
    <create-citizenship></create-citizenship>
@endsection

@push('scripts')
    @include('layouts.summernote-scripts')
@endpush


