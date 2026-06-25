 <section id="hero" class="hero-section position-relative" style="background-image: url('{{ isset($banner) && $banner ? asset('uploads/banners/' . $banner->image) : asset('assets/img/service/hero.jpg') }}')">
   <!-- Navbar at top -->

   @include('frontend.nav')

   <!-- Hero Content -->
   <div class=" d-flex align-items-center " style="min-height: 100%; height: 82vh;">
     <div class=" container" style="z-index: 2;">
       <div class="row align-items-center">
         <div class="col-md-10 col-lg-10 align-items-center">
          <h1 class="head-1 text-white mb-4 fw-800"><?= isset($banner) && $banner ? $banner->title_en : 'Welcome' ?></h1>
           <button data-bs-toggle="modal" data-bs-target="#quoteModal" class="btn btn-primary">Get
             Started</button>
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