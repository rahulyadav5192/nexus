@extends('layouts.nexus')

@section('title', 'Leadership — Nexus Group Holdings')
@section('active_page', 'leadership')

@section('content')
<!-- SUB-HERO -->
  <section class="subhero" style="min-height:54dvh">
    <div class="subhero-media">
      <video autoplay muted loop playsinline
        poster="https://images.pexels.com/photos/1370882/pexels-photo-1370882.jpeg?auto=compress&cs=tinysrgb&w=1920"
        style="width:100%;height:100%;object-fit:cover;display:block">
        <source src="https://www.pexels.com/download/video/8397996/" type="video/mp4">
        <track kind="captions" src="{{ asset('nexus/empty.vtt') }}" label="No dialogue">
      </video>
    </div>
    <div class="wrap">
      <span class="eyebrow reveal">Leadership</span>
      <h1 class="reveal d1">Leadership driving <span class="serif-i">global growth.</span></h1>
      <p class="lead reveal d2">A founding team with depth across gold, manufacturing, trade and investment &mdash;
        building an internationally respected group.</p>
    </div>
  </section>

  <!--  MESSAGES -->
  <section id="ceo">
    <div class="wrap">
      <span class="eyebrow reveal">From The CEO</span>
      <div class="ceo" style="margin-top: 0.5rem;">
        <div class="ceo-portrait reveal d1"><img src="{{ asset('nexus/images/al-ameen-ceo.webp') }}"
            alt="Al Ameen, CEO and Founder — Nexus Group Holdings"></div>
        <div class="ceo-body reveal d2">
          <p class="ceo-quote" style="font-size: clamp(1.2rem, 2vw, 1.8rem);">"We are driven by a vision that extends
            <span class="serif-i">far beyond retail
              success</span> &mdash; building a vertically integrated enterprise that redefines how the world
            experiences gold. From sourcing directly at the mines to crafting in our workshops, from pioneering
            brands like Regalia to expanding our footprint with new showrooms across the UAE, every initiative is
            a deliberate step toward long-term leadership in the global jewelry industry."
          </p>
          <p>From sourcing directly at the mines in Africa to refining, manufacturing, wholesale trading, retail
            and global investment, every initiative is a deliberate step toward long-term value, sustainable
            growth and international leadership.</p>
          <p>Our strength lies in vertical integration &mdash; owning each stage of the journey, from raw gold to the
            finished piece, and from the showroom floor to the capital markets. Leadership, in my view, is not
            about short-term gains but about building an enduring legacy &mdash; upholding the values of integrity,
            innovation and excellence, while continually adapting to the evolving needs of our customers and
            markets.</p>
          <div class="ceo-sign">
            <div class="n">Al Ameen</div>
            <div class="r">CEO &amp; Founder &middot; BE, MBA, PMP</div>
          </div>
        </div>
      </div>
    </div>
  </section>

  <!-- BOARD -->
  <section id="board" style="background:var(--ink-2);border-block:1px solid var(--line)">
    <div class="wrap">
      <span class="eyebrow reveal">The Team</span>
      <h2 class="reveal d1" style="margin-top:1.6rem;font-size:var(--fs-h2);font-weight:300">
        Promoters, Founders &amp; <span class="serif-i">Director Board.</span></h2>

      <div class="group-label reveal">Promoters</div>
      <div class="lead-grid">
        <div class="person reveal">
          <div class="frame"><img
              src="https://images.pexels.com/photos/2182970/pexels-photo-2182970.jpeg?auto=compress&cs=tinysrgb&w=800&h=800&fit=crop"
              alt="Shareef, Promoter — Nexus Group Holdings"></div>
          <div class="name">Shareef</div>
          <div class="role">Promotor (MD - Al Madeena Group)</div>
        </div>
        <div class="person reveal d1">
          <div class="frame"><img src="{{ asset('nexus/images/noor-mohmd.webp') }}" alt="Noor Mohammed K, Promoter — Nexus Group Holdings"></div>
          <div class="name">Noor Mohammed K</div>
          <div class="role">Promotor (Chairman &amp; CEO - Panorama Oils)</div>
        </div>
      </div>

      <div class="group-label reveal">Founders</div>
      <div class="lead-grid">
        <div class="person reveal">
          <div class="frame"><img src="{{ asset('nexus/images/al-ameen.webp') }}" alt="Al Ameen, CEO & Founder — Nexus Group Holdings"></div>
          <div class="name">Al Ameen</div>
          <div class="role">CEO &amp; Founder</div>
        </div>
        <div class="person reveal d1">
          <div class="frame"><img src="{{ asset('nexus/images/shoukathali.webp') }}" alt="Shoukath MT, MD & Founder — Nexus Group Holdings"></div>
          <div class="name">Shoukath MT</div>
          <div class="role">MD &amp; Founder</div>
        </div>
        <div class="person reveal d2">
          <div class="frame"><img src="{{ asset('nexus/images/noushad-karanath.webp') }}"
              alt="Noushad Karanath, Founder & Head of Operations — Nexus Group Holdings"></div>
          <div class="name">Noushad Karanath</div>
          <div class="role">Founder &amp; Head of Operations</div>
        </div>
        <div class="person reveal d3">
          <div class="frame"><img src="{{ asset('nexus/images/kader-muneer.webp') }}" alt="Kader Muneer, Founder & HR — Nexus Group Holdings"></div>
          <div class="name">Kader Muneer</div>
          <div class="role">Founder &amp; HR</div>
        </div>
      </div>

      <div class="stats-head" style="margin-top: 4rem;">
        <div>
          <h2 class="reveal d1" style="font-size:var(--fs-h2);font-weight:300">
            Director <span class="serif-i">Board.</span></h2>
          <p class="reveal d2" style="color:var(--ink-dim); max-width: 40ch;">Directors of different entities</p>
        </div>
      </div>

      <div class="lead-grid" style="margin-top:2rem">
        <div class="person reveal">
          <div class="frame"><img
              src="https://images.pexels.com/photos/2128807/pexels-photo-2128807.jpeg?auto=compress&cs=tinysrgb&w=800&h=800&fit=crop"
              alt="Nisar Chola"></div>
          <div class="name">Nisar Chola</div>
          <div class="role">Director</div>
        </div>
        <div class="person reveal d1">
          <div class="frame"><img
              src="https://images.pexels.com/photos/3785079/pexels-photo-3785079.jpeg?auto=compress&cs=tinysrgb&w=800&h=800&fit=crop"
              alt="Mutumba Ahmed"></div>
          <div class="name">Mutumba Ahmed</div>
          <div class="role">Director</div>
        </div>
        <div class="person reveal d2">
          <div class="frame"><img
              src="https://images.pexels.com/photos/1043471/pexels-photo-1043471.jpeg?auto=compress&cs=tinysrgb&w=800&h=800&fit=crop"
              alt="Abdul Naser"></div>
          <div class="name">Abdul Naser</div>
          <div class="role">Director</div>
        </div>
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
        <track kind="captions" src="{{ asset('nexus/empty.vtt') }}" label="No dialogue">
      </video>
      <div class="cta-overlay-dark"></div>
      <div class="cta-overlay-glow"></div>
    </div>
    <!-- centered content -->
    <div class="wrap cta-wrap">
      <span class="eyebrow reveal" style="color:var(--gold-soft);margin-bottom:1.8rem;display:block">Join Us</span>
      <h2 class="reveal d1"
        style="font-size:var(--fs-display);font-weight:300;color:#F5EFE3;max-width:20ch;margin-inline:auto;line-height:1.05">
        Build your future <span class="serif-i">with Nexus.</span>
      </h2>
      <div class="reveal d3" style="display:flex;gap:1rem;flex-wrap:wrap;justify-content:center;margin-top:2.6rem">
        <a class="btn solid reveal d2" href="{{ route('careers') }}"><span>View Careers</span> <span class="arr">&rarr;</span></a>
      </div>
    </div>
  </section>

  <!-- FOOTER -->
@endsection
