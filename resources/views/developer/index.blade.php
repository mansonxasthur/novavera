@extends('layouts.app')

@section('content')
    <developers :developers="{{ $developers }}"></developers>
@endsection