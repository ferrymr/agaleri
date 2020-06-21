@extends('layouts.app')

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
                        <form class="form-horizontal" method="POST" action="{{ url('send_skb') }}">
                            {{ csrf_field() }}

                            <div class="form-group">
                              <label class="col-md-2 control-label">Tanggal Awal:</label>
                              <div class="col-md-2">
                                <div class="input-group">
                                  <input type="text" name="mydate" placeholder="Select a date" class="form-control datepicker" data-dateformat="dd/mm/yy">
                                  <span class="input-group-addon"><i class="fa fa-calendar"></i></span>
                                </div>
                              </div>
                              <label class="col-md-2 control-label">Tanggal Akhir:</label>
                              <div class="col-md-2">
                                <div class="input-group">
                                  <input type="text" name="mydate" placeholder="Select a date" class="form-control datepicker" data-dateformat="dd/mm/yy">
                                  <span class="input-group-addon"><i class="fa fa-calendar"></i></span>
                                </div>
                              </div>
                            </div>



                                <div class="form-group">
                                  <label for="" class="col-md-2 control-label">Produksi ID</label>
                                  <div class="col-md-2">
                                    <select style="width:100%" id="proses_id_utama" class="form-control"></select>
                                  </div>
                                  <label for="" class="col-md-2 control-label">SO ID</label>
                                  <div class="col-md-2">
                                    <select style="width:100%" id="proses_id_utama" class="form-control"></select>
                                  </div>
                                  <label for="" class="col-md-2 control-label">Barang Jadi</label>
                                  <div class="col-md-2">
                                    <select style="width:100%" id="proses_id_utama" class="form-control"></select>
                                  </div>
                                </div>

                                <div class="form-group">
                                  <label for="" class="col-md-2 control-label">Supplier</label>
                                  <div class="col-md-2">
                                    <select style="width:100%" id="proses_id_utama" class="form-control"></select>
                                  </div>
                                  <label for="" class="col-md-2 control-label">Brand</label>
                                  <div class="col-md-2">
                                    <select style="width:100%" id="proses_id_utama" class="form-control"></select>
                                  </div>
                                  <label for="" class="col-md-2 control-label">Bahan Baku</label>
                                  <div class="col-md-2">
                                    <select style="width:100%" id="proses_id_utama" class="form-control"></select>
                                  </div>
                                </div>

                                <div class="form-group">
                                  <label class="col-md-2 control-label">Status </label>
                                  <div class="col-md-2">
                                    <label class="radio radio-inline">
                                      <input type="radio" class="radiobox" name="mata_uang" checked="">
                                      <span>Aktif</span>
                                    </label>
                                    <label class="radio radio-inline">
                                      <input type="radio" class="radiobox" name="mata_uang">
                                      <span>Non Aktif</span>
                                    </label>
                                  </div>
                                </div>
                                <div class="form-actions">
                                  <div class="row">
                                    <div class="col-md-12">
                                      <button class="btn btn-default">
                                        <i class="glyphicon glyphicon-refresh"></i>
                                        Reset
                                      </button>
                                      <button class="btn btn-primary" type="submit">
                                        <i class="glyphicon glyphicon-flash"></i>
                                        Process
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

        <!-- widget content -->
        <div class="widget-body no-padding">

          <table id="datatable_tabletools" class="table table-striped table-bordered table-hover" width="100%">
            <thead>
              <tr>
                <th data-hide="phone">Kode Barang</th>
                <th data-class="expand">Nama Barang</th>
                <th data-hide="phone">Stock</th>
                <th data-hide="phone">Satuan</th>
                <th>Status</th>
                <th>Action</th>
              </tr>
            </thead>
            <tbody>
              <tr class="info">
                <td>0105-40.00-0205</td>
                <td>Kain Cotton Navy Jersey 270 GSM</td>
                <td>200</td>
                <td>KG</td>
                <td><span class="label label-primary">Ready</span></td>
                <td><a href="javascript:void(0);" class="btn btn-default btn-xs disabled"><i class="fa fa-pencil"></i></a>&nbsp;<a href="javascript:void(0);" onclick="verifikasi('0001')" class="btn btn-warning btn-xs"><i class="fa fa-check-square-o"></i></a></td>
              </tr>
              <tr class="warning">
                <td>0445-55.10-0705</td>
                <td>Benang CVC PIQUE MULTISTRIPE</td>
                <td>2</td>
                <td>Yard</td>
                <td><span class="label label-warning">Hampir Habis</span></td>
                <td><a href="javascript:void(0);" class="btn btn-default btn-xs disabled"><i class="fa fa-pencil"></i></a>&nbsp;<a href="javascript:void(0);" onclick="verifikasi('0001')" class="btn btn-warning btn-xs"><i class="fa fa-check-square-o"></i></a></td>
              </tr>
              <tr class="warning">
                <td>0445-55.10-0705</td>
                <td>Benang CVC PIQUE MULTISTRIPE</td>
                <td>2</td>
                <td>Yard</td>
                <td><span class="label label-warning">Hampir Habis</span></td>
                <td><a href="javascript:void(0);" class="btn btn-default btn-xs disabled"><i class="fa fa-pencil"></i></a>&nbsp;<a href="javascript:void(0);" onclick="verifikasi('0001')" class="btn btn-warning btn-xs"><i class="fa fa-check-square-o"></i></a></td>
              </tr>
              <tr class="warning">
                <td>0445-55.10-0705</td>
                <td>Benang CVC PIQUE MULTISTRIPE</td>
                <td>2</td>
                <td>Yard</td>
                <td><span class="label label-warning">Hampir Habis</span></td>
                <td><a href="javascript:void(0);" class="btn btn-default btn-xs disabled"><i class="fa fa-pencil"></i></a>&nbsp;<a href="javascript:void(0);" onclick="verifikasi('0001')" class="btn btn-warning btn-xs"><i class="fa fa-check-square-o"></i></a></td>
              </tr>
              <tr class="warning">
                <td>0445-55.10-0705</td>
                <td>Benang CVC PIQUE MULTISTRIPE</td>
                <td>2</td>
                <td>Yard</td>
                <td><span class="label label-warning">Hampir Habis</span></td>
                <td><a href="javascript:void(0);" class="btn btn-default btn-xs disabled"><i class="fa fa-pencil"></i></a>&nbsp;<a href="javascript:void(0);" onclick="verifikasi('0001')" class="btn btn-warning btn-xs"><i class="fa fa-check-square-o"></i></a></td>
              </tr>
              <tr class="warning">
                <td>0445-55.10-0705</td>
                <td>Benang CVC PIQUE MULTISTRIPE</td>
                <td>2</td>
                <td>Yard</td>
                <td><span class="label label-warning">Hampir Habis</span></td>
                <td><a href="javascript:void(0);" class="btn btn-default btn-xs disabled"><i class="fa fa-pencil"></i></a>&nbsp;<a href="javascript:void(0);" onclick="verifikasi('0001')" class="btn btn-warning btn-xs"><i class="fa fa-check-square-o"></i></a></td>
              </tr>
              <tr class="warning">
                <td>0445-55.10-0705</td>
                <td>Benang CVC PIQUE MULTISTRIPE</td>
                <td>2</td>
                <td>Yard</td>
                <td><span class="label label-warning">Hampir Habis</span></td>
                <td><a href="javascript:void(0);" class="btn btn-default btn-xs disabled"><i class="fa fa-pencil"></i></a>&nbsp;<a href="javascript:void(0);" onclick="verifikasi('0001')" class="btn btn-warning btn-xs"><i class="fa fa-check-square-o"></i></a></td>
              </tr>
              <tr class="danger">
                <td>1040-100.00-8005</td>
                <td>Benang Cotton 99% White</td>
                <td>0</td>
                <td>Yard</td>
                <td><span class="label label-danger">Habis</span></td>
                <td><a href="javascript:void(0);" class="btn btn-default btn-xs disabled"><i class="fa fa-pencil"></i></a>&nbsp;<a href="javascript:void(0);" onclick="verifikasi('0001')" class="btn btn-warning btn-xs"><i class="fa fa-check-square-o"></i></a></td>
              </tr>
              <tr class="danger">
                <td>1040-100.00-8005</td>
                <td>Benang Cotton 99% White</td>
                <td>0</td>
                <td>Yard</td>
                <td><span class="label label-danger">Habis</span></td>
                <td><a href="javascript:void(0);" class="btn btn-default btn-xs disabled"><i class="fa fa-pencil"></i></a>&nbsp;<a href="javascript:void(0);" onclick="verifikasi('0001')" class="btn btn-warning btn-xs"><i class="fa fa-check-square-o"></i></a></td>
              </tr>
              <tr class="danger">
                <td>1040-100.00-8005</td>
                <td>Benang Cotton 99% White</td>
                <td>0</td>
                <td>Yard</td>
                <td><span class="label label-danger">Habis</span></td>
                <td><a href="javascript:void(0);" class="btn btn-default btn-xs disabled"><i class="fa fa-pencil"></i></a>&nbsp;<a href="javascript:void(0);" onclick="verifikasi('0001')" class="btn btn-warning btn-xs"><i class="fa fa-check-square-o"></i></a></td>
              </tr>
              <tr class="info">
                <td>1040-100.00-8005</td>
                <td>Benang Cotton 100% White</td>
                <td>1000</td>
                <td>Rolls</td>
                <td><span class="label label-primary">Ready</span></td>
                <td><a href="javascript:void(0);" class="btn btn-default btn-xs disabled"><i class="fa fa-pencil"></i></a>&nbsp;<a href="javascript:void(0);" onclick="verifikasi('0001')" class="btn btn-warning btn-xs"><i class="fa fa-check-square-o"></i></a></td>
              </tr>
              <tr class="info">
                <td>1040-100.00-8005</td>
                <td>Benang Cotton 100% White</td>
                <td>1000</td>
                <td>Rolls</td>
                <td><span class="label label-primary">Ready</span></td>
                <td><a href="javascript:void(0);" class="btn btn-default btn-xs disabled"><i class="fa fa-pencil"></i></a>&nbsp;<a href="javascript:void(0);" onclick="verifikasi('0001')" class="btn btn-warning btn-xs"><i class="fa fa-check-square-o"></i></a></td>
              </tr>
              <tr class="info">
                <td>1040-100.00-8005</td>
                <td>Benang Cotton 100% White</td>
                <td>1000</td>
                <td>Rolls</td>
                <td><span class="label label-primary">Ready</span></td>
                <td><a href="javascript:void(0);" class="btn btn-default btn-xs disabled"><i class="fa fa-pencil"></i></a>&nbsp;<a href="javascript:void(0);" onclick="verifikasi('0001')" class="btn btn-warning btn-xs"><i class="fa fa-check-square-o"></i></a></td>
              </tr>

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

