@extends('layouts.app')


@section('style')
<style>

</style>
@endsection

@section('content')
<div id="content">
  <div class="row">
    <div class="col-xs-12 col-sm-7 col-md-7 col-lg-4">
      <h1 class="page-title txt-color-blueDark">
        <i class="fa fa-pencil-square-o fa-fw "></i>
        Master {{ $title }}
      </h1>
    </div>
  </div>
  <section id="widget-grid" class="">
    <div class="row">
      <article class="col-sm-12 col-md-12 col-lg-12">
        <div class="jarviswidget" id="wid-id-0" data-widget-colorbutton="false" data-widget-editbutton="false">
          <header>
            <span class="widget-icon"> <i class="fa fa-send"></i> </span>
            <h2>Tambah {{ $title }}</h2>
          </header>
          <div>
            <div class="jarviswidget-editbox">
            </div>
            <div class="widget-body">
              <form id="formAdd" method="post" class="form-horizontal" data-toggle="validator" enctype="multipart/form-data">
                {{ csrf_field() }} {{ method_field('POST') }}
                <fieldset>
                  <div class="form-group">
                    <label for="" class="col-md-2 control-label">Kategori</label>
                    <div class="col-md-2">
                      <select style="width:100%" id="kategori_id" name="kategori_id" class="form-control" required=""></select>
                    </div>
                    <label class="col-md-2 control-label">Kode {{ $title }}</label>
                    <div class="col-md-2">
                      <input class="form-control" id="id" name="id" placeholder="Kode {{ $title }}" type="text" value="" readonly>
                      <input class="form-control" id="index" name="index" placeholder="" type="hidden" value="">
                    </div>
                  </div>
                  <div class="form-group">
                    <label class="col-md-2 control-label">Nama {{ $title }}</label>
                    <div class="col-md-6">
                      <input class="form-control" name="name" placeholder="Masukkan Nama {{ $title }}" type="text" autofocus="" required maxlength="50">
                      <span class="help-block with-errors"></span>
                    </div>

                  </div>
                  <div class="form-group">
                    <label class="col-md-2 control-label">Berat {{ $title }} /gr</label>
                    <div class="col-md-2">
                      <input class="form-control ribuan" name="berat" placeholder="Masukkan Berat {{ $title }}" type="decimal" maxlength="50">
                      <span class="help-block with-errors"></span>
                    </div>
                    <label class="col-md-2 control-label">Harga {{ $title }}</label>
                    <div class="col-md-2">
                      <input class="form-control decimal" name="harga" placeholder="Masukkan Harga {{ $title }}" type="decimal" maxlength="50">
                      <span class="help-block with-errors"></span>
                    </div>
                  </div>
                  <div class="form-group">
                    <label class="col-md-2 control-label">Deskripsi {{ $title }}</label>
                    <div class="col-md-10">
                      <textarea class="form-control" name="deskripsi" type="text"></textarea>
                      <span class="help-block with-errors"></span>
                    </div>
                  </div>
                  <div class="form-group">
                    <label class="col-md-2 control-label">Spesifikasi {{ $title }}</label>
                    <div class="col-md-10">
                      <textarea class="form-control" name="spesifikasi" type="text"></textarea>
                      <span class="help-block with-errors"></span>
                    </div>
                  </div>
                  <div class="form-group">
                    <label class="col-md-2 control-label">Upload Foto Utama</label>
                    <div class="col-md-4">
                      <input type="file" class="btn btn-default" id="photo" name="photo" required>
                      <p class="help-block">
                        Upload Foto Utama Produk.
                      </p>
                    </div>
                  </div>
                  <div class="form-group">
                    <label class="col-md-2 control-label">Upload Foto Thumb</label>
                    <div class="col-md-4">
                      <input type="file" class="btn btn-default" id="thumb" name="thumb" required>
                      <p class="help-block">
                        Upload Foto Thumb Produk.
                      </p>
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
        <div class="jarviswidget jarviswidget-color-blueDark" id="wid-id-3" data-widget-editbutton="false">
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

