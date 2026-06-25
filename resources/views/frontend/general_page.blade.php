@extends('layouts.frontend')
@section('content')
<?php
if (!isset($meta_tags)) {
    $pageTitle = isset($company_profile) && $company_profile && isset($company_profile->title)
        ? $company_profile->title
        : 'Page';
    $tag            =   $pageTitle . ' | Pro Global Logistics';
    $decsription    =   isset($company_profile) && $company_profile && isset($company_profile->description)
        ? $company_profile->description
        : 'Pro Global Logistics - Your trusted partner for comprehensive logistics and transportation solutions.';
} else {
    $tag            =   $meta_tags->tag;
    $decsription    =   $meta_tags->description;
}

// Safe page title fallback
$pageTitle = isset($company_profile) && $company_profile && isset($company_profile->title)
    ? $company_profile->title
    : ($tag ?? 'Page');
?>

@section('title', $tag)
@section('meta_description', $decsription)
<section id="hero" class="hero-section position-relative"
    style="background-image: url('assets/img/service/hero.jpg'); min-height: 300px;">
    <!-- Navbar at top -->
    @include('frontend.nav')
    <!-- Hero Content -->
    <div class="d-flex align-items-center" style="min-height: 300px;">
        <div class="container" style="z-index: 2;">
            <div class="row align-items-center">
                <div class="col-lg-8 col-md-10">
                    <h1 class="text-white head-1">{{ $pageTitle }}</h1>
                    <nav aria-label="breadcrumb">
                        <ol class="breadcrumb bg-transparent p-0 mb-0">
                            <li class="breadcrumb-item"><a href="{{ route('home') }}">Home</a></li>
                            <li class="breadcrumb-item active" aria-current="page">{{ $pageTitle }}</li>
                        </ol>
                    </nav>
                </div>
            </div>
        </div>
    </div>
    <div class="hero-icons-fixed" aria-hidden="false">
        <button class="icon-btn" id="currencyBtn" aria-label="Support">
            <span class="material-icons">attach_money</span>
            <span class="tooltip-text">Currency Conversion</span>
        </button>

        <button class="icon-btn" id="unitBtn" aria-label="Language" style="max-width: 190px;">
            <span class="material-icons">language</span>
            <span class="tooltip-text">Unit Conversion</span>
        </button>
    </div>
</section>


<div class="about-skill-area pt-80 pb-50">
    <div class="container">
        <div class="row">

            <div class="col-lg-12 col-md-12">
                <div class="col-lg-12 col-md-12">
                    <h1>{{ strtoupper($pageTitle) }}</h1>
                    <div class="about-skill-test">
                        <p>
                            {!! isset($company_profile) && $company_profile && isset($company_profile->description)
                                ? $company_profile->description
                                : '' !!}
                        </p>
                    </div>
                </div>
            </div>
        </div>
    </div>

    @include('frontend.footer')
@endsection