@extends('layouts.app')

@section('content')
    <citizenship :citizenship="{{ $citizenship }}" :citizenship-collection="{{ $citizenships }}"></citizenship>
@endsection