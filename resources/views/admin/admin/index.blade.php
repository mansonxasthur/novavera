@extends('admin.layouts.app')

@section('content')
    <admins :roles="{{ $roles }}" :admin-collection="{{ $admins }}"></admins>
@endsection