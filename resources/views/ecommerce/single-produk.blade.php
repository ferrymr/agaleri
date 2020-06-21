@extends('layouts.ecommerce.app')
@section('content')
<!-- Breadcrumbs -->
<section class="g-brd-bottom g-brd-gray-light-v4 g-py-30">
  <div class="container">
    <ul class="u-list-inline">
      <li class="list-inline-item g-mr-5">
        <a class="u-link-v5 g-color-text" href="#!">Home</a>
        <i class="g-color-gray-light-v2 g-ml-5 fa fa-angle-right"></i>
      </li>
      <li class="list-inline-item g-mr-5">
        <a class="u-link-v5 g-color-text" href="#!">Pages</a>
        <i class="g-color-gray-light-v2 g-ml-5 fa fa-angle-right"></i>
      </li>
      <li class="list-inline-item g-color-primary">
        <span>Product</span>
      </li>
    </ul>
  </div>
</section>
<!-- End Breadcrumbs -->

<!-- Product Description -->
@foreach($produk as $p)
<form class="form-horizontal" data-toggle="validator" method="post" action="/single-produk/add-cart/{{ $p->id }}" enctype="multipart/form-data">
  {{ csrf_field() }} {{ method_field('POST') }}
  <div class="container g-py-50">
    <div class="row">
      <div class="col-lg-7">
        <!-- Carousel -->
        <div id="carouselCus1" class="js-carousel g-pt-10 g-mb-10" data-infinite="true" data-fade="true" data-arrows-classes="u-arrow-v1 g-brd-around g-brd-white g-absolute-centered--y g-width-45 g-height-45 g-font-size-14 g-color-white g-color-primary--hover rounded-circle" data-arrow-left-classes="fa fa-angle-left g-left-40" data-arrow-right-classes="fa fa-angle-right g-right-40" data-nav-for="#carouselCus2">
          <div class="js-slide g-bg-cover g-bg-black-opacity-0_1--after">
            <img class="img-fluid w-100" src="{{ asset($p->photo) }}" alt="Image Description">
          </div>
          <div class="js-slide g-bg-cover g-bg-black-opacity-0_1--after">
            <img class="img-fluid w-100" src="{{ asset($p->thumb) }}" alt="Image Description">
          </div>
        </div>

        <div id="carouselCus2" class="js-carousel text-center u-carousel-v3 g-mx-minus-5" data-center-mode="true" data-slides-show="3" data-is-thumbs="true" data-focus-on-select="true" data-nav-for="#carouselCus1">
          <div class="js-slide g-cursor-pointer g-px-5">
            <img class="img-fluid" src="{{ asset($p->photo) }}" alt="Image Description">
          </div>
          <div class="js-slide g-cursor-pointer g-px-5">
            <img class="img-fluid" src="{{ asset($p->thumb) }}" alt="Image Description">
          </div>
        </div>
        <!-- End Carousel -->
      </div>

      <div class="col-lg-5">
        <div class="g-px-40--lg g-pt-70">
          <!-- Product Info -->
          <div class="g-mb-30">
            <h6 class="g-font-weight-50">{{ $p->id }}</h6>
            <input type="hidden" name="id_produk" value="{{ $p->id }}">
            <input type="hidden" name="harga" value="{{ $p->harga }}">
            <h1 class="g-font-weight-300 mb-4">{{ $p->name }}</h1>
            <span class="g-color-black g-font-weight-500 g-font-size-30 mr-2">IDR {{ (isset($promo[0]->price)) ? number_format($promo[0]->price) : number_format($p->harga) }}</span>
            <s class="g-color-gray-dark-v4 g-font-weight-500 g-font-size-16">{{ (isset($promo[0]->price)) ? 'IDR '.number_format($p->harga) : '' }}</s>
          </div>
          <!-- End Product Info -->

          <!-- Price -->
          <div class="g-mb-30">
          </div>
          <!-- End Price -->


          <!-- Accordion -->
          <div id="accordion-01" role="tablist" aria-multiselectable="true">
            <div id="accordion-01-heading-01" class="g-brd-y g-brd-gray-light-v3 py-3" role="tab">
              <h5 class="g-font-weight-400 g-font-size-default mb-0">
                <a class="d-block g-color-gray-dark-v5 g-text-underline--none--hover" href="#accordion-01-body-01" data-toggle="collapse" data-parent="#accordion-01" aria-expanded="true" aria-controls="accordion-01-body-01">Description
                  <span class="float-right g-pos-rel g-top-3 mr-1 fa fa-angle-down"></span></a>
              </h5>
            </div>
            <div id="accordion-01-body-01" class="collapse" role="tabpanel" aria-labelledby="accordion-01-heading-01">
              <div class="g-py-10">
                <p class="g-font-size-12 mb-2">{{ $p->deskripsi }}</p>
              </div>
            </div>
          </div>
          <!-- End Accordion -->

          <!-- Size -->
          <div class="d-flex justify-content-between align-items-center g-brd-bottom g-brd-gray-light-v3 py-3" role="tab">
            <h5 class="g-color-gray-dark-v5 g-font-weight-400 g-font-size-default mb-0">Size</h5>

            <div class="js-quantity input-group u-quantity-v1 g-width-200 g-brd-primary--focus">
              <select name="id_size" class="js-custom-select u-select-v1 h-100 rounded g-py-12" style="width: 100%;" data-placeholder="Month" data-open-icon="fa fa-angle-down" data-close-icon="fa fa-angle-up">
                @foreach($produk_stok as $p)
                @if((int)$p->stok < 1) <option value="{{ $p->id_size }}" disabled>{{ $p->id_size }} - Tidak tersedia</option>
                  @else
                  <option value="{{ $p->id_size }}">{{ $p->id_size }} - Sisa {{ $p->stok }}</option>
                  @endif
                  @endforeach
              </select>
            </div>

          </div>
          <!-- End Size -->

          <!-- Quantity -->
          <div class="d-flex justify-content-between align-items-center g-brd-bottom g-brd-gray-light-v3 py-3 g-mb-30" role="tab">
            <h5 class="g-color-gray-dark-v5 g-font-weight-400 g-font-size-default mb-0">Jumlah</h5>

            <div class="js-quantity input-group u-quantity-v1 g-width-80 g-brd-primary--focus">
              <input name="qty" class="js-result form-control text-center g-font-size-13 rounded-0" type="text" value="1" readonly>

              <div class="input-group-addon d-flex align-items-center g-brd-gray-light-v2 g-width-30 g-bg-white g-font-size-13 rounded-0 g-pa-5">
                <i class="js-plus g-color-gray g-color-primary--hover fa fa-angle-up"></i>
                <i class="js-minus g-color-gray g-color-primary--hover fa fa-angle-down"></i>
              </div>
            </div>
          </div>
          <!-- End Quantity -->

          <!-- Buttons -->
          <div class="row g-mx-minus-5 g-mb-20">
            <div class="col g-px-5 g-mb-10">
              <button class="btn btn-block u-btn-primary g-font-size-12 text-uppercase g-py-15 g-px-25" type="submit">
                Add to Cart <i class="align-middle ml-2 icon-finance-100 u-line-icon-pro"></i>
              </button>
            </div>
          </div>
          <!-- End Buttons -->

          <!-- Nav Tabs -->
          <ul class="nav d-flex justify-content-between g-font-size-12 text-uppercase" role="tablist" data-target="nav-1-1-default-hor-left">
            <!-- <li class="nav-item g-brd-bottom g-brd-gray-dark-v4">
              <a class="nav-link active g-color-primary--parent-active g-pa-0 g-pb-1" data-toggle="tab" href="#nav-1-1-default-hor-left--1" role="tab">View Size Guide</a>
            </li>
            <li class="nav-item g-brd-bottom g-brd-gray-dark-v4">
              <a class="nav-link g-color-primary--parent-active g-pa-0 g-pb-1" data-toggle="tab" href="#nav-1-1-default-hor-left--2" role="tab">Delivery</a>
            </li> -->
          </ul>
          <!-- End Nav Tabs -->

          <!-- Tab Panes -->
          <div id="nav-1-1-default-hor-left" class="tab-content">
            <div class="tab-pane fade  g-pt-30" id="nav-1-1-default-hor-left--3" role="tabpanel">
              <p class="g-color-gray-dark-v4 g-font-size-13 mb-0">You can return/exchange your orders in Unify E-commerce. For more information, read our
                <a href="#!">FAQ</a>.</p>
            </div>

            <div class="tab-pane fade show active g-pt-30" id="nav-1-1-default-hor-left--1" role="tabpanel">
              <h4 class="g-font-size-15 mb-3">Size Chart Zeker</h4>

              <!-- Size -->
              <table>
                <tbody>
                  <tr class="g-color-gray-dark-v4 g-font-size-12">
                    <td class="align-top g-width-150 g-py-5">EUR</td>
                    <td class="align-top g-width-50 g-py-5">39</td>
                    <td class="align-top g-width-50 g-py-5">40</td>
                    <td class="align-top g-width-50 g-py-5">41</td>
                    <td class="align-top g-width-50 g-py-5">42</td>
                    <td class="align-top g-width-50 g-py-5">43</td>
                    <td class="align-top g-width-50 g-py-5">44</td>
                  </tr>
                  <tr class="g-color-gray-dark-v4 g-font-size-12">
                    <td class="align-top g-width-150 g-py-5">CM</td>
                    <td class="align-top g-width-50 g-py-5">24.5</td>
                    <td class="align-top g-width-50 g-py-5">25</td>
                    <td class="align-top g-width-50 g-py-5">26</td>
                    <td class="align-top g-width-50 g-py-5">26.5</td>
                    <td class="align-top g-width-50 g-py-5">27.5</td>
                    <td class="align-top g-width-50 g-py-5">28</td>
                  </tr>
                </tbody>
              </table>
              <!-- End Size -->
            </div>
          </div>
          <!-- End Tab Panes -->
        </div>
      </div>
    </div>
  </div>
