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
        <span>Cart</span>
      </li>
      </li>
    </ul>
  </div>
</section>

<div class="container g-brd-bottom g-brd-gray-light-v4 g-py-30">
  <h2 class="g-color-black "> YOUR CART </h2>
</div>

<div class="container g-pt-20 g-pb-20">
  <form method="post" action="/cart/process" enctype="multipart/form-data">
    {{ csrf_field() }}
    <div id="stepFormSteps">
      <div class="row">
        <div class="col-md-8 g-mb-30">
          <!-- Products Block -->
          <div class="g-overflow-x-scroll g-overflow-x-visible--lg">
            <table class="text-center w-100">
              <thead class="h6 g-brd-bottom g-brd-gray-light-v3 g-color-black text-uppercase">
                <!-- <hr class="g-mb-50"> -->
                <tr>
                  <th class="g-font-weight-400 text-left g-pb-20">Product</th>
                  <th class="g-font-weight-400 g-width-130 g-pb-20">Price</th>
                  <th class="g-font-weight-400 g-width-50 g-pb-20">Qty</th>
                  <th class="g-font-weight-400 g-width-130 g-pb-20">Total</th>
                  <th></th>
                </tr>
              </thead>
          </div>
          <tbody>
            <!-- Item-->
            @foreach($cart as $c)
            <input type="hidden" name="id[]" value="{{ $c->id }}">
            <input type="hidden" name="barang_id[]" value="{{ $c->barang_id }}">
            <input type="hidden" name="size_id[]" value="{{$c->size_id}}">
            <input type="hidden" name="harga[]" value="{{ $c->harga }}">
            <input type="hidden" id="qty_{{ $c->id }}_{{ $c->barang_id }}_{{$c->size_id}}" name="qty[]" value="{{ $c->qty }}">
            <form method="post" action="/cart/remove/{{ $c->id }}/{{ $c->barang_id }}/{{$c->size_id}}" enctype="multipart/form-data">
              {{ csrf_field() }}
              <tr class="g-brd-bottom g-brd-gray-light-v3">
                <td class="text-left g-py-25">
                  <img class="d-inline-block g-width-100 mr-4" src="{{ asset($c->photo) }}" alt="Image Description">
                  <div class="d-inline-block align-middle">
                    <h4 class="h6 g-color-black">{{ $c->name }}</h4>
                    <ul class="list-unstyled g-color-gray-dark-v4 g-font-size-12 g-line-height-1_6 mb-0">
                      <li>Size: {{ $c->size_id }}</li>
                      <button class="btn btn-info btn-xs" name="btn_submit_cart" value="remove" type="submit">Remove</button>
                    </ul>
                  </div>
                </td>
                <td class="g-color-gray-dark-v2 g-font-size-13"> {{ ($c->potongan>0) ? 'IDR '.number_format($c->harga_total/$c->qty) : 'IDR'.number_format($c->harga)  }} <br>
                  <s class="g-color-gray-dark-v4 g-font-weight-500 g-font-size-16">{{ ($c->potongan>0) ? 'IDR '.number_format($c->harga) : '' }}</s></td>
                <td>
                  <div class="js-quantity input-group u-quantity-v1 g-width-80 g-brd-primary--focus">
                    <input class="js-result form-control text-center g-font-size-13 rounded-0 g-pa-0" name="qty_awal[]" type="number" value="{{ $c->qty }}" param_id="{{ $c->id }}" param_barang_id="{{ $c->barang_id }}" param_size_id="{{ $c->size_id }}">
                  </div>
                </td>
                <td class="text-right g-color-black">
                  <span class="g-color-gray-dark-v2 g-font-size-13 mr-4">IDR {{ number_format($c->harga_total) }}</span>
                  <span class="g-color-gray-dark-v4 g-color-black--hover g-cursor-pointer">
                  </span>
                </td>
              </tr>
            </form>
            @endforeach

          </tbody>
          </table>
          <hr class="g-mb-30">
          <div class="text-right">
            <span class="g-color-black">Subtotal</span>
            <span class="g-color-black ">IDR {{ number_format($sub_total) }}</span>
          </div>
          <div class="text-right g-py-50">
            <a class="btn btn-info btn-sm" href="{{ url('/shop')}}">COUNTINUE SHOPPING</a>
            <button class="btn btn-warning btn-sm" name="btn_submit_cart" value="update" type="submit">UPDATE</button>
            <button class="btn btn-danger btn-sm" name="btn_submit_cart" value="checkout" type="submit">CHECK OUT</button>
          </div>
  </form>
</div>
</div>
</div>
</div>
</div>
</div>
@endsection

@section('script')
<script>
  $('[name="qty_awal[]"').on('change', function() {
    val = $(this).val();
    id = $(this).attr('param_id');
    barang_id = $(this).attr('param_barang_id');
    size_id = $(this).attr('param_size_id');
    $('#qty_' + id + '_' + barang_id + '_' + size_id).val(val);
    console.log(id, barang_id, size_id);
  });
</script>
@endsection