<!DOCTYPE html>
<html lang="<?php echo e(app()->getLocale()); ?>" ng-app="LaravelCRUD">

<head>
  <meta charset="utf-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <link rel="icon" type="image/webp" href="<?php echo e(asset('nexus/images/nexus-favicon.webp')); ?>">
  <title>PGL Logistics <?php echo $__env->yieldContent('title'); ?></title>
  <!-- Tell the browser to be responsive to screen width -->
  <meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no">
  <!-- Font Awesome -->
  <link rel="stylesheet" href="<?php echo e(asset('admin_theme/plugins/fontawesome-free/css/all.min.css')); ?>">
  <!-- Ionicons -->
  <link rel="stylesheet" href="https://code.ionicframework.com/ionicons/2.0.1/css/ionicons.min.css">
  <!-- Tempusdominus Bbootstrap 4 -->
  <link rel="stylesheet" href="<?php echo e(asset('admin_theme/plugins/tempusdominus-bootstrap-4/css/tempusdominus-bootstrap-4.min.css')); ?>">
  <!-- iCheck -->
  <link rel="stylesheet" href="<?php echo e(asset('admin_theme/plugins/icheck-bootstrap/icheck-bootstrap.min.css')); ?>">
  <!-- JQVMap -->
  <link rel="stylesheet" href="<?php echo e(asset('admin_theme/plugins/jqvmap/jqvmap.min.css')); ?>">
  <!-- Theme style -->
  <link rel="stylesheet" href="<?php echo e(asset('admin_theme/dist/css/adminlte.min.css')); ?>">
  <!-- overlayScrollbars -->
  <link rel="stylesheet" href="<?php echo e(asset('admin_theme/plugins/overlayScrollbars/css/OverlayScrollbars.min.css')); ?>">
  <!-- Daterange picker -->
  <link rel="stylesheet" href="<?php echo e(asset('admin_theme/plugins/daterangepicker/daterangepicker.css')); ?>">
  <!-- summernote -->
  <link rel="stylesheet" href="<?php echo e(asset('admin_theme/plugins/summernote/summernote-bs4.css')); ?>">
  <!-- Google Font: Source Sans Pro -->
  <link href="https://fonts.googleapis.com/css?family=Source+Sans+Pro:300,400,400i,700" rel="stylesheet">
  <!-- jQuery -->
  <script src="<?php echo e(asset('admin_theme/plugins/jquery/jquery.min.js')); ?>"></script>

  <link rel="stylesheet" href="<?php echo e(asset('admin_theme/dist/css/datatables.min.css')); ?>">

  <link rel="stylesheet" href="<?php echo e(asset('admin_theme/plugins/toastr/toastr.min.css')); ?>">

  <link rel="stylesheet" href="<?php echo e(asset('admin_theme/plugins/sweetalert2-theme-bootstrap-4/bootstrap-4.min.css')); ?>">

  <link rel="stylesheet" href="<?php echo e(asset('admin_theme/dist/css/style.css')); ?>">
  <link href="https://cdn.jsdelivr.net/npm/select2@4.1.0-beta.1/dist/css/select2.min.css" rel="stylesheet" />
  <script src="<?php echo e(asset('frontend_theme/js/jquery.barrating.min.js')); ?>"></script>
  <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css" rel="stylesheet" />
  <link href="https://cdnjs.cloudflare.com/ajax/libs/jquery-bar-rating/1.2.1/themes/fontawesome-stars.min.css" rel="stylesheet" />
  <link href="https://cdnjs.cloudflare.com/ajax/libs/jquery-bar-rating/1.2.1/themes/bars-reversed.min.css" rel="stylesheet" />


</head>

