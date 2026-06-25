@extends('layouts.frontend')
@section('content')
<?php
if (!isset($meta_tags)) {
    $serviceName = isset($ServiceDetails) && $ServiceDetails ? $ServiceDetails->name : 'Service';
    $tag            =   $serviceName . ' | Pro Global Logistics';
    $decsription    =   isset($ServiceDetails) && $ServiceDetails && $ServiceDetails->short_description 
                        ? $ServiceDetails->short_description 
                        : 'Professional ' . $serviceName . ' services by Pro Global Logistics. Reliable, efficient, and cost-effective logistics solutions.';
} else {
    $tag            =   $meta_tags->tag;
    $decsription    =   $meta_tags->description;
}


?>

@section('title', $tag)
@section('meta_description', $decsription)
<section id="hero" class="hero-section position-relative"
    style="background-image: url('/assets/img/service/hero.jpg'); min-height: 300px;">

    <!-- Navbar at top -->
    @include('frontend.nav')
    <!-- Hero Content -->
    <div class=" d-flex align-items-center" style="min-height: 300px; ">
        <div class="container" style="z-index: 2;">
            <div class="row align-items-center">
                <div class="col-lg-8 col-md-10">
                    <h1 class=" text-white head-1"><?= $ServiceDetails->name ?></h1>
                    <nav aria-label="breadcrumb">
                        <ol class="breadcrumb bg-transparent p-0 mb-0">
                            <li class="breadcrumb-item"><a href="{{route('home')}}">Home</a>
                            </li>
                            <li class="breadcrumb-item active" aria-current="page"><?= $ServiceDetails->name ?></li>
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

