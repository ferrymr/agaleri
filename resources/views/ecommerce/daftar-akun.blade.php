@extends('layouts.ecommerce.app')
<!-- ecommerce member -->
@section('content')
<!-- style -->
<!-- CSS Global Compulsory -->
<link rel="stylesheet" href="{{ asset('template_ecommerce/assets/vendor/bootstrap/bootstrap.min.css') }}">
<link rel="stylesheet" href="{{ asset('template_ecommerce/assets/vendor/icon-line/css/simple-line-icons.css') }}">

<!-- CSS Implementing Plugins -->
<link rel="stylesheet" href="{{ asset('template_ecommerce/assets/vendor/icon-awesome/css/font-awesome.min.css') }}">
<link rel="stylesheet" href="{{ asset('template_ecommerce/assets/vendor/icon-line-pro/style.css') }}">
<link rel="stylesheet" href="{{ asset('template_ecommerce/assets/vendor/jquery-ui/themes/base/jquery-ui.min.css') }}">
<link rel="stylesheet" href="{{ asset('template_ecommerce/assets/vendor/chosen/chosen.css') }}">
<link rel="stylesheet" href="{{ asset('template_ecommerce/assets/vendor/icon-hs/style.css') }}">
<link rel="stylesheet" href="{{ asset('template_ecommerce/assets/vendor/animate.css') }}">
<link rel="stylesheet" href="{{ asset('template_ecommerce/assets/vendor/hamburgers/hamburgers.min.css') }}">
<link rel="stylesheet" href="{{ asset('template_ecommerce/assets/vendor/hs-megamenu/src/hs.megamenu.css') }}">
<link rel="stylesheet" href="{{ asset('template_ecommerce/assets/vendor/malihu-scrollbar/jquery.mCustomScrollbar.min.css') }}">

<!-- CSS Unify Theme -->
<link rel="stylesheet" href="{{ asset('template_ecommerce/assets/css/styles.e-commerce.css') }}">

<!-- CSS Customization -->
<link rel="stylesheet" href="{{ asset('template_ecommerce/assets/css/custom.css') }}">
<!-- end style -->

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
        <span>Signup</span>
      </li>
    </ul>
  </div>
</section>
<!-- End Breadcrumbs -->

