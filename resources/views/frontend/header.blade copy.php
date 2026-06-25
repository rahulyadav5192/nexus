    <section id="hero" class="hero-section position-relative" style="background-image: url('assets/img/home-bg.png') ">
      <!-- Navbar at top -->
      <nav class="navbar navbar-expand-xl navbar-light custom-navbar fixed-top ">
        <div class="container justify-content-between">
          <a class="navbar-brand" href="index.html">
            <img src="assets/img/logo.svg" alt="Logo" height="60px">
          </a>
          <button class="navbar-close-btn d-xl-none" type="button" aria-label="Close menu">
            <span class="material-icons">close</span>
          </button>
          <div class="collapse navbar-collapse" id="navbarContent">
            <ul class="navbar-nav mx-auto d-flex justify-content-center">
              <li class="nav-item"><a class="nav-link active" href="{{route('home')}}">HOME</a></li>
              <li class="nav-item"><a class="nav-link" href="{{route('about')}}">ABOUT US</a></li>
              <!-- <li class="nav-item"><a class="nav-link" href="service.html">SERVICES</a></li> -->
              <li class="nav-item dropdown">
                <a class="nav-link dropdown-toggle" href="{{route('services')}}" id="servicesDropdown" role="button"
                  data-bs-toggle="dropdown" aria-expanded="false">SERVICES</a>
                <ul class="dropdown-menu" aria-labelledby="servicesDropdown">
                  <li><a class="dropdown-item" href="{{route('services')}}">All Services</a></li>
                  <li><a class="dropdown-item" href="service-detail.html?s=ocean">Ocean Freight</a></li>
                  <li><a class="dropdown-item" href="service-detail.html?s=air">Air Freight</a></li>
                  <li><a class="dropdown-item" href="service-detail.html?s=land">Land Freight</a></li>
                  <li><a class="dropdown-item" href="service-detail.html?s=custom">Customs Clearance</a></li>
                  <li><a class="dropdown-item" href="service-detail.html?s=warehousing">Warehousing</a></li>
                  <li><a class="dropdown-item" href="service-detail.html?s=project">Project Handling</a></li>
                </ul>
              </li>
              <li class="nav-item"><a class="nav-link" href="{{route('associates')}}">ASSOCIATES</a></li>
              <li class="nav-item"><a class="nav-link" href="{{route('blogs')}}">BLOGS</a></li>
              <li class="nav-item"><a class="nav-link" href="{{route('careers')}}">CAREERS</a></li>
              <li class="nav-item"><a class="nav-link" href="{{route('contactus')}}">CONTACT US</a></li>
              <li class="nav-item d-block d-xl-none"><a class="nav-link"
                  href="https://jbmpgl.jbmcloud.com/JBMPortal/General/Login/Login.aspx">CUSTOMER PORTAL</a></li>
            </ul>
          </div>
          <a href="https://jbmpgl.jbmcloud.com/JBMPortal/General/Login/Login.aspx"
            class="navbar-authbtn btn btn-primary ms-3 d-none d-xl-block">
            <span class="material-icons" style="font-size: 18px; margin: 0;">person</span>
            CUSTOMER PORTAL
          </a>
          <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarContent"
            aria-controls="navbarContent" aria-expanded="false" aria-label="Toggle navigation">
            <span class="navbar-toggler-icon"></span>
          </button>
        </div>

      </nav>
      <!-- Hero Content -->
      <div class=" d-flex align-items-center " style="min-height: 100%; height: 80vh;">
        <div class=" container" style="z-index: 2;">
          <div class="row align-items-center">
            <div class="col-md-10 col-lg-10 align-items-center">
              <h1 class="head-1 text-white mb-4 fw-800">Shipping your cargo everywhere</h1>
              <button data-bs-toggle="modal" data-bs-target="#quoteModal" class="btn btn-primary">Get
                Started</button>
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
    <section>
      <div class="container mt-5">
        <h2 class="head-2 head-underline mb-4">Track & <span class="text-secondary">Trace</span>
          <span class="custom-underline"></span>
        </h2>
        <p>Enter your tracking number to get real-time updates on your shipment status and location</p>

        <div class="tracking-container">
          <!-- Dropdown -->
          <select class="tracking-select">
            <option selected disabled>Service Type</option>
            <option value="Bill of Lading">Bill of Lading</option>
            <option value="Air Way Bill">Air Way Bill</option>
            <option value="Container Number">Container Number</option>
            <option value="Booking Ref">Booking Ref</option>
            <option value="Purchase Order">Purchase Order</option>
          </select>

          <!-- Textbox -->
          <input type="text" class="tracking-input" placeholder="Enter your tracking number">

          <button class="tracking-btn">
            <span class="btn-text">Track Now</span>
            <span class="btn-arrow">➤</span>
            <span class="btn-loader" style="display:none;"></span>
          </button>

        </div>

        <!-- Results -->
        <div id="tracking-result"></div>
        <div id="tracking-error" class="tracking-error"></div>


        <div class="row mt-5">
          <div class="col-md-6 col-12">
            <h2 class="head-2 mb-4 text-secondary">We Provide a Full Range of Innovative And Reliable Supply
              Chain Solutions
            </h2>
            <p style="font-weight: 800;">We are committed to delivering innovative, reliable and most effective
              supply chain solutions.
              Empower our clients to expand their reach and business growth. Therefore, exceeding customer
              expectations by providing seamless shipping solutions with our strong ​global network and local
              expertise.</p>


          </div>
          <div class="col-md-6 col-12">
            <img src="assets/img/home/map.png" alt="About Us" class="img-fluid rounded d-none d-md-block">
          </div>
        </div>
        <div>
          <ul class="home-list list-unstyled mb-0 row g-4">
            <li class="col-md-6 px-4">
              <div class="logo">
                <img src="assets/icons/truck.svg" alt="Truck Icon" />
              </div>

              <div>
                <span class="head">On Time Delivery</span>
                <p>We are committed to delivering your cargo promptly and reliably,
                  ensuring it reaches its destination exactly when you need it.</p>
              </div>
            </li>
            <li class="col-md-6 px-4">
              <div class="logo">
                <img src="assets/icons/globe.svg" alt="Globe Icon" />
              </div>

              <div>
                <span class="head">Worldwide Service</span>
                <p>Logistics specializes in import, export, re-export, cross trade
                  or LCL to any destination globally.</p>
              </div>
            </li>
            <li class="col-md-6 px-4">
              <div class="logo">
                <img src="assets/icons/telephone.svg" alt="Telephone Icon" />
              </div>

              <div>
                <span class="head">24/7 Telephone Support</span>
                <p>Our dedicated support team is available around the clock to assist you
                  with any inquiries or issues. Experience seamless support whenever you
                  need it.</p>
              </div>
            </li>
            <li class="col-md-6 px-4">
              <div class="logo">
                <img src="assets/icons/handshake.svg" alt="Handshake Icon" />
              </div>

              <div>
                <span class="head">Global Network</span>
                <p>Strong partnership with international carriers,agents,and logistics
                  providers across key trade lanes.</p>
              </div>
            </li>

          </ul>
          <div class="justify-content-center d-flex">
            <a href="service.html" class="btn btn-primary mt-4 ">READ MORE</a>
          </div>

        </div>

      </div>

    </section>
    <div class="container mt-8">
      <h2 class="head-2 head-underline">
        Logistics <span class="text-secondary">Services</span>
        <span class="custom-underline"></span>
      </h2>

      <!-- Scrollable wrapper -->
      <div class="services-scroll mt-4">
        <!-- Ocean Freight -->
        <div class="col-lg-4 col-md-6 col-12 d-flex justify-content-center mb-4">
          <div class="service-card">
            <img src="assets/img/home/ocean.jpg" alt="Ocean Freight" />
            <div class="overlay"></div>
            <div class="service-card-content">
              <div class="service-card-number">01</div>
              <div class="service-card-title">Ocean Freight</div>
              <div class="service-card-desc">
                We specialize in the transportation of goods by sea, ensuring reliability and
                cost-effectiveness for global shipments.
              </div>
              <a href="service-detail.html?s=sea-freight" class="service-card-readmore">READ MORE</a>
              <span class="service-card-icon material-icons">directions_boat</span>
            </div>
          </div>
        </div>

        <!-- Air Freight -->
        <div class="col-lg-4 col-md-6 col-12 d-flex justify-content-center mb-4">
          <div class="service-card">
            <img src="assets/img/home/air.jpg" alt="Air Freight" />
            <div class="overlay"></div>
            <div class="service-card-content">
              <div class="service-card-number">02</div>
              <div class="service-card-title">Air Freight</div>
              <div class="service-card-desc">
                We specialize in the air transportation of perishable cargo, ensuring product freshness and
                extended shelf life by meeting strict deadlines at every stage of the supply chain.
              </div>
              <a href="service-detail.html?s=air-freight" class="service-card-readmore">READ MORE</a>
              <span class="service-card-icon material-icons">flight</span>
            </div>
          </div>
        </div>

        <!-- Land Freight -->
        <div class="col-lg-4 col-md-6 col-12 d-flex justify-content-center mb-4">
          <div class="service-card">
            <img src="assets/img/home/land.jpg" alt="Land Freight" />
            <div class="overlay"></div>
            <div class="service-card-content">
              <div class="service-card-number">03</div>
              <div class="service-card-title">Land Freight</div>
              <div class="service-card-desc">
                Reliable land freight solutions for domestic and cross-border transportation, ensuring
                timely delivery and safety of your cargo.
              </div>
              <a href="service-detail.html?s=land-freight" class="service-card-readmore">READ MORE</a>
              <span class="service-card-icon material-icons">local_shipping</span>
            </div>
          </div>
        </div>

        <!-- Customs Clearance --> 
        <div class="col-lg-4 col-md-6 d-flex justify-content-center mb-4">
          <div class="service-card">
            <img src="assets/img/home/custom.png" alt="Customs Clearance" />
            <div class="overlay"></div>
            <div class="service-card-content">
              <div class="service-card-number">04</div>
              <div class="service-card-title">Customs Clearance</div>
              <div class="service-card-desc">
                Hassle-free customs clearance services to ensure smooth import and export processes,
                minimizing delays and ensuring compliance.
              </div>
              <a href="service-detail.html?s=custom-clearance" class="service-card-readmore">READ MORE</a>
              <span class="service-card-icon material-icons">assignment_turned_in</span>
            </div>
          </div>
        </div>

        <!-- Warehousing -->
        <div class="col-lg-4 col-md-6 d-flex justify-content-center mb-4">
          <div class="service-card">
            <img src="assets/img/home/warehouse.jpg" alt="Warehousing" />
            <div class="overlay"></div>
            <div class="service-card-content">
              <div class="service-card-number">05</div>
              <div class="service-card-title">Warehousing</div>
              <div class="service-card-desc">
                Secure and scalable warehousing solutions for short-term and long-term storage,
                with inventory management and distribution support.
              </div>
              <a href="service-detail.html?s=warehousing" class="service-card-readmore">READ MORE</a>
              <span class="service-card-icon material-icons">warehouse</span>
            </div>
          </div>
        </div>

        <!-- Project Handling -->
        <div class="col-lg-4 col-md-6 d-flex justify-content-center mb-4">
          <div class="service-card">
            <img src="assets/img/home/project.png" alt="Project Handling" />
            <div class="overlay"></div>
            <div class="service-card-content">
              <div class="service-card-number">06</div>
              <div class="service-card-title">Project Handling</div>
              <div class="service-card-desc">
                End-to-end project logistics management, handling oversized and complex cargo with
                tailored transport solutions across air, sea, and land.
              </div>
              <a href="service-detail.html?s=project-handling" class="service-card-readmore">READ MORE</a>
              <span class="service-card-icon material-icons">engineering</span>
            </div>
          </div>
        </div>
      </div>


      <div class="swipper-dots mt-2 ms-2">
        <span class="dot active"></span>
        <span class="dot"></span>
        <span class="dot"></span>
        <span class="dot"></span>
      </div>
    </div>

    <div class="container mt-8">
      <div class="row">
        <div class="col-lg-7 col-12">
          <img src="assets/img/home/why-us.jpg" alt="Air Freight" class="img-fluid rounded">
        </div>
        <div class="col-lg-5 col-12">
          <h2 class="head-2 mb-3">Why You <span class="text-secondary">Choose
              Us</span>
          </h2>
          <span class="font-primary">
            We deliver more than shipments — we deliver confidence. With a proven track record, a global network
            of trusted partners, and a complete range of logistics services, we ensure your goods move swiftly,
            safely, and cost -effectively. Our focus on transparency, technology, and personalized service makes
            us the partner you can count on, every time.
          </span>
          <ul class="list-unstyled">
            <li class="mt-3 font-primary">
              <span class="material-icons text-primary "
                style="font-size:20px;vertical-align:middle;margin-right:8px;">check</span>
              End-to-end logistics solutions — air, sea, land, and warehousing

            </li>
            <li class="mt-3 font-primary">
              <span class="material-icons text-primary"
                style="font-size:20px;vertical-align:middle;margin-right:8px;">check</span>
              Global coverage with local expertise

            </li>
            <li class="mt-3 font-primary">
              <span class="material-icons text-primary"
                style="font-size:20px;vertical-align:middle;margin-right:8px;">check</span>
              24/7 tracking and customer support

            </li>
            <li class="mt-3 font-primary">
              <span class="material-icons text-primary"
                style="font-size:20px;vertical-align:middle;margin-right:8px;">check</span>
              Flexible solutions tailored to your needs

            </li>
          </ul>
          <a href="service.html" class="btn btn-primary mt-3">view all services</a>

        </div>
      </div>

    </div>
    <div class="container py-5 mt-4">
      <div class="row align-items-center">
        <!-- Left: Heading -->
        <div class="col-lg-5 col-12 mb-4 mb-lg-0">
          <h2 class="head-2 text-secondary">
            What our clients<br>say about us
          </h2>
        </div>
        <!-- Center: Client Image -->
        <div class="col-lg-2 col-12 d-flex justify-content-center mb-4 mb-lg-0">
          <div class="testimonial-img"
            style="width:130px; height:130px; border-radius:50%; overflow:hidden; background:#eaeaea;">
            <img id="testimonial-img" src="assets/img/home/client.png" alt="Client"
              style="width:100%; height:100%; object-fit:cover;">
          </div>
        </div>
        <!-- Right: Testimonial & Controls -->
        <div class="col-lg-5 col-12 font-primary">
          <div id="testimonial-text" class=" mb-3">
            It really saves me time and effort. Kargon is exactly what our business has been lacking. I will let
            my mum know about this, she could really make use of cargo!
          </div>
          <div id="testimonial-name" class="fw-bold">
            KRISTIN DIXON
          </div>
          <div id="testimonial-role">
            RELATIONS SPECIALIST
          </div>
          <div class="testimonial-controls mt-4 d-flex gap-3">
            <button id="prev-btn" class="testimonial-arrow text-dark"
              style="width:36px;height:36px;border:2px solid ;border-radius:50%;background:transparent;display:flex;align-items:center;justify-content:center;">
              <span class="material-icons text-dark" style="margin: 0;">arrow_back</span>
            </button>
            <button id="next-btn" class="testimonial-arrow text-dark"
              style="width:36px;height:36px;border:2px solid ;border-radius:50%;background:transparent;display:flex;align-items:center;justify-content:center;">
              <span class="material-icons text-dark" style="margin: 0">arrow_forward</span>
            </button>
          </div>
        </div>
      </div>
    </div>
    <section class="sectionhero-banner  align-items-start mt-4 pt-4"
      style=" background: url('assets/img/home/home-cta.png') center center/cover no-repeat;">
      <div class="container">
        <div class="row align-items-center ">
          <div class="col-lg-8 col-md-8 mt-4 pt-4" style="z-index: 2;">
            <h2 class="head-1 text-white">
              Looking for the best logistics solution provider?
            </h2>
            <a href="contact.html" class="btn btn-primary mt-4">GET IN TOUCH</a>
          </div>
        </div>
      </div>
    </section>
    <section class="blog-section py-5">
      <div class="container">
        <h2 class="head-2 text-center mb-5 text-secondary">What’s New In Freight & Logistics
        </h2>
        <div class="row justify-content-center">
          <!-- Blog Card 1 -->
          <div class="col-lg-4 col-md-6 mb-4 d-flex justify-content-center">
            <div class="blog-card">
              <div class="blog-card-img">
                <img src="assets/img/home/blog1.jpg" alt="Blog 1">
                <span class="blog-card-badge">Business</span>
              </div>
              <div class="blog-card-body">
                <div class="blog-card-date">
                  <span class="material-icons">event</span>
                  25 Nov, 2024
                </div>
                <h3 class="font-primary head-3 fw-bold">
                  Importers achieve savings through the First Sale rule!
                </h3>
                <a href="blog.html" class="readmore-btn">
                  Read More <span class="material-icons" style="font-size:18px;">east</span>
                </a>
              </div>
            </div>
          </div>
          <!-- Blog Card 2 -->
          <div class="col-lg-4 col-md-6 mb-4 d-flex justify-content-center">
            <div class="blog-card">
              <div class="blog-card-img">
                <img src="assets/img/home/blog2.jpg" alt="Blog 2">
                <span class="blog-card-badge">Business</span>
              </div>
              <div class="blog-card-body">
                <div class="blog-card-date">
                  <span class="material-icons">event</span>
                  25 Nov, 2024
                </div>
                <h3 class="font-primary head-3 fw-bold">
                  Importers achieve savings through the First Sale rule!
                </h3>
                <a href="blog.html" class="readmore-btn">
                  Read More <span class="material-icons" style="font-size:18px;">east</span>
                </a>
              </div>
            </div>
          </div>
          <!-- Blog Card 3 -->
          <div class="col-lg-4 col-md-6 mb-4 d-flex justify-content-center">
            <div class="blog-card">
              <div class="blog-card-img">
                <img src="assets/img/home/blog3.jpg" alt="Blog 2">
                <span class="blog-card-badge">Business</span>
              </div>
              <div class="blog-card-body">
                <div class="blog-card-date">
                  <span class="material-icons">event</span>
                  25 Nov, 2024
                </div>
                <h3 class="font-primary head-3 fw-bold">
                  Importers achieve savings through the First Sale rule!
                </h3>
                <a href="blog.html" class="readmore-btn">
                  Read More <span class="material-icons" style="font-size:18px;">east</span>
                </a>
              </div>
            </div>
          </div>
        </div>
        <div class="text-center mt-4">
          <a href="blog.html" class="btn btn-primary blog-readmore-btn">READ MORE</a>
        </div>
      </div>
    </section>