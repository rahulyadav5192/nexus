@extends('layouts.frontend')

@section('title', isset($meta_tags) && $meta_tags ? $meta_tags->tag : ($blog->blog_name ?? 'Blog'))
@section('meta_description', isset($meta_tags) && $meta_tags ? $meta_tags->description : ($blog->short_description ?? 'Blog details'))

@section('content')
<section id="hero" class="hero-section position-relative blog-detail-hero"
    style="background-image: url('{{ asset('assets/img/service/hero.jpg') }}'); min-height: 300px;">
    <!-- Navbar at top -->
    @include('frontend.nav')
    <!-- Hero Content -->
    <div class="d-flex align-items-center" style="min-height: 300px;">
        <div class="container" style="z-index: 2;">
            <div class="row align-items-center">
                <div class="col-lg-8 col-md-10">
                    <h1 class="text-white head-1 blog-detail-title">{{ $blog->blog_name ?? 'Blog Detail' }}</h1>
                    {{-- <nav aria-label="breadcrumb">
                        <ol class="breadcrumb bg-transparent p-0 mb-0">
                            <li class="breadcrumb-item"><a href="{{ route('home') }}">Home</a></li>
                            <li class="breadcrumb-item"><a href="{{ route('blogs') }}">Blogs</a></li>
                            <li class="breadcrumb-item active" aria-current="page">
                                {{ \Illuminate\Support\Str::limit($blog->blog_name ?? 'Blog Detail', 60) }}
                            </li>
                        </ol>
                    </nav> --}}
                </div>
            </div>
        </div>
    </div>
    <div class="hero-icons-fixed" aria-hidden="false">
        <button class="icon-btn" id="currencyBtn" aria-label="Support">
            <span class="material-icons">attach_money</span>
            <span class="tooltip-text">Currency Conversion</span>
        </button>

        <button class="icon-btn" id="unitBtn" aria-label="Language" style="max-width: 190px;">
            <span class="material-icons">language</span>
            <span class="tooltip-text">Unit Conversion</span>
        </button>
</div>
</section>

