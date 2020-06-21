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
        <div class="jarviswidget jarviswidget-color-orange" id="wid-id-3" data-widget-editbutton="false">
          <header>
            <span class="widget-icon"> <i class="fa fa-table"></i> </span>
            <h2>List Data {{ $title }}</h2>
          </header>
          <div>
            <div class="widget-body">
              <table id="{{$tag}}-table" class="table table-striped table-bordered table-hover" width="100%">
                <thead>
                  <tr>
                    <th data-hide="phone">Kode</th>
                    <th data-class="expand">Nama Costumer</th>
                    <th>Qty Total</th>
                    <th>Grand Total</th>
                    <th data-hide="phone">Action</th>
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
@include('invoice.view.modalGeneralView');
@endsection

@section('script')
<script>
var token = $('meta[name="csrf-token"]').attr('content');
var tag   = '{{$tag}}';
var table = $('#'+tag+'-table').DataTable({
  processing: true,
  serverSide: true,
  order: [0,'desc'],
  ajax: "{{ route('invoice.api') }}",
  columns: [
    {data: 'id', name: 'id'},
    {data: 'nama_costumer', name: 'nama_costumer'},
    {data: 'total_qty', name: 'total_qty'},
    {data: 'grand_total', name: 'grand_total'},
    {data: 'action', name: 'action', orderable: false, searchable: false}
  ]
});


$(function () {
});

//Fungsi View Data
function printData(id) {
  window.open(baseurl+'/invoice/'+id+'/print');
}


</script>
@endsection
