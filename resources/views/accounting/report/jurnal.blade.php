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
                <div class="form-grou">
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
                  <div class="itemLine col-md-1">
                  <button type="button" id="view" class="btn btn-success">Vew</button>
                    <!-- <button type="button" id="export" class="btn btn-success">Export</button> -->
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
            <table id="{{$tag}}-table" class="table table-striped table-bordered table-hover" width="100%">
              <thead>
                <tr>
                  <th data-hide="phone">ID</th>
                  <th data-hide="phone">Tanggal</th>
                  <th data-hide="phone">Kode Akun</th>
                  <th data-hide="phone">Nama Akun</th>
                  <th data-class="expand">Debit</th>
                  <th data-class="expand">Kredit</th>
                  <th data-class="expand">Aksi</th>
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



<!-- Modal -->
    <div class="modal fade" id="modalEdit" tabindex="-1" role="dialog" aria-labelledby="modalEditLabel" aria-hidden="true">
      <div class="modal-dialog modal-lg">
        <div class="modal-content">
          <div class="modal-header">
            <button type="button" class="close" data-dismiss="modal" aria-hidden="true">
              &times;
            </button>
            <h4 class="modal-title" id="modalEditLabel">Edit {{ $title }}</h4>
          </div>
          <div class="modal-body">
            <form id="formEdit" class="form-horizontal" method="PATCH" action="{{ url('jurnal_update') }}">
              {{ csrf_field() }}

                <div class="form-group">
                <label for="id" class="col-md-2 control-label">Id Jurnal</label>
                <div class="col-md-2">
                  <input id="id_jurnal_edit" type="text" class="form-control" name="id_jurnal_edit" readonly>
                </div>
                </div>

                <div class="form-group">
                <label for="id" class="col-md-2 control-label">Tanggal</label>
                <div class="col-md-5">
                  <input id="tanggal_edit" type="text" class="form-control" name="tanggal_edit" readonly>
                </div>
                </div>
                
                <div class="form-group">
                <label for="id" class="col-md-2 control-label">Kode Akun</label>
                <div class="col-md-5">
                  <input id="id_akun_edit" type="text" class="form-control" name="id_akun_edit" readonly>
                </div>
                </div>
                <div class="form-group">
                <label for="id" class="col-md-2 control-label">Nama Akun</label>
                <div class="col-md-5">
                  <input id="nama_akun_edit" type="text" class="form-control" name="nama_akun_edit" readonly>
                </div>
                </div>
                <div class="form-group">
                <label for="name" class="col-md-2 control-label">Debit</label>
                <div class="col-md-4">
                  <input id="debit_edit" type="integer" class="form-control" name="debit_edit" autofocus  maxlength="75">
                </div>
                </div>
                <div class="form-group">
                <label for="name" class="col-md-2 control-label">Kredit</label>
                <div class="col-md-4">
                  <input id="kredit_edit" type="integer" class="form-control" name="kredit_edit" autofocus  maxlength="75">
                </div>
                </div>
              
            
              <div class="form-actions">
                <div class="row">
                  <div class="col-md-12">
                    <button class="btn btn-primary" id="btnUpdate" type="button">
                      <i class="fa fa-save"></i>
                      Simpan
                    </button>
                    <button type="button" class="btn btn-default" data-dismiss="modal">
                      Batal
                    </button>
                  </div>
                </div>
              </div>
            </form>
          </div>
        </div><!-- /.modal-content -->
      </div><!-- /.modal-dialog -->
    </div><!-- /.modal -->





@endsection

@section('script')
<script>
var tag         = '{{ $tag }}';
var token       = $('meta[name="csrf-token"]').attr('content');


