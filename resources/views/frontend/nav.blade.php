<nav class="navbar navbar-expand-xl navbar-light custom-navbar fixed-top ">
  <div class="container justify-content-between">
    <a class="navbar-brand" href="{{route('home')}}">
      <img src=" {{asset('assets/img/logo.svg')}} " alt="Logo" style="height: 89px;">
    </a>
    <button class="navbar-close-btn d-xl-none" type="button" aria-label="Close menu">
      <span class="material-icons">close</span>
    </button>
    <div class="collapse navbar-collapse" id="navbarContent">
      <ul class="navbar-nav mx-auto d-flex justify-content-center">
        <li class="nav-item"><a class="nav-link" href="{{route('home')}}">HOME</a></li>
        <li class="nav-item"><a class="nav-link" href="{{route('about')}}">ABOUT US</a></li>

        <li class="nav-item dropdown">
          <a class="nav-link dropdown-toggle" href="#" id="servicesDropdown" role="button"
            data-bs-toggle="dropdown" aria-expanded="false">SERVICES</a>
          <ul class="dropdown-menu" aria-labelledby="servicesDropdown">
            <li><a class="dropdown-item" href="{{route('services')}}">All Services</a></li>
            <li><a class="dropdown-item" href="<?= url('service-detail/ocean-freight') ?>">Ocean Freight</a></li>
            <li><a class="dropdown-item" href="<?= url('service-detail/air-freight') ?>">Air Freight</a></li>
            <li><a class="dropdown-item" href="<?= url('service-detail/land-freight') ?>">Land Freight</a></li>
            <li><a class="dropdown-item" href="<?= url('service-detail/customs-clearance') ?>">Customs Clearance</a></li>
            <li><a class="dropdown-item" href="<?= url('service-detail/warehousing') ?>">Warehousing</a></li>
            <li><a class="dropdown-item" href="<?= url('service-detail/project-handling') ?>">Project Handling</a></li>
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