@extends('layouts.app')

@section('content')
<div id="main" class="utama_panel" role="main">
  <div id="content">
    <div class="row">
      <div class="col-xs-12 col-sm-7 col-md-7 col-lg-4">
        <h1 class="page-title txt-color-blueDark"><i class="fa fa-desktop fa-fw "></i>
          List {{ $title }}
        </h1>
      </div>
    </div>
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
                <th>Tanggal Order</th>
                <th>Id</th>
                <th>Nama Customer</th>
                 <th>Status</th>
                 <th>Total Transaction</th>
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

<!-- Modal -->
<div class="modal fade" id="modalInput" tabindex="-1" role="dialog" aria-labelledby="modalEditLabel" aria-hidden="true">
  <div class="modal-dialog modal-lg">
    <div class="modal-content">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal" aria-hidden="true">
          &times;
        </button>
        <h4 class="modal-title" id="modalEditLabel">Pilih Proses</h4>
      </div>
      <form id="input_no_resi" class="form-horizontal" method="POST" action="{{ url('input_no_resi') }}">
        {{ csrf_field() }}
        <div class="modal-body">
          <div class="row">
            <div class="form-group">
              <label for="name" class="col-md-2 control-label">No Resi</label>
              <div class="col-md-6">
                <input id="invoice_id" type="hidden" class="form-control" name="invoice_id" value="">
                <input id="no_resi" type="text" class="form-control" name="no_resi" maxlength="30">
              </div>
            </div>
            <br>
            <div class="form-group">
              <label for="name" class="col-md-2 control-label">Ongkos Kirim</label>
              <div class="col-md-6">
                <input id="ongkos_kirim" type="number" class="form-control" name="ongkos_kirim">
              </div>
            </div>
          </div><br><br><br>
          <div class="row">
            <div class="col-md-12">
              <button class="btn btn-primary" type="button" id="btn_input_resi">
                <i class="fa fa-send"></i>
                Posting
              </button>
              <button type="button" class="btn btn-default" data-dismiss="modal">
                Batal
              </button>
      </form>
    </div>
  </div>
</div>
</div><!-- /.modal-content -->
</div><!-- /.modal-dialog -->
</div><!-- /.modal -->

@endsection

@section('script')
<script>
  var tag = '{{$tag}}';
  var table = $('#' + tag + '-table').DataTable({
    processing: true,
    serverSide: true,
    order: [1, 'desc'],
    ajax: "{{ route('order_list_ecommerce.api') }}",
    columns: [{
        data: 'tanggal_order',
        name: 'tanggal_order'
      }, {
        data: 'id',
        name: 'id'
      },
      {
        data: 'nama_customer',
        name: 'nama_customer'
      },
      {
        data: 'status_order',
        name: 'status_order'
      },
      {
        data: 'total_transaksi',
        name: 'total_transaksi'
      },
      {
        data: 'action',
        name: 'action',
        orderable: false,
        searchable: false
      }
    ]
  });
  var jml_art_post = 0;

  $('[name=btnPostingProses]').on('click', function() {
    postProses();
  });

  function showProses(id) {
    $('[name=so_id_post]').val(id);
    $('.cbp').prop('checked', true);
  }

  //Fungsi View Data
  function view_print(id) {
    window.open(baseurl + '/order_ecommerce/' + id + '/view_print');
  }

  function batal_order(id) {
    var data = {
      id: id
    };
    $.ajax({
      type: 'POST',
      url: baseurl + '/batal_order',
      data: data,
      dataType: 'json',
    }).done(function(res) {
      if (res.status == true) {
        myswal('s', res.message, 's', 1500);
      }
      table.ajax.reload();
    });
  }

  function approve_order(id) {
    var data = {
      id: id
    };
    $.ajax({
      type: 'POST',
      url: baseurl + '/approve_order',
      data: data,
      dataType: 'json',
    }).done(function(res) {
      if (res.status == true) {
        myswal('s', res.message, 's', 1500);
      }
      table.ajax.reload();
    });
  }

  function selesai_order(id) {
    var data = {
      id: id
    };
    $.ajax({
      type: 'POST',
      url: baseurl + '/selesai_order',
      data: data,
      dataType: 'json',
    }).done(function(res) {
      if (res.status == true) {
        myswal('s', res.message, 's', 1500);
      }
      table.ajax.reload();
    });
  }

  $('#btn_input_resi').on('click', function() {
    createData();
  });

  function createData() {
    $.ajax({
      url: "{{ route('input_no_resi') }}",
      type: "POST",
      data: $('#input_no_resi').serialize(),
      success: function(data) {
        myswal('s', data.message, 's', 1500);
        table.ajax.reload();
        $('#modalInput').modal('hide');
      },
      error: function() {
        myswal('e', 'No Data..', 'e', 1500);
      }
    });
  }

  function input_no_resi(id) {
    $('form#input_no_resi')[0].reset();
    $('[name=invoice_id]').val(id);
  }
</script>
@endsection