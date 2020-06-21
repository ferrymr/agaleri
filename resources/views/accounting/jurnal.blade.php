@extends('layouts.app')

@section('style')
<style>
  #content{
    margin-bottom: 100px;
  }
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
            <h2>Tambah {{ $title }}</h2>
          </header>
          <div>
            <div class="widget-body">
              <form id="formAdd" name="formAdd" method="post" class="form-horizontal" data-toggle="validator" enctype="multipart/form-data">
                {{ csrf_field() }} {{ method_field('POST') }}
                <fieldset>
                  <div class="form-group">
                    <label class="col-md-1 control-label">Kode Jurnal </label>
                    <div class="col-md-2">
                      <input class="form-control" id="id" name="id" placeholder="Auto" type="text" value="" readonly>
                      <input class="form-control" id="type_jurnal" name="type_jurnal" type="hidden" value="{{Request::path()}}">
                    </div>
                  </div>
                  <div class="form-group">
                    <label class="col-md-1 control-label">Tanggal </label>
                    <div class="col-md-2">
                      <div class="input-group">
                        <input type="text" id="tanggal" name="tanggal" placeholder="Select a date" class="form-control datepicker" data-dateformat="dd/mm/yy" value="{{ $tanggal }}">
                        <span class="input-group-addon"><i class="fa fa-calendar"></i></span>
                      </div>
                    </div>
                  </div>
                  <div class="form-group">
                    <label class="col-md-1 control-label">No Ref </label>
                    <div class="col-md-2">
                      <input class="form-control" id="no_ref" name="no_ref" placeholder="No Ref" type="text" value="">
                    </div>
                  </div>
                </fieldset><br><br>
                <fieldset>
                  <legend>Details {{ $title }}</legend>
                  <div class="form-group">
                    <div class="col-md-4">
                      <label class="control-label">Deskripsi</label>
                    </div>
                    <div class="col-md-3">
                      <label class="control-label">Akun</label>
                    </div>
                    <div class="col-md-2">
                      <label class="control-label">Debit</label>
                    </div>
                    <div class="col-md-2">
                      <label class="control-label">Kredit</label>
                    </div>
                    <div class="col-md-1">
                      <label class="control-label">-</label>
                    </div>
                  </div>
                  <div id="detail">
                    <div class="detailLine form-group">
                      <div class="itemLine col-md-4">
                        <input class="form-control" name="deskripsi[]" placeholder="Deskripsi" type="text" required="">
                      </div>
                      <div class="itemLine col-md-3">
                          <select style="width:100%" id="id_akun[]" name="id_akun[]" class="form-control" required=""></select>
                      </div>
                      <div class="itemLine col-md-2">
                        <input class="form-control decimal calc" value="0" name="debit[]" style="text-align:right;" placeholder="0" type="text">
                      </div>
                      <div class="itemLine col-md-2">
                        <input class="form-control decimal calc" value="0" name="kredit[]" style="text-align:right;" placeholder="0" type="text">
                      </div>
                      <div class="itemLine col-md-1">
                        <input type="hidden" name="indexRow[]" value="0">
                        <button type="button" name="btnRemoveLine[]" class="btn-remove-line btn btn-default btn-circle"><i class="glyphicon glyphicon-minus"></i></button>
                      </div>
                    </div>
                    <div class="detailLine form-group">
                      <div class="itemLine col-md-4">
                        <input class="form-control" name="deskripsi[]" placeholder="Deskripsi" type="text" required="">
                      </div>
                      <div class="itemLine col-md-3">
                          <select style="width:100%" id="id_akun[]" name="id_akun[]" class="form-control" required=""></select>
                      </div>
                      <div class="itemLine col-md-2">
                        <input class="form-control decimal calc" value="0" name="debit[]" style="text-align:right;" placeholder="0" type="text">
                      </div>
                      <div class="itemLine col-md-2">
                        <input class="form-control decimal calc" value="0" name="kredit[]" style="text-align:right;" placeholder="0" type="text">
                      </div>
                      <div class="itemLine col-md-1">
                        <input type="hidden" name="indexRow[]" value="0">
                        <button type="button" name="btnRemoveLine[]" class="btn-remove-line btn btn-default btn-circle"><i class="glyphicon glyphicon-minus"></i></button>
                      </div>
                    </div>
                  </div>
                  <div class="form-group">
                    <div class="col-md-1">
                      <button id="btnAddLine" class="btn btn-primary btn-circle"><i class="glyphicon glyphicon-plus"></i></button>
                    </div>
                    <div class="col-md-2 col-md-offset-6">
                      <div class="control-label ">
                        <strong>Total Debit</strong>
                      </div>
                      <div class="control-label" id="total_debit">
                        Rp. 0.00
                      </div>
                    </div>
                    <div class="col-md-2">
                      <div class="control-label ">
                        <strong>Total Kredit</strong>
                      </div>
                      <div class="control-label" id="total_kredit">
                        Rp. 0.00
                      </div>
                    </div>
                  </div>
                  <div class="form-group">
                    <div class="col-md-2">
                      <label for="memo">Memo</label>
                      <textarea name="memo" rows="5" cols="50"></textarea>
                    </div>
                  </div>
                </fieldset>
                <div class="form-actions">
                  <div class="row">
                    <div class="col-md-12">
                      <button id="btnAdd" type="submit" class="btn btn-primary">
                        <i class="fa fa-send"></i>
                        Buat Jurnal
                      </button>
                      <a id="btnResetAdd" class="btn btn-default">
                        <i class="fa fa-refresh"></i>
                        Batal
                      </a>
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
var tag   = '{{$tag}}';

