<!DOCTYPE html>
<html lang="en">

<head>

  <!-- Required Meta Tags Always Come First -->
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
  <meta http-equiv="x-ua-compatible" content="ie=edge">

  <!-- CSRF Token -->
  <meta name="csrf-token" content="{{ csrf_token() }}">

  <!-- Title -->
  <title>{{ config('app.name', 'eManufacture') }} - @yield('title')</title>

  <!-- Favicon-->
  <link rel="shortcut icon" href="{{ asset('template/img/favicon/favicon.ico') }}">

  <!-- Google Fonts -->
  <link rel="stylesheet" href="//fonts.googleapis.com/css?family=Roboto%3A300%2C400%2C500%2C700%7CPlayfair+Display%7CRaleway%7CSpectral%7CRubik">
  <!-- style -->
  <!-- CSS Global Compulsory -->
  <link rel="stylesheet" href="{{ asset('template_ecommerce/assets/vendor/bootstrap/bootstrap.min.css') }}">

  <!-- CSS Implementing Plugins -->
  <link rel="stylesheet" href="{{ asset('template_ecommerce/assets/vendor/animate.css') }}">
  <link rel="stylesheet" href="{{ asset('template_ecommerce/assets/vendor/icon-awesome/css/font-awesome.min.css') }}">
  <link rel="stylesheet" href="{{ asset('template_ecommerce/assets/vendor/icon-line-pro/style.css') }}">
  <link rel="stylesheet" href="{{ asset('template_ecommerce/assets/vendor/icon-hs/style.css') }}">
  <link rel="stylesheet" href="{{ asset('template_ecommerce/assets/vendor/dzsparallaxer/dzsparallaxer.css') }}">
  <link rel="stylesheet" href="{{ asset('template_ecommerce/assets/vendor/dzsparallaxer/dzsscroller/scroller.css') }}">
  <link rel="stylesheet" href="{{ asset('template_ecommerce/assets/vendor/dzsparallaxer/advancedscroller/plugin.css') }}">
  <link rel="stylesheet" href="{{ asset('template_ecommerce/assets/vendor/hamburgers/hamburgers.min.css') }}">
  <link rel="stylesheet" href="{{ asset('template_ecommerce/assets/vendor/hs-megamenu/src/hs.megamenu.css') }}">
  <link rel="stylesheet" href="{{ asset('template_ecommerce/assets/vendor/slick-carousel/slick/slick.css') }}">
  <link rel="stylesheet" href="{{ asset('template_ecommerce/assets/vendor/malihu-scrollbar/jquery.mCustomScrollbar.min.css') }}">
  <!-- Revolution Slider -->
  <link rel="stylesheet" href="{{ asset('template_ecommerce/assets/vendor/revolution-slider/revolution/fonts/pe-icon-7-stroke/css/pe-icon-7-stroke.css') }}">
  <link rel="stylesheet" href="{{ asset('template_ecommerce/assets/vendor/revolution-slider/revolution/css/settings.css') }}">
  <link rel="stylesheet" href="{{ asset('template_ecommerce/assets/vendor/revolution-slider/revolution/css/layers.css') }}">
  <link rel="stylesheet" href="{{ asset('template_ecommerce/assets/vendor/revolution-slider/revolution/css/navigation.css') }}">
  <link rel="stylesheet" href="{{ asset('template_ecommerce/assets/vendor/revolution-slider/revolution-addons/typewriter/css/typewriter.css') }}">
  <!-- <link rel="stylesheet" href="{{ asset('css/imgal.min.css') }}"> -->

  <!-- CSS Unify Theme -->
  <link rel="stylesheet" href="{{ asset('template_ecommerce/assets/css/styles.e-commerce.css') }}">

  <!-- CSS Customization -->
  <link rel="stylesheet" href="{{ asset('template_ecommerce/assets/css/custom.css') }}">
  <!-- end style -->

  @php
  $r = Request::path();
  @endphp
  @if($r == '/' || $r == 'shop' || $r == 'cart' || $r == 'cart/process' || $r == 'shipping' || preg_match("/single-produk/", $r))

  <!-- Facebook Pixel Code -->
  <script>
    ! function(f, b, e, v, n, t, s) {
      if (f.fbq) return;
      n = f.fbq = function() {
        n.callMethod ?
          n.callMethod.apply(n, arguments) : n.queue.push(arguments)
      };
      if (!f._fbq) f._fbq = n;
      n.push = n;
      n.loaded = !0;
      n.version = '2.0';
      n.queue = [];
      t = b.createElement(e);
      t.async = !0;
      t.src = v;
      s = b.getElementsByTagName(e)[0];
      s.parentNode.insertBefore(t, s)
    }(window, document, 'script',
      'https://connect.facebook.net/en_US/fbevents.js');
    fbq('init', '1328197200663252');
    fbq('track', 'PageView');
  </script>
  <noscript><img height="1" width="1" style="display:none" src="https://www.facebook.com/tr?id=1328197200663252&ev=PageView&noscript=1" /></noscript>
  <!-- End Facebook Pixel Code -->
  @endif
