<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <meta name="csrf-token" content="{{ csrf_token() }}">
  <title>@yield('title', 'Pro Global Logistics')</title>
  <meta name="description" content="@yield('meta_description', 'Pro Global Logistics - Your trusted partner for comprehensive logistics and transportation solutions worldwide.')">
  <meta name="keywords" content="@yield('meta_keywords', 'logistics, freight forwarding, shipping, transportation, cargo, Dubai, UAE')">
  
  <!-- Open Graph / Facebook -->
  <meta property="og:type" content="website">
  <meta property="og:url" content="{{ url()->current() }}">
  <meta property="og:title" content="@yield('title', 'Pro Global Logistics')">
  <meta property="og:description" content="@yield('meta_description', 'Pro Global Logistics - Your trusted partner for comprehensive logistics and transportation solutions worldwide.')">
  <meta property="og:image" content="@yield('og_image', asset('assets/img/logo.svg'))">
  
  <!-- Twitter -->
  <meta property="twitter:card" content="summary_large_image">
  <meta property="twitter:url" content="{{ url()->current() }}">
  <meta property="twitter:title" content="@yield('title', 'Pro Global Logistics')">
  <meta property="twitter:description" content="@yield('meta_description', 'Pro Global Logistics - Your trusted partner for comprehensive logistics and transportation solutions worldwide.')">
  <meta property="twitter:image" content="@yield('og_image', asset('assets/img/logo.svg'))">
  
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet"
    integrity="sha384-T3c6CoIi6uLrA9TneNEoa7RxnatzjcDSCmG1MXxSR1GAsXEV/Dwwykc2MPK8M2HN" crossorigin="anonymous">
  <link rel="stylesheet" href="{{ asset('assets/styles.css') }}">
  <link rel="icon" type="image/x-icon" href="{{ asset('assets/icons/favicon.ico') }}">
  <link href="https://fonts.googleapis.com/icon?family=Material+Icons" rel="stylesheet">
  <link href="https://fonts.googleapis.com/css2?family=Plus+Jakarta+Sans:wght@400;500;700&display=swap"
    rel="stylesheet">
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js" crossorigin="anonymous"></script>
    <script src="https://code.jquery.com/jquery-3.7.0.min.js"></script>
</head>


<body>

  @yield('content')





</body>

<!-- JAVASCRIPT  FILES ========================================= -->

<script src="{{asset('JS/main.js')}}"></script>
<script src="{{asset('JS/sliders.js')}}"></script>

