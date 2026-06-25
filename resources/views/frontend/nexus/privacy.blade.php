@extends('layouts.nexus')

@section('title', 'Privacy Policy — Nexus Group Holdings')
@section('meta_description', 'Privacy Policy for Nexus Group Holdings. Legal information and terms.')
@section('active_page', 'privacy')

@section('content')
<!-- SUB-HERO -->
<section class="subhero" style="min-height:52dvh">
  <div class="subhero-media">
    <video autoplay muted loop playsinline poster="https://images.pexels.com/photos/1370882/pexels-photo-1370882.jpeg?auto=compress&cs=tinysrgb&w=1920" style="width:100%;height:100%;object-fit:cover;display:block">
      <source src="https://www.pexels.com/download/video/8397996/" type="video/mp4">
        <track kind="captions" src="{{ asset('nexus/empty.vtt') }}" label="No dialogue">
    </video>
  </div>
  <div class="wrap">
    <span class="eyebrow reveal">Privacy Policy</span>
    <h1 class="reveal d1">Your data, <span class="serif-i">our responsibility.</span></h1>
    <p class="lead reveal d2">For partnerships, investment enquiries, wholesale or media &mdash; the Group's Dubai
      office is the place to start.</p>
  </div>
</section>
<section style="padding: clamp(4rem, 8vw, 8rem) 0;"><div class="wrap"><h2>Privacy Policy</h2><p class="lead">Placeholder text for privacy policy.</p></div></section>
<!-- FOOTER -->
@endsection
