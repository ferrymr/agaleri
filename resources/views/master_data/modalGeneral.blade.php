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
            <label for="id_edit" class="col-md-3 control-label">Kode {{ $title }}</label>
            <div class="col-md-2">
              <input type="text" id="id_edit" name="id_edit" class="form-control" required readonly>
              <span class="help-block with-errors"></span>
            </div>
          </div>

          <div class="form-group">
            <label for="name_edit" class="col-md-3 control-label">Nama {{ $title }}</label>
            <div class="col-md-9">
              <input type="text" id="name_edit" name="name_edit" class="form-control" autofocus required>
              <span class="help-block with-errors"></span>
            </div>
          </div>

          <div class="form-group">
            <label class="col-md-3 control-label">Status</label>
            <div class="col-md-9">
              <label class="radio radio-inline">
                <input type="radio" value="A" class="radiobox" id="isactive_edit_a" name="isactive_edit">
                <span>Aktif</span>
              </label>
              <label class="radio radio-inline">
                <input type="radio" value="N" class="radiobox" id="isactive_edit_n" name="isactive_edit">
                <span>Non Aktif</span>
              </label>
            </div>
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
