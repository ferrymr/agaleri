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
          <div class="jarviswidget jarviswidget-color-orange jarviswidget-sortable" id="wid-id-1" data-widget-editbutton="false" role="widget">
            <header role="heading" class="ui-sortable-handle"><div class="jarviswidget-ctrls" role="menu">   <a href="javascript:void(0);" class="button-icon jarviswidget-toggle-btn" rel="tooltip" title="" data-placement="bottom" data-original-title="Collapse"><i class="fa fa-minus "></i></a> <a href="javascript:void(0);" class="button-icon jarviswidget-fullscreen-btn" rel="tooltip" title="" data-placement="bottom" data-original-title="Fullscreen"><i class="fa fa-expand "></i></a> <a href="javascript:void(0);" class="button-icon jarviswidget-delete-btn" rel="tooltip" title="" data-placement="bottom" data-original-title="Delete"><i class="fa fa-times"></i></a></div><div class="widget-toolbar" role="menu"><a data-toggle="dropdown" class="dropdown-toggle color-box selector" href="javascript:void(0);"></a><ul class="dropdown-menu arrow-box-up-right color-select pull-right"><li><span class="bg-color-green" data-widget-setstyle="jarviswidget-color-green" rel="tooltip" data-placement="left" data-original-title="Green Grass"></span></li><li><span class="bg-color-greenDark" data-widget-setstyle="jarviswidget-color-greenDark" rel="tooltip" data-placement="top" data-original-title="Dark Green"></span></li><li><span class="bg-color-greenLight" data-widget-setstyle="jarviswidget-color-greenLight" rel="tooltip" data-placement="top" data-original-title="Light Green"></span></li><li><span class="bg-color-purple" data-widget-setstyle="jarviswidget-color-purple" rel="tooltip" data-placement="top" data-original-title="Purple"></span></li><li><span class="bg-color-magenta" data-widget-setstyle="jarviswidget-color-magenta" rel="tooltip" data-placement="top" data-original-title="Magenta"></span></li><li><span class="bg-color-pink" data-widget-setstyle="jarviswidget-color-pink" rel="tooltip" data-placement="right" data-original-title="Pink"></span></li><li><span class="bg-color-pinkDark" data-widget-setstyle="jarviswidget-color-pinkDark" rel="tooltip" data-placement="left" data-original-title="Fade Pink"></span></li><li><span class="bg-color-blueLight" data-widget-setstyle="jarviswidget-color-blueLight" rel="tooltip" data-placement="top" data-original-title="Light Blue"></span></li><li><span class="bg-color-teal" data-widget-setstyle="jarviswidget-color-teal" rel="tooltip" data-placement="top" data-original-title="Teal"></span></li><li><span class="bg-color-blue" data-widget-setstyle="jarviswidget-color-blue" rel="tooltip" data-placement="top" data-original-title="Ocean Blue"></span></li><li><span class="bg-color-blueDark" data-widget-setstyle="jarviswidget-color-blueDark" rel="tooltip" data-placement="top" data-original-title="Night Sky"></span></li><li><span class="bg-color-darken" data-widget-setstyle="jarviswidget-color-darken" rel="tooltip" data-placement="right" data-original-title="Night"></span></li><li><span class="bg-color-yellow" data-widget-setstyle="jarviswidget-color-yellow" rel="tooltip" data-placement="left" data-original-title="Day Light"></span></li><li><span class="bg-color-orange" data-widget-setstyle="jarviswidget-color-orange" rel="tooltip" data-placement="bottom" data-original-title="Orange"></span></li><li><span class="bg-color-orangeDark" data-widget-setstyle="jarviswidget-color-orangeDark" rel="tooltip" data-placement="bottom" data-original-title="Dark Orange"></span></li><li><span class="bg-color-red" data-widget-setstyle="jarviswidget-color-red" rel="tooltip" data-placement="bottom" data-original-title="Red Rose"></span></li><li><span class="bg-color-redLight" data-widget-setstyle="jarviswidget-color-redLight" rel="tooltip" data-placement="bottom" data-original-title="Light Red"></span></li><li><span class="bg-color-white" data-widget-setstyle="jarviswidget-color-white" rel="tooltip" data-placement="right" data-original-title="Purity"></span></li><li><a href="javascript:void(0);" class="jarviswidget-remove-colors" data-widget-setstyle="" rel="tooltip" data-placement="bottom" data-original-title="Reset widget color to default">Remove</a></li></ul></div>
              <span class="widget-icon"> <i class="fa fa-sitemap"></i> </span>
              <h2>Form {{ $title }}</h2>
              <span class="jarviswidget-loader"><i class="fa fa-refresh fa-spin"></i></span></header>
              <div role="content">
                <div class="widget-body">
                  <div role="content">
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
                          <div class="col-md-5">
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
                              <label class="control-label">Jenis Bahan Baku</label>
                            </div>
                            <div class="col-md-1">
                              <label class="control-label">Warna</label>
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
                            <!-- <div class="detailLine form-group">
                              <div class="itemLine col-md-2">
                                <input name="kode_bb[]" type="text" class="form-control" readonly>
                              </div>
                              <div class="itemLine col-md-2">
                                <select name="id_bb[]" style="width:100%;" value="" required></select>
                              </div>
                              <div class="itemLine col-md-1">
                                <select name="id_warna[]" style="width:100%;" value="" required></select>
                              </div>
                              <div class="itemLine col-md-2">
                                <select name="id_supplier[]" style="width:100%;" value="" required></select>
                              </div>
                              <div class="itemLine col-md-1">
                                <input name="qty[]" type="decimal" onblur="calc_qty();" class="form-control decimal" value="" required>
                              </div>
                              <div class="itemLine col-md-1">
                                <select name="satuan_id[]" style="width:100%;" value="" required></select>
                              </div>
                              <div class="itemLine col-md-3">
                                <input name="ket[]" type="text" class="form-control" value="">
                              </div>
                            </div> -->
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

                  </div>
                </div>
              </div>
            </div>
          </article>
         </div>
         </section>
              <div class="jarviswidget jarviswidget-color-orange" id="wid-id-3" data-widget-editbutton="false">
                <header>
                  <span class="widget-icon"> <i class="fa fa-table"></i> </span>
                  <h2>List Data</h2>
                </header>
                <div>
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
                </div>
              </div>
            </div>
            @endsection

            @section('script')
            <script>
            runRibuan();
            runDecimal();
            var tag   = '{{$tag}}';
            var table = $('#'+tag+'-table').DataTable({
              processing: true,
              serverSide: true,
              ajax: "{{ route('permintaan_bb.api') }}",
              columns: [
                {data: 'id', name: 'id'},
                {data: 'tanggal', name: 'tanggal'},
                {data: 'id_produksi', name: 'id_produksi'},
                {data: 'nama_produk', name: 'nama_produk'},
                {data: 'qty', name: 'qty'},
                // {data: 'total', name: 'total'},
              ]
            });

            select2Run();
            setkg($('[name="satuan_id[]"]'));
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
                      kategori: 'bb'
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

              $('[name="id_bb[]"]').select2({
                ajax: {
                  url: baseurl+'/get_bb',
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

              $('[name="id_warna[]"]').select2({
                ajax: {
                  url: baseurl+'/get_warna',
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

              $('#id_so').on('change', function (e){

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
                  url = "{{ url('permintaan_bb') }}";

                  $.ajax({
                    url : url,
                    type : "POST",
                    data : $('#formAdd').serialize(),
                    success : function(data) {
                      console.log('sukses');
                      resetForm();
                      table.ajax.reload();
                      if (data.status == true) {
                        swal({
                          title: 'Success!',
                          text: data.message,
                          type: 'success',
                          timer: '1500'
                        });
                        $('[name=no_bukti_permintaan]').val(data.newid);
                      } else {
                        swal({
                          title: 'Oops...',
                          text: data.message,
                          type: 'error',
                          timer: '1500'
                        });
                        $('#id').val(id);
                      }
                    },
                    error : function(data){
                      swal({
                        title: 'Oops...',
                        text: data.message,
                        type: 'error',
                        timer: '1500'
                      })
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
                var kode_bb = self.parents('.detailLine').find('[name="kode_bb[]"]');
                var id_bb = self.parents('.detailLine').find('select[name="id_bb[]"]').val();
                var id_warna = self.parents('.detailLine').find('[name="id_warna[]"]').val();
                var id_brand = self.parents('.detailLine').find('[name="id_brand[]"]').val();
                var id_supplier = self.parents('.detailLine').find('[name="id_supplier[]"]').val();
                if (id_bb == null) id_bb='';
                if (id_warna == null) id_warna='';
                if (id_supplier == null) id_supplier='';
                kode_bb.val(id_bb+'-'+id_warna+'-'+id_supplier+'');
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
              $('[name="id_bb[]"]:last,[name="id_warna[]"]:last,[name="id_brand[]"]:last,[name="id_supplier[]"]:last,[name="satuan_id[]"]:last').select2("val", "");
            }

            function addRow() {
              var detailLine = $('#detail .detailLine').eq(0).html();
              $('#detail .detailLine').last().after('<div class="detailLine form-group">'+detailLine+'</div>');
              $('[name="id_bb[]"]:last,[name="id_warna[]"]:last,[name="id_brand[]"]:last,[name="id_supplier[]"]:last,[name="satuan_id[]"]:last').next(".select2-container").hide();
              select2Run();
              clearSelect2Detail();
              setkg($('[name="satuan_id[]"]'));
              runRibuan();
              runDecimal();
            }

  changeSo();
  function changeSo() {
    $('[name="id_so"]').on('change', function () {
      var id        = $(this).val();
      var append    = '';
      if (id != null) {
        sendajax('POST','/get_detail_so',{id:id})
        .done(function (rs) {
          console.log(rs);
          for (var i = 0; i < rs.length; i++) {
            $('.detailLine').not(':eq(0)').remove();
            if(rs.length > 1){
              addRow();
            }

            append += '<div class="detailLine form-group">\n\
            <div class="itemLine col-md-2">\n\
             <input name="kode_bb[]" type="text" value="'+rs[i].bb_id+'-'+rs[i].warna_a+'" class="form-control" readonly>\n\
            </div>\n\
            <div class="itemLine col-md-2">\n\
            <select name="id_bb[]" style="width:100%;" value="'+rs[i].bb_id+'" required></select>\n\
            </div>\n\
            <div class="itemLine col-md-1">\n\
            <select name="id_warna[]" style="width:100%;" value="'+rs[i].warna_a+'" required></select>\n\
            </div>\n\
            <div class="itemLine col-md-2">\n\
            <select name="id_supplier[]" style="width:100%;" value="" required></select>\n\
            </div>\n\
            <div class="itemLine col-md-1">\n\
            <input name="qty[]" type="text" onblur="calc_qty();" class="form-control decimal" value="" required>\n\
            </div>\n\
            <div class="itemLine col-md-1">\n\
            <select name="satuan_id[]" style="width:100%;" value="" required></select>\n\
            </div>\n\
            <div class="itemLine col-md-3">\n\
            <input name="ket[]" type="text" class="form-control" value="">\n\
            </div>\n\
            </div>';
          }
          
          $('#detail').html('');
          $('#detail').append(append);
          runRibuan();
          rundesimal();
          select2Run();
          setkg($('[name="satuan_id[]"]'));
          for (var i = 0; i < rs.length; i++) {
            var dataBahanBaku = {
                  id: rs[i].bb_id,
                  text: rs[i].nama_bahan_baku
              };
            var newOptionBahanBaku = new Option(dataBahanBaku.text, dataBahanBaku.id, false, false);
            $('[name="id_bb[]"]').eq(i).append(newOptionBahanBaku).trigger('change');
            var dataWarna = {
                  id: rs[i].id_warna,
                  text: rs[i].nama_warna
              };
            var newOptionWarna = new Option(dataWarna.text, dataWarna.id, false, false);
            $('[name="id_warna[]"]').eq(i).append(newOptionWarna).trigger('change');
          }
        });
      }
    });
  }

  </script>
  @endsection
