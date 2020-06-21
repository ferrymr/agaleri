@extends('layouts.app')

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
              <span class="widget-icon"> <i class="fa fa-cubes"></i> </span>
              <h2>{{ $title }}</h2>
              <span class="jarviswidget-loader"><i class="fa fa-refresh fa-spin"></i></span></header>
              <div role="content">
                <div class="widget-body">
                  <div role="content">
                    <div class="widget-body">
                      <form id="formAdd" class="form-horizontal" method="post" data-toggle="validator" enctype="multipart/form-data">
                        {{ csrf_field() }} {{ method_field('POST') }}
                        <input type="hidden" name="param" value="{{$tag}}">
                        <div class="form-group">
                          <label for="" class="col-md-1 control-label">No. SO</label>
                          <div class="col-md-2">
                            <select style="width:100%" name="so_id" class="form-control"></select>
                          </div>
                        </div>
                        <div class="form-group">
                          <label for="" class="col-md-1 control-label">No. Artikel</label>
                          <div class="col-md-2">
                            <select style="width:100%" name="art_id" class="form-control"></select>
                          </div>
                        </div>
                        <!-- <div class="form-group">
                          <label class="col-md-2 control-label">Status Bahan Baku</label>
                          <div class="col-md-4">
                            <label class="radio radio-inline">
                              <input type="radio" class="radiobox" name="status" value="A" checked="">
                              <span>Ready</span>
                            </label>
                            <label class="radio radio-inline">
                              <input type="radio" class="radiobox" name="status" value="B">
                              <span>Hampir Habis</span>
                            </label>
                            <label class="radio radio-inline">
                              <input type="radio" class="radiobox" name="status" value="C">
                              <span>Habis</span>
                            </label>
                          </div>
                        </div> -->
                        <div class="form-actions">
                          <div class="row">
                            <div class="col-md-12">
                              <!-- <button type="button" class="btn btn-primary" id="btnPrint">
                                <i class="fa fa-print"></i>
                                Print
                              </button> -->
                              <button class="btn btn-warning" id="btnReset" type="button" onclick="resetForm()">
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

      <div class="jarviswidget jarviswidget-color-orange" id="wid-id-2" data-widget-editbutton="false">
        <header>
          <span class="widget-icon"> <i class="fa fa-table"></i> </span>
          <h2>List Data</h2>
        </header>
        <div>
          <div class="widget-body">
            <table id="{{$tag}}-table" class="table table-striped table-bordered table-hover" width="100%">
              <thead>
                <tr>
                  <th>No. {{ $title }}</th>
                  <th>Nama Barang</th>
                  <th>Customer</th>
                  <th>Produksi</th>
                  <th>Hasil Cutt.</th>
                  <th>SO</th>  
                  <th>WH</th>     
                  <th>INV. CMT</th>     
                  <th>Cacat Bahan</th>     
                  <th>WIP</th>     
                  <th>Validasi</th>     
                </tr>
              </thead>
              <tbody>
              </tbody>
            </table>
          </div>
        </div>
      </div>

    </div>
  </div>
@endsection

@section('script')
<script>
var tag   = '{{$tag}}';

  var table = $('#'+tag+'-table').DataTable({
    lengthMenu: [[20, 50, 100, -1], [20, 50, 100, "All"]],
    processing: true,
    serverSide: true,
    ajax: {
      url: "{{ route('history_art.api') }}",
      data: function (d) {
        d.so_id = $('[name=so_id]').val(),
        d.art_id = $('[name=art_id]').val();
      }
    },
    columns: [
      {data: 'art_id', name: 'art_id'},
      {data: 'name', name: 'name'},
      {data: 'nama_costumer', name: 'nama_costumer'},
      {data: 'bulan_id', name: 'bulan_id'},
      {data: 'qty', name: 'qty'},
      {data: 'qty_so', name: 'qty_so'},
      {data: 'qty_bj', name: 'qty_bj'},
      {data: 'inv_cmt', name: 'inv_cmt'},
      {data: 'cacat_bahan', name: 'cacat_bahan'},
      {data: 'wip', name: 'wip'},
      {data: 'validasi', name: 'validasi'},
    ]
  });

  $('[name=so_id]').select2({
    ajax: {
      url: baseurl+'/get_so_id_history',
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

  $('[name=art_id]').select2({
    ajax: {
      url: baseurl+'/get_art_id_history',
      delay:250,
      data: function (params) {
        var query = {
          search: params.term,
          so_id: $('[name=so_id]').val(),
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

  $('[name=art_id]').on('change',function(){
    table.ajax.reload();
  });

  $('[name=so_id]').on('change',function(){
    $("[name=art_id]").select2("val", "");
  });

  //Fungsi Reset Data form
  function resetForm(e) {
    $("[name=so_id],[name=art_id]").select2("val", "");
  }

  </script>
@endsection
