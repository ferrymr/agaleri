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
        <article class="col-sm-12 col-md-12 col-lg-12">
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
                      <label class="col-md-2 control-label">Name</label>
                      <div class="col-md-5">
                        <input class="form-control" name="name" placeholder="Masukkan Nama {{ $title }}" type="text" autofocus required maxlength="150">
                        <span class="help-block with-errors"></span>
                      </div>
                    </div>

                    <div class="form-group">
                      <label for="" class="col-md-2 control-label">Produk</label>
                      <div class="col-md-2">
                        <select style="width:100%" id="id_produk" name="id_produk" class="form-control"></select>
                      </div>
                    </div>

                    <div class="form-group">
                      <label class="col-md-2 control-label">Price Promo</label>
                      <div class="col-md-2">
                        <input class="form-control" name="price" placeholder="Masukkan Harga {{ $title }}" type="number" required>
                      </div>
                    </div>

                    <div class="form-group">
                      <label for="keterangan" class="col-md-2 control-label">Keterangan</label>
                      <div class="col-md-10">
                        <input type="text" id="keterangan" name="keterangan" class="form-control" autofocus required>
                        <span class="help-block with-errors"></span>
                      </div>
                    </div>

                    <div class="form-group">
                      <label class="col-md-2 control-label">Dari Tanggal</label>
                      <div class="itemLine col-md-2">
                        <div class="input-group">
                          <input class="form-control" id="from" name="from" type="text" placeholder="Tanggal Awal" style="z-index:100;">
                          <span class="input-group-addon"><i class="fa fa-calendar"></i></span>
                        </div>
                      </div>
                      <label class="col-md-1 control-label">Sampai</label>
                      <div class="itemLine col-md-2">
                        <div class="input-group">
                          <input class="form-control" id="to" name="to" type="text" placeholder="Tanggal Akhir">
                          <span class="input-group-addon"><i class="fa fa-calendar"></i></span>
                        </div>
                      </div>
                    </div>

                    <div class="form-group">
                      <label class="col-md-2 control-label">Status</label>
                      <div class="col-md-10">
                        <label class="radio radio-inline">
                          <input type="radio" value="A" class="radiobox" name="status" checked>
                          <span>Aktif</span>
                        </label>
                        <label class="radio radio-inline">
                          <input type="radio" value="N" class="radiobox" name="status">
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
                      <th>ID</th>
                      <th>Name {{ $title }}</th>
                      <th>Tanggal Mulai</th>
                      <th>Tanggal Akhir</th>
                      <th>Nama Barang</th>
                      <th>Harga</th>
                      <th>Keterangan</th>
                      <th>Status</th>
                      <th>Action</th>
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
              <label for="id_edit" class="col-md-3 control-label">ID {{ $title }}</label>
              <div class="col-md-2">
                <input type="text" id="id_edit" name="id_edit" class="form-control" required readonly>
                <span class="help-block with-errors"></span>
              </div>
            </div>

            <div class="form-group">
              <label for="name_edit" class="col-md-3 control-label">Name {{ $title }}</label>
              <div class="col-md-9">
                <input type="text" id="name_edit" name="name_edit" class="form-control" autofocus required>
                <span class="help-block with-errors"></span>
              </div>
            </div>

            <div class="form-group">
              <label for="" class="col-md-3 control-label">Produk</label>
              <div class="col-md-2">
                <input type="text" id="id_produk_edit" name="id_produk_edit" class="form-control" readonly>
              </div>
              <div class="col-md-4">
                <input type="text" id="produk_edit" name="produk_edit" class="form-control" readonly>
              </div>
            </div>

            <div class="form-group">
              <label class="col-md-3 control-label">Price Promo</label>
              <div class="col-md-4">
                <input class="form-control" id="price_edit" name="price_edit" placeholder="Masukkan Harga {{ $title }}" type="number" required>
              </div>
            </div>

            <div class="form-group">
              <label for="keterangan_edit" class="col-md-3 control-label">Keterangan</label>
              <div class="col-md-9">
                <input type="text" id="keterangan_edit" name="keterangan_edit" class="form-control" autofocus required>
                <span class="help-block with-errors"></span>
              </div>
            </div>

            <div class="form-group">
              <label class="col-md-3 control-label">Dari Tanggal</label>
              <div class="itemLine col-md-3">
                <div class="input-group">
                  <input class="form-control" id="from_edit" name="from_edit" type="text" placeholder="Tanggal Awal" style="z-index:4000;">
                  <span class="input-group-addon"><i class="fa fa-calendar"></i></span>
                </div>
              </div>

              <label class="col-md-2 control-label">Sampai</label>
              <div class="itemLine col-md-3">
                <div class="input-group">
                  <input class="form-control" id="to_edit" name="to_edit" type="text" placeholder="Tanggal Akhir" style="z-index:4000;">
                  <span class="input-group-addon"><i class="fa fa-calendar"></i></span>
                </div>
              </div>
            </div>

            <div class="form-group">
              <label class="col-md-3 control-label">Status</label>
              <div class="col-md-9">
                <label class="radio radio-inline" style="z-index:unset;">
                  <input type="radio" value="A" class="radiobox" id="status_edit_a" name="status_edit">
                  <span>Aktif</span>
                </label>
                <label class="radio radio-inline">
                  <input type="radio" value="N" class="radiobox" id="status_edit_n" name="status_edit">
                  <span>Non Aktif</span>
                </label>
              </div>
            </div>
          </div>

          <div class="modal-footer">
            <button type="submit" class="btn btn-primary btn-save"><i class="fa fa-send"></i> Update</button>
            <button type="button" class="btn btn-default" data-dismiss="modal"><i class="fa fa-refresh"></i> Cancel</button>
          </div>

        </form>
      </div>
    </div>
  </div>


  <!-- END MAIN CONTENT -->
  @endsection

  @section('script')
  <script>
    var token = $('meta[name="csrf-token"]').attr('content');
    var tag = '{{$tag}}';
    var table = $('#' + tag + '-table').DataTable({
      processing: true,
      serverSide: true,
      ajax: "{{ route('promo.api') }}",
      columns: [{
          data: 'id',
          name: 'id'
        },
        {
          data: 'name',
          name: 'name'
        },
        {
          data: 'start_date',
          name: 'start_date'
        },
        {
          data: 'end_date',
          name: 'end_date'
        },
        {
          data: 'nama_barang',
          name: 'nama_barang'
        },
        {
          data: 'price',
          name: 'price'
        },
        {
          data: 'keterangan',
          name: 'keterangan'
        },
        {
          data: 'status',
          name: 'status'
        },
        {
          data: 'action',
          name: 'action',
          orderable: false,
          searchable: false
        }
      ]
    });

    $("#from").datepicker({
      dateFormat: 'dd/mm/yy',
      defaultDate: "+1w",
      changeMonth: true,
      numberOfMonths: 1,
      prevText: '<i class="fa fa-chevron-left"></i>',
      nextText: '<i class="fa fa-chevron-right"></i>',
      onClose: function(selectedDate) {
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
      onClose: function(selectedDate) {
        $("#from").datepicker("option", "maxDate", selectedDate);
      }
    }).datepicker("setDate", new Date());


    $("#from_edit").datepicker({
      dateFormat: 'dd/mm/yy',
      defaultDate: "+1w",
      changeMonth: true,
      numberOfMonths: 1,
      prevText: '<i class="fa fa-chevron-left"></i>',
      nextText: '<i class="fa fa-chevron-right"></i>',
      onClose: function(selectedDate) {
        $("#to_edit").datepicker("option", "minDate", selectedDate);
      }
    }).datepicker("setDate", new Date());

    $("#to_edit").datepicker({
      dateFormat: 'dd/mm/yy',
      defaultDate: "+1w",
      changeMonth: true,
      numberOfMonths: 1,
      prevText: '<i class="fa fa-chevron-left"></i>',
      nextText: '<i class="fa fa-chevron-right"></i>',
      onClose: function(selectedDate) {
        $("#from_edit").datepicker("option", "maxDate", selectedDate);
      }
    }).datepicker("setDate", new Date());



    $('#id_produk').select2({
      ajax: {
        url: baseurl + '/get_e_produk',
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

    // $('#id_produk_edit').select2({
    //   ajax: {
    //     url: baseurl + '/get_e_produk',
    //     delay: 250,
    //     data: function(params) {
    //       var query = {
    //         search: params.term,
    //         type: 'public',
    //       }
    //       return query;
    //     },
    //     processResults: function(data) {
    //       return {
    //         results: data
    //       };
    //     }
    //   }
    // });

    function editData(id) {
      save_method = 'edit';
      $('input[name=_method]').val('PATCH');
      $('#modalEdit form')[0].reset();
      $.ajax({
        url: "{{ url('promo') }}" + '/' + id + "/edit",
        type: "GET",
        dataType: "JSON",
        success: function(rsp) {
          var data = rsp[0];
          $('#modalEdit').modal('show');
          $('.modal-title').text('Edit Pages ');
          $('#id_edit').val(data.id);
          $('#name_edit').val(data.name);
          $('#price_edit').val(data.price);
          $('#id_produk_edit').val(data.id_barang);
          $('#produk_edit').val(data.nama_produk);
          // $('#id_produk_edit').val('').trigger('change');
          // var dataProdcuk = {
          //   id: data.id_barang,
          //   text: data.nama_produk
          // };
          // if (data.id_barang != '') {
          //   var newOption = new Option(dataProdcuk.text, dataProdcuk.id, false, false);
          //   $('#id_produk_edit').append(newOption).trigger('change');
          // }
          $('#from_edit').val(data.start_date);
          $('#to_edit').val(data.end_date);
          $('#keterangan_edit').val(data.keterangan);
          if (data.status == 'A') {
            $('#status_edit_a').prop('checked', true);
          } else {
            $('#status_edit_n').prop('checked', true);
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
            url: "{{ url('promo') }}" + '/' + id,
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
          url = "{{ url('promo') }}";

          $.ajax({
            url: url,
            type: "POST",
            data: new FormData($("#formAdd")[0]),
            // data : $('#formAdd').serialize(),
            contentType: false, //matikan jika menggunakan serialize
            processData: false, //matikan jika menggunakan serialize
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
          // $('[name=content_edit]').val(CKEDITOR.instances['content_promo_edit'].getData());
          var id = $('#id_edit').val();
          url = "{{ url('promo') . '/' }}" + id;

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
              // $('#id_produk_edit').val(null).trigger('change');
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

  <script>
    // CKEDITOR.replace('content_promo', {
    //   height: '380px',
    //   startupFocus: true
    // });

    // CKEDITOR.replace('content_promo_edit', {
    //   height: '380px',
    //   startupFocus: true
    // });
  </script>

  @endsection