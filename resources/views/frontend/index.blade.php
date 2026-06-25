@extends('layouts.frontend')
@section('title', isset($meta_tags) && $meta_tags ? $meta_tags->tag : 'Home | Pro Global Logistics')
@section('meta_description', isset($meta_tags) && $meta_tags ? $meta_tags->description : 'Pro Global Logistics - Your trusted partner for comprehensive logistics and transportation solutions worldwide. We offer air freight, ocean freight, land freight, warehousing, and more.')
@section('content')
@include('frontend.header')
@include('frontend.trackandtrace')
@include('frontend.services')
@include('frontend.whychoose')

@include('frontend.newsletter')
@include('frontend.footer')
@include('frontend.modal')

@endsection