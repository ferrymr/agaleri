@extends('layouts.ecommerce.app')

@section('content')

<!-- Promo Block -->
<section class="dzsparallaxer auto-init height-is-based-on-content use-loading mode-scroll loaded dzsprx-readyall" data-options='{direction: "fromtop", animation_duration: 25, direction: "reverse"}'>
  <div class="divimage dzsparallaxer--target w-100 g-bg-pos-top-center g-bg-cover g-bg-black-opacity-0_1--after" style="height: 100%; background-image: url({{ asset('template_ecommerce/assets/img/header/header_shop.png') }});"></div>

  <div class="container g-color-white g-pt-100 g-pb-40">
    <div class="g-mb-50" style="margin-top:450px;"></div>
  </div>
</section>
<!-- End Promo Block -->

<!-- Products -->
<div class="container">
  <div class="row">
    <!-- Content -->
    <div class="col-md-9 order-md-2">
      <div class="g-pl-15--lg">
        <!-- Filters -->
        <div class="d-flex justify-content-end align-items-center g-brd-bottom g-brd-gray-light-v4 g-pt-40 g-pb-20">
          <!-- Show -->
          <div class="g-mr-60">
            <!-- <h2 class="h6 align-middle d-inline-block g-font-weight-400 text-uppercase g-pos-rel g-top-1 mb-0">Show:</h2> -->
            <!-- End Secondary Button -->
          </div>
          <!-- End Show -->

          <!-- Sort By -->
          <div class="g-mr-60">
            <h2 class="h6 align-middle d-inline-block g-font-weight-400 text-uppercase g-pos-rel g-top-1 mb-0">Sort by:</h2>

            <!-- Secondary Button -->
            <div class="d-inline-block btn-group g-line-height-1_2">
              <button type="button" class="btn btn-secondary dropdown-toggle h6 align-middle g-brd-none g-color-gray-dark-v5 g-color-black--hover g-bg-transparent text-uppercase g-font-weight-300 g-font-size-12 g-pa-0 g-pl-10 g-ma-0" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                Bestseller
              </button>
              <div class="dropdown-menu rounded-0">
                <a class="dropdown-item g-color-gray-dark-v4 g-font-weight-300" href="#!">Bestseller</a>
                <a class="dropdown-item g-color-gray-dark-v4 g-font-weight-300" href="#!">Price low to high</a>
                <a class="dropdown-item g-color-gray-dark-v4 g-font-weight-300" href="#!">price high to low</a>
              </div>
            </div>
            <!-- End Secondary Button -->
          </div>
          <!-- End Sort By -->

          <!-- Sort By -->

          <!-- End Sort By -->
        </div>
        <!-- End Filters -->

        <!-- Products -->
        <div class="row g-pt-30 g-mb-50">
          @foreach($produk as $p)
          <div class="col-6 col-lg-4 g-mb-30" name="card_{{ $p->id_category }}">
            <!-- Product -->
            <figure class="g-pos-rel g-mb-20">
              <img class="img-fluid" src="{{ asset($p->thumb) }}" alt="{{ $p->name }} {{ $p->id }}">
              <figcaption class="w-100 g-bg-primary g-bg-black--hover text-center g-pos-abs g-bottom-0 g-transition-0_2 g-py-5">
                <a class="g-color-white g-font-size-11 text-uppercase g-letter-spacing-1 g-text-underline--none--hover" href="{{url('single-produk/'.$p->id)}}">Beli</a>
              </figcaption>
            </figure>
            <div class="media">
              <!-- Product Info -->

              <div class="d-flex flex-column">
                <h4 class="h6 g-color-black mb-1">
                  <a class="u-link-v5 g-color-black g-color-primary--hover" href="{{url('single-produk/'.$p->id)}}">
                    {{ $p->name }}
                  </a>
                </h4>
                <a class="d-inline-block g-color-gray-dark-v5 g-font-size-13" href="#!">{{ $p->id }}</a>
                <span class="d-block g-color-black g-font-size-17">Rp. {{ number_format($p->harga) }}</span>
              </div>
              <!-- End Product Info -->

              <!-- Products Icons
              <ul class="list-inline media-body text-right">
                <li class="list-inline-item align-middle mx-0">
                  <a class="u-icon-v1 u-icon-size--sm g-color-gray-dark-v5 g-color-primary--hover g-font-size-15 rounded-circle" href="#!"
                     data-toggle="tooltip"
                     data-placement="top"
                     title="Add to Cart">
                    <i class="icon-finance-100 u-line-icon-pro"></i>
                  </a>
                </li>
                <li class="list-inline-item align-middle mx-0">
                  <a class="u-icon-v1 u-icon-size--sm g-color-gray-dark-v5 g-color-primary--hover g-font-size-15 rounded-circle" href="#!"
                     data-toggle="tooltip"
                     data-placement="top"
                     title="Add to Wishlist">
                    <i class="icon-medical-022 u-line-icon-pro"></i>
                  </a>
                </li>
              </ul>
              -- End Products Icons -->
            </div>

            <!-- End Product -->
          </div>
          @endforeach

        </div>
        <!-- End Products -->

        <!-- <hr class="g-mb-60"> -->

        <!-- Pagination -->
        <!-- <nav class="g-mb-100" aria-label="Page Navigation">
          <ul class="list-inline mb-0">
            <li class="list-inline-item hidden-down">
              <a class="active u-pagination-v1__item g-width-30 g-height-30 g-brd-gray-light-v3 g-brd-primary--active g-color-white g-bg-primary--active g-font-size-12 rounded-circle g-pa-5" href="#!">1</a>
            </li>
            <li class="list-inline-item hidden-down">
              <a class="u-pagination-v1__item g-width-30 g-height-30 g-color-gray-dark-v5 g-color-primary--hover g-font-size-12 rounded-circle g-pa-5" href="#!">2</a>
            </li>
            <li class="list-inline-item g-hidden-xs-down">
              <a class="u-pagination-v1__item g-width-30 g-height-30 g-color-gray-dark-v5 g-color-primary--hover g-font-size-12 rounded-circle g-pa-5" href="#!">3</a>
            </li>
            <li class="list-inline-item hidden-down">
              <span class="g-width-30 g-height-30 g-color-gray-dark-v5 g-font-size-12 rounded-circle g-pa-5">...</span>
            </li>
            <li class="list-inline-item g-hidden-xs-down">
              <a class="u-pagination-v1__item g-width-30 g-height-30 g-color-gray-dark-v5 g-color-primary--hover g-font-size-12 rounded-circle g-pa-5" href="#!">15</a>
            </li>
            <li class="list-inline-item">
              <a class="u-pagination-v1__item g-width-30 g-height-30 g-brd-gray-light-v3 g-brd-primary--hover g-color-gray-dark-v5 g-color-primary--hover g-font-size-12 rounded-circle g-pa-5 g-ml-15" href="#!" aria-label="Next">
                <span aria-hidden="true">
                  <i class="fa fa-angle-right"></i>
                </span>
                <span class="sr-only">Next</span>
              </a>
            </li>
            <li class="list-inline-item float-right">
              <span class="u-pagination-v1__item-info g-color-gray-dark-v4 g-font-size-12 g-pa-5">Page 1 of 15</span>
            </li>
          </ul>
        </nav> -->
        <!-- End Pagination -->
      </div>
    </div>
    <!-- End Content -->

    <!-- Filters -->
    <div class="col-md-3 order-md-1 g-brd-right--lg g-brd-gray-light-v4 g-pt-40">
      <div class="g-pr-15--lg g-pt-60">
        <!-- Categories -->
        <!-- <div class="g-mb-30">
          <h3 class="h5 mb-3">Categories</h3>

          <ul class="list-unstyled">
           
            <li class="my-3">
              <a class="d-block u-link-v5 g-color-gray-dark-v4 g-color-primary--hover" href="#!">
                <span class="float-right g-font-size-12"></span></a>
            </li>
            
          </ul>
        </div> -->
        <!-- End Categories -->

        <!-- <hr> -->

        <!-- Pricing -->
        <!-- <div class="g-mb-30">
          <h3 class="h5 mb-3">Pricing</h3>

          <div class="text-center">
            <span class="d-block g-color-primary mb-4">$(<span id="rangeSliderAmount3">0</span>)</span>
            <div id="rangeSlider1" class="u-slider-v1-3" data-result-container="rangeSliderAmount3" data-range="true" data-default="180, 320" data-min="0" data-max="500"></div>
          </div>
        </div> -->
        <!-- End Pricing -->

        <!-- <hr> -->

        <!-- Brand -->
        <div class="g-mb-30">
          <h3 class="h5 mb-3">Brand</h3>

          <ul class="list-unstyled">
            @foreach ($kategori as $k)
            <li class="my-2">
              <label class="form-check-inline u-check d-block u-link-v5 g-color-gray-dark-v4 g-color-primary--hover g-pl-30">
                <input class="g-hidden-xs-up g-pos-abs g-top-0 g-left-0" type="checkbox" name="category" value="{{$k->id}}" checked>
                <span class="d-block u-check-icon-checkbox-v4 g-absolute-centered--y g-left-0">
                  <i class="fa" data-check-icon="&#xf00c"></i>
                </span>
                {{ $k->name_e_kategori }} <span class="float-right g-font-size-13"></span>
              </label>
            </li>
            @endforeach
          </ul>
        </div>
        <!-- End Brand -->

        <hr>

        <!-- Size -->
        <!-- <div class="g-mb-30">
          <h3 class="h5 mb-3">Size</h3>

          <ul class="list-unstyled">
            <li class="my-2">
              <label class="form-check-inline u-check d-block u-link-v5 g-color-gray-dark-v4 g-color-primary--hover g-pl-30">
                <input class="g-hidden-xs-up g-pos-abs g-top-0 g-left-0" type="checkbox">
                <span class="d-block u-check-icon-checkbox-v4 g-absolute-centered--y g-left-0">
                  <i class="fa" data-check-icon="&#xf00c"></i>
                </span>
                S <span class="float-right g-font-size-13">24</span>
              </label>
            </li>
            <li class="my-2">
              <label class="form-check-inline u-check d-block u-link-v5 g-color-gray-dark-v4 g-color-primary--hover g-pl-30">
                <input class="g-hidden-xs-up g-pos-abs g-top-0 g-left-0" type="checkbox" checked>
                <span class="d-block u-check-icon-checkbox-v4 g-absolute-centered--y g-left-0">
                  <i class="fa" data-check-icon="&#xf00c"></i>
                </span>
                M <span class="float-right g-font-size-13">334</span>
              </label>
            </li>
            <li class="my-2">
              <label class="form-check-inline u-check d-block u-link-v5 g-color-gray-dark-v4 g-color-primary--hover g-pl-30">
                <input class="g-hidden-xs-up g-pos-abs g-top-0 g-left-0" type="checkbox">
                <span class="d-block u-check-icon-checkbox-v4 g-absolute-centered--y g-left-0">
                  <i class="fa" data-check-icon="&#xf00c"></i>
                </span>
                L <span class="float-right g-font-size-13">18</span>
              </label>
            </li>
            <li class="my-2">
              <label class="form-check-inline u-check d-block u-link-v5 g-color-gray-dark-v4 g-color-primary--hover g-pl-30">
                <input class="g-hidden-xs-up g-pos-abs g-top-0 g-left-0" type="checkbox">
                <span class="d-block u-check-icon-checkbox-v4 g-absolute-centered--y g-left-0">
                  <i class="fa" data-check-icon="&#xf00c"></i>
                </span>
                XL <span class="float-right g-font-size-13">6</span>
              </label>
            </li>
            <li class="my-2">
              <label class="form-check-inline u-check d-block u-link-v5 g-color-gray-dark-v4 g-color-primary--hover g-pl-30">
                <input class="g-hidden-xs-up g-pos-abs g-top-0 g-left-0" type="checkbox">
                <span class="d-block u-check-icon-checkbox-v4 g-absolute-centered--y g-left-0">
                  <i class="fa" data-check-icon="&#xf00c"></i>
                </span>
                XXL <span class="float-right g-font-size-13">71</span>
              </label>
            </li>
          </ul>
        </div> -->
        <!-- End Size -->

      </div>
    </div>
    <!-- End Filters -->
  </div>
