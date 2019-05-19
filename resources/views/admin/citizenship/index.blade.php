@extends('admin.layouts.app')

@section('content')
    <citizenship-list :citizenship-collection="{{ $citizenshipList }}"></citizenship-list>
@endsection