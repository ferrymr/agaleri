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
                    <button type="button" id="exportIncome" class="btn btn-success">Export Income</button>
                  </div>
                  <div class="itemLine col-md-1">
                    <button type="button" id="exportExpense" class="btn btn-warning">Export Expense</button>
                  </div>
                </div>
              </fieldset>
            </form>
          </div>
        </div>
      </div>
    </article>
  </div>
  <div class="row" style="margin-bottom:30px;">
    <article class="col-sm-12 col-md-12 col-lg-12">
      <div class="jarviswidget jarviswidget-color-orange" id="wid-id-3" data-widget-editbutton="false">
        <header>
          <span class="widget-icon"> <i class="fa fa-table"></i> </span>
          <h2>List Data Pemasukan</h2>
        </header>
        <div>
          <div class="widget-body">
            <table id="{{$tag}}-income-table" class="table table-striped table-bordered table-hover" width="100%">
              <thead>
                <tr>
                  <th data-hide="phone">Kode Akun</th>
                  <th data-hide="phone">Nama Akun</th>
                  <th data-class="expand">Nilai</th>
                </tr>
              </thead>
              <tbody>
              </tbody>
            </table>
          </div>
        </div>
      </div>
    </article>
    <div class="pull-right">
      <article class="col-sm-12 col-md-12 col-lg-12">
        <span><strong>Total Pemasukan</strong> : Rp. <span id="income">0,00</span></span>
      </article>
    </div>
  </div>

  <div class="row" style="margin-bottom:50px;">
    <article class="col-sm-12 col-md-12 col-lg-12">
      <div class="jarviswidget jarviswidget-color-orange" id="wid-id-3" data-widget-editbutton="false">
        <header>
          <span class="widget-icon"> <i class="fa fa-table"></i> </span>
          <h2>List Data Pengeluaran</h2>
        </header>
        <div>
          <div class="widget-body">
            <table id="{{$tag}}-expense-table" class="table table-striped table-bordered table-hover" width="100%">
              <thead>
                <tr>
                  <th data-hide="phone">Kode Akun</th>
                  <th data-hide="phone">Nama Akun</th>
                  <th data-class="expand">Nilai</th>
                </tr>
              </thead>
              <tbody>
              </tbody>
            </table>
          </div>
        </div>
      </div>
    </article>
    <div class="pull-right" style="text-align:right;">
      <article class="col-sm-12 col-md-12 col-lg-12">
        <span><strong>Total Pengeluaran</strong> : Rp. <span id="expense">0,00</span></span>
      </article>
      <article class="col-sm-12 col-md-12 col-lg-12">
        <span><strong>Jumlah Laba</strong> : Rp. <span id="laba">0,00</span></span>
      </article>
    </div>
  </div>

</section>
</div>

@endsection

@section('script')
<script>
var tag   = '{{ $tag }}';
var datenow = '{{ $tanggal }}';

$(function () {
  runSelect2Accounting();
  $('#bulan').val(datenow.substr(3,2));
  $('#tahun').val(datenow.substr(8,2));
  var bulan = $('#bulan').val();
  var tahun = $('#tahun').val();
  getLaba(bulan, tahun);

  var tableIncome = $('#'+tag+'-income-table').DataTable({
    lengthMenu: [[20, 50, 100, -1], [20, 50, 100, "All"]],
    processing: true,
    serverSide: true,
    ajax: {
      url: "{{ route('laba_rugi_income.api') }}",
      data: function (d) {
        d.bulan = $('#bulan').val(),
        d.tahun = $('#tahun').val();
      }
    },
    columns: [
      {data: 'akun', name: 'akun'},
      {data: 'nama_akun', name: 'nama_akun'},
      {data: 'nilai', name: 'nilai'},
    ]
  });

  var tableExpense = $('#'+tag+'-expense-table').DataTable({
    lengthMenu: [[20, 50, 100, -1], [20, 50, 100, "All"]],
    processing: true,
    serverSide: true,
    ajax: {
      url: "{{ route('laba_rugi_expense.api') }}",
      data: function (d) {
        d.bulan = $('#bulan').val(),
        d.tahun = $('#tahun').val();
      }
    },
    columns: [
      {data: 'akun', name: 'akun'},
      {data: 'nama_akun', name: 'nama_akun'},
      {data: 'nilai', name: 'nilai'},
    ]
  });

  $('#bulan,#tahun').on('change', function (e) {
    tableIncome.ajax.reload();
    tableExpense.ajax.reload();
    var bulan = $('#bulan').val();
    var tahun = $('#tahun').val();
    getLaba(bulan, tahun);
  });

  $('#exportIncome').on('click', function (e) {
    var bulan = $('#bulan').val();
    var tahun = $('#tahun').val();
    exportExcelIncome(bulan, tahun);
  });

  $('#exportExpense').on('click', function (e) {
    var bulan = $('#bulan').val();
    var tahun = $('#tahun').val();
    exportExcelExpense(bulan, tahun);
  });

});

function getLaba(bulan, tahun) {
  var url = "{{ route('get_laba') }}";
  var data = {
    bulan   : bulan,
    tahun   : tahun
  };

  $.ajax({
    url : url,
    type : "POST",
    data : data,
    success : function(data) {
      if (data.status == true) {
        $('#income').html('0,00');
        $('#income').html(data.income);
        $('#expense').html('0,00');
        $('#expense').html(data.expense);
        $('#laba').html('0,00');
        $('#laba').html(data.laba);
      } else {
        $('#income').html('0,00');
        $('#expense').html('0,00');
        $('#laba').html('0,00');
      }
    },
    error : function(data){
      myswal('e',data.message,'e',1500);
    }
  });
}

function exportExcelIncome(bulan, tahun) {
  var url = "{{ route('export_income.laba_rugi') }}";
  var data = {
    bulan   : bulan,
    tahun   : tahun
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