@endsection

@section('script')
<script>
  setTimeout(function () {
    $('.msg').hide();
  }, 3000);

var status_now = {
c:'CUTTING',co:'CUTTING ON PROSES',cc:'CUTTING CLOSE',
p:'PRINTING',po:'PRINTING ON PROSES',pc:'PRINTING CLOSE',
e:'EMBRO',eo:'EMBRO ON PROSES',ec:'EMBRO CLOSE',
s:'SEWING',so:'SEWING ON PROSES',sc:'SEWING CLOSE',
w:'WASHING',wo:'WASHING ON PROSES',wc:'WASHING CLOSE',
l:'LAIN2',lo:'LAIN2 ON PROSES',lc:'LAIN2 CLOSE',
f:'FINISHING',fo:'FINISHING ON PROSES',fc:'FINISHING CLOSE',
 };

$('#so_id_utama').select2({
  ajax: {
    url: baseurl+'/get_so',
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
    }
  }
});

$('#proses_id_utama').select2({
  ajax: {
    url: baseurl+'/get_proses',
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
    }
  }
});

$('#cmt_id_utama').select2({
  ajax: {
    url: baseurl+'/get_cmt',
    delay:250,
    data: function (params) {
      var p = $('#proses_id_utama :selected').text();
      var query = {
        search: params.term,
        type: 'public',
        proses:p,
      }
      return query;
    },
    processResults: function (data) {
      return {
        results: data
      };
    }
  }
});

