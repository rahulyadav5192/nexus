@php($activePage = trim($__env->yieldContent('active_page')))

<header class="nav" id="nav">
  <div class="wrap">
    <a class="brand" href="{{ route('home') }}" aria-label="Nexus Group Holdings home">
      <img src="{{ asset('nexus/images/nexus-logo.webp') }}" alt="Nexus Group Holdings" style="height:2.8rem;width:auto;display:block;">
    </a>
    <nav class="nav-links" aria-label="Primary">
      <a href="{{ route('about') }}" @if($activePage === 'about') class="active" @endif>Group</a>
      <a href="{{ route('companies') }}" @if($activePage === 'companies') class="active" @endif>Companies</a>
      <a href="{{ route('operations') }}" @if($activePage === 'operations') class="active" @endif>Operations</a>
      <a href="{{ route('expansion') }}" @if($activePage === 'expansion') class="active" @endif>Expansion</a>
      <a href="{{ route('investors') }}" @if($activePage === 'investors') class="active" @endif>Investors</a>
      <a href="{{ route('blogs') }}" @if($activePage === 'blogs') class="active" @endif>Insights</a>
      <a class="btn nav-cta" href="{{ route('contactus') }}"><span>Contact</span></a>
    </nav>
    <button class="nav-toggle" aria-label="Open menu" aria-expanded="false" aria-controls="mobileMenu">
      <span></span><span></span><span></span>
    </button>
  </div>
</header>

<div class="mobile-menu" id="mobileMenu">
  <a href="{{ route('about') }}"><span class="n">01</span> Group</a>
  <a href="{{ route('companies') }}"><span class="n">02</span> Companies</a>
  <a href="{{ route('operations') }}"><span class="n">03</span> Operations</a>
  <a href="{{ route('leadership') }}"><span class="n">04</span> Leadership</a>
  <a href="{{ route('expansion') }}"><span class="n">05</span> Expansion</a>
  <a href="{{ route('investors') }}"><span class="n">06</span> Investors</a>
  <a href="{{ route('blogs') }}"><span class="n">07</span> Insights</a>
  <a href="{{ route('careers') }}"><span class="n">08</span> Careers</a>
  <a href="{{ route('contactus') }}"><span class="n">09</span> Contact</a>
</div>
