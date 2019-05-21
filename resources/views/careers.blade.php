@extends('layouts.app')

@section('content')
    <careers :departments="{{ $departments }}"></careers>
@endsection