<!DOCTYPE html>
<html lang="{{ app()->getLocale() }}" class="smart-style-3">
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <!-- CSRF Token -->
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>{{ config('app.name', 'eManufacture') }} - @yield('title')</title>

    <!-- Styles -->
    <link href="{{ asset('css/app.css') }}" rel="stylesheet">


    <!-- Basic Styles -->
    <link rel="stylesheet" type="text/css" media="screen" href="{{ asset('template/css/bootstrap.min.css') }}">
    <link rel="stylesheet" type="text/css" media="screen" href="{{  asset('template/css/font-awesome.min.css') }}">

    <!-- SmartAdmin Styles : Caution! DO NOT change the order -->
		<link rel="stylesheet" type="text/css" media="screen" href="{{ asset('template/css/smartadmin-production-plugins.min.css') }}">
		<link rel="stylesheet" type="text/css" media="screen" href="{{ asset('template/css/smartadmin-production.min.css') }}">
		<link rel="stylesheet" type="text/css" media="screen" href="{{ asset('template/css/smartadmin-skins.min.css') }}">

    <link rel="stylesheet" href="{{ asset('template/css/extended.css') }}">

    <!-- SmartAdmin RTL Support -->
		<link rel="stylesheet" type="text/css" media="screen" href="{{ asset('template/css/smartadmin-rtl.min.css') }}">

    <!-- Demo purpose only: goes with demo.js, you can delete this css when designing your own WebApp -->
		<!-- <link rel="stylesheet" type="text/css" media="screen" href="{{ asset('template/css/demo.min.css') }}"> -->

		<!-- FAVICONS -->
		<link rel="shortcut icon" href="{{ asset('template/img/favicon/favicon.ico') }}" type="image/x-icon">
		<link rel="icon" href="{{ asset('template/img/favicon/favicon.ico') }}" type="image/x-icon">

		<!-- GOOGLE FONT -->
		<link rel="stylesheet" href="{{ asset('template/fonts/google/font.css') }}">

		<!-- Specifying a Webpage Icon for Web Clip
			 Ref: https://developer.apple.com/library/ios/documentation/AppleApplications/Reference/SafariWebContent/ConfiguringWebApplications/ConfiguringWebApplications.html -->
		<link rel="apple-touch-icon" href="{{ asset('template/img/splash/sptouch-icon-iphone.png') }}">
		<link rel="apple-touch-icon" sizes="76x76" href="{{ asset('template/img/splash/touch-icon-ipad.png') }}">
		<link rel="apple-touch-icon" sizes="120x120" href="img/splash/touch-icon-iphone-retina.png') }}">
		<link rel="apple-touch-icon" sizes="152x152" href="img/splash/touch-icon-ipad-retina.png') }}">