<!-- Service Detail Navigator Section -->
<section id="service-detail-navigator" class="service-detail-navigator py-5">
    <div class="container">
        <div class="row gx-4">
            <!-- LEFT: Navigator / Contact / Brochures -->
            <aside class="col-lg-3 col-md-4 mb-4 sticky-aside">
                <div class="sd-card sd-nav-card mb-4">
                    <div class="sd-card-header">OUR SERVICES</div>
                    <ul id="sd-service-list" class="sd-service-list list-unstyled mb-0">
                        <?php foreach ($allServices as $service) {
                            $isActive = isset($ServiceDetails) && $ServiceDetails->id == $service->id;
                        ?>
                            <li>
                                <a href="<?= route('service.detail', $service->slug) ?>"
                                   class="sd-service-item <?= $isActive ? 'active' : '' ?>">
                                <span><?= $service->name ?></span>
                                    <span class="material-icons" style="margin: 0; align-items: center;">arrow_forward</span>
                                </a>
                            </li>
                        <?php } ?>
                        <!-- <li class="d-flex justify-content-between">
                            <span>Warehousing</span>
                            <span class="material-icons" style="margin: 0;align-items: center;">arrow_forward</span>
                        </li>
                        <li class=" d-flex justify-content-between active">

                            <span>Sea Freight</span>
                            <span class="material-icons" style="margin: 0;align-items: center;">arrow_forward</span>
                        </li> -->
                        <!-- populated dynamically -->
                    </ul>
                </div>

                <div class="sd-card mb-4">
                    <div class="sd-card-header">CONTACT INFO</div>
                    <ul class="sd-contact-list list-unstyled mb-0 ps-3">
                        <li>
                            <div class="logo ">
                                <span class="mi material-icons m-0">email</span>
                            </div>

                            <div>
                                <span class="head">Email</span>
                                <a href="mailto:{{ $contact_details->email }}">{{ $contact_details->email }}</a>

                            </div>
                        </li>
                        <li>
                            <div class="logo">
                                <span class="mi material-icons m-0">phone</span>
                            </div>

                            <div>
                                <span class="head">Phone Number</span>
                                <a href="tel:{{ $contact_details->mobile }}">{{ $contact_details->mobile }}</a>
                            </div>
                        </li>
                        <li class="location-item">
                            <div class="logo">
                                <span class="mi material-icons m-0">place</span>
                            </div>

                            <div class="flex-grow-1">
                                <span class="head">Location</span>
                                <a href="https://maps.app.goo.gl/bBt3ikj1dxjVF14V8" class="d-block location-address">{{ $contact_details->address ?? '' }}</a>
                            </div>
                        </li>

                    </ul>
                </div>

                <div class="sd-card sd-brochure-card">
                    <div class="sd-card-header">BROCHURES</div>
                    <!-- replace / populate the <ul id="sd-brochure-list"> with items like these -->
                    <ul id="sd-brochure-list" class="sd-brochure-list list-unstyled mb-0">
                        <li>
                            <a class="brochure-item" href="{{ asset('PGL Slides x ESF.pdf') }}" target="_blank"
                                rel="noopener">
                                <img src="{{ asset('assets/icons/Pdf.svg') }}" alt="PDF Icon" class="brochure-icon material-icons">

                                <span class="brochure-text">Download PDF</span>
                            </a>
                        </li>

                        <!-- <li>
                            <a class="brochure-item" href="assets/brochures/download.txt" target="_blank"
                                rel="noopener">
                                <img src="assets/icons/Doc.svg" class="brochure-icon material-icons" alt="PDF Icon">
                                <span class="brochure-text">Download.txt</span>
                            </a>
                        </li> -->
                    </ul>
                </div>
            </aside>

            <!-- RIGHT: Main service content -->
            <main class="col-lg-9 col-md-8">
                <div class="sd-main-card">
                    <div class="row gx-4 align-items-start">
                        <div class="col-lg-12">
                            <img id="sd-main-image" class="img-fluid sd-main-image rounded"
                                src="{{ asset('uploads/product_items/' . $ServiceDetails->image) }}"
                                alt="{{ $ServiceDetails->name ?? 'Service Image' }}" style="width: 400px;">

                        </div>
                        <div class="col-lg-12 mt-4">
                            <h2 class="head-2-5 text-secondary"><?= $ServiceDetails->name ?></h2>
                            <div id="sd-intro" class="sd-intro text-muted">
                                <?= $ServiceDetails->short_description ?>
                            </div>
                            <div id="sd-intro" class="sd-intro text-muted mt-3">

                                Whether you require airport-to-airport,
                                door-to-door, or a custom combination, we handle the logistics to match your
                                preferences. With Pro Global Logistics, your cargo stays within our trusted network
                                throughout its journey. No matter the size, type, or frequency of your shipments, we
                                offer flexible services designed to fit your business—because when it matters most,
                                we deliver.
                            </div>
                        </div>

                        <!-- <div class="col-md-5 col-12 mt-4">
                            <img class="img-fluid sd-main-image rounded-20"
                                src="{{ asset('assets/img/service/hero.jpg') }}"
                                alt="Service image">
                        </div> -->
                        <!-- <div class="col-md-7 col-12 mt-4">
                            <div class="sd-features mt-0 mt-md-4">
                                <h2 class="head-2-5 text-secondary">Our air freight services include</h2>
                            </div>
                            <div class="row">
                                <div class="col-md-6">
                                    <span class="bulletin-section">
                                        <div class="rounded-bulletin">1</div>
                                        <span>Back to back cargo</span>
                                    </span>
                                </div>
                                <div class="col-md-6">
                                    <span class="bulletin-section">
                                        <div class="rounded-bulletin">2</div>
                                        <span>Full or Part charter</span>
                                    </span>
                                </div>
                                <div class="col-md-6">
                                    <span class="bulletin-section">
                                        <div class="rounded-bulletin">3</div>
                                        <span>Sea-Air/Air-Sea</span>
                                    </span>
                                </div>
                                <div class="col-md-6">
                                    <span class="bulletin-section">
                                        <div class="rounded-bulletin">4</div>
                                        <span>Cross trade shipments</span>
                                    </span>
                                </div>
                                <div class="col-md-12">
                                    <span class="bulletin-section">
                                        <div class="rounded-bulletin">5</div>
                                        <span>Consolidation from major trade lanes in Far East, USA, Europe</span>
                                    </span>
                                </div>



                            </div>

                        </div> -->
                        <div class="col-12">
                            <div class="sd-intro text-muted mt-4">
                                <?= $ServiceDetails->description ?>
                            </div>
                        </div>

                    </div>

                </div>
            </main>
        </div>
    </div>
