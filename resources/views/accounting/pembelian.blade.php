@extends('layouts.app')

@section('style')
<style media="screen">
  label input[type=radio].radiobox+span{
    z-index:unset !important;
  }
  .btn-create {
    margin-top: 10px;
    right: 0px;
  }
</style>
@endsection

@section('content')
<div id="main" class="utama_panel"role="main">
  <div id="content">
    <div class="row">
      <div class="col-xs-12 col-sm-7 col-md-10 col-lg-10">
        <h1 class="page-title txt-color-blueDark"><i class="fa fa-desktop fa-fw "></i>
          {{ $title }}
        </h1>
      </div>
      <div class="col-xs-12 col-sm-7 col-md-7 col-lg-2">
        <div class="dropdown pull-right">
          <button class="btn btn-primary dropdown-toggle btn-create" type="button" data-toggle="dropdown">Buat Pembelian
            <span class="caret"></span>
            </button>
            <ul class="dropdown-menu">
              <li><a href="{{ url('/pembelian_bb') }}"> Bahan Baku</a></li>
              <li><a href="{{ url('/pembelian_acc') }}"> Accessoris</a></li>
              <li><a href="{{ url('/pembelian_bj') }}"> Barang Jadi</a></li>
            </ul>
          </div>
        </div>
      </div>
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
                  <th>No. Pembelian</th>
                  <th>Tanggal</th>
                  <th>No. Faktur</th>
                  <th>Tanggal Faktur</th>
                  <th>Nama Supplier</th>
                  <th>Nilai Faktur</th>
                  <th>Action</th>
                </tr>
              </thead>
              <tbody>
              </tbody>
            </table>
          </div>
        </div>
      </div>
      <div class="row">
        <div class="col-xs-12 col-sm-7 col-md-7 col-lg-4">
          <h1 class="page-title txt-color-blueDark"><i class="fa fa-desktop fa-fw "></i>
            {{ $title2 }}
          </h1>
        </div>
      </div>
      <div class="jarviswidget jarviswidget-color-orange" id="wid-id-4" data-widget-editbutton="false">
        <header>
          <span class="widget-icon"> <i class="fa fa-table"></i> </span>
          <h2>List Data</h2>
        </header>
        <div>
          <div class="widget-body">
            <table id="{{$tag2}}-table" class="table table-striped table-bordered table-hover" width="100%">
              <thead>
                <tr>
                  <th>No. Pembelian</th>
                  <th>Tanggal</th>
                  <th>No. Faktur</th>
                  <th>Tanggal Faktur</th>
                  <th>Nama Supplier</th>
                  <th>Nilai Faktur</th>
                  <th>Action</th>
                </tr>
              </thead>
              <tbody>
              </tbody>
            </table>
          </div>
        </div>
      </div>
      <div class="row">
        <div class="col-xs-12 col-sm-7 col-md-7 col-lg-4">
          <h1 class="page-title txt-color-blueDark"><i class="fa fa-desktop fa-fw "></i>
            {{ $title3 }}
          </h1>
        </div>
      </div>
      <div class="jarviswidget jarviswidget-color-orange" id="wid-id-5" data-widget-editbutton="false">
        <header>
          <span class="widget-icon"> <i class="fa fa-table"></i> </span>
          <h2>List Data</h2>
        </header>
        <div>
          <div class="widget-body">
            <table id="{{$tag3}}-table" class="table table-striped table-bordered table-hover" width="100%">
              <thead>
                <tr>
                  <th>No. Pembelian</th>
                  <th>Tanggal</th>
                  <th>No. Faktur</th>
                  <th>Tanggal Faktur</th>
                  <th>Nama Supplier</th>
                  <th>Nilai Faktur</th>
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
  ajax: "{{ route('pembelian_bb.api') }}",
  order: [0,'desc'],
  columns: [
    {data: 'id', name: 'id'},
    {data: 'tanggal', name: 'tanggal'},
    {data: 'id_faktur', name: 'id_faktur'},
    {data: 'tgl_faktur', name: 'tgl_faktur'},
    {data: 'nama_supplier', name: 'nama_supplier'},
    {data: 'total_trans', name: 'total_trans'},
    {data: 'action', name: 'action'},
  ]
});

var tag2   = '{{$tag2}}';
var table2 = $('#'+tag2+'-table').DataTable({
  processing: true,
  serverSide: true,
  ajax: "{{ route('pembelian_acc.api') }}",
  order: [0,'desc'],
  columns: [
    {data: 'id', name: 'id'},
    {data: 'tanggal', name: 'tanggal'},
    {data: 'id_faktur', name: 'id_faktur'},
    {data: 'tgl_faktur', name: 'tgl_faktur'},
    {data: 'nama_supplier', name: 'nama_supplier'},
    {data: 'total_trans', name: 'total_trans'},
    {data: 'action', name: 'action'},
  ]
});