// $(function () {
  
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

  $('#view').on('click', function (e) {
    var from = $('#from').val();
    var to = $('#to').val();
    var id = $('#id_akun_tujuan').val();
    if(from && to !== ''){
      from = from.replace(/\//g,'-');
      to = to.replace(/\//g,'-');
      window.open(baseurl+'/view_jurnal/'+from+'/'+to);
    }    
  });

  var table = $('#'+tag+'-table').DataTable({
  lengthMenu: [[20, 50, 100, -1], [20, 50, 100, "All"]],
  processing: true,
  serverSide: true,
  ajax: {
    url: "{{ route('jurnal.api') }}",
    data: function (d) {
      d.from = $('#from').val(),
      d.to = $('#to').val();
    }
  },
  columns: [
    {data: 'id', name: 'id'},
    {data: 'tanggal', name: 'tanggal'},
    {data: 'kode_akun', name: 'kode_akun'},
    {data: 'nama_akun', name: 'nama_akun'},
    {data: 'debit', name: 'debit'},
    {data: 'kredit', name: 'kredit'},
    {data: 'action', name: 'action'},
  ]
});

$('#from,#to').on('change', function (e) {
  clear_table();
});

// Fungsi clear table 
function clear_table(){
    table.ajax.reload();
}

// });

//Fungsi Batal Edit
function batalEdit() {
  $('#formEdit')[0].reset();
  closeEdit();
}

// $('#modalEdit').modal('show');

//Fungsi Edit
function validasiData(jurnal_id,type) {
  swal({
    title: 'Masukkan PIN Super Admin!',
    input: 'password',
    inputAttributes: {
      autocapitalize: 'off'
    },
    showCancelButton: true,
    confirmButtonText: 'Aprove',
    showLoaderOnConfirm: true,
    preConfirm: (pin) => {
      $.ajax({
        url: "{{ route('validasi_pin_super_admin') }}",
        type: "POST",
        data: {'jurnal_id':jurnal_id,'pin':pin,'_token' : token},
        dataType: "JSON",
        success: function(data) {
          if (data.status == true) {
            if(type == 'edit'){
              $('#modalEdit').modal('show');
              showEdit(jurnal_id);
            } else {
              updateData(jurnal_id);
            }
          } else {
            myswal('e',data.message,'e',1500);
          }
        },
        error : function() {
          myswal('e','Not Autorized..','e',1500);
        }
      });
    },
    allowOutsideClick: () => !swal.isLoading()
  });

}

// Fungsi Show Edit
function showEdit(jurnal_id) {
  console.log(jurnal_id);
  // $('.edit-skb').show();
  // $('.create-skb').hide();
  // $('.list-data-skb').hide();
  getData(jurnal_id);
}

// Fungsi Show Edit
function closeEdit() {
  // $('.edit-skb').hide();
  // $('.create-skb').show();
  // $('.list-data-skb').show();
  $('#formEdit')[0].reset();
}

function getData(jurnal_id){
  $.ajax({
    url: "{{ route('get_jurnal') }}",
    type: "POST",
    dataType: "JSON",
    data : {'jurnal_id':jurnal_id},
    success: function(data) {
      var d = data.data[0];
      $('#formEdit')[0].reset();
      $('#id_jurnal_edit').val(d.journal_id);
      $('#tanggal_edit').val(d.created_at);
      $('#id_akun_edit').val(d.akun_id);
      $('#nama_akun_edit').val(d.nama_akun);
      $('#debit_edit').val(d.debit);
      $('#kredit_edit').val(d.credit);
    },
    error : function() {
      myswal('e','No Data..','e',1500);
    }
  });
}

$('#btnBatalEdit').on('click', function (e) {
  batalEdit();
});

$('#btnUpdate').on('click', function (e) {
  if (!e.isDefaultPrevented()){
    var id = $('#id').val();
    url = "{{ route('jurnal.update') }}";

    $.ajax({
      url : url,
      type : "POST",
      data : $('#formEdit').serialize(),
      success : function(data) {
        if (data.status == true) {
          myswal('s',data.message,'s',1500);
          $('#modalEdit').modal('hide');
          clear_table();
          closeEdit();
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

function updateData(jurnal_id){
  $.ajax({
    url: "{{ route('update_saldo') }}",
    type: "POST",
    dataType: "JSON",
    data : {'jurnal_id':jurnal_id},
    success: function(data) {
      myswal('s',data.message,'s',1500);
      table.ajax.reload();
    },
    error : function() {
      myswal('e','No Data..','e',1500);
    }
  });
}

</script>
@endsection
