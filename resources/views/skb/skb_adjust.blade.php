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
                      <label for="id" class="col-md-2 control-label">No SKB Adjust</label>
                      <div class="col-md-2">
                        <input id="id" type="text" class="form-control" name="id" value="{{ $newid }}" readonly="">
                      </div>
                      <label for="id" class="col-md-1 control-label">Kategori : </label>
                      <div class="col-md-3">
                        <label class="radio radio-inline">
                          <input type="radio" class="radiobox" name="type" value="M" >
                          <span>Non SKB Masuk</span>
                        </label>
												<label class="radio radio-inline">
												<input type="radio" class="radiobox" name="type" value="K" checked>
												<span>Non SKB Keluar</span>
											</label>
										</div>
                      <div class="col-md-2 pull-right ">
                        <div class="input-group">
                          <input type="text" name="tanggal" placeholder="Pilih tanggal" class="form-control datepicker" data-dateformat="dd/mm/yy" value="{{ $tanggal }}">
                          <span class="input-group-addon"><i class="fa fa-calendar"></i></span>
                        </div>
                      </div>
                    </div>
                    <div class="form-group">
                      <label for="" class="col-md-2 control-label">Proses</label>
                      <div class="col-md-2">
                        <select style="width:100%" id="proses_id" name="proses_id" class="form-control" required=""></select>
                        <input type="hidden" name="proses_now" value="">
                      </div>     
                    </div>
                    <div class="form-group">
                      <label for="" class="col-md-2 control-label">CMT</label>
                      <div class="col-md-2">
                        <select style="width:100%" id="cmt_id" name="cmt_id" class="form-control" required=""></select>
                      </div>
                    </div>
                    <fieldset>
                      <legend>Details {{ $title }}</legend>
                      <div class="form-group">
                        <div class="col-md-2">
                          <label class="control-label">Status</label>
                        </div>
                        <div class="col-md-2">
                          <label class="control-label">No SKB Keluar</label>
                        </div>
                        <div class="col-md-2">
                          <label class="control-label">No SKB Adjst</label>
                        </div>
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
                          <label class="control-label">Qty</label>
                        </div>
                        <div class="col-md-1">
                          <label class="control-label">Satuan</label>
                        </div>
                        
                      </div>
                      <div id="detail">
                        <div class="detailLine form-group">
                        <div class="itemLine col-md-2">
                            <select class="form-control masuk" name="status[]" style="width:100%;">
                              <option value=""></option>
                              <option value="1">Cacat</option>
                              <option value="2">INV. CMT</option>
                              <option value="3">Keluar Perbaikan</option>
                              <option value="4">Masuk Perbaikan</option>
                            </select>
                          </div>
                          <div class="itemLine col-md-2">
                            <input name="no_skb_keluar[]" type="text" class="form-control">
                          </div>
                          <div class="itemLine col-md-2">
                            <input name="no_skb_adjust[]" type="text" class="form-control">
                          </div>
                          <div class="itemLine col-md-1">
                            <select name="so_id[]" style="width:100%;" value="" required></select>
                          </div>
                          <div class="itemLine col-md-1">
                            <select name="art_id[]" style="width:100%;" value="" required></select>
                          </div>
                          <div class="itemLine col-md-2">
                            <input name="nama[]" type="text" class="form-control" readonly>
                          </div>
                          <div class="itemLine col-md-1">
                            <input name="qty[]" type="decimal" class="form-control ribuan" value="" required>
                          </div>
                          <div class="itemLine col-md-1">
                            <select name="satuan_id[]" style="width:100%;" value="" required></select>
                          </div>
                          
                        </div>
                      </div>
                      <div class="form-group">
                        <div class="col-md-1">
                          <button id="btnAddLine" class="btn btn-primary btn-circle"><i class="glyphicon glyphicon-plus"></i></button>
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
              <th>No. SKN</th>
              <th>No. SO</th>
              <th>No. Art</th>
              <th>CMT</th>
              <th>Proses</th>
              <th>Status</th>
              <th>Qty</th>
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
  ajax: "{{ route('skb_adjust.api') }}",
  order:[0,'desc'],
  columns: [
    {data: 'skb_id', name: 'skb_id'},
    {data: 'so_id', name: 'so_id'},
    {data: 'art_id', name: 'art_id'},
    {data: 'nama_cmt', name: 'nama_cmt'},
    {data: 'nama_proses', name: 'nama_proses'},
    {data: 'status', name: 'status'},
    {data: 'qty', name: 'qty'},
    {data: 'action', name: 'action'},
  ]
});


