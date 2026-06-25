   <div class="container mt-8">
       <h2 class="head-2 head-underline">
           Logistics <span class="text-secondary">Services</span>
           <span class="custom-underline"></span>
       </h2>

       <!-- Scrollable wrapper -->
       <div class="services-scroll mt-4">

          <?php
          $count = 1;
          // Fixed icon order for the first 6 services
          $icons = [
              'directions_boat',
              'flight',
              'local_shipping',
              'assignment_turned_in',
              'warehouse',
              'engineering',
          ];
          ?>
          <?php foreach ($services as $obj): ?>
               <div class="col-lg-4 col-md-6 col-12 d-flex justify-content-center mb-4">
                   <div class="service-card">
                       <img src="<?= asset('uploads/product_items/' . $obj->image) ?>" alt="<?= e($obj->name) ?>" />
                       <div class="overlay"></div>
                       <div class="service-card-content">
                           <div class="service-card-number">
                               <?= str_pad($count, 2, '0', STR_PAD_LEFT) ?>
                           </div>
                           <div class="service-card-title"><?= e($obj->name) ?></div>
                           <div class="service-card-desc">
                               <?= $obj->short_description ?>
                           </div>
                           <a href="<?= url('service-detail/' . $obj->slug) ?>" class="service-card-readmore">READ MORE</a>
                           <?php
                           // Pick icon by position; if more than 6 items, repeat the last icon
                           $iconIndex = $count - 1;
                           if ($iconIndex >= count($icons)) {
                               $iconIndex = count($icons) - 1;
                           }
                           $iconName = $icons[$iconIndex];
                           ?>
                           <span class="service-card-icon material-icons"><?= $iconName ?></span>
                       </div>
                   </div>
               </div>
               <?php $count++; ?>
           <?php endforeach; ?>
       </div>


       <div class="swipper-dots mt-2 ms-2">
           <span class="dot active"></span>
           <span class="dot"></span>
           <span class="dot"></span>
           <span class="dot"></span>
       </div>
   </div>