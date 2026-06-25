@extends('layouts.frontend')
@section('content')
<?php
if (!isset($meta_tags)) {
    $tag            =   'About Us | Pro Global Logistics';
    $decsription    =   'Learn about Pro Global Logistics, your trusted partner for comprehensive logistics and transportation solutions worldwide. Discover our history, values, and commitment to excellence.';
} else {
    $tag            =   $meta_tags->tag;
    $decsription    =   $meta_tags->description;
}


?>

@section('title', $tag)
@section('meta_description', $decsription)
<section id="hero" class="hero-section position-relative"
    style="background-image: url('assets/img/service/hero.jpg'); min-height: 300px;">
    <!-- Navbar at top -->
    @include('frontend.nav')
    <!-- Hero Content -->
    <div class=" d-flex align-items-center" style="min-height: 300px; ">
        <div class="container" style="z-index: 2;">
            <div class="row align-items-center">
                <div class="col-lg-8 col-md-10">
                    <h1 class=" text-white head-1">About Us</h1>
                    <nav aria-label="breadcrumb">
                        <ol class="breadcrumb bg-transparent p-0 mb-0">
                            <li class="breadcrumb-item"><a href="{{route('home')}}">Home</a>
                            </li>
                            <li class="breadcrumb-item active">About Us</li>
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



<section class="journey-section py-5">
    <div class="container">
        <div class="row align-items-center">
            <!-- Left: Text with bullets -->
            <div class="col-lg-6 col-12 mb-4 mb-lg-0">
                <h2 class="fw-bold text-secondary head-2">
                    Our Journey
                </h2>
                <ul class="journey-list mt-4">
                    <li>Pro Global Logistics was incorporated in 2007 in Dubai, United Arab Emirates </li>
                    <li>Founded by two seasoned logistics professionals, PGL has rapidly grown into a leading
                        logistics provider globally.</li>
                    <li>With a skilled and dedicated team, PGL meets tight deadlines and delivers efficient &
                        effective logistic support at every stage.</li>
                    <li>Local market knowledge and expertise is our strength in addition to a global network of
                        reputed agents/associates.</li>
                </ul>
            </div>
            <!-- Right: Overlapping Images -->
            <div class="col-lg-6 col-12 d-flex justify-content-center">
                <div class="journey-images position-relative">
                    <img src="{{asset('assets/img/about/section1.png')}} " alt="Logistics" class="journey-img-main">
                    <img src="{{asset('assets/img/about/section1-1.png')}} " alt="Dubai" class="journey-img-overlap">
                </div>
            </div>
        </div>
    </div>
</section>

<section class="about-stats-section position-relative my-5">
    <div class="about-stats-bg"></div>
    <div class="container position-relative">
        <div class="row justify-content-center text-center">
            <div class="col-md-4 mb-4 mb-md-0">
                <div class="about-stats-icon mb-3">
                    <img src="{{asset('assets/icons/Great.svg')}} " alt="Great" />
                </div>
                <div class="about-stats-number">18 +</div>
                <div class="about-stats-label">Years of Experience</div>
            </div>
            <div class="col-md-4 mb-4 mb-md-0">
                <div class="about-stats-icon mb-3">
                    <img src="{{asset('assets/icons/Travel.svg')}} " alt="Travel" />
                </div>
                <div class="about-stats-number">100 +</div>
                <div class="about-stats-label">Countries Served Worldwide</div>
            </div>
            <div class="col-md-4">
                <div class="about-stats-icon mb-3">
                    <img src="{{asset('assets/icons/People.svg')}} " alt="People" />
                </div>
                <div class="about-stats-number">200 +</div>
                <div class="about-stats-label">Satisfied Clients</div>
            </div>
        </div>
    </div>
</section>

<!-- How We Operate Section -->
<section class="operate-section py-1">
    <div class="container">
        <h2 class="text-secondary fw-bold text-center mb-2 " style="font-size:2rem;">How We Operate
            Unveiling Our
            Logistics Process</h2>
        <p class="text-secondary text-dark-light mb-4" style="font-size:1.05rem;">
            At Pro Global Logistics (PGL), we have spent years refining our processes and investing in cutting-edge
            IT systems to deliver seamless, reliable solutions to our clients. Our automated Business Process
            Management System (BPMS) ensures consistent service excellence and adds measurable value. Key features
            include:
        </p>
        <div class="row justify-content-center g-4 mb-4">
            <div class="col-md-4 col-12 text-center mt-5">
                <div class="operate-icon mb-2"><img src="{{asset('assets/icons/Clock.svg')}}" alt="Track & Trace"></div>
                <div class="operate-desc text-black">Timely updates on shipment through PGL Track & Trace</div>
            </div>
            <div class="col-md-4 col-12 text-center mt-5">
                <div class="operate-icon mb-2"><img src="{{asset('assets/icons/Speaker.svg')}}" alt="Alerts"></div>
                <div class="operate-desc text-black">Notifications and alerts on every operational milestone of the
                    shipment as a proactive email</div>
            </div>
            <div class="col-md-4 col-12 text-center mt-5">
                <div class="operate-icon mb-2"><img src="{{asset('assets/icons/Lock.svg')}}" alt="Portal"></div>
                <div class="operate-desc text-black">Customer portal which will give you a secure access to your
                    shipment
                    related information</div>
            </div>
            <div class="col-md-4 col-12 text-center mt-5">
                <div class="operate-icon mb-2"><img src="{{asset('assets/icons/Integration.svg')}}" alt="EDI"></div>
                <div class="operate-desc text-black">The integration with port and customs via the EDI systems</div>
            </div>
            <div class="col-md-4 col-12 text-center mt-5">
                <div class="operate-icon mb-2"><img src="{{asset('assets/icons/Shakehand.svg')}}" alt="Documents"></div>
                <div class="operate-desc text-black">Processing of all shipping documents such as Bill of Lading,
                    Airway
                    bill ensure accuracy in processing the electronic data pertaining to your merchandise</div>
            </div>
            <div class="col-md-4 col-12 text-center mt-5">
                <div class="operate-icon mb-2"><img src="{{asset('assets/icons/Great.svg')}}" alt="Automated"></div>
                <div class="operate-desc text-black">The automated systems ensure availability of the our services
                    24x7
                    on a self help model</div>
            </div>
        </div>
    </div>
