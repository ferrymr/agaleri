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
      <h1 class="page-title txt-color-blueDark"><i class="fa fa-desktop fa-fw "></i>
        {{ $title }}
      </h1>
    </div>
  </div>

  <section id="widget-grid">
    <div class="row">
      <article class="col-sm-12 col-md-12 col-lg-12 sortable-grid ui-sortable">
        <div class="jarviswidget jarviswidget-color-orange jarviswidget-sortable" id="wid-id-1" data-widget-editbutton="false" role="widget">
          <header role="heading" class="ui-sortable-handle"><div class="jarviswidget-ctrls" role="menu">   <a href="javascript:void(0);" class="button-icon jarviswidget-toggle-btn" rel="tooltip" title="" data-placement="bottom" data-original-title="Collapse"><i class="fa fa-minus "></i></a> <a href="javascript:void(0);" class="button-icon jarviswidget-fullscreen-btn" rel="tooltip" title="" data-placement="bottom" data-original-title="Fullscreen"><i class="fa fa-expand "></i></a> <a href="javascript:void(0);" class="button-icon jarviswidget-delete-btn" rel="tooltip" title="" data-placement="bottom" data-original-title="Delete"><i class="fa fa-times"></i></a></div><div class="widget-toolbar" role="menu"><a data-toggle="dropdown" class="dropdown-toggle color-box selector" href="javascript:void(0);"></a><ul class="dropdown-menu arrow-box-up-right color-select pull-right"><li><span class="bg-color-green" data-widget-setstyle="jarviswidget-color-green" rel="tooltip" data-placement="left" data-original-title="Green Grass"></span></li><li><span class="bg-color-greenDark" data-widget-setstyle="jarviswidget-color-greenDark" rel="tooltip" data-placement="top" data-original-title="Dark Green"></span></li><li><span class="bg-color-greenLight" data-widget-setstyle="jarviswidget-color-greenLight" rel="tooltip" data-placement="top" data-original-title="Light Green"></span></li><li><span class="bg-color-purple" data-widget-setstyle="jarviswidget-color-purple" rel="tooltip" data-placement="top" data-original-title="Purple"></span></li><li><span class="bg-color-magenta" data-widget-setstyle="jarviswidget-color-magenta" rel="tooltip" data-placement="top" data-original-title="Magenta"></span></li><li><span class="bg-color-pink" data-widget-setstyle="jarviswidget-color-pink" rel="tooltip" data-placement="right" data-original-title="Pink"></span></li><li><span class="bg-color-pinkDark" data-widget-setstyle="jarviswidget-color-pinkDark" rel="tooltip" data-placement="left" data-original-title="Fade Pink"></span></li><li><span class="bg-color-blueLight" data-widget-setstyle="jarviswidget-color-blueLight" rel="tooltip" data-placement="top" data-original-title="Light Blue"></span></li><li><span class="bg-color-teal" data-widget-setstyle="jarviswidget-color-teal" rel="tooltip" data-placement="top" data-original-title="Teal"></span></li><li><span class="bg-color-blue" data-widget-setstyle="jarviswidget-color-blue" rel="tooltip" data-placement="top" data-original-title="Ocean Blue"></span></li><li><span class="bg-color-blueDark" data-widget-setstyle="jarviswidget-color-blueDark" rel="tooltip" data-placement="top" data-original-title="Night Sky"></span></li><li><span class="bg-color-darken" data-widget-setstyle="jarviswidget-color-darken" rel="tooltip" data-placement="right" data-original-title="Night"></span></li><li><span class="bg-color-yellow" data-widget-setstyle="jarviswidget-color-yellow" rel="tooltip" data-placement="left" data-original-title="Day Light"></span></li><li><span class="bg-color-orange" data-widget-setstyle="jarviswidget-color-orange" rel="tooltip" data-placement="bottom" data-original-title="Orange"></span></li><li><span class="bg-color-orangeDark" data-widget-setstyle="jarviswidget-color-orangeDark" rel="tooltip" data-placement="bottom" data-original-title="Dark Orange"></span></li><li><span class="bg-color-red" data-widget-setstyle="jarviswidget-color-red" rel="tooltip" data-placement="bottom" data-original-title="Red Rose"></span></li><li><span class="bg-color-redLight" data-widget-setstyle="jarviswidget-color-redLight" rel="tooltip" data-placement="bottom" data-original-title="Light Red"></span></li><li><span class="bg-color-white" data-widget-setstyle="jarviswidget-color-white" rel="tooltip" data-placement="right" data-original-title="Purity"></span></li><li><a href="javascript:void(0);" class="jarviswidget-remove-colors" data-widget-setstyle="" rel="tooltip" data-placement="bottom" data-original-title="Reset widget color to default">Remove</a></li></ul></div>
            <span class="widget-icon"> <i class="fa fa-inbox"></i> </span>
            <h2>Form {{ $title }}</h2>
            <span class="jarviswidget-loader"><i class="fa fa-refresh fa-spin"></i></span></header>
            <div role="content">
              <div class="jarviswidget-editbox">
              </div>
              <div class="widget-body">
                <div role="content">
                  <div class="widget-body">
                    <form id="formAdd" name="formAdd" method="post" class="form-horizontal" data-toggle="validator" enctype="multipart/form-data">
                      {{ csrf_field() }} {{ method_field('POST') }}
                        
                      <br/>
                      <fieldset>
                        <div class="form-group">
                          <label class="col-md-2 control-label">Tanggal Pengeluaran</label>
                          <div class="col-sm-2">
                            <div class="input-group">
                            <input type="text" id="tanggal" name="tanggal" placeholder="Select a date" class="form-control datepicker" data-dateformat="dd/mm/yy" value="{{ $tanggal }}">
                              <span class="input-group-addon"><i class="fa fa-calendar"></i></span>
                            </div>
                          </div>
                        </div>
                        <div class="form-group">
                          <label class="col-md-2 control-label">Dibayarkan Kepada </label>
                          <div class="col-md-2">
                            <select class="form-control" style="width:100%;" name="id_akun"></select>
                          </div>
                        </div>
                        <div class="form-group">
                          <label class="col-md-2 control-label">Kode Perkiraan Debet </label>
                          <div class="col-md-2">
                            <input class="form-control" type="text" name="id_akun_debet" value="" readonly>
                          </div>
                        </div>
                        <div class="form-group">
                          <label class="col-md-2 control-label">Nomor Giro/ Cheque Pelanggan </label>
                          <div class="col-md-2">
                            <input class="form-control" type="text" name="no_giro_pelanggan" value="">
                          </div>
                        </div>
                        <div class="form-group">
                          <label class="col-md-2 control-label">Nomor Giro/ Cheque Sendiri </label>
                          <div class="col-md-2">
                            <input class="form-control" type="text" name="no_giro_sendiri" value="">
                          </div>
                        </div>
                        <div class="form-group">
                          <label class="col-md-2 control-label">Kode Perkiraan Kredit </label>
                          <div class="col-md-2">
                            <input class="form-control" type="text" name="id_akun_kredit" value="2201030001" readonly>
                          </div>
                          <div class="col-md-3">
                            <input class="form-control" type="text" name="nama_id_akun_kredit" value="GIRO KELUAR" readonly>
                          </div>
                        </div>
                        <div class="form-group">
                          <label class="col-md-2 control-label">Tanggal Jatuh Tempo</label>
                          <div class="col-sm-2">
                            <div class="input-group">
                            <input type="text" id="tanggal_jatuh_tempo" name="tanggal_jatuh_tempo" placeholder="Select a date" class="form-control datepicker" data-dateformat="dd/mm/yy" value="{{ $tanggal }}">
                              <span class="input-group-addon"><i class="fa fa-calendar"></i></span>
                            </div>
                          </div>
                        </div>
                        <div class="form-group">
                          <label class="col-md-2 control-label">Nilai Nominal </label>
                          <div class="col-md-2">
                            <input class="form-control ribuan" type="text" name="nilai_nominal" value="">
                          </div>
                        </div>
                        <!-- <div class="form-group">
                          <label class="col-md-2 control-label">Saldo Fiktif </label>
                          <div class="col-md-2">
                            <input class="form-control" type="text" name="saldo_fiktif" value="">
                          </div>
                        </div> -->
                        <div class="form-group">
                          <label class="col-md-2 control-label">Uraian Transaksi </label>
                          <div class="col-md-5">
                            <textarea class="form-control" type="text" name="uraian" value=""></textarea>
                          </div>
                        </div>
                      <div class="form-actions">
                        <div class="row">
                          <div class="col-md-12">
                            <button id="btnAdd" type="submit" class="btn btn-primary">
                              <i class="fa fa-send"></i>
                              Post
                            </button>
                            <a id="btnResetAdd" class="btn btn-default">
                              <i class="fa fa-refresh"></i>
                              Reset
                            </a>
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
    <section id="widget-grid">
    <div class="row">
        <article class="col-sm-12 col-md-12 col-lg-12">
          <div class="jarviswidget jarviswidget-color-orange" id="wid-id-3" data-widget-editbutton="false">
            <header>
              <span class="widget-icon"> <i class="fa fa-table"></i> </span>
              <h2>List Data</h2>
            </header>
            <div>
              <div class="widget-body">
                <table id="{{$tag}}-table" class="table table-striped table-bordered table-hover" width="100%">
                  <thead>
                    <tr>
                      <th data-hide="phone">ID</th>
                      <th data-class="expand">Tanggal</th>
                      <th data-class="expand">Tanggal Jatuh Tempo</th>
                      <th data-class="expand">No Giro Pelanggan</th>
                      <th data-class="expand">No Giro Sendiri</th>
                      <th>Nominal</th>
                      <th>Status</th>
                      <th data-hide="phone">Action</th>
                    </tr>
                  </thead>
                  <tbody>
                  </tbody>
                </table>
              </div>
            </div>
          </div>
        </article>
      </div>  
    </section>
  </div>
