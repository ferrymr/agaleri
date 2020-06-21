@extends('layouts.app')

@section('style')
<style>

</style>
@endsection

@section('content')
<div id="main" class="utama_panel"role="main">
  <div id="content">
    <div class="row">
      <div class="col-xs-12 col-sm-7 col-md-7 col-lg-4">
        <h1 class="page-title txt-color-blueDark"><i class="fa fa-desktop fa-fw "></i>
          {{ $title }}
        </h1>
      </div>
    </div>
    <section id="widget-grid" class=""> 
      <div class="row">
        <article class="col-sm-12 col-md-12 col-lg-12 sortable-grid ui-sortable">
          <div class="jarviswidget jarviswidget-color-orange jarviswidget-sortable" id="wid-id-1" data-widget-editbutton="false" role="widget">
            <header role="heading" class="ui-sortable-handle"><div class="jarviswidget-ctrls" role="menu">   <a href="javascript:void(0);" class="button-icon jarviswidget-toggle-btn" rel="tooltip" title="" data-placement="bottom" data-original-title="Collapse"><i class="fa fa-minus "></i></a> <a href="javascript:void(0);" class="button-icon jarviswidget-fullscreen-btn" rel="tooltip" title="" data-placement="bottom" data-original-title="Fullscreen"><i class="fa fa-expand "></i></a> <a href="javascript:void(0);" class="button-icon jarviswidget-delete-btn" rel="tooltip" title="" data-placement="bottom" data-original-title="Delete"><i class="fa fa-times"></i></a></div><div class="widget-toolbar" role="menu"><a data-toggle="dropdown" class="dropdown-toggle color-box selector" href="javascript:void(0);"></a><ul class="dropdown-menu arrow-box-up-right color-select pull-right"><li><span class="bg-color-green" data-widget-setstyle="jarviswidget-color-green" rel="tooltip" data-placement="left" data-original-title="Green Grass"></span></li><li><span class="bg-color-greenDark" data-widget-setstyle="jarviswidget-color-greenDark" rel="tooltip" data-placement="top" data-original-title="Dark Green"></span></li><li><span class="bg-color-greenLight" data-widget-setstyle="jarviswidget-color-greenLight" rel="tooltip" data-placement="top" data-original-title="Light Green"></span></li><li><span class="bg-color-purple" data-widget-setstyle="jarviswidget-color-purple" rel="tooltip" data-placement="top" data-original-title="Purple"></span></li><li><span class="bg-color-magenta" data-widget-setstyle="jarviswidget-color-magenta" rel="tooltip" data-placement="top" data-original-title="Magenta"></span></li><li><span class="bg-color-pink" data-widget-setstyle="jarviswidget-color-pink" rel="tooltip" data-placement="right" data-original-title="Pink"></span></li><li><span class="bg-color-pinkDark" data-widget-setstyle="jarviswidget-color-pinkDark" rel="tooltip" data-placement="left" data-original-title="Fade Pink"></span></li><li><span class="bg-color-blueLight" data-widget-setstyle="jarviswidget-color-blueLight" rel="tooltip" data-placement="top" data-original-title="Light Blue"></span></li><li><span class="bg-color-teal" data-widget-setstyle="jarviswidget-color-teal" rel="tooltip" data-placement="top" data-original-title="Teal"></span></li><li><span class="bg-color-blue" data-widget-setstyle="jarviswidget-color-blue" rel="tooltip" data-placement="top" data-original-title="Ocean Blue"></span></li><li><span class="bg-color-blueDark" data-widget-setstyle="jarviswidget-color-blueDark" rel="tooltip" data-placement="top" data-original-title="Night Sky"></span></li><li><span class="bg-color-darken" data-widget-setstyle="jarviswidget-color-darken" rel="tooltip" data-placement="right" data-original-title="Night"></span></li><li><span class="bg-color-yellow" data-widget-setstyle="jarviswidget-color-yellow" rel="tooltip" data-placement="left" data-original-title="Day Light"></span></li><li><span class="bg-color-orange" data-widget-setstyle="jarviswidget-color-orange" rel="tooltip" data-placement="bottom" data-original-title="Orange"></span></li><li><span class="bg-color-orangeDark" data-widget-setstyle="jarviswidget-color-orangeDark" rel="tooltip" data-placement="bottom" data-original-title="Dark Orange"></span></li><li><span class="bg-color-red" data-widget-setstyle="jarviswidget-color-red" rel="tooltip" data-placement="bottom" data-original-title="Red Rose"></span></li><li><span class="bg-color-redLight" data-widget-setstyle="jarviswidget-color-redLight" rel="tooltip" data-placement="bottom" data-original-title="Light Red"></span></li><li><span class="bg-color-white" data-widget-setstyle="jarviswidget-color-white" rel="tooltip" data-placement="right" data-original-title="Purity"></span></li><li><a href="javascript:void(0);" class="jarviswidget-remove-colors" data-widget-setstyle="" rel="tooltip" data-placement="bottom" data-original-title="Reset widget color to default">Remove</a></li></ul></div>
              <span class="widget-icon"> <i class="fa fa-sitemap"></i> </span>
              <h2>Form {{ $title }}</h2>
              <span class="jarviswidget-loader"><i class="fa fa-refresh fa-spin"></i></span></header>
              <div role="content">
                <div class="widget-body">
                  <div role="content">
                    <div class="widget-body">
                      <form id="formAdd" class="form-horizontal" method="post" data-toggle="validator" enctype="multipart/form-data">
                        {{ csrf_field() }} {{ method_field('POST') }}
                        <div class="form-group">
                          <label for="tanggal" class="col-md-2 control-label">Tanggal</label>
                          <div class="col-md-2">
                            <div class="input-group">
                              <input readonly type="text" name="tanggal" placeholder="Pilih tanggal" class="form-control datepicker" data-dateformat="dd/mm/yy" value="{{ $tanggal }}">
                              <span class="input-group-addon"><i class="fa fa-calendar"></i></span>
                            </div>
                          </div>
                        </div>

                        <div class="form-group">
                          <label for="id" class="col-md-2 control-label">No Bukti Permintaan</label>
                          <div class="col-md-2">
                            <input id="no_bukti_permintaan" name="no_bukti_permintaan" type="text" class="form-control"  value="" readonly>
                          </div>
                        </div>

                        <div class="form-group">
                          <label for="id" class="col-md-2 control-label">No Bukti Keluar</label>
                          <div class="col-md-2">
                            <input id="no_bukti_keluar" name="no_bukti_keluar" type="text" class="form-control"  value="" readonly>
                          </div>
                        </div>

                        <div class="form-group">
                          <label for="id" class="col-md-2 control-label">No Bukti Pemakaian</label>
                          <div class="col-md-2">
                            <input id="no_bukti_pemakaian" name="no_bukti_pemakaian" type="text" class="form-control"  value="" readonly>
                          </div>
                        </div>

                        <div class="form-group">
                          <label for="" class="col-md-2 control-label">Kode Produksi/ SO</label>
                          <div class="col-md-3">
                            <select style="width:100%" id="id_so" name="id_so" class="form-control" required></select>
                          </div>
                        </div>

                        <fieldset>
                          <legend>Details {{ $title }}</legend>
                          <div class="form-group">
                          <div class="col-md-2">
                            <label class="control-label">Kode</label>
                          </div>
                          <div class="col-md-2">
                            <label class="control-label">Accessories</label>
                          </div>
                          <div class="col-md-1">
                            <label class="control-label">Brand</label>
                          </div>
                          <div class="col-md-1">
                            <label class="control-label">Supplier</label>
                          </div>
                          <div class="col-md-1">
                            <label class="control-label">Permintaan</label>
                          </div>
                          <div class="col-md-1">
                            <label class="control-label">Keluar</label>
                          </div>
                          <div class="col-md-1">
                            <label class="control-label">Pemakaian</label>
                          </div>
                          <div class="col-md-1">
                            <label class="control-label"></label>
                          </div>
                          <div class="col-md-1">
                            <label class="control-label">Keterangan</label>
                          </div>
                        </div>
                        <div id="detail">
                          <div class="detailLine form-group">
                          <div class="itemLine col-md-2">
                            <input name="kode_acc[]" type="text" class="form-control" readonly>
                          </div>
                          <div class="itemLine col-md-2">
                            <input type="text" name="nama_acc[]" class="form-control" value="" readonly>
                            <input type="hidden" name="id_acc[]" class="form-control" value="" readonly>
                          </div>
                          <div class="itemLine col-md-1">
                            <input type="text" name="nama_brand[]" class="form-control" value="" readonly>
                            <input type="hidden" name="id_brand[]" class="form-control" value="" readonly>
                          </div>
                          <div class="itemLine col-md-1">
                            <input type="text" name="nama_supplier[]" class="form-control" value="" readonly>
                            <input type="hidden" name="id_supplier[]" class="form-control" value="" readonly>
                          </div>
                          <div class="itemLine col-md-1">
                            <input name="qty_permintaan[]" kode="" onblur="calc_qty();" type="decimal" class="form-control decimal qty" value="" readonly>
                          </div>
                          <div class="itemLine col-md-1">
                            <input name="qty_keluar[]" kode="" onblur="calc_qty();" type="decimal" class="form-control decimal qty" value="" readonly>
                          </div>
                          <div class="itemLine col-md-1">
                            <input name="qty_pemakaian[]" kode="" onblur="calc_qty();" type="decimal" class="form-control decimal qty" value="">
                          </div>
                          <div class="itemLine col-md-1">
                            <label class="checkbox-inline"><input name="acc[]" type="checkbox" value="">Acc & Post</label>
                          </div>
                          <div class="itemLine col-md-2">
                            <input name="ket[]" type="text" class="form-control" value="" readonly>
                          </div>
                        </div>
                      </div>

                      <div class="form-group">
                        <div class="col-md-7">
                          <!-- <button id="btnAddLine" class="btn btn-primary btn-circle"><i class="glyphicon glyphicon-plus"></i></button> -->
                        </div>
                        <div class="col-md-1">
                          <!-- <input name="total_qty" type="decimal" class="form-control decimal" value=""> -->
                        </div>
                      </div>
                    </fieldset>

                        <div class="form-actions">
                          <div class="row">
                            <div class="col-md-12">
                              <button type="submit" class="btn btn-primary" id="btnSend">
                                <i class="fa fa-send"></i>
                                Simpan
                              </button>
                              <button class="btn btn-warning" id="btnReset">
                                <i class="fa fa-refresh"></i>
                                Reset
                              </button>
                            </div>
                          </div>
                        </div>
                      </form>
                    </div>
                  </div>
                </div>
              </div>
            </div>

            <div class="jarviswidget jarviswidget-color-orange" id="wid-id-4" data-widget-editbutton="false" data-widget-colorbutton="false" data-widget-deletebutton="false" data-widget-fullscreenbutton="false" data-widget-collapsed="true">
              <header>
                <span class="widget-icon"> <i class="fa fa-table"></i> </span>
                <h2>List Data by No Pemakaian </h2>
              </header>
              <div>
                <div class="jarviswidget-editbox">
                </div>
                <div class="widget-body">
                  <table id="{{$tag}}-table" class="table table-striped table-bordered table-hover" width="100%">
                    <thead>
                      <tr>
                        <th>No. Pemakaian</th>
                        <th>Tanggal</th>
                        <th>No. SO</th>
                        <th>Qty</th>
                        <!-- <th>Jumlah</th> -->
                        <!-- <th>Action</th> -->
                      </tr>
                    </thead>
                    <tbody>
                    </tbody>
                  </table>
                </div>
              </div>
            </div>

            <!-- <div class="jarviswidget jarviswidget-color-orange" id="wid-id-4" data-widget-editbutton="false" data-widget-colorbutton="false" data-widget-deletebutton="false" data-widget-fullscreenbutton="false" data-widget-collapsed="true">
              <header>
                <span class="widget-icon"> <i class="fa fa-table"></i> </span>
                <h2>List Data by SO </h2>
              </header>
              <div>
                <div class="jarviswidget-editbox">
                </div>
                <div class="widget-body">
                  <table id="{{$tag}}-table-so2" class="table table-striped table-bordered table-hover" width="100%">
                    <thead>
                      <tr>
                        <th>No. SO</th>
                        <th>Nama Produk</th>
                        <th>Total Qty Keluar</th>
                        <th>Total Qty Pemakaian</th>
                        <th>Sisa Pengembalian</th>
                      </tr>
                    </thead>
                    <tbody>
                    </tbody>
                  </table>
                </div>
              </div>
            </div> -->
          </article>
        </div>
      </section>
    </div>


  </div>
  <!-- END MAIN PANEL -->

  @endsection

  @section('script')
  <script>
  $('[name=btnPostingArt]').on('click',function() {
    postData();
  });
  var tag   = '{{$tag}}';
  var table = $('#'+tag+'-table').DataTable({
    processing: true,
    serverSide: true,
    ajax: "{{ route('pemakaian_acc.api') }}",
    columns: [
      {data: 'id', name: 'id'},
      {data: 'tanggal', name: 'tanggal'},
      {data: 'id_so', name: 'id_so'},
      {data: 'qty', name: 'qty'},
      // {data: 'hasil_cutt', name: 'hasil_cutt'},
      // {data: 'jumlah', name: 'jumlah'},
      // {data: 'action', name: 'action'},
    ]
  });

  var table_so = $('#'+tag+'-table-so').DataTable({
    processing: true,
    serverSide: true,
    ajax: "{{ route('pemakaian_acc_so.api') }}",
    columns: [
      {data: 'id_so', name: 'id_so'},
      {data: 'nama_produk', name: 'nama_produk'},
      // {data: 'qty_keluar', name: 'qty_keluar'},
      {data: 'qty_keluar', name: 'qty_keluar'},
      {data: 'qty', name: 'qty'},
      {data: 'sisa', name: 'sisa'},
      // {data: 'hasil_cutt', name: 'hasil_cutt'},
      // {data: 'action', name: 'action'},
    ]
  });

  select2Run();
  setkg($('[name="id_satuan[]"]'));
  function select2Run() {
    $('#id_so').select2({
      ajax: {
        url: baseurl+'/get_produksi',
        delay:250,
        data: function (params) {
          var query = {
            search: params.term,
            type: 'public',
            jenis: 'keluar_ok',
            kategori: 'acc',
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


  $(function(){

    $('#btnReset').on('click', function (e) {
      resetForm();
      e.preventDefault();
    });

    $('#formAdd').validator().on('submit', function (e) {
      $('input[name=_method]').val('POST');
      if (!e.isDefaultPrevented()){
        var id = $('#id').val();
        url = "{{ url('pemakaian_acc') }}";

        var request = $.ajax({
          url : url,
          type : "POST",
          data : $('#formAdd').serialize(),
          success : function(data) {
            resetForm();
            table.ajax.reload();
            if (data.status == true) {
              myswal('s',data.message,'s',1500);
              $('[name=no_bukti_pemakaian]').val(data.newid);
              setTimeout(function () {
                location.reload();
              }, 1500);
            } else {
              myswal('e',data.message,'e',1500);
              $('[name=no_bukti_pemakaian]').val(data.newid);
              setTimeout(function () {
                location.reload();
              }, 1500);
            }
          },
          error : function(data){
            myswal('e',data.message,'e',1500);
            // setTimeout(function () {
            //   location.reload();
            // }, 1500);
          }
        });
        return false;

      }
    });

    $('#detail').on('change','select', function (e) {
      var self = $(this);
      var kode_acc = self.parents('.detailLine').find('[name="kode_acc[]"]');
      var id_acc = self.parents('.detailLine').find('select[name="id_acc[]"]').val();
      var id_brand = self.parents('.detailLine').find('[name="id_brand[]"]').val();
      var id_supplier = self.parents('.detailLine').find('[name="id_supplier[]"]').val();
      if (id_acc == null) id_acc='';
      if (id_brand == null) id_brand='';
      if (id_supplier == null) id_supplier='';
      kode_acc.val(id_acc+'-'+id_brand+'-'+id_supplier+'');
    });

    $('#id_so').on('change', function (e) {
      $('#formAdd').validator('update');
      e.preventDefault();
      var id = $('#id_so');
      if (id.val() == null) {
        return;
      } else {
      var id = $(this).val();
      $('[name="qty_pemakaian[]"]').prop('readonly',false);
      $('[name="acc[]"]').prop('checked',false);
      $('[name="acc[]"]').prop('disabled',false);
      $('[name="hasil_cutt[]"]').prop('readonly',false);
      $('#no_bukti_keluar').val('');
      $('#no_bukti_pemakaian').val('');
      $('.qty').attr('kode','');
      url = "{{ route('detail_permintaan_acc.get') }}";
      $.ajax({
        url : url,
        type : "POST",
        data : {id_so:id},
        success : function(data) {
          $('#no_bukti_keluar').val(data.id_keluar);
          $('#no_bukti_pemakaian').val(data.id_pemakaian);
          $('#no_bukti_permintaan').val(data.permintaan[0]['id']);
          $('.detailLine').not(':eq(0)').remove();
          var detailLine = $('#detail .detailLine').eq(0).html();
          for (var i = 0; i < data.permintaan.length; i++) {
            if (i > 0) {
              $('#detail .detailLine').last().after('<div class="detailLine form-group">'+detailLine+'</div>');
            }

            $('[name="kode_acc[]"]').eq(i).val(data.permintaan[i]['kode_acc']);
            $('[name="nama_acc[]"]').eq(i).val(data.permintaan[i]['nama_acc']);
            $('[name="id_acc[]"]').eq(i).val(data.permintaan[i]['id_acc']);
            $('[name="nama_brand[]"]').eq(i).val(data.permintaan[i]['nama_brand']);
            $('[name="id_brand[]"]').eq(i).val(data.permintaan[i]['id_brand']);
            $('[name="nama_supplier[]"]').eq(i).val(data.permintaan[i]['nama_supplier']);
            $('[name="id_supplier[]"]').eq(i).val(data.permintaan[i]['id_supplier']);
            $('[name="qty_permintaan[]"]').eq(i).val(data.permintaan[i]['qty_permintaan']);
            $('[name="qty_permintaan[]"]').eq(i).attr('kode_p',data.permintaan[i]['kode_acc']);
            $('[name="qty_keluar[]"]').eq(i).attr('kode_k',data.permintaan[i]['kode_acc']);
            $('[name="qty_pemakaian[]"]').eq(i).attr('kode_s',data.permintaan[i]['kode_acc']);
            $('[name="hasil_cutt[]"]').eq(i).attr('kode_cutt',data.permintaan[i]['kode_acc']);
            $('[name="hasil_cutt[]"]').eq(i).val(0);
            $('[name="acc[]"]').eq(i).val(i);
            $('[name="acc[]"]').eq(i).attr('kode_acc',data.permintaan[i]['kode_acc']);

            var id_kode = data.permintaan[i]['kode_acc'];
            var qty_keluar = 0;
            var qty_pemakaian = parseInt(data.permintaan[i]['qty_permintaan']);
            $('[kode_k='+id_kode+']').val(qty_keluar);
            $('[kode_s='+id_kode+']').val(qty_pemakaian);
            $('[name="nama_satuan[]"]').eq(i).val(data.permintaan[i]['nama_satuan']);
            $('[name="id_satuan[]"]').eq(i).val(data.permintaan[i]['id_satuan']);
            $('[name="ket[]"]').eq(i).val(data.permintaan[i]['ket']);
          }

          for (var i = 0; i < data.keluar.length; i++){
            var total_keluar = 0;
            var id_keluar = data.keluar[i]["kode_acc"];
            var qty_keluar = data.keluar[i]['qty_keluar'];
            var qty_pemakaian = parseInt($('[kode_p='+id_keluar+']').val()) - parseInt(qty_keluar);
            $('[kode_k='+id_keluar+']').val(qty_keluar);
            $('[kode_s='+id_keluar+']').val(qty_pemakaian);
            var qty_pemakaian_finish = $('[kode_s='+id_keluar+']').val();
          }

          for (var i = 0; i < data.pemakaian.length; i++){
            var total_pemakaian = 0;
            var id_pemakaian = data.pemakaian[i]["kode_acc"];
            var qty_pemakaian = data.pemakaian[i]['qty_pemakaian'];
            $('[kode_s='+id_pemakaian+']').val(qty_pemakaian);            
            $('[kode_s='+id_pemakaian+']').prop('readonly',true);
            $('[kode_cutt='+id_pemakaian+']').prop('readonly',true);
            $('[kode_acc='+id_pemakaian+']').prop('disabled',true);
          }

        runRibuan();
        runDecimal();
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
    $("#id_cmt").select2("val", "");
    $("#id_so").select2("val", "");
    $('.detailLine').remove();
    select2Run();
    $('#formAdd').validator('update');
  }

  </script>
  @endsection