</section>

<!-- Leadership Section -->
<section class="leadership-section py-5">
    <div class="container">
        <!-- Partner 1: Text left, image right -->

        <div
            class="leader-card-box leader-card-top-left bg-white rounded-4 shadow-sm p-4 h-100 row align-items-center justify-content-center mb-5 ">
            <div class="col-lg-8 col-12 mb-4 mb-lg-0">
                <h2 class="fw-bold mb-1" style="color:#19799f; font-size:2.1rem;">Sarkar Chauhan</h2>
                <div class="leader-role fw-bold mb-2" style="font-size:1.2rem; color:#222;">Managing Partner
                </div>
                <div class="leader-desc" style="font-size:1.08rem; color:#222;">
                    Sarkar Chauhan, Managing Partner of PGL, is a seasoned logistics expert with decades of
                    industry experience. Before founding M/S Pro Global Logistics in 2007, he held key roles at
                    leading MNCs like DB Schenker, UTI(DSV), and Kuehne+Nagel. He brings deep expertise in
                    freight forwarding, a client-focused mindset, and a strong problem-solving approach. His
                    leadership emphasizes service excellence, strategic guidelines, and quality human
                    resources.
                </div>
            </div>
            <div class="col-lg-4 col-12 d-flex justify-content-center">
                <div class="leader-img-box">
                    <img src="{{asset('assets/img/about/partner-1.png')}}" alt="Sarkar Chauhan" class="leader-img-main" />
                </div>
            </div>
        </div>
        <!-- Partner 2: Image left, text right -->
        <div class=" align-items-center justify-content-center flex-lg-row flex-column-reverse">


            <div class=" row leader-card-box leader-card-bottom-right bg-white rounded-4 shadow-sm p-4 h-100">
                <div class="col-lg-4 col-12 d-flex justify-content-center mb-4 mb-lg-0">
                    <div class="leader-img-box">
                        <img src="{{asset('assets/img/about/partner-2.png')}}" alt="Arjun Kohli" class="leader-img-main" />
                    </div>
                </div>
                <div class="col-lg-8 col-12">
                    <h2 class="fw-bold mb-1" style="color:#19799f; font-size:2.1rem;">Arjun Kohli</h2>
                    <div class="leader-role fw-bold mb-2" style="font-size:1.2rem; color:#222;">Managing Partner
                    </div>
                    <div class="leader-desc" style="font-size:1.08rem; color:#222;">
                        Arjun Kohli, a business graduate with a master's in Economics, began his logistics career
                        in Dubai in 1992 with British firm Sterling Gulf Services. Over the years, he held key
                        roles in sales and key account management with top European freight companies, including
                        a long tenure at Kuehne & Nagel. With extensive experience in business development and
                        client management, he co-founded Pro Global Logistics (PGL) in 2007. Backed by a strong
                        team and loyal clientele, he remains committed to positioning PGL as a global leader in
                        freight and logistics.
                    </div>
                </div>

            </div>
        </div>
    </div>
</section>

<!-- Key Clients Section -->
<section class="clients-section py-5">
    <div class="container">
        <h2 class="text-center fw-bold mb-4 text-secondary head-2-6">Our Key Clients</h2>
        <div class="clients-slider mt-5">
            <!-- Slider rows will be injected here -->
        </div>
    </div>
</section>
@include('frontend.newsletter')
@include('frontend.footer')


<script>
    fetch('assets/data/clients.json')
        .then(res => res.json())
        .then(data => {
            const sliderContainer = document.querySelector('.clients-slider');

            const chunkSize = Math.ceil(data.length / 3);
            const directions = ['right', 'left', 'right']; // top, middle, bottom

            for (let i = 0; i < 3; i++) {
                const chunk = data.slice(i * chunkSize, (i + 1) * chunkSize);
                const row = document.createElement('div');
                row.classList.add('client-row', 'd-flex', 'gap-3', `scroll-${directions[i]}`);

                // Duplicate the logos for seamless loop
                const logos = [...chunk, ...chunk];

                logos.forEach(client => {
                    const div = document.createElement('div');
                    div.className = 'client-logo flex-shrink-0';
                    div.style.width = '120px';
                    div.innerHTML = `<img src="${client.logo}" alt="${client.name}" class="img-fluid">`;
                    row.appendChild(div);
                });

                sliderContainer.appendChild(row);
            }
        });
</script>


@endsection