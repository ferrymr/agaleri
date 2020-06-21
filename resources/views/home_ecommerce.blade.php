@extends('layouts.ecommerce.app')

@section('content')
<!-- style -->
<!-- CSS Global Compulsory -->
<link rel="stylesheet" href="{{ asset('template_ecommerce/assets/vendor/bootstrap/bootstrap.min.css') }}">

<!-- CSS Implementing Plugins -->
<link rel="stylesheet" href="{{ asset('template_ecommerce/assets/vendor/icon-awesome/css/font-awesome.min.css') }}">
<link rel="stylesheet" href="{{ asset('template_ecommerce/assets/vendor/icon-line-pro/style.css') }}">
<link rel="stylesheet" href="{{ asset('template_ecommerce/assets/vendor/slick-carousel/slick/slick.css') }}">
<link rel="stylesheet" href="{{ asset('template_ecommerce/assets/vendor/icon-hs/style.css') }}">
<link rel="stylesheet" href="{{ asset('template_ecommerce/assets/vendor/hamburgers/hamburgers.min.css') }}">
<link rel="stylesheet" href="{{ asset('template_ecommerce/assets/vendor/hs-megamenu/src/hs.megamenu.css') }}">
<link rel="stylesheet" href="{{ asset('template_ecommerce/assets/vendor/malihu-scrollbar/jquery.mCustomScrollbar.min.css') }}">
<link rel="stylesheet" href="{{ asset('template_ecommerce/assets/vendor/animate.css') }}">

<!-- Revolution Slider -->
<link rel="stylesheet" href="{{ asset('template_ecommerce/assets/vendor/revolution-slider/revolution/fonts/pe-icon-7-stroke/css/pe-icon-7-stroke.css') }}">
<link rel="stylesheet" href="{{ asset('template_ecommerce/assets/vendor/revolution-slider/revolution/css/settings.css') }}">
<link rel="stylesheet" href="{{ asset('template_ecommerce/assets/vendor/revolution-slider/revolution/css/layers.css') }}">
<link rel="stylesheet" href="{{ asset('template_ecommerce/assets/vendor/revolution-slider/revolution/css/navigation.css') }}">
<link rel="stylesheet" href="{{ asset('template_ecommerce/assets/vendor/revolution-slider/revolution-addons/typewriter/css/typewriter.css') }}">

<!-- CSS Unify Theme -->
<link rel="stylesheet" href="{{ asset('template_ecommerce/assets/css/styles.e-commerce.css') }}">

<!-- CSS Customization -->
<link rel="stylesheet" href="{{ asset('template_ecommerce/assets/css/custom.css') }}">
<!-- end style -->

