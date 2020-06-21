@extends('layouts.app')

@section('style')
<style media="screen">
  .label_costumer{
    top: 7px;
  }
  .modal-header{
    background-color: #f78c40;
    color: white;
  }
</style>
@endsection

@section('content')

<!-- MAIN PANEL -->
<div id="main" class="utama_panel"role="main">
  <div id="content">

				<!-- widget grid -->
				<section id="widget-grid" class="">

					<!-- row -->
					<div class="row">

						<!-- NEW WIDGET START -->
						<article class="col-xs-12 col-sm-12 col-md-12 col-lg-12 sortable-grid ui-sortable">

							<!-- Widget ID (each widget will need unique ID)-->
							<div class="jarviswidget well jarviswidget-color-darken" id="wid-id-0" data-widget-sortable="false" data-widget-deletebutton="false" data-widget-editbutton="false" data-widget-colorbutton="false" role="widget">
								<!-- widget options:
								usage: <div class="jarviswidget" id="wid-id-0" data-widget-editbutton="false">

								data-widget-colorbutton="false"
								data-widget-editbutton="false"
								data-widget-togglebutton="false"
								data-widget-deletebutton="false"
								data-widget-fullscreenbutton="false"
								data-widget-custombutton="false"
								data-widget-collapsed="true"
								data-widget-sortable="false"

								-->
								<header role="heading"><div class="jarviswidget-ctrls" role="menu">   <a href="javascript:void(0);" class="button-icon jarviswidget-toggle-btn" rel="tooltip" title="" data-placement="bottom" data-original-title="Collapse"><i class="fa fa-minus "></i></a> <a href="javascript:void(0);" class="button-icon jarviswidget-fullscreen-btn" rel="tooltip" title="" data-placement="bottom" data-original-title="Fullscreen"><i class="fa fa-expand "></i></a> </div>
									<span class="widget-icon"> <i class="fa fa-barcode"></i> </span>
									<h2>Item #44761 </h2>

								<span class="jarviswidget-loader"><i class="fa fa-refresh fa-spin"></i></span></header>

								<!-- widget div-->
								<div role="content">

									<!-- widget edit box -->
									<div class="jarviswidget-editbox">
										<!-- This area used as dropdown edit box -->

									</div>
									<!-- end widget edit box -->

									<!-- widget content -->
                  <div class="widget-body no-padding">
                  	<div class="widget-body-toolbar">
                  		<div class="row">
                  			<div class="col-sm-4">
                  				<!-- <div class="input-group">
                  					<input class="form-control" type="text" placeholder="Cari">
                  					<div class="input-group-btn">
                  						<button class="btn btn-default" type="button">
                  							<i class="fa fa-search"></i> Search
                  						</button>
                  					</div>
                  				</div> -->
                  			</div>
                  			<div class="col-sm-8 text-align-right">
                  				<div class="btn-group">
                  					<a href="#" class="btn btn-sm btn-success" data-toggle="modal" data-target="#modalProduk"> <i class="fa fa-plus"></i> Tambah </a>
                  				</div>
                  				<div class="btn-group">
                  					<a href="#" class="btn btn-sm btn-primary" data-toggle="modal" data-target="#modalProduk"> <i class="fa fa-print"></i> Cetak </a>
                  				</div>
                  				<div class="btn-group">
                            <a href="#" class="btn btn-sm btn-danger" data-toggle="modal" data-target="#modalProduk"> <i class="fa fa-refresh"></i> Reset </a>
                  				</div>
                  				<div class="btn-group">
                            <a href="#" class="btn btn-sm btn-warning" data-toggle="modal" data-target="#modalProduk"> <i class="fa fa-money"></i> Bayar </a>
                  				</div>

                  			</div>
                  		</div>
                  	</div>
                  	<div class="padding-10">
                  		<br>
                  		<div class="pull-left">
                  			<img src="{{ asset('logo.png')}}" width="150" height="32" alt="invoice icon">
                  			<address>
                  				<br>
                  				<strong>CV. LUNAWIJAYA</strong>
                  				<br>
                  				Alamat Jalan Gempol Asri I No. 62
                  				<br>
                  				Bandung, 40215
                  				<br>
                  			</address>
                  		</div>
                  		<div class="pull-right">
                  			<h1 class="font-400">PO</h1>
                  		</div>
                  		<div class="clearfix"></div>
                  		<br>
                  		<br>
                  		<div class="row">
                  			<div class="col-sm-9">
                          <div class="form-group">
                						<label class="col-md-1 control-label label_costumer">Costumer</label>
                            <div class="col-md-4">
                						<select style="width:40%" class="col-sm-6 select2 select2-hidden-accessible form-control" tabindex="-1" aria-hidden="true">
                              @foreach($costumer as $c)
                              <option value="{{ $c->id }}">{{ $c->name }}</option>
                              @endforeach
                						</select>
                            </div>
                					</div>
                  			</div>
                  			<div class="col-sm-3">
                            <div class="form-group">
                  						<label name="label-name-costumer" class="col-md-4 control-label">No Transaksi</label>
                              <div class="col-md-8">
                  						<input type="text" name="" value="{{ $trans_id }}" class="form-control" readonly="">
                              </div>
                  					</div><br><br>
                            <div class="form-group">
                  						<label name="label-name-costumer" class="col-md-4 control-label">Tanggal</label>
                              <div class="col-md-8">
                                <div class="input-group">
                									<input type="text" name="mydate" placeholder="Select a date" class="form-control datepicker hasDatepicker" data-dateformat="dd/mm/yy" id="dp1523416796855">
                									<span class="input-group-addon"><i class="fa fa-calendar"></i></span>
                								</div>
                              </div>
                  					</div>
                  			</div>
                        <br>
                        <br>
                        <br>
                        <br>
                        <br>
                        <br>
                  		</div>
                  		<table class="table table-hover">
                  			<thead>
                  				<tr>
                  					<th class="text-center">QTY</th>
                  					<th>KODE ITEM</th>
                  					<th>ITEM</th>
                  					<th>HARGA</th>
                  					<th>SUBTOTAL</th>
                  				</tr>
                  			</thead>
                  			<tbody>
                  				<tr>
                  					<td class="text-center"><strong>100</strong></td>
                  					<td><a href="javascript:void(0);">B004</a></td>
                  					<td>T SHIRT LOMBOK EXCOTIC</td>
                  					<td>Rp 130.000</td>

                  					<td>Rp 13.000.000</td>
                  				</tr>

                  				<tr>
                  					<td colspan="4">Total</td>
                  					<td><strong>Rp 13.000.000</strong></td>
                  				</tr>
                  				<tr>
                  					<td colspan="4">Discount</td>
                  					<td><strong>13%</strong></td>
                  				</tr>
                  			</tbody>
                  		</table>

                  		<div class="invoice-footer">

                  			<div class="row">

                  				<div class="col-sm-7">
                  					<!-- <div class="payment-methods">
                  						<h5>Payment Methods</h5>
                  						<img src="img/invoice/paypal.png" width="64" height="64" alt="paypal">
                  						<img src="img/invoice/americanexpress.png" width="64" height="64" alt="american express">
                  						<img src="img/invoice/mastercard.png" width="64" height="64" alt="mastercard">
                  						<img src="img/invoice/visa.png" width="64" height="64" alt="visa">
                  					</div> -->
                  				</div>
                  				<div class="col-sm-5">
                  					<div class="invoice-sum-total pull-right">
                  						<h3><strong>Total Bayar: <span class="text-success">Rp 11.700.000</span></strong></h3>
                  					</div>
                  				</div>

                  			</div>

                  			<div class="row">
                  				<!-- <div class="col-sm-12">
                  					<p class="note">**To avoid any excess penalty charges, please make payments within 30 days of the due date. There will be a 2% interest charge per month on all late invoices.</p>
                  				</div> -->
                  			</div>

                  		</div>
                  	</div>
                  </div>
									<!-- end widget content -->

								</div>
								<!-- end widget div -->

							</div>
							<!-- end widget -->

						</article>
						<!-- WIDGET END -->

					</div>

					<!-- end row -->

				</section>
				<!-- end widget grid -->

			</div>
