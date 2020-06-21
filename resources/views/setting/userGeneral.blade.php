<div class="modal" id="modalEdit" tabindex="1" role="dialog" aria-hidden="true" data-backdrop="static">
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
                        <label for="id_edit" class="col-md-2 control-label">Kode {{ $title }}</label>
                        <div class="col-md-3">
                            <input type="text" id="id_edit" name="id_edit" class="form-control" required readonly>
                            <input type="hidden" id="id_hidden" name="id_hidden" value="Norway">
                            <span class="help-block with-errors"></span>
                        </div>
                    </div>

                    <div class="form-group">
                      <label class="col-md-2 control-label">Nama {{ $title }}</label>
                      <div class="col-md-7">
                        <input class="form-control" id="name_edit" name="name_edit" placeholder="Masukkan Nama {{ $title }}" type="text" autofocus required maxlength="50">
                        <span class="help-block with-errors"></span>
                      </div>
                    </div>

                    <!-- <div class="form-group">
                      <label class="col-md-2 control-label">Hak Akses </label>
                      <div class="col-md-2">
                        <select class="select2" name="role_edit">
                          <option></option>
                          <option id="isactive_edit_sa" value="SA">Super Admin</option>
                        </select>
                      </div>
                    </div> -->

                    <div class="form-group">
                      <label class="col-md-2 control-label">Email {{ $title }}</label>
                      <div class="col-md-7">
                        <input class="form-control" id="email_edit" name="email_edit" placeholder="Masukkan Email {{ $title }}" type="text" autofocus required maxlength="50">
                        <span class="help-block with-errors"></span>
                      </div>
                    </div>

                    <div class="form-group">
                      <label class="col-md-2 control-label">KTP</label>
                      <div class="col-md-7">
                        <input class="form-control" id="ktp_edit" name="ktp_edit" placeholder="Masukkan KTP {{ $title }}" type="text" autofocus required maxlength="50">
                        <span class="help-block with-errors"></span>
                      </div>
                    </div>

                    <div class="form-group">
                      <label class="col-md-2 control-label">Telepon {{ $title }}</label>
                      <div class="col-md-7">
                        <input class="form-control" id="telp_edit" name="telp_edit" placeholder="Masukkan Telepon {{ $title }}" type="text" autofocus required maxlength="50">
                        <span class="help-block with-errors"></span>
                      </div>
                    </div>

                    <div class="form-group">
                      <label class="col-md-2 control-label">Alamat</label>
                      <div class="col-md-7">
                        <input class="form-control" id="alamat_edit" name="alamat_edit" placeholder="Alamat" type="text" autofocus required maxlength="50">
                        <span class="help-block with-errors"></span>
                      </div>
                    </div>

                    <div class="form-group">
                      <label class="col-md-2 control-label">Status</label>
                      <div class="col-md-10">
                        <label class="radio radio-inline">
                          <input id="isactive_edit_a" type="radio" value="A" class="radiobox" name="isactive_edit">
                          <span>Aktif</span>
                        </label>
                        <label class="radio radio-inline">
                          <input id="isactive_edit_n" type="radio" value="N" class="radiobox" name="isactive_edit">
                          <span>Non Aktif</span>
                        </label>
                      </div>
                    </div>
                </div>

                <div class="modal-footer">
                    <button type="submit" class="btn btn-primary btn-save">Submit</button>
                    <button type="button" class="btn btn-default" data-dismiss="modal">Cancel</button>
                </div>

            </form>
        </div>
    </div>
</div>
