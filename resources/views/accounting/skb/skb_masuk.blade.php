@extends('layouts.app')

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
                      <label for="id" class="col-md-2 control-label">No SKK</label>
                      <div class="col-md-2">
                        <select name="skb_id" style="width:100%;" value="" required></select>
                      </div>
                      <div class="col-md-2 pull-right ">
                        <div class="input-group">
                          <input type="text" name="tanggal" placeholder="Pilih tanggal" class="form-control datepicker" data-dateformat="dd/mm/yy" value="{{ $tanggal }}">
                          <span class="input-group-addon"><i class="fa fa-calendar"></i></span>
                        </div>
                      </div>
                    </div>
                    <div class="form-group">
                      <label for="" class="col-md-2 control-label">SKB Keluar</label>
                      <div class="col-md-2">
                        <input type="text" id="skk" name="skk" class="form-control" value="" readonly>
                      </div>
                      <label for="" class="col-md-1 control-label">Proses</label>
                      <div class="col-md-2">
                        <input type="text" id="proses" name="proses" class="form-control" value="" readonly>
                      </div>
                      <label for="" class="col-md-1 control-label">CMT</label>
                      <div class="col-md-4">
                        <input type="hidden" id="cmt_id" name="cmt_id" class="form-control" value="" readonly>
                        <input type="text" id="cmt" name="cmt" class="form-control" value="" readonly>
                      </div>
                    </div>
                    <fieldset>
                      <legend>Details {{ $title }}</legend>
                      <div class="form-group">
                        <div class="col-md-1">
                          <label class="control-label">No SO</label>
                        </div>
                        <div class="col-md-1">
                          <label class="control-label">No Art</label>
                        </div>
                        <div class="col-md-2">
                          <label class="control-label">Nama</label>
                        </div>
                        <div class="col-md-1">
                          <label class="control-label">Qty Out</label>
                        </div>
                        <div class="col-md-1">
                          <label class="control-label">Qty In</label>
                        </div>
                        <div class="col-md-1">
                          <label class="control-label">Satuan</label>
                        </div>
                        <div class="col-md-1">
                          <label class="control-label">Harga</label>
                        </div>
                        <div class="col-md-2">
                          <label class="control-label">Total</label>
                        </div>
                        <div class="col-md-2">
                          <label class="control-label">Keterangan</label>
                        </div>
                      </div>
                      <div id="detail">
                        <div class="detailLine form-group">
                          <div class="itemLine col-md-1">
                            <input type="text" name="so[]" class="form-control" value="" readonly>
                          </div>
                          <div class="itemLine col-md-1">
                            <input type="text" name="art[]" class="form-control" value="" readonly>
                          </div>
                          <div class="itemLine col-md-2">
                            <input name="nama[]" type="text" class="form-control" readonly>
                          </div>
                          <div class="itemLine col-md-1">
                            <input name="qty_out[]" type="decimal" class="form-control ribuan" value="" readonly>
                          </div>
                          <div class="itemLine col-md-1">
                            <input name="qty_in[]" type="decimal" class="form-control ribuan calc" value="" readonly>
                          </div>
                          <div class="itemLine col-md-1">
                            <input name="satuan[]" type="decimal" class="form-control ribuan" value="" readonly>
                          </div>
                          <div class="itemLine col-md-1">
                            <input name="harga[]" type="decimal" class="form-control ribuan calc" value="">
                          </div>
                          <div class="itemLine col-md-2">
                            <input name="total[]" type="decimal" class="form-control ribuan calc" value="" readonly>
                          </div>
                          <div class="itemLine col-md-2">
                            <input name="ket[]" type="text" class="form-control" value="" readonly>
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
              <th>No. SKK</th>
              <th>No. SO</th>
              <th>No. Art</th>
              <th>CMT</th>
              <th>Proses</th>
              <th>Status</th>
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
@endsection

@section('script')
<script>

var proses_now  = '';
var tag         = '{{$tag}}';
var table       = $('#'+tag+'-table').DataTable({
  processing: true,
  serverSide: true,
  ajax: "{{ route('skb_keluar.api') }}",
  columns: [
    {data: 'skb_id', name: 'skb_id'},
    {data: 'so_id', name: 'so_id'},
    {data: 'art_id', name: 'art_id'},
    {data: 'nama_cmt', name: 'nama_cmt'},
    {data: 'nama_proses', name: 'nama_proses'},
    {data: 'status', name: 'status'},
    {data: 'ket', name: 'ket'},
    {data: 'action', name: 'action'},
  ]
});

