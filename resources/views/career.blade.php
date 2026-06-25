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
                    <h1 class=" text-white head-1">Career</h1>
                    <nav aria-label="breadcrumb">
                        <ol class="breadcrumb bg-transparent p-0 mb-0">
                            <li class="breadcrumb-item"><a href="{{route('home')}}">Home</a>
                            </li>
                            <li class="breadcrumb-item active" aria-current="page">Career</li>
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
<!-- Career Opportunities Section (below hero) -->
<section class="career-opportunities-section py-5">
    <div class="container">
        <h2 class="head-2-5 text-secondary text-center">Great People Deserve Great Opportunities</h2>
        <p class=" text-dark-light text-center mb-5">
            We offer a vibrant, multicultural work environment for logistics professionals with the passion to
            innovate
            and grow. We take pride in our dedicated team—many of whom have been with us since day one. As our
            business expands, we’re excited to welcome new talent to grow with us and shape the future of logistics
            together.
        </p>

        <div class="text-primary text-center">
            <span class="career-link">Looking for a Career in Logistics?</span>
        </div>
        <h2 class="head-2-5 text-secondary text-center mb-2">Become a Part of Our Big Family.</h2>
        <p class=" text-dark-light text-center mb-5">
            If you are ready and interested in joining to our team, then send your application to the head office of
            Pro Global Logistics. Or, if you are geographically mobile and want to apply for the company’s Pro
            Global Logistics Track International program instead, then send your CV and covering letter to our
            Corporate Human Resources department via <a href="mailto:info@pgldubai.com"
                class="text-primary">info@pgldubai.com</a>.
        </p>

        <h2 class="head-2-5 text-secondary text-center mb-4">We’re Hiring</h2>


        <div class="career-positions-list">
            <!-- Position 1 -->
            <div class="career-positions-list">
                @foreach($career as $job)
                <div class="career-position-card {{ $loop->first ? 'active' : '' }}">
                    <button class="career-position-toggle {{ $loop->first ? 'career-toggle-active' : '' }}" type="button">
                        <span>{{ $job->name }}</span>
                        <span class="career-toggle-icon material-icons">{{ $loop->first ? 'expand_more' : 'chevron_right' }}</span>
                    </button>
                    <div class="career-position-details {{ $loop->first ? 'show' : '' }}">
                        <div class="career-details-content p-4">
                            <h5 class="head-4 mb-2">{{ $job->name }}</h5>
                            <p class="text-dark-light mb-3"> <?= $job->description ?> </p>
                            <div class="row">
                                <div class="career-skills-list mb-3 col-md-6 ps-2">
                                    <?= $job->skills ?>
                                </div>

                                <div class="col-md-6">
                                    <form class="sd-contact-form" id="job-application-form-{{ $job->id }}" method="post" enctype="multipart/form-data">
                                        @csrf
                                        <input type="hidden" name="career_id" value="{{ $job->id }}">
                                        <div class="row g-3">
                                            <div class="col-sm-6">
                                                <label for="sd-name-{{ $job->id }}" class="form-label">Your Name <span class="text-danger">*</span></label>
                                                <input id="sd-name-{{ $job->id }}" name="name" type="text" class="form-control" placeholder="Your name here" required />
                                            </div>
                                            <div class="col-sm-6">
                                                <label for="sd-email-{{ $job->id }}" class="form-label">Your Email <span class="text-danger">*</span></label>
                                                <input id="sd-email-{{ $job->id }}" name="email" type="email" class="form-control" placeholder="Your email here" required />
                                            </div>
                                            <div class="col-sm-6">
                                                <label for="sd-phone-{{ $job->id }}" class="form-label">Phone Number <span class="text-danger">*</span></label>
                                                <input id="sd-phone-{{ $job->id }}" name="phone" type="text" class="form-control" placeholder="Phone Number" required />
                                            </div>
                                            <div class="col-md-6 col-12">
                                                <label for="sd-resume-{{ $job->id }}" class="form-label">Resume <span class="text-danger">*</span></label>
                                                <div class="custom-file-upload">
                                                    <input id="sd-resume-{{ $job->id }}" name="resume" type="file" accept=".pdf,.doc,.docx" class="file-input" required />
                                                    <label for="sd-resume-{{ $job->id }}" class="file-upload-btn">
                                                        <span class="material-icons">upload_file</span>
                                                        <span class="file-text">Choose CV/Resume</span>
                                                    </label>
                                                    <span class="file-name text-muted">No file selected</span>
                                                </div>
                                            </div>
                                            <div class="col-12 mt-3">
                                                <div class="ajax-response mb-3" style="display:none;"></div>
                                            </div>
                                            <div class="col-12 mt-4">
                                                <button type="submit" class="btn btn-primary sd-submit">
                                                    {{ $job->button_text ?? 'APPLY NOW' }}
                                                </button>
                                            </div>
                                        </div>
                                    </form>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                @endforeach
            </div>

        </div>

    </div>