$('#so_id_utama').on('change', function () {
  select2send($(this).val());
});

$('#proses_id_utama').on('change', function () {
  $('[name=proses_now]').val('');
  $('[name=proses_now]').val($(this).text().toLowerCase());
});

$('#cmt_id_utama').on('change', function () {
  $('#btnSave').removeClass('disabled');
});

function select2send(data) {
  console.log('data = '+data);
  var append = '';
  ajax('POST','/get_so_art',{id:data}).done(function (r) {
    $('[name=nama_produk]').val(r[0].nama_produk);
    for (var i = 0; i < r.length; i++) {
      append += '<tr name="art_id_parent">\n\
        <td><span name="art_id">'+r[i].art_id+'</span></td>\n\
        <td><input type="number" class="col-sm-3" name="qty" value="'+r[i].qty+'"></td>\n\
        <td><input type="text" class="col-sm-6" name="ket"></td>\n\
      </tr>';
    }
    $('#table_art').html('');
    $('#table_art').append(append);
    var c = ['cutting','printing','embro','sewing','washing','lain2','finishing'];
    var c0 = ['c','p','e','s','w','l','f'];
    var c1 = [r[0].proses_cutting,r[0].proses_printing,r[0].proses_embro,r[0].proses_sewing,r[0].proses_washing,r[0].proses_lain2,r[0].proses_finishing];
    var c2 = [r[0].status_cutting,r[0].status_printing,r[0].status_embro,r[0].status_sewing,r[0].status_washing,r[0].status_lain2,r[0].status_finishing];

  });
}

