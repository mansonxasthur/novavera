@extends('admin.layouts.app')

@section('content')
    <projects :project-collection="{{ $projects }}"></projects>
@endsection