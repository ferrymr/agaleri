@extends('layouts.app')

@section('style')
<style>
  .saldoDebitCredit {
    text-align: center;
  }
  .thMain {
    vertical-align: middle !important;
    text-align: center;
  }
  #id_akun_tujuan {

  }
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
                    <label class="col-md-1 control-label">Tahun</label>
                    <div class="itemLine col-md-2">
                      <select style="width:100%" id="year" name="year" class="form-control" required="">
                        @foreach($year as $i => $t)
                        <option value="{{ $i }}">{{ $t }}</option>
                        @endforeach
                      </select>
                    </select>
                  </div>
                  <div class="itemLine col-md-1">
                    <button type="button" id="export" class="btn btn-success">Export</button>
                  </div>
                </div>
              </fieldset>
            </form>
          </div>
        </div>
      </div>
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
            <div class="panel-body table-responsive"  >
              <table id="{{$tag}}-table" class="table table-striped table-bordered" style="width: 100%;">
                <thead>
                  <tr>
                    <th rowspan="2" class="thMain">ID</th>
                    <th rowspan="2" class="thMain">Category</th>
                    <th rowspan="2" class="thMain">Nama Akun</th>
                    <th colspan="2" class="saldoDebitCredit">Januari</th>
                    <th colspan="2" class="saldoDebitCredit">Februari</th>
                    <th colspan="2" class="saldoDebitCredit">Maret</th>
                    <th colspan="2" class="saldoDebitCredit">April</th>
                    <th colspan="2" class="saldoDebitCredit">Mei</th>
                    <th colspan="2" class="saldoDebitCredit">Juni</th>
                    <th colspan="2" class="saldoDebitCredit">Juli</th>
                    <th colspan="2" class="saldoDebitCredit">Agustus</th>
                    <th colspan="2" class="saldoDebitCredit">September</th>
                    <th colspan="2" class="saldoDebitCredit">Oktober</th>
                    <th colspan="2" class="saldoDebitCredit">November <span class="widget-icon edit_saldo" value="11"><i class="fa fa-edit"></i></span></th>
                    <th colspan="2" class="saldoDebitCredit">Desember </th>
                  </tr>
                  <tr>
                    <th class="saldoDebitCredit">Debit</th>
                    <th class="saldoDebitCredit">Credit</th>
                    <th class="saldoDebitCredit">Debit</th>
                    <th class="saldoDebitCredit">Credit</th>
                    <th class="saldoDebitCredit">Debit</th>
                    <th class="saldoDebitCredit">Credit</th>
                    <th class="saldoDebitCredit">Debit</th>
                    <th class="saldoDebitCredit">Credit</th>
                    <th class="saldoDebitCredit">Debit</th>
                    <th class="saldoDebitCredit">Credit</th>
                    <th class="saldoDebitCredit">Debit</th>
                    <th class="saldoDebitCredit">Credit</th>
                    <th class="saldoDebitCredit">Debit</th>
                    <th class="saldoDebitCredit">Credit</th>
                    <th class="saldoDebitCredit">Debit</th>
                    <th class="saldoDebitCredit">Credit</th>
                    <th class="saldoDebitCredit">Debit</th>
                    <th class="saldoDebitCredit">Credit</th>
                    <th class="saldoDebitCredit">Debit</th>
                    <th class="saldoDebitCredit">Credit</th>
                    <th class="saldoDebitCredit">Debit</th>
                    <th class="saldoDebitCredit">Credit</th>
                    <th class="saldoDebitCredit">Debit</th>
                    <th class="saldoDebitCredit">Credit</th>
                  </tr>
                </thead>
                <tbody>
                </tbody>
              </table>
            </div>
            </table>
          </div>
        </div>
      </div>
    </article>
  </div>
</section>
</div>
<div class="modal" id="modalEdit" role="dialog" aria-hidden="true" data-backdrop="static">
  <div class="modal-dialog modal-lg">
    <div class="modal-content">
      <form id="formInsert" method="post" class="form-horizontal" data-toggle="validator" enctype="multipart/form-data">
        {{ csrf_field() }} {{ method_field('POST') }}
        <div class="modal-header" style="background-color:#2C3742;color:white;">
          <button type="button" class="close" data-dismiss="modal" aria-label="Close">
            <span aria-hidden="true"> &times; </span>
          </button>
          <h3 class="modal-title"> Insert Saldo</h3>
        </div>

        <div class="modal-body">
          <input type="hidden" id="month" value="">
          <div class="form-group">
            <label class="col-md-2 control-label">Akun</label>
            <div class="col-md-4">
              <select style="width:100%" id="id_akun_tujuan" name="id_akun_tujuan" class="form-control" required=""></select>
            </div>
            <label class="col-md-2 control-label">ID : <span id="id_akun"></span></label>
          </div>
          <div class="form-group">
            <label for="name_edit" class="col-md-2 control-label">Debit</label>
            <div class="col-md-6">
              <input type="text" id="debit" name="debit" class="form-control">
              <span class="help-block with-errors"></span>
            </div>
          </div>
          <div class="form-group">
            <label for="name_edit" class="col-md-2 control-label">Credit</label>
            <div class="col-md-6">
              <input type="text" id="credit" name="credit" class="form-control">
              <span class="help-block with-errors"></span>
            </div>
          </div>
          <div class="form-group">
            <label for="name_edit" class="col-md-2 control-label">Saldo</label>
            <div class="col-md-6">
              <input type="text" id="saldo" name="saldo" class="form-control">
              <span class="help-block with-errors"></span>
            </div>
          </div>

        </div>

        <div class="modal-footer">
          <button type="button" class="btn btn-primary btn-save btn_insert"><i class="fa fa-send"></i> Insert</button>
          <button type="button" class="btn btn-default" data-dismiss="modal"><i class="fa fa-refresh"></i> Keluar</button>
        </div>

      </form>
    </div>
  </div>
