@extends('layouts.ecommerce.app')

@section('content')
<!-- Promo Block -->
<section class="dzsparallaxer auto-init height-is-based-on-content use-loading mode-scroll loaded dzsprx-readyall" data-options='{direction: "fromtop", animation_duration: 25, direction: "reverse"}'>
  <div class="divimage dzsparallaxer--target w-100 g-bg-pos-top-center g-bg-cover g-bg-black-opacity-0_1--after" style="height: 100%; background-image: url({{ asset($data[0]->featured_image) }});"></div>

  <div class="container g-color-white g-pt-100 g-pb-40">
    <div class="g-mb-50" style="margin-top:450px;">
    </div>
  </div>
</section>
<!-- End Promo Block -->
<section class="g-bg-secondary">
  <div class="container g-pt-100 g-pb-40">
    <div class="row justify-content-center g-mb-60">
      <div class="col-lg-7">
        <!-- Heading -->
        <div class="text-left">
          <h2 class="h3 g-color-black text-uppercase mb-2">{{ $data[0]->title }}</h2>
          <div class="d-inline-block g-width-75 g-height-4 g-bg-primary mb-4"></div>
          <p class="lead mb-5">
            {!! $data[0]->content !!}</p>
        </div>
        <!-- End Heading -->
      </div>
    </div>

  </div>
  <!-- End Static Process -->
  </div>
</section>
@endsection

@section('script')
<script>

</script>
@endsection