$(function () {
  hitungTotal();
  runselect2one();

  $('[name=skb_id]').on('change', function () {
       $('[name="harga[]"]').eq(0).prop('disabled',false);
       $('[name="total[]"]').val('');
       var id = $(this).val();
       url = "{{ route('detail_skb_masuk_finance.get') }}";
       $.ajax({
         url : url,
         type : "POST",
         data : {id:id},
         success : function(data) {
           $('.calc[name="harga[]"]').val('');
           $('#skk').val(data.skk[0]['id']);
           $('#proses').val(data.skm[0]['nama_proses']);
           $('#cmt').val(data.skm[0]['nama_cmt']);
           $('#cmt_id').val(data.skm[0]['cmt_id']);
           $('.detailLine').not(':eq(0)').remove();
           var detailLine = $('#detail .detailLine').eq(0).html();
           $('[name="so[]"]').eq(0).val(data.skm[0]['so_id']);
           $('[name="art[]"]').eq(0).val(data.skm[0]['art_id']);
           $('[name="nama[]"]').eq(0).val(data.skm[0]['nama_produk']);
           $('[name="qty_out[]"]').eq(0).val(data.skk[0]['qty']);
           $('[name="qty_in[]"]').eq(0).val(data.skm[0]['qty']);
           $('[name="satuan[]"]').eq(0).val('PCS');
           $('[name="ket[]"]').eq(0).val(data.skm[0]['ket']);
           if (data.skm[0]['harga'] !== null) {
             $('[name="harga[]"]').eq(0).val(data.skm[0]['harga']);
             $('[name="total[]"]').eq(0).val(data.skm[0]['total_item']);
             $('[name="harga[]"]').eq(0).prop('disabled',true);
           }
           for (var i = 1; i < data.skm.length; i++) {
             $('#detail .detailLine').last().after('<div class="detailLine form-group">'+detailLine+'</div>');
             $('[name="so[]"]').eq(i).val(data.skm[i]['so_id']);
             $('[name="art[]"]').eq(i).val(data.skm[i]['art_id']);
             $('[name="nama[]"]').eq(i).val(data.skm[i]['nama_produk']);
             $('[name="qty_out[]"]').eq(i).val(data.skk[i]['qty']);
             $('[name="qty_in[]"]').eq(i).val(data.skm[i]['qty']);
             $('[name="satuan[]"]').eq(i).val('PCS');
             $('[name="ket[]"]').eq(i).val(data.skm[i]['ket']);
             if (data.skm[i]['harga'] !== null) {
               $('[name="harga[]"]').eq(i).val(data.skm[i]['harga']);
               $('[name="total[]"]').eq(i).val(data.skm[i]['total_item']);
               $('[name="harga[]"]').eq(i).prop('disabled',true);
             }
           }
           hitungTotal();
         },
         error : function(data){
           $('.calc[name="harga[]"]').val('');
           myswal('e',data.message,'e',1500);
         }
       });
       return false;
  });

  $('#formAdd').validator().on('submit', function (e) {
    $('input[name=_method]').val('POST');
    if (!e.isDefaultPrevented()){
      var id = $('#id').val();
      url = "{{ route('skb_masuk_finance.create') }}";

      $.ajax({
        url : url,
        type : "POST",
        data : $('#formAdd').serialize(),
        success : function(data) {
          if (data.status == true) {
            myswal('s',data.message,'s',1500);
            resetForm();
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

//Hitung Total
function hitungTotal() {
  $('#detail').on('keyup','.calc',function() {
    var self  = $(this);
    var qty   = self.parents('.detailLine').find('.calc[name="qty_in[]"]');
    var price = self.parents('.detailLine').find('.calc[name="harga[]"]');
    var total = self.parents('.detailLine').find('.calc[name="total[]"]');
    var total_price = decimal(parseFloat((ribuantodb(qty.val())*ribuantodb(price.val()))));
    var total_item = parseFloat(ribuantodb(total_price));
    total.val(decimal(total_item));
  }
);
}

//Fungsi select2 1x run for this page
function runselect2one() {
  $('[name="skb_id"]').select2({
    ajax: {
      url: baseurl+'/get_skb_masuk_finance',
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
  $('.select2').val('').change();
  $('.detailLine').not(':eq(0)').remove();
}

</script>
@endsection
