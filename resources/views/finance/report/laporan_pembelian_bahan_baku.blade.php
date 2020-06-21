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
                        <input class="form-control" id="from" type="text" placeholder="Tanggal Awal">
                        <span class="input-group-addon"><i class="fa fa-calendar"></i></span>
                      </div>
                    </div>
                    <label class="col-md-1 control-label">Sampai</label>
                    <div class="itemLine col-md-2">
                      <div class="input-group">
                        <input class="form-control" id="to" type="text" placeholder="Tanggal Akhir">
                        <span class="input-group-addon"><i class="fa fa-calendar"></i></span>
                      </div>
                  </div>
                    
                  <label class="col-md-1 control-label">Berdasarkan</label>
                  <div class="itemLine col-md-2">
                    <select style="width:100%" id="id" name="id" class="form-control" required=""></select>
                  </div>
                  <div class="itemLine col-md-1">
                    <button type="button" id="view" class="btn btn-success">Vew</button>
                  </div>
                  {{-- <div class="itemLine col-md-1">
                    <button type="button" id="export" class="btn btn-success">Export</button>
                  </div> --}}
                </div>
                <div style="display:none">
                  <label class="col-md-1 control-label">Bulan</label>
                    <div class="itemLine col-md-2">
                      <select style="width:100%" id="bulan" name="bulan" class="form-control" required="">
                        @foreach($bulan as $i => $b)
                        <option value="{{ $i }}">{{ $b }}</option>
                        @endforeach
                      </select>
                    </div>
                    <label class="col-md-1 control-label">Tahun</label>
                    <div class="itemLine col-md-2">
                      <select style="width:100%" id="tahun" name="tahun" class="form-control" required="">
                        @foreach($tahun as $i => $t)
                        <option value="{{ $i }}">{{ $t }}</option>
                        @endforeach
                      </select>
                    </select>
                  </div>
                </div>
              </fieldset>
            </form>
          </div>
        </div>
      </div>
    </article>
  </div>
  {{-- <div class="row" style="margin-bottom:30px;">
    <article class="col-sm-12 col-md-12 col-lg-12">
      <span><strong>Id Akun</strong> : <span id="id_akun_info">Belum memilih akun </span></span><span>&nbsp;<strong>Saldo</strong> : Rp. <span id="saldo">0,00</span></span>
    </article>
  </div>
  <div class="row">
    <article class="col-sm-12 col-md-12 col-lg-12">
      <div class="jarviswidget jarviswidget-color-orange" id="wid-id-3" data-widget-editbutton="false">
        <header>
          <span class="widget-icon"> <i class="fa fa-table"></i> </span>
          <h2>List Data {{ $title }}</h2>
        </header>
        <div>
          <div class="widget-body">
            <table id="{{$tag}}-table" class="table table-striped table-bordered table-hover" width="100%">
              <thead>
                <tr>
                  <th>ID</th>
                  <th>Tanggal</th>
                  <th>Deskripsi</th>
                  <th>Kode Ref</th>
                  <th>Debit</th>
                  <th>Kredit</th>
                  <th>Saldo</th>
                </tr>
              </thead>
              <tbody>
              </tbody>
            </table>
          </div>
        </div>
      </div>
    </article>
  </div> --}}
</section>
</div>

@endsection

@section('script')
<script>
var kategori   = '{{ $kategori }}';
var tag   = '{{ $tag }}';
var datenow = '{{ $tanggal }}';

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


  if(kategori == 'supplier'){
    $('[name="id"]').select2({
      ajax: {
        url: baseurl+'/get_supplier',
        delay:250,
        data: function (params) {
          var query = {
            search: params.term,
            type: 'public'
          }
          return query;
        },
        processResults: function (data) {
          return {
            results: data
          };
        },
      }
    });
  } else if (kategori == 'jenis') {
    $('[name="id"]').select2({
      ajax: {
        url: baseurl+'/get_bb',
        delay:250,
        data: function (params) {
          var query = {
            search: params.term,
            type: 'public'
          }
          return query;
        },
        processResults: function (data) {
          return {
            results: data
          };
        },
      }
    });  
  } 

  $('#view').on('click', function (e) {
    var from = $('#from').val();
    var to = $('#to').val();
    var id = $('#id').val();
    if(from && to && id !== '' || from && to && id !== null){
      from = from.replace(/\//g,'-');
      to = to.replace(/\//g,'-');
      // console.log(from+ ' ' +to+' '+id);
      window.open(baseurl+'/laporan_pembelian_bahan_baku/view/'+kategori+'/'+from+'/'+to+'/'+id+'/');
    }
    
  });  

});


</script>
@endsection
