@extends('layouts.app')

@section('style')
<style media="screen">
  label input[type=radio].radiobox+span{
    z-index:unset !important;
  }
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
                <div class="jarviswidget-editbox">
                </div>
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
                          <label for="id" class="col-md-2 control-label">No Bukti Pembelian</label>
                          <div class="col-md-2">
                            <input id="id" name="id" type="text" class="form-control"  value="{{ $newid }}" readonly="">
                          </div>
                          <label class="col-md-1 control-label">Jenis</label>
                          <div class="col-md-2" style="">
                            <label class="radio radio-inline">
                              <input type="radio" class="radiobox" name="type" value="F" checked="">
                              <span>FOB</span>
                            </label>
                            <!-- <label class="radio radio-inline">
                              <input type="radio" class="radiobox" name="type" value="NF">
                              <span>Non FOB</span>
                            </label> -->
                          </div>
                        </div>
                        <div class="form-group">
                          <label for="tanggal_faktur" class="col-md-2 control-label">Tanggal Faktur</label>
                          <div class="col-md-2">
                            <div class="input-group">
                              <input type="text" name="tgl_faktur" placeholder="Pilih tanggal" class="form-control datepicker" data-dateformat="dd/mm/yy" value="{{ $tanggal }}">
                              <span class="input-group-addon"><i class="fa fa-calendar"></i></span>
                            </div>
                          </div>
                        </div>
                        <div class="form-group">
                          <label for="" class="col-md-2 control-label">SO</label>
                          <div class="col-md-2">
                            <select style="width:100%" id="id_so" name="id_so" class="form-control"></select>
                          </div>
                        </div>
                        <div class="form-group">
                          <label for="id" class="col-md-2 control-label">No Faktur Supplier</label>
                          <div class="col-md-2">
                            <input id="id_faktur" name="id_faktur" type="text" class="form-control"  value="" required>
                          </div>                          
                        </div>
                        <div class="form-group">
                          <label for="" class="col-md-2 control-label">Supplier</label>
                          <div class="col-md-2">
                            <select style="width:100%" id="id_supplier" name="id_supplier" class="form-control"></select>
                          </div>                          
                        </div>
                        <div class="form-group">
                          <label class="col-md-2 control-label">Pembayaran</label>
                          <div class="col-md-2" style="">
                            <label class="radio radio-inline">
                              <input type="radio" class="radiobox" name="pembayaran" value="C" checked="">
                              <span>Cash</span>
                            </label>
                            <label class="radio radio-inline">
                              <input type="radio" class="radiobox" name="pembayaran" value="K">
                              <span>Kredit</span>
                            </label>
                          </div>
                          <label for="" class="col-md-1 control-label form-akun">Dari Akun</label>
                          <div class="col-md-2 form-akun">
                            <select class="form-control" style="width:100%;" name="id_akun"></select>
                          </div>
                          <label for="" class="col-md-1 control-label form-tempo">Hari</label>
                          <div class="col-md-1 form-tempo">
                            <input id="tempo" name="tempo" type="decimal" class="form-control"  value="" placeholder="Hari">
                          </div>
                        </div>
                        <fieldset>
                          <legend>Details {{ $title }}</legend>
                          <div class="form-group">
                            <div class="col-md-2">
                              <label class="control-label">Kode</label>
                            </div>
                            <div class="col-md-1">
                              <label class="control-label">Id Barang Jadi</label>
                            </div>
                            <div class="col-md-3">
                              <label class="control-label">Nama Barang Jadi</label>
                            </div>
                            <!-- <div class="col-md-1">
                              <label class="control-label">Warna</label>
                            </div> -->
                            <div class="col-md-1">
                              <label class="control-label">Qty</label>
                            </div>
                            <div class="col-md-1">
                              <label class="control-label">Satuan</label>
                            </div>
                            <div class="col-md-1">
                              <label class="control-label">Harga</label>
                            </div>
                            <div class="col-md-3">
                              <label class="control-label">Jumlah</label>
                            </div>
                          </div>
                          <div id="detail">
                            <div class="detailLine form-group">
                              <div class="itemLine col-md-2">
                                <input name="kode_bj[]" type="text" class="form-control" readonly>
                              </div>
                              <div class="itemLine col-md-1">
                                <input name="id_bj[]" type="text" class="form-control" value="" readonly>
                              </div>
                              <div class="itemLine col-md-3">
                                <input name="nama_barang_jadi[]" type="text" class="form-control" value="" readonly>
                              </div>
                              <!-- <div class="itemLine col-md-1">
                                <select name="id_warna[]" style="width:100%;" value="" required></select>
                              </div> -->
                              <div class="itemLine col-md-1">
                                <input name="qty[]" type="decimal" class="form-control decimal" value="" required>
                              </div>
                              <div class="itemLine col-md-1">
                                <select name="id_satuan[]" style="width:100%;" value="" required></select>
                              </div>
                              <div class="itemLine col-md-1">
                                <input name="harga[]" type="decimal" class="form-control ribuan" value="">
                              </div>
                              <div class="itemLine col-md-3">
                                <input name="jumlah[]" type="decimal" class="form-control ribuan" value="" readonly>
                              </div>
                            </div>
                          </div>
                          <div class="form-group">
                            <div class="col-md-1">
                              <!-- <button id="btnAddLine" class="btn btn-primary btn-circle"><i class="glyphicon glyphicon-plus"></i></button> -->
                            </div>
                            <div class="col-md-3 pull-right">
                              <input name="total" type="text" class="form-control input-lg" readonly value="" placeholder="Total">
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
    </div>
    @endsection

    @section('script')
    <script>
    var token = $('meta[name="csrf-token"]').attr('content');

    setpcs($('[name="id_satuan[]"]'));
    select2Run();

    $(function(){

      $('[name=type]').on('click', function (e) {
        var type = $(this).val();
        if (type == 'F') {
          $("[name=id_so]").prop("disabled", false);
        } else {
          $("[name=id_so]").prop("disabled", true);
        }
      });

      $('[name=id_so]').on('change', function (e) {
        var id = $(this).val();
        url = "{{ url('get_so_fob_detail') }}";
        $.ajax({
          url : url,
          type : "POST",
          data : {id:id,_token:token},
          success : function(data) {
            // for (var i = 1; i < data.length; i++) {
              // addRow();
              // console.log(data[i]);
            // }
            // for (var i = 0; i < data.length; i++) {
              $('[name="kode_bj[]"]').eq(0).val(data[0].barang_jadi_id);
              $('[name="id_bj[]"]').eq(0).val(data[0].bj_id);
              $('[name="nama_barang_jadi[]"]').eq(0).val(data[0].name);
              $('[name="qty[]"]').eq(0).val(ribuan(data[0].qty));
              $('[name="harga[]"]').eq(0).val(ribuan(data[0].nilai_pekerjaan));
              $('[name="jumlah[]"]').eq(0).val(parseFloat(data[0].qty)*parseFloat(data[0].nilai_pekerjaan));
              $('[name="total"]').val(ribuan($('[name="jumlah[]"]').val()));
              // console.log(data[i]);
            // }
            // if(data.length < 1){
            // } else {
            //   harga.val(ribuan(data[0]['harga_default']));
            // }
          },
          error : function(data){
            myswal('e',data.message,'e',1500);
          }
        });
      });

      $('#btnReset').on('click', function (e) {
        resetForm();
      });

      $('#formAdd').validator().on('submit', function (e) {
        $('input[name=_method]').val('POST');
        if (!e.isDefaultPrevented()){
          var id = $('#id').val();
          url = "{{ url('pembelian_bj') }}";

          $.ajax({
            url : url,
            type : "POST",
            data : $('#formAdd').serialize(),
            success : function(data) {
              resetForm();
              if (data.status == true) {
                myswal('s',data.message,'s',1500);
                setTimeout(function () {
                  window.location = '{{ route("pembelian.index")}}';
                }, 1500);
              } else {
                myswal('e',data.message,'e',1500);
                $('[name=id]').val(id);
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
        e.preventDefault();
        addRow();
      });

      $('#detail').on('keyup','input[name="qty[]"]:last', function (e) {
        // addRow();
        e.preventDefault();
      });

      $('#id_supplier').on('change',function(e) {
        // $('.detailLine').not(':eq(0)').remove();
        // clearSelect2Detail();
      });

      $('#detail').on('change','select', function (e) {
        var self = $(this);
        var kode_bj = self.parents('.detailLine').find('[name="kode_bj[]"]');
        var harga = self.parents('.detailLine').find('[name="harga[]"]');
        var id_bj = self.parents('.detailLine').find('select[name="id_bj[]"]').val();
        // var id_warna = self.parents('.detailLine').find('[name="id_warna[]"]').val();
        var id_brand = self.parents('.detailLine').find('[name="id_brand[]"]').val();
        var id_supplier = $('#id_supplier').val();
        if (id_bj == null) id_bj='';
        // if (id_warna == null) id_warna='';
        if (id_supplier == null) id_supplier='';
        // kode_bj.val(id_bj+'-'+id_warna+'-'+id_supplier+'');
        // if (kode_bj.val().length > 15) {
        //   var id = kode_bj.val();
        //   url = "{{ url('get_harga_bj_default') }}";
        //   $.ajax({
        //     url : url,
        //     type : "POST",
        //     data : {id:id,_token:token},
        //     success : function(data) {
        //       if(data.length < 1){
        //       } else {
        //         harga.val(ribuan(data[0]['harga_default']));
        //       }
        //     },
        //     error : function(data){
        //       myswal('e',data.message,'e',1500);
        //     }
        //   });
        // }

      });

      $('#detail').on('keyup','input', function (e) {
        var self = $(this);
        var qty = self.parents('.detailLine').find('[name="qty[]"]').val();
        var harga = self.parents('.detailLine').find('[name="harga[]"]').val();
        var jumlah = self.parents('.detailLine').find('[name="jumlah[]"]');
        if (qty != '' && harga != '') {
          var jumlahribuan = ribuantodb(qty)*ribuantodb(harga);
          jumlah.val(ribuan(jumlahribuan));
          var total = 0;
          $('[name="jumlah[]"]').each(function(e) {
            var jumlahtotal = ribuantodb($(this).val());
            if (jumlahtotal > 0) {
              total = parseFloat(total) + parseFloat(jumlahtotal);
            }
          });
          $('[name=total]').val(ribuan(total));
        }
      });

    });

    //Fungsi Reset Data form
    function resetForm() {
      $('#formAdd')[0].reset();
      $('.select2').val('').change();
      $("#id_supplier").select2("val", "");
      $("[name='kode_bj[]']").val("");
      $('.detailLine').not(':eq(0)').remove();
      setpcs($('[name="id_satuan[]"]'));
    }

    function clearSelect2Detail() {
      $('[name="qty[]"]:last,[name="harga[]"]:last,[name="jumlah[]"]:last,[name="total"]:last').val('');
      $('[name="id_bj[]"]:last,[name="id_brand[]"]:last,[name="id_satuan[]"]:last').select2("val", "");
    }

    function addRow() {
      var detailLine = $('#detail .detailLine').eq(0).html();
      $('#detail .detailLine').last().after('<div class="detailLine form-group">'+detailLine+'</div>');
      $('[name="id_bj[]"]:last,[name="id_brand[]"]:last,[name="id_satuan[]"]:last').next(".select2-container").hide();
      select2Run();
      clearSelect2Detail();
      setpcs($('[name="id_satuan[]"]'));
      runRibuan();
      runDecimal();
    }

    // Pembayaran Cash / Kredit
      $('.form-akun').show();
      $('.form-tempo').hide();
      $('[name=pembayaran]').on('change',function(e) {
        if($(this).val() == 'C') {
          $('.form-akun').show();
          $('.form-tempo').hide();
        } else {
          $('.form-akun').hide();
          $('.form-tempo').show();
        }
      });

    function select2Run() {
      $('[name="id_akun"]').select2({
        ajax: {
          url: baseurl+'/get_akun',
          delay:250,
          data: function (params) {
            var query = {
              search: params.term,
              type: 'public',
              category: 'k3',
              k31: '110101',
              k32: '110102',
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
      
      $('[name="id_so"]').select2({
        ajax: {
          url: baseurl+'/get_so_fob',
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

      // $('[name="id_bj[]"]').select2({
      //   ajax: {
      //     url: baseurl+'/get_bj',
      //     delay:250,
      //     data: function (params) {
      //       var query = {
      //         search: params.term,
      //         type: 'public'
      //       }
      //       return query;
      //     },
      //     processResults: function (data) {
      //       return {
      //         results: data
      //       };
      //     },
      //   }
      // });

      // $('[name="id_warna[]"]').select2({
      //   ajax: {
      //     url: baseurl+'/get_warna',
      //     delay:250,
      //     data: function (params) {
      //       var query = {
      //         search: params.term,
      //         type: 'public'
      //       }
      //       return query;
      //     },
      //     processResults: function (data) {
      //       return {
      //         results: data
      //       };
      //     },
      //   }
      // });

      $('[name="id_supplier[]"],#id_supplier').select2({
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

      $('[name="id_satuan[]"]').select2({
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

    </script>
    @endsection
