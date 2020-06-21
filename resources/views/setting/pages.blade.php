@extends('layouts.app')

@section('style')
<style>

</style>
@endsection

@section('content')
<div id="main" class="utama_panel" role="main">
  <div id="content">
    <div class="row">
      <div class="col-xs-12 col-sm-7 col-md-7 col-lg-4">
        <h1 class="page-title txt-color-blueDark"><i class="fa fa-desktop fa-fw "></i>
          Master {{ $title }}
        </h1>
      </div>
    </div>
    <section id="widget-grid" class="">
      <div class="row">
        <article class="col-sm-12 col-md-12 col-lg-12">
          <div class="jarviswidget jarviswidget-color-orange" id="wid-id-0" data-widget-colorbutton="false" data-widget-editbutton="false">
            <header>
              <span class="widget-icon"> <i class="fa fa-send"></i> </span>
              <h2>Tambah {{ $title }}</h2>
            </header>

            <div>
              <div class="widget-body">
                <form id="formAdd" method="post" class="form-horizontal" data-toggle="validator" enctype="multipart/form-data">
                  {{ csrf_field() }} {{ method_field('POST') }}

                  <fieldset>
                    <div class="form-group">
                      <label class="col-md-2 control-label">Name</label>
                      <div class="col-md-5">
                        <input class="form-control" name="name" placeholder="Masukkan Nama {{ $title }}" type="text" autofocus required maxlength="50">
                        <span class="help-block with-errors">Lower Case & Unique</span>
                      </div>
                    </div>

                    <div class="form-group">
                      <label class="col-md-2 control-label">Title {{ $title }}</label>
                      <div class="col-md-10">
                        <input class="form-control" name="title" placeholder="Masukkan Title {{ $title }}" type="text" required>
                        <span class="help-block with-errors"></span>
                      </div>
                    </div>

                    <div class="form-group">
                      <label class="col-md-2 control-label">Content</label>
                      <div class="col-md-10">
                        <input type="hidden" name="content">
                        <textarea name="content_pages">
											</textarea>
                      </div>
                    </div>

                    <div class="form-group">
                      <label class="col-md-2 control-label">Featured Image</label>
                      <div class="col-md-4">
                        <input type="file" class="btn btn-default" id="featured_image" name="featured_image">
                        <p class="help-block">
                          Upload
                        </p>
                      </div>
                    </div>

                    <div class="form-group">
                      <label class="col-md-2 control-label">Status</label>
                      <div class="col-md-10">
                        <label class="radio radio-inline">
                          <input type="radio" value="A" class="radiobox" name="status" checked>
                          <span>Aktif</span>
                        </label>
                        <label class="radio radio-inline">
                          <input type="radio" value="N" class="radiobox" name="status">
                          <span>Non Aktif</span>
                        </label>
                      </div>
                    </div>
                    <!-- widget content -->
                    <!-- <div class="widget-body no-padding">
                      <textarea name="ckeditor2">
												&lt;h1&gt;&lt;img alt="Saturn V carrying Apollo 11" class="right" src="img/demo/sample.jpg"/&gt; Apollo 11&lt;/h1&gt; &lt;p&gt;&lt;b&gt;Apollo 11&lt;/b&gt; was the spaceflight that landed the first humans, Americans &lt;a href="http://en.wikipedia.org/wiki/Neil_Armstrong" title="Neil Armstrong"&gt;Neil Armstrong&lt;/a&gt; and &lt;a href="http://en.wikipedia.org/wiki/Buzz_Aldrin" title="Buzz Aldrin"&gt;Buzz Aldrin&lt;/a&gt;, on the Moon on July 20, 1969, at 20:18 UTC. Armstrong became the first to step onto the lunar surface 6 hours later on July 21 at 02:56 UTC.&lt;/p&gt; &lt;p&gt;Armstrong spent about &lt;strike&gt;three and a half&lt;/strike&gt; two and a half hours outside the spacecraft, Aldrin slightly less; and together they collected 47.5 pounds (21.5&amp;nbsp;kg) of lunar material for return to Earth. A third member of the mission, &lt;a href="http://en.wikipedia.org/wiki/Michael_Collins_(astronaut)" title="Michael Collins (astronaut)"&gt;Michael Collins&lt;/a&gt;, piloted the &lt;a href="http://en.wikipedia.org/wiki/Apollo_Command/Service_Module" title="Apollo Command/Service Module"&gt;command&lt;/a&gt; spacecraft alone in lunar orbit until Armstrong and Aldrin returned to it for the trip back to Earth.&lt;/p&gt; &lt;h2&gt;Broadcasting and &lt;em&gt;quotes&lt;/em&gt; &lt;a id="quotes" name="quotes"&gt;&lt;/a&gt;&lt;/h2&gt; &lt;p&gt;Broadcast on live TV to a world-wide audience, Armstrong stepped onto the lunar surface and described the event as:&lt;/p&gt; &lt;blockquote&gt;&lt;p&gt;One small step for [a] man, one giant leap for mankind.&lt;/p&gt;&lt;/blockquote&gt; &lt;p&gt;Apollo 11 effectively ended the &lt;a href="http://en.wikipedia.org/wiki/Space_Race" title="Space Race"&gt;Space Race&lt;/a&gt; and fulfilled a national goal proposed in 1961 by the late U.S. President &lt;a href="http://en.wikipedia.org/wiki/John_F._Kennedy" title="John F. Kennedy"&gt;John F. Kennedy&lt;/a&gt; in a speech before the United States Congress:&lt;/p&gt; &lt;blockquote&gt;&lt;p&gt;[...] before this decade is out, of landing a man on the Moon and returning him safely to the Earth.&lt;/p&gt;&lt;/blockquote&gt; &lt;h2&gt;Technical details &lt;a id="tech-details" name="tech-details"&gt;&lt;/a&gt;&lt;/h2&gt; &lt;table align="right" border="1" bordercolor="#ccc" cellpadding="5" cellspacing="0" style="border-collapse:collapse;margin:10px 0 10px 15px;"&gt; &lt;caption&gt;&lt;strong&gt;Mission crew&lt;/strong&gt;&lt;/caption&gt; &lt;thead&gt; &lt;tr&gt; &lt;th scope="col"&gt;Position&lt;/th&gt; &lt;th scope="col"&gt;Astronaut&lt;/th&gt; &lt;/tr&gt; &lt;/thead&gt; &lt;tbody&gt; &lt;tr&gt; &lt;td&gt;Commander&lt;/td&gt; &lt;td&gt;Neil A. Armstrong&lt;/td&gt; &lt;/tr&gt; &lt;tr&gt; &lt;td&gt;Command Module Pilot&lt;/td&gt; &lt;td&gt;Michael Collins&lt;/td&gt; &lt;/tr&gt; &lt;tr&gt; &lt;td&gt;Lunar Module Pilot&lt;/td&gt; &lt;td&gt;Edwin &amp;quot;Buzz&amp;quot; E. Aldrin, Jr.&lt;/td&gt; &lt;/tr&gt; &lt;/tbody&gt; &lt;/table&gt; &lt;p&gt;Launched by a &lt;strong&gt;Saturn V&lt;/strong&gt; rocket from &lt;a href="http://en.wikipedia.org/wiki/Kennedy_Space_Center" title="Kennedy Space Center"&gt;Kennedy Space Center&lt;/a&gt; in Merritt Island, Florida on July 16, Apollo 11 was the fifth manned mission of &lt;a href="http://en.wikipedia.org/wiki/NASA" title="NASA"&gt;NASA&lt;/a&gt;&amp;#39;s Apollo program. The Apollo spacecraft had three parts:&lt;/p&gt; &lt;ol&gt; &lt;li&gt;&lt;strong&gt;Command Module&lt;/strong&gt; with a cabin for the three astronauts which was the only part which landed back on Earth&lt;/li&gt; &lt;li&gt;&lt;strong&gt;Service Module&lt;/strong&gt; which supported the Command Module with propulsion, electrical power, oxygen and water&lt;/li&gt; &lt;li&gt;&lt;strong&gt;Lunar Module&lt;/strong&gt; for landing on the Moon.&lt;/li&gt; &lt;/ol&gt; &lt;p&gt;After being sent to the Moon by the Saturn V&amp;#39;s upper stage, the astronauts separated the spacecraft from it and travelled for three days until they entered into lunar orbit. Armstrong and Aldrin then moved into the Lunar Module and landed in the &lt;a href="http://en.wikipedia.org/wiki/Mare_Tranquillitatis" title="Mare Tranquillitatis"&gt;Sea of Tranquility&lt;/a&gt;. They stayed a total of about 21 and a half hours on the lunar surface. After lifting off in the upper part of the Lunar Module and rejoining Collins in the Command Module, they returned to Earth and landed in the &lt;a href="http://en.wikipedia.org/wiki/Pacific_Ocean" title="Pacific Ocean"&gt;Pacific Ocean&lt;/a&gt; on July 24.&lt;/p&gt; &lt;hr/&gt; &lt;p style="text-align: right;"&gt;&lt;small&gt;Source: &lt;a href="http://en.wikipedia.org/wiki/Apollo_11"&gt;Wikipedia.org&lt;/a&gt;&lt;/small&gt;&lt;/p&gt;
				              </textarea>
                    </div> -->
                    <!-- end widget content -->


                  </fieldset>

                  <div class="form-actions">
                    <div class="row">
                      <div class="col-md-12">
                        <button id="btnAdd" type="submit" class="btn btn-primary">
                          <i class="fa fa-send"></i>
                          Simpan
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
                      <th>Name {{ $title }}</th>
                      <th>Title</th>
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
              <label for="id_edit" class="col-md-3 control-label">ID {{ $title }}</label>
              <div class="col-md-2">
                <input type="text" id="id_edit" name="id_edit" class="form-control" required readonly>
                <span class="help-block with-errors"></span>
              </div>
            </div>

            <div class="form-group">
              <label for="name_edit" class="col-md-3 control-label">Name {{ $title }}</label>
              <div class="col-md-9">
                <input type="text" id="name_edit" name="name_edit" class="form-control" autofocus required>
                <span class="help-block with-errors"></span>
              </div>
            </div>

            <div class="form-group">
              <label for="name_edit" class="col-md-3 control-label">Title {{ $title }}</label>
              <div class="col-md-9">
                <input type="text" id="title_edit" name="title_edit" class="form-control" autofocus required>
                <span class="help-block with-errors"></span>
              </div>
            </div>

            <div class="form-group">
              <label class="col-md-3 control-label">Content</label>
              <div class="col-md-9">
                <input type="hidden" name="content_edit">
                <textarea name="content_pages_edit">
								</textarea>
              </div>
            </div>

            <div class="form-group">
              <label class="col-md-3 control-label">Featured Image</label>
              <div class="col-md-9">
                <input type="file" class="btn btn-default" id="featured_image_edit" name="featured_image_edit">
                <p class="help-block">
                  Upload
                </p>
              </div>
            </div>

            <div class="form-group">
              <label class="col-md-3 control-label">Status</label>
              <div class="col-md-9">
                <label class="radio radio-inline">
                  <input type="radio" value="A" class="radiobox" id="status_edit_a" name="status_edit">
                  <span>Aktif</span>
                </label>
                <label class="radio radio-inline">
                  <input type="radio" value="N" class="radiobox" id="status_edit_n" name="status_edit">
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


  <!-- END MAIN CONTENT -->
  @endsection

  @section('script')
  <script>
    var token = $('meta[name="csrf-token"]').attr('content');
    var tag = '{{$tag}}';
    var table = $('#' + tag + '-table').DataTable({
      processing: true,
      serverSide: true,
      ajax: "{{ route('pages.api') }}",
      columns: [{
          data: 'id',
          name: 'id'
        },
        {
          data: 'name',
          name: 'name'
        },
        {
          data: 'title',
          name: 'title'
        },
        {
          data: 'status',
          name: 'status'
        },
        {
          data: 'action',
          name: 'action',
          orderable: false,
          searchable: false
        }
      ]
    });

    function editData(id) {
      save_method = 'edit';
      $('input[name=_method]').val('PATCH');
      $('#modalEdit form')[0].reset();
      $.ajax({
        url: "{{ url('pages') }}" + '/' + id + "/edit",
        type: "GET",
        dataType: "JSON",
        success: function(data) {
          $('#modalEdit').modal('show');
          $('.modal-title').text('Edit Pages ');
          $('#id_edit').val(data.id);
          $('#name_edit').val(data.name);
          $('#title_edit').val(data.title);
          $('[name=content_edit]').val(CKEDITOR.instances['content_pages_edit'].getData());
          CKEDITOR.instances['content_pages_edit'].setData(data.content);
          if (data.status == 'A') {
            $('#status_edit_a').prop('checked', true);
          } else {
            $('#status_edit_n').prop('checked', true);
          }
        },
        error: function() {
          myswal('e', 'No Data..', 'e', 1500);
        }
      });
    }

    function deleteData(id) {
      var csrf_token = $('meta[name="csrf-token"]').attr('content');
      swal({
        title: 'Are you sure?',
        text: "You won't be able to revert this!",
        type: 'warning',
        showCancelButton: true,
        cancelButtonColor: '#d33',
        confirmButtonColor: '#3085d6',
        confirmButtonText: 'Yes, delete it!'
      }).then((result) => {
        if (result.value) {
          $.ajax({
            url: "{{ url('pages') }}" + '/' + id,
            type: "POST",
            data: {
              '_method': 'DELETE',
              '_token': csrf_token
            },
            success: function(data) {
              table.ajax.reload();
              $('#id').val(data.newid);
              $('#name').focus();
              myswal('s', data.message, 's', 1500);
            },
            error: function() {
              $('#id').val(data.newid);
              $('#name').focus();
              myswal('e', data.message, 'e', 1500);
            }
          });
        }
      });
    }

    $(function() {

      $('#btnResetAdd').on('click', function(e) {
        $('#formAdd')[0].reset();
      });

      $('#formAdd').validator().on('submit', function(e) {
        $('[name=content]').val(CKEDITOR.instances['content_pages'].getData());
        $('input[name=_method]').val('POST');
        if (!e.isDefaultPrevented()) {
          var id = $('#id').val();
          url = "{{ url('pages_c') }}";

          $.ajax({
            url: url,
            type: "POST",
            data: new FormData($("#formAdd")[0]),
            // data : $('#formAdd').serialize(),
            contentType: false, //matikan jika menggunakan serialize
            processData: false, //matikan jika menggunakan serialize
            success: function(data) {
              table.ajax.reload();
              $('#formAdd')[0].reset();
              if (data.status == true) {
                myswal('s', data.message, 's', 1500);
                CKEDITOR.instances['content_pages'].setData('');
                $('#name').focus();
              } else {
                myswal('e', data.message, 'e', 1500);
                $('#name').focus();
              }
            },
            error: function(data) {
              myswal('e', data.message, 'e', 1500);
            }
          });
          return false;
        }
      });


      $('#modalEdit form').validator().on('submit', function(e) {
        if (!e.isDefaultPrevented()) {
          $('[name=content_edit]').val(CKEDITOR.instances['content_pages_edit'].getData());
          var id = $('#id_edit').val();
          url = "{{ url('pages') . '/' }}" + id;

          $.ajax({
            url: url,
            type: "POST",
            data: new FormData($("#formEdit")[0]),
            // data : $('#formEdit').serialize(),
            contentType: false, //matikan jika menggunakan serialize
            processData: false, //matikan jika menggunakan serialize
            success: function(data) {
              $('#modalEdit').modal('hide');
              table.ajax.reload();
              myswal('s', data.message, 's', 1500);
            },
            error: function(data) {
              myswal('e', data.message, 'e', 1500);
            }
          });
          return false;
        }
      });

    });
  </script>

  <script>
    CKEDITOR.replace('content_pages', {
      height: '380px',
      startupFocus: true
    });

    CKEDITOR.replace('content_pages_edit', {
      height: '380px',
      startupFocus: true
    });
  </script>

  @endsection