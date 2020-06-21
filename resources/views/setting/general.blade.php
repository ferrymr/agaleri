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
        Setting {{ $title }}
      </h1>
    </div>
  </div>

  <section id="widget-grid" class="">
    <div class="row">
      <article class="col-sm-12 col-md-12 col-lg-12">
        <div class="jarviswidget" id="wid-id-0" data-widget-colorbutton="false" data-widget-editbutton="false">
          <header>
            <span class="widget-icon"> <i class="fa fa-send"></i> </span>
            <h2>Setting {{ $title }}</h2>
          </header>
          <div>
            <div class="widget-body">
              <form id="formAdd" method="post" class="form-horizontal" data-toggle="validator" enctype="multipart/form-data">
                {{ csrf_field() }} {{ method_field('POST') }}
                <fieldset>
                  <div class="form-group">
                    <label class="col-md-2 control-label">Nama Perusahaan</label>
                    <div class="col-md-7">
                      <input class="form-control" name="name_perusahaan" placeholder="Masukkan Nama Perusahaan" type="text" autofocus required maxlength="50" value="{{ $param[0]->name_perusahaan }}">
                      <span class="help-block with-errors"></span>
                    </div>
                  </div>

                  <div class="form-group">
                    <label class="col-md-2 control-label">Nama Aplikasi</label>
                    <div class="col-md-7">
                      <input class="form-control" name="name_aplikasi" placeholder="Masukkan Nama Aplikasi" type="text" maxlength="50" value="{{ $param[0]->name_aplikasi }}">
                      <span class="help-block with-errors"></span>
                    </div>
                  </div>

                  <div class="form-group">
                    <label class="col-md-2 control-label">Versi Aplikasi</label>
                    <div class="col-md-7">
                      <input class="form-control" name="versi" placeholder="Masukkan Versi " type="text" maxlength="50" value="{{ $param[0]->versi }}">
                      <span class="help-block with-errors"></span>
                    </div>
                  </div>

                  <div class="form-group">
                    <label class="col-md-2 control-label">Alamat Perusahaan</label>
                    <div class="col-md-7">
                      <input class="form-control" name="alamat" placeholder="Alamat" type="text" maxlength="255" value="{{ $param[0]->alamat }}">
                      <span class="help-block with-errors"></span>
                    </div>
                  </div>

                  <div class="form-group">
                    <label class="col-md-2 control-label">Email Perusahaan</label>
                    <div class="col-md-7">
                      <input class="form-control" name="email" placeholder="Masukkan Email" type="email" required maxlength="255" value="{{ $param[0]->email }}">
                      <span class="help-block with-errors"></span>
                    </div>
                  </div>

                  <div class="form-group">
                    <label class="col-md-2 control-label">No Telepon Kantor</label>
                    <div class="col-md-7">
                      <input class="form-control" name="telepon" placeholder="Masukkan No Telepon" type="text" maxlength="15" value="{{ $param[0]->telepon }}">
                      <span class="help-block with-errors"></span>
                    </div>
                  </div>

                  <div class="form-group">
                    <label class="col-md-2 control-label">No Whatsapp</label>
                    <div class="col-md-7">
                      <input class="form-control" name="no_wa" placeholder="Masukkan No WA" type="number" maxlength="15" value="{{ $param[0]->no_wa }}">
                      <span class="help-block with-errors"></span>
                    </div>
                  </div>

                  <div class="form-group">
                    <label class="col-md-2 control-label">Copyright Year</label>
                    <div class="col-md-7">
                      <input class="form-control" name="copyright_year" placeholder="Masukkan Tahun Pembuatan" type="text" value="{{ $param[0]->copyright_year }}">
                      <span class="help-block with-errors"></span>
                    </div>
                  </div>

                  <div class="form-group">
                    <label class="col-md-2 control-label">Logo eCommerce Header</label>
                    <div class="col-md-4">
                      <input type="file" class="btn btn-default" id="photo_header" name="photo_header">
                      <p class="help-block">
                        Upload
                      </p>
                    </div>
                  </div>

                  <div class="form-group">
                    <label class="col-md-2 control-label">Logo eCommerce Footer</label>
                    <div class="col-md-4">
                      <input type="file" class="btn btn-default" id="photo_footer" name="photo_footer">
                      <p class="help-block">
                        Upload
                      </p>
                    </div>
                  </div>

                  <div class="form-group">
                    <label class="col-md-2 control-label">Logo Header Admin</label>
                    <div class="col-md-4">
                      <input type="file" class="btn btn-default" id="photo_admin" name="photo_admin">
                      <p class="help-block">
                        Upload
                      </p>
                    </div>
                  </div>


                </fieldset>

                <div class="form-actions">
                  <div class="row">
                    <div class="col-md-12">
                      <a id="btnResetAdd" class="btn btn-default">
                        Batal
                      </a>
                      <button id="btnAdd" type="submit" class="btn btn-primary">
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
      </article>
    </div>
  </section>
</div>

@endsection

@section('script')
<script>
  var tag = '{{$tag}}';

  $(function() {
    $('#btnResetAdd').on('click', function(e) {
      $('#formAdd')[0].reset();
    });

    $('#formAdd').validator().on('submit', function(e) {
      $('input[name=_method]').val('PATCH');
      if (!e.isDefaultPrevented()) {
        var id = $('#id').val();
        url = "{{ url('general') }}";

        $.ajax({
          url: url,
          type: "POST",
          data: $('#formAdd').serialize(),
          success: function(data) {
            console.log(data.status);
            if (data.status == true) {
              myswal('s', data.message, 's', 1500);
            } else {
              myswal('w', data.message, 'w', 1500);
            }
          },
          error: function(data) {
            myswal('w', 'Opps', 'w', 1500);
          }
        });
        return false;
      }
    });

  });
</script>
@endsection