</div>
<!-- End Products -->


@endsection

@section('script')
<!-- JS Global Compulsory -->
<script src="{{ asset('template_ecommerce/assets/vendor/jquery/jquery.min.js') }}"></script>
<script src="{{ asset('template_ecommerce/assets/vendor/jquery-migrate/jquery-migrate.min.js') }}"></script>
<script src="{{ asset('template_ecommerce/assets/vendor/popper.min.js') }}"></script>
<script src="{{ asset('template_ecommerce/assets/vendor/bootstrap/bootstrap.min.js') }}"></script>

<!-- JS Implementing Plugins -->
<script src="{{ asset('template_ecommerce/assets/vendor/jquery-ui/ui/widget.js') }}"></script>
<script src="{{ asset('template_ecommerce/assets/vendor/jquery-ui/ui/widgets/menu.js') }}"></script>
<script src="{{ asset('template_ecommerce/assets/vendor/jquery-ui/ui/widgets/mouse.js') }}"></script>
<script src="{{ asset('template_ecommerce/assets/vendor/jquery-ui/ui/widgets/slider.js') }}"></script>
<script src="{{ asset('template_ecommerce/assets/vendor/dzsparallaxer/dzsparallaxer.js') }}"></script>
<script src="{{ asset('template_ecommerce/assets/vendor/dzsparallaxer/dzsscroller/scroller.js') }}"></script>
<script src="{{ asset('template_ecommerce/assets/vendor/dzsparallaxer/advancedscroller/plugin.js') }}"></script>
<script src="{{ asset('template_ecommerce/assets/vendor/hs-megamenu/src/hs.megamenu.js') }}"></script>
<script src="{{ asset('template_ecommerce/assets/vendor/malihu-scrollbar/jquery.mCustomScrollbar.concat.min.js') }}"></script>

