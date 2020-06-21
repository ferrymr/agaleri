<!-- <div class="modal" id="modalEdit" tabindex="1" role="dialog" aria-hidden="true" data-backdrop="static">
  <div class="modal-dialog modal-lg">
    <div class="modal-content">
      <form id="formEdit" method="post" class="form-horizontal" data-toggle="validator" enctype="multipart/form-data">
        {{ csrf_field() }} {{ method_field('POST') }}
        <div class="modal-header" style="background-color:#2C3742;color:white;">
          <button type="button" class="close" data-dismiss="modal" aria-label="Close">
            <span aria-hidden="true"> &times; </span>
          </button>
          <h3 class="modal-title"></h3>
        </div>

        <div class="modal-body">
          <div class="form-group">
            <label for="id_edit" class="col-md-3 control-label">Kode {{ $title }}</label>
            <div class="col-md-2">
              <input type="text" id="id_edit" name="id_edit" class="form-control" required readonly>
            </div>
          </div>

          <div class="form-group">
            <label for="name_edit" class="col-md-3 control-label">Nama {{ $title }}</label>
            <div class="col-md-9">
              <input type="text" id="name_edit" name="name_edit" class="form-control" autofocus required>
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
                @foreach($banks as $b)
                <option value="{{ $b->id }}">{{ $b->name }}</option>
                @endforeach
              </select>
            </div>
            <label for="no_rek_edit" class="col-md-2 control-label">Nomor Rekening</label>
            <div class="col-md-2">
              <input type="number" class="form-control" name="no_rek_edit" >
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

          <div class="modal-footer">
            <button type="submit" class="btn btn-primary btn-save"><i class="fa fa-send"></i> Update</button>
            <button type="button" class="btn btn-default" data-dismiss="modal"><i class="fa fa-refresh"></i> Cancel</button>
          </div>

        </form>
      </div>
    </div>
  </div>
 -->


  <!-- <div class="modal fade" id="modalEdit" tabindex="-1" role="dialog" aria-labelledby="modalEditLabel" aria-hidden="true">
  <div class="modal-dialog modal-lg">
  <div class="modal-content">
  <div class="modal-header">
  <button type="button" class="close" data-dismiss="modal" aria-hidden="true">
  &times;
</button>
<h4 class="modal-title" id="modalEditLabel">Edit</h4>
</div>
<div class="modal-body">
<form class="form-horizontal" method="POST" action="{{ url('update_costumer') }}">
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
@foreach($banks as $b)
<option value="{{ $b->id }}">{{ $b->name }}</option>
@endforeach
</select>
</div>
<label for="no_rek_edit" class="col-md-2 control-label">Nomor Rekening</label>
<div class="col-md-2">
<input type="number" class="form-control" name="no_rek_edit" >
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
</div> -->
