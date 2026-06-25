@extends('layouts.frontend')
@section('content')
<?php
// if (!isset($meta_tags)) {
    $tag            =   'Associates | Pro Global Logistics';
    $decsription    =   'Our trusted network of partners and associates at Pro Global Logistics. We work with leading air carriers, ocean carriers, and agents worldwide to deliver exceptional logistics solutions.';
// } else {
//     $tag            =   $meta_tags->tag;
//     $decsription    =   $meta_tags->description;
// }


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
                    <h1 class=" text-white head-1">Associates</h1>
                    <nav aria-label="breadcrumb">
                        <ol class="breadcrumb bg-transparent p-0 mb-0">
                            <li class="breadcrumb-item"><a href="{{route('home')}}">Home</a>
                            </li>
                            <li class="breadcrumb-item active" aria-current="page">Associates</li>
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

<!-- Associates Content Section -->
<section class="associates-content-section py-5">
    <div class="container">
        <!-- Agent Network -->
        <div class="row">
            <div class="col-md-6 col-12">
                <h2 class="head-2 head-underline text-primary mb-4">Agent Network<span
                        class="custom-underline"></span>
                </h2>

                <p>
                    At PGL, associates excel in building an extensive and reliable network of professional agents,
                    enabling
                    seamless logistics solutions across the globe. Our agent network is carefully selected to ensure
                    the
                    highest standards of service, compliance, and reliability. Through strategic partnerships and
                    continuous
                    collaboration, we deliver efficient and cost-effective logistics solutions that ensure timely,
                    secure,
                    and flexible cargo movement for our clients.
                </p>
                <div class="associates-logos mb-4">
                    <!-- <img src="assets/img/associates/ag-1.png" alt="WCA" class="associates-logo"> -->
                    <img src="assets/img/associates/ag-2.png" alt="FIATA" class="associates-logo">
                    <!-- <img src="assets/img/associates/ag-3.png" alt="UAE Freight" class="associates-logo"> -->
                </div>
            </div>
            <div class="col-md-6 col-12">
                <img src="assets/img/associates/map.png" alt="Agent Network" class="img-fluid rounded">

            </div>
        </div>


        <!-- Air Carrier -->

        <h2 class="head-2 head-underline text-primary mb-4">Air Carrier Partner <span class="custom-underline"></span>
        </h2>
        <p>
            At PGL, our team practices industry above all when it comes to air freight. Whether shipping on a
            scheduled service or charter, we leverage our relationships with leading airlines to offer competitive
            rates and reliable schedules. Our air carrier partners are selected for their proven track record in
            safety, compliance, and global reach. This enables us to provide flexible solutions for urgent
            shipments, temperature-sensitive items, and project cargo, helping our clients to deliver confidently
            worldwide.
        </p>
        <div class="associates-logos mb-4 mt-4">
            <img src="assets/img/associates/ac-1.png" alt="Qatar Airways" class="associates-logo">
            <img src="assets/img/associates/ac-2.png" alt="Emirates" class="associates-logo">
            <img src="assets/img/associates/ac-3.png" alt="Singapore Airlines" class="associates-logo">
            <img src="assets/img/associates/ac-4.png" alt="Lufthansa" class="associates-logo">
            <img src="assets/img/associates/ac-5.png" alt="Lufthansa" class="associates-logo">
            <img src="assets/img/associates/ac-6.png" alt="Lufthansa" class="associates-logo">
        </div>

        <!-- Ocean Carrier -->
        <h2 class="head-2 head-underline text-primary mb-4">Ocean Carrier Partner <span class="custom-underline"></span>
        </h2>
        <p>
            Our strategic partnerships with leading ocean carriers worldwide give us a comprehensive edge in pricing
            and space availability. Thanks to extensive carrier relationships, we offer flexible sailing schedules,
            competitive freight rates, and reliable transit times for FCL, LCL, and project cargo. Our ocean carrier
            network is built on trust and performance, ensuring that every shipment is handled with care and
            efficiency, regardless of destination.
        </p>
        <div class="associates-logos mb-4 mt-4">
           <img src="assets/img/associates/oc-5.png" alt="Hapag-Lloyd" class="associates-logo">
           <img src="assets/img/associates/oc-4.png" alt="Hapag-Lloyd" class="associates-logo">
            <img src="assets/img/associates/oc-2.png" alt="Maersk" class="associates-logo">
            <img src="assets/img/associates/oc-3.png" alt="MSC" class="associates-logo">
            
            
             <img src="assets/img/associates/oc-1.png" alt="CMA CGM" class="associates-logo">
        </div>
    </div>
</section>
@include('frontend.newsletter')
@include('frontend.footer')
@endsection