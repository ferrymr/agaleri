@extends('layouts.app')

@section('content')
<div id="main" class="utama_panel"role="main">
  <div id="content">
    <div class="row">
      <div class="col-xs-12 col-sm-7 col-md-7 col-lg-4">
        <h1 class="page-title txt-color-blueDark"><i class="fa fa-desktop fa-fw "></i>
          {{$title}}
        </h1>
      </div>
    </div>
    @if ($msg != '')
    <div class="msg alert alert-success">
      {{$msg}}
    </div>
    @endif
    <section id="widget-grid" class="">
      <div class="row">
        <article class="col-sm-12 col-md-12 col-lg-12 sortable-grid ui-sortable">
          <div class="jarviswidget jarviswidget-color-orange" id="wid-id-1"  data-widget-editbutton="false" data-widget-colorbutton="false" data-widget-deletebutton="false" data-widget-fullscreenbutton="false" data-widget-collapsed="true">
            <header role="heading" class="ui-sortable-handle"><div class="jarviswidget-ctrls" role="menu">   <a href="javascript:void(0);" class="button-icon jarviswidget-toggle-btn" rel="tooltip" title="" data-placement="bottom" data-original-title="Collapse"><i class="fa fa-minus "></i></a> <a href="javascript:void(0);" class="button-icon jarviswidget-fullscreen-btn" rel="tooltip" title="" data-placement="bottom" data-original-title="Fullscreen"><i class="fa fa-expand "></i></a> <a href="javascript:void(0);" class="button-icon jarviswidget-delete-btn" rel="tooltip" title="" data-placement="bottom" data-original-title="Delete"><i class="fa fa-times"></i></a></div><div class="widget-toolbar" role="menu"><a data-toggle="dropdown" class="dropdown-toggle color-box selector" href="javascript:void(0);"></a><ul class="dropdown-menu arrow-box-up-right color-select pull-right"><li><span class="bg-color-green" data-widget-setstyle="jarviswidget-color-green" rel="tooltip" data-placement="left" data-original-title="Green Grass"></span></li><li><span class="bg-color-greenDark" data-widget-setstyle="jarviswidget-color-greenDark" rel="tooltip" data-placement="top" data-original-title="Dark Green"></span></li><li><span class="bg-color-greenLight" data-widget-setstyle="jarviswidget-color-greenLight" rel="tooltip" data-placement="top" data-original-title="Light Green"></span></li><li><span class="bg-color-purple" data-widget-setstyle="jarviswidget-color-purple" rel="tooltip" data-placement="top" data-original-title="Purple"></span></li><li><span class="bg-color-magenta" data-widget-setstyle="jarviswidget-color-magenta" rel="tooltip" data-placement="top" data-original-title="Magenta"></span></li><li><span class="bg-color-pink" data-widget-setstyle="jarviswidget-color-pink" rel="tooltip" data-placement="right" data-original-title="Pink"></span></li><li><span class="bg-color-pinkDark" data-widget-setstyle="jarviswidget-color-pinkDark" rel="tooltip" data-placement="left" data-original-title="Fade Pink"></span></li><li><span class="bg-color-blueLight" data-widget-setstyle="jarviswidget-color-blueLight" rel="tooltip" data-placement="top" data-original-title="Light Blue"></span></li><li><span class="bg-color-teal" data-widget-setstyle="jarviswidget-color-teal" rel="tooltip" data-placement="top" data-original-title="Teal"></span></li><li><span class="bg-color-blue" data-widget-setstyle="jarviswidget-color-blue" rel="tooltip" data-placement="top" data-original-title="Ocean Blue"></span></li><li><span class="bg-color-blueDark" data-widget-setstyle="jarviswidget-color-blueDark" rel="tooltip" data-placement="top" data-original-title="Night Sky"></span></li><li><span class="bg-color-darken" data-widget-setstyle="jarviswidget-color-darken" rel="tooltip" data-placement="right" data-original-title="Night"></span></li><li><span class="bg-color-yellow" data-widget-setstyle="jarviswidget-color-yellow" rel="tooltip" data-placement="left" data-original-title="Day Light"></span></li><li><span class="bg-color-orange" data-widget-setstyle="jarviswidget-color-orange" rel="tooltip" data-placement="bottom" data-original-title="Orange"></span></li><li><span class="bg-color-orangeDark" data-widget-setstyle="jarviswidget-color-orangeDark" rel="tooltip" data-placement="bottom" data-original-title="Dark Orange"></span></li><li><span class="bg-color-red" data-widget-setstyle="jarviswidget-color-red" rel="tooltip" data-placement="bottom" data-original-title="Red Rose"></span></li><li><span class="bg-color-redLight" data-widget-setstyle="jarviswidget-color-redLight" rel="tooltip" data-placement="bottom" data-original-title="Light Red"></span></li><li><span class="bg-color-white" data-widget-setstyle="jarviswidget-color-white" rel="tooltip" data-placement="right" data-original-title="Purity"></span></li><li><a href="javascript:void(0);" class="jarviswidget-remove-colors" data-widget-setstyle="" rel="tooltip" data-placement="bottom" data-original-title="Reset widget color to default">Remove</a></li></ul></div>
              <span class="widget-icon"> <i class="fa fa-plus"></i> </span>
              <h2>Tambah Data</h2>
              <span class="jarviswidget-loader"><i class="fa fa-refresh fa-spin"></i></span></header>
              <div role="content">
                <div class="widget-body">
                  <div role="content">
                    <div class="widget-body">
                      <form class="form-horizontal" method="POST" action="{{ url('cmt_create') }}">
                        {{ csrf_field() }}

                        <div class="form-group">
                          <label for="id" class="col-md-2 control-label">Kode</label>
                          <div class="col-md-2">
                            <input id="id" type="text" class="form-control" name="id" value="{{ $newid }}" disabled="">
                          </div>
                        </div>

                        <div class="form-group">
                          <label for="name" class="col-md-2 control-label">Nama {{$title}}</label>
                          <div class="col-md-10">
                            <input id="name" type="text" class="form-control" name="name" value="" required autofocus maxlength="75">
                          </div>
                        </div>

                        <div class="form-group">
                          <label for="alamat" class="col-md-2 control-label">Alamat</label>
                          <div class="col-md-10">
                            <input type="text" class="form-control" name="alamat" >
                          </div>
                        </div>

                        <div class="form-group">
                          <label for="kota" class="col-md-2 control-label">Kota</label>
                          <div class="col-md-4">
                            <input type="text" class="form-control" name="kota" >
                          </div>
                          <label for="kode_pos" class="col-md-2 control-label">Kode Pos</label>
                          <div class="col-md-4">
                            <input type="number" class="form-control" name="kode_pos" >
                          </div>
                        </div>

                        <div class="form-group">
                          <label for="no_telepon" class="col-md-2 control-label">No Telepon</label>
                          <div class="col-md-2">
                            <input type="number" class="form-control" name="no_telepon" >
                          </div>
                          <label for="no_hp" class="col-md-2 control-label">No HP</label>
                          <div class="col-md-2">
                            <input type="number" class="form-control" name="no_hp" >
                          </div>
                          <label for="no_fax" class="col-md-2 control-label">No Fax</label>
                          <div class="col-md-2">
                            <input type="number" class="form-control" name="no_fax" >
                          </div>
                        </div>

                        <div class="form-group">
                          <label for="email" class="col-md-2 control-label">Email</label>
                          <div class="col-md-10">
                            <input type="email" class="form-control" name="email" >
                          </div>
                        </div>


                        <div class="form-group">
                          <label for="bank_id" class="col-md-2 control-label">Bank</label>
                          <div class="col-md-2">
                            <select style="width:100%" name="bank_id" class="form-control">
                              @foreach($banks as $b)
                              <option value="{{ $b->id }}">{{ $b->name }}</option>
                              @endforeach
                            </select>
                          </div>
                          <label for="no_rek" class="col-md-2 control-label">Nomor Rekening</label>
                          <div class="col-md-2">
                            <input type="number" class="form-control" name="no_rek" >
                          </div>
                          <label for="proses_id" class="col-md-2 control-label">Proses</label>
                          <div class="col-md-2">
                            <select style="width:100%" name="proses_id" class="form-control" required="">
                              @foreach($proses as $p)
                              <option value="{{ $p->id }}">{{ $p->name }}</option>
                              @endforeach
                            </select>
                          </div>
                        </div>
                        <fieldset>
                          <legend>Accounting</legend>
                          <div class="form-group">
                            <label class="col-md-2 control-label">Kode Akun</label>
                            <div class="col-md-2">
                              <input class="form-control" id="id_akun" name="id_akun" placeholder="Kode Akun" type="text" required value="{{ $id_akun }}" maxlength="15" readonly>
                            </div>
