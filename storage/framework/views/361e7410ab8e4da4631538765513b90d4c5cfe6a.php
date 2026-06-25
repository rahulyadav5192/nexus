<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8">
  <link rel="icon" type="image/webp" href="<?php echo e(asset('nexus/images/nexus-favicon.webp')); ?>">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <meta name="csrf-token" content="<?php echo e(csrf_token()); ?>">
  <?php
    $fallbackTitle = trim($__env->yieldContent('title')) ?: 'Nexus Group Holdings';
    $fallbackDescription = trim($__env->yieldContent('meta_description')) ?: 'Nexus Group Holdings LLC — a diversified, vertically integrated group spanning gold sourcing, refining, jewelry manufacturing, retail and strategic investments across the UAE and Africa.';
    $useDbMeta = isset($meta_tags) && $meta_tags && (int) $meta_tags->status === 1;
    $pageTitle = $useDbMeta && !empty($meta_tags->tag) ? $meta_tags->tag : $fallbackTitle;
    $pageDescription = $useDbMeta && !empty($meta_tags->description) ? $meta_tags->description : $fallbackDescription;
  ?>
  <title><?php echo e($pageTitle); ?></title>
  <meta name="description" content="<?php echo e($pageDescription); ?>">
  <meta property="og:title" content="<?php echo e($pageTitle); ?>">
  <meta property="og:description" content="<?php echo e($pageDescription); ?>">
  <meta property="og:url" content="<?php echo e(url()->current()); ?>">
  <meta property="og:type" content="website">
  <link rel="preconnect" href="https://fonts.googleapis.com">
  <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
  <link rel="stylesheet" href="https://fonts.googleapis.com/css2?family=Fraunces:ital,opsz,wght@0,9..144,300..700;1,9..144,300..700&family=Plus+Jakarta+Sans:ital,wght@0,300..700;1,300..700&display=swap">
  <link rel="stylesheet" href="<?php echo e(asset('nexus/css/styles.css')); ?>">
  <?php echo $__env->yieldContent('page_styles'); ?>
</head>

<body>
  <?php echo $__env->make('frontend.nexus.partials.nav', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>

  <?php echo $__env->yieldContent('content'); ?>

  <?php echo $__env->make('frontend.nexus.partials.footer', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>

  <script src="<?php echo e(asset('nexus/js/main.js')); ?>"></script>
  <?php echo $__env->yieldContent('page_scripts'); ?>
</body>

</html>
<?php /**PATH /Applications/XAMPP/xamppfiles/htdocs/nexus/resources/views/layouts/nexus.blade.php ENDPATH**/ ?>