</head>


<body>
  <main>
    <!-- Header -->
    <header id="js-header" class="u-header u-header--static u-shadow-v19">
      <!-- Top Bar -->
      <div class="u-header__section g-brd-gray-light-v4 g-bg-black g-transition-0_3">
        <div class="container">
          <div class="row justify-content-between align-items-center g-mx-0--lg">
            <div class="col-sm-auto g-hidden-sm-down">
              <!-- Social Icons -->
              {{-- <ul class="list-inline g-py-14 mb-0">
                <li class="list-inline-item">
                  <a class="g-color-white-opacity-0_9 g-color-primary--hover g-pa-3" href="https://www.facebook.com">
                    <i class="fa fa-facebook"></i>
                  </a>
                </li>
                <li class="list-inline-item">
                  <a class="g-color-white-opacity-0_9 g-color-primary--hover g-pa-3" href="https://www.instagram.com/lunahouse.id/">
                    <i class="fa fa-instagram"></i>
                  </a>
                </li>
                <li class="list-inline-item">
                  <a class="g-color-white-opacity-0_9 g-color-primary--hover g-pa-3" href="https://www.instagram.com/lunahouse.id/">
                    <i class="fa fa-whatsup"></i>
                  </a>
                </li>
              </ul> --}}
              <!-- End Social Icons -->
            </div>

            {{-- <div class="col-sm-auto g-hidden-sm-down g-color-white-opacity-0_9 g-font-weight-400 g-pl-15 g-pl-0--sm g-py-14">
              <i class="icon-communication-163 u-line-icon-pro g-font-size-18 g-valign-middle g-color-white-opacity-0_9 g-mr-10 g-mt-minus-2"></i>
              0813 1324 6941
            </div> --}}

            <!-- <div class="col-sm-auto g-pos-rel g-py-14">
              <ul class="list-inline g-overflow-hidden g-pt-1 g-mx-minus-4 mb-0">
                <li class="list-inline-item g-mx-4">
                  <a class="g-color-white-opacity-0_6 g-color-primary--hover g-font-weight-400 g-text-underline--none--hover" href="page-our-stores-1.html">HUBUNGI KAMI</a>
                </li>
                <li class="list-inline-item g-color-white-opacity-0_3 g-mx-4">|</li>
                <li class="list-inline-item g-mx-4">
                  <a class="g-color-white-opacity-0_6 g-color-primary--hover g-font-weight-400 g-text-underline--none--hover" href="page-help-1.html">BANTUAN</a>
                </li>
                <li class="list-inline-item g-color-white-opacity-0_3 g-mx-4">|</li>
                <li class="list-inline-item g-mx-4">
                  <a class="g-color-white-opacity-0_6 g-color-primary--hover g-font-weight-400 g-text-underline--none--hover" href="/daftar-akun">DAFTAR AKUN</a>
                </li>
              </ul>
            </div> -->


            <div class="col-sm-auto g-pr-15 g-pr-0--sm">
              <!-- Basket -->
              <div class="u-basket d-inline-block g-z-index-3">
                <div class="g-py-10 g-px-6">
                  <a href="{{ route('cart') }}" class="u-icon-v1 g-color-white-opacity-0_8 g-color-primary--hover g-font-size-17 g-text-underline--none--hover">
                    <!-- <span class="u-badge-v1--sm g-color-white g-bg-primary g-font-size-11 g-line-height-1_4 g-rounded-50x g-pa-4" style="top: 7px !important; right: 3px !important;">1</span> -->
                    <i class="icon-hotel-restaurant-105 u-line-icon-pro"></i></a>
                </div>


              </div>
              <!-- End Basket -->
              <div class="d-inline-block g-valign-middle">
                <div class="g-py-10 g-pl-15">
                  <a href="#!" class="g-color-white-opacity-0_9 g-color-primary--hover g-font-size-17 g-text-underline--none--hover" aria-haspopup="true" aria-expanded="false" data-dropdown-event="click" aria-controls="searchform-1" data-dropdown-target="#searchform-1" data-dropdown-type="css-animation" data-dropdown-duration="300" data-dropdown-animation-in="fadeInUp" data-dropdown-animation-out="fadeOutDown">
                    <i class="g-pos-rel g-top-3 icon-education-045 u-line-icon-pro"></i>
                  </a>
                </div>

                <!-- Search Form -->
                <form id="searchform-1" class="u-searchform-v1 u-dropdown--css-animation u-dropdown--hidden u-shadow-v20 g-brd-around g-brd-gray-light-v4 g-bg-white g-right-0 rounded g-pa-10 1g-mt-8">
                  <div class="input-group">
                    <input class="form-control g-font-size-13" type="search" placeholder="Search Here...">
                    <div class="input-group-append p-0">
                      <button class="btn u-btn-primary g-font-size-12 text-uppercase g-py-13 g-px-15" type="submit">Go</button>
                    </div>
                  </div>
                </form>
                <!-- End Search Form -->
              </div>
              <!-- End Search -->
            </div>
          </div>
        </div>
      </div>
      <!-- End Top Bar -->