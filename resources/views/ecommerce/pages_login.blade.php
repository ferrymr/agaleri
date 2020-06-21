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
  <title>Laravel</title>

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

<body class="g-bk-login">
  <section class="container g-pt-100 g-pb-20">
        <div class="row justify-content-between">
          <div class="col-md-6 col-lg-5 order-lg-2 g-mb-80">
            <div class="g-brd-around g-brd-gray-light-v3 g-bg-white rounded g-px-30 g-py-50 mb-4 ">
              <header class="text-center mb-4"> 
                <h1 class="h4 g-color-black g-font-weight-400">Login to Your Account</h1>
              </header>

              <!-- Form -->
              <form method="post" action="{{ route('login') }}" class="g-py-15">
              {{ csrf_field() }}
                <div class="mb-4">
                  <div class="input-group g-rounded-left-3">
                    <span class="input-group-prepend g-width-45">
                      <span class="input-group-text justify-content-center w-100 g-bg-transparent g-brd-gray-light-v3 g-color-gray-dark-v5">
                        <i class="icon-finance-067 u-line-icon-pro"></i>
                      </span>
                    </span>
                    <input class="form-control g-color-black g-bg-white g-bg-white--focus g-brd-gray-light-v3 g-rounded-left-0 g-rounded-right-3 g-py-15 g-px-15" name="email" type="email" placeholder="Email Adress">
                  </div>
                </div>

                <div class="mb-4">
                  <div class="input-group g-rounded-left-3 mb-4">
                    <span class="input-group-prepend g-width-45">
                      <span class="input-group-text justify-content-center w-100 g-bg-transparent g-brd-gray-light-v3 g-color-gray-dark-v5">
                        <i class="icon-media-094 u-line-icon-pro"></i>
                      </span>
                    </span>
                    <input class="form-control g-color-black g-bg-white g-bg-white--focus g-brd-gray-light-v3 g-rounded-left-0 g-rounded-right-3 g-py-15 g-px-15" name="password" type="password" placeholder="Password">
                  </div>
                </div>

                <div class="row justify-content-between mb-5">
                  <div class="col align-self-center">
                    <label class="form-check-inline u-check g-color-gray-dark-v5 g-font-size-13 g-pl-25 mb-0">
                    </label>
                  </div>
                  <div class="col align-self-center text-right ">
                  <a class="g-font-size-13" href="{{ url('/password_recovery') }}">Forgot password?</a>
                  </div>
                </div>
                <button class="btn btn-block u-btn-primary g-font-size-12 text-uppercase g-py-12 g-px-25" type="submit">LOGIN</button>
              </form>
              <!-- End Form -->
            </div>
            <div class="text-center g-color-dark-v5">
              <p class="g-color-dark-v5 mb-0">Don't have an account?
                <a class="g-color-dark-v5 mb-0" href="{{ url('/pages_signup') }}">signup</a></p>
            </div>
          </div>
          <div class="col-lg-7 order col-lg-1 g-mb-80"> 
          </div>
        </div>
  </section>
</body>
</html>
@endsection