</head>
<body class="desktop-detected menu-on-top fixed-header smart-style-3 pace-done">
    <div id="app">
      <!-- HEADER -->
      <header id="header">
        <div id="logo-group">

          <!-- PLACE YOUR LOGO HERE -->
          <span id="logo"> <a href="{{ url('/') }}"><img src="{{ asset('template/img/logo-white.png') }}" alt=""></a> </span>
          @guest
          @else
          <!-- <span id="activity" class="activity-dropdown"> <i class="fa fa-bell"></i> <b class="badge bg-color-red bounceIn animated"> 2 </b> </span> -->
          <div class="ajax-dropdown" style="display: none;">

					<!-- the ID links are fetched via AJAX to the ajax container "ajax-notifications" -->
					<div class="btn-group btn-group-justified" data-toggle="buttons">
            <label class="btn btn-default active">
              <input type="radio" name="activity" id="ajax/notify/notifications.html">
              Notify (2) </label>
						<label class="btn btn-default">
							<input type="radio" name="activity" id="ajax/notify/mail.html">
							Msgs (0) </label>
						<label class="btn btn-default">
							<input type="radio" name="activity" id="ajax/notify/tasks.html">
							Tasks (0) </label>
					</div>

					<!-- notification content -->
					<div class="ajax-notifications custom-scroll" style="opacity: 1;"><ul class="notification-body">
            <li>
              <span class="padding-10">
                <em class="badge padding-5 no-border-radius bg-color-orange pull-left margin-right-5">
                  <i class="fa fa-calendar fa-fw fa-2x"></i>
                </em>                
                <span>
                  Hutang yang akan jatuh tempo dalam 7 hari - <a href="{{ url('/laporan_hutang/view/all/all/akan_jatuh_tempo/all/') }}" target="_blank" class="display-normal">Buka</a>
                  <br>
                  <span class="pull-right font-xs text-muted"><i>1 day ago...</i></span>
                </span>                
              </span>
            </li>
            <li>
              <span class="padding-10">
                <em class="badge padding-5 no-border-radius bg-color-red pull-left margin-right-5">
                  <i class="fa fa-calendar fa-fw fa-2x"></i>
                </em>                
                <span>
                  Hutang sudah jatuh tempo - <a href="{{ url('/laporan_hutang/view/all/all/jatuh_tempo/all/') }}" target="_blank" class="display-normal">Buka</a>
                  <br>
                  <span class="pull-right font-xs text-muted"><i>1 day ago...</i></span>
                </span>                
              </span>
            </li>
          </ul>
        </div>
					<!-- end notification content -->

					<!-- footer: refresh area -->
					<span> Last updated on: 12/12/2013 9:43AM
						<button type="button" data-loading-text="<i class='fa fa-refresh fa-spin'></i> Loading..." class="btn btn-xs btn-default pull-right">
							<i class="fa fa-refresh"></i>
						</button> </span>
					<!-- end footer -->

				</div> 
          @endguest
          <!-- END LOGO PLACEHOLDER -->
          
        </div>

        <!-- pulled right: nav area -->
        <div class="pull-right">

          <!-- collapse menu button -->
          <div id="hide-menu" class="btn-header pull-right">
            <span> <a href="javascript:void(0);" data-action="toggleMenu" title="Collapse Menu"><i class="fa fa-reorder"></i></a> </span>
          </div>
          <!-- end collapse menu -->

          <!-- #MOBILE -->
          <!-- Top menu profile link : this shows only when top menu is active -->
          @guest
          @else
          <ul id="mobile-profile-img" class="header-dropdown-list hidden-xs padding-5">
            <li class="">
              <a href="#" class="dropdown-toggle no-margin userdropdown" data-toggle="dropdown">
                <img src="{{ asset('template/img/avatars/4.png') }}" alt="Cecep Abu Fatih" class="online" />
              </a>
              <ul class="dropdown-menu pull-right">
                <li>
                  <a href="{{ url('/') }}" class="padding-10 padding-top-0 padding-bottom-0" ><i class="fa fa-home"></i> Back Home</a>
                </li>
                <li>
                  <a href="{{ url('/profile') }}" class="padding-10 padding-top-0 padding-bottom-0" ><i class="fa fa-user"></i> Profile</a>
                </li>
                <!-- <li>
                  <a href="javascript:void(0);" class="padding-10 padding-top-0 padding-bottom-0" data-action="launchFullscreen"><i class="fa fa-arrows-alt"></i> Full <u>S</u>creen</a>
                </li> -->
                <li>
                  <a href="{{ route('logout')}}" onclick="event.preventDefault();
                           document.getElementById('logout-form').submit();" class="padding-10 padding-top-5 padding-bottom-5" data-action="userLogout"><i class="fa fa-sign-out fa-lg"></i> <strong><u>L</u>ogout</strong></a>
                </li>
              </ul>
            </li>
          </ul>
          @endguest

          <!-- logout button -->
          @guest
          <div id="login" class="btn-header transparent pull-right">
            <span> <a href="{{ route('login') }}" title="Masuk" ><i class="fa fa-sign-in"></i></a> </span>
          </div>
          <!-- <div id="register" class="btn-header transparent pull-right">
            <span> <a href="{{ route('register') }}" title="Daftar" ><i class="fa fa-plus"></i></a> </span>
          </div> -->
          @else
          <div id="logout" class="btn-header transparent pull-right">
            <span> <a href="{{ route('logout') }}" title="Keluar" onclick="event.preventDefault();
                     document.getElementById('logout-form').submit();"><i class="fa fa-sign-out"></i></a> </span>
            <form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none;">
                {{ csrf_field() }}
            </form>
          </div>
            @endguest
          <!-- end logout button -->


        </div>
        <!-- end pulled right: nav area -->

        <!-- <script src="{{ asset('template/fonts/google/jquery_3.2.1_jquery.min.js') }}"></script> -->
      </header></br>
      <!-- END HEADER -->


          