@extends('layouts.nexus')

@section('title', 'Careers — Nexus Group Holdings')
@section('meta_description', 'Build your future with Nexus. International exposure, growth opportunities and long-term career development across a fast-growing global group.')
@section('active_page', 'careers')

@section('content')
<!-- SUB-HERO -->
<section class="subhero">
  <div class="subhero-media">
    <video autoplay muted loop playsinline poster="https://images.pexels.com/photos/1370882/pexels-photo-1370882.jpeg?auto=compress&cs=tinysrgb&w=1920" style="width:100%;height:100%;object-fit:cover;display:block">
      <source src="https://www.pexels.com/download/video/8397996/" type="video/mp4">
        <track kind="captions" src="{{ asset('nexus/empty.vtt') }}" label="No dialogue">
    </video>
  </div>
  <div class="wrap">
    <span class="eyebrow reveal">Careers</span>
    <h1 class="reveal d1">Build your future <span class="serif-i">with Nexus.</span></h1>
    <p class="lead reveal d2">Join a fast-growing international group at the intersection of gold, luxury,
      manufacturing and global investment.</p>
        <div class="hero-actions reveal d3" style="margin-top:2rem">
        <a class="btn solid" href="{{ route('contactus') }}"><span>Start a Conversation</span> <span class="arr">&rarr;</span></a>
      </div>
  </div>
</section>

<!-- WHY JOIN -->
<section id="why">
  <div class="wrap">
    <div class="stats-head">
      <h2 class="reveal" style="font-size:var(--fs-h2);font-weight:300">Why join <span class="serif-i">Nexus.</span></h2>
      <p class="reveal d1" style="color:var(--bone-dim);max-width:32ch;font-weight:300">
        A place to grow alongside an expanding global enterprise.</p>
    </div>
    <div class="values">
      <div class="value reveal"><span class="vn">01</span><h3>International Exposure</h3><p>Work across the UAE, Africa and an expanding global footprint.</p></div>
      <div class="value reveal d1"><span class="vn">02</span><h3>Growth Opportunities</h3><p>Clear paths to advance as the Group scales across new markets.</p></div>
      <div class="value reveal d2"><span class="vn">03</span><h3>Dynamic Industry</h3><p>Gold, luxury, manufacturing and capital markets &mdash; never standing still.</p></div>
      <div class="value reveal"><span class="vn">04</span><h3>Innovation Culture</h3><p>Modern systems, digital commerce and data-driven decisions.</p></div>
      <div class="value reveal d1"><span class="vn">05</span><h3>Long-Term Development</h3><p>We invest in people for the decades ahead, not just the role today.</p></div>
      <div class="value reveal d2"><span class="vn">06</span><h3>Real Ownership</h3><p>Meaningful responsibility from day one across every division.</p></div>
    </div>
  </div>
</section>

<!-- OPENINGS -->
<section id="openings" style="background:var(--ink-2);border-block:1px solid var(--line)">
  <div class="wrap">
    <span class="eyebrow reveal">Current Openings</span>
    <h2 class="reveal d1" style="margin-top:1.6rem;font-size:var(--fs-h2);font-weight:300">Roles across <span class="serif-i">the Group.</span></h2>

    <div class="jobs reveal d1">
      <div class="job">
        <div><h3>Head of Fundraising &amp; Investor Relations</h3>
          <div class="j-meta"><span><b>Finance</b></span><span>Dubai HQ</span><span>Full-time</span></div></div>
        <a class="btn ghost apply" href="#applyForm" data-apply="Head of Fundraising & Investor Relations"><span>Apply</span></a>
      </div>
      <div class="job">
        <div><h3>Financial Analyst / Business Associate</h3>
          <div class="j-meta"><span><b>Finance</b></span><span>Dubai HQ</span><span>Full-time</span></div></div>
        <a class="btn ghost apply" href="#applyForm" data-apply="Financial Analyst / Business Associate"><span>Apply</span></a>
      </div>
      <div class="job">
        <div><h3>Stock Market Trader</h3>
          <div class="j-meta"><span><b>Investments</b></span><span>Dubai HQ</span><span>Full-time</span></div></div>
        <a class="btn ghost apply" href="#applyForm" data-apply="Stock Market Trader"><span>Apply</span></a>
      </div>
      <div class="job">
        <div><h3>Showroom Manager</h3>
          <div class="j-meta"><span><b>Retail</b></span><span>UAE</span><span>Full-time</span></div></div>
        <a class="btn ghost apply" href="#applyForm" data-apply="Showroom Manager"><span>Apply</span></a>
      </div>
      <div class="job">
        <div><h3>Sales Associate &mdash; Jewelry</h3>
          <div class="j-meta"><span><b>Retail</b></span><span>Sharjah &middot; RAK</span><span>Full-time</span></div></div>
        <a class="btn ghost apply" href="#applyForm" data-apply="Sales Associate &mdash; Jewelry"><span>Apply</span></a>
      </div>
      <div class="job">
        <div><h3>Goldsmith / Chain Manufacturing</h3>
          <div class="j-meta"><span><b>Manufacturing</b></span><span>Sharjah</span><span>Full-time</span></div></div>
        <a class="btn ghost apply" href="#applyForm" data-apply="Goldsmith / Chain Manufacturing"><span>Apply</span></a>
      </div>
      <div class="job">
        <div><h3>Trading &amp; Sourcing Officer</h3>
          <div class="j-meta"><span><b>Sourcing</b></span><span>Uganda</span><span>Full-time</span></div></div>
        <a class="btn ghost apply" href="#applyForm" data-apply="Trading & Sourcing Officer"><span>Apply</span></a>
      </div>
    </div>
    <p class="reveal" style="margin-top:2rem;color:var(--bone-faint);font-size:.88rem;font-weight:300">
      Don't see your role? Send an open application below &mdash; we're always interested in exceptional people.</p>
  </div>
