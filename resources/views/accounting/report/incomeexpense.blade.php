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
        Report {{ $title }}
      </h1>
    </div>
  </div>
  <section id="widget-grid" class="">
    <div class="row">
      <article class="col-sm-12 col-md-12 col-lg-12">
        <div class="jarviswidget jarviswidget-color-orange" id="wid-id-0" data-widget-colorbutton="false" data-widget-editbutton="false">
          <header>
            <span class="widget-icon"> <i class="fa fa-paste"></i> </span>
            <h2>{{ $title }}</h2>
          </header>
          <div>
            <div class="widget-body">
              <div class="col-sm-12 well" style="margin-bottom: 50px !important;">
                <div class="col-sm-12">
                  <div class="highchart-container"></div>
                </div>
                <div class="col-sm-12" style="display:none;">
                  <table class="highchart table table-hover table-bordered" data-graph-container=".. .. .highchart-container" data-graph-type="line">
                    <caption>{{ $title }} Resume</caption>
                    <thead>
                      <tr>
                        <th width="20%">Bulan</th>
                        <th width="25%">Amount (Dalam Rupiah)</th>
                        <th width="25%">Amount (Dalam Rupiah)</th>
                        <th width="30%">Profit (Dalam Rupiah)</th>
                      </tr>
                    </thead>
                    <tbody id="table_report">
                      @foreach($report_income as $i=>$a)
                      <tr>
                        <td>{{ $month[$i] }}</td>
                        <td>{{ $a }}</td>
                        <td>{{ $report_expense[$i] }}</td>
                        <td>{{ $a-$report_expense[$i] }}</td>
                      </tr>
                      @endforeach
                    </tbody>
                  </table>
                </div>
                <div class="col-sm-12">
                  <table class="table table-hover table-bordered" data-graph-container=".. .. .highchart-container" data-graph-type="line">
                    <caption>{{ $title }} Resume</caption>
                    <thead>
                      <tr>
                        <th width="20%">Bulan</th>
                        <th width="25%">Amount Income (Dalam Rupiah)</th>
                        <th width="25%">Amount Expense (Dalam Rupiah)</th>
                        <th width="30%">Profit</th>
                      </tr>
                    </thead>
                    <tbody id="table_report">
                      @foreach($report_income as $i=>$a)
                      <tr>
                        <td>{{ $month[$i] }}</td>
                        <td>Rp. {{ number_format($a,2) }},-</td>
                        <td>Rp. {{ number_format($report_expense[$i],2) }},-</td>
                        <td>Rp. {{ number_format($a-$report_expense[$i],2) }},-</td>
                      </tr>
                      @endforeach
                    </tbody>
                  </table>
                </div>
              </div>
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

$(document).ready(function() {
  $('table.highchart').highchartTable();
});

$(function(){

});

</script>
@endsection
