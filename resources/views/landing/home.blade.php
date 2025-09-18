<!-- resources/views/landing/home.blade.php -->
@extends('landing.layout')

@section('content')
  @include('landing.partials.hero')
  @include('landing.partials.about')
  @include('landing.partials.how')
  @include('landing.partials.testimonials')
  @include('landing.partials.benefits')
  @include('landing.partials.contact')
  @include('landing.partials.cta')
@endsection
