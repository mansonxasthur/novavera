@extends('admin.layouts.app')

@section('content')
    <pages :page-collection="{{ $pages }}"></pages>
@endsection