</section>
<section class="sectionhero-banner align-items-start mt-4 pt-4"
    style="background: url('{{ asset('assets/img/service-details/cta.jpg') }}') center center / cover no-repeat;">

    <div class="container" style="z-index: 2;">
        <div class="row align-items-center ">
            <div class="col-lg-8  col-12 mt-4 pt-4">
                <h2 class="head-1 text-white">
                    Looking for a reliable partner in logistics and transportation?
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
                            <a class="info-box-black-transparent p-3 " href="tel:{{ $contact_details->mobile }}">
                                <i class="material-icons me-2">call</i>
                                {{ $contact_details->mobile }}
                            </a>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>
<section>
    <div class="container mt-5">
        <div class="row">
            <div class="col-md-5 d-flex align-items-center">
                <div>
                    <h2 class="head-2-5 text-secondary">Request A Quote!</h2>
                    <div class="sd-intro text-muted mt-4">Let us help you find the best solution for your logistics
                        needs.
                        Our
                        team is ready to provide a personalized quote tailored to your
                        requirements. Reach out today to experience reliable, efficient
                        service you can count on.</div>
                </div>
            </div>
            <div class="col-md-7">
                <div class="">
                    <!-- replace the empty CTA form with the contact form below -->
                    <form class="sd-contact-form" id="quote-form" action="{{route('contactus.submit')}}" method="post" novalidate>
                        @csrf
                        <div class="ajax-response mb-3" style="display:none;"></div> <!-- MESSAGE PLACEHOLDER -->
                        <div class="row g-3">
                            <div class="col-sm-6">
                                <label for="sd-name" class="form-label">Your Name <span
                                        class="text-danger">*</span></label>
                                <input id="sd-name" name="name" type="text" class="form-control"
                                    placeholder="Your name here" required>
                                <div class="invalid-feedback d-block quote-error" data-field="name"></div>
                            </div>
                            <div class="col-sm-6">
                                <label for="sd-email" class="form-label">Your Email <span
                                        class="text-danger">*</span></label>
                                <input id="sd-email" name="email" type="email" class="form-control"
                                    placeholder="Your email here" required>
                                <div class="invalid-feedback d-block quote-error" data-field="email"></div>
                            </div>

                            <div class="col-sm-6">
                                <label for="sd-subject" class="form-label">Your Subject <span
                                        class="text-danger">*</span></label>
                                <input id="sd-subject" name="subject" type="text" class="form-control"
                                    placeholder="Your subject here" required>
                                <div class="invalid-feedback d-block quote-error" data-field="subject"></div>
                            </div>
                            <div class="col-sm-6">
                                <label for="sd-phone" class="form-label">Contact Number <span
                                        class="text-danger">*</span></label>
                                <input id="sd-phone" name="phone" type="tel" class="form-control"
                                    placeholder="Your phone here" required>
                                <div class="invalid-feedback d-block quote-error" data-field="phone"></div>
                            </div>

                            <div class="col-12">
                                <label for="sd-message" class="form-label">Message <span
                                        class="text-danger">*</span></label>
                                <textarea id="sd-message" name="message" rows="3" class="form-control"
                                    placeholder="Tell us a few words" required></textarea>
                                <div class="invalid-feedback d-block quote-error" data-field="message"></div>
                            </div>

                            <div class="col-12 mt-4">
                                <button type="submit" class="btn btn-primary sd-submit">SEND MESSAGE</button>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</section>

@include('frontend.newsletter')
@include('frontend.footer')
@endsection