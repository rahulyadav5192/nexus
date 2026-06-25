<section class="py-4" style="background-color: #f0f4ff;">
    <div class="container">
        <div class="row align-items-center">
            <!-- Left: Text & Form -->
            <div class="col-lg-6 col-12 mb-4 mb-lg-0">
                <h2 class="head-2 text-secondary ">
                    Stay Ahead In Logistics
                </h2>
                <div class=" font-primary head-3 text-dark-light fw-bold mb-3">
                    Get the latest shipping trends, tips, and industry updates straight to your inbox.
                </div>
                <form class="subscribe-form" id="newsletter-form" method="POST">
                    @csrf
                    <div class="subscribe-input-wrapper w-100 d-flex flex-column flex-sm-row ">
                        <input type="email" name="email" id="newsletter-email" class="subscribe-input" placeholder="Your Email..." required>
                        <span class="material-icons subscribe-input-icon" style="color: #9ACBE8;">person</span>
                    </div>
                    <div class="mt-4">
                        <div class="newsletter-response" style="display: none; margin-bottom: 10px;"></div>
                        <button type="submit" class="btn btn-primary subscribe-btn">SUBSCRIBE NOW</button>
                    </div>
                </form>
            </div>
            <!-- Right: Illustration -->
            <div class="col-lg-6 col-12 d-lg-flex d-none justify-content-center">
                <img src="{{ asset('assets/img/newpapperboy.svg') }}"
                    alt="Subscribe Illustration"
                    class="subscribe-illustration">
            </div>
        </div>
    </div>
</section>