

<?php $__env->startSection('title', 'Nexus Group Holdings — Gold, Luxury & Global Investments'); ?>
<?php $__env->startSection('active_page', 'home'); ?>

<?php $__env->startSection('page_styles'); ?>
<style>
/* &mdash;&rdquo; Page-level overrides &mdash;&rdquo; */



    /* Hero h1 word-split animation */
    .hero h1 .word {
      display: inline;
      white-space: nowrap
    }

    .hero h1 .word .inner {
      display: inline;
      opacity: 0;
      animation: wordFade .8s cubic-bezier(.32, .72, 0, 1) forwards
    }

    @keyframes  wordFade {
      0% {
        opacity: 0;
        filter: blur(6px);
        transform: translateY(12px)
      }

      to {
        opacity: 1;
        filter: none;
        transform: none
      }
    }

    /* Roadmap editorial redesign */
    .roadmap-editorial {
      position: relative;
      overflow: hidden;
      padding-block: var(--section-y)
    }

    .roadmap-parallax-bg {
      position: absolute;
      inset: 0;
      background-image: url('<?php echo e(asset('nexus/images/nexcorp-internation.webp')); ?>');
      background-attachment: fixed;
      background-size: cover;
      background-position: center;
      z-index: 0
    }

    .roadmap-parallax-bg::after {
      content: "";
      position: absolute;
      inset: 0;
      background: rgba(8, 6, 3, .88)
    }

    .roadmap-wrap {
      position: relative;
      z-index: 1
    }

    .roadmap-editorial h2,
    .roadmap-editorial h3 {
      color: #F5EFE3
    }

    .roadmap-editorial p,
    .roadmap-editorial li {
      color: rgba(245, 239, 227, .6)
    }

    .roadmap-editorial .eyebrow {
      color: var(--gold-soft)
    }

    .roadmap-editorial .rm-phases {
      border-top-color: rgba(255,255,255,.1)
    }

    .roadmap-editorial .rm-phase {
      border-right-color: rgba(255,255,255,.1)
    }

    .roadmap-editorial .link-arrow {
      color: #F5EFE3 !important
    }

    .rm-intro {
      display: grid;
      grid-template-columns: 1fr 1fr;
      gap: clamp(1.5rem, 4vw, 4rem);
      align-items: start;
      margin-bottom: clamp(2rem, 4vw, 3.5rem)
    }

    .rm-phases {
      display: grid;
      grid-template-columns: repeat(4, 1fr);
      border-top: 1px solid var(--line)
    }

    .rm-phase {
      padding: clamp(1.2rem, 2.5vw, 2rem) clamp(.8rem, 1.5vw, 1.8rem) clamp(1.2rem, 2.5vw, 2rem) 0;
      border-right: 1px solid var(--line)
    }

    .rm-phase:last-child {
      border-right: none
    }

    .rm-phase-num {
      font-family: var(--serif);
      font-size: clamp(3.5rem, 7vw, 6rem);
      font-weight: 300;
      line-height: .9;
      color: transparent;
      -webkit-text-stroke: 1px var(--gold-soft);
      margin-bottom: 1.4rem
    }

    .rm-phase-yr {
      font-size: .62rem;
      letter-spacing: .22em;
      text-transform: uppercase;
      color: var(--gold);
      margin-bottom: .9rem
    }

    .rm-phase h3 {
      font-family: var(--serif);
      font-size: clamp(1.2rem, 2vw, 1.7rem);
      font-weight: 400;
      margin-bottom: 1.1rem;
      line-height: 1.15
    }

    .rm-phase ul {
      list-style: none;
      display: flex;
      flex-direction: column;
      gap: .55rem
    }

    .rm-phase li {
      color: var(--ink-dim);
      font-size: .88rem;
      padding-left: 1rem;
      position: relative
    }

    .rm-phase li::before {
      content: "";
      position: absolute;
      left: 0;
      top: .55em;
      width: 4px;
      height: 1px;
      background: var(--gold)
    }

    .rm-live .rm-phase-num {
      -webkit-text-stroke: 1px var(--gold);
      color: transparent
    }

    .rm-live h3 {
      color: var(--ink)
    }

    /* Testimonials */
    .testi-section {
      position: relative;
      overflow: hidden;
      border-top: 1px solid var(--line)
    }

    .testi-parallax-bg {
      position: absolute;
      inset: 0;
      background-image: url('<?php echo e(asset('nexus/images/nexus-gold-and-diamonds.webp')); ?>');
      background-attachment: fixed;
      background-size: cover;
      background-position: center;
      z-index: 0
    }

    .testi-parallax-bg::after {
      content: "";
      position: absolute;
      inset: 0;
      background: rgba(8, 6, 3, .9)
    }

    .testi-wrap {
      position: relative;
      z-index: 1
    }

    .testi-grid {
      display: grid;
      grid-template-columns: repeat(3, 1fr);
      gap: 1.6rem;
      margin-top: clamp(2.5rem, 5vw, 4rem)
    }

    .testi-card {
      background: var(--card);
      border-radius: var(--r);
      padding: clamp(1.8rem, 3vw, 2.4rem);
      position: relative;
      box-shadow: var(--shadow)
    }

    .testi-card::before {
      content: "";
      position: absolute;
      top: 0;
      left: 0;
      width: 40px;
      height: 2px;
      background: var(--gold)
    }

    .testi-quote {
      font-family: var(--serif);
      font-size: 3.2rem;
      line-height: .7;
      color: var(--gold);
      opacity: .5;
      margin-bottom: 1.2rem;
      display: block
    }

    .testi-text {
      color: var(--ink-dim);
      font-size: .95rem;
      line-height: 1.75;
      font-style: italic
    }

    .testi-author {
      margin-top: 1.6rem;
      padding-top: 1.2rem;
      border-top: 1px solid var(--line)
    }

    .testi-name {
      font-weight: 600;
      font-size: .88rem;
      color: var(--ink);
      letter-spacing: .02em
    }

    .testi-role {
      font-size: .78rem;
      color: var(--gold);
      letter-spacing: .06em;
      text-transform: uppercase;
      margin-top: .25rem
    }

    @media(max-width:900px) {
      .testi-grid { grid-template-columns: 1fr 1fr }
    }

    @media(max-width:600px) {
      .testi-grid { grid-template-columns: 1fr }
    }

    /* Ecosystem directory parallax */
    #ecosystem-dir {
      position: relative;
      overflow: hidden
    }

    .eco-dir-bg {
      position: absolute;
      inset: 0;
      background-image: url('<?php echo e(asset('nexus/images/bg.webp')); ?>');
      background-attachment: fixed;
      background-size: cover;
      background-position: center;
      z-index: 0
    }

    .eco-dir-bg::after {
      content: "";
      position: absolute;
      inset: 0;
      background: rgba(8, 6, 3, .82)
    }

    .eco-dir-grid {
      grid-template-columns: repeat(4, 1fr)
    }

    .eco-stat {
      border-color: rgba(255, 255, 255, .08)
    }

    .eco-sub {
      font-size: .72rem;
      letter-spacing: .12em;
      text-transform: uppercase;
      color: var(--gold);
      margin: .5rem 0 .8rem
    }

    .eco-loc {
      font-size: .88rem;
      color: #fff;
      line-height: 1.7;
      margin-top: .5rem
    }

    @media(max-width:900px) {
      .eco-dir-grid { grid-template-columns: repeat(2, 1fr) }
    }

    @media(max-width:500px) {
      .eco-dir-grid { grid-template-columns: 1fr }
    }

    /* CTA with image background */
    .cta-image-band {
      position: relative;
      overflow: hidden;
      text-align: center
    }

    .cta-image-band .cta-bg {
      position: absolute;
      inset: 0;
      z-index: 0
    }

    .cta-image-band .cta-bg img {
      width: 100%;
      height: 100%;
      object-fit: cover;
      filter: brightness(.28)
    }

    .cta-image-band .wrap {
      position: relative;
      z-index: 2;
      display: flex;
      flex-direction: column;
      align-items: center
    }

    .cta-image-band h2 {
      font-size: var(--fs-display);
      font-weight: 300;
      max-width: 22ch;
      margin: 1.6rem 0 2.4rem;
      color: #F5EFE3
    }

    .cta-image-band h2 .serif-i {
      color: var(--gold-soft)
    }

    .cta-image-band .eyebrow {
      color: var(--gold-soft)
    }

    .cta-image-band .btn {
      background: rgba(255, 255, 255, .08);
      border-color: rgba(255, 255, 255, .2);
      color: #F5EFE3
    }

    .cta-image-band .btn .arr {
      background: rgba(255, 255, 255, .16)
    }

    .cta-image-band .btn.solid {
      background: var(--gold-soft);
      color: var(--on-gold);
      border-color: transparent
    }

    /* Pexels image cards */
    .eco-card {
      box-shadow: none
    }

    /* Section split image */
    .split-img-section {
      display: grid;
      grid-template-columns: 1fr 1fr;
      min-height: 520px
    }

    .split-img-section .split-img {
      overflow: hidden
    }

    .split-img-section .split-img img {
      width: 100%;
      height: 100%;
      object-fit: cover;
      display: block
    }

    .split-img-section .split-body {
      padding: clamp(2rem, 5vw, 4rem) clamp(1.5rem, 4vw, 3.5rem);
      display: flex;
      flex-direction: column;
      justify-content: center;
      background: var(--espresso)
    }

    .split-img-section .split-body h2 {
      font-size: var(--fs-h2);
      font-weight: 300;
      color: #F5EFE3
    }

    .split-img-section .split-body h2 .serif-i {
      color: var(--gold-soft)
    }

    .split-img-section .split-body p {
      color: rgba(245, 239, 227, .7);
      font-size: var(--fs-lead);
      margin-top: 1.4rem;
      max-width: 44ch
    }

    .split-img-section .split-body .btn {
      margin-top: 2.4rem
    }

    @media(max-width:760px) {
      .rm-phases {
        grid-template-columns: 1fr 1fr
      }

      .rm-phase {
        border-right: none;
        border-bottom: 1px solid var(--line)
      }

      .rm-phase:last-child {
        border-bottom: none
      }

      .rm-intro {
        grid-template-columns: 1fr
      }

      .split-img-section {
        grid-template-columns: 1fr
      }

      .split-img-section .split-img {
        min-height: 280px
      }
    }