<!-- Revolution Slider -->
<div class="g-overflow-hidden">
  <div id="rev_slider_1014_1_wrapper" class="rev_slider_wrapper fullscreen-container" data-alias="typewriter-effect" data-source="gallery" style="background-color:transparent;padding:0px;">
    <!-- START REVOLUTION SLIDER 5.4.1 fullscreen mode -->
    <div id="rev_slider_1014_1" class="rev_slider fullscreenbanner" style="display:none;" data-version="5.4.1">
      <ul>
        <!-- SLIDE  -->
        <li data-index="rs-2800" data-transition="slidingoverlayhorizontal" data-slotamount="default" data-hideafterloop="0" data-hideslideonmobile="off" data-easein="default" data-easeout="default" data-masterspeed="default" data-thumb="{{ asset('template_ecommerce/assets/img-temp/1920x1080/img2.jpg') }}" data-rotate="0" data-saveperformance="off" data-title="Slide" data-param1="" data-param2="" data-param3="" data-param4="" data-param5="" data-param6="" data-param7="" data-param8="" data-param9="" data-param10="" data-description="">
          <!-- MAIN IMAGE -->
          <img src="{{ asset('template_ecommerce/assets/img/slider/Slide 01.png') }}" alt="" data-bgposition="center center" data-bgfit="cover" data-bgparallax="10" class="rev-slidebg">
          <!-- LAYERS -->
        </li>
        <!-- END SLIDE  -->
        <li data-index="rs-2800" data-transition="slidingoverlayhorizontal" data-slotamount="default" data-hideafterloop="0" data-hideslideonmobile="off" data-easein="default" data-easeout="default" data-masterspeed="default" data-thumb="{{ asset('template_ecommerce/assets/img-temp/1920x1080/img2.jpg') }}" data-rotate="0" data-saveperformance="off" data-title="Slide" data-param1="" data-param2="" data-param3="" data-param4="" data-param5="" data-param6="" data-param7="" data-param8="" data-param9="" data-param10="" data-description="">
          <!-- MAIN IMAGE -->
          <img src="{{ asset('template_ecommerce/assets/img/slider/Slide 02.png') }}" alt="" data-bgposition="center center" data-bgfit="cover" data-bgparallax="10" class="rev-slidebg">
          <!-- LAYERS -->
        </li>
        <li data-index="rs-2800" data-transition="slidingoverlayhorizontal" data-slotamount="default" data-hideafterloop="0" data-hideslideonmobile="off" data-easein="default" data-easeout="default" data-masterspeed="default" data-thumb="{{ asset('template_ecommerce/assets/img-temp/1920x1080/img2.jpg') }}" data-rotate="0" data-saveperformance="off" data-title="Slide" data-param1="" data-param2="" data-param3="" data-param4="" data-param5="" data-param6="" data-param7="" data-param8="" data-param9="" data-param10="" data-description="">
          <!-- MAIN IMAGE -->
          <img src="{{ asset('template_ecommerce/assets/img/slider/Slide 03.png') }}" alt="" data-bgposition="center center" data-bgfit="cover" data-bgparallax="10" class="rev-slidebg">
          <!-- LAYERS -->
        </li>

      </ul>
      <div class="tp-bannertimer tp-bottom" style="visibility: hidden !important;"></div>
    </div>
  </div>
</div>
<!-- End Revolution Slider -->



<!-- Categories -->
<div class="container g-pt-100 g-pb-70">
  <div class="row g-mx-minus-1">

    <div class="col-sm-4 col-md-4 g-px-10 g-mb-30">
      <article class="u-block-hover">
        <img class="w-100 u-block-hover__main--zoom-v1 g-mb-minus-8" src="{{ asset('template_ecommerce/assets/img/banner/Banner 01.png') }}" alt="Image Description">
        <div class="g-pos-abs g-bottom-30 g-left-30">
          {{-- <span class="d-block g-color-black">Koleksi</span>
                <h2 class="h1 mb-0">Kaos Polos</h2> --}}
        </div>
        {{-- <a class="u-link-v2" href="#!"></a> --}}
      </article>
    </div>

    <div class="col-sm-4 col-md-4 g-px-10 g-mb-30">
      <article class="u-block-hover">
        <img class="w-100 u-block-hover__main--zoom-v1 g-mb-minus-8" src="{{ asset('template_ecommerce/assets/img/banner/Banner 02.png') }}" alt="Image Description">
        <div class="g-pos-abs g-bottom-30 g-left-30">
          {{-- <span class="d-block g-color-black">Koleksi</span>
                <h2 class="h1 mb-0">Kaos Polos</h2> --}}
        </div>
        {{-- <a class="u-link-v2" href="#!"></a> --}}
      </article>
    </div>

    <div class="col-sm-4 col-md-4 g-px-10 g-mb-30">
      <article class="u-block-hover">
        <img class="w-100 u-block-hover__main--zoom-v1 g-mb-minus-8" src="{{ asset('template_ecommerce/assets/img/banner/Banner 03.png') }}" alt="Image Description">
        <div class="g-pos-abs g-bottom-30 g-left-30">
          {{-- <span class="d-block g-color-black">Koleksi</span>
                <h2 class="h1 mb-0">Kaos Polos</h2> --}}
        </div>
        {{-- <a class="u-link-v2" href="#!"></a> --}}
      </article>
    </div>


  </div>
