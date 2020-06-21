@extends('layouts.ecommerce.app')

@section('content')

<section class="g-brd-bottom g-brd-gray-light-v4 g-py-30">
  <div class="container">
    <ul class="u-list-inline">
      <li class="list-inline-item g-mr-5">
        <a class="u-link-v5 g-color-text" href="{{ url('/')}}">Home</a>
        <i class="g-color-gray-light-v2 g-ml-5 fa fa-angle-right"></i>
      </li>
      <li class="list-inline-item g-color-primary">
        <span>Forgot Password</span>
      </li>
      </li>
    </ul>
  </div>
</section>

<div class="container g-pt-10 g-pb-30">
  <div class="row">
    <div class="col-lg-3 g-mb-50">
      <h1 class="h4 g-color-black ">MY ACCOUNT</h1>
      <div class="row">
        <div class="col-sm-1">
          <ul class="list-unstyled mb-0">
            <li class="">
              <a class="d-block align-middle u-link-v5 g-color-text g-color-primary--hover g-bg-gray-light-v5--hover rounded g-pa-3" href="{{ url('/order')}}">
                <span class="mr-0 g-color-black"></span>
                ORDER
              </a>
            </li>
            <li class="g-py-3">
              <a class="d-block align-middle u-link-v5 g-color-text g-color-primary--hover g-bg-gray-light-v5--hover rounded g-pa-3" href="{{ url('/account')}}">
                <span class="mr-0 g-color-black"></span>
                PROFILE
              </a>
            </li>
            <li class="g-py-3">
              <a class="d-block align-middle u-link-v5 g-color-text g-color-primary--hover g-bg-gray-light-v5--hover rounded g-pa-3" href="{{ url('/password_recovery')}}">
                <span class="mr-0 g-color-black"></span>
                PASSWORD
              </a>
            </li>
            <li class="g-py-3">
              <a class="d-block align-middle u-link-v5 g-color-text g-color-primary--hover g-bg-gray-light-v5--hover rounded g-pa-3 " href="{ route('logout')}}" onclick="event.preventDefault();
                document.getElementById('logout-form').submit();">
                <span class="mr-0 g-color-black"></span>
                LOGOUT
              </a>
              <form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none;">
                {{ csrf_field() }}
              </form>
            </li>
          </ul>
          <!-- Profile Picture -->
          <div class="text-center g-pos-rel g-mb-30">
            <div class="g-width-100 g-height-100 mx-auto mb-3">
              </li>
              </ul>
            </div>
          </div>
        </div>
      </div>
    </div>
    <!-- Login -->
    <div class="col-lg-9 g-mb-20">
      <section class="container g-py-20">
        <!-- <div class="row justify-content-center"> -->
        <div class="col-lg-5 g-mb-50">
          <!-- Balance & Rewards -->
          <form method="post" action="{{ route('password.update') }}" class="g-py-15">
            {{ csrf_field() }}
            <!-- <div class="row"> -->
            <div class="g-mb-20">
              <input name="password" class="form-control g-color-black g-bg-white g-bg-white--focus g-brd-gray-light-v3 rounded g-py-15 g-px-15" type="password" placeholder="Password">
            </div>

            <button class="btn btn-block u-btn-primary g-font-size-12 text-uppercase g-py-12 g-px-25" type="submit">UPDATE</button>
          </form>

        </div>
    </div>
    </section>
    <!-- End Login -->
  </div>
</div>
</div>

@endsection