</style>
<?php $__env->stopSection(); ?>

<?php $__env->startSection('content'); ?>
<!-- ============ HERO ============ -->
  <section class="hero">
    <div class="hero-media">
      <video autoplay muted loop playsinline
        poster="https://images.pexels.com/photos/1370882/pexels-photo-1370882.jpeg?auto=compress&cs=tinysrgb&w=1920">
        <source src="https://www.pexels.com/download/video/8397996/" type="video/mp4">
        <track kind="captions" src="<?php echo e(asset('nexus/empty.vtt')); ?>" label="No dialogue">
        <!-- fallback image -->
        <img src="https://images.pexels.com/photos/1370882/pexels-photo-1370882.jpeg?auto=compress&cs=tinysrgb&w=1920"
          alt="Gold jewelry">
      </video>
    </div>
    <div class="wrap">
      <h1 id="heroTitle"
        style="font-size:clamp(1.9rem,4vw + 1rem,5.8rem);font-weight:300;max-width:22ch;margin-bottom:2rem;color:#fff;letter-spacing:-.025em;line-height:1.08">
      </h1>
      <p class="lead reveal d2">A diversified and vertically integrated group spanning gold sourcing, refining,
        jewelry manufacturing, trading, retail and strategic investments &mdash; from the mines of Africa to
        international capital markets.</p>
      <div class="hero-actions reveal d3">
        <a class="btn solid" href="<?php echo e(route('companies')); ?>"><span>Explore Our Group</span> <span class="arr">&rarr;</span></a>
        <a class="btn ghost" href="<?php echo e(route('expansion')); ?>"><span>View Expansion Vision</span></a>
      </div>
    </div>
  </section>

  <!-- ============ ABOUT ============ -->
  <section id="about">
    <div class="wrap editorial">
      <div>
        <span class="eyebrow reveal">About The Group</span>
        <h2 class="reveal d1" style="margin-top:1.6rem">A global enterprise built across the entire <span
            class="serif-i">gold value chain.</span></h2>
      </div>
      <div class="col-meta reveal d2">
        <span class="kicker-num">&mdash; 2021 / Established in Sharjah</span>
        <p class="lead">Nexus began in 2021 in Sharjah as a Gold Bullion and Booking firm. It has since evolved
          into a diversified, vertically integrated group &mdash; sourcing directly at the mines in Africa and moving
          through refining, manufacturing, wholesale, retail and global investment activities.</p>
        <p class="lead" style="margin-top:1.4rem">Our mission: to offer ethically sourced, high-quality jewelry
          with premium service &mdash; building a balanced ecosystem that pairs traditional asset strength with modern
          global investment opportunity, and to be recognised for innovation, integrity and operational excellence.</p>
        <div style="margin-top:2.4rem"><a class="link-arrow" href="<?php echo e(route('about')); ?>">Read Our Story <span
              class="arr">&rarr;</span></a></div>
      </div>
    </div>
  </section>

  <!-- ============ SNAPSHOT / STATS ============ -->
  <section id="snapshot">
    <div class="wrap">
      <div class="stats-head">
        <h2 class="reveal">The Group at a <span class="serif-i">glance.</span></h2>
        <p class="reveal d1" style="color:var(--bone-dim);max-width:36ch;font-weight:300">
          An integrated ecosystem operating across the UAE and Africa &mdash; with sourcing reaching Uganda, Congo
          and Rwanda, and expansion planned through the GCC, India and Europe.</p>
      </div>
      <div class="stats-grid">
        <div class="stat reveal">
          <div class="num">2021</div>
          <div class="label">Established</div>
          <div class="desc">Founded as a Gold Bullion &amp; Booking firm in Sharjah.</div>
        </div>
        <div class="stat reveal d1">
          <div class="num"><span data-count="5" data-pad="true">00</span></div>
          <div class="label">Countries of Operation</div>
          <div class="desc">United Arab Emirates &amp; Africa.</div>
        </div>
        <div class="stat reveal d2">
          <div class="num"><span data-count="8">0</span><span class="suf">+</span></div>
          <div class="label">Business Divisions</div>
          <div class="desc">Sourcing, refining, manufacturing, retail, e-commerce &amp; investments.</div>
        </div>
        <div class="stat reveal d1">
          <div class="num"><span data-count="1" data-pad="true">00</span></div>
          <div class="label">Gold Elution Plant</div>
          <div class="desc">NEXCORP Refinery &amp; Elution Plant in Uganda &mdash; 2 tons/day, expanding to 5 tons.</div>
        </div>
        <div class="stat reveal d2" style="grid-column:span 2">
          <div class="num">2030</div>
          <div class="label">Global Vision</div>
          <div class="desc">Roadmap toward international markets, IPO readiness on DFM/ADX.</div>
        </div>
      </div>

    </div>
  </section>

  <!-- ============ BUSINESS ECOSYSTEM DIRECTORY ============ -->
  <section id="ecosystem-dir">
    <div class="eco-dir-bg"></div>
    <div class="wrap" style="position:relative;z-index:1">
      <div class="stats-head">
        <h2 class="reveal" style="color:#fff">Our Business <span class="serif-i" style="color:var(--gold-soft)">Ecosystem.</span></h2>
      </div>
      <div class="stats-grid eco-dir-grid">
        <div class="stat eco-stat reveal">
          <div class="num" style="color:var(--gold-soft)">01</div>
          <div class="label" style="color:rgba(255,255,255,.45)">Nexus Capital Markets</div>
          <div class="eco-sub">Investments &amp; Wealth Management</div>
          <div class="eco-loc">Saheel Tower 2, Office 607<br>Dubai, UAE</div>
        </div>
        <div class="stat eco-stat reveal d1">
          <div class="num" style="color:var(--gold-soft)">01</div>
          <div class="label" style="color:rgba(255,255,255,.45)">Nexus Chains</div>
          <div class="eco-sub">Gold Jewellery Manufacturing</div>
          <div class="eco-loc">Umm Altarafa &ndash; Al Gharb<br>Sharjah, UAE</div>
        </div>
        <div class="stat eco-stat reveal d2">
          <div class="num" style="color:var(--gold-soft)">01</div>
          <div class="label" style="color:rgba(255,255,255,.45)">Nexcorp Refinery &amp; Elution Plant</div>
          <div class="eco-sub">Uganda Operations</div>
          <div class="eco-loc">Uganda</div>
        </div>
        <div class="stat eco-stat reveal d3">
          <div class="num" style="color:var(--gold-soft)">02</div>
          <div class="label" style="color:rgba(255,255,255,.45)">Retail Showrooms</div>
          <div class="eco-sub">Nexus Gold and Diamond</div>
          <div class="eco-loc">
            <span style="display:block;font-weight:600;color:rgba(255,255,255,.8)">1. Sharjah Gold Centre (Rolla)</span>
            Shop No. 13
            <span style="display:block;font-weight:600;color:rgba(255,255,255,.8);margin-top:.5rem">2. Safa Mall Nesto, RAK (Nakheel)</span>
            Shop No. 2
          </div>
        </div>
      </div>
    </div>
  </section>

  <!-- ============ ECOSYSTEM ============ -->
  <section id="ecosystem">
    <div class="wrap">
      <span class="eyebrow reveal">Our Business Ecosystem</span>
      <h2 class="reveal d1" style="margin-top:1.6rem;max-width:18ch;font-size:var(--fs-h2);font-weight:300">
        Six interlocking divisions, one integrated chain of value.</h2>

      <div class="eco-grid" style="margin-top:clamp(2.5rem,5vw,4rem)">
        <a class="eco-card reveal" href="<?php echo e(route('operations')); ?>">
          <div class="bg"><img loading="lazy"
              src="<?php echo e(asset('nexus/images/nexcorp-internation.webp')); ?>"
              alt="Gold Sourcing and Trading"></div>
          <span class="top"></span>
          <div class="inner">
            <span class="idx">01</span>
            <h3>Gold Sourcing &amp; Trading</h3>
            <p>Direct sourcing across Uganda, Congo &amp; Rwanda through NEXCORP International &ndash; Africa, with
              online and offline bullion trading via Nexus Bullion.</p>
          </div>
        </a>
        <a class="eco-card reveal d1" href="<?php echo e(route('operations')); ?>">
          <div class="bg"><img loading="lazy"
              src="<?php echo e(asset('nexus/images/nexcorp-elution.webp')); ?>"
              alt="Gold Refining and Processing"></div>
          <span class="top"></span>
          <div class="inner">
            <span class="idx">02</span>
            <h3>Refining &amp; Processing</h3>
            <p>The NEXCORP Gold Refinery &amp; Elution Plant in Uganda &mdash; raw gold processing, refining and
              supply-chain integration.</p>
          </div>
        </a>
        <a class="eco-card reveal d2" href="<?php echo e(route('operations')); ?>">
          <div class="bg"><img loading="lazy"
              src="<?php echo e(asset('nexus/images/nexus-chains-manufacturing.webp')); ?>"
              alt="Nexus Chains Manufacturing"></div>
          <span class="top"></span>
          <div class="inner">
            <span class="idx">03</span>
            <h3>Manufacturing</h3>
            <p>Nexus Chains Manufacturing Factory &mdash; Um Altarafa &ndash; Al Gharb &ndash; Sharjah.</p>
          </div>
        </a>
        <a class="eco-card reveal" href="<?php echo e(route('companies')); ?>">
          <div class="bg"><img loading="lazy"
              src="<?php echo e(asset('nexus/images/nexus-gold-and-diamonds.webp')); ?>"
              alt="Nexus Gold and Diamonds"></div>
          <span class="top"></span>
          <div class="inner">
            <span class="idx">04</span>
            <h3>Retail &amp; Wholesale</h3>
            <p>Nexus Gold &amp; Diamonds showrooms and the Regalia exclusive diamond ornaments brand, with a growing
              B2B wholesale division. Wedding &amp; gift packages, VIP membership and buy-back programs.</p>
          </div>
        </a>
        <a class="eco-card reveal d1" href="<?php echo e(route('investors')); ?>">
          <div class="bg"><img loading="lazy"
              src="<?php echo e(asset('nexus/images/investment-divison.webp')); ?>"
              alt="Global investment and finance"></div>
          <span class="top"></span>
          <div class="inner">
            <span class="idx">05</span>
            <h3>Investments &amp; Wealth Management</h3>
            <p>US stocks, ETFs &amp; index funds, international equities, commodities and strategic overseas ventures.</p>
          </div>
        </a>
        <a class="eco-card reveal d2" href="<?php echo e(route('companies')); ?>">
          <div class="bg"><img loading="lazy"
              src="https://images.pexels.com/photos/5632397/pexels-photo-5632397.jpeg?auto=compress&cs=tinysrgb&w=1200"
              alt="Digital commerce and e-commerce"></div>
          <span class="top"></span>
          <div class="inner">
            <span class="idx">06</span>
            <h3>Digital Commerce</h3>
            <p>A dedicated e-commerce division bringing the Group's jewelry online across the UAE and beyond.</p>
          </div>
        </a>
      </div>
    </div>
  </section>

  <!-- ============ ROADMAP ============ -->
  <section class="roadmap-editorial" id="roadmap">
    <div class="roadmap-parallax-bg"></div>
    <div class="wrap roadmap-wrap">
      <div class="rm-intro">
        <div>
          <span class="eyebrow reveal">Expansion Roadmap</span>
          <h2 class="reveal d1" style="margin-top:1.6rem;font-size:var(--fs-h2);font-weight:300;max-width:14ch">
            From first showroom to <span class="serif-i">global listing.</span></h2>
        </div>
        <div class="reveal d2" style="padding-top:.6rem">
          <p style="color:var(--ink-dim);font-size:var(--fs-lead);max-width:44ch;line-height:1.7">Four deliberate phases
            &mdash; each building on the last &mdash; taking Nexus from a single Sharjah outlet in 2021 to an internationally
            listed
            group by 2030.</p>
          <a class="link-arrow" href="<?php echo e(route('expansion')); ?>"
            style="display:inline-flex;align-items:center;gap:.6rem;margin-top:2rem;font-weight:600;font-size:.76rem;letter-spacing:.12em;text-transform:uppercase;color:#F5EFE3">Full
            Expansion Plan <span class="arr" style="color:var(--gold)">&rarr;</span></a>
        </div>
      </div>
      <div class="rm-phases">
        <div class="rm-phase rm-live reveal">
          <div class="rm-phase-num">01</div>
          <div class="rm-phase-yr">2021 &ndash; 2024</div>
          <h3>Foundations &amp; First Showrooms</h3>
          <ul>
            <li>Gold Bullion &amp; Booking firm &mdash; Sharjah</li>
            <li>First retail showroom, Sharjah Gold Centre</li>
            <li>Ras Al Khaimah &mdash; Safa Mall expansion</li>
            <li>Regalia diamond brand launch</li>
            <li>Africa sourcing network &amp; Uganda refinery</li>
          </ul>
        </div>
        <div class="rm-phase rm-live reveal d1">
          <div class="rm-phase-num">02</div>
          <div class="rm-phase-yr">2025 &ndash; 2026</div>
          <h3>UAE Consolidation</h3>
          <ul>
            <li>Dubai flagship &mdash; Nesto Mall</li>
            <li>Abudhabi based showroom</li>
            <li>Ajman mall-based showroom</li>
            <li>Wholesale division launch</li>
            <li>E-commerce platform</li>
            <li>Uganda gold trading division</li>
          </ul>
        </div>
        <div class="rm-phase reveal d2">
          <div class="rm-phase-num">03</div>
          <div class="rm-phase-yr">2027 &ndash; 2028</div>
          <h3>GCC : Retail and Wholesale Scale Up</h3>
          <ul>
            <li>Saudi Arabia &mdash; Riyadh entry</li>
            <li>Abu Dhabi, Bahrain &amp; Qatar</li>
            <li>Full-scale Sharjah factory</li>
            <li>Multilingual GCC campaigns</li>
          </ul>
        </div>
        <div class="rm-phase reveal d3">
          <div class="rm-phase-num">04</div>
          <div class="rm-phase-yr">2029 &ndash; 2030</div>
          <h3>International Markets &amp; IPO</h3>
          <ul>
            <li>Europe &mdash; Antwerp, London, Frankfurt</li>
            <li>East Africa showroom expansion</li>
            <li>Blockchain gold traceability</li>
            <li>IPO &mdash; DFM or ADX by 2030</li>
          </ul>
        </div>
      </div>
    </div>
  </section>

  <!-- ============ LEADERSHIP PREVIEW ============ -->
  <section id="leadership">
    <div class="wrap">
      <div class="stats-head">
        <div>
          <span class="eyebrow reveal">Leadership</span>
          <h2 class="reveal d1" style="margin-top:1.6rem;font-size:var(--fs-h2);font-weight:300">
            Leadership driving <span class="serif-i">global growth.</span></h2>
        </div>
        <a class="btn solid reveal d2" href="<?php echo e(route('leadership')); ?>" style="margin-top:1rem"><span>Meet The Leadership Team</span> <span class="arr">&rarr;</span></a>
      </div>

      <div class="lead-grid">
        <div class="person reveal">
          <div class="frame"><img src="<?php echo e(asset('nexus/images/al-ameen.webp')); ?>" alt="Portrait"></div>
          <div class="name">Al Ameen</div>
          <div class="role">CEO</div>
        </div>
        <div class="person reveal d1">
          <div class="frame"><img src="<?php echo e(asset('nexus/images/shoukathali.webp')); ?>" alt="Portrait"></div>
          <div class="name">Shoukath MT</div>
          <div class="role">Head of Operations UAE</div>
        </div>
        <div class="person reveal d2">
          <div class="frame"><img src="<?php echo e(asset('nexus/images/noushad-karanath.webp')); ?>" alt="Portrait"></div>
          <div class="name">Noushad Karanath</div>
          <div class="role">Head of Operations Africa</div>
        </div>
        <div class="person reveal d3">
          <div class="frame"><img src="<?php echo e(asset('nexus/images/kader-muneer.webp')); ?>" alt="Portrait"></div>
          <div class="name">Kader Muneer</div>
          <div class="role">Head of HR &amp; Admin</div>
        </div>
      </div>
    </div>
  </section>

  <!-- ============ TESTIMONIALS ============ -->
  <?php if(isset($testimonials) && $testimonials->isNotEmpty()): ?>
  <section class="testi-section" id="testimonials">
    <div class="testi-parallax-bg"></div>
    <div class="wrap testi-wrap">
      <span class="eyebrow reveal">What People Say</span>
      <h2 class="reveal d1" style="margin-top:1.6rem;font-size:var(--fs-h2);font-weight:300;max-width:20ch">
        Trusted by partners, clients &amp; <span class="serif-i">investors alike.</span></h2>

      <div class="testi-grid">
        <?php $__currentLoopData = $testimonials; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $index => $testimonial): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
        <div class="testi-card reveal<?php echo e($index > 0 ? ' d' . min($index, 2) : ''); ?>">
          <span class="testi-quote">&ldquo;</span>
          <p class="testi-text"><?php echo e($testimonial->quotes); ?></p>
          <div class="testi-author">
            <div class="testi-name"><?php echo e($testimonial->person_name); ?></div>
            <div class="testi-role"><?php echo e($testimonial->designation); ?></div>
          </div>
        </div>
        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
      </div>
    </div>
  </section>
  <?php endif; ?>

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
      <!-- dark overlay identical to hero -->
      <div class="cta-overlay-dark"></div>
      <!-- gold radial glow -->
      <div
        style="position:absolute;inset:0;background:radial-gradient(ellipse 60% 80% at 50% 50%,rgba(200,169,104,.18),transparent 65%)">
      </div>
    </div>
    <!-- centered content -->
    <div class="wrap cta-wrap">
      <span class="eyebrow reveal" style="color:var(--gold-soft);margin-bottom:1.8rem;display:block">Partnership &amp;
        Investors</span>
      <h2 class="reveal d1"
        style="font-size:var(--fs-display);font-weight:300;color:#F5EFE3;max-width:20ch;margin-inline:auto;line-height:1.05">
        Partner with <span style="font-style:italic;color:var(--gold-soft)">Nexus Group Holdings.</span>
      </h2>
      <p class="reveal d2"
        style="color:rgba(245,239,227,.7);font-size:var(--fs-lead);margin-top:1.4rem;max-width:48ch;margin-inline:auto;line-height:1.75">
        We welcome investors, wholesale partners and strategic collaborators who share our commitment to quality,
        integrity and long-term growth.
      </p>
      <div class="reveal d3" style="display:flex;gap:1rem;flex-wrap:wrap;justify-content:center;margin-top:2.6rem">
        <a class="btn solid" href="<?php echo e(route('contactus')); ?>"><span>Start a Conversation</span> <span class="arr">&rarr;</span></a>
        <a class="btn" href="<?php echo e(route('investors')); ?>"
          style="background:rgba(255,255,255,.08);border-color:rgba(255,255,255,.25);color:#F5EFE3"><span>Investor
            Relations</span></a>
      </div>
    </div>
  </section>

  <!-- ============ FOOTER ============ -->
<?php $__env->stopSection(); ?>

<?php $__env->startSection('page_scripts'); ?>
<script>
    // Hero h1 word-split animation
    (function () {
      var text = 'Building the Future of Gold, Luxury & Global Investments';
      var el = document.getElementById('heroTitle');
      if (!el) return;
      var words = text.split(' ');
      el.innerHTML = words.map(function (w, i) {
        var isGold = w === 'Gold,';
        var inner = isGold
          ? '<span style="color:var(--gold-soft);font-style:italic">' + w.replace(',', '') + ',</span>'
          : w;
        return '<span class="word"><span class="inner" style="animation-delay:' + (i * 0.07 + 0.1) + 's">' + inner + '</span></span> ';
      }).join('');
    })();
  </script>
<?php $__env->stopSection(); ?>

<?php echo $__env->make('layouts.nexus', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH /Applications/XAMPP/xamppfiles/htdocs/nexus/resources/views/frontend/nexus/index.blade.php ENDPATH**/ ?>