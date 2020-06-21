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
<!-- <script src="{{ asset('js/imgal.js') }}"></script> -->

<!-- JS Customization -->
<script src="{{ asset('template_ecommerce/assets/js/custom.js') }}"></script>

@php
$data = \App\Param::select('name_aplikasi','name_perusahaan','copyright_year','alamat','telepon','email','no_wa')->limit(1)->get();
@endphp
<a href="https://api.whatsapp.com/send?phone={{$data[0]->no_wa}}&text=Halo%20Admin%20" class="act-btn">
  <span class="fa fa-phone">
</a>
<style>
  .act-btn {
    background: green;
    display: block;
    width: 50px;
    height: 50px;
    line-height: 50px;
    text-align: center;
    color: white;
    font-size: 20px;
    font-weight: bold;
    border-radius: 50%;
    -webkit-border-radius: 50%;
    text-decoration: none;
    transition: ease all 0.3s;
    position: fixed;
    right: 30px;
    bottom: 30px;
  }

  .act-btn:hover {
    background: blue
  }
</style>

<!-- <script>
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
</script> -->
<!-- Footer -->
<!-- Footer -->
<footer class="g-bg-main-light-v1">
  <!-- Content -->
  <div class="g-brd-secondary-light-v1">
    <div class="container g-pt-100">
      <div class="row justify-content-start g-mb-30 g-mb-0--md">
        <div class="col-md-5 g-mb-30">
          <h2 class="h5 g-color-gray-light-v3 mb-4"><img src={{ asset('template_ecommerce/assets/img/logo/logo_1.png') }} width="70%"></h2>
        </div>

        <div class="col-sm-3 col-md-2 g-mb-30 g-mb-0--sm">
          <h2 class="h5 g-color-gray-light-v3 mb-4">ABOUT</h2>

          <div class="row">
            <div class="col-12 g-mb-20">
              <!-- Links -->
              <ul class="list-unstyled g-font-size-13 mb-0">
                <li class="g-mb-10">
                  <a class="u-link-v5 g-color-gray-dark-v5 g-color-primary--hover" href="{{ url('pages/about_us/show') }}">About Us</a>
                </li>
                <li class="g-my-10">
                  <a class="u-link-v5 g-color-gray-dark-v5 g-color-primary--hover" href="{{ url('pages/ketentuan_order/show') }}">Ketentuan Order</a>
                </li>
              </ul>
              <!-- End Links -->
            </div>
          </div>
        </div>
 
        <div class="col-sm-3 col-md-2 g-mb-30 g-mb-0--sm">
          <h2 class="h5 g-color-gray-light-v3 mb-4">BRANDS</h2>

          <div class="row">
            <div class="col-12 g-mb-20">
              <!-- Links -->
              <ul class="list-unstyled g-font-size-13 mb-0">
                <li class="g-mb-10">
                  <a class="u-link-v5 g-color-gray-dark-v5 g-color-primary--hover" href="{{ url('shop') }}">Zeker</a>
                </li>
              </ul>
              <!-- End Links -->
            </div>
          </div>
        </div>

        <div class="col-sm-3 col-md-3 ml-auto g-mb-30 g-mb-0--sm">
          <h2 class="h5 g-color-gray-light-v3 mb-4">Contacts</h2>

          <!-- Links -->
          <ul class="list-unstyled g-color-gray-dark-v5 g-font-size-13">
            <li class="media my-3">
              <i class="d-flex mt-1 mr-3 icon-hotel-restaurant-235 u-line-icon-pro"></i>
              <div class="media-body">
                {{ $data[0]->alamat }}
              </div>
            </li>
            <li class="media my-3">
              <i class="d-flex mt-1 mr-3 icon-communication-062 u-line-icon-pro"></i>
              <div class="media-body">
                {{ $data[0]->email }}
              </div>
            </li>
            <li class="media my-3">
              <i class="d-flex mt-1 mr-3 icon-communication-033 u-line-icon-pro"></i>
              <div class="media-body">
                {{ $data[0]->telepon }}
              </div>
            </li>
            <li class="media my-5">
              <a href="https://facebook.com"><i class="fa fa-facebook-square"></i></a> &nbsp; &nbsp; &nbsp;
              <a href="https://instagram.com"><i class="fa fa-instagram"></i></a>
            </li>
          </ul>
          <!-- End Links -->
        </div>
      </div>

    </div>
  </div>
  <!-- End Content -->

  <!-- Copyright -->
  <div class="container g-pt-30 g-pb-10">
    <div class="row justify-content-between align-items-center">
      <div class="col-md-12 g-mb-20">
        <br><br><br>

        <p class="g-font-size-13 mb-0" style="text-align:center;">{{ $data[0]->copyright_year }} &copy; {{ $data[0]->name_perusahaan }}</p>
      </div>

    </div>
  </div>
  <!-- End Copyright -->
