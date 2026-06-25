<footer class="footer-section pt-5 pb-3">
  <div class="container">
    <div class="row text-white">
      <!-- Logo & Social -->
      <div class="col-lg-4 col-md-6 mb-4">
        <a href="{{route('home')}}">
          <img src=" {{asset('assets/img/logo.svg')}}" alt="Pro Global Logistics" style="height:90px;">
        </a>
        <div class="mt-3 mb-2 footer-font-bold">
          We pride ourselves on providing the best transport and shipping services.
        </div>
        <!--<div class="footer-social d-flex gap-3 mt-3">-->
        <!--  @if(isset($contact_details) && $contact_details && $contact_details->facebook)-->
        <!--  <a href="{{ $contact_details->facebook }}" class="footer-social-icon" target="_blank" rel="noopener"><img-->
        <!--      src="{{asset('assets/icons/Face.svg')}}" alt="Facebook"></a>-->
        <!--  @endif-->
        <!--</div>-->
      </div>
      <!-- Quick Links -->
      <div class="col-lg-2 col-md-6 mb-4">
        <div class="footer-title fw-bold mb-3">Quick Links</div>
        <ul class="footer-list list-unstyled">
          <li><a href="{{route('home')}}">Home</a></li>
          <li><a href="{{route('about')}}">About Us</a></li>
          <li><a href="{{route('services')}}">Services</a></li>
          <li><a href="{{route('careers')}}">Careers</a></li>
          <li><a href="{{route('contactus')}}">Contact Us</a></li>
          <li><a href="{{route('blogs')}}">Blogs</a></li>
        </ul>
      </div>
      <!-- Services -->
      <div class="col-lg-3 col-md-6 mb-4">
        <div class="footer-title fw-bold mb-3">Services</div>
        <ul class="footer-list list-unstyled">

          <li><a href="<?= url('service-detail/ocean-freight') ?>">Ocean Freight</a></li>
          <li><a href="<?= url('service-detail/air-freight') ?>">Air Freight</a></li>
          <li><a href="<?= url('service-detail/land-freight') ?>">Land Freight</a></li>
          <li><a href="<?= url('service-detail/customs-clearance') ?>">Customs Clearance</a></li>
          <li><a href="<?= url('service-detail/warehousing') ?>">Warehousing</a></li>
          <li><a href="<?= url('service-detail/project-handling') ?>">Project Handling</a></li>

        </ul>
      </div>
      <!-- Contact -->
      <div class="col-lg-3 col-md-6 mb-4">
        <div class="footer-title fw-bold mb-3">Contact</div>
        <ul class="footer-list list-unstyled">
          @if(isset($contact_details) && $contact_details)
          <li>
            <!-- <a href="adsf"> -->
            <span class="material-icons" style="font-size:14px;vertical-align:middle;">email</span>
            <a href="mailto:{{ $contact_details->email ?? '' }}">{{ $contact_details->email ?? '' }}</a>
            <!-- </a> -->
          </li>
          <li class="align-items-start">
            <span class="material-icons" style="font-size:14px;vertical-align:middle;">location_on</span>
            <a href="https://maps.app.goo.gl/bBt3ikj1dxjVF14V8">{{ $contact_details->address ?? '' }}</a>
          </li>
          <li>
            <span class="material-icons" style="font-size:14px;vertical-align:middle;">phone</span>
            <a href="tel:{{ $contact_details->mobile ?? '' }}">{{ $contact_details->mobile ?? '' }}</a>
          </li>
          @endif
        </ul>
      </div>
    </div>
    <div class="footer-bottom d-flex justify-content-between align-items-center pt-3 mt-4 border-top"
      style="border-color:rgba(255,255,255,0.15)!important;">
      <div class="footer-copyright text-white-50">
        Copyright © {{date('Y')}} <span style="color:#9ACBE8;">Pro Global Logistics</span>. All Rights Reserved.
      </div>
    </div>
  </div>
</footer>