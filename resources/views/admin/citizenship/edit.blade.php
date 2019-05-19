@extends('admin.layouts.app')
@push('styles')
    @include('layouts.summernote-styles')
@endpush
@section('content')
    <edit-citizenship
        :citizenship-collection="{{ $citizenship }}"
    ></edit-citizenship>
@endsection

@push('scripts')
    @include('layouts.summernote-scripts')
@endpush


