@extends('layouts.frontend')
@section('content')
<?php
if (!isset($meta_tags)) {
    $tag            =   'Contact Us | Pro Global Logistics';
    $decsription    =   'Get in touch with Pro Global Logistics. Contact us for all your logistics and transportation needs. We are here to help you with reliable and efficient solutions.';
} else {
    $tag            =   $meta_tags->tag;
    $decsription    =   $meta_tags->description;
}


?>

@section('title', $tag)
@section('meta_description', $decsription)
<section id="hero" class="hero-section position-relative"
    style="background-image: url('assets/img/service/hero.jpg'); min-height: 300px;  ">
    <!-- Navbar at top -->
    @include('frontend.nav')
    <!-- Hero Content -->
    <div class=" d-flex align-items-center" style="min-height: 300px; ">
        <div class="container" style="z-index: 2;">
            <div class="row align-items-center">
                <div class="col-lg-8 col-md-10">
                    <h1 class=" text-white head-1">Contact Us</h1>
                    <nav aria-label="breadcrumb">
                        <ol class="breadcrumb bg-transparent p-0 mb-0">
                            <li class="breadcrumb-item"><a href="{{route('home')}}">Home</a>
                            </li>
                            <li class="breadcrumb-item active" aria-current="page">Contact Us</li>
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

<section>
    <div class="container mt-5">
        <div class="row">
            <div class="col-md-6 d-flex align-items-center mt-4 mt-md-0">
                <div>
                    <h2 class="head-2-5 text-secondary" style="font-size: 42px;">Looking for a reliable logistics
                        partner?</h2>
                    <div class="sd-intro text-muted mt-4">We handle every step—from planning and implementation to
                        transportation, storage, and distribution—ensuring your goods move efficiently and
                        seamlessly, every time.</div>
                    <ul class="ca-contact-list list-unstyled mb-0 row">
                        <li class="col-md-6">
                            <div class="logo">
                                <span class="mi material-icons m-0">phone</span>
                            </div>

                            <div>
                                <span class="head">Phone Number</span>
                                <a href="tel:{{ $contact_details->mobile ?? '' }}">{{ $contact_details->mobile ?? '' }}</a>
                            </div>
                        </li>
                        <li class="col-md-6">
                            <div class="logo ">
                                <span class="mi material-icons m-0">email</span>
                            </div>

                            <div>
                                <span class="head">Email Address</span>
                                <a href="mailto:{{ $contact_details->email ?? '' }}">{{ $contact_details->email ?? '' }}</a>
                            </div>
                        </li>

                        <li>
                            <div class="logo">
                                <span class="mi material-icons m-0">place</span>
                            </div>

                            <div>
                                <span class="head">Address</span>
                                <a href="https://maps.app.goo.gl/bBt3ikj1dxjVF14V8">{{ $contact_details->address ?? '' }}</a>
                            </div>
                        </li>

                    </ul>
                    <!-- Social icons (paste inside .ca-social-icons) -->
                    <!--@if(isset($contact_details) && $contact_details && $contact_details->facebook)-->
                    <!--<div class=" ca-social-icons d-flex mt-4">-->
                    <!--    <a href="{{ $contact_details->facebook }}" target="_blank" class="ca-social-btn"-->
                    <!--        aria-label="Facebook">-->
                    <!--        <span class="ca-social-ic fab fa-facebook-f"></span>-->
                    <!--        <img src="assets/icons/Face.svg" alt="Facebook Icon" style="width: 16px; height: 16px;">-->
                    <!--    </a>-->
                    <!--</div>-->
                    <!--@endif-->
                </div>
            </div>
            <div class="col-md-6 mt-4 mt-md-0">
                <div class="">

                    <!-- replace the empty CTA form with the contact form below -->
                    <form class="sd-contact-form needs-validation" id="contact-form" name="" action="{{route('contactus.submit')}}" method="post" novalidate>
                        @csrf
                        <h2 class="head-2-6 text-secondary mb-5 mt-4">Get In Touch</h2>

                        <div class="ajax-response mb-3" style="display:none;"></div> <!-- MESSAGE PLACEHOLDER -->

                        <div class="row g-3">
                            <div class="col-sm-6">
                                <label for="sd-name" class="form-label">Your Name <span
                                        class="text-danger">*</span></label>
                                <input id="sd-name" name="name" type="text" class="form-control"
                                    placeholder="Your name here" required>
                                <div class="invalid-feedback">
                                    Please provide your name.
                                </div>
                            </div>
                            <div class="col-sm-6">
                                <label for="sd-email" class="form-label">Your Email <span
                                        class="text-danger">*</span></label>
                                <input id="sd-email" name="email" type="email" class="form-control"
                                    placeholder="Your email here" required>
                                <div class="invalid-feedback">
                                    Please provide a valid email address.
                                </div>
                            </div>

                            <div class="col-sm-6">
                                <label for="sd-subject" class="form-label"> Subject <span
                                        class="text-danger">*</span></label>
                                <input id="sd-subject" name="subject" type="text" class="form-control"
                                    placeholder="Subject here" required>
                                <div class="invalid-feedback">
                                    Please provide a subject.
                                </div>
                            </div>
                            <div class="col-sm-6">
                                <label for="sd-phone" class="form-label">Contact Number <span
                                        class="text-danger">*</span></label>
                                <input id="sd-phone" name="phone" type="tel" class="form-control"
                                    placeholder="Your phone here" required>
                                <div class="invalid-feedback">
                                    Please provide your contact number.
                                </div>
                            </div>

                            <div class="col-sm-6">
                                <label for="sd-country" class="form-label">Country <span
                                        class="text-danger">*</span></label>
                                <input id="sd-country" name="country" type="text" class="form-control"
                                    placeholder="Your country here" required>
                                <div class="invalid-feedback">
                                    Please provide your country.
                                </div>
                            </div>

                            <div class="col-sm-6">
                                <label for="sd-city" class="form-label">City <span
                                        class="text-danger">*</span></label>
                                <input id="sd-city" name="city" type="text" class="form-control"
                                    placeholder="Your city here" required>
                                <div class="invalid-feedback">
                                    Please provide your city.
                                </div>
                            </div>

                            <div class="col-12">
                                <label for="sd-message" class="form-label">Message <span
                                        class="text-danger">*</span></label>
                                <textarea id="sd-message" name="message" rows="3" class="form-control"
                                    placeholder="Tell us a few words" required></textarea>
                                <div class="invalid-feedback">
                                    Please provide a message.
                                </div>
                            </div>

                            <div class="col-12 mt-4">
                                <button type="submit" class="btn btn-primary sd-submit" id="contact-submit-btn">
                                    <span class="btn-text">SEND MESSAGE</span>
                                    <span class="btn-spinner spinner-border spinner-border-sm d-none" role="status" aria-hidden="true"></span>
                                </button>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</section>
