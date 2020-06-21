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
        {{ $title }}
      </h1>
    </div>
  </div>

  <section id="widget-grid" class="">
    <div class="row">
      <article class="col-sm-12 col-md-12 col-lg-12">
        <div class="jarviswidget" id="wid-id-0" data-widget-colorbutton="false" data-widget-editbutton="false">
          <header>
            <span class="widget-icon"> <i class="fa fa-send"></i> </span>
            <h2>{{ $title }} General</h2>
          </header>
          <div> 
            <div class="widget-body">
              <form id="formAdd" method="post" class="form-horizontal" data-toggle="validator" enctype="multipart/form-data" action="{{ route('clear_data.proses') }}">
                {{ csrf_field() }} {{ method_field('POST') }}
                
                <fieldset>
                  <div class="form-group">
                  <label class="select2 col-md-1 control-label">Profile Clear</label>
                    <div class="col-md-2">
                      <select style="width:40%" name="profile_clear" class="col-sm-6 select2 select2-hidden-accessible form-control" tabindex="0" aria-hidden="true">
                        <option value="manual">Manual</option>
                        <option value="master">Clear Master Data</option>
                        <option value="so">Clear SO</option>
                        <option value="warehouse">Clear Warehouse</option>
                        <option value="production">Clear Production</option>
                        <option value="skb">Clear SKB</option>
                        <option value="finance">Clear Finance</option>
                        <option value="accounting">Clear Accounting</option>
                        <option value="accounting">Clear eCommerce</option>
                      </select>
                    </div>
                  </div>
                  <hr>
                  <div class="form-group">
                    <label class="col-md-1 control-label">Master Data</label>
                    <div class="col-md-10">
                      <label class="checkbox-inline">
                        <input type="checkbox" name="master[]" value="BahanBaku" class="checkbox style-0">
                        <span>Bahan Baku</span>
                      </label>
                      <label class="checkbox-inline">
                        <input type="checkbox" name="master[]" value="Warna" class="checkbox style-0">
                        <span>Warna</span>
                      </label>
                      <label class="checkbox-inline">
                        <input type="checkbox" name="master[]" value="Brand" class="checkbox style-0">
                        <span>Brand</span>
                      </label>
                      <label class="checkbox-inline">
                        <input type="checkbox" name="master[]" value="BarangJadi" class="checkbox style-0">
                        <span>Barang Jadi</span>
                      </label>
                      <label class="checkbox-inline">
                        <input type="checkbox" name="master[]" value="Supplier" class="checkbox style-0">
                        <span>Supplier</span>
                      </label>
                      <label class="checkbox-inline">
                        <input type="checkbox" name="master[]" value="Costumer" class="checkbox style-0">
                        <span>Costumer</span>
                      </label>
                      <label class="checkbox-inline">
                        <input type="checkbox" name="master[]" value="Cmt" class="checkbox style-0">
                        <span>Cmt</span>
                      </label>
                      <label class="checkbox-inline">
                        <input type="checkbox" name="master[]" value="Acc" class="checkbox style-0">
                        <span>Accessories</span>
                      </label>
                      <label class="checkbox-inline">
                        <input type="checkbox" name="master[]" value="Bank" class="checkbox style-0">
                        <span>Bank</span>
                      </label>
                      <label class="checkbox-inline">
                        <input type="checkbox" name="master[]" value="Satuan" class="checkbox style-0">
                        <span>Satuan</span>
                      </label>
                      <label class="checkbox-inline">
                        <input type="checkbox" name="master[]" value="Proses" class="checkbox style-0">
                        <span>Proses</span>
                      </label>
                    </div>
                  </div>
                  <div class="form-group">
                    <label class="col-md-1 control-label">So</label>
                    <div class="col-md-10">
                      <label class="checkbox-inline">
                        <input type="checkbox" name="so[]" value="So" class="checkbox style-0" >
                        <span>SO</span>
                      </label>
                      <label class="checkbox-inline">
                        <input type="checkbox" name="so[]" value="Art" class="checkbox style-0" >
                        <span>Artikel</span>
                      </label>
                      <label class="checkbox-inline">
                        <input type="checkbox" name="so[]" value="CatatanProduksi" class="checkbox style-0" >
                        <span>Catatan</span>
                      </label>
                      <label class="checkbox-inline">
                        <input type="checkbox" name="so[]" value="PostArtDetail" class="checkbox style-0" >
                        <span>Art Detail</span>
                      </label>
                    </div>
                  </div>
                  <div class="form-group">
                    <label class="col-md-1 control-label">Gudang</label>
                    <div class="col-md-10">
                      <label class="checkbox-inline">
                        <input type="checkbox" name="gudang[]" value="KeluarBB" class="checkbox style-0" >
                        <span>Keluar BB</span>
                      </label>
                      <label class="checkbox-inline">
                        <input type="checkbox" name="gudang[]" value="MasterBB" class="checkbox style-0">
                        <span>Stock BB</span>
                      </label>
                      <label class="checkbox-inline">
                        <input type="checkbox" name="gudang[]" value="KartuPersediaanBB" class="checkbox style-0">
                        <span>Kartu Persediaan BB</span>
                      </label>
                      <label class="checkbox-inline">
                        <input type="checkbox" name="gudang[]" value="ReturBB" class="checkbox style-0" >
                        <span>Retur BB</span>
                      </label>
                      <label class="checkbox-inline">
                        <input type="checkbox" name="gudang[]" value="KeluarAcc" class="checkbox style-0" >
                        <span>Keluar Acc</span>
                      </label>
                      <label class="checkbox-inline">
                        <input type="checkbox" name="gudang[]" value="MasterAcc" class="checkbox style-0">
                        <span>Stock Acc</span>
                      </label>
                      <label class="checkbox-inline">
                        <input type="checkbox" name="gudang[]" value="KartuPersediaanAcc" class="checkbox style-0">
                        <span>Kartu Persediaan Acc</span>
                      </label>
                      <label class="checkbox-inline">
                        <input type="checkbox" name="gudang[]" value="ReturBB" class="checkbox style-0" >
                        <span>Retur Acc</span>
                      </label>
                      <label class="checkbox-inline">
                        <input type="checkbox" name="gudang[]" value="MasterBJ" class="checkbox style-0">
                        <span>Stock BJ</span>
                      </label>
                    </div>
                  </div>
                  <div class="form-group">
                    <label class="col-md-1 control-label">Produksi</label>
                    <div class="col-md-10">
                      <label class="checkbox-inline">
                        <input type="checkbox" name="produksi[]" value="PermintaanBB" class="checkbox style-0" >
                        <span>Permintaan Bahan Baku</span>
                      </label>
                      <label class="checkbox-inline">
                        <input type="checkbox" name="produksi[]" value="PemakaianBB" class="checkbox style-0" >
                        <span>Pemakaian Bahan Baku</span>
                      </label>
                      <label class="checkbox-inline">
                        <input type="checkbox" name="produksi[]" value="ReturBB" class="checkbox style-0" >
                        <span>Retur Bahan Baku</span>
                      </label>
                      <label class="checkbox-inline">
                        <input type="checkbox" name="produksi[]" value="PermintaanAcc" class="checkbox style-0" >
                        <span>Permintaan Accessories</span>
                      </label>
                      <label class="checkbox-inline">
                        <input type="checkbox" name="produksi[]" value="PemakaianAcc" class="checkbox style-0" >
                        <span>Pemakaian Accessories</span>
                      </label>
                      <label class="checkbox-inline">
                        <input type="checkbox" name="produksi[]" value="ReturAcc" class="checkbox style-0" >
                        <span>Retur Accessories</span>
                      </label>
                    </div>
                  </div>
                  <div class="form-group">
                    <label class="col-md-1 control-label">Skb</label>
                    <div class="col-md-10">
                      <label class="checkbox-inline">
                        <input type="checkbox" name="skb[]" value="Skb" class="checkbox style-0" >
                        <span>Skb Masuk, Keluar, Adjust</span>
                      </label>
                    </div>
                  </div>
                  <div class="form-group">
                    <label class="col-md-1 control-label">Invoice</label>
                    <div class="col-md-10">
                      <label class="checkbox-inline">
                        <input type="checkbox" name="invoice" value="Invoice" class="checkbox style-0">
                        <span>Invoice</span>
                      </label>
                    </div>
                  </div>
                  <div class="form-group">
                    <label class="col-md-1 control-label">Finance</label>
                    <div class="col-md-10">
                      <label class="checkbox-inline">
                        <input type="checkbox" name="finance[]" value="PembelianBB" class="checkbox style-0">
                        <span>Pembelian Bahan Baku</span>
                      </label>
                      <label class="checkbox-inline">
                        <input type="checkbox" name="finance[]" value="PembelianAcc" class="checkbox style-0">
                        <span>Pembelian Accessories</span>
                      </label>
                      <label class="checkbox-inline">
                        <input type="checkbox" name="finance[]" value="PembelianBJ" class="checkbox style-0">
                        <span>Pembelian Barang Jadi</span>
                      </label>
                    </div>
                  </div>
                  <div class="form-group">
                    <label class="col-md-1 control-label"></label>
                    <div class="col-md-10">
                      <label class="checkbox-inline">
                        <input type="checkbox" name="finance[]" value="Pengeluaran" class="checkbox style-0">
                        <span>Pengeluaran</span>
                      </label>
                      <label class="checkbox-inline">
                        <input type="checkbox" name="finance[]" value="Hutang" class="checkbox style-0">
                        <span>Hutang</span>
                      </label>
                      <label class="checkbox-inline">
                        <input type="checkbox" name="finance[]" value="PembayaranPiutang" class="checkbox style-0">
                        <span>Piutang</span>
                      </label>
                      <label class="checkbox-inline">
                        <input type="checkbox" name="finance[]" value="Giro" class="checkbox style-0">
                        <span>Giro</span>
                      </label>
                    </div>
                  </div>
                  <div class="form-group">
                    <label class="col-md-1 control-label">Accounting</label>
                    <div class="col-md-10">
                      <label class="checkbox-inline">
                        <input type="checkbox" name="accounting[]" value="Trans" class="checkbox style-0">
                        <span>All Jurnal</span>
                      </label>
                      <label class="checkbox-inline">
                        <input type="checkbox" name="accounting[]" value="Akun" class="checkbox style-0">
                        <span>Akun</span>
                      </label>
                    </div>
                  </div>
                  <div class="form-group">
                    <label class="col-md-1 control-label">Ecommerce</label>
                    <div class="col-md-10">
                      <label class="checkbox-inline">
                        <input type="checkbox" name="ecommerce[]" value="Trans" class="checkbox style-0">
                        <span>All Transaction</span>
                      </label>
                      <label class="checkbox-inline">
                        <input type="checkbox" name="ecommerce[]" value="Product" class="checkbox style-0">
                        <span>Product</span>
                      </label>
                    </div>
                  </div>
                </fieldset>

                <div class="form-actions">
                  <div class="row">
                    <div class="col-md-12">
                      <button id="btnAdd" type="submit" class="btn btn-primary">
                        <i class="fa fa-send"></i>
                        Proccess
                      </button>
                    </div>
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
</div>

@endsection

@section('script')
<script>
$(function () {
  $('[name=model]').on('change', function() {
    var model = $(this).val();
    var code  = '';
    if (model == 'BahanBaku') {
      code = 'BB';
    } else if (model == 'Warna') {
      code = 'W';
    } else if (model == 'Brand') {
      code = 'B';
    } else if (model == 'BarangJadi') {
      code = 'BJ';
    } else if (model == 'Acc') {
      code = 'AC';
    }
    $('[name=code]').val(code);
    console.log(model);
    console.log(code);
  });
});
</script>
@endsection