</footer>
<!-- End Footer -->

<!-- Go To Top -->
<a class="js-go-to u-go-to-v2" href="#!" data-type="fixed" data-position='{
           "bottom": 15,
           "right": 15
         }' data-offset-top="400" data-compensation="#js-header" data-show-effect="zoomIn">
  <!-- <i class="hs-icon hs-icon-arrow-top"></i> -->
</a>
<!-- End Go To Top -->

<!-- Modal Window -->
<div id="modal-type-onscroll" class="js-autonomous-popup text-left g-bg-white g-pos-rel g-rounded-5" style="display: none;" data-modal-type="onscroll" data-open-effect="fadeIn" data-close-effect="fadeIn" data-breakpoint="1000" data-speed="500">
  <button type="button" class="close g-color-main-light-v3 g-color-primary--hover g-font-size-13 g-pos-abs g-top-15 g-right-15 g-opacity-1" onclick="Custombox.modal.close();">
    <i class="hs-icon hs-icon-close"></i>
  </button>

  <!-- Modal Window - Content -->
  <div class="g-width-720">
    <div class="row align-items-center">
      <div class="col-sm-6 g-height-350--sm g-bg-size-cover g-bg-pos-top-center g-rounded-left-5" data-bg-img-src="assets/img-temp/300x300/img1.jpg"></div>

      <div class="col-sm-6">
        <div class="g-pl-30 g-pl-20--sm g-pr-30 g-py-20">
          <!-- Info -->
          <div class="g-mb-35">
            <h3 class="h1 g-color-primary">Subscribe</h3>
            <p class="g-font-weight-300 g-font-size-16">Get free promotions every month!</p>
          </div>
          <!-- End Info -->

          <!-- Subscribe Form -->
          <form class="input-group u-shadow-v19 rounded g-mb-20">
            <input class="form-control g-brd-right-none g-brd-gray-light-v4 g-color-white g-bg-main-light-v3 g-rounded-left-5 g-px-20 g-py-8" type="email" placeholder="Enter your email">
            <span class="input-group-addon u-shadow-v19 g-brd-left-none g-brd-gray-light-v4 g-bg-main-light-v3 g-rounded-right-5 g-pa-5">
              <button class="btn u-btn-primary rounded text-uppercase g-py-8 g-px-18" type="submit">
                <i class="fa fa-angle-right"></i>
              </button>
            </span>
          </form>
          <!-- End Subscribe Form -->

          <!-- Social Icons -->
          <ul class="list-inline mb-0">
            <li class="list-inline-item g-mx-0">
              <a class="u-icon-v3 u-icon-size--xs g-color-main-light-v3 g-color-white--hover g-bg-white g-bg-primary--hover g-font-size-13 rounded" href="#!">
                <i class="fa fa-facebook"></i>
              </a>
            </li>
            <li class="list-inline-item g-mx-0">
              <a class="u-icon-v3 u-icon-size--xs g-color-main-light-v3 g-color-white--hover g-bg-white g-bg-primary--hover g-font-size-13 rounded" href="#!">
                <i class="fa fa-twitter"></i>
              </a>
            </li>
            <li class="list-inline-item g-mx-0">
              <a class="u-icon-v3 u-icon-size--xs g-color-main-light-v3 g-color-white--hover g-bg-white g-bg-primary--hover g-font-size-13 rounded" href="#!">
                <i class="fa fa-instagram"></i>
              </a>
            </li>
            <li class="list-inline-item g-mx-0">
              <a class="u-icon-v3 u-icon-size--xs g-color-main-light-v3 g-color-white--hover g-bg-white g-bg-primary--hover g-font-size-13 rounded" href="#!">
                <i class="fa fa-google-plus"></i>
              </a>
            </li>
            <li class="list-inline-item g-mx-0">
              <a class="u-icon-v3 u-icon-size--xs g-color-main-light-v3 g-color-white--hover g-bg-white g-bg-primary--hover g-font-size-13 rounded" href="#!">
                <i class="fa fa-linkedin"></i>
              </a>
            </li>
          </ul>
          <!-- End Social Icons -->
        </div>
      </div>
    </div>
  </div>
  <!-- End Modal Window - Content -->
</div>
<!-- End Modal Window -->
</main>

<div class="u-outer-spaces-helper"></div>
<!-- BASE FUNCTION AZHTECH  -->
<!-- <script src="{{ asset('js/basefunction.js') }}"></script>
    <script src="{{ asset('js/accountingfunction.js') }}"></script> -->
</body>

</html>