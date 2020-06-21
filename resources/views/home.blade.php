@extends('layouts.app')

@section('content')

@php
  $r = Auth::user()->role
@endphp

<!-- MAIN PANEL -->
<div id="main" class="utama_panel"role="main">

  <!-- RIBBON -->
  <div id="ribbon">

    <span class="ribbon-button-alignment">
      <span id="refresh" class="btn btn-ribbon" data-action="resetWidgets" data-title="refresh"  rel="tooltip" data-placement="bottom" data-original-title="<i class='text-warning fa fa-warning'></i> Warning! This will reset all your widget settings." data-html="true">
        <i class="fa fa-refresh"></i>
      </span>
    </span>

    <!-- breadcrumb -->
    <ol class="breadcrumb">
      <li>Hi, {{ Auth::user()->name }}, Semoga pekerjaan Anda diberkahi Allah ^_^</li>
    </ol>
    <!-- end breadcrumb -->

  </div>
  <!-- END RIBBON -->

<!-- MAIN CONTENT -->
<div id="content">

@if($r == '1')


  <div class="row">
    <div class="col-xs-12 col-sm-7 col-md-7 col-lg-4">
      <h1 class="page-title txt-color-blueDark"><i class="fa fa-desktop fa-fw "></i>
        Dashboard
      </h1>
    </div>
    <div class="col-xs-12 col-sm-5 col-md-5 col-lg-8">
      <ul id="sparks" class="">
				
			</ul>
    </div>
  </div>
  <!-- widget grid -->

  <!-- end widget grid -->
  <!-- <section id="widget-grid" class="">
    <div class="row">
      <article class="col-sm-12 col-md-12 col-lg-12">
        <div class="jarviswidget jarviswidget-color-darken" id="wid-id-0" data-widget-colorbutton="false" data-widget-editbutton="false">
          <header>
            <span class="widget-icon"> <i class="fa fa-send"></i> </span>
            <h2>Penjualan</h2>
          </header>
          <div>
            <div class="widget-body">
              <div class="col-sm-12 well" style="margin-bottom: 50px !important;">
                <div class="col-sm-12">
                  <div class="highchart-container"></div>
                  <div class="highchart-container1"></div>
                  <div class="highchart-container2"></div>
                  <div class="highchart-container3"></div>
                </div>
                <div class="col-sm-12" style="display:none;">
                  <table class="highchart table table-hover table-bordered" data-graph-container=".. .. .highchart-container1" data-graph-type="line">
                    <caption>Penjualan Bulanan</caption>
                    <thead>
                      <tr>
                        <th width="30%">Bulan</th>
                        <th width="70%">Amount (Dalam Rupiah)</th>
                      </tr>
                    </thead>
                    <tbody id="table_report">
                      @foreach($report_income as $i=>$a)
                      <tr>
                        <td>{{ $month[$i] }}</td>
                        <td>{{ $a }}</td>
                      </tr>
                      @endforeach
                    </tbody>
                  </table>
                </div>
                
                </div>
              </div>
            </div>
          </div>
        </div>
      </article>
    </div>
  </section> -->

@endif  


</div>
<!-- END MAIN CONTENT -->

</div>
<!-- END MAIN PANEL -->
@endsection

@section('script')
<script type="text/javascript">

$(document).ready(function() {
  $('table.highchart').highchartTable();
});

</script>
@endsection
