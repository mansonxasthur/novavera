@extends('admin.layouts.app')

@section('content')
    <posts :post-collection="{{ $posts }}"></posts>
@endsection