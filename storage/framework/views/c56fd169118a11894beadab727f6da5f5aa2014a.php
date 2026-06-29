

<?php $__env->startSection('title', 'Operations — Nexus Group Holdings'); ?>
<?php $__env->startSection('meta_description', 'The Group\'s operations across the gold value chain — sourcing, refining, manufacturing, wholesale, retail and investment.'); ?>
<?php $__env->startSection('active_page', 'operations'); ?>

<?php $__env->startSection('content'); ?>
<!-- SUB-HERO -->
<section class="subhero">
  <div class="subhero-media">
    <video autoplay muted loop playsinline poster="https://images.pexels.com/photos/1370882/pexels-photo-1370882.jpeg?auto=compress&cs=tinysrgb&w=1920" style="width:100%;height:100%;object-fit:cover;display:block">
      <source src="https://www.pexels.com/download/video/8397996/" type="video/mp4">
        <track kind="captions" src="<?php echo e(asset('nexus/empty.vtt')); ?>" label="No dialogue">
    </video>
  </div>
  <div class="wrap">
    <span class="eyebrow reveal">Operations</span>
    <h1 class="reveal d1">From the mine to the <span class="serif-i">showroom.</span></h1>
    <p class="lead reveal d2">A single, integrated chain of operations &mdash; every stage owned and operated by the
      Group, from African sourcing to capital-market investment.</p>
        <div class="hero-actions reveal d3" style="margin-top:2rem">
        <a class="btn solid" href="<?php echo e(route('contactus')); ?>"><span>Start a Conversation</span> <span class="arr">&rarr;</span></a>
      </div>
  </div>
</section>

<!-- FILTERS + OPERATIONS -->
<section id="operations">
  <div class="wrap">
    <span class="eyebrow reveal">Across The Value Chain</span>
    <h2 class="reveal d1" style="margin-top:1.6rem;font-size:var(--fs-h2);font-weight:300">
      Six operating <span class="serif-i">disciplines.</span></h2>


    <div class="op-grid" id="opGrid">
      <?php $__empty_1 = true; $__currentLoopData = $services; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $item): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); $__empty_1 = false; ?>
      <article class="op reveal<?php echo e($item->reveal_delay ? ' ' . $item->reveal_delay : ''); ?>" data-cat="<?php echo e($item->category_slug); ?>">
        <div class="op-media">
          <span class="cat-tag"><?php echo e($item->category_tag); ?></span>
          <img loading="lazy" src="<?php echo e($item->image_url); ?>" alt="<?php echo e($item->image_alt ?? $item->name); ?>">
        </div>
        <div class="op-body">
          <h3><?php echo e($item->name); ?></h3>
          <p><?php echo e($item->short_description); ?></p>
          <?php if(!empty($item->highlights)): ?>
          <div class="op-hl">
            <?php $__currentLoopData = $item->highlights; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $highlight): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
            <span class="h">
              <span class="hn"><?php echo e($highlight['value'] ?? ''); ?><?php if(!empty($highlight['suffix'])): ?><span style="font-size:.5em"><?php echo e($highlight['suffix']); ?></span><?php endif; ?></span>
              <span class="hl-l"><?php echo e($highlight['label'] ?? ''); ?></span>
            </span>
            <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
          </div>
          <?php elseif(!empty($item->bullet_points)): ?>
          <ul class="op-list">
            <?php $__currentLoopData = $item->bullet_points; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $point): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
            <li><?php echo e($point); ?></li>
            <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
          </ul>
          <?php endif; ?>
        </div>
      </article>
      <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); if ($__empty_1): ?>
      <p style="color:var(--bone-dim);grid-column:1/-1">No operating disciplines have been added yet.</p>
      <?php endif; ?>
    </div>
  </div>
</section>

<!-- OPERATIONS BACKBONE -->
<section id="backbone" style="background:var(--ink-2);border-block:1px solid var(--line)">
  <div class="wrap">
    <div class="stats-head">
      <h2 class="reveal" style="font-size:var(--fs-h2);font-weight:300">Operational <span class="serif-i">backbone.</span></h2>
      <p class="reveal d1" style="color:var(--bone-dim);max-width:34ch;font-weight:300">
        Sourcing, systems and security that keep the chain running.</p>
    </div>
    <div class="present-grid">
      <div class="present reveal"><div class="pc">Inventory Sourcing</div>
        <ul><li>Africa &mdash; Uganda, Congo, Rwanda</li><li>Dubai Gold Souk</li><li>India</li></ul></div>
      <div class="present reveal d1"><div class="pc">Systems &amp; SOPs</div>
        <ul><li>Inventory management system</li><li>Customer service, returns &amp; repairs</li><li>Buy-back &amp; customization</li><li>VIP membership &amp; loyalty program</li></ul></div>
      <div class="present reveal"><div class="pc">Security &amp; Compliance</div>
        <ul><li>Vaults &amp; surveillance</li><li>Insurance &mdash; inventory, premises, staff</li><li>AML / KYC compliance (UAE gold trade)</li><li>Gold import/export permits</li></ul></div>
      <div class="present reveal d1"><div class="pc">Revenue Streams</div>
        <ul><li>In-store retail sales</li><li>Online store / e-commerce</li><li>VIP &amp; wholesale clients</li><li>Jewelry customization</li><li>Buy-back programs</li><li>Gold investment products</li></ul></div>
    </div>
  </div>
</section>

<!-- ============ CTA BAND ============ -->
<section class="cta-video-band">
  <!-- video background -->
  <div class="cta-bg">
      <video autoplay muted loop playsinline
           poster="https://images.pexels.com/photos/1370882/pexels-photo-1370882.jpeg?auto=compress&cs=tinysrgb&w=1920"
           style="width:100%;height:100%;object-fit:cover;display:block">
      <source src="https://www.pexels.com/download/video/8397996/" type="video/mp4">
        <track kind="captions" src="<?php echo e(asset('nexus/empty.vtt')); ?>" label="No dialogue">
    </video>
    <div class="cta-overlay-dark"></div>
    <div class="cta-overlay-glow"></div>
  </div>
  <!-- centered content -->
  <div class="wrap cta-wrap">
    <span class="eyebrow reveal" style="color:var(--gold-soft);margin-bottom:1.8rem;display:block">Next</span>
    <h2 class="reveal d1" style="font-size:var(--fs-display);font-weight:300;color:#F5EFE3;max-width:20ch;margin-inline:auto;line-height:1.05">
      The people behind <span class="serif-i">the Group.</span>
    </h2>
    <div class="reveal d3" style="display:flex;gap:1rem;flex-wrap:wrap;justify-content:center;margin-top:2.6rem">
      <a class="btn solid reveal d2" href="<?php echo e(route('leadership')); ?>"><span>Meet The Leadership</span> <span class="arr">&rarr;</span></a>
    </div>
  </div>
</section>

<!-- FOOTER -->
<?php $__env->stopSection(); ?>

<?php echo $__env->make('layouts.nexus', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH /Applications/XAMPP/xamppfiles/htdocs/nexus/resources/views/frontend/nexus/operations.blade.php ENDPATH**/ ?>