function simpanData() {
  var id = $('[name=id]').val();
  var tgl = $('[name=tanggal]').val();
  var so_id = $('#so_id_utama :selected').val();
  var cmt_id = $('#cmt_id_utama :selected').val();

   var data_art = [];
   var jumlah_qty = 0;
  var art_id = $('tr[name=art_id_parent]').each(function (r) {
    data_art.push({
      art_id:$(this).children('td').children('[name=art_id]').text(),
      qty:$(this).children('td').children('[name=qty]').val(),
      ket:$(this).children('td').children('[name=ket]').val(),
    });
    jumlah_qty = jumlah_qty + ($(this).children('td').children('[name=qty]').val())*1;
  });

  var data = {
    id:id,
    tgl:tgl,
    so_id:so_id,
    cmt_id:cmt_id,
    qty:jumlah_qty,
    status:$('#proses_id_utama :selected').text().substr(0,1).toLowerCase(),
  }

  swal({
      title: 'Apa yakin?',
      text: "Pastikan data diisi dengan benar!",
      type: 'warning',
      showCancelButton: true,
      confirmButtonColor: '#3085d6',
      cancelButtonColor: '#d33',
      confirmButtonText: 'Ya, Simpan Data Ini!'
      }).then((result) => {
        if (result.value) {
          ajax('POST','/send_skb_keluar',{data:data,data_art:data_art})
          .done(function (r) {
            if (r[0] == '1') {
              swal({
                title:'Sukses',
                text:'SKK Berhasil Disimpan',
                timer:'1500',
                showConfirmButton:false,
                type:'success'
              });
            } else {
              swal({
                title:'Gagal',
                text:'SKK Gagal Disimpan',
                type:'error',
                timer:1500,
                confirmButtonText:false,
              });
            }
            setTimeout(function () {
              window.location.reload();
            }, 1500);
          });
        }

      });

}

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
        sendAjax('/del_bahan_baku','POST',{id:id});
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