<body class="hold-transition sidebar-mini layout-fixed">

  <div class="wrapper">

    <!-- Navbar -->
    <nav class="main-header navbar navbar-expand navbar-dark navbar-danger">
      <ul class="navbar-nav">
        <li class="nav-item">
          <a class="nav-link" data-widget="pushmenu" href="#" role="button"><i class="fas fa-bars"></i></a>
        </li>
      </ul>
      <!-- Right navbar links -->
      <ul class="navbar-nav ml-auto">
        <!-- Messages Dropdown Menu -->

        <li class="nav-item dropdown">
          <a class="nav-link" data-toggle="dropdown" href="#">
            <i class="far fa-user"></i>
          </a>
          <div class="dropdown-menu dropdown-menu-lg dropdown-menu-right">
            <span class="dropdown-item dropdown-header"><?php echo e(Auth::user()->name); ?></span>
            <div class="dropdown-divider"></div>
            <?php if (Auth::user()->id == 1) { ?>
              <a href="<?php echo e(route('users.edit',1)); ?>" class="dropdown-item" style="text-align: center;">
                <i class="fas fa-key mr-2"></i> Change Password
              </a>
            <?php } ?>
            <div class="dropdown-divider"></div>
            <a class="dropdown-item dropdown-footer" href="<?php echo e(route('logout')); ?>" onclick="event.preventDefault();
                                                     document.getElementById('logout-form').submit();">
              <i class="fa fa-power-off"></i> <?php echo e(__('Sign Out')); ?>

            </a>
            <form id="logout-form" action="<?php echo e(route('logout')); ?>" method="POST" class="d-none">
              <?php echo csrf_field(); ?>
            </form>
          </div>
        </li>
        <!-- <li class="nav-item">
        <a class="nav-link" data-widget="control-sidebar" data-slide="true" href="#" role="button">
          <i class="fas fa-th-large"></i>
        </a>
      </li> -->
      </ul>
    </nav>
    <!-- /.navbar -->

    <!-- Main Sidebar Container -->
    <aside class="main-sidebar elevation-4 sidebar-light-indigo">
      <!-- Brand Logo -->
      <a href="<?php echo e(url('/web-admin')); ?>" class="brand-link" style="text-align: center;">
        <img src="<?php echo e(asset('nexus/images/nexus-logo.webp')); ?>" alt="Nexus Group Holdings" class="img-responsive" style="width: 50%;">
        <!-- <span class="brand-text font-weight-light">AL AREEN</span> -->
      </a>

      <!-- Sidebar -->
      <div class="sidebar">
        <!-- Sidebar user panel (optional) -->
        <div class="user-panel mt-3 pb-3 mb-3 d-flex">
          <div class="image">
            <img src="<?php echo e(asset('nexus/images/nexus-logo.webp')); ?>" class="img-circle elevation-2" alt="User Image">
          </div>
          <div class="info">
            <a href="<?php echo e(url('/web-admin')); ?>" class="d-block"><?php echo e(Auth::user()->name); ?></a>
          </div>
        </div>

        <!-- Sidebar Menu -->
        <nav class="mt-2">
          <ul class="nav nav-pills nav-sidebar flex-column text-sm nav-child-indent" data-widget="treeview" role="menu" data-accordion="false">
            <!-- Add icons to the links using the .nav-icon class
               with font-awesome or any other icon font library -->

            <li class="nav-item">
              <a href="<?php echo e(url('/web-admin')); ?>" class="nav-link">
                <i class="nav-icon fas fa-tachometer-alt"></i>
                <p>
                  Dashboard
                </p>
              </a>
            </li>

            <?php if (app(\Illuminate\Contracts\Auth\Access\Gate::class)->check('seo')): ?>
            <li class="nav-item has-treeview">
              <a href="#" class="nav-link">
                <i class="nav-icon fas fa-flag"></i>
                <p>
                  SEO & Marketing
                  <i class="fas fa-angle-left right"></i>
                </p>
              </a>
              <ul class="nav nav-treeview">
                <?php if (app(\Illuminate\Contracts\Auth\Access\Gate::class)->check('meta-tags-list')): ?>
                <li class="nav-item">
                  <a href="<?php echo e(route('meta-tags.index')); ?>" class="nav-link">
                    <i class="fas fa-tag"></i>
                    <p>Meta Tags</p>
                  </a>
                </li>
                <?php endif; ?>
                <?php if (app(\Illuminate\Contracts\Auth\Access\Gate::class)->check('subscribers')): ?>
                <li class="nav-item">
                  <a href="<?php echo e(route('subscribers.index')); ?>" class="nav-link">
                    <i class="fas fa-envelope"></i>
                    <p>Subscribers</p>
                  </a>
                </li>
                <?php endif; ?>
                <?php if (app(\Illuminate\Contracts\Auth\Access\Gate::class)->check('enquiry')): ?>
                <li class="nav-item">
                  <a href="<?php echo e(route('enquiry.index')); ?>" class="nav-link">
                    <i class="fas fa-envelope"></i>
                    <p>Enquiry</p>
                  </a>
                </li>
                <?php endif; ?>

              </ul>
            </li>
            <?php endif; ?>

            <?php if (app(\Illuminate\Contracts\Auth\Access\Gate::class)->check('blogs-management')): ?>
            <li class="nav-item has-treeview">
              <a href="#" class="nav-link">
                <i class="nav-icon fas fa-blog"></i>
                <p>
                  Blogs Management
                  <i class="fas fa-angle-left right"></i>
                </p>
              </a>
              <ul class="nav nav-treeview">
                <?php if (app(\Illuminate\Contracts\Auth\Access\Gate::class)->check('blog-category-list')): ?>
                <li class="nav-item">
                  <a href="<?php echo e(route('blog_cat.index')); ?>" class="nav-link">
                    <i class="fas fa-layer-group"></i>
                    <p>Blog Category</p>
                  </a>
                </li>
                <?php endif; ?>
                <?php if (app(\Illuminate\Contracts\Auth\Access\Gate::class)->check('blogs-list')): ?>
                <li class="nav-item">
                  <a href="<?php echo e(route('blogs.index')); ?>" class="nav-link">
                    <i class="fas fa-blog"></i>
                    <p>Blog</p>
                  </a>
                </li>
                <?php endif; ?>
              </ul>
            </li>
            <?php endif; ?>

            <?php if (app(\Illuminate\Contracts\Auth\Access\Gate::class)->check('cms')): ?>
            <li class="nav-item has-treeview">
              <a href="#" class="nav-link">
                <i class="nav-icon fas fa-bars"></i>
                <p>
                  CMS
                  <i class="fas fa-angle-left right"></i>
                </p>
              </a>
              <ul class="nav nav-treeview">
                <?php if (app(\Illuminate\Contracts\Auth\Access\Gate::class)->check('banners-list')): ?>
                <li class="nav-item">
                  <a href="<?php echo e(route('banners.index')); ?>" class="nav-link">
                    <i class="fas fa-images"></i>
                    <p>Main Banners</p>
                  </a>
                </li>
                <?php endif; ?>



                <?php if (app(\Illuminate\Contracts\Auth\Access\Gate::class)->check('general')): ?>
                <li class="nav-item">
                  <a href="<?php echo e(route('general.index')); ?>" class="nav-link">
                    <i class="fas fa-laptop-house"></i>
                    <p> Generals</p>
                  </a>
                </li>
                <?php endif; ?>
                <?php if (app(\Illuminate\Contracts\Auth\Access\Gate::class)->check('contact-social-media')): ?>
                <li class="nav-item">
                  <a href="<?php echo e(route('contact-details.index')); ?>" class="nav-link">
                    <i class="fas fa-address-book"></i>
                    <p> Contact & Social Media</p>
                  </a>
                </li>
                <?php endif; ?>

                <?php if (app(\Illuminate\Contracts\Auth\Access\Gate::class)->check('testimonials-list')): ?>
                <li class="nav-item">
                  <a href="<?php echo e(route('testimonials.index')); ?>" class="nav-link">
                    <i class="fas fa-book-open"></i>
                    <p>Testimonials</p>
                  </a>
                </li>
                <?php endif; ?>


                <li class="nav-item">
                  <a href="<?php echo e(route('careers.index')); ?>" class="nav-link">
                    <i class="fas fa-book-open"></i>
                    <p>Career</p>
                  </a>
                </li>




              </ul>
            </li>
            <?php endif; ?>





            <li class="nav-item has-treeview">
              <a href="#" class="nav-link">
                <i class="nav-icon fas fa-dolly"></i>
                <p>
                  Service Management

                  <i class="fas fa-angle-left right"></i>
                </p>
              </a>
              <ul class="nav nav-treeview">

                <!-- <li class="nav-item">
                  <a href="<?php echo e(route('categories.index')); ?>" class="nav-link">
                    <i class="fas fa-layer-group"></i>
                    <p>Service </p>
                  </a>
                </li> -->



                <li class="nav-item">
                  <a href="<?php echo e(route('product-items.index')); ?>" class="nav-link">
                    <i class="fas fa-dolly-flatbed"></i>
                    <p>Operations Disciplines</p>
                  </a>
                </li>



              </ul>
            </li>






            <?php if (app(\Illuminate\Contracts\Auth\Access\Gate::class)->check('masters')): ?>
            <li class="nav-item has-treeview">
              <a href="#" class="nav-link">
                <i class="nav-icon fas fa-lock"></i>
                <p>
                  Masters
                  <i class="fas fa-angle-left right"></i>
                </p>
              </a>
              <ul class="nav nav-treeview">
                <?php if (app(\Illuminate\Contracts\Auth\Access\Gate::class)->check('user-list')): ?>
                <li class="nav-item">
                  <a href="<?php echo e(route('users.index')); ?>" class="nav-link">
                    <i class="far fa fa-users nav-icon"></i>
                    <p>Users Management</p>
                  </a>
                </li>
                <?php endif; ?>
                <?php if (app(\Illuminate\Contracts\Auth\Access\Gate::class)->check('role-list')): ?>
                <li class="nav-item">
                  <a href="<?php echo e(route('roles.index')); ?>" class="nav-link">
                    <i class="far fa fa-users nav-icon"></i>
                    <p>Roles Management</p>
                  </a>
                </li>
                <?php endif; ?>
              </ul>
            </li>
            <?php endif; ?>



          </ul>
        </nav>
        <!-- /.sidebar-menu -->
      </div>
      <!-- /.sidebar -->
    </aside>

    <?php echo $__env->yieldContent('content'); ?>

    <!-- /.content-wrapper -->
    <footer class="main-footer">
      <strong>Copyright &copy; <?= date('Y') ?> </strong>
      All rights reserved.
      <div class="float-right d-none d-sm-inline-block">
        Developed By <b>Pure Magic IT Services</b>
      </div>
    </footer>

    <!-- Control Sidebar -->
    <aside class="control-sidebar control-sidebar-dark">
      <!-- Control sidebar content goes here -->
    </aside>
    <!-- /.control-sidebar -->
  </div>
  <!-- ./wrapper -->


  <!-- jQuery UI 1.11.4 -->
  <script src="<?php echo e(asset('admin_theme/plugins/jquery-ui/jquery-ui.min.js')); ?>"></script>
  <!-- jQuery UI Touch Punch for mobile drag support -->
  <script src="https://cdnjs.cloudflare.com/ajax/libs/jqueryui-touch-punch/0.2.3/jquery.ui.touch-punch.min.js"></script>
  <!-- Resolve conflict in jQuery UI tooltip with Bootstrap tooltip -->
  <script>
    $.widget.bridge('uibutton', $.ui.button)
  </script>
  <!-- Bootstrap 4 -->
  <script src="<?php echo e(asset('admin_theme/plugins/bootstrap/js/bootstrap.bundle.min.js')); ?>"></script>
  <!-- ChartJS -->
  <script src="<?php echo e(asset('admin_theme/plugins/chart.js/Chart.min.js')); ?>"></script>
  <!-- Sparkline -->
  <script src="<?php echo e(asset('admin_theme/plugins/sparklines/sparkline.js')); ?>"></script>

  <!-- jQuery Knob Chart -->
  <script src="<?php echo e(asset('admin_theme/plugins/jquery-knob/jquery.knob.min.js')); ?>"></script>
  <!-- daterangepicker -->
  <script src="<?php echo e(asset('admin_theme/plugins/moment/moment.min.js')); ?>"></script>
  <script src="<?php echo e(asset('admin_theme/plugins/daterangepicker/daterangepicker.js')); ?>"></script>
  <!-- Tempusdominus Bootstrap 4 -->
  <script src="<?php echo e(asset('admin_theme/plugins/tempusdominus-bootstrap-4/js/tempusdominus-bootstrap-4.min.js')); ?>"></script>
  <!-- Summernote -->
  <script src="<?php echo e(asset('admin_theme/plugins/summernote/summernote-bs4.min.js')); ?>"></script>
  <!-- overlayScrollbars -->
  <script src="<?php echo e(asset('admin_theme/plugins/overlayScrollbars/js/jquery.overlayScrollbars.min.js')); ?>"></script>
  <!-- AdminLTE App -->
  <script src="<?php echo e(asset('admin_theme/dist/js/adminlte.js')); ?>"></script>
  <!-- AdminLTE dashboard demo (This is only for demo purposes) -->

  <!-- AdminLTE for demo purposes -->
  <script src="<?php echo e(asset('admin_theme/dist/js/demo.js')); ?>"></script>
  <script src="<?php echo e(asset('admin_theme/dist/js/master_nav.js')); ?>"></script>
  <script src="<?php echo e(asset('admin_theme/dist/js/datatables.min.js')); ?>"></script>
  <script src="<?php echo e(asset('admin_theme/ckeditor/ckeditor.js')); ?>"></script>
  <script src="<?php echo e(asset('admin_theme/plugins/toastr/toastr.min.js')); ?>"></script>
  <script src="<?php echo e(asset('admin_theme/plugins/sweetalert2/sweetalert2.min.js')); ?>"></script>
  <script src="<?php echo e(asset('admin_theme/plugins/datatables/jquery.dataTables.min.js')); ?>"></script>
  <script src="https://cdn.jsdelivr.net/npm/select2@4.1.0-beta.1/dist/js/select2.min.js"></script>

  <script type="text/javascript">
    var Toast = Swal.mixin({
      toast: true,
      position: 'top-end',
      showConfirmButton: false,
      timer: 3000
    });

    function status_alert(icon, title) {
      Toast.fire({
        icon: icon,
        title: title
      })
    }
  </script>

  <!-- Mobile Responsive Scripts -->
  <script type="text/javascript">
    $(document).ready(function() {
      // Handle sidebar toggle on mobile
      $('[data-widget="pushmenu"]').on('click', function() {
        $('body').toggleClass('sidebar-open');
      });
      
      // Close sidebar when clicking outside on mobile
      $(document).on('click', function(e) {
        if ($(window).width() < 768) {
          if (!$(e.target).closest('.main-sidebar, [data-widget="pushmenu"]').length) {
            $('body').removeClass('sidebar-open');
          }
        }
      });
      
      // Make all tables responsive
      function wrapTables() {
        // Wrap all regular tables
        $('table').each(function() {
          var $table = $(this);
          if (!$table.parent().hasClass('table-responsive-wrapper') && 
              !$table.closest('.dataTables_wrapper').length &&
              !$table.closest('.table-responsive-wrapper').length) {
            $table.wrap('<div class="table-responsive-wrapper" style="overflow-x: auto; -webkit-overflow-scrolling: touch; width: 100%;"></div>');
          }
        });
        
        // Also wrap DataTables tables and ensure scrolling
        $('.dataTables_wrapper').each(function() {
          var $wrapper = $(this);
          $wrapper.css({
            'overflow-x': 'auto',
            '-webkit-overflow-scrolling': 'touch',
            'width': '100%'
          });
          
          // Ensure scroll body is scrollable
          $wrapper.find('.dataTables_scrollBody').css({
            'overflow-x': 'auto',
            '-webkit-overflow-scrolling': 'touch'
          });
        });
        
        // Force card-body to be scrollable
        $('.card-body').each(function() {
          var $cardBody = $(this);
          if ($cardBody.find('table').length > 0) {
            $cardBody.css({
              'overflow-x': 'auto',
              '-webkit-overflow-scrolling': 'touch'
            });
          }
        });
      }
      
      // Always wrap tables on mobile, check immediately and after delay
      function checkAndWrapTables() {
        if ($(window).width() < 768) {
          wrapTables();
          // Force scroll on mobile
          $('.card-body, .table-responsive-wrapper, .dataTables_wrapper').css({
            'overflow-x': 'auto',
            '-webkit-overflow-scrolling': 'touch'
          });
        }
      }
      
      // Check immediately
      checkAndWrapTables();
      
      // Check after a short delay to catch dynamically loaded tables
      setTimeout(checkAndWrapTables, 500);
      setTimeout(checkAndWrapTables, 1500);
      
      // Re-check on window resize
      $(window).on('resize', function() {
        if ($(window).width() < 768) {
          checkAndWrapTables();
        } else {
          $('table').unwrap('.table-responsive-wrapper');
        }
      });
      
      // Initialize DataTables with responsive options
      if ($.fn.DataTable) {
        $.extend(true, $.fn.dataTable.defaults, {
          responsive: true,
          scrollX: true,
          autoWidth: false,
          // Move length selector to bottom: l = length, f = filter, t = table, i = info, p = pagination
          // Top: filter only, Bottom: length, info, pagination
          dom: '<"row"<"col-sm-12 col-md-6"f><"col-sm-12 col-md-6"l>>rt<"row"<"col-sm-12 col-md-5"i><"col-sm-12 col-md-7"p>>',
          language: {
            search: "Search:",
            lengthMenu: "Show _MENU_ entries",
            info: "Showing _START_ to _END_ of _TOTAL_ entries",
            infoEmpty: "No entries to show",
            infoFiltered: "(filtered from _MAX_ total entries)"
          }
        });
        
        // After DataTable initialization, wrap tables for mobile
        $(document).on('init.dt', function() {
          if ($(window).width() < 768) {
            wrapTables();
          }
        });
      }
      
      // Wrap tables after DataTables are fully initialized - Multiple attempts
      setTimeout(function() {
        if ($(window).width() < 768) {
          wrapTables();
          // Force apply scrolling styles directly
          forceMobileScrolling();
        }
      }, 500);
      
      setTimeout(function() {
        if ($(window).width() < 768) {
          wrapTables();
          forceMobileScrolling();
        }
      }, 1500);
      
      setTimeout(function() {
        if ($(window).width() < 768) {
          wrapTables();
          forceMobileScrolling();
        }
      }, 3000);
      
      // Function to force mobile scrolling
      function forceMobileScrolling() {
        $('.card-body').each(function() {
          if ($(this).find('table').length > 0) {
            $(this).css({
              'overflow-x': 'auto',
              '-webkit-overflow-scrolling': 'touch',
              'width': '100%'
            });
          }
        });
        
        $('.dataTables_wrapper, .dataTables_scroll, .dataTables_scrollBody').css({
          'overflow-x': 'auto',
          '-webkit-overflow-scrolling': 'touch',
          'width': '100%'
        });
        
        $('.table-responsive-wrapper').css({
          'overflow-x': 'auto',
          '-webkit-overflow-scrolling': 'touch',
          'width': '100%'
        });
        
        $('table').css({
          'min-width': '600px',
          'display': 'table'
        });
      }
      
      // Enhance existing sortable instances for mobile
      function enhanceSortableForMobile() {
        $('[id*="tablecontents"]').each(function() {
          var $sortable = $(this);
          
          if ($sortable.hasClass('ui-sortable')) {
            // Get existing options
            var existingOptions = $sortable.sortable('option');
            
            // Update with mobile-friendly options
            $sortable.sortable('option', {
              tolerance: 'pointer',
              distance: $(window).width() < 768 ? 10 : 0, // Only use distance on mobile
              delay: $(window).width() < 768 ? 150 : 0, // Only use delay on mobile
              scroll: true,
              scrollSensitivity: 100,
              scrollSpeed: 20,
              forceHelperSize: true,
              forcePlaceholderSize: true,
              appendTo: 'body',
              helper: 'clone'
            });
          }
        });
      }
      
      // Initialize mobile-friendly sortable for all tables with drag functionality
      function initMobileSortable() {
        // Wait for DataTables and existing sortable to initialize
        setTimeout(function() {
          $('[id*="tablecontents"]').each(function() {
            var $sortable = $(this);
            
            // If sortable is not initialized yet, wait a bit more
            if (!$sortable.hasClass('ui-sortable')) {
              return;
            }
            
            // Enhance existing sortable
            enhanceSortableForMobile();
          });
        }, 1500);
      }
      
      // Initialize mobile sortable after page load
      initMobileSortable();
      
      // Re-initialize after DataTables initialization
      $(document).on('init.dt', function() {
        setTimeout(function() {
          initMobileSortable();
        }, 500);
      });
      
      // Re-initialize on window resize
      var resizeTimer;
      $(window).on('resize', function() {
        clearTimeout(resizeTimer);
        resizeTimer = setTimeout(function() {
          enhanceSortableForMobile();
        }, 300);
      });
      
      // Also enhance when sortable is created
      $(document).on('sortcreate', '[id*="tablecontents"]', function() {
        enhanceSortableForMobile();
      });
    });
  </script>

  <style>
    /* Additional mobile fixes */
    @media (max-width: 768px) {
      body.sidebar-open {
        overflow: hidden;
      }
      
      body.sidebar-open .main-sidebar {
        z-index: 1050;
        position: fixed;
        height: 100vh;
        overflow-y: auto;
      }
      
      body.sidebar-open .content-wrapper {
        margin-left: 0;
      }
      
      body.sidebar-open::before {
        content: '';
        position: fixed;
        top: 0;
        left: 0;
        right: 0;
        bottom: 0;
        background: rgba(0, 0, 0, 0.5);
        z-index: 1040;
      }
      
      /* Ensure tables are scrollable - Force with important */
      .card-body,
      .table-responsive-wrapper,
      .dataTables_wrapper,
      .dataTables_scroll,
      .dataTables_scrollBody {
        overflow-x: auto !important;
        -webkit-overflow-scrolling: touch !important;
        overflow-y: visible !important;
        width: 100% !important;
        position: relative !important;
      }
      
      /* Force table scrolling */
      table {
        min-width: 600px !important;
        display: table !important;
      }
      
      /* Ensure DataTables scroll body is scrollable */
      .dataTables_wrapper .dataTables_scrollBody {
        overflow-x: auto !important;
        -webkit-overflow-scrolling: touch !important;
        max-width: 100vw !important;
      }
      
      /* Fix for DataTables on mobile */
      .dataTables_wrapper .dataTables_scroll {
        overflow-x: auto !important;
        -webkit-overflow-scrolling: touch !important;
        width: 100% !important;
      }
      
      /* Force card body to allow scrolling */
      .card .card-body {
        overflow-x: auto !important;
        -webkit-overflow-scrolling: touch !important;
      }
      
      /* DataTables controls layout on mobile */
      .dataTables_wrapper .row:first-child {
        display: flex;
        flex-direction: column;
      }
      
      .dataTables_wrapper .row:first-child > div:first-child {
        display: flex;
        align-items: center;
        justify-content: space-between;
        width: 100%;
        margin-bottom: 0.5rem;
      }
      
      .dataTables_wrapper .dataTables_length {
        margin-bottom: 0;
        margin-right: 0;
      }
      
      .dataTables_wrapper .dataTables_filter {
        width: 100%;
        margin-top: 0.5rem;
        margin-bottom: 1rem;
      }
    }
    
    /* Desktop layout - Add New and Search on top, Show on bottom */
    @media (min-width: 768px) {
      .dataTables_wrapper .row:first-child {
        display: flex;
        align-items: center;
        justify-content: space-between;
        flex-wrap: wrap;
      }
      
      .dataTables_wrapper .row:first-child > div:first-child {
        display: flex;
        align-items: center;
        flex: 1;
      }
      
      .dataTables_wrapper .dataTables_filter {
        margin-left: auto;
        margin-bottom: 0;
      }
      
      .dataTables_wrapper .row:last-child {
        display: flex;
        align-items: center;
        justify-content: space-between;
      }
      
      .dataTables_wrapper .dataTables_length {
        margin-right: 1rem;
        margin-bottom: 0;
      }
      
      .pull-right {
        margin-left: auto;
        margin-right: 0;
        margin-bottom: 0;
      }
    }
  </style>

</body>

</html><?php /**PATH /Applications/XAMPP/xamppfiles/htdocs/nexus/resources/views/layouts/admin.blade.php ENDPATH**/ ?>