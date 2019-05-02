@extends('admin.layouts.app')

@section('content')
    <tags :tag-collection="{{ $tags }}"></tags>
@endsection