<!-- JS Unify -->
<script src="{{ asset('template_ecommerce/assets/js/hs.core.js') }}"></script>
<script src="{{ asset('template_ecommerce/assets/js/components/hs.header.js') }}"></script>
<script src="{{ asset('template_ecommerce/assets/js/helpers/hs.hamburgers.js') }}"></script>
<script src="{{ asset('template_ecommerce/assets/js/components/hs.dropdown.js') }}"></script>
<script src="{{ asset('template_ecommerce/assets/js/components/hs.scrollbar.js') }}"></script>
<script src="{{ asset('template_ecommerce/assets/js/helpers/hs.rating.js') }}"></script>
<script src="{{ asset('template_ecommerce/assets/js/components/hs.slider.js') }}"></script>
<script src="{{ asset('template_ecommerce/assets/js/components/hs.go-to.js') }}"></script>

<!-- JS Customization -->
<script src="{{ asset('template_ecommerce/assets/js/custom.js') }}"></script>

<!-- JS Plugins Init. -->
<script>
  $('[name=category]').on('click', function() {
    $('[name=category]').each(function(index, value) {
      val = $(this).val();
      // console.log(val);
      
      if ($(this).is(':checked')) {
        $('[name=card_' + val + ']').show();
        console.log(val+' true');
      }else {
        $('[name=card_' + val + ']').hide();
        console.log(val+' else');
      }
    });
  });
  $(document).on('ready', function() {
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

    // initialization of HSScrollBar component
    $.HSCore.components.HSScrollBar.init($('.js-scrollbar'));

    // initialization of go to
    $.HSCore.components.HSGoTo.init('.js-go-to');

    // initialization of rating
    $.HSCore.helpers.HSRating.init();

    // initialization of range slider
    $.HSCore.components.HSSlider.init('#rangeSlider1');
  });
</script>
@endsection