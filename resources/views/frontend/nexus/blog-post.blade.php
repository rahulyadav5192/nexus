@extends('layouts.nexus')

@section('active_page', 'blogs')

@section('content')
<section style="padding-top:calc(var(--nav-h) + clamp(2rem,5vw,4rem))">
  <div class="wrap">
    <article class="article reveal">
      <a class="link-arrow" href="{{ route('blogs') }}" style="margin-bottom:1.6rem"><span class="arr" style="transform:rotate(180deg)">&rarr;</span> All Insights</a>
      <div class="a-cat">{{ $blog->category->category_name ?? 'Insights' }}</div>
      <h1>{{ $blog->blog_name }}</h1>
      @if($blog->displayMeta())
      <div class="a-meta">
        @foreach(explode(' · ', $blog->displayMeta()) as $metaPart)
        <span>{{ $metaPart }}</span>
        @endforeach
      </div>
      @endif

      <figure class="a-figure">
        <img src="{{ $blog->imageUrl() }}" alt="{{ $blog->blog_name }}">
      </figure>

      <div class="prose">
        @if(!empty($blog->content))
          {!! $blog->content !!}
        @elseif($blog->short_description)
          <p>{{ $blog->short_description }}</p>
        @endif

        @foreach($blog_sections as $section)
          @if(!empty($section->title))
          <h2>{{ $section->title }}</h2>
          @endif
          @if(!empty($section->section_image))
          <figure class="a-figure">
            <img src="{{ str_starts_with($section->section_image, 'http') ? $section->section_image : asset('uploads/blogs/'.$section->section_image) }}" alt="{{ $section->title }}">
          </figure>
          @endif
          @if(!empty($section->description))
          {!! $section->description !!}
          @endif
        @endforeach
      </div>

      <div class="share">
        <span>Share</span>
        <a href="https://www.linkedin.com/sharing/share-offsite/?url={{ urlencode(url()->current()) }}" aria-label="Share on LinkedIn" target="_blank" rel="noopener">In</a>
        <a href="https://twitter.com/intent/tweet?url={{ urlencode(url()->current()) }}&text={{ urlencode($blog->blog_name) }}" aria-label="Share on X" target="_blank" rel="noopener">X</a>
        <a href="mailto:?subject={{ rawurlencode($blog->blog_name) }}&body={{ urlencode(url()->current()) }}" aria-label="Share by email">@</a>
      </div>
    </article>
  </div>
</section>

@if(isset($relatedBlogs) && $relatedBlogs->count())
<section id="related" style="background:var(--ink-2);border-top:1px solid var(--line)">
  <div class="wrap">
    <span class="eyebrow reveal">Related Articles</span>
    <div class="insight-grid" style="margin-top:clamp(2rem,4vw,3rem)">
      @foreach($relatedBlogs as $index => $related)
      <a class="insight reveal{{ $index === 1 ? ' d1' : ($index === 2 ? ' d2' : '') }}" href="{{ $related->detailUrl() }}">
        <div class="thumb"><img loading="lazy" src="{{ $related->imageUrl() }}" alt="{{ $related->blog_name }}"></div>
        <div class="body">
          <span class="cat">{{ $related->category->category_name ?? 'Insights' }}</span>
          <h3>{{ $related->blog_name }}</h3>
          @if($related->displayMeta())
          <span class="meta">{{ $related->displayMeta() }}</span>
          @endif
        </div>
      </a>
      @endforeach
    </div>
  </div>
</section>
@endif
@endsection
