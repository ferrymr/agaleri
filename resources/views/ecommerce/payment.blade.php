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
        <span>Payment</span>
      </li>
      </li>
    </ul>
  </div>
</section>

<div class="container g-pb-30">
  <h2 class="g-color-black "> PAYMENT </h2>
</div>

<div class="container">
  <p class=" g-color-black"> BANK TRANSFER.</p>
</div>


<section class="container" style="padding-top:0px !important;padding-bottom:0px !important">
  <div class="row g-mx-minus-10 g-mb-50">
    <div class="col-md-2 col-lg-5 g-px-10">
      <article class="media g-brd-around g-brd-gray-light-v4 g-bg-white rounded g-pa-10 g-mb-20">
        <div class="media-body align-self-center">
          <div class="form-group">
            <label>
              BRI - 1300017710701 PT. AGAN CAHAYA LESTARI </label>
            <label>
              MANDIRI - 1300017710701 PT. AGAN CAHAYA LESTARI</label>
          </div>
        </div>
    </div>
    </article>
  </div>
  <div class="container">
    <p class=" g-color-black"> SEGERA LAKUKAN KONFIRMASI UNTUK ONGKOS KIRIM DAN LAKUKAN PEMBAYARAN KE NOMOR REKENING DIATAS.</p>
    <p class=" g-color-black"> BATAS PEMBAYARAN TRANSFER KAMI TUNGGU MAKSIMAL 24 JAM.</p>
    <p class=" g-color-black"> SETELAH ANDA MELAKUKAN PEMBAYARAN, HARAP KONFIRMASI KEPADA KAMI DI NO WA CS 1 081312453661 </p>
    <!-- <a href="{{ url('/')}}" class=" btn btn-info btn-sm col-lg-1" onclick="return confirm('APAKAH ANDA AKAN MELAKUKAN PEMBAYARAN?');">SUBMIT</a> -->
  </div>

  </div>

  </div>
  <a class="btn u-btn-primary g-font-size-13 text-uppercase g-px-40 g-py-15" href="{{ url('/shop') }}" data-next-step="#step3" aria-invalid="false">Belanja lagi</a>
  <br><br>
</section>







@endsection