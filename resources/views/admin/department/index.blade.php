@extends('admin.layouts.app')

@section('content')
    <departments :department-collection="{{ $departments }}"></departments>
@endsection