var tag3   = '{{$tag3}}';
var table3 = $('#'+tag3+'-table').DataTable({
  processing: true,
  serverSide: true,
  ajax: "{{ route('pembelian_bj.api') }}",
  order: [0,'desc'],
  columns: [
    {data: 'id', name: 'id'},
    {data: 'tanggal', name: 'tanggal'},
    {data: 'id_faktur', name: 'id_faktur'},
    {data: 'tgl_faktur', name: 'tgl_faktur'},
    {data: 'nama_supplier', name: 'nama_supplier'},
    {data: 'total_trans', name: 'total_trans'},
    {data: 'action', name: 'action'},
  ]
});

setkg($('[name="id_satuan[]"]'));
select2Run();
function select2Run() {

  $('[name="id_acc[]"]').select2({
    ajax: {
      url: baseurl+'/get_acc',
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

  $('[name="id_brand[]"]').select2({
    ajax: {
      url: baseurl+'/get_brand',
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

  $('[name="id_supplier[]"],#id_supplier').select2({
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

  $('[name="id_satuan[]"]').select2({
    ajax: {
      url: baseurl+'/get_satuan',
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

$(function(){

  $('#btnReset').on('click', function (e) {
    resetForm();
  });

  $('#formAdd').validator().on('submit', function (e) {
    $('input[name=_method]').val('POST');
    if (!e.isDefaultPrevented()){
      var id = $('#id').val();
      url = "{{ url('pembelian_acc') }}";

      $.ajax({
        url : url,
        type : "POST",
        data : $('#formAdd').serialize(),
        success : function(data) {
          resetForm();
          table.ajax.reload();
          if (data.status == true) {
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

  $('#btnAddLine').on('click',function (e) {
    addRow();
    e.preventDefault();
  });

  $('#detail').on('keyup','input[name="qty[]"]:last', function (e) {
    // addRow();
    e.preventDefault();
  });

  $('#id_supplier').on('change',function(e) {
    $('.detailLine').not(':eq(0)').remove();
    clearSelect2Detail();
  });

  $('#detail').on('change','select', function (e) {
    var self = $(this);
    var kode_acc = self.parents('.detailLine').find('[name="kode_acc[]"]');
    var harga = self.parents('.detailLine').find('[name="harga[]"]');
    var id_acc = self.parents('.detailLine').find('select[name="id_acc[]"]').val();
    var id_brand = self.parents('.detailLine').find('[name="id_brand[]"]').val();
    var id_brand = self.parents('.detailLine').find('[name="id_brand[]"]').val();
    var id_supplier = $('#id_supplier').val();
    if (id_acc == null) id_acc='';
    if (id_brand == null) id_brand='';
    if (id_supplier == null) id_supplier='';
    kode_acc.val(id_acc+'-'+id_brand+'-'+id_supplier+'');
    if (kode_acc.val().length > 15) {
      var id = kode_acc.val();
      url = "{{ url('get_harga_acc_default') }}";
      $.ajax({
        url : url,
        type : "POST",
        data : {id:id,_token:token},
        success : function(data) {
          if(data.length < 1){
            // harga.val(1);
          } else {
            harga.val(ribuan(data[0]['harga_default']));
          }
        },
        error : function(data){
          myswal('e',data.message,'e',1500);
        }
      });
    }

  });

  $('#detail').on('keyup','input', function (e) {
    var self = $(this);
    var qty = self.parents('.detailLine').find('[name="qty[]"]').val();
    var harga = self.parents('.detailLine').find('[name="harga[]"]').val();
    var jumlah = self.parents('.detailLine').find('[name="jumlah[]"]');
    if (qty != '' && harga != '') {
      var jumlahribuan = ribuantodb(qty)*ribuantodb(harga);
      jumlah.val(ribuan(jumlahribuan));
      var total = 0;
      $('[name="jumlah[]"]').each(function(e) {
        var jumlahtotal = ribuantodb($(this).val());
        if (jumlahtotal > 0) {
          total = parseFloat(total) + parseFloat(jumlahtotal);
        }
      });
      $('[name=total]').val(ribuan(total));
    }
  });

});

//Fungsi Reset Data form
function resetForm() {
  $('#formAdd')[0].reset();
  $('.select2').val('').change();
  $("#id_supplier").select2("val", "");
  $("[name='kode_acc[]']").val("");
  $('.detailLine').not(':eq(0)').remove();
  setkg($('[name="id_satuan[]"]'));
}

function clearSelect2Detail() {
  $('[name="qty[]"]:last,[name="harga[]"]:last,[name="jumlah[]"]:last,[name="total"]:last').val('');
  $('[name="id_acc[]"]:last,[name="id_brand[]"]:last,[name="id_brand[]"]:last,[name="id_satuan[]"]:last').select2("val", "");
}

function addRow() {
  var detailLine = $('#detail .detailLine').eq(0).html();
  $('#detail .detailLine').last().after('<div class="detailLine form-group">'+detailLine+'</div>');
  $('[name="id_acc[]"]:last,[name="id_brand[]"]:last,[name="id_brand[]"]:last,[name="id_satuan[]"]:last').next(".select2-container").hide();
  select2Run();
  clearSelect2Detail();
  setkg($('[name="id_satuan[]"]'));
  runRibuan();
  runDecimal();
}


//Fungsi View Data
function viewData(id,type) {
  window.open(baseurl+'/pembelian/view/'+type+'/'+id);
}

</script>
@endsection
