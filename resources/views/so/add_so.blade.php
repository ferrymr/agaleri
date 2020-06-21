@extends('layouts.app')

@section('style')
<style media="screen">
  [name=label-name-costumer]{
    top: 7px;
  }
  .modal-header{
    background-color: #f78c40;
    color: white;
  }
  .label_artikel{
    text-align:center;
  }
</style>
@endsection

@section('content')
<div id="main" class="utama_panel"role="main">
  <div id="content">
    <section id="widget-grid" class="">
      <div class="row">
        <article class="col-sm-12 col-md-12 col-lg-12 sortable-grid ui-sortable">
          <div class="jarviswidget jarviswidget-color-orange jarviswidget-sortable" id="wid-id-1" data-widget-editbutton="false" role="widget">
            <header role="heading" class="ui-sortable-handle"><div class="jarviswidget-ctrls" role="menu">   <a href="javascript:void(0);" class="button-icon jarviswidget-toggle-btn" rel="tooltip" title="" data-placement="bottom" data-original-title="Collapse"><i class="fa fa-minus "></i></a> <a href="javascript:void(0);" class="button-icon jarviswidget-fullscreen-btn" rel="tooltip" title="" data-placement="bottom" data-original-title="Fullscreen"><i class="fa fa-expand "></i></a> <a href="javascript:void(0);" class="button-icon jarviswidget-delete-btn" rel="tooltip" title="" data-placement="bottom" data-original-title="Delete"><i class="fa fa-times"></i></a></div><div class="widget-toolbar" role="menu"><a data-toggle="dropdown" class="dropdown-toggle color-box selector" href="javascript:void(0);"></a><ul class="dropdown-menu arrow-box-up-right color-select pull-right"><li><span class="bg-color-green" data-widget-setstyle="jarviswidget-color-green" rel="tooltip" data-placement="left" data-original-title="Green Grass"></span></li><li><span class="bg-color-greenDark" data-widget-setstyle="jarviswidget-color-greenDark" rel="tooltip" data-placement="top" data-original-title="Dark Green"></span></li><li><span class="bg-color-greenLight" data-widget-setstyle="jarviswidget-color-greenLight" rel="tooltip" data-placement="top" data-original-title="Light Green"></span></li><li><span class="bg-color-purple" data-widget-setstyle="jarviswidget-color-purple" rel="tooltip" data-placement="top" data-original-title="Purple"></span></li><li><span class="bg-color-magenta" data-widget-setstyle="jarviswidget-color-magenta" rel="tooltip" data-placement="top" data-original-title="Magenta"></span></li><li><span class="bg-color-pink" data-widget-setstyle="jarviswidget-color-pink" rel="tooltip" data-placement="right" data-original-title="Pink"></span></li><li><span class="bg-color-pinkDark" data-widget-setstyle="jarviswidget-color-pinkDark" rel="tooltip" data-placement="left" data-original-title="Fade Pink"></span></li><li><span class="bg-color-blueLight" data-widget-setstyle="jarviswidget-color-blueLight" rel="tooltip" data-placement="top" data-original-title="Light Blue"></span></li><li><span class="bg-color-teal" data-widget-setstyle="jarviswidget-color-teal" rel="tooltip" data-placement="top" data-original-title="Teal"></span></li><li><span class="bg-color-blue" data-widget-setstyle="jarviswidget-color-blue" rel="tooltip" data-placement="top" data-original-title="Ocean Blue"></span></li><li><span class="bg-color-blueDark" data-widget-setstyle="jarviswidget-color-blueDark" rel="tooltip" data-placement="top" data-original-title="Night Sky"></span></li><li><span class="bg-color-darken" data-widget-setstyle="jarviswidget-color-darken" rel="tooltip" data-placement="right" data-original-title="Night"></span></li><li><span class="bg-color-yellow" data-widget-setstyle="jarviswidget-color-yellow" rel="tooltip" data-placement="left" data-original-title="Day Light"></span></li><li><span class="bg-color-orange" data-widget-setstyle="jarviswidget-color-orange" rel="tooltip" data-placement="bottom" data-original-title="Orange"></span></li><li><span class="bg-color-orangeDark" data-widget-setstyle="jarviswidget-color-orangeDark" rel="tooltip" data-placement="bottom" data-original-title="Dark Orange"></span></li><li><span class="bg-color-red" data-widget-setstyle="jarviswidget-color-red" rel="tooltip" data-placement="bottom" data-original-title="Red Rose"></span></li><li><span class="bg-color-redLight" data-widget-setstyle="jarviswidget-color-redLight" rel="tooltip" data-placement="bottom" data-original-title="Light Red"></span></li><li><span class="bg-color-white" data-widget-setstyle="jarviswidget-color-white" rel="tooltip" data-placement="right" data-original-title="Purity"></span></li><li><a href="javascript:void(0);" class="jarviswidget-remove-colors" data-widget-setstyle="" rel="tooltip" data-placement="bottom" data-original-title="Reset widget color to default">Remove</a></li></ul></div>
              <span class="widget-icon"> <i class="fa fa-file-o"></i> </span>
              <h2>Form SO</h2>
              <span class="jarviswidget-loader"><i class="fa fa-refresh fa-spin"></i></span></header>
              <div role="content">
                <div class="widget-body">
                  <div role="content">
                    <div class="widget-body">
                      <form class="form-horizontal" method="POST" action="{{ url('add_bahan_baku') }}">
                        {{ csrf_field() }}
                        <div class="form-group">
                          <label for="id" class="col-md-2 control-label">Kode</label>
                          <div class="col-md-2">
                            <input type="text" class="form-control" name="id" value="{{ $trans_id }}" readonly>
                          </div>
                          <label class="col-md-2 control-label">Jam Order</label>
                          <div class="col-md-2">
                            <input type="text" name="jam_order" value="{{ $time }}" class="form-control" readonly="">
                          </div>
                          <label class="col-md-2 control-label">Dikerjakan</label>
                          <div class="col-md-2">
                            <label class="radio radio-inline">
                              <input type="radio" class="radiobox" name="status_kerjaan" value="S" checked="">
                              <span>Sendiri</span>
                            </label>
                            <label class="radio radio-inline">
                              <input type="radio" class="radiobox" name="status_kerjaan" value="F">
                              <span>F.O.B</span>
                            </label>
                          </div>
                        </div>

                        <div class="form-group">
                          <label class="col-md-2 control-label">Tanggal Order</label>
                          <div class="col-md-3">
                            <div class="input-group">
                              <input type="text" name="tanggal_order" placeholder="Pilih tanggal" class="form-control datepicker" data-dateformat="dd/mm/yy" value="{{ $tanggal_order }}">
                              <span class="input-group-addon"><i class="fa fa-calendar"></i></span>
                            </div>
                          </div>
                          <label class="col-md-1 control-label">Deadline</label>
                          <div class="col-md-2">
                            <div class="input-group">
                              <input type="text" name="dead" value="" placeholder="Pilih tanggal" class="form-control datepicker " data-dateformat="dd/mm/yy" >
                              <span class="input-group-addon"><i class="fa fa-calendar"></i></span>
                            </div>
                          </div>
                          <div class="col-md-2">
                            <div class="input-group">
                              <input type="text" name="dead_end" value="" placeholder="Pilih tanggal" class="form-control datepicker " data-dateformat="dd/mm/yy">
                              <span class="input-group-addon"><i class="fa fa-calendar"></i></span>
                            </div>
                          </div>
                        </div>

                        <div class="form-group">
                          <label class="col-md-2 control-label">Costumer</label>
                          <div class="col-md-3">
                            <select style="width:40%" name="costumer_id" class="col-sm-6 select2 select2-hidden-accessible form-control" tabindex="0" aria-hidden="true">
                              <option></option>
                              @foreach($costumer as $c)
                              <option value="{{ $c->id }}" akun="{{ $c->akun_id }}">{{ $c->name }}</option>
                              @endforeach
                            </select>
                          </div>
                            <input type="hidden" class="form-control" name="term" value="" placeholder="Term">
                          <!-- <label class="col-md-2 control-label">Term of Payment</label> -->
                          <!-- <div class="col-md-1">
                            <input type="text" class="form-control" name="term" value="" placeholder="Term">
                          </div>
                          <label class="col-md-1 control-label" style="text-align:left !important;">Hari</label> -->
                        </div>

                        <div class="form-group">
                          <label class="col-md-2 control-label">Keterangan</label>
                          <div class="col-md-10">
                            <input type="text" name="ket" value="" class="form-control" >
                          </div>
                        </div>

                        <div class="form-group">
                          <label class="col-md-2 control-label">Kategori BJ</label>
                          <div class="col-md-4">
                            <select style="width:40%" name="barang_jadi_id" class="col-sm-6 select2 select2-hidden-accessible form-control" tabindex="0" aria-hidden="true">
                              <option></option>
                              @foreach($produk as $i)
                              <option value="{{ $i->id }}">{{ $i->name }}</option>
                              @endforeach
                            </select>
                          </div>
                          <label class="col-md-1 control-label">Brand</label>
                          <div class="col-md-2">
                            <select style="width:40%" name="brand_id" class="col-sm-6 select2 select2-hidden-accessible form-control" tabindex="0" aria-hidden="true">
                              <option></option>
                              @foreach($brand as $i)
                              <option value="{{ $i->id }}">{{ $i->name }}</option>
                              @endforeach
                            </select>
                          </div>
                          <label class="col-md-1 control-label">Bahan Baku</label>
                          <div class="col-md-2">
                            <select style="width:40%" name="bahan_baku_id" class="col-sm-6 select2 select2-hidden-accessible form-control" tabindex="0" aria-hidden="true">
                              <option></option>
                              @foreach($bahan_baku as $i)
                              <option value="{{ $i->id }}">{{ $i->name }}</option>
                              @endforeach
                            </select>
                          </div>
                        </div>

                        <div class="form-group">
                          <label for="" class="col-md-2 control-label">Bulan Produksi</label>
                          <div class="col-md-1">
                            <input type="text" class="form-control" name="bulan_produksi" value="{{ $bulan_produksi }}" readonly>
                          </div>
                          <label for="" class="col-md-2 control-label">Rencana Produksi</label>
                          <div class="col-md-2">
                            <input type="decimal" class="form-control ribuan" name="qty_produksi" value="" placeholder="Qty Produksi">
                          </div>
                          <div class="col-md-1">
                            <select class="form-control" name="satuan">
                              <option value="PCS">Pcs</option>
                            </select>
                          </div>
                          <label for="" class="col-md-2 control-label">Jumlah Artikel</label>
                          <div class="col-md-2">
                            <input type="decimal" class="form-control ribuan" name="art" value="1" placeholder="Jumlah Artikel">
                          </div>
                        </div>

                        <div class="form-group">
                          <label for="" class="col-md-2 control-label">Harga Jual SPK</label>
                          <div class="col-md-2">
                            <input type="decimal" class="form-control ribuan" name="harga_jual_spk" value="" placeholder="Harga">
                          </div>
                          <label for="" class="col-md-1 control-label">Nilai Kerja</label>
                          <div class="col-md-3">
                            <input type="decimal" readonly class="form-control ribuan" name="nilai_pekerjaan" value="" placeholder="Nilai">
                          </div>
                        </div>
                        <div class="form-group">
                          <label for="" class="col-md-2 control-label">Pembayaran DP</label>
                          <div class="col-md-2">
                            <input type="decimal" class="form-control ribuan" name="dp" value="" placeholder="Dp">
                          </div>
                          <!-- <label class="col-md-1 control-label">Dari </label> -->
                          <!-- <div class="col-md-1"> -->
                            <!-- <select class="form-control" style="width:100%;" name="id_akun_sumber"></select> -->
                            <input type="hidden" name="id_akun_sumber" value="">
                          <!-- </div> -->
                          <label class="col-md-1 control-label">Setor Ke </label>
                          <div class="col-md-3">
                            <select class="form-control" style="width:100%;" name="id_akun_tujuan"></select>
                          </div>
                          <label for="" class="col-md-1 control-label">Sisa</label>
                          <div class="col-md-3">
                            <input type="decimal" class="form-control ribuan" name="sisa_pembayaran" value="" placeholder="Sisa" readonly>
                          </div>
                        </div>

                        <div class="form-group">
                          <label for="nomor_produksi" class="col-md-2 control-label">No Produksi</label>
                          <div class="col-md-10">
                            <input type="text" class="form-control input-lg" name="no_produksi" value="" readonly>
                          </div>
                        </div>

                        <div class="form-group">
                          <label for="kode_barang" class="col-md-2 control-label">Kode Barang Jadi</label>
                          <div class="col-md-10">
                            <input type="text" class="form-control" name="kode_barang" value="" readonly>
                          </div>
                        </div>

                        <div class="form-group">
                          <label for="nomor_produksi_spk" class="col-md-2 control-label">Nama Barang Jadi</label>
                          <div class="col-md-10">
                            <input type="text" class="form-control" name="nama_barang_jadi" value="">
                          </div>
                        </div>

                        <div class="form-group">
                          <label for="nomor_produksi_spk" class="col-md-2 control-label">Catatan</label>
                          <div class="col-md-10">
                            <textarea name="catatan" rows="8" cols="80" style="width:100%" placeholder="Isi Catan Produksi"></textarea>
                          </div>
                        </div>

                        <fieldset>
                          <legend>Catatan Produksi</legend>
                          <div class="form-group">
                            <label class="col-md-2 control-label"></label>
                            <label class="col-md-2 label_artikel">Warna A</label>
                            <label class="col-md-2 label_artikel">Warna B</label>
                            <label class="col-md-1 label_artikel">S</label>
                            <label class="col-md-1 label_artikel">M</label>
                            <label class="col-md-1 label_artikel">L</label>
                            <label class="col-md-1 label_artikel">XL</label>
                          </div>
                          <div class="form-group">
                            <label for="nomor_produksi_spk" class="col-md-2 control-label">1</label>
                            <div class="col-md-2">
                              <select style="width:40%" name="warna_art_1_a" class="col-sm-6 select2 catatanProduksi select2-hidden-accessible form-control" tabindex="0" aria-hidden="true">
                                <option></option>
                                @foreach($warna as $i)
                                <option value="{{ $i->id }}">{{ $i->name }}</option>
                                @endforeach
                              </select>
                            </div>
                            <div class="col-md-2">
                              <select style="width:40%" name="warna_art_1_b" class="col-sm-6 select2 select2-hidden-accessible form-control" tabindex="0" aria-hidden="true">
                                <option></option>
                                @foreach($warna as $i)
                                <option value="{{ $i->id }}">{{ $i->name }}</option>
                                @endforeach
                              </select>
                            </div>
                            <div class="col-md-1">
                              <input type="text" class="form-control" name="ukuran_art_1_s" value="">
                            </div>
                            <div class="col-md-1">
                              <input type="text" class="form-control" name="ukuran_art_1_m" value="">
                            </div>
                            <div class="col-md-1">
                              <input type="text" class="form-control" name="ukuran_art_1_l" value="">
                            </div>
                            <div class="col-md-1">
                              <input type="text" class="form-control" name="ukuran_art_1_xl" value="">
                            </div>
                          </div>
                          <div class="form-group">
                            <label for="nomor_produksi_spk" class="col-md-2 control-label">2</label>
                            <div class="col-md-2">
                              <select style="width:40%" name="warna_art_2_a" class="col-sm-6 select2 catatanProduksi select2-hidden-accessible form-control" tabindex="0" aria-hidden="true">
                                <option></option>
                                @foreach($warna as $i)
                                <option value="{{ $i->id }}">{{ $i->name }}</option>
                                @endforeach
                              </select>
                            </div>
                            <div class="col-md-2">
                              <select style="width:40%" name="warna_art_2_b" class="col-sm-6 select2 select2-hidden-accessible form-control" tabindex="0" aria-hidden="true">
                                <option></option>
                                @foreach($warna as $i)
                                <option value="{{ $i->id }}">{{ $i->name }}</option>
                                @endforeach
                              </select>
                            </div>
                            <div class="col-md-1">
                              <input type="text" class="form-control" name="ukuran_art_2_s" value="">
                            </div>
                            <div class="col-md-1">
                              <input type="text" class="form-control" name="ukuran_art_2_m" value="">
                            </div>
                            <div class="col-md-1">
                              <input type="text" class="form-control" name="ukuran_art_2_l" value="">
                            </div>
                            <div class="col-md-1">
                              <input type="text" class="form-control" name="ukuran_art_2_xl" value="">
                            </div>
                          </div>
                          <div class="form-group">
                            <label for="nomor_produksi_spk" class="col-md-2 control-label">3</label>
                            <div class="col-md-2">
                              <select style="width:40%" name="warna_art_3_a" class="col-sm-6 select2 catatanProduksi select2-hidden-accessible form-control" tabindex="0" aria-hidden="true">
                                <option></option>
                                @foreach($warna as $i)
                                <option value="{{ $i->id }}">{{ $i->name }}</option>
                                @endforeach
                              </select>
                            </div>
                            <div class="col-md-2">
                              <select style="width:40%" name="warna_art_3_b" class="col-sm-6 select2 select2-hidden-accessible form-control" tabindex="0" aria-hidden="true">
                                <option></option>
                                @foreach($warna as $i)
                                <option value="{{ $i->id }}">{{ $i->name }}</option>
                                @endforeach
                              </select>
                            </div>
                            <div class="col-md-1">
                              <input type="text" class="form-control" name="ukuran_art_3_s" value="">
                            </div>
                            <div class="col-md-1">
                              <input type="text" class="form-control" name="ukuran_art_3_m" value="">
                            </div>
                            <div class="col-md-1">
                              <input type="text" class="form-control" name="ukuran_art_3_l" value="">
                            </div>
                            <div class="col-md-1">
                              <input type="text" class="form-control" name="ukuran_art_3_xl" value="">
                            </div>
                          </div>
                          <div class="form-group">
                            <label for="nomor_produksi_spk" class="col-md-2 control-label">4</label>
                            <div class="col-md-2">
                              <select style="width:40%" name="warna_art_4_a" class="col-sm-6 select2 catatanProduksi select2-hidden-accessible form-control" tabindex="0" aria-hidden="true">
                                <option></option>
                                @foreach($warna as $i)
                                <option value="{{ $i->id }}">{{ $i->name }}</option>
                                @endforeach
                              </select>
                            </div>
                            <div class="col-md-2">
                              <select style="width:40%" name="warna_art_4_b" class="col-sm-6 select2 select2-hidden-accessible form-control" tabindex="0" aria-hidden="true">
                                <option></option>
                                @foreach($warna as $i)
                                <option value="{{ $i->id }}">{{ $i->name }}</option>
                                @endforeach
                              </select>
                            </div>
                            <div class="col-md-1">
                              <input type="text" class="form-control" name="ukuran_art_4_s" value="">
                            </div>
                            <div class="col-md-1">
                              <input type="text" class="form-control" name="ukuran_art_4_m" value="">
                            </div>
                            <div class="col-md-1">
                              <input type="text" class="form-control" name="ukuran_art_4_l" value="">
                            </div>
                            <div class="col-md-1">
                              <input type="text" class="form-control" name="ukuran_art_4_xl" value="">
                            </div>
                          </div>
                          <div class="form-group">
                            <label for="nomor_produksi_spk" class="col-md-2 control-label">5</label>
                            <div class="col-md-2">
                              <select style="width:40%" name="warna_art_5_a" class="col-sm-6 select2 catatanProduksi select2-hidden-accessible form-control" tabindex="0" aria-hidden="true">
                                <option></option>
                                @foreach($warna as $i)
                                <option value="{{ $i->id }}">{{ $i->name }}</option>
                                @endforeach
                              </select>
                            </div>
                            <div class="col-md-2">
                              <select style="width:40%" name="warna_art_5_b" class="col-sm-6 select2 select2-hidden-accessible form-control" tabindex="0" aria-hidden="true">
                                <option></option>
                                @foreach($warna as $i)
                                <option value="{{ $i->id }}">{{ $i->name }}</option>
                                @endforeach
                              </select>
                            </div>
                            <div class="col-md-1">
                              <input type="text" class="form-control" name="ukuran_art_5_s" value="">
                            </div>
                            <div class="col-md-1">
                              <input type="text" class="form-control" name="ukuran_art_5_m" value="">
                            </div>
                            <div class="col-md-1">
                              <input type="text" class="form-control" name="ukuran_art_5_l" value="">
                            </div>
                            <div class="col-md-1">
                              <input type="text" class="form-control" name="ukuran_art_5_xl" value="">
                            </div>
                          </div>
                          <div class="form-group">
                            <label for="nomor_produksi_spk" class="col-md-2 control-label">6</label>
                            <div class="col-md-2">
                              <select style="width:40%" name="warna_art_6_a" class="col-sm-6 select2 catatanProduksi select2-hidden-accessible form-control" tabindex="0" aria-hidden="true">
                                <option></option>
                                @foreach($warna as $i)
                                <option value="{{ $i->id }}">{{ $i->name }}</option>
                                @endforeach
                              </select>
                            </div>
                            <div class="col-md-2">
                              <select style="width:40%" name="warna_art_6_b" class="col-sm-6 select2 select2-hidden-accessible form-control" tabindex="0" aria-hidden="true">
                                <option></option>
                                @foreach($warna as $i)
                                <option value="{{ $i->id }}">{{ $i->name }}</option>
                                @endforeach
                              </select>
                            </div>
                            <div class="col-md-1">
                              <input type="text" class="form-control" name="ukuran_art_6_s" value="">
                            </div>
                            <div class="col-md-1">
                              <input type="text" class="form-control" name="ukuran_art_6_m" value="">
                            </div>
                            <div class="col-md-1">
                              <input type="text" class="form-control" name="ukuran_art_6_l" value="">
                            </div>
                            <div class="col-md-1">
                              <input type="text" class="form-control" name="ukuran_art_6_xl" value="">
                            </div>
                          </div>
                          <div class="form-group">
                            <label for="nomor_produksi_spk" class="col-md-2 control-label">7</label>
                            <div class="col-md-2">
                              <select style="width:40%" name="warna_art_7_a" class="col-sm-6 select2 catatanProduksi select2-hidden-accessible form-control" tabindex="0" aria-hidden="true">
                                <option></option>
                                @foreach($warna as $i)
                                <option value="{{ $i->id }}">{{ $i->name }}</option>
                                @endforeach
                              </select>
                            </div>
                            <div class="col-md-2">
                              <select style="width:40%" name="warna_art_7_b" class="col-sm-6 select2 select2-hidden-accessible form-control" tabindex="0" aria-hidden="true">
                                <option></option>
                                @foreach($warna as $i)
                                <option value="{{ $i->id }}">{{ $i->name }}</option>
                                @endforeach
                              </select>
                            </div>
                            <div class="col-md-1">
                              <input type="text" class="form-control" name="ukuran_art_7_s" value="">
                            </div>
                            <div class="col-md-1">
                              <input type="text" class="form-control" name="ukuran_art_7_m" value="">
                            </div>
                            <div class="col-md-1">
                              <input type="text" class="form-control" name="ukuran_art_7_l" value="">
                            </div>
                            <div class="col-md-1">
                              <input type="text" class="form-control" name="ukuran_art_7_xl" value="">
                            </div>
                          </div>
                          <div class="form-group">
                            <label for="nomor_produksi_spk" class="col-md-2 control-label">8</label>
                            <div class="col-md-2">
                              <select style="width:40%" name="warna_art_8_a" class="col-sm-6 select2 catatanProduksi select2-hidden-accessible form-control" tabindex="0" aria-hidden="true">
                                <option></option>
                                @foreach($warna as $i)
                                <option value="{{ $i->id }}">{{ $i->name }}</option>
                                @endforeach
                              </select>
                            </div>
                            <div class="col-md-2">
                              <select style="width:40%" name="warna_art_8_b" class="col-sm-6 select2 select2-hidden-accessible form-control" tabindex="0" aria-hidden="true">
                                <option></option>
                                @foreach($warna as $i)
                                <option value="{{ $i->id }}">{{ $i->name }}</option>
                                @endforeach
                              </select>
                            </div>
                            <div class="col-md-1">
                              <input type="text" class="form-control" name="ukuran_art_8_s" value="">
                            </div>
                            <div class="col-md-1">
                              <input type="text" class="form-control" name="ukuran_art_8_m" value="">
                            </div>
                            <div class="col-md-1">
                              <input type="text" class="form-control" name="ukuran_art_8_l" value="">
                            </div>
                            <div class="col-md-1">
                              <input type="text" class="form-control" name="ukuran_art_8_xl" value="">
                            </div>
                          </div>
                          <div class="form-group">
                            <label for="nomor_produksi_spk" class="col-md-2 control-label">9</label>
                            <div class="col-md-2">
                              <select style="width:40%" name="warna_art_9_a" class="col-sm-6 select2 catatanProduksi select2-hidden-accessible form-control" tabindex="0" aria-hidden="true">
                                <option></option>
                                @foreach($warna as $i)
                                <option value="{{ $i->id }}">{{ $i->name }}</option>
                                @endforeach
                              </select>
                            </div>
                            <div class="col-md-2">
                              <select style="width:40%" name="warna_art_9_b" class="col-sm-6 select2 select2-hidden-accessible form-control" tabindex="0" aria-hidden="true">
                                <option></option>
                                @foreach($warna as $i)
                                <option value="{{ $i->id }}">{{ $i->name }}</option>
                                @endforeach
                              </select>
                            </div>
                            <div class="col-md-1">
                              <input type="text" class="form-control" name="ukuran_art_9_s" value="">
                            </div>
                            <div class="col-md-1">
                              <input type="text" class="form-control" name="ukuran_art_9_m" value="">
                            </div>
                            <div class="col-md-1">
                              <input type="text" class="form-control" name="ukuran_art_9_l" value="">
                            </div>
                            <div class="col-md-1">
                              <input type="text" class="form-control" name="ukuran_art_9_xl" value="">
                            </div>
                          </div>
                          <div class="form-group">
                            <label for="nomor_produksi_spk" class="col-md-2 control-label">10</label>
                            <div class="col-md-2">
                              <select style="width:40%" name="warna_art_10_a" class="col-sm-6 select2 catatanProduksi select2-hidden-accessible form-control" tabindex="0" aria-hidden="true">
                                <option></option>
                                @foreach($warna as $i)
                                <option value="{{ $i->id }}">{{ $i->name }}</option>
                                @endforeach
                              </select>
                            </div>
                            <div class="col-md-2">
                              <select style="width:40%" name="warna_art_10_b" class="col-sm-6 select2 select2-hidden-accessible form-control" tabindex="0" aria-hidden="true">
                                <option></option>
                                @foreach($warna as $i)
                                <option value="{{ $i->id }}">{{ $i->name }}</option>
                                @endforeach
                              </select>
                            </div>
                            <div class="col-md-1">
                              <input type="text" class="form-control" name="ukuran_art_10_s" value="">
                            </div>
                            <div class="col-md-1">
                              <input type="text" class="form-control" name="ukuran_art_10_m" value="">
                            </div>
                            <div class="col-md-1">
                              <input type="text" class="form-control" name="ukuran_art_10_l" value="">
                            </div>
                            <div class="col-md-1">
                              <input type="text" class="form-control" name="ukuran_art_10_xl" value="">
                            </div>
                          </div>
                        </fieldset>

                        <div class="form-actions">
                          <div class="row">
                            <div class="col-md-12">
                              <div class="btn-group">
                                <a href="#" class="btn btn-sm btn-success" onclick="sendSO(0)"> <i class="fa fa-save"></i> Submit </a>
                              </div>
                              <div class="btn-group">
                                <a href="#" class="btn btn-sm btn-primary" onclick="sendSO(1)"> <i class="fa fa-print"></i> Submit & Print </a>
                              </div>
                              <div class="btn-group">
                                <a href="#" class="btn btn-sm btn-danger"> <i class="fa fa-refresh"></i> Refresh </a>
                              </div>
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
  </div>

  @endsection

  @section('script')
  <script>
  var names = ["costumer_id","barang_jadi_id","brand_id","bahan_baku_id"];
  var jml_catatan = 0;

  $(function () {
    runSelect2Locale();
    runRibuan();
    $('.select2').on('select2:select', function (e) {
      $(this).focus();
    });
    $('[name=costumer_id]').on('change', function() {
      var akun = $('option:selected', this).attr('akun');
      $('[name=id_akun_sumber]').val(akun);
    });

    $('[name=warna_art_1_a]').on('change', function() { checkCatatan() });
    $('[name=warna_art_2_a]').on('change', function() { checkCatatan() });
    $('[name=warna_art_3_a]').on('change', function() { checkCatatan() });
    $('[name=warna_art_4_a]').on('change', function() { checkCatatan() });
    $('[name=warna_art_5_a]').on('change', function() { checkCatatan() });
    $('[name=warna_art_6_a]').on('change', function() { checkCatatan() });
    $('[name=warna_art_7_a]').on('change', function() { checkCatatan() });
    $('[name=warna_art_8_a]').on('change', function() { checkCatatan() });
    $('[name=warna_art_9_a]').on('change', function() { checkCatatan() });
    $('[name=warna_art_10_a]').on('change', function() { checkCatatan() });
  });

  function checkCatatan() {
    jml_catatan = 0;
    $('select.catatanProduksi :selected').each(function () {
      if ($(this).val() != '') {
        jml_catatan = jml_catatan + 1 ;
        // console.log(jml_catatan);
      }
    });
  }

  setTimeout(function () {
    generateKodeProduksi();
  }, 3000);

  $('[name='+names[0]+']').on('change', function() {generateKodeProduksi();});
  $('[name='+names[1]+']').on('change', function() {generateKodeProduksi();});
  $('[name='+names[2]+']').on('change', function() {generateKodeProduksi();});
  $('[name='+names[3]+']').on('change', function() {generateKodeProduksi();});

  //Kalkulasi Nilai Pekerjaan
  $('[name=qty_produksi]').on('keyup', function() {kalkulasiNilaiProduksi();});
  $('[name=harga_jual_spk]').on('keyup', function() {kalkulasiNilaiProduksi();});
  $('[name=dp]').on('keyup', function() {KalkulasiSisa();});

  function kalkulasiNilaiProduksi() {
    var qty   = ribuantodb($('[name=qty_produksi]').val());
    var harga = ribuantodb($('[name=harga_jual_spk]').val());

    var total = qty*harga;
    $('[name=nilai_pekerjaan]').val(ribuan(total));
  }

  function KalkulasiSisa() {
    var total = ribuantodb($('[name=nilai_pekerjaan]').val());
    var dp    = ribuantodb($('[name=dp]').val());
    if (total != '' || dp != '') {
      var sisa  = total - dp;
      $('[name=sisa_pembayaran]').val(ribuan(sisa));
    }
  }

  function generateKodeProduksi() {
    var cid         = $('[name='+names[0]+'] :selected').val();
    var bjid        = $('[name='+names[1]+'] :selected').val();
    var bid         = $('[name='+names[2]+'] :selected').val();
    var bbid        = $('[name='+names[3]+'] :selected').val();
    var t           = $('[name=bulan_produksi]').val();
    var id          = $('[name=id]').val();
    var no_produksi = cid+'-'+t+'-'+bjid+'-'+bid+'-'+bbid+'-'+id;
    $('[name=no_produksi]').val(no_produksi);
    var no_barang   = bjid+'-'+bid+'-'+id+'-'+t;
    var art         = $('[name=art]').val();
    $('[name=kode_barang]').val(no_barang);
    var nama_bj = $('[name='+names[1]+'] :selected').text() +' '+  $('[name='+names[2]+'] :selected').text()
    $('[name=nama_barang_jadi]').val(nama_bj);
  }


  function sendSO(type) {
    var url = '{{ url("/") }}/send_so';
    var id  = $('[name=id]').val(); var jam_order  = $('[name=jam_order]').val(); var status_kerjaan  = $('[name=status_kerjaan]:checked').val();
    var tanggal_order  = $('[name=tanggal_order]').val(); var ket  = $('[name=ket]').val();  var dead  = $('[name=dead]').val();
    var dead_end  = $('[name=dead_end]').val(); var qty_produksi  = ribuantodb($('[name=qty_produksi]').val());  var art  = ribuantodb($('[name=art]').val());
    var term  = $('[name=term]').val();  var harga_jual_spk  = ribuantodb($('[name=harga_jual_spk]').val()); var nilai_pekerjaan  = ribuantodb($('[name=nilai_pekerjaan]').val());
    var dp  = ribuantodb($('[name=dp]').val()); var no_produksi  = $('[name=no_produksi]').val(); var kode_barang  = $('[name=kode_barang]').val();
    var nama_barang_jadi  = $('[name=nama_barang_jadi]').val(); var catatan  = $('[name=catatan]').val();
    var sisa_pembayaran = ribuantodb($('[name=sisa_pembayaran]').val());
    var id_akun_sumber = $('[name=id_akun_sumber]').val();
    var id_akun_tujuan = $('[name=id_akun_tujuan]').val();
    // console.log(id_akun_tujuan);
    if(dp != '' ){
      if(id_akun_tujuan == null){
        return alert("Harus terisi akun tujuan");
      }
    }

    if(dead == '' || dead_end == ''|| dead_end == dead){
      return alert("Deadline Harus Terisi dan Tidak Boleh Sama");
    }

    if (no_produksi.length <= 30) {
      return alert("Maaf tolong isi dengan benar!");
    }

    var data_catatan = [];
    var data_art = [];

    data_art.push({
      id          : kode_barang,
      produksi_id : no_produksi,
      so_id       : no_produksi.substr(0,5),
      target_id   : no_produksi.substr(6,3),
      qty         : qty_produksi/art,
    });

    for (var i = 0; i < jml_catatan; i++) {
      var x = i + 1;
      var str = "" + x;
      var pad = "000";
      var y = pad.substr(0, pad.length - str.length) + str;
      var w_a = $('[name=warna_art_'+x+'_a] :selected').val();
      var w_b = $('[name=warna_art_'+x+'_b] :selected').val();
      var u_s = $('[name=ukuran_art_'+x+'_s]').val();
      var u_m = $('[name=ukuran_art_'+x+'_m]').val();
      var u_l = $('[name=ukuran_art_'+x+'_l]').val();
      var u_xl = $('[name=ukuran_art_'+x+'_xl]').val();

      data_catatan.push({
        id : kode_barang+"-"+y,
        warna_a : w_a,
        warna_b : w_b,
        s : u_s,
        m : u_m,
        l : u_l,
        xl : u_xl,
      });
    }

    if (data_catatan.length < 1) {
      return alert("Maaf tolong isi Catatan Produksi!");
      data_catatan = [];
    }

    var data = {
      "id"              :id,
      "jam_order"       :jam_order,
      "status_kerjaan"  :status_kerjaan,
      "tanggal_order"   :tanggal_order,
      "ket"             :ket,
      "dead"            :dead,
      "dead_end"        :dead_end,
      "qty_produksi"    :qty_produksi,
      "art"             :art,
      "term"            :term,
      "harga_jual_spk"  :harga_jual_spk,
      "nilai_pekerjaan" :nilai_pekerjaan,
      "dp"              :dp,
      "id_akun_sumber"  :id_akun_sumber,
      "id_akun_tujuan"  :id_akun_tujuan,
      "sisa_pembayaran" :sisa_pembayaran,
      "no_produksi"     :no_produksi,
      "kode_barang"     :kode_barang,
      "nama_barang_jadi":nama_barang_jadi,
      "catatan"         :catatan,
      "data_catatan"    :data_catatan,
      "data_art"        :data_art,
    };
    $.ajax({
      type:"POST",
      url:url,
      data:data,
      success:function(data){
        myswal('s','So berhasil dibuat!','s',1500);
        if (type == 0) {
          setTimeout(function () {
            window.location.reload();
          }, 2000);
        } else if (type == 1) {
          var urlprint = baseurl+'/so/'+id+'/print';
          window.open(urlprint);
          setTimeout(function () {
            window.location.reload();
          }, 2000);
        }
      }
    });
  }

  function runSelect2Locale() {
    $('[name="id_akun_tujuan"]').select2({
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
            level: '4'
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