</div>
<!-- End Categories -->

<!-- New Arrivals -->
<section class="container g-py-100" style="padding-top:0px !important;padding-bottom:0px !important">
  <div class="text-center mx-auto g-max-width-600 g-mb-50">
    <h2 class="g-color-black mb-4"> NEW ARRIVAL </h2>
    {{-- <p class="lead">We want to create a range of beautiful, practical and modern outerwear that doesn't cost the earth – but let's you still live life in style.</p> --}}
  </div>

  <div class="row g-mx-minus-10 g-mb-50">
    <?php $count = 0; ?>
    @foreach($products as $p)
    <?php if ($count == 3) break; ?>
    <div class="col-md-6 col-lg-4 g-px-10">
      <article class="media g-brd-around g-brd-gray-light-v4 g-bg-white rounded g-pa-10 g-mb-20">
        <div class="g-max-width-100 g-mr-15">
          <img class="d-flex w-100" src="{{ asset($p->thumb) }}" alt="Image Description">
        </div>
        <div class="media-body align-self-center">
          <h4 class="h5 g-mb-7">
            <a class="g-color-black g-color-primary--hover g-text-underline--none--hover" href="{{ url('single-produk/'.$p->id) }}">{{ $p->name }}</a>
          </h4>
          <a class="d-inline-block g-color-gray-dark-v5 g-font-size-13 g-mb-10" href="{{ url('single-produk/'.$p->id) }}">{{ $p->id }}</a>
          <footer class="d-flex justify-content-between g-font-size-16">
            <span class="g-color-black g-line-height-1">Rp {{ number_format($p->harga) }}</span>
            <ul class="list-inline g-color-gray-light-v2 g-font-size-14 g-line-height-1">
              <!-- <li class="list-inline-item align-middle g-brd-right g-brd-gray-light-v3 g-pr-10 g-mr-6">
                      <a class="g-color-gray-dark-v5 g-color-primary--hover g-text-underline--none--hover" href="#!" title="Add to Cart"
                         data-toggle="tooltip"
                         data-placement="top">
                        <i class="icon-finance-100 u-line-icon-pro"></i>
                      </a>
                    </li> -->
              <!-- <li class="list-inline-item align-middle">
                      <a class="g-color-gray-dark-v5 g-color-primary--hover g-text-underline--none--hover" href="#!" title="Add to Wishlist"
                         data-toggle="tooltip"
                         data-placement="top">
                        <i class="icon-medical-022 u-line-icon-pro"></i>
                      </a>
                    </li> -->
            </ul>
          </footer>
        </div>
      </article>
    </div>
    <?php $count++; ?>
    @endforeach
  </div>
<!-- 
  <div class="text-center">
    <a class="btn u-btn-primary g-font-size-12 text-uppercase g-py-12 g-px-25" href="https://api.whatsapp.com/send?phone=6281312453661&text=Halo%20Admin%20">CHAT</a>
  </div> -->
  <br>
</section>
<!-- End New Arrivals -->

@endsection

@section('script')
<!-- JS Global Compulsory -->
<script src="{{ asset('template_ecommerce/assets/vendor/jquery/jquery.min.js') }}"></script>
<script src="{{ asset('template_ecommerce/assets/vendor/jquery-migrate/jquery-migrate.min.js') }}"></script>
<script src="{{ asset('template_ecommerce/assets/vendor/popper.min.js') }}"></script>
<script src="{{ asset('template_ecommerce/assets/vendor/bootstrap/bootstrap.min.js') }}"></script>

<!-- JS Implementing Plugins -->
<script src="{{ asset('template_ecommerce/assets/vendor/jquery.countdown.min.js') }}"></script>
<script src="{{ asset('template_ecommerce/assets/vendor/slick-carousel/slick/slick.js') }}"></script>
<script src="{{ asset('template_ecommerce/assets/vendor/hs-megamenu/src/hs.megamenu.js') }}"></script>
<script src="{{ asset('template_ecommerce/assets/vendor/malihu-scrollbar/jquery.mCustomScrollbar.concat.min.js') }}"></script>
<script src="{{ asset('template_ecommerce/assets/vendor/appear.js') }}"></script>

