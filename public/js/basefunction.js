function sendajax(type,url,data) {
  return $.ajax({
    type:type,
    url:baseurl+url,
    data:data,
    dataType:'json',
  });
}

function calc_qty() {
  var total = 0;
  $('[name="qty[]"]').each(function () {
    var val = $(this).val();
    val = ribuantodb(val);
    if (val != '' || val > 0) {
      total = parseFloat(total) + parseFloat(val);
    }
  });
  $('[name=total_qty]').val(decimal(total));
}


function runRibuan() {
  $('input.ribuan').on('keyup',function (e) {
    var val = $(this).val()
    $(this).val(ribuan(val));
  });
}
runRibuan();

function runDecimal() {
  $('input.decimal').on('blur',function (e) {
    var val = $(this).val()
    $(this).val(decimal(val));
  });
}
runDecimal();

function ribuan(val) {
  return numeral(val).format('0,0');
}

function decimal(val) {
  return numeral(val).format('0,0.00');
}

function ribuantodb(val='') {
  return val.replace(/,/g,'');
}

function setkg(set) {
  var dataSatuan = {
        id: 'ST001',
        text: 'KG'
    };
  var newOptionSatuan = new Option(dataSatuan.text, dataSatuan.id, false, false);
  set.append(newOptionSatuan).trigger('change');
}

function setpcs(set) {
  var dataSatuan = {
        id: 'ST003',
        text: 'Pcs'
    };
  var newOptionSatuan = new Option(dataSatuan.text, dataSatuan.id, false, false);
  set.append(newOptionSatuan).trigger('change');
}

function setcostumer(set,costumer_id,nama_costumer) {
  var dataCostumer = {
        id: costumer_id,
        text: nama_costumer
    };
  var newOptionCostumer = new Option(dataCostumer.text, dataCostumer.id, false, false);
  set.append(newOptionCostumer).trigger('change');
}

function setpcs(set) {
  var dataSatuan = {
        id: 'ST003',
        text: 'Pcs'
    };
  var newOptionSatuan = new Option(dataSatuan.text, dataSatuan.id, false, false);
  set.append(newOptionSatuan).trigger('change');
}

function rundesimal() {
  $('input.decimal').on('blur',function (e) {
    var val = $(this).val()
    $(this).val(decimal(val));
  });
}

function myswal($title,$text,$type,$timer) {

  if ($title == 's') {
    $title = 'Success !';
  } else if ($title == 'e') {
    $title = 'Oops...';
  } else if ($title == 'w') {
    $title = 'Warning !';
  }

  if ($text != '') {
    $text = $text;
  } else {
    $text = '';
  }

  if ($type == 's') {
    $type = 'success';
  } else if ($type == 'e') {
    $type = 'warning';
  } else if ($type == 'w') {
    $type = 'warning';
  }

  swal({
      title: $title,
      text: $text,
      type: $type,
      timer: $timer
  });
}

runselect2();
function runselect2() {

  $('[name=akun_id]').select2({
    ajax: {
      url: baseurl+'/get_akun',
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

  $('[name=proses_id]').select2({
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

  $('[name=warna_id]').select2({
    ajax: {
      url: baseurl+'/get_warna',
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

  $('[name="id_costumer"]').select2({
    ajax: {
      url: baseurl+'/get_costumer',
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
      },
    }
  });

  $('[name=supplier_id]').select2({
    ajax: {
      url: baseurl+'/get_supplier',
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

  $('[name=brand_id]').select2({
    ajax: {
      url: baseurl+'/get_brand',
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

  $('[name=bb_id]').select2({
    ajax: {
      url: baseurl+'/get_bb',
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

  $('[name=bj_id]').select2({
    ajax: {
      url: baseurl+'/get_bj',
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

  $('[name="master_bj_id[]"]').select2({
    ajax: {
      url: baseurl+'/get_master_bj',
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

  $('[name=acc_id]').select2({
    ajax: {
      url: baseurl+'/get_acc',
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

  $('[name=master_bb_id]').select2({
    ajax: {
      url: baseurl+'/get_master_bb',
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

  $('[name="satuan_id[]"]').select2({
    ajax: {
      url: baseurl+'/get_satuan',
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
      },
    }
  });

}