<!-- <hr class="mt-5" /> -->

<section>
    <div class="container mt-5">
        <div class="row justify-content-center d-flexs">
            <div class="col-md-12">
                <!-- FAQ Section (paste inside .faq-section) -->
                <div class="faq-section">
                    <h2 class="head-2-5 mb-4">Frequently Asked Questions (FAQs)</h2>
                    <div class="faq-list">
                        <!-- FAQ Item 1 (expanded by default) -->
                        <div class="faq-item active">
                            <button class="faq-question" type="button">
                                <span class="faq-q-text  fw-bold">What types of freight and logistics
                                    services do you offer?</span>
                                <span class="faq-toggle-icon">–</span>
                            </button>
                            <div class="faq-answer show">
                                <div class="faq-answer-inner">
                                    <span>We offer a full range of services including:</span>
                                    <ul class="faq-bullet-list">
                                        <li>Air freight</li>
                                        <li>Sea freight (FCL/LCL)</li>
                                        <li>Road and rail transport</li>
                                        <li>Contract logistics</li>
                                        <li>Warehousing and inventory management</li>
                                        <li>Project and oversized cargo shipments</li>
                                    </ul>
                                </div>
                            </div>
                        </div>
                        <!-- FAQ Item 2 -->
                        <div class="faq-item">
                            <button class="faq-question" type="button">
                                <span class="faq-q-text">Do you handle international shipments?</span>
                                <span class="faq-toggle-icon">+</span>
                            </button>
                            <div class="faq-answer">
                                <div class="faq-answer-inner">
                                    Yes, we provide global logistics solutions for both import and export shipments.
                                </div>
                            </div>
                        </div>
                        <!-- FAQ Item 3 -->
                        <div class="faq-item">
                            <button class="faq-question" type="button">
                                <span class="faq-q-text">Can I ship personal items or trade-specific cargo?</span>
                                <span class="faq-toggle-icon">+</span>
                            </button>
                            <div class="faq-answer">
                                <div class="faq-answer-inner">
                                    Absolutely. We handle personal effects, commercial cargo, and specialized
                                    shipments.
                                </div>
                            </div>
                        </div>
                        <!-- FAQ Item 4 -->
                        <div class="faq-item">
                            <button class="faq-question" type="button">
                                <span class="faq-q-text">Still have questions?</span>
                                <span class="faq-toggle-icon">+</span>
                            </button>
                            <div class="faq-answer">
                                <div class="faq-answer-inner">
                                    Please contact our team for personalized assistance.
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

            </div>
            <!-- <div class="col-md-3 d-none d-md-block">
                    <img src="assets/img/contact/faq-img.svg" alt="Map" class="img-fluid rounded">
                </div> -->
        </div>
    </div>
</section>
<!-- Transporting Section (full width, image outside blue box, left text) -->
<section class="transporting-section py-0">
    <div class="container-fluid px-0">
        <div class="transporting-row position-relative">
            <div class="transporting-box  d-flex align-items-center">
                <div class="transporting-content px-4 py-4">
                    <h2 class="transporting-title mb-0 d-flex">
                        Transporting You With
                        <span class="transporting-highlight"> Speed,
                            Safety, And Reliability</span>
                    </h2>
                </div>
            </div>
            <div class="transporting-img-outer">
                <img src="assets/img/contact/cta.svg" alt="Delivery Person" class="transporting-img">
            </div>
        </div>
    </div>
</section>
<section class="map-section">

    <iframe
        src="https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d3609.3422947274685!2d55.28103317483841!3d25.225393530559074!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x3e5f433b7a0fecb3%3A0x1807d25205eae604!2sProglobal%20Logistics%20LLC!5e0!3m2!1sen!2sae!4v1758541035679!5m2!1sen!2sae"
        width="100%" height="500" style="border:0;" allowfullscreen="" loading="lazy"
        referrerpolicy="no-referrer-when-downgrade"></iframe>
</section>


<style>
    .required {
        color: red;
        font-size: 0.5vw;
    }
</style>
@include('frontend.footer')
@endsection