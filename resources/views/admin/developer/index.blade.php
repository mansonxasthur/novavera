@extends('admin.layouts.app')

@section('content')
    <developers :developer-collection="{{ $developers }}"></developers>
@endsection