<!--
                            <label class="col-md-2 control-label">Category </label>
                            <div class="col-md-2">
                              <select class="form-control" style="width:100%;" name="id_category" required></select>
                            </div> -->

                            <label class="col-md-2 control-label">Saldo Awal</label>
                            <div class="col-md-2">
                              <input class="form-control decimal" id="saldo" name="saldo" placeholder="Saldo" type="text" value="0" maxlength="30">
                              <span class="help-block with-errors"></span>
                            </div>
                          </div>
                        </fieldset>

                        <div class="form-group">
                          <label class="col-md-2 control-label">Status</label>
                          <div class="col-md-10">
                            <label class="radio radio-inline">
                              <input type="radio" class="radiobox" name="isactive" value="A" checked="">
                              <span>Aktif</span>
                            </label>
                            <label class="radio radio-inline">
                              <input type="radio" class="radiobox" name="isactive" value="N">
                              <span>Non Aktif</span>
                            </label>
                          </div>
                        </div>

                        <div class="form-actions">
                          <div class="row">
                            <div class="col-md-12">
                              <button class="btn btn-primary" type="submit">
                                <i class="fa fa-save"></i>
                                Simpan
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
                        <th>ID</th>
                        <th>Nama</th>
                        <th>Alamat</th>
                        <th>Kota</th>
                        <th>No Telepon</th>
                        <th>No Rekening</th>
                        <th>Status</th>
                        <th>Action</th>
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
  </div>

  <div class="modal fade" id="modalEdit" tabindex="-1" role="dialog" aria-labelledby="modalEditLabel" aria-hidden="true">
    <div class="modal-dialog modal-lg">
      <div class="modal-content">
        <div class="modal-header">
          <button type="button" class="close" data-dismiss="modal" aria-hidden="true">
            &times;
          </button>
          <h4 class="modal-title" id="modalEditLabel">Edit</h4>
        </div>
        <div class="modal-body">
          <form id="editData" class="form-horizontal" method="POST" action="{{ url('cmt_update') }}">
            {{ csrf_field() }}

            <div class="form-group">
              <label for="id_edit" class="col-md-2 control-label">Kode</label>
              <div class="col-md-10">
                <input id="id_edit" type="text" class="form-control" name="id_edit" readonly>
              </div>
            </div>

            <div class="form-group">
              <label for="name_edit" class="col-md-2 control-label">Nama {{$title}}</label>
              <div class="col-md-10">
                <input id="name_edit" type="text" class="form-control" name="name_edit" required autofocus maxlength="75">
              </div>
            </div>

            <div class="form-group">
              <label for="alamat_edit" class="col-md-2 control-label">Alamat</label>
              <div class="col-md-10">
                <input type="text" class="form-control" name="alamat_edit" >
              </div>
            </div>

            <div class="form-group">
              <label for="kota_edit" class="col-md-2 control-label">Kota</label>
              <div class="col-md-4">
                <input type="text" class="form-control" name="kota_edit" >
              </div>
              <label for="kode_pos_edit" class="col-md-2 control-label">Kode Pos</label>
              <div class="col-md-4">
                <input type="number" class="form-control" name="kode_pos_edit" >
              </div>
            </div>

            <div class="form-group">
              <label for="no_telepon_edit" class="col-md-2 control-label">No Telepon</label>
              <div class="col-md-2">
                <input type="number" class="form-control" name="no_telepon_edit" >
              </div>
              <label for="no_hp_edit" class="col-md-2 control-label">No HP</label>
              <div class="col-md-2">
                <input type="number" class="form-control" name="no_hp_edit" >
              </div>
              <label for="no_fax_edit" class="col-md-2 control-label">No Fax</label>
              <div class="col-md-2">
                <input type="number" class="form-control" name="no_fax_edit" >
              </div>
            </div>

            <div class="form-group">
              <label for="email_edit" class="col-md-2 control-label">Email</label>
              <div class="col-md-10">
                <input type="email" class="form-control" name="email_edit" >
              </div>
            </div>


            <div class="form-group">
              <label for="bank_id_edit" class="col-md-2 control-label">Bank</label>
              <div class="col-md-2">
                <select style="width:100%" name="bank_id_edit" class="form-control">
                  <option value=""></option>
                  @foreach($banks as $b)
                  <option value="{{ $b->id }}">{{ $b->name }}</option>
                  @endforeach
                </select>
              </div>
              <label for="no_rek_edit" class="col-md-2 control-label">Nomor Rekening</label>
              <div class="col-md-2">
                <input type="number" class="form-control" name="no_rek_edit" >
              </div>
              <label for="proses_id_edit" class="col-md-2 control-label">Proses</label>
              <div class="col-md-2">
                <select style="width:100%" name="proses_id_edit" class="form-control">
                  @foreach($proses as $p)
                  <option value="{{ $p->id }}">{{ $p->name }}</option>
                  @endforeach
                </select>
              </div>
            </div>

            <div class="form-group">
              <label class="col-md-2 control-label">Status</label>
              <div class="col-md-10">
                <label class="radio radio-inline">
                  <input type="radio" class="radiobox" id="isactive_edit_a" name="isactive_edit" value="A" checked="">
                  <span>Aktif</span>
                </label>
                <label class="radio radio-inline">
                  <input type="radio" class="radiobox" id="isactive_edit_n" name="isactive_edit" value="N">
                  <span>Non Aktif</span>
                </label>
              </div>
            </div>

            <div class="form-actions">
              <div class="row">
                <div class="col-md-12">
                  <button class="btn btn-primary" type="submit">
                    <i class="fa fa-save"></i>
                    Update
                  </button>
                </div>
              </div>
            </div>
          </form>
        </div>
      </div>
    </div>
  </div>



  @endsection

  @section('script')
  <script>

  var tag   = '{{$tag}}';
  var table = $('#'+tag+'-table').DataTable({
    responsive: true,
    processing: true,
    serverSide: true,
    ajax: "{{ route('cmt.api') }}",
    columns: [
      {data: 'id', name: 'id'},
      {data: 'name', name: 'name'},
      {data: 'alamat', name: 'alamat'},
      {data: 'kota', name: 'kota'},
      {data: 'no_telepon', name: 'no_telepon'},
      {data: 'no_rek', name: 'no_rek'},
      {data: 'status', name: 'status'},
      {data: 'action', name: 'action', orderable: false, searchable: false}
    ]
  });

  $(function(){
    setTimeout(function () {
      $('.msg').hide();
    }, 3000);

    $('[name="id_category"]').select2({
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
        },
      }
    });
  });

  function editData(id) {
    save_method = 'edit';
    $('input[name=_method]').val('PATCH');
    $('#modalEdit form')[0].reset();
    $.ajax({
      url: "{{ url('cmt') }}" + '/' + id + "/edit",
      type: "GET",
      dataType: "JSON",
      success: function(data) {
        $('#modalEdit').modal('show');
        $('.modal-title').text('Edit Data');
        $('[name=id_edit]').val(data.id);
        $('[name=name_edit]').val(data.name);
        $('[name=alamat_edit]').val(data.alamat);
        $('[name=kota_edit]').val(data.kota);
        $('[name=kode_pos_edit]').val(data.kode_pos);
        $('[name=no_telepon_edit]').val(data.no_telepon);
        $('[name=no_hp_edit]').val(data.no_hp);
        $('[name=no_fax_edit]').val(data.no_fax);
        $('[name=email_edit]').val(data.email);
        $('[name=bank_id_edit]').val(data.bank_id);
        $('[name=no_rek_edit]').val(data.no_rek);
        $('[name=proses_id_edit]').val(data.proses_id);
        if (data.isactive == 'A') {
          $('#isactive_edit_a').prop("checked", true);
        } else {
          $('#isactive_edit_n').prop("checked", true);
        }
      },
      error : function() {
        myswal('e','No Data..','e',1500);
      }
    });

  }

  function deleteData(id) {
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
        myswal('s','Berhasil dihapus','s',1500);
        sendAjax('/cmt_delete','POST',{id:id});
      }
    });
  }

  </script>
  @endsection