<div class="modal" id="modalEdit" tabindex="1" role="dialog" aria-hidden="true" data-backdrop="static">
  <div class="modal-dialog modal-lg">
    <div class="modal-content">
      <form id="formEdit" method="post" class="form-horizontal" data-toggle="validator" enctype="multipart/form-data">
        {{ csrf_field() }} {{ method_field('POST') }}
        <div class="modal-header" style="background-color:#2C3742;color:white;">
          <button type="button" class="close" data-dismiss="modal" aria-label="Close">
            <span aria-hidden="true"> &times; </span>
          </button>
          <h3 class="modal-title"></h3>
        </div>

        <div class="modal-body">
          <div class="form-group">
            <label for="id_edit" class="col-md-3 control-label">Kode {{ $title }}</label>
            <div class="col-md-3">
              <input type="text" id="id_edit" name="id_edit" class="form-control" required readonly>
              <span class="help-block with-errors"></span>
            </div>
          </div>

          <div class="form-group">
            <label for="name_edit" class="col-md-3 control-label">Nama {{ $title }}</label>
            <div class="col-md-6">
              <input type="text" id="name_edit" name="name_edit" class="form-control" autofocus required>
              <span class="help-block with-errors"></span>
            </div>
          </div>

          <div class="form-group">
            <label for="name_edit" class="col-md-3 control-label">Berat {{ $title }}</label>
            <div class="col-md-6">
              <input type="text" id="berat_edit" name="berat_edit" class="form-control">
              <span class="help-block with-errors"></span>
            </div>
          </div>

          <div class="form-group">
            <label for="name_edit" class="col-md-3 control-label">Harga {{ $title }}</label>
            <div class="col-md-6">
              <input type="text" id="harga_edit" name="harga_edit" class="form-control" required>
              <span class="help-block with-errors"></span>
            </div>
          </div>

          <div class="form-group">
            <label class="col-md-3 control-label">Deskripsi {{ $title }}</label>
            <div class="col-md-6">
              <textarea class="form-control" id="deskripsi_edit" name="deskripsi_edit" type="text"></textarea>
              <span class="help-block with-errors"></span>
            </div>
          </div>

          <div class="form-group">
            <label class="col-md-3 control-label">Spesifikasi {{ $title }}</label>
            <div class="col-md-6">
              <textarea class="form-control" id="spesifikasi_edit" name="spesifikasi_edit" type="text"></textarea>
              <span class="help-block with-errors"></span>
            </div>
          </div>

          <div class="form-group">
            <label class="col-md-3 control-label">Upload Foto Utama</label>
            <div class="col-md-6">
              <input type="file" class="btn btn-default" id="photo_edit" name="photo_edit">
              <p class="help-block">
                Upload Foto Utama Produk.
              </p>
            </div>
          </div>

          <div class="form-group">
            <label class="col-md-3 control-label">Upload Foto Thumb</label>
            <div class="col-md-6">
              <input type="file" class="btn btn-default" id="thumb_edit" name="thumb_edit">
              <p class="help-block">
                Upload Foto Thumb Produk.
              </p>
            </div>
          </div>


          <div class="form-group">
            <label class="col-md-3 control-label">Status</label>
            <div class="col-md-9">
              <label class="radio radio-inline">
                <input type="radio" value="A" class="radiobox" id="isactive_edit_a" name="isactive_edit">
                <span>Aktif</span>
              </label>
              <label class="radio radio-inline">
                <input type="radio" value="N" class="radiobox" id="isactive_edit_n" name="isactive_edit">
                <span>Non Aktif</span>
              </label>
            </div>
          </div>
        </div>

        <div class="modal-footer">
          <button type="submit" class="btn btn-primary btn-save">Submit</button>
          <button type="button" class="btn btn-default" data-dismiss="modal">Cancel</button>
        </div>

      </form>
    </div>
  </div>
</div>

@endsection

@section('script')
<script>
  var token = $('meta[name="csrf-token"]').attr('content');
  var tag = '{{$tag}}';
  var table = $('#' + tag + '-table').DataTable({
    processing: true,
    serverSide: true,
    ajax: "{{ route('produk.api') }}",
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
      url: "{{ url('produk') }}" + '/' + id + "/edit",
      type: "GET",
      dataType: "JSON",
      success: function(data) {
        $('#modalEdit').modal('show');
        $('.modal-title').text('Edit Product');
        $('#id_edit').val(data.id);
        $('#name_edit').val(data.name);
        $('#harga_edit').val(data.harga);
        $('#berat_edit').val(data.berat);
        $('#deskripsi_edit').val(data.deskripsi);
        $('#spesifikasi_edit').val(data.spesifikasi);
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
          url: "{{ url('produk') }}" + '/' + id,
          type: "POST",
          data: {
            '_method': 'DELETE',
            '_token': token
          },
          success: function(data) {
            table.ajax.reload();
            myswal('s', data.message, 's', 1500);
          },
          error: function() {
            myswal('e', data.message, 'e', 1500);
          }
        });
      }
    });
  }

  $(function() {
    $('#btnResetAdd').on('click', function(e) {
      resetForm();
    });

    $('#formAdd').validator().on('submit', function(e) {
      $('input[name=_method]').val('POST');
      if (!e.isDefaultPrevented()) {
        var id = $('#id').val();
        url = "{{ url('produk') }}";
        $.ajax({
          url: url,
          type: "POST",
          data: new FormData($("#formAdd")[0]),
          // data : $('#formAdd').serialize(),
          contentType: false, //matikan jika menggunakan serialize
          processData: false, //matikan jika menggunakan serialize
          success: function(data) {
            table.ajax.reload();
            resetForm();
            if (data.status == true) {
              myswal('s', data.message, 's', 1500);
              // $('#id').val(data.newid);
              $('[name=name]').focus();
            } else {
              myswal('e', data.message, 'e', 1500);
              // $('#id').val(id);
              $('[name=name]').focus();
            }
            e.preventDefault();
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
        url = "{{ url('produk') . '/' }}" + id;

        $.ajax({
          url: url,
          type: "POST",
          data: new FormData($("#formEdit")[0]),
          // data : $('#formEdit').serialize(),
          contentType: false, //matikan jika menggunakan serialize
          processData: false, //matikan jika menggunakan serialize
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

    $('#kategori_id').select2({
      ajax: {
        url: baseurl + '/get_e_kategori',
        delay: 250,
        data: function(params) {
          var query = {
            search: params.term,
            type: 'public',
          }
          return query;
        },
        processResults: function(data) {
          return {
            results: data
          };
        }
      }
    });


  });

  $('[name=kategori_id]').on('change', function() {
    var id = $(this).val();
    var url = "{{ url('produk_id') . '/' }}" + id;
    console.log(id);
    console.log(url);
    $.ajax({
      url: url,
      type: "POST",
      data: {
        'id': id
      },
      success: function(data) {
        // $('#modalEdit').modal('hide');
        $('#id').val(data.id);
        $('#index').val(data.index);
        // table.ajax.reload();
        // myswal('s', data.message, 's', 1500);
      },
      error: function(data) {
        // myswal('e', data.message, 'e', 1500);
      }
    });
    return false;
  });

  function resetForm() {
    $('#formAdd')[0].reset();
    $('.select2').val('').change();
    $("#kategori_id").select2("val", "");
  }
</script>
@endsection