<!-- JS Revolution Slider -->
<script src="{{ asset('template_ecommerce/assets/vendor/revolution-slider/revolution/js/jquery.themepunch.tools.min.js') }}"></script>
<script src="{{ asset('template_ecommerce/assets/vendor/revolution-slider/revolution/js/jquery.themepunch.revolution.min.js') }}"></script>

<script src="{{ asset('template_ecommerce/assets/vendor/revolution-slider/revolution-addons/typewriter/js/revolution.addon.typewriter.min.js') }}"></script>

<script src="{{ asset('template_ecommerce/assets/vendor/revolution-slider/revolution/js/extensions/revolution.extension.actions.min.js') }}"></script>
<script src="{{ asset('template_ecommerce/assets/vendor/revolution-slider/revolution/js/extensions/revolution.extension.carousel.min.js') }}"></script>
<script src="{{ asset('template_ecommerce/assets/vendor/revolution-slider/revolution/js/extensions/revolution.extension.kenburn.min.js') }}"></script>
<script src="{{ asset('template_ecommerce/assets/vendor/revolution-slider/revolution/js/extensions/revolution.extension.layeranimation.min.js') }}"></script>
<script src="{{ asset('template_ecommerce/assets/vendor/revolution-slider/revolution/js/extensions/revolution.extension.migration.min.js') }}"></script>
<script src="{{ asset('template_ecommerce/assets/vendor/revolution-slider/revolution/js/extensions/revolution.extension.navigation.min.js') }}"></script>
<script src="{{ asset('template_ecommerce/assets/vendor/revolution-slider/revolution/js/extensions/revolution.extension.parallax.min.js') }}"></script>
<script src="{{ asset('template_ecommerce/assets/vendor/revolution-slider/revolution/js/extensions/revolution.extension.slideanims.min.js') }}"></script>
<script src="{{ asset('template_ecommerce/assets/vendor/revolution-slider/revolution/js/extensions/revolution.extension.video.min.js') }}"></script>

<!-- JS Unify -->
<script src="{{ asset('template_ecommerce/assets/js/hs.core.js') }}"></script>
<script src="{{ asset('template_ecommerce/assets/js/components/hs.header.js') }}"></script>
<script src="{{ asset('template_ecommerce/assets/js/helpers/hs.hamburgers.js') }}"></script>
<script src="{{ asset('template_ecommerce/assets/js/components/hs.dropdown.js') }}"></script>
<script src="{{ asset('template_ecommerce/assets/js/components/hs.scrollbar.js') }}"></script>
<script src="{{ asset('template_ecommerce/assets/js/components/hs.countdown.js') }}"></script>
<script src="{{ asset('template_ecommerce/assets/js/components/hs.carousel.js') }}"></script>
<script src="{{ asset('template_ecommerce/assets/js/components/hs.go-to.js') }}"></script>
<script src="{{ asset('template_ecommerce/assets/js/components/hs.count-qty.js') }}"></script>

<!-- JS Customization -->
<script src="{{ asset('template_ecommerce/assets/js/custom.js') }}"></script>

