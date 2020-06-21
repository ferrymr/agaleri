@extends('layouts.app')

@section('content')
<div id="main" class="utama_panel"role="main">
<div id="content">
  <div class="row">
    <div class="col-xs-12 col-sm-7 col-md-7 col-lg-4">
      <h1 class="page-title txt-color-blueDark"><i class="fa fa-desktop fa-fw "></i>
        List History Produksi by SPK
      </h1>
    </div>
  </div>
  <div class="jarviswidget jarviswidget-color-orange" id="wid-id-3" data-widget-editbutton="false">
    <header>
      <span class="widget-icon"> <i class="fa fa-table"></i> </span>
      <h2>List Data</h2>
    </header>
    <div>
      <div class="widget-body no-padding" style="overflow-x:auto;">
        <table id="datatable_tabletools" class="table table-striped table-bordered table-hover" width="100%">
          <thead>
            <tr>
              <th rowspan="2">No SO</th>
              <th rowspan="2">No Art</th>
              <th rowspan="2">Nama Barang</th>
              <th rowspan="2">Qty</th>
              <th colspan="9">Printing</th>
              <th colspan="9">Embro</th>
              <th colspan="9">Sewing</th>
              <th colspan="9">Washing</th>
              <th colspan="9">Lain</th>
              <th colspan="9">Finishing</th>
            </tr>
            <tr>
                <th>Out</th>
                <th>In</th>
                <th>Inv CMT</th>
                <th>Cacat</th>
                <th>Out Perbaikan</th>
                <th>In Perbaikan</th>
                <th>Sisa</th>
                <th>Status</th>
                <th>Detail</th>
                <th>Out</th>
                <th>In</th>
                <th>Inv CMT</th>
                <th>Cacat</th>
                <th>Out Perbaikan</th>
                <th>In Perbaikan</th>
                <th>Sisa</th>
                <th>Status</th>
                <th>Detail</th>
                <th>Out</th>
                <th>In</th>
                <th>Inv CMT</th>
                <th>Cacat</th>
                <th>Out Perbaikan</th>
                <th>In Perbaikan</th>
                <th>Sisa</th>
                <th>Status</th>
                <th>Detail</th>
                <th>Out</th>
                <th>In</th>
                <th>Inv CMT</th>
                <th>Cacat</th>
                <th>Out Perbaikan</th>
                <th>In Perbaikan</th>
                <th>Sisa</th>
                <th>Status</th>
                <th>Detail</th>
                <th>Out</th>
                <th>In</th>
                <th>Inv CMT</th>
                <th>Cacat</th>
                <th>Out Perbaikan</th>
                <th>In Perbaikan</th>
                <th>Sisa</th>
                <th>Status</th>
                <th>Detail</th>
                <th>Out</th>
                <th>In</th>
                <th>Inv CMT</th>
                <th>Cacat</th>
                <th>Out Perbaikan</th>
                <th>In Perbaikan</th>
                <th>Sisa</th>
                <th>Status</th>
                <th>Detail</th>
            </tr>
          </thead>
          <tbody>
            @foreach($data as $i)
            @php

            if($i->qty_out_cutting != null)
            $sc = ($i->qty_out_cutting-$i->qty_in_cutting <= 0 ) ? 'Close':'Proses';
            else
            $sc = 'Belum Proses';
    
            if($i->qty_out_printing != null)
            $sp = ($i->status_printing == 'C') ? 'Close':'Proses';
            else
            if($i->proses_printing == 'Y')
            $sp = 'Belum Proses';
            else
            $sp = '';

            if($i->qty_out_embro != null)
            $se = ($i->status_embro == 'C') ? 'Close':'Proses';
            else
            if($i->proses_embro == 'Y')
            $se = 'Belum Proses';
            else
            $se = '';

            if($i->qty_out_sewing != null)
            $ss = ($i->status_sewing == 'C') ? 'Close':'Proses';
            else
            if($i->proses_sewing == 'Y')
            $ss = 'Belum Proses';
            else
            $ss = '';

            if($i->qty_out_washing != null)
            $sw = ($i->status_washing == 'C') ? 'Close':'Proses';
            else
            if($i->proses_washing == 'Y')
            $sw = 'Belum Proses';
            else
            $sw = '';

            if($i->qty_out_lain2 != null)
            $sl = ($i->status_lain2 == 'C') ? 'Close':'Proses';
            else
            if($i->proses_lain2 == 'Y')
            $sl = 'Belum Proses';
            else
            $sl = '';

            if($i->qty_out_finishing != null)
            $sf = ($i->status_finishing == 'C') ? 'Close':'Proses';
            else
            if($i->proses_finishing == 'Y')
            $sf = 'Belum Proses';
            else
            $sf = '';

            if($sc == 'Close')
            $color_c = 'primary';
            elseif($sc == 'Proses')
            $color_c = 'warning';
            else $color_c = 'default';

            if($sp == 'Close')
            $color_p = 'primary';
            elseif($sp == 'Proses')
            $color_p = 'warning';
            else $color_p = 'default';

            if($se == 'Close')
            $color_e = 'primary';
            elseif($se == 'Proses')
            $color_e = 'warning';
            else $color_e = 'default';

            if($ss == 'Close')
            $color_s = 'primary';
            elseif($ss == 'Proses')
            $color_s = 'warning';
            else $color_s = 'default';

            if($sw == 'Close')
            $color_w = 'primary';
            elseif($sw == 'Proses')
            $color_w = 'warning';
            else $color_w = 'default';

            if($sl == 'Close')
            $color_l = 'primary';
            elseif($sl == 'Proses')
            $color_l = 'warning';
            else $color_l = 'default';

            if($sf == 'Close')
            $color_f = 'primary';
            elseif($sf == 'Proses')
            $color_f = 'warning';
            else $color_f = 'default';
            @endphp
            <tr>
              <td>{{ $i->so_id }}</td>
              <td>{{ $i->art_id }}</td>
              <td>{{ $i->name }}</td>
              <td>{{ $i->qty }}</td>
              <td>{{ $i->qty_out_printing }}</td>
              <td>{{ $i->qty_in_printing }}</td>
              <td>{{ $i->inv_cmt_printing }}</td>
              <td>{{ $i->cacat_bahan_printing }}</td>
              <td>{{ $i->out_perbaikan_printing }}</td>
              <td>{{ $i->in_perbaikan_printing }}</td>
              <td>{{ $i->sisa_printing }}</td>
              <td><span class="label label-{{$color_c}}">{{$sp}}</span></td>
              <td><a href="javascript:void(0);" onclick="showDetail('{{ $i->so_id }}','{{ $i->art_id }}','PR003')" class="">@if($sp != '' )<i class="glyphicon glyphicon-eye-open"></i>@endif</a></td>
              <td>{{$i->qty_out_embro}}</td>
              <td>{{$i->qty_in_embro}}</td>
              <td>{{ $i->inv_cmt_embro }}</td>
              <td>{{ $i->cacat_bahan_embro }}</td>
              <td>{{ $i->out_perbaikan_embro }}</td>
              <td>{{ $i->in_perbaikan_embro }}</td>
              <td>{{ $i->sisa_embro }}</td>
              <td><span class="label label-{{$color_c}}">{{$se}}</span></td>
              <td><a href="javascript:void(0);" onclick="showDetail('{{ $i->so_id }}','{{ $i->art_id }}','PR004')"  class="">@if($se != '')<i class="glyphicon glyphicon-eye-open"></i>@endif</a></td>
              <td>{{$i->qty_out_sewing}}</td>
              <td>{{$i->qty_in_sewing}}</td>
              <td>{{ $i->inv_cmt_sewing }}</td>
              <td>{{ $i->cacat_bahan_sewing }}</td>
              <td>{{ $i->out_perbaikan_sewing }}</td>
              <td>{{ $i->in_perbaikan_sewing }}</td>
              <td>{{ $i->sisa_sewing }}</td>
              <td><span class="label label-{{$color_c}}">{{$ss}}</span></td>
              <td><a href="javascript:void(0);" onclick="showDetail('{{ $i->so_id }}','{{ $i->art_id }}','PR005')"  class="">@if($ss != '')<i class="glyphicon glyphicon-eye-open"></i>@endif</a></td>
              <td>{{$i->qty_out_washing}}</td>
              <td>{{$i->qty_in_washing}}</td>
              <td>{{ $i->inv_cmt_washing }}</td>
              <td>{{ $i->cacat_bahan_washing }}</td>
              <td>{{ $i->out_perbaikan_washing }}</td>
              <td>{{ $i->in_perbaikan_washing }}</td>
              <td>{{ $i->sisa_washing }}</td>
              <td><span class="label label-{{$color_c}}">{{$sw}}</span></td>
              <td><a href="javascript:void(0);" onclick="showDetail('{{ $i->so_id }}','{{ $i->art_id }}','PR006')"  class="">@if($sw != '')<i class="glyphicon glyphicon-eye-open"></i>@endif</a></td>
              <td>{{$i->qty_out_lain2}}</td>
              <td>{{$i->qty_in_lain2}}</td>
              <td>{{ $i->inv_cmt_lain2 }}</td>
              <td>{{ $i->cacat_bahan_lain2 }}</td>
              <td>{{ $i->out_perbaikan_lain2 }}</td>
              <td>{{ $i->in_perbaikan_lain2 }}</td>
              <td>{{ $i->sisa_lain2 }}</td>
              <td><span class="label label-{{$color_c}}">{{$sl}}</span></td>
              <td><a href="javascript:void(0);" onclick="showDetail('{{ $i->so_id }}','{{ $i->art_id }}','PR007')"  class="">@if($sl != '')<i class="glyphicon glyphicon-eye-open"></i>@endif</a></td>
              <td>{{$i->qty_out_finishing}}</td>
              <td>{{$i->qty_in_finishing}}</td>
              <td>{{ $i->inv_cmt_finishing }}</td>
              <td>{{ $i->cacat_bahan_finishing }}</td>
              <td>{{ $i->out_perbaikan_finishing }}</td>
              <td>{{ $i->in_perbaikan_finishing }}</td>
              <td>{{ $i->sisa_finishing }}</td>
              <td><span class="label label-{{$color_c}}">{{$sf}}</span></td>
              <td><a href="javascript:void(0);" onclick="showDetail('{{ $i->so_id }}','{{ $i->art_id }}','PR008')"  class="">@if($sf != '')<i class="glyphicon glyphicon-eye-open"></i>@endif</a></td>
            </tr>
            @endforeach
          </tbody>
        </table>
      </div>
    </div>
  </div>
