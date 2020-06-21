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
        <span>Shipping</span>
      </li>
      </li>
    </ul>
  </div>
</section>

<div class="container">
  <h2 class="g-color-black "> SHIPPING </h2>
</div>
<form method="post" action="/shipping" enctype="multipart/form-data">
  {{ csrf_field() }}
  <input type="hidden" name="subtotal" value="{{ $sub_total }}">
  <input type="hidden" name="potongan" value="{{ $potongan }}">
  <div class="container">
    <div class="row">
      <div class="col-md-8 g-mb-30">
        <div class="row">
          <div class="col-sm-6 g-mb-20">
            <label class="d-block g-color-gray-dark-v2 g-font-size-13">Nama</label>
            <input name="name" value="{{ $data[0]->name }}" class="form-control u-form-control g-placeholder-gray-light-v1 rounded-0 g-py-15" type="text" placeholder="email@email.com">
          </div>
          <div class="col-sm-6 g-mb-20">
            <label class="d-block g-color-gray-dark-v2 g-font-size-13">Email Address</label>
            <input name="email" value="{{ $data[0]->email }}" class="form-control u-form-control g-placeholder-gray-light-v1 rounded-0 g-py-15" type="email" placeholder="email@email.com">
          </div>
        </div>

        <div class="row">
          <div class="col-sm-12 g-mb-20">
            <div class="form-group">
              <label class="d-block g-color-gray-dark-v2 g-font-size-13">Alamat</label>
              <input name="alamat" value="{{ $data[0]->alamat }}" class="form-control u-form-control g-placeholder-gray-light-v1 rounded-0 g-py-15" type="text" placeholder="Bandung">
            </div>
          </div>
        </div>

        <div class="row">
          <div class="col-sm-6 g-mb-20">
            <div class="form-group">
              <label class="d-block g-color-gray-dark-v2 g-font-size-13">Kota/ Kabupaten</label>
              <input name="kota" value="{{ $data[0]->kota }}" class="form-control u-form-control g-placeholder-gray-light-v1 rounded-0 g-py-15" type="text" placeholder="Bandung">
            </div>
          </div>
          <div class="col-sm-6 g-mb-20">
            <label class="d-block g-color-gray-dark-v2 g-font-size-13">Kode Pos</label>
            <input name="kode_pos" value="{{ $data[0]->kode_pos }}" class="form-control u-form-control g-placeholder-gray-light-v1 rounded-0 g-py-15" type="text" placeholder="40215">
          </div>
        </div>

        <div class="row">
          <div class="col-sm-6 g-mb-20">
            <label class="d-block g-color-gray-dark-v2 g-font-size-13">No Handphone</label>
            <input name="no_hp" value="{{ $data[0]->no_hp }}" class="form-control u-form-control g-placeholder-gray-light-v1 rounded-0 g-py-15" type="text" placeholder="08211111000">
          </div>
          <div class="col-sm-6 g-mb-20">
            <label class="d-block g-color-gray-dark-v2 g-font-size-13">Catatan</label>
            <input name="catatan" value="" class="form-control u-form-control g-placeholder-gray-light-v1 rounded-0 g-py-15" type="text" placeholder="Dititip tetangga">
          </div>
        </div>

        <hr class="g-mb-50">

        <!-- End Shipping Mehtod -->

        <button class="btn u-btn-primary g-font-size-13 text-uppercase g-px-40 g-py-15" type="submit" data-next-step="#step3" aria-invalid="false">Proceed to Payment</button>
      </div>
</form>
<div class="col-md-4 g-mb-30">
  <!-- Order Summary -->
  <div class="g-bg-gray-light-v5 g-pa-20 g-pb-50 mb-4">
    <h4 class="h6 text-uppercase mb-3">Order summary</h4>

    <!-- Accordion -->
    <div id="accordion-03" class="mb-4" role="tablist" aria-multiselectable="true">
      <div id="accordion-03-heading-03" class="g-brd-y g-brd-gray-light-v2 py-3" role="tab">
        <h5 class="g-font-weight-400 g-font-size-default mb-0">
          <a class="g-color-gray-dark-v4 g-text-underline--none--hover" href="#accordion-03-body-03" data-toggle="collapse" data-parent="#accordion-03" aria-expanded="false" aria-controls="accordion-03-body-03">{{ $count_order }} items in cart
            <span class="ml-3 fa fa-angle-down"></span></a>
        </h5>
      </div>
      <div id="accordion-03-body-03" class="collapse" role="tabpanel" aria-labelledby="accordion-03-heading-03">
        <div class="g-py-15">
          <ul class="list-unstyled mb-3">
            @foreach($cart as $c)
            <!-- Product -->
            <li class="d-flex justify-content-start">
              <img class="g-width-100 g-height-100 mr-3" src="{{ asset($c->photo) }}" alt="Image Description">
              <div class="d-block">
                <h4 class="h6 g-color-black">{{ $c->name }}</h4>
                <ul class="list-unstyled g-color-gray-dark-v4 g-font-size-12 g-line-height-1_4 mb-1">
                  <li>Size: {{ $c->size_id }}</li>
                  <li>QTY: {{ $c->qty }}</li>
                </ul>
                <span class="d-block g-color-black g-font-weight-400">IDR {{ number_format($c->harga) }}</span>
              </div>
            </li>
            <!-- End Product -->
            @endforeach
          </ul>
        </div>
      </div>
    </div>
    <!-- End Accordion -->

    <div class="d-flex justify-content-between mb-2">
      <span class="g-color-black">Potongan</span>
      <span class="g-color-black g-font-weight-300">IDR {{ number_format($potongan) }}</span>
    </div>
    <div class="d-flex justify-content-between mb-2">
      <span class="g-color-black">Subtotal</span>
      <span class="g-color-black g-font-weight-300">IDR {{ number_format($sub_total) }}</span>
    </div>
    <div class="d-flex justify-content-between mb-2">
      <span class="g-color-black">Pengiriman</span>
      <span class="g-color-black g-font-weight-300">Hubungi admin</span>
    </div>
    <div class="d-flex justify-content-between">
      <span class="g-color-black">Order Total</span>
      <span class="g-color-black g-font-weight-300">IDR {{ number_format($sub_total) }}</span>
    </div>
  </div>
  <!-- End Order Summary -->
</div>
</div>

</div>

</div>
@endsection