<!-- Signup -->
<section class="container g-pt-100 g-pb-20">
  <div class="row">
    <div class="col-lg-5 order-lg-2 g-mb-80">
      <div class="g-brd-around g-brd-gray-light-v3 g-bg-white rounded g-px-30 g-py-50 mb-4">
        <header class="text-center mb-4">
          <h1 class="h4 g-color-black g-font-weight-400">Create New Account</h1>
        </header>

        <!-- Form -->
        <form class="g-py-15" method="post" action="/daftar-akun/add" enctype="multipart/form-data">
          {{ csrf_field() }} {{ method_field('POST') }}
          <div class="row">
            <div class="col g-mb-20">
              <input name="txtNamaDepan" class="form-control g-color-black g-bg-white g-bg-white--focus g-brd-gray-light-v3 rounded g-py-15 g-px-15" type="text" placeholder="Nama Depan">
            </div>

            <div class="col g-mb-20">
              <input name="txtNamaBelakang" class="form-control g-color-black g-bg-white g-bg-white--focus g-brd-gray-light-v3 rounded g-py-15 g-px-15" type="text" placeholder="Nama Belakang">
            </div>
          </div>

          <div class="row">
            <div class="col-sm-6 col-md-12 col-lg-6 g-mb-20">
              <select name="txtBulan" class="js-custom-select u-select-v1 h-100 g-brd-gray-light-v3 g-color-gray-dark-v5 rounded g-py-12" style="width: 100%;"
                      data-placeholder="Bulan"
                      data-open-icon="fa fa-angle-down"
                      data-close-icon="fa fa-angle-up">
                <option></option>
                <option value="1">Januari</option>
                <option value="2">Februari</option>
                <option value="3">Maret</option>
                <option value="4">April</option>
                <option value="5">Mai</option>
                <option value="6">Juni</option>
                <option value="7">Juli</option>
                <option value="8">Augustus</option>
                <option value="9">September</option>
                <option value="10">Oktober</option>
                <option value="11">November</option>
                <option value="12">Desember</option>
              </select>
            </div>

            <div class="col g-mb-20">
              <select name="txtHari" class="js-custom-select u-select-v1 h-100 g-brd-gray-light-v3 g-color-gray-dark-v5 rounded g-py-12" style="width: 100%;"
                      data-placeholder="Hari"
                      data-open-icon="fa fa-angle-down"
                      data-close-icon="fa fa-angle-up">
                <option></option>
                <option value="senin">Senin</option>
                <option value="selasa">Selasa</option>
                <option value="rabu">Rabu</option>
                <option value="kamis">Kamis</option>
                <option value="jumat">Jumat</option>
                <option value="sabtu">Sabtu</option>
                <option value="minggu">Minggu</option>
              </select>
            </div>

            <div class="col g-mb-20">
              <input name="txtTahun" class="form-control g-color-black g-bg-white g-bg-white--focus g-brd-gray-light-v3 rounded g-py-15 g-px-15" type="text" placeholder="Tahun">
            </div>
          </div>

          <div class="g-mb-20">
            <input name="txtNamaPengguna" class="form-control g-color-black g-bg-white g-bg-white--focus g-brd-gray-light-v3 rounded g-py-15 g-px-15" type="text" placeholder="Nama Pengguna">
          </div>

          <div class="g-mb-20">
            <input name="txtEmail" class="form-control g-color-black g-bg-white g-bg-white--focus g-brd-gray-light-v3 rounded g-py-15 g-px-15" type="text" placeholder="Alamat Email">
          </div>

          <div class="g-mb-20">
            <input name="txtKataKunci" class="form-control g-color-black g-bg-white g-bg-white--focus g-brd-gray-light-v3 rounded g-py-15 g-px-15" type="text" placeholder="Kata Kunci">
          </div>

          <div class="g-mb-20">
            <input name="txtVerifikasiKataKunci" class="form-control g-color-black g-bg-white g-bg-white--focus g-brd-gray-light-v3 rounded g-py-15 g-px-15" type="text" placeholder="Verifikasi Kata Kunci">
          </div>

          <div class="mb-1">
            <label class="form-check-inline u-check g-color-gray-dark-v5 g-font-size-13 g-pl-25 mb-2">
              <input class="g-hidden-xs-up g-pos-abs g-top-0 g-left-0" type="checkbox">
              <span class="d-block u-check-icon-checkbox-v6 g-absolute-centered--y g-left-0">
                <i class="fa" data-check-icon="&#xf00c"></i>
              </span>
              I accept the <a href="#!">Terms and Conditions</a>
            </label>
          </div>

          <div class="mb-3">
            <label class="form-check-inline u-check g-color-gray-dark-v5 g-font-size-13 g-pl-25 mb-2">
              <input class="g-hidden-xs-up g-pos-abs g-top-0 g-left-0" type="checkbox">
              <span class="d-block u-check-icon-checkbox-v6 g-absolute-centered--y g-left-0">
                <i class="fa" data-check-icon="&#xf00c"></i>
              </span>
              Subscribe to our newsletter
            </label>
          </div>

          <button class="btn btn-block u-btn-primary g-font-size-12 text-uppercase g-py-12 g-px-25" type="submit">Signup</button>
        </form>
        <!-- End Form -->
      </div>

      <div class="text-center">
        <p class="g-color-gray-dark-v5 mb-0">Already have an account?
          <a class="g-font-weight-600" href="page-login-1.html">signin</a></p>
      </div>
    </div>

    <div class="col-lg-7 order-lg-1 g-mb-80">
      <div class="g-pr-20--lg">
        <div class="mb-5">
          <h2 class="h1 g-font-weight-400 mb-3">Welcome to Unify</h2>
          <p class="g-color-gray-dark-v4">The time has come to bring those ideas and plans to life. This is where we really begin to visualize your napkin sketches and make them into beautiful pixels.</p>
        </div>

        <div class="row text-center mb-5">
          <div class="col-sm-4 g-mb-10">
            <!-- Counters -->
            <div class="g-bg-gray-light-v5 g-pa-20">
              <div class="js-counter g-color-gray-dark-v5 g-font-weight-300 g-font-size-25 g-line-height-1">52147</div>
              <div class="d-inline-block g-width-10 g-height-2 g-bg-gray-dark-v5 mb-1"></div>
              <h4 class="g-color-gray-dark-v4 g-font-size-12 text-uppercase">Code Lines</h4>
            </div>
            <!-- End Counters -->
          </div>

          <div class="col-sm-4 g-mb-10">
            <!-- Counters -->
            <div class="g-bg-gray-light-v5 g-pa-20">
              <div class="js-counter g-color-gray-dark-v5 g-font-weight-300 g-font-size-25 g-line-height-1">24583</div>
              <div class="d-inline-block g-width-10 g-height-2 g-bg-gray-dark-v5 mb-1"></div>
              <h4 class="g-color-gray-dark-v4 g-font-size-12 text-uppercase">Projects</h4>
            </div>
            <!-- End Counters -->
          </div>

          <div class="col-sm-4 g-mb-10">
            <!-- Counters -->
            <div class="g-bg-gray-light-v5 g-pa-20">
              <div class="js-counter g-color-gray-dark-v5 g-font-weight-300 g-font-size-25 g-line-height-1">7348</div>
              <div class="d-inline-block g-width-10 g-height-2 g-bg-gray-dark-v5 mb-1"></div>
              <h4 class="g-color-gray-dark-v4 g-font-size-12 text-uppercase">Working Hours</h4>
            </div>
            <!-- End Counters -->
          </div>
        </div>

        <div class="text-center">
          <h2 class="h4 g-font-weight-400 mb-4">Join more than
            <span class="g-color-primary">33,000</span> members worldwide</h2>
          <img class="img-fluid g-opacity-0_6" src="{{ asset('template_ecommerce/assets/img/maps/map.png') }}" alt="Image Description">
        </div>
      </div>
    </div>
  </div>