</div>
</div>
<div class="modal" id="modalDetail" tabindex="1" role="dialog" aria-hidden="true" data-backdrop="static">
  <div class="modal-dialog modal-lg">
    <div class="modal-content">
      <form id="formDetail" method="post" class="form-horizontal" data-toggle="validator" enctype="multipart/form-data">
        {{ csrf_field() }} {{ method_field('POST') }}
        <div class="modal-header" style="background-color:#2C3742;color:white;">
          <button type="button" class="close" data-dismiss="modal" aria-label="Close">
            <span aria-hidden="true"> &times; </span>
          </button>
          <h3 class="modal-title">Detail</h3>
        </div>
        <div class="modal-body">
          <div class="form-group">
            <label for="cmt_name" class="col-md-1 control-label">CMT :</label>
            <div class="col-md-4">
              <input type="text" id="cmt_name" name="cmt_name" class="form-control" readonly>
            </div>
            <label for="price" class="col-md-2 control-label">Price :</label>
            <div class="col-md-4">
              <input type="text" id="price" name="price" class="form-control" readonly>
            </div>
          </div>
        </div>
        <div class="modal-footer">
          <button type="button" class="btn btn-default" data-dismiss="modal"><i class="fa fa-refresh"></i> Close</button>
        </div>
      </form>
    </div>
  </div>
</div>
@endsection

@section('script')
<script>
  function showDetail(so_id,art_id,proses_id){
    $('[name=cmt_name],[name=price').val('');
    $('#modalDetail').modal('show');
    var data = {
      so_id:so_id,
      art_id:art_id,
      proses_id:proses_id,
    };
    var url = "{{ route('history_detail.get') }}";
    $.ajax({
      url : url,
      type : "POST",
      data : data,
      success : function(data) {
        $('[name=cmt_name]').val(data.cmt_name);
        $('[name=price').val(data.price);
      },
      error : function(data){
        myswal('e',data.message,'e',1500);
      }
    });
    return false;
  };

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
