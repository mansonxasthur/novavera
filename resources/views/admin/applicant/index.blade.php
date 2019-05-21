@extends('admin.layouts.app')

@section('content')
    <applicants :applicant-collection="{{ $applicants }}"></applicants>
@endsection