</section>


@include('frontend.newsletter')
@include('frontend.footer')

<script>
$(document).ready(function() {
    $('.sd-contact-form').on('submit', function(e) {
        e.preventDefault();
        
        var form = $(this);
        var submitBtn = form.find('.sd-submit');
        var responseDiv = form.find('.ajax-response');
        var originalBtnText = submitBtn.html();
        
        // Disable submit button
        submitBtn.prop('disabled', true).text('Submitting...');
        responseDiv.hide().removeClass('text-success text-danger');
        
        var formData = new FormData(this);
        
        $.ajax({
            type: "POST",
            url: "{{ url('/job-application/submit') }}",
            data: formData,
            processData: false,
            contentType: false,
            success: function(response) {
                var successHtml = '<div class="alert alert-success mb-0" role="alert">';
                successHtml += '<strong><i class="material-icons" style="vertical-align: middle; font-size: 18px;">check_circle</i> Success:</strong> ';
                successHtml += (response.message || 'Your application has been submitted successfully!');
                successHtml += '</div>';
                
                responseDiv.removeClass('text-danger alert-danger').addClass('text-success alert-success').html(successHtml).show();
                form[0].reset();
                
                // Reset file upload display
                form.find('.file-name').text('No file selected').addClass('text-muted');
                form.find('.file-text').text('Choose CV/Resume');
                form.find('.custom-file-upload').removeClass('has-file');
                
                // Scroll to success message
                $('html, body').animate({
                    scrollTop: responseDiv.offset().top - 100
                }, 500);
                
                setTimeout(() => {
                    responseDiv.fadeOut();
                }, 5000);
            },
            error: function(xhr) {
                var errorMessage = '';
                var errorHtml = '';
                
                // Handle validation errors (422 status)
                if (xhr.status === 422 && xhr.responseJSON && xhr.responseJSON.errors) {
                    errorHtml = '<div class="alert alert-danger mb-0" role="alert">';
                    errorHtml += '<strong><i class="material-icons" style="vertical-align: middle; font-size: 18px;">error</i> Validation Error:</strong><ul class="mb-0 mt-2">';
                    
                    $.each(xhr.responseJSON.errors, function(field, messages) {
                        $.each(messages, function(index, message) {
                            // Format field name for display
                            var fieldName = field.replace(/_/g, ' ').replace(/\b\w/g, function(l) { return l.toUpperCase(); });
                            errorHtml += '<li>' + message + '</li>';
                        });
                    });
                    
                    errorHtml += '</ul></div>';
                } 
                // Handle other errors
                else if (xhr.responseJSON && xhr.responseJSON.message) {
                    errorHtml = '<div class="alert alert-danger mb-0" role="alert">';
                    errorHtml += '<strong><i class="material-icons" style="vertical-align: middle; font-size: 18px;">error</i> Error:</strong> ';
                    errorHtml += xhr.responseJSON.message;
                    errorHtml += '</div>';
                } 
                // Handle plain text errors
                else if (xhr.responseText) {
                    try {
                        var errorData = JSON.parse(xhr.responseText);
                        if (errorData.message) {
                            errorHtml = '<div class="alert alert-danger mb-0" role="alert">';
                            errorHtml += '<strong><i class="material-icons" style="vertical-align: middle; font-size: 18px;">error</i> Error:</strong> ';
                            errorHtml += errorData.message;
                            errorHtml += '</div>';
                        }
                    } catch(e) {
                        errorHtml = '<div class="alert alert-danger mb-0" role="alert">';
                        errorHtml += '<strong><i class="material-icons" style="vertical-align: middle; font-size: 18px;">error</i> Error:</strong> ';
                        errorHtml += 'An error occurred. Please try again.';
                        errorHtml += '</div>';
                    }
                } 
                // Default error message
                else {
                    errorHtml = '<div class="alert alert-danger mb-0" role="alert">';
                    errorHtml += '<strong><i class="material-icons" style="vertical-align: middle; font-size: 18px;">error</i> Error:</strong> ';
                    errorHtml += 'An error occurred. Please try again.';
                    errorHtml += '</div>';
                }
                
                responseDiv.removeClass('text-success alert-success').addClass('text-danger alert-danger').html(errorHtml).show();
                
                // Scroll to error message
                $('html, body').animate({
                    scrollTop: responseDiv.offset().top - 100
                }, 500);
            },
            complete: function() {
                submitBtn.prop('disabled', false).html(originalBtnText);
            }
        });
    });
});
</script>

@endsection