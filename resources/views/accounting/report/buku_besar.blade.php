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
                    <label class="col-md-1 control-label">Dari Tanggal</label>
                    <div class="itemLine col-md-2">
                      <div class="input-group">
                        <input class="form-control" id="from" type="text" placeholder="Tanggal Awal">
                        <span class="input-group-addon"><i class="fa fa-calendar"></i></span>
                      </div>
                    </div>
                    <label class="col-md-1 control-label">Sampai</label>
                    <div class="itemLine col-md-2">
                      <div class="input-group">
                        <input class="form-control" id="to" type="text" placeholder="Tanggal Akhir">
                        <span class="input-group-addon"><i class="fa fa-calendar"></i></span>
                      </div>
                  </div>
                    
                  <label class="col-md-1 control-label">Akun</label>
                  <div class="itemLine col-md-2">
                    <select style="width:100%" id="id_akun_tujuan" name="id_akun_tujuan" class="form-control" required=""></select>
                  </div>
                  <div class="itemLine col-md-1">
                    <button type="button" id="view" class="btn btn-success">View</button>
                  </div>
                  <!-- {{-- <div class="itemLine col-md-1">
                    <button type="button" id="export" class="btn btn-success">Export</button>
                  </div> --}} -->
                </div>
                </div>
              </fieldset>
            </form>
          </div>
        </div>
      </div>
    </article>
  <!-- </div> -->
  
  <!-- <div class="row" style="margin-bottom:30px;">
    <article class="col-sm-12 col-md-12 col-lg-12">
      <span><strong>Id Akun</strong> : <span id="id_akun_info">Belum memilih akun </span></span><span>&nbsp;<strong>Saldo</strong> : Rp. <span id="saldo">0,00</span></span>
    </article>
  </div> -->
  <div class="row">
    <article class="col-sm-12 col-md-12 col-lg-12">
      <div class="jarviswidget jarviswidget-color-orange" id="wid-id-3" data-widget-editbutton="false">
        <header>
          <span class="widget-icon"> <i class="fa fa-table"></i> </span>
          <h2>List Data {{ $title }}</h2>
        </header>
        <div>
          <div class="widget-body">
            <table id="{{$tag}}-table" class="table table-striped table-bordered table-hover" width="100%">
              <thead>
                <tr>
                  <th>ID</th>
                  <th>Tanggal</th>
                  <th>Deskripsi</th>
                  <th>Kode Ref</th>
                  <th>Debit</th>
                  <th>Kredit</th>
                  <th>Saldo</th>
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

@endsection

@section('script')
<script>
var tag   = '{{ $tag }}';

$(function () {

// Date Range Picker
  $("#from").datepicker({
      dateFormat: 'dd/mm/yy',
      defaultDate: "+1w",
      changeMonth: true,
      numberOfMonths: 1,
      prevText: '<i class="fa fa-chevron-left"></i>',
      nextText: '<i class="fa fa-chevron-right"></i>',
      onClose: function (selectedDate) {
          $("#to").datepicker("option", "minDate", selectedDate);
      }
  }).datepicker("setDate", new Date());

  $("#to").datepicker({
      dateFormat: 'dd/mm/yy',
      defaultDate: "+1w",
      changeMonth: true,
      numberOfMonths: 1,
      prevText: '<i class="fa fa-chevron-left"></i>',
      nextText: '<i class="fa fa-chevron-right"></i>',
      onClose: function (selectedDate) {
          $("#from").datepicker("option", "maxDate", selectedDate);
      }
  }).datepicker("setDate", new Date());


  $('#id_akun_tujuan').select2({
    ajax: {
      url: baseurl+'/get_akun',
      delay:250,
      data: function (params) {
        var query = {
          search: params.term,
          type: 'public',
          category: 'all',
          level: '4',
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

  var table = $('#'+tag+'-table').DataTable({
    lengthMenu: [[20, 50, 100, -1], [20, 50, 100, "All"]],
    processing: true,
    serverSide: true,
    ajax: {
      url: "{{ route('buku_besar.api') }}",
      data: function (d) {
        d.from = $('#from').val(),
        d.to = $('#to').val(),
        d.id_akun = $('#id_akun_tujuan').val();
      }
    },
    columns: [
      {data: 'id', name: 'id'},
      {data: 'tanggal', name: 'tanggal'},
      {data: 'kode_akun', name: 'kode_akun'},
      {data: 'nama_akun', name: 'nama_akun'},
      {data: 'debit', name: 'debit'},
      {data: 'kredit', name: 'kredit'},
      {data: 'balance', name: 'balance'},
    ]
  });

  $('#from,#to,#id_akun_tujuan').on('change', function (e) {
    table.ajax.reload();
  });


  // runSelect2Accounting()
  // $('#bulan').val(datenow.substr(3,2));
  // $('#tahun').val(datenow.substr(8,2));

  // $('#bulan,#tahun,#id_akun_tujuan').on('change', function (e) {
  //   table.ajax.reload();
  //   var bulan = $('#bulan').val();
  //   var tahun = $('#tahun').val();
  //   var id_akun = $('#id_akun_tujuan').val();
  //   if (id_akun != null) {
  //     getSaldo(bulan, tahun, id_akun);
  //   }
  // });

  $('#view').on('click', function (e) {
    var from = $('#from').val();
    var to = $('#to').val();
    var id = $('#id_akun_tujuan').val();
    if(from && to !== ''){
      from = from.replace(/\//g,'-');
      to = to.replace(/\//g,'-');
      window.open(baseurl+'/view_buku_besar/'+from+'/'+to+'/'+id+'/');
    }    
  });

});
 
// function getSaldo(bulan, tahun, id_akun) {
//   var url = "{{ route('saldo.akun') }}";
//   var data = {
//     bulan   : bulan,
//     tahun   : tahun,
//     id_akun : id_akun
//   };

//   $.ajax({
//     url : url,
//     type : "POST",
//     data : data,
//     success : function(data) {
//       if (data.status == true) {
//         $('#saldo').html('0,00');
//         $('#saldo').html(data.saldo);
//         $('#id_akun_info').html('-');
//         $('#id_akun_info').html(id_akun);
//       } else {
//         $('#saldo').html('0,00');
//         $('#id_akun_info').html('Belum memilih akun');
//       }
//     },
//     error : function(data){
//       myswal('e',data.message,'e',1500);
//     }
//   });
// }

// function exportExcel(bulan, tahun, id_akun) {
//   var url = "{{ route('export.buku_besar') }}";
//   var data = {
//     bulan   : bulan,
//     tahun   : tahun,
//     id_akun : id_akun
//   };

//   $.ajax({
//     url : url,
//     type : "POST",
//     data : data,
//     success: function (response, textStatus, request) {
//       var a = document.createElement("a");
//       a.href = response.file;
//       a.download = response.name;
//       document.body.appendChild(a);
//       a.click();
//       a.remove();
//     },
//     error : function(data){
//       myswal('e',data.message,'e',1500);
//     }
//   });
// }

</script>
@endsection