</form>
@endforeach
<!-- End Product Description -->

@endsection

@section('script')
<!-- JS Global Compulsory -->
<script src="{{ asset('template_ecommerce/assets/vendor/jquery/jquery.min.js') }}"></script>
<script src="{{ asset('template_ecommerce/assets/vendor/jquery-migrate/jquery-migrate.min.js') }}"></script>
<script src="{{ asset('template_ecommerce/assets/vendor/popper.min.js') }}"></script>
<script src="{{ asset('template_ecommerce/assets/vendor/bootstrap/bootstrap.min.js') }}"></script>

<!-- JS Implementing Plugins -->
<script src="{{ asset('template_ecommerce/assets/vendor/slick-carousel/slick/slick.js') }}"></script>
<script src="{{ asset('template_ecommerce/assets/vendor/hs-megamenu/src/hs.megamenu.js') }}"></script>
<script src="{{ asset('template_ecommerce/assets/vendor/jquery.countdown.min.js') }}"></script>
<script src="{{ asset('template_ecommerce/assets/vendor/malihu-scrollbar/jquery.mCustomScrollbar.concat.min.js') }}"></script>

<!-- JS Unify -->
<script src="{{ asset('template_ecommerce/assets/js/hs.core.js') }}"></script>
<script src="{{ asset('template_ecommerce/assets/js/components/hs.header.js') }}"></script>
<script src="{{ asset('template_ecommerce/assets/js/helpers/hs.hamburgers.js') }}"></script>
<script src="{{ asset('template_ecommerce/assets/js/components/hs.dropdown.js') }}"></script>
<script src="{{ asset('template_ecommerce/assets/js/components/hs.scrollbar.js') }}"></script>
<script src="{{ asset('template_ecommerce/assets/js/components/hs.countdown.js') }}"></script>
<script src="{{ asset('template_ecommerce/assets/js/components/hs.carousel.js') }}"></script>
<script src="{{ asset('template_ecommerce/assets/js/components/hs.tabs.js') }}"></script>
<script src="{{ asset('template_ecommerce/assets/js/components/hs.count-qty.js') }}"></script>
<script src="{{ asset('template_ecommerce/assets/js/components/hs.go-to.js') }}"></script>

<!-- JS Customization -->
<script src="{{ asset('template_ecommerce/assets/js/custom.js') }}"></script>

<!-- JS Plugins Init. -->
<script>
  $(document).on('ready', function() {
    // initialization of carousel
    $.HSCore.components.HSCarousel.init('.js-carousel');

    // initialization of header
    $.HSCore.components.HSHeader.init($('#js-header'));
    $.HSCore.helpers.HSHamburgers.init('.hamburger');

    // initialization of HSMegaMenu plugin
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

    // initialization of HSScrollBar component
    $.HSCore.components.HSScrollBar.init($('.js-scrollbar'));

    // initialization of quantity counter
    $.HSCore.components.HSCountQty.init('.js-quantity');

    // initialization of tabs
    $.HSCore.components.HSTabs.init('[role="tablist"]');
  });

  $(window).on('resize', function() {
    setTimeout(function() {
      $.HSCore.components.HSTabs.init('[role="tablist"]');
    }, 200);
  });
</script>
@endsection