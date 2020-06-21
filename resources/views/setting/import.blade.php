@extends('layouts.app')

@section('style')
<style>

</style>
@endsection

@section('content')
<div id="content">
  <div class="row">
    <div class="col-xs-12 col-sm-7 col-md-7 col-lg-4">
      <h1 class="page-title txt-color-blueDark">
        <i class="fa fa-pencil-square-o fa-fw "></i>
        {{ $title }}
      </h1>
    </div>
  </div>
@if( Request::path() == 'import')
  <section id="widget-grid" class="">
    <div class="row">
      <article class="col-sm-12 col-md-12 col-lg-12">
        <div class="jarviswidget" id="wid-id-0" data-widget-colorbutton="false" data-widget-editbutton="false">
          <header>
            <span class="widget-icon"> <i class="fa fa-send"></i> </span>
            <h2>{{ $title }} General</h2>
          </header>
          <div>
            <div class="widget-body">
              <form id="formAdd" method="post" class="form-horizontal" data-toggle="validator" enctype="multipart/form-data" action="{{ route('import.general') }}">
                {{ csrf_field() }} {{ method_field('POST') }}
                <fieldset>
                  <div class="form-group">
                    <label for="file" class="col-md-1">Upload Excel</label>
                    <input type="file" class="col-md-3" name="file" value="">
                    <label for="model" class="col-md-1">To Master</label>
                    <select class="col-md-2" name="model">
                      <option value="BahanBaku">Bahan Baku</option>
                      <option value="Warna">Warna</option>
                      <option value="Brand">Brand</option>
                      <option value="BarangJadi">Barang Jadi</option>
                      <option value="Acc">Accessories</option>
                      <!-- <option value="Costumer">Costumer</option>
                      <option value="Supplier">Supplier</option>
                      <option value="Cmt">CMT</option> -->
                    </select>
                    <input type="hidden" name="code" value="BB">
                  </div>
                </fieldset>
                <div class="form-actions">
                  <div class="row">
                    <div class="col-md-12">
                      <button id="btnAdd" type="submit" class="btn btn-primary">
                        <i class="fa fa-save"></i>
                        Import
                      </button>
                    </div>
                  </div>
                </div>
              </form>
            </div>
          </div>
        </div>
      </article>
    </div>
  </section>
  @elseif( Request::path() == 'import_stock')
  <section id="widget-grid" class="">
    <div class="row">
      <article class="col-sm-12 col-md-12 col-lg-12">
        <div class="jarviswidget" id="wid-id-0" data-widget-colorbutton="false" data-widget-editbutton="false">
          <header>
            <span class="widget-icon"> <i class="fa fa-send"></i> </span>
            <h2>{{ $title }} Stock</h2>
          </header>
          <div>
            <div class="widget-body">
              <form id="formAdd" method="post" class="form-horizontal" data-toggle="validator" enctype="multipart/form-data" action="{{ route('import.general') }}">
                {{ csrf_field() }} {{ method_field('POST') }}
                <fieldset>
                  <div class="form-group">
                    <label for="file" class="col-md-1">Upload Excel</label>
                    <input type="file" class="col-md-3" name="file" value="">
                    <label for="model" class="col-md-1">To Master</label>
                    <select class="col-md-2" name="model">
                      <option value="MasterBB">Bahan Baku</option>
                      <option value="MasterAcc">Accessoris</option>
                      <option value="MasterBJ">Barang Jadi</option>
                    </select>
                    <input type="hidden" name="code" value="stock">
                  </div>
                </fieldset>
                <div class="form-actions">
                  <div class="row">
                    <div class="col-md-12">
                      <button id="btnAdd" type="submit" class="btn btn-primary">
                        <i class="fa fa-save"></i>
                        Import
                      </button>
                    </div>
                  </div>
                </div>
              </form>
            </div>
          </div>
        </div>
      </article>
    </div>
  </section>
  @elseif( Request::path() == 'import_akun')
  <section id="widget-grid" class="">
    <div class="row">
      <article class="col-sm-12 col-md-12 col-lg-12">
        <div class="jarviswidget" id="wid-id-0" data-widget-colorbutton="false" data-widget-editbutton="false">
          <header>
            <span class="widget-icon"> <i class="fa fa-send"></i> </span>
            <h2>{{ $title }} Akun</h2>
          </header>
          <div>
            <div class="widget-body">
              <form id="formAdd" method="post" class="form-horizontal" data-toggle="validator" enctype="multipart/form-data" action="{{ route('import.general') }}">
                {{ csrf_field() }} {{ method_field('POST') }}
                <fieldset>
                  <div class="form-group">
                    <label for="file" class="col-md-1">Upload Excel</label>
                    <input type="file" class="col-md-3" name="file" value="">
                    <label for="model" class="col-md-1">To Master</label>
                    <select class="col-md-2" name="model">
                      <option value="General">Akun General</option>
                      <option value="Costumer">Akun Customer</option>
                      <option value="Supplier">Akun Supplier</option>
                      <option value="Cmt">Akun CMT</option>
                    </select>
                    <input type="hidden" name="code" value="akun">
                  </div>
                </fieldset>
                <div class="form-actions">
                  <div class="row">
                    <div class="col-md-12">
                      <button id="btnAdd" type="submit" class="btn btn-primary">
                        <i class="fa fa-save"></i>
                        Import
                      </button>
                    </div>
                  </div>
                </div>
              </form>
            </div>
          </div>
        </div>
      </article>
    </div>
  </section>
  @endif
</div>

@endsection

@section('script')
<script>
$(function () {
  $('[name=model]').on('change', function() {
    var model = $(this).val();
    if (model == 'BahanBaku') {
      code = 'BB';
      $('[name=code]').val(code);
    } else if (model == 'Warna') {
      code = 'W';
      $('[name=code]').val(code);
    } else if (model == 'Brand') {
      code = 'B';
      $('[name=code]').val(code);
    } else if (model == 'BarangJadi') {
      code = 'BJ';
      $('[name=code]').val(code);
    } else if (model == 'Acc') {
      code = 'AC';
      $('[name=code]').val(code);
    } 
    // else if (model == 'Costumer') {
    //   code = 'akun';
    // } else if (model == 'Supplier') {
    //   code = 'akun';
    // } else if (model == 'Cmt') {
    //   code = 'akun';
    // } else if (model == 'General') {
    //   code = 'akun';
    // }
    console.log($('[name=code]').val());
  });
});
</script>
@endsection
