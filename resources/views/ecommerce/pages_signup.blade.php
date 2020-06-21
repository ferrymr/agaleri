@extends('layouts.ecommerce.app')
<!-- ecommerce member -->
@section('content')
<!-- Breadcrumbs -->
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
  <title>Laravel -</title>

  <!-- Favicon-->
  <link rel="shortcut icon" href="{{ asset('template/img/favicon/favicon.ico') }}">

  <!-- Google Fonts -->
  <link rel="stylesheet" href="//fonts.googleapis.com/css?family=Roboto%3A300%2C400%2C500%2C700%7CPlayfair+Display%7CRaleway%7CSpectral%7CRubik">

  <!-- style -->
  <!-- CSS Global Compulsory -->
  <link rel="stylesheet" href="{{ asset('template_ecommerce/assets/vendor/bootstrap/bootstrap.min.css') }}">
  <link rel="stylesheet" href="{{ asset('template_ecommerce/assets/vendor/icon-line/css/simple-line-icons.css') }}">

  <!-- CSS Implementing Plugins -->
  <link rel="stylesheet" href="{{ asset('template_ecommerce/assets/vendor/icon-awesome/css/font-awesome.min.css') }}">
  <link rel="stylesheet" href="{{ asset('template_ecommerce/assets/vendor/icon-line-pro/style.css') }}">
  <link rel="stylesheet" href="{{ asset('template_ecommerce/assets/vendor/icon-hs/style.css') }}">
  <link rel="stylesheet" href="{{ asset('template_ecommerce/assets/vendor/dzsparallaxer/dzsparallaxer.css') }}">
  <link rel="stylesheet" href="{{ asset('template_ecommerce/assets/vendor/dzsparallaxer/dzsscroller/scroller.css') }}">
  <link rel="stylesheet" href="{{ asset('template_ecommerce/assets/vendor/dzsparallaxer/advancedscroller/plugin.css') }}">
  <link rel="stylesheet" href="{{ asset('template_ecommerce/assets/vendor/animate.css') }}">
  <link rel="stylesheet" href="{{ asset('template_ecommerce/assets/vendor/hamburgers/hamburgers.min.css') }}">
  <link rel="stylesheet" href="{{ asset('template_ecommerce/assets/vendor/hs-megamenu/src/hs.megamenu.css') }}">
  <link rel="stylesheet" href="{{ asset('template_ecommerce/assets/vendor/malihu-scrollbar/jquery.mCustomScrollbar.min.css') }}">

  <!-- CSS Unify Theme -->
  <link rel="stylesheet" href="{{ asset('template_ecommerce/assets/css/styles.e-commerce.css') }}">

  <!-- CSS Customization -->
  <link rel="stylesheet" href="{{ asset('template_ecommerce/assets/css/custom.css') }}">
  <!-- end style -->
</head>

<body class="g-bk-signup">
  <section class="container g-pt-100 g-pb-20">
    <div class="row">
      <div class="col-lg-5 order-lg-2 g-mb-80">
        <div class="g-brd-around g-brd-gray-light-v3 g-bg-white rounded g-px-30 g-py-50 mb-4">
          <header class="text-center mb-4">
            <h1 class="h4 g-color-black g-font-weight-400">Create New Account</h1>
          </header>

          <!-- Form -->
          <form method="post" action="{{ url('pages_signup/add') }}" class="g-py-15">
            {{ csrf_field() }}
            <div class="row">
              <div class="col g-mb-20">
                <input name="name" class="form-control g-color-black g-bg-white g-bg-white--focus g-brd-gray-light-v3 rounded g-py-15 g-px-15" type="text" placeholder="Name">
              </div>
            </div>

            <div class="g-mb-20">
              <input name="email" class="form-control g-color-black g-bg-white g-bg-white--focus g-brd-gray-light-v3 rounded g-py-15 g-px-15" type="text" placeholder="Email">
            </div>

            <div class="row">
              <div class="col g-mb-20">
                <input name="day" class="form-control g-color-black g-bg-white g-bg-white--focus g-brd-gray-light-v3 rounded g-py-15 g-px-15" type="text" placeholder="Day">
              </div>

              <div class="col-sm-6 col-md-12 col-lg-6 g-mb-20">
                <select name="month" class="js-custom-select u-select-v1 h-100 g-brd-gray-light-v3 g-color-gray-dark-v5 rounded g-py-12" style="width: 100%;" data-placeholder="Month" data-open-icon="fa fa-angle-down" data-close-icon="fa fa-angle-up">
                  <option>Month</option>
                  <option value="01">January</option>
                  <option value="02">February</option>
                  <option value="03">March</option>
                  <option value="04">April</option>
                  <option value="05">May</option>
                  <option value="06">June</option>
                  <option value="07">July</option>
                  <option value="08">August</option>
                  <option value="09">September</option>
                  <option value="10">October</option>
                  <option value="11">November</option>
                  <option value="12">December</option>
                </select>
              </div>

              <div class="col g-mb-20">
                <input name="year" class="form-control g-color-black g-bg-white g-bg-white--focus g-brd-gray-light-v3 rounded g-py-15 g-px-15" type="text" placeholder="Year">
              </div>
            </div>

            <div class="g-mb-20">
              <input name="hoby" class="form-control g-color-black g-bg-white g-bg-white--focus g-brd-gray-light-v3 rounded g-py-15 g-px-15" type="text" placeholder="Hoby">
            </div>

            <div class="g-mb-20">
              <input name="favorite_food" class="form-control g-color-black g-bg-white g-bg-white--focus g-brd-gray-light-v3 rounded g-py-15 g-px-15" type="text" placeholder="Favorite Food">
            </div>

            <div class="g-mb-20">
              <input name="password" class="form-control g-color-black g-bg-white g-bg-white--focus g-brd-gray-light-v3 rounded g-py-15 g-px-15" type="password" placeholder="Password">
            </div>

            <div class="mb-1">
              <label class="form-check-inline u-check g-color-gray-dark-v5 g-font-size-13 g-pl-25 mb-2">
                <input class="g-hidden-xs-up g-pos-abs g-top-0 g-left-0" type="checkbox">
                <span class="d-block u-check-icon-checkbox-v6 g-absolute-centered--y g-left-0">
                  <i class="fa" data-check-icon="&#xf00c"></i>
                </span>
                I accept the <a href="#!">&nbsp;Terms and Conditions</a>
              </label>
            </div>
            <div>
              <button class="btn btn-block u-btn-primary g-font-size-12 text-uppercase g-py-15 g-px-25" type="submit">SIGNUP</button>
            </div>
          </form>
          <!-- End Form -->
        </div>

        <div class="text-center">
          <p class="g-color-gray-dark-v5 mb-0"> Have an account Log in?
            <a class="g-font-weight-600" href="{{ url('/pages_login') }}">signin</a></p>
        </div>
      </div>
      <div class="col-lg-7 order-lg-1 g-mb-80">
      </div>
    </div>
  </section>
</body>

</html>
@endsection