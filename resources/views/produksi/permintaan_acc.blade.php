@extends('layouts.app')

@section('style')
<style>

</style>
@endsection

@section('content')
<!-- MAIN PANEL -->
<div id="main" class="utama_panel"role="main">
  <!-- MAIN CONTENT -->
  <div id="content">

    <div class="row">
      <div class="col-xs-12 col-sm-7 col-md-7 col-lg-4">
        <h1 class="page-title txt-color-blueDark"><i class="fa fa-desktop fa-fw "></i>
          {{ $title }}
        </h1>
      </div>
    </div>
    <!-- widget grid -->
    <section id="widget-grid" class="">

      <div class="row">

        <!-- NEW WIDGET START -->
        <article class="col-sm-12 col-md-12 col-lg-12 sortable-grid ui-sortable">

          <!-- Widget ID (each widget will need unique ID)-->
          <div class="jarviswidget jarviswidget-color-orange jarviswidget-sortable" id="wid-id-1" data-widget-editbutton="false" role="widget">
            <header role="heading" class="ui-sortable-handle"><div class="jarviswidget-ctrls" role="menu">   <a href="javascript:void(0);" class="button-icon jarviswidget-toggle-btn" rel="tooltip" title="" data-placement="bottom" data-original-title="Collapse"><i class="fa fa-minus "></i></a> <a href="javascript:void(0);" class="button-icon jarviswidget-fullscreen-btn" rel="tooltip" title="" data-placement="bottom" data-original-title="Fullscreen"><i class="fa fa-expand "></i></a> <a href="javascript:void(0);" class="button-icon jarviswidget-delete-btn" rel="tooltip" title="" data-placement="bottom" data-original-title="Delete"><i class="fa fa-times"></i></a></div><div class="widget-toolbar" role="menu"><a data-toggle="dropdown" class="dropdown-toggle color-box selector" href="javascript:void(0);"></a><ul class="dropdown-menu arrow-box-up-right color-select pull-right"><li><span class="bg-color-green" data-widget-setstyle="jarviswidget-color-green" rel="tooltip" data-placement="left" data-original-title="Green Grass"></span></li><li><span class="bg-color-greenDark" data-widget-setstyle="jarviswidget-color-greenDark" rel="tooltip" data-placement="top" data-original-title="Dark Green"></span></li><li><span class="bg-color-greenLight" data-widget-setstyle="jarviswidget-color-greenLight" rel="tooltip" data-placement="top" data-original-title="Light Green"></span></li><li><span class="bg-color-purple" data-widget-setstyle="jarviswidget-color-purple" rel="tooltip" data-placement="top" data-original-title="Purple"></span></li><li><span class="bg-color-magenta" data-widget-setstyle="jarviswidget-color-magenta" rel="tooltip" data-placement="top" data-original-title="Magenta"></span></li><li><span class="bg-color-pink" data-widget-setstyle="jarviswidget-color-pink" rel="tooltip" data-placement="right" data-original-title="Pink"></span></li><li><span class="bg-color-pinkDark" data-widget-setstyle="jarviswidget-color-pinkDark" rel="tooltip" data-placement="left" data-original-title="Fade Pink"></span></li><li><span class="bg-color-blueLight" data-widget-setstyle="jarviswidget-color-blueLight" rel="tooltip" data-placement="top" data-original-title="Light Blue"></span></li><li><span class="bg-color-teal" data-widget-setstyle="jarviswidget-color-teal" rel="tooltip" data-placement="top" data-original-title="Teal"></span></li><li><span class="bg-color-blue" data-widget-setstyle="jarviswidget-color-blue" rel="tooltip" data-placement="top" data-original-title="Ocean Blue"></span></li><li><span class="bg-color-blueDark" data-widget-setstyle="jarviswidget-color-blueDark" rel="tooltip" data-placement="top" data-original-title="Night Sky"></span></li><li><span class="bg-color-darken" data-widget-setstyle="jarviswidget-color-darken" rel="tooltip" data-placement="right" data-original-title="Night"></span></li><li><span class="bg-color-yellow" data-widget-setstyle="jarviswidget-color-yellow" rel="tooltip" data-placement="left" data-original-title="Day Light"></span></li><li><span class="bg-color-orange" data-widget-setstyle="jarviswidget-color-orange" rel="tooltip" data-placement="bottom" data-original-title="Orange"></span></li><li><span class="bg-color-orangeDark" data-widget-setstyle="jarviswidget-color-orangeDark" rel="tooltip" data-placement="bottom" data-original-title="Dark Orange"></span></li><li><span class="bg-color-red" data-widget-setstyle="jarviswidget-color-red" rel="tooltip" data-placement="bottom" data-original-title="Red Rose"></span></li><li><span class="bg-color-redLight" data-widget-setstyle="jarviswidget-color-redLight" rel="tooltip" data-placement="bottom" data-original-title="Light Red"></span></li><li><span class="bg-color-white" data-widget-setstyle="jarviswidget-color-white" rel="tooltip" data-placement="right" data-original-title="Purity"></span></li><li><a href="javascript:void(0);" class="jarviswidget-remove-colors" data-widget-setstyle="" rel="tooltip" data-placement="bottom" data-original-title="Reset widget color to default">Remove</a></li></ul></div>
              <span class="widget-icon"> <i class="fa fa-sitemap"></i> </span>
              <h2>Form {{ $title }}</h2>
              <span class="jarviswidget-loader"><i class="fa fa-refresh fa-spin"></i></span></header>

              <!-- widget div-->
              <div role="content">

                <!-- widget edit box -->
                <div class="jarviswidget-editbox">
                  <!-- This area used as dropdown edit box -->

                </div>
                <!-- end widget edit box -->

                <!-- widget content -->
                <div class="widget-body">
                  <div role="content">

                    <!-- widget content -->
                    <div class="widget-body">
                      <form id="formAdd" class="form-horizontal" method="post" data-toggle="validator" enctype="multipart/form-data">
                        {{ csrf_field() }} {{ method_field('POST') }}
                        <div class="form-group">
                          <label for="tanggal" class="col-md-2 control-label">Tanggal</label>
                          <div class="col-md-2">
                            <div class="input-group">
                              <input readonly type="text" name="tanggal" placeholder="Pilih tanggal" class="form-control datepicker" data-dateformat="dd/mm/yy" value="{{ $tanggal }}">
                              <span class="input-group-addon"><i class="fa fa-calendar"></i></span>
                            </div>
                          </div>
                        </div>

                        <div class="form-group">
                          <label for="id" class="col-md-2 control-label">No Bukti Permintaan</label>
                          <div class="col-md-2">
                            <input id="no_bukti_permintaan" name="no_bukti_permintaan" type="text" class="form-control"  value="{{ $newid }}" readonly>
                          </div>
                        </div>

                        <div class="form-group">
                          <label for="" class="col-md-2 control-label">Kode Produksi/ SO</label>
                          <div class="col-md-3">
                            <select style="width:100%" id="id_so" name="id_so" class="form-control" required></select>
                          </div>
                        </div>

                        <fieldset>
                          <legend>Details {{ $title }}</legend>
                          <div class="form-group">
                            <div class="col-md-2">
                              <label class="control-label">Kode</label>
                            </div>
                            <div class="col-md-2">
                              <label class="control-label">Jenis Accessories</label>
                            </div>
                            <div class="col-md-1">
                              <label class="control-label">Brand</label>
                            </div>
                            <div class="col-md-2">
                              <label class="control-label">Supplier</label>
                            </div>
                            <div class="col-md-1">
                              <label class="control-label">Qty</label>
                            </div>
                            <div class="col-md-1">
                              <label class="control-label">Sat</label>
                            </div>
                            <div class="col-md-2">
                              <label class="control-label">Keterangan</label>
                            </div>
                          </div>
                          <div id="detail">
                            <div class="detailLine form-group">
                              <div class="itemLine col-md-2">
                                <input name="kode_acc[]" type="text" class="form-control" readonly>
                              </div>
                              <div class="itemLine col-md-2">
                                <select name="id_acc[]" style="width:100%;" value="" required></select>
                              </div>
                              <div class="itemLine col-md-1">
                                <select name="id_brand[]" style="width:100%;" value="" required></select>
                              </div>
                              <div class="itemLine col-md-2">
                                <select name="id_supplier[]" style="width:100%;" value="" required></select>
                              </div>
                              <div class="itemLine col-md-1">
                                <input name="qty[]" onblur="calc_qty();" type="decimal" class="form-control ribuan" value="" required>
                              </div>
                              <div class="itemLine col-md-1">
                                <select name="satuan_id[]" style="width:100%;" value="" required></select>
                              </div>
                              <div class="itemLine col-md-3">
                                <input name="ket[]" type="text" class="form-control" value="">
                              </div>
                            </div>
                          </div>
                          <input type="hidden" name="total" value="">
                          <div class="form-group">
                            <div class="col-md-7">
                              <button id="btnAddLine" class="btn btn-primary btn-circle"><i class="glyphicon glyphicon-plus"></i></button>
                            </div>
                            <div class="col-md-1">
                              <input name="total_qty" type="decimal" class="form-control decimal" value="">
                            </div>
                          </div>
                        </fieldset>

                        <div class="form-actions">
                          <div class="row">
                            <div class="col-md-12">
                              <button type="submit" class="btn btn-primary" id="btnSend">
                                <i class="fa fa-send"></i>
                                Simpan
                              </button>
                              <button class="btn btn-warning" id="btnReset">
                                <i class="fa fa-refresh"></i>
                                Reset
                              </button>
                            </div>
                          </div>
                        </div>
                      </form>

                    </div>
                    <!-- end widget content -->

                  </div></div></div></div></article>
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

                  <div class="widget-body">

                    <table id="{{$tag}}-table" class="table table-striped table-bordered table-hover" width="100%">
                      <thead>
                        <tr>
                          <th>No. Permintaan</th>
                          <th>Tanggal</th>
                          <th>No. SO</th>
                          <th>Nama Produk</th>
                          <th>Qty</th>
                        </tr>
                      </thead>
                      <tbody>
                      </tbody>
                    </table>

                  </div>
                  <!-- end widget div -->

                </div>
                <!-- end widget -->

              </div>
              <!-- END MAIN CONTENT -->

            </div>
            <!-- END MAIN PANEL -->

            @endsection

            @section('script')
            <script>
            runRibuan();
            runDecimal();
            var tag   = '{{$tag}}';
            var table = $('#'+tag+'-table').DataTable({
              processing: true,
              serverSide: true,
              ajax: "{{ route('permintaan_acc.api') }}",
              columns: [
                {data: 'id', name: 'id'},
                {data: 'tanggal', name: 'tanggal'},
                {data: 'id_produksi', name: 'id_produksi'},
                {data: 'nama_produk', name: 'nama_produk'},
                {data: 'qty', name: 'qty'},
              ]
            });

            select2Run();
            setpcs($('[name="satuan_id[]"]'));
            function select2Run() {
              $('#id_so').select2({
                ajax: {
                  url: baseurl+'/get_produksi',
                  delay:250,
                  data: function (params) {
                    var query = {
                      search: params.term,
                      type: 'public',
                      jenis: 'proses_ok',
                      kategori: 'acc'
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

              $('[name="id_acc[]"]').select2({
                ajax: {
                  url: baseurl+'/get_acc',
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

              $('[name="id_brand[]"]').select2({
                ajax: {
                  url: baseurl+'/get_brand',
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

              $('[name="id_supplier[]"]').select2({
                ajax: {
                  url: baseurl+'/get_supplier',
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

              $('[name="satuan_id[]"]').select2({
                ajax: {
                  url: baseurl+'/get_satuan',
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

            }

            $(function(){

              $('#btnReset').on('click', function (e) {
                resetForm();
              });

              $('#formAdd').validator().on('submit', function (e) {
                var total = 0;
                $('[name="qty[]"]').each(function () {
                  var val = $(this).val();
                  if (val != '') total = parseFloat(ribuantodb(val)) + parseFloat(total);
                });
                $('[name="total"]').val(total);
                $('input[name=_method]').val('POST');
                if (!e.isDefaultPrevented()){
                  var id = $('#id').val();
                  url = "{{ url('permintaan_acc') }}";

                  $.ajax({
                    url : url,
                    type : "POST",
                    data : $('#formAdd').serialize(),
                    success : function(data) {
                      resetForm();
                      table.ajax.reload();
                      if (data.status == true) {
                        myswal('s',data.message,'s',1500);
                        $('[name=no_bukti_permintaan]').val(data.newid);
                      } else {
                        myswal('e',data.message,'e',1500);
                        $('#id').val(id);
                      }
                    },
                    error : function(data){
                      myswal('e',data.message,'e',1500);
                    }
                  });
                  return false;
                }
              });

              $('#btnAddLine').on('click',function (e) {
                addRow();
                e.preventDefault();
              });

              $('#detail').on('keyup','input[name="qty[]"]:last', function (e) {
                addRow();
                e.preventDefault();
              });

              $('#detail').on('change','select', function (e) {
                var self = $(this);
                var kode_acc = self.parents('.detailLine').find('[name="kode_acc[]"]');
                var id_acc = self.parents('.detailLine').find('select[name="id_acc[]"]').val();
                var id_brand = self.parents('.detailLine').find('[name="id_brand[]"]').val();
                var id_supplier = self.parents('.detailLine').find('[name="id_supplier[]"]').val();
                if (id_acc == null) id_acc='';
                if (id_brand == null) id_brand='';
                if (id_supplier == null) id_supplier='';
                kode_acc.val(id_acc+'-'+id_brand+'-'+id_supplier+'');
              });

            });

            //Fungsi Reset Data form
            function resetForm() {
              $('#formAdd')[0].reset();
              $('.select2').val('').change();
              $("#id_so").select2("val", "");
              $('.detailLine').not(':eq(0)').remove();
              clearSelect2Detail();
              select2Run();
            }

            function clearSelect2Detail() {
              $('[name="id_acc[]"]:last,[name="id_brand[]"]:last,[name="id_supplier[]"]:last,[name="satuan_id[]"]:last').select2("val", "");
            }

            function addRow() {
              var detailLine = $('#detail .detailLine').eq(0).html();
              $('#detail .detailLine').last().after('<div class="detailLine form-group">'+detailLine+'</div>');
              $('[name="id_acc[]"]:last,[name="id_brand[]"]:last,[name="id_supplier[]"]:last,[name="satuan_id[]"]:last').next(".select2-container").hide();
              select2Run();
              clearSelect2Detail();
              setkg($('[name="satuan_id[]"]'));
              runRibuan();
              runDecimal();
            }

            </script>
            @endsection
