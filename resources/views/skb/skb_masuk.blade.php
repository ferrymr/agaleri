@extends('layouts.app')
@section('style')
<style>
  .modal-xl {
    width: 90%;
   max-width:1200px;
  }
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
                  <form id="formAdd" class="form-horizontal" method="post" data-toggle="validator" enctype="multipart/form-data">
                    {{ csrf_field() }} {{ method_field('POST') }}
                    <div class="form-group">
                      <label for="id" class="col-md-2 control-label">No. SKB Masuk</label>
                      <div class="col-md-2">
                        <input id="id" type="text" class="form-control" name="id" value="{{ $newid }}" readonly="">
                      </div>
                      <div class="col-md-2 pull-right ">
                        <div class="input-group">
                          <input type="text" name="tanggal" placeholder="Pilih tanggal" class="form-control datepicker" data-dateformat="dd/mm/yy" value="{{ $tanggal }}">
                          <span class="input-group-addon"><i class="fa fa-calendar"></i></span>
                        </div>
                      </div>
                    </div>
                    <div class="form-group">
                      <label for="id" class="col-md-2 control-label">No. Surat Jalan</label>
                      <div class="col-md-2">
                        <input id="no_surat_jalan" type="text" class="form-control" name="no_surat_jalan" value="" >
                      </div>
                    </div>
                    <div class="form-group">
                      <label for="" class="col-md-2 control-label">CMT</label>
                      <div class="col-md-2">
                      <select style="width:100%" id="cmt_id" name="cmt_id" class="form-control" required=""></select>
                    </div>
                    <div class="col-md-2">
                    </div>
                  </div>
                  <fieldset>
                    <legend>Details {{ $title }}</legend>
                    <div class="form-group">
                      <div class="col-md-2">
                        <label class="control-label" style="margin-left:10px;">No. SKB Keluar</label>
                      </div>
                      <div class="col-md-1">
                        <label class="control-label">Tanggal Keluar</label>
                      </div>
                      <div class="col-md-1">
                        <label class="control-label">No SO</label>
                      </div>
                      <div class="col-md-1">
                        <label class="control-label">Art</label>
                      </div>
                      <div class="col-md-2">
                        <label class="control-label">Kode Barang</label>
                      </div>
                      <div class="col-md-2">
                        <label class="control-label">Nama Barang</label>
                      </div>
                      <div class="col-md-1">
                        <label class="control-label">Qty Keluar</label>
                      </div>
                      <div class="col-md-1">
                        <label class="control-label">Qty Masuk</label>
                      </div>
                      <div class="col-md-1">
                        <label class="control-label">Keterangan</label>
                      </div>
                    </div>
                    <div id="detail">
                      <div class="detailLine form-group">
                          <div class="itemLine col-md-2">
                            <div class="col-md-2"><button type="button" class="btn btn-success pull-left" name="btnAddSKB[]" so_art_btn_add=""><i class="fa fa-plus"></i></button></div>
                            <div class="col-md-10"><input type="text" name="no_skb[]" class="form-control" value="" readonly=""></div>                          
                          </div>
                          <div class="itemLine col-md-1">
                            <input name="tanggal_keluar[]" type="text" class="form-control" readonly="">
                          </div>
                          <div class="itemLine col-md-1">
                            <input name="so_id[]" type="text" class="form-control" value="" readonly="">
                          </div>
                          <div class="itemLine col-md-1">
                            <input name="art_id[]" type="text" class="form-control" value="" readonly="">
                          </div>
                          <div class="itemLine col-md-2">
                            <input name="kode_barang[]" type="text" class="form-control" value="" readonly="">
                          </div>
                          <div class="itemLine col-md-2">
                            <input name="nama_barang[]" type="text" class="form-control" value="" readonly="">
                          </div>
                          <div class="itemLine col-md-1">
                            <input name="qty_keluar[]" type="decimal" class="form-control ribuan calc" value="" readonly="">
                          </div>
                          <div class="itemLine col-md-1">
                            <input name="qty_masuk[]" type="decimal" class="form-control ribuan calc" value="">
                          </div>
                          <div class="itemLine col-md-1">
                            <input name="ket[]" type="text" class="form-control" value="">
                          </div>
                        </div>
                    </div>
                  </fieldset>
                  <div class="form-actions">
                    <div class="row">
                      <div class="col-md-12">
                        <button type="submit" class="btn btn-primary" id="btnSend">
                          <i class="fa fa-send"></i>
                          Send
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
        </article>
      </div>
    </section>
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
                <th>No. SKB Masuk</th>
                <th>No. SKB Keluar</th>
                <th>No. Surat Jalan</th>
                <th>No. SO</th>
                <th>No. Art</th>
                <th>CMT</th>
                <th>Proses</th>
                <th>Status</th>
                <th>Qty</th>
                <th>Catatan</th>
                <th>Action</th>
              </tr>
            </thead>
            <tbody>
            </tbody>
          </table>
        </div>
      </div>
    </div>
  </div>


  <!-- Modal -->
    <div class="modal fade" id="modalAdd" tabindex="-1" role="dialog" aria-labelledby="modalAdd" aria-hidden="true">
      <div class="modal-dialog modal-xl" style="width=100%">
        <div class="modal-content">
          <div class="modal-header">
            <button type="button" class="close" data-dismiss="modal" aria-hidden="true">
              &times;
            </button>
            <h4 class="modal-title" id="modalAdd">List Data</h4>
          </div>
          <div class="modal-body">
            <form class="form-horizontal form_penyerian">
              {{ csrf_field() }}
              <div class="jarviswidget jarviswidget-color-orange" id="wid-id-3" data-widget-editbutton="false">
                <header>
                  <span class="widget-icon"> <i class="fa fa-table"></i> </span>
                  <h2>List Data</h2>
                </header>
                <div>
                  <div class="widget-body no-padding table_data">
                  </div>
                </div>
              </div>
            </form>
            </div>
          </div>
        </div>
      </div>
    </div>
  @endsection

  @section('script')
  <script>

  var proses_now  = '';
  var tag         = '{{$tag}}';
  var table       = $('#'+tag+'-table').DataTable({
    processing: true,
    serverSide: true,
    ajax: "{{ route('skb_masuk.api') }}",
    order:[0,'desc'],
    columns: [
      {data: 'skb_id', name: 'skb_id'},
      {data: 'skk_id', name: 'skk_id'},
      {data: 'no_surat_jalan', name: 'no_surat_jalan'},
      {data: 'so_id', name: 'so_id'},
      {data: 'art_id', name: 'art_id'},
      {data: 'nama_cmt', name: 'nama_cmt'},
      {data: 'nama_proses', name: 'nama_proses'},
      {data: 'status', name: 'status'},
      {data: 'qty', name: 'qty'},
      {data: 'ket', name: 'ket'},
      {data: 'action', name: 'action'},
    ]
  });

  function addRow() {
    var detailLine = $('#detail .detailLine').eq(0).html();
    $('#detail .detailLine').last().after('<div class="detailLine form-group">'+detailLine+'</div>');
    $('[name="btnAddSKB[]"]').last().on('click', function (e) {
      $('#modalAdd').modal('toggle');
    });
    $('[name="btnAddSKB[]"]').last().attr('so_art_btn_add','');
    $('[name="btnAddSKB[]"]').last().attr('disabled',false);
    runRibuan();
    runDecimal();
  }

  function addtoSKB(){
    $('[name="btnAddtoSKB[]"').on('click',function(){
      var self = $(this);
      var so_art_pre = self.attr('so_art_pre');
      var data = $('[so_art_pre='+so_art_pre+']').serializeArray();
      $('[so_art_pre='+so_art_pre+']').hide();
      for(var i=0;i<data.length;i++){
        $('[name="no_skb[]"]').last().val(data[0].value);
        $('[name="tanggal_keluar[]"]').last().val(data[1].value);
        $('[name="so_id[]"]').last().val(data[2].value);
        $('[name="art_id[]"]').last().val(data[3].value);
        $('[name="kode_barang[]"]').last().val(data[4].value);
        $('[name="nama_barang[]"]').last().val(data[5].value);
        $('[name="qty_keluar[]"]').last().val(data[6].value);
        $('[name="btnAddSKB[]"]').last().attr('so_art_btn_add',so_art_pre);
      }
      if(data.length){
        $('#modalAdd').modal('toggle');
      }
      addRow();
      $('[so_art_btn_add='+so_art_pre+']').attr('disabled',true);
      // console.log(data);
    });
  }

  function get_detail_skb(){
    var no_surat_jalan = $('#no_surat_jalan').val();
    var cmt_id = $('#cmt_id').val();
    var append = '';
    if (no_surat_jalan == '') {
      return myswal('w','Belum Mengisi No Surat Jalan!','w',1500);;
    } 
    if (cmt_id == null) {
      return myswal('w','Belum Memilih CMT!','w',1500);;
    } 
      url = "{{ route('get_skb_detail.get') }}";
      $.ajax({
        url : url,
        type : "POST",
        data : {cmt_id:cmt_id},
        success : function(data) {
            append += '<table id="datatable_tabletools" class="table table-striped table-bordered table-hover" width="100%">';
            append += '<thead width="100%"><tr>';
            append += '<th width="2%">Add</th>';
            append += '<th width="10%">No SKB Keluar</th>';
            append += '<th width="10%">Tanggal Keluar</th>';
            append += '<th width="7%">No. SO</th>';
            append += '<th width="7%">Art</th>';
            append += '<th width="15%">Kode Barang</th>';
            append += '<th width="15%">Nama Barang</th>';
            append += '<th width="10%">Qty SKB Keluar</th>';
            append += '<th width="10%">Qty Sisa</th>';
            append += '</tr></thead>';
            append += '<tbody name="list_art" width="100%">';
          for (var i = 0; i < data.length; i++) {
            var disabled='';
            var readonly='';
            var qty_sisa=(data[i].qty_sisa != null)? parseInt(data[i].qty_sisa):0;
            if(data.length){
              disabled = 'disabled';
              readonly = 'readonly';
            }
            append += '<tr so_art_pre="'+data[i].so_id+'-'+data[i].art_id+'">';
            append += '<td><button type="button" class="btn btn-success pull-left" name="btnAddtoSKB[]" so_art_pre="'+data[i].so_id+'-'+data[i].art_id+'"><i class="fa fa-plus"></i></button></td>';
            append += '<td><input type="text" class="form-control" name="no_skb_keluar_pre[]" value="'+data[i].id+'" '+readonly+' so_art_pre="'+data[i].so_id+'-'+data[i].art_id+'"></td>';
            append += '<td><input type="text" class="form-control" name="tanggal_keluar_pre[]" value="'+data[i].tanggal_keluar+'" '+readonly+' so_art_pre="'+data[i].so_id+'-'+data[i].art_id+'"></td>';
            append += '<td><input type="text" class="form-control" name="so_pre[]" value="'+data[i].so_id+'" '+readonly+' so_art_pre="'+data[i].so_id+'-'+data[i].art_id+'"></td>';
            append += '<td><input type="text" class="form-control" name="art_pre[]" value="'+data[i].art_id+'" '+readonly+' so_art_pre="'+data[i].so_id+'-'+data[i].art_id+'"></td>';
            append += '<td><input type="text" class="form-control" name="barang_jadi_id_pre[]" value="'+data[i].barang_jadi_id+'" '+readonly+' so_art_pre="'+data[i].so_id+'-'+data[i].art_id+'"></td>';
            append += '<td><input type="text" class="form-control" name="nama_produk_pre[]" value="'+data[i].nama_produk+'" '+readonly+' so_art_pre="'+data[i].so_id+'-'+data[i].art_id+'"></td>';
            append += '<td><input type="text" class="form-control" name="qty_keluar_pre[]" value="'+parseInt(data[i].qty)+'" '+readonly+' so_art_pre="'+data[i].so_id+'-'+data[i].art_id+'"></td>';
            append += '<td><input type="text" class="form-control" name="qty_sisa_pre[]" value="'+qty_sisa+'" '+readonly+' so_art_pre="'+data[i].so_id+'-'+data[i].art_id+'"></td>';
            append += '</tr>';
          }
          append += '</tbody></table>';
          $('.table_data').html('');
          $('.table_data').append(append);
          addtoSKB();
          runRibuan();
          runDecimal();
        },
        error : function(data){
          myswal('e',data.message,'e',1500);
        }
      });
      return false;
     }


  $(function () {
    runselect2one();
    runRibuan();
    $('#btnReset').on('click', function (e) {
      resetForm();
    });
    $('[name="btnAddSKB[]"]').on('click', function (e) {
      $('#modalAdd').modal('toggle');
    });
    $('#cmt_id').on('change', function(e){
      get_detail_skb();
    });
    $('#formAdd').validator().on('submit', function (e) {
      $('input[name=_method]').val('POST');
      if (!e.isDefaultPrevented()){
        var id = $('#id').val();
        url = "{{ route('skb_masuk.create') }}";

        $.ajax({
          url : url,
          type : "POST",
          data : $('#formAdd').serialize(),
          success : function(data) {
            runselect2one();
            if (data.status == true) {
              resetForm();
              table.ajax.reload();
              myswal('s',data.message,'s',1500);
              $('[name=id]').val(data.newid);
            } else {
              myswal('e',data.message,'e',1500);
              $('[name=id]').val(id);
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

  //Fungsi select2 1x run for this page
  function runselect2one() {
    $('#cmt_id').select2({
    ajax: {
      url: baseurl+'/get_cmt',
      delay:250,
      data: function (params) {
        var query = {
          search: params.term,
          type: 'public',
        }
        return query;
      },
      processResults: function (data) {
        return {
          results: data
        };
      }
    }
  });
  }

  //Fungsi Reset Data form
  function resetForm() {
    $('#formAdd')[0].reset();
    $('#cmt_id').select2("val", "");
    $('.itemLine input').val('');
    $('.detailLine').not(':eq(0)').remove();
    $('[name="btnAddSKB[]"]').attr('disabled',false);
  }

  // Fungsi post to Stock
  function postToStock(so_id,art_id,qty,skb_id) {
    sendajax('POST','/post_to_stock',{so_id:so_id,art_id:art_id,qty:qty,skb_id:skb_id}).done(function(rs) {
      myswal('success',rs.message,'s',1500);
      table.ajax.reload();
    });
  }
  </script>
  @endsection
