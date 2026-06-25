@extends('layouts.frontend')
@section('content')
<?php
if (!isset($meta_tags)) {
    $tag            =   'PGL Logistics';
    $decsription      =   'PGL Logistics';
} else {
    $tag            =   $meta_tags->tag;
    $decsription    =   $meta_tags->description;
}


?>

@section('title', $tag)
<section id="hero" class="hero-section position-relative"
    style="background-image: url('assets/img/service/hero.jpg'); min-height: 300px;  ">
    <!-- Navbar at top -->
    @include('frontend.nav')
    <!-- Hero Content -->
    <div class=" d-flex align-items-center" style="min-height: 300px; ">
        <div class="container" style="z-index: 2;">
            <div class="row align-items-center">
                <div class="col-lg-8 col-md-10">
                    <h1 class=" text-white head-1">Services</h1>
                    <nav aria-label="breadcrumb">
                        <ol class="breadcrumb bg-transparent p-0 mb-0">
                            <li class="breadcrumb-item"><a href="{{route('home')}}">Home</a>
                            </li>
                            <li class="breadcrumb-item active" aria-current="page">Services</li>
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

<!-- Services We Provide Section -->
<section class="services-provide-section py-5" style="background:#f6f8fc;">
    <div class="container">
        <h2 class="head-2 head-underline text-secondary">Our Services
            <span class="custom-underline"></span>
        </h2>
        <div class="row mt-4 justify-content-center g-4">
            <!-- Ocean Freight -->
            <?php foreach ($services as $obj): ?>
                <a class="col-lg-4 col-md-6 d-flex justify-content-center mb-5 px-2"
                    style="text-decoration: none; cursor: pointer;" href="<?= url('service-detail/' . $obj->slug) ?>">
                    <div>
                        <div class="service-card">
                            <img src="<?= asset('uploads/product_items/' . $obj->image) ?>" alt="<?= e($obj->name) ?>" />
                            <div class="overlay"></div>
                            <div class="service-card-content-middle">
                                <div class="service-card-desc">
                                    <?= $obj->short_description ?>
                                </div>
                                <span class="overlay-arrow material-icons service-card-desc"
                                    style="height: 30px;margin: 0; padding-top: 10px;color: #bababa;">arrow_forward</span>
                            </div>
                        </div>
                        <div class="service-card-footerTitle mt-4 head-underline p-0"><?= e($obj->name) ?> <span
                                class="custom-underline"></span></div>
                    </div>
                </a>

            <?php endforeach; ?>
        </div>
    </div>
</section>

<!-- CTA Section -->
<section class="sectionhero-banner  align-items-start mt-4 pt-4"
    style=" background: url('assets/img/home/home-cta.png') center center/cover no-repeat;">
    <div class="container" style="z-index: 2;">
        <div class="row align-items-center " sty>
            <div class="col-lg-8 col-12 mt-4 pt-4">
                <h2 class="head-1 text-white">
                    Need a Trusted Partner for Your Logistics Requirements?
                </h2>
                <a href="{{route('contactus')}}" class="btn btn-primary mt-4">GET IN TOUCH</a>
                <div class="container position-absolute bottom-0 start-0 end-0 mb-4">
                    <div class="row mt-5 d-none d-md-flex">
                        <!-- Box 1 -->
                        <div class="col-lg-3 col-md-6 col-12">
                            <div
                                class="info-box-white p-3 bg-white text-dark rounded shadow-sm text-center row align-items-center">
                                <h3 class="fw-bold mb-0 col-6" style="font-size: 40px;font-weight: 800;">100K</h3>
                                <p class="text-start col-6">Shipments Delivered</p>
                            </div>
                        </div>
                        <!-- Box 2 -->
                        <div class="col-lg-3 col-md-6 col-12">
                            <a class="info-box-black-transparent p-3 " href="tel:+97143515599">
                                <i class="material-icons me-2">call</i>
                                +971 4 351 5599
                            </a>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>
<!-- Dedicated Service Team Section -->
<section class="px-4">
    <h2 class="head-2 text-secondary text-center mt-5 pt-2">
        PGL Dedicated Service Team ​
    </h2>
    <p class="pt-4 text-center"
        style="font-weight: 500;font-size: 18px;line-height: 33.2px;letter-spacing: 0.5px;color: #575A7B;">
        At PGL, we are committed to ensuring the efficient and timely handling of our customer shipments and to
        achieve this,we have implemented a structured workflow with dedicated personnel overseeing each critical
        aspect of the process.
    </p>
    <div class="d-flex justify-content-center align-items-center pt-4">
        <img src="assets/img/about/Circle.svg" alt="Circle" style="max-height: 100vh; width: 100%;">
    </div>
</section>
@include('frontend.footer')
@endsection