<!-- JS Plugins Init. -->
<script>
  $(document).on('ready', function() {
    // initialization of carousel
    $.HSCore.components.HSCarousel.init('[class*="js-carousel"]');

    $('#carouselCus1').slick('setOption', 'responsive', [{
      breakpoint: 1200,
      settings: {
        slidesToShow: 4
      }
    }, {
      breakpoint: 992,
      settings: {
        slidesToShow: 3
      }
    }, {
      breakpoint: 768,
      settings: {
        slidesToShow: 2
      }
    }], true);
  });

  // initialization of header
  $.HSCore.components.HSHeader.init($('#js-header'));
  $.HSCore.helpers.HSHamburgers.init('.hamburger');

  // initialization of HSMegaMenu component
  $('.js-mega-menu').HSMegaMenu({
    event: 'hover',
    pageContainer: $('.container'),
    breakpoint: 991
  });

  // initialization of HSDropdown component
  $.HSCore.components.HSDropdown.init($('[data-dropdown-target]'), {
    afterOpen: function() {
      $(this).find('input[type="search"]').focus();
    }
  });

  // initialization of go to
  $.HSCore.components.HSGoTo.init('.js-go-to');

  // initialization of countdowns
  var countdowns = $.HSCore.components.HSCountdown.init('.js-countdown', {
    yearsElSelector: '.js-cd-years',
    monthElSelector: '.js-cd-month',
    daysElSelector: '.js-cd-days',
    hoursElSelector: '.js-cd-hours',
    minutesElSelector: '.js-cd-minutes',
    secondsElSelector: '.js-cd-seconds'
  });

  // initialization of quantity counter
  $.HSCore.components.HSCountQty.init('.js-quantity');

  $(window).on('load', function() {
    // initialization of HSScrollBar component
    $.HSCore.components.HSScrollBar.init($('.js-scrollbar'));
  });

  // initialization of revolution slider
  var tpj = jQuery;

  var revapi1014;
  tpj(document).ready(function() {
    if (tpj("#rev_slider_1014_1").revolution == undefined) {
      revslider_showDoubleJqueryError("#rev_slider_1014_1");
    } else {
      revapi1014 = tpj("#rev_slider_1014_1").show().revolution({
        sliderType: "standard",
        jsFileLocation: "revolution/js/",
        sliderLayout: "fullscreen",
        dottedOverlay: "false",
        delay: 3000,
        navigation: {
          keyboardNavigation: "off",
          keyboard_direction: "horizontal",
          mouseScrollNavigation: "off",
          mouseScrollReverse: "default",
          onHoverStop: "off",
          touch: {
            touchenabled: "on",
            swipe_threshold: 75,
            swipe_min_touches: 1,
            swipe_direction: "horizontal",
            drag_block_vertical: false
          },
          arrows: {
            style: "uranus",
            enable: true,
            hide_onmobile: true,
            hide_under: 768,
            hide_onleave: false,
            tmp: '',
            left: {
              h_align: "left",
              v_align: "center",
              h_offset: 20,
              v_offset: 0
            },
            right: {
              h_align: "right",
              v_align: "center",
              h_offset: 20,
              v_offset: 0
            }
          }
        },
        parallax: {
          type: "mouse",
          origo: "slidercenter",
          speed: 2000,
          levels: [2, 3, 4, 5, 6, 7, 12, 16, 10, 50],
          disable_onmobile: "on"
        },
        responsiveLevels: [1240, 1024, 778, 480],
        visibilityLevels: [1240, 1024, 778, 480],
        gridwidth: [1240, 1024, 778, 480],
        gridheight: [868, 768, 960, 600],
        lazyType: "none",
        shadow: 0,
        spinner: "on",
        stopLoop: "off",
        stopAfterLoops: 0,
        stopAtSlide: 0,
        shuffle: "off",
        autoHeight: "on",
        fullScreenAutoWidth: "on",
        fullScreenAlignForce: "off",
        fullScreenOffsetContainer: "#js-header",
        fullScreenOffset: "",
        disableProgressBar: "off",
        hideThumbsOnMobile: "off",
        hideSliderAtLimit: 0,
        hideCaptionAtLimit: 0,
        hideAllCaptionAtLilmit: 0,
        debugMode: false,
        fallbacks: {
          simplifyAll: "off",
          nextSlideOnWindowFocus: "off",
          disableFocusListener: false
        }
      });
    }

    RsTypewriterAddOn(tpj, revapi1014);
  });
  // var baseurl = '{{ url('/') }}';
</script>
@endsection