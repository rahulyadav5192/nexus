@extends('layouts.nexus')

@section('title', 'Terms & Conditions — Nexus Group Holdings')
@section('meta_description', 'Terms & Conditions for Nexus Group Holdings. Legal information and terms.')
@section('active_page', 'terms')

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
    <span class="eyebrow reveal">Terms & Conditions</span>
    <h1 class="reveal d1">Clear rules for <span class="serif-i">mutual trust.</span></h1>
    <p class="lead reveal d2">For partnerships, investment enquiries, wholesale or media &mdash; the Group's Dubai
      office is the place to start.</p>
  </div>
</section>
<section style="padding: clamp(4rem, 8vw, 8rem) 0;"><div class="wrap"><h2>Terms of Service</h2><p class="lead">Placeholder text for terms of service.</p></div></section>
<!-- FOOTER -->
@endsection
