//Mengaktifkan Fungsi Select 2 Default
function runSelect2Accounting() {
  // console.log(112);
  $('[name=id_payment]').select2({
    ajax: {
      url: baseurl+'/get_payment',
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

  $('[name=id_category]').select2({
    ajax: {
      url: baseurl+'/get_category',
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

  $('[name="id_akun"]').select2({
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
      },
    }
  });

}
