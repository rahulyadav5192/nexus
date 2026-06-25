

<?php $__env->startSection('active_page', 'blogs'); ?>

<?php $__env->startSection('content'); ?>
<section style="padding-top:calc(var(--nav-h) + clamp(2rem,5vw,4rem))">
  <div class="wrap">
    <article class="article reveal">
      <a class="link-arrow" href="<?php echo e(route('blogs')); ?>" style="margin-bottom:1.6rem"><span class="arr" style="transform:rotate(180deg)">&rarr;</span> All Insights</a>
      <div class="a-cat"><?php echo e($blog->category->category_name ?? 'Insights'); ?></div>
      <h1><?php echo e($blog->blog_name); ?></h1>
      <?php if($blog->displayMeta()): ?>
      <div class="a-meta">
        <?php $__currentLoopData = explode(' · ', $blog->displayMeta()); $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $metaPart): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
        <span><?php echo e($metaPart); ?></span>
        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
      </div>
      <?php endif; ?>

      <figure class="a-figure">
        <img src="<?php echo e($blog->imageUrl()); ?>" alt="<?php echo e($blog->blog_name); ?>">
      </figure>

      <div class="prose">
        <?php if(!empty($blog->content)): ?>
          <?php echo $blog->content; ?>

        <?php elseif($blog->short_description): ?>
          <p><?php echo e($blog->short_description); ?></p>
        <?php endif; ?>

        <?php $__currentLoopData = $blog_sections; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $section): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
          <?php if(!empty($section->title)): ?>
          <h2><?php echo e($section->title); ?></h2>
          <?php endif; ?>
          <?php if(!empty($section->section_image)): ?>
          <figure class="a-figure">
            <img src="<?php echo e(str_starts_with($section->section_image, 'http') ? $section->section_image : asset('uploads/blogs/'.$section->section_image)); ?>" alt="<?php echo e($section->title); ?>">
          </figure>
          <?php endif; ?>
          <?php if(!empty($section->description)): ?>
          <?php echo $section->description; ?>

          <?php endif; ?>
        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
      </div>

      <div class="share">
        <span>Share</span>
        <a href="https://www.linkedin.com/sharing/share-offsite/?url=<?php echo e(urlencode(url()->current())); ?>" aria-label="Share on LinkedIn" target="_blank" rel="noopener">In</a>
        <a href="https://twitter.com/intent/tweet?url=<?php echo e(urlencode(url()->current())); ?>&text=<?php echo e(urlencode($blog->blog_name)); ?>" aria-label="Share on X" target="_blank" rel="noopener">X</a>
        <a href="mailto:?subject=<?php echo e(rawurlencode($blog->blog_name)); ?>&body=<?php echo e(urlencode(url()->current())); ?>" aria-label="Share by email">@</a>
      </div>
    </article>
  </div>
</section>

<?php if(isset($relatedBlogs) && $relatedBlogs->count()): ?>
<section id="related" style="background:var(--ink-2);border-top:1px solid var(--line)">
  <div class="wrap">
    <span class="eyebrow reveal">Related Articles</span>
    <div class="insight-grid" style="margin-top:clamp(2rem,4vw,3rem)">
      <?php $__currentLoopData = $relatedBlogs; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $index => $related): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
      <a class="insight reveal<?php echo e($index === 1 ? ' d1' : ($index === 2 ? ' d2' : '')); ?>" href="<?php echo e($related->detailUrl()); ?>">
        <div class="thumb"><img loading="lazy" src="<?php echo e($related->imageUrl()); ?>" alt="<?php echo e($related->blog_name); ?>"></div>
        <div class="body">
          <span class="cat"><?php echo e($related->category->category_name ?? 'Insights'); ?></span>
          <h3><?php echo e($related->blog_name); ?></h3>
          <?php if($related->displayMeta()): ?>
          <span class="meta"><?php echo e($related->displayMeta()); ?></span>
          <?php endif; ?>
        </div>
      </a>
      <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
    </div>
  </div>
</section>
<?php endif; ?>
<?php $__env->stopSection(); ?>

<?php echo $__env->make('layouts.nexus', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH /Applications/XAMPP/xamppfiles/htdocs/nexus/resources/views/frontend/nexus/blog-post.blade.php ENDPATH**/ ?>