changeSO();
function changeSO() {
  $('[name="so_id[]"]').on('change', function () {
    var id = $(this).val();
    var self = $(this);
    var name = self.parents('.detailLine').find('[name="nama[]"]');
    if (id != null) {
      sendajax('POST','/get_so_nama',{id:id})
      .done(function (r) {
        name.val(r);
      });
    }
  });
}
function switch_no(){
  $('[name="status[]"]').on('change',function () {
  var self = $(this);
  var no_skb_adjust = self.parents('.detailLine').find('[name="no_skb_adjust[]"]');
  if(self.val() == '1' || self.val() == '2' || self.val() == '3'){
    no_skb_adjust.prop('readonly',true);
  } else {
    no_skb_adjust.prop('readonly',false);
  }
});
}
function switch_type(){
  $('[name=type]').on('change',function () {
  var value = $(this).val();
  sendajax('post','/get_id_skb_adjust',{type:value}).done(function (rsp) {
    $('[name=id]').val(rsp.id);
  });

  if (value == 'M') {
    $('[name="no_skb_adjust[]"]').prop('readonly',false);
    $('[name="status[]"] option[value=3]').hide();
    $('[name="status[]"] option[value=1]').show();
    $('[name="status[]"] option[value=2]').show();
    $('[name="status[]"] option[value=4]').show();
  } else {
    $('[name="no_skb_adjust[]"]').prop('readonly',true);
    $('[name="status[]"] option[value=3]').show();
    $('[name="status[]"] option[value=1]').hide();
    $('[name="status[]"] option[value=2]').hide();
    $('[name="status[]"] option[value=4]').hide();
  }

  });
}

$(function () {
  switch_no();
  switch_type();

    $('[name="no_skb_adjust[]"]').prop('readonly',true);
    $('[name="status[]"] option[value=3]').show();
    $('[name="status[]"] option[value=1]').hide();
    $('[name="status[]"] option[value=2]').hide();
    $('[name="status[]"] option[value=4]').hide();
  runselect2one();

  setpcs($('[name="satuan_id[]"]'));
  $('#btnReset').on('click', function (e) {
    resetForm();
    switch_no();
    switch_type();
  });
  $('#formAdd').validator().on('submit', function (e) {
    $('input[name=_method]').val('POST');
    if (!e.isDefaultPrevented()){
      var id = $('#id').val();
      url = "{{ route('skb_adjust.create') }}";

      $.ajax({
        url : url,
        type : "POST",
        data : $('#formAdd').serialize(),
        success : function(data) {
          if (data.status == true) {
            myswal('s',data.message,'s',1500);
            setTimeout(function () {
                location.reload();
              }, 1500);
            // resetForm();
            // table.ajax.reload();
            // runselect2one();
            // $('[name=id]').val(data.newid);
            //   switch_no();
            //   switch_type();
          } else {
            setTimeout(function () {
                location.reload();
              }, 1500);
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
  $('#proses_id').on('change', function () {
    var data = $(this).select2('data');
    if (data.length > 0) {
      proses_now = data[0].text.substr(0,1);
      $('[name=proses_now]').val(proses_now);
    }
    changeForm();
    switch_no();
    switch_type();
  });
  $('#btnAddLine').on('click',function (e) {
    addRow();
    switch_no();
    switch_type();
    e.preventDefault();
  });
  $('#detail').on('keyup','input[name="qty[]"]:last', function (e) {
    addRow();
    switch_no();
    switch_type();
    e.preventDefault();
  });
});

//Fungsi select2 1x run for this page
function runselect2one() {
  $('[name="so_id[]"]').select2({
    ajax: {
      url: baseurl+'/get_so',
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

  $('[name="art_id[]"]').select2({
    ajax: {
      url: baseurl+'/get_art',
      delay:250,
      data: function (params) {
        var id = $(this).parents('.detailLine').find('[name="so_id[]"]').val();
        if (id == null) return myswal('w','Belum memilih SO!','w',1500);
        if (proses_now == '' || proses_now == null) return myswal('w','Belum memilih Proses!','w',1500);
        var query = {
          search: params.term,
          type: 'public',
          id:id,
          proses:proses_now,
          adjust:'y',

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

  $('#proses_id').select2({
    ajax: {
      url: baseurl+'/get_proses',
      delay:250,
      data: function (params) {
        var query = {
          search: params.term,
          type: 'public',
          modul:'skb_adjust'
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

  $('#cmt_id').select2({
    ajax: {
      url: baseurl+'/get_cmt',
      delay:250,
      data: function (params) {
        var p = $('#proses_id :selected').text();
        var query = {
          search: params.term,
          type: 'public',
          proses:p,
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
  $("#proses_id").select2("val", "");
  $('.detailLine').not(':eq(0)').remove();
  clearSelect2Detail();
}

//Fungsi Reset Data form afret change proses
function changeForm() {
  $('#cmt_id').select2("val", "");
  $('[name="so_id[]"]').select2("val", "");
  $('[name="art_id[]"]').select2("val", "");
  $('[name="satuan_id[]"]').select2("val", "");
  $('.itemLine input').val('');
  $('.detailLine').not(':eq(0)').remove();
  clearSelect2Detail();
  setpcs($('[name="satuan_id[]"]'));
}

// Fungsi bersihkan select2 detail
function clearSelect2Detail() {
  $('[name="so_id[]"]:last,[name="art_id[]"]:last,[name="satuan_id[]"]:last').select2("val", "");
}

//Fungsi tambah detail
function addRow() {
  var detailLine = $('#detail .detailLine').eq(0).html();
  $('#detail .detailLine').last().after('<div class="detailLine form-group">'+detailLine+'</div>');
  $('[name="so_id[]"]:last,[name="art_id[]"]:last,[name="satuan_id[]"]:last').next(".select2-container").hide();
  runselect2one();
  runselect2();
  clearSelect2Detail();
  runRibuan();
  runDecimal();
  changeSO();
  setpcs($('[name="satuan_id[]"]'));
}

</script>
@endsection
