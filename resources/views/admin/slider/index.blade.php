@extends('admin.layouts.app')

@section('content')
    <sliders :slider-collection="{{ $sliders }}"></sliders>
@endsection