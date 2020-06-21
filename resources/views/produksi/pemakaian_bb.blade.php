@extends('layouts.app')

@section('style')
<style>
  .modal-xl {
    width: 90%;
   max-width:1200px;
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
      <div class="row" >
        <article class="col-sm-12 col-md-12 col-lg-12 sortable-grid ui-sortable" >
          <div class="jarviswidget jarviswidget-color-orange jarviswidget-sortable create-pemakaian" id="wid-id-1" data-widget-editbutton="false" role="widget" >
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
                            <input id="no_bukti_permintaan" name="no_bukti_permintaan" type="text" class="form-control"  value="" readonly>
                          </div>
                        </div>

                        <div class="form-group">
                          <label for="id" class="col-md-2 control-label">No Bukti Keluar</label>
                          <div class="col-md-2">
                            <input id="no_bukti_keluar" name="no_bukti_keluar" type="text" class="form-control"  value="" readonly>
                          </div>
                        </div>

                        <div class="form-group">
                          <label for="id" class="col-md-2 control-label">No Bukti Pemakaian</label>
                          <div class="col-md-2">
                            <input id="no_bukti_pemakaian" name="no_bukti_pemakaian" type="text" class="form-control"  value="" readonly>
                          </div>
                        </div>

                        <div class="form-group">
                          <label for="" class="col-md-2 control-label">Kode Produksi/ SO</label>
                          <div class="col-md-5">
                            <select style="width:100%" id="id_so" name="id_so" class="form-control" required></select>
                          </div>
                        </div>

                        <div class="form-group">
                          <label for="" class="col-md-2 control-label">Operator Cutt</label>
                          <div class="col-md-2">
                            <select style="width:100%" id="id_cmt" name="id_cmt" class="form-control" required></select>
                          </div>
                        </div>

                        <fieldset>
                          <legend>Details {{ $title }}</legend>
                          <div class="form-group">
                          <div class="col-md-2">
                            <label class="control-label">Kode</label>
                          </div>
                          <div class="col-md-1">
                            <label class="control-label">Bahan Baku</label>
                          </div>
                          <div class="col-md-1">
                            <label class="control-label">Warna</label>
                          </div>
                          <div class="col-md-1">
                            <label class="control-label">Supplier</label>
                          </div>
                          <div class="col-md-1">
                            <label class="control-label">Permintaan</label>
                          </div>
                          <div class="col-md-1">
                            <label class="control-label">Keluar</label>
                          </div>
                          <div class="col-md-1">
                            <label class="control-label">Pemakaian</label>
                          </div>
                          <div class="col-md-1">
                            <label class="control-label">Cutting Pcs</label>
                          </div>
                          <div class="col-md-1">
                            <label class="control-label"></label>
                          </div>
                          <div class="col-md-1">
                            <label class="control-label">Keterangan</label>
                          </div>
                        </div>
                        <div id="detail">
                          <div class="detailLine form-group">
                          <div class="itemLine col-md-2">
                            <input name="kode_bb[]" type="text" class="form-control" readonly>
                          </div>
                          <div class="itemLine col-md-1">
                            <input type="text" name="nama_bb[]" class="form-control" value="" readonly>
                            <input type="hidden" name="id_bb[]" class="form-control" value="" readonly>
                          </div>
                          <div class="itemLine col-md-1">
                            <input type="text" name="nama_warna[]" class="form-control" value="" readonly>
                            <input type="hidden" name="id_warna[]" class="form-control" value="" readonly>
                          </div>
                          <div class="itemLine col-md-1">
                            <input type="text" name="nama_supplier[]" class="form-control" value="" readonly>
                            <input type="hidden" name="id_supplier[]" class="form-control" value="" readonly>
                          </div>
                          <div class="itemLine col-md-1">
                            <input name="qty_permintaan[]" kode="" onblur="calc_qty();" type="decimal" class="form-control decimal qty" value="" readonly>
                          </div>
                          <div class="itemLine col-md-1">
                            <input name="qty_keluar[]" kode="" onblur="calc_qty();" type="decimal" class="form-control decimal qty" value="" readonly>
                          </div>
                          <div class="itemLine col-md-1">
                            <input name="qty_pemakaian[]" placeholder="0" kode="" onblur="calc_qty();" type="decimal" class="form-control decimal qty" value="">
                          </div>
                          <div class="itemLine col-md-1">
                            <input name="hasil_cutt[]" placeholder="0" kode="" onblur="calc_qty();" type="integer" class="form-control qty" value="">
                          </div>
                          <div class="itemLine col-md-1">
                            <label class="checkbox-inline"><input name="acc[]" type="checkbox" value="">Acc & Post</label>
                          </div>
                          <div class="itemLine col-md-2">
                            <input name="ket[]" type="text" class="form-control" value="" readonly>
                          </div>
                        </div>
                      </div>

                      <div class="form-group">
                        <div class="col-md-7">
                          <!-- <button id="btnAddLine" class="btn btn-primary btn-circle"><i class="glyphicon glyphicon-plus"></i></button> -->
                        </div>
                        <div class="col-md-1">
                          <!-- <input name="total_qty" type="decimal" class="form-control decimal" value=""> -->
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
                          <button type="button" class="btn btn-warning" id="btnReset">
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

      <div class="row">
        <article class="col-sm-12 col-md-12 col-lg-12 sortable-grid ui-sortable">
          <div class="jarviswidget jarviswidget-color-orange jarviswidget-sortable edit-pemakaian" id="wid-id-1" data-widget-editbutton="false" role="widget">
            <header role="heading" class="ui-sortable-handle"><div class="jarviswidget-ctrls" role="menu">   <a href="javascript:void(0);" class="button-icon jarviswidget-toggle-btn" rel="tooltip" title="" data-placement="bottom" data-original-title="Collapse"><i class="fa fa-minus "></i></a> <a href="javascript:void(0);" class="button-icon jarviswidget-fullscreen-btn" rel="tooltip" title="" data-placement="bottom" data-original-title="Fullscreen"><i class="fa fa-expand "></i></a> <a href="javascript:void(0);" class="button-icon jarviswidget-delete-btn" rel="tooltip" title="" data-placement="bottom" data-original-title="Delete"><i class="fa fa-times"></i></a></div><div class="widget-toolbar" role="menu"><a data-toggle="dropdown" class="dropdown-toggle color-box selector" href="javascript:void(0);"></a><ul class="dropdown-menu arrow-box-up-right color-select pull-right"><li><span class="bg-color-green" data-widget-setstyle="jarviswidget-color-green" rel="tooltip" data-placement="left" data-original-title="Green Grass"></span></li><li><span class="bg-color-greenDark" data-widget-setstyle="jarviswidget-color-greenDark" rel="tooltip" data-placement="top" data-original-title="Dark Green"></span></li><li><span class="bg-color-greenLight" data-widget-setstyle="jarviswidget-color-greenLight" rel="tooltip" data-placement="top" data-original-title="Light Green"></span></li><li><span class="bg-color-purple" data-widget-setstyle="jarviswidget-color-purple" rel="tooltip" data-placement="top" data-original-title="Purple"></span></li><li><span class="bg-color-magenta" data-widget-setstyle="jarviswidget-color-magenta" rel="tooltip" data-placement="top" data-original-title="Magenta"></span></li><li><span class="bg-color-pink" data-widget-setstyle="jarviswidget-color-pink" rel="tooltip" data-placement="right" data-original-title="Pink"></span></li><li><span class="bg-color-pinkDark" data-widget-setstyle="jarviswidget-color-pinkDark" rel="tooltip" data-placement="left" data-original-title="Fade Pink"></span></li><li><span class="bg-color-blueLight" data-widget-setstyle="jarviswidget-color-blueLight" rel="tooltip" data-placement="top" data-original-title="Light Blue"></span></li><li><span class="bg-color-teal" data-widget-setstyle="jarviswidget-color-teal" rel="tooltip" data-placement="top" data-original-title="Teal"></span></li><li><span class="bg-color-blue" data-widget-setstyle="jarviswidget-color-blue" rel="tooltip" data-placement="top" data-original-title="Ocean Blue"></span></li><li><span class="bg-color-blueDark" data-widget-setstyle="jarviswidget-color-blueDark" rel="tooltip" data-placement="top" data-original-title="Night Sky"></span></li><li><span class="bg-color-darken" data-widget-setstyle="jarviswidget-color-darken" rel="tooltip" data-placement="right" data-original-title="Night"></span></li><li><span class="bg-color-yellow" data-widget-setstyle="jarviswidget-color-yellow" rel="tooltip" data-placement="left" data-original-title="Day Light"></span></li><li><span class="bg-color-orange" data-widget-setstyle="jarviswidget-color-orange" rel="tooltip" data-placement="bottom" data-original-title="Orange"></span></li><li><span class="bg-color-orangeDark" data-widget-setstyle="jarviswidget-color-orangeDark" rel="tooltip" data-placement="bottom" data-original-title="Dark Orange"></span></li><li><span class="bg-color-red" data-widget-setstyle="jarviswidget-color-red" rel="tooltip" data-placement="bottom" data-original-title="Red Rose"></span></li><li><span class="bg-color-redLight" data-widget-setstyle="jarviswidget-color-redLight" rel="tooltip" data-placement="bottom" data-original-title="Light Red"></span></li><li><span class="bg-color-white" data-widget-setstyle="jarviswidget-color-white" rel="tooltip" data-placement="right" data-original-title="Purity"></span></li><li><a href="javascript:void(0);" class="jarviswidget-remove-colors" data-widget-setstyle="" rel="tooltip" data-placement="bottom" data-original-title="Reset widget color to default">Remove</a></li></ul></div>
              <span class="widget-icon"> <i class="fa fa-sitemap"></i> </span>
              <h2>Form Edit {{ $title }}</h2>
              <span class="jarviswidget-loader"><i class="fa fa-refresh fa-spin"></i></span></header>
              <div role="content">
                <div class="widget-body">
                  <div role="content">
                    <div class="widget-body">
                      <form id="formEdit" class="form-horizontal" method="post" data-toggle="validator" enctype="multipart/form-data">
                        {{ csrf_field() }} {{ method_field('POST') }}
                        <div class="form-group">
                          <label for="tanggal_edit" class="col-md-2 control-label">Tanggal</label>
                          <div class="col-md-2">
                            <div class="input-group">
                              <input readonly type="text" name="tanggal_edit" placeholder="Pilih tanggal" class="form-control datepicker" data-dateformat="dd/mm/yy" value="{{ $tanggal }}">
                              <span class="input-group-addon"><i class="fa fa-calendar"></i></span>
                            </div>
                          </div>
                        </div>

                        <div class="form-group">
                          <label for="no_bukti_permintaan_edit" class="col-md-2 control-label">No Bukti Permintaan</label>
                          <div class="col-md-2">
                            <input id="no_bukti_permintaan_edit" name="no_bukti_permintaan_edit" type="text" class="form-control"  value="" readonly>
                          </div>
                        </div>

                        <div class="form-group">
                          <label for="no_bukti_keluar_edit" class="col-md-2 control-label">No Bukti Keluar</label>
                          <div class="col-md-2">
                            <input id="no_bukti_keluar_edit" name="no_bukti_keluar_edit" type="text" class="form-control"  value="" readonly>
                          </div>
                        </div>

                        <div class="form-group">
                          <label for="no_bukti_pemakaian_edit" class="col-md-2 control-label">No Bukti Pemakaian</label>
                          <div class="col-md-2">
                            <input id="no_bukti_pemakaian_edit" name="no_bukti_pemakaian_edit" type="text" class="form-control"  value="" readonly>
                          </div>
                        </div>

                        <div class="form-group">
                          <label for="" class="col-md-2 control-label">SO</label>
                          <div class="col-md-2">
                            <input id="id_so_edit" name="id_so_edit" type="text" class="form-control"  value="" readonly>
                            <!-- <select style="width:100%" id="id_so" name="id_so" class="form-control" required></select> -->
                          </div>
                        </div>

                        <div class="form-group">
                          <label for="" class="col-md-2 control-label">Operator Cutt</label>
                          <div class="col-md-2">
                            <select style="width:100%" id="id_cmt_edit" name="id_cmt_edit" class="form-control" required></select>
                          </div>
                        </div>

                        <fieldset>
                          <legend>Details {{ $title }}</legend>
                          <div class="form-group">
                          <div class="col-md-2">
                            <label class="control-label">Kode</label>
                          </div>
                          <div class="col-md-1">
                            <label class="control-label">Bahan Baku</label>
                          </div>
                          <div class="col-md-1">
                            <label class="control-label">Warna</label>
                          </div>
                          <div class="col-md-1">
                            <label class="control-label">Supplier</label>
                          </div>
                          <div class="col-md-1">
                            <label class="control-label">Permintaan</label>
                          </div>
                          <div class="col-md-1">
                            <label class="control-label">Keluar</label>
                          </div>
                          <div class="col-md-1">
                            <label class="control-label">Pemakaian</label>
                          </div>
                          <div class="col-md-1">
                            <label class="control-label">Cutting Pcs</label>
                          </div>
                          <div class="col-md-2">
                            <label class="control-label">Keterangan</label>
                          </div>
                        </div>
                        <div id="detail-edit">
                          <div class="detailLine-edit form-group">
                          <div class="itemLine col-md-2">
                            <input name="kode_bb_edit[]" type="text" class="form-control" readonly>
                          </div>
                          <div class="itemLine col-md-1">
                            <input type="text" name="nama_bb_edit[]" class="form-control" value="" readonly>
                            <input type="hidden" name="id_bb_edit[]" class="form-control" value="" readonly>
                          </div>
                          <div class="itemLine col-md-1">
                            <input type="text" name="nama_warna_edit[]" class="form-control" value="" readonly>
                            <input type="hidden" name="id_warna_edit[]" class="form-control" value="" readonly>
                          </div>
                          <div class="itemLine col-md-1">
                            <input type="text" name="nama_supplier_edit[]" class="form-control" value="" readonly>
                            <input type="hidden" name="id_supplier_edit[]" class="form-control" value="" readonly>
                          </div>
                          <div class="itemLine col-md-1">
                            <input name="qty_permintaan_edit[]" kode="" onblur="calc_qty();" type="decimal" class="form-control decimal qty-edit" value="" readonly>
                          </div>
                          <div class="itemLine col-md-1">
                            <input name="qty_keluar_edit[]" kode="" onblur="calc_qty();" type="decimal" class="form-control decimal qty-edit" value="" readonly>
                          </div>
                          <div class="itemLine col-md-1">
                            <input name="qty_pemakaian_edit[]" placeholder="0" kode="" onblur="calc_qty();" type="decimal" class="form-control decimal qty-edit" value="">
                          </div>
                          <div class="itemLine col-md-1">
                            <input name="hasil_cutt_edit[]" placeholder="0" kode="" onblur="calc_qty();" type="integer" class="form-control qty-edit" value="">
                          </div>
                          <div class="itemLine col-md-3">
                            <input name="ket_edit[]" type="text" class="form-control" value="">
                          </div>
                        </div>
                      </div>
                    </fieldset>

                    <div class="form-actions">
                      <div class="row">
                        <div class="col-md-12">
                          <button type="button" class="btn btn-primary" id="btnUpdate">
                            Update
                          </button>
                          <button type="button" class="btn btn-warning" id="btnCloseEdit">
                            Close
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

            <div class="jarviswidget jarviswidget-color-orange list-data-pemakaian" id="wid-id-4" data-widget-editbutton="false" data-widget-colorbutton="false" data-widget-deletebutton="false" data-widget-fullscreenbutton="false" >
            <!-- <div class="jarviswidget jarviswidget-color-orange" id="wid-id-4" data-widget-editbutton="false" data-widget-colorbutton="false" data-widget-deletebutton="false" data-widget-fullscreenbutton="false" data-widget-collapsed="true"> -->
              <header>
                <span class="widget-icon"> <i class="fa fa-table"></i> </span>
                <h2>List Data by SO </h2>
              </header>
              <div>
                <div class="jarviswidget-editbox">
                </div>
                <div class="widget-body">
                  <table id="{{$tag}}-table-so" class="table table-striped table-bordered table-hover" width="100%">
                    <thead>
                      <tr>
                        <th>No. Pemakaian</th>
                        <th>No. SO</th>
                        <th>Nama Produk</th>
                        <!-- <th>Total Qty Keluar</th> -->
                        <th>Total Qty Pemakaian</th>
                        {{-- <th>Total Qty Retur</th> --}}
                        <th>Total Cutting</th>
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

    <!-- Modal -->
    <div class="modal fade" id="modalPost" tabindex="-1" role="dialog" aria-labelledby="modalEditLabel" aria-hidden="true">
      <div class="modal-dialog modal-xl" style="width=100%">
        <div class="modal-content">
          <div class="modal-header">
            <button type="button" class="close" data-dismiss="modal" aria-hidden="true">
              &times;
            </button>
            <h4 class="modal-title" id="modalEditLabel">Form Penyerian</h4>
          </div>
          <div class="modal-body">
            <form class="form-horizontal form_penyerian">
              {{ csrf_field() }}
              <div class="jarviswidget jarviswidget-color-orange" id="wid-id-3" data-widget-editbutton="false">
                <header>
                  <span class="widget-icon"> <i class="fa fa-table"></i> </span>
                  <h2>List Data</h2>
                </header>
                <div>
                  <div class="widget-body no-padding table_art">
                  </div>
                </div>
              </div>
            </form>
            <div class="row">
              <div class="col-md-12">
                <input type="hidden" name="so_id_post" value="" readonly>
                <button class="btn btn-primary" name="btnPostingArt">
                  <i class="fa fa-send"></i>
                  Posting
                </button>
                <button type="button" class="btn btn-default" data-dismiss="modal">
                  Batal
                </button>
              </div>
            </div>
          </div>
        </div>
      </div>
    </div>


  </div>
  <!-- END MAIN PANEL -->

  @endsection

  @section('script')
  <script>
  var tag   = '{{$tag}}';
  var token       = $('meta[name="csrf-token"]').attr('content');
  var table_so = $('#'+tag+'-table-so').DataTable({
    processing: true,
    serverSide: true,
    ajax: "{{ route('pemakaian_bb_so.api') }}",
    order: [0,'desc'],
    columns: [
      {data: 'id', name: 'id'},
      {data: 'id_so', name: 'id_so'},
      {data: 'nama_produk', name: 'nama_produk'},
      {data: 'qty_pemakaian', name: 'qty_pemakaian'},
      {data: 'hasil_cutt', name: 'hasil_cutt'},
      {data: 'action', name: 'action'},
    ]
  });


  function accChange(){
    $('[name="acc_art[]"]').on('change', function(){
      var total_qty = 0;
      $('[name="art_qty[]"]').each(function (r2) {
        var self = $(this);
        var acc = self.parents('tr').find('[name="acc[]"]');
        if(acc.is(":checked")){
          total_qty = parseInt(total_qty) + parseInt(ribuantodb($(this).val())) * 1;
        }
      });
      $('[name=total_qty_now]').val(ribuan(total_qty));
    });
  }

  function modalPenyerian(id) {
    var append = '';
    var append2 = '';
    jml_art_post = 0;
    var data = {id:id};
    $.ajax({
      type:'POST',
      url:baseurl+'/get_art',
      data:data,
      dataType:'json',
    }).done(function (res) {
      var r = res.data;
      for (var i = 0; i < res.data.length; i++) {
        var disabled='';
        var readonly='';
        var color='';
        var val=0;
        var valSo=ribuan(r[i].qty);
        if(r[i].ispost == 'Y'){
          color = 'style="background-color:#c7c7c7"';
          disabled = 'disabled';
          readonly = 'readonly';
          val = '';
          valSo = '';
        }
        append += '<table id="datatable_tabletools" class="table table-striped table-bordered table-hover" width="100%">';
        if(i==0){
        append += '<thead width="100%"><tr>';
        append += '<th width="5%">Acc</th>';
        append += '<th width="10%">No SO</th>';
        append += '<th width="10%">Kode Artikel</th>';
        append += '<th width="10%">Qty SO</th>';
        append += '<th width="25%">Nama Barang</th>';
        append += '<th width="10%">Detail Warna A</th>';
        append += '<th width="10%">Detail Warna B</th>';
        append += '<th width="15%">Qty</th>';
        append += '</tr></thead>';
        }
        append += '<tbody name="list_art" width="100%"><tr '+color+'>';
        append += '<td width="5%"><input name="acc_art[]" type="checkbox" value="" '+disabled+'></td>';
        append += '<td width="10%">'+r[i].so_id+'</td>';
        append += '<td width="10%" class="art_id">'+r[i].art_id+'</td>';
        append += '<td width="10%" class="qty_so"><input type="decimal" class="form-control ribuan" name="qty_so[]" onblur="calc_qty_so();" qty="'+r[i].qty+'" value="'+valSo+'" '+readonly+'></td>';
        append += '<td width="25%">'+r[i].nama_produk+'</td>';
        append += '<td width="10%">';
        for (var x = 0; x < res.data_detail.length; x++) {
          var warna_a = (res.data_detail[x].warna_a != null) ? res.data_detail[x].warna_a : '';
          append += '<input type="text" class="form-control" name="art_name_detail[]" value="'+warna_a+'" readonly></br>';
        }
        append += '</td>';
        append += '<td width="10%">';
        for (var x = 0; x < res.data_detail.length; x++) {
          var warna_b = (res.data_detail[x].warna_b != null) ? res.data_detail[x].warna_b : '';
        append += '<input type="text" class="form-control" name="art_name_detail[]" value="'+warna_b+'" readonly></br>';
        }
        append += '</td>';
        append += '<td width="15%">';
        for (var x = 0; x < res.data_detail.length; x++) {
        append += '<input type="decimal" class="form-control ribuan" name="art_qty[]" value="'+val+'" artikel="'+r[i].art_id+'" '+readonly+'></br>';
        }
        append += '</td>';
        append += '</tr></tbody></table>';
        jml_art_post = jml_art_post + 1;
      }

        append += '<table id="datatable_tabletools" class="table table-striped table-bordered table-hover" width="100%">'; 
        append += '<thead width="100%"><tr>';
        append += '<th width="5%"></th>';
        append += '<th width="10%">Total Qty SO</th>';
        append += '<th width="10%">Total Qty Cutting</th>';
        append += '<th width="10%">Total Qty Pakai</th>';
        append += '<th width="25%"></th>';
        append += '<th width="20%">Total Qty Sisa</th>';
        append += '<th width="15%">Total Qty Acc</th>';
        append += '</tr></thead>';
        append += '</tr></thead>';
        append += '<tbody name="list_art"><tr>';
        append += '<td></td>';
        append += '<td><input type="decimal" class="form-control ribuan" name="total_qty_so" value="'+res.total_art+'" readonly></td>';
        append += '<td><input type="decimal" class="form-control ribuan" name="total_qty_cutting" value="'+res.total_cutting+'" readonly></td>';
        append += '<td><input type="decimal" class="form-control ribuan" name="total_qty_pakai_cutting" value="'+res.total_pakai_cutting+'" readonly></td>';
        append += '<td></td>';
        append += '<td><input type="decimal" class="form-control ribuan" name="total_qty_sisa" value="'+res.total_sisa+'" readonly></td>';
        append += '<td><input type="decimal" class="form-control ribuan" name="total_qty_now" value="0" readonly></td>';
        append += '</tr></tbody></table></br>';

      $('.table_art').html('');
      $('.table_art').append(append);
      // console.log(append);
      $('[name=so_id_post]').val(r[0].so_id);
      runRibuan();
      runDecimal();
      calc_qty_so();
      accChange();
      // $('input.ribuan[name=art_qty]').on('blur', function () {
      //   if (parseFloat(ribuantodb($(this).val())) < parseFloat($(this).attr('qty')) - 100 ) {
      //     myswal('w','Maaf tidak boleh kurang','w',1500);
      //     $(this).val(ribuan($(this).attr('qty')));
      //   } else if (parseFloat(ribuantodb($(this).val())) > parseFloat($(this).attr('qty')) + 100 ) {
      //     myswal('w','Maaf tidak boleh lebih','w',1500);
      //     $(this).val(ribuan($(this).attr('qty')));
      //   }
      // });
    });
  }

  function postData() {
    var id = $('[name=so_id_post]').val();
    var data = [];
    $('[name="acc_art[]"]:checked').each(function (r) {
      var self = $(this);
      var art = self.parents('tr').find('.art_id').text();
      var qty_so = self.parents('tr').find('[name="qty_so[]"]');
      var qty = self.parents('tr').find('[name="art_qty[]"]');
      var array_qty = new Array();
      var array_qty_so = new Array();
      var total_qty_so = 0;
      var total_qty = 0;
      var total_qty_so_all = parseInt($('[name=total_qty_so]').val());
      qty_so.each(function (r2) {
        array_qty_so.push($(this).val());
        total_qty_so = parseInt(total_qty_so) + parseInt(ribuantodb(qty_so.val())) * 1;
      });

      qty.each(function (r2) {
        array_qty.push($(this).val());
        total_qty = parseInt(total_qty) + parseInt(ribuantodb(qty.val())) * 1;
      });

      if(total_qty_so > total_qty_so_all){
        myswal('w','Cek kembali Qty So','w',1500);
        $('form.form_penyerian').trigger("reset");
        return;
      }
      
      if(total_qty > total_qty_so){
        myswal('w','Cek kembali Qty','w',1500);
        $('form.form_penyerian').trigger("reset");
        return;
      }
      
      // console.log('Total Qty '+total_qty);
      // console.log('Total Qty SO '+total_qty_so);
      // console.log('Total Qty SO All '+total_qty_so_all);

      data.push({
        so : id,
        art : art,
        qty_so : qty_so.val(),
        qty : array_qty,
      });
    });
    var data = {data:data};
      // if(data.lenght){
      // } else {
      //   console.log(data.lenght);
      //   return myswal('w','Pilih acc','w',1500);
      // }
    // console.log(data.length);
    // console.log(data);
    $.ajax({
      type:'POST',
      url:baseurl+'/posting_art',
      data:data,
      dataType:'json',
    }).done(function (res) {
      var r = res.data;
      if (res.data == 1) {
        myswal('s','Sukses memposting data artikel','s',1500);
        $('#modalPost').modal('toggle');
        $('[name=btnShowArt'+id+']').addClass('disabled');
        $('[name=btnShowProcess'+id+']').addClass('disabled');
        $('[name=isactive'+id+']').html('Telah Di Posting');
        table_so.ajax.reload();
      } else {

      }
    });
  }


  select2Run();
  setkg($('[name="id_satuan[]"]'));
  function select2Run() {
    $('#id_so').select2({
      ajax: {
        url: baseurl+'/get_produksi',
        delay:250,
        data: function (params) {
          var query = {
            search: params.term,
            type: 'public',
            jenis: 'keluar_ok',
            kategori: 'bb',
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

    $('[name=id_cmt],[name=id_cmt_edit]').select2({
      ajax: {
        url: baseurl+'/get_cmt',
        delay:250,
        data: function (params) {
          var query = {
            search: params.term,
            proses: 'cutting',
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

  function calc_qty_so(){
      var total_qty = 0;
      $('[name="qty_so[]"]').each(function (r2) {
        total_qty = parseInt(total_qty) + parseInt(ribuantodb($(this).val())) * 1;
      });
      $('[name=total_qty_so_now]').val(ribuan(total_qty));
  }

  $(function(){
    $('#formAdd').keypress(
      function(event){
        if (event.which == '13') {
          event.preventDefault();
        }
    });
    $('[name=btnPostingArt').on('click', function(e){
      e.preventDefault();
      var total_qty_sisa = ribuantodb($('[name=total_qty_sisa]').val());
      var total_qty_now = ribuantodb($('[name=total_qty_now]').val());
      if(total_qty_now == '' ){
        myswal('w','Total Qty tidak boleh kosong','w',1500);
      } 
      if(parseInt(total_qty_now) > parseInt(total_qty_sisa) ){
        console.log(total_qty_sisa);
        console.log(total_qty_now);
        myswal('w','Total Qty tidak boleh melebihi Total Qty Sisa','w',1500);
      } else {
        postData();
      }
    });

    $('#btnReset').on('click', function (e) {
      resetForm();
      e.preventDefault();
    });



    $('#formAdd').validator().on('submit', function (e) {
      $('input[name=_method]').val('POST');
      if (!e.isDefaultPrevented()){
        var id = $('#id').val();
        url = "{{ url('pemakaian_bb') }}";

        var request = $.ajax({
          url : url,
          type : "POST",
          data : $('#formAdd').serialize(),
          success : function(data) {
            if (data.status == true) {
              myswal('s',data.message,'s',1500);
              setTimeout(function () {
                location.reload();
              }, 1500);
              // table_so.ajax.reload();
              // resetForm();
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

    // $('#btnAddLine').on('click',function (e) {
    //   addRow();
    //   e.preventDefault();
    // });

    $('#detail').on('change','select', function (e) {
      var self = $(this);
      var kode_bb = self.parents('.detailLine').find('[name="kode_bb[]"]');
      var id_bb = self.parents('.detailLine').find('select[name="id_bb[]"]').val();
      var id_warna = self.parents('.detailLine').find('[name="id_warna[]"]').val();
      var id_supplier = self.parents('.detailLine').find('[name="id_supplier[]"]').val();
      if (id_bb == null) id_bb='';
      if (id_warna == null) id_warna='';
      if (id_supplier == null) id_supplier='';
      kode_bb.val(id_bb+'-'+id_warna+'-'+id_supplier+'');
    });

    $('#id_so').on('change', function (e) {
      
      e.preventDefault();
      var id = $('#id_so');
      if (id.val() == null) {
        return;
      } else {
      var id = $(this).val();
      $('[name="qty_pemakaian[]"]').prop('readonly',false);
      $('[name="acc[]"]').prop('checked',false);
      $('[name="acc[]"]').prop('disabled',false);
      $('[name="hasil_cutt[]"]').prop('readonly',false);
      $('#no_bukti_keluar').val('');
      $('#no_bukti_pemakaian').val('');
      $('.qty').attr('kode','');
      url = "{{ route('detail_permintaan_bb.get') }}";
      $.ajax({
        url : url,
        type : "POST",
        data : {id_so:id},
        success : function(data) {
          $('#no_bukti_keluar').val(data.id_keluar);
          $('#no_bukti_pemakaian').val(data.id_pemakaian);
          $('#no_bukti_permintaan').val(data.permintaan[0]['id']);
          var dataCmt = {
            id: data.id_cmt,
            text: data.nama_cmt
          };
          if(data.id_cmt != ''){
            var newOptionCmt = new Option(dataCmt.text, dataCmt.id, false, false);
            $('#id_cmt').append(newOptionCmt).trigger('change');
          }
          $('.detailLine').not(':eq(0)').remove();
          var detailLine = $('#detail .detailLine').eq(0).html();
          for (var i = 0; i < data.permintaan.length; i++) {
            if (i > 0) {
              $('#detail .detailLine').last().after('<div class="detailLine form-group">'+detailLine+'</div>');
            }

            $('[name="kode_bb[]"]').eq(i).val(data.permintaan[i]['kode_bb']);
            $('[name="nama_bb[]"]').eq(i).val(data.permintaan[i]['nama_bb']);
            $('[name="id_bb[]"]').eq(i).val(data.permintaan[i]['id_bb']);
            $('[name="nama_warna[]"]').eq(i).val(data.permintaan[i]['nama_warna']);
            $('[name="id_warna[]"]').eq(i).val(data.permintaan[i]['id_warna']);
            $('[name="nama_supplier[]"]').eq(i).val(data.permintaan[i]['nama_supplier']);
            $('[name="id_supplier[]"]').eq(i).val(data.permintaan[i]['id_supplier']);
            $('[name="qty_permintaan[]"]').eq(i).val(data.permintaan[i]['qty_permintaan']);
            $('[name="qty_permintaan[]"]').eq(i).attr('kode_p',data.permintaan[i]['kode_bb']);
            $('[name="qty_keluar[]"]').eq(i).attr('kode_k',data.permintaan[i]['kode_bb']);
            $('[name="qty_pemakaian[]"]').eq(i).attr('kode_s',data.permintaan[i]['kode_bb']);
            $('[name="hasil_cutt[]"]').eq(i).attr('kode_cutt',data.permintaan[i]['kode_bb']);
            // $('[name="hasil_cutt[]"]').eq(i).val(0);
            $('[name="acc[]"]').eq(i).val(i);
            $('[name="acc[]"]').eq(i).attr('kode_acc',data.permintaan[i]['kode_bb']);

            var id_kode = data.permintaan[i]['kode_bb'];
            var qty_keluar = 0;
            var qty_pemakaian = parseInt(data.permintaan[i]['qty_permintaan']);
            $('[kode_k='+id_kode+']').val(qty_keluar);
            // $('[kode_s='+id_kode+']').val(qty_pemakaian);
            $('[name="nama_satuan[]"]').eq(i).val(data.permintaan[i]['nama_satuan']);
            $('[name="id_satuan[]"]').eq(i).val(data.permintaan[i]['id_satuan']);
            $('[name="ket[]"]').eq(i).val(data.permintaan[i]['ket']);
          }

          for (var i = 0; i < data.keluar.length; i++){
            var total_keluar = 0;
            var id_keluar = data.keluar[i]["kode_bb"];
            var qty_keluar = data.keluar[i]['qty_keluar'];
            var qty_pemakaian = parseInt($('[kode_p='+id_keluar+']').val()) - parseInt(qty_keluar);
            $('[kode_k='+id_keluar+']').val(qty_keluar);
            // $('[kode_s='+id_keluar+']').val(qty_pemakaian);
            // var qty_pemakaian_finish = $('[kode_s='+id_keluar+']').val();
          }

          for (var i = 0; i < data.pemakaian.length; i++){
            var total_pemakaian = 0;
            var id_pemakaian = data.pemakaian[i]["kode_bb"];
            var qty_pemakaian = data.pemakaian[i]['qty_pemakaian'];
            $('[kode_s='+id_pemakaian+']').val(qty_pemakaian);            
            $('[kode_s='+id_pemakaian+']').prop('readonly',true);
            $('[kode_cutt='+id_pemakaian+']').prop('readonly',true);
            $('[kode_acc='+id_pemakaian+']').prop('disabled',true);
          }

          for (var i = 0; i < data.hasil_cutt.length; i++){
            var total_cutt = 0;
            var id_cutt = data.hasil_cutt[i]["kode_bb"];
            var qty_cutt = data.hasil_cutt[i]['qty_cutt'];
            $('[kode_cutt='+id_cutt+']').val(qty_cutt);
          }
        runRibuan();
        runDecimal();
        },
        error : function(data){
          myswal('e',data.message,'e',1500);
        }
      });
      return false;
     }
    $('#formAdd').validator('update');
    });

  });

  //Fungsi Reset Data form
  function resetForm() {
    $('#formAdd')[0].reset();
    $("#id_cmt").select2("val", "");
    $("#id_so").select2("val", "");
    select2Run();
    $('#formAdd').validator('update');
    $('.detailLine').not(':eq(0)').remove();
  }

//Fungsi Edit
function editData(so_id) {
  swal({
    title: 'Masukkan PIN Super Admin!',
    input: 'password',
    inputAttributes: {
      autocapitalize: 'off'
    },
    showCancelButton: true,
    confirmButtonText: 'Aprove',
    showLoaderOnConfirm: true,
    preConfirm: (pin) => {
      $.ajax({
        url: "{{ url('validasi_pin_super_admin') }}",
        type: "POST",
        data: {'pin':pin,'_token' : token},
        dataType: "JSON",
        success: function(data) {
          if (data.status == true) {
            showEdit(so_id);
          } else {
            myswal('e',data.message,'e',1500);
          }
        },
        error : function() {
          myswal('e','Not Autorized..','e',1500);
        }
      });
    },
    allowOutsideClick: () => !swal.isLoading()
  });

}
closeEdit();
// Fungsi Show Edit
function showEdit(so_id) {
  console.log(so_id);
  $('.edit-pemakaian').show();
  $('.create-pemakaian').hide();
  $('.list-data-pemakaian').hide();
  getData(so_id);
}

// Fungsi Show Edit
function closeEdit() {
  console.log('close edit');
  $('.edit-pemakaian').hide();
  $('.create-pemakaian').show();
  $('.list-data-pemakaian').show();
  $('#formEdit')[0].reset();
}

function getData(so_id){
    var id = so_id;
    if (id == null || id == '') {
      return;
    } else {
    $('[name="qty_pemakaian_edit[]"]').prop('readonly',false);
    $('[name="hasil_cutt_edit[]"]').prop('readonly',false);
    $('#no_bukti_keluar_edit').val('');
    $('#no_bukti_pemakaian_edit').val('');
    $('.qty-edit').attr('kode','');
    url = "{{ route('detail_permintaan_bb.get') }}";
    $.ajax({
      url : url,
      type : "POST",
      data : {id_so:id},
      success : function(data) {
        $('#id_so_edit').val(id);
        $('#no_bukti_keluar_edit').val(data.id_keluar);
        $('#no_bukti_pemakaian_edit').val(data.id_pemakaian);
        $('#no_bukti_permintaan_edit').val(data.permintaan[0]['id']);
        $("#id_cmt_edit").select2("val", "");
        var dataCmt = {
            id: data.id_cmt,
            text: data.nama_cmt
        };
        if(data.id_cmt != ''){
            var newOptionCmt = new Option(dataCmt.text, dataCmt.id, false, false);
            $('#id_cmt_edit').append(newOptionCmt).trigger('change');
          }
        $('.detailLine-edit').not(':eq(0)').remove();
        var detailLine = $('#detail-edit .detailLine-edit').eq(0).html();
        for (var i = 0; i < data.permintaan.length; i++) {
          if (i > 0) {
            $('#detail-edit .detailLine-edit').last().after('<div class="detailLine-edit form-group">'+detailLine+'</div>');
          }

          $('[name="kode_bb_edit[]"]').eq(i).val(data.permintaan[i]['kode_bb']);
          $('[name="nama_bb_edit[]"]').eq(i).val(data.permintaan[i]['nama_bb']);
          $('[name="id_bb_edit[]"]').eq(i).val(data.permintaan[i]['id_bb']);
          $('[name="nama_warna_edit[]"]').eq(i).val(data.permintaan[i]['nama_warna']);
          $('[name="id_warna_edit[]"]').eq(i).val(data.permintaan[i]['id_warna']);
          $('[name="nama_supplier_edit[]"]').eq(i).val(data.permintaan[i]['nama_supplier']);
          $('[name="id_supplier_edit[]"]').eq(i).val(data.permintaan[i]['id_supplier']);
          $('[name="qty_permintaan_edit[]"]').eq(i).val(data.permintaan[i]['qty_permintaan']);
          $('[name="qty_permintaan_edit[]"]').eq(i).attr('kode_p',data.permintaan[i]['kode_bb']);
          $('[name="qty_keluar_edit[]"]').eq(i).attr('kode_k',data.permintaan[i]['kode_bb']);
          $('[name="qty_pemakaian_edit[]"]').eq(i).attr('kode_s',data.permintaan[i]['kode_bb']);
          $('[name="hasil_cutt_edit[]"]').eq(i).attr('kode_cutt',data.permintaan[i]['kode_bb']);
          // $('[name="hasil_cutt_edit[]"]').eq(i).val(0);
          $('[name="acc_edit[]"]').eq(i).val(i);
          $('[name="acc_edit[]"]').eq(i).attr('kode_acc',data.permintaan[i]['kode_bb']);

          var id_kode = data.permintaan[i]['kode_bb'];
          var qty_keluar = 0;
          var qty_pemakaian = parseInt(data.permintaan[i]['qty_permintaan']);
          $('[kode_k='+id_kode+']').val(qty_keluar);
          // $('[kode_s='+id_kode+']').val(qty_pemakaian);
          $('[name="nama_satuan_edit[]"]').eq(i).val(data.permintaan[i]['nama_satuan']);
          $('[name="id_satuan_edit[]"]').eq(i).val(data.permintaan[i]['id_satuan']);
          $('[name="ket_edit[]"]').eq(i).val(data.permintaan[i]['ket']);
        }

        for (var i = 0; i < data.keluar.length; i++){
          var total_keluar = 0;
          var id_keluar = data.keluar[i]["kode_bb"];
          var qty_keluar = data.keluar[i]['qty_keluar'];
          var qty_pemakaian = parseInt($('[kode_p='+id_keluar+']').val()) - parseInt(qty_keluar);
          $('[kode_k='+id_keluar+']').val(qty_keluar);
          // $('[kode_s='+id_keluar+']').val(qty_pemakaian);
          // var qty_pemakaian_finish = $('[kode_s='+id_keluar+']').val();
        }

        for (var i = 0; i < data.pemakaian.length; i++){
          var total_pemakaian = 0;
          var id_pemakaian = data.pemakaian[i]["kode_bb"];
          var qty_pemakaian = data.pemakaian[i]['qty_pemakaian'];
          $('[kode_s='+id_pemakaian+']').val(qty_pemakaian);            
          $('[kode_s='+id_pemakaian+']').prop('readonly',false);
          $('[kode_cutt='+id_pemakaian+']').prop('readonly',false);
          $('[kode_acc='+id_pemakaian+']').prop('disabled',false);
        }

        for (var i = 0; i < data.hasil_cutt.length; i++){
          var total_cutt = 0;
          var id_cutt = data.hasil_cutt[i]["kode_bb"];
          var qty_cutt = data.hasil_cutt[i]['qty_cutt'];
          $('[kode_cutt='+id_cutt+']').val(qty_cutt);
        }
      runRibuan();
      runDecimal();
      },
      error : function(data){
        myswal('e',data.message,'e',1500);
      }
    });
    return false;
    }
  $('#formEdit').validator('update');
}

$('#btnCloseEdit').on('click', function (e) {
  batalEdit();
});

//Fungsi Batal Edit
function batalEdit() {
  $('#formEdit')[0].reset();
  closeEdit();
}

$('#btnUpdate').on('click', function (e) {
  if (!e.isDefaultPrevented()){
    var id = $('#id').val();
    url = "{{ route('pemakaian_bb.update') }}";

    $.ajax({
      url : url,
      type : "POST",
      data : $('#formEdit').serialize(),
      success : function(data) {
        if (data.status == true) {
          myswal('s',data.message,'s',1500);
          table_so.ajax.reload();
          closeEdit();
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


  </script>
  @endsection
