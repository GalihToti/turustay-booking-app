@extends('layouts.site')

@section('title', 'TuruStay - Pengalaman Menginap yang Tak Terlupakan')

@push('styles')
    <link rel="stylesheet" href="{{ asset('css/home.css') }}">
@endpush

@section('content')
    @include('pages.home.partials.hero')
    @include('pages.home.partials.features')
    @include('pages.home.partials.booking-form')
    @include('pages.home.partials.rooms')
    @include('pages.home.partials.promo')
    @include('pages.home.partials.testimonials')
    @include('pages.home.partials.location')
@endsection
