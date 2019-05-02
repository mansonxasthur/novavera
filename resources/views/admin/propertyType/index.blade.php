@extends('admin.layouts.app')

@section('content')
    <property-types :property-type-collection="{{ $propertyTypes }}"></property-types>
@endsection