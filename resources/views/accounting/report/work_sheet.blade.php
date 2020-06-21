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
                    <th rowspan="2" class="thMain">KODE</th>
                    <th rowspan="2" class="thMain">AKUN</th>
                    <th rowspan="2" class="thMain">NAMA PERKIRAAN</th>
                    <th colspan="2" class="saldoDebitCredit">NERACA SALDO</th>
                    <th colspan="2" class="saldoDebitCredit">JURNAL PENYESUAIAN</th>
                    <th colspan="2" class="saldoDebitCredit">NERACA SETELAH DISESUAIKAN</th>
                    <th colspan="2" class="saldoDebitCredit">IKHTISAR LABA RUGI</th>
                    <th colspan="2" class="saldoDebitCredit">NERACA</th>
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

@endsection

@section('script')
<script>
var tag   = '{{ $tag }}';
var datenow = '{{ $tanggal }}';

$(function () {
  runSelect2Accounting()
  $('#bulan').val(datenow.substr(3,2));
  $('#tahun').val(datenow.substr(8,2));
  var table = $('#'+tag+'-table').DataTable({
    lengthMenu: [[20, 50, 100, -1], [20, 50, 100, "All"]],
    processing: true,
    serverSide: true,
    ajax: {
      url: "{{ route('work_sheet.api') }}",
      data: function (d) {
        d.bulan = $('#bulan').val(),
        d.tahun = $('#tahun').val();
      }
    },
    columns: [
      {data: 'id', name: 'id'},
      {data: 'category', name: 'category'},
      {data: 'nama_akun', name: 'nama_akun'},
      {data: 'debit', name: 'debit'},
      {data: 'kredit', name: 'kredit'},
      {data: 'dumy', name: 'dumy'},
      {data: 'dumy', name: 'dumy'},
      {data: 'dumy', name: 'dumy'},
      {data: 'dumy', name: 'dumy'},
      {data: 'laba_rugi_debit', name: 'laba_rugi_debit'},
      {data: 'laba_rugi_credit', name: 'laba_rugi_credit'},
      {data: 'neraca_debit', name: 'neraca_debit'},
      {data: 'neraca_credit', name: 'neraca_credit'},
    ]
  });

  $('#bulan,#tahun').on('change', function (e) {
    table.ajax.reload();
  });

  $('#export').on('click', function (e) {
    var bulan = $('#bulan').val();
    var tahun = $('#tahun').val();
    exportExcel(bulan, tahun);
  });

});

function exportExcel(bulan, tahun, id_akun) {
  var url = "{{ route('export.neraca_saldo') }}";
  var data = {
    bulan   : bulan,
    tahun   : tahun,
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
