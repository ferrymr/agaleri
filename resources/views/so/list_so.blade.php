@extends('layouts.app')

@section('content')
<div id="main" class="utama_panel"role="main">
  <div id="content">
    <div class="row">
      <div class="col-xs-12 col-sm-7 col-md-7 col-lg-4">
        <h1 class="page-title txt-color-blueDark"><i class="fa fa-desktop fa-fw "></i>
          List {{ $title }}
        </h1>
      </div>
    </div>
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
                <th data-hide="phone">ID SO</th>
                <th data-class="expand">Kode Produksi</th>
                <th data-class="expand">BJ ID</th>
                <th data-class="expand">Nama Barang</th>
                <th data-class="expand">Qty</th>
                <th data-class="expand">Artikel</th>
                <th data-class="expand">Dikerjakan</th>
                <th data-class="expand">Status</th>
                <th data-hide="phone">Action</th>
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

<!-- Modal -->
<div class="modal fade" id="modalProses" tabindex="-1" role="dialog" aria-labelledby="modalEditLabel" aria-hidden="true">
  <div class="modal-dialog modal-lg">
    <div class="modal-content">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal" aria-hidden="true">
          &times;
        </button>
        <h4 class="modal-title" id="modalEditLabel">Pilih Proses</h4>
      </div>
      <div class="modal-body">
        <div class="row">
          <div class="form-group">
            <div class="col-md-12">
              <label class="checkbox-inline">
                <input type="checkbox" name="p_printing" class="checkbox cbp style-0" checked="" value="P">
                <span>Printing</span>
              </label>
              <label class="checkbox-inline">
                <input type="checkbox" name="p_embro" class="checkbox cbp style-0" checked="" value="E">
                <span>Embro</span>
              </label>
              <label class="checkbox-inline">
                <input type="checkbox" name="p_sewing" class="checkbox cbp style-0" checked="" value="S">
                <span>Sewing</span>
              </label>
              <label class="checkbox-inline">
                <input type="checkbox" name="p_washing" class="checkbox cbp style-0" checked="" value="W">
                <span>Washing</span>
              </label>
              <label class="checkbox-inline">
                <input type="checkbox" name="p_lain2" class="checkbox cbp style-0" checked="" value="L">
                <span>Lain - lain</span>
              </label>
              <label class="checkbox-inline">
                <input type="checkbox" name="p_finishing" class="checkbox cbp style-0" checked="" value="F">
                <span>Finishing</span>
              </label>
            </div>
          </div>
        </div><br><br><br>
        <div class="row">
          <div class="col-md-12">
            <input type="hidden" name="so_id_post" value="" readonly>
            <button class="btn btn-primary" name="btnPostingProses">
              <i class="fa fa-send"></i>
              Posting
            </button>
            <button type="button" class="btn btn-default" data-dismiss="modal">
              Batal
            </button>
          </div>
        </div>
      </div>
    </div><!-- /.modal-content -->
  </div><!-- /.modal-dialog -->
</div><!-- /.modal -->

@endsection

@section('script')
<script>
var tag   = '{{$tag}}';
var table = $('#'+tag+'-table').DataTable({
  processing: true,
  serverSide: true,
  ajax: "{{ route('so.api') }}",
  columns: [
    {data: 'id', name: 'id'},
    {data: 'produksi_id', name: 'produksi_id'},
    {data: 'barang_jadi_id', name: 'barang_jadi_id'},
    {data: 'name', name: 'name'},
    {data: 'qty', name: 'qty'},
    {data: 'art', name: 'art'},
    {data: 'status', name: 'status'},
    {data: 'isactive', name: 'isactive'},
    {data: 'action', name: 'action', orderable: false, searchable: false}
  ]
});
var jml_art_post = 0;

$('[name=btnPostingProses]').on('click',function() {
  postProses();
});

function showProses(id) {
  $('[name=so_id_post]').val(id);
  $('.cbp').prop('checked',true);
}

//Fungsi View Data
function printData(id) {
  window.open(baseurl+'/so/'+id+'/print');
}

function postProses(){
  var id = $('[name=so_id_post]').val();
  var data = [];
  var alur_proses = '';
  $('.cbp').each(function (r) {
    if($(this).is(':checked')){
      data.push('Y');
      alur_proses = alur_proses+$(this).val();
    } else {
      data.push('N');
    }
  });
  var data = {so:id,data:data,alur_proses:alur_proses};
  $.ajax({
    type:'POST',
    url:baseurl+'/posting_proses',
    data:data,
    dataType:'json',
  }).done(function (res) {
    var r = res.data;
    if (res.data == 1) {
      myswal('s','Success','s',1500);
    }
    $('#modalProses').modal('toggle');
    $('[name=btnShowProcess'+id+']').addClass('disabled');
    table.ajax.reload();
  });
}

</script>
@endsection
