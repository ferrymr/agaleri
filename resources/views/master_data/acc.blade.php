@extends('layouts.app')

@section('content')
<div id="main" class="utama_panel"role="main">
  <div id="content">
    <div class="row">
      <div class="col-xs-12 col-sm-7 col-md-7 col-lg-4">
        <h1 class="page-title txt-color-blueDark"><i class="fa fa-desktop fa-fw "></i>
          Accessories
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
                      <form class="form-horizontal" method="POST" action="{{ url('add_acc') }}">
                        {{ csrf_field() }}

                        <div class="form-group">
                          <label for="id" class="col-md-2 control-label">Kode</label>
                          <div class="col-md-2">
                            <input id="id" type="text" class="form-control" name="id" value="{{ $newid }}" disabled="">
                          </div>
                        </div>

                        <div class="form-group{{ $errors->has('name') ? ' has-error' : '' }}">
                          <label for="name" class="col-md-2 control-label">Nama Accessories</label>

                          <div class="col-md-5">
                            <input id="name" type="text" class="form-control" name="name" value="{{ old('name') }}" required autofocus maxlength="75">
                            @if ($errors->has('name'))
                            <span class="help-block">
                              <strong>{{ $errors->first('name') }}</strong>
                            </span>
                            @endif
                          </div>
                        </div>

                        <div class="form-group">
                          <label class="col-md-2 control-label">Status</label>
                          <div class="col-md-10">
                            <label class="radio radio-inline">
                              <input type="radio" class="radiobox" name="isactive" value="A" checked="">
                              <span>Aktif</span>
                            </label>
                            <label class="radio radio-inline">
                              <input type="radio" class="radiobox" name="isactive" value="N">
                              <span>Non Aktif</span>
                            </label>
                          </div>
                        </div>

                        <div class="form-actions">
                          <div class="row">
                            <div class="col-md-12">
                              <button class="btn btn-primary" type="submit">
                                <i class="fa fa-save"></i>
                                Simpan
                              </button>
                            </div>
                          </div>
                        </div>
                      </form>
                    </div>

                  </div>
                </div>
              </div>
            </div>
          </article>
          <!-- WIDGET END -->

        </div>

      </section>
      <!-- end widget grid -->

      <!-- Widget ID (each widget will need unique ID)-->
      <div class="jarviswidget jarviswidget-color-orange" id="wid-id-3" data-widget-editbutton="false">
        <header>
          <span class="widget-icon"> <i class="fa fa-table"></i> </span>
          <h2>List Data</h2>

        </header>

        <!-- widget div-->
        <div>

          <!-- widget edit box -->
          <div class="jarviswidget-editbox">
            <!-- This area used as dropdown edit box -->

          </div>
          <!-- end widget edit box -->

          <!-- widget content -->
          <div class="widget-body no-padding">

            <table id="datatable_tabletools" class="table table-striped table-bordered table-hover" width="100%">
              <thead>
                <tr>
                  <th>ID</th>
                  <th>Name</th>
                  <th>Status</th>
                  <th>Action</th>
                </tr>
              </thead>
              <tbody>
                @foreach($data as $d)
                <tr>
                  <td>{{ $d->id }}</td>
                  <td id="listN{{ $d->id }}">{{ $d->name }}</td>
                  <td id="listA{{ $d->id }}">{{ ($d->isactive == 'A') ? 'Aktif' : 'Non Aktif' }}</td>
                  <td>
                    <a href="#" class="btn btn-xs btn-warning"  data-toggle="modal" data-target="#modalEdit" onclick="editData('{{ $d->id }}','{{ $d->name }}','{{$d->isactive}}')"><i class="fa fa-edit"></i> Edit</a>
                    <a href="#" class="btn btn-xs btn-danger" onclick="delData('{{ $d->id }}')"><i class="fa fa-remove"></i> Delete</a>
                  </tr>
                  @endforeach
                </tbody>
              </table>

            </div>
            <!-- end widget content -->

          </div>
          <!-- end widget div -->

        </div>
        <!-- end widget -->

      </div>
      <!-- END MAIN CONTENT -->

    </div>
    <!-- END MAIN PANEL -->

    <!-- Modal -->
    <div class="modal fade" id="modalEdit" tabindex="-1" role="dialog" aria-labelledby="modalEditLabel" aria-hidden="true">
      <div class="modal-dialog">
        <div class="modal-content">
          <div class="modal-header">
            <button type="button" class="close" data-dismiss="modal" aria-hidden="true">
              &times;
            </button>
            <h4 class="modal-title" id="modalEditLabel">Edit</h4>
          </div>
          <div class="modal-body">
            <form class="form-horizontal" method="POST" action="{{ url('update_acc') }}">
              {{ csrf_field() }}

              <div class="form-group">
                <label for="id" class="col-md-2 control-label">Kode</label>

                <div class="col-md-10">
                  <input id="id_edit" type="text" class="form-control" name="id_edit" readonly>
                </div>
              </div>

              <div class="form-group">
                <label for="name" class="col-md-2 control-label">Nama Accessories</label>

                <div class="col-md-10">
                  <input id="name_edit" type="text" class="form-control" name="name_edit" required autofocus  maxlength="75">
                </div>
              </div>

              <div class="form-group">
                <label class="col-md-2 control-label">Status</label>
                <div class="col-md-10">
                  <label class="radio radio-inline">
                    <input type="radio" class="radiobox" name="isactive_edit" id="isactive_edit_a" value="A">
                    <span>Aktif</span>
                  </label>
                  <label class="radio radio-inline">
                    <input type="radio" class="radiobox" name="isactive_edit" id="isactive_edit_n" value="N">
                    <span>Non Aktif</span>
                  </label>
                </div>
              </div>

              <div class="form-actions">
                <div class="row">
                  <div class="col-md-12">
                    <button class="btn btn-primary" type="submit">
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
    setTimeout(function () {
      $('.msg').hide();
    }, 3000);

    function editData(id,name,status) {
      console.log(id,name,status);
      $('[name=id_edit]').val(id);
      $('[name=name_edit]').val(name);
      if (status == 'A') {
        $('#isactive_edit_a').prop("checked", true);
      } else {
        $('#isactive_edit_n').prop("checked", true);
      }
    }

    function delData(id) {
      console.log(id);
      swal({
        title: 'Apa yakin?',
        text: "Data yang telah dihapus tidak dapat dikembalikan!",
        type: 'warning',
        showCancelButton: true,
        confirmButtonColor: '#3085d6',
        cancelButtonColor: '#d33',
        confirmButtonText: 'Ya, Hapus Data Ini!'
      }).then((result) => {
        if (result.value) {
          swal(
            'Deleted!',
            'Your file has been deleted.',
            'success'
          )
          sendAjax('/del_acc','POST',{id:id});
        }
      });
    }

    // DO NOT REMOVE : GLOBAL FUNCTIONS!

    $(document).ready(function() {

      pageSetUp();

      /* // DOM Position key index //

      l - Length changing (dropdown)
      f - Filtering input (search)
      t - The Table! (datatable)
      i - Information (records)
      p - Pagination (paging)
      r - pRocessing
      < and > - div elements
      <"#id" and > - div with an id
      <"class" and > - div with a class
      <"#id.class" and > - div with an id and class

      Also see: http://legacy.datatables.net/usage/features
      */

      /* BASIC ;*/
      var responsiveHelper_dt_basic = undefined;
      var responsiveHelper_datatable_fixed_column = undefined;
      var responsiveHelper_datatable_col_reorder = undefined;
      var responsiveHelper_datatable_tabletools = undefined;

      var breakpointDefinition = {
        tablet : 1024,
        phone : 480
      };

      $('#dt_basic').dataTable({
        "sDom": "<'dt-toolbar'<'col-xs-12 col-sm-6'f><'col-sm-6 col-xs-12 hidden-xs'l>r>"+
        "t"+
        "<'dt-toolbar-footer'<'col-sm-6 col-xs-12 hidden-xs'i><'col-xs-12 col-sm-6'p>>",
        "autoWidth" : true,
        "oLanguage": {
          "sSearch": '<span class="input-group-addon"><i class="glyphicon glyphicon-search"></i></span>'
        },
        "preDrawCallback" : function() {
          // Initialize the responsive datatables helper once.
          if (!responsiveHelper_dt_basic) {
            responsiveHelper_dt_basic = new ResponsiveDatatablesHelper($('#dt_basic'), breakpointDefinition);
          }
        },
        "rowCallback" : function(nRow) {
          responsiveHelper_dt_basic.createExpandIcon(nRow);
        },
        "drawCallback" : function(oSettings) {
          responsiveHelper_dt_basic.respond();
        }
      });

      /* END BASIC */

      /* TABLETOOLS */
      $('#datatable_tabletools').dataTable({

        // Tabletools options:
        //   https://datatables.net/extensions/tabletools/button_options
        "sDom": "<'dt-toolbar'<'col-xs-12 col-sm-6'f><'col-sm-6 col-xs-6 hidden-xs'T>r>"+
        "t"+
        "<'dt-toolbar-footer'<'col-sm-6 col-xs-12 hidden-xs'i><'col-sm-6 col-xs-12'p>>",
        "oLanguage": {
          "sSearch": '<span class="input-group-addon"><i class="glyphicon glyphicon-search"></i></span>'
        },
        "oTableTools": {
          "aButtons": [
            "copy",
            "csv",
            "xls",
            {
              "sExtends": "pdf",
              "sTitle": "SmartAdmin_PDF",
              "sPdfMessage": "SmartAdmin PDF Export",
              "sPdfSize": "letter"
            },
            {
              "sExtends": "print",
              "sMessage": "CV. LUNAWIJAYA</i>"
            }
          ],
          "sSwfPath": "js/plugin/datatables/swf/copy_csv_xls_pdf.swf"
        },
        "autoWidth" : true,
        "preDrawCallback" : function() {
          // Initialize the responsive datatables helper once.
          if (!responsiveHelper_datatable_tabletools) {
            responsiveHelper_datatable_tabletools = new ResponsiveDatatablesHelper($('#datatable_tabletools'), breakpointDefinition);
          }
        },
        "rowCallback" : function(nRow) {
          responsiveHelper_datatable_tabletools.createExpandIcon(nRow);
        },
        "drawCallback" : function(oSettings) {
          responsiveHelper_datatable_tabletools.respond();
        }
      });

      /* END TABLETOOLS */

    });

    </script>
    @endsection
