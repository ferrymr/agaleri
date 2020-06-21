<section id="widget-grid" class="">
	<div class="row">
		<article class="col-xs-12 col-sm-12 col-md-12 col-lg-12">
			<div class="jarviswidget well jarviswidget-color-darken" id="wid-id-0" data-widget-sortable="false" data-widget-deletebutton="false" data-widget-editbutton="false" data-widget-colorbutton="false">
				<header>
					<span class="widget-icon"> <i class="fa fa-barcode"></i> </span>
				</header>
				<div>
					<div class="jarviswidget-editbox">
					</div>
					<div class="widget-body no-padding">
						<div class="padding-10">
							<br>
							<div class="pull-left">
							</div>
							<div class="pull-right">
								<h1 class="font-400">{{ $title }}</h1>
							</div>
							<div class="clearfix"></div>
							<br><br>
							<div class="row">
								<div class="col-sm-9">
									<h4 class="semi-bold"><span class="profile" id="view_name"></span></h4>
									<address>
										<strong>Alamat : <span class="profile" id="view_alamat"></span></strong><br>
										<abbr title="Phone">Telepon :</abbr> <span class="profile" id="view_telepon"></span>
									</address>
								</div>
								<div class="col-sm-3">
									<div><strong>Kode No. : </strong> <span class="dataview" id="view_id"></span> </div>
									<div><strong>Tanggal : </strong> <span class="dataview" id="view_tanggal"></span> </div>
									<div><strong>Supplier : </strong> <span class="dataview" id="view_supplier"></span> </div>
									<div><strong>Alamat : </strong> <span class="dataview" id="view_alamat_supplier"></span> </div>
									<div><strong>Pembelian : </strong> <span class="dataview" id="view_proses"></span> </div>
									<div><strong>Attention : </strong> <span class="dataview" id="view_attention"></span> </div>
									<br>
									<br>
								</div>
							</div>
							<table class="table table-hover">
								<thead>
									<tr>
										<th>Nama Barang</th>
										<th>Colour</th>
										<th>Size</th>
										<th>LD</th>
										<th>Qty</th>
										<th>Unit</th>
										<th>Price</th>
										<th>Total</th>
									</tr>
								</thead>
								<tbody id="view_detail">
								</tbody>
							</table>
							<div class="invoice-footer">
								<div class="row">
									<div class="col-sm-12">
										<span id="view_ppn"></span>
										<p class="note">Note: Tampilan ini tidak dapat dicetak/digandakan!</p>
									</div>
								</div>
							</div>
						</div>
					</div>
				</div>
			</div>
		</article>
	</div>
</section>
