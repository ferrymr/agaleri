@extends('layouts.app')

@section('style')
<style>
</style>
@endsection

@section('content')
<div id="main" class="utama_panel" role="main">
  <div id="content">
    <div class="row">
      <div class="col-xs-12 col-sm-7 col-md-7 col-lg-4">
        <h1 class="page-title txt-color-blueDark">
          <i class="fa fa-pencil-square-o fa-fw "></i>
          {{ $title }}
        </h1>
      </div>
    </div>
  <section id="widget-grid" class="">
    <div class="row">
      <article class="col-sm-12 col-md-12 col-lg-12">
        <div class="jarviswidget jarviswidget-color-orange" id="wid-id-0" data-widget-editbutton="false">
          <header>
            <span class="widget-icon"> <i class="fa fa-send"></i> </span>
            <h2>Filter {{ $title }}</h2>
          </header>
          <div>
            <div class="widget-body">
              <form id="formAdd" name="formAdd" method="post" class="form-horizontal" data-toggle="validator" enctype="multipart/form-data">
                {{ csrf_field() }} {{ method_field('POST') }}
                <fieldset>

                  <div class="form-group">
                    <label class="col-md-1 control-label">Dari Tanggal</label>
                    <div class="itemLine col-md-2">
                      <div class="input-group">
                        <input class="form-control" id="from" type="text" placeholder="Tanggal Awal" value="{{$tanggal}}">
                        <span class="input-group-addon"><i class="fa fa-calendar"></i></span>
                      </div>
                    </div>
                    <label class="col-md-1 control-label">Sampai</label>
                    <div class="itemLine col-md-2">
                      <div class="input-group">
                        <input class="form-control" id="to" type="text" placeholder="Tanggal Akhir" value="{{$tanggal}}">
                        <span class="input-group-addon"><i class="fa fa-calendar"></i></span>
                      </div>
                  </div>
                    
                  <!-- <label class="col-md-1 control-label" style="display:none;">Atau</label>
                  <div class="itemLine col-md-1" style="display:none;">
                    <select style="width:100%" id="type" name="type" class="form-control">
                      <option value="all">All</option>
                      <option value="akan_jatuh_tempo">Akan Jatuh Tempo</option>
                      <option value="jatuh_tempo">Jatuh Tempo</option>
                    </select>
                  </div> -->
                  <!-- <label class="col-md-1 control-label">Kategori</label>
                  <div class="col-md-1">
                    <select style="width:100%" id="kategori" name="kategori" class="form-control">
                      <option value="all">All</option>
                      <option value="m">Masuk</option>
                      <option value="k">Keluar</option>
                    </select>
                  </div> -->
                  <label class="col-md-1 control-label">Status</label>
                  <div class="col-md-1">
                    <select style="width:100%" id="status" name="status" class="form-control">
                      <option value="all">All</option>
                      <option value="np">Not Paid</option>
                      <option value="p0">Partial</option>
                      <option value="p1">Paid</option>
                    </select>
                  </div>
                  <!-- <label class="col-md-1 control-label">Supplier/CMT</label>
                  <div class="itemLine col-md-2">
                    <select style="width:100%" id="id_supplier" name="id_supplier" class="form-control"></select>
                    <select style="width:100%" id="id_cmt" name="id_cmt" class="form-control"></select>
                  </div> -->
                  <div class="itemLine col-md-1">
                    <button type="button" id="view" class="btn btn-success">Vew</button>
                  </div>
                </div>
              </fieldset>
            </form>
          </div>
        </div>
      </div>
    </article>
  </div>
</section>
</div>

@endsection

@section('script')
<script>
var tag   = '{{ $tag }}';

$(function () {

// Date Range Picker
  $("#from").datepicker({
      defaultDate: "+1w",
      changeMonth: true,
      numberOfMonths: 1,
      prevText: '<i class="fa fa-chevron-left"></i>',
      nextText: '<i class="fa fa-chevron-right"></i>',
      onClose: function (selectedDate) {
          $("#to").datepicker("option", "minDate", selectedDate);
      }

  });
  $("#to").datepicker({
      defaultDate: "+1w",
      changeMonth: true,
      numberOfMonths: 1,
      prevText: '<i class="fa fa-chevron-left"></i>',
      nextText: '<i class="fa fa-chevron-right"></i>',
      onClose: function (selectedDate) {
          $("#from").datepicker("option", "maxDate", selectedDate);
      }
  });

  $('#view').on('click', function (e) {
    var from = $('#from').val();
    var to = $('#to').val();
    var kategori = $('#kategori').val();
    var status = $('#status').val();
    if(from == '') from = 'all' ;
    if(to == '') to = 'all' ;

    if(from && to != ''){
      from = from.replace(/\//g,'-');
      to = to.replace(/\//g,'-');
    }
    
    window.open(baseurl+'/laporan_piutang/view/'+from+'/'+to+'/'+status+'/');
    
  });

  });
</script>
@endsection
