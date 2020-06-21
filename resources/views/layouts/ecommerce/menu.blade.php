<div class="u-header__section u-header__section--light g-bg-primary g-transition-0_3 g-py-10">
  <nav class="js-mega-menu navbar navbar-expand-lg">
    <div class="container">
      <!-- Responsive Toggle Button -->
      <button class="navbar-toggler navbar-toggler-right btn g-line-height-1 g-brd-none g-pa-0 g-pos-abs g-top-3 g-right-0" type="button" aria-label="Toggle navigation" aria-expanded="false" aria-controls="navBar" data-toggle="collapse" data-target="#navBar">
        <span class="hamburger hamburger--slider g-pr-0">
          <span class="hamburger-box">
            <span class="hamburger-inner"></span>
          </span>
        </span>
      </button>
      <a class="navbar-brand" href="{{ url('/')}}">
        <!-- LOGO COMPANY -->
        <img src="{{ asset('template_ecommerce/assets/img/logo/logo 2.png') }}" alt="Image Description" width="10%;">
      </a>
      <div id="navBar" class="collapse navbar-collapse align-items-center flex-sm-row g-pt-15 g-pt-0--lg">
        <ul class="navbar-nav ml-auto">
          <li class="nav-item g-mx-10--lg g-mx-15--xl">
            <a class="nav-link text-uppercase g-color-black--hover g-pl-5 g-pr-0 g-py-20" href="{{ url('/')}}">Home</a>
          </li>
          <li class="nav-item g-mx-10--lg g-mx-15--xl">
            <a class="nav-link text-uppercase g-color-black--hover g-pl-5 g-pr-0 g-py-20" href="{{ url('pages/services/show') }}">Services</a>
          </li>
          <li class="nav-item g-mx-10--lg g-mx-15--xl">
            <a class="nav-link text-uppercase g-color-black--hover g-pl-5 g-pr-0 g-py-20" href="{{ url('/shop') }}">Shop</a>
          </li>
          @guest
          @else
          <!-- <li class="nav-item g-mx-10--lg g-mx-15--xl">
            <a class="nav-link text-uppercase g-color-black--hover g-pl-5 g-pr-0 g-py-20" href="{{ url('/dashboard') }}">Dashboard</a>
          </li> -->
          @endguest
          <li class="nav-item g-mx-10--lg g-mx-15--xl">
            @guest
            <a class="nav-link text-uppercase g-color-black--hover g-pl-5 g-pr-0 g-py-20" href="{{ route('pages_login')}}">Login</a>
            @else
            <a class="nav-link text-uppercase g-color-black--hover g-pl-5 g-pr-0 g-py-20" href="{{ route('order')}}">Profile</a>
            <!-- <div id="logout" class="btn-header transparent pull-right">
              <a class="nav-link text-uppercase g-color-black--hover g-pl-5 g-pr-0 g-py-20" href="{{ route('logout')}}" onclick="event.preventDefault();
                document.getElementById('logout-form').submit();">Logout</a> </span>
              <form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none;">
                {{ csrf_field() }}
              </form>
            </div> -->
            @endguest
          </li>
        </ul>
      </div>
    </div>
  </nav>
</div>
</header>
<!-- End Header -->