@extends('layouts.app')

@section('content')
    <v-container fluid>
        <project-section :locations="{{ $locations }}" title="{{ $title }}"></project-section>
    </v-container>
@endsection