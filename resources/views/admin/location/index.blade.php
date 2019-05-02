@extends('admin.layouts.app')

@section('content')
    <locations :location-collection="{{ $locations }}"></locations>
@endsection