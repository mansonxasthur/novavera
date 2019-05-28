@extends('admin.layouts.app')

@section('content')
    <citizenship-list :citizenship-collection="{{ $citizenships }}"></citizenship-list>
@endsection