<script>
  $(document).ready(function() {
    // Handle contact form
    $('#contact-form').on('submit', function(e) {
      var form = $(this)[0];
      var $form = $(this);
      
      // Check form validity
      if (!form.checkValidity()) {
        e.preventDefault();
        e.stopPropagation();
        $form.addClass('was-validated');
        return false;
      }
      
      e.preventDefault(); // Stop normal submission

      var responseDiv = $form.find('.ajax-response');
      var submitBtn = $form.find('#contact-submit-btn');
      var btnText = submitBtn.find('.btn-text');
      var btnSpinner = submitBtn.find('.btn-spinner');

      // Show loading state
      submitBtn.prop('disabled', true);
      btnText.text('SENDING...');
      btnSpinner.removeClass('d-none');
      responseDiv.hide();

      $.ajax({
        type: "POST",
        url: $form.attr('action'),
        data: new FormData($form[0]),
        processData: false,
        contentType: false,
        headers: {
          'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
        },
        success: function(response) {
          // Hide loading state
          submitBtn.prop('disabled', false);
          btnText.text('SEND MESSAGE');
          btnSpinner.addClass('d-none');

          if (response.success) {
            responseDiv.removeClass("text-danger alert-danger").addClass("text-success alert alert-success").html(response.message).show();
            $form[0].reset();
            $form.removeClass('was-validated'); // Remove validation classes on success
            setTimeout(() => responseDiv.fadeOut(), 5000);
          } else {
            responseDiv.removeClass("text-success alert-success").addClass("text-danger alert alert-danger").html(response.message).show();
            setTimeout(() => responseDiv.fadeOut(), 5000);
          }
        },
        error: function(xhr) {
          // Hide loading state
          submitBtn.prop('disabled', false);
          btnText.text('SEND MESSAGE');
          btnSpinner.addClass('d-none');

          var errorMessage = 'An error occurred. Please try again.';
          if (xhr.responseJSON) {
            if (xhr.responseJSON.errors) {
              // Handle validation errors
              var errorList = '<ul class="mb-0">';
              $.each(xhr.responseJSON.errors, function(key, errors) {
                $.each(errors, function(index, error) {
                  errorList += '<li>' + error + '</li>';
                });
              });
              errorList += '</ul>';
              errorMessage = xhr.responseJSON.message || 'Validation errors:' + errorList;
            } else if (xhr.responseJSON.message) {
              errorMessage = xhr.responseJSON.message;
            }
          }
          responseDiv.removeClass("text-success alert-success").addClass("text-danger alert alert-danger").html(errorMessage).show();
          setTimeout(() => responseDiv.fadeOut(), 5000);
        }
      });
    });

    // Handle quote form (Request A Quote on service detail page)
    $('#quote-form').on('submit', function(e) {
      e.preventDefault(); // Stop normal submission

      var form = $(this);
      var formEl = form[0];
      var submitBtn = form.find('button[type="submit"]');
      var originalText = submitBtn.html();
      var responseDiv = form.find(".ajax-response");
      
      // Clear previous messages and field errors
      responseDiv.removeClass("text-danger text-success").hide().html('');
      form.find('.quote-error').text('');
      form.find('.form-control').removeClass('is-invalid');
      
      // Client-side HTML5 validation
      if (!formEl.checkValidity()) {
        form.addClass('was-validated');
        return;
      } else {
        form.removeClass('was-validated');
      }
      
      // Disable button and show loading
      submitBtn.prop('disabled', true).html('Sending...');

      // Create FormData and ensure CSRF token is included
      var formData = new FormData(this);
      var csrfToken = $('meta[name="csrf-token"]').attr('content');
      if (csrfToken) {
        formData.append('_token', csrfToken);
      }

      $.ajax({
        type: "POST",
        url: form.attr('action'),
        data: formData,
        processData: false,
        contentType: false,
        success: function(response) {
          // Normalize response (JSON or plain text)
          var success = false;
          var message = '';

          if (typeof response === 'object') {
            success = !!response.success;
            message = response.message || (success ? 'Thank you! Your request has been submitted.' : 'Something went wrong.');
          } else {
            // Fallback for plain text
            success = true;
            message = response;
          }

          if (success) {
            responseDiv
              .removeClass("text-danger alert-danger")
              .addClass("text-success alert alert-success")
              .html(message)
              .show();

            form[0].reset(); // Reset form
            form.removeClass('was-validated');
          } else {
            responseDiv
              .removeClass("text-success alert-success")
              .addClass("text-danger alert alert-danger")
              .html(message)
              .show();
          }

          setTimeout(() => responseDiv.fadeOut(), 5000);
        },
        error: function(xhr, status, error) {
          console.error('Quote form error:', {
            status: xhr.status,
            statusText: xhr.statusText,
            responseText: xhr.responseText,
            error: error
          });
          
          var errorMessage = 'An error occurred. Please try again.';
          
          // Handle different error types
          if (xhr.status === 419) {
            errorMessage = 'Session expired. Please refresh the page and try again.';
          } else if (xhr.status === 422 && xhr.responseJSON && xhr.responseJSON.errors) {
            // Show validation errors below each input
            var firstErrorField = null;
            $.each(xhr.responseJSON.errors, function(key, messages) {
              var field = form.find('[name="' + key + '"]');
              var errorContainer = form.find('.quote-error[data-field="' + key + '"]');
              if (field.length) {
                field.addClass('is-invalid');
              }
              if (errorContainer.length) {
                errorContainer.text(messages[0]);
              }
              if (!firstErrorField && field.length) {
                firstErrorField = field;
              }
            });
            
            if (firstErrorField) {
              $('html, body').animate({
                scrollTop: firstErrorField.offset().top - 120
              }, 400);
            }
            
            // Do not show global error if field-level shown
            return;
          } else if (xhr.responseJSON && xhr.responseJSON.message) {
            errorMessage = xhr.responseJSON.message;
          } else if (xhr.responseText) {
            // Try to parse as JSON
            try {
              var errorData = JSON.parse(xhr.responseText);
              if (errorData.message) {
                errorMessage = errorData.message;
              }
            } catch(e) {
              // If not JSON, use response text if it's short
              if (xhr.responseText.length < 200) {
                errorMessage = xhr.responseText;
              }
            }
          }
          
          responseDiv.removeClass("text-success").addClass("text-danger").html(errorMessage).show();
          setTimeout(() => responseDiv.fadeOut(), 5000);
        },
        complete: function() {
          // Re-enable button
          submitBtn.prop('disabled', false).html(originalText);
        }
      });
    });

    // Handle home hero quote modal form (same as contact us submission)
    $('#home-quote-form').on('submit', function(e) {
      e.preventDefault();

      var form = $(this);
      var responseDiv = form.find('.ajax-response');
      var submitBtn = form.find('button[type="submit"]');
      var originalText = submitBtn.html();

      responseDiv.removeClass('text-danger text-success alert-danger alert-success').hide().html('');
      submitBtn.prop('disabled', true).html('Sending...');

      var formData = new FormData(this);
      var csrfToken = $('meta[name="csrf-token"]').attr('content');
      if (csrfToken && !formData.has('_token')) {
        formData.append('_token', csrfToken);
      }

      $.ajax({
        type: 'POST',
        url: form.attr('action'),
        data: formData,
        processData: false,
        contentType: false,
        success: function(response) {
          if (response && response.success) {
            responseDiv
              .removeClass('text-danger alert-danger')
              .addClass('text-success alert alert-success')
              .html(response.message)
              .show();
            form[0].reset();
          } else {
            var msg = (response && response.message) ? response.message : 'Thank you! Your message has been sent.';
            responseDiv
              .removeClass('text-success alert-success')
              .addClass('text-danger alert alert-danger')
              .html(msg)
              .show();
          }
          setTimeout(function(){ responseDiv.fadeOut(); }, 5000);
        },
        error: function(xhr) {
          var errorMessage = 'An error occurred. Please try again.';
          if (xhr.responseJSON) {
            if (xhr.responseJSON.errors) {
              var errorList = '<ul class=\"mb-0\">';
              $.each(xhr.responseJSON.errors, function(key, errors) {
                $.each(errors, function(index, error) {
                  errorList += '<li>' + error + '</li>';
                });
              });
              errorList += '</ul>';
              errorMessage = xhr.responseJSON.message || 'Validation errors:' + errorList;
            } else if (xhr.responseJSON.message) {
              errorMessage = xhr.responseJSON.message;
            }
          }
          responseDiv
            .removeClass('text-success alert-success')
            .addClass('text-danger alert alert-danger')
            .html(errorMessage)
            .show();
          setTimeout(function(){ responseDiv.fadeOut(); }, 5000);
        },
        complete: function() {
          submitBtn.prop('disabled', false).html(originalText);
        }
      });
    });

    // Newsletter subscription form
    $('.subscribe-form').on('submit', function(e) {
      e.preventDefault();
      
      var form = $(this);
      var submitBtn = form.find('.subscribe-btn');
      var responseDiv = form.find('.newsletter-response');
      var originalBtnText = submitBtn.html();
      
      // Disable submit button
      submitBtn.prop('disabled', true).html('Subscribing...');
      responseDiv.hide().removeClass('text-success text-danger');
      
      $.ajax({
        type: "POST",
        url: "{{ route('subscribers.submit') }}",
        data: {
          email: form.find('input[type="email"]').val(),
          _token: $('input[name="_token"]').val()
        },
        success: function(response) {
          if (response.status === 'success') {
            responseDiv.removeClass('text-danger').addClass('text-success').html(response.message || 'Thank you for subscribing!').show();
            form[0].reset();
            setTimeout(() => {
              responseDiv.fadeOut();
            }, 5000);
          } else {
            responseDiv.removeClass('text-success').addClass('text-danger').html(response.error || 'Something went wrong. Please try again.').show();
          }
        },
        error: function(xhr) {
          var errorMessage = 'An error occurred. Please try again.';
          if (xhr.responseJSON && xhr.responseJSON.errors && xhr.responseJSON.errors.email) {
            errorMessage = xhr.responseJSON.errors.email[0];
          } else if (xhr.responseJSON && xhr.responseJSON.message) {
            errorMessage = xhr.responseJSON.message;
          } else if (xhr.responseJSON && xhr.responseJSON.error) {
            errorMessage = xhr.responseJSON.error;
          }
          responseDiv.removeClass('text-success').addClass('text-danger').html(errorMessage).show();
        },
        complete: function() {
          submitBtn.prop('disabled', false).html(originalBtnText);
        }
      });
    });

  });

  // $(".successform").hide();
  // $('#contact-form').on('submit', function(e) {
  //   e.preventDefault();


  //   var form = $("#contact-form");
  //   $.ajax({
  //     type: "POST",
  //     url: "<?= route('contactus.submit') ?>",
  //     data: new FormData(this),
  //     processData: false,
  //     contentType: false,
  //     beforeSend: function() {


  //     },
  //     success: function(data) {
  //       if (data == 1) {
  //         form[0].reset(); // Reset form fields
  //         $(".ajax-response").removeClass("text-danger").addClass("text-success").html('Form submitted successfully!').show();

  //         setTimeout(() => {
  //           $(".ajax-response").hide(); // Hide success message after 3 seconds
  //         }, 3000);
  //       } else {
  //         $(".ajax-response").removeClass("text-success").addClass("text-danger").html('Something went wrong. Please try again after sometime').show();

  //         setTimeout(() => {
  //           $("#modal-contact-us").modal("hide");
  //           $(".ajax-response").hide(); // Hide error message after 3 seconds
  //         }, 3000);
  //       }
  //     },
  //     error: function() {
  //       $(".ajax-response").removeClass("text-success").addClass("text-danger").html('An error occurred. Please try again later.').show();

  //       setTimeout(() => {
  //         $(".ajax-response").hide(); // Hide error message after 3 seconds
  //       }, 3000);
  //     }


  //   });

  // });
</script>

</html>