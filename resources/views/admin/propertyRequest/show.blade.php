@extends('admin.layouts.app')

@section('content')
    <applicant :applicant-collection="{{ $applicant }}"></applicant>
@endsection
