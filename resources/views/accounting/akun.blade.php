@extends('layouts.app')

@section('style')
<style>

</style>
@endsection

@section('content')
<div id="main" class="utama_panel" role="main">
  <div id="content">
    <div class="row">
      <div class="col-xs-12 col-sm-7 col-md-7 col-lg-8">
        <h1 class="page-title txt-color-blueDark"><i class="fa fa-desktop fa-fw "></i>
          Master {{ $title }}
        </h1>
      </div>
      <div class="col-lg-2">
      </div>
      <div class="col-lg-2">
        <button id="btnAdd" type="button" class="btn btn-primary page-title" onclick="window.location.href='{{ url('/tutup_buku')}}'">
          <i class="fa fa-book"></i>
          Penutupan Buku
        </button>
      </div>
    </div>
    <section id="widget-grid" class="">
      <div class="row">
        <article class="col-sm-12 col-md-12 col-lg-12">
          <div class="jarviswidget jarviswidget-color-orange" id="wid-id-0" data-widget-colorbutton="false" data-widget-editbutton="false">
            <header>
              <span class="widget-icon"> <i class="fa fa-send"></i> </span>
              <h2>Rancangan Kode Perkiraan</h2>
            </header>
            <div>
              <div class="widget-body">
                <form id="formAdd" method="post" class="form-horizontal" data-toggle="validator" enctype="multipart/form-data">
                  {{ csrf_field() }} {{ method_field('POST') }}

                  <fieldset>
                    <div class="form-group">
                      <label class="col-md-2 control-label">Kelompok </label>
                      <div class="col-md-2">
                        <select class="form-control" style="width:100%;" name="id_category" required=""></select>
                        <span class="help-block with-errors"></span>
                      </div>
                    </div>

                    <div class="form-group">
                      <label class="col-md-2 control-label">Detail </label>
                      <div class="col-md-2">
                        <select class="form-control" style="width:100%;" name="id_level" required="">
                          <option value=""></option>
                          <option value="1">K1</option>
                          <option value="2">K2</option>
                          <option value="3">K3</option>
                          <option value="4">K4</option>
                        </select>
                      </div>
                      <label class="col-md-1 control-label label-parent" style="display:none;">Parent</label>
                      <div class="col-md-2 k-main k2-div" style="display:none;">
                        <select class="form-control k2 k-group" style="width:100%;" name="k2" level="2"></select>
                      </div>
                      <div class="col-md-2 k-main k3-div" style="display:none;">
                        <select class="form-control k3 k-group" style="width:100%;" name="k3" level="3"></select>
                      </div>
                    </div>

                    <div class="form-group">
                      <label class="col-md-2 control-label">Kode Perkiraan</label>
                      <div class="col-md-2">
                        <input class="form-control" id="id" name="id" placeholder="Kode {{ $title }}" type="text" required value="" maxlength="15" readonly>
                        <span class="help-block with-errors"></span>
                      </div>
                    </div>

                    <div class="form-group">
                      <label class="col-md-2 control-label">Nama Perkiraan</label>
                      <div class="col-md-2">
                        <input class="form-control" name="name" placeholder="Masukkan Nama {{ $title }}" type="text" autofocus required maxlength="50">
                        <span class="help-block with-errors"></span>
                      </div>
                    </div>

                    <div class="form-group" style="display:none">
                      <label class="col-md-2 control-label">Deskripsi</label>
                      <div class="col-md-2">
                        <textarea class="form-control" id="deskripsi" name="deskripsi" type="text" value=""></textarea>
                      </div>
                    </div>

                    <div class="form-group">
                      <label class="col-md-2 control-label">Saldo Awal</label>
                      <div class="col-md-2">
                        <input class="form-control decimal" id="saldo" name="saldo" placeholder="Saldo" type="text" value="0" maxlength="30">
                        <span class="help-block with-errors"></span>
                      </div>
                    </div>

                    <div class="form-group">
                      <label class="col-md-2 control-label">Status</label>
                      <div class="col-md-10">
                        <label class="radio radio-inline">
                          <input type="radio" value="A" class="radiobox" name="isactive" checked>
                          <span>Aktif</span>
                        </label>
                        <label class="radio radio-inline">
                          <input type="radio" value="N" class="radiobox" name="isactive">
                          <span>Non Aktif</span>
                        </label>
                      </div>
                    </div>
                  </fieldset>

                  <div class="form-actions">
                    <div class="row">
                      <div class="col-md-4">
                        <a id="btnResetAdd" class="btn btn-default">
                          <i class="fa fa-refresh"></i>
                          Batal
                        </a>
                        <button id="btnAdd" type="submit" class="btn btn-primary">
                          <i class="fa fa-send"></i>
                          Simpan
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

      <div class="row">
        <article class="col-sm-12 col-md-12 col-lg-12">
          <div class="jarviswidget jarviswidget-color-orange" id="wid-id-3" data-widget-editbutton="false">
            <header>
              <span class="widget-icon"> <i class="fa fa-table"></i> </span>
              <h2>List Data Perkiraan</h2>
            </header>
            <div>
              <div class="widget-body">
                <table id="{{$tag}}-table" class="table table-striped table-bordered table-hover" width="100%">
                  <thead>
                    <tr>
                      <th data-hide="phone">Kode Perkiraan</th>
                      <th data-class="expand">Nama Perkiraan</th>
                      <th data-class="expand">Saldo Awal</th>
                      <th data-class="expand">Saldo Akhir</th>
                      <th data-class="expand">Kelompok Perkiraan</th>
                      <th>Status</th>
                      <th data-hide="phone">Action</th>
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

  @include('accounting.setting.modalGeneral');

  @endsection

  @section('script')
  <script>
  var token = $('meta[name="csrf-token"]').attr('content');
  var tag   = '{{$tag}}';
  var table = $('#'+tag+'-table').DataTable({
    processing: true,
    serverSide: true,
    ajax: {
      url: "{{url('akun/api')}}",
      method: 'POST',
      data: function (d) {
        d._token = token;
        d.id_category = $('[name=id_category]').val();
      }
    },
    // ajax: "{{ route('akun.api') }}",
    columns: [
      {data: 'id', name: 'id'},
      {data: 'name', name: 'name'},
      {data: 'saldo_awal', name: 'saldo_awal'},
      {data: 'saldo_akhir', name: 'saldo_akhir'},
      {data: 'kategori', name: 'kategori'},
      {data: 'isactive', name: 'isactive'},
      {data: 'action', name: 'action', orderable: false, searchable: false}
    ]
  });

  function editData(id) {
    save_method = 'edit';
    $('input[name=_method]').val('PATCH');
    $('#modalEdit form')[0].reset();
    $.ajax({
      url: "{{ url('akun') }}" + '/' + id + "/edit",
      type: "GET",
      dataType: "JSON",
      success: function(data) {
        $('#modalEdit').modal('show');
        $('.modal-title').text('Edit Akun ');
        $('#id_edit').val(data.id);
        $('#name_edit').val(data.name);
        if (data.isactive == 'A') {
          $('#isactive_edit_a').prop('checked',true);
        } else {
          $('#isactive_edit_n').prop('checked',true);
        }
      },
      error : function() {
        myswal('e','No Data..','e',1500);
      }
    });
  }

  function deleteData(id){
    swal({
      title: 'Are you sure?',
      text: "You won't be able to revert this!",
      type: 'warning',
      showCancelButton: true,
      cancelButtonColor: '#d33',
      confirmButtonColor: '#3085d6',
      confirmButtonText: 'Yes, delete it!'
    }).then((result) => {
      if (result.value) {
        $.ajax({
          url : "{{ url('akun') }}" + '/' + id,
          type : "POST",
          data : {'_method' : 'DELETE', '_token' : token},
          success : function(data) {
            table.ajax.reload();
            myswal('s',data.message,'s',1500);
          },
          error : function () {
            myswal('e',data.message,'e',1500);
          }
        });
      }
    });
  }

  function get_id_akun(type,parent) {
    console.log(parent);
    var url         = "{{ url('get_id_akun') }}";
    var level       = $('[name=id_level]').val();
    var id_kategori = $('[name=id_category]').val();
    var parent = (parent != null) ? parent : '';
    if ($('[name=id_category]').val() != null) {
      var data = {
        '_token' : token,
        'level' : level,
        'id_kategori' : id_kategori,
        'parent' : parent,
      }
      $.ajax({
        url : url,
        type : "POST",
        data : data,
        success : function(data) {
          if (type == '2') {
            $('[name=id]').val(id_kategori+data);
          } else if (type == '3') {
            var val = ($('[name=k2]').val() != null) ? $('[name=k2]').val() : '' ;
            $('[name=id]').val(val+data);
          } else if (type == '4') {
            var val = ($('[name=k3]').val() != null) ? $('[name=k3]').val() : '' ;
            $('[name=id]').val(val+data);
          }
        },
        error : function(data){
          myswal('e',data.message,'e',1500);
        }
      });
    }
  }

  $(function(){

    $('[name=id_level]').on('change', function(e){
      var val = $(this).val();
      var id_kategori = $('[name=id_category]').val();
      if (val != '1') {
        if (val == '1' || val == '2') {
          get_id_akun(val);
        }
      } else {
        if (val != '') {
          $('[name=id]').val(id_kategori);
        } else {
          $('[name=id]').val('');
        }
      }
      if (val == '3') {
        $('.label-parent').show();
        $('.k3-div').hide();
        $('.k2-div').show();
      } else if (val == '4') {
        $('.label-parent').show();
        $('.k2-div').hide();
        $('.k3-div').show();
      } else {
        $('.label-parent').hide();
        $('.k-main').hide();
      }
    });

    $('[name=id_category]').on('change', function(e){
      var val = $(this).val();
      $('[name=id_level]').val('');
      if ($(this).val() != null) {
        $('[name=id]').val(val);
      }
      table.ajax.reload();
    });

    $('[name=k2]').on('change', function(e){
      var val = $(this).val();
      if ($(this).val() != null) {
        get_id_akun(3,val);
      }
    });

    $('[name=k3]').on('change', function(e){
      var val = $(this).val();
      if ($(this).val() != null) {
        get_id_akun(4,val);
      }
    });

    $('#btnResetAdd').on('click', function (e) {
      $('#formAdd')[0].reset();
    });

    $('#formAdd').validator().on('submit', function (e) {
      $('input[name=_method]').val('POST');
      if (!e.isDefaultPrevented()){
        var id = $('#id').val();
        url = "{{ url('akun') }}";

        $.ajax({
          url : url,
          type : "POST",
          data : $('#formAdd').serialize(),
          success : function(data) {
            table.ajax.reload();
            $('#formAdd')[0].reset();
            if (data.status == true) {
              myswal('s',data.message,'s',1500);
              $('select[name=id_category]').val('').trigger('change');
              $('select[name=id_level]').val('').trigger('change');
              $('select[name=k2]').val('').trigger('change');
              $('select[name=k3]').val('').trigger('change');
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

    $('#modalEdit form').validator().on('submit', function (e) {
      if (!e.isDefaultPrevented()){
        var id = $('#id_edit').val();
        url = "{{ url('akun') . '/' }}" + id;

        $.ajax({
          url : url,
          type : "POST",
          data : $('#modalEdit form').serialize(),
          success : function(data) {
            $('#modalEdit').modal('hide');
            table.ajax.reload();
            myswal('s',data.message,'s',1500);
          },
          error : function(data){
            myswal('e',data.message,'e',1500);
          }
        });
        return false;
      }
    });

    $('[name="id_category"]').select2({
      ajax: {
        url: baseurl+'/get_category',
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

    $('.k-group').select2({
      ajax: {
        url: baseurl+'/get_k',
        delay:250,
        data: function (params) {
          var query = {
            search: params.term,
            type: 'public',
            level: $(this).attr('level'),
            id_kategori: $('[name="id_category"]').val(),
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

  </script>
  @endsection