</section>

<!-- LIFE AT NEXUS -->
<section id="life">
  <div class="wrap">
    <span class="eyebrow reveal">Life At Nexus</span>
    <h2 class="reveal d1" style="margin-top:1.6rem;font-size:var(--fs-h2);font-weight:300">A culture of <span class="serif-i">craft and ambition.</span></h2>
    <div class="gallery reveal d1">
      <figure><img loading="lazy" src="https://images.pexels.com/photos/3183150/pexels-photo-3183150.jpeg?auto=compress&cs=tinysrgb&w=1200" alt="Craftsmanship"><figcaption>Craftsmanship</figcaption></figure>
      <figure><img loading="lazy" src="https://images.pexels.com/photos/4386467/pexels-photo-4386467.jpeg?auto=compress&cs=tinysrgb&w=1200" alt="Trading floor"><figcaption>Trading Floor</figcaption></figure>
      <figure><img loading="lazy" src="https://images.pexels.com/photos/6801648/pexels-photo-6801648.jpeg?auto=compress&cs=tinysrgb&w=1200" alt="Refining"><figcaption>Refining</figcaption></figure>
      <figure><img loading="lazy" src="https://images.pexels.com/photos/5849577/pexels-photo-5849577.jpeg?auto=compress&cs=tinysrgb&w=1200" alt="Strategy"><figcaption>Strategy</figcaption></figure>
    </div>
  </div>
</section>

<!-- APPLY -->
<section id="apply" style="background:var(--ink-2);border-top:1px solid var(--line)">
  <div class="wrap">
    <div class="contact-grid">
      <div class="cinfo">
        <span class="eyebrow reveal">Apply Now</span>
        <div class="cinfo-item reveal d1">
          <div class="ci-v" style="font-size:1.6rem;margin-top:1rem">Tell us where you'd fit.</div>
          <p>Send your details and we'll be in touch. For specific roles, use the apply buttons above to
            pre-fill the position.</p>
        </div>
        <div class="cinfo-item reveal d2">
          <div class="ci-k">Or email directly</div>
          <div class="ci-v"><a href="mailto:admin@nexusgroup.ae">admin@nexusgroup.ae</a></div>
        </div>
      </div>

      <div class="reveal d1">
        <form id="applyForm" class="cform" novalidate>
          <div class="field"><label for="a-name">Name *</label><input id="a-name" name="name" type="text" placeholder="Your full name" required></div>
          <div class="field"><label for="a-email">Email *</label><input id="a-email" name="email" type="email" placeholder="you@email.com" required></div>
          <div class="field"><label for="a-phone">Phone</label><input id="a-phone" name="phone" type="tel" placeholder="+971"></div>
          <div class="field"><label for="a-position">Position</label>
            <select id="a-position" name="position">
              <option value="">Open application</option>
              <option>Head of Fundraising &amp; Investor Relations</option>
              <option>Financial Analyst / Business Associate</option>
              <option>Stock Market Trader</option>
              <option>Showroom Manager</option>
              <option>Sales Associate &mdash; Jewelry</option>
              <option>Goldsmith / Chain Manufacturing</option>
              <option>Trading &amp; Sourcing Officer</option>
            </select>
          </div>
          <div class="field full"><label for="a-message">Message</label><textarea id="a-message" name="message" placeholder="A few words about you, and a link to your CV or portfolio"></textarea></div>
          <div class="field full"><button class="btn solid" type="submit"><span>Submit Application</span> <span class="arr">&rarr;</span></button></div>
          <p id="applyMsg" class="form-msg" role="status" aria-live="polite"></p>
        </form>
      </div>
    </div>
  </div>
</section>

<!-- FOOTER -->
@endsection
