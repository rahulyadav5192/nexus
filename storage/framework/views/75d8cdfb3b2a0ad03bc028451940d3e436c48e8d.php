

<?php $__env->startSection('active_page', 'blogs'); ?>

<?php $__env->startSection('content'); ?>
<section class="subhero" style="min-height:46dvh">
  <div class="subhero-media">
    <video autoplay muted loop playsinline poster="https://images.pexels.com/photos/1370882/pexels-photo-1370882.jpeg?auto=compress&cs=tinysrgb&w=1920" style="width:100%;height:100%;object-fit:cover;display:block">
      <source src="https://www.pexels.com/download/video/8397996/" type="video/mp4">
      <track kind="captions" src="<?php echo e(asset('nexus/empty.vtt')); ?>" label="No dialogue">
    </video>
  </div>
  <div class="wrap">
    <span class="eyebrow reveal">Insights</span>
    <h1 class="reveal d1">News from <span class="serif-i">the Group.</span></h1>
    <p class="lead reveal d2">Company milestones, expansion updates, investment perspective and gold-market commentary.</p>
  </div>
</section>

<section id="insights">
  <div class="wrap">

    <?php if(isset($featuredBlog) && $featuredBlog): ?>
    <a class="featured reveal" href="<?php echo e($featuredBlog->detailUrl()); ?>">
      <div class="f-media">
        <img loading="lazy" src="<?php echo e($featuredBlog->imageUrl()); ?>" alt="<?php echo e($featuredBlog->blog_name); ?>">
      </div>
      <div class="f-body">
        <span class="cat"><?php echo e($featuredBlog->category->category_name ?? 'Insights'); ?></span>
        <h2><?php echo e($featuredBlog->blog_name); ?></h2>
        <p><?php echo e($featuredBlog->short_description); ?></p>
        <?php if($featuredBlog->displayMeta()): ?>
        <span class="meta"><?php echo e($featuredBlog->displayMeta()); ?></span>
        <?php endif; ?>
      </div>
    </a>
    <?php endif; ?>

    <div class="filters reveal" data-target="#blogGrid .insight" style="margin-top:clamp(2.5rem,5vw,4rem)">
      <button class="filter-btn <?php echo e(empty($categoryId) ? 'active' : ''); ?>" data-cat="all">All</button>
      <?php $__currentLoopData = $blog_categories; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $category): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
      <button class="filter-btn <?php echo e((string) $categoryId === (string) $category->id ? 'active' : ''); ?>" data-cat="<?php echo e($category->slug); ?>"><?php echo e($category->category_name); ?></button>
      <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
    </div>

    <div class="insight-grid" id="blogGrid" style="margin-top:1.6rem">
      <?php $__empty_1 = true; $__currentLoopData = $gridBlogs; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $index => $blog): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); $__empty_1 = false; ?>
      <a class="insight reveal<?php echo e($index % 3 === 1 ? ' d1' : ($index % 3 === 2 ? ' d2' : '')); ?>" data-cat="<?php echo e($blog->category->slug ?? 'all'); ?>" href="<?php echo e($blog->detailUrl()); ?>">
        <div class="thumb"><img loading="lazy" src="<?php echo e($blog->imageUrl()); ?>" alt="<?php echo e($blog->blog_name); ?>"></div>
        <div class="body">
          <span class="cat"><?php echo e($blog->category->category_name ?? 'Insights'); ?></span>
          <h3><?php echo e($blog->blog_name); ?></h3>
          <?php if($blog->displayMeta()): ?>
          <span class="meta"><?php echo e($blog->displayMeta()); ?></span>
          <?php endif; ?>
        </div>
      </a>
      <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); if ($__empty_1): ?>
      <p style="grid-column:1/-1;color:var(--ink-dim)">No insights published yet.</p>
      <?php endif; ?>
    </div>
  </div>
</section>

<section class="cta-video-band">
  <div class="cta-bg">
    <video autoplay muted loop playsinline poster="https://images.pexels.com/photos/1370882/pexels-photo-1370882.jpeg?auto=compress&cs=tinysrgb&w=1920" style="width:100%;height:100%;object-fit:cover;display:block">
      <source src="https://www.pexels.com/download/video/8397996/" type="video/mp4">
      <track kind="captions" src="<?php echo e(asset('nexus/empty.vtt')); ?>" label="No dialogue">
    </video>
    <div class="cta-overlay-dark"></div>
    <div class="cta-overlay-glow"></div>
  </div>
  <div class="wrap cta-wrap">
    <span class="eyebrow reveal" style="color:var(--gold-soft);margin-bottom:1.8rem;display:block">Stay Informed</span>
    <h2 class="reveal d1" style="font-size:var(--fs-display);font-weight:300;color:#F5EFE3;max-width:20ch;margin-inline:auto;line-height:1.05">
      Partner with <span class="serif-i">Nexus Group Holdings.</span>
    </h2>
    <div class="reveal d3" style="display:flex;gap:1rem;flex-wrap:wrap;justify-content:center;margin-top:2.6rem">
      <a class="btn solid reveal d2" href="<?php echo e(route('contactus')); ?>"><span>Get In Touch</span> <span class="arr">&rarr;</span></a>
    </div>
  </div>
</section>
<?php $__env->stopSection(); ?>

<?php echo $__env->make('layouts.nexus', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH /Applications/XAMPP/xamppfiles/htdocs/nexus/resources/views/frontend/nexus/blog.blade.php ENDPATH**/ ?>