</section>
<!-- End Signup -->


@endsection

@section('script')
<!-- JS Global Compulsory -->
<script src="{{ asset('template_ecommerce/assets/vendor/jquery/jquery.min.js') }}"></script>
<script src="{{ asset('template_ecommerce/assets/vendor/jquery-migrate/jquery-migrate.min.js') }}"></script>
<script src="{{ asset('template_ecommerce/assets/vendor/popper.min.js') }}"></script>
<script src="{{ asset('template_ecommerce/assets/vendor/bootstrap/bootstrap.min.js') }}"></script>

<!-- JS Implementing Plugins -->
<script src="{{ asset('template_ecommerce/assets/vendor/appear.js') }}"></script>
<script src="{{ asset('template_ecommerce/assets/vendor/chosen/chosen.jquery.js') }}"></script>
<script src="{{ asset('template_ecommerce/assets/vendor/image-select/src/ImageSelect.jquery.js') }}"></script>
<script src="{{ asset('template_ecommerce/assets/vendor/hs-megamenu/src/hs.megamenu.js') }}"></script>
<script src="{{ asset('template_ecommerce/assets/vendor/malihu-scrollbar/jquery.mCustomScrollbar.concat.min.js') }}"></script>

<!-- JS Unify -->
<script src="{{ asset('template_ecommerce/assets/js/hs.core.js') }}"></script>
<script src="{{ asset('template_ecommerce/assets/js/components/hs.header.js') }}"></script>
<script src="{{ asset('template_ecommerce/assets/js/helpers/hs.hamburgers.js') }}"></script>
<script src="{{ asset('template_ecommerce/assets/js/components/hs.dropdown.js') }}"></script>
<script src="{{ asset('template_ecommerce/assets/js/components/hs.scrollbar.js') }}"></script>
<script src="{{ asset('template_ecommerce/assets/js/components/hs.select.js') }}"></script>
<script src="{{ asset('template_ecommerce/assets/js/components/hs.counter.js') }}"></script>
<script src="{{ asset('template_ecommerce/assets/js/components/hs.go-to.js') }}"></script>

<!-- JS Customization -->
<script src="{{ asset('template_ecommerce/assets/js/custom.js') }}"></script>

<!-- JS Plugins Init. -->
<script>
  $(document).on('ready', function () {
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
      afterOpen: function () {
        $(this).find('input[type="search"]').focus();
      }
    });

    // initialization of HSScrollBar component
    $.HSCore.components.HSScrollBar.init($('.js-scrollbar'));

    // initialization of go to
    $.HSCore.components.HSGoTo.init('.js-go-to');

    // initialization of custom select
    $.HSCore.components.HSSelect.init('.js-custom-select');

    // initialization of counters
    var counters = $.HSCore.components.HSCounter.init('[class*="js-counter"]');
  });
</script>
@endsection