<!-- MAIN CONTENT -->
</div>
<!-- END MAIN PANEL -->

<!-- Modal -->
				<div class="modal fade" id="modalProduk" role="dialog" aria-labelledby="modalProdukLabel" aria-hidden="true">
					<div class="modal-dialog modal-lg">
						<div class="modal-content">
							<div class="modal-header">
								<button type="button" class="close" data-dismiss="modal" aria-hidden="true">
									&times;
								</button>
								<h4 class="modal-title" id="modalProdukLabel">Produk</h4>
							</div>
							<div class="modal-body">
                <form class="form-horizontal" method="POST" action="{{ url('update_cmt') }}">
                    {{ csrf_field() }}

                    <div class="form-group">
                      <label for="bank_id" class="col-md-2 control-label">Pilih Produk</label>
                      <div class="col-md-10">
                        <select style="width:100%" name="bank_id" class="select2 select2-hidden-accessible form-control">
                          @foreach($produk as $p)
                          <option value="{{ $p->id }}">{{ $p->name }}</option>
                          @endforeach
                        </select>
                      </div>
                    </div>

                    <div class="form-group">
                        <label for="" class="col-md-2 control-label">Qty</label>
                        <div class="col-md-4">
                            <input id="" type="text" class="form-control" name="">
                        </div>
                        <label for="" class="col-md-2 control-label">Disc</label>
                        <div class="col-md-4">
                            <input id="" type="text" class="form-control" name="">
                        </div>
                    </div>

                    <div class="form-group">
                        <label for="" class="col-md-2 control-label">Catatan</label>
                        <div class="col-md-10">
                          <textarea name="name" rows="4" placeholder="Masukkan Catatan Disini" style="width:100%;"></textarea>
                        </div>
                    </div>

                    <div class="form-group">
                      <label class="col-md-2 control-label">Harga Jual</label>
                      <div class="col-md-10">
                        <label class="radio radio-inline">
                          <input type="radio" class="radiobox" name="isactive" value="E" checked="">
                          <span>Eceran</span>
                        </label>
                        <label class="radio radio-inline">
                          <input type="radio" class="radiobox" name="isactive" value="P">
                          <span>Partai</span>
                        </label>
                      </div>
                    </div>


                    <div class="form-actions">
                      <div class="row">
                        <div class="col-md-12">
                          <button class="btn btn-primary" type="">
                            <i class="fa fa-save"></i>
                            Add
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

function editData(data) {
  console.log(data);
  $('[name=id_edit]').val(data[0]);
  $('[name=name_edit]').val(data[1]);
  $('[name=alamat_edit]').val(data[2]);
  $('[name=kota_edit]').val(data[3]);
  $('[name=kode_pos_edit]').val(data[4]);
  $('[name=no_telepon_edit]').val(data[5]);
  $('[name=no_hp_edit]').val(data[6]);
  $('[name=no_fax_edit]').val(data[7]);
  $('[name=email_edit]').val(data[8]);
  $('[name=bank_id_edit]').val(data[9]).change();
  $('[name=no_rek_edit]').val(data[10]);
  if (data[11] == 'A') {
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
        sendAjax('/del_cmt','POST',{id:id});
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
