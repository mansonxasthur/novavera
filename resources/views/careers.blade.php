@extends('layouts.app')


@push('meta')
    @component('partials.meta', ['name' => 'description'])
        Apply now to our open jobs and join our team of professionals
    @endcomponent

    @component('partials.meta', ['name' => 'keywords'])
        job, career, accountant, sales, seo, public relations, PR, hr, Human Resources
    @endcomponent
@endpush

@push('title')
    @component('partials.title')
        Careers
    @endcomponent
@endpush

@section('content')
    <careers :departments="{{ $departments }}"></careers>
@endsection