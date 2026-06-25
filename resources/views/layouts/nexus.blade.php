<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8">
  <link rel="icon" type="image/webp" href="{{ asset('nexus/images/nexus-favicon.webp') }}">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <meta name="csrf-token" content="{{ csrf_token() }}">
  @php
    $fallbackTitle = trim($__env->yieldContent('title')) ?: 'Nexus Group Holdings';
    $fallbackDescription = trim($__env->yieldContent('meta_description')) ?: 'Nexus Group Holdings LLC — a diversified, vertically integrated group spanning gold sourcing, refining, jewelry manufacturing, retail and strategic investments across the UAE and Africa.';
    $useDbMeta = isset($meta_tags) && $meta_tags && (int) $meta_tags->status === 1;
    $pageTitle = $useDbMeta && !empty($meta_tags->tag) ? $meta_tags->tag : $fallbackTitle;
    $pageDescription = $useDbMeta && !empty($meta_tags->description) ? $meta_tags->description : $fallbackDescription;
  @endphp
  <title>{{ $pageTitle }}</title>
  <meta name="description" content="{{ $pageDescription }}">
  <meta property="og:title" content="{{ $pageTitle }}">
  <meta property="og:description" content="{{ $pageDescription }}">
  <meta property="og:url" content="{{ url()->current() }}">
  <meta property="og:type" content="website">
  <link rel="preconnect" href="https://fonts.googleapis.com">
  <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
  <link rel="stylesheet" href="https://fonts.googleapis.com/css2?family=Fraunces:ital,opsz,wght@0,9..144,300..700;1,9..144,300..700&family=Plus+Jakarta+Sans:ital,wght@0,300..700;1,300..700&display=swap">
  <link rel="stylesheet" href="{{ asset('nexus/css/styles.css') }}">
  @yield('page_styles')
</head>

<body>
  @include('frontend.nexus.partials.nav')

  @yield('content')

  @include('frontend.nexus.partials.footer')

  <script src="{{ asset('nexus/js/main.js') }}"></script>
  @yield('page_scripts')
</body>

</html>
