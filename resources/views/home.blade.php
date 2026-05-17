{{-- Main Index File for Static Landing Page --}}
@extends('layouts.app')

@section('content')
@include('sections.hero')
@include('sections.featured_opportunities')
@include('sections.about_pinnacle')
@include('sections.invest_victoria')
@include('sections.core-pillars')
{{-- @include('sections.about_us') --}}

@include('sections.inquiry-form')
@include('sections.how-it-works')
@include('sections.advisor_cta')
@include('sections.refer-a-friend')
@include('sections.solutions')
@include('sections.blog')
@endsection