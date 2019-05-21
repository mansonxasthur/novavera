@extends('admin.layouts.app')

@section('content')
    <property-requests :property-request-collection="{{ $propertyRequests }}"></property-requests>
@endsection
