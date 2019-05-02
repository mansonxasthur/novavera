@extends('admin.layouts.app')
@push('styles')
    @include('layouts.summernote-styles')
@endpush
@section('content')
    <edit-project
        :developer-collection="{{ $developers }}"
        :property-collection="{{ $propertyTypes }}"
        :location-collection="{{ $locations }}"
        :project-collection="{{ $project }}"
    ></edit-project>
@endsection

@push('scripts')
    @include('layouts.summernote-scripts')
@endpush


