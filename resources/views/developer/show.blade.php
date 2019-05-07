@extends('layouts.app')

@section('content')
    <developer :developer="{{ $developer }}" :locations="{{ $locations }}"></developer>
@endsection