function removeRowClick() {
  $('[name="btnRemoveLine[]"]').on('click',function (e) {
    var index = $(this);
    var detail = index.parents('.detailLine').index();
    if (detail == 0) {
      myswal('w','Row 1 Tidak Dapat Dihapus!','w',1500);
      return true;
    }
    if (detail == 1) {
      myswal('w','Row 2 Tidak Dapat Dihapus!','w',1500);
      return true;
    }
    removeRow(detail);
    e.preventDefault();
  });
}
 
$(function () {
  removeRowClick();
  var detailLine = $('#detail .detailLine').eq(1).html();
    
  $('#btnAddLine').on('click',function (e) {
    $('#detail .detailLine').last().after('<div class="detailLine form-group">'+detailLine+'</div>');
    $('[name="id_akun[]"]:last').next(".select2-container").hide();
    $('[name="btnRemoveLine[]"]').unbind('click');
    runselect2();
    select2Run();
    removeRowClick();
    e.preventDefault();
  });


  $('#detail').on('blur','.calc',function() {
    var self    = $(this);
    var debit   = self.parents('.detailLine').find('.calc[name="debit[]"]');
    var kredit  = self.parents('.detailLine').find('.calc[name="kredit[]"]');
    var total   = decimal(parseFloat(ribuantodb(debit.val())*ribuantodb(kredit.val())));
    hitungTotal();
    if( ribuantodb(total) != 0) {
      $('[name="id_akun[]"]:last').next(".select2-container").hide();
    }
    runselect2();
    select2Run();
    runRibuan();
    runDecimal();
  }
);

$('#btnResetAdd').on('click', function (e) {
  resetForm();
});

$('#formAdd').validator().on('submit', function (e) { 
  $('input[name=_method]').val('POST');
  if (!e.isDefaultPrevented()){
    var id = $('#id').val();
    url = "{{ url('jurnal') }}";

    $.ajax({
      url : url,
      type : "POST",
      data : $('#formAdd').serialize(),
      success : function(data) {
        // table.ajax.reload();
        if (data.status == true) {
          myswal('s',data.message,'s',1500);
          resetForm();
        } else {
          myswal('e',data.message,'e',1500);
          resetForm();
        }
      },
      error : function(data){
        myswal('e',data.message,'e',1500);
      }
    });
    return false;
  }
});

runselect2();
select2Run();
});

//Fungsi Select 2 Local
function select2Run() {
  $('[name="id_akun[]"]').select2({
    ajax: {
      url: baseurl+'/get_akun',
      delay:250,
      data: function (params) {
        var query = {
          search: params.term,
          type: 'public',
          category: 'all',
          level: '4',
        }
        return query;
      },
      processResults: function (data) {
        return {
          results: data
        };
      },
    }
  });
}

//Fungsi Reset Data form
function resetForm() {
  $('#formAdd')[0].reset();
  $('.select2').val('').change();
  $('.detailLine').not(':eq(0),:eq(1)').remove();
  $('[name="id_akun[]"]').val('').trigger('change');
  $('#total_debit').text('Rp. 0,00');
  $('#total_kredit').text('Rp. 0,00');
}

//Fungsi Hitung Total All
function hitungTotal() {
  var total_debit = 0;
  var total_kredit = 0;
  $('[name="debit[]"]').each(function() {
    var val = $(this).val();
    total_debit = parseFloat(total_debit) + parseFloat(ribuantodb(val));
  });
  $('[name="kredit[]"]').each(function() {
    var val = $(this).val();
    total_kredit = parseFloat(total_kredit) + parseFloat(ribuantodb(val));
  });
  var num1   = decimal(total_debit);
  var num2   = decimal(total_kredit);
  $('#total_debit').text('Rp. '+num1);
  $('#total_kredit').text('Rp. '+num2);
  if (num1 == num2) {
    $('#btnAdd').prop('disabled',false);
  } else {
    $('#btnAdd').prop('disabled',true);
  }
}

function removeRow(index) {
  $('.detailLine').eq(index).remove();
}

</script>
@endsection
