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
        {{ $title }}
      </h1>
    </div>
  </div>
  <section id="widget-grid">
    <div class="row">
      <article class="col-sm-12 col-md-12 col-lg-12 sortable-grid ui-sortable">
        <div class="jarviswidget jarviswidget-color-orange jarviswidget-sortable" id="wid-id-1" data-widget-editbutton="false" role="widget">
          <header role="heading" class="ui-sortable-handle"><div class="jarviswidget-ctrls" role="menu">   <a href="javascript:void(0);" class="button-icon jarviswidget-toggle-btn" rel="tooltip" title="" data-placement="bottom" data-original-title="Collapse"><i class="fa fa-minus "></i></a> <a href="javascript:void(0);" class="button-icon jarviswidget-fullscreen-btn" rel="tooltip" title="" data-placement="bottom" data-original-title="Fullscreen"><i class="fa fa-expand "></i></a> <a href="javascript:void(0);" class="button-icon jarviswidget-delete-btn" rel="tooltip" title="" data-placement="bottom" data-original-title="Delete"><i class="fa fa-times"></i></a></div><div class="widget-toolbar" role="menu"><a data-toggle="dropdown" class="dropdown-toggle color-box selector" href="javascript:void(0);"></a><ul class="dropdown-menu arrow-box-up-right color-select pull-right"><li><span class="bg-color-green" data-widget-setstyle="jarviswidget-color-green" rel="tooltip" data-placement="left" data-original-title="Green Grass"></span></li><li><span class="bg-color-greenDark" data-widget-setstyle="jarviswidget-color-greenDark" rel="tooltip" data-placement="top" data-original-title="Dark Green"></span></li><li><span class="bg-color-greenLight" data-widget-setstyle="jarviswidget-color-greenLight" rel="tooltip" data-placement="top" data-original-title="Light Green"></span></li><li><span class="bg-color-purple" data-widget-setstyle="jarviswidget-color-purple" rel="tooltip" data-placement="top" data-original-title="Purple"></span></li><li><span class="bg-color-magenta" data-widget-setstyle="jarviswidget-color-magenta" rel="tooltip" data-placement="top" data-original-title="Magenta"></span></li><li><span class="bg-color-pink" data-widget-setstyle="jarviswidget-color-pink" rel="tooltip" data-placement="right" data-original-title="Pink"></span></li><li><span class="bg-color-pinkDark" data-widget-setstyle="jarviswidget-color-pinkDark" rel="tooltip" data-placement="left" data-original-title="Fade Pink"></span></li><li><span class="bg-color-blueLight" data-widget-setstyle="jarviswidget-color-blueLight" rel="tooltip" data-placement="top" data-original-title="Light Blue"></span></li><li><span class="bg-color-teal" data-widget-setstyle="jarviswidget-color-teal" rel="tooltip" data-placement="top" data-original-title="Teal"></span></li><li><span class="bg-color-blue" data-widget-setstyle="jarviswidget-color-blue" rel="tooltip" data-placement="top" data-original-title="Ocean Blue"></span></li><li><span class="bg-color-blueDark" data-widget-setstyle="jarviswidget-color-blueDark" rel="tooltip" data-placement="top" data-original-title="Night Sky"></span></li><li><span class="bg-color-darken" data-widget-setstyle="jarviswidget-color-darken" rel="tooltip" data-placement="right" data-original-title="Night"></span></li><li><span class="bg-color-yellow" data-widget-setstyle="jarviswidget-color-yellow" rel="tooltip" data-placement="left" data-original-title="Day Light"></span></li><li><span class="bg-color-orange" data-widget-setstyle="jarviswidget-color-orange" rel="tooltip" data-placement="bottom" data-original-title="Orange"></span></li><li><span class="bg-color-orangeDark" data-widget-setstyle="jarviswidget-color-orangeDark" rel="tooltip" data-placement="bottom" data-original-title="Dark Orange"></span></li><li><span class="bg-color-red" data-widget-setstyle="jarviswidget-color-red" rel="tooltip" data-placement="bottom" data-original-title="Red Rose"></span></li><li><span class="bg-color-redLight" data-widget-setstyle="jarviswidget-color-redLight" rel="tooltip" data-placement="bottom" data-original-title="Light Red"></span></li><li><span class="bg-color-white" data-widget-setstyle="jarviswidget-color-white" rel="tooltip" data-placement="right" data-original-title="Purity"></span></li><li><a href="javascript:void(0);" class="jarviswidget-remove-colors" data-widget-setstyle="" rel="tooltip" data-placement="bottom" data-original-title="Reset widget color to default">Remove</a></li></ul></div>
            <span class="widget-icon"> <i class="fa fa-inbox"></i> </span>
            <h2>Form {{ $title }}</h2>
            <span class="jarviswidget-loader"><i class="fa fa-refresh fa-spin"></i></span></header>
            <div role="content">
              <div class="jarviswidget-editbox">
              </div>
              <div class="widget-body">
                <div role="content">
                  <div class="widget-body">
                    <form id="formAdd" name="formAdd" method="post" class="form-horizontal" data-toggle="validator" enctype="multipart/form-data">
                      {{ csrf_field() }} {{ method_field('POST') }}
                        <div class="form-group">
                          <label class="col-md-4 pull-right control-label" style="font-size:25px;"><strong>Total <span id="total_head">Rp. 0.00</span></strong></label>
                        </div>
                      <hr>
                      <fieldset>
                        <div class="form-group">
                          <label class="col-md-2 control-label">Bayar Dari </label>
                          <div class="col-md-2">
                            <select class="form-control" style="width:100%;" name="id_akun"></select>
                          </div>
                          <label class="col-md-2 control-label">No Ref </label>
                          <div class="col-md-2">
                            <input type="text" class="form-control" name="no_ref">
                            <!-- <select class="form-control" style="width:100%;" name="id_akun"></select> -->
                          </div>
                          <label class="col-md-2 control-label">Tgl Pembayaran</label>
                          <div class="col-sm-2">
                            <div class="input-group">
                              <input type="text" id="tanggal" name="tanggal" placeholder="Select a date" class="form-control datepicker" data-dateformat="dd/mm/yy" value="{{ $tanggal }}">
                              <span class="input-group-addon"><i class="fa fa-calendar"></i></span>
                            </div>
                          </div>
                        </div>
                        <div class="form-group">
                          <label class="col-md-2 control-label">Cara Pembayaran </label>
                          <div class="col-md-2">
                            <select class="form-control" style="width:100%;" name="id_payment"></select>
                          </div>
                        </div>
                        <hr>
                        <fieldset>
                          <legend>Details {{ $title }}</legend>
                          <div class="form-group">
                            <div class="col-md-3">
                              <label class="control-label">Akun</label>
                            </div>
                            <div class="col-md-5">
                              <label class="control-label">Deskripsi</label>
                            </div>
                            <div class="col-md-3">
                              <label class="control-label">Jumlah</label>
                            </div>
                            <div class="col-md-1">
                              <label class="control-label"></label>
                            </div>
                          </div>
                          <div id="detail">
                            <div class="detailLine form-group">
                              <div class="itemLine col-md-3">
                                <select style="width:100%" id="id_akun_biaya[]" name="id_akun_biaya[]" class="form-control" required=""></select>
                              </div>
                              <div class="itemLine col-md-5">
                                <input class="form-control" name="deskripsi[]" placeholder="Deskripsi" type="text" required="">
                              </div>
                              <div class="itemLine col-md-3">
                                <input class="form-control decimal calc" value="0" name="jumlah[]" style="text-align:right;" placeholder="0" type="text">
                              </div>
                              <div class="itemLine col-md-1">
                                <input type="hidden" name="indexRow[]" value="0">
                                <button type="button" name="btnRemoveLine[]" class="btn-remove-line btn btn-default btn-circle"><i class="glyphicon glyphicon-minus"></i></button>
                              </div>
                            </div>
                          </div>
                          <div class="form-group">
                            <div class="col-md-1">
                              <button id="btnAddLine" class="btn btn-primary btn-circle"><i class="glyphicon glyphicon-plus"></i></button>
                            </div>
                            <div class="col-md-2 col-md-offset-8">
                              <div class="control-label ">
                                <strong>Total</strong>
                              </div>
                              <div class="control-label" id="total">
                                Rp. 0.00
                              </div>
                              <input class="form-control" type="hidden" name="total" value="0">
                            </div>
                          </div>
                          <div class="form-group">
                            <div class="col-md-2">
                              <label for="memo">Memo</label>
                              <textarea name="memo" rows="5" cols="50"></textarea>
                            </div>
                          </div>
                        </fieldset>
                      <div class="form-actions">
                        <div class="row">
                          <div class="col-md-12">
                            <button id="btnAdd" type="submit" class="btn btn-primary">
                              <i class="fa fa-send"></i>
                              Buat {{$title}} Baru
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
        </div>
      </div>
    </section>
  </div>
  </div>

  @endsection

  @section('script')
  <script>

  var tag         = '{{$tag}}';
  var costumer    = $('[name=id_costumer]');
  var detailLine  = $('#detail .detailLine').eq(0).html();
  var table       = $('#'+tag+'-table').DataTable({
    processing: true,
    serverSide: true,
    ajax: "{{ route('akun.api') }}",
    columns: [
      {data: 'id', name: 'id'},
      {data: 'name', name: 'name'},
      {data: 'kategori', name: 'kategori'},
      {data: 'saldo', name: 'saldo'},
      {data: 'isactive', name: 'isactive'},
      {data: 'action', name: 'action', orderable: false, searchable: false}
    ]
  });

  $(function(){
    collect();

    $('#btnAddLine').on('click',function (e) {
      e.preventDefault();
      $('#detail .detailLine').last().after('<div class="detailLine form-group">'+detailLine+'</div>');
      $('[name="id_akun[]"]:last').next(".select2-container").hide();
      $('[name="btnRemoveLine[]"]').unbind('click');
      collect();
    });

    $('#detail').on('blur','.calc',function() {
      var self    = $(this);
      var debit   = self.parents('.detailLine').find('.calc[name="jumlah[]"]');
      collect();
    });

    $('#btnResetAdd').on('click', function (e) {
      resetForm();
    });

    $('#formAdd').validator().on('submit', function (e) {
      $('input[name=_method]').val('POST');
      if (!e.isDefaultPrevented()){
        var id = $('#id').val();
        url = "{{ url('payment_expense') }}";

        $.ajax({
          url : url,
          type : "POST",
          data : $('#formAdd').serialize(),
          success : function(data) {
            resetForm();
            if (data.status == true) {
              myswal('s',data.message,'s',1500);
              window.location = '{{ route("payment_expense.index")}}';
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
  });

  //Fungsi Reset Data form
  function resetForm() {
    $('#formAdd')[0].reset();
    $('.select2').val('').change();
    $('.detailLine').not(':eq(0)').remove();
    $('#total').text('Rp. 0,00');
    $('[name=total]').text('0');
    $('#total_head').text('Rp. 0,00');
  }

  //Fungsi Hitung Total All
  function hitungTotal() {
    var total = 0;
    $('[name="jumlah[]"]').each(function() {
      var val = $(this).val();
      total = parseFloat(total) + parseFloat(ribuantodb(val));
    });
    var num1   = decimal(total);
    $('#total').text('Rp. '+num1);
    $('#total_head').text('Rp. '+num1);
    $('[name=total]').val(ribuantodb(num1));
  }

// Fungsi Hapus Baris
  function removeRowClick() {
    $('[name="btnRemoveLine[]"]').on('click',function (e) {
      var index = $(this);
      var detail = index.parents('.detailLine').index();
      if (detail == 0) {
        myswal('w','Row 1 Tidak Dapat Dihapus!','w',1500);
        return true;
      }
      removeRow(detail);
      e.preventDefault();
    });
  }

  function removeRow(index) {
    $('.detailLine').eq(index).remove();
    e.preventDefault();
  }

// Fungsi Select 2 Local
  function select2Run() {
  $('[name="id_payment"]').select2({
    ajax: {
      url: baseurl+'/get_payment',
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

  $('[name="id_supplier"]').select2({
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

  $('[name="id_akun_biaya[]"]').select2({
    ajax: {
      url: baseurl+'/get_akun',
      delay:250,
      data: function (params) {
        var query = {
          search: params.term,
          type: 'public',
          category: 'expense'
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
  }

// Fungsi Collection
  function collect() {
    hitungTotal();
    runselect2();
    select2Run();
    runRibuan();
    runDecimal();
    removeRowClick();
  }
  </script>
  @endsection
