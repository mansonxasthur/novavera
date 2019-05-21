@extends('layouts.app')

@push('meta')
    @component('partials.meta', ['name' => 'description'])
        {{ \Illuminate\Support\Str::limit($developer->description, 140) }}
    @endcomponent

    @component('partials.meta', ['name' => 'keywords'])
        {{ $developer->name }}
    @endcomponent
@endpush

@push('title')
    @component('partials.title')
        {{ $developer->name }}
    @endcomponent
@endpush

@section('content')
    <developer :developer="{{ $developer }}" :locations="{{ $locations }}"></developer>
@endsection