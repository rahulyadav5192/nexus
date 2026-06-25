@extends('layouts.nexus')

@section('title', 'About — Nexus Group Holdings')
@section('active_page', 'about')

@section('content')
<!-- SUB-HERO -->
  <section class="subhero">
    <div class="subhero-media">
      <video autoplay muted loop playsinline
        poster="https://images.pexels.com/photos/1370882/pexels-photo-1370882.jpeg?auto=compress&cs=tinysrgb&w=1920"
        style="width:100%;height:100%;object-fit:cover;display:block">
        <source src="https://www.pexels.com/download/video/8397996/" type="video/mp4">
        <track kind="captions" src="{{ asset('nexus/empty.vtt') }}" label="No dialogue">
      </video>
    </div>
    <div class="wrap">
      <span class="eyebrow reveal">About The Group</span>
      <h1 class="reveal d1">Building a Legacy <span class="serif-i">Beyond Gold.</span></h1>
      <p class="lead reveal d2">A diversified, vertically integrated global enterprise redefining how the world
        experiences gold, luxury and strategic investments.</p>
      <div class="hero-actions reveal d3" style="margin-top:2rem">
        <a class="btn solid" href="{{ route('contactus') }}"><span>Start a Conversation</span> <span class="arr">&rarr;</span></a>
      </div>
    </div>
  </section>

  <!-- OVERVIEW -->
  <section id="overview">
    <div class="wrap editorial">
      <div>
        <span class="eyebrow reveal">Company Overview</span>
        <h2 class="reveal d1" style="margin-top:1.6rem">From a single bullion desk to an <span
            class="serif-i">international group.</span></h2>
      </div>
      <div class="col-meta reveal d2">
        <p class="lead">At Nexus Group Holdings, we are driven by a vision that extends far beyond retail success.
          From sourcing directly at the mines in Africa to refining, manufacturing, wholesale trading, retail
          operations and global investment activities, every initiative is a deliberate step toward long-term
          value and international leadership.</p>
        <p class="lead" style="margin-top:1.4rem">Our objective is a balanced ecosystem &mdash; one that combines the
          enduring strength of precious metals with modern global investment opportunity.</p>
      </div>
    </div>
  </section>

  <!-- OUR STORY -->
  <section id="story" style="background:var(--ink-2);border-block:1px solid var(--line)">
    <div class="wrap">
      <span class="eyebrow reveal">Our Story</span>
      <div class="editorial" style="margin-top:1.6rem">
        <h2 class="reveal d1" style="font-size:var(--fs-h2);font-weight:300">A journey of deliberate, <span
            class="serif-i">vertical growth.</span></h2>
        <div class="col-meta reveal d2">
          <p class="lead">Nexus began its journey in 2021 in Sharjah as a Gold Bullion and Booking firm. In 2022 we
            entered the retail jewelry sector with the launch of our first showroom, Nexus Gold &amp; Diamonds at
            Sharjah Gold Centre, Rolla, Sharjah (Shop No. 13). Building on this success, in 2024 we expanded to
            Ras Al Khaimah with Nexus Gold &amp; Diamonds at Safa Mall, Nesto Hypermarket, Nakheel, Ras Al Khaimah
            (Shop No. 02).</p>
          <p class="lead" style="margin-top:1.4rem">In parallel, we proudly launched our exclusive jewelry brand
            <em>Regalia</em>, dedicated to lightweight diamond ornaments, while strengthening our
            manufacturing capabilities through the Nexus Chain Manufacturing Facility at Al Sarab Goldsmith,
            Sharjah &mdash; an established manufacturing facility operating since 1996, producing 3 kg of gold chains
            per day (90 kg monthly).
          </p>
          <p class="lead" style="margin-top:1.4rem">The Group expanded into Africa through NEXCORP INTERNATIONAL &ndash;
            AFRICA, strengthening sourcing and trading operations across Uganda, Congo and Rwanda, and established
            the NEXCORP Gold Refinery &amp; Elution Plant in Uganda &mdash; currently processing 2 tons of carbon
            material per cycle, with an immediate expansion planned to double capacity to 4 tons per cycle.
          </p>
        </div>
      </div>
    </div>
  </section>

  <!-- VISION / MISSION -->
  <section id="vm">
    <div class="wrap">
      <span class="eyebrow reveal">Vision &amp; Mission</span>
      <div class="vm">
        <div class="vm-card reveal d1">
          <span class="vm-k">Vision</span>
          <h2>To become a globally trusted leader in gold, jewelry, refining, investments and international trade
            &mdash; through innovation, integrity and sustainable growth.</h2>
        </div>
        <div class="vm-card reveal d2">
          <span class="vm-k">Mission</span>
          <h2>To offer ethically sourced, high-quality jewelry with premium service &mdash; establishing Nexus Group
            Holdings
            as a globally trusted leader in gold, investments, refining and international trade through innovation,
            excellence and sustainable growth.</h2>
        </div>
      </div>
    </div>
  </section>

  <!-- CORE VALUES -->
  <section id="values" style="background:var(--ink-2);border-block:1px solid var(--line)">
    <div class="wrap">
      <div class="stats-head">
        <h2 class="reveal" style="font-size:var(--fs-h2);font-weight:300">Our core <span class="serif-i">values.</span>
        </h2>
        <p class="reveal d1" style="color:var(--bone-dim);max-width:32ch;font-weight:300">
          The principles that anchor every decision across the Group.</p>
      </div>
      <div class="values">
        <div class="value reveal"><span class="vn">01</span>
          <h3>Integrity</h3>
          <p>Transparent, ethical conduct across sourcing, trading and every client relationship.</p>
        </div>
        <div class="value reveal d1"><span class="vn">02</span>
          <h3>Excellence</h3>
          <p>Operational rigour and craftsmanship from the refinery floor to the showroom.</p>
        </div>
        <div class="value reveal d2"><span class="vn">03</span>
          <h3>Innovation</h3>
          <p>Modern systems, digital commerce and capital-market thinking applied to a traditional asset.</p>
        </div>
        <div class="value reveal"><span class="vn">04</span>
          <h3>Sustainability</h3>
          <p>Responsible growth and a roadmap toward traceable, ethical gold sourcing.</p>
        </div>
        <div class="value reveal d1"><span class="vn">05</span>
          <h3>Trust</h3>
          <p>A name built to be relied upon by partners, investors and customers alike.</p>
        </div>
        <div class="value reveal d2"><span class="vn">06</span>
          <h3>Long-Term Growth</h3>
          <p>Decisions measured in decades &mdash; value compounded across the full value chain.</p>
        </div>
      </div>
    </div>
  </section>

  <section id="milestones">
    <div class="wrap">
      <span class="eyebrow reveal">Milestones</span>
      <h2 class="reveal d1" style="margin-top:1.6rem;font-size:var(--fs-h2);font-weight:300">A timeline of <span
          class="serif-i">momentum.</span></h2>
      <div class="milestones">
        <div class="ms done reveal">
          <div class="y">2021</div>
          <h3>Nexus Bullion established</h3>
          <p>The Group begins in Sharjah as a Gold Bullion and Booking firm &mdash; online and offline bullion trading.
          </p>
        </div>
        <div class="ms done reveal">
          <div class="y">2022</div>
          <h3>First retail showroom</h3>
          <p>Nexus Gold &amp; Diamonds opens at Shop No. 13, Sharjah Gold Centre, Rolla &mdash; premium gold and diamond
            retail.</p>
        </div>
        <div class="ms done reveal">
          <div class="y">2024</div>
          <h3>Ras Al Khaimah expansion</h3>
          <p>Second showroom opens at Shop No. 02, Safa Mall, Nesto Hypermarket, Nakheel, Ras Al Khaimah.</p>
        </div>
        <div class="ms done reveal">
          <div class="y">2024</div>
          <h3>Regalia brand launch</h3>
          <p>An exclusive lightweight ornaments and diamond jewelry brand joins the portfolio &mdash; modern design for
            everyday luxury.</p>
        </div>
        <div class="ms done reveal">
          <div class="y">2024-2025</div>
          <h3>Africa &amp; refining</h3>
          <p>NEXCORP International &ndash; Africa established, and the NEXCORP Gold Elution Plant (Uganda) begins
            operations &mdash; 2 tons/cycle capacity.</p>
        </div>
        <div class="ms reveal">
          <div class="y">2025–2026</div>
          <h3>Dubai flagship &amp; Group HQ</h3>
          <p>Flagship Dubai showroom opens at Nesto Mall alongside the strategic, investment-focused NEXUS Group HQ in
            Dubai.</p>
        </div>
        <div class="ms reveal">
          <div class="y">2026-2027</div>
          <h3>Dubai, Abu Dhabi and Ajman Showrooms</h3>
          <p>Expansion to Fujairah (Lulu Mall) as a main branch &amp; base of operations, and Ajman mall-based showroom.
          </p>
        </div>
        <div class="ms reveal">
          <div class="y">2028</div>
          <h3>GCC &amp; international growth</h3>
          <p>Saudi Arabia, Bahrain, Qatar &mdash; and long-term Europe entry with IPO readiness on DFM/ADX by 2030.</p>
        </div>
      </div>
    </div>
  </section>

  <!-- ============ CTA BAND ============ -->
  <section class="cta-video-band">
    <!-- video background -->
    <div class="cta-bg">
      </video>
      <div class="cta-overlay-dark"></div>
      <div class="cta-overlay-glow"></div>
    </div>
    <!-- centered content -->
    <div class="wrap cta-wrap">
      <span class="eyebrow reveal" style="color:var(--gold-soft);margin-bottom:1.8rem;display:block">Next</span>
      <h2 class="reveal d1"
        style="font-size:var(--fs-display);font-weight:300;color:#F5EFE3;max-width:20ch;margin-inline:auto;line-height:1.05">
        Explore the <span class="serif-i">group companies.</span>
      </h2>
      <div class="reveal d3" style="display:flex;gap:1rem;flex-wrap:wrap;justify-content:center;margin-top:2.6rem">
        <a class="btn solid reveal d2" href="{{ route('companies') }}"><span>View Portfolio</span> <span
            class="arr">&rarr;</span></a>
      </div>
    </div>
  </section>

  <!-- FOOTER -->
@endsection
