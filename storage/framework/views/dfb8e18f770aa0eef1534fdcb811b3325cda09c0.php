<?php ($activePage = trim($__env->yieldContent('active_page'))); ?>

<header class="nav" id="nav">
  <div class="wrap">
    <a class="brand" href="<?php echo e(route('home')); ?>" aria-label="Nexus Group Holdings home">
      <img src="<?php echo e(asset('nexus/images/nexus-logo.webp')); ?>" alt="Nexus Group Holdings" style="height:2.8rem;width:auto;display:block;">
    </a>
    <nav class="nav-links" aria-label="Primary">
      <a href="<?php echo e(route('about')); ?>" <?php if($activePage === 'about'): ?> class="active" <?php endif; ?>>Group</a>
      <a href="<?php echo e(route('companies')); ?>" <?php if($activePage === 'companies'): ?> class="active" <?php endif; ?>>Companies</a>
      <a href="<?php echo e(route('operations')); ?>" <?php if($activePage === 'operations'): ?> class="active" <?php endif; ?>>Operations</a>
      <a href="<?php echo e(route('expansion')); ?>" <?php if($activePage === 'expansion'): ?> class="active" <?php endif; ?>>Expansion</a>
      <a href="<?php echo e(route('investors')); ?>" <?php if($activePage === 'investors'): ?> class="active" <?php endif; ?>>Investors</a>
      <a href="<?php echo e(route('blogs')); ?>" <?php if($activePage === 'blogs'): ?> class="active" <?php endif; ?>>Insights</a>
      <a class="btn nav-cta" href="<?php echo e(route('contactus')); ?>"><span>Contact</span></a>
    </nav>
    <button class="nav-toggle" aria-label="Open menu" aria-expanded="false" aria-controls="mobileMenu">
      <span></span><span></span><span></span>
    </button>
  </div>
</header>

<div class="mobile-menu" id="mobileMenu">
  <a href="<?php echo e(route('about')); ?>"><span class="n">01</span> Group</a>
  <a href="<?php echo e(route('companies')); ?>"><span class="n">02</span> Companies</a>
  <a href="<?php echo e(route('operations')); ?>"><span class="n">03</span> Operations</a>
  <a href="<?php echo e(route('leadership')); ?>"><span class="n">04</span> Leadership</a>
  <a href="<?php echo e(route('expansion')); ?>"><span class="n">05</span> Expansion</a>
  <a href="<?php echo e(route('investors')); ?>"><span class="n">06</span> Investors</a>
  <a href="<?php echo e(route('blogs')); ?>"><span class="n">07</span> Insights</a>
  <a href="<?php echo e(route('careers')); ?>"><span class="n">08</span> Careers</a>
  <a href="<?php echo e(route('contactus')); ?>"><span class="n">09</span> Contact</a>
</div>
<?php /**PATH /Applications/XAMPP/xamppfiles/htdocs/nexus/resources/views/frontend/nexus/partials/nav.blade.php ENDPATH**/ ?>