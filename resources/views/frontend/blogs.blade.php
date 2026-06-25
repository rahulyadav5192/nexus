@extends('layouts.frontend')
@section('content')
<?php
if (!isset($meta_tags)) {
    $tag            =   'Blogs | Pro Global Logistics';
    $decsription    =   'Read the latest news, insights, and updates from Pro Global Logistics on logistics, shipping, transportation, and industry trends.';
} else {
    $tag            =   $meta_tags->tag;
    $decsription    =   $meta_tags->description;
}


?>

@section('title', $tag)
@section('meta_description', $decsription)
<section id="hero" class="hero-section position-relative"
    style="background-image: url('assets/img/service/hero.jpg'); min-height: 300px;  ">
    <!-- Navbar at top -->
    @include('frontend.nav')
    <!-- Hero Content -->
    <div class=" d-flex align-items-center" style="min-height: 300px; ">
        <div class="container" style="z-index: 2;">
            <div class="row align-items-center">
                <div class="col-lg-8 col-md-10">
                    <h1 class=" text-white head-1">Blogs</h1>
                    <nav aria-label="breadcrumb">
                        <ol class="breadcrumb bg-transparent p-0 mb-0">
                            <li class="breadcrumb-item"><a href="{{route('home')}}">Home</a>
                            </li>
                            <li class="breadcrumb-item active" aria-current="page">Blogs</li>
                        </ol>
                    </nav>
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

<!-- Blog Section (below hero) -->
<section class="blog-section py-5">
    <div class="container">
        <div class="row">
            <!-- Main Blog Grid -->
            <div class="col-lg-8">
                <div class="row g-4">
                    <!-- Blog Card 1 -->
                    <?php foreach ($blogs as $obj) {
                        if (isset($obj->slug) && $obj->slug != '') {
                            $slug = $obj->slug;
                        } else {
                            $slug = $obj->id;
                        } ?>
                        <div class="col-md-6" id="blogDetail">
                            <div class="blog-card" data-blog-url="{{route('blogs.details',$slug)}}">
                                <div class="blog-card-img-wrap">
                                    <img src="{{asset('uploads/blogs').'/'.$obj->blog_image}}"
                                         title="<?= $obj->blog_name ?>"
                                         alt="<?= $obj->blog_name ?>"
                                         class="blog-card-img"
                                         loading="lazy">
                                </div>
                                <div class="blog-card-body">
                                    <div class="blog-card-meta mb-2">
                                        <span class="blog-card-date"><span class="material-icons">calendar_today</span>
                                            <?php echo date('F j', strtotime($obj->blog_date)); ?></span>
                                        <!-- <span class="blog-card-category">Business</span> -->
                                    </div>
                                    <h5 class="blog-card-title">{{$obj->blog_name}}
                                    </h5>
                                    <p>{{$obj->short_description}}</p>
                                    <a href="{{route('blogs.details',$slug)}}" class="readmore-btn">
                                        Read More <span class="material-icons" style="font-size:18px;">east</span>
                                    </a>
                                </div>
                            </div>
                        </div>
                    <?php } ?>
                </div>
                <!-- Pagination -->
                <!-- <nav class="blog-pagination mt-4 d-flex justify-content-center">
                    <ul class="pagination">
                        <li class="page-item"><a class="page-link" href="#">
                                &#8592; </a>
                        </li>
                        <li class="page-item active"><a class="page-link" href="#">1</a></li>
                        <li class="page-item"><a class="page-link" href="#">2</a></li>
                        <li class="page-item"><span class="page-link">...</span></li>
                        <li class="page-item"><a class="page-link" href="#">22</a></li>
                        <li class="page-item"><a class="page-link" href="#"> &#8594; </a></li>
                    </ul>
                </nav> -->
            </div>
            <!-- Sidebar -->
            <div class="col-lg-4">
                <div class="blog-sidebar">
                    <!-- Search -->
                    <!-- <div class="blog-search mb-4">
                        <form>
                            <div class="input-group">
                                <input type="text" class="form-control" placeholder="Search here">
                                <button class="btn " type="submit">
                                    <span class="material-icons">search</span>
                                </button>
                            </div>
                        </form>
                    </div> -->
                    <!-- Categories -->
                    <div class="blog-categories mb-4">
                        <h5 class="blog-sidebar-title">Categories</h5>
                        <ul class="list-unstyled">
                            <?php foreach ($blog_categories as $category): ?>
                                <li>
                                    <a href="{{ route('blogs') }}?category=<?= $category->id ?>"><?= $category->category_name ?></a>
                                </li>
                            <?php endforeach; ?>
                        </ul>
                    </div>
                    <!-- Latest Post -->
                    <!-- <div class="blog-latest mb-4">
                        <h5 class="blog-sidebar-title">Latest Post</h5>
                        <ul class="list-unstyled latest-posts">
                            <li>
                                <img src="assets/img/blog/blog_1.jpg" alt="Post 1">
                                <div class="post-info">
                                    <small><span class="material-icons">event</span> 25 Nov, 2024</small>
                                    <a href="#">The Right Learning Path For Your</a>
                                </div>
                            </li>
                            <li>
                                <img src="assets/img/blog/blog_2.jpg" alt="Post 2">
                                <div class="post-info">
                                    <small><span class="material-icons">event</span> 25 Nov, 2024</small>
                                    <a href="#">The Growing Need Management</a>
                                </div>
                            </li>
                            <li>
                                <img src="assets/img/blog/blog_3.jpg" alt="Post 3">
                                <div class="post-info">
                                    <small><span class="material-icons">event</span> 25 Nov, 2024</small>
                                    <a href="#">Fast Freight, Fast Value</a>
                                </div>
                            </li>
                        </ul>
                    </div> -->

                    @if(isset($contact_details) && $contact_details)
                    <div class="contact-card">
                        <div class="contact-image">
                            <img src="assets/img/blog/blog_1.jpg" alt="Contact Image" loading="lazy">
                        </div>
                        <div class="contact-icon">
                            <img src="assets/icons/onClick.svg" alt="Contact Icon" />
                        </div>
                        <div class="contact-content">
                            <h5>Get in touch</h5>
                            <p><i class="bi bi-telephone-fill"></i> {{ $contact_details->mobile ?? '' }}</p>
                            <p><i class="bi bi-envelope-fill"></i> {{ $contact_details->email ?? '' }}</p>
                        </div>
                    </div>
                    @endif

                </div>
            </div>
        </div>
    </div>
</section>

@include('frontend.newsletter')
@include('frontend.footer')
@endsection