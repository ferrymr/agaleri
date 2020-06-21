@extends('layouts.ecommerce.app')
<!-- ecommerce member -->
@section('content')
<!-- Breadcrumbs -->

<section class="g-brd-bottom g-brd-gray-light-v4 g-py-30">
  <div class="container">
    <ul class="u-list-inline">
      <li class="list-inline-item g-mr-5">
        <a class="u-link-v5 g-color-text" href="{{ url('/')}}">Home</a>
        <i class="g-color-gray-light-v2 g-ml-5 fa fa-angle-right"></i>
      </li>
      <li class="list-inline-item g-color-primary">
        <span>Order</span>
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

    <div class="col-lg-9 g-mb-50">
      <div class="widget-body">
        <table class="table table-striped table-bordered table-hover" width="100%">
          <thead>
            <tr>
              <th data-hide="phone">Id Order</th>
              <th data-class="expand">Tanggal Order</th>
              <th data-class="expand">No. Resi</th>
              <th data-class="expand">Status</th>
              <th data-class="expand">Total Transaksi</th>
              <th data-hide="phone">Keterangan</th>
            </tr>
            @foreach($data as $d)
            @php
            $status = $d->status_order;
            if($status == 'n') $status = 'New';
            if($status == 'b') $status = 'Batal';
            if($status == 'p') $status = 'Proses';
            if($status == 's') $status = 'Selesai';
            @endphp
            <tr>
              <td>{{ $d->id }}</td>
              <td>{{ Carbon\Carbon::parse($d->tanggal_order)->format('d M Y') }}</td>
              <td>{{ $d->no_resi }}</td>
              <td>{{ $status }}</td>
              <td>{{ number_format($d->total_transaksi) }}</td>
              <td></td>
            </tr>
            @endforeach
          </thead>
          <tbody>
          </tbody>
        </table>
      </div>
    </div>
  </div>
</div>

@endsection