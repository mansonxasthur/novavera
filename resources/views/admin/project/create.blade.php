@extends('admin.layouts.app')
@push('styles')
    @include('layouts.summernote-styles')
@endpush
@section('content')
    <create-project
        :developer-collection="{{ $developers }}"
        :property-collection="{{ $propertyTypes }}"
        :location-collection="{{ $locations }}"
    ></create-project>
@endsection

@push('scripts')
    @include('layouts.summernote-scripts')
@endpush


