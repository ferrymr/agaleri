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
        <h1 class="page-title txt-color-blueDark"><i class="fa fa-desktop fa-fw "></i>
          Master {{ $title }}
        </h1>
      </div>
    </div>
    <section id="widget-grid" class="">
      <div class="row">
        <article class="col-sm-6 col-md-6 col-lg-6">
          <div class="jarviswidget jarviswidget-color-orange" id="wid-id-0" data-widget-colorbutton="false" data-widget-editbutton="false">
            <header>
              <span class="widget-icon"> <i class="fa fa-send"></i> </span>
              <h2>Tambah {{ $title }}</h2>
            </header>

            <div>
              <div class="widget-body">
                <form id="formAdd" method="post" class="form-horizontal" data-toggle="validator" enctype="multipart/form-data">
                  {{ csrf_field() }} {{ method_field('POST') }}

                  <fieldset>
                    <div class="form-group">
                      <label class="col-md-2 control-label">Kode {{ $title }}</label>
                      <div class="col-md-2">
                        <input class="form-control" id="id" name="id" placeholder="Kode {{ $title }}" type="text" value="">
                      </div>
                    </div>

                    <div class="form-group">
                      <label class="col-md-2 control-label">Nama {{ $title }}</label>
                      <div class="col-md-10">
                        <input class="form-control" name="name" placeholder="Masukkan Nama {{ $title }}" type="text" autofocus required maxlength="50">
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
                      <div class="col-md-12">
                        <button id="btnAdd" type="submit" class="btn btn-primary">
                          <i class="fa fa-send"></i>
                          Simpan
                        </button>
                        <a id="btnResetAdd" class="btn btn-default">
                          <i class="fa fa-refresh"></i>
                          Batal
                        </a>
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
              <h2>List Data {{ $title }}</h2>
            </header>
            <div>
              <div class="widget-body">
                <table id="{{$tag}}-table" class="table table-striped table-bordered table-hover" width="100%">
                  <thead>
                    <tr>
                      <th data-hide="phone">Kode</th>
                      <th data-class="expand">Nama {{ $title }}</th>
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

  @include('master_data.modalGeneral');

  <!-- END MAIN CONTENT -->
  @endsection

  @section('script')
  <script>
    var tag = '{{$tag}}';
    var table = $('#' + tag + '-table').DataTable({
      processing: true,
      serverSide: true,
      ajax: "{{ route('size.api') }}",
      columns: [{
          data: 'id',
          name: 'id'
        },
        {
          data: 'name',
          name: 'name'
        },
        {
          data: 'isactive',
          name: 'isactive'
        },
        {
          data: 'action',
          name: 'action',
          orderable: false,
          searchable: false
        }
      ]
    });

    function editData(id) {
      save_method = 'edit';
      $('input[name=_method]').val('PATCH');
      $('#modalEdit form')[0].reset();
      $.ajax({
        url: "{{ url('size') }}" + '/' + id + "/edit",
        type: "GET",
        dataType: "JSON",
        success: function(data) {
          $('#modalEdit').modal('show');
          $('.modal-title').text('Edit Material ');
          $('#id_edit').val(data.id);
          $('#name_edit').val(data.name);
          if (data.isactive == 'A') {
            $('#isactive_edit_a').prop('checked', true);
          } else {
            $('#isactive_edit_n').prop('checked', true);
          }
        },
        error: function() {
          myswal('e', 'No Data..', 'e', 1500);
        }
      });
    }

    function deleteData(id) {
      var csrf_token = $('meta[name="csrf-token"]').attr('content');
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
            url: "{{ url('size') }}" + '/' + id,
            type: "POST",
            data: {
              '_method': 'DELETE',
              '_token': csrf_token
            },
            success: function(data) {
              table.ajax.reload();
              $('#id').val(data.newid);
              $('#name').focus();
              myswal('s', data.message, 's', 1500);
            },
            error: function() {
              $('#id').val(data.newid);
              $('#name').focus();
              myswal('e', data.message, 'e', 1500);
            }
          });
        }
      });
    }

    $(function() {

      $('#btnResetAdd').on('click', function(e) {
        $('#formAdd')[0].reset();
      });

      $('#formAdd').validator().on('submit', function(e) {
        $('input[name=_method]').val('POST');
        if (!e.isDefaultPrevented()) {
          var id = $('#id').val();
          url = "{{ url('size') }}";

          $.ajax({
            url: url,
            type: "POST",
            data: $('#formAdd').serialize(),
            success: function(data) {
              table.ajax.reload();
              $('#formAdd')[0].reset();
              if (data.status == true) {
                myswal('s', data.message, 's', 1500);

                $('#name').focus();
              } else {
                myswal('e', data.message, 'e', 1500);

                $('#name').focus();
              }
            },
            error: function(data) {
              myswal('e', data.message, 'e', 1500);
            }
          });
          return false;
        }
      });

      $('#modalEdit form').validator().on('submit', function(e) {
        if (!e.isDefaultPrevented()) {
          var id = $('#id_edit').val();
          url = "{{ url('size') . '/' }}" + id;

          $.ajax({
            url: url,
            type: "POST",
            data: $('#modalEdit form').serialize(),
            success: function(data) {
              $('#modalEdit').modal('hide');
              table.ajax.reload();
              myswal('s', data.message, 's', 1500);
            },
            error: function(data) {
              myswal('e', data.message, 'e', 1500);
            }
          });
          return false;
        }
      });
    });
  </script>
  @endsection