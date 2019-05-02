@extends('admin.layouts.app')
@push('styles')
    @include('layouts.summernote-styles')
@endpush
@section('content')
    <edit-slider
        :slider-collection="{{ $slider }}"
    ></edit-slider>
@endsection

@push('scripts')
    @include('layouts.summernote-scripts')
@endpush


