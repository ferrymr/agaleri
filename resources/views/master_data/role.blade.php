@extends('layouts.app')

@section('style')
<style>

</style>
@endsection

@section('content')
<div id="main" class="utama_panel"role="main">
  <div id="content">
    <div class="row">
      <div class="col-xs-12 col-sm-7 col-md-7 col-lg-4">
        <h1 class="page-title txt-color-blueDark"><i class="fa fa-desktop fa-fw "></i>
          {{ $title }}
        </h1>
      </div>
    </div>
    <section id="widget-grid" class="">
      <div class="row">
        <article class="col-sm-12 col-md-12 col-lg-12 sortable-grid ui-sortable">
          <div class="jarviswidget jarviswidget-color-orange" id="wid-id-1"  data-widget-editbutton="false" data-widget-colorbutton="false" data-widget-deletebutton="false" data-widget-fullscreenbutton="false" data-widget-collapsed="true">
            <header role="heading" class="ui-sortable-handle"><div class="jarviswidget-ctrls" role="menu">   <a href="javascript:void(0);" class="button-icon jarviswidget-toggle-btn" rel="tooltip" title="" data-placement="bottom" data-original-title="Collapse"><i class="fa fa-minus "></i></a> <a href="javascript:void(0);" class="button-icon jarviswidget-fullscreen-btn" rel="tooltip" title="" data-placement="bottom" data-original-title="Fullscreen"><i class="fa fa-expand "></i></a> <a href="javascript:void(0);" class="button-icon jarviswidget-delete-btn" rel="tooltip" title="" data-placement="bottom" data-original-title="Delete"><i class="fa fa-times"></i></a></div><div class="widget-toolbar" role="menu"><a data-toggle="dropdown" class="dropdown-toggle color-box selector" href="javascript:void(0);"></a><ul class="dropdown-menu arrow-box-up-right color-select pull-right"><li><span class="bg-color-green" data-widget-setstyle="jarviswidget-color-green" rel="tooltip" data-placement="left" data-original-title="Green Grass"></span></li><li><span class="bg-color-greenDark" data-widget-setstyle="jarviswidget-color-greenDark" rel="tooltip" data-placement="top" data-original-title="Dark Green"></span></li><li><span class="bg-color-greenLight" data-widget-setstyle="jarviswidget-color-greenLight" rel="tooltip" data-placement="top" data-original-title="Light Green"></span></li><li><span class="bg-color-purple" data-widget-setstyle="jarviswidget-color-purple" rel="tooltip" data-placement="top" data-original-title="Purple"></span></li><li><span class="bg-color-magenta" data-widget-setstyle="jarviswidget-color-magenta" rel="tooltip" data-placement="top" data-original-title="Magenta"></span></li><li><span class="bg-color-pink" data-widget-setstyle="jarviswidget-color-pink" rel="tooltip" data-placement="right" data-original-title="Pink"></span></li><li><span class="bg-color-pinkDark" data-widget-setstyle="jarviswidget-color-pinkDark" rel="tooltip" data-placement="left" data-original-title="Fade Pink"></span></li><li><span class="bg-color-blueLight" data-widget-setstyle="jarviswidget-color-blueLight" rel="tooltip" data-placement="top" data-original-title="Light Blue"></span></li><li><span class="bg-color-teal" data-widget-setstyle="jarviswidget-color-teal" rel="tooltip" data-placement="top" data-original-title="Teal"></span></li><li><span class="bg-color-blue" data-widget-setstyle="jarviswidget-color-blue" rel="tooltip" data-placement="top" data-original-title="Ocean Blue"></span></li><li><span class="bg-color-blueDark" data-widget-setstyle="jarviswidget-color-blueDark" rel="tooltip" data-placement="top" data-original-title="Night Sky"></span></li><li><span class="bg-color-darken" data-widget-setstyle="jarviswidget-color-darken" rel="tooltip" data-placement="right" data-original-title="Night"></span></li><li><span class="bg-color-yellow" data-widget-setstyle="jarviswidget-color-yellow" rel="tooltip" data-placement="left" data-original-title="Day Light"></span></li><li><span class="bg-color-orange" data-widget-setstyle="jarviswidget-color-orange" rel="tooltip" data-placement="bottom" data-original-title="Orange"></span></li><li><span class="bg-color-orangeDark" data-widget-setstyle="jarviswidget-color-orangeDark" rel="tooltip" data-placement="bottom" data-original-title="Dark Orange"></span></li><li><span class="bg-color-red" data-widget-setstyle="jarviswidget-color-red" rel="tooltip" data-placement="bottom" data-original-title="Red Rose"></span></li><li><span class="bg-color-redLight" data-widget-setstyle="jarviswidget-color-redLight" rel="tooltip" data-placement="bottom" data-original-title="Light Red"></span></li><li><span class="bg-color-white" data-widget-setstyle="jarviswidget-color-white" rel="tooltip" data-placement="right" data-original-title="Purity"></span></li><li><a href="javascript:void(0);" class="jarviswidget-remove-colors" data-widget-setstyle="" rel="tooltip" data-placement="bottom" data-original-title="Reset widget color to default">Remove</a></li></ul></div>
              <span class="widget-icon"> <i class="fa fa-plus"></i> </span>
              <h2>Tambah Data</h2>
              <span class="jarviswidget-loader"><i class="fa fa-refresh fa-spin"></i></span></header>
              <div role="content">
                <div class="widget-body">
                  <div role="content">
                    <div class="widget-body">
                      <form id="formAdd" method="post" class="form-horizontal" data-toggle="validator" enctype="multipart/form-data">
                        {{ csrf_field() }} {{ method_field('POST') }}

                        <fieldset>
                          <div class="form-group">
                            <label class="col-md-2 control-label">Nama {{ $title }}</label>
                            <div class="col-md-5">
                              <input class="form-control" name="name" placeholder="Masukkan Nama {{ $title }}" type="text" autofocus required maxlength="50">
                              <span class="help-block with-errors"></span>
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

          </section>
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
                      <!-- <th data-hide="phone">Kode</th> -->
                      <th data-class="expand">Nama {{ $title }}</th>
                      <th data-hide="phone">Action</th>
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
                <div class="col-md-2">
                  <input type="text" id="id_edit" name="id_edit" class="form-control" required readonly>
                  <span class="help-block with-errors"></span>
                </div>
              </div>

              <div class="form-group">
                <label for="name_edit" class="col-md-3 control-label">Nama {{ $title }}</label>
                <div class="col-md-9">
                  <input type="text" id="name_edit" name="name_edit" class="form-control" autofocus required>
                  <span class="help-block with-errors"></span>
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

    @endsection

    @section('script')
    <script>

    var tag   = '{{$tag}}';
    var table = $('#'+tag+'-table').DataTable({
      processing: true,
      serverSide: true,
      ajax: "{{ route('role.api') }}",
      columns: [
        // {data: 'id', name: 'id'},
        {data: 'role_name', name: 'role_name'},
        {data: 'action', name: 'action', orderable: false, searchable: false}
      ]
    });

    function editData(id) {
      save_method = 'edit';
      $('input[name=_method]').val('PATCH');
      $('#modalEdit form')[0].reset();
      $.ajax({
        url: "{{ url('role') }}" + '/' + id + "/edit",
        type: "GET",
        dataType: "JSON",
        success: function(data) {
          $('#modalEdit').modal('show');
          $('.modal-title').text('Edit Material ');
          $('#id_edit').val(data.id);
          $('#name_edit').val(data.role_name);
        },
        error : function() {
          myswal('e','No Data..','e',1500);
        }
      });
    }

    function deleteData(id){
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
            url : "{{ url('role') }}" + '/' + id,
            type : "POST",
            data : {'_method' : 'DELETE', '_token' : csrf_token},
            success : function(data) {
              table.ajax.reload();
              $('#id').val(data.newid);
              $('#name').focus();
              myswal('s',data.message,'s',1500);
            },
            error : function () {
              $('#id').val(data.newid);
              $('#name').focus();
              myswal('e',data.message,'e',1500);
            }
          });
        }
      });
    }

    $(function(){

      $('#btnResetAdd').on('click', function (e) {
        $('#formAdd')[0].reset();
      });

      $('#formAdd').validator().on('submit', function (e) {
        $('input[name=_method]').val('POST');
        if (!e.isDefaultPrevented()){
          url = "{{ url('role') }}";

          $.ajax({
            url : url,
            type : "POST",
            data : $('#formAdd').serialize(),
            success : function(data) {
              table.ajax.reload();
              $('#formAdd')[0].reset();
              if (data.status == true) {
                myswal('s',data.message,'s',1500);
                $('#name').focus();
              } else {
                myswal('e',data.message,'e',1500);
                $('#name').focus();
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
          url = "{{ url('role') . '/' }}" + id;

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
    });

    </script>
    @endsection
