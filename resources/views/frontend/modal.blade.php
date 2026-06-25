<!-- Modal -->
<div class="modal fade" id="quoteModal" tabindex="-1" aria-hidden="true">
    <div class="modal-dialog modal-xl modal-dialog-centered rounded-lg">
        <div class="modal-content">
            <div class="modal-body p-0 d-flex flex-column flex-lg-row">

                <!-- Left side image -->
                <div class="col-lg-6 d-none d-lg-block">
                    <img src="https://images.pexels.com/photos/262353/pexels-photo-262353.jpeg" alt="Shipping"
                        class="img-fluid h-100 w-100" style="object-fit: cover;">
                </div>

                <!-- Right side form -->
                <div class="col-lg-6">
                    <form class="sd-contact-form" id="home-quote-form" action="{{ route('contactus.submit') }}" method="post" novalidate>
                        @csrf
                        <h2 class="head-2-6 mb-3 mt-4">Get an Instant <span class="text-primary">Quote</span></h2>

                        <div class="ajax-response mb-3" style="display:none;"></div>

                        <div class="row g-3">
                            <div class="col-sm-6">
                                <label for="hq-name" class="form-label">Your Name <span
                                        class="text-danger">*</span></label>
                                <input id="hq-name" name="name" type="text" class="form-control"
                                    placeholder="Your name here" required>
                            </div>
                            <div class="col-sm-6">
                                <label for="hq-email" class="form-label">Your Email <span
                                        class="text-danger">*</span></label>
                                <input id="hq-email" name="email" type="email" class="form-control"
                                    placeholder="Your email here" required>
                            </div>

                            <div class="col-sm-6">
                                <label for="hq-subject" class="form-label">Your Subject <span
                                        class="text-danger">*</span></label>
                                <input id="hq-subject" name="subject" type="text" class="form-control"
                                    placeholder="Your subject here" required>
                            </div>
                            <div class="col-sm-6">
                                <label for="hq-phone" class="form-label">Contact Number</label>
                                <input id="hq-phone" name="phone" type="tel" class="form-control"
                                    placeholder="Your phone here">
                            </div>

                            <div class="col-12">
                                <label for="hq-message" class="form-label">Message <span
                                        class="text-danger">*</span></label>
                                <textarea id="hq-message" name="message" rows="3" class="form-control"
                                    placeholder="Tell us a few words" required></textarea>
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
</div>