<!-- Blog Detail + Sidebar -->
<section class="py-5">
    <div class="container">
        <div class="row g-4">
            <!-- Main content -->
            <div class="col-lg-8">
                <article class="blog-detail-card">
                    @if(!empty($blog->blog_image))
                        <div class="blog-detail-image mb-4">
                            <img src="{{ asset('uploads/blogs/'.$blog->blog_image) }}"
                                 alt="{{ $blog->blog_name }}"
                                 class="img-fluid w-100 rounded-3"
                                 loading="lazy">
                        </div>
                    @endif

                    <div class="d-flex flex-wrap align-items-center text-muted small mb-3 gap-3">
                        @if(!empty($blog->blog_date))
                            <span>
                                <i class="bi bi-calendar3 me-1"></i>
                                {{ \Carbon\Carbon::parse($blog->blog_date)->format('d M Y') }}
                            </span>
                        @endif
                        @if(isset($blog->category) || isset($blog->category_id))
                            @php
                                // Find current category object from $blog_categories if available
                                $currentCategory = null;
                                if(isset($blog_categories)) {
                                    foreach($blog_categories as $cat) {
                                        if(isset($cat->id) && $cat->id == $blog->category_id) {
                                            $currentCategory = $cat;
                                            break;
                                        }
                                    }
                                }
                                $categorySlug = null;
                                if($currentCategory && isset($currentCategory->slug) && $currentCategory->slug) {
                                    $categorySlug = $currentCategory->slug;
                                }
                            @endphp
                            @if($currentCategory)
                                <span class="d-inline-flex align-items-center">
                                    <i class="bi bi-folder2-open me-1"></i>
                                    <a href="{{ route('blogs') }}?category={{ $currentCategory->id }}"
                                       class="text-decoration-none">
                                        {{ $currentCategory->category_name }}
                                    </a>
                                </span>
                            @endif
                        @endif
                    </div>

                    @if(!empty($blog->short_description))
                        <p class="lead text-secondary">
                            {{ $blog->short_description }}
                        </p>
                    @endif

                    @if(!empty($blog_sections) && count($blog_sections))
                        @foreach($blog_sections as $section)
                            <section class="mb-4">
                                @if(!empty($section->title))
                                    <h2 class="h5">{{ $section->title }}</h2>
                                @endif

                                @if(!empty($section->description))
                                    <div class="text-muted">
                                        {!! $section->description !!}
                                    </div>
                                @endif
                            </section>
                        @endforeach
                    @else
                        @if(!empty($blog->description))
                            <div class="text-muted">
                                {!! $blog->description !!}
                            </div>
                        @endif
                    @endif
                </article>
            </div>

            <!-- Sidebar -->
            <div class="col-lg-4">
                <aside class="blog-sidebar">
                    {{-- Categories --}}
                    @if(isset($blog_categories) && count($blog_categories))
                        <div class="mb-4 p-4 rounded-3 border bg-white">
                            <h5 class="mb-3">Categories</h5>
                            <ul class="list-unstyled mb-0">
                                @foreach($blog_categories as $category)
                                    <li class="mb-2">
                                        <a href="{{ route('blogs') }}?category={{ $category->id }}"
                                           class="d-flex justify-content-between align-items-center text-decoration-none">
                                            <span>
                                                <i class="bi bi-chevron-right small me-1"></i>
                                                {{ $category->category_name }}
                                            </span>
                                            @if(isset($arrCategoryWise[$category->id]))
                                                <span class="badge bg-light text-muted">
                                                    {{ count($arrCategoryWise[$category->id]) }}
                                                </span>
                                            @endif
                                        </a>
                                    </li>
                                @endforeach
                                </ul>
                        </div>
                    @endif

                    {{-- Recent Posts --}}
                    @if(isset($blogs) && count($blogs))
                        <div class="mb-4 p-4 rounded-3 border bg-white">
                            <h5 class="mb-3">Recent Posts</h5>
                            <div class="list-unstyled">
                                @foreach($blogs->take(4) as $recent)
                                    @php
                                        $slug = $recent->slug ?? $recent->id;
                                    @endphp
                                    <a href="{{ route('blogs.details', $slug) }}"
                                       class="d-flex mb-3 text-decoration-none recent-post-item">
                                        @if(!empty($recent->blog_image))
                                            <div class="flex-shrink-0 me-3">
                                                <img src="{{ asset('uploads/blogs/'.$recent->blog_image) }}"
                                                     alt="{{ $recent->blog_name }}"
                                                     class="rounded-2"
                                                     style="width: 64px; height: 64px; object-fit: cover;"
                                                     loading="lazy">
                                    </div>
                                        @endif
                                        <div class="flex-grow-1">
                                            <div class="small text-muted mb-1">
                                                @if(!empty($recent->blog_date))
                                                    {{ \Carbon\Carbon::parse($recent->blog_date)->format('d M Y') }}
                                                @endif
                                    </div>
                                            <div class="fw-semibold text-dark">
                                                {{ \Illuminate\Support\Str::limit($recent->blog_name, 60) }}
                                    </div>
                                </div>
                                    </a>
                                @endforeach
                            </div>
                        </div>
                    @endif

                    {{-- Contact Card (reused from blogs listing sidebar) --}}
                    <div class="p-4 rounded-3 bg-primary text-white">
                        <h5 class="mb-2">Need assistance?</h5>
                        <p class="mb-3 small">Talk to our logistics experts for any queries related to our services.</p>
                        @if(isset($contact_details))
                            <p class="mb-1"><i class="bi bi-telephone-fill me-2"></i>{{ $contact_details->phone ?? '+971 4 351 5599' }}</p>
                            <p class="mb-0"><i class="bi bi-envelope-fill me-2"></i>{{ $contact_details->email ?? 'info@pgldubai.com' }}</p>
                        @else
                            <p class="mb-1"><i class="bi bi-telephone-fill me-2"></i>+971 4 351 5599</p>
                            <p class="mb-0"><i class="bi bi-envelope-fill me-2"></i>Info@Pgldubai.Com</p>
                        @endif
                    </div>
                </aside>
            </div>
        </div>
    </div>
</section>

@include('frontend.footer')
@endsection