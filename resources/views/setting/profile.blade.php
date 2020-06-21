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
          Master {{ $title }}
      </h1>
    </div>
  </div>

  <section id="widget-grid" class="">
    <div class="row">
      <article class="col-sm-12 col-md-12 col-lg-12">
        <div class="jarviswidget" id="wid-id-0" data-widget-colorbutton="false" data-widget-editbutton="false">
          <header>
            <span class="widget-icon"> <i class="fa fa-send"></i> </span>
            <h2>{{ $title }}</h2>
          </header>
          <div>
            <div class="widget-body">
                <form id="formAdd" method="post" class="form-horizontal" data-toggle="validator" enctype="multipart/form-data">
                {{ csrf_field() }} {{ method_field('POST') }}
                <fieldset>

                  <div class="form-group">
                    <label class="col-md-2 control-label">Nama {{ $title }}</label>
                    <div class="col-md-7">
                      <input class="form-control" name="name" placeholder="Masukkan Nama {{ $title }}" type="text" value="{{ $user->name }}"autofocus required maxlength="50">
                      <span class="help-block with-errors"></span>
                    </div>
                  </div>

                  <div class="form-group">
                    <label class="col-md-2 control-label">Email {{ $title }}</label>
                    <div class="col-md-7">
                      <input class="form-control" name="email" placeholder="Masukkan Email {{ $title }}" value="{{ $user->email }}" type="email" required maxlength="50">
                      <span class="help-block with-errors"></span>
                    </div>
                  </div>

                  <div class="form-group">
                    <label class="col-md-2 control-label">No KTP</label>
                    <div class="col-md-7">
                      <input class="form-control" name="no_ktp" placeholder="Masukkan No KTP {{ $title }}" value="{{ $user->no_ktp }}" type="number" maxlength="99999999999999999999">
                      <span class="help-block with-errors"></span>
                    </div>
                  </div>

                  <div class="form-group">
                    <label class="col-md-2 control-label">No Telepon</label>
                    <div class="col-md-7">
                      <input class="form-control" name="telepon" placeholder="Masukkan Telepon {{ $title }}" value="{{ $user->telepon }}" type="text" maxlength="20">
                      <span class="help-block with-errors"></span>
                    </div>
                  </div>

                  <div class="form-group">
                    <label class="col-md-2 control-label">Alamat</label>
                    <div class="col-md-7">
                      <input class="form-control" name="alamat" placeholder="Alamat" value="{{ $user->alamat }}" type="text" maxlength="50">
                      <span class="help-block with-errors"></span>
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

    <div class="row">
      <article class="col-sm-12 col-md-12 col-lg-12">
        <div class="jarviswidget" id="wid-id-0" data-widget-colorbutton="false" data-widget-editbutton="false">
          <header>
            <span class="widget-icon"> <i class="fa fa-send"></i> </span>
            <h2>Keamanan {{ $title }}</h2>
          </header>
          <div>
            <div class="widget-body">
                <form id="formAddSecurity" method="post" class="form-horizontal" data-toggle="validator" enctype="multipart/form-data">
                {{ csrf_field() }} {{ method_field('POST') }}
                <fieldset>

                  <div class="form-group">
                    <label class="col-md-2 control-label">Password</label>
                    <div class="col-md-7">
                      <input class="form-control" name="password" placeholder="Masukkan Password" type="password" required maxlength="50">
                      <span class="help-block with-errors"></span>
                    </div>
                  </div>

                  <div class="form-group">
                    <label class="col-md-2 control-label">Confirm Password</label>
                    <div class="col-md-7">
                      <input class="form-control" name="confirm_password" placeholder="Masukkan Confirm Passowrd" type="password" required maxlength="50">
                      <span class="help-block with-errors"></span>
                    </div>
                  </div>

                  <div class="form-group">
                    <label class="col-md-2 control-label">PIN</label>
                    <div class="col-md-2">
                      <input class="form-control" name="pin" placeholder="Masukkan PIN Anda" type="password" required minlength="6" maxlength="6">
                      <span class="help-block with-errors"></span>
                    </div>
                  </div>

                  <div class="form-group">
                    <label class="col-md-2 control-label">PIN Confirm</label>
                    <div class="col-md-2">
                      <input class="form-control" name="confirm_pin" placeholder="Masukkan PIN Confirm Anda" type="password" required minlength="6" maxlength="6">
                      <span class="help-block with-errors"></span>
                    </div>
                  </div>
                </fieldset>

                <div class="form-actions">
                  <div class="row">
                    <div class="col-md-12">
                      <a id="btnResetAdd" class="btn btn-default">
                        Batal
                      </a>
                      <button id="btnAdd2" type="submit" class="btn btn-primary">
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

$(function(){
      $('#btnResetAdd').on('click', function (e) {
        $('#formAdd')[0].reset();
      });

      $('#formAdd').validator().on('submit', function (e) {
        $('input[name=_method]').val('POST');
          if (!e.isDefaultPrevented()){
              var id = $('#id').val();
              url = "{{ url('profile') }}";
              $.ajax({
                  url : url,
                  type : "POST",
                  data : $('#formAdd').serialize(),
                  success : function(data) {
                      $('#formAdd')[0].reset();
                      if (data.status == true) {
                        myswal('s',data.message,'s',1500);
                        $('[name=name]').val(data.name);
                        $('[name=email]').val(data.email);
                        $('[name=telepon]').val(data.telepon);
                        $('[name=no_ktp]').val(data.no_ktp);
                        $('[name=alamat]').val(data.alamat);
                        $('[name=name]').focus();
                      } else {
                        myswal('w','Oopps','w',1500);
                        $('[name=name]').focus();
                      }
                  },
                  error : function(data){
                    myswal('w',data.message,'w',1500);
                  }
              });
              return false;
          }
      });

      $('#formAddSecurity').validator().on('submit', function (e) {
        $('input[name=_method]').val('POST');
          if (!e.isDefaultPrevented()){
              var id = $('#id').val();
              url = "{{ url('profile/security') }}";
              $.ajax({
                  url : url,
                  type : "POST",
                  data : $('#formAddSecurity').serialize(),
                  success : function(data) {
                      $('#formAddSecurity')[0].reset();
                      if (data.status == true) {
                        myswal('s',data.message,'s',1500);
                      } else {
                        myswal('w',data.message,'w',1500);
                      }
                  },
                  error : function(data){
                    myswal('w',data.message,'w',1500);
                  }
              });
              return false;
          }
      });


      $('[name=id_role]').select2({
          ajax: {
            url: baseurl+'/role_get',
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

  });
</script>
@endsection