</div>

  
  @endsection

  @section('script')
  <script>
  var token = $('meta[name="csrf-token"]').attr('content');
  var tag   = '{{$tag}}';
  var table = $('#'+tag+'-table').DataTable({
    processing: true,
    serverSide: true,
    ajax: "{{ route('giro_keluar.api') }}",
    columns: [
      {data: 'id', name: 'id'},
      {data: 'tanggal_keluar', name: 'tanggal_keluar'},
      {data: 'tanggal_jatuh_tempo', name: 'tanggal_jatuh_tempo'},
      {data: 'no_cek_giro_pelanggan', name: 'no_cek_giro_pelanggan'},
      {data: 'no_cek_giro_sendiri', name: 'no_cek_giro_sendiri'},
      {data: 'nominal', name: 'nominal'},
      {data: 'status', name: 'status'},
      {data: 'action', name: 'action', orderable: false, searchable: false}
    ]
  });
  
    select2Run();

    $('[name=id_akun]').on('change', function(e) {
      if ($(this).val() != null) {
        var val = $(this).val();
          $('[name=id_akun_debet]').val(val);
        }   
    });
    
    $('#btnResetAdd').on('click', function (e) {
        resetForm();
    });

    $('#formAdd').validator().on('submit', function (e) {
      $('input[name=_method]').val('POST');
      if (!e.isDefaultPrevented()){
        var id = $('#id').val();
        url = "{{ url('giro_keluar') }}";

        $.ajax({
          url : url,
          type : "POST",
          data : $('#formAdd').serialize(),
          success : function(data) {
            if (data.status == true) {
              myswal('s',data.message,'s',1500);
              table.ajax.reload();
              resetForm();
            } else {
              myswal('e',data.message,'e',1500);
            }
          },
          error : function(data){
            myswal('e','Periksa Kembali Inputanya!','e',1500);
          }
        });
        return false;
      }
    });

 function aprove(id) {
    var url         = "{{ url('giro_keluar_aprove') }}";
    var data = {
      '_token' : token,
      'id' : id
    }
    $.ajax({
      url : url,
      data : data,
      type : "POST",
      success : function(data) {
        myswal('s',data.message,'s',1500);
        table.ajax.reload();
        resetForm();
      },
      error : function(data){
        myswal('e',data.message,'e',1500);
      }
    });
  }


  //Fungsi Select2
  function select2Run() { 
    $('[name="id_akun"]').select2({
      ajax: {
          url: baseurl+'/get_akun',
          delay:250,
          data: function (params) {
            var query = {
              search: params.term,
              type: 'public',
              category: 'k3',
              k31: '220101',
              k32: '220102',
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

  //Fungsi Reset Data form
  function resetForm() {
    $('#formAdd')[0].reset();
    $('[name="id_akun"').val('').change();     
  }

  </script>
  @endsection
