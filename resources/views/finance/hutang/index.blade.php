@extends('layouts.app')

@section('style')
<style>
  .btn-create {
    margin-top: 10px;
    right: 0px;
  }
</style>
@endsection

@section('content')
<div id="main" class="utama_panel" role="main">
<div id="content">
  <div class="row">
    <div class="col-md-10">
      <h1 class="page-title txt-color-blueDark"><i class="fa fa-desktop fa-fw "></i>
        {{ $title }}
      </h1>
    </div>
    <div class="col-md-1">
      <button class="btn btn-warning pull-right btn-create" type="button" onclick="window.location.href='{{ url('/hutang_tambah') }}'">Tambah</button>
    </div>
    <div class="col-md-1">
      <button class="btn btn-primary pull-right btn-create" type="button" onclick="window.location.href='{{ url('/hutang_bayar') }}'">Pembayaran</button>
    </div>
  </div>
  <section id="widget-grid">
    <div class="row">
      <article class="col-sm-12 col-md-12 col-lg-12">
        <div class="jarviswidget jarviswidget-color-orange" id="wid-id-3" data-widget-editbutton="false">
          <header>
            <span class="widget-icon"> <i class="fa fa-table"></i> </span>
            <h2>Hutang Supplier</h2>
          </header>
          <div>
            <div class="widget-body">
              <table id="{{$tag}}-table" class="table table-striped table-bordered table-hover" width="100%">
                <thead>
                  <tr>
                    <th data-class="expand">ID</th>
                    <th data-class="expand">No Faktur</th>
                    <th data-hide="phone">Tgl Faktur</th>
                    <th data-hide="phone">Tgl Jatuh Tempo</th>
                    <th>Supplier</th>
                    <th>Total Hutang</th>
                    <th>Total Bayar</th>
                    <th>Sisa</th>
                    <th>Status</th>
                  </tr>
                </thead>
                <tbody>
                </tbody>
              </table>
            </div>
          </div>
        </div>
      </article>
    </section>
  <section id="widget-grid">
    <div class="row">
      <article class="col-sm-12 col-md-12 col-lg-12">
        <div class="jarviswidget jarviswidget-color-orange" id="wid-id-3" data-widget-editbutton="false">
          <header>
            <span class="widget-icon"> <i class="fa fa-table"></i> </span>
            <h2>Hutang CMT</h2>
          </header>
          <div>
            <div class="widget-body">
              <table id="{{$tag}}-cmt-table" class="table table-striped table-bordered table-hover" width="100%">
                <thead>
                  <tr>
                    <th data-class="expand">ID</th>
                    <th data-class="expand">No SKB</th>
                    <th data-hide="phone">Tgl Faktur</th>
                    <th data-hide="phone">Tgl Jatuh Tempo</th>
                    <th>CMT</th>
                    <th>Total Hutang</th>
                    <th>Total Bayar</th>
                    <th>Sisa</th>
                    <th>Status</th>
                  </tr>
                </thead>
                <tbody>
                </tbody>
              </table>
            </div>
          </div>
        </div>
      </article>
    </section>
  </div>
  </div>

  @endsection

  @section('script')
  <script>

  var tag   = '{{$tag}}';
  var table = $('#'+tag+'-table').DataTable({
    processing: true,
    serverSide: true,
    ajax: "{{ route('hutang.api') }}",
    order: [0,'asc'],
    columns: [
      {data: 'id', name: 'id'},
      {data: 'no_faktur', name: 'no_faktur'},
      {data: 'tanggal_faktur', name: 'tanggal_faktur'},
      {data: 'tanggal_jatuh_tempo', name: 'tanggal_jatuh_tempo'},
      {data: 'nama_supplier', name: 'nama_supplier'},
      {data: 'total_hutang', name: 'total_hutang'},
      {data: 'total_bayar', name: 'total_bayar'},
      {data: 'total_sisa', name: 'total_sisa'},
      {data: 'status', name: 'status'},
      // {data: 'action', name: 'action', orderable: false, searchable: false}
    ]
  });

  var table_cmt = $('#'+tag+'-cmt-table').DataTable({
    processing: true,
    serverSide: true,
    ajax: "{{ route('hutang_cmt.api') }}",
    order: [0,'asc'],
    columns: [
      {data: 'id', name: 'id'},
      {data: 'no_skb', name: 'no_skb'},
      {data: 'tanggal_faktur', name: 'tanggal_faktur'},
      {data: 'tanggal_jatuh_tempo', name: 'tanggal_jatuh_tempo'},
      {data: 'nama_cmt', name: 'nama_cmt'},
      {data: 'total_hutang', name: 'total_hutang'},
      {data: 'total_bayar', name: 'total_bayar'},
      {data: 'total_sisa', name: 'total_sisa'},
      {data: 'status', name: 'status'},
      // {data: 'action', name: 'action', orderable: false, searchable: false}
    ]
  });

  $(function(){
    // select2Run();
    function select2Run() {

      $('[name="id_payment"]').select2({
        ajax: {
          url: baseurl+'/get_payment',
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

      $('[name="id_costumer"]').select2({
        ajax: {
          url: baseurl+'/get_costumer',
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

      $('[name="id_category"]').select2({
        ajax: {
          url: baseurl+'/get_category',
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
    $('#btnResetAdd').on('click', function (e) {
      $('#formAdd')[0].reset();
    });

    $('#formAdd').validator().on('submit', function (e) {
      $('input[name=_method]').val('POST');
      if (!e.isDefaultPrevented()){
        var id = $('#id').val();
        url = "{{ url('revenue') }}";

        $.ajax({
          url : url,
          type : "POST",
          data : $('#formAdd').serialize(),
          success : function(data) {
            resetForm();
            if (data.status == true) {
              myswal('s',data.message,'s',1500);
            } else {
              myswal('e',data.message,'e',1500);
            }
          },
          error : function(data){
            myswal('e',data.message,'e',1500);
          }
        });
        return false;
      }
    });
  });

  //Fungsi Reset Data form
  function resetForm() {
    $('#formAdd')[0].reset();
    $('select').val('').change();
    $('#jumlah').focus();
  }


  function editHutang(id) {
    window.location.href = '{{ url("/hutang/") }}'+'/'+id;
    console.log(id);
  }

  </script>
  @endsection
