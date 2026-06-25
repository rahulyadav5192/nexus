@extends('layouts.nexus')

@section('active_page', 'blogs')

@section('content')
<section class="subhero" style="min-height:46dvh">
  <div class="subhero-media">
    <video autoplay muted loop playsinline poster="https://images.pexels.com/photos/1370882/pexels-photo-1370882.jpeg?auto=compress&cs=tinysrgb&w=1920" style="width:100%;height:100%;object-fit:cover;display:block">
      <source src="https://www.pexels.com/download/video/8397996/" type="video/mp4">
      <track kind="captions" src="{{ asset('nexus/empty.vtt') }}" label="No dialogue">
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

    @if(isset($featuredBlog) && $featuredBlog)
    <a class="featured reveal" href="{{ $featuredBlog->detailUrl() }}">
      <div class="f-media">
        <img loading="lazy" src="{{ $featuredBlog->imageUrl() }}" alt="{{ $featuredBlog->blog_name }}">
      </div>
      <div class="f-body">
        <span class="cat">{{ $featuredBlog->category->category_name ?? 'Insights' }}</span>
        <h2>{{ $featuredBlog->blog_name }}</h2>
        <p>{{ $featuredBlog->short_description }}</p>
        @if($featuredBlog->displayMeta())
        <span class="meta">{{ $featuredBlog->displayMeta() }}</span>
        @endif
      </div>
    </a>
    @endif

    <div class="filters reveal" data-target="#blogGrid .insight" style="margin-top:clamp(2.5rem,5vw,4rem)">
      <button class="filter-btn {{ empty($categoryId) ? 'active' : '' }}" data-cat="all">All</button>
      @foreach($blog_categories as $category)
      <button class="filter-btn {{ (string) $categoryId === (string) $category->id ? 'active' : '' }}" data-cat="{{ $category->slug }}">{{ $category->category_name }}</button>
      @endforeach
    </div>

    <div class="insight-grid" id="blogGrid" style="margin-top:1.6rem">
      @forelse($gridBlogs as $index => $blog)
      <a class="insight reveal{{ $index % 3 === 1 ? ' d1' : ($index % 3 === 2 ? ' d2' : '') }}" data-cat="{{ $blog->category->slug ?? 'all' }}" href="{{ $blog->detailUrl() }}">
        <div class="thumb"><img loading="lazy" src="{{ $blog->imageUrl() }}" alt="{{ $blog->blog_name }}"></div>
        <div class="body">
          <span class="cat">{{ $blog->category->category_name ?? 'Insights' }}</span>
          <h3>{{ $blog->blog_name }}</h3>
          @if($blog->displayMeta())
          <span class="meta">{{ $blog->displayMeta() }}</span>
          @endif
        </div>
      </a>
      @empty
      <p style="grid-column:1/-1;color:var(--ink-dim)">No insights published yet.</p>
      @endforelse
    </div>
  </div>
</section>

<section class="cta-video-band">
  <div class="cta-bg">
    <video autoplay muted loop playsinline poster="https://images.pexels.com/photos/1370882/pexels-photo-1370882.jpeg?auto=compress&cs=tinysrgb&w=1920" style="width:100%;height:100%;object-fit:cover;display:block">
      <source src="https://www.pexels.com/download/video/8397996/" type="video/mp4">
      <track kind="captions" src="{{ asset('nexus/empty.vtt') }}" label="No dialogue">
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
      <a class="btn solid reveal d2" href="{{ route('contactus') }}"><span>Get In Touch</span> <span class="arr">&rarr;</span></a>
    </div>
  </div>
</section>
@endsection