</div>
@endsection

@section('script')
<script>
var tag   = '{{ $tag }}';
var datenow = '{{ $tanggal }}';

$(function () {
  runSelect2Accounting()
  $('#year').val(datenow.substr(8,2));
  var table = $('#'+tag+'-table').DataTable({
    lengthMenu: [[20, 50, 100, -1], [20, 50, 100, "All"]],
    processing: true,
    serverSide: true,
    ajax: {
      url: "{{ route('master_neraca_saldo.api') }}",
      data: function (d) {
        d.year = '20'+$('#year').val();
      }
    },
    columns: [
      {data: 'id', name: 'id'},
      {data: 'category', name: 'category'},
      {data: 'name', name: 'name'},
      {data: 'debit1', name: 'debit1'},
      {data: 'credit1', name: 'credit1'},
      {data: 'debit2', name: 'debit2'},
      {data: 'credit2', name: 'credit2'},
      {data: 'debit3', name: 'debit3'},
      {data: 'credit3', name: 'credit3'},
      {data: 'debit4', name: 'debit4'},
      {data: 'credit4', name: 'credit4'},
      {data: 'debit5', name: 'debit5'},
      {data: 'credit5', name: 'credit5'},
      {data: 'debit6', name: 'debit6'},
      {data: 'credit6', name: 'credit6'},
      {data: 'debit7', name: 'debit7'},
      {data: 'credit7', name: 'credit7'},
      {data: 'debit8', name: 'debit8'},
      {data: 'credit8', name: 'credit8'},
      {data: 'debit9', name: 'debit9'},
      {data: 'credit9', name: 'credit9'},
      {data: 'debit10', name: 'debit10'},
      {data: 'credit10', name: 'credit10'},
      {data: 'debit11', name: 'debit11'},
      {data: 'credit11', name: 'credit11'},
      {data: 'debit12', name: 'debit12'},
      {data: 'credit12', name: 'credit12'},
    ]
  });

  $('#id_akun_tujuan').on('change', function (e) {
    $('#id_akun').text($(this).val());
  });

  $('.btn_insert').on('click', function (e) {
    var id = $('#id_akun_tujuan').val();
    var month = $('#month').val();
    var year = $('#year').val();
    var debit = $('#debit').val();
    var credit = $('#credit').val();
    var saldo = $('#saldo').val();
    console.log(id,month,year,debit,credit,saldo);
    insertSaldo(id,month,year,debit,credit,saldo);
  });

  $('#export').on('click', function (e) {
    var year = $('#year').val();
    exportExcel(year);
  });

  $('.edit_saldo').on('click', function (e) {
    $('#modalEdit').modal('toggle');
    $('#month').val($(this).attr('value'));
  });

  $('[name="id_akun_tujuan"]').select2({
    ajax: {
      url: baseurl+'/get_akun',
      delay:250,
      data: function (params) {
        var query = {
          search: params.term,
          type: 'public',
          category: 'asset',
          level: '4',
          type: 'all'
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

});

function insertSaldo(id, month, year, debit, credit, saldo) {
  var url = "{{ route('insert.neraca_saldo') }}";
  var data = {
    id      : id,
    month   : month,
    year    : year,
    debit   : debit,
    credit  : credit,
    saldo   : saldo,
  };
  $.ajax({
    url : url,
    type : "POST",
    data : data,
    success: function (rsp) {
      myswal('s',data.message,'s',1500);
      resetForm()
      console.log(rsp);
    },
    error : function(data){
      myswal('e',data.message,'e',1500);
    }
  });
}

//Fungsi Reset Data form
function resetForm() {
  $('#formInsert')[0].reset();
  $('.select2').val('').change();
  $('#debit').text('0');
  $('#credit').text('0');
  $('#saldo').text('0');
}

function exportExcel(year, id_akun) {
  var url = "{{ route('master_export.neraca_saldo') }}";
  var data = {
    year   : year,
    id_akun : id_akun
  };

  $.ajax({
    url : url,
    type : "POST",
    data : data,
    success: function (response, textStatus, request) {
      var a = document.createElement("a");
      a.href = response.file;
      a.download = response.name;
      document.body.appendChild(a);
      a.click();
      a.remove();
    },
    error : function(data){
      myswal('e',data.message,'e',1500);
    }
  });
}

</script>
@endsection
