    <!-- OUR BLOG START -->
    <div class="section-full  p-t80  bg-white blog-post-outer-3 ">
      <div class="container">

        <div class="wt-separator-two-part">
          <div class="row wt-separator-two-part-row">
            <div class="col-lg-8 col-md-7 wt-separator-two-part-left">
              <!-- TITLE START-->
              <div class="section-head left wt-small-separator-outer">
                <div class="wt-small-separator site-text-primary">
                  <div class="sep-leaf-left"></div>
                  <div>Latest Articles Updated Daily</div>
                  <div class="sep-leaf-right"></div>
                </div>
                <h2>We Are Here To Learn You More From Blog</h2>
              </div>
              <!-- TITLE END-->
            </div>
            <div class="col-lg-4 col-md-5 wt-separator-two-part-right text-right">
              <a href="{{route('blogs')}}" class="site-button site-btn-effect">More Detail</a>
            </div>
          </div>
        </div>

        <!-- BLOG SECTION START -->
        <div class="section-content">
          <div class="row d-flex justify-content-center">
            @if(isset($blogs) && count($blogs) > 0)
              @foreach($blogs as $index => $blog)
                <?php
                  if (isset($blog->slug) && $blog->slug != '') {
                    $slug = $blog->slug;
                  } else {
                    $slug = $blog->id;
                  }
                  $category = isset($blog->category) ? $blog->category->category_name : 'Blog';
                ?>
            <div class="col-lg-4 col-md-6 col-sm-12 m-b30">
              <div class="blog-post date-style-2">
                <div class="wt-post-media wt-img-effect zoom-slow">
                      <a href="{{route('blogs.details', $slug)}}">
                        <img src="{{asset('uploads/blogs').'/'.$blog->blog_image}}" alt="{{$blog->blog_name}}">
                      </a>
                </div>
                <div class="wt-post-info bg-white p-t30">
                  <div class="wt-post-meta ">
                    <ul>
                          <li class="post-category"><span>{{$category}}</span> </li>
                          <li class="post-date">{{date('F d, Y', strtotime($blog->blog_date))}}</li>
                    </ul>
                  </div>
                  <div class="wt-post-title ">
                        <h3 class="post-title">{{$blog->blog_name}}</h3>
                  </div>
                  <div class="wt-post-readmore ">
                        <a href="{{route('blogs.details', $slug)}}" class="site-button-link black">Read More</a>
              </div>
            </div>
                  </div>
                </div>
              @endforeach
            @endif
          </div>
        </div>
      </div>

    </div>